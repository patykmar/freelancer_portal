<?php

namespace App\EventListener;

use App\Entity\Ci;
use DateTime;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class CiSubscriber implements EventSubscriber
{

    /**
     * @inheritDoc
     */
    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist
        ];
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof Ci) {
            $this->addedParameter($args->getObject());
        }
    }

    /**
     * @param Ci|object $ci
     */
    private function addedParameter(Ci $ci): void
    {
        $ci->setCreatedDateTime(new DateTime());
    }
}