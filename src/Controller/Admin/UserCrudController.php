<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

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
            yield TextField::new('password')
                ->setFormType(PasswordType::class);
        }
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
