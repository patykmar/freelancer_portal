<?php

namespace App\Controller\Admin;

use App\Entity\Queue;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class QueueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Queue::class;
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
