<?php


namespace App\DataFixtures;


use App\Entity\Tariff;
use App\Entity\Vat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TariffFixture extends Fixture implements DependentFixtureInterface
{

    public const CZK_299 = 'czk-299';
    public const CZK_399 = 'czk-399';
    public const CZK_450 = 'czk-450';
    public const CZK_499 = 'czk-499';
    public const CZK_600 = 'czk-600';
    public const CZK_699 = 'czk-699';
    public const CZK_999 = 'czk-999';

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

        $tariff299 = new Tariff();
        $tariff299->setPrice(29900)
            ->setName('299 CZK per hour')
            ->setVat($vatZero);
        $manager->persist($tariff299);
        $this->setReference(self::CZK_299, $tariff299);

        $tariff399 = new Tariff();
        $tariff399->setPrice(39900)
            ->setName('399 CZK per hour')
            ->setVat($vatZero);
        $manager->persist($tariff399);
        $this->setReference(self::CZK_399, $tariff399);

        $tariff450 = new Tariff();
        $tariff450->setPrice(45000)
            ->setName('450 CZK per hour')
            ->setVat($vatZero);
        $manager->persist($tariff450);
        $this->setReference(self::CZK_450, $tariff450);

        $tariff499 = new Tariff();
        $tariff499->setPrice(49900)
            ->setName('499 CZK per hour')
            ->setVat($vatZero);
        $manager->persist($tariff499);
        $this->setReference(self::CZK_499, $tariff499);

        $tariff600 = new Tariff();
        $tariff600->setPrice(60000)
            ->setName('600 CZK per hour')
            ->setVat($vatZero);
        $manager->persist($tariff600);
        $this->setReference(self::CZK_600, $tariff600);

        $tariff699 = new Tariff();
        $tariff699->setPrice(69900)
            ->setName('699 CZK per hour')
            ->setVat($vatZero);
        $manager->persist($tariff699);
        $this->setReference(self::CZK_699, $tariff699);

        $tariff999 = new Tariff();
        $tariff999->setPrice(99900)
            ->setName('999 CZK per hour')
            ->setVat($vatZero);
        $manager->persist($tariff999);
        $this->setReference(self::CZK_999, $tariff999);

        $manager->flush();
    }
}