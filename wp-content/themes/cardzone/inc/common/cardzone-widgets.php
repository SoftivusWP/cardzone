<?php 

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cardzone_widgets_init() {

    $footer_style_2_switch = get_theme_mod( 'footer_layout_2_switch', false );
    $footer_style_3_switch = get_theme_mod( 'footer_layout_2_switch', false );

    /**
     * blog sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Blog Sidebar', 'cardzone' ),
        'id'            => 'blog-sidebar',
        'before_widget' => '<div id="%1$s" class="rs-sidebar-widget card__common__item bgwhite round16 mb-24 mb-40 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="rs-sidebar-widget-title head fw-600 bborderdash title pb-24 mb-24">',
        'after_title'   => '</h3>',
    ] );

    
    //Product Sidebar
     register_sidebar( [
        'name'          => esc_html__( 'Product Sidebar', 'cardzone' ),
        'id'            => 'product-sidebar',
        'before_widget' => '<div id="%1$s" class="sidebar__widget bank__check__wrap pb-24 %2$s">', 
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="sidebar__widget-title title mb-16">',
        'after_title'   => '</h5>',
    ] );


    $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

    // footer default
    for ( $num = 1; $num <= $footer_widgets; $num++ ) {
        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer %1$s', 'cardzone' ), $num ),
            'id'            => 'footer-' . $num,
            'description'   => sprintf( esc_html__( 'Footer Column %1$s', 'cardzone' ), $num ),
            'before_widget' => '<div id="%1$s" class="pa-footer-widget tp-footer-2-col-'.$num.' mb-50 %2$s"> <div class="tp-footer-widget-content">',
            'after_widget'  => '</div></div>',
            'before_title'  => '<h3 class="pa-footer-widget-title footer__title fz-24 fw-600 inter text-white mb-24 d-block">',
            'after_title'   => '</h3>',
        ] );
    }

    // footer 2
    if ( $footer_style_2_switch ) {
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {

            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 2 : %1$s', 'cardzone' ), $num ),
                'id'            => 'footer-2-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 2 : %1$s', 'cardzone' ), $num ),
                'before_widget' => '<div id="%1$s" class="tp-footer-widget tp-footer-col-'.$num.' mb-50 %2$s"> <div class="tp-footer-widget-content">',
                'after_widget'  => '</div></div>',
                'before_title'  => '<h3 class="tp-footer-widget-title">',
                'after_title'   => '</h3>',
            ] );
        }
    }    
  
    // footer 3
    if ( $footer_style_3_switch ) {
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {

            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 3 : %1$s', 'cardzone' ), $num ),
                'id'            => 'footer-3-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 3 : %1$s', 'cardzone' ), $num ),
                'before_widget' => '<div id="%1$s" class="tp-footer-widget tp-footer-3-col-'.$num.' mb-50 %2$s"> <div class="tp-footer-widget-content">',
                'after_widget'  => '</div></div>',
                'before_title'  => '<h3 class="tp-footer-widget-title">',
                'after_title'   => '</h3>',
            ] );
        }
    }    
}
add_action( 'widgets_init', 'cardzone_widgets_init' );