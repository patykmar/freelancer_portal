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
use DateTime;

class WorkInventoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WorkInventory::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $idField = IdField::new('id')
            ->onlyOnIndex();
        $descriptionTextField = TextField::new('description', 'Description: ')
            ->setMaxLength(30);
        $tariffAssociationField = AssociationField::new('tariff')
            ->setRequired(true);
        $companyAssociationField = AssociationField::new('company')
            ->setRequired(true);

        $workStartDateTimeField = DateTimeField::new('work_start');
        $workEndDateTimeField = DateTimeField::new('work_end')
            ->onlyOnForms();

        if (str_contains($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {
            // fix FireFox bug https://bugzil.la/888320
            // more info https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/datetime-local
            $workStartDateTimeField->renderAsNativeWidget(false);
            $workEndDateTimeField->renderAsNativeWidget(false);
        }
        $workDurationNumberField = NumberField::new('work_duration')
            ->onlyOnIndex();

        if (Crud::PAGE_NEW == $pageName) {
            $workStartDateTimeField->setFormTypeOptions([
                'data' => new DateTime('now'),
            ]);
        }

        yield $idField;
        yield $descriptionTextField;
        yield $tariffAssociationField;
        yield $companyAssociationField;
        yield $workStartDateTimeField;
        yield $workEndDateTimeField;
        yield $workDurationNumberField;
    }


    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud(
            $crud
                ->setPageTitle(Crud::PAGE_INDEX, 'Work inventory')
                ->setPageTitle(Crud::PAGE_NEW, 'Create work inventory')
                ->setPageTitle(Crud::PAGE_EDIT, 'Edit work inventory')
                ->setDefaultSort(['id' => 'DESC'])
        );
    }

}
