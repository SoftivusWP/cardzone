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
$post_type = current( $post_types );

$alike_data = get_option('alike_data');
$results    = array();



$alike_selected_data = get_option('alike_selected_data', true);

$final_data = array();

foreach ($alike_selected_data as $key => $selected_data) {
  
  if( $key == $post_type ) {
    $results = $selected_data;
  }
}


foreach ($results as $result) {
  

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

    if( isset( $result['groupBy'] ) && $result['groupBy'] == 'true' ) {
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

          case 'post_keys':
            foreach ($ids as $id) {
              // _log($child_type[1]);
              switch ($child_type[1]) {
                case 'post_thumbnail':
                  $thumbnail = get_the_post_thumbnail( $id, 'alike_thumbnail' );

                  $child_all_data[] = array(
                    'id' => $id,
                    'title' => $child_row['title'],
                    'data' => $thumbnail,
                  );
                  break;

                case 'post_title':

                  $child_all_data[] = array(
                    'id' => $id,
                    'title' => $child_row['title'],
                    'data' => get_the_title( $id ),
                  );
                  break;

                case 'post_excerpt':

                  $child_all_data[] = array(
                    'id' => $id,
                    'title' => $child_row['title'],
                    'data' => get_the_excerpt( $id ),
                  );
                  break;
              }
            }
            break;
        }
      }
    } else {
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
    } // end if $result['groupBy']
    if( isset( $result['groupBy'] ) && $result['groupBy'] == 'true' ) {
      
      $final_data[] = array(
        'type' => 'set',
        'title' => $result['title'],
        'data' => $child_all_data,
        'groupBy' => true,
      );
    } else {
      $final_data[] = array(
        'type' => 'set',
        'title' => $result['title'],
        'data' => $child_all_data,
      );  
    }
    
  }
  
}



_log($final_data);

// $new_combined_top = array();

// // $new_combined_bottom = array();
// // foreach ($new_all_data['on_bottom'] as $key => $value) {
// //   $new_combined_bottom[$value['title']][$key] = $value['data'];
// // }


// $theme_style = 'style-' . $alike_settings['alike_theme_select'];
// $theme_content = 'alike-content-' . $alike_settings['alike_theme_select'];

?>

<div class='rq-alike-compare'>
    <div class="rq-alike-topic-p">
      <?php foreach ($final_data as $final_key => $final_value) : ?>
        <div class="rq-alike-topic">
          <?php echo $final_value['title'] ?>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="rq-alike-items">
      <?php foreach ($final_data as $final_key => $final_value) : ?>

        <?php if( $final_value['type'] == 'set' ) : ?>
          <?php if( isset( $final_value['groupBy'] ) ) : ?>
            <?php
              $new_array = alike_array_group_by( $final_value['data'], function($i){  return $i['id']; } );
            ?>
                <div class="alike-column">
                  <?php foreach ($new_array as $key => $value) : ?>
                    <div class="rq-alike-items-list">post title</div>
                  <?php endforeach ?>
                </div>
          <?php endif; ?>
        <?php else : ?>
        <?php endif; ?>
          <div class="alike-column">
            <div class="rq-alike-items-list">one</div>
            <div class="rq-alike-items-list">tw0</div>
          </div>
        <?php endforeach; ?>
    </div>

</div>

<div class="alike-flex-table">
  <div class="alike-flex-top">
      <div class="alike-flex-top-heading">
        &nbsp;
      </div>
      <div class="alike-flex-top-content">
        <?php foreach ($ids as $id) : ?>
          <div class="alike-flex-item">
              <?php echo get_the_post_thumbnail( $id, 'alike_thumbnail' ) ?>
              <a href="<?php echo get_the_permalink( $id ) ?>"><h2><?php echo get_the_title( $id ) ?></h2></a>
          </div>
        <?php endforeach; // $ids ?>
      </div>
  </div>
  <div class="alike-flex-main-body">
      <div class="alike-flex-main-wrapper">
        
          <?php foreach ($final_data as $final_key => $final_value) : ?>
            <div class="alike-flex-bottom-hold">
            <?php if( $final_value['type'] == 'set') : ?>

              <h3><?php echo $final_value['title'] ?></h3>
              <?php 
                $set_data = array();
                foreach ($final_value['data'] as $key => $data) {
                  
                  foreach ($data as $k => $dat) {
                    $set_data[$data['title']][$key] = $data['data'];
                  }
                } // end foreach $final_value['data']
                
              ?>
              
              <?php foreach ($set_data as $key => $value) : ?>
              <div class="alike-flex-bottom">
                  <div class="alike-flex-bottom-heading">
                    <?php echo $key; ?>
                  </div>
                  <div class="alike-flex-bottom-content">
                      <?php foreach ($value as $v) : ?>
                      <div class="alike-flex-item">
                        <?php echo $v; ?>
                      </div>
                      <?php endforeach; // end $value ?>
                  </div>
              </div>
              <?php endforeach; // end $set_data ?>
              </div>
              <div class="alike-flex-bottom-hold">
              <?php elseif( $final_value['type'] == 'row' ): ?>
                
                <?php 
                  $row_data = array();
                  foreach ($final_value['data']['on_bottom'] as $key => $data) {
                    
                    foreach ($data as $k => $dat) {
                      $row_data[$data['title']][$key] = $data['data'];
                    }
                  } // end foreach $final_value['data']

                ?>
                <?php foreach ($row_data as $key => $value) : ?>
                <div class="alike-flex-bottom">
                  <div class="alike-flex-bottom-heading">
                    <?php echo $key ?>
                  </div>
                  <div class="alike-flex-bottom-content">
                    <?php foreach ($value as $v) : ?>
                      <div class="alike-flex-item">
                        <?php echo $v; ?>
                      </div>
                    <?php endforeach; // end $value ?>
                  </div>
                </div>
                <?php endforeach; // end $row_data ?>
              <?php endif; ?>
              </div>
          <?php endforeach; // $final_data ?>
        
      </div>
  </div>
</div>



<?php else : // end count ids if ?>

<?php echo sprintf( esc_html__('You can compare maximum between %s items.', 'alike'), $max_compare) ?>

<?php endif; ?>

<div class='rq-alike-compare'>
    <div class="rq-alike-topic-p">
        <div class="rq-alike-topic">
            Group 1
        </div>

        <div class="rq-alike-topic">
            header
        </div>

        <div class="rq-alike-topic">
            header
        </div>
        <div class="rq-alike-topic">
            header
        </div>
    <div class="rq-alike-topic">
            Group 2
        </div>

        <div class="rq-alike-topic">
            header
        </div>

        <div class="rq-alike-topic">
            header
        </div>
        <div class="rq-alike-topic">
            header
        </div>
        
    </div>

    <div class="rq-alike-items">
        <div class="alike-column">
            <div class="rq-alike-items-list"></div>
            <div class="rq-alike-items-list">one</div>
            <div class="rq-alike-items-list">tw0</div>
            <div class="rq-alike-items-list">three</div>
            <div class="rq-alike-items-list"></div>
            <div class="rq-alike-items-list">one</div>
            <div class="rq-alike-items-list">tw0</div>
            <div class="rq-alike-items-list">three</div>
        </div>

        <div class="alike-column">
            <div class="rq-alike-items-list"></div>
            <div class="rq-alike-items-list">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum eveniet ut facere nisi eum, a provident exercitationem fuga et illum!</div>
            <div class="rq-alike-items-list">3</div>
            <div class="rq-alike-items-list">5</div>
            <div class="rq-alike-items-list"></div>
            <div class="rq-alike-items-list">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum eveniet ut facere nisi eum, a provident exercitationem fuga et illum!</div>
            <div class="rq-alike-items-list">3</div>
            <div class="rq-alike-items-list">5</div>
        </div>

        <div class="alike-column">
            <div class="rq-alike-items-list"></div>
            <div class="rq-alike-items-list">Four</div>
            <div class="rq-alike-items-list">Five</div>
            <div class="rq-alike-items-list">Six</div>
            <div class="rq-alike-items-list"></div>
            <div class="rq-alike-items-list">Four</div>
            <div class="rq-alike-items-list">Five</div>
            <div class="rq-alike-items-list">Six</div>
        </div>
        <div class="alike-column">
            <div class="rq-alike-items-list"></div>
            <div class="rq-alike-items-list">4</div>
            <div class="rq-alike-items-list">5</div>
            <div class="rq-alike-items-list">6</div>
            <div class="rq-alike-items-list"></div>
            <div class="rq-alike-items-list">4</div>
            <div class="rq-alike-items-list">5</div>
            <div class="rq-alike-items-list">6</div>
        </div>
    </div>

</div>

<?php

function alike_array_group_by(array $arr, callable $key_selector) {
  $result = array();
  foreach ($arr as $i) {
    $key = call_user_func($key_selector, $i);
    $result[$key][] = $i;
  }  
  return $result;
}
