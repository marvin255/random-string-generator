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
class BasicRandomStringGeneratorTest extends BaseCase
{
    private const MESSAGE_ZERO_LENGTH = 'Length can be less than zero';
    private const MESSAGE_EMTY_VOCABULARY = 'Vocabulary must be a non empty string';
    private const MESSAGE_LESS_THAN_MIN_LENGTH = 'Length can be less than four';

    /**
     * @test
     *
     * @dataProvider provideAlphanumeric
     */
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
            $this->assertNotFalse(strpos($vocabulary, $symbol));
        }
    }

    public function provideAlphanumeric(): array
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
     * @dataProvider provideAlpha
     */
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
            $this->assertNotFalse(strpos($vocabulary, $symbol));
        }
    }

    public function provideAlpha(): array
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
     * @dataProvider provideNumeric
     *
     * @psalm-suppress InvalidLiteralArgument
     */
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
            $this->assertNotFalse(strpos($vocabulary, $symbol));
        }
    }

    public function provideNumeric(): array
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
     * @dataProvider providePassword
     */
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
        $vocabulary = str_split(Vocabulary::ALL);

        $this->assertSame($length, $randLength);
        $this->assertNotEmpty(
            array_intersect(
                str_split(Vocabulary::NUMERIC),
                $randSplit
            ),
            'Need numeric'
        );
        $this->assertNotEmpty(
            array_intersect(
                str_split(Vocabulary::ALPHA),
                $randSplit
            ),
            'Need alphabet symbol'
        );
        $this->assertNotEmpty(
            array_intersect(
                str_split(Vocabulary::SPECIAL),
                $randSplit
            ),
            'Need special symbol'
        );
        for ($i = 0; $i < $randLength; ++$i) {
            $symbol = mb_substr($rand, $i, 1);
            $this->assertTrue(\in_array($symbol, $vocabulary));
        }
    }

    public function providePassword(): array
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
     */
    public function testPasswordShuffle(): void
    {
        $engine = new MtRandomEngine();
        $generator = new BasicRandomStringGenerator($engine);

        $rand = $generator->password(20);

        $is1Symbol = mb_strpos(Vocabulary::ALPHA_LOWER, mb_substr($rand, 0, 1));
        $is2Symbol = mb_strpos(Vocabulary::ALPHA_UPPER, mb_substr($rand, 1, 1));
        $is3Symbol = mb_strpos(Vocabulary::NUMERIC, mb_substr($rand, 2, 1));
        $is4Symbol = mb_strpos(Vocabulary::SPECIAL, mb_substr($rand, 3, 1));

        $this->assertFalse($is1Symbol && $is2Symbol && $is3Symbol && $is4Symbol);
    }

    /**
     * @test
     *
     * @dataProvider provideString
     */
    public function testString(int $length, string $vocabulary, ?\Exception $e = null): void
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
            $this->assertNotFalse(mb_strpos($vocabulary, $symbol));
        }
    }

    public function provideString(): array
    {
        return [
            'random vocabulary' => [
                10,
                '1b_',
            ],
            'utf vocabulary' => [
                10,
                'Ёю😁1',
            ],
            'utf vocabulary one symbol' => [
                1,
                '😁',
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
