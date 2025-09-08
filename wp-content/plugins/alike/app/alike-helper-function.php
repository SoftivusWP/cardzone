<?php

/**
 * alike_is_homogenous
 *
 * @param array
 * @return bool
 */
function alike_is_homogenous($arr)
{
  $firstValue = current($arr);
  foreach ($arr as $val) {
    if ($firstValue !== $val) {
      return false;
    }
  }

  return true;
}


function alike_render_preview_data($post_type, $ids, $show_difference)
{

  $results    = array();

  $alike_selected_data = get_option('alike_selected_data', true);

  $comparison_data = array();
  if (empty($alike_selected_data) || !is_array($alike_selected_data)) {
    return;
  }

  foreach ($alike_selected_data as $key => $selected_data) {

    if ($key == $post_type) {
      $results = $selected_data;
    }
  }

  foreach ($results as $result) {

    $temp_data = array();

    if ($result['type'] == 'set' && isset($result['groupBy']) && $result['groupBy'] == true) {

      if (isset($result['rows']) && is_array($result['rows'])) {

        foreach ($result['rows'] as $rows) {

          $check_keys = explode(',', $rows['selectedPost']);

          switch ($check_keys[0]) {
            case 'meta_keys':
              foreach ($ids as $id) {
                $post_meta = get_post_meta($id, $check_keys[1], true);
                if (!empty($post_meta)) {
                  $temp_data[$id][] = array(
                    'title' => $rows['title'],
                    'data'  => $post_meta,
                    'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                  );
                } else {
                  $temp_data[$id][] = array(
                    'title' => $rows['title'],
                    'data'  => '-',
                    'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                  );
                }
              }
              break;
            case 'taxonomy_keys':
              foreach ($ids as $id) {
                $post_terms = get_the_terms($id, $check_keys[1]);
                if (!empty($post_terms)) {
                  $terms = array();
                  foreach ($post_terms as $term) {
                    $terms[] = $term->name;
                  }
                  $temp_data[$id][] = array(
                    'title' => $rows['title'],
                    'data'  => implode(', ', $terms),
                    'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                  );
                } else {
                  $temp_data[$id][] = array(
                    'title' => $rows['title'],
                    'data'  => '-',
                    'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                  );
                }
              }
              break;
            case 'post_keys':
              switch ($check_keys[1]) {
                case 'post_thumbnail':
                  foreach ($ids as $id) {

                    $temp_data[$id][] = array(
                      'title' => $rows['title'],
                      'data'  => get_the_post_thumbnail($id, 'alike_thumbnail'),
                      'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                    );
                  }
                  break;

                case 'post_title':
                  foreach ($ids as $id) {

                    $temp_data[$id][] = array(
                      'title' => $rows['title'],
                      'data'  => '<h2>' . get_the_title($id) . '</h2>',
                      'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                    );
                  }
                  break;

                case 'post_title_link':
                  foreach ($ids as $id) {

                    $temp_data[$id][] = array(
                      'title' => $rows['title'],
                      'data'  => '<a href="' . get_the_permalink($id) . '"><h2>' . get_the_title($id) . '</h2></a>',
                      'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                    );
                  }
                  break;

                case 'post_excerpt':
                  foreach ($ids as $id) {

                    $temp_data[$id][] = array(
                      'title' => $rows['title'],
                      'data'  => get_the_excerpt($id),
                      'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                    );
                  }
                  break;

                case 'post_content':
                  foreach ($ids as $id) {

                    $temp_data[$id][] = array(
                      'title' => $rows['title'],
                      'data'  =>  apply_filters('the_content', get_post_field('post_content', $id)),
                      'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                    );
                  }
                  break;
                case 'woocommerce_price':
                  foreach ($ids as $id) {
                    $_product = wc_get_product($id);
                    $temp_data[$id][] = array(
                      'title' => $rows['title'],
                      'data'  => $_product->get_price_html(),
                      'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                    );
                  }
                  break;
              }
              break;
          }
        } // end foreach $result['rows']
      }

      $comparison_data[] = array(
        'type'    => 'set',
        'title'   => $result['title'],
        'groupBy' => true,
        'data'    => $temp_data,
        'customScrollbar' => (isset($result['customScrollbar'])) ? $result['customScrollbar'] : false,
        'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
      );
      $temp_data = array();
    } elseif ($result['type'] == 'set' && isset($result['groupBy']) && $result['groupBy'] != true) {
      $extra_title = array();
      if (isset($result['rows']) && is_array($result['rows'])) {

        foreach ($result['rows'] as $rows) {

          if (!in_array($rows['title'], $extra_title)) {
            $extra_title[] = $rows['title'];
          }
          $check_keys = explode(',', $rows['selectedPost']);

          switch ($check_keys[0]) {
            case 'meta_keys':
              foreach ($ids as $id) {
                $post_meta = get_post_meta($id, $check_keys[1], true);
                switch ($rows['displayType']) {
                  case 'price':
                    if (!empty($post_meta)) {
                      if ($rows['displayType'] == 'price')
                        $temp_data[$id][] = array(
                          'title' => $rows['title'],
                          'data'  => wc_price($post_meta),
                          'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                        );
                    } else {
                      $temp_data[$id][] = array(
                        'title' => $rows['title'],
                        'data'  => '-',
                        'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                      );
                    }
                    break;
                  case 'boolean':

                    if (!empty($post_meta)) {

                      $bool = filter_var($post_meta, FILTER_VALIDATE_BOOLEAN);

                      if ($bool) {
                        // Push data to on_bottom array
                        $temp_data[$id][] = array(
                          'title' => $rows['title'],
                          'data' => '<span class="available"><i class="ion-checkmark-round"></i></span>',
                          'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                        );
                      } else {
                        // Push data to on_bottom array
                        $temp_data[$id][] = array(
                          'title' => $rows['title'],
                          'data' => '<span class="not-available"><i class="ion-close-round"></i></span>',
                          'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                        );
                      }
                    } else {
                      // Push data to on_bottom array
                      $temp_data[$id][] = array(
                        'title' => $rows['title'],
                        'data' => '<span class="not-available"><i class="ion-close-round"></i></span>',
                        'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                      );
                    }

                    break;

                  case 'rating':
                    if (!empty($post_meta)) {
                      // Generate rating html data
                      if (gettype($post_meta) == 'string') {
                        $rating_value = $post_meta * 20 . '%';
                        $data_html = '<div class="alike-star-rating" title="Rated ' . $post_meta . ' out of ' . $post_meta . '"><span style="width:' . $rating_value . '"></span></div>';
                      } else {
                        $data_html = esc_html__('Array or Object are not allowed here', 'alike');
                      }
                      $temp_data[$id][] = array(
                        'title' => $result['title'],
                        'data'  => $data_html,
                        'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
                      );
                    } else {
                      $temp_data[$id][] = array(
                        'title' => $result['title'],
                        'data'  => '-',
                        'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
                      );
                    }
                    break;

                  default:
                    if (!empty($post_meta)) {

                      $temp_data[$id][] = array(
                        'title' => $rows['title'],
                        'data'  => $post_meta,
                        'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                      );
                    } else {
                      $temp_data[$id][] = array(
                        'title' => $rows['title'],
                        'data'  => '-',
                        'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                      );
                    }
                    break;
                }
              }
              break;
            case 'taxonomy_keys':
              foreach ($ids as $id) {
                $post_terms = get_the_terms($id, $check_keys[1]);
                if (!empty($post_terms)) {
                  $terms = array();
                  foreach ($post_terms as $term) {
                    $terms[] = $term->name;
                  }
                  $temp_data[$id][] = array(
                    'title' => $rows['title'],
                    'data'  => implode(', ', $terms),
                    'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                  );
                } else {
                  $temp_data[$id][] = array(
                    'title' => $rows['title'],
                    'data'  => '-',
                    'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                  );
                }
              }
              break;
            case 'post_keys':
              switch ($check_keys[1]) {
                case 'post_thumbnail':
                  foreach ($ids as $id) {

                    $temp_data[$id][] = array(
                      'title' => $rows['title'],
                      'data'  => get_the_post_thumbnail($id, 'alike_thumbnail'),
                      'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                    );
                  }
                  break;

                case 'post_title':
                  foreach ($ids as $id) {

                    $temp_data[$id][] = array(
                      'title' => $rows['title'],
                      'data'  => '<h2>' . get_the_title($id) . '</h2>',
                      'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                    );
                  }
                  break;

                case 'post_title_link':
                  foreach ($ids as $id) {

                    $temp_data[$id][] = array(
                      'title' => $rows['title'],
                      'data'  => '<a href="' . get_the_permalink($id) . '"><h2>' . get_the_title($id) . '</h2></a>',
                      'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                    );
                  }
                  break;

                case 'post_excerpt':
                  foreach ($ids as $id) {

                    $temp_data[$id][] = array(
                      'title' => $rows['title'],
                      'data'  => get_the_excerpt($id),
                      'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                    );
                  }
                  break;
                case 'post_content':
                  foreach ($ids as $id) {

                    $temp_data[$id][] = array(
                      'title' => $rows['title'],
                      'data'  =>  apply_filters('the_content', get_post_field('post_content', $post_id)),
                      'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                    );
                  }
                  break;
                case 'woocommerce_price':
                  foreach ($ids as $id) {
                    $_product = wc_get_product($id);
                    $temp_data[$id][] = array(
                      'title' => $rows['title'],
                      'data'  => $_product->get_price_html(),
                      'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                    );
                  }
                  break;
              }
              break;
          }
        } // end foreach $result['rows']
      }

      $comparison_data[] = array(
        'type'            => 'set',
        'title'           => '<div class="alike-group-content"><h4>' . $result['title'] . '</h4></div>',
        'groupBy'         => false,
        'extra_title'     => $extra_title,
        'data'            => $temp_data,
        'customScrollbar' => (isset($result['customScrollbar'])) ? $result['customScrollbar'] : false,
        'height'          => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
      );
    } else { // end if $result['type'] == 'set'
      // _log($rows);
      // if( empty( $rows ) ) {
      //   return;
      // }

      $temp_data  = array();
      if (!isset($result['selectedPost'])) {
        $result['selectedPost'] = "";
      }
      $check_keys = explode(',', $result['selectedPost']);
      switch ($check_keys[0]) {
        case 'meta_keys':
          foreach ($ids as $id) {
            $post_meta = get_post_meta($id, $check_keys[1], true);

            switch ($result['displayType']) {
              case 'price':
                if (!empty($post_meta)) {
                  if ($result['displayType'] == 'price')
                    $temp_data[$id][] = array(
                      'title'   => $result['title'],
                      'data'    => wc_price($post_meta),
                      'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
                    );
                } else {
                  $temp_data[$id][] = array(
                    'title' => $result['title'],
                    'data'  => '-',
                    'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
                  );
                }
                break;
              case 'rating':
                if (!empty($post_meta)) {
                  // Generate rating html data
                  if (gettype($post_meta) == 'string') {
                    $rating_value = $post_meta * 20 . '%';
                    $data_html = '<div class="alike-star-rating" title="Rated ' . $post_meta . ' out of 5"><span style="width:' . $rating_value . '"></span></div>';
                  } else {
                    $data_html = esc_html__('Array or Object are not allowed here', 'alike');
                  }
                  $temp_data[$id][] = array(
                    'title' => $result['title'],
                    'data'  => $data_html,
                    'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
                  );
                } else {
                  $temp_data[$id][] = array(
                    'title' => $result['title'],
                    'data'  => '-',
                    'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
                  );
                }
                break;

              case 'hyperlink':
                if (!empty($post_meta)) {
                  $anchor_title   = (!empty($result['hyperLinkText'])) ? $result['hyperLinkText'] : $result['title'];
                  $anchor_link    = $post_meta;
                  $anchor_target  = $result['hyperLinkTarget'];
                  $anchor_class   = 'alike-hyperlink-btn';

                  if (!empty($result['hyperLinkUrl'])) {
                    $anchor_link = $anchor_link . $result['hyperLinkUrl'];
                  }

                  if (!empty($result['hyperLinkClass'])) {
                    $anchor_class .= ' ' . $result['hyperLinkClass'];
                  }

                  $data_html = '<a class="' . $anchor_class . '" href="' . esc_url($anchor_link) . '" target="' . $anchor_target . '">' . $anchor_title . '</a>';
                  $temp_data[$id][] = array(
                    'title' => $result['title'],
                    'data'  => $data_html,
                    'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
                  );
                } else {
                  $temp_data[$id][] = array(
                    'title' => $result['title'],
                    'data'  => '-',
                    'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
                  );
                }
                break;

              case 'boolean':

                if (!empty($post_meta)) {

                  $bool = filter_var($post_meta, FILTER_VALIDATE_BOOLEAN);

                  if ($bool) {
                    // Push data to on_bottom array
                    $temp_data[$id][] = array(
                      'title' => $rows['title'],
                      'data' => '<span class="available"><i class="ion-checkmark-round"></i></span>',
                      'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                    );
                  } else {
                    // Push data to on_bottom array
                    $temp_data[$id][] = array(
                      'title' => $rows['title'],
                      'data' => '<span class="not-available"><i class="ion-close-round"></i></span>',
                      'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                    );
                  }
                } else {
                  // Push data to on_bottom array
                  $temp_data[$id][] = array(
                    'title' => $rows['title'],
                    'data' => '<span class="not-available"><i class="ion-close-round"></i></span>',
                    'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                  );
                }

                break;

              default:
                if (!empty($post_meta)) {
                  $temp_data[$id][] = array(
                    'title' => $result['title'],
                    'data'  => $post_meta,
                    'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
                  );
                } else {
                  $temp_data[$id][] = array(
                    'title' => $result['title'],
                    'data'  => '-',
                    'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
                  );
                }
                break;
            }
          }
          break;
        case 'taxonomy_keys':
          foreach ($ids as $id) {
            $post_terms = get_the_terms($id, $check_keys[1]);
            if (!empty($post_terms)) {
              $terms = array();
              foreach ($post_terms as $term) {
                $terms[] = $term->name;
              }
              $temp_data[$id][] = array(
                'title' => $result['title'],
                'data'  => implode(', ', $terms),
                'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
              );
            } else {
              $temp_data[$id][] = array(
                'title' => $result['title'],
                'data'  => '-',
                'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
              );
            }
          }
          break;
        case 'post_keys':
          switch ($check_keys[1]) {
            case 'post_thumbnail':
              foreach ($ids as $id) {
                $temp_data[$id][] = array(
                  'title' => $result['title'],
                  'data'  => get_the_post_thumbnail($id, 'alike_thumbnail'),
                  'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
                );
              }
              break;

            case 'post_title':
              foreach ($ids as $id) {

                $temp_data[$id][] = array(
                  'title' => $result['title'],
                  'data'  => '<h2>' . get_the_title($id) . '</h2>',
                  'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
                );
              }
              break;

            case 'post_title_link':
              foreach ($ids as $id) {

                $temp_data[$id][] = array(
                  'title' => $result['title'],
                  'data'  => '<a href="' . get_the_permalink($id) . '"><h2>' . get_the_title($id) . '</h2></a>',
                  'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
                );
              }
              break;

            case 'post_excerpt':
              foreach ($ids as $id) {

                $temp_data[$id][] = array(
                  'title' => $result['title'],
                  'data'  => get_the_excerpt($id),
                  'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
                );
              }
              break;
            case 'post_content':
              foreach ($ids as $id) {

                $temp_data[$id][] = array(
                  'title' => $result['title'],
                  'data'  =>  apply_filters('the_content', get_post_field('post_content', $id)),
                  'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
                );
              }
              break;
            case 'woocommerce_price':
              foreach ($ids as $id) {
                $_product = wc_get_product($id);
                $temp_data[$id][] = array(
                  'title' => $rows['title'],
                  'data'  => $_product->get_price_html(),
                  'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
                );
              }
              break;
            case 'woocommerce_add_to_cart':
              foreach ($ids as $id) {
                $_product = wc_get_product($id);
                if ($_product->is_type('simple')) {
                  $temp_data[$id][] = array(
                    'title' => $rows['title'],
                    'data'  => '<a rel="nofollow" href="/shop/?add-to-cart=' . $id . '" data-quantity="1" data-product_id="' . $id . '" data-product_sku="' . $_product->get_sku() . '" class="button add_to_cart_button ajax_add_to_cart">' . __('Add to cart', 'alike') . '</a>',
                    'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
                  );
                } else {
                  $temp_data[$id][] = array(
                    'title' => $rows['title'],
                    'data'  => '<a rel="nofollow" href="' . get_the_permalink($id) . '" data-quantity="1" data-product_id="' . $id . '" data-product_sku="' . $_product->get_sku() . '" class="button add_to_cart_button">' . __('Select options', 'alike') . '</a>',
                    'height'  => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
                  );
                }
              }
              break;
          }
          break;

        default:

          foreach ($ids as $id) {
            $post_terms = get_the_terms($id, $check_keys[0]);

            if (!empty($post_terms)) {
              $terms = array();
              foreach ($post_terms as $term) {
                $terms[] = $term->term_id;
              }

              if (in_array($check_keys[1], $terms)) {
                // Push data to on_bottom array
                $temp_data[$id][] = array(
                  'title' => isset($rows['title']) ? $rows['title'] : "",
                  'data' => '<span class="available"><i class="ion-checkmark-round"></i></span>',
                  'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
                );
              } else {
                // Push data to on_bottom array
                $temp_data[$id][] = array(
                  'title' => isset($rows['title']) ? $rows['title'] : "",
                  'data' => '<span class="not-available"><i class="ion-close-round"></i></span>',
                  'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',

                );
              }
            } else {
              // Push data to on_bottom array
              $temp_data[$id][] = array(
                'title' => isset($rows['title']) ? $rows['title'] : "",
                'data' => '<span class="not-available"><i class="ion-close-round"></i></span>',
                'height'  => (isset($rows['height']) && !empty($rows['height'])) ? $rows['height'] : '',
              );
            }
          }

          break;
      }

      $comparison_data[] = array(
        'type'            => 'row',
        'title'           => $result['title'],
        'groupBy'         => false,
        'data'            => $temp_data,
        'customScrollbar' => (isset($result['customScrollbar'])) ? $result['customScrollbar'] : false,
        'height'          => (isset($result['height']) && !empty($result['height'])) ? $result['height'] : '',
      );
    } // end if $result['type'] == 'set'

  } // end foreach $results



  $new_data_set = array();
  foreach ($comparison_data as $comparison_value) {
    $groupBy = (isset($comparison_value['groupBy']) && $comparison_value['groupBy'] == true) ? true : false;
    if ($show_difference == 'yes') {
      if (alike_check_similarities($comparison_value['data'])) {
        foreach ($comparison_value['data'] as $key => $value) {
          $some_value = array();
          if ($comparison_value['type'] == 'set' && isset($comparison_value['groupBy']) && $comparison_value['groupBy'] == false) {

            $some_value[] = array(
              'title' => '&nbsp;',
              'data' => '<div class="alike-group-content">&nbsp;</div>',
            );
          }
          $new_data_set[$key][] = array(
            'type'              => $comparison_value['type'],
            'groupBy'           => $groupBy,
            'title'             => $comparison_value['title'],
            'value'             => array_merge($some_value, $value),
            'customScrollbar'   => (isset($comparison_value['customScrollbar']) && $comparison_value['customScrollbar'] == 'enable') ? 'enable' : 'disable',
          );
        }
      }
    } else {
      foreach ($comparison_value['data'] as $key => $value) {
        $some_value = array();
        if ($comparison_value['type'] == 'set' && isset($comparison_value['groupBy']) && $comparison_value['groupBy'] == false) {

          $some_value[] = array(
            'title' => '&nbsp;',
            'data' => '<div class="alike-group-content">&nbsp;</div>',
          );
        }
        $new_data_set[$key][] = array(
          'type'              => $comparison_value['type'],
          'groupBy'           => $groupBy,
          'title'             => $comparison_value['title'],
          'value'             => array_merge($some_value, $value),
          'customScrollbar'   => (isset($comparison_value['customScrollbar']) && $comparison_value['customScrollbar'] == 'enable') ? 'enable' : 'disable',
        );
      }
    }

    // endif;
  }

  return array(
    'comparison_data'   => $comparison_data,
    'new_data_set'      => $new_data_set,
  );
}

function alike_check_similarities($arr)
{
  $init       = current($arr);
  $firstValue = $init[0]['data'];
  if ($firstValue === '&nbsp;' || $firstValue === '<div class="alike-group-content">&nbsp;</div>') {
    return false;
  }
  foreach ($arr as $val) {

    if ($firstValue !== $val[0]['data']) {
      return true;
    }
  }
  return false;
}
