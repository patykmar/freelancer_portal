<?php

namespace App\DataFixtures;

use App\Entity\Impact;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ImpactFixtures extends Fixture
{
    public const IMPACT_FIXTURES_01 = 'impact_fixtures_01';
    public const IMPACT_FIXTURES_02 = 'impact_fixtures_02';
    public const IMPACT_FIXTURES_03 = 'impact_fixtures_03';

    private array $fixturesData = [
        ['name' => 'Small', 'coefficient_price' => 0.5, 'coefficient_time' => 1.2, 'ref' => self::IMPACT_FIXTURES_01],
        ['name' => 'Normal', 'coefficient_price' => 1, 'coefficient_time' => 1, 'ref' => self::IMPACT_FIXTURES_02],
        ['name' => 'Hight', 'coefficient_price' => 1.5, 'coefficient_time' => 0.8, 'ref' => self::IMPACT_FIXTURES_03],
    ];

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->fixturesData as $item) {
            $fixtureItem = new Impact();
            $fixtureItem
                ->setName($item['name'])
                ->setCoefficientPrice($item['coefficient_price'])
                ->setCoefficientTime($item['coefficient_time']);
            $this->addReference($item['ref'], $fixtureItem);
            $manager->persist($fixtureItem);
            unset($fixtureItem);
        }
        $manager->flush();
    }
}