<?php
  $post_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail', false );
?>
<a href="#"
  class="alike-button alike-button-style"
  data-post-id="<?php echo esc_attr( get_the_ID() ) ?>"
  data-post-title="<?php echo esc_attr( get_the_title() ) ?>"
  data-post-thumb="<?php echo esc_url( $post_image_src[0] ) ?>"
  data-post-link="<?php echo esc_url( get_the_permalink() ) ?>"
  title="<?php echo esc_attr($value) ?>"
  onclick="alikeAddToCompare()"
  ><?php echo ($show_icon) ? '<i class="'.$icon_class.'"></i>' : esc_attr($value); ?></a>

<script type="text/javascript">
  function alikeAddToCompare() {
    jQuery('body a.alike-button').live('click', function(e) {
      e.preventDefault();
      var postId = jQuery(this).data('post-id');
      var postTitle = jQuery(this).data('post-title');
      var postThumb = jQuery(this).data('post-thumb');
      var postLink = jQuery(this).data('post-link');

      var allPosts = window.localStorage.getItem('alikeData') ? JSON.parse(window.localStorage.getItem('alikeData')) : [];

      var checkIndex = _.findIndex(allPosts, { postId });

      if (checkIndex === -1) {
        var newPost = {
          postId, postTitle, postThumb, postLink,
        };
        if (allPosts.length < ALIKE.max_compare) {
          allPosts.push(newPost);
        } else {
          alert(ALIKE.LANG.YOU_CAN_COMPARE_MAXIMUM_BETWEEN_S_ITEMS);
        }
      }

      window.localStorage.setItem('alikeData', JSON.stringify(allPosts));
      jQuery('alike-compare-widget-wrapper').show();
      jQuery('.alike-compare-widget-content').removeClass('alike-compare-widget-content-before-scale').addClass('alike-compare-widget-content-scale');
      onStorageEvent();
    });
  }

  function onStorageEvent(storageEvent) {
      if (jQuery('.alike-compare-widget-content-load').length > 0) {
        var items = (JSON.parse(localStorage.getItem('alikeData')) !== null) ? JSON.parse(localStorage.getItem('alikeData')) : [];
        jQuery('.alike-compare-widget-counter').html(items.length);
        if (items.length > 0) {
          jQuery('.alike-compare-widget-wrapper').show();
          var customWidth = items.length*160;
          jQuery('.alike-compare-widget-content').css('width', customWidth + 'px');
          jQuery('.alike-compare-widget-content').removeClass('alike-compare-widget-content-before-scale').addClass('alike-compare-widget-content-scale');
        } else {
          jQuery('.alike-compare-widget-wrapper').hide();
        }

        var resultTemplate = _.template(jQuery('.alike-list').html());
        var resultingHtml = resultTemplate({ items });
        var allPostIds = [];
        items.forEach(function(value) {
          allPostIds.push(value.postId);
        });
        
        var pageUrl = ALIKE.pageUrl;
        jQuery('.alike-compare-widget-button').attr('href', pageUrl + '?ids=' + allPostIds.join([',']));

        jQuery('.alike-compare-widget-content-load').html(resultingHtml).on('click', '.alike-compare-widget-post-remove-button', function (e) {
          e.preventDefault();
          var postId = jQuery(this).data('post-id');
          var allPosts = JSON.parse(window.localStorage.getItem('alikeData'));
          var checkIndex = _.findIndex(allPosts, { postId });

          if (checkIndex !== -1) {
            allPosts.splice(checkIndex, 1);
            window.localStorage.setItem('alikeData', JSON.stringify(allPosts));

            onStorageEvent();
          }
        }).next('.alike-compare-widget-post-remove-all').on('click', '.alike-compare-widget-post-remove-all-content', function (e) {
          e.preventDefault();
          window.localStorage.setItem('alikeData', '[]');
          onStorageEvent();
        });
      }
    }
</script>