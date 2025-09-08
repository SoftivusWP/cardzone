<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package cardzone
 */

function get_header_style($style){
    if ( $style == 'header_2'  ) {
        get_template_part( 'template-parts/header/header-2' );
    }
    elseif ( $style == 'header_3'  ) {
        get_template_part( 'template-parts/header/header-3' );
    }
    elseif ( $style == 'header_1_onepage' ) {
        get_template_part( 'template-parts/header/header-1-onepage' );
    }
    elseif ( $style == 'header_2_onepage' ) {
        get_template_part( 'template-parts/header/header-2-onepage' );
    }
    elseif ( $style == 'header_3_onepage' ) {
        get_template_part( 'template-parts/header/header-3-onepage' );
    }
    else{
        get_template_part( 'template-parts/header/header-1');
    }
}

function cardzone_check_header() {
    $tp_header_tabs = function_exists('tpmeta_field')? tpmeta_field('cardzone_header_tabs') : false;
    $tp_header_style_meta = function_exists('tpmeta_field')? tpmeta_field('cardzone_header_style') : '';
    $elementor_header_template_meta = function_exists('tpmeta_field')? tpmeta_field('cardzone_header_templates') : false;

    $cardzone_header_option_switch = get_theme_mod('cardzone_header_elementor_switch', false);
    $header_default_style_kirki = get_theme_mod( 'header_layout_custom', 'header_1' );
    $elementor_header_templates_kirki = get_theme_mod( 'cardzone_header_templates' );
    
    if($tp_header_tabs == 'default'){
        if($cardzone_header_option_switch){
            if($elementor_header_templates_kirki){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            }
        }else{ 
            if($header_default_style_kirki){
                get_header_style($header_default_style_kirki);
            }else{
                get_template_part( 'template-parts/header/header-1' );
            }
        }
    }elseif($tp_header_tabs == 'custom'){
        if ($tp_header_style_meta) {
            get_header_style($tp_header_style_meta);
        }else{
            get_header_style($header_default_style_kirki);
        }  
    }elseif($tp_header_tabs == 'elementor'){
        if($elementor_header_template_meta){
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_template_meta);
        }else{
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
        }
    }else{
        if($cardzone_header_option_switch){

            if($elementor_header_templates_kirki){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            }else{
                get_template_part( 'template-parts/header/header-1' );
            }
        }else{
            get_header_style($header_default_style_kirki);

        }
        
    }

}
add_action( 'cardzone_header_style', 'cardzone_check_header', 10 );



/**
 * [cardzone_header_lang description]
 * @return [type] [description]
 */

function cardzone_header_lang_defualt() {
    $cardzone_header_lang = get_theme_mod( 'cardzone_header_lang', true );
    if ( $cardzone_header_lang ): ?>

<span class="tp-header-lang-selected-lang tp-lang-toggle"
    id="tp-header-lang-toggle"><?php print esc_html__( 'English', 'cardzone' );?></span>

<?php do_action( 'cardzone_language' );?>

<?php endif;?>
<?php
}

/**
 * [cardzone_language_list description]
 * @return [type] [description]
 */
function _cardzone_language( $mar ) {
    return $mar;
}
function cardzone_language_list() {

    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul class="tp-header-lang-list tp-lang-list">';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="tp-header-lang-list tp-lang-list tp-header-lan-list-area">';
        $mar .= '<li><a href="#">' . esc_html__( 'English', 'cardzone' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Bangla', 'cardzone' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'French', 'cardzone' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Hindi', 'cardzone' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _cardzone_language( $mar );
}
add_action( 'cardzone_language', 'cardzone_language_list' );



// header logo
function cardzone_header_logo() { ?>
    <?php 
        $cardzone_logo_on = function_exists('tpmeta_field')? tpmeta_field('cardzone_en_secondary_logo') : '';
        $cardzone_logo = get_template_directory_uri() . '/assets/img/logo/logo.png';
        $cardzone_logo_white = get_template_directory_uri() . '/assets/img/logo/logolisht.png';

        $cardzone_site_logo = get_theme_mod( 'header_logo', $cardzone_logo );
        $cardzone_secondary_logo = get_theme_mod( 'header_secondary_logo', $cardzone_logo_white );
      ?>

    <?php if ( $cardzone_logo_on == 'on' ) : ?>
    <a class="main-logo" href="<?php print esc_url( home_url( '/' ) );?>">
        <img src="<?php print esc_url( $cardzone_secondary_logo );?>" alt="<?php print esc_attr__( 'logo', 'cardzone' );?>" />
    </a>
    <?php else : ?>
    <a class="standard-logo" href="<?php print esc_url( home_url( '/' ) );?>">
        <img src="<?php print esc_url( $cardzone_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'cardzone' );?>" />
    </a>
    <?php endif; ?>
<?php
}

/**
 * [cardzone_header_social_profiles description]
 * @return [type] [description]
 */
function cardzone_header_social_profiles() {
    $cardzone_topbar_fb_url = get_theme_mod( 'header_facebook_link', esc_html__( '#', 'cardzone' ) );
    $cardzone_topbar_twitter_url = get_theme_mod( 'header_twitter_link', esc_html__( '#', 'cardzone' ) );
    $cardzone_topbar_instagram_url = get_theme_mod( 'header_instagram_link', esc_html__( '#', 'cardzone' ) );
    $cardzone_topbar_linkedin_url = get_theme_mod( 'header_linkedin_link', esc_html__( '#', 'cardzone' ) );
    $cardzone_topbar_youtube_url = get_theme_mod( 'header_youtube_link', esc_html__( '#', 'cardzone' ) );
    ?>
<?php if ( !empty( $cardzone_topbar_fb_url ) ): ?>
<a class="icon facebook" href="<?php print esc_url( $cardzone_topbar_fb_url );?>"><i class="fa-brands fa-facebook-f"></i></a>
<?php endif;?>

<?php if ( !empty( $cardzone_topbar_twitter_url ) ): ?>
<a class="icon twitter" href="<?php print esc_url( $cardzone_topbar_twitter_url );?>"><i class="fa-brands fa-twitter"></i></a>
<?php endif;?>

<?php if ( !empty( $cardzone_topbar_instagram_url ) ): ?>
<a class="icon youtube" href="<?php print esc_url( $cardzone_topbar_instagram_url );?>"><i class="fa-brands fa-instagram"></i></a>
<?php endif;?>

<?php if ( !empty( $cardzone_topbar_linkedin_url ) ): ?>
<a class="icon linkedin" href="<?php print esc_url( $cardzone_topbar_linkedin_url );?>"><i class="fab fa-linkedin"></i></a>
<?php endif;?>

<?php if ( !empty( $cardzone_topbar_youtube_url ) ): ?>
<a class="icon youtube" href="<?php print esc_url( $cardzone_topbar_youtube_url );?>"><i class="fab fa-youtube"></i></a>
<?php endif;?>

<?php
}

/**
 * [cardzone_header_side_info_social_profiles description]
 * @return [type] [description]
 */
function cardzone_header_side_info_social_profiles() {
    $cardzone_topbar_fb_url = get_theme_mod( 'header_facebook_link', esc_html__( '#', 'cardzone' ) );
    $cardzone_topbar_twitter_url = get_theme_mod( 'header_twitter_link', esc_html__( '#', 'cardzone' ) );
    $cardzone_topbar_instagram_url = get_theme_mod( 'header_instagram_link', esc_html__( '#', 'cardzone' ) );
    $cardzone_topbar_linkedin_url = get_theme_mod( 'header_linkedin_link', esc_html__( '#', 'cardzone' ) );
    $cardzone_topbar_youtube_url = get_theme_mod( 'header_youtube_link', esc_html__( '#', 'cardzone' ) );
    ?>

<?php if ( !empty( $cardzone_topbar_fb_url ) ): ?>
<a class="icon facebook" href="<?php print esc_url( $cardzone_topbar_fb_url );?>"><i class="fab fa-facebook-f"></i></a>
<?php endif;?>

<?php if ( !empty( $cardzone_topbar_twitter_url ) ): ?>
<a class="icon twitter" href="<?php print esc_url( $cardzone_topbar_twitter_url );?>"><i class="fab fa-twitter"></i></a>
<?php endif;?>

<?php if ( !empty( $cardzone_topbar_instagram_url ) ): ?>
<a class="icon linkedin" href="<?php echo esc_url( $cardzone_topbar_instagram_url ) ?>"><i
        class="fa-brands fa-instagram"></i></a>
<?php endif;?>

<?php if ( !empty( $cardzone_topbar_linkedin_url ) ): ?>
<a class="icon linkedin" href="<?php echo esc_url( $cardzone_topbar_linkedin_url ) ?>"><i
        class="fab fa-linkedin"></i></a>
<?php endif;?>

<?php if ( !empty( $cardzone_topbar_youtube_url ) ): ?>
<a class="icon youtube" href="<?php print esc_url( $cardzone_topbar_youtube_url );?>"><i class="fab fa-youtube"></i></a>
<?php endif;?>

<?php
}

// cardzone_footer_social_profiles 
function cardzone_footer_social_profiles() {
    $cardzone_footer_fb_url = get_theme_mod( 'cardzone_footer_fb_url', esc_html__( '#', 'cardzone' ) );
    $cardzone_footer_twitter_url = get_theme_mod( 'cardzone_footer_twitter_url', esc_html__( '#', 'cardzone' ) );
    $cardzone_footer_instagram_url = get_theme_mod( 'cardzone_footer_instagram_url', esc_html__( '#', 'cardzone' ) );
    $cardzone_footer_linkedin_url = get_theme_mod( 'cardzone_footer_linkedin_url', esc_html__( '#', 'cardzone' ) );
    $cardzone_footer_youtube_url = get_theme_mod( 'cardzone_footer_youtube_url', esc_html__( '#', 'cardzone' ) );
    ?>


<?php if ( !empty( $cardzone_footer_fb_url ) ): ?>
<a href="<?php print esc_url( $cardzone_footer_fb_url );?>">
    <?php echo esc_html__('Fb.','cardzone'); ?>
</a>
<?php endif;?>

<?php if ( !empty( $cardzone_footer_twitter_url ) ): ?>
<a href="<?php print esc_url( $cardzone_footer_twitter_url );?>">
    <?php echo esc_html__('Tw.','cardzone'); ?>
</a>
<?php endif;?>

<?php if ( !empty( $cardzone_footer_instagram_url ) ): ?>
<a href="<?php print esc_url( $cardzone_footer_instagram_url );?>">
    <?php echo esc_html__('In.','cardzone'); ?>
</a>
<?php endif;?>

<?php if ( !empty( $cardzone_footer_linkedin_url ) ): ?>
<a href="<?php print esc_url( $cardzone_footer_linkedin_url );?>">
    <?php echo esc_html__('Ln.','cardzone'); ?>
</a>
<?php endif;?>

<?php if ( !empty( $cardzone_footer_youtube_url ) ): ?>
<a href="<?php print esc_url( $cardzone_footer_youtube_url );?>">
    <?php echo esc_html__('Yt.','cardzone'); ?>
</a>
<?php endif;?>

<?php
    }

/**
 * [cardzone_header_menu description]
 * @return [type] [description]
 */
function cardzone_header_menu() {
    ?>
<?php
        wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => 'main-menu',
            'container'      => '',
            'fallback_cb'    => 'Cardzone_Navwalker_Class::fallback',
            'walker'         => new \TPCore\Widgets\Cardzone_Navwalker_Class,
        ] );
    ?>
<?php
}


/**
 * [cardzone_footer_menu description]
 * @return [type] [description]
 */
function cardzone_onepage_menu_01() {
    wp_nav_menu( [
        'theme_location' => 'onepage-menu-menu-01',
        'menu_class'     => 'tp-onepage-menu',
        'container'      => '',
        'fallback_cb'    => 'cardzone_Navwalker_Class::fallback',
        'walker'         =>  new \TPCore\Widgets\cardzone_Navwalker_Class,
    ] );
}


 /*
 * cardzone footer
 */
add_action( 'cardzone_footer_style', 'cardzone_check_footer', 10 );


function get_footer_style($style){
    if( $style == 'footer_2'  ) {
        get_template_part( 'template-parts/footer/footer-2' );
    }elseif ( $style == 'footer_3'  ) {
        get_template_part( 'template-parts/footer/footer-3' );
    }elseif ( $style == 'footer_4' ) {
        get_template_part( 'template-parts/footer/footer-4' );
    }else{
        get_template_part( 'template-parts/footer/footer-1');
    }
}

function cardzone_check_footer() {
    $tp_footer_tabs = function_exists('tpmeta_field')? tpmeta_field('cardzone_footer_tabs') : '';
    $cardzone_footer_style = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'cardzone_footer_style' ) : NULL;
    $footer_template = function_exists('tpmeta_field')? tpmeta_field('cardzone_footer_template') : false;

    $cardzone_footer_option_switch = get_theme_mod( 'cardzone_footer_elementor_switch', false );
    $elementor_footer_template = get_theme_mod( 'cardzone_footer_templates');
    $cardzone_default_footer_style = get_theme_mod( 'footer_layout', 'footer_1' );

    if($tp_footer_tabs == 'default'){
        if($cardzone_footer_option_switch){
            if($elementor_footer_template){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_template);
            }
        }else{ 
            if($cardzone_default_footer_style){
                get_footer_style($cardzone_default_footer_style);
            }else{
                get_template_part( 'template-parts/footer/footer-1' );
            }
        }
    }elseif($tp_footer_tabs == 'custom'){
        if ($cardzone_footer_style) {
            get_footer_style($cardzone_footer_style);
        }else{
            get_footer_style($cardzone_default_footer_style);
        }  
    }elseif($tp_footer_tabs == 'elementor'){
        if($footer_template){
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($footer_template);
        }else{
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_template);
        }

    }else{
        if($cardzone_footer_option_switch){

            if($elementor_footer_template){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_template);
            }else{
                get_template_part( 'template-parts/footer/footer-1' );
            }
        }else{
            get_footer_style($cardzone_default_footer_style);

        }
    }
}

// cardzone_copyright_text
function cardzone_copyright_text() {
   print get_theme_mod( 'footer_copyright', esc_html__( '© 2023 cardzone, All Rights Reserved. Design By Theme Pure', 'cardzone' ) );
}


/**
 *
 * pagination
 */
if ( !function_exists( 'cardzone_pagination' ) ) {

    function _cardzone_pagi_callback( $pagination ) {
        return $pagination;
    }

    //page navegation
    function cardzone_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if ( !$pages ) {
                $pages = 1;
            }

        }

        $pagination = [
            'base'      => add_query_arg( 'paged', '%#%' ),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }

        if ( !empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = ['s' => get_query_var( 's' )];
        }

        $pagi = '';
        if ( paginate_links( $pagination ) != '' ) {
            $paginations = paginate_links( $pagination );
            $pagi .= '<ul>';
            foreach ( $paginations as $key => $pg ) {
                $pagi .= '<li>' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _cardzone_pagi_callback( $pagi );
    }
}

// theme color
function cardzone_custom_color() {
    $cardzone_color_1 = get_theme_mod( 'cardzone_color_1', '#1A4DBE' );
    $cardzone_color_2 = get_theme_mod( 'cardzone_color_2', '#FF826B' );
    $cardzone_gra_color_1 = get_theme_mod( 'cardzone_gra_color_1', '#004D6E' );
    $cardzone_gra_color_2 = get_theme_mod( 'cardzone_gra_color_2', '#00ACCC' );
    $cardzone_body = get_theme_mod( 'cardzone_body', '#333F4D' );

    wp_enqueue_style( 'cardzone-custom', CARDZONE_THEME_CSS_DIR . 'cardzone-custom.css', [] );
    
    if ( !empty($cardzone_color_1 || $cardzone_color_2 || $cardzone_color_3 || $cardzone_color_4)) {
        $custom_css = '';
        $custom_css .= "html:root{
            --base: " . $cardzone_color_1 . ";
            --base2: " . $cardzone_color_2 . ";
            --tp-gradient-primary: linear-gradient(90deg, {$cardzone_gra_color_1} 0%,  {$cardzone_gra_color_2} 100%);
            --tp-text-1: " . $cardzone_body . ";
        }";

        wp_add_inline_style( 'cardzone-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'cardzone_custom_color' );


function cardzone_menu_custom_color()
{
    // Default Menu bg Color
    $color_code_menu_bg = get_theme_mod('header_menu_bg_color', '');
    $custom_menu_css_bg = '';
    if ($color_code_menu_bg != '') {
        $custom_menu_css_bg .= ".header-section{
            background-color: $color_code_menu_bg !important;
        }";
    }

    $color_code_menu = get_theme_mod('header_menu_color', '');
    $custom_menu_css = '';
    if ($color_code_menu != '') {
        $custom_menu_css .= ".main-menu>li>a{
            color: $color_code_menu !important;
        }";
    }

    $color_code_menu_hover = get_theme_mod('header_menu_hover_color', '');
    $custom_menu_css_hov = '';
    if ($color_code_menu_hover != '') {
        $custom_menu_css_hov .= "body .main-menu li>a:hover, body .main-menu li .sub-menu > li a:hover, body .navbar-nav .current-menu-ancestor>a, body .navbar-nav .current_page_item>a{
            color: $color_code_menu_hover !important;
        }";
    }

      // Default Menu hover Color
      $color_code_menu_drop_bg = get_theme_mod('header_menu_dropdown_bg_color', '');
      $custom_menu_css_drop_bg = '';
      if ($color_code_menu_drop_bg != '') {
          $custom_menu_css_drop_bg .= "body .main-menu li .sub-menu{
              background-color: $color_code_menu_drop_bg !important;
          }";
      }

       // Default Menu hover Color
    $color_menu_css_drop_hover = get_theme_mod('header_menu_dropdown_hover_color', '');
    $custom_menu_css_drop_hover = '';
    if ($color_menu_css_drop_hover != '') {
        $custom_menu_css_drop_hover .= "body .main-menu li .sub-menu li a {
             color: $color_menu_css_drop_hover !important;
         }";
    }

     // button box Bg
     $color_code_buttom = get_theme_mod('custom_menu_css_buttom', '');
     $custom_menu_css_buttom = '';
     if ($color_code_buttom != '') {
         $custom_menu_css_buttom .= ".menu__components .cmn--btn{
             background: $color_code_buttom !important;
         }";
     }

    // buttom box Color
    $color_code_buttom_color = get_theme_mod('custom_menu_css_buttom_color', '');
    $custom_menu_css_buttom_color = '';
    if ($color_code_buttom_color != '') {
        $custom_menu_css_buttom_color .= ".menu__components .cmn--btn {
            color: $color_code_buttom_color !important;
        }";
    }



    // Enqueue and add inline styles for menu Color
    wp_register_style('custom_menu_css_bg', false);
    wp_enqueue_style('custom_menu_css_bg', false);
    wp_add_inline_style('custom_menu_css_bg', $custom_menu_css_bg, true);

    // Enqueue and add inline styles for menu Color
    wp_register_style('custom_menu_css_color', false);
    wp_enqueue_style('custom_menu_css_color', false);
    wp_add_inline_style('custom_menu_css_color', $custom_menu_css, true);

    wp_register_style('custom_menu_css_color_hover', false);
    wp_enqueue_style('custom_menu_css_color_hover', false);
    wp_add_inline_style('custom_menu_css_color_hover', $custom_menu_css_hov, true);

      // Enqueue and add inline styles for menu Color
      wp_register_style('custom_menu_drop_css_bg', false);
      wp_enqueue_style('custom_menu_drop_css_bg', false);
      wp_add_inline_style('custom_menu_drop_css_bg', $custom_menu_css_drop_bg, true);

    // Enqueue and add inline styles for menu Color
    wp_register_style('custom_menu_css_drop_color_hover', false);
    wp_enqueue_style('custom_menu_css_drop_color_hover', false);
    wp_add_inline_style('custom_menu_css_drop_color_hover', $custom_menu_css_drop_hover, true);

    // Enqueue and add inline styles for button bg
    wp_register_style('header-menu-custom-button', false);
    wp_enqueue_style('header-menu-custom-button', false);
    wp_add_inline_style('header-menu-custom-button', $custom_menu_css_buttom, true);

    // Enqueue and add inline styles for button Color
    wp_register_style('header-menu-custom-button-color', false);
    wp_enqueue_style('header-menu-custom-button-color', false);
    wp_add_inline_style('header-menu-custom-button-color', $custom_menu_css_buttom_color, true);

   
}
add_action('wp_enqueue_scripts', 'cardzone_menu_custom_color');

// cardzone_kses_intermediate
function cardzone_kses_intermediate( $string = '' ) {
    return wp_kses( $string, cardzone_get_allowed_html_tags( 'intermediate' ) );
}

function cardzone_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function cardzone_kses($raw){

   $allowed_tags = array(
      'a'                         => array(
         'class'   => array(),
         'href'    => array(),
         'rel'  => array(),
         'title'   => array(),
         'target' => array(),
      ),
      'abbr'                      => array(
         'title' => array(),
      ),
      'b'                         => array(),
      'blockquote'                => array(
         'cite' => array(),
      ),
      'cite'                      => array(
         'title' => array(),
      ),
      'code'                      => array(),
      'del'                    => array(
         'datetime'   => array(),
         'title'      => array(),
      ),
      'dd'                     => array(),
      'div'                    => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'dl'                     => array(),
      'dt'                     => array(),
      'em'                     => array(),
      'h1'                     => array(),
      'h2'                     => array(),
      'h3'                     => array(),
      'h4'                     => array(),
      'h5'                     => array(),
      'h6'                     => array(),
      'i'                         => array(
         'class' => array(),
      ),
      'img'                    => array(
         'alt'  => array(),
         'class'   => array(),
         'height' => array(),
         'src'  => array(),
         'width'   => array(),
      ),
      'li'                     => array(
         'class' => array(),
      ),
      'ol'                     => array(
         'class' => array(),
      ),
      'p'                         => array(
         'class' => array(),
      ),
      'q'                         => array(
         'cite'    => array(),
         'title'   => array(),
      ),
      'span'                      => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'iframe'                 => array(
         'width'         => array(),
         'height'     => array(),
         'scrolling'     => array(),
         'frameborder'   => array(),
         'allow'         => array(),
         'src'        => array(),
      ),
      'strike'                 => array(),
      'br'                     => array(),
      'strong'                 => array(),
      'data-wow-duration'            => array(),
      'data-wow-delay'            => array(),
      'data-wallpaper-options'       => array(),
      'data-stellar-background-ratio'   => array(),
      'ul'                     => array(
         'class' => array(),
      ),
      'svg' => array(
           'class' => true,
           'aria-hidden' => true,
           'aria-labelledby' => true,
           'role' => true,
           'xmlns' => true,
           'width' => true,
           'height' => true,
           'viewbox' => true, // <= Must be lower case!
       ),
       'g'     => array( 'fill' => true ),
       'title' => array( 'title' => true ),
       'path'  => array( 'd' => true, 'fill' => true,  ),
      );

   if (function_exists('wp_kses')) { // WP is here
      $allowed = wp_kses($raw, $allowed_tags);
   } else {
      $allowed = $raw;
   }

   return $allowed;
}
// blog single social share
function cardzone_blog_social_share(){

    $cardzone_singleblog_social = get_theme_mod( 'cardzone_singleblog_social', false );
    $post_url = get_the_permalink();
    $end_class = has_tag() ? 'text-lg-end' : 'text-lg-start';

    if(!empty($cardzone_singleblog_social)) : ?>

<div class="col-lg-5 col-md-5">
    <div class="postbox__details-share tp-postbox-share-social text-md-end <?php echo esc_attr($end_class); ?>">
        <div class="pa-blog-details-social social social2 d-flex gap-3 flex-wrap align-items-center">
        <span><?php echo esc_html__('Share:', 'cardzone');?></span>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url);?>" target="_blank"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://twitter.com/share?url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fa-brands fa-twitter"></i></a>
            <a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fa-brands fa-pinterest-p"></i></a>
        </div>
    </div>
</div>
<?php endif ; 

}

// product single social share
function cardzone_product_social_share(){
    $post_url = get_the_permalink();
    ?>
<div class="rs-shop-details__social">
    <span><?php echo esc_html__('Share:', 'cardzone');?></span>
    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url);?>" target="_blank"><i
            class="fa-brands fa-linkedin-in"></i></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url);?>" target="_blank"><i
            class="fa-brands fa-facebook"></i></a>
    <a href="https://twitter.com/share?url=<?php echo esc_url($post_url);?>" target="_blank"><i
            class="fa-brands fa-twitter"></i></a>
    <a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url($post_url);?>" target="_blank"><i
            class="fa-brands fa-pinterest-p"></i></a>
</div>
<?php
}

// / This code filters the Archive widget to include the post count inside the link /
add_filter( 'get_archives_link', 'cardzone_archive_count_span' );
function cardzone_archive_count_span( $links ) {
    $links = str_replace('</a>&nbsp;(', '<span > (', $links);
    $links = str_replace(')', ')</span></a> ', $links);
    return $links;
}


// / This code filters the Category widget to include the post count inside the link /
add_filter('wp_list_categories', 'cardzone_cat_count_span');
function cardzone_cat_count_span($links) {
  $links = str_replace('</a> (', '<span> (', $links);
  $links = str_replace(')', ')</span></a>', $links);
  return $links;
}