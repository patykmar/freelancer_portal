<?php

namespace App\DataTransformer\Input;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\Mapper\TicketMapper;
use App\Entity\Ticket;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class TicketInputDataTransformer implements DataTransformerInterface
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
     * @inheritDoc
     */
    public function transform($object, string $to, array $context = [])
    {
        if (isset($context[AbstractNormalizer::OBJECT_TO_POPULATE])) {
            // PUT method
            return $this->ticketMapper->fullFillEntity(
                $context[AbstractNormalizer::OBJECT_TO_POPULATE],
                $object
            );
        } else {
            // POST method
            return $this->ticketMapper->toEntity($object);
        }
    }

    /**
     * @inheritDoc
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof Ticket) {
            return false;
        }
        return Ticket::class === $to && null !== ($context['input']['class'] ?? null);

    }
}