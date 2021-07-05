<?php

namespace App\DataFixtures;

use App\Entity\PaymentType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PaymentTypeFixture extends Fixture
{

    public const PT_PREVOD = 'pt-prevod';
    public const PT_HOTOVE = 'pt-hotove';


    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $paymentTypes = [
            ['name' => 'převodním příkazem', 'isDefault' => true, 'ref' => self::PT_PREVOD],
            ['name' => 'hotově', 'isDefault' => false, 'ref' => self::PT_HOTOVE],
        ];

        for ($i = 0; $i < count($paymentTypes); $i++) {
            $paymentFixture = new PaymentType();
            $paymentFixture
                ->setName($paymentTypes[$i]['name'])
                ->setIsDefault($paymentTypes[$i]['isDefault']);
            $this->addReference($paymentTypes[$i]['ref'], $paymentFixture);
            $manager->persist($paymentFixture);
            unset($paymentFixture);
        }


        $manager->flush();
    }
}
