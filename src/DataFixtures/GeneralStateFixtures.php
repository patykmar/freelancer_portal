<?php

namespace App\DataFixtures;

use App\Entity\GeneralState;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GeneralStateFixtures extends Fixture
{

    public const GS_STATE_01 = 'ci_state_01';
    public const GS_STATE_02 = 'ci_state_02';
    public const GS_STATE_03 = 'ci_state_03';
    public const GS_STATE_04 = 'ci_state_04';
    public const GS_STATE_05 = 'ci_state_05';
    public const GS_STATE_06 = 'ci_state_06';
    public const GS_STATE_07 = 'ci_state_07';
    public const GS_STATE_08 = 'ci_state_08';
    public const GS_STATE_09 = 'ci_state_09';
    public const GS_STATE_10 = 'ci_state_10';
    public const GS_STATE_11 = 'ci_state_11';
    public const GS_STATE_12 = 'ci_state_12';
    public const GS_STATE_13 = 'ci_state_13';
    public const GS_STATE_14 = 'ci_state_14';

    private array $fixturesData = [
        ['name' => 'Draft', 'isForCi' => true, 'isForCloseState' => false, 'isForTicket' => false, 'coefficient_price' => 1.0, 'ref' => self::GS_STATE_01],
        ['name' => 'Planning', 'isForCi' => true, 'isForCloseState' => false, 'isForTicket' => false, 'coefficient_price' => 1.0, 'ref' => self::GS_STATE_02],
        ['name' => 'In use', 'isForCi' => true, 'isForCloseState' => false, 'isForTicket' => false, 'coefficient_price' => 1.0, 'ref' => self::GS_STATE_03],
        ['name' => 'Decommission', 'isForCi' => true, 'isForCloseState' => false, 'isForTicket' => false, 'coefficient_price' => 1.0, 'ref' => self::GS_STATE_04],
        ['name' => 'Retired', 'isForCi' => true, 'isForCloseState' => false, 'isForTicket' => false, 'coefficient_price' => 1.0, 'ref' => self::GS_STATE_05],

        ['name' => 'Resolved', 'isForCi' => false, 'isForCloseState' => true, 'isForTicket' => true, 'coefficient_price' => 1.0, 'ref' => self::GS_STATE_06],
        ['name' => 'No action', 'isForCi' => false, 'isForCloseState' => true, 'isForTicket' => false, 'coefficient_price' => 0.1, 'ref' => self::GS_STATE_07],
        ['name' => 'Rejected', 'isForCi' => false, 'isForCloseState' => true, 'isForTicket' => false, 'coefficient_price' => 0.3, 'ref' => self::GS_STATE_08],

        ['name' => 'Open', 'isForCi' => false, 'isForCloseState' => true, 'isForTicket' => true, 'coefficient_price' => 1.0, 'ref' => self::GS_STATE_09],
        ['name' => 'Assign', 'isForCi' => false, 'isForCloseState' => true, 'isForTicket' => true, 'coefficient_price' => 1.0, 'ref' => self::GS_STATE_10],
        ['name' => 'Work in progress', 'isForCi' => false, 'isForCloseState' => true, 'isForTicket' => true, 'coefficient_price' => 1.0, 'ref' => self::GS_STATE_11],
        ['name' => 'Closed', 'isForCi' => false, 'isForCloseState' => true, 'isForTicket' => true, 'coefficient_price' => 1.0, 'ref' => self::GS_STATE_12],
        ['name' => 'Waiting for customer', 'isForCi' => false, 'isForCloseState' => true, 'isForTicket' => true, 'coefficient_price' => 1.0, 'ref' => self::GS_STATE_13],
        ['name' => 'Re-open', 'isForCi' => false, 'isForCloseState' => true, 'isForTicket' => true, 'coefficient_price' => 1.0, 'ref' => self::GS_STATE_14],
    ];


    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->fixturesData as $item) {
            $fixtureItem = new GeneralState();
            $fixtureItem
                ->setName($item['name'])
                ->setIsForCi($item['isForCi'])
                ->setIsForCloseState($item['isForCloseState'])
                ->setIsForTicket($item['isForTicket'])
                ->setCoefficientPrice($item['coefficient_price']);
            $this->addReference($item['ref'], $fixtureItem);
            $manager->persist($fixtureItem);
            unset($fixtureItem);
        }
        $manager->flush();
    }
}