<?php

namespace App\Controller\Admin;

use App\Entity\Company;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CompanyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Company::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', 'ID')
            ->onlyOnIndex();
        yield TextField::new('name', 'Company name: ');
        yield TextField::new('description', 'Company description: ');
        yield TextField::new('company_id', 'Company ID: ')
            ->hideOnIndex();
        yield TextField::new('vat_number', 'VAT ID: ')
            ->hideOnIndex();
        yield TextField::new('street', 'Address: ')
            ->hideOnIndex();
        yield TextField::new('city', 'City: ');
        yield TextField::new('zip_code', 'ZIP code: ')
            ->hideOnIndex();
        yield AssociationField::new('country', 'County: ');
        yield TextField::new('account_number', 'Bank account: ')
            ->hideOnIndex();
        yield TextField::new('iban', 'IBAN: ')
            ->hideOnIndex();
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

}
