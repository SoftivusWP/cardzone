<?php
/* Template Name: Results Page */

get_header();

// Get filter values from URL parameters
$credit_score = isset($_GET['credit_score']) ? sanitize_text_field($_GET['credit_score']) : '';
$card_type = isset($_GET['card_type']) ? sanitize_text_field($_GET['card_type']) : '';

// Prepare arguments for WP_Query
$args = array(
    'post_type' => 'listing-card',
    'posts_per_page' => 10,
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
    'meta_query' => array('relation' => 'AND'),
);

// Add meta queries based on filter values
if ($credit_score) {
    $args['meta_query'][] = array(
        'key' => 'credit_score',
        'value' => $credit_score,
        'compare' => '=',
    );
}

if ($card_type) {
    $args['meta_query'][] = array(
        'key' => 'card_type',
        'value' => $card_type,
        'compare' => '=',
    );
}

// Execute WP_Query
$query = new WP_Query($args);
?>

<section class="card__details__section card-listing-archive ralt pt-120 pb-120 ddd">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="row g-4 justify-content-center">
                    <?php if ($query->have_posts()) :
                        while ($query->have_posts()) :
                            $query->the_post();
                            $contact_url = function_exists('get_field') ? get_field('contact_url') : '';
                            $loan_card_list = function_exists('get_field') ? get_field('loan_card_list') : '';
                            $loan_rating = get_field('loan_rating');
                            $terms = get_the_terms(get_the_ID(), 'cards-cat');
                            ?>

                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                                <div class="popular__items popular__v2 round16">
                                    <div class="card__boxleft">
                                        <?php the_post_thumbnail(); ?>

                                        <?php if (!empty(get_field('cta_title'))) : ?>

                                            <span class="aplication ralt mb-15 d-block fz-14 fw-400 inter ptext2"><?php echo wp_kses_post(get_field('cta_title')); ?></span>

                                        <?php endif; ?>

                                        <?php if (!empty(get_field('rating_title'))) : ?>
                                            <div class="d-flex mb-16 fz-18 fw-400 inter ptext2 gap-1 align-items-center">
                                                <i class="material-symbols-outlined ratting fz-24 mb-2">star</i>
                                                <?php echo wp_kses_post(get_field('rating_title')); ?>
                                            </div>
                                        <?php endif; ?>


                                    </div>
                                    <div class="card__boxright">
                                        <div class="d-flex mb-30 justify-content-between align-items-center justify-content-between flex-wrap gap-3">
                                            <a href="<?php the_permalink() ?>">
                                                <h3 class="title mb-16"><?php the_title(); ?></h3>
                                            </a>

                                            <?php if (!empty(get_field('apply_button_text'))) : ?>
                                                <a href="<?php echo esc_url(get_field('apply_btn_url')); ?>" class="cmn--btn">
                                                    <span><?php echo esc_html(get_field('apply_button_text')); ?></span>
                                                </a>
                                            <?php endif; ?>

                                        </div>

                                        <div class="d-flex card__btngrp align-items-center">
                                            <?php foreach ($terms as $term) : ?>
                                                <a href="<?php echo esc_url(get_term_link($term)); ?>" class="ctband__item d-flex align-items-center gap-1">
                                                    <i class="material-symbols-outlined base fz-18">sell</i>
                                                    <span class="fz-14 fw-500 inter base"><?php echo esc_html($term->name); ?></span>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>

                                        <div class="bank__detals d-flex align-items-center">
                                            <?php if (!empty(get_field('card_info_repeater_left'))) : ?>
                                                <ul class="bankd__wrap">
                                                    <?php if (have_rows('card_info_repeater_left')) : ?>
                                                        <?php while (have_rows('card_info_repeater_left')) : the_row(); ?>
                                                            <li class="d-flex align-items-center justify-content-between">
                                                                <span class="fz-14 fw-400 ptext2 inter"><?php the_sub_field('title'); ?></span>
                                                                <span class="fz-14 fw-400 inter title"><?php the_sub_field('value'); ?></span>
                                                            </li>
                                                        <?php endwhile ?>
                                                    <?php endif; ?>
                                                </ul>
                                            <?php endif; ?>
                                            <?php if (!empty(get_field('card_info_repeater_right'))) : ?>
                                                <ul class="bankd__wrap left__border">
                                                    <?php if (have_rows('card_info_repeater_right')) : ?>
                                                        <?php while (have_rows('card_info_repeater_right')) : the_row(); ?>
                                                            <li class="d-flex align-items-center justify-content-between">
                                                                <span class="fz-14 fw-400 ptext2 inter"><?php the_sub_field('title'); ?></span>
                                                                <span class="fz-14 fw-400 inter title"><?php the_sub_field('value'); ?></span>
                                                            </li>
                                                        <?php endwhile ?>
                                                    <?php endif; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>

                                        <?php if (!empty(get_field('card_short_description'))) : ?>
                                            <p class="card__info fz-16 inter ptext"><?php echo wp_kses_post(get_field('card_short_description')); ?></p>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                    <?php
                        endwhile;
                    else :
                        echo '<h2 class="cardnoresult">No results found.</h2>';
                    endif;

                    // Pagination
                    if ($query->max_num_pages > 1) {
                        echo '<nav aria-label="Page navigation" class="nav_pagination wow fadeInUp">';
                        echo '<ul class="pagination">';

                        // Previous page link
                        if (get_previous_posts_link()) {
                            echo '<li class="page-item">';
                            previous_posts_link('<i class="material-symbols-outlined">chevron_left</i>');
                            echo '</li>';
                        }

                        // Pagination numbers
                        $current_page = max(1, get_query_var('paged'));
                        $total_pages = $query->max_num_pages;
                        $range = 2; // Number of links to show before and after the current page
                        $show_items = ($range * 2) + 1;

                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($total_pages != 1 && $total_pages >= $show_items && abs($current_page - $i) <= $range) {
                                echo '<li class="page-item">';
                                echo '<a class="page-link' . ($current_page === $i ? ' active' : '') . '" href="' . esc_url(get_pagenum_link($i)) . '">' . $i . '</a>';
                                echo '</li>';
                            } elseif ($total_pages < $show_items) {
                                echo '<li class="page-item">';
                                echo '<a class="page-link' . ($current_page === $i ? ' active' : '') . '" href="' . esc_url(get_pagenum_link($i)) . '">' . $i . '</a>';
                                echo '</li>';
                            } elseif ($i === 1 || $i === $total_pages) {
                                echo '<li class="page-item">';
                                echo '<a class="page-link' . ($current_page === $i ? ' active' : '') . '" href="' . esc_url(get_pagenum_link($i)) . '">' . $i . '</a>';
                                echo '</li>';
                            } elseif ($total_pages != 1 && $total_pages > $show_items && abs($current_page - $i) <= $range) {
                                if ($i === $current_page - $range - 1 || $i === $current_page + $range + 1) {
                                    echo '<li class="page-item three_dots_box">';
                                    echo '<a class="page-link three-dots" href="#">...</a>';
                                    echo '</li>';
                                }
                            }
                        }

                        // Next page link
                        if (get_next_posts_link()) {
                            echo '<li class="page-item">';
                            next_posts_link('<i class="material-symbols-outlined">chevron_right</i>');
                            echo '</li>';
                        }

                        echo '</ul>';
                        echo '</nav>';
                    }

                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>