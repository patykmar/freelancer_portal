<?php

namespace App\Controller\Admin;

use App\Entity\Ticket;
use Doctrine\ORM\QueryBuilder;
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
        $idField = IdField::new('id');
        // filtered only valid State, Type, Impact and Priority for Ticket entity
        $ticketTypeField = AssociationField::new('ticketType')
            ->setQueryBuilder(fn(QueryBuilder $queryBuilder) => $queryBuilder->andWhere('entity.isDisable=0'));
        $ticketStateField = AssociationField::new('ticketState')
            ->setQueryBuilder(fn(QueryBuilder $queryBuilder) => $queryBuilder->andWhere('entity.isForTicket=1'));
        $priorityField = AssociationField::new('priority')
            ->setQueryBuilder(fn(QueryBuilder $builder) => $builder
                ->andWhere('entity.isForPriority = 1')
                ->orderBy('entity.coefficientPrice'));
        $impactField = AssociationField::new('impact')
            ->setQueryBuilder(fn(QueryBuilder $builder) => $builder
                ->andWhere('entity.isForImpact = 1')
                ->orderBy('entity.coefficientPrice'));
        $closeStateField = AssociationField::new('ticketCloseState')
            ->setQueryBuilder(fn(QueryBuilder $builder) => $builder
                ->andWhere('entity.isForCloseState = 1')
                ->orderBy('entity.coefficientPrice'));

        switch ($pageName) {
            case Crud::PAGE_INDEX:
                yield $idField;
                yield TextField::new('descriptionTitle', 'Title');
                yield TextField::new('queueUser.user.getFullName', 'Assigned to');
                yield $priorityField;
                yield $ticketStateField;
                yield DateField::new('createdDatetime', 'Created');
                yield DateField::new('deliveryDatetime', 'Delivery');
                break;
            case Crud::PAGE_EDIT:
                yield $idField->setFormTypeOption('disabled', true);
                yield $ticketTypeField;
                yield $ticketStateField;
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
                yield $priorityField;
                yield $impactField;
                yield TextField::new('descriptionTitle');
                yield TextEditorField::new('descriptionBody');
                yield $closeStateField;
                yield TextEditorField::new('closedNotes');
                yield CollectionField::new('logs')
                    ->setFormTypeOption('disabled', true)
//                    ->setCustomOption('compound',true)
                    ->allowAdd(false)
                    ->allowDelete(false)
//                    ->addHtmlContentsToBody("<br />")
//                    ->addHtmlContentsToBody('<b> ... </b>')
                ;
                break;
            case Crud::PAGE_NEW:
                yield AssociationField::new('ticketType');
                yield AssociationField::new('ci');
                yield AssociationField::new('serviceCatalog');
                yield $priorityField;
                yield $impactField;
                yield TextField::new('descriptionTitle');
                yield TextEditorField::new('descriptionBody');
                yield $closeStateField;
                yield TextEditorField::new('closedNotes');
                yield CollectionField::new('logs')
                    ->setFormTypeOption('disabled', true);
                break;
        }
    }
}