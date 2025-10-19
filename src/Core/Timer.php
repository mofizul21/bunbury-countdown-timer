<?php
/**
 * Core Timer class
 *
 * @package Bunbury\CountdownTimer\Core
 */

namespace Bunbury\CountdownTimer\Core;

/**
 * Class Timer
 * @package Bunbury\CountdownTimer\Core
 */
class Timer {

    /**
     * Get end time
     *
     * @since 1.0.0
     * @return int
     */
    public function get_end_time(): int {
        return strtotime( 'today 23:59:59' );
    }

    /**
     * Get current time
     *
     * @since 1.0.0
     * @return int
     */
    public function get_current_time(): int {
        return time();
    }
}