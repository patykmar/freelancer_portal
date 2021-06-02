<?php


namespace App\EventListener;


use App\Entity\WorkInventory;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class WorkInventorySubscriber implements EventSubscriber
{

    /**
     * @return string[]
     */
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        if($args->getObject() instanceof WorkInventory){
            $this->calculateDurations($args->getObject());
        }
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        if($args->getObject() instanceof WorkInventory){
            $this->calculateDurations($args->getObject());
        }
    }

    private function calculateDurations()
    {
        //TODO: Calculate Work duration, when you know work_end time
    }
}