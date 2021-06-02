<?php


namespace App\DataFixtures;


use App\Entity\WorkInventory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use DateTime;

class WorkInventoryFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            TariffFixture::class,
        ];
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $companyInnovation = $this->getReference(CompanyFixture::INNOVATION_ADVISORS);
        $companyCge = $this->getReference(CompanyFixture::CGE_SRO);
        $companyMaxxnet = $this->getReference(CompanyFixture::COMPANY_MAXXNET);

        $userAdmin = $this->getReference(UserFixture::USER_ADMIN_REFERENCE);
        $userUser = $this->getReference(UserFixture::USER_USER_REFERENCE);

        $tariff600 = $this->getReference(TariffFixture::CZK_600);
        $tariff450 = $this->getReference(TariffFixture::CZK_450);

        $wif01 = new WorkInventory();
        $wif01->setUser($userAdmin)
            ->setCompany($companyMaxxnet)
            ->setTariff($tariff450)
            ->setDescribe('Zmena routingu na lokalitě silo. Testováno prepojeni na zálohu.')
            ->setWorkStart(new DateTime('2021-04-23 09:30:00'))
            ->setWorkEnd(new DateTime('2021-04-23 10:40:00'));
        $manager->persist($wif01);

        $wif02 = new WorkInventory();
        $wif02->setUser($userAdmin)
            ->setCompany($companyMaxxnet)
            ->setTariff($tariff450)
            ->setDescribe('Konzultace jak zapojit lokalitu silo tak, aby byla zajistena vysoka dostupnost sluzeb')
            ->setWorkStart(new DateTime('2021-05-20 09:00:00'))
            ->setWorkEnd(new DateTime('2021-05-20 16:00:00'));
        $manager->persist($wif02);

        $wif03 = new WorkInventory();
        $wif03->setUser($userAdmin)
            ->setCompany($companyMaxxnet)
            ->setTariff($tariff450)
            ->setDescribe('Predstaveni navrhu na predelani lokality silo')
            ->setWorkStart(new DateTime('2021-05-26 15:30:00'))
            ->setWorkEnd(new DateTime('2021-05-26 18:00:00'));
        $manager->persist($wif03);

        $wif04 = new WorkInventory();
        $wif04->setUser($userAdmin)
            ->setCompany($companyMaxxnet)
            ->setTariff($tariff450)
            ->setDescribe('LLD L2 diagram zapojeni lokality silo')
            ->setWorkStart(new DateTime('2021-05-27 12:30:00'))
            ->setWorkEnd(new DateTime('2021-05-27 14:30:00'));
        $manager->persist($wif04);

        $wif05 = new WorkInventory();
        $wif05->setUser($userAdmin)
            ->setCompany($companyMaxxnet)
            ->setTariff($tariff450)
            ->setDescribe('LLD L2 vytvoreni pracovni verze navrhu zapojeni lokality silo')
            ->setWorkStart(new DateTime('2021-05-28 09:30:00'))
            ->setWorkEnd(new DateTime('2021-05-28 12:30:00'));
        $manager->persist($wif05);

        $wif11 = new WorkInventory();
        $wif11->setUser($userUser)
            ->setCompany($companyCge)
            ->setTariff($tariff600)
            ->setDescribe('cge-energy.cz - Zracovani pripominek k webu cge-energy.cz z data 25.3.2021')
            ->setWorkStart(new DateTime('2021-03-29 14:10:00'))
            ->setWorkEnd(new DateTime('2021-03-29 16:50:00'));
        $manager->persist($wif11);

        $wif12 = new WorkInventory();
        $wif12->setUser($userUser)
            ->setCompany($companyCge)
            ->setTariff($tariff600)
            ->setDescribe('cge-energy.cz - Zracovani zmena adresy mapy v kontaktech, uprava sirky stranky, instalace pluginu pro tvorbu grafu a naplneni grafu daty')
            ->setWorkStart(new DateTime('2021-03-31 11:30:00'))
            ->setWorkEnd(new DateTime('2021-03-31 13:20:00'));
        $manager->persist($wif12);

        $wif13 = new WorkInventory();
        $wif13->setUser($userUser)
            ->setCompany($companyCge)
            ->setTariff($tariff600)
            ->setDescribe('cge-energy.cz - Predelani hlavni stranky, zmena loga solidsun, vytvoreni navrhu vzhledu stranek investice...')
            ->setWorkStart(new DateTime('2021-03-31 20:00:00'))
            ->setWorkEnd(new DateTime('2021-03-31 22:40:00'));
        $manager->persist($wif13);

        $wif14 = new WorkInventory();
        $wif14->setUser($userUser)
            ->setCompany($companyCge)
            ->setTariff($tariff600)
            ->setDescribe('cpg-power.com - Aktualizace CMS drupal na verzi 7.79')
            ->setWorkStart(new DateTime('2021-04-08 10:00:00'))
            ->setWorkEnd(new DateTime('2021-04-08 10:20:00'));
        $manager->persist($wif14);

        $wif15 = new WorkInventory();
        $wif15->setUser($userUser)
            ->setCompany($companyCge)
            ->setTariff($tariff600)
            ->setDescribe('cpg-power.com - zpracovano, uprava obsahu na webu')
            ->setWorkStart(new DateTime('2021-04-08 11:00:00'))
            ->setWorkEnd(new DateTime('2021-04-08 13:40:00'));
        $manager->persist($wif15);

        $wif16 = new WorkInventory();
        $wif16->setUser($userUser)
            ->setCompany($companyCge)
            ->setTariff($tariff600)
            ->setDescribe('cpg-power.com - zpracovani pripominek')
            ->setWorkStart(new DateTime('2021-04-08 20:00:00'))
            ->setWorkEnd(new DateTime('2021-04-08 22:40:00'));
        $manager->persist($wif16);

        //TODO: add more work inventories from company Innovation Advisors s.r.o. and Biopool

        $manager->flush();
    }
}