<?php

namespace App\Dto\Mapper;

interface MapperInterface
{
    /**
     * @param object $dto
     * @return object
     */
    public function toEntity(object $dto): object;

    /**
     * @param object $existingItem
     * @param object $userData
     * @return object
     */
    public function fullFillEntity(object $existingItem, object $userData): object;

    /**
     * @param object $entity
     * @return object
     */
    public function toDto(object $entity): object;
}