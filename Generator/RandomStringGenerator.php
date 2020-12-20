<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\Generator;

use Marvin255\RandomStringGenerator\Vocabulary\Vocabulary;

/**
 * Interface for object that can generate random string.
 */
interface RandomStringGenerator
{
    /**
     * Generates string consists of random digits and latin symbols.
     *
     * @param int $length
     *
     * @return string
     */
    public function alphanumeric(int $length): string;

    /**
     * Generates string consists of random latin symbols.
     *
     * @param int $length
     *
     * @return string
     */
    public function alpha(int $length): string;

    /**
     * Generates string consists of random digits.
     *
     * @param int $length
     *
     * @return string
     */
    public function numeric(int $length): string;

    /**
     * Generates random string using length and set vocabulary.
     *
     * @param int    $length
     * @param string $vocabulary
     *
     * @return string
     */
    public function string(int $length, string $vocabulary): string;
}
