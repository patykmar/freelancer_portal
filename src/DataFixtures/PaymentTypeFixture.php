<?php

namespace App\DataFixtures;

use App\Entity\PaymentType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PaymentTypeFixture extends Fixture
{

    public const PT_PREVOD = 'pt-prevod';
    public const PT_HOTOVE = 'pt-hotove';


    public function load(ObjectManager $manager)
    {
        $prevod = new PaymentType();
        $prevod->setName("převodním příkazem");
        $prevod->setIsDefault(true);

        $hotove = new PaymentType();
        $hotove->setName("hotově");
        $hotove->setIsDefault(false);

        // díky tomuto se pak dostaneme k těmto uživatelům z jiných fixtur
        $this->addReference(self::PT_PREVOD, $prevod);
        $this->addReference(self::PT_HOTOVE, $hotove);


        $manager->persist($prevod);
        $manager->persist($hotove);

        $manager->flush();
    }
}
