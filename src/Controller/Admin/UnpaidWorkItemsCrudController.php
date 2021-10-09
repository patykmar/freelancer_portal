<?php

namespace App\Controller\Admin;

use App\Entity\UnpaidWorkItems;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UnpaidWorkItemsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UnpaidWorkItems::class;
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
