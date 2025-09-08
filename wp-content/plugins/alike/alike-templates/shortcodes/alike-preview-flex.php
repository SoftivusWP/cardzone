<?php
if( empty( $_GET['ids'] ) ) {
  esc_html_e("No IDs to compare", "alike");
  return;
}
$alike_settings = get_option('alike_settings', true);

$max_compare = ( isset( $alike_settings['max_compare'] ) ) ? $alike_settings['max_compare'] : '4';
$ids = explode(',', $_GET['ids']);
if( count( $ids ) <= $max_compare ) :

$post_types = array();
foreach ($ids as $id) {
  $post_types[] = get_post_type( $id );
}

$isHomogenous = alike_is_homogenous( $post_types );
if( !$isHomogenous ) {
  esc_html_e("Please select same post type to compare.", "alike");

  return;
}
// $post_type = current( $post_types );

$alike_data = get_option('alike_data');
$results    = array();

// if( !empty( $alike_data ) ) {
//   foreach($alike_data as $key => $value) {
//     if ( isset( $value['selectedData'] ) && $value['post_type'] == $post_type) {
//       $results[] = $value['selectedData'];
//     }
//   }
// }


$new_post_type = current( $post_types );

$alike_selected_data = get_option('alike_selected_data', true);


$final_data = array();

$new_results = array();
foreach ($alike_selected_data as $key => $selected_data) {
  
  if( $key == $new_post_type ) {
    $new_results = $selected_data;
  }
}


foreach ($new_results as $result) {
  
  

  if( $result['type'] == 'row') {
    $new_type = explode( ',', $result['selectedPost'] ); 
    $new_all_data = array();
    $new_all_data['on_bottom'] = array();
    $new_all_data['on_top'] = array();







    switch ($new_type[0]) {
    case 'taxonomy_keys':
      foreach ($ids as $id) {
        $post_terms = get_the_terms($id, $new_type[1]);
        
        if( !empty( $post_terms ) ) {
          $terms = array();
          foreach ($post_terms as $term) {
            $terms[] = $term->name;
          }

          if( isset( $result['topHeader'] ) && $result['topHeader'] == 'true' ) {
            // Push data to on_top array
            $new_all_data['on_top'][] = array(
              'id' => $id,
              'title' => $result['title'],
              'data' => implode(', ', $terms),
            );
          } else {
            // Push data to on_top array
            $new_all_data['on_bottom'][] = array(
              'id' => $id,
              'title' => $result['title'],
              'data' => implode(', ', $terms),
            );
          }
        } else {
          if( isset( $result['topHeader'] ) && $result['topHeader'] == 'true' ) {
            // Push data to on_top array
            $new_all_data['on_top'][] = array(
              'id' => $id,
              'title' => $result['title'],
              'data' => '-',
            );
          } else {
            // Push data to on_top array
            $new_all_data['on_bottom'][] = array(
              'id' => $id,
              'title' => $result['title'],
              'data' => '-',
            );
          }
        }
      }
      break;
      
    case 'meta_keys':
      foreach ($ids as $id) {
        $post_meta = get_post_meta($id, $new_type[1], true );
        if( !empty( $post_meta ) ) {
          if( isset( $result['topHeader'] ) && $result['topHeader'] == 'true' ) {
            // Push data to on_top array
            $new_all_data['on_bottom'][] = array(
              'id' => $id,
              'title' => $result['title'],
              'data' => $post_meta,
            );
          } else {
            // Push data to on_top array
            $new_all_data['on_bottom'][] = array(
              'id' => $id,
              'title' => $result['title'],
              'data' => $post_meta,
            );
          }
        } else {
          if( isset( $result['topHeader'] ) && $result['topHeader'] == 'true' ) {
            // Push data to on_top array
            $new_all_data['on_bottom'][] = array(
              'id' => $id,
              'title' => $result['title'],
              'data' => '-',
            );
          } else {
            // Push data to on_top array
            $new_all_data['on_bottom'][] = array(
              'id' => $id,
              'title' => $result['title'],
              'data' => '-',
            );
          }
        }
      }
      break;
  }





  $final_data[] = array(
    'type' => 'row',
    'data' => $new_all_data,
  );


  } elseif( $result['type'] == 'set') {
    $child_all_data = array();
    $set_rows = $result['rows'];

    foreach ($set_rows as $child_row) {
      
      $child_type = explode( ',', $child_row['selectedPost'] );  

      switch ($child_type[0]) {
        case 'taxonomy_keys':
          foreach ($ids as $id) {
            $post_terms = get_the_terms($id, $child_type[1]);
            
            if( !empty( $post_terms ) ) {
              $terms = array();
              foreach ($post_terms as $term) {
                $terms[] = $term->name;
              }

                $child_all_data[] = array(
                  'id' => $id,
                  'title' => $child_row['title'],
                  'data' => implode(', ', $terms),
                );
            } else {
              
                // Push data to on_top array
                $child_all_data[] = array(
                  'id' => $id,
                  'title' => $child_row['title'],
                  'data' => '-',
                );
            }
          }
          break;
          
        case 'meta_keys':
          foreach ($ids as $id) {
            $post_meta = get_post_meta($id, $child_type[1], true );
            if( !empty( $post_meta ) ) {
              
              // Push data to on_top array
              $child_all_data[] = array(
                'id' => $id,
                'title' => $child_row['title'],
                'data' => $post_meta,
              );
            } else {
              
              // Push data to on_top array
              $child_all_data[] = array(
                'id' => $id,
                'title' => $child_row['title'],
                'data' => '-',
              );
            }
          }
          break;
      }
    }

    $final_data[] = array(
      'type' => 'set',
      'title' => $result['title'],
      'data' => $child_all_data,
    );
  }
  
}



// _log($final_data);

$new_combined_top = array();

$new_combined_bottom = array();
foreach ($new_all_data['on_bottom'] as $key => $value) {
  $new_combined_bottom[$value['title']][$key] = $value['data'];
}


$theme_style = 'style-' . $alike_settings['alike_theme_select'];
$theme_content = 'alike-content-' . $alike_settings['alike_theme_select'];

?>

<div class="alike-compare-table-wrapper">
  <div class="alike-row">
    <div class="alike-item-row">
      <div class="alike-column-title">
        &nbsp;
      </div>
      <?php foreach ($ids as $id) { ?>
      <div class="alike-column-item">
        <?php echo get_the_post_thumbnail( $id, 'alike_thumbnail' ); ?>
        <h3><?php echo get_the_title( $id ) ?></h3>
      </div>
      <?php } // end foreach $ids ?>
    </div>
  </div>
  <?php foreach ($final_data as $key => $value) { ?>
    <?php if( $value['type'] == 'set' ) { ?>
      <div class="alike-row">
        <h3><?php echo $value['title'] ?></h3>
        <?php 
        $set_data = array();
        foreach ($value['data'] as $dat_key => $data) {
          
          foreach ($data as $k => $dat) {
            $set_data[$data['title']][$dat_key] = $data['data'];
          }
        } // end foreach $value['data']
        
        ?>
        <?php foreach ($set_data as $key => $value) { ?>
        <div class="alike-item-row">
          <div class="alike-column-title">
            <?php echo $key; ?>
          </div>
          <?php foreach ($value as $v) { ?>
          <div class="alike-column-item">
            <?php echo $v ?>
          </div>
          <?php } // end foreach $value ?>
        </div>
        <?php } // end foreach $set_data ?>
       

      </div>
    <?php } // end if $value['type'] ?>
  <?php } // end foreach $final_data ?>

</div><!-- end .alike-compare-table-wrapper -->



<?php else : // end count ids if ?>

<?php echo sprintf( esc_html__('You can compare maximum between %s items.', 'alike'), $max_compare) ?>

<?php endif; ?>