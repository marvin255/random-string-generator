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
    /**
     * @test
     */
    public function testAlphanumeric(): void
    {
        $length = 10;

        $engine = new MtRandomEngine();
        $generator = new BasicRandomStringGenerator($engine);

        $rand = $generator->alphanumeric($length);

        $randLength = mb_strlen($rand);
        $this->assertSame($length, $randLength);
        for ($i = 0; $i < $randLength; ++$i) {
            $inVocabulary = mb_strpos(Vocabulary::ALPHA_NUMERIC, $rand[$i]) !== false;
            $this->assertTrue($inVocabulary);
        }
    }

    /**
     * @test
     */
    public function testAlpha(): void
    {
        $length = 10;

        $engine = new MtRandomEngine();
        $generator = new BasicRandomStringGenerator($engine);

        $rand = $generator->alpha($length);

        $randLength = mb_strlen($rand);
        $this->assertSame($length, $randLength);
        for ($i = 0; $i < $randLength; ++$i) {
            $inVocabulary = mb_strpos(Vocabulary::ALPHA, $rand[$i]) !== false;
            $this->assertTrue($inVocabulary);
        }
    }

    /**
     * @test
     *
     * @psalm-suppress InvalidLiteralArgument
     */
    public function testNumeric(): void
    {
        $length = 10;

        $engine = new MtRandomEngine();
        $generator = new BasicRandomStringGenerator($engine);

        $rand = $generator->numeric($length);

        $randLength = mb_strlen($rand);
        $this->assertSame($length, $randLength);
        for ($i = 0; $i < $randLength; ++$i) {
            $inVocabulary = mb_strpos(Vocabulary::NUMERIC, $rand[$i]) !== false;
            $this->assertTrue($inVocabulary);
        }
    }

    /**
     * @test
     */
    public function testPassword(): void
    {
        $length = 10;

        $engine = new MtRandomEngine();
        $generator = new BasicRandomStringGenerator($engine);

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

    /**
     * @test
     */
    public function testString(): void
    {
        $length = 10;
        $vocabulary = ['1', 'b', '_'];

        $engine = new MtRandomEngine();
        $generator = new BasicRandomStringGenerator($engine);

        $rand = $generator->string($length, implode('', $vocabulary));

        $randLength = mb_strlen($rand);
        $this->assertSame($length, $randLength);
        for ($i = 0; $i < $randLength; ++$i) {
            $symbol = mb_substr($rand, $i, 1);
            $this->assertTrue(\in_array($symbol, $vocabulary));
        }
    }

    /**
     * @test
     */
    public function testStringWithUtf(): void
    {
        $length = 10;
        $vocabulary = ['Ё', 'ю', '😁', '1'];

        $engine = new MtRandomEngine();
        $generator = new BasicRandomStringGenerator($engine);

        $rand = $generator->string($length, implode('', $vocabulary));

        $randLength = mb_strlen($rand);
        $this->assertSame($length, $randLength);
        for ($i = 0; $i < $randLength; ++$i) {
            $symbol = mb_substr($rand, $i, 1);
            $this->assertTrue(\in_array($symbol, $vocabulary));
        }
    }
}
