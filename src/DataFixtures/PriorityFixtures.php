<?php

namespace App\DataFixtures;

use App\Entity\Priority;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PriorityFixtures extends Fixture
{
    public const PRIORITY_FIXTURES_01 = 'priority_fixtures_01';
    public const PRIORITY_FIXTURES_02 = 'priority_fixtures_02';
    public const PRIORITY_FIXTURES_03 = 'priority_fixtures_03';
    public const PRIORITY_FIXTURES_04 = 'priority_fixtures_04';
    public const PRIORITY_FIXTURES_05 = 'priority_fixtures_05';

    private array $priorityData = [
        ['name' => 'Very small', 'coefficient_price' => 0.9, 'coefficient_time' => 1.7, 'ref' => self::PRIORITY_FIXTURES_01],
        ['name' => 'Small', 'coefficient_price' => 0.95, 'coefficient_time' => 1.5, 'ref' => self::PRIORITY_FIXTURES_02],
        ['name' => 'Normal', 'coefficient_price' => 1, 'coefficient_time' => 1, 'ref' => self::PRIORITY_FIXTURES_03],
        ['name' => 'High', 'coefficient_price' => 1.3, 'coefficient_time' => 0.8, 'ref' => self::PRIORITY_FIXTURES_04],
        ['name' => 'Critical', 'coefficient_price' => 1.5, 'coefficient_time' => 0.7, 'ref' => self::PRIORITY_FIXTURES_05],
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->priorityData as $item){
            $priority = new Priority();
            $priority
                ->setName($item['name'])
                ->setCoefficientPrice($item['coefficient_price'])
                ->setCoefficientTime($item['coefficient_time']);
            $this->addReference($item['ref'], $priority);
            $manager->persist($priority);
            unset($priority);
        }
        $manager->flush();
    }
}