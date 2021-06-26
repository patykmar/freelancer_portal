<?php


namespace App\EventListener;

use App\Entity\Invoice;
use App\Services\InvoiceServices;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use DateTime;
use Exception;


class InvoiceSubscriber implements EventSubscriber
{
    /** @var InvoiceServices $invoiceServices */
    private InvoiceServices $invoiceServices;

    /**
     * InvoiceSubscriber constructor.
     * @param InvoiceServices $invoiceServices
     */
    public function __construct(InvoiceServices $invoiceServices)
    {
        $this->invoiceServices = $invoiceServices;
    }


    /**
     * @inheritDoc
     */
    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::preUpdate,
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
    }


}