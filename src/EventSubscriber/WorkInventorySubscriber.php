<?php


namespace App\EventSubscriber;


use App\Entity\WorkInventory;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class WorkInventorySubscriber implements EventSubscriberInterface
{
    private const DAY_HOURS = 24;

    /**
     * @var Security
     */
    private Security $security;

    /**
     * WorkInventorySubscriber constructor.
     */
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
            BeforeEntityUpdatedEvent::class => ['beforeEditWorkInventory'],
        ];
    }

    public function addMissingValues(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof WorkInventory) {

            // when I know when work ended I can calculate duration
            if (!is_null($entity->getWorkEnd())) {
                $entity->setWorkDuration($this->calculateDuration($entity));
            }

            // TODO: osetrit, aby work_end nebyl drive nez work_start
            // set user ID to invoice
            $entity->setUser($this->security->getUser());
        }
        unset($entity);
    }

    public function beforeEditWorkInventory(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof WorkInventory) {

//            dump($entity);
//            dump($entity->getWorkDuration() * $entity->getTarif()->getPrice());
//            dd($entity->getTarif()->getPrice());

            // when I know when work ended I can calculate duration
            if (!is_null($entity->getWorkEnd())) {
                $entity->setWorkDuration($this->calculateDuration($entity));
            }
        }
        unset($entity);
    }


    /**
     * Calculate interval between work_end and work_start and return how many hours is between those.
     * @param WorkInventory $entity
     * @return float
     */
    private function calculateDuration(WorkInventory $entity): float
    {
        $workStart = $entity->getWorkStart();
        $workEnd = $entity->getWorkEnd();
//        $workStart = new \DateTime("2021-03-05 20:20:00");
//        $workEnd = new \DateTime("2021-03-05 21:20:00");

        $duration = $workEnd->diff($workStart);
        $durationInHours = 0.0;

        /* handle minutes:
         * - for interval 1-30 min plus 0.5 hour
         * - for interval 31-59 min plus 1 hour */
        if ($duration->i <= 30 && $duration->i > 0)
            $durationInHours += 0.5;
        else if ($duration->i < 60 && $duration->i > 30)
            $durationInHours += 1;

        // handle hours
        $durationInHours += $duration->h;

        // handle days
        $durationInHours += $duration->days * self::DAY_HOURS;

//        dump($durationInHours);
//        dd($duration);

        unset($workStart, $workEnd, $duration);
        return $durationInHours;
    }
}