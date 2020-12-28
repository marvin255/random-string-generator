<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\RandomEngine;

/**
 * Object that uses random_int function to create random numbers.
 */
class RandomIntEngine implements RandomEngine
{
    /**
     * {@inheritDoc}
     */
    public function rand(int $min = 0, int $max = null): int
    {
        $max = $max === null ? mt_getrandmax() : $max;

        return random_int($min, $max);
    }
}
