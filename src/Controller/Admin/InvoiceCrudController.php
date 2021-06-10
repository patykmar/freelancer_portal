<?php

namespace App\Controller\Admin;

use App\Entity\Invoice;
use App\Form\InvoiceItemEditFormType;
use App\Form\InvoiceItemFormType;
use App\Services\InvoiceServices;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Doctrine\ORM\NonUniqueResultException;
use DateTime;

class InvoiceCrudController extends AbstractCrudController
{

    private InvoiceServices $invoiceServices;

    /**
     * InvoiceCrudController constructor.
     * @param InvoiceServices $invoiceServices
     */
    public function __construct(InvoiceServices $invoiceServices)
    {
        $this->invoiceServices = $invoiceServices;
    }


    public static function getEntityFqcn(): string
    {
        return Invoice::class;
    }


    /**
     * @throws NonUniqueResultException
     */
    public function configureFields(string $pageName): iterable
    {
        // prepare fields which want to show
        $returnArray = [
            AssociationField::new('supplier', 'Dodavatel: ')
                ->setRequired(true),
            AssociationField::new('subscriber', 'Odběratel: ')
                ->setRequired(true),
            AssociationField::new('payment_type', 'Forma úhrady: ')
                ->setRequired(true),
        ];


        // in case I'm editing or adding item show InvoiceItems
        switch ($pageName) {
            case Crud::PAGE_NEW:
                $invoiceCreated_minValue = new DateTime('-1 year');
                // new Invoice form
                $returnArray[] = DateTimeField::new('invoice_created')
                    ->setFormTypeOptions([
                        'data' => new DateTime('now'),
                        'attr' => [
                            'min' => $invoiceCreated_minValue->format('Y-m-d H:i:s'),
                        ]
                    ]);

                $returnArray[] = IntegerField::new('due', 'Splatnost: ')
                    ->setFormTypeOptions([
                        'data' => 14,
                        'attr' => [
                            'min' => 1,
                            'max' => 99,
                        ],
                    ])
                    ->setHelp('Počet dní splatnost faktury')
                    ->onlyOnForms()
                    ->setRequired(true);

                $returnArray[] = TextField::new('vs')
                    ->setFormTypeOptions([
                        'data' => $this->invoiceServices->calculateInvoiceVs(),
                    ])
                    ->setRequired(true);
                $returnArray[] = TextField::new('ks')
                    ->setFormTypeOptions(['data' => '0308']);
                $returnArray[] = CollectionField::new('invoiceItems')
                    ->setEntryType(InvoiceItemFormType::class);

                return $returnArray;

            case Crud::PAGE_EDIT:
                $returnArray[] = IntegerField::new('due', 'Due: ')
                    ->setRequired(true);
                $returnArray[] = TextField::new('vs', 'Variable symbol: ')
                    ->setRequired(true);
                $returnArray[] = CollectionField::new('invoiceItems')
                    ->setEntryType(InvoiceItemEditFormType::class)
                    //TODO: nefunguje nacteni sablony
                    ->setTemplatePath('admin/invoice/invoiceItemForm.html.twig');
                return $returnArray;

            case Crud::PAGE_DETAIL:
//                $returnArray[] = AssociationField::new('user', 'Created by: ');
                $returnArray[] = DateTimeField::new('invoice_created');
                $returnArray[] = IntegerField::new('due', 'Due: ');
                $returnArray[] = DateTimeField::new('due_date', 'Due date: ');
                $returnArray[] = CollectionField::new('invoiceItems')
                    ->setEntryType(InvoiceItemFormType::class)
                    ->setTemplatePath('admin/invoice/detail.html.twig');
                return $returnArray;
        }
        return $returnArray;
    }

    public function configureActions(Actions $actions): Actions
    {
        $viewInvoiceHtml = Action::new('viewInvoiceHtml', 'PDF', 'fas fa-file-pdf');
        $viewInvoiceHtml
            ->linkToRoute('inventory_generate_pdf', function (Invoice $invoice): array {
                return ['invoiceId' => $invoice->getId()];
            })
            ->setHtmlAttributes(['target' => '_blank']);

        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_INDEX, $viewInvoiceHtml);

    }

}
