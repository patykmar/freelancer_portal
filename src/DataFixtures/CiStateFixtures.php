<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\CiState;

class CiStateFixtures extends Fixture
{
    public const CI_STATE_01 = 'ci_state_01';
    public const CI_STATE_02 = 'ci_state_02';
    public const CI_STATE_03 = 'ci_state_03';
    public const CI_STATE_04 = 'ci_state_04';
    public const CI_STATE_05 = 'ci_state_05';

    private array $fixturesData = [
        ['name' => 'Draft', 'ref' => self::CI_STATE_01],
        ['name' => 'Planning', 'ref' => self::CI_STATE_02],
        ['name' => 'In use', 'ref' => self::CI_STATE_03],
        ['name' => 'Decommission', 'ref' => self::CI_STATE_04],
        ['name' => 'Retired', 'ref' => self::CI_STATE_05],
    ];

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->fixturesData as $item) {
            $fixtureItem = new CiState();
            $fixtureItem
                ->setName($item['name']);
            $this->addReference($item['ref'], $fixtureItem);
            $manager->persist($fixtureItem);
            unset($fixtureItem);
        }
        $manager->flush();
    }
}