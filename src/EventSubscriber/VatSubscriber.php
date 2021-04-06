<?php


namespace App\EventSubscriber;


use App\Entity\Vat;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityDeletedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class VatSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;


    /**
     * VatSubscriber constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
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
                $this->updateDefaultItem();

        }

        unset($entity);
    }

    public function vatBeforePersisted(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof Vat) {
            // if user select some item to default set rest of items to false
            if ($entity->getIsDefault())
                $this->updateDefaultItem();
        }

        unset($entity);
    }

    public function vatBeforeDeleted(BeforeEntityDeletedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof Vat) {
            //TODO: osetri mazani vychozi hodnoty
            dd($entity);
        }
        unset($entity);
    }


    /**
     * Set isDefault to false for each rows
     * @throws \Doctrine\ORM\ORMException
     */
    private function updateDefaultItem(): void
    {
        // set all default
        $this->entityManager->getRepository(Vat::class)
            ->unsetDefaultAll();
    }

}