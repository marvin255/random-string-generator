<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\Tests\RandomEngine;

use Marvin255\RandomStringGenerator\RandomEngine\RandomIntEngine;
use Marvin255\RandomStringGenerator\Tests\BaseCase;

/**
 * @internal
 */
class RandomIntEngineTest extends BaseCase
{
    /**
     * @test
     */
    public function testRand(): void
    {
        $from = 12;
        $to = 4321;

        $generator = new RandomIntEngine();

        $rand = $generator->rand($from, $to);

        $this->assertGreaterThanOrEqual($from, $rand);
        $this->assertLessThanOrEqual($to, $rand);
    }
}
