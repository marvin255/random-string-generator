<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\Generator;

/**
 * Interface for object that can generate random string.
 */
interface RandomStringGenerator
{
    public const MIN_PASSWORD_LENGTH = 4;

    /**
     * Generates string consists of random digits and latin symbols.
     *
     * @param int $length
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function alphanumeric(int $length): string;

    /**
     * Generates string consists of random latin symbols.
     *
     * @param int $length
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function alpha(int $length): string;

    /**
     * Generates string consists of random digits.
     *
     * @param int $length
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function numeric(int $length): string;

    /**
     * Generates string which can be used as passport.
     *
     * @param int $length
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function password(int $length): string;

    /**
     * Generates random string using length and set vocabulary.
     *
     * @param int    $length
     * @param string $vocabulary
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function string(int $length, string $vocabulary): string;
}
