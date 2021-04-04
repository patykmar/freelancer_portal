<?php

namespace App\Controller;

use App\Controller\Admin\InvoiceCrudController;
use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use App\Entity\WorkInventory;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
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
//    public function showAllWorkInventoryByCompany(int $companyId, EntityManagerInterface $em)
    public function showAllWorkInventoryByCompany(int $companyId)
    {
        dump($companyId);

        dump($this->getParameter('invoiceDueDaysDefault'));

        // get all unpaid work
        $workItemsByCompanyId = $this->em->getRepository(WorkInventory::class)
            ->getAllUnpaidWorkItemByCompanyId($companyId)
            ->getQuery()
            ->execute();

        $invoiceItemArray = new ArrayCollection();

        $invoice = new Invoice();
//        $invoice->set

//        foreach ($workItemsByCompanyId as $item) {
//            $invoiceItem = new InvoiceItem();
//
//
//        }


        dd($workItemsByCompanyId);

        // generate URL to EasyAdmin controller
        $url = $this->adminUrlGenerator->setController(InvoiceCrudController::class)
            ->setAction(Crud::PAGE_INDEX);


//        dd($url->__toString());
//        return $this->redirect('http://127.0.0.1:8000/admin?crudAction=index&crudControllerFqcn=App%5CController%5CAdmin%5CInvoiceCrudController&menuIndex=2&signature=s1zSVMkMvNg4HnJCUHVdMde3SbxXsb3gZC1chYea89A&submenuIndex=-1');
        return $this->redirect($url);

//        dd($url);
//
//       return $this->render('work_inventory/byCompany.html.twig', [
//            'workItemsByCompany' => $workItemsByCompany,
//        ]);
    }

    /**
     * @Route("/work-inventory/unpaid", name="work_inventory_unpaid")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function unpaidWorkInventory(EntityManagerInterface $em): Response
    {
        $unpaidWorkInventory = $em->getRepository(WorkInventory::class)
            ->getAllUnpaidWorkItemGroupByCompany()
            ->getQuery()
            ->execute();

        //TODO: zjistit jak bude fungovat vice odvedene prace pod jinymi tarify pod jednou firmou.
        // asi bude treba pridat dalsi sloupec do group by (Tariff)

//        dd($unpaidWorkInventory);

        return $this->render('work_inventory/unpaid.html.twig', [
            'unpaidWorkInventory' => $unpaidWorkInventory,
        ]);
    }
}
