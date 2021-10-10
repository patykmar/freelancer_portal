<?php

namespace App\Controller\Admin;

use App\Entity\UnpaidWorkItems;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UnpaidWorkItemsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UnpaidWorkItems::class;
    }

    /**
     * @param Crud $crud
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Unpaid work items');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('companyName'),
            TextField::new('tariffName'),
            NumberField::new('workDurationTotal'),
            MoneyField::new('pricePerUnit')
                ->setCurrency('CZK'),
            MoneyField::new('totalPrice')
                ->setCurrency('CZK'),
        ];
    }

    /**
     * @param Actions $actions
     * @return Actions
     */
    public function configureActions(Actions $actions): Actions
    {
        $generateInvoiceAction = Action::NEW(
            'generateInvoice',
            'Generate invoice',
            'fas fa-file-invoice'
        );
        $generateInvoiceAction->linkToRoute(
            'work_inventory_generate_invoice_by_company',
            fn(UnpaidWorkItems $inventory): array => ['companyId' => $inventory->getCompanyId()]
        );

        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->add(Crud::PAGE_INDEX, $generateInvoiceAction);
    }
}
