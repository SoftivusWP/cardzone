<?php

namespace Alike\Admin;
use Alike\Admin\Reuse_Builder_Reuse;
/**
* Class Alike_Admin_Scripts
* @package Alike\Admin
*/
class Ra_Admin_Scripts {

  /**
   * class constructor
   *
   * @version 1.0.0
   * @since 1.0.0
   *
   * @return null
   */

  public function __construct(){
    add_action( 'admin_enqueue_scripts', array( $this, 'alike_admin_load_scripts') );
  }

  /**
   * admin script loading
   *
   * @version 1.0.0
   * @since 1.0.0
   *
   * @param $hook
   * @return null
   */

  public function alike_admin_load_scripts( $hook ) {
    $restricted_page = array(
      'toplevel_page_alike_admin'
    );

    if( in_array($hook, $restricted_page) ){

      wp_register_script( 'react', RA_JS_VENDOR.'react.min.js', array(), $ver = true, true);
      wp_enqueue_script( 'react' );
      wp_register_script( 'react-dom', RA_JS_VENDOR.'react-dom.min.js', array(), $ver = true, true);
      wp_enqueue_script( 'react-dom' );

      wp_register_style('ra-alike-ion-icon', RA_CSS.'/ionicons.css', array(), $ver = false, $media = 'all');
      wp_enqueue_style('ra-alike-ion-icon');

      wp_register_style('simple-line-icons-style', RA_CSS.'/simple-line-icons.css', array(), $ver = false, $media = 'all');
      wp_enqueue_style('simple-line-icons-style');

      wp_register_style('ra-admin-style', RA_CSS.'/admin.css', array(), $ver = false, $media = 'all');
      wp_enqueue_style('ra-admin-style');

      wp_enqueue_script( 'jquery' );
      wp_enqueue_script( 'jquery-ui-core' );
      wp_enqueue_script( 'jquery-ui-sortable' );
      wp_enqueue_script( 'underscore' );

      
      $this->redq_rb_load_reuse_form_scripts();

      $this->load_admin_scripts();
      // wp_register_script( 'ra-backend',RA_JS.'backend.js', array('jquery','underscore','jquery-ui-core','jquery-ui-sortable'), $ver = true, true);
      // wp_enqueue_script( 'ra-backend' );

    }
  }

  public function ra_get_all_post_types(){
    $post_types = get_post_types( array('public'=> true ) , 'names', 'and' );

    $all_types = array();
    foreach ($post_types as $type) {
      $all_types[] = $type;
    }

    return $all_types;
  }

  public function redq_rb_load_reuse_form_scripts(){
      if ( !is_plugin_active( 'redq-reuse-form/redq-reuse-form.php' ) ) {
          wp_register_script( 'reuse-form-variable', RA_JS_VENDOR.'reuse-form-variable.js', array(), $ver = true, true);
          wp_enqueue_script( 'reuse-form-variable' );
          wp_register_style('reuse-form-two', RA_CSS.'reuse-form-two.css', array(), $ver = false, $media = 'all');
          wp_enqueue_style('reuse-form-two');
          wp_register_style('reuse-form', RA_CSS.'reuse-form.css', array(), $ver = false, $media = 'all');
          wp_enqueue_style('reuse-form');
          $reuse_form_scripts   = new Reuse_Builder_Reuse;
          $webpack_public_path  = get_option('webpack_public_path_url', true);
          $reuse_form_scripts->load($webpack_public_path);
          
      }
  }

  public function load_admin_scripts(){
    $admin_scripts = json_decode(file_get_contents( RA_DIR . "/resource/admin-assets.json"),true);
    foreach ($admin_scripts as $filename => $file) {
      wp_register_script( $filename, RA_JS. $file['js'] , array('jquery', 'underscore'), $ver = false, true);
      wp_enqueue_script( $filename );

        $lang = array(
        'SAVE'                      => esc_html__('Save', 'alike'),
        'PLEASE_SELECT_A_POST_TYPE' => esc_html__('Please select a post type', 'alike'),
        'ADD_POST_TYPES'            => esc_html__('Add Post Types', 'alike'),
        'PLEASE_SELECT_POST_TYPES'  => esc_html__('Please select post types', 'alike'),
        'UPDATE'                    => esc_html__('Update', 'alike'),
        'SHOW_RATING_BOX'           => esc_html__('Show Rating Box', 'alike'),
        'SHOW_ON_TOP'               => esc_html__('Show on Top', 'alike'),
      );

      wp_localize_script( $filename, 'ALIKE_ADMIN', array(
        'builder_nonce'         => wp_create_nonce( 'builder_nonce' ),
        'alike_get_post_data'   => 'alike_get_post_data',
        'alike_save_post_types' => 'alike_save_post_types',
        'ajaxurl'               => admin_url('admin-ajax.php'),
        'helper'                => array(
          'all_post_types'      => $this->ra_get_all_post_types()
        ),
        'LANG'                  => $lang,
      ));
    }
  }
}
