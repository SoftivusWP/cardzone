<?php

namespace Alike\App;

class Ra_Ajax {
  public function __construct() {
    // $ajax_events = array(
    //  // 'get_all_posts' => true,
    //   'save_all_data' => true,
    // );
    // foreach ( $ajax_events as $ajax_event => $nopriv ) {
    //   add_action( 'wp_ajax_ra_' . $ajax_event, array( $this, $ajax_event ) );
    //   if ( $nopriv ) {
    //     add_action( 'wp_ajax_nopriv_ra_' . $ajax_event, array( $this , $ajax_event ) );
    //   }
    // }

    add_action( 'wp_ajax_alike_get_post_data', array( $this, 'alike_get_post_data' ) );
    add_action( 'wp_ajax_alike_save_post_types', array( $this, 'alike_save_post_types' ) );
    
    add_action( 'wp_ajax_alike_reset_data', array( $this, 'alike_reset_data' ) );
  }

  public function alike_reset_data() {
    if ( !wp_verify_nonce( $_REQUEST['nonce'], "builder_nonce")) {
      exit("No naughty business please");
    }

    delete_option('alike_saved_post_types');
    delete_option('alike_selected_data');

    echo json_encode(array( 'message' => 'All data deleted', 'status_code' => 200 ));

    wp_die();
  }

  public function alike_save_post_types() {
    $posted  = $_POST;

    $post_types = $posted['postTypes'];

    update_option( 'alike_saved_post_types', $post_types );
    
    $result = array();

    foreach ($post_types as $post_type) {
      $data = new \Alike\Admin\Ra_Admin_Provider();
      $result[$post_type] = $data->get_post_data($post_type);
    } 
    echo json_encode(array(
      'postTypes'     => $post_types,
      'initialData'   => $result,
    ));

    wp_die();
  }
  public function alike_get_post_data() {

    $posted  = $_POST;
    if( isset( $posted['selectedData'] ) ) {
      $selected_data = $posted['selectedData'];

      update_option( 'alike_selected_data', $selected_data );  
    }
    
    // $result = array();

    // foreach ($post_types as $post_type) {
    //     $data = new \Alike\Admin\Ra_Admin_Provider();
    //     $result[$post_type] = $data->get_post_data($post_type);
    // } 
    // echo json_encode(array(
    //     'postTypes'     => $post_types,
    //     'initialData'   => $result,
    // ));

    wp_die();
  }
  // public function save_all_data() {
  //   if( isset($_POST['allData']) && !empty($_POST['allData']) ){
  //     $allData = $_POST['allData'];

  //     $option_name = 'alike_data';
  //     update_option( $option_name, $allData);

  //     $data = new \Alike\Admin\Ra_Admin_Provider();
  //     $result = $data->get_post_data($allData);
  //     if( !isset($_POST['noreturn']) )
  //       echo json_encode($result);
  //   }
  //   wp_die();
  // }



}