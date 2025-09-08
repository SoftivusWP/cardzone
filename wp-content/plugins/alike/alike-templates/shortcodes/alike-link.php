<?php
if ($post_id != null) {
  $post_id = $post_id;
} else {
  $post_id = get_the_ID();
}

$post_image_src = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full', false);

$parent_link_class = "alike-button alike-button-style ";

if (!empty($parent_class)) {
  $parent_link_class .= $parent_class;
}
?>
<a href="#" class="<?php echo esc_attr(trim($parent_link_class)) ?>" data-post-id="<?php echo esc_attr($post_id) ?>" data-post-title="<?php echo esc_attr(get_the_title($post_id)) ?>" data-post-thumb="<?php echo isset($post_image_src[0]) ? esc_url($post_image_src[0]) : "" ?>" data-post-link="<?php echo esc_url(get_the_permalink($post_id)) ?>" title="<?php echo esc_attr($text) ?>">
  <?php
  switch ($preview) {
    case "text":
      echo esc_attr($text);
      break;
    case "icon":
      echo '<i class="' . $icon_class . '"></i>';
      break;
    case "text_icon":
      echo esc_attr($text) . ' <i class="' . $icon_class . '"></i>';
      break;
    case "icon_text":
      echo '<i class="' . $icon_class . '"></i> ' . esc_attr($text);
      break;
    default:
      echo esc_attr($text);
      break;
  }
  // echo ($show_icon) ? '<i class="'.$icon_class.'"></i>' : esc_attr($text);
  ?>
</a>