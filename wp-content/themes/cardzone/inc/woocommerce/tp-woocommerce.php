<?php


remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
remove_action('woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
// remove_action('woocommerce_before_main_content', 'WC_Structured_Data::generate_website_data()', 30);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);


remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

//remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);


//single hook remove
remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_sharing',50);

remove_action('woocommerce_after_single_product_summary','woocommerce_output_related_products',20);

remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash',10);
remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_images',20);

add_filter( 'woocommerce_product_tabs', 'remove_product_description_tab', 99 );

function remove_product_description_tab( $tabs ) {
    unset( $tabs['description'] ); // Remove the description tab
    return $tabs;
}


//Shop page product grid
if( !function_exists('tp_woo_product_grid') ) {

    function tp_woo_product_grid() {
        global $product;
        global $post;
        global $woocommerce;

        ?>

            <div class="gift__card__item shadow6 round16 overhid bgwhite p-8">
                <a href="<?php the_permalink(); ?>" class="thumb product-thumb">
                    <?php the_post_thumbnail(); ?>
                </a>
                <div class="addto-card-btn">
                    <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" 
                        data-quantity="<?php echo esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ); ?>" 
                        class="button product_type_<?php echo esc_attr( $product->get_type() ); ?> add_to_cart_button ajax_add_to_cart" 
                        data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" 
                        data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>" 
                        aria-label="<?php echo esc_attr( $product->add_to_cart_description() ); ?>" 
                        rel="nofollow">
                        <i class="material-symbols-outlined">shopping_cart</i>
                    </a>
                </div>
                <div class="content p-24">
                    <a href="<?php the_permalink(); ?>">
                        <h5 class="title mb-16">
                            <?php the_title(); ?>
                        </h5>
                    </a>
                    <div class="price d-flex mb-16 flex-wrap gap-2 align-items-center justify-content-between">
                    <span class="d-flex align-items-center gap-2">
                        <?php woocommerce_template_loop_price(); ?>
                        
                        <!-- <span class="ptext2 fw-400 inter">
                            25% OFF
                        </span> -->
                    </span>
                    <span class="fz-18 fw-400 ptext2 inter d-flex align-items-center gap-2">

                    <?php 
                    
                    global $product;

                    ?>
                    <i class="material-symbols-outlined ratting">
                                 star
                              </i>
                        <?php
                        // Get average rating and count
                        $average_rating = $product->get_average_rating();
                        // $rating_count = $product->get_rating_count();

                        // Format average rating to one decimal place
                        $formatted_average_rating = number_format($average_rating, 1);

                        // Display the rating
                        echo '<span class="woocommerce-product-rating">';
                        echo '<span class="star-rating" title="Rated ' . $formatted_average_rating . '">';
                        echo '<span style="width: ' . ( ( $formatted_average_rating / 5 ) * 100 ) . '%;">';
                        echo '<strong itemprop="ratingValue">' . $formatted_average_rating . '</strong> ';
                        echo '</span>';
                        echo '</span>';
                        echo '</span>';
                                            
                            ?>
      
                                    </span>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="d-flex align-items-center gap-2 base fz-16 fw-600 inter">
                                    <?php echo esc_html__("Details", "cardzone"); ?>
                                    <i class="material-symbols-outlined base">
                                        arrow_right_alt
                                    </i>
                                    </a>
                                </div>
                            </div>
                                        
                                
                                <?php
                            }

                    }


add_action('woocommerce_before_shop_loop_item', 'tp_woo_product_grid', 10);


//Product Details single page
function cardzone_product_details() {

    global $product;
    global $post;
    global $woocommerce;

    ?>
        <div class="card__sidebar">
            <div class="card__common__item bgwhite round16">
                <span class="fz-18 fw-500 mb-10 d-block inter title">
                    <?php echo esc_html__("Price", "cardzone"); ?>
                </span>
                <div class="d-flex gap-3 mb-40 align-items-center">
                    <i class="material-symbols-outlined title">
                    sell
                    </i>
                    <span class="fz-16 fw-400 title inter">
                        <?php echo esc_html__("From", "cardzone"); ?>
                    </span>
                    <h3 class="title fw-600 d-flex align-items-start gap-2">
                    <?php woocommerce_template_single_price(); ?>
                    </h3>
                </div>

                <div class="purchase__quantity d-flex align-items-center justify-content-between">
                    <?php woocommerce_template_single_add_to_cart(); ?>
                </div>

                <div class="tborderdash mt-30 mb-40 pt-16">
                    <div class="d-flex align-items-center mb-16 justify-content-between">
                    <span class="fz-16 fw-400 inter ptext2">
                        <?php echo esc_html__("Base Price", "cardzone"); ?>
                    </span>
                    <span class="fz-16 fw-500 inter title base-price">
                        <?php
                          global $product;
                          // Get the product price excluding taxes
                          $total_price = wc_get_price_excluding_tax( $product );
                          // Display the total price
                          echo wc_price( $total_price );
                        ?>
                    </span>
                    </div>
                    <div class="d-flex align-items-center bborderdash pb-16 justify-content-between">
                    <span class="fz-16 fw-400 inter ptext2">
                        <?php echo esc_html__("State Tax", "cardzone"); ?>
                    </span>
                    <span class="fz-16 fw-500 inter title tax-price">

                        <?php 
                            global $product;
                                // Get the taxes for the product
                                $taxes = WC_Tax::get_rates( $product->get_tax_class() );
                                // Check if taxes exist
                                if ( $taxes ) {
                                    foreach ( $taxes as $tax ) {
                                        // Display tax rate and amount
                                        // echo 'Tax Rate: ' . $tax['rate'] . '%<br>';
                                        echo wc_price( $product->get_price() * ( $tax['rate'] / 100 ) ) . '<br>';
                                    }
                                } else {
                                    echo 'No taxes applied.';
                                }
                        ?>

                    </span>
                    </div>
                    <div class="d-flex align-items-center pt-16 justify-content-between">
                    <span class="fz-16 fw-400 inter ptext2">
                        <?php echo esc_html__("Total", "cardzone"); ?>
                    </span>
                    <span class="fz-16 fw-500 inter title total-price">
                        
                    <?php
                        global $product;
                        // Get the product price including taxes
                        $total_price = wc_get_price_including_tax( $product );
                        // Display the total price
                        echo wc_price( $total_price );
                    ?>

                    </span>
                    </div>
                </div>

          <?php 
          
          ?>
                <a href="<?php echo wc_get_cart_url(); ?>" class="cmn--btn w-100 text-center">
                    <span>
                    <?php echo esc_html__("Buy Now", "cardzone"); ?>
                    </span>
                </a>

              
            </div>
        </div>
    <?php


}

add_action('woocommerce_single_product_summary', 'cardzone_product_details');



function cardzone_product_details_left() {
    global $product;
    global $post;
    global $woocommerce;
    ?>

        <div class="popular__items popular__v3 mb-40 round16">      
            <div class="d-flex gift__detailsleft align-items-center bborderdash pb-24 mb-24">
                <div class="card__boxleft">
                    <?php the_post_thumbnail(); ?>               
                </div>
                <div class="card__boxright">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <h3 class="title mb-10">
                            <?php echo the_title(); ?> 
                            <span class="fz-18 fw-400 inter ptext2">(
                                <?php
                                    // Get the categories of the current product
                                    $product_categories = get_the_terms(get_the_ID(), 'product_cat');
                                    // Output the categories if they exist
                                    if ($product_categories && !is_wp_error($product_categories)) {
                                        //  echo '<div class="product-categories">';
                                        foreach ($product_categories as $category) {
                                            echo '<span>'. $category->name .'</span>';
                                        }
                                    
                                    }
                                ?>
                            )</span>
                        </h3>
                    </div>

                    <div class="ratting mb-15 d-flex align-items-center gap-2">

                                    
                    <i class="material-symbols-outlined ratting">
                                 star
                              </i>
                        <?php
                        // Get average rating and count
                        $average_rating = $product->get_average_rating();
                        // $rating_count = $product->get_rating_count();

                        // Format average rating to one decimal place
                        $formatted_average_rating = number_format($average_rating, 1);

                        // Display the rating
                        echo '<span class="woocommerce-product-rating">';
                        echo '<span class="star-rating" title="Rated ' . $formatted_average_rating . '">';
                        echo '<span style="width: ' . ( ( $formatted_average_rating / 5 ) * 100 ) . '%;">';
                        echo '<strong itemprop="ratingValue">' . $formatted_average_rating . '</strong> ';
                        echo '</span>';
                        echo '</span>';
                        echo '</span>';
                                            
                            ?>


                        
                    </div>
                    
                    <?php woocommerce_template_single_excerpt(); ?>
                    
                </div>
            </div>
            <div class="highlight__item pb-15">
                <h5 class="title mb-16">
                    <?php echo esc_html__("More Details", "cardzone"); ?>
                </h5>
                <?php the_content(); ?>
            </div>
            
        </div>

    <?php
}

add_action('woocommerce_before_single_product_summary', 'cardzone_product_details_left');








//Product Search
add_filter( 'get_product_search_form' , 'cardzone_custom_product_searchform' );

function cardzone_custom_product_searchform( $form ) {

	$form = '
    
    <form action="' . esc_url( home_url( '/shop'  ) ) . '" method="get" class="product-search-form d-flex align-items-center justify-content-between">
        <input type="search" value="' . get_search_query() . '" name="s" placeholder="'.esc_attr__('Search by product','cardzone').'" class="product-search-inpur">
        <i class="material-symbols-outlined">
        search
        </i>
    </form>
            
            ';

	return $form;
}



//Product Details 
add_action( 'wp_footer' , 'custom_quantity_fields_script' );

// custom_quantity_fields_script
function custom_quantity_fields_script(){
    ?>
<script type='text/javascript'>
jQuery(function($) {
    if (!String.prototype.getDecimals) {
        String.prototype.getDecimals = function() {
            var num = this,
                match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
            if (!match) {
                return 0;
            }
            return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
        }
    }
    // Quantity "plus" and "minus" buttons
    $(document.body).on('click', '.tp-cart-plus, .tp-cart-minus', function() {
        var $qty = $(this).closest('.quantity').find('.qty'),
            currentVal = parseFloat($qty.val()),
            max = parseFloat($qty.attr('max')),
            min = parseFloat($qty.attr('min')),
            step = $qty.attr('step');

        // Format values
        if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
        if (max === '' || max === 'NaN') max = '';
        if (min === '' || min === 'NaN') min = 0;
        if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

        // Change the value
        if ($(this).is('.tp-cart-plus')) {
            if (max && (currentVal >= max)) {
                $qty.val(max);
            } else {
                $qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
            }
        } else {
            if (min && (currentVal <= min)) {
                $qty.val(min);
            } else if (currentVal > 0) {
                $qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
            }
        }

        // Trigger change event
        $qty.trigger('change');
    });
});
</script>
<?php
}