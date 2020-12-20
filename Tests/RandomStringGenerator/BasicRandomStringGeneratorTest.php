<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\Tests\RandomStringGenerator;

use Marvin255\RandomStringGenerator\RandomEngine\MtRandomEngine;
use Marvin255\RandomStringGenerator\RandomStringGenerator\BasicRandomStringGenerator;
use Marvin255\RandomStringGenerator\Tests\BaseCase;
use Marvin255\RandomStringGenerator\Vocabulary\Vocabulary;

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
            $this->assertTrue(in_array($symbol, $vocabulary));
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
            $this->assertTrue(in_array($symbol, $vocabulary));
        }
    }
}
