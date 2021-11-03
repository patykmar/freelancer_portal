<?php

namespace App\Dto\Mapper;

interface MapperInterface
{
    /**
     * @param object $dto
     * @return object
     */
    public function toEntity(object $dto);

    /**
     * @param object $entity
     * @return object
     */
    public function toDto(object $entity);
}