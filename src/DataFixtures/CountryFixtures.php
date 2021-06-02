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
        $cz->setIso3166Alpha3("CZE");

        $sk = new Country();
        $sk->setName("Slovenská republika");
        $sk->setIso3166Alpha3('SVK');

        $pl = new Country();
        $pl->setName('Polská republika');
        $pl->setIso3166Alpha3('POL');

        $a = new Country();
        $a->setName('Republika Rakousko');
        $a->setIso3166Alpha3('AUT');

        $d = new Country();
        $d->setName('Spolková republika Německo');
        $d->setIso3166Alpha3('DEU');

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
