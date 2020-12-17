<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\RandomStringGenerator;

/**
 * Generator that always return set string. Useful for test environment.
 */
class DummyRandomStringGenerator implements RandomStringGenerator
{
    private string $dummyString;

    public function __construct(string $dummyString)
    {
        $this->dummyString = $dummyString;
    }

    /**
     * @inheritDoc
     */
    public function alphanumeric(int $length): string
    {
        return $this->dummyString;
    }

    /**
     * @inheritDoc
     */
    public function alpha(int $length): string
    {
        return $this->dummyString;
    }

    /**
     * @inheritDoc
     */
    public function numeric(int $length): string
    {
        return $this->dummyString;
    }

    /**
     * @inheritDoc
     */
    public function string(int $length, string $vocabulary): string
    {
        return $this->dummyString;
    }
}
