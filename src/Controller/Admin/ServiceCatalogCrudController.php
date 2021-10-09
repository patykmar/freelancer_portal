<?php

namespace App\Controller\Admin;

use App\Entity\ServiceCatalog;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ServiceCatalogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ServiceCatalog::class;
    }
}