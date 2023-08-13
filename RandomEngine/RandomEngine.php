<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\RandomEngine;

/**
 * Interface for object that can generate random numbers.
 */
interface RandomEngine
{
    public const RAND_MIN = 0;
    public const RAND_MAX = 2147483647;

    /**
     * Generates random number like mt_rand do.
     */
    public function rand(int $min = self::RAND_MIN, int $max = self::RAND_MAX): int;
}
