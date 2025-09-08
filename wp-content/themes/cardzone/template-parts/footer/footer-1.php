<?php 

/**
 * Template part for displaying footer layout three
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cardzone
*/


    $cardzone_footer_logo = get_theme_mod( 'cardzone_footer_logo' );
    $footer_bottom_menu = get_theme_mod( 'footer_bottom_menu' );
    $cardzone_footer_top_space = function_exists('tpmeta_field') ? tpmeta_field('cardzone_footer_top_space') : '0';
    
    //footer bg image & color
    $cardzone_footer_bg_url_from_page = function_exists( 'tpmeta_image_field' ) ? tpmeta_image_field( 'cardzone_footer_bg_image' ) : '';

    $cardzone_footer_bg_color_from_page = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'cardzone_footer_bg_color' ) : '';

    $footer_bg_img = get_theme_mod( 'footer_bg_image' );
    $footer_bg_color = get_theme_mod( 'footer_bg_color' );
    
    $footer_copyright_switch = get_theme_mod( 'footer_copyright_switch', true );
    $footer_bottom_copyright_area_switch = get_theme_mod( 'footer_bottom_copyright_area_switch', true );

    // bg image
    $bg_img = !empty( $cardzone_footer_bg_url_from_page['url'] ) ? $cardzone_footer_bg_url_from_page['url'] : $footer_bg_img;

    // bg color
     $bg_color = !empty( $cardzone_footer_bg_color_from_page ) ? $cardzone_footer_bg_color_from_page : $footer_bg_color;



    $footer_menu_switch = get_theme_mod( 'footer_menu_switch', false );

    // footer_columns
    $footer_columns = 0;
    $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

    for ( $num = 1; $num <= $footer_widgets + 1; $num++ ) {
        if ( is_active_sidebar( 'footer-' . $num ) ) {
            $footer_columns++;
        }
    }

    switch ( $footer_columns ) {
    case '1':
        $footer_class[1] = 'col-lg-12';
        break;
    case '2':
        $footer_class[1] = 'col-lg-6 col-md-6';
        $footer_class[2] = 'col-lg-6 col-md-6';
        break;
    case '3':
        $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
        $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
        $footer_class[3] = 'col-xl-4 col-lg-6';
        break;
    case '4':
        $footer_class[1] = 'col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6';
        $footer_class[2] = 'col-xxl-2 col-xl-2 col-lg-2 col-md-6 col-sm-6';
        $footer_class[3] = 'col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6';
        $footer_class[4] = 'col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6';
        break;
    default:
        $footer_class = 'col-xl-3 col-lg-3 col-md-6';
        break;
    }

?>


<!--Footer Section-->
<footer class="footer__section bgadd" style="background-color: <?php echo esc_url($bg_color);?>" >
   <div class="container">

   <?php if ( is_active_sidebar('footer-1') OR is_active_sidebar('footer-2') OR is_active_sidebar('footer-3') OR is_active_sidebar('footer-4') ): ?>
      <div class="footer__top pt-120 pb-120">
         <div class="row g-4">
                <?php
                    if ( $footer_columns > 4 ) {
                    print '<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">';
                    dynamic_sidebar( 'footer-1' );
                    print '</div>';

                    print '<div class="col-xxl-2 col-xl-2 col-lg-2 col-md-6 col-sm-6">';
                    dynamic_sidebar( 'footer-2' );
                    print '</div>';

                    print '<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">';
                    dynamic_sidebar( 'footer-3' );
                    print '</div>';

                    print '<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">';
                    dynamic_sidebar( 'footer-4' );
                    print '</div>';
                    } else {
                        for ( $num = 1; $num <= $footer_columns; $num++ ) {
                            if ( !is_active_sidebar( 'footer-' . $num ) ) {
                                continue;
                            }
                            print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                            dynamic_sidebar( 'footer-' . $num );
                            print '</div>';
                        }
                    }
                ?>
         </div>
      </div>
    <?php endif; ?>
      
      <div class="footer__bottom d-flex align-items-center">

        <?php if(!empty($footer_copyright_switch)): ?>
            <p class="fz-16 fw-400 inter text-white">
                <?php print cardzone_copyright_text(); ?>
            </p>
        <?php endif; ?>
        <?php if(!empty($footer_bottom_menu)): ?>
            <ul class="help__support d-flex align-items-center">
                <?php echo cardzone_kses( $footer_bottom_menu ); ?>
            </ul>
        <?php endif; ?>
      </div>
   </div>
</footer>

<!-- footer area end -->
 