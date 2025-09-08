<?php 
    $alike_saved_post_types = get_option( 'alike_saved_post_types' );
    $result = array();
    if( !empty( $alike_saved_post_types ) ) {
            foreach ($alike_saved_post_types as $post_type) {
            $data = new \Alike\Admin\Ra_Admin_Provider();
            $result[$post_type] = $data->get_post_data($post_type);
        }
    }

    wp_localize_script( 'alike_backend', 'ALIKE_DATA', array(
        'postTypes'     => $alike_saved_post_types,
        'initialData'   => $result,
        'selectedData'  => get_option( 'alike_selected_data', true ),
    ));
    
  
?>
<div id="alike-admin"></div>

<div style="margin-left: 30px;">
    <button class="alike-reset-data">Reset Alike Option Data <i class="fa fa-spinner fa-spin" style="display: none;"></i></button>
</div>