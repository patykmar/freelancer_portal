<?php

namespace App\DataFixtures;

use App\Entity\Queue;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class QueueFixtures extends Fixture
{
    public const QUF_01 = 'quf_01';
    public const QUF_02 = 'quf_02';
    public const QUF_03 = 'quf_03';

    private array $fixturesData = [
        ['name' => 'TIER 1', 'ref' => self::QUF_01],
        ['name' => 'SW developers', 'ref' => self::QUF_02],
        ['name' => 'Network TIER 2', 'ref' => self::QUF_03],
    ];
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->fixturesData as $item) {
            $fixtureItem = new Queue();
            $fixtureItem
                ->setName($item['name']);
            $this->addReference($item['ref'], $fixtureItem);
            $manager->persist($fixtureItem);
            unset($fixtureItem);
        }
        $manager->flush();
    }
}