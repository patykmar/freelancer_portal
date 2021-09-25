<?php

namespace App\DataFixtures;

use App\Entity\TicketType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TicketTypeFixtures extends Fixture
{
    public const TTF_01 = 'ttf_01';
    public const TTF_02 = 'ttf_02';
    public const TTF_03 = 'ttf_03';

    private array $fixturesData = [
        ['name' => 'Order', 'abbreviation' => 'ORD', 'is_disable' => false, 'coefficient_price' => 1, 'coefficient_time' => 1, 'ref' => self::TTF_01],
        ['name' => 'Incident', 'abbreviation' => 'INC', 'is_disable' => false, 'coefficient_price' => 1, 'coefficient_time' => 1, 'ref' => self::TTF_02],
        ['name' => 'Incident task', 'abbreviation' => 'ITASK', 'is_disable' => false, 'coefficient_price' => 0.9, 'coefficient_time' => 0.8, 'ref' => self::TTF_03],
    ];

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->fixturesData as $item) {
            $fixtureItem = new TicketType();
            $fixtureItem
                ->setName($item['name'])
                ->setAbbreviation($item['abbreviation'])
                ->setIsDisable($item['is_disable'])
                ->setCoefficientPrice($item['coefficient_price'])
                ->setCoefficientTime($item['coefficient_time']);
            $this->addReference($item['ref'], $fixtureItem);
            $manager->persist($fixtureItem);
            unset($fixtureItem);
        }
        $manager->flush();
    }
}