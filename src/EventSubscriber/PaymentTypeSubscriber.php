<?php


namespace App\EventSubscriber;


use App\Entity\PaymentType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PaymentTypeSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * PaymentTypeSubscriber constructor.
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
            BeforeEntityUpdatedEvent::class => ['paymentTypeBeforeEntityUpdatedEvent'],
            BeforeEntityPersistedEvent::class => ['paymentTypeBeforeEntityPersistedEvent'],
        ];

    }

    /**
     * @param BeforeEntityUpdatedEvent $event
     */
    public function paymentTypeBeforeEntityUpdatedEvent(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof PaymentType) {
            if ($entity->getIsDefault())
                $this->updateDefaultItem();
        }
        unset($entity);
    }

    /**
     * @param BeforeEntityPersistedEvent $entityPersistedEvent
     * @throws \Doctrine\ORM\ORMException
     */
    public function paymentTypeBeforeEntityPersistedEvent(BeforeEntityPersistedEvent $entityPersistedEvent)
    {
        $entity = $entityPersistedEvent->getEntityInstance();
        if ($entity instanceof PaymentType) {
            if ($entity->getIsDefault())
                $this->updateDefaultItem();
        }
        unset($entityPersistedEvent);
    }


    /**
     * Set isDefault to false for each rows
     * @throws \Doctrine\ORM\ORMException
     */
    private function updateDefaultItem(): void
    {
        // set all default
        $this->entityManager
            ->getRepository(PaymentType::class)
            ->unsetDefaultAll();
    }
}