<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  tpcore
 */
get_header();

$blog_column = is_active_sidebar( 'card-listing-sidebar' ) ? 'col-xl-8 col-lg-8' : 'col-xl-12 col-lg-12';

$terms = get_the_terms(get_the_ID(), 'cards-cat');
?>

<section class="card-details">
   <div class="container">
      <div class="row">
         <?php
         if (have_posts()) :
               while (have_posts()) : the_post();
         ?>
                  <?php the_content() ?>
         <?php
               endwhile;
               wp_reset_query();
         endif;
         ?>
      </div>
   </div>
</section>


<?php get_footer();  ?>




