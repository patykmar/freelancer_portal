<?php

namespace App\EventSubscriber;

use App\Entity\Vat;
use App\Repository\VatRepository;
use ContainerXtzauUv\getConsole_Command_EventDispatcherDebugService;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityDeletedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class VatSubscriber implements EventSubscriberInterface
{

    /** @var EntityManagerInterface */
    private EntityManagerInterface $entityManager;

    /** @var VatRepository */
    private $repo;

    /**
     * VatSubscriber constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repo = $this->entityManager->getRepository(Vat::class);
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityUpdatedEvent::class => ['vatBeforeUpdated'],
            BeforeEntityPersistedEvent::class => ['vatBeforePersisted'],
            BeforeEntityDeletedEvent::class => ['vatBeforeDeleted']
        ];
    }

    public function vatBeforeUpdated(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof Vat) {
            // if user select some item to default set rest of items to false
            if ($entity->getIsDefault())
                $this->updateDefaultItem($entity);
        }

        unset($entity);
    }

    public function vatBeforePersisted(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof Vat) {
            // if user select some item to default set rest of items to false
            if ($entity->getIsDefault())
                $this->updateDefaultItem($entity);

            // if table is empty set default true by default
            $rowCount = $this->repo->getCount();
            if ($rowCount == 0)
                $entity->setIsDefault(true);
        }

        unset($entity);
    }

    public function vatBeforeDeleted(BeforeEntityDeletedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof Vat) {
            //TODO: osetri mazani vychozi hodnoty
            // are you try delete row with default value ?
            if ($entity->getIsDefault()) {
                // are there any other rows ?
                if ($this->repo->getCount() > 0) {
                    $this->setIsDefaultToTrueOnSomeRow($entity);
                }
            }
            #dd($entity);
        }
        unset($entity);
    }

    /**
     * Set isDefault to false for each rows
     * @throws \Doctrine\ORM\ORMException
     */
    private function updateDefaultItem(Vat $entity): void
    {
        /** @var Vat */
        $whoIsDefault = $this->repo->getDefaultEntity();

        // if $whoIsDefault is null no entity is default
        if (is_null($whoIsDefault))
            return;

        // in case you are editing the default entry don't do that
        if ($entity->getId() != $whoIsDefault->getId()) {
            // set all default
            $this->repo->unsetDefaultAll();
        }

    }

    /**
     *
     */
    private function setIsDefaultToTrueOnSomeRow(Vat $entity)
    {
        $repo = $this->entityManager
            ->getRepository(Vat::class);

        $someItem = $repo->findOneRow($entity->getId());

        if (count($someItem) === 1) {
            $someItem[0]->setIsDefault(TRUE);
            $repo->setIsDefaultById($someItem[0]->getId());
        } else
            return;
    }

}
