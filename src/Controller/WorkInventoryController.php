<?php

namespace App\Controller;

use App\Controller\Admin\InvoiceCrudController;
use App\Entity\Company;
use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use App\Entity\PaymentType;
use App\Entity\WorkInventory;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use http\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class WorkInventoryController extends AbstractController
{
    /**
     * @var AdminUrlGenerator
     */
    private AdminUrlGenerator $adminUrlGenerator;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * @var Security
     */
    private Security $security;

    /**
     * WorkInventoryController constructor.
     * @param AdminUrlGenerator $adminUrlGenerator
     * @param EntityManagerInterface $em
     * @param Security $security
     */
    public function __construct(AdminUrlGenerator $adminUrlGenerator, EntityManagerInterface $em, Security $security)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
        $this->em = $em;
        $this->security = $security;
    }

    /**
     * @Route("/work/inventory", name="work_inventory")
     */
    public function index(): Response
    {
        dump('/work/inventory');

        return $this->render('work_inventory/index.html.twig', [
            'controller_name' => 'WorkInventoryController',
        ]);
    }

    /**
     * @Route("/work-inventory/generate-invoice-by-company/{companyId}", name="work_inventory_generate_invoice_by_company")
     */
    public function showAllWorkInventoryByCompany(int $companyId)
    {
        // generate URL to EasyAdmin controller
        $destinationUrl = $this->adminUrlGenerator
            ->setController(InvoiceCrudController::class)
            ->setAction(Crud::PAGE_INDEX);
        try {
            // get all unpaid work
            $workItemsByCompanyId = $this->em->getRepository(WorkInventory::class)
                ->getAllUnpaidWorkItemByCompanyId($companyId);

            if (!(count($workItemsByCompanyId) > 1))
                throw new InvalidArgumentException("No work inventory items which could be transformer to invoice");

            // get company by ID
            $company = $this->em->getRepository(Company::class)
                ->find($companyId);

            $lastIdOfInvoice = $this->em->getRepository(Invoice::class)
                ->getLastId();

            $supplier = $this->em->getRepository(Company::class)
                ->getSupplier();

            $paymentType = $this->em->getRepository(PaymentType::class)
                ->getDefaultEntity();


//            dump("Last id: ");
//            dd($lastIdOfInvoice[0]['id']);
//
//            dump("supplier: ");
//            dump($supplier);


            // how many days will be have invoice due date
            $dueDays = $this->getParameter('invoiceDueDaysDefault');

            $invoice = new Invoice();

            $invoice->setInvoiceCreated(new \DateTime());
            $invoice->setDueDate(new \DateTime("+" . $dueDays . " days"));
            $invoice->setDue($dueDays);
            $invoice->setUserCreated($this->security->getUser());
            $invoice->setSubscriber($company);
            $invoice->setSupplier($supplier);
            $invoice->setPaymentType($paymentType);
            $invoice->setVs($this->calculateVs($lastIdOfInvoice[0]['id']));
            $invoice->setKs($this->getParameter('invoiceKsDefault'));


            $this->em->persist($invoice);

            foreach ($workItemsByCompanyId as $item) {
                $invoiceItem = new InvoiceItem();
                $invoiceItem->setName($item->getDescribe());
                $invoiceItem->setPrice($item->getTariff()->getPrice());
                $invoiceItem->setUnitCount($item->getWorkDuration());
                $invoiceItem->setPriceTotal($item->getTariff()->getPrice()*$item->getWorkDuration());
                $invoiceItem->setVat($this->getParameter('defaultVatPercent'));
                $invoiceItem->setPriceTotalIncVat($this->calculateTotalPriceIncVat($invoiceItem->getPriceTotal()));

                // relates InvoiceItem with the new Invoice
                $invoiceItem->setInvoice($invoice);

                // relates WorkInventory with the new Invoice
                $item->setInvoice($invoice);

                $invoice->addWorkInventory($item);
                $this->em->persist($invoiceItem);
                unset($invoiceItem);
            }



            $this->em->flush();

            #dd($invoice);


            return $this->redirect($destinationUrl);
        } catch (InvalidArgumentException $exception) {
            $this->addFlash('danger', $exception->getMessage());
            return $this->redirect($destinationUrl);
        }


    }

    /**
     * @Route("/work-inventory/unpaid", name="work_inventory_unpaid")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function unpaidWorkInventory(EntityManagerInterface $em): Response
    {
        $unpaidWorkInventory = $em->getRepository(WorkInventory::class)
            ->getAllUnpaidWorkItemGroupByCompany();

        //TODO: zjistit jak bude fungovat vice odvedene prace pod jinymi tarify pod jednou firmou.
        // asi bude treba pridat dalsi sloupec do group by (Tariff)

//        dd($unpaidWorkInventory);

        return $this->render('work_inventory/unpaid.html.twig', [
            'unpaidWorkInventory' => $unpaidWorkInventory,
        ]);
    }

    private function calculateTotalPriceIncVat($priceTotal): float
    {
        $vatPercent = $this->getParameter('defaultVatPercent');
        return $priceTotal*(($vatPercent/100) + 1);
    }

    private function calculateVs(int $lastInvoiceId): string
    {
        $date = new \DateTime();
        $year = $date->format("Y");
        return $year.str_pad(++$lastInvoiceId,6,"0",STR_PAD_LEFT);
    }
}
