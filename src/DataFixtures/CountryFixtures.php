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
            ['name' => 'Česká republika', 'iso3166alpha3' => 'CZE', 'ref' => self::COUNTRY_CZ_REFERENCE],
            ['name' => 'Slovenská republika', 'iso3166alpha3' => 'SVK', 'ref' => self::COUNTRY_SK_REFERENCE],
            ['name' => 'Polská republika', 'iso3166alpha3' => 'POL', 'ref' => self::COUNTRY_PL_REFERENCE],
            ['name' => 'Republika Rakousko', 'iso3166alpha3' => 'AUT', 'ref' => self::COUNTRY_A_REFERENCE],
            ['name' => 'Spolková republika Německo', 'iso3166alpha3' => 'DEU', 'ref' => self::COUNTRY_D_REFERENCE],
        ];

        for ($i = 0; $i < count($countries); $i++) {
            $country = new Country();
            $country
                ->setName($countries[$i]['name'])
                ->setIso3166Alpha3($countries[$i]['iso3166alpha3']);

            $manager->persist($country);
            $this->addReference($countries[$i]['ref'], $country);
            unset($country);
        }

        $manager->flush();
    }
}
