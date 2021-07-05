<?php


namespace App\DataFixtures;


use App\Entity\Tariff;
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
     */
    public function load(ObjectManager $manager): void
    {
        $vats = [
            $this->getReference(VatFixture::NO_VAT),
            $this->getReference(VatFixture::VAT_05),
            $this->getReference(VatFixture::VAT_10),
            $this->getReference(VatFixture::VAT_15),
            $this->getReference(VatFixture::VAT_20),
            $this->getReference(VatFixture::VAT_21),
            $this->getReference(VatFixture::VAT_21),
        ];

        $tariffs = [
            ['name' => '299 CZK per hour', 'price' => 29900, 'ref' => self::CZK_299],
            ['name' => '399 CZK per hour', 'price' => 39900, 'ref' => self::CZK_399],
            ['name' => '450 CZK per hour', 'price' => 45000, 'ref' => self::CZK_450],
            ['name' => '499 CZK per hour', 'price' => 49900, 'ref' => self::CZK_499],
            ['name' => '600 CZK per hour', 'price' => 60000, 'ref' => self::CZK_600],
            ['name' => '699 CZK per hour', 'price' => 69900, 'ref' => self::CZK_699],
            ['name' => '999 CZK per hour', 'price' => 99900, 'ref' => self::CZK_999],
        ];

        for ($i = 0; $i < count($tariffs); $i++) {
            $tariff = new Tariff();
            $tariff
                ->setName($tariffs[$i]['name'])
                ->setPrice($tariffs[$i]['price'])
                ->setVat($vats[rand(0, count($vats) - 1)]);
            $this->setReference($tariffs[$i]['ref'], $tariff);
            $manager->persist($tariff);
            unset($tariff);
        }

        $manager->flush();
    }
}