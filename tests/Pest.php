<?php

/**
 * Pest configuration, for the Unit suite.
 *
 * The Integration suite is class-based PHPUnit 9.6 under tests/Integration, run
 * from its own Composer setup; Pest never loads it.
 */

declare(strict_types=1);

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

use function Brain\Monkey\setUp;
use function Brain\Monkey\tearDown;

/**
 * Brain Monkey around every test.
 *
 * setUp() defines WordPress' hook functions and arms Patchwork; tearDown()
 * verifies every expectation the test set (a `->once()` that never happened
 * fails here) and removes every mock, so nothing leaks into the next test.
 *
 * The assertion count: Brain Monkey's expectations are Mockery expectations,
 * which PHPUnit does not count. `MockeryPHPUnitIntegration` adds them, so a test
 * whose only check is `Functions\expect(...)->once()` is not reported as risky
 * (failOnRisky would fail it).
 *
 * This is a class, not a `uses()->afterEach()` closure, because the closure's
 * `$this` is `mixed` to PHPStan at level 10, and a class types it.
 */
abstract class BrainMonkeyTestCase extends TestCase
{
    use MockeryPHPUnitIntegration;

    protected function setUp(): void
    {
        parent::setUp();

        setUp();
    }

    protected function tearDown(): void
    {
        tearDown();

        parent::tearDown();
    }
}

uses(BrainMonkeyTestCase::class)->in('Unit');
