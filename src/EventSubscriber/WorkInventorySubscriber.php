<?php


namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\WorkInventory;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class WorkInventorySubscriber implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['validateWorkStartWorkEnd', EventPriorities::PRE_VALIDATE]
        ];
    }

    public function validateWorkStartWorkEnd(ViewEvent $event): void
    {
        $workInventory = $event->getControllerResult();
        if (!$workInventory instanceof WorkInventory || !$event->getRequest()->isMethodSafe()) {
            return;
        }
        //TODO: Validate work end must be after work start
        // https://api-platform.com/docs/core/errors/
    }

}