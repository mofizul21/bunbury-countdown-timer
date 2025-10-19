<?php
/**
 * Frontend Shortcode class
 *
 * @package Bunbury\CountdownTimer\Frontend
 */

namespace Bunbury\CountdownTimer\Frontend;

use Bunbury\CountdownTimer\Core\Timer;

/**
 * Class Shortcode
 * @package Bunbury\CountdownTimer\Frontend
 */
class Shortcode {

    /**
     * Shortcode constructor.
     *
     * @since 1.0.0
     * @return void
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
        add_shortcode( 'bunbury_countdown_timer', [ $this, 'render_shortcode' ] );
    }

    /**
     * Enqueue frontend scripts
     *
     * @since 1.0.0
     * @return void
     */
    public function enqueue_scripts(): void {
        wp_enqueue_style( 'bct-frontend-style', BCT_ASSETS . '/css/frontend.css', [], BCT_VERSION );
        wp_enqueue_script( 'bct-frontend-script', BCT_ASSETS . '/js/frontend.js', [ 'jquery' ], BCT_VERSION, true );
    }

    /**
     * Render shortcode
     *
     * @since 1.0.0
     * @return string
     */
    public function render_shortcode(): string {
        $options = get_option( 'bct_settings' );

        if ( false === $options ) {
            $display_timer = 1;
        } else {
            $display_timer = isset( $options['display_timer'] ) && $options['display_timer'] ? 1 : 0;
        }

        if ( ! $display_timer ) {
            return '';
        }

        $timer = new Timer();
        $end_time = $timer->get_end_time();
        $current_time = $timer->get_current_time();

        $text = $options['timer_text'] ?? '24 hours only | Save $10 with this coupon code <b>WIDEAL</b> and book now.';
        $background_color = $options['background_color'] ?? '#c2e9eb';
        $text_size = $options['text_size'] ?? '16';
        $text_color = $options['text_color'] ?? '#000000';

        ob_start();
        ?>
        <div class="bct-countdown-timer-wrapper" style="background-color: <?php echo esc_attr( $background_color ); ?>; font-size: <?php echo esc_attr( $text_size ); ?>px; color: <?php echo esc_attr( $text_color ); ?>;" data-end-time="<?php echo esc_attr( $end_time ); ?>" data-current-time="<?php echo esc_attr( $current_time ); ?>">
            <p><?php echo wp_kses_post( $text ); ?></p>
            <p class="bct-timer"><strong><?php esc_html_e( 'Ends in', 'bunbury-countdown-timer' ); ?> <span class="bct-hours"></span>h <span class="bct-minutes"></span>m <span class="bct-seconds"></span>s.</strong></p>
        </div>
        <?php
        return ob_get_clean();
    }
}
