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

        $vat5 = new Vat();
        $vat5->setName("DPH 5%")
            ->setMultiplier(105)
            ->setPercent(5)
            ->setIsDefault(FALSE);

        $vat10 = new Vat();
        $vat10->setName("DPH 10%")
            ->setMultiplier(110)
            ->setPercent(10)
            ->setIsDefault(FALSE);

        $vat15 = new Vat();
        $vat15->setName("DPH 15%")
            ->setMultiplier(115)
            ->setPercent(15)
            ->setIsDefault(FALSE);

        $vat20 = new Vat();
        $vat20->setName("DPH 20%")
            ->setMultiplier(120)
            ->setPercent(20)
            ->setIsDefault(FALSE);

        $vat21 = new Vat();
        $vat21->setName("DPH 21%")
            ->setMultiplier(121)
            ->setPercent(21)
            ->setIsDefault(FALSE);

        $vat22 = new Vat();
        $vat22->setName("DPH 22%")
            ->setMultiplier(122)
            ->setPercent(22)
            ->setIsDefault(FALSE);

        $this->addReference(self::NO_VAT, $vatNo);
        $this->addReference(self::VAT_21, $vat21);

        $manager->persist($vatNo);
        $manager->persist($vat21);

        $manager->flush();
    }
}
