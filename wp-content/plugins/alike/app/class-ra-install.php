<?php

namespace Alike\App;


/**
 * Class Ra_Install
 *
 * @author      RedQTeam
 * @category    Admin
 * @package     Alike\App
 * @version     1.0.0
 * @since       1.0.0
 */

class Ra_Install {

  public function __construct(){

    // install hooks 
    register_activation_hook( RA_FILE, array( &$this, 'alike_plugin_install' ) );

  }

  /**
   * For db table
   * @return [type] [description]
   */
  public function alike_plugin_install(){
    add_option('alike_settings', '');
    $alike_settings = array(
      'alike_theme_select' => 'one',
      'thumbnail_size_w'   => '400',
      'thumbnail_size_h'   => '300',
      'thumbnail_crop'     => '1',
      'max_compare'        => '4',
    );
    
    $get_settings = get_option('alike_settings', true);    
    if( empty( $get_settings ) ) {
      update_option('alike_settings', $alike_settings );
    }

    global $wpdb;
    $title = 'Alike Preview';
    $content = '[alike_preview]';
    
    $post_if = $wpdb->get_var("SELECT * FROM $wpdb->posts WHERE post_content LIKE '".$content."'");
    if( empty( $post_if ) ) {
      // Create post object
      $alike_preview = array(
        'post_title'    => $title,
        'post_content'  => $content,
        'post_status'   => 'publish',
        'post_type'     => 'page',
      );
       
      // Insert the page into the database
      wp_insert_post( $alike_preview );
    }

    // Add the admin notice notifier during plugin activation. Default set to false.
    // add_option('reactive_builder_admin_notices', false);
    update_option('webpack_public_path_url', RA_JS_REUSE_FORM);
    
    // $webpack_public_path = get_option('webpack_public_path_url', true);
    // if($webpack_public_path == '' || $webpack_public_path == '1') {
    //   update_option('webpack_public_path_url', RA_JS_REUSE_FORM);
    // }

  }

}