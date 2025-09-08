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
class TP_con_card_info extends Widget_Base
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
        return 'tp-con-card-info';
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
        return __('Contact Info Card', 'tpcore');
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


        //cont_card Section
        $this->start_controls_section(
            'finview_cont_card_section_genaral',
            [
                'label' => esc_html__('Contact Card', 'finview-core')
            ]
        );


        $this->add_responsive_control(
            'finview_cont_card_content_align',
            [
                'label'         => esc_html__('Card Text Align', 'finview-core'),
                'type'             => \Elementor\Controls_Manager::CHOOSE,
                'options'         => [
                    'left'         => [
                        'title' => esc_html__('Left', 'finview-core'),
                        'icon'     => 'eicon-text-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__('Center', 'finview-core'),
                        'icon'     => 'eicon-text-align-center',
                    ],
                    'right'     => [
                        'title' => esc_html__('Right', 'finview-core'),
                        'icon'     => 'eicon-text-align-right',
                    ],
                    'justify'     => [
                        'title' => esc_html__('Justified', 'finview-core'),
                        'icon'     => 'eicon-text-align-justify',
                    ],
                ],
                'default'         => 'left',
                'selectors'     => [
                    '{{WRAPPER}} .contact-info-card .gap-2' => 'justify-content: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'finview_cont_phone',
            [
                'label' => esc_html__('Phone ', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('123-789-4567', 'finview-core'),
                'placeholder' => esc_html__('Type your Phone here', 'finview-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'finview_cont_location',
            [
                'label' => esc_html__('Location ', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Royal Ln. Mesa, New Jersey 45463', 'finview-core'),
                'placeholder' => esc_html__('Type your Location here', 'finview-core'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'finview_cont_mail',
            [
                'label' => esc_html__('Email ', 'finview-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('info@example.com', 'finview-core'),
                'placeholder' => esc_html__('Type your Email here', 'finview-core'),
                'label_block' => true,
            ]
        );


        $this->end_controls_section();

        // ======================= contact card Start Style =================================//

        // card  Icon 
        $this->start_controls_section(
            'card_icon_style',
            [
                'label' => esc_html__('Content', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'finview-core'),
                'name'     => 'facility_title_style_typ',
                'selector' => '{{WRAPPER}} .cus_icon span,.cus_icon span a',

            ]
        );

        $this->add_control(
            'card_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .cus_icon i' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Icon Size
        $this->add_responsive_control(
            'icon_custom_dimensionsss',
            [
                'label' => esc_html__('Icon Size', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cus_icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .cus_icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );



        $this->add_control(
            'facility_title_color',
            [
                'label'     => esc_html__('Content Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_icon span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .cus_icon span a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'facility_title_color_hover',
            [
                'label'     => esc_html__('Content Hover Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cus_icon:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .cus_icon:hover span a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'facility_icon_style_margin',
            [
                'label' => esc_html__('Gap', 'finview-core'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cus_icon' => 'gap: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'facility_title_style_margin',
            [
                'label' => esc_html__('Margin', 'finview-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cus_icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'facility_title_style_padding',
            [
                'label'      => __('Padding', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cus_icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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

?>

        <div class="contact-info-card">
            <?php if (!empty($settings['finview_cont_location'])) : ?>
                <div class="cus_icon gap-2 mb-3 d-flex align-item-center">
                <i class="material-symbols-outlined">
                    location_on
                </i>
                    <span><?php echo wp_kses($settings['finview_cont_location'], wp_kses_allowed_html('post')) ?></span>
                </div>
            <?php endif; ?>
            <?php if (!empty($settings['finview_cont_phone'])) : ?>
                <div class="cus_icon gap-2 mb-3 d-flex align-item-center">
                    <i class="material-symbols-outlined">call</i>
                    <span><?php echo wp_kses($settings['finview_cont_phone'], wp_kses_allowed_html('post')) ?></span>
                </div>
            <?php endif; ?>
            <?php if (!empty($settings['finview_cont_mail'])) : ?>
                <div class="cus_icon gap-2 d-flex align-item-center">
                    <i class="material-symbols-outlined">mail</i>
                    <span><?php echo wp_kses($settings['finview_cont_mail'], wp_kses_allowed_html('post')) ?></span>
                </div>
            <?php endif; ?>
        </div>
       
<?php
    }
}

$widgets_manager->register(new TP_con_card_info());
