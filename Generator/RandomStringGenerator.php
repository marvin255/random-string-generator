<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\Generator;

use Marvin255\RandomStringGenerator\Vocabulary\Vocabulary;

/**
 * Interface for object that can generate random string.
 */
interface RandomStringGenerator
{
    public const MIN_PASSWORD_LENGTH = 4;

    /**
     * Generates string consists of random digits and latin symbols.
     *
     * @throws \InvalidArgumentException
     */
    public function alphanumeric(int $length): string;

    /**
     * Generates string consists of random latin symbols.
     *
     * @throws \InvalidArgumentException
     */
    public function alpha(int $length): string;

    /**
     * Generates string consists of random digits.
     *
     * @throws \InvalidArgumentException
     */
    public function numeric(int $length): string;

    /**
     * Generates string which can be used as passport.
     *
     * @throws \InvalidArgumentException
     */
    public function password(int $length): string;

    /**
     * Generates random string using length and set vocabulary.
     *
     * @throws \InvalidArgumentException
     */
    public function string(int $length, string|Vocabulary $vocabulary): string;
}
