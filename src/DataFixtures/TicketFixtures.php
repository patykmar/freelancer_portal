<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TicketFixtures extends Fixture implements DependentFixtureInterface
{
    private array $serviceCatalogs;
    private array $ticketTypes;

    private array $influencingTickets;
    private array $priorities;
    private array $impact;

    private array $generalStates;
    private array $ticketCloseState;
    private array $ticketState;

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            ServiceCatalogFixtures::class,
            TicketTypeFixtures::class,
            InfluencingTicketFixtures::class,
        ];
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
    }

    private function initServiceCatalogs(): void
    {
        $this->serviceCatalogs = array(
            $this->getReference(ServiceCatalogFixtures::SRVCTL_01), $this->getReference(ServiceCatalogFixtures::SRVCTL_02),
            $this->getReference(ServiceCatalogFixtures::SRVCTL_03), $this->getReference(ServiceCatalogFixtures::SRVCTL_04),
            $this->getReference(ServiceCatalogFixtures::SRVCTL_05), $this->getReference(ServiceCatalogFixtures::SRVCTL_06),
            $this->getReference(ServiceCatalogFixtures::SRVCTL_07), $this->getReference(ServiceCatalogFixtures::SRVCTL_08),
            $this->getReference(ServiceCatalogFixtures::SRVCTL_09), $this->getReference(ServiceCatalogFixtures::SRVCTL_10),
            $this->getReference(ServiceCatalogFixtures::SRVCTL_11), $this->getReference(ServiceCatalogFixtures::SRVCTL_12),
            $this->getReference(ServiceCatalogFixtures::SRVCTL_13), $this->getReference(ServiceCatalogFixtures::SRVCTL_14),
            $this->getReference(ServiceCatalogFixtures::SRVCTL_15), $this->getReference(ServiceCatalogFixtures::SRVCTL_16),
            $this->getReference(ServiceCatalogFixtures::SRVCTL_17), $this->getReference(ServiceCatalogFixtures::SRVCTL_18),
            $this->getReference(ServiceCatalogFixtures::SRVCTL_19), $this->getReference(ServiceCatalogFixtures::SRVCTL_20),
            $this->getReference(ServiceCatalogFixtures::SRVCTL_21), $this->getReference(ServiceCatalogFixtures::SRVCTL_22),
            $this->getReference(ServiceCatalogFixtures::SRVCTL_23), $this->getReference(ServiceCatalogFixtures::SRVCTL_24),
            $this->getReference(ServiceCatalogFixtures::SRVCTL_25),
        );
    }

    private function initTicketTypes(): void
    {
        $this->ticketTypes = array(
            $this->getReference(TicketTypeFixtures::TTF_01),
            $this->getReference(TicketTypeFixtures::TTF_02),
            $this->getReference(TicketTypeFixtures::TTF_03),
        );
    }

    private function initPrioritiesAndImpact(): void
    {
        $this->priorities = $this->influencingTicketFixtures->generatorPriority();
        $this->impact = $this->influencingTicketFixtures->generatorImpact();
    }

    private function initInfluencingTicket(): void
    {
        $this->influencingTickets[] = array(
            $this->getReference(InfluencingTicketFixtures::INF_TIC_FIXTURES_01),
            $this->getReference(InfluencingTicketFixtures::INF_TIC_FIXTURES_02),
            $this->getReference(InfluencingTicketFixtures::INF_TIC_FIXTURES_03),
            $this->getReference(InfluencingTicketFixtures::INF_TIC_FIXTURES_04),
            $this->getReference(InfluencingTicketFixtures::INF_TIC_FIXTURES_05),
            $this->getReference(InfluencingTicketFixtures::INF_TIC_FIXTURES_06),
            $this->getReference(InfluencingTicketFixtures::INF_TIC_FIXTURES_07),
        );

        // grab priority and impact
        foreach ($this->influencingTickets as $influencingTicket) {
            if ($influencingTicket['isForPriority'])
                $this->priorities[] = $influencingTicket;

            if ($influencingTicket['isForImpact'])
                $this->priorities[] = $influencingTicket;
        }
    }

    private function initGeneralSTate(): void
    {
        $this->generalStates[] = array(
            $this->getReference(GeneralStateFixtures::GS_STATE_01),
            $this->getReference(GeneralStateFixtures::GS_STATE_02),
            $this->getReference(GeneralStateFixtures::GS_STATE_03),
            $this->getReference(GeneralStateFixtures::GS_STATE_04),
            $this->getReference(GeneralStateFixtures::GS_STATE_05),
            $this->getReference(GeneralStateFixtures::GS_STATE_06),
            $this->getReference(GeneralStateFixtures::GS_STATE_07),
            $this->getReference(GeneralStateFixtures::GS_STATE_08),
            $this->getReference(GeneralStateFixtures::GS_STATE_09),
            $this->getReference(GeneralStateFixtures::GS_STATE_10),
            $this->getReference(GeneralStateFixtures::GS_STATE_11),
            $this->getReference(GeneralStateFixtures::GS_STATE_12),
            $this->getReference(GeneralStateFixtures::GS_STATE_13),
            $this->getReference(GeneralStateFixtures::GS_STATE_14),
        );

        foreach ($this->generalStates as $generalStateItem){
            if ($generalStateItem['isForCloseState'])
                $this->ticketCloseState[] = $generalStateItem;

            if ($generalStateItem['isForTicket'])
                $this->ticketState[] = $generalStateItem;
        }
    }
}