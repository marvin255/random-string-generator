<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\Vocabulary;

/**
 * List of vocabularies to generate random strings.
 */
class Vocabulary
{
    public const ALPHA_UPPER = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    public const ALPHA_LOWER = 'abcdefghijklmnopqrstuvwxyz';
    public const ALPHA = self::ALPHA_UPPER . self::ALPHA_LOWER;
    public const NUMERIC = '0123456789';
    public const ALPHA_NUMERIC = self::ALPHA . self::NUMERIC;
    public const SPECIAL = '_!#()[]{}-,.?';
    public const ALL = self::ALPHA_UPPER . self::ALPHA_LOWER . self::NUMERIC . self::SPECIAL;
}
