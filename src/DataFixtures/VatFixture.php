<?php

namespace App\DataFixtures;

use App\Entity\Vat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VatFixture extends Fixture
{
    public const NO_VAT = 'no-vat';
    public const VAT_05 = 'vat-05';
    public const VAT_10 = 'vat-10';
    public const VAT_15 = 'vat-15';
    public const VAT_20 = 'vat-20';
    public const VAT_21 = 'vat-21';
    public const VAT_22 = 'vat-22';

    public function load(ObjectManager $manager): void
    {
        $vats = [
            ['name' => 'No VAT', 'percent' => 0, 'is-disable' => true, 'ref' => self::NO_VAT],
            ['name' => 'VAT 5%', 'percent' => 5, 'is-disable' => false, 'ref' => self::VAT_05],
            ['name' => 'VAT 10%', 'percent' => 10, 'is-disable' => false, 'ref' => self::VAT_10],
            ['name' => 'VAT 15%', 'percent' => 15, 'is-disable' => false, 'ref' => self::VAT_15],
            ['name' => 'VAT 20%', 'percent' => 20, 'is-disable' => false, 'ref' => self::VAT_20],
            ['name' => 'VAT 21%', 'percent' => 21, 'is-disable' => false, 'ref' => self::VAT_21],
            ['name' => 'VAT 22%', 'percent' => 22, 'is-disable' => false, 'ref' => self::VAT_22],
        ];

        for ($i = 0; $i < count($vats); $i++) {
            $vatFixture = new Vat();
            $vatFixture->setName($vats[$i]['name'])
                ->setPercent($vats[$i]['percent'])
                ->setIsDefault($vats[$i]['is-disable']);
            $this->addReference($vats[$i]['ref'], $vatFixture);
            $manager->persist($vatFixture);
        }

        $manager->flush();
    }
}
