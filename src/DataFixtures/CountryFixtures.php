<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{

    public const COUNTRY_CZ_REFERENCE = 'country-cz';
    public const COUNTRY_SK_REFERENCE = 'country-sk';
    public const COUNTRY_A_REFERENCE = 'country-a';
    public const COUNTRY_D_REFERENCE = 'country-d';

    public function load(ObjectManager $manager)
    {
        $cz = new Country();
        $cz->setName("Česká republika");

        $sk = new Country();
        $sk->setName("Slovenská republika");

        $pl = new Country();
        $pl->setName('Polská republika');

        $a = new Country();
        $a->setName('Republika Rakousko');

        $d = new Country();
        $d->setName('Spolková republika Německo');

        // díky tomuto se pak dostaneme k těmto uživatelům z jiných fixtur
        $this->addReference(self::COUNTRY_CZ_REFERENCE, $cz);
        $this->addReference(self::COUNTRY_SK_REFERENCE, $sk);
        $this->addReference(self::COUNTRY_A_REFERENCE, $a);
        $this->addReference(self::COUNTRY_D_REFERENCE, $d);

        $manager->persist($cz);
        $manager->persist($sk);
        $manager->persist($a);
        $manager->persist($d);

        $manager->flush();
    }
}
