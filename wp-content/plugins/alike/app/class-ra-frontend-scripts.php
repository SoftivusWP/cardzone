<?php

namespace Alike\App;

class Ra_Frontend_Scripts{

  public function __construct(){
    add_action('wp_enqueue_scripts', array( $this , 'alike_load_scripts' ), 20 );
  }

  public function alike_load_scripts() {

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'underscore' );

    wp_register_script( 'mousewheel',RA_LIB.'jquery.mousewheel.min.js', array('jquery'), $ver = true, true);
    wp_enqueue_script( 'mousewheel' );

    wp_register_script( 'mCustomScrollbar',RA_LIB.'jquery.mCustomScrollbar.min.js', array('jquery', 'mousewheel'), $ver = true, true);
    wp_enqueue_script( 'mCustomScrollbar' );
    
    wp_register_style('ionicons-style', RA_CSS.'/ionicons.css', array(), $ver = false, $media = 'all');
    wp_enqueue_style('ionicons-style');

    // wp_register_style('mCustomScrollbar', RA_CSS.'/jquery.mCustomScrollbar.css', array(), $ver = false, $media = 'all');
    // wp_enqueue_style('mCustomScrollbar');
    
    wp_register_style('ra-style', RA_CSS.'/style.css', array(), $ver = false, $media = 'all');
    wp_enqueue_style('ra-style');

    // $alike_settings = get_option('alike_settings', true);
    // $max_compare = ( isset( $alike_settings['max_compare'] ) ) ? $alike_settings['max_compare'] : '4';
    // $lang = array(
    //   'YOU_CAN_COMPARE_MAXIMUM_BETWEEN_S_ITEMS' => sprintf( esc_html__('You can compare maximum between %s items.', 'alike'), $max_compare),
    // );
    // wp_localize_script( 'ra-frontend', 'ALIKE', array(
    //   'builder_nonce' => wp_create_nonce( 'builder_nonce' ),
    //   'ajaxurl' => admin_url('admin-ajax.php'),
    //   'IMG' => RA_IMG,
    //   'max_compare' => $max_compare,
    //   'LANG' => $lang,
    // ));

    $this->load_front_scripts();
    

  }

  public function load_front_scripts(){
    $alike_settings = get_option('alike_settings', true);
    $max_compare = ( isset( $alike_settings['max_compare'] ) ) ? $alike_settings['max_compare'] : '4';
    $preview_page = '';
    if( isset($alike_settings['preview_page']) ) {
      $preview_page = esc_url ( get_the_permalink( $alike_settings['preview_page'] ) );
    }
    

    $lang = array(
      'YOU_CAN_COMPARE_MAXIMUM_BETWEEN_S_ITEMS' => sprintf( esc_html__('You can compare maximum between %s items.', 'alike'), $max_compare),
    );
    $admin_scripts = json_decode(file_get_contents( RA_DIR . "/resource/frontend-assets.json"),true);
    $check_device = 'no';
    if( wp_is_mobile() ) {
      $check_device = 'yes';
    }
    foreach ($admin_scripts as $filename => $file) {
      wp_register_script( $filename, RA_JS. $file['js'] , array('jquery', 'underscore'), $ver = false, true);
      wp_enqueue_script( $filename );
      wp_localize_script( $filename, 'ALIKE', array(
        'builder_nonce'   => wp_create_nonce( 'builder_nonce' ),
        'ajaxurl'         => admin_url('admin-ajax.php'),
        'IMG'             => RA_IMG,
        'max_compare'     => $max_compare,
        'LANG'            => $lang,
        'pageUrl'         => $preview_page,
        'CHECK_DEVICE'    => $check_device,
      ));
    }
  }

}