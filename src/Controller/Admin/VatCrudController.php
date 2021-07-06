<?php

namespace App\Controller\Admin;

use App\Entity\Invoice;
use App\Entity\Vat;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vat::class;
    }


    /**
     * @param string $pageName
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        // index section
        yield IdField::new('id')
            ->onlyOnIndex();
        yield TextField::new('name', 'Name')
            ->onlyOnIndex();
        yield PercentField::new('percent', 'Tax in percent')
            ->onlyOnIndex()
            ->setStoredAsFractional(false);
        yield NumberField::new('multiplier', 'Multiplier: ')
            ->onlyOnIndex()
            ->setNumDecimals(0);
        yield BooleanField::new('isDefault', 'Is default?')
            ->onlyOnIndex();


        // form section
        yield TextField::new('name', 'Name: ')
            ->onlyOnForms();
        yield IntegerField::new('percent', 'Tax in percent: ')
            ->onlyOnForms()
            ->setHelp('například 20% bude 20')
            ->setFormTypeOptions([
                'attr' => [
                    'min' => 0,
                    'max' => 99,
                ],
            ]);
        yield BooleanField::new('isDefault', 'Is default?')
            ->onlyOnForms();

    }

    /**
     * @param Crud $crud
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud(
            $crud
                ->setPageTitle(Crud::PAGE_INDEX, 'VAT')
                ->setPageTitle(Crud::PAGE_NEW, 'Add new VAT item')
                ->setPageTitle(Crud::PAGE_EDIT, 'Edit VAT item')
        );
    }


}
