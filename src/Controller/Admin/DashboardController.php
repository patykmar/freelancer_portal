<?php

namespace App\Controller\Admin;

use App\Entity\Company;
use App\Entity\Country;
use App\Entity\Invoice;
use App\Entity\PaymentType;
use App\Entity\Tariff;
use App\Entity\Unit;
use App\Entity\User;
use App\Entity\Vat;
use App\Entity\WorkInventory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {

        // redirect to some CRUD controller
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(InvoiceCrudController::class)->generateUrl());


        // show default page with hint how to create controller
        #return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Fakturační Systém');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section("Aplikace", 'fas fa-rocket');
        yield MenuItem::linkToCrud("Faktury", 'fas fa-file-invoice-dollar', Invoice::class);


        yield MenuItem::section('Hodinová sazba za práci');
        yield MenuItem::linkToCrud('Pracovní výkaz', 'fas fa-clipboard-list', WorkInventory::class);
        yield MenuItem::linkToRoute("Nevyfakturovaná práce", 'fab fa-creative-commons-nc-eu', 'work_inventory_unpaid');
        yield MenuItem::linkToCrud('Tarif', 'fas fa-receipt', Tariff::class);

        yield MenuItem::section("Číselníky", 'fas fa-list-ol');
        yield MenuItem::linkToCrud("Firmy", 'fas fa-building', Company::class);
        yield MenuItem::linkToCrud("Platební metody", 'fas fa-wallet', PaymentType::class);
        yield MenuItem::linkToCrud("Země", 'fas fa-globe-europe', Country::class);
        yield MenuItem::linkToCrud('DPH', 'fas fa-hand-holding-usd', Vat::class);



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
            #DateTimeField::new('beginsAt')->setFormat('Y-MM-dd HH:mm')->renderAsNativeWidget(),
        ];

    }
}
