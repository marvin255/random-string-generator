<?php

declare(strict_types=1);

namespace Marvin255\RandomStringGenerator\Tests\RandomEngine;

use Marvin255\RandomStringGenerator\RandomEngine\RandomizerFastEngine;
use Marvin255\RandomStringGenerator\Tests\BaseCase;

/**
 * @internal
 */
final class RandomizerFastEngineTest extends BaseCase
{
    public function testRand(): void
    {
        $from = 12;
        $to = 4321;

        $generator = new RandomizerFastEngine();

        $rand = $generator->rand($from, $to);

        $this->assertGreaterThanOrEqual($from, $rand);
        $this->assertLessThanOrEqual($to, $rand);
    }
}
