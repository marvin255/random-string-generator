<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\RandomEngine;

/**
 * Object that uses mt_rand function to create random numbers.
 */
class MtRandomEngine implements RandomEngine
{
    /**
     * @inheritDoc
     */
    public function rand(int $min = 0, int $max = null): int
    {
        $max = $max === null ? mt_getrandmax() : $max;

        return mt_rand($min, $max);
    }
}
