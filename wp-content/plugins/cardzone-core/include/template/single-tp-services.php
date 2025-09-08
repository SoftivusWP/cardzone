<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  tpcore
 */
get_header();

$blog_column = is_active_sidebar( 'tp-services-sidebar' ) ? 'col-lg-8' : 'col-lg-12';

?>

<section class="card__details__section pt-120 pb-120 bgadd ralt">
    <div class="container">
        <div class="row">

        <div class="col-xl-8 col-lg-8">
            <div class="row g-4 justify-content-center">

            <?php 
               if( have_posts() ) : 
               while( have_posts() ) : 
               the_post();
            ?>

            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                  <div class="popular__items popular__v2 round16">
                     <div class="card__boxleft">
                        <img src="assets/img/cards/card4.png" alt="card" class="w-100 mb-24">
                        <span class="aplication ralt mb-15 d-block fz-14 fw-400 inter ptext2">1 Application – offer of 4 cards</span>
                        <div class="d-flex mb-16 fz-18 fw-400 inter ptext2 gap-1 align-items-center">
                           <i class="material-symbols-outlined ratting fz-24 mb-2">
                              star
                           </i>
                           4.5 (47 People Reviews)
                        </div>
                        <div class="d-flex flex-wrap gap-4 align-items-center">
                           <a href="compare-card.html" class="compare__btn d-flex align-items-center">
                              <i class="material-symbols-outlined round50 justify-content-center base d-flex align-items-center fs-16">
                                 compare_arrows
                              </i>
                              <span class="fz-14 fw-400 inter ">
                                 Compare
                              </span>
                           </a>
                           <a href="listing-details.html" class="compare__btn d-flex align-items-center">
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
                           <?php the_content(); ?>
                        </div>
                        <div class="bank__detals d-flex align-items-center ">
                           <ul class="bankd__wrap">
                              <li class="d-flex align-items-center justify-content-between">
                                 <span class="fz-14 fw-400 ptext2 inter">
                                    Max credit
                                 </span>
                                 <span class="fz-14 fw-400 inter title">
                                    $150,000
                                 </span>
                              </li>
                              <li class="d-flex align-items-center justify-content-between">
                                 <span class="fz-14 fw-400 ptext2 inter">
                                    Income
                                 </span>
                                 <span class="fz-14 fw-400 inter title">
                                    $120,000
                                 </span>
                              </li>
                              <li class="d-flex align-items-center justify-content-between">
                                 <span class="fz-14 fw-400 ptext2 inter">
                                    Interst-free
                                 </span>
                                 <span class="fz-14 fw-400 inter title">
                                   35 days
                                 </span>
                              </li>
                           </ul>
                           <ul class="bankd__wrap left__border">
                              <li class="d-flex align-items-center justify-content-between">
                                 <span class="fz-14 fw-400 ptext2 inter">
                                    Max credit
                                 </span>
                                 <span class="fz-14 fw-400 inter title">
                                    $150,000
                                 </span>
                              </li>
                              <li class="d-flex align-items-center justify-content-between">
                                 <span class="fz-14 fw-400 ptext2 inter">
                                    Income
                                 </span>
                                 <span class="fz-14 fw-400 inter title">
                                    $120,000
                                 </span>
                              </li>
                              <li class="d-flex align-items-center justify-content-between">
                                 <span class="fz-14 fw-400 ptext2 inter">
                                    Interst-free
                                 </span>
                                 <span class="fz-14 fw-400 inter title">
                                   35 days
                                 </span>
                              </li>
                           </ul>
                        </div>
                        <p class="card__info fz-16 inter ptext">
                           Credit cards are plastic or metal cards used to pay for items or services using credit.
                        </p>
                     </div>
                  </div>
               </div>



            <?php
               endwhile; 
               wp_reset_query();
               endif;
            ?>

</div>
               </div>

            <?php if ( is_active_sidebar( 'tp-services-sidebar' ) ): ?>
            <div class="col-lg-4">
                <div class="tp-service-widget">
                    <?php dynamic_sidebar( 'tp-services-sidebar' ); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer();  ?>




