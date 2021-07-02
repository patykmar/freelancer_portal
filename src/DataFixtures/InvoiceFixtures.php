<?php


namespace App\DataFixtures;


use App\Entity\Company;
use App\Entity\Invoice;
use App\Entity\PaymentType;
use App\Entity\User;
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
        /** @var PaymentType $paymentTypeCache */
        $paymentTypeCache = $this->getReference(PaymentTypeFixture::PT_HOTOVE);
        /** @var PaymentType $paymentTypeBank */
        $paymentTypeBank = $this->getReference(PaymentTypeFixture::PT_PREVOD);

        /** @var Company $companyPatykMartin */
        $companyPatykMartin = $this->getReference(CompanyFixture::COMPANY_PATYK_MARTIN);
        /** @var Company $companyVodafone */
        $companyVodafone = $this->getReference(CompanyFixture::COMPANY_VODAFONE_CZ);
        /** @var Company $companyTmcz */
        $companyTmcz = $this->getReference(CompanyFixture::COMPANY_TMOBILE_CZ);
        /** @var Company $companyO2cz */
        $companyO2cz = $this->getReference(CompanyFixture::COMPANY_O2_CZ);

        /** @var User $userPatykmar */
        $userPatykmar = $this->getReference(UserFixture::USER_ADMIN_REFERENCE);
        /** @var User $userUser */
        $userUser = $this->getReference(UserFixture::USER_USER_REFERENCE);

        $invoice1 = new Invoice();
        $invoice1->setPaymentType($paymentTypeBank)
            ->setSupplier($companyPatykMartin)
            ->setSubscriber($companyVodafone)
            ->setPaymentType($paymentTypeBank)
            ->setDue(14)
            ->setPaymentDay(new DateTime("+".rand(5,20)." days"))
            ->setUserCreated($userPatykmar);
        $this->setReference(self::INVOICE_01, $invoice1);
        $manager->persist($invoice1);

        $invoice2 = new Invoice();
        $invoice2->setPaymentType($paymentTypeBank)
            ->setSupplier($companyPatykMartin)
            ->setSubscriber($companyTmcz)
            ->setPaymentType($paymentTypeBank)
            ->setDue(14)
            ->setPaymentDay(new DateTime("+".rand(5,20)." days"))
            ->setUserCreated($userPatykmar);
        $this->setReference(self::INVOICE_02, $invoice2);
        $manager->persist($invoice2);

        $invoice3 = new Invoice();
        $invoice3->setPaymentType($paymentTypeBank)
            ->setSupplier($companyPatykMartin)
            ->setSubscriber($companyO2cz)
            ->setPaymentType($paymentTypeBank)
            ->setDue(14)
            ->setPaymentDay(new DateTime("+".rand(5,20)." days"))
            ->setUserCreated($userPatykmar);
        $this->setReference(self::INVOICE_03, $invoice3);
        $manager->persist($invoice3);

        $invoice4 = new Invoice();
        $invoice4->setPaymentType($paymentTypeBank)
            ->setSupplier($companyPatykMartin)
            ->setSubscriber($companyO2cz)
            ->setPaymentType($paymentTypeCache)
            ->setDue(14)
            ->setPaymentDay(new DateTime("+".rand(5,20)." days"))
            ->setUserCreated($userUser);
        $this->setReference(self::INVOICE_04, $invoice4);
        $manager->persist($invoice4);

        $invoice5 = new Invoice();
        $invoice5->setPaymentType($paymentTypeBank)
            ->setSupplier($companyPatykMartin)
            ->setSubscriber($companyO2cz)
            ->setPaymentType($paymentTypeCache)
            ->setDue(14)
            ->setPaymentDay(new DateTime("+".rand(5,20)." days"))
            ->setUserCreated($userUser);
        $this->setReference(self::INVOICE_05, $invoice5);
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