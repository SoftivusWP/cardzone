<?php
/*
 * Plugin Name: Alike - WordPress Custom Post Comparison
 * Plugin URI: https://goo.gl/95KKLv
 * Description: Alike - is a WordPress post comparison plugin. It can compare between two or more posts in same post type.
 * Version: 2.1.6
 * Author: redqteam
 * Author URI: https://redq.io/
 * Requires at least: 4.5
 * Tested up to: 4.9.6
 *
 * Text Domain: alike
 * Domain Path: /languages/
 * 
 * Copyright: © 2015-2018 redqteam.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * 
 */

if(!defined('ABSPATH')) exit; // Exit if accessed directly
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Class Redq_Alike
 */
class Redq_Alike {

  /**
   * @var null
   */
  protected static $_instance = null;


  /**
   * @create instance on self
   */
  public static function instance() {
    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }


  public function __construct(){

    $this->ra_load_all_classes();
    $this->ra_app_bootstrap();
    add_action( 'plugins_loaded', array( &$this, 'ra_language_textdomain' ), 1 );
    add_action( 'wp_footer', array( $this, 'ra_footer_script' ) );
  }

  public function ra_footer_script() {
    $button_class = 'alike-compare-widget-button';
    ?>
    <script type="text/html" class="alike-list">
      <% if( _.isObject(items) ){ %>
      
        <% _.each(items, function(item,key,list){ %>
          <div class="alike-compare-widget-post">
            <div class="alike-compare-widget-post-remove">
              <span class="alike-compare-widget-post-remove-button" data-post-id="<%= item.postId %>">✕</span>
            </div>
            <div class="alike-compare-widget-post-image-wrapper" style="height: 112px; width: 112px;">
              <img class="alike-compare-widget-post-image" alt="<%= item.postTitle %>" src="<%= item.postThumb %>">
            </div>
            <div class="alike-compare-widget-post-title" title="<%= item.postTitle %>"><%= item.postTitle %></div>
          </div>

        <% }) %>

      <%  } %>
      <% if( _.isEmpty(items) ){ %>
        <div class="alike-widget-partials clearfix"><?php echo esc_html__('No Items Selected.', 'alike') ?></div>
      <%  } %>
    </script>
    
    <script type="text/html" class="alike-mobile-list">
      <% if( _.isObject(items) ){ %>
        <% _.each(items, function(item,key,list){ %>
          <div class="alike-compare-item">
            <div class="alike-item-image-wrap">
              <img src="<%= item.postThumb %>" alt="<%= item.postTitle %>">
            </div>
            <div class="alike-item-content">
              <h3><%= item.postTitle %></h3>
            </div>
            <a href="#" class="alike-close-item" data-post-id="<%= item.postId %>">
              <i class="ion-close-round" data-post-id="<%= item.postId %>"></i>
            </a>
          </div>
        <% }) %>

      <%  } %>
      <% if( _.isEmpty(items) ){ %>
        <div class="alike-widget-partials clearfix"><?php echo esc_html__('No Items Selected.', 'alike') ?></div>
      <%  } %>
    </script>
    
    <div class="alike-compare-area">
      <div id="alikeMobileDrawer" class="alike-mobile-drawer">
        <div class="alike-compare-list-wrapper">
          <div class="alike-compare-title">
            <h2>Your compare list</h2>
            <i class="alikeCloseDrawer ion-close-round"></i>
          </div>
          <div class="alike-compare-widget-mobile-content-load"></div>
        </div>
        <div class="alike-compare-action">
          <button class="btn-remove-all alike-btn-remove-all">
            Remove All
          </button>
          <a class="alike-btn-compare" href="#">
            Compare
          </a>
        </div>
      </div>
    </div>

    <div class="alike-compare-widget-wrapper">
      <div class="alike-compare-widget-main">
        <div class="alike-compare-widget-content alike-compare-widget-content-before-scale">
          <div class="alike-compare-widget-content-load" style=""></div>
          <div class="alike-compare-widget-post-remove-all">
            <div class="alike-compare-widget-post-remove-all-content">
              <span><?php esc_html_e('REMOVE ALL', 'alike') ?></span>
            </div>
          </div>
        </div>
        <?php if ( wp_is_mobile() ) {
          $button_class .= ' alikeMobileDrawerJs';
        } ?>
        <a class="<?php echo esc_attr($button_class) ?>" href="#">
          <span class="alike-compare-widget-button-text"><?php esc_html_e('COMPARE', 'alike') ?></span>
          <div class="alike-compare-widget-counter-wrapper">
            <span class="alike-compare-widget-counter">0</span>
          </div>
        </a>
      </div>
    </div>
    <?php
  }


  /**
   *  App Bootstrap
   *  Fire all class
   */
  public function ra_app_bootstrap(){


    /**
     * Define plugin constant
     */
    define( 'RA_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
    define( 'RA_URL', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) );
    define( 'RA_FILE', __FILE__ );

    define( 'RA_CSS' , RA_URL.'/assets/dist/css/' );
    define( 'RA_JS' ,  RA_URL.'/assets/dist/js/' );
    define( 'RA_JS_VENDOR' ,  RA_URL.'/assets/dist/ven/' );
    define( 'RA_IMG' ,  RA_URL.'/assets/dist/img/' );
    define( 'RA_VEN' , RA_URL.'/assets/vendor/' );
    define( 'RA_JS_REUSE_FORM',  RA_URL.'/assets/dist/reuse-form/' );
    define( 'RA_LIB' , RA_URL.'/assets/dist/library/' );
    define( 'RA_TEMPLATE_PATH', plugin_dir_path( __FILE__ ) . 'templates/' );


    // ALL CLASS WILL BE LOADED FROM HERE ()

    /**
    * admin part
    */

    
    new Alike\App\Ra_Install();          // TextDomain , install hook
    new Alike\Admin\Ra_Admin();         // admin initialization
    new Alike\Admin\Ra_Admin_Scripts(); // admin scripts
    
    //new Alike\Admin\Ra_Admin_Provider(); // admin data provider
    

    new Alike\App\Alike_ICONS_Provider();
    new Alike\App\Ra_Shortcodes();
    new Alike\App\Ra_Frontend_Scripts();
    new Alike\App\Ra_Ajax();
    // new comparison\App\Re_Ajax_Builder();


    // add_action( 'widgets_init', function(){
    //   register_widget( 'Alike\App\Ra_Alike_Widget' );
    // });

  }

  /**
 	 * Load all the classes with composer auto loader
 	 *
 	 * @return void
	 */
  public function ra_load_all_classes(){

    include_once __DIR__.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
    include_once __DIR__.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'alike-helper-function.php';

  }

  /**
   * Get the template path.
   * @return string
   */
  public function template_path() {
    return apply_filters( 'alike_template_path', 'alike/' );
  }

  /**
   * Get the plugin path.
   * @return string
   */
  public function plugin_path() {
    return untrailingslashit( plugin_dir_path( __FILE__ ) );
  }

  /**
   * Get the plugin textdomain for multilingual.
   * @return null
   */
  public function ra_language_textdomain() {
    load_plugin_textdomain( 'alike', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
  }

}


/**
 * Main instance of alike.
 *
 * Returns the main instance of RA to prevent the need to use globals.
 *
 * @since  1.0
 * @return Redq_Alike
 */
function RA() {
  return Redq_Alike::instance();
}

// Global for backwards compatibility.
$GLOBALS['alike'] = RA();
