<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\Tests\Generator;

use Marvin255\RandomStringGenerator\Generator\DummyRandomStringGenerator;
use Marvin255\RandomStringGenerator\Tests\BaseCase;

class DummyRandomStringGeneratorTest extends BaseCase
{
    /**
     * @test
     */
    public function testAlphanumeric(): void
    {
        $length = 10;
        $string = 'test';

        $generator = new DummyRandomStringGenerator($string);

        $rand = $generator->alphanumeric($length);

        $this->assertSame($string, $rand);
    }

    /**
     * @test
     */
    public function testAlpha(): void
    {
        $length = 10;
        $string = 'test';

        $generator = new DummyRandomStringGenerator($string);

        $rand = $generator->alpha($length);

        $this->assertSame($string, $rand);
    }

    /**
     * @test
     */
    public function testNumeric(): void
    {
        $length = 10;
        $string = '12345';

        $generator = new DummyRandomStringGenerator($string);

        $rand = $generator->numeric($length);

        $this->assertSame($string, $rand);
    }

    /**
     * @test
     */
    public function testPassword(): void
    {
        $length = 10;
        $string = '12345';

        $generator = new DummyRandomStringGenerator($string);

        $rand = $generator->password($length);

        $this->assertSame($string, $rand);
    }

    /**
     * @test
     */
    public function testString(): void
    {
        $length = 10;
        $string = 'test';

        $generator = new DummyRandomStringGenerator($string);

        $rand = $generator->string($length, $string);

        $this->assertSame($string, $rand);
    }
}
