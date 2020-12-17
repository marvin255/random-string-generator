<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\RandomStringGenerator;

use Marvin255\RandomStringGenerator\RandomEngine\RandomEngine;
use Marvin255\RandomStringGenerator\Vocabulary\Vocabulary;

/**
 * Basic random string generator.
 */
class BasicRandomStringGenerator implements RandomStringGenerator
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
    public function string(int $length, string $vocabulary): string
    {
        $vocabularyLength = mb_strlen($vocabulary) - 1;

        $string = '';
        for ($i = 0; $i < $length; ++$i) {
            $number = $this->randomEngine->rand(0, $vocabularyLength);
            $string .= mb_substr($vocabulary, $number, 1);
        }

        return $string;
    }
}
