<?php

namespace App\DataFixtures;

use App\Entity\TicketCloseState;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TicketCloseStateFixtures extends Fixture
{
    public const TCSF_01 = 'tcsf_01';
    public const TCSF_02 = 'tcsf_02';
    public const TCSF_03 = 'tcsf_03';

    private array $fixturesData = [
        ['name' => 'Resolved', 'coefficient_price' => 1.0, 'ref' => self::TCSF_01],
        ['name' => 'No action', 'coefficient_price' => 0.1, 'ref' => self::TCSF_02],
        ['name' => 'Rejected', 'coefficient_price' => 0.3, 'ref' => self::TCSF_03],
    ];

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->fixturesData as $item) {
            $fixtureItem = new TicketCloseState();
            $fixtureItem
                ->setName($item['name'])
                ->setCoefficientPrice($item['coefficient_price']);
            $this->addReference($item['ref'], $fixtureItem);
            $manager->persist($fixtureItem);
            unset($fixtureItem);
        }
        $manager->flush();
    }
}