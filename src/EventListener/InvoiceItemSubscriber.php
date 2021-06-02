<?php


namespace App\EventListener;


use App\Entity\InvoiceItem;
use App\Services\InvoiceItemServices;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;


class InvoiceItemSubscriber implements EventSubscriber
{

    private InvoiceItemServices $invoiceItemServices;

    /**
     * InvoiceItemSubscriber constructor.
     * @param InvoiceItemServices $invoiceItemServices
     */
    public function __construct(InvoiceItemServices $invoiceItemServices)
    {
        $this->invoiceItemServices = $invoiceItemServices;
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
        if ($args->getObject() instanceof InvoiceItem) {
            $this->calculateTotalValues($args->getObject());
        }
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof InvoiceItem) {
            $this->calculateTotalValues($args->getObject());
        }
    }

    /**
     * Set MarginTotal, DiscountTotal, PriceTotal, PriceTotalIncVat items before insert/update to database
     * @param InvoiceItem $invoiceItem
     */
    private function calculateTotalValues(InvoiceItem $invoiceItem)
    {
        $marginTotal = $this->invoiceItemServices->calculateTotalMargin(
            $invoiceItem->getPrice(),
            $invoiceItem->getMargin()
        );
        $invoiceItem->setMarginTotal($marginTotal);

        $discountTotal = $this->invoiceItemServices->calculateTotalDiscount(
            ($marginTotal + $invoiceItem->getPrice()),
            $invoiceItem->getDiscount()
        );
        $invoiceItem->setDiscountTotal($discountTotal);

        $priceTotal = $this->invoiceItemServices->calculateTotalPrice(
            $invoiceItem->getPrice(),
            $marginTotal,
            $discountTotal,
            $invoiceItem->getUnitCount()
        );
        $invoiceItem->setPriceTotal($priceTotal);

        $priceTotalIncVat = $this->invoiceItemServices->calculateTotalPriceIncVat(
            $priceTotal,
            $invoiceItem->getVat()->getMultiplier()
        );
        $invoiceItem->setPriceTotalIncVat($priceTotalIncVat);

        // unset local variables
        unset($marginTotal, $discountTotal, $priceTotal, $priceTotalIncVat);

    }

}