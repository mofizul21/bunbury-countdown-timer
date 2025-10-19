<?php
/**
 * Plugin Name: Bunbury Countdown Timer
 * Description: A simple countdown timer plugin.
 * Version: 1.0.1
 * Author: WP Algo
 * Author URI: https://wpalgo.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: bunbury-countdown-timer
 * Domain Path: /languages
 *
 * @package Bunbury\CountdownTimer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class Bunbury_Countdown_Timer {

	/**
	 * Plugin version
	 *
	 * @var string
	 */
	const VERSION = '1.0.0';

	/**
	 * Class constructor
     *
     * @since 1.0.0
     * @return void
	 */
	private function __construct() {
		$this->define_constants();
		register_activation_hook( __FILE__, [ $this, 'activate' ] );
		add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
        add_filter( 'plugin_action_links_' . plugin_basename( BCT_FILE ), [ $this, 'add_action_links' ] );
	}

	/**
	 * Initializes a singleton instance
	 *
     * @since 1.0.0
	 * @return \Bunbury_Countdown_Timer
	 */
	public static function init(): \Bunbury_Countdown_Timer {
		static $instance = false;

		if ( ! $instance ) {
			$instance = new self();
		}

		return $instance;
	}

	/**
	 * Define the required plugin constants
	 *
     * @since 1.0.0
	 * @return void
	 */
	public function define_constants(): void {
		define( 'BCT_VERSION', self::VERSION );
		define( 'BCT_FILE', __FILE__ );
		define( 'BCT_PATH', __DIR__ );
		define( 'BCT_URL', plugins_url( '', BCT_FILE ) );
		define( 'BCT_ASSETS', BCT_URL . '/assets' );
	}

	/**
	 * Initialize the plugin
	 *
     * @since 1.0.0
	 * @return void
	 */
	public function init_plugin(): void {
        load_plugin_textdomain( 'bunbury-countdown-timer', false, dirname( plugin_basename( BCT_FILE ) ) . '/languages' );
        \Bunbury\CountdownTimer\Plugin::instance()->init();
	}

	/**
	 * Do stuff upon plugin activation
	 *
     * @since 1.0.0
	 * @return void
	 */
	public function activate(): void {
		$installed = get_option( 'bct_installed' );

		if ( ! $installed ) {
			update_option( 'bct_installed', time() );
		}

		update_option( 'bct_version', BCT_VERSION );
	}

    /**
     * Add action links
     *
     * @param array $links
     *
     * @since 1.0.0
     * @return array
     */
    public function add_action_links( array $links ): array {
        $settings_link = sprintf( '<a href="%s">%s</a>', admin_url( 'admin.php?page=bunbury-countdown-timer' ), __( 'Settings', 'bunbury-countdown-timer' ) );
        array_unshift( $links, $settings_link );
        return $links;
    }
}

/**
 * Initializes the main plugin
 *
 * @since 1.0.0
 * @return \Bunbury_Countdown_timer
 */
function bunbury_countdown_timer(): \Bunbury_Countdown_timer {
	return Bunbury_Countdown_Timer::init();
}

// kick-off the plugin
bunbury_countdown_timer();
