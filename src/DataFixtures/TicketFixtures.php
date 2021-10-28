<?php

namespace App\DataFixtures;

use App\Entity\Ticket;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TicketFixtures extends Fixture implements DependentFixtureInterface
{
    public const TICKET_01 = 'ticket-01';
    public const TICKET_02 = 'ticket-02';
    public const TICKET_03 = 'ticket-03';
    public const TICKET_04 = 'ticket-04';
    public const TICKET_05 = 'ticket-05';
    public const TICKET_06 = 'ticket-06';
    public const TICKET_07 = 'ticket-07';
    public const TICKET_08 = 'ticket-08';
    public const TICKET_09 = 'ticket-09';
    public const TICKET_10 = 'ticket-10';
    public const TICKET_11 = 'ticket-11';
    public const TICKET_12 = 'ticket-12';
    public const TICKET_13 = 'ticket-13';
    public const TICKET_14 = 'ticket-14';
    public const TICKET_15 = 'ticket-15';
    public const TICKET_16 = 'ticket-16';
    public const TICKET_17 = 'ticket-17';
    public const TICKET_18 = 'ticket-18';
    public const TICKET_19 = 'ticket-19';
    public const TICKET_20 = 'ticket-20';
    public const TICKET_21 = 'ticket-21';
    public const TICKET_22 = 'ticket-22';
    public const TICKET_23 = 'ticket-23';
    public const TICKET_24 = 'ticket-24';
    public const TICKET_25 = 'ticket-25';
    public const TICKET_26 = 'ticket-26';
    public const TICKET_27 = 'ticket-27';
    public const TICKET_28 = 'ticket-28';
    public const TICKET_29 = 'ticket-29';
    public const TICKET_30 = 'ticket-30';
    public const TICKET_31 = 'ticket-31';
    public const TICKET_32 = 'ticket-32';
    public const TICKET_33 = 'ticket-33';
    public const TICKET_34 = 'ticket-34';
    public const TICKET_35 = 'ticket-35';
    public const TICKET_36 = 'ticket-36';
    public const TICKET_37 = 'ticket-37';
    public const TICKET_38 = 'ticket-38';
    public const TICKET_39 = 'ticket-39';
    public const TICKET_40 = 'ticket-40';
    public const TICKET_41 = 'ticket-41';
    public const TICKET_42 = 'ticket-42';
    public const TICKET_43 = 'ticket-43';
    public const TICKET_44 = 'ticket-44';
    public const TICKET_45 = 'ticket-45';
    public const TICKET_46 = 'ticket-46';
    public const TICKET_47 = 'ticket-47';
    public const TICKET_48 = 'ticket-48';
    public const TICKET_49 = 'ticket-49';
    public const TICKET_50 = 'ticket-50';
    public const TICKET_51 = 'ticket-51';
    public const TICKET_52 = 'ticket-52';
    public const TICKET_53 = 'ticket-53';
    public const TICKET_54 = 'ticket-54';
    public const TICKET_55 = 'ticket-55';
    public const TICKET_56 = 'ticket-56';
    public const TICKET_57 = 'ticket-57';
    public const TICKET_58 = 'ticket-58';
    public const TICKET_59 = 'ticket-59';
    public const TICKET_60 = 'ticket-60';
    public const TICKET_61 = 'ticket-61';
    public const TICKET_62 = 'ticket-62';
    public const TICKET_63 = 'ticket-63';
    public const TICKET_64 = 'ticket-64';
    public const TICKET_65 = 'ticket-65';
    public const TICKET_66 = 'ticket-66';
    public const TICKET_67 = 'ticket-67';
    public const TICKET_68 = 'ticket-68';
    public const TICKET_69 = 'ticket-69';
    public const TICKET_70 = 'ticket-70';
    public const TICKET_71 = 'ticket-71';
    public const TICKET_72 = 'ticket-72';
    public const TICKET_73 = 'ticket-73';
    public const TICKET_74 = 'ticket-74';
    public const TICKET_75 = 'ticket-75';
    public const TICKET_76 = 'ticket-76';
    public const TICKET_77 = 'ticket-77';
    public const TICKET_78 = 'ticket-78';
    public const TICKET_79 = 'ticket-79';
    public const TICKET_80 = 'ticket-80';
    public const TICKET_81 = 'ticket-81';
    public const TICKET_82 = 'ticket-82';
    public const TICKET_83 = 'ticket-83';
    public const TICKET_84 = 'ticket-84';
    public const TICKET_85 = 'ticket-85';
    public const TICKET_86 = 'ticket-86';
    public const TICKET_87 = 'ticket-87';
    public const TICKET_88 = 'ticket-88';
    public const TICKET_89 = 'ticket-89';
    public const TICKET_90 = 'ticket-90';
    public const TICKET_91 = 'ticket-91';
    public const TICKET_92 = 'ticket-92';
    public const TICKET_93 = 'ticket-93';
    public const TICKET_94 = 'ticket-94';
    public const TICKET_95 = 'ticket-95';
    public const TICKET_96 = 'ticket-96';
    public const TICKET_97 = 'ticket-97';
    public const TICKET_98 = 'ticket-98';
    public const TICKET_99 = 'ticket-99';
    public const TICKET_100 = 'ticket-100';

    public array $ticket_references;
    public array $cis;

    private array $serviceCatalogs;
    private array $ticketTypes;

    private array $priorities;
    private array $impact;

    private array $ticketState;

    private array $users;
    private array $queueUsers;

    private array $references = [
        self::TICKET_01, self::TICKET_02, self::TICKET_03, self::TICKET_04, self::TICKET_05, self::TICKET_06, self::TICKET_07,
        self::TICKET_08, self::TICKET_09, self::TICKET_10, self::TICKET_11, self::TICKET_12, self::TICKET_13, self::TICKET_14,
        self::TICKET_15, self::TICKET_16, self::TICKET_17, self::TICKET_18, self::TICKET_19, self::TICKET_20, self::TICKET_21,
        self::TICKET_22, self::TICKET_23, self::TICKET_24, self::TICKET_25, self::TICKET_26, self::TICKET_27, self::TICKET_28,
        self::TICKET_29, self::TICKET_30, self::TICKET_31, self::TICKET_32, self::TICKET_33, self::TICKET_34, self::TICKET_35,
        self::TICKET_36, self::TICKET_37, self::TICKET_38, self::TICKET_39, self::TICKET_40, self::TICKET_41, self::TICKET_42,
        self::TICKET_43, self::TICKET_44, self::TICKET_45, self::TICKET_46, self::TICKET_47, self::TICKET_48, self::TICKET_49,
        self::TICKET_50, self::TICKET_51, self::TICKET_52, self::TICKET_53, self::TICKET_54, self::TICKET_55, self::TICKET_56,
        self::TICKET_57, self::TICKET_58, self::TICKET_59, self::TICKET_60, self::TICKET_61, self::TICKET_62, self::TICKET_63,
        self::TICKET_64, self::TICKET_65, self::TICKET_66, self::TICKET_67, self::TICKET_68, self::TICKET_69, self::TICKET_70,
        self::TICKET_71, self::TICKET_72, self::TICKET_73, self::TICKET_74, self::TICKET_75, self::TICKET_76, self::TICKET_77,
        self::TICKET_78, self::TICKET_79, self::TICKET_80, self::TICKET_81, self::TICKET_82, self::TICKET_83, self::TICKET_84,
        self::TICKET_85, self::TICKET_86, self::TICKET_87, self::TICKET_88, self::TICKET_89, self::TICKET_90, self::TICKET_91,
        self::TICKET_92, self::TICKET_93, self::TICKET_94, self::TICKET_95, self::TICKET_96, self::TICKET_97, self::TICKET_98,
        self::TICKET_99, self::TICKET_100
    ];

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            ServiceCatalogFixtures::class,
            TicketTypeFixtures::class,
            InfluencingTicketFixtures::class,
            UserFixture::class,
            CiFixtures::class,
        ];
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {

        $this->initGeneralSTate();
        $this->initInfluencingTicket();
        $this->initServiceCatalogs();
        $this->initTicketTypes();
        $this->initUsers();
        $this->initQueueUsers();
        $this->initCi();

        for ($i = 0; $i < 100; $i++) {
            $ticket = new Ticket();
            $ticket->setServiceCatalog($this->serviceCatalogs[rand(0, count($this->serviceCatalogs) - 1)])
                ->setUserCreated($this->users[rand(0, count($this->users) - 1)])
                ->setTicketState($this->ticketState[rand(0, count($this->ticketState) - 1)])
                ->setTicketType($this->ticketTypes[rand(0, count($this->ticketTypes) - 1)])
                ->setPriority($this->priorities[rand(0, count($this->priorities) - 1)])
                ->setImpact($this->impact[rand(0, count($this->impact) - 1)])
                ->setQueueUser($this->queueUsers[rand(0, count($this->queueUsers) - 1)])
                ->setDescriptionTitle(InvoiceItemFixtures::$sentences[rand(0, count(InvoiceItemFixtures::$sentences) - 1)])
                ->setDescriptionBody(InvoiceItemFixtures::$sentences[rand(0, count(InvoiceItemFixtures::$sentences) - 1)])
                ->setCi($this->cis[rand(0, count($this->cis) - 1)]);
            $this->addReference($this->references[$i], $ticket);
            $manager->persist($ticket);
            unset($ticket);
        }
        $manager->flush();
    }

    private function initCi(): void
    {
        $this->cis = [
            $this->getReference(CiFixtures::CI_FIX_01),
            $this->getReference(CiFixtures::CI_FIX_02),
            $this->getReference(CiFixtures::CI_FIX_03),
            $this->getReference(CiFixtures::CI_FIX_04),
            $this->getReference(CiFixtures::CI_FIX_05),
            $this->getReference(CiFixtures::CI_FIX_06),
            $this->getReference(CiFixtures::CI_FIX_07),
            $this->getReference(CiFixtures::CI_FIX_08),
            $this->getReference(CiFixtures::CI_FIX_09),
            $this->getReference(CiFixtures::CI_FIX_10),
            $this->getReference(CiFixtures::CI_FIX_11),
            $this->getReference(CiFixtures::CI_FIX_12),
        ];
    }

    private function initServiceCatalogs(): void
    {
        $this->serviceCatalogs = [
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
        ];
    }

    private function initTicketTypes(): void
    {
        $this->ticketTypes = [
            $this->getReference(TicketTypeFixtures::TTF_01),
            $this->getReference(TicketTypeFixtures::TTF_02),
            $this->getReference(TicketTypeFixtures::TTF_03),
        ];
    }

    private function initInfluencingTicket(): void
    {
        $influencingTickets = [
            $this->getReference(InfluencingTicketFixtures::INF_TIC_FIXTURES_01),
            $this->getReference(InfluencingTicketFixtures::INF_TIC_FIXTURES_02),
            $this->getReference(InfluencingTicketFixtures::INF_TIC_FIXTURES_03),
            $this->getReference(InfluencingTicketFixtures::INF_TIC_FIXTURES_04),
            $this->getReference(InfluencingTicketFixtures::INF_TIC_FIXTURES_05),
            $this->getReference(InfluencingTicketFixtures::INF_TIC_FIXTURES_06),
            $this->getReference(InfluencingTicketFixtures::INF_TIC_FIXTURES_07),
        ];

        // grab priority and impact
        foreach ($influencingTickets as $influencingTicket) {
            if ($influencingTicket->getIsForPriority())
                $this->priorities[] = $influencingTicket;

            if ($influencingTicket->getIsForImpact())
                $this->impact[] = $influencingTicket;
        }
    }

    private function initGeneralSTate(): void
    {
        $generalStates = [
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
        ];

        foreach ($generalStates as $generalStateItem) {
            if ($generalStateItem->getIsForTicket())
                $this->ticketState[] = $generalStateItem;
        }
    }

    private function initUsers(): void
    {
        $this->users = [
            $this->getReference(UserFixture::USER_FIXTURE_01),
            $this->getReference(UserFixture::USER_FIXTURE_02),
            $this->getReference(UserFixture::USER_FIXTURE_03),
            $this->getReference(UserFixture::USER_FIXTURE_04),
        ];
    }

    private function initQueueUsers(): void
    {
        $this->queueUsers = [
            $this->getReference(QueueUserFixtures::QU_FIXTURES_01),
            $this->getReference(QueueUserFixtures::QU_FIXTURES_02),
            $this->getReference(QueueUserFixtures::QU_FIXTURES_03),
            $this->getReference(QueueUserFixtures::QU_FIXTURES_04),
            $this->getReference(QueueUserFixtures::QU_FIXTURES_05),
            $this->getReference(QueueUserFixtures::QU_FIXTURES_06),
        ];
    }
}