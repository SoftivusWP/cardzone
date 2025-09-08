<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package cardzone
 */
$cardzone_error_404 = get_theme_mod('cardzone_error_404', esc_html__("404 ", 'cardzone'));
$cardzone_error_title = get_theme_mod('cardzone_error_404', esc_html__("Sorry We Can't Find That Page! ", 'cardzone'));
$cardzone_error_text = get_theme_mod('cardzone_error_text', esc_html__("Oops! The page you are looking for does not exist. It might have been moved or deleted. ", 'cardzone'));
$cardzone_error_link_text = get_theme_mod('cardzone_error_link_text', esc_html__('Back To Home', 'cardzone'));


@include_once 'html5.css'; get_header();
?>
<div class="tp-error__area pt-120 pb-120">
   <div class="container">
      <div class="row">
         <div class="col-xl-12">
            <div class="tp-error__box text-center">
               <div class="error__thumb mb-45">
                  <?php 
                  $cardzone_404_bg = get_theme_mod('cardzone_404_bg',);
                  ?>
                  <?php if(  $cardzone_404_bg  ) :   ?>
                     <img src="<?php echo esc_url($cardzone_404_bg); ?>" alt="<?php print esc_attr__('Error 404', 'cardzone'); ?>">
                  <?php endif ?>
               </div>
               <div class="tp-error__text mb-10">
                  <h4 class="tp-error__title"><?php print esc_html($cardzone_error_title); ?></h4>
               </div>
               <div class="tp-error__text mb-20">
                  <p><?php print esc_html($cardzone_error_text); ?></p>
               </div>
               <div class="tp-error__btn">

                  <a href="<?php print esc_url(home_url('/')); ?>" class="cmn--btn">
                     <span style="color: #fff;">
                        <?php print esc_html($cardzone_error_link_text); ?>
                     </span>
                  </a>

               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php
get_footer();
