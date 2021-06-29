<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use DateTime;
use Exception;

class CompanyFixture extends Fixture implements DependentFixtureInterface
{
    public const COMPANY_PATYK_MARTIN = 'ing-patykmar';
    public const COMPANY_VODAFONE_CZ = 'vf-cz';
    public const COMPANY_TMOBILE_CZ = 'tm-cz';
    public const COMPANY_O2_CZ = 'o2-cz';
    public const COMPANY_RDRYMAROV = 'rd-rymarov';
    public const COMPANY_CETIN_CZ = 'cetin-cz';
    public const COMPANY_MAXXNET = 'maxxnet-sro';
    public const COMPANY_CEZ = 'cez-cz';
    public const INNOVATION_ADVISORS = 'innovation_advisors-sro';
    public const GAPPAY_SRO = 'gappay-sro';
    public const CGE_SRO = 'cge-sro';


    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        // get references from CountryFixtures class
        /** @var Country $countryCz */
        $countryCz = $this->getReference(CountryFixtures::COUNTRY_CZ_REFERENCE);

        $company1 = new Company();
        $company1->setName("Ing. Martin Patyk")
            ->setDescription("Ing. Martin Patyk - Cerna")
            ->setCompanyId("88230104")
            ->setVatNumber('CZ8707145876')
            ->setStreet("Černá 1416/5")
            ->setCity("Opava - Kateřinky ")
            ->setZipCode("74705")
            ->setAccountNumber("670100-2209225998/6210")
            ->setCreated(new DateTime("2014-01-13 22:17:20"))
            ->setIsSupplier(true)
            ->setCountry($countryCz);
        $this->addReference(self::COMPANY_PATYK_MARTIN, $company1);

        $company2 = new Company();
        $company2->setName("Vodafone Czech Republic a. s.")
            ->setDescription("Vodafone Czech Republic a. s.")
            ->setCompanyId("25788001")
            ->setVatNumber('CZ25788001')
            ->setStreet("náměstí Junkových 2")
            ->setCity("Praha 5")
            ->setZipCode("15500")
            ->setCreated(new DateTime("@".rand(946684800,time())))
            ->setCountry($countryCz);
        $this->addReference(self::COMPANY_VODAFONE_CZ, $company2);

        $company3 = new Company();
        $company3->setName("T‑Mobile Czech Republic a.s.")
            ->setDescription("T‑Mobile Czech Republic a.s.")
            ->setCompanyId("64949681")
            ->setVatNumber('CZ64949681')
            ->setStreet("Tomíčkova 2144/1")
            ->setCity("Praha 4")
            ->setZipCode("14800")
            ->setCreated(new DateTime("2014-01-13 22:27:52"))
            ->setCountry($countryCz);
        $this->addReference(self::COMPANY_TMOBILE_CZ, $company3);

        $company4 = new Company();
        $company4->setName("O2 Czech Republic a.s.")
            ->setDescription("O2 Czech Republic a.s.")
            ->setCompanyId("60193336")
            ->setVatNumber('CZ60193336')
            ->setStreet("Za Brumlovkou 266/2")
            ->setCity("Praha 4, Michle")
            ->setZipCode("14022")
            ->setCreated(new DateTime("2014-01-13 22:31:07"))
            ->setCountry($countryCz);
        $this->addReference(self::COMPANY_O2_CZ, $company4);

        $company5 = new Company();
        $company5->setName("RD Rýmařov s.r.o.")
            ->setDescription("RD Rýmařov s.r.o.")
            ->setCompanyId("18953581")
            ->setVatNumber('CZ18953581')
            ->setStreet("8. května 1191/45")
            ->setCity("Rýmařov")
            ->setZipCode("79501")
            ->setCreated(new DateTime("2014-01-13 22:32:26"))
            ->setCountry($countryCz);
        $this->addReference(self::COMPANY_RDRYMAROV, $company5);

        $company6 = new Company();
        $company6->setName("CETIN a.s.")
            ->setDescription("CETIN a.s.")
            ->setCompanyId("04084063")
            ->setVatNumber('CZ04084063')
            ->setStreet("Českomoravská 2510/19")
            ->setCity("Praha 9")
            ->setZipCode("19000")
            ->setCreated(new DateTime("2014-02-08 15:05:18"))
            ->setCountry($countryCz);
        $this->addReference(self::COMPANY_CETIN_CZ, $company6);

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
        $company9->setName("ČEZ, a. s.")
            ->setDescription("ČEZ, a. s.")
            ->setCompanyId("45274649")
            ->setVatNumber("CZ45274649")
            ->setStreet("Duhová 1444/2")
            ->setCity("Praha - Michle")
            ->setZipCode("14000")
            ->setCreated(new DateTime())
            ->setAccountNumber("2701577960/2010")
            ->setCountry($countryCz);
        $this->addReference(self::COMPANY_CEZ, $company9);

        $company10 = new Company();
        $company10->setName("ŠKODA AUTO a.s.")
            ->setDescription("ŠKODA AUTO a.s.")
            ->setCompanyId("00177041")
            ->setVatNumber('CZ00177041')
            ->setStreet("tř. Václava Klementa 869")
            ->setCity("Mladá Boleslav II")
            ->setZipCode("29301")
            ->setCreated(new DateTime())
            ->setAccountNumber("001-8336621-32")
            ->setIban('BE90001833662132')
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
