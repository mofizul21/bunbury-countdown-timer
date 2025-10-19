<?php
/**
 * Admin class
 *
 * @package Bunbury\CountdownTimer\Admin
 */

namespace Bunbury\CountdownTimer\Admin;

/**
 * Class Admin
 * @package Bunbury\CountdownTimer\Admin
 */
class Admin {

    /**
     * Admin constructor.
     *
     * @since 1.0.0
     * @return void
     */
    public function __construct() {
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }

    /**
     * Enqueue admin scripts
     *
     * @param string $hook
     *
     * @since 1.0.0
     * @return void
     */
    public function enqueue_scripts( string $hook ): void {
        if ( 'toplevel_page_bunbury-countdown-timer' !== $hook ) {
            return;
        }

        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'bct-admin-script', BCT_ASSETS . '/js/admin.js', [ 'jquery', 'wp-color-picker' ], BCT_VERSION, true );
    }
}
