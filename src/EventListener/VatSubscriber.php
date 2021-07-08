<?php


namespace App\EventListener;


use App\Entity\Vat;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class VatSubscriber implements EventSubscriber
{

    /**
     * @return string[]
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
        if ($args->getObject() instanceof Vat) {
            $this->calculateMultiplier($args->getObject());
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof Vat) {
            $this->calculateMultiplier($args->getObject());
        }
    }

    /**
     * @param Object|Vat $vat
     */
    private function calculateMultiplier(Vat $vat)
    {
        // multiplier for 20 % is 120
        $vat->setMultiplier($vat->getPercent() + 100);
    }
}