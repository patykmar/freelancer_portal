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
    public const COUNTRY_PL_REFERENCE = 'country-pl';

    public function load(ObjectManager $manager)
    {
        $countries = [
            ['name' => 'Česká republika', 'Iso3166Alpha3' => 'CZE', 'ref' => self::COUNTRY_CZ_REFERENCE],
            ['name' => 'Slovenská republika', 'Iso3166Alpha3' => 'SVK', 'ref' => self::COUNTRY_SK_REFERENCE],
            ['name' => 'Polská republika', 'Iso3166Alpha3' => 'POL', 'ref' => self::COUNTRY_PL_REFERENCE],
            ['name' => 'Republika Rakousko', 'Iso3166Alpha3' => 'AUT', 'ref' => self::COUNTRY_A_REFERENCE],
            ['name' => 'Spolková republika Německo', 'Iso3166Alpha3' => 'DEU', 'ref' => self::COUNTRY_D_REFERENCE],
        ];

        for ($i = 0; $i < count($countries); $i++) {
            $country = new Country();
            $country
                ->setName($countries[$i]['name'])
                ->setIso3166Alpha3($countries[$i]['Iso3166Alpha3']);

            $manager->persist($country);
            $this->addReference($countries[$i]['ref'], $country);
            unset($country);
        }

        $manager->flush();
    }
}
