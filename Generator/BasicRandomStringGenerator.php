<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\Generator;

use Marvin255\RandomStringGenerator\RandomEngine\RandomEngine;
use Marvin255\RandomStringGenerator\Vocabulary\Vocabulary;

/**
 * Basic random string generator.
 */
final class BasicRandomStringGenerator implements RandomStringGenerator
{
    private RandomEngine $randomEngine;

    public function __construct(RandomEngine $randomEngine)
    {
        $this->randomEngine = $randomEngine;
    }

    /**
     * {@inheritDoc}
     */
    public function alphanumeric(int $length): string
    {
        return $this->string($length, Vocabulary::ALPHA_NUMERIC);
    }

    /**
     * {@inheritDoc}
     */
    public function alpha(int $length): string
    {
        return $this->string($length, Vocabulary::ALPHA);
    }

    /**
     * {@inheritDoc}
     */
    public function numeric(int $length): string
    {
        return $this->string($length, Vocabulary::NUMERIC);
    }

    /**
     * {@inheritDoc}
     */
    public function password(int $length): string
    {
        $password = [
            $this->string(1, Vocabulary::ALPHA_LOWER),
        ];
        --$length;

        if ($length > 0) {
            $password[] = $this->string(1, Vocabulary::ALPHA_UPPER);
            --$length;
        }

        if ($length > 0) {
            $password[] = $this->string(1, Vocabulary::NUMERIC);
            --$length;
        }

        if ($length > 0) {
            $password[] = $this->string(1, Vocabulary::SPECIAL);
            --$length;
        }

        if ($length > 0) {
            $password[] = $this->string($length, Vocabulary::ALL);
        }

        shuffle($password);

        return implode('', $password);
    }

    /**
     * {@inheritDoc}
     */
    public function string(int $length, string $vocabulary): string
    {
        if ($length < 0) {
            throw new \InvalidArgumentException('Length can be less than zero');
        }

        if ($vocabulary === '') {
            throw new \InvalidArgumentException('Vocabulary must be a non empty string');
        }

        $vocabularyArray = mb_str_split($vocabulary);
        $vocabularyLength = \count($vocabularyArray) - 1;

        $string = '';
        for ($i = 0; $i < $length; ++$i) {
            $number = $this->randomEngine->rand(RandomEngine::RAND_MIN, $vocabularyLength);
            $string .= $vocabularyArray[$number];
        }

        return $string;
    }
}
