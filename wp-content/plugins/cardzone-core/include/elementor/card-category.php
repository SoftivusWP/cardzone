<?php

namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_loan_category extends Widget_Base
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
        return 'tp-loan-category';
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
        return __('Card Category', 'tpcore');
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
        return ['tpcore'];
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
    {


        // ======================= Style =================================//

        $this->start_controls_section(
            'finview_category_box_card_section_genaral',
            [
                'label' => esc_html__('Category Box', 'bankio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'button_category_box_color',
            [
                'label' => esc_html__('Color', 'bankio-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sidebar-filter__part li' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_category_bg_color',
            [
                'label' => esc_html__('List BG', 'bankio-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sidebar-filter__part li' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_category_bg_color_hover',
            [
                'label' => esc_html__('List Hover BG', 'bankio-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sidebar-filter__part li:hover' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_category_box_bdr_color',
            [
                'label' => esc_html__('Border Color', 'bankio-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sidebar-filter__part li' => 'border:1px solid {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_category_box_border_radius',
            [
                'label'      => __('Border Radius', 'bankio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sidebar-filter__part li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'button_category_box_style_margin',
            [
                'label' => esc_html__('Margin', 'bankio-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .sidebar-filter__part li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_category_box_style_padding',
            [
                'label'      => __('Padding', 'bankio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sidebar-filter__part li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

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
        $query = new \WP_Query(
            array(
                'post_type'      => 'listing-card',
                // 'posts_per_page' => $settings['loans_posts_per_page'],
                // 'orderby'        => $settings['loans_template_order_by'],
                // 'order'          => $settings['loans_template_order'],
                'offset'         => 0,
                'post_status'    => 'publish',
            )
        );

?>

        <div class="listing-card-sidebar-category">
            <ul class="query">
                <?php
                // Get all categories for the 'loans' post type
                $categories = get_terms(array(
                    'taxonomy'   => 'cards-cat', // Taxonomy name
                    'hide_empty' => false,       // Show even if no posts are assigned
                ));

                // Check if categories exist and are not WP_Error
                if ($categories && !is_wp_error($categories)) {
                    // Loop through each category
                    foreach ($categories as $category) {
                ?>
                        <a href="<?php echo get_term_link($category); ?>">
                            <li>
                                <span class="query__label"><?php echo esc_html($category->name); ?></span>
                            </li>
                        </a>
                <?php
                    }
                }
                ?>

            </ul>
        </div>

<?php
    }
}

$widgets_manager->register(new TP_loan_category());
