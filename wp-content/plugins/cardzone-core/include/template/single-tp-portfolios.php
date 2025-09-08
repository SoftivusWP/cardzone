<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  tpcore
 */
get_header();

?>

<section class="card__details__section pt-120 pb-120 bgadd ralt">
      <div class="container">
         <div class="row">
            <div class="col-12">
                  <?php
                  
                  if( have_posts() ):
                  while( have_posts() ): the_post(); ?>

                  <?php the_content(); ?>
                  
                  <?php
                  endwhile; wp_reset_query();
                  endif;
                  ?>
            </div>
         </div>
      </div>
</section>

<?php get_footer();  ?>
