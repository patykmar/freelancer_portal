<?php

namespace App\DataFixtures;

use App\Entity\Sla;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SlaFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [
            InfluencingTicketFixtures::class,
            TicketTypeFixtures::class,
            TariffFixture::class,
        ];
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $tariffs = [
            $this->getReference(TariffFixture::CZK_299),
            $this->getReference(TariffFixture::CZK_399),
            $this->getReference(TariffFixture::CZK_450),
            $this->getReference(TariffFixture::CZK_499),
            $this->getReference(TariffFixture::CZK_600),
            $this->getReference(TariffFixture::CZK_699),
            $this->getReference(TariffFixture::CZK_999),
        ];

        $priorities = [
            $this->getReference(InfluencingTicketFixtures::INF_TIC_FIXTURES_04),
            $this->getReference(InfluencingTicketFixtures::INF_TIC_FIXTURES_05),
            $this->getReference(InfluencingTicketFixtures::INF_TIC_FIXTURES_02),
            $this->getReference(InfluencingTicketFixtures::INF_TIC_FIXTURES_06),
            $this->getReference(InfluencingTicketFixtures::INF_TIC_FIXTURES_07),
        ];

        $ticketTypes = [
            $this->getReference(TicketTypeFixtures::TTF_01),
            $this->getReference(TicketTypeFixtures::TTF_02),
            $this->getReference(TicketTypeFixtures::TTF_03),
        ];

        foreach ($tariffs as $tariff){
            foreach ($priorities as $priority){
                foreach ($ticketTypes as $ticketType){
                    $fixtureItem = new Sla();
                    $fixtureItem
                        ->setTariff($tariff)
                        ->setPriority($priority)
                        ->setTicketType($ticketType)
                        ->setReactionTime(7776000) // 3 months
                        ->setResolvedTime(15552000) // 6 months
                        ->setPriceMultiplier(100)
                    ;
                    $manager->persist($fixtureItem);
                    unset($fixtureItem);
                }
            }
        }
        $manager->flush();
    }
}