<?php


namespace App\EventListener;


use App\Entity\WorkInventory;
use App\Services\WorkInventoryServices;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class WorkInventorySubscriber implements EventSubscriber
{

    private WorkInventoryServices $workInventoryServices;

    /**
     * WorkInventorySubscriber constructor.
     * @param WorkInventoryServices $workInventoryServices
     */
    public function __construct(WorkInventoryServices $workInventoryServices)
    {
        $this->workInventoryServices = $workInventoryServices;
    }


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

    public function prePersist(LifecycleEventArgs $args): void
    {
        if($args->getObject() instanceof WorkInventory){
            $this->calculateDuration($args->getObject());
        }
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        if($args->getObject() instanceof WorkInventory){
            $this->calculateDuration($args->getObject());
        }
    }

    private function calculateDuration(WorkInventory $workInventory)
    {
        // If I know, when work ended I can calculate duration
        if (!is_null($workInventory->getWorkEnd())) {
            $workStart = $workInventory->getWorkStart();
            $workEnd = $workInventory->getWorkEnd();

            $workInventory->setWorkDuration(
                $this->workInventoryServices->calculateDuration(
                    $workStart,
                    $workEnd
                )
            );
        }
    }

}