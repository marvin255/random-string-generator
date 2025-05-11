<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\RandomEngine;

use Random\Engine\Secure;
use Random\Randomizer;

/**
 * Object that uses Randomizer object with Random\Engine\Secure to create random numbers.
 *
 * @internal
 */
final class RandomizerSecureEngine implements RandomEngine
{
    private readonly Randomizer $randomizer;

    public function __construct()
    {
        $this->randomizer = new Randomizer(new Secure());
    }

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function rand(int $min = RandomEngine::RAND_MIN, int $max = RandomEngine::RAND_MAX): int
    {
        return $this->randomizer->getInt($min, $max);
    }
}
