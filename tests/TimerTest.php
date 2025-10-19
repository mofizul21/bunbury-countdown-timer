<?php

use Bunbury\CountdownTimer\Core\Timer;
use Yoast\WPTestUtils\BrainMonkey\TestCase;
use Brain\Monkey\Functions;

class Timer_Test extends TestCase {

    public function test_get_end_time_returns_expected_timestamp() {
        // 1. The "Arrange" step: Set up the test.
        // We are mocking the global strtotime() function.
        // We tell it that whenever it's called with 'today 23:59:59',
        // it should return our expected timestamp, 1672531199 (which is Dec 31, 2022 23:59:59).
        $expected_timestamp = 1672531199;
        Functions\when('strtotime')
            ->justReturn($expected_timestamp);

        // 2. The "Act" step: Call the method we are testing.
        $timer = new Timer();
        $result = $timer->get_end_time();

        // 3. The "Assert" step: Check if the result is what we expect.
        $this->assertEquals($expected_timestamp, $result);
    }
}
