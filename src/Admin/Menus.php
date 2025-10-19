<?php
/**
 * Admin Menus class
 *
 * @package Bunbury\CountdownTimer\Admin
 */

namespace Bunbury\CountdownTimer\Admin;

/**
 * Class Menus
 * @package Bunbury\CountdownTimer\Admin
 */
class Menus {

    /**
     * Menus constructor.
     *
     * @since 1.0.0
     * @return void
     */
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'admin_menu' ] );
    }

    /**
     * Register admin menu
     *
     * @since 1.0.0
     * @return void
     */
    public function admin_menu(): void {
        $settings = new Settings();

        add_menu_page(
            __( 'Countdown Timer', 'bunbury-countdown-timer' ),
            __( 'Countdown Timer', 'bunbury-countdown-timer' ),
            'manage_options',
            'bunbury-countdown-timer',
            [ $settings, 'display' ],
            'dashicons-clock'
        );
    }
}
