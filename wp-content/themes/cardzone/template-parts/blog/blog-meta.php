<?php 

/**
 * Template part for displaying post meta
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cardzone
 */

$categories = get_the_terms( $post->ID, 'category' );
$cardzone_blog_date = get_theme_mod( 'cardzone_blog_date', true );
$cardzone_blog_comments = get_theme_mod( 'cardzone_blog_comments', true );
$cardzone_blog_author = get_theme_mod( 'cardzone_blog_author', true );
$cardzone_blog_cat = get_theme_mod( 'cardzone_blog_cat', false );

?>

<div class="rs-postbox-meta blog__addmin flex-wrap mb-24 d-flex align-items-center">
    <?php if ( !empty($cardzone_blog_author) ): ?>
        <span>
            <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>" class="fz-18 text-capitalize ralt fw-400 inter ptext2 d-flex align-items-center gap-2">
                <i class="material-symbols-outlined ptext2">
                    account_circle
                </i>
            <?php echo esc_html__("By", "cardzone"); ?> <?php print get_the_author();?>
            </a>
        </span> 
    <?php endif; ?>

    <?php if ( !empty($cardzone_blog_cat) ): ?>
        <span class="fz-18 ralt fw-400 inter ptext2 d-flex align-items-center gap-2">
            <a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>" class="fz-18 ralt fw-400 inter ptext2 d-flex align-items-center gap-2">
                <i class="fa-regular fa-folder-open"></i>
                <?php echo esc_html($categories[0]->name); ?>
            </a>
        </span>
    <?php endif; ?>
   
    <?php if ( !empty($cardzone_blog_date) ): ?>
        <span class="fz-18 ralt fw-400 inter ptext2 d-flex align-items-center gap-2">
            <i class="material-symbols-outlined ptext2">
                calendar_month
            </i>
            <?php the_time( get_option('date_format') ); ?>
        </span>
    <?php endif; ?>
   
    <?php if ( !empty($cardzone_blog_comments) ): ?>
        <span>
            <a href="<?php comments_link();?>" class="fz-18 ralt fw-400 inter ptext2 d-flex align-items-center gap-2">
                <i class="material-symbols-outlined ptext2">
                    chat
                </i>
                <?php comments_number();?>
            </a>
        </span>
    <?php endif; ?>
</div>