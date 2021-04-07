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
}
