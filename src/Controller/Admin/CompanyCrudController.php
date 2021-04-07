<?php

namespace App\Controller\Admin;

use App\Entity\Company;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CompanyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Company::class;
    }


    public function configureFields(string $pageName): iterable
    {
        #dd($pageName);

        return [
            TextField::new('name', 'Název firmy: '),
            TextField::new('description', 'Popis: '),
            TextField::new('company_id', 'IČO: ')
                ->hideOnIndex(),
            TextField::new('vat_number', 'DIČ: ')
                ->hideOnIndex(),
            TextField::new('street', 'Adresa: ')
                ->hideOnIndex(),
            TextField::new('city', 'Město: '),
            TextField::new('zip_code', 'PSČ: ')
                ->hideOnIndex(),
            AssociationField::new('country', 'Stát: '),
            TextField::new('account_number', 'Bankovní účet: ')
                ->hideOnIndex(),
            TextField::new('iban', 'IBAN: ')
                ->hideOnIndex(),
            CollectionField::new('workInventories')
                ->onlyOnDetail(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        // if the method is not defined in a CRUD controller, link to its route
        $sendInvoice = Action::new('workItemsByCompany', 'Work items: ', 'fa fa-envelope')
            // 2) using a callable (useful if parameters depend on the entity instance)
            // (the type-hint of the function argument is optional but useful)
            ->linkToRoute('work_inventory_by_company', function (Company $company): array {
                return [
                    'companyId' => $company->getId(),
                ];
            });

        return $actions
            ->add(Crud::PAGE_INDEX, $sendInvoice)
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

}
