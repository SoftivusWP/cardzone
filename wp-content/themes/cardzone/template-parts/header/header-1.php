<?php 

	/**
	 * Template part for displaying header layout one
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package cardzone
	*/

   // Header Address Link
   $header_top_address_link = get_theme_mod( 'header_address_link', esc_html__( '#', 'cardzone' ) );

   // Button Text
   $header_right_button_text = get_theme_mod( 'header_button_text', esc_html__( 'Apply Now', 'cardzone' ) );
   $header_right_button_link = get_theme_mod( 'header_button_link', esc_html__( '#', 'cardzone' ) );

   // header search btn 
   $header_search_switch = get_theme_mod( 'header_search_switch', true );

   //Header right switch
   $cardzone_header_right = get_theme_mod( 'header_right_switch', false );

?>


<header class="header-section bgadd">
   <div class="container">
      <div class="header-wrapper">
         <div class="logo-menu">
            <!--header logo-->
            <?php cardzone_header_logo(); ?>
         </div>
            <!--header main menu-->
            <?php cardzone_header_menu(); ?>
        <?php if(!empty($cardzone_header_right)): ?>
            <div class="menu__right__components d-flex align-items-center">
                <div class="menu__components">
                <?php if(!empty($header_search_switch)): ?>
                    <button id="searchBtn">
                        <i class="material-symbols-outlined">
                            <?php echo esc_html__('search', 'cardzone'); ?>
                        </i>
                    </button>
                <?php endif; ?>
                    <div class="tolly__shop">
                        <a href="<?php echo wc_get_cart_url(); ?>">
                            <i class="material-symbols-outlined">
                                shopping_cart
                            </i>
                        </a>
                        <span class="cart-total"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                    </div>
                    <?php if(!empty($header_right_button_text)): ?>
                        <a href="<?php echo esc_url($header_right_button_link); ?>" class="cmn--btn">
                            <span><?php echo esc_html($header_right_button_text); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="header-bar">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        <?php endif; ?>
      </div>
   </div>
</header>





<?php get_template_part( 'template-parts/header/header-side-info' ); ?>