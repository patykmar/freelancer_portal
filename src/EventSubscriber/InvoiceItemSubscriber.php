<?php


namespace App\EventSubscriber;


use App\Entity\InvoiceItem;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class InvoiceItemSubscriber implements EventSubscriberInterface
{

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
           # BeforeEntityPersistedEvent::class => ['addMissingValuesInvoiceItem'],
#            BeforeEntityUpdatedEvent::class => ['recalculateValues']
        ];
    }

    public function addMissingValuesInvoiceItem(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        dd($entity);

        // for InvoiceItem calculate missing field based on input parameter and add to entity
        if ($entity instanceof InvoiceItem) {

            dd($entity);
            $price = $entity->getPrice();
            $unitCount = $entity->getUnitCount();

            // calculate vat from percent to multiplier example: 20 -> 1.2
            $vat = $entity->getVat() / 100;

            // calculate discount based on percent value of discount filled out by user
            $discoutTotal = ($price / 100) * $entity->getDiscount();
            $entity->setDiscountTotal($discoutTotal);

            // calculate margin based on percent value of margin filled out by user
            $marginTotal = ($entity->getMargin() / 100) * $price;
            $entity->setMarginTotal($marginTotal);

            $priceTotal = ($price + $marginTotal - $discoutTotal) * $unitCount;
            $entity->setPriceTotal($priceTotal);

            if ($vat > 0)
                $totalPriceIncVat = $priceTotal * $vat;
            else
                $totalPriceIncVat = $priceTotal;

            $entity->setPriceTotalIncVat($totalPriceIncVat);

            dd($entity);

            // unset local variables
            unset($price, $unitCount, $vat, $discoutTotal, $marginTotal, $priceTotal, $totalPriceIncVat);
        }
    }

//    public function recalculateValues(BeforeEntityUpdatedEvent $event)
//    {
//        $entity = $event->getEntityInstance();
//
//        if ($entity instanceof InvoiceItem) {
//            $dbEntity = $this->em->getRepository(InvoiceItem::class)->find($entity->getId())
//                ->getQuery()->execute();
//
//            dd($entity, $dbEntity);
//        }
//
//    }
}
