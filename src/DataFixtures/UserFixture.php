<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public const USER_ADMIN_01 = 'user-admin';
    public const USER_USER_01 = 'user-user';


    public function load(ObjectManager $manager): void
    {
        $reference = [
            $this->getReference(CompanyFixture::COMPANY_PATYK_MARTIN)
        ];

        $users = [
            ['email' => 'patyk.m@gmail.com', 'pass' => '7C8K8zszyuBkGDKY', 'firstName' => 'Martin',
                'lastName' => 'Patyk', 'role' => ["ROLE_ADMIN"], 'ref' => self::USER_ADMIN_01,
                'company' => $reference[0]],
            ['email' => 'fake@user.com', 'pass' => 'gyOLHeWLuV6T4hru', 'firstName' => 'Fake',
                'lastName' => 'User', 'role' => ["ROLE_USER"], 'ref' => self::USER_USER_01,
                'company' => $reference[0]],
        ];

        for ($i = 0; $i < count($users); $i++) {
            $user = new User();
            // password encoding is handle in EventListener/UserSubscriber
            $user->setPlainTextPassword($users[$i]['pass'])
                ->setEmail($users[$i]['email'])
                ->setFirstName($users[$i]['firstName'])
                ->setLastName($users[$i]['lastName'])
                ->setRoles($users[$i]['role'])
                ->setCompany($user[$i]['company']);
            $this->addReference($users[$i]['ref'], $user);
            $manager->persist($user);
            unset($user);
        }

        $manager->flush();
    }
}
