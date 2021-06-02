<?php


namespace App\DataFixtures;


use App\Entity\Company;
use App\Entity\Invoice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use DateTime;

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
     */
    public function load(ObjectManager $manager): void
    {
        $paymentTypeCache = $this->getReference(PaymentTypeFixture::PT_HOTOVE);
        $paymentTypeBank = $this->getReference(PaymentTypeFixture::PT_PREVOD);

        /** @var Company $countryCz */
        $companyPatykMartin = $this->getReference(CompanyFixture::COMPANY_PATYK_MARTIN);
        $companyPatykdesign = $this->getReference(CompanyFixture::COMPANY_PATYKDESIGN);
        $companyVahyOpava = $this->getReference(CompanyFixture::COMPANY_VAHYOPAVA);
        $companySedko = $this->getReference(CompanyFixture::COMPANY_SEDKO);

        $userPatykmar = $this->getReference(UserFixture::USER_ADMIN_REFERENCE);
        $userUser = $this->getReference(UserFixture::USER_USER_REFERENCE);

        $invoice1 = new Invoice();
        $invoice1->setPaymentType($paymentTypeBank)
            ->setSupplier($companyPatykMartin)
            ->setSubscriber($companyPatykdesign)
            ->setPaymentType($paymentTypeBank)
            ->setDue(14)
            ->setInvoiceCreated(new DateTime())
            ->setDueDate(new DateTime("+14 days"))
            ->setPaymentDay(new DateTime("+10 days"))
            ->setUserCreated($userPatykmar)
            ->setVs('2021000010')
            ->setKs('309');

        $this->setReference(self::INVOICE_01, $invoice1);

        $invoice2 = new Invoice();
        $invoice2->setPaymentType($paymentTypeBank)
            ->setSupplier($companyPatykMartin)
            ->setSubscriber($companyVahyOpava)
            ->setPaymentType($paymentTypeBank)
            ->setDue(14)
            ->setInvoiceCreated(new DateTime())
            ->setDueDate(new DateTime("+14 days"))
            ->setPaymentDay(new DateTime("+1 days"))
            ->setUserCreated($userPatykmar)
            ->setVs('2021000011')
            ->setKs('309');

        $this->setReference(self::INVOICE_02, $invoice2);

        $invoice3 = new Invoice();
        $invoice3->setPaymentType($paymentTypeBank)
            ->setSupplier($companyPatykMartin)
            ->setSubscriber($companySedko)
            ->setPaymentType($paymentTypeBank)
            ->setDue(14)
            ->setInvoiceCreated(new DateTime())
            ->setDueDate(new DateTime("+14 days"))
            ->setPaymentDay(new DateTime("+22 days"))
            ->setUserCreated($userPatykmar)
            ->setVs('2021000012')
            ->setKs('309');

        $this->setReference(self::INVOICE_03, $invoice3);

        $invoice4 = new Invoice();
        $invoice4->setPaymentType($paymentTypeBank)
            ->setSupplier($companyPatykMartin)
            ->setSubscriber($companySedko)
            ->setPaymentType($paymentTypeCache)
            ->setDue(14)
            ->setInvoiceCreated(new DateTime())
            ->setDueDate(new DateTime("+14 days"))
            ->setPaymentDay(new DateTime("+22 days"))
            ->setUserCreated($userUser)
            ->setVs('2021000013')
            ->setKs('309');

        $this->setReference(self::INVOICE_04, $invoice4);

        $invoice5 = new Invoice();
        $invoice5->setPaymentType($paymentTypeBank)
            ->setSupplier($companyPatykMartin)
            ->setSubscriber($companySedko)
            ->setPaymentType($paymentTypeCache)
            ->setDue(14)
            ->setInvoiceCreated(new DateTime())
            ->setDueDate(new DateTime("+14 days"))
            ->setPaymentDay(new DateTime("+22 days"))
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