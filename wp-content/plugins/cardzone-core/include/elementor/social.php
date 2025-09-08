<?php

namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_social extends Widget_Base
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
        return 'tp-social';
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
        return __('Social', 'tpcore');
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
        // Testimonial Section
        $this->start_controls_section(
            'finview_section_general',
            [
                'label' => esc_html__('Testimonial Section', 'finview-core')
            ]
        );

        $this->add_control(
            'finview_content_style_selection',
            [
                'label' => esc_html__('Select Style', 'finview-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_one' => esc_html__('Style One', 'finview-core'),
                    'style_two' => esc_html__('Style Two', 'finview-core'),
                ],
                'default' => 'style_one',
            ]
        );

        $this->end_controls_section();

        // Social Content
        $this->start_controls_section(
            'social_content',
            [
                'label' => esc_html__('Social', 'tpcore'),
            ]
        );

        // Social Align
        $this->add_responsive_control(
            'social_content_align',
            [
                'label' => esc_html__('Social Align', 'tpcore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'tpcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'tpcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'tpcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'tpcore'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .social_area ' => 'justify-content: {{VALUE}};',
                    '{{WRAPPER}} .social ' => 'justify-content: {{VALUE}};',
                ],

            ]
        );

        // Facebook URL
        $this->add_control(
            'social_fb_icon_url',
            [
                'label' => esc_html__('Facebook URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'label_block' => true,
            ]
        );

        // Twitter URL
        $this->add_control(
            'social_tw_icon_url',
            [
                'label' => esc_html__('Twitter URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'label_block' => true,
            ]
        );

        // Pinterest URL
        $this->add_control(
            'social_pi_icon_url',
            [
                'label' => esc_html__('Pinterest URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'label_block' => true,
            ]
        );
        // Twitch URL
        $this->add_control(
            'social_twi_icon_url',
            [
                'label' => esc_html__('Twitch URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'label_block' => true,
            ]
        );

        // Skype URL
        $this->add_control(
            'social_sk_icon_url',
            [
                'label' => esc_html__('Skype URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'label_block' => true,
            ]
        );

        // Instagram URL
        $this->add_control(
            'social_in_icon_url',
            [
                'label' => esc_html__('Instagram URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'label_block' => true,
            ]
        );

        // LinkedIn URL
        $this->add_control(
            'social_ln_icon_url',
            [
                'label' => esc_html__('LinkedIn URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'label_block' => true,
            ]
        );

        // YouTube URL
        $this->add_control(
            'social_yt_icon_url',
            [
                'label' => esc_html__('YouTube URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'label_block' => true,
            ]
        );

        // Telegram URL
        $this->add_control(
            'social_tel_icon_url',
            [
                'label' => esc_html__('Telegram URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'label_block' => true,
            ]
        );

        // WhatsApp URL
        $this->add_control(
            'social_wa_icon_url',
            [
                'label' => esc_html__('WhatsApp URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'label_block' => true,
            ]
        );
        // WeChat URL
        $this->add_control(
            'social_wc_icon_url',
            [
                'label' => esc_html__('WeChat URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                'label_block' => true,
            ]
        );



        $this->end_controls_section();

        // style
        // Icon 
        $this->start_controls_section(
            'counter_icon_style',
            [
                'label' => esc_html__('Icon', 'finview-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'counter_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_theme.btn_alt' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'counter_icon_hover_color',
            [
                'label'     => esc_html__('Hover Color ', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_theme.btn_alt:hover ' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'counter_icon_bgcolor',
            [
                'label'     => esc_html__('Background', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_theme.btn_alt' => 'background: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'counter_icon_hvr_bgcolor',
            [
                'label'     => esc_html__('Hover Background', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_theme.btn_alt:after' => 'background-color: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'selector' => '{{WRAPPER}} .btn_theme.btn_alt',
            ]
        );

        $this->add_control(
            'bdr_counter_hvr_color',
            [
                'label' => esc_html__('Hover Border Color', 'finview-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_theme.btn_alt:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_border_radius',
            [
                'label'      => __('Border Radius', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .btn_theme.btn_alt' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        // Icon Size
        $this->add_responsive_control(
            'counter_icon_custom_dimensionsss',
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
                    '{{WRAPPER}} .btn_theme.btn_alt i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .btn_theme.btn_alt svg' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .btn_theme.btn_alt img' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Icon box Size
        $this->add_responsive_control(
            'counter_icon_box_custom_dimensionsss',
            [
                'label' => esc_html__('Box Size', 'finview-core'),
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
                    '{{WRAPPER}} .btn_theme.btn_alt' => 'height: {{SIZE}}{{UNIT}} !important;width: {{SIZE}}{{UNIT}}!important;min-width: {{SIZE}}{{UNIT}} !important;',


                ],
            ]
        );

        $this->add_responsive_control(
            'counter_icon_style_margin',
            [
                'label' => esc_html__('Margin', 'finview-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .btn_theme.btn_alt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'counter_icon_style_padding',
            [
                'label'      => __('Padding', 'finview-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .btn_theme.btn_alt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'
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

        <style>
            .share_title {
                color: #074C3E;
                font-size: 18px;
                font-weight: 500;
                margin-top: 2px;
            }
        </style>

        <?php if ($settings['finview_content_style_selection'] == 'style_one') : ?>
            <div class="social-card">
                <?php if (!empty($settings['social_fb_icon_url']['url'])) :   ?>
                    <a href="<?php echo esc_url($settings['social_fb_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                    <i class="fa-brands fa-facebook"></i>
                    </a>
                <?php endif ?>
                <?php if (!empty($settings['social_tw_icon_url']['url'])) :   ?>
                    <a href="<?php echo esc_url($settings['social_tw_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                <?php endif ?>
                <?php if (!empty($settings['social_pi_icon_url']['url'])) :   ?>
                    <a href="<?php echo esc_url($settings['social_pi_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                        <i class="fa-brands fa-pinterest"></i>
                    </a>
                <?php endif ?>
              
                <?php if (!empty($settings['social_sk_icon_url']['url'])) :   ?>
                    <a href="<?php echo esc_url($settings['social_sk_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                        <i class="fa-brands fa-skype"></i>
                    </a>
                <?php endif ?>
                <?php if (!empty($settings['social_in_icon_url']['url'])) :   ?>
                    <a href="<?php echo esc_url($settings['social_in_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                <?php endif ?>
                <?php if (!empty($settings['social_ln_icon_url']['url'])) :   ?>
                    <a href="<?php echo esc_url($settings['social_ln_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>
                <?php endif ?>
                <?php if (!empty($settings['social_yt_icon_url']['url'])) :   ?>
                    <a href="<?php echo esc_url($settings['social_yt_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                <?php endif ?>
                <?php if (!empty($settings['social_tel_icon_url']['url'])) :   ?>
                    <a href="<?php echo esc_url($settings['social_tel_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                        <i class="fa-brands fa-telegram"></i>
                    </a>
                <?php endif ?>
                <?php if (!empty($settings['social_wc_icon_url']['url'])) :   ?>
                    <a href="<?php echo esc_url($settings['social_wc_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                <?php endif ?>
            </div>
        <?php endif ?>

        <?php if ($settings['finview_content_style_selection'] == 'style_two') : ?>
            <div class="social_area d-flex gap-3 align-items-start">
                <p class="share_title flex-shrink-0">Share -</p>
                <div class="social flex-wrap justify-content-start">
                    <?php if (!empty($settings['social_fb_icon_url']['url'])) :   ?>
                        <a href="<?php echo esc_url($settings['social_fb_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                            <i class="bi bi-facebook"></i>
                        </a>
                    <?php endif ?>
                    <?php if (!empty($settings['social_tw_icon_url']['url'])) :   ?>
                        <a href="<?php echo esc_url($settings['social_tw_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                            <i class="bi bi-twitter"></i>
                        </a>
                    <?php endif ?>
                    <?php if (!empty($settings['social_pi_icon_url']['url'])) :   ?>
                        <a href="<?php echo esc_url($settings['social_pi_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                            <i class="bi bi-pinterest"></i>
                        </a>
                    <?php endif ?>
                    <?php if (!empty($settings['social_twi_icon_url']['url'])) :   ?>
                        <a href="<?php echo esc_url($settings['social_twi_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                            <i class="bi bi-twitch"></i>
                        </a>
                    <?php endif ?>
                    <?php if (!empty($settings['social_sk_icon_url']['url'])) :   ?>
                        <a href="<?php echo esc_url($settings['social_sk_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                            <i class="bi bi-skype"></i>
                        </a>
                    <?php endif ?>
                    <?php if (!empty($settings['social_in_icon_url']['url'])) :   ?>
                        <a href="<?php echo esc_url($settings['social_in_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                            <i class="bi bi-instagram"></i>
                        </a>
                    <?php endif ?>
                    <?php if (!empty($settings['social_ln_icon_url']['url'])) :   ?>
                        <a href="<?php echo esc_url($settings['social_ln_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    <?php endif ?>
                    <?php if (!empty($settings['social_yt_icon_url']['url'])) :   ?>
                        <a href="<?php echo esc_url($settings['social_yt_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                            <i class="bi bi-youtube"></i>
                        </a>
                    <?php endif ?>
                    <?php if (!empty($settings['social_tel_icon_url']['url'])) :   ?>
                        <a href="<?php echo esc_url($settings['social_tel_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                            <i class="bi bi-telegram"></i>
                        </a>
                    <?php endif ?>
                    <?php if (!empty($settings['social_wc_icon_url']['url'])) :   ?>
                        <a href="<?php echo esc_url($settings['social_wc_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    <?php endif ?>
                    <?php if (!empty($settings['social_wa_icon_url']['url'])) :   ?>
                        <a href="<?php echo esc_url($settings['social_wa_icon_url']['url']); ?>" class="box_8 p-0 btn_theme btn_alt">
                            <i class="bi bi-wechat"></i>
                        </a>
                    <?php endif ?>
                </div>
            </div>
        <?php endif ?>
<?php
    }
}

$widgets_manager->register(new TP_social());
