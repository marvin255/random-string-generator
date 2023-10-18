<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\Tests\RandomEngine;

use Marvin255\RandomStringGenerator\RandomEngine\RandomizerSecureEngine;
use Marvin255\RandomStringGenerator\Tests\BaseCase;

/**
 * @internal
 */
class RandomizerSecureEngineTest extends BaseCase
{
    /**
     * @test
     */
    public function testRand(): void
    {
        $from = 12;
        $to = 4321;

        $generator = new RandomizerSecureEngine();

        $rand = $generator->rand($from, $to);

        $this->assertGreaterThanOrEqual($from, $rand);
        $this->assertLessThanOrEqual($to, $rand);
    }
}
