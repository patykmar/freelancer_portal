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
    public const COMPANY_SKODA = 'skoda-cz';
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
        $countries = [
            $this->getReference(CountryFixtures::COUNTRY_CZ_REFERENCE),
        ];

        $companies = [
            ['name' => 'Ing. Martin Patyk', 'desc' => 'Ing. Martin Patyk - Cerna', 'compId' => '88230104',
                'vatNumber' => 'CZ8707145876', 'street' => 'Černá 1416/5', 'city' => 'Opava - Kateřinky',
                'zip' => '74705', 'account' => '670100-2209225998/6210', 'created' => new DateTime("2014-01-13 22:17:20"),
                'isSupplier' => true, 'country' => $countries[0], 'ref' => self::COMPANY_PATYK_MARTIN],
            ['name' => 'Vodafone Czech Republic a. s.', 'desc' => 'Vodafone Czech Republic a. s.', 'compId' => '25788001',
                'vatNumber' => 'CZ25788001', 'street' => 'náměstí Junkových 2', 'city' => 'Praha 5',
                'zip' => '15500', 'created' => new DateTime("@" . rand(946684800, time())),
                'country' => $countries[0], 'ref' => self::COMPANY_VODAFONE_CZ],
            ['name' => 'T‑Mobile Czech Republic a.s.', 'desc' => 'T‑Mobile Czech Republic a.s.',
                'compId' => '64949681', 'vatNumber' => 'CZ64949681', 'street' => 'Tomíčkova 2144/1',
                'city' => 'Praha 4', 'zip' => '14800', 'created' => new DateTime("@" . rand(946684800, time())),
                'country' => $countries[0], 'ref' => self::COMPANY_TMOBILE_CZ],
            ['name' => 'O2 Czech Republic a.s.', 'desc' => 'O2 Czech Republic a.s.',
                'compId' => '60193336', 'vatNumber' => 'CZ60193336', 'street' => 'Za Brumlovkou 266/2',
                'city' => 'Praha 4, Michle', 'zip' => '14022', 'created' => new DateTime("@" . rand(946684800, time())),
                'country' => $countries[0], 'ref' => self::COMPANY_O2_CZ],
            ['name' => 'RD Rýmařov s.r.o.', 'desc' => 'RD Rýmařov s.r.o.',
                'compId' => '18953581', 'vatNumber' => 'CZ18953581', 'street' => '8. května 1191/45',
                'city' => 'Rýmařov', 'zip' => '79501', 'created' => new DateTime("@" . rand(946684800, time())),
                'country' => $countries[0], 'ref' => self::COMPANY_RDRYMAROV],
            ['name' => 'CETIN a.s.', 'desc' => 'CETIN a.s.',
                'compId' => '04084063', 'vatNumber' => 'CZ04084063', 'street' => 'Českomoravská 2510/19',
                'city' => 'Praha 9', 'zip' => '19000', 'created' => new DateTime("@" . rand(946684800, time())),
                'country' => $countries[0], 'ref' => self::COMPANY_CETIN_CZ],
            ['name' => 'Maxxnet.cz s.r.o.', 'desc' => 'Maxxnet.cz s.r.o.', 'account' => '256256296/0300',
                'compId' => '29459711', 'vatNumber' => 'CZ29459711', 'street' => 'Nákladní 4',
                'city' => 'Opava', 'zip' => '74601', 'created' => new DateTime("@" . rand(946684800, time())),
                'country' => $countries[0], 'ref' => self::COMPANY_MAXXNET],
            ['name' => 'GAPPAY s.r.o.', 'desc' => 'GAPPAY s.r.o.', 'account' => '825242821/0100',
                'compId' => '47151960', 'vatNumber' => 'CZ47151960', 'street' => 'Olomoucká 134',
                'city' => 'Slavkov u Opavy', 'zip' => '74757', 'created' => new DateTime("@" . rand(946684800, time())),
                'country' => $countries[0], 'ref' => self::GAPPAY_SRO],
            ['name' => 'ČEZ, a. s.', 'desc' => 'ČEZ, a. s.', 'account' => '2701577960/2010',
                'compId' => '45274649', 'vatNumber' => 'CZ45274649', 'street' => 'Duhová 1444/2',
                'city' => 'Praha - Michle', 'zip' => '14000', 'created' => new DateTime("@" . rand(946684800, time())),
                'country' => $countries[0], 'ref' => self::COMPANY_CEZ],
            ['name' => 'ŠKODA AUTO a.s.', 'desc' => 'ŠKODA AUTO a.s.', 'account' => '001-8336621-32',
                'compId' => '00177041', 'vatNumber' => 'CZ00177041', 'street' => 'tř. Václava Klementa 869',
                'city' => 'Mladá Boleslav II', 'zip' => '29301', 'created' => new DateTime("@" . rand(946684800, time())),
                'country' => $countries[0], 'ref' => self::COMPANY_SKODA, 'iban' => 'BE90001833662132'],
            ['name' => 'Innovation Advisors s.r.o.', 'desc' => 'Innovation Advisors s.r.o.',
                'compId' => '40763200', 'vatNumber' => 'CZ40763200', 'street' => 'Boženy Němcové 1604/24',
                'city' => 'Opava', 'zip' => '74601', 'created' => new DateTime("@" . rand(946684800, time())),
                'country' => $countries[0], 'ref' => self::INNOVATION_ADVISORS],
            ['name' => 'Czech Green Energy s.r.o.', 'desc' => 'Czech Green Energy s.r.o.',
                'compId' => '09703667', 'vatNumber' => 'CZ09703667', 'street' => 'Vinařská 460/3',
                'city' => 'Brno - Pisárky', 'zip' => '60300', 'created' => new DateTime("@" . rand(946684800, time())),
                'country' => $countries[0], 'ref' => self::CGE_SRO],
        ];

        for ($i = 0; $i < count($companies); $i++) {
            $companyFixture = new Company();
            $companyFixture
                ->setName($companies[$i]['name'])
                ->setDescription($companies[$i]['desc'])
                ->setCompanyId($companies[$i]['compId'])
                ->setVatNumber($companies[$i]['vatNumber'])
                ->setStreet($companies[$i]['street'])
                ->setCity($companies[$i]['city'])
                ->setZipCode($companies[$i]['zip'])
                ->setCreated($companies[$i]['created'])
                ->setCountry($companies[$i]['country']);
            if (isset($companies[$i]['account'])) {
                $companyFixture->setAccountNumber($companies[$i]['account']);
            }
            if (isset($companies[$i]['isSupplier'])) {
                $companyFixture->setIsSupplier($companies[$i]['isSupplier']);
            }
            if (isset($companies[$i]['iban'])) {
                $companyFixture->setIban($companies[$i]['iban']);
            }
            $this->addReference($companies[$i]['ref'], $companyFixture);
            $manager->persist($companyFixture);
            unset($companyFixture);
        }

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
