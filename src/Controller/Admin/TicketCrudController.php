<?php

namespace App\Controller\Admin;

use App\Entity\Ticket;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TicketCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ticket::class;
    }


    public function configureFields(string $pageName): iterable
    {
        switch ($pageName) {
            case Crud::PAGE_INDEX:
                yield IdField::new('id');
                yield TextField::new('descriptionTitle', 'Title');
                yield TextField::new('queueUser.user.getFullName', 'Assigned to');
                yield TextField::new('priority', 'Priority');
                yield TextField::new('ticketState', 'State');
                yield DateField::new('createdDatetime', 'Created');
                yield DateField::new('deliveryDatetime', 'Delivery');
                break;
            case Crud::PAGE_EDIT:
                yield IdField::new('id')
                    ->setFormTypeOption('disabled', true);
                yield AssociationField::new('ticketType');
                yield AssociationField::new('ticketState');
                yield DateTimeField::new('createdDatetime', 'Created')
                    ->setFormTypeOption('disabled', true);
                yield DateTimeField::new('reactionDatetime', 'Reaction time')
                    ->setFormTypeOption('disabled', true);
                yield DateTimeField::new('deliveryDatetime', 'Delivery time')
                    ->setFormTypeOption('disabled', true);
                yield DateTimeField::new('closedDatetime', 'Closed time')
                    ->setFormTypeOption('disabled', true);

                yield AssociationField::new('serviceCatalog');
                yield AssociationField::new('ci');
                yield AssociationField::new('queueUser', 'Assigned to');
                yield AssociationField::new('userCreated', 'Created by')
                    ->setFormTypeOption('disabled', true);
                yield AssociationField::new('userResolved', 'Resolved by')
                    ->setFormTypeOption('disabled', true);
                yield AssociationField::new('priority');
                yield AssociationField::new('impact');
                yield TextField::new('descriptionTitle');
                yield TextEditorField::new('descriptionBody');
                yield AssociationField::new('ticketCloseState');
                yield TextEditorField::new('closedNotes');
                yield CollectionField::new('logs')
                    ->setFormTypeOption('disabled', true);
                break;
        }
//        return [
//
//            ,
//            TextEditorField::new('description'),
//        ];
    }

}
