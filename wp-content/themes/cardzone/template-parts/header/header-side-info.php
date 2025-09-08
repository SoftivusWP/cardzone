<?php 

   /**
    * Template part for displaying header side information
    *
    * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
    *
    * @package cardzone
   */

   // $header_side_logo = get_theme_mod( 'header_side_logo', get_template_directory_uri() . '/assets/img/logo/logo-black.png' );

    // Contacts Text 
    $header_side_contacts_text = get_theme_mod( 'header_side_contacts_text', esc_html__( 'CONTACT US', 'cardzone' ) );

    // Contacts Text 
    $header_side_contacts_text = get_theme_mod( 'header_side_contacts_text', esc_html__( 'CONTACT US', 'cardzone' ) );
   // Email id 
   $header_top_email = get_theme_mod( 'header_email', esc_html__( 'cardzone@support.com', 'cardzone' ) );

   // Phone Number
   $header_top_phone = get_theme_mod( 'header_phone', esc_html__( '+8801310-069824', 'cardzone' ) );

   // Header Address Text
   $header_top_address_text = get_theme_mod( 'header_address', esc_html__( '734 H, Bryan Burlington, NC 27215', 'cardzone' ) );

   // Header Address Link
   $header_top_address_link = get_theme_mod( 'header_address_link', esc_html__( 'https://www.google.com/maps/@36.0758266,-79.4558848,17z', 'cardzone' ) );


   //Offcanvas About Us
   $offcanvas_about_us = get_theme_mod( 'header_top_offcanvas_textarea', esc_html__( 'Web designing in a powerful way of just not an only professions. We have tendency to believe the idea that smart looking .', 'cardzone' ) );

    // footer area links  switch
    $header_side_info_switch = get_theme_mod( 'header_side_info_switch', false );

?>
<!-- offcanvas area start -->
<div class="offcanvas__area d-none">
    <div class="offcanvas__wrapper">
        <div class="offcanvas__close">
            <button class="offcanvas__close-btn offcanvas-close-btn">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 1L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M1 1L11 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
        <div class="offcanvas__content">
            <div class="offcanvas__top mb-50 d-flex justify-content-between align-items-center">
                <div class="offcanvas__logo logo">
                    <a href="<?php print esc_url( home_url( '/' ) );?>">
                        <img src="<?php echo esc_url( $header_side_logo ); ?>" alt="<?php print esc_attr__( 'logo', 'cardzone' );?>">
                    </a>
                </div>
            </div>

        <div class="tp-main-menu-mobile fix d-xl-none mb-40"></div>
            <?php  if ( !empty( $header_side_info_switch ) ): ?>
            <div class="offcanvas__contact">
                <?php  if ( !empty( $header_side_contacts_text ) ): ?>
                <h4 class="offcanvas__title"><?php echo esc_html( $header_side_contacts_text ); ?></h4>
                <?php endif; ?>
                <?php  if ( !empty( $header_top_address_text ) ): ?>
                <div class="offcanvas__contact-content d-flex">
                    <div class="offcanvas__contact-content-icon">
                        <i class="fa-sharp fa-solid fa-location-dot"></i>
                    </div>
                    <div class="offcanvas__contact-content-content">
                        <a
                            href="<?php echo esc_url( $header_top_address_link ); ?>"><?php echo esc_html( $header_top_address_text ); ?></a>
                    </div>
                </div>
                <?php endif?>
                <?php  if ( !empty( $header_top_email ) ): ?>
                <div class="offcanvas__contact-content d-flex">
                    <div class="offcanvas__contact-content-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="offcanvas__contact-content-content">
                        <a href="mailto:<?php echo esc_attr( $header_top_email ); ?>"><?php echo esc_html( $header_top_email ); ?></a>
                    </div>
                </div>
                <?php endif; ?>
                <?php  if ( !empty(  $header_top_phone ) ): ?>
                <div class="offcanvas__contact-content d-flex">
                    <div class="offcanvas__contact-content-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div class="offcanvas__contact-content-content">
                        <a href="tel:<?php echo esc_attr( $header_top_phone ); ?>"><?php echo esc_html( $header_top_phone ); ?></a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="offcanvas__social">
                <?php cardzone_header_social_profiles(); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="body-overlay"></div>
<!-- offcanvas area end -->
