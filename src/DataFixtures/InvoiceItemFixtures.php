<?php


namespace App\DataFixtures;


use App\Entity\InvoiceItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class InvoiceItemFixtures extends Fixture implements DependentFixtureInterface
{

    public static array $sentences = array(
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Nam at congue nulla.',
        'Sed a sodales leo, fermentum lobortis tellus.', 'Morbi et risus sed enim consequat auctor id convallis massa.',
        'Duis lacus enim, accumsan eget tristique sed, viverra et augue.', 'Curabitur ut sodales ante.',
        'Sed vestibulum, erat eget tincidunt egestas, sem metus eleifend erat, vel suscipit est ante id arcu.',
        'Nunc laoreet, quam sit amet pretium ultricies, justo nisi placerat libero, a molestie dolor odio vel nisl.',
        'In hac habitasse platea dictumst.', 'Suspendisse massa arcu, laoreet eget cursus non, vulputate eget diam.',
        'Vestibulum nisl sapien, pellentesque non consectetur et, finibus eget elit.',
        'Phasellus quis tincidunt arcu.', 'Suspendisse sed lectus dui.', 'In laoreet libero orci, sed tincidunt sapien viverra eget.',
        'Nam erat mauris, hendrerit sed varius id, aliquet id arcu.',
        'Quisque elementum, nulla id sollicitudin volutpat, metus nunc pretium nisi, in varius massa lectus vitae sapien.',
        'Nulla facilisi.', 'Suspendisse ac nisi laoreet, vulputate augue eget, porttitor arcu.',
        'Etiam vel urna ullamcorper, dignissim urna non, consequat ex.', 'Duis tempor nibh sapien.',
        'Donec pellentesque arcu quis feugiat dapibus.', 'Sed consequat enim et neque iaculis elementum.',
        'Nulla massa metus, vestibulum ut eros a, feugiat vehicula tortor.', 'Pellentesque tristique molestie tortor posuere rutrum.',
        'Praesent porttitor magna id ligula congue, a scelerisque ligula fringilla.', 'Proin non suscipit sapien.');

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
        $invoices = [
            $this->getReference(InvoiceFixtures::INVOICE_01), $this->getReference(InvoiceFixtures::INVOICE_02),
            $this->getReference(InvoiceFixtures::INVOICE_03), $this->getReference(InvoiceFixtures::INVOICE_04),
            $this->getReference(InvoiceFixtures::INVOICE_05), $this->getReference(InvoiceFixtures::INVOICE_06),
            $this->getReference(InvoiceFixtures::INVOICE_07), $this->getReference(InvoiceFixtures::INVOICE_08),
            $this->getReference(InvoiceFixtures::INVOICE_09), $this->getReference(InvoiceFixtures::INVOICE_10),
            $this->getReference(InvoiceFixtures::INVOICE_11), $this->getReference(InvoiceFixtures::INVOICE_12),
            $this->getReference(InvoiceFixtures::INVOICE_13), $this->getReference(InvoiceFixtures::INVOICE_14),
            $this->getReference(InvoiceFixtures::INVOICE_15), $this->getReference(InvoiceFixtures::INVOICE_16),
            $this->getReference(InvoiceFixtures::INVOICE_17), $this->getReference(InvoiceFixtures::INVOICE_18),
            $this->getReference(InvoiceFixtures::INVOICE_19), $this->getReference(InvoiceFixtures::INVOICE_20),
            $this->getReference(InvoiceFixtures::INVOICE_21), $this->getReference(InvoiceFixtures::INVOICE_22),
            $this->getReference(InvoiceFixtures::INVOICE_23), $this->getReference(InvoiceFixtures::INVOICE_24),
            $this->getReference(InvoiceFixtures::INVOICE_25), $this->getReference(InvoiceFixtures::INVOICE_26),
            $this->getReference(InvoiceFixtures::INVOICE_27), $this->getReference(InvoiceFixtures::INVOICE_28),
            $this->getReference(InvoiceFixtures::INVOICE_29), $this->getReference(InvoiceFixtures::INVOICE_30),
        ];

        $vats = [
            $this->getReference(VatFixture::NO_VAT),
            $this->getReference(VatFixture::VAT_05),
            $this->getReference(VatFixture::VAT_10),
            $this->getReference(VatFixture::VAT_15),
            $this->getReference(VatFixture::VAT_20),
            $this->getReference(VatFixture::VAT_21),
            $this->getReference(VatFixture::VAT_22),
        ];



        for ($i = 0; $i < 500; $i++) {
            $iif = new InvoiceItem();
            $iif->setInvoice($invoices[rand(0, count($invoices) - 1)])
                ->setVat($vats[rand(0, count($vats) - 1)])
                ->setName(InvoiceItemFixtures::$sentences[rand(0, count(InvoiceItemFixtures::$sentences) - 1)])
                ->setPrice(rand(100, 999999))
                ->setUnitCount(rand(1, 99999) * (rand(1, 10) / 10))
                ->setDiscount(rand(0, 100))
                ->setMargin(rand(0, 300));
            $manager->persist($iif);
        }

        $manager->flush();

    }
}