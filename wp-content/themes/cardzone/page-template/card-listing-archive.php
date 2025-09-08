
<?php
/**
* Template Name: Card Listing Archive
*
*/

get_header();

$args = array(
   'post_type' => 'listing-card',
   'posts_per_page' => -1,
   'order'          => 'DESC',
   'tax_query' => array(
       array(
           'taxonomy' => 'cards-cat',
           'field'    => 'slug',
           'terms'    => array('post-format-quote'),
           'operator' => 'NOT IN'
       )
   )
);

$loop = new \WP_Query($args);

$blog_column = is_active_sidebar( 'card-listing-sidebar' ) ? 'col-xl-8 col-lg-8' : 'col-xl-12 col-lg-12';

?>


<section class="card__details__section card-archive pt-120 pb-120 bgadd ralt">
   <div class="container">
      <div class="row g-4">

         <?php if ( is_active_sidebar( 'card-listing-sidebar' ) ): ?>
            <div class="col-xl-4 col-lg-4">
               <div class="card__sidebar">
                  <div class="card__common__item bgwhite round16 mb-24">
                     <?php dynamic_sidebar( 'card-listing-sidebar' ); ?>
                  </div>
               </div>
            </div>
         <?php endif; ?>
         
         <div class="<?php print esc_attr( $blog_column );?>">
            <div class="row g-4 justify-content-center">
               
            <?php if ($loop->have_posts()) : ?>
            <?php while ($loop->have_posts()) : $loop->the_post(); ?>
               
               <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                  <div class="popular__items popular__v2 round16">
                     <div class="card__boxleft">
                        
                     <div class="main-thumb">
                        <?php the_post_thumbnail(); ?>
                     </div>

                     <?php if( !empty( get_field('cta_title') ) ): ?>
                        <span class="aplication ralt mb-15 d-block fz-14 fw-400 inter ptext2"> <?php echo wp_kses_post( get_field('cta_title') ); ?> </span>
                     <?php endif; ?>


                     <?php if( !empty( get_field('rating_title') ) ): ?>
                        <div class="d-flex mb-16 fz-18 fw-400 inter ptext2 gap-1 align-items-center">
                           <i class="material-symbols-outlined ratting fz-24 mb-2">
                              star
                           </i>
                           <?php echo wp_kses_post( get_field('rating_title') ); ?>
                        </div>
                     <?php endif; ?>

                        <div class="d-flex flex-wrap gap-4 align-items-center">
                           <a href="compare-card.html" class="compare__btn d-flex align-items-center">
                              <i class="material-symbols-outlined round50 justify-content-center base d-flex align-items-center fs-16">
                                 compare_arrows
                              </i>
                              <span class="fz-14 fw-400 inter ">
                                 Compare
                              </span>
                           </a>
                           <a href="<?php the_permalink(); ?>" class="compare__btn d-flex align-items-center">
                              <i class="material-symbols-outlined round50 justify-content-center base d-flex align-items-center fs-16">
                                 arrow_right_alt
                              </i>
                              <span class="fz-14 fw-400 inter ">
                                 Details
                              </span>
                           </a>
                        </div>
                     </div>
                     <div class="card__boxright">
                        <div class="d-flex mb-30 align-items-center justify-content-between flex-wrap gap-3">
                           <h3 class="title mb-16">
                              <?php the_title(); ?>
                           </h3>
                           <a href="<?php the_permalink(); ?>" class="cmn--btn">
                              <span>
                                 Apply Now
                              </span>
                           </a>
                        </div>
                        <div class="d-flex card__btngrp align-items-center">

                        <?php
                           // Get terms from the custom taxonomy 'cards-cat'
                           $terms = get_terms(array(
                              'post_type' => 'listing-card',
                              'taxonomy' => 'cards-cat',
                              'hide_empty' => false,
                           ));

                           // Check if terms are not empty
                           if (!empty($terms) && !is_wp_error($terms)) {
                              foreach ($terms as $term) {
                                 // Get the term link
                                 $term_link = get_term_link($term);
                                 // Get the term name
                                 $term_name = $term->name;
                                 ?>
                                 <a href="<?php echo esc_url($term_link); ?>" class="ctband__item d-flex align-items-center gap-1">
                                       <i class="material-symbols-outlined base fz-18">
                                          sell
                                       </i>
                                       <span class="fz-14 fw-500 inter base">
                                          <?php echo esc_html($term_name); ?>
                                       </span>
                                 </a>
                                 <?php
                              }
                           }
                        ?>

                        </div>
                        <div class="bank__detals d-flex align-items-center ">

                       
                           <?php if( !empty( get_field('card_info_repeater_left') ) ): ?>
                              <ul class="bankd__wrap">
                                 <?php if (have_rows('card_info_repeater_left')) : ?>
                                    <?php while (have_rows('card_info_repeater_left')) : the_row(); ?>
                                       <li class="d-flex align-items-center justify-content-between">
                                          <span class="fz-14 fw-400 ptext2 inter">
                                             <?php acf_esc_html(the_sub_field('title')); ?>
                                          </span>
                                          <span class="fz-14 fw-400 inter title">
                                             <?php acf_esc_html(the_sub_field('value')); ?>
                                          </span>
                                       </li>
                                    <?php endwhile ?>
                                 <?php endif; ?>
                              </ul>
                           <?php endif; ?>


                           <?php if( !empty( get_field('card_info_repeater_left') ) ): ?>
                              <ul class="bankd__wrap left__border">
                                 <?php if (have_rows('card_info_repeater__right')) : ?>
                                    <?php while (have_rows('card_info_repeater__right')) : the_row(); ?>
                                       <li class="d-flex align-items-center justify-content-between">
                                          <span class="fz-14 fw-400 ptext2 inter">
                                             <?php acf_esc_html(the_sub_field('title')); ?>
                                          </span>
                                          <span class="fz-14 fw-400 inter title">
                                             <?php acf_esc_html(the_sub_field('value')); ?>
                                          </span>
                                       </li>
                                    <?php endwhile ?>
                                 <?php endif; ?>
                              </ul>
                           <?php endif; ?>
                           
                        </div>

                        <?php if( !empty( get_field('card_short_description') ) ): ?>
                           <p class="card__info fz-16 inter ptext">
                              <?php echo wp_kses_post ( get_field('card_short_description') ); ?>
                           </p>
                        <?php endif; ?>

                     </div>
                  </div>
               </div>

               <?php endwhile; ?>
               <?php
            
            endif; ?>


            </div>
            <ul class="pagination justify-content-center mt-40">
               <li>
                  <a href="#0">
                     <i class="material-symbols-outlined">
                        chevron_left
                     </i>
                  </a>
               </li>
               <li>
                  <a href="#0">
                     1
                  </a>
               </li>
               <li>
                  <a href="#0">
                     2
                  </a>
               </li>
               <li>
                  <a href="#0">
                     3
                  </a>
               </li>
               <li>
                  <a href="#0">
                     ...
                  </a>
               </li>
               <li>
                  <a href="#0">
                     <i class="material-symbols-outlined">
                        chevron_right
                     </i>
                  </a>
               </li>
            </ul>
         </div>

      </div>
   </div>
</section>


<?php get_footer();  ?>
