 <?php
/**
 * Template part for displaying posts
 *
 * @link htrss://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cardzone
 */
$categories = get_the_terms( $post->ID, 'category' );
$cardzone_blog_cat = get_theme_mod( 'cardzone_blog_cat', false );
$cardzone_singleblog_social = get_theme_mod( 'cardzone_singleblog_social', false );
  
 $social_shear_col= $cardzone_singleblog_social ? "col-xl-6 col-lg-6 col-md-6" : "col-xl-12 col-md-12 col-lg-12";

if ( is_single() ) : ?>

 <article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item balance__transfercard p-8 bgwhite mb-40 round16 rs-postbox-item-wrapper mb-80 format-image' );?>>
     <?php if ( has_post_thumbnail() ): ?>
        <div class="rs-postbox-item-thumb p-relative bt__one">
            <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
        </div>
        <?php endif; ?>

        <div class="balance__transferbody">
            <!-- blog meta -->
            <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>
            <h3 class="rs-postbox-title2 details-title title mb-24"><?php the_title();?></h3>

            <div class="blog-details-content">
                <?php the_content();?>
            </div>

        </div>
        

     <?php
            wp_link_pages( [
                'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'cardzone' ),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ] );
        ?>
    <?php if(has_tag()) : ?>

        <div class="balance__transferbody">
            <div class="rs-postbox-share-wrapper balance__cardfooter gap-4 flex-wrap  d-flex align-items-center justify-content-between"> 
                <div class="<?php echo esc_attr($social_shear_col); ?>">
                    <?php echo cardzone_get_tag(); ?>
                </div>
                <?php cardzone_blog_social_share() ?>
            </div>
        </div>

     <?php endif; ?>
 </article>

 <?php else: ?>

 <article id="post-<?php the_ID();?>" <?php post_class( 'rs-postbox-item mb-50 bgwhite mb-24 p-8 round16 format-standard' );?>>
     <?php if ( has_post_thumbnail() ): ?>
     <div class="rs-postbox-thumb bt__one mb-20 p-relative">
         <a href="<?php the_permalink();?>">
             <?php the_post_thumbnail( 'full', ['class' => 'img-responsive img-responsive wp-post-image'] );?>
         </a>
     </div>
     <?php endif; ?>
     <div class="rs-postbox-content blog__content">

         <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>
         <h3 class="rs-postbox-title title mb-24">
             <a class="title" href="<?php the_permalink();?>"><?php the_title();?></a>
         </h3>
         <div class="rs-postbox-text fz-18 fw-400 mb-40 ptext2 inter">
             <?php the_excerpt();?>
         </div>
         <!-- blog btn -->
         <?php get_template_part( 'template-parts/blog/blog-btn' ); ?>
     </div>
 </article>

 <?php endif;?>