<?php

namespace App\Controller\Admin;

use App\Entity\Tariff;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class TariffCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tariff::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->onlyOnIndex(),
            TextField::new('name', 'Tariff name: '),
            MoneyField::new('price', 'Price per unit: ')
                ->setCurrency('CZK')
                ->setNumDecimals(0)
        ];
    }

}
