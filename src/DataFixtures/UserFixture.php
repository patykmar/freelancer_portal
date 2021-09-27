<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture implements DependentFixtureInterface
{
    public const USER_FIXTURE_01 = 'user_fixture_01';
    public const USER_FIXTURE_02 = 'user_fixture_02';
    public const USER_FIXTURE_03 = 'user_fixture_03';
    public const USER_FIXTURE_04 = 'user_fixture_04';


    public function load(ObjectManager $manager): void
    {
        $companies = [
            $this->getReference(CompanyFixture::COMPANY_PATYK_MARTIN),
        ];

        $users = [
            ['email' => 'patyk.m@gmail.com', 'pass' => '7C8K8zszyuBkGDKY', 'firstName' => 'Martin',
                'lastName' => 'Patyk', 'role' => ["ROLE_ADMIN"], 'ref' => self::USER_FIXTURE_01],
            ['email' => 'fake@user.com', 'pass' => 'gyOLHeWLuV6T4hru', 'firstName' => 'Fake',
                'lastName' => 'User', 'role' => ["ROLE_USER"], 'ref' => self::USER_FIXTURE_02],
            ['email' => 'sd24h@patyk.cz', 'pass' => 'gWLuV6yOLHeWLuhrV6T4u', 'firstName' => 'Service',
                'lastName' => 'Desk', 'role' => ["ROLE_ADMIN"], 'ref' => self::USER_FIXTURE_03],
            ['email' => 'ss@patyk.cz', 'pass' => 'gWLuV6yOLHeT4hrWLuu', 'firstName' => 'Shift',
                'lastName' => 'Supervisor', 'role' => ["ROLE_ADMIN"], 'ref' => self::USER_FIXTURE_04],
        ];

        for ($i = 0; $i < count($users); $i++) {
            $user = new User();
            // password encoding is handle in EventListener/UserSubscriber
            $user->setPlainTextPassword($users[$i]['pass'])
                ->setEmail($users[$i]['email'])
                ->setFirstName($users[$i]['firstName'])
                ->setLastName($users[$i]['lastName'])
                ->setRoles($users[$i]['role'])
                ->setEmployeeOf($companies[0]);
            $this->addReference($users[$i]['ref'], $user);
            $manager->persist($user);
            unset($user);
        }

        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            CompanyFixture::class
        ];
    }
}
