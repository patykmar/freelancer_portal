<?php


namespace App\DataFixtures;


use App\Entity\Tariff;
use App\Entity\Vat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TariffFixture extends Fixture implements DependentFixtureInterface
{

    public const CZK_600 = 'czk-600';
    public const CZK_450 = 'czk-450';

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
        $this->setReference(self::CZK_600, $tariff600);

        $tariff450 = new Tariff();
        $tariff450->setPrice(450)
            ->setName('450 CZK per hour')
            ->setVat($vatZero);
        $this->setReference(self::CZK_450, $tariff450);

        $manager->persist($tariff600);
        $manager->persist($tariff450);

        $manager->flush();
    }
}