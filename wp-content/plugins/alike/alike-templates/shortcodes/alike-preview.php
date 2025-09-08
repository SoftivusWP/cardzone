<?php
if (empty($_GET['ids'])) {
  esc_html_e("No IDs to compare", "alike");
  return;
}

$show_difference = 'no';

if (isset($_GET['show_difference'])) {
  $show_difference = $_GET['show_difference'];
}

$alike_settings = get_option('alike_settings', true);


$max_compare = (isset($alike_settings['max_compare'])) ? $alike_settings['max_compare'] : '4';
$ids = explode(',', $_GET['ids']);
if (count($ids) <= $max_compare) :

  $post_types = array();
  foreach ($ids as $id) {
    $post_types[] = get_post_type($id);
  }

  $isHomogenous = alike_is_homogenous($post_types);
  if (!$isHomogenous) {
    esc_html_e("Please select same post type to compare.", "alike");

    return;
  }

  $post_type            = current($post_types);
  $alike_data           = get_option('alike_data');

  $preview_render_data  = alike_render_preview_data($post_type, $ids, $show_difference);
  if (is_array($preview_render_data)) {

    $comparison_data      = $preview_render_data['comparison_data'];
    $new_data_set         = $preview_render_data['new_data_set'];
  }

  // _log($new_data_set);

  // if( empty( $comparison_data ) && empty( $new_data_set ) ) {
  //   echo esc_html__('There is no data builded by the site owner.', 'alike') . '<br /><br />';
  //   if( current_user_can('administrator') ) {
  //     echo esc_html__('Please add the builder data. ', 'alike');

  //     echo '<a href="'.admin_url('admin.php?page=alike_admin').'">'.esc_html__('Alike Builder', 'alike').'</a>';  
  //   }
  // }
  $page_url             = get_the_permalink();
  $get_ids              = $_GET['ids'];
  $get_show_difference  = (isset($_GET['show_difference'])) ? $_GET['show_difference'] : 'no';

  if ($get_show_difference == 'yes') {
    $new_show_difference = 'no';
  } else {
    $new_show_difference = 'yes';
  }
  $link_url = $page_url . '?ids=' . $get_ids . '&show_difference=' . $new_show_difference;
  $link_title = ($new_show_difference == 'no') ? esc_html__('Show All', 'alike') : esc_html__('Show Difference', 'alike');
?>


  <div class="rq-alike-compare">
    <a class="rq-alike-show-difference" href="<?php echo esc_url($link_url); ?>"><?php echo $link_title ?></a>
    <div class="rq-alike-topic-p">
      <?php
      if (!empty($comparison_data)) :

        foreach ($comparison_data as $key => $value) :
          $custom_scrollbar = '';

          if ($value['customScrollbar'] == 'enable') {
            $custom_scrollbar = 'rq-alike-custom-scrollbar';
          }

          $custom_height = (isset($value["height"]) && !empty($value['height'])) ? 'style="height: ' . $value["height"] . '"' : '';

          if ($value['type'] == 'set' && isset($value['groupBy']) && $value['groupBy'] == true) { ?>
            <div class="rq-alike-topic alike-image" <?php echo $custom_height . ' ' . $custom_scrollbar ?>>
              <?php echo $value['title'] ?>
            </div>
          <?php } elseif ($value['type'] == 'set' && isset($value['groupBy']) && $value['groupBy'] == false) { ?>
            <div class="rq-alike-topic" <?php echo $custom_height ?>>
              <?php echo $value['title'] ?>
            </div>
            <?php if ($show_difference == 'yes') {
              if (alike_check_similarities($value['data'])) { ?>
                <?php foreach ($value['extra_title'] as $title) { ?>
                  <div class="rq-alike-topic" <?php echo $custom_height . ' ' . $custom_scrollbar ?>>
                    <?php echo $title ?>
                  </div>
                <?php } ?>
              <?php }
            } else { ?>
              <?php foreach ($value['extra_title'] as $title) { ?>
                <div class="rq-alike-topic" <?php echo $custom_height . ' ' . $custom_scrollbar ?>>
                  <?php echo $title ?>
                </div>
              <?php } ?>
            <?php } ?>

            <?php } else {
            if ($show_difference == 'yes') {
              if (alike_check_similarities($value['data'])) { ?>
                <div class="rq-alike-topic" <?php echo $custom_height . ' ' . $custom_scrollbar ?>>
                  <?php echo $value['title'] ?>
                </div>
              <?php }
            } else { ?>
              <div class="rq-alike-topic" <?php echo $custom_height . ' ' . $custom_scrollbar ?>>
                <?php echo $value['title'] ?>
              </div>
            <?php }
            ?>
          <?php }
          ?>


      <?php endforeach;
      endif; ?>

    </div>

    <div class="rq-alike-items">
      <?php
      if (!empty($new_data_set)) :
        foreach ($new_data_set as $new_key => $new_value) : ?>
          <div class="alike-column">
            <?php foreach ($new_value as $data) {
              if ($data['type'] == 'set' && isset($data['groupBy']) && $data['groupBy'] == true) { ?>
                <div class="rq-alike-items-list alike-image">
                  <?php foreach ($data['value'] as $value) {
                    $custom_height = (isset($value["height"]) && !empty($value['height'])) ? 'style="height: ' . $value["height"] . '"' : '';
                  ?>
                    <div class="rq-alike-top-data" <?php echo $custom_height ?>><?php echo html_entity_decode($value['data']); ?>
                    </div>
                  <?php } ?>
                </div>
              <?php } elseif ($data['type'] == 'set' && isset($data['groupBy']) && $data['groupBy'] == false) { ?>

                <?php foreach ($data['value'] as $value) {
                  $custom_height = (isset($value["height"]) && !empty($value['height'])) ? 'style="height: ' . $value["height"] . '"' : '';
                ?>
                  <div class="rq-alike-items-list" <?php echo $custom_height ?>>
                    <?php echo html_entity_decode($value['data']); ?>
                  </div>
                <?php } ?>
              <?php } else { ?>
                <?php
                $custom_scrollbar = '';
                if ($data['customScrollbar'] == 'enable') {
                  $custom_scrollbar = 'rq-alike-custom-scrollbar';
                }
                $custom_height = (isset($data['value'][0]["height"]) && !empty($data['value'][0]['height'])) ? 'style="height: ' . $data['value'][0]["height"] . '"' : '';
                ?>
                <div class="rq-alike-items-list <?php echo $custom_scrollbar ?>" <?php echo $custom_height ?>>
                  <?php echo html_entity_decode($data['value'][0]['data']); ?>
                </div>
            <?php }
            } ?>
          </div>
      <?php endforeach;
      endif; ?>
    </div>

  </div>


<?php else : // end count ids if 
?>

  <?php echo sprintf(esc_html__('You can compare maximum between %s items.', 'alike'), $max_compare) ?>

<?php endif; ?>



<?php
if (!function_exists('alike_array_group_by')) {
  function alike_array_group_by(array $arr, callable $key_selector)
  {
    $result = array();
    foreach ($arr as $i) {
      $key = call_user_func($key_selector, $i);
      $result[$key][] = $i;
    }
    return $result;
  }
}
