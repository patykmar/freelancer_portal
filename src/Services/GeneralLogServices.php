<?php

namespace App\Services;

use App\Entity\GeneralLog;
use App\Entity\Ticket;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;

class GeneralLogServices
{
    private ManagerRegistry $managerRegistry;

    /**
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    public function newLogTicket(Ticket $ticket)
    {
        $entityManager = $this->managerRegistry->getManager();

        $logMessage =
            "<b>Ticket state:</b> " . $ticket->getTicketState()->getName() . "<br />" .
            "<b>Ticket type:</b> " . $ticket->getTicketType()->getName() . "<br />" .
            "<b>Ticket priority:</b> " . $ticket->getPriority()->getName() . "<br />" .
            "<b>Ticket impact:</b> " . $ticket->getImpact()->getName() . "<br />" .
            "<b>Description title:</b> " . $ticket->getDescriptionTitle() . "<br />" .
            $ticket->getDescriptionBody();

        $newLog = new GeneralLog();
        $newLog->setTicket($ticket);
        $newLog->setUser($ticket->getUserCreated());
        $newLog->setBody($logMessage);
        $newLog->setCreated(new DateTime());
        $entityManager->persist($newLog);
        $entityManager->flush();
    }
}