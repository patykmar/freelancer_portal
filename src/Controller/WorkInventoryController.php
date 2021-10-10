<?php

namespace App\Controller;

use App\Controller\Admin\CompanyCrudController;
use App\Controller\Admin\InvoiceCrudController;
use App\Entity\Company;
use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use App\Entity\PaymentType;
use App\Repository\WorkInventoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security as UserSecurity;


/**
 * @Security("is_granted('ROLE_ADMIN')")
 */
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
     * @var UserSecurity
     */
    private UserSecurity $security;


    private WorkInventoryRepository $workInventoryRepository;

    /**
     * WorkInventoryController constructor.
     * @param AdminUrlGenerator $adminUrlGenerator
     * @param EntityManagerInterface $em
     * @param UserSecurity $security
     * @param WorkInventoryRepository $workInventoryRepository
     */
    public function __construct(
        AdminUrlGenerator $adminUrlGenerator,
        EntityManagerInterface $em,
        UserSecurity $security,
        WorkInventoryRepository $workInventoryRepository
    )
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
        $this->em = $em;
        $this->security = $security;
        $this->workInventoryRepository = $workInventoryRepository;
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
     * @Route("/work-inventory/generate-invoice-by-company/{companyId}", name="work_inventory_generate_invoice_by_company", requirements={"companyId"="\d+"})
     */
    public function generateInvoiceByCompany(int $companyId): Response
    {
        $companyUrl = $this->adminUrlGenerator
            ->setController(CompanyCrudController::class)
            ->setAction(Crud::PAGE_INDEX);
        // generate URL to EasyAdmin controller
        $destinationUrl = $this->adminUrlGenerator
            ->setController(InvoiceCrudController::class)
            ->setAction(Crud::PAGE_INDEX);

        // get all unpaid work
        $workItemsByCompanyId = $this->workInventoryRepository->getAllUnpaidWorkItemByCompanyId($companyId);

        if (!(count($workItemsByCompanyId) > 1)) {
            $this->addFlash('error', "No work inventory items which could be transformer to invoice");
            $this->redirect($companyUrl);
        }

        /** @var Company $company get company by ID */
        $company = $this->em->getRepository(Company::class)
            ->find($companyId);

        /** @var Company $supplier who is supplier of services on new invoice */
        $supplier = $this->em->getRepository(Company::class)
            ->getSupplier();

        /** @var PaymentType $paymentType */
        $paymentType = $this->em->getRepository(PaymentType::class)
            ->getDefaultEntity();

        $invoice = new Invoice();

        // how many days will be have invoice due date
        $invoice->setDue($this->getParameter('invoiceDueDaysDefault'));
        $invoice->setUserCreated($this->security->getUser());
        $invoice->setSubscriber($company);
        $invoice->setSupplier($supplier);
        $invoice->setPaymentType($paymentType);
        $invoice->setKs($this->getParameter('invoiceKsDefault'));

        $this->em->persist($invoice);

        foreach ($workItemsByCompanyId as $item) {
            $invoiceItem = new InvoiceItem();
            $invoiceItem->setName($item->getDescription());
            $invoiceItem->setPrice($item->getTariff()->getPrice());
            $invoiceItem->setUnitCount($item->getWorkDuration());
            $invoiceItem->setVat($item->getTariff()->getVat());

            // relates InvoiceItem with the new Invoice
            $invoiceItem->setInvoice($invoice);

            // relates WorkInventory with the new Invoice
            $item->setInvoice($invoice);

            $invoice->addWorkInventory($item);
            $this->em->persist($invoiceItem);
            unset($invoiceItem);
        }
        $this->em->flush();

        $this->addFlash('notice', 'New invoice for company ' . $company->getName() . ' has been created');
        return $this->redirect($destinationUrl);
    }
}
