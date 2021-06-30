<?php

namespace App\DataFixtures;

use App\Entity\Vat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VatFixture extends Fixture
{
    public const NO_VAT = 'no-vat';
    public const VAT_21 = 'vat-21';

    public function load(ObjectManager $manager): void
    {
        $vatNo = new Vat();
        $vatNo->setName("Bez DPH")
            ->setMultiplier(100)
            ->setPercent(0)
            ->setIsDefault(TRUE);

        $vat21 = new Vat();
        $vat21->setName("DPH 21%")
            ->setMultiplier(121)
            ->setPercent(21)
            ->setIsDefault(FALSE);

        $this->addReference(self::NO_VAT, $vatNo);
        $this->addReference(self::VAT_21, $vat21);

        $manager->persist($vatNo);
        $manager->persist($vat21);

        $manager->flush();
    }
}
