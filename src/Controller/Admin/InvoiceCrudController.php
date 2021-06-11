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
        $returnArray[] =
            AssociationField::new('supplier', 'Dodavatel: ')
                ->setRequired(true);
        $returnArray[] =
            AssociationField::new('subscriber', 'Odběratel: ')
                ->setRequired(true);
        $returnArray[] =
            AssociationField::new('payment_type', 'Forma úhrady: ')
                ->setRequired(true);
        $userCreatedAssociationField = AssociationField::new('user_created', 'Created by: ');

        $invoiceCreatedDateTimeField =
            DateTimeField::new('invoice_created');
        if (str_contains($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {
            // fix FireFox bug https://bugzil.la/888320
            // more info https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/datetime-local
            $invoiceCreatedDateTimeField->renderAsNativeWidget(false);
        }

        $dueIntegerField = IntegerField::new('due', 'Days due: ')
            ->setRequired(true);

        $dueDateDateTimeField = DateTimeField::new('due_date', 'Due date: ');

        $vsTextField = TextField::new('vs', 'Variable symbol: ')
            ->setRequired(true);

        $ksTextField = TextField::new('ks', 'Constant symbol: ');

        $invoiceItemsCollectionField = CollectionField::new('invoiceItems', 'Invoice Items: ');

        // in case I'm editing or adding item show InvoiceItems
        switch ($pageName) {
            case Crud::PAGE_NEW:
                // new Invoice form
                $returnArray[] = $invoiceCreatedDateTimeField->setFormTypeOptions([
                    'data' => new DateTime('now'),
                ]);

                $returnArray[] = $dueIntegerField->setFormTypeOptions([
                    'data' => 14,
                    'attr' => [
                        'min' => 1,
                        'max' => Invoice::MAX_DUE_DAYS,
                    ],
                ])
                    ->setHelp('Number of days due invoice')
                    ->onlyOnForms()
                    ->setRequired(true);

                $returnArray[] = $vsTextField->setFormTypeOptions([
                    'data' => $this->invoiceServices->calculateInvoiceVs(),
                ]);
                $returnArray[] = $ksTextField->setFormTypeOptions(['data' => '0308']);
                $returnArray[] = $invoiceItemsCollectionField
                    ->setEntryType(InvoiceItemFormType::class);

                unset($invoiceCreatedDateTimeField, $dueIntegerField, $vsTextField, $ksTextField, $invoiceItemsCollectionField);
                return $returnArray;

            case Crud::PAGE_EDIT:
                $returnArray[] = $userCreatedAssociationField;
                $returnArray[] = $dueIntegerField;
                $returnArray[] = $vsTextField;
                $returnArray[] = $ksTextField;
                $returnArray[] = $invoiceItemsCollectionField
                    ->setEntryType(InvoiceItemEditFormType::class)
                    //TODO: nefunguje nacteni sablony
                    ->setTemplatePath('admin/invoice/InvoiceItemEditFormType.html.twig');

                unset($dueIntegerField, $vsTextField, $ksTextField, $invoiceItemsCollectionField);
                return $returnArray;

            case Crud::PAGE_DETAIL:
                $returnArray[] = $userCreatedAssociationField;
                $returnArray[] = $invoiceCreatedDateTimeField;
                $returnArray[] = $vsTextField;
                $returnArray[] = $dueIntegerField;
                $returnArray[] = $dueDateDateTimeField;
                $returnArray[] = $invoiceItemsCollectionField
                    ->setTemplatePath('admin/invoice/detail.html.twig');
                unset($userCreatedAssociationField,$invoiceCreatedDateTimeField,$vsTextField,$dueIntegerField,$invoiceItemsCollectionField);
                return $returnArray;
            default:
                // Crud::PAGE_INDEX
                $returnArray[] = $vsTextField;
                $returnArray[] = $dueDateDateTimeField;
                return $returnArray;
        }
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
