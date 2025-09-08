<?php
/**
	* Plugin Name: Cardzone Core
	* Description: Cardzone elementor core plugin.
	* Plugin URI:  https://themeforest.net/user/pixelaxis/portfolio
	* Version:     1.0.2
	* Author:      Pixelaxis
	* Author URI:  https://themeforest.net/user/pixelaxis/portfolio
	* Text Domain: cardzone
	* Elementor tested up to: 3.17.3
*/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Controls_Manager;

/**
 * Define
*/
define('TPCORE_ADDONS_URL', plugins_url('/', __FILE__));
define('TPCORE_ADDONS_DIR', dirname(__FILE__));
define('TPCORE_ADDONS_PATH', plugin_dir_path(__FILE__));
define('TPCORE_ELEMENTS_PATH', TPCORE_ADDONS_DIR . '/include/elementor');
define('TPCORE_WIDGET_PATH', TPCORE_ADDONS_DIR . '/include/widgets');
define('TPCORE_INCLUDE_PATH', TPCORE_ADDONS_DIR . '/include');
define('TP_EXT_LOGO_ICON_URL', TPCORE_ADDONS_URL.'assets/img/logo.png' );

define( 'TP_ADDONS_FILE_', __FILE__ );
define( 'TP_ADDONS_VERSION_', '1.0.1');




/**
 * Include all files
*/
// include_once(TPCORE_ADDONS_DIR . '/include/custom-post-services.php');
// include_once(TPCORE_ADDONS_DIR . '/include/custom-post-jobs.php');
 include_once(TPCORE_ADDONS_DIR . '/include/custom-post-portfolio.php');
 include_once(TPCORE_ADDONS_DIR . '/include/card-listing-custom-post.php');
 include_once(TPCORE_ADDONS_DIR . '/include/card-featured-custom-post.php');
//  include_once(TPCORE_ADDONS_DIR . '/include/service.php');
 //include_once(TPCORE_ADDONS_DIR . '/include/custom-post-card.php');
//  include_once(TPCORE_ADDONS_DIR . '/include/card-listing-cpt.php');

include_once(TPCORE_ADDONS_DIR . '/include/common-functions.php');
include_once(TPCORE_ADDONS_DIR . '/include/class-ocdi-importer.php');
include_once(TPCORE_ADDONS_DIR . '/include/allow-svg.php');
include_once(plugin_dir_path(__FILE__) . '/include/post-view.php');
include_once(plugin_dir_path(__FILE__) . '/include/social-share.php');
include_once(plugin_dir_path(__FILE__) . '/include/tp-woo.php');

include_once(TPCORE_ADDONS_DIR . '/include/menu/menu.php');



/**
 * TP Custom Widget
*/
include_once(TPCORE_WIDGET_PATH . '/tp-blog-post-sidebar.php');
include_once(TPCORE_WIDGET_PATH . '/tp-footer-post-no-thumb.php');
include_once(TPCORE_WIDGET_PATH . '/tp-service-list.php');

if ( class_exists('Charitable_Campaign' ) ) {
	include_once(TPCORE_WIDGET_PATH . '/tp-donation-post.php');
}



// Filter shortcode


function custom_search_card_shortcode() {
    ob_start(); // Start output buffering

    // HTML and PHP code for the shortcode
    ?>
    <section class="search__card">
       
            <div class="find__searchcard">
                <form id="filter_form" action="<?php echo esc_url(get_permalink(get_page_by_path('results-page'))); ?>" method="GET">
                    <div class="row g-3 justify-content-center align-items-end">
                        <!-- Credit Score Filter -->
                        <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-6 col-sm-6">
                            <div class="card__find__item">
                                <span class="fz-18 fw-500 inter title mb-16 d-block">
                                    <?php echo esc_html__('What\'s your credit score?', 'cardzone'); ?>
                                </span>
                                <select name="credit_score" id="credit_score">
                                    <option value=""><?php echo esc_html__('Select Credit Score', 'cardzone'); ?></option>
                                    <?php
                                    // Fetch unique credit scores
                                    $credit_scores = get_posts(array(
                                        'post_type' => 'listing-card',
                                        'posts_per_page' => -1,
                                        'meta_key' => 'credit_score',
                                        'orderby' => 'meta_value',
                                        'order' => 'ASC',
                                        'fields' => 'ids'
                                    ));

                                    $credit_score_values = array();
                                    foreach ($credit_scores as $post_id) {
                                        $score = get_post_meta($post_id, 'credit_score', true);
                                        if ($score && !in_array($score, $credit_score_values)) {
                                            $credit_score_values[] = $score;
                                            echo '<option value="' . esc_attr($score) . '">' . esc_html($score) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Card Type Filter -->
                        <div class="col-xxl-5 col-xl-5 col-lg-4 col-md-6 col-sm-6">
                            <div class="card__find__item">
                                <span class="fz-18 fw-500 inter title mb-16 d-block">
                                    <?php echo esc_html__('What are you looking for?', 'cardzone'); ?>
                                </span>
                                <select name="card_type" id="card_type">
                                    <option value=""><?php echo esc_html__('Select Card Type', 'cardzone'); ?></option>
                                    <?php
                                    // Fetch unique card types
                                    $card_types = get_posts(array(
                                        'post_type' => 'listing-card',
                                        'posts_per_page' => -1,
                                        'meta_key' => 'card_type',
                                        'orderby' => 'meta_value',
                                        'order' => 'ASC',
                                        'fields' => 'ids'
                                    ));

                                    $card_type_values = array();
                                    foreach ($card_types as $post_id) {
                                        $type = get_post_meta($post_id, 'card_type', true);
                                        if ($type && !in_array($type, $card_type_values)) {
                                            $card_type_values[] = $type;
                                            echo '<option value="' . esc_attr($type) . '">' . esc_html($type) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-5">
                            <div class="card__find__item">
                                <button type="submit" class="cmn--btn filter-btn">
                                    <span style="color:#fff"><?php echo esc_html__('Find Your Card', 'cardzone'); ?></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
     
    </section>
    <?php

    return ob_get_clean(); // Return the buffered content
}

// Register the shortcode with WordPress
add_shortcode('search_card_form', 'custom_search_card_shortcode');

// include_once(TPCORE_WIDGET_PATH . '/tp-latest-posts-footer.php');



/**
 * Main Tp Core Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.2.0
 */
final class TP_Core {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.2.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

	
		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'plugin.php' );
	}


	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'cardzone' ),
			'<strong>' . esc_html__( 'Cardzone Core', 'cardzone' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'cardzone' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'cardzone' ),
			'<strong>' . esc_html__( 'Cardzone Core', 'cardzone' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'cardzone' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'cardzone' ),
			'<strong>' . esc_html__( 'Cardzone Core', 'cardzone' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'cardzone' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}

// Instantiate TP_Core.
new TP_Core();