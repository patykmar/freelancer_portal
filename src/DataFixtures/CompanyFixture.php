<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use \DateTime;

class CompanyFixture extends Fixture implements DependentFixtureInterface
{
    public const COMPANY_PATYK_MARTIN = 'Ing. Martin Patyk';
    public const COMPANY_PATYKDESIGN = 'PATYKDESIGN';
    public const COMPANY_VAHYOPAVA = 'Vahy-opava';
    public const COMPANY_SEDKO = 'sedko-sro';
    public const COMPANY_MAXXNET = 'maxxnet-sro';
    public const INNOVATION_ADVISORS = 'innovation_advisors-sro';
    public const GAPPAY_SRO = 'gappay-sro';
    public const CGE_SRO = 'cge-sro';


    public function load(ObjectManager $manager)
    {
        // get references from CountryFixtures class
        /** @var Country $countryCz */
        $countryCz = $this->getReference(CountryFixtures::COUNTRY_CZ_REFERENCE);

        $company1 = new Company();
        $company1->setName("Ing. Martin Patyk")
            ->setDescription("Ing. Martin Patyk - Ratiborska")
            ->setCompanyId("88230104")
            ->setVatNumber('CZ8707145876')
            ->setStreet("Ratibořská 36")
            ->setCity("Opava - Kateřinky ")
            ->setZipCode("747 05")
            ->setAccountNumber("670100-2209225998/6210")
            ->setCreated(new DateTime("2014-01-13 22:17:20"))
            ->setIsSupplier(true)
            ->setCountry($countryCz);

        $this->addReference(self::COMPANY_PATYK_MARTIN, $company1);

        $company2 = new Company();
        $company2->setName("PATYKDESIGN s.r.o.")
            ->setDescription("PATYKDESIGN s.r.o. - Olomoucka")
            ->setCompanyId("28648579")
            ->setVatNumber('CZ28648579')
            ->setStreet("Olomoucká 8")
            ->setCity("Opava - Předměstí")
            ->setZipCode("746 01")
            ->setCreated(new DateTime("2014-01-13 22:24:39"))
            ->setCountry($countryCz);

        $this->addReference(self::COMPANY_PATYKDESIGN, $company2);

        $company3 = new Company();
        $company3->setName("Opravna vah")
            ->setDescription("Opravna vah - U cukrovaru")
            ->setCompanyId("44197373")
            ->setVatNumber('CZ5908041524')
            ->setStreet("U cukrovaru 12")
            ->setCity("Opava - Kateřinky")
            ->setZipCode("747 05")
            ->setCreated(new DateTime("2014-01-13 22:27:52"))
            ->setCountry($countryCz);

        $this->addReference(self::COMPANY_VAHYOPAVA, $company3);

        $company4 = new Company();
        $company4->setName("SEDKO group s.r.o.")
            ->setDescription("SEDKO group s.r.o.")
            ->setCompanyId("25857355")
            ->setVatNumber('CZ25857355')
            ->setStreet("Rooseveltova 1940/33")
            ->setCity("Opava")
            ->setZipCode("746 01")
            ->setCreated(new DateTime("2014-01-13 22:31:07"))
            ->setCountry($countryCz);

        $this->addReference(self::COMPANY_SEDKO, $company4);

        $company5 = new Company();
        $company5->setName("RD Rýmařov s.r.o.")
            ->setDescription("RD Rýmařov s.r.o.")
            ->setCompanyId("18953581")
            ->setVatNumber('CZ18953581')
            ->setStreet("8. května 1191/45")
            ->setCity("Rýmařov")
            ->setZipCode("795 01")
            ->setCreated(new DateTime("2014-01-13 22:32:26"))
            ->setCountry($countryCz);

        $company6 = new Company();
        $company6->setName("PH&PM Trading s.r.o.")
            ->setDescription("PH&PM Trading s.r.o.")
            ->setCompanyId("2784301")
            ->setVatNumber('CZ02784301')
            ->setStreet("Chudenická 1059/30")
            ->setCity("Praha - Hostivař")
            ->setZipCode("102 00")
            ->setCreated(new DateTime("2014-02-08 15:05:18"))
            ->setAccountNumber("2400578126/2010")
            ->setCountry($countryCz);

        $company7 = new Company();
        $company7->setName("Maxxnet.cz s.r.o.")
            ->setDescription("Maxxnet.cz s.r.o.")
            ->setCompanyId("29459711")
            ->setVatNumber('CZ29459711')
            ->setStreet("Nákladní 4")
            ->setCity("Opava")
            ->setZipCode("746 01")
            ->setCreated(new DateTime())
            ->setAccountNumber("256256296/0300")
            ->setCountry($countryCz);
        $this->addReference(self::COMPANY_MAXXNET, $company7);

        $company8 = new Company();
        $company8->setName("GAPPAY s.r.o.")
            ->setDescription("GAPPAY s.r.o.")
            ->setCompanyId("47151960")
            ->setVatNumber('CZ47151960')
            ->setStreet("Olomoucká 134")
            ->setCity("Slavkov u Opavy")
            ->setZipCode("747 57")
            ->setCreated(new DateTime())
            ->setAccountNumber("825242821/0100")
            ->setCountry($countryCz);
        $this->addReference(self::GAPPAY_SRO, $company8);

        $company9 = new Company();
        $company9->setName("Ondřej Patyk")
            ->setDescription("Ondřej Patyk")
            ->setCompanyId("75338360")
            ->setStreet("Ratibořská 1148/36")
            ->setCity("Opava - Kateřinky")
            ->setZipCode("747 05")
            ->setCreated(new DateTime())
            ->setAccountNumber("2701577960/2010")
            ->setCountry($countryCz);


        $company10 = new Company();
        $company10->setName("Vladimír Patyk")
            ->setDescription("Vladimír Patyk")
            ->setCompanyId("44197373")
            ->setVatNumber('CZ5908041524')
            ->setStreet("Ratibořská 1148/36")
            ->setCity("Opava - Kateřinky")
            ->setZipCode("747 05")
            ->setCreated(new DateTime())
            ->setAccountNumber("952444821/0100")
            ->setCountry($countryCz);

        $company11 = new Company();
        $company11->setName("Innovation Advisors s.r.o.")
            ->setDescription("Innovation Advisors s.r.o.")
            ->setCompanyId("40763200")
            ->setVatNumber('CZ40763200')
            ->setStreet("Boženy Němcové 1604/24")
            ->setCity("Opava")
            ->setZipCode("74601")
            ->setCreated(new DateTime())
            ->setCountry($countryCz);
        $this->addReference(self::INNOVATION_ADVISORS, $company11);

        $company12 = new Company();
        $company12->setName("Czech Green Energy s.r.o.")
            ->setDescription("Czech Green Energy s.r.o.")
            ->setCompanyId("09703667")
            ->setVatNumber('CZ09703667')
            ->setStreet("Vinařská 460/3")
            ->setCity("Brno - Pisárky")
            ->setZipCode("603 00")
            ->setCreated(new DateTime())
            ->setCountry($countryCz);
        $this->addReference(self::CGE_SRO, $company12);


        $manager->persist($company1);
        $manager->persist($company2);
        $manager->persist($company3);
        $manager->persist($company4);
        $manager->persist($company5);
        $manager->persist($company6);
        $manager->persist($company7);
        $manager->persist($company8);
        $manager->persist($company9);
        $manager->persist($company10);
        $manager->persist($company11);
        $manager->persist($company12);

        $manager->flush();
    }

    // to which fixtures is depending, they load earlier
    public function getDependencies(): array
    {
        return array(
            CountryFixtures::class
        );
    }
}
