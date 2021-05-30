<?php

namespace App\Controller\Admin;

use App\Entity\PaymentType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PaymentTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PaymentType::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->onlyOnIndex(),
            TextField::new('name', 'Jméno: ')
                ->onlyOnForms(),
            TextField::new('name', 'Jméno')
                ->onlyOnIndex(),
            BooleanField::new('isDefault', 'Bude výchozí ?')
                ->onlyOnForms(),
            BooleanField::new('isDefault', 'Výchozí')
                ->onlyOnIndex()
        ];
    }
}
