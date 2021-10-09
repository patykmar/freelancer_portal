<?php

namespace App\Controller\Admin;

use App\Entity\InfluencingTicket;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class InfluencingTicketCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InfluencingTicket::class;
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
