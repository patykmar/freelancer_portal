<?php


namespace App\DataFixtures;


use App\Entity\Invoice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use DateTime;
use Exception;

class InvoiceFixtures extends Fixture implements DependentFixtureInterface
{
    public const INVOICE_01 = 'invoice-01';
    public const INVOICE_02 = 'invoice-02';
    public const INVOICE_03 = 'invoice-03';
    public const INVOICE_04 = 'invoice-04';
    public const INVOICE_05 = 'invoice-05';
    public const INVOICE_06 = 'invoice-06';
    public const INVOICE_07 = 'invoice-07';
    public const INVOICE_08 = 'invoice-08';
    public const INVOICE_09 = 'invoice-09';
    public const INVOICE_10 = 'invoice-10';
    public const INVOICE_11 = 'invoice-11';
    public const INVOICE_12 = 'invoice-12';
    public const INVOICE_13 = 'invoice-13';
    public const INVOICE_14 = 'invoice-14';
    public const INVOICE_15 = 'invoice-15';
    public const INVOICE_16 = 'invoice-16';
    public const INVOICE_17 = 'invoice-17';
    public const INVOICE_18 = 'invoice-18';
    public const INVOICE_19 = 'invoice-19';
    public const INVOICE_20 = 'invoice-20';
    public const INVOICE_21 = 'invoice-21';
    public const INVOICE_22 = 'invoice-22';
    public const INVOICE_23 = 'invoice-23';
    public const INVOICE_24 = 'invoice-24';
    public const INVOICE_25 = 'invoice-25';
    public const INVOICE_26 = 'invoice-26';
    public const INVOICE_27 = 'invoice-27';
    public const INVOICE_28 = 'invoice-28';
    public const INVOICE_29 = 'invoice-29';
    public const INVOICE_30 = 'invoice-30';


    /**
     * @param ObjectManager $manager
     * @return mixed
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $references = [
            self::INVOICE_01, self::INVOICE_02, self::INVOICE_03, self::INVOICE_04, self::INVOICE_05,
            self::INVOICE_06, self::INVOICE_07, self::INVOICE_08, self::INVOICE_09, self::INVOICE_10,
            self::INVOICE_11, self::INVOICE_12, self::INVOICE_13, self::INVOICE_14, self::INVOICE_15,
            self::INVOICE_16, self::INVOICE_17, self::INVOICE_18, self::INVOICE_19, self::INVOICE_20,
            self::INVOICE_21, self::INVOICE_22, self::INVOICE_23, self::INVOICE_24, self::INVOICE_25,
            self::INVOICE_26, self::INVOICE_27, self::INVOICE_28, self::INVOICE_29, self::INVOICE_30,
        ];

        $paymentTypes = [
            $this->getReference(PaymentTypeFixture::PT_HOTOVE),
            $this->getReference(PaymentTypeFixture::PT_PREVOD),
        ];

        $companies = [
            $this->getReference(CompanyFixture::COMPANY_PATYK_MARTIN),
            $this->getReference(CompanyFixture::COMPANY_VODAFONE_CZ),
            $this->getReference(CompanyFixture::COMPANY_TMOBILE_CZ),
            $this->getReference(CompanyFixture::COMPANY_O2_CZ),
            $this->getReference(CompanyFixture::COMPANY_RDRYMAROV),
            $this->getReference(CompanyFixture::COMPANY_CETIN_CZ),
            $this->getReference(CompanyFixture::COMPANY_MAXXNET),
            $this->getReference(CompanyFixture::COMPANY_CEZ),
            $this->getReference(CompanyFixture::INNOVATION_ADVISORS),
            $this->getReference(CompanyFixture::GAPPAY_SRO),
            $this->getReference(CompanyFixture::CGE_SRO),
            $this->getReference(CompanyFixture::COMPANY_SKODA),
        ];

        $users = [
            $this->getReference(UserFixture::USER_FIXTURE_01),
            $this->getReference(UserFixture::USER_FIXTURE_02),
        ];

        for ($i = 0; $i < count($references); $i++) {
            $invoiceFixtures = new Invoice();
            $invoiceFixtures
                ->setPaymentType($paymentTypes[rand(0, count($paymentTypes) - 1)])
                ->setSupplier($companies[0])
                ->setSubscriber($companies[rand(1, count($companies) - 1)])
                ->setDue(14)
                ->setPaymentDay(new DateTime("+" . rand(5, 20) . " days"))
                ->setUserCreated($users[rand(0, count($users) - 1)]);
            $this->setReference($references[$i], $invoiceFixtures);
            $manager->persist($invoiceFixtures);
            unset($invoiceFixtures);
        }

        $manager->flush();
    }

    // to which fixtures is depending, they load earlier
    public function getDependencies(): array
    {
        return array(
            CompanyFixture::class,
            PaymentTypeFixture::class,
            UserFixture::class,
        );
    }

}