<?php

namespace App\Controller\Admin;

use App\Entity\Company;
use App\Entity\Country;
use App\Entity\Invoice;
use App\Entity\PaymentType;
use App\Entity\Tariff;
use App\Entity\User;
use App\Entity\Vat;
use App\Entity\WorkInventory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    private AdminUrlGenerator $adminUrlGenerator;

    /**
     * @param AdminUrlGenerator $adminUrlGenerator
     */
    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }


    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(InvoiceCrudController::class)
            ->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Freelancer\'s portal');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section("Application", 'fas fa-rocket');
        yield MenuItem::linkToCrud("Invoices", 'fas fa-file-invoice-dollar', Invoice::class);


        yield MenuItem::section('Work payed per hour');
        yield MenuItem::linkToCrud('Work inventory', 'fas fa-clipboard-list', WorkInventory::class);
        yield MenuItem::linkToRoute("Unpaid work", 'fab fa-creative-commons-nc-eu', 'work_inventory_unpaid');
        yield MenuItem::linkToCrud('Tariffs', 'fas fa-receipt', Tariff::class);

        yield MenuItem::section("Lists", 'fas fa-list-ol');
        yield MenuItem::linkToCrud("Companies", 'fas fa-building', Company::class);
        yield MenuItem::linkToCrud("Countries", 'fas fa-globe-europe', Country::class);
        yield MenuItem::linkToCrud("Payment methods", 'fas fa-wallet', PaymentType::class);
        yield MenuItem::linkToCrud('VAT', 'fas fa-hand-holding-usd', Vat::class);


        yield MenuItem::section('Users');
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
        yield MenuItem::linkToLogout('Logout', 'fas fa-sign-out-alt');
    }

    /**
     * General settings for all CrudController
     * @return Crud
     */
    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setDateTimeFormat('dd.MM. y HH:mm');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // native date picker format cannot be changed
            // Uses native HTML5 widgets when rendering this field in forms.
            DateTimeField::new('beginsAt')
                ->setFormat('Y-MM-dd HH:mm')
                ->renderAsNativeWidget(),
        ];

    }
}
