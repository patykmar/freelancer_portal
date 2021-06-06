<?php


namespace App\EventListener;

use App\Entity\Invoice;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use DateTime;


class InvoiceSubscriber implements EventSubscriber
{

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;


    /**
     * InvoiceSubscriber constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
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

    public function prePersist(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof Invoice) {
            $this->calculateMissingValues($args->getObject());
        }
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof Invoice) {
            $this->calculateMissingValues($args->getObject());
        }
    }

    /**
     * @param Invoice $invoice
     * @throws \Exception
     */
    private function calculateMissingValues(Invoice $invoice): void
    {
        $invoice
            ->setInvoiceCreated(new DateTime())
            ->setDueDate(new DateTime("+" . $invoice->getDue() . " days"));

        // if user not defined VS calculate it
        if(is_null($invoice->getVs())){
            $invoice->setVs($this->calculateInvoiceVs());
        }
    }


    /**
     * @return string
     */
    private function calculateInvoiceVs(): string
    {
        $lastInvoiceId = $this->entityManager->getRepository(Invoice::class)
            ->getLastId();
        if (count($lastInvoiceId) == 0){
            $lastInvoiceId['id'] = 0;
        }
        $today = new DateTime('now');
        $year = $today->format('Y');
        return $year.str_pad(++$lastInvoiceId['id'],6,"0",STR_PAD_LEFT);
    }
}