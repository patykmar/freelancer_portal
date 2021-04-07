<?php

namespace App\Controller\Admin;

use App\Entity\Vat;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
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
        return [
            IdField::new('id')
                ->onlyOnIndex(),
            TextField::new('name', 'Název: '),
            NumberField::new('percent', 'Procentuální vyjádření daňe: ')
                ->setNumDecimals(0)
                ->setHelp('například 20% bude 20'),
            NumberField::new('multiplier', 'Násobitel: ')
                ->setNumDecimals(2)
                ->setHelp('U 20% nastav 1,2',),
            BooleanField::new('isDefault', 'Výchozí'),
        ];
    }

    /**
     * @param Crud $crud
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud
    {

        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'DPH')
            ->setPageTitle(Crud::PAGE_NEW, 'Přidej nový záznam')
            ->setPageTitle(Crud::PAGE_EDIT, 'Edit DPH')
            ;
    }


}
