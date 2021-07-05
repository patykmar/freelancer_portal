<?php


namespace App\DataFixtures;


use App\Entity\Company;
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

    /**
     * @param ObjectManager $manager
     * @return mixed
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $paymentTypeCache = $this->getReference(PaymentTypeFixture::PT_HOTOVE);
        $paymentTypeBank = $this->getReference(PaymentTypeFixture::PT_PREVOD);

        /** @var Company $countryCz */
        $companyPatykMartin = $this->getReference(CompanyFixture::COMPANY_PATYK_MARTIN);
        $companyVodafone = $this->getReference(CompanyFixture::COMPANY_VODAFONE_CZ);
        $companyTmcz = $this->getReference(CompanyFixture::COMPANY_TMOBILE_CZ);
        $companyO2cz = $this->getReference(CompanyFixture::COMPANY_O2_CZ);

        $userPatykmar = $this->getReference(UserFixture::USER_ADMIN_REFERENCE);
        $userUser = $this->getReference(UserFixture::USER_USER_REFERENCE);

        $invoice1 = new Invoice();
        $invoice1->setPaymentType($paymentTypeBank)
            ->setSupplier($companyPatykMartin)
            ->setSubscriber($companyVodafone)
            ->setPaymentType($paymentTypeBank)
            ->setDue(14)
            ->setPaymentDay(new DateTime("+" . rand(5, 20) . " days"))
            ->setUserCreated($userPatykmar)
            ->setVs('2021000010')
            ->setKs('309');
        $this->setReference(self::INVOICE_01, $invoice1);

        $invoice2 = new Invoice();
        $invoice2->setPaymentType($paymentTypeBank)
            ->setSupplier($companyPatykMartin)
            ->setSubscriber($companyTmcz)
            ->setPaymentType($paymentTypeBank)
            ->setDue(14)
            ->setPaymentDay(new DateTime("+" . rand(5, 20) . " days"))
            ->setUserCreated($userPatykmar)
            ->setVs('2021000011')
            ->setKs('309');
        $this->setReference(self::INVOICE_02, $invoice2);

        $invoice3 = new Invoice();
        $invoice3->setPaymentType($paymentTypeBank)
            ->setSupplier($companyPatykMartin)
            ->setSubscriber($companyO2cz)
            ->setPaymentType($paymentTypeBank)
            ->setDue(14)
            ->setPaymentDay(new DateTime("+" . rand(5, 20) . " days"))
            ->setUserCreated($userPatykmar)
            ->setVs('2021000012')
            ->setKs('309');
        $this->setReference(self::INVOICE_03, $invoice3);

        $invoice4 = new Invoice();
        $invoice4->setPaymentType($paymentTypeBank)
            ->setSupplier($companyPatykMartin)
            ->setSubscriber($companyO2cz)
            ->setPaymentType($paymentTypeCache)
            ->setDue(14)
            ->setPaymentDay(new DateTime("+" . rand(5, 20) . " days"))
            ->setUserCreated($userUser)
            ->setVs('2021000013')
            ->setKs('309');
        $this->setReference(self::INVOICE_04, $invoice4);

        $invoice5 = new Invoice();
        $invoice5->setPaymentType($paymentTypeBank)
            ->setSupplier($companyPatykMartin)
            ->setSubscriber($companyO2cz)
            ->setPaymentType($paymentTypeCache)
            ->setDue(14)
            ->setPaymentDay(new DateTime("+" . rand(5, 20) . " days"))
            ->setUserCreated($userUser)
            ->setVs('2021000014')
            ->setKs('309');
        $this->setReference(self::INVOICE_05, $invoice5);

        $manager->persist($invoice1);
        $manager->persist($invoice2);
        $manager->persist($invoice3);
        $manager->persist($invoice4);
        $manager->persist($invoice5);

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