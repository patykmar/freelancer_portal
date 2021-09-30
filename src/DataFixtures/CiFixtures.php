<?php

namespace App\DataFixtures;

use App\Entity\Ci;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CiFixtures extends Fixture implements DependentFixtureInterface
{
    public const CI_FIX_01 = 'ci_fix_01';
    public const CI_FIX_02 = 'ci_fix_02';
    public const CI_FIX_03 = 'ci_fix_03';
    public const CI_FIX_04 = 'ci_fix_04';
    public const CI_FIX_05 = 'ci_fix_05';
    public const CI_FIX_06 = 'ci_fix_06';
    public const CI_FIX_07 = 'ci_fix_07';
    public const CI_FIX_08 = 'ci_fix_08';
    public const CI_FIX_09 = 'ci_fix_09';
    public const CI_FIX_10 = 'ci_fix_10';
    public const CI_FIX_11 = 'ci_fix_11';
    public const CI_FIX_12 = 'ci_fix_12';

    private array $fixturesData;
    private array $users;
    private array $queues;
    private array $states;
    private array $tariffs;

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $this->initFixtureData();

        foreach ($this->fixturesData as $item) {
            $fixtureItem = new Ci();
            $fixtureItem
                ->setName($item['ciName'])
                ->setCompany($item['company-ref'])
                ->setCreatedUser($this->users[rand(0, count($this->users) - 1)])
                ->setState($this->states[rand(0, count($this->states) - 1)])
                ->setTariff($this->tariffs[rand(0, count($this->tariffs) - 1)])
                ->setCreatedDateTime(new DateTime())
                ->setDescription(InvoiceItemFixtures::$sentences[rand(0, count(InvoiceItemFixtures::$sentences) - 1)])
                ->setQueueTier1($this->queues[0])
                ->setQueueTier2($this->queues[1])
                ->setQueueTier3(null);
            $this->addReference($item['ref'], $fixtureItem);
            $manager->persist($fixtureItem);
            unset($fixtureItem);
        }
        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            QueueFixtures::class,
            GeneralStateFixtures::class,
            TariffFixture::class,
            CompanyFixture::class,
        ];
    }

    private function initFixtureData(): void
    {
        $this->setUsers();
        $this->setQueues();
        $this->setStates();
        $this->setTariffs();
        $this->setFixturesData();
    }

    private function setUsers(): void
    {
        $this->users[] = $this->getReference(UserFixture::USER_FIXTURE_01);
        $this->users[] = $this->getReference(UserFixture::USER_FIXTURE_02);
        $this->users[] = $this->getReference(UserFixture::USER_FIXTURE_03);
        $this->users[] = $this->getReference(UserFixture::USER_FIXTURE_04);
    }

    private function setQueues(): void
    {
        // TIER 1
        $this->queues[] = $this->getReference(QueueFixtures::QUF_01);
        // SW developers
        $this->queues[] = $this->getReference(QueueFixtures::QUF_02);
        // Network TIER 2
        $this->queues[] = $this->getReference(QueueFixtures::QUF_03);
    }

    private function setStates(): void
    {
        $this->states[] = $this->getReference(GeneralStateFixtures::GS_STATE_01);
        $this->states[] = $this->getReference(GeneralStateFixtures::GS_STATE_02);
        $this->states[] = $this->getReference(GeneralStateFixtures::GS_STATE_03);
        $this->states[] = $this->getReference(GeneralStateFixtures::GS_STATE_04);
        $this->states[] = $this->getReference(GeneralStateFixtures::GS_STATE_05);
    }

    private function setTariffs(): void
    {
        $this->tariffs[] = $this->getReference(TariffFixture::CZK_299);
        $this->tariffs[] = $this->getReference(TariffFixture::CZK_399);
        $this->tariffs[] = $this->getReference(TariffFixture::CZK_450);
        $this->tariffs[] = $this->getReference(TariffFixture::CZK_499);
        $this->tariffs[] = $this->getReference(TariffFixture::CZK_600);
        $this->tariffs[] = $this->getReference(TariffFixture::CZK_699);
        $this->tariffs[] = $this->getReference(TariffFixture::CZK_999);
    }

    private function setFixturesData(): void
    {
        $this->fixturesData = array(
            ['ciName' => 'patyk.cz', 'ref' => self::CI_FIX_01,
                'company-ref' => $this->getReference(CompanyFixture::COMPANY_PATYK_MARTIN)],
            ['ciName' => 'vodafone.cz', 'ref' => self::CI_FIX_02,
                'company-ref' => $this->getReference(CompanyFixture::COMPANY_VODAFONE_CZ)],
            ['ciName' => 't-mobile.cz', 'ref' => self::CI_FIX_03,
                'company-ref' => $this->getReference(CompanyFixture::COMPANY_TMOBILE_CZ)],
            ['ciName' => 'o2.cz', 'ref' => self::CI_FIX_04,
                'company-ref' => $this->getReference(CompanyFixture::COMPANY_O2_CZ)],
            ['ciName' => 'rdrymarov.cz', 'ref' => self::CI_FIX_05,
                'company-ref' => $this->getReference(CompanyFixture::COMPANY_RDRYMAROV)],
            ['ciName' => 'cetin.cz', 'ref' => self::CI_FIX_06,
                'company-ref' => $this->getReference(CompanyFixture::COMPANY_CETIN_CZ)],
            ['ciName' => 'nagigovesiti.cz', 'ref' => self::CI_FIX_07,
                'company-ref' => $this->getReference(CompanyFixture::COMPANY_MAXXNET)],
            ['ciName' => 'cez.cz', 'ref' => self::CI_FIX_08,
                'company-ref' => $this->getReference(CompanyFixture::COMPANY_CEZ)],
            ['ciName' => 'skoda-auto.cz', 'ref' => self::CI_FIX_09,
                'company-ref' => $this->getReference(CompanyFixture::COMPANY_SKODA)],
            ['ciName' => 'innovationadvisors.cz', 'ref' => self::CI_FIX_10,
                'company-ref' => $this->getReference(CompanyFixture::INNOVATION_ADVISORS)],
            ['ciName' => 'gappay.cz', 'ref' => self::CI_FIX_11,
                'company-ref' => $this->getReference(CompanyFixture::GAPPAY_SRO)],
            ['ciName' => 'cge-energy.cz', 'ref' => self::CI_FIX_12,
                'company-ref' => $this->getReference(CompanyFixture::CGE_SRO)],
        );
    }

}