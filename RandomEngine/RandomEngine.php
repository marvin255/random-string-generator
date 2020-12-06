<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\RandomEngine;

/**
 * Interface for object that can generate random numbers.
 */
interface RandomEngine
{
    /**
     * Generates random number like mt_rand do.
     *
     * @param int      $min
     * @param int|null $max
     *
     * @return int
     */
    public function rand(int $min = 0, int $max = null): int;
}
