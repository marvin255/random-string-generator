<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\Generator;

use Marvin255\RandomStringGenerator\Vocabulary\Vocabulary;

/**
 * Generator that always return set string. Useful for test environment.
 *
 * @internal
 */
final class DummyRandomStringGenerator implements RandomStringGenerator
{
    public function __construct(private readonly string $dummyString)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function alphanumeric(int $length): string
    {
        return $this->dummyString;
    }

    /**
     * {@inheritDoc}
     */
    public function alpha(int $length): string
    {
        return $this->dummyString;
    }

    /**
     * {@inheritDoc}
     */
    public function numeric(int $length): string
    {
        return $this->dummyString;
    }

    /**
     * {@inheritDoc}
     */
    public function password(int $length): string
    {
        return $this->dummyString;
    }

    /**
     * {@inheritDoc}
     */
    public function string(int $length, string|Vocabulary $vocabulary): string
    {
        return $this->dummyString;
    }
}
