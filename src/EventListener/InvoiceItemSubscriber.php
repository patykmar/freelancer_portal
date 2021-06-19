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

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof InvoiceItem) {
            $this->calculateTotalValues($args->getObject());
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof InvoiceItem) {
            $this->calculateTotalValues($args->getObject());
        }
    }

    /**
     * Set missing items before insert/update to database
     * @param InvoiceItem $invoiceItem
     */
    private function calculateTotalValues(InvoiceItem $invoiceItem)
    {
        $marginTotal = $this->invoiceItemServices->calculateMarginTotal(
            $invoiceItem->getPrice(),
            $invoiceItem->getMargin()
        );
        $invoiceItem->setMarginTotal($marginTotal);

        $priceIncMargin = $this->invoiceItemServices->calculatePriceIncMargin(
            $invoiceItem->getPrice(),
            $marginTotal
        );
        $invoiceItem->setPriceIncMargin($priceIncMargin);

        $discountTotal = $this->invoiceItemServices->calculateDiscountTotal(
            $priceIncMargin,
            $invoiceItem->getDiscount()
        );
        $invoiceItem->setDiscountTotal($discountTotal);

        $priceIncMarginMinusDiscount = $this->invoiceItemServices->calculatePriceIncMarginMinusDiscount(
            $priceIncMargin,
            $discountTotal
        );
        $invoiceItem->setPriceIncMarginMinusDiscount($priceIncMarginMinusDiscount);

        $priceIncMarginDiscountMultiVat = $this->invoiceItemServices->calculatePriceIncMarginDiscountMultiVat(
            $priceIncMarginMinusDiscount,
            $invoiceItem->getVat()->getMultiplier()
        );
        $invoiceItem->setPriceIncMarginDiscountMultiVat($priceIncMarginDiscountMultiVat);

        $priceIncMarginMultiVat = $this->invoiceItemServices->calculatePriceIncMarginMultiVat(
            $priceIncMargin,
            $invoiceItem->getVat()->getMultiplier()
        );
        $invoiceItem->setPriceIncMarginMultiVat($priceIncMarginMultiVat);

        $totalPriceIncMarginDiscountVat = $this->invoiceItemServices->calculateTotalPriceIncMarginDiscountVat(
            $priceIncMarginDiscountMultiVat,
            $invoiceItem->getUnitCount()
        );
        $invoiceItem->setTotalPriceIncMarginDiscountVat($totalPriceIncMarginDiscountVat);

        $totalPriceIncMarginVat = $this->invoiceItemServices->calculateTotalPriceIncMarginVat(
            $priceIncMarginMultiVat,
            $invoiceItem->getUnitCount()
        );
        $invoiceItem->setTotalPriceIncMarginVat($totalPriceIncMarginVat);

        // unset local variables
        unset($priceIncMargin, $marginTotal, $discountTotal, $priceTotal,
            $priceIncMarginMinusDiscount, $priceIncMarginDiscountMultiVat,
            $priceIncMarginMultiVat, $totalPriceIncMarginDiscountVat,
            $totalPriceIncMarginVat);

    }

}