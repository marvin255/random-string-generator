<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\RandomEngine;

use Random\Engine\Xoshiro256StarStar;
use Random\Randomizer;

/**
 * Object that uses Randomizer object with Random\Engine\Xoshiro256StarStar to create random numbers.
 *
 * @internal
 * 
 * @psalm-suppress UndefinedClass
 * @psalm-suppress MixedAssignment
 * @psalm-suppress MixedInferredReturnType
 * @psalm-suppress MixedReturnStatement
 */
final class RandomizerFastEngine implements RandomEngine
{
    private readonly Randomizer $randomizer;

    public function __construct()
    {
        $this->randomizer = new Randomizer(new Xoshiro256StarStar());
    }

    /**
     * {@inheritDoc}
     */
    public function rand(int $min = RandomEngine::RAND_MIN, int $max = RandomEngine::RAND_MAX): int
    {
        return $this->randomizer->getInt($min, $max);
    }
}
