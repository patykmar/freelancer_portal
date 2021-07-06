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
        // index section
        yield IdField::new('id')
            ->onlyOnIndex();
        yield TextField::new('name', 'Payment method name')
            ->onlyOnIndex();
        yield BooleanField::new('isDefault', 'Is default?')
            ->onlyOnIndex();

        // forms section
        yield TextField::new('name', 'Payment method name: ')
            ->onlyOnForms();
        yield BooleanField::new('isDefault', 'Will be default ?')
            ->onlyOnForms();

    }
}
