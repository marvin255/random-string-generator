<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\Vocabulary;

/**
 * List of vocabularies to generate random strings.
 */
enum Vocabulary: string
{
    case ALPHA_UPPER = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    case ALPHA_LOWER = 'abcdefghijklmnopqrstuvwxyz';
    case ALPHA = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    case NUMERIC = '0123456789';
    case ALPHA_NUMERIC = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    case SPECIAL = '_!#()[]{}-,.?';
    case ALL = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_!#()[]{}-,.?';
}
