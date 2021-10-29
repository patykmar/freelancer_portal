<?php


namespace App\EventListener;

use App\Entity\Invoice;
use App\Services\InvoiceServices;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use DateTime;
use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class InvoiceSubscriber implements EventSubscriber
{
    /** @var InvoiceServices $invoiceServices */
    private InvoiceServices $invoiceServices;

    /** @var ParameterBagInterface $parameterBag */
    private ParameterBagInterface $parameterBag;

    /**
     * InvoiceSubscriber constructor.
     * @param InvoiceServices $invoiceServices
     * @param ParameterBagInterface $parameterBag
     */
    public function __construct(InvoiceServices $invoiceServices, ParameterBagInterface $parameterBag)
    {
        $this->invoiceServices = $invoiceServices;
        $this->parameterBag = $parameterBag;
    }


    /**
     * @inheritDoc
     */
    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::preUpdate,
            Events::postPersist,
        ];
    }

    /**
     * @throws Exception
     */
    public function prePersist(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof Invoice) {
            $this->calculateMissingValues($args->getObject());
        }
    }

    /**
     * @throws Exception
     */
    public function preUpdate(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof Invoice) {
            $this->calculateMissingValues($args->getObject());
        }
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof Invoice) {
            $this->setMissingName($args->getObject());
        }
    }

    /**
     * @param Object|Invoice $invoice
     * @throws Exception
     */
    private function calculateMissingValues(Invoice $invoice): void
    {
        $invoice
            ->setInvoiceCreated(new DateTime())
            ->setDueDate(new DateTime("+" . $invoice->getDue() . " days"));

        // if user not defined VS calculate it
        if (is_null($invoice->getVs())) {
            $invoice->setVs($this->invoiceServices->calculateInvoiceVs());
        }

        // if user not defined KS load from services.yaml
        if (is_null($invoice->getKs())) {
            $this->parameterBag->get('invoiceKsDefault');
        }

    }

    /**
     * @param Invoice|Object $invoice
     */
    private function setMissingName(Invoice $invoice): void
    {
        $invoice->setName(
            $invoice->getVs() . ", " .
            $invoice->getSupplier() . " -> " .
            $invoice->getSubscriber() . " - " .
            $invoice->getDueDate()->format("d.m.Y")
        );
    }
}