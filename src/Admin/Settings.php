<?php
/**
 * Admin Settings class
 *
 * @package Bunbury\CountdownTimer\Admin
 */

namespace Bunbury\CountdownTimer\Admin;

/**
 * Class Settings
 * @package Bunbury\CountdownTimer\Admin
 */
class Settings {

    /**
     * Settings constructor.
     *
     * @since 1.0.0
     * @return void
     */
    public function __construct() {
        add_action( 'admin_init', [ $this, 'register_settings' ] );
    }

    /**
     * Register settings
     *
     * @since 1.0.0
     * @return void
     */
    public function register_settings(): void {
        register_setting( 'bunbury_countdown_timer_options', 'bct_settings' );

        add_settings_section(
            'bct_settings_section',
            __( 'Countdown Timer Settings', 'bunbury-countdown-timer' ),
            null,
            'bunbury-countdown-timer'
        );

        add_settings_field(
            'bct_display_timer',
            __( 'Display Timer Clock', 'bunbury-countdown-timer' ),
            [ $this, 'display_timer_callback' ],
            'bunbury-countdown-timer',
            'bct_settings_section'
        );

        add_settings_field(
            'bct_timer_text',
            __( 'Timer Text', 'bunbury-countdown-timer' ),
            [ $this, 'timer_text_callback' ],
            'bunbury-countdown-timer',
            'bct_settings_section'
        );

        add_settings_field(
            'bct_background_color',
            __( 'Background Color', 'bunbury-countdown-timer' ),
            [ $this, 'background_color_callback' ],
            'bunbury-countdown-timer',
            'bct_settings_section'
        );

        add_settings_field(
            'bct_text_size',
            __( 'Text Size', 'bunbury-countdown-timer' ),
            [ $this, 'text_size_callback' ],
            'bunbury-countdown-timer',
            'bct_settings_section'
        );

        add_settings_field(
            'bct_text_color',
            __( 'Text Color', 'bunbury-countdown-timer' ),
            [ $this, 'text_color_callback' ],
            'bunbury-countdown-timer',
            'bct_settings_section'
        );
    }

    /**
     * Display timer callback
     *
     * @since 1.0.0
     * @return void
     */
    public function display_timer_callback(): void {
        $options = get_option( 'bct_settings' );
        $checked = 1; // Default to checked

        if ( is_array( $options ) ) {
            $checked = $options['display_timer'] ?? 0;
        }

        echo '<input type="checkbox" name="bct_settings[display_timer]" value="1" ' . checked( 1, $checked, false ) . ' />';
    }

    /**
     * Timer text callback
     *
     * @since 1.0.0
     * @return void
     */
    public function timer_text_callback(): void {
        $options = get_option( 'bct_settings' );
        $text = $options['timer_text'] ?? '<strong>24 hours only</strong> | To save $10 book now and use the <u>SAVE10</u> coupon code.';
        echo '<textarea name="bct_settings[timer_text]" rows="5" cols="50">' . $text . '</textarea>';
    }

    /**
     * Background color callback
     *
     * @since 1.0.0
     * @return void
     */
    public function background_color_callback(): void {
        $options = get_option( 'bct_settings' );
        $color = $options['background_color'] ?? '#c2e9eb';
        echo '<input type="text" name="bct_settings[background_color]" value="' . $color . '" class="bct-color-picker" />';
    }

    /**
     * Text size callback
     *
     * @since 1.0.0
     * @return void
     */
    public function text_size_callback(): void {
        $options = get_option( 'bct_settings' );
        $size = $options['text_size'] ?? '16';
        echo '<input type="number" name="bct_settings[text_size]" value="' . $size . '" /> px';
    }

    /**
     * Text color callback
     *
     * @since 1.0.0
     * @return void
     */
    public function text_color_callback(): void {
        $options = get_option( 'bct_settings' );
        $color = $options['text_color'] ?? '#000000';
        echo '<input type="text" name="bct_settings[text_color]" value="' . $color . '" class="bct-color-picker" />';
    }

    /**
     * Display settings page
     *
     * @since 1.0.0
     * @return void
     */
    public function display(): void {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

            <?php settings_errors(); ?>

<p><?php esc_html_e( 'Use this shortcode any page or widget to display the countdown clock', 'bunbury-countdown-timer' ); ?>: <code>[bunbury_countdown_timer]</code></p>
            <form action="options.php" method="post">
                <?php
                settings_fields( 'bunbury_countdown_timer_options' );
                do_settings_sections( 'bunbury-countdown-timer' );
                submit_button( 'Save Changes' );
                ?>
            </form>
        </div>
        <?php
    }
}
