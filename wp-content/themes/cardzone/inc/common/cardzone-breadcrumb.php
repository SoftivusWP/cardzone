<?php

/**
 * Breadcrumbs for cardzone theme.
 *
 * @package     cardzone
 * @author      Theme_Pure
 * @copyright   Copyright (c) 2022, Theme_Pure
 * @link        https://themeforest.net/user/pixelaxis
 * @since       cardzone 1.0.0
 */



function cardzone_breadcrumb_func()
{
    global $post;
    $breadcrumb_class = '';
    $breadcrumb_show = 1;

    if (is_front_page() && is_home()) {
        $title = get_theme_mod('breadcrumb_blog_title', esc_html__('Blog', 'cardzone'));
        $breadcrumb_class = 'home_front_page';
    } elseif (is_front_page()) {
        $title = get_theme_mod('breadcrumb_blog_title', esc_html__('Blog', 'cardzone'));
        $breadcrumb_show = 0;
    } elseif (is_home()) {
        if (get_option('page_for_posts')) {
            $title = get_the_title(get_option('page_for_posts'));
        }
    } elseif (is_single() && 'post' == get_post_type()) {
        $title = get_the_title();
    } elseif (is_single() && 'product' == get_post_type()) {
        $title = get_theme_mod('breadcrumb_product_details', esc_html__('Shop', 'cardzone'));
    } elseif (is_single() && 'courses' == get_post_type()) {
        $title = esc_html__('Course Details', 'cardzone');
    } elseif (is_search()) {
        $title = esc_html__('Search Results for : ', 'cardzone') . get_search_query();
    } elseif (is_404()) {
        $title = esc_html__('Page not Found', 'cardzone');
    } elseif (is_archive()) {
        $title = get_the_archive_title();
    } else {
        $title = get_the_title();
    }



    $_id = get_the_ID();

    if (is_single() && 'product' == get_post_type()) {
        $_id = $post->ID;
    } elseif (function_exists("is_shop") and is_shop()) {
        $_id = wc_get_page_id('shop');
    } elseif (is_home() && get_option('page_for_posts')) {
        $_id = get_option('page_for_posts');
    }

    //Breadcrumb main id
    $breadcrumb_shape_switch = get_theme_mod('breadcrumb_shape_switch', 'on');

    $breadcrumb_bg_color = get_theme_mod('breadcrumb_bg_color', '#0d3f84');
    $breadcrumb_image = get_theme_mod('breadcrumb_image');

    $cardzone_breadcrumb_bg = function_exists('tpmeta_image_field') ? tpmeta_image_field('cardzone_breadcrumb_bg') : '';

    $breadImg = $cardzone_breadcrumb_bg ? $cardzone_breadcrumb_bg['url'] : $breadcrumb_image;

    $breadImgFinl = $breadImg ? "background-image:url({$breadImg});" : "background-color:{$breadcrumb_bg_color};";

    $is_breadcrumb = function_exists('tpmeta_field') ? tpmeta_field('cardzone_check_bredcrumb') : 'off';



    $breadImg = $cardzone_breadcrumb_bg ? $cardzone_breadcrumb_bg['url'] : $breadcrumb_image;
    $breadImgFinl = $breadImg ? "background-image:url({$breadImg});" : "background-color:{$breadcrumb_bg_color};";
    $breadcrumb_shape_img = get_theme_mod('breadcrumb_shape_image');



    $is_breadcrumb = function_exists('tpmeta_field') ? tpmeta_field('cardzone_check_bredcrumb') : 'on';

    $con1 = $is_breadcrumb && ($is_breadcrumb == 'on') && $breadcrumb_show == 1;

    $con_main = is_404() ? is_404() : $con1;

    if ($con_main) {
        $bg_img_from_page = function_exists('tpmeta_image_field') ? tpmeta_image_field('cardzone_breadcrumb_bg') : '';

        $hide_bg_img = function_exists('tpmeta_field') ? tpmeta_field('cardzone_check_bredcrumb_img') : 'on';
        // get_theme_mod

        $breadcrumb_padding = get_theme_mod('breadcrumb_padding');
        $breadcrumb_bg_color = get_theme_mod('breadcrumb_bg_color', '#112f75');
        $breadcrumb_shape_switch = get_theme_mod('breadcrumb_shape_switch', 'on');
        $cardzone_breadcrumb_shape = function_exists('tpmeta_image_field') ? tpmeta_image_field('cardzone_breadcrumb_shape') : '';

        ?>

        <?php if ($breadcrumb_shape_img or $cardzone_breadcrumb_shape) : ?>

            <section class="banner__breadcumn overhid ralt" style="<?php echo esc_attr($breadImgFinl); ?>">
                <div class="breadcumnd__wrapper">
                    <div class="container">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-8">
                                <div class="breadcumnd__content">
                                    <span class="d4 mb-24">
                                        <?php echo cardzone_kses($title); ?>
                                    </span>

                                    <?php if (function_exists('bcn_display')) : ?>
                                        <ul class="breadcun__list flex-wrap gap-1 d-flex align-items-center">
                                            <?php bcn_display(); ?>
                                        </ul>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                <?php if (!empty($breadcrumb_shape_img)) : ?>
                                    <?php
                                                    $cardzone_breadcrumb_shape = function_exists('tpmeta_image_field') ? tpmeta_image_field('cardzone_breadcrumb_shape') : '';
                                                    ?>
                                    <div class="featured__card">
                                        <?php if ($cardzone_breadcrumb_shape) : ?>
                                            <img src="<?php echo esc_url($cardzone_breadcrumb_shape['url']); ?>" class="w-100" alt="img">
                                        <?php else : ?>
                                            <img src="<?php echo esc_url($breadcrumb_shape_img); ?>" class="w-100" alt="img">
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (!empty($breadcrumb_shape_switch)) : ?>
                    <!--element-->
                    <div class="element1">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/banner/chok1.png'); ?>" alt="<?php echo esc_attr__('element', 'cardzone'); ?>">
                    </div>

                    <div class="element2">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/banner/chok2.png'); ?>" alt="<?php echo esc_attr__('element', 'cardzone'); ?>">
                    </div>

                    <div class="element3">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/banner/chok4.png'); ?>" alt="<?php echo esc_attr__('element', 'cardzone'); ?>">
                    </div>

                    <div class="element4">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/banner/chok3.png'); ?>" alt="<?php echo esc_attr__('element', 'cardzone'); ?>">
                    </div>

                    <div class="element5">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/banner/chok4.png'); ?>" alt="<?php echo esc_attr__('element', 'cardzone'); ?>">
                    </div>

                    <!--element-->
                <?php endif; ?>
            </section>

        <?php else : ?>


            <section class="banner__breadcumn overhid ralt breadcrumb-gap" style="<?php echo esc_attr($breadImgFinl); ?>">
            <div class="breadcumnd__wrapper">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-8">
                            <div class="breadcumnd__content">
                                <span class="d4 mb-24">
                                    <?php echo cardzone_kses($title); ?>
                                </span>

                                <?php if (function_exists('bcn_display')) : ?>
                                    <ul class="breadcun__list flex-wrap gap-1 d-flex align-items-center">
                                        <?php bcn_display(); ?>
                                    </ul>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                            <?php if (!empty($breadcrumb_shape_img)) : ?>
                                <?php
                                            $cardzone_breadcrumb_shape = function_exists('tpmeta_image_field') ? tpmeta_image_field('cardzone_breadcrumb_shape') : '';
                                            ?>
                                <div class="featured__card">
                                    <?php if ($cardzone_breadcrumb_shape) : ?>
                                        <img src="<?php echo esc_url($cardzone_breadcrumb_shape['url']); ?>" class="w-100" alt="img">
                                    <?php else : ?>
                                        <img src="<?php echo esc_url($breadcrumb_shape_img); ?>" class="w-100" alt="img">
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (!empty($breadcrumb_shape_switch)) : ?>
                <!--element-->
                <div class="element1">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/banner/chok1.png'); ?>" alt="<?php echo esc_attr__('element', 'cardzone'); ?>">
                </div>

                <div class="element2">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/banner/chok2.png'); ?>" alt="<?php echo esc_attr__('element', 'cardzone'); ?>">
                </div>

                <div class="element3">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/banner/chok4.png'); ?>" alt="<?php echo esc_attr__('element', 'cardzone'); ?>">
                </div>

                <div class="element4">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/banner/chok3.png'); ?>" alt="<?php echo esc_attr__('element', 'cardzone'); ?>">
                </div>

                <div class="element5">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/banner/chok4.png'); ?>" alt="<?php echo esc_attr__('element', 'cardzone'); ?>">
                </div>

                <!--element-->
            <?php endif; ?>
        </section>


        <?php endif ?>

 


    

    <?php
        }
    }

    add_action('cardzone_before_main_content', 'cardzone_breadcrumb_func');

    // cardzone_search_form
    function cardzone_search_form()
    {
        ?>

    <!--Search Popup-->
    <div id="searchPopup" class="search__popup">
        <form method="get" action="<?php print esc_url(home_url('/')); ?>" class="popup-content d-flex align-items-center">
            <input type="text" name="s" value="<?php print esc_attr(get_search_query()) ?>" placeholder="<?php echo esc_attr__("Search Here", "cardzone"); ?>">
            <button id="closeButton">
                <i class="material-symbols-outlined">
                    close
                </i>
            </button>
        </form>
    </div>
    <!--Search Popup-->


<?php
}
add_action('cardzone_before_main_content', 'cardzone_search_form');
