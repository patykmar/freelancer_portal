<?php


namespace App\EventListener;

use App\Entity\Company;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use DateTime;


class CompanySubscriber implements EventSubscriber
{

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
        if ($args->getObject() instanceof Company) {
            $this->addedModifyParameter($args->getObject());
        }
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof Company) {
            $this->addedModifyParameter($args->getObject());
        }
    }

    private function addedModifyParameter(Company $company): void
    {
        $company->setModify(new DateTime());
    }

}