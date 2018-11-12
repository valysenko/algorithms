<?php

namespace App\DataStructures\Interfaces;

/**
 * Interface Comparable
 * @package App\DataStructures\Interfaces
 */
interface Comparable
{
    public function compareTo(Comparable $object);
}