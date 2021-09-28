<?php

namespace App\DataFixtures;

use App\Entity\QueueUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class QueueUserFixtures extends Fixture implements DependentFixtureInterface
{
    public const QU_FIXTURES_01 = 'qu_fixtures_01';
    public const QU_FIXTURES_02 = 'qu_fixtures_02';
    public const QU_FIXTURES_03 = 'qu_fixtures_03';
    public const QU_FIXTURES_04 = 'qu_fixtures_04';
    public const QU_FIXTURES_05 = 'qu_fixtures_05';
    public const QU_FIXTURES_06 = 'qu_fixtures_06';

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $users = [
            $this->getReference(UserFixture::USER_FIXTURE_01),
            $this->getReference(UserFixture::USER_FIXTURE_02),
            $this->getReference(UserFixture::USER_FIXTURE_03),
            $this->getReference(UserFixture::USER_FIXTURE_04),
        ];
        $queues = [
            $this->getReference(QueueFixtures::QUF_01),
            $this->getReference(QueueFixtures::QUF_02),
            $this->getReference(QueueFixtures::QUF_03),
        ];

        $fixturesData = [
            ['user' => $users[0], 'queue' => $queues[2], 'ref' => self::QU_FIXTURES_01],
            ['user' => $users[0], 'queue' => $queues[3], 'ref' => self::QU_FIXTURES_02],
            ['user' => $users[1], 'queue' => $queues[1], 'ref' => self::QU_FIXTURES_03],
            ['user' => $users[1], 'queue' => $queues[2], 'ref' => self::QU_FIXTURES_04],
            ['user' => $users[2], 'queue' => $queues[1], 'ref' => self::QU_FIXTURES_05],
            ['user' => $users[2], 'queue' => $queues[2], 'ref' => self::QU_FIXTURES_06],
        ];

        foreach ($fixturesData as $item) {
            $fixtureItem = new QueueUser();
            $fixtureItem
                ->setUser($item['name'])
                ->setQueue($item['queue']);
            $this->addReference($item['ref'], $fixtureItem);
            $manager->persist($fixtureItem);
            unset($fixtureItem);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixture::class,
            QueueFixtures::class
        ];
    }
}