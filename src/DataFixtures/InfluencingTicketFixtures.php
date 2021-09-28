<?php

namespace App\DataFixtures;

use App\Entity\InfluencingTicket;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class InfluencingTicketFixtures extends Fixture
{
    public const INF_TIC_FIXTURES_01 = 'inf_tic_fixtures_01';
    public const INF_TIC_FIXTURES_02 = 'inf_tic_fixtures_02';
    public const INF_TIC_FIXTURES_03 = 'inf_tic_fixtures_03';
    public const INF_TIC_FIXTURES_04 = 'inf_tic_fixtures_04';
    public const INF_TIC_FIXTURES_05 = 'inf_tic_fixtures_05';
    public const INF_TIC_FIXTURES_06 = 'inf_tic_fixtures_06';
    public const INF_TIC_FIXTURES_07 = 'inf_tic_fixtures_07';

    private array $fixturesData = [
        ['name' => 'Small', 'coefficient_price' => 0.5, 'coefficient_time' => 1.2, 'isForPriority' => false, 'isForImpact' => true, 'ref' => self::INF_TIC_FIXTURES_01],
        ['name' => 'Normal', 'coefficient_price' => 1, 'coefficient_time' => 1, 'isForPriority' => true, 'isForImpact' => true, 'ref' => self::INF_TIC_FIXTURES_02],
        ['name' => 'High', 'coefficient_price' => 1.5, 'coefficient_time' => 0.8, 'isForPriority' => false, 'isForImpact' => true, 'ref' => self::INF_TIC_FIXTURES_03],

        ['name' => 'Very small', 'coefficient_price' => 0.9, 'coefficient_time' => 1.7, 'isForPriority' => true, 'isForImpact' => false, 'ref' => self::INF_TIC_FIXTURES_04],
        ['name' => 'Small', 'coefficient_price' => 0.95, 'coefficient_time' => 1.5, 'isForPriority' => true, 'isForImpact' => false, 'ref' => self::INF_TIC_FIXTURES_05],
        ['name' => 'High', 'coefficient_price' => 1.3, 'coefficient_time' => 0.8, 'isForPriority' => true, 'isForImpact' => false, 'ref' => self::INF_TIC_FIXTURES_06],
        ['name' => 'Critical', 'coefficient_price' => 1.5, 'coefficient_time' => 0.7, 'isForPriority' => true, 'isForImpact' => false, 'ref' => self::INF_TIC_FIXTURES_07],

    ];

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->fixturesData as $item) {
            $priority = new InfluencingTicket();
            $priority
                ->setName($item['name'])
                ->setCoefficientPrice($item['coefficient_price'])
                ->setCoefficientTime($item['coefficient_time'])
                ->setIsForImpact($item['isForPriority'])
                ->setIsForPriority($item['isForImpact']);
            $this->addReference($item['ref'], $priority);
            $manager->persist($priority);
            unset($priority);
        }
        $manager->flush();
    }
}