<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\Vocabulary;

/**
 * List of vocabularies to generate random strings.
 */
class Vocabulary
{
    public const ALPHA = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    public const NUMERIC = '0123456789';
    public const ALPHA_NUMERIC = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
}
