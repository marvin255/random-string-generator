<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\RandomEngine;

/**
 * Object that uses random_int function to create random numbers.
 *
 * @internal
 */
final class RandomIntEngine implements RandomEngine
{
    /**
     * {@inheritDoc}
     */
    public function rand(int $min = RandomEngine::RAND_MIN, int $max = RandomEngine::RAND_MAX): int
    {
        return random_int($min, $max);
    }
}
