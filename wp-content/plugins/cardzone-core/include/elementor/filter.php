<?php

namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_FilterBox extends Widget_Base
{

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'filterbox';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Filter Box', 'cardzone');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'tp-icon';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['tpcore'];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends()
    {
        return ['cardzone'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls()
    { }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>


        <section class="search__card">
            <div class="container">
                <div class="find__searchcard">
                    <form id="filter_form" action="<?php echo esc_url(get_permalink(get_page_by_path('results-page'))); ?>" method="GET">
                        <div class="row g-3 justify-content-center align-items-end">
                            <!-- Credit Score Filter -->
                            <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-6 col-sm-6">
                                <div class="card__find__item">
                                    <span class="fz-18 fw-500 inter title mb-16 d-block">
                                        <?php echo esc_html__('Whats your credit score?', 'tpcore') ?>
                                    </span>
                                    <select name="credit_score" id="credit_score">
                                        <option value=""><?php echo esc_html__('Select Credit Score', 'tpcore')?></option>
                                        <?php
                                                $credit_scores = get_posts(array(
                                                    'post_type' => 'listing-card',
                                                    'posts_per_page' => -1,
                                                    'meta_key' => 'credit_score',
                                                    'orderby' => 'meta_value',
                                                    'order' => 'ASC',
                                                    'fields' => 'ids'
                                                ));

                                                $credit_score_values = array();
                                                foreach ($credit_scores as $post_id) {
                                                    $score = get_post_meta($post_id, 'credit_score', true);
                                                    if ($score && !in_array($score, $credit_score_values)) {
                                                        $credit_score_values[] = $score;
                                                        echo '<option value="' . esc_attr($score) . '">' . esc_html($score) . '</option>';
                                                    }
                                                }
                                                ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Card Type Filter -->
                            <div class="col-xxl-5 col-xl-5 col-lg-4 col-md-6 col-sm-6">
                                <div class="card__find__item">
                                    <span class="fz-18 fw-500 inter title mb-16 d-block">
                                        <?php echo esc_html__(' What are you looking for?', 'tpcore') ?>
                                    </span>
                                    <select name="card_type" id="card_type">
                                        <option value=""><?php echo esc_html__('Select Card Type', 'tpcore') ?></option>
                                        <?php
                                                $card_types = get_posts(array(
                                                    'post_type' => 'listing-card',
                                                    'posts_per_page' => -1,
                                                    'meta_key' => 'card_type',
                                                    'orderby' => 'meta_value',
                                                    'order' => 'ASC',
                                                    'fields' => 'ids'
                                                ));

                                                $card_type_values = array();
                                                foreach ($card_types as $post_id) {
                                                    $type = get_post_meta($post_id, 'card_type', true);
                                                    if ($type && !in_array($type, $card_type_values)) {
                                                        $card_type_values[] = $type;
                                                        echo '<option value="' . esc_attr($type) . '">' . esc_html($type) . '</option>';
                                                    }
                                                }
                                                ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-4 col-sm-5">
                                <div class="card__find__item">
                                    <button type="submit" class="cmn--btn filter-btn">
                                        <span style="color: #fff;"><?php echo esc_html__('Find Your Card', 'tpcore') ?></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>











<?php
    }
}

$widgets_manager->register(new TP_FilterBox());
