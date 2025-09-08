<?php

/**
 * Template part for displaying post btn
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cardzone
 */

$cardzone_blog_btn = get_theme_mod( 'cardzone_blog_btn', 'Read More' );
$cardzone_blog_btn_switch = get_theme_mod( 'cardzone_blog_btn_switch', true );

?>
<?php if ( !empty( $cardzone_blog_btn_switch ) ): ?>

    <a href="<?php the_permalink(); ?>" class="cmn--btn blog-btn d-flex align-items-center gap-2 outline__btn">
        <span>
        <?php print esc_html( $cardzone_blog_btn );?>
        </span>
        <span class="mt-1">
        <i class="material-symbols-outlined">
            arrow_right_alt
        </i>
        </span>
    </a>
<?php endif;?>