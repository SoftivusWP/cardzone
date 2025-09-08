<?php 

	/**
	 * Template part for displaying header layout two
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

<header class="header-section header_two header__sectiontwo headerthree">
        <div class="container">
        <div class="header-wrapper">
            <div class="logo-menu">
                <?php cardzone_header_logo(); ?>
            </div>
                <?php cardzone_header_menu(); ?>
            <?php if(!empty($cardzone_header_right)): ?>
                <div class="menu__right__components d-flex align-items-center">
                    <div class="menu__components">
                        <?php if(!empty($header_search_switch)): ?>
                            <button id="searchBtn">
                                <i class="material-symbols-outlined">
                                    search
                                </i>
                            </button>
                        <?php endif; ?>
                        <div class="tolly__shop">
                            <a href="gift-card.html">
                                <i class="material-symbols-outlined">
                                shopping_cart
                                </i>
                            </a>
                        </div>
                        <?php if(!empty($header_right_button_text)): ?>
                            <a href="<?php echo esc_url($header_right_button_link); ?>" class="cmn--btn">
                                <span><?php echo esc_html($header_right_button_text); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="header-bar d-lg-none">
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