<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public const USER_USER_REFERENCE = 'user-user';
    public const USER_ADMIN_REFERENCE = 'user-admin';


    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        // password encoding is handle in EventListener/UserSubscriber
        $user1->setPassword("7C8K8zszyuBkGDKY");
        $user1->setEmail("patyk.m@gmail.com");
        $user1->setFirstName("Martin");
        $user1->setLastName("Patyk");
        $user1->setRoles(["ROLE_ADMIN"]);

        $user2 = new User();
        // password encoding is handle in EventListener/UserSubscriber
        $user2->setPassword("gyOLHeWLuV6T4hru");
        $user2->setEmail("martin@patyk.cz");
        $user2->setFirstName("Fake");
        $user2->setLastName("User");
        $user2->setRoles(["ROLE_USER"]);

        $this->addReference(self::USER_ADMIN_REFERENCE, $user1);
        $this->addReference(self::USER_USER_REFERENCE, $user2);

        $manager->persist($user1);
        $manager->persist($user2);

        $manager->flush();
    }
}
