<?php

namespace App\Repository;

/**
 *
 * @author patykmar
 */
interface DefaultValueInterface
{
    public function unsetDefaultAll(): bool;

    public function getDefaultEntity();

    public function getCount();

    public function findOneRow(int $id);

    public function setIsDefaultById(int $id);
}
