<?php
/**
 * Plugin main class
 *
 * @package Bunbury\CountdownTimer
 */

namespace Bunbury\CountdownTimer;

use Bunbury\CountdownTimer\Admin\Admin;
use Bunbury\CountdownTimer\Admin\Menus;
use Bunbury\CountdownTimer\Core\Timer;
use Bunbury\CountdownTimer\Frontend\Shortcode;

/**
 * Class Plugin
 * @package Bunbury\CountdownTimer
 */
class Plugin {

    /**
     * Plugin version
     *
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * The single instance of the class
     *
     * @var \Bunbury\CountdownTimer\Plugin
     * @since 1.0.0
     */
    private static $instance = null;

    /**
     * Plugin data
     *
     * @var array
     * @since 1.0.0
     */
    private $data = [];

    /**
     * Plugin constructor.
     *
     * @param array $data
     * @since 1.0.0
     * @return void
     */
    private function __construct( array $data = [] ) {
        $this->data = $data;
    }

    /**
     * Initializes a singleton instance
     *
     * @param array $data
     *
     * @since 1.0.0
     * @return \Bunbury\CountdownTimer\Plugin
     */
    public static function instance( array $data = [] ): Plugin {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self( $data );
        }
        return self::$instance;
    }

    /**
     * Initialize the plugin
     *
     * @since 1.0.0
     * @return void
     */
    public function init(): void {
        if ( is_admin() ) {
            new Admin();
            new Menus();
        } else {
            new Shortcode();
        }

        new Timer();
    }
}
