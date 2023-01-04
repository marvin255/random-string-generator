<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\RandomEngine;

/**
 * Object that uses mt_rand function to create random numbers.
 */
final class MtRandomEngine implements RandomEngine
{
    /**
     * {@inheritDoc}
     */
    public function rand(int $min = RandomEngine::RAND_MIN, int $max = RandomEngine::RAND_MAX): int
    {
        return mt_rand($min, $max);
    }
}
