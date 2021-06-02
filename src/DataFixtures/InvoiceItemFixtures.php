<?php


namespace App\DataFixtures;


use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class InvoiceItemFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @return mixed
     */
    public function getDependencies(): array
    {
        return array(
            InvoiceFixtures::class,
        );
    }

    /**
     * @param ObjectManager $manager
     * @return mixed
     */
    public function load(ObjectManager $manager): void
    {
        /** @var Invoice $invoice01 */
        $invoice01 = $this->getReference(InvoiceFixtures::INVOICE_01);
        /** @var Invoice $invoice02 */
        $invoice02 = $this->getReference(InvoiceFixtures::INVOICE_02);
        /** @var Invoice $invoice03 */
        $invoice03 = $this->getReference(InvoiceFixtures::INVOICE_03);
        /** @var Invoice $invoice04 */
        $invoice04 = $this->getReference(InvoiceFixtures::INVOICE_04);
        /** @var Invoice $invoice05 */
        $invoice05 = $this->getReference(InvoiceFixtures::INVOICE_05);

        $vat0 = $this->getReference(VatFixture::NO_VAT);
        $vat21 = $this->getReference(VatFixture::VAT_21);

        $invoiceItem11 = new InvoiceItem();
        $invoiceItem11
            ->setInvoice($invoice01)
            ->setVat($vat0)
            ->setName('Lorem ipsum dolor sit amet consectetuer')
            ->setPrice(1000000)
            ->setUnitCount(150)
            ->setDiscount(0)
            ->setMargin(20);

        $invoiceItem12 = new InvoiceItem();
        $invoiceItem12
            ->setInvoice($invoice01)
            ->setVat($vat0)
            ->setName('Sed enim auctor pede pellentesque')
            ->setPrice(156987)
            ->setUnitCount(1000)
            ->setDiscount(0)
            ->setMargin(20);

        $invoiceItem13 = new InvoiceItem();
        $invoiceItem13
            ->setInvoice($invoice01)
            ->setVat($vat0)
            ->setName('Justo nascetur faucibus pellentesque')
            ->setPrice(158648321)
            ->setUnitCount(300)
            ->setDiscount(10)
            ->setMargin(20);

        $invoiceItem14 = new InvoiceItem();
        $invoiceItem14
            ->setInvoice($invoice01)
            ->setVat($vat21)
            ->setName('Adipiscing hendrerit justo Ut montes sodales nisl')
            ->setPrice(147850)
            ->setUnitCount(3000)
            ->setDiscount(90)
            ->setMargin(20);

        $invoiceItem21 = new InvoiceItem();
        $invoiceItem21
            ->setInvoice($invoice02)
            ->setVat($vat21)
            ->setName('Montes quis id tortor egestas enim')
            ->setPrice(258741)
            ->setUnitCount(300)
            ->setDiscount(0)
            ->setMargin(0);

        $invoiceItem22 = new InvoiceItem();
        $invoiceItem22
            ->setInvoice($invoice02)
            ->setVat($vat21)
            ->setName('Odio eget nonummy Cras lorem')
            ->setPrice(369852)
            ->setUnitCount(100)
            ->setDiscount(100)
            ->setMargin(0);

        $invoiceItem23 = new InvoiceItem();
        $invoiceItem23
            ->setInvoice($invoice02)
            ->setVat($vat21)
            ->setName('Pretium congue id tincidunt id ligula metus')
            ->setPrice(2563214)
            ->setUnitCount(1000)
            ->setDiscount(0)
            ->setMargin(100);

        $invoiceItem24 = new InvoiceItem();
        $invoiceItem24
            ->setInvoice($invoice02)
            ->setVat($vat21)
            ->setName('Pede tincidunt Maecenas pretium')
            ->setPrice(2563214)
            ->setUnitCount(1000)
            ->setDiscount(0)
            ->setMargin(100);

        $invoiceItem31 = new InvoiceItem();
        $invoiceItem31
            ->setInvoice($invoice03)
            ->setVat($vat0)
            ->setName('Cursus et at a id feugiat nibh')
            ->setPrice(985476)
            ->setUnitCount(200)
            ->setDiscount(100)
            ->setMargin(100);

        $invoiceItem32 = new InvoiceItem();
        $invoiceItem32
            ->setInvoice($invoice03)
            ->setVat($vat0)
            ->setName('Vestibulum dapibus faucibus Aliquam')
            ->setPrice(258741)
            ->setUnitCount(1200)
            ->setDiscount(0)
            ->setMargin(0);

        $invoiceItem33 = new InvoiceItem();
        $invoiceItem33
            ->setInvoice($invoice03)
            ->setVat($vat0)
            ->setName('Lacus dui habitasse auctor neque ut In Aliquam elit malesuada Sed')
            ->setPrice(123698521)
            ->setUnitCount(14700)
            ->setDiscount(0)
            ->setMargin(100);

        $invoiceItem34 = new InvoiceItem();
        $invoiceItem34
            ->setInvoice($invoice03)
            ->setVat($vat0)
            ->setName('Consectetuer eu nascetur.')
            ->setPrice(258963)
            ->setUnitCount(32100)
            ->setDiscount(0)
            ->setMargin(100);

        $invoiceItem35 = new InvoiceItem();
        $invoiceItem35
            ->setInvoice($invoice03)
            ->setVat($vat0)
            ->setName('Turpis Duis ipsum nec mi nonummy eget tellus elit rhoncus interdum.')
            ->setPrice(654789321)
            ->setUnitCount(1400)
            ->setDiscount(0)
            ->setMargin(100);

        $invoiceItem41 = new InvoiceItem();
        $invoiceItem41
            ->setInvoice($invoice04)
            ->setVat($vat0)
            ->setName('Gravida fringilla eget suscipit purus leo In ut lorem ac Nulla.')
            ->setPrice(2547853)
            ->setUnitCount(58200)
            ->setDiscount(0)
            ->setMargin(100);

        $invoiceItem42 = new InvoiceItem();
        $invoiceItem42
            ->setInvoice($invoice04)
            ->setVat($vat0)
            ->setName('Nascetur metus id dui et pretium et Aenean auctor nulla pellentesque.')
            ->setPrice(258635)
            ->setUnitCount(47800)
            ->setDiscount(0)
            ->setMargin(100);

        $invoiceItem43 = new InvoiceItem();
        $invoiceItem43
            ->setInvoice($invoice04)
            ->setVat($vat0)
            ->setName('Nunc Quisque ut amet nec quam hac In egestas hac pulvinar.')
            ->setPrice(456987)
            ->setUnitCount(1200)
            ->setDiscount(50)
            ->setMargin(0);

        $invoiceItem51 = new InvoiceItem();
        $invoiceItem51
            ->setInvoice($invoice05)
            ->setVat($vat0)
            ->setName('Risus wisi sollicitudin vitae risus pellentesque orci tellus faucibus eget.')
            ->setPrice(147852)
            ->setUnitCount(3200)
            ->setDiscount(10)
            ->setMargin(30);

        $invoiceItem52 = new InvoiceItem();
        $invoiceItem52
            ->setInvoice($invoice05)
            ->setVat($vat0)
            ->setName('Ac gravida Maecenas Fusce interdum risus vel tempor Phasellus neque tellus.')
            ->setPrice(258741)
            ->setUnitCount(100)
            ->setDiscount(1)
            ->setMargin(1);

        $invoiceItem53 = new InvoiceItem();
        $invoiceItem53
            ->setInvoice($invoice05)
            ->setVat($vat0)
            ->setName('Vitae velit Morbi ridiculus id ligula dui justo fringilla libero urna.')
            ->setPrice(963258)
            ->setUnitCount(10000)
            ->setDiscount(100)
            ->setMargin(100);

        $manager->persist($invoiceItem11);
        $manager->persist($invoiceItem12);
        $manager->persist($invoiceItem13);
        $manager->persist($invoiceItem14);
        $manager->persist($invoiceItem21);
        $manager->persist($invoiceItem22);
        $manager->persist($invoiceItem23);
        $manager->persist($invoiceItem24);
        $manager->persist($invoiceItem31);
        $manager->persist($invoiceItem32);
        $manager->persist($invoiceItem33);
        $manager->persist($invoiceItem34);
        $manager->persist($invoiceItem35);
        $manager->persist($invoiceItem41);
        $manager->persist($invoiceItem42);
        $manager->persist($invoiceItem43);
        $manager->persist($invoiceItem51);
        $manager->persist($invoiceItem52);
        $manager->persist($invoiceItem53);

        $manager->flush();

    }
}