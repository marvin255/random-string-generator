<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\Tests\Generator;

use Marvin255\RandomStringGenerator\Generator\BasicRandomStringGenerator;
use Marvin255\RandomStringGenerator\RandomEngine\MtRandomEngine;
use Marvin255\RandomStringGenerator\Tests\BaseCase;
use Marvin255\RandomStringGenerator\Vocabulary\Vocabulary;

/**
 * @internal
 */
final class BasicRandomStringGeneratorTest extends BaseCase
{
    private const MESSAGE_ZERO_LENGTH = 'Length can be less than zero';
    private const MESSAGE_EMTY_VOCABULARY = 'Vocabulary must be a non empty string';
    private const MESSAGE_LESS_THAN_MIN_LENGTH = 'Length can be less than four';

    /**
     * @test
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('provideAlphanumeric')]
    public function testAlphanumeric(int $length, ?\Exception $e = null): void
    {
        $vocabulary = Vocabulary::ALPHA_NUMERIC;
        $engine = new MtRandomEngine();
        $generator = new BasicRandomStringGenerator($engine);

        if ($e) {
            $this->expectExceptionObject($e);
        }

        $rand = $generator->alphanumeric($length);
        $randLength = mb_strlen($rand);

        $this->assertSame($length, $randLength);
        for ($i = 0; $i < $randLength; ++$i) {
            $symbol = mb_substr($rand, $i, 1);
            $this->assertNotFalse(strpos($vocabulary->value, $symbol));
        }
    }

    public static function provideAlphanumeric(): array
    {
        return [
            'one symbol' => [
                1,
            ],
            'zero symbols' => [
                0,
            ],
            'more symbols' => [
                10,
            ],
            'negative length exception' => [
                -1,
                new \InvalidArgumentException(self::MESSAGE_ZERO_LENGTH),
            ],
        ];
    }

    /**
     * @test
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('provideAlpha')]
    public function testAlpha(int $length, ?\Exception $e = null): void
    {
        $vocabulary = Vocabulary::ALPHA;
        $engine = new MtRandomEngine();
        $generator = new BasicRandomStringGenerator($engine);

        if ($e) {
            $this->expectExceptionObject($e);
        }

        $rand = $generator->alpha($length);
        $randLength = mb_strlen($rand);

        $this->assertSame($length, $randLength);
        for ($i = 0; $i < $randLength; ++$i) {
            $symbol = mb_substr($rand, $i, 1);
            $this->assertNotFalse(strpos($vocabulary->value, $symbol));
        }
    }

    public static function provideAlpha(): array
    {
        return [
            'one symbol' => [
                1,
            ],
            'zero symbols' => [
                0,
            ],
            'more symbols' => [
                10,
            ],
            'negative length exception' => [
                -1,
                new \InvalidArgumentException(self::MESSAGE_ZERO_LENGTH),
            ],
        ];
    }

    /**
     * @test
     *
     * @psalm-suppress InvalidLiteralArgument
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('provideNumeric')]
    public function testNumeric(int $length, ?\Exception $e = null): void
    {
        $vocabulary = Vocabulary::NUMERIC;
        $engine = new MtRandomEngine();
        $generator = new BasicRandomStringGenerator($engine);

        if ($e) {
            $this->expectExceptionObject($e);
        }

        $rand = $generator->numeric($length);
        $randLength = mb_strlen($rand);

        $this->assertSame($length, $randLength);
        for ($i = 0; $i < $randLength; ++$i) {
            $symbol = mb_substr($rand, $i, 1);
            $this->assertNotFalse(strpos($vocabulary->value, $symbol));
        }
    }

    public static function provideNumeric(): array
    {
        return [
            'one symbol' => [
                1,
            ],
            'zero symbols' => [
                0,
            ],
            'more symbols' => [
                10,
            ],
            'negative length exception' => [
                -1,
                new \InvalidArgumentException(self::MESSAGE_ZERO_LENGTH),
            ],
        ];
    }

    /**
     * @test
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('providePassword')]
    public function testPassword(int $length, ?\Exception $e = null): void
    {
        $engine = new MtRandomEngine();
        $generator = new BasicRandomStringGenerator($engine);

        if ($e) {
            $this->expectExceptionObject($e);
        }

        $rand = $generator->password($length);

        $randSplit = str_split($rand);
        $randLength = mb_strlen($rand);
        $vocabulary = str_split(Vocabulary::ALL->value);

        $this->assertSame($length, $randLength);
        $this->assertNotEmpty(
            array_intersect(
                str_split(Vocabulary::NUMERIC->value),
                $randSplit
            ),
            'Need numeric'
        );
        $this->assertNotEmpty(
            array_intersect(
                str_split(Vocabulary::ALPHA->value),
                $randSplit
            ),
            'Need alphabet symbol'
        );
        $this->assertNotEmpty(
            array_intersect(
                str_split(Vocabulary::SPECIAL->value),
                $randSplit
            ),
            'Need special symbol'
        );
        for ($i = 0; $i < $randLength; ++$i) {
            $symbol = mb_substr($rand, $i, 1);
            $this->assertTrue(\in_array($symbol, $vocabulary));
        }
    }

    public static function providePassword(): array
    {
        return [
            'more symbols' => [
                10,
            ],
            'min required symbols' => [
                4,
            ],
            'negative length' => [
                -1,
                new \InvalidArgumentException(self::MESSAGE_LESS_THAN_MIN_LENGTH),
            ],
            'length less tham min password' => [
                3,
                new \InvalidArgumentException(self::MESSAGE_LESS_THAN_MIN_LENGTH),
            ],
        ];
    }

    /**
     * @test
     *
     * @psalm-suppress InvalidLiteralArgument
     */
    public function testPasswordShuffle(): void
    {
        $engine = new MtRandomEngine();
        $generator = new BasicRandomStringGenerator($engine);

        $rand = $generator->password(20);

        $alphaLower = Vocabulary::ALPHA_LOWER->value;
        $alphaUpper = Vocabulary::ALPHA_UPPER->value;
        $numeric = Vocabulary::NUMERIC->value;
        $special = Vocabulary::SPECIAL->value;

        $is1Symbol = mb_strpos($alphaLower, mb_substr($rand, 0, 1)) !== false;
        $is2Symbol = mb_strpos($alphaUpper, mb_substr($rand, 1, 1)) !== false;
        $is3Symbol = mb_strpos($numeric, mb_substr($rand, 2, 1)) !== false;
        $is4Symbol = mb_strpos($special, mb_substr($rand, 3, 1)) !== false;

        $this->assertFalse($is1Symbol && $is2Symbol && $is3Symbol && $is4Symbol);
    }

    /**
     * @test
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('provideString')]
    public function testString(int $length, string|Vocabulary $vocabulary, ?\Exception $e = null): void
    {
        $engine = new MtRandomEngine();
        $generator = new BasicRandomStringGenerator($engine);

        if ($e) {
            $this->expectExceptionObject($e);
        }

        $rand = $generator->string($length, $vocabulary);
        $randLength = mb_strlen($rand);

        $this->assertSame($length, $randLength);
        for ($i = 0; $i < $randLength; ++$i) {
            $symbol = mb_substr($rand, $i, 1);
            $vocabularyString = \is_string($vocabulary) ? $vocabulary : $vocabulary->value;
            $this->assertNotFalse(mb_strpos($vocabularyString, $symbol));
        }
    }

    public static function provideString(): array
    {
        return [
            'random vocabulary' => [
                10,
                '1b_',
            ],
            'different languages vocabulary' => [
                10,
                'ЙЯČáě日本',
            ],
            'utf vocabulary' => [
                10,
                '⛱⛰⛴⛽',
            ],
            'utf vocabulary one symbol' => [
                1,
                '⛱⛰⛴⛽',
            ],
            'one symbol' => [
                1,
                '123',
            ],
            'zero symbols' => [
                0,
                '123',
            ],
            'vocabulary with one symbol' => [
                10,
                '1',
            ],
            'vocabulary enum' => [
                10,
                Vocabulary::ALPHA_NUMERIC,
            ],
            'negative length' => [
                -10,
                '1',
                new \InvalidArgumentException(self::MESSAGE_ZERO_LENGTH),
            ],
            'empty vocabulary' => [
                10,
                '',
                new \InvalidArgumentException(self::MESSAGE_EMTY_VOCABULARY),
            ],
        ];
    }
}
