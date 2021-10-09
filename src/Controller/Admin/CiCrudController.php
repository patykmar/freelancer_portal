<?php

namespace App\Controller\Admin;

use App\Entity\Ci;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CiCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ci::class;
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
