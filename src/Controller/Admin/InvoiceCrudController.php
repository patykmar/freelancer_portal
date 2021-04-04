<?php

namespace App\Controller\Admin;

use App\Entity\Invoice;
use App\Form\InvoiceItemFormType;
use ContainerSabFytd\getAnnotations_CacheWarmerService;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class InvoiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Invoice::class;
    }


    public function configureFields(string $pageName): iterable
    {
        // prepare fields which want to show
        $returnArray = [
            AssociationField::new('supplier', 'Dodavatel: '),
            AssociationField::new('subscriber', 'Odběratel: '),
            AssociationField::new('payment_type', 'Forma úhrady: '),

            IntegerField::new('due', 'Splatnost: ')
                ->setFormTypeOptions(['data' => 14])
                ->setHelp('Počet dní splatnost faktury')
                ->onlyOnForms(),


            TextField::new('vs'),
            TextField::new('ks')
                ->setFormTypeOptions(['data' => 308]),
        ];

        // in case I'm editing or adding item show InvoiceItems
        switch ($pageName) {
            case Crud::PAGE_NEW:
            case Crud::PAGE_EDIT:
                $returnArray[] = CollectionField::new('invoiceItems')
                    ->setEntryType(InvoiceItemFormType::class)
                    //TODO: nefunguje nacteni sablony
                    ->setTemplatePath('admin/invoice/invoiceItemForm.html.twig');
                return $returnArray;
                break;
            case Crud::PAGE_DETAIL:
                $returnArray[] = [
                    DateTimeField::new('due_date'),
                    CollectionField::new('invoiceItems')
                        ->setEntryType(InvoiceItemFormType::class)
                        ->setTemplatePath('admin/invoice/detail.html.twig')
                ];
                return $returnArray;
                break;
            default:
                return $returnArray;
        }

    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

}
