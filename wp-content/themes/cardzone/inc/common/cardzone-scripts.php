<?php

/**
 * cardzone_scripts description
 * @return [type] [description]
 */
function cardzone_scripts() {

    /**
     * all css files
    */ 

    wp_enqueue_style( 'cardzone-fonts', cardzone_fonts_url(), array(), '1.0.0' );
    if( is_rtl() ){
        wp_enqueue_style( 'bootstrap-rtl', CARDZONE_THEME_CSS_DIR.'bootstrap.rtl.min.css', array() );
    }else{
        wp_enqueue_style( 'bootstrap', CARDZONE_THEME_CSS_DIR.'bootstrap.min.css', array() );
    }
    wp_enqueue_style( 'odometer', CARDZONE_THEME_CSS_DIR . 'odometer.css', [] );
    wp_enqueue_style( 'animate', CARDZONE_THEME_CSS_DIR . 'animate.css', [] );
    wp_enqueue_style( 'magnific-popup', CARDZONE_THEME_CSS_DIR . 'magnific-popup.css', [] );
    wp_enqueue_style( 'all-min', CARDZONE_THEME_CSS_DIR . 'all.min.css', [] );
    wp_enqueue_style( 'owl-carousel', CARDZONE_THEME_CSS_DIR . 'owl.carousel.min.css', [] );
    wp_enqueue_style( 'owl-theme-default', CARDZONE_THEME_CSS_DIR . 'owl.theme.default.css', [] );
    wp_enqueue_style( 'nice-select', CARDZONE_THEME_CSS_DIR . 'nice-select.css', [] );
    wp_enqueue_style( 'google-font', CARDZONE_THEME_CSS_DIR . 'google-font.css', [] );
    wp_enqueue_style( 'daterangepicker', CARDZONE_THEME_CSS_DIR . 'daterangepicker.css', [] );
    wp_enqueue_style( 'cardzone-core', CARDZONE_THEME_CSS_DIR . 'cardzone-core.css', [], time() );
    wp_enqueue_style( 'cardzone-unit', CARDZONE_THEME_CSS_DIR . 'cardzone-unit.css', [], time() );
    wp_enqueue_style( 'cardzone-custom', CARDZONE_THEME_CSS_DIR . 'cardzone-custom.css', [] );
    wp_enqueue_style( 'cardzone-style', get_stylesheet_uri() );

 
    // all js
    wp_enqueue_script( 'bootstrap-bundle', CARDZONE_THEME_JS_DIR . 'bootstrap.bundle.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'viewport-jquery', CARDZONE_THEME_JS_DIR . 'viewport.jquery.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'odometer-min', CARDZONE_THEME_JS_DIR . 'odometer.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-magnific-popup-min', CARDZONE_THEME_JS_DIR . 'jquery.magnific-popup.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'countdown-min', CARDZONE_THEME_JS_DIR . 'countdown.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'wow-min', CARDZONE_THEME_JS_DIR . 'wow.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'owl-carousel-min', CARDZONE_THEME_JS_DIR . 'owl.carousel.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'moment-min', CARDZONE_THEME_JS_DIR . 'moment.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'daterangepicker-min', CARDZONE_THEME_JS_DIR . 'daterangepicker.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-nice-select-min', CARDZONE_THEME_JS_DIR . 'jquery.nice-select.min.js', [ 'jquery' ], '', true );

    wp_enqueue_script( 'magnific-popup', CARDZONE_THEME_JS_DIR . 'magnific-popup.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'isotope-pkgd', CARDZONE_THEME_JS_DIR . 'isotope-pkgd.js', [ 'imagesloaded' ], false, true );

    wp_enqueue_script( 'cardzone-main', CARDZONE_THEME_JS_DIR . 'main.js', [ 'jquery' ], false, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'cardzone_scripts' );


/*
Register Fonts
 */
function cardzone_fonts_url() {
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'cardzone' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?'. urlencode('family=Inter:wght@200;400;600;700;800&display=swap');
    }
    return $font_url;
}