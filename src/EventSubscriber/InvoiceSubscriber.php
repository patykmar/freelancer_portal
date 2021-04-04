<?php


namespace App\EventSubscriber;


use App\Entity\Invoice;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class InvoiceSubscriber implements EventSubscriberInterface
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['addMissingValues'],
        ];
    }

    /**
     * @param BeforeEntityPersistedEvent $event
     * @throws \Exception
     */
    public function addMissingValues(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        // for invoice instance only
        if ($entity instanceof Invoice) {
            // set user ID to invoice
            $entity->setUserCreated($this->security->getUser());
            // calculate due date based on how many days was filled out
            $entity->setDueDate(new \DateTime("+" . $entity->getDue() . " days"));
            // set day when invoice has been created
            $entity->setInvoiceCreated(new \DateTime());

            // update InvoiceItem
            foreach ($entity->getInvoiceItems() as $item) {

                $price = $item->getPrice();
                $unitCount = $item->getUnitCount();

                // calculate vat from percent to multiplier example: 20 -> 1.2
                $vat = $item->getVat() / 100;

                // calculate discount based on percent value of discount filled out by user
                $discountTotal = ($price / 100) * $item->getDiscount();
                $item->setDiscountTotal($discountTotal);

                // calculate margin based on percent value of margin filled out by user
                $marginTotal = ($item->getMargin() / 100) * $price;
                $item->setMarginTotal($marginTotal);

                $priceTotal = ($price + $marginTotal - $discountTotal) * $unitCount;
                $item->setPriceTotal($priceTotal);

                if ($vat > 0)
                    $totalPriceIncVat = $priceTotal * $vat;
                else
                    $totalPriceIncVat = $priceTotal;

                $item->setPriceTotalIncVat($totalPriceIncVat);

                // unset local variables
                unset($price, $unitCount, $vat, $discountTotal, $marginTotal, $priceTotal, $totalPriceIncVat);
            }
        }

        unset($entity);
    }


}