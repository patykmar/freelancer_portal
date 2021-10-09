<?php

namespace App\Controller\Admin;

use App\Entity\Sla;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SlaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Sla::class;
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
