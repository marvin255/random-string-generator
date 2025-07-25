<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\Generator;

use Marvin255\RandomStringGenerator\RandomEngine\RandomEngine;
use Marvin255\RandomStringGenerator\Vocabulary\Vocabulary;

/**
 * Basic random string generator.
 *
 * @internal
 */
final class BasicRandomStringGenerator implements RandomStringGenerator
{
    public function __construct(private readonly RandomEngine $randomEngine)
    {
    }

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function alphanumeric(int $length): string
    {
        return $this->string($length, Vocabulary::ALPHA_NUMERIC);
    }

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function alpha(int $length): string
    {
        return $this->string($length, Vocabulary::ALPHA);
    }

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function numeric(int $length): string
    {
        return $this->string($length, Vocabulary::NUMERIC);
    }

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function password(int $length): string
    {
        if ($length < self::MIN_PASSWORD_LENGTH) {
            throw new \InvalidArgumentException('Length can be less than four');
        }

        $password = [
            $this->string(1, Vocabulary::ALPHA_LOWER),
            $this->string(1, Vocabulary::ALPHA_UPPER),
            $this->string(1, Vocabulary::NUMERIC),
            $this->string(1, Vocabulary::SPECIAL),
        ];

        $additionalString = $this->string(
            $length - self::MIN_PASSWORD_LENGTH,
            Vocabulary::ALL
        );
        $additionalSymbols = str_split($additionalString);
        $password = array_merge($password, $additionalSymbols);

        shuffle($password);

        return implode('', $password);
    }

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function string(int $length, string|Vocabulary $vocabulary): string
    {
        if ($length < 0) {
            throw new \InvalidArgumentException('Length can be less than zero');
        }

        if ($vocabulary === '') {
            throw new \InvalidArgumentException('Vocabulary must be a non empty string');
        }

        $vocabularyString = \is_string($vocabulary) ? $vocabulary : $vocabulary->value;
        $vocabularyArray = mb_str_split($vocabularyString);
        $vocabularyLength = \count($vocabularyArray) - 1;

        $string = '';
        for ($i = 0; $i < $length; ++$i) {
            $number = $this->randomEngine->rand(RandomEngine::RAND_MIN, $vocabularyLength);
            $string .= $vocabularyArray[$number];
        }

        return $string;
    }
}
