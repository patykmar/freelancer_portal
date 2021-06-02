<?php


namespace App\DataFixtures;


use App\Entity\Tariff;
use App\Entity\Vat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TariffFixture extends Fixture implements DependentFixtureInterface
{

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            VatFixture::class,
        ];
    }

    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        /** @var Vat $vatZero */
        $vatZero = $this->getReference(VatFixture::NO_VAT);

        $tariff600 = new Tariff();
        $tariff600->setPrice(600)
            ->setName('600 CZK per hour')
            ->setVat($vatZero);

        $tariff600 = new Tariff();
        $tariff600->setPrice(450)
            ->setName('450 CZK per hour')
            ->setVat($vatZero);
    }
}