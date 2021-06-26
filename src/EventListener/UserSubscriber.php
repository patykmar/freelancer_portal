<?php


namespace App\EventListener;


use App\Entity\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use DateTime;

class UserSubscriber implements EventSubscriber
{

    private UserPasswordEncoderInterface $encoder;

    /**
     * UserSubscriber constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    /**
     * @return string[]
     */
    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
        ];
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        if ($args->getObject() instanceof User) {
            $this->encryptPasswordAndGenerateMissingFields($args->getObject());
        }
    }

    /**
     * @param Object|User $user
     */
    private function encryptPasswordAndGenerateMissingFields(User $user)
    {
        $today = new DateTime('now');

        // rewrite password field by encode password
        $user->setPassword(
            $this->encoder->encodePassword(
                $user,
                $user->getPassword()
            ));

        $user->setCreated($today);
        $user->setPasswordChanged($today);
        $user->setLastLogin($today);

        unset($today);
    }
}