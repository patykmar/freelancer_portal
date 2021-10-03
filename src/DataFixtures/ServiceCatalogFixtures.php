<?php

namespace App\DataFixtures;

use App\Entity\ServiceCatalog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ServiceCatalogFixtures extends Fixture implements DependentFixtureInterface
{
    public const SRVCTL_01 = 'srvctl_01';
    public const SRVCTL_02 = 'srvctl_02';
    public const SRVCTL_03 = 'srvctl_03';
    public const SRVCTL_04 = 'srvctl_04';
    public const SRVCTL_05 = 'srvctl_05';
    public const SRVCTL_06 = 'srvctl_06';
    public const SRVCTL_07 = 'srvctl_07';
    public const SRVCTL_08 = 'srvctl_08';
    public const SRVCTL_09 = 'srvctl_09';
    public const SRVCTL_10 = 'srvctl_10';
    public const SRVCTL_11 = 'srvctl_11';
    public const SRVCTL_12 = 'srvctl_12';
    public const SRVCTL_13 = 'srvctl_13';
    public const SRVCTL_14 = 'srvctl_14';
    public const SRVCTL_15 = 'srvctl_15';
    public const SRVCTL_16 = 'srvctl_16';
    public const SRVCTL_17 = 'srvctl_17';
    public const SRVCTL_18 = 'srvctl_18';
    public const SRVCTL_19 = 'srvctl_19';
    public const SRVCTL_20 = 'srvctl_20';
    public const SRVCTL_21 = 'srvctl_21';
    public const SRVCTL_22 = 'srvctl_22';
    public const SRVCTL_23 = 'srvctl_23';
    public const SRVCTL_24 = 'srvctl_24';
    public const SRVCTL_25 = 'srvctl_25';

    private array $fixturesData = [
        ['name' => 'Web alarm', 'description' => 'Web alarm', 'price' => 10000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_01],
        ['name' => 'HTML - create new page', 'description' => 'Create new page', 'price' => 30000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_02],
        ['name' => 'HTML - modify page', 'description' => 'Modify web page', 'price' => 19900, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_03],
        ['name' => 'HTML+CSS Develop web template - only HTML CSS', 'description' => 'HTML+CSS Develop web template - only HTML CSS', 'price' => 100000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_04],
        ['name' => 'HTML+CSS Develop web template - PHP framework', 'description' => 'HTML+CSS Develop web template - PHP framework', 'price' => 200000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_05],
        ['name' => 'HTML+CSS Develop web template - CMS Drupal', 'description' => 'HTML+CSS Develop web template - CMS Drupal', 'price' => 350000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_06],
        ['name' => 'CSS - Modify cascade style', 'description' => 'CSS - Modify cascade style', 'price' => 25000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_07],
        ['name' => 'PHP - New app-function develop by 3rd party', 'description' => 'PHP - New app-function develop by 3rd party', 'price' => 100000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_08],
        ['name' => 'PHP - New app-function', 'description' => 'PHP - New app-function', 'price' => 60000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_09],
        ['name' => 'Drupal - update modules', 'description' => 'Drupal - update modules', 'price' => 29900, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_10],
        ['name' => 'Drupal - new instance', 'description' => 'Drupal - new instance', 'price' => 150000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_11],
        ['name' => 'Drupal - create type of content', 'description' => 'Drupal - create type of content', 'price' => 70000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_12],
        ['name' => 'PrestaShop - new instance', 'description' => 'PrestaShop - new instance', 'price' => 150000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_13],
        ['name' => 'Piwic - new instance', 'description' => 'Piwic - new instance', 'price' => 100000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_14],
        ['name' => 'Piwic - update', 'description' => 'Piwic - update', 'price' => 30000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_15],
        ['name' => 'Web application - relate with web analytics', 'description' => 'Web application - relate with web analytics', 'price' => 50000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_16],
        ['name' => 'Drupal - install plug-in', 'description' => 'Drupal - install plug-in', 'price' => 30000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_17],
        ['name' => 'Drupal - deploying content', 'description' => 'Drupal - deploying content', 'price' => 30000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_18],
        ['name' => 'Drupal - configure plug-inu', 'description' => 'Drupal - configure plug-inu', 'price' => 40000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_19],
        ['name' => 'Drupal - development plug-in', 'description' => 'Drupal - development plug-in', 'price' => 300000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_20],
        ['name' => 'PHP - modify function of application develop by 3rd party', 'description' => 'PHP - modify function of application develop by 3rd party', 'price' => 50000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_21],
        ['name' => 'Web-hosting create instance', 'description' => 'Webhosting vytvoření nového hostingu', 'price' => 50000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_22],
        ['name' => 'Drupal - migration to different web-hosting', 'description' => 'Drupal - migration to different web-hosting', 'price' => 75000, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_23],
        ['name' => 'Database migration', 'description' => 'Database migration', 'price' => 49900, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_24],
        ['name' => 'Web-hosting configuration', 'description' => 'Web-hosting configuration', 'price' => 19900, 'estimate_time_delivery' => 5184000, 'estimate_time_reaction' => 2592000, 'isDisabled' => false, 'ref' => self::SRVCTL_25],
    ];

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
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

        foreach ($this->fixturesData as $item) {
            $fixtureItem = new ServiceCatalog();
            $fixtureItem
                ->setName($item['name'])
                ->setDescription($item['description'])
                ->setPrice($item['price'])
                ->setEstimateTimeDelivery($item['estimate_time_delivery'])
                ->setEstimateTimeReaction($item['estimate_time_reaction'])
                ->setVat($vats[0])
                ->setIsDisable($item['isDisabled']);
            $this->addReference($item['ref'], $fixtureItem);
            $manager->persist($fixtureItem);
            unset($fixtureItem);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            VatFixture::class,
        ];
    }
}