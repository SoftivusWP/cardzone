<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cardzone
 */
?>

<article id="post-<?php the_ID();?>"
    <?php post_class( 'postbox__blockquote p-relative postbox_quote__item rs-postbox-item blog__content bgwhite mb-24 p-8 round16 format-quote mb-50' );?>>
    <div class="post__text">
        <?php the_content();?>
    </div>
</article>