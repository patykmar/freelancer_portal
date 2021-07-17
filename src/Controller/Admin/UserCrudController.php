<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield EmailField::new('email')
            ->setRequired(true)
            ->setHelp('Used also as login value');
        yield TextField::new('first_name')
            ->setRequired(true);
        yield TextField::new('last_name')
            ->setRequired(true);
        if ($pageName == Crud::PAGE_NEW) {
            yield TextField::new('plainTextPassword')
//                ->onlyOnForms()
                ->setFormType(RepeatedType::class)
                ->setFormTypeOptions([
//                    'mapped' => false,
                    'type' => PasswordType::class,
//                    'type_options' => ['required' => false],
                    'first_options' => ['label' => 'Password: ', 'required' => false],
                    'second_options' => ['label' => 'Re-type password: ', 'required' => false],
                    'required' => false,
                ])
                ->setRequired(true);
        }
        yield ChoiceField::new('roles')
            ->onlyOnForms()
            ->allowMultipleChoices(true)
            ->setChoices([
                'ADMIN' => 'ROLE_ADMIN',
                'USER' => 'ROLE_USER',
            ]);
        yield AssociationField::new('company');
        yield DateTimeField::new('last_login')
            ->onlyOnIndex();
        yield DateTimeField::new('created')
            ->onlyOnIndex();
    }

    public function configureActions(Actions $actions): Actions
    {
        $generatePassword = Action::new('set-new-password', '', 'fas fa-key');
        $generatePassword
            ->linkToRoute('user_set-new-password', function (User $user): array {
                return ['userId' => $user->getId()];
            });

        return $actions
            ->add(Crud::PAGE_INDEX, $generatePassword);

    }

}
