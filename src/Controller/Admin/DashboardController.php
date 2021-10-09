<?php

namespace App\Controller\Admin;

use App\Entity\Ci;
use App\Entity\Company;
use App\Entity\Country;
use App\Entity\GeneralState;
use App\Entity\InfluencingTicket;
use App\Entity\Invoice;
use App\Entity\PaymentType;
use App\Entity\Queue;
use App\Entity\ServiceCatalog;
use App\Entity\Tariff;
use App\Entity\Ticket;
use App\Entity\TicketType;
use App\Entity\UnpaidWorkItems;
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
        yield MenuItem::linkToCrud("Tickets", 'far fa-calendar-check', Ticket::class);

        yield MenuItem::section('Work payed per hour');
        yield MenuItem::linkToCrud('Work inventory', 'fas fa-clipboard-list', WorkInventory::class);
        yield MenuItem::linkToRoute("Unpaid work", 'fab fa-creative-commons-nc-eu', 'work_inventory_unpaid');
        yield MenuItem::linkToCrud("Unpaid work - view", 'fab fa-creative-commons-nc-eu', UnpaidWorkItems::class);

        yield MenuItem::section("Catalogs", 'fas fa-list-ol');
        yield MenuItem::linkToCrud('Catalog items', 'fab fa-servicestack', Ci::class);
        yield MenuItem::linkToCrud("Companies", 'fas fa-building', Company::class);
        yield MenuItem::linkToCrud("Countries", 'fas fa-globe-europe', Country::class);
        yield MenuItem::linkToCrud('General state', 'fas fa-traffic-light', GeneralState::class);
        yield MenuItem::linkToCrud('Influencing ticket', 'fas fa-adjust', InfluencingTicket::class);
        yield MenuItem::linkToCrud("Payment methods", 'fas fa-wallet', PaymentType::class);
        yield MenuItem::linkToCrud('Queue', 'fas fa-exchange-alt', Queue::class);
        yield MenuItem::linkToCrud('Service catalog', 'fas fa-warehouse', ServiceCatalog::class);
        yield MenuItem::linkToCrud('Tariffs', 'fas fa-receipt', Tariff::class);
        yield MenuItem::linkToCrud('Ticket type', 'far fa-arrow-alt-circle-up', TicketType::class);
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
