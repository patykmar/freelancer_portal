<?php

namespace App\DataFixtures;

use App\Entity\Unit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UnitFixture extends Fixture
{
    public const UNIT_X = 'unit-x';
    public const UNIT_KC = 'unit-kc';
    public const UNIT_KS = 'unit-ks';
    public const UNIT_KG = 'unit-kg';

    public function load(ObjectManager $manager)
    {
        $unit1 = new Unit();
        $unit1->setName("Neurčito");
        $unit1->setAbbreviation("x");

        $unit2 = new Unit();
        $unit2->setName("Korun českých");
        $unit2->setAbbreviation("Kč");

        $unit3 = new Unit();
        $unit3->setName("Kusů")
            ->setAbbreviation('Ks');

        $unit4 = new Unit();
        $unit4->setName("Kilo")
            ->setAbbreviation("Kg");

        $this->addReference(self::UNIT_X, $unit1);
        $this->addReference(self::UNIT_KC, $unit2);
        $this->addReference(self::UNIT_KS, $unit3);
        $this->addReference(self::UNIT_KG, $unit4);


        $manager->persist($unit1);
        $manager->persist($unit2);
        $manager->persist($unit3);
        $manager->persist($unit4);

        $manager->flush();
    }
}
