<?php

namespace App\Controller\Admin;

use App\Entity\WorkInventory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class WorkInventoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WorkInventory::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $fieldConfig = [
            IdField::new('id')
                ->onlyOnIndex(),
            TextField::new('description', 'Popis')
                ->setMaxLength(30),
            AssociationField::new('tariff'),
            AssociationField::new('company'),
            DateTimeField::new('work_start'),
            DateTimeField::new('work_end')->onlyOnForms(),
        ];

        if ($pageName === Crud::PAGE_INDEX)
            $fieldConfig[] = NumberField::new('work_duration');


        return $fieldConfig;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // ->showEntityActionsAsDropdown()// ...
            ->setPageTitle(Crud::PAGE_INDEX, 'Pracovní výkaz')
            ->setDefaultSort(['id' => 'DESC']);
    }

//    public function configureFilters(Filters $filters): Filters
//    {
//        return $filters
//            ->add(ArrayFilter::new('id'))
////            ->add('tarif')
//            // most of the times there is no need to define the
//            // filter type because EasyAdmin can guess it automatically
//           # ->add(BooleanFilter::new('published'))
//            ;
//    }

}
