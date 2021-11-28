<?php

namespace App\DataTransformer\Output;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\Mapper\TicketMapper;
use App\Dto\Out\TicketDtoOut;
use App\Entity\Ticket;

class TicketOutputDataTransformer implements DataTransformerInterface
{
    private TicketMapper $ticketMapper;

    /**
     * @param TicketMapper $ticketMapper
     */
    public function __construct(TicketMapper $ticketMapper)
    {
        $this->ticketMapper = $ticketMapper;
    }

    /**
     * @param Ticket|object $object
     * @param string $to
     * @param array $context
     * @return TicketDtoOut|object
     */
    public function transform($object, string $to, array $context = [])
    {
        if (isset($context['operation_type']) && $context['operation_type'] === 'item') {
            return $this->ticketMapper->toDtoItem($object);
        }
        return $this->ticketMapper->toDto($object);
    }

    /**
     * @inheritDoc
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return TicketDtoOut::class === $to && $data instanceof Ticket;
    }
}