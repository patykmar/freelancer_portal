<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    public const USER_USER_REFERENCE = 'user-user';
    public const USER_ADMIN_REFERENCE = 'user-admin';

    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setPassword($this->encoder->encodePassword($user1, "7C8K8zszyuBkGDKY"));
        $user1->setEmail("patyk.m@gmail.com");
        $user1->setFirstName("Martin");
        $user1->setLastName("Patyk");
        $user1->setLastLogin(new DateTime());
        $user1->setCreated(new DateTime());
        $user1->setRoles(["ROLE_ADMIN"]);

        $user2 = new User();
        $user2->setPassword($this->encoder->encodePassword($user2, "gyOLHeWLuV6T4hru"));
        $user2->setEmail("martin@patyk.cz");
        $user2->setFirstName("Fake");
        $user2->setLastName("User");
        $user2->setCreated(new DateTime());
        $user2->setLastLogin(new DateTime());
        $user2->setRoles(["ROLE_USER"]);

        $this->addReference(self::USER_ADMIN_REFERENCE, $user1);
        $this->addReference(self::USER_USER_REFERENCE, $user2);

        $manager->persist($user1);
        $manager->persist($user2);

        $manager->flush();
    }
}
