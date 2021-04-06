<?php

namespace App\Controller\Admin;

use App\Entity\PaymentType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PaymentTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PaymentType::class;

        //TODO: update PaymentTypeCrudController
        //TODO: create new Subscriber, when handle default value changing
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
