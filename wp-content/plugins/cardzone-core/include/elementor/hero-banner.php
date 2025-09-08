<?php

namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Repeater;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Utils;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;
use TPCore\Elementor\Controls\Group_Control_TPGradient;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Hero_Banner extends Widget_Base
{

    use \TPCore\Widgets\TPCoreElementFunctions;

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
        return 'hero-banner';
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
        return __('Hero Banner', 'tp-core');
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

    public function get_tp_contact_form()
    {
        if (!class_exists('WPCF7')) {
            return;
        }
        $tp_cfa         = array();
        $tp_cf_args     = array('posts_per_page' => -1, 'post_type' => 'wpcf7_contact_form');
        $tp_forms       = get_posts($tp_cf_args);
        $tp_cfa         = ['0' => esc_html__('Select Form', 'tpcore')];
        if ($tp_forms) {
            foreach ($tp_forms as $tp_form) {
                $tp_cfa[$tp_form->ID] = $tp_form->post_title;
            }
        } else {
            $tp_cfa[esc_html__('No contact form found', 'tpcore')] = 0;
        }
        return $tp_cfa;
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
        $this->register_controls_section();
        $this->style_tab_content();
    }


    protected function register_controls_section()
    {

        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'tp-core'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tp-core'),
                    'layout-2' => esc_html__('Layout 2', 'tp-core')
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('banner', 'Banner Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5']);


        //Contact form add
        $this->start_controls_section(
            'tpcore_contact',
            [
                'label' => esc_html__('Contact Form', 'tpcore'),
                'condition' => [
                    'tp_design_style' => ['layout-2']
                ]
            ]

        );


        $this->add_control(
            'form_switch_banner',
            [
                'label'        => esc_html__('Form Switch', 'tpcore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'tpcore'),
                'label_off'    => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default'      => '0',
            ]
        );

        $this->add_control(
            'scooby_contact_content_form_shortcode',
            [
                'label' => esc_html__('Contact Form Shortcode', 'scooby-core'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'placeholder' => esc_html__('Type your Shortcode here', 'scooby-core'),
            ]
        );

        $this->end_controls_section();
        //Contact form end

        // button
        $this->tp_button_render('banner', 'Button', ['layout-1', 'layout-3']);

        // button 2
        $this->tp_button_render('banner-two', 'Button Two', ['layout-1', 'layout-3']);

        // social links
        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__('Social Profiles', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-3'
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tp_social_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
            ]
        );

        $repeater->add_control(
            'tp_social_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_social_icon_type' => 'image',
                ]

            ]
        );

        $repeater->add_control(
            'tp_social_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_social_icon_type' => 'svg'
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_social_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fas fa-facebook-f',
                    'condition' => [
                        'tp_social_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_social_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fab fa-facebook-f',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_social_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_social_link',
            [
                'label' => esc_html__('Social Profile Link', 'textdomain'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'textdomain'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_social_title',
            [
                'label' => esc_html__('Social Profile Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Profile Title', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tp_social_title }}}',
                'default' => [
                    [
                        'tp_social_link' => ['url' => 'https://facebook.com/'],
                        'tp_social_title' => 'facebook',
                        'tp_social_selected_icon' => ['value' => 'fab fa-facebook-f']
                    ],
                    [
                        'tp_social_link' => ['url' => 'https://linkedin.com/'],
                        'tp_social_title' => 'linkedin',
                        'tp_social_selected_icon' => ['value' => 'fab fa-linkedin-in']
                    ],
                    [
                        'tp_social_link' => ['url' => 'https://twitter.com/'],
                        'tp_social_title' => 'twitter',
                        'tp_social_selected_icon' => ['value' => 'fab fa-twitter']
                    ]
                ],
            ]
        );

        $this->end_controls_section();

        // thumbnail image
        $this->start_controls_section(
            'tp_thumbnail_section',
            [
                'label' => esc_html__('Thumbnail', 'tpcore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_banner_bg_image',
            [
                'label' => esc_html__('Choose Banner Background', 'tp-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-2', 'layout-4']
                ]
            ]
        );

        $this->add_control(
            'tp_thumbnail_image',
            [
                'label' => esc_html__('Choose Banner Right Image', 'tp-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_thumbnail_image_2',
            [
                'label' => esc_html__('Choose Thumbnail Image 2', 'tp-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-3', 'layout-4', 'layout-5']
                ]
            ]
        );

        $this->add_control(
            'tp_thumbnail_image_3',
            [
                'label' => esc_html__('Choose Thumbnail Image 3', 'tp-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-4', 'layout-5']
                ]
            ]
        );

        $this->add_control(
            'tp_thumbnail_image_4',
            [
                'label' => esc_html__('Choose Thumbnail Image 4', 'tp-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => 'layout-4'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_thumbnail_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();

        // banner shape
        $this->start_controls_section(
            'tp_banner_shape',
            [
                'label' => esc_html__('Hero Shape', 'tpcore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]

        );

        $this->add_control(
            'tp_banner_shape_switch_two',
            [
                'label'        => esc_html__('Shape Two On/Off', 'tpcore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'tpcore'),
                'label_off'    => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default'      => '0',
                'condition' => [
                    'tp_design_style' => 'layout-2'
                ]
            ]
        );

        $this->add_control(
            'tp_banner_shape_switch',
            [
                'label'        => esc_html__('Shape On/Off', 'tpcore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'tpcore'),
                'label_off'    => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default'      => '0',
            ]
        );

        $this->add_control(
            'tp_shape_image_1',
            [
                'label' => esc_html__('Choose Shape Image 1', 'tp-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_banner_shape_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_shape_image_2',
            [
                'label' => esc_html__('Choose Shape Image 2', 'tp-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_banner_shape_switch' => 'yes',
                    'tp_design_style' => ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'tp_shape_image_3',
            [
                'label' => esc_html__('Choose Shape Image 3', 'tp-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_banner_shape_switch' => 'yes',
                    'tp_design_style' => ['layout-1', 'layout-5']
                ]
            ]
        );

        $this->add_control(
            'tp_shape_image_4',
            [
                'label' => esc_html__('Choose Shape Image 4', 'tp-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_banner_shape_switch' => 'yes',
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
            'tp_shape_image_5',
            [
                'label' => esc_html__('Choose Shape Image 5', 'tp-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_banner_shape_switch' => 'yes',
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'condition' => [
                    'tp_banner_shape_switch' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // background
        $this->start_controls_section(
            'tp_background_section',
            [
                'label' => esc_html__('Background Image', 'tpcore'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-3'
                ]
            ]
        );

        $this->add_control(
            'tp_bg_image',
            [
                'label' => esc_html__('Choose Background Image', 'tp-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_bg_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();

        // scroll down
        $this->start_controls_section(
            'section_scroll',
            [
                'label' => esc_html__('Scroll Down', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-4'
                ]
            ]
        );

        $this->add_control(
            'tp_scroll_switch',
            [
                'label'        => esc_html__('Scroll Down On/Off', 'tpcore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'tpcore'),
                'label_off'    => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default'      => '0',
            ]
        );

        $this->add_control(
            'tp_scroll_title',
            [
                'label'       => esc_html__('Scroll Down Title', 'tpcore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Scroll Down', 'tpcore'),
                'placeholder' => esc_html__('Your Title Text', 'tpcore'),
                'description' => 'Type Your Scroll Down Title In This Field',
                'label_block' => true,
                'condition'   => [
                    'tp_scroll_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_scroll_id',
            [
                'label'       => esc_html__('Section ID', 'tpcore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('#', 'tpcore'),
                'placeholder' => esc_html__('Your Section ID', 'tpcore'),
                'description' => 'Note: Please, insert "#" before your section ID text here',
                'condition'   => [
                    'tp_scroll_switch' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // client area
        $this->start_controls_section(
            'section_client',
            [
                'label' => esc_html__('Client Area', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-4'
                ]
            ]
        );

        $this->add_control(
            'tp_client_switch',
            [
                'label'        => esc_html__('Client On/Off', 'tpcore'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'tpcore'),
                'label_off'    => esc_html__('Hide', 'tpcore'),
                'return_value' => 'yes',
                'default'      => '0',
            ]
        );

        $this->add_control(
            'tp_client_title',
            [
                'label'       => esc_html__('Client Title', 'tpcore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Over 5Ok+ Client all over the world', 'tpcore'),
                'placeholder' => esc_html__('Your Title Text', 'tpcore'),
                'description' => 'Type Your Client Title In This Field',
                'label_block' => true,
                'condition'   => [
                    'tp_client_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_client_image',
            [
                'label' => esc_html__('Choose Client Image', 'tp-core'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_client_switch' => 'yes'
                ]
            ]
        );


        $this->end_controls_section();


        // hero slider
        $this->start_controls_section(
            'tpcore_hero_sider_area',
            [
                'label' => esc_html__('Hero Slider Area', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-4'
                ]
            ]
        );

        // repeter field with text 
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tpcore_hero_slider_title',
            [
                'label'       => esc_html__('Title', 'tpcore'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__('Your Title', 'tpcore'),
                'placeholder' => esc_html__('Your Title Text', 'tpcore'),
                'description' => 'Type Your Title In This Field',
                'label_block' => true,
            ]
        );


        $this->add_control(
            'tpcore_hero_slider_list',
            [
                'label' => esc_html__('Hero Slider List', 'tp-core'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();
    }


    // style_tab_content
    protected function style_tab_content()
    {
        $this->tp_section_style_controls('banner_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('section_sub_title', 'Section - Sub Title', '.tp-el-sub-title', ['layout-1', 'layout-2']);
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title', ['layout-1', 'layout-2']);
        $this->tp_basic_style_controls('section_des', 'Section - Description', '.tp-el-des', ['layout-1', 'layout-2']);
        $this->tp_link_controls_style('section_btn', 'Section - Button', '.tp-el-btn', ['layout-1', 'layout-2']);
        $this->tp_link_controls_style('section_btn_two', 'Section - Button Two', '.tp-el-btn-two', ['layout-1', 'layout-2']);
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

        <script>
            jQuery('select').niceSelect();
        </script>

        <?php if ($settings['tp_design_style']  == 'layout-2') :

                    // thumbnail image
                    if (!empty($settings['tp_thumbnail_image']['url'])) {
                        $tp_thumbnail_image = !empty($settings['tp_thumbnail_image']['id']) ? wp_get_attachment_image_url($settings['tp_thumbnail_image']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image']['url'];
                        $tp_thumbnail_image_alt = get_post_meta($settings["tp_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                    // banner background
                    if (!empty($settings['tp_banner_bg_image']['url'])) {
                        $tp_banner_bg_image = !empty($settings['tp_banner_bg_image']['id']) ? wp_get_attachment_image_url($settings['tp_banner_bg_image']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_banner_bg_image']['url'];
                        $tp_banner_bg_image_alt = get_post_meta($settings["tp_banner_bg_image"]["id"], "_wp_attachment_image_alt", true);
                    }

                    // shape image
                    if (!empty($settings['tp_shape_image_1']['url'])) {
                        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url($settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
                        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
                    }

                    // client img
                    if (!empty($settings['tp_client_image']['url'])) {
                        $tp_client_image = !empty($settings['tp_client_image']['id']) ? wp_get_attachment_image_url($settings['tp_client_image']['id']) : $settings['tp_client_image']['url'];
                        $tp_client_image_alt = get_post_meta($settings["tp_client_image"]["id"], "_wp_attachment_image_alt", true);
                    }

                    // Link
                    if ('2' == $settings['tp_banner_btn_link_type']) {
                        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_banner_btn_page_link']));
                        $this->add_render_attribute('tp-button-arg', 'target', '_self');
                        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-btn');
                    } else {
                        if (!empty($settings['tp_banner_btn_link']['url'])) {
                            $this->add_link_attributes('tp-button-arg', $settings['tp_banner_btn_link']);
                            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-btn');
                        }
                    }

                    $this->add_render_attribute('title_args', 'class', 'd2 mb-24 text-white wow fadeInUp tp-el-title');

                    ?>


            <!-- Hero Section Here -->
            <section class="banner__sectiontwo overhid ralt tp-el-section" style="background-image: url('<?php echo esc_url($tp_banner_bg_image); ?>');">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xl-8 col-lg-8">
                            <div class="banner__content pt__spacenone ralt">
                                <div class="banner__content2box">

                                    <?php if (!empty($settings['tp_banner_sub_title'])) : ?>
                                        <h4 class="sub2 tp-el-sub-title ralt base2 mb-16 wow fadeInDown" data-wow-duration="0.4s">
                                            <?php echo tp_kses($settings['tp_banner_sub_title']); ?>
                                        </h4>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['tp_banner_title'])) :
                                                    printf(
                                                        '<%1$s %2$s>%3$s</%1$s>',
                                                        tag_escape($settings['tp_banner_title_tag']),
                                                        $this->get_render_attribute_string('title_args'),
                                                        tp_kses($settings['tp_banner_title'])
                                                    );
                                                endif; ?>

                                    <?php if (!empty($settings['tp_banner_description'])) : ?>
                                        <p class="mb-40 tp-el-des text-white wow fadeInDown" data-wow-duration="0.8s"><?php echo tp_kses($settings['tp_banner_description']); ?></p>
                                    <?php endif; ?>

                                </div>

                                <?php if (!empty($settings['form_switch_banner'])) : ?>

                                    <div class="contact__wrapper_banner">
                                        <?php if (!empty($settings['scooby_contact_content_form_shortcode'])) :   ?>
                                            <?php echo do_shortcode($settings['scooby_contact_content_form_shortcode']) ?>
                                        <?php endif ?>
                                    </div>

                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                            <div class="banner__shapethumb2 ralt">
                                <div class="thumb">
                                    <img src="<?php echo esc_url($tp_thumbnail_image); ?>" alt="<?php echo esc_attr($tp_thumbnail_image_alt); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (!empty($settings['tp_banner_shape_switch'])) : ?>
                    <div class="round__shape">
                        <img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($$tp_shape_image_alt); ?>">
                    </div>
                <?php endif; ?>


                <?php if (!empty($settings['tp_banner_shape_switch_two'])) : ?>
                    <!--element-->
                    <div class="element1">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/banner/chok1.png" alt="element">
                    </div>
                    <div class="element2">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/banner/chok2.png" alt="element">
                    </div>
                    <div class="element3">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/banner/chok4.png" alt="element">
                    </div>
                    <div class="element4">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/banner/chok3.png" alt="element">
                    </div>
                    <!--element-->
                <?php endif; ?>

            </section>
            <!-- Hero Section End -->




            <!--Default style-->
        <?php else :

                    // thumbnail image
                    if (!empty($settings['tp_thumbnail_image']['url'])) {
                        $tp_thumbnail_image = !empty($settings['tp_thumbnail_image']['id']) ? wp_get_attachment_image_url($settings['tp_thumbnail_image']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image']['url'];
                        $tp_thumbnail_image_alt = get_post_meta($settings["tp_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
                    }
                    // thumbnail image2
                    if (!empty($settings['tp_thumbnail_image2']['url'])) {
                        $tp_thumbnail_image2 = !empty($settings['tp_thumbnail_image2']['id']) ? wp_get_attachment_image_url($settings['tp_thumbnail_image2']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image2']['url'];
                        $tp_thumbnail_image_alt2 = get_post_meta($settings["tp_thumbnail_image2"]["id"], "_wp_attachment_image_alt", true);
                    }

                    // shape image
                    if (!empty($settings['tp_shape_image_1']['url'])) {
                        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url($settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
                        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
                    }
                    if (!empty($settings['tp_shape_image_2']['url'])) {
                        $tp_shape_image_2 = !empty($settings['tp_shape_image_2']['id']) ? wp_get_attachment_image_url($settings['tp_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_2']['url'];
                        $tp_shape_image_alt_2 = get_post_meta($settings["tp_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
                    }
                    if (!empty($settings['tp_shape_image_3']['url'])) {
                        $tp_shape_image_3 = !empty($settings['tp_shape_image_3']['id']) ? wp_get_attachment_image_url($settings['tp_shape_image_3']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_3']['url'];
                        $tp_shape_image_alt_3 = get_post_meta($settings["tp_shape_image_3"]["id"], "_wp_attachment_image_alt", true);
                    }
                    if (!empty($settings['tp_shape_image_4']['url'])) {
                        $tp_shape_image_4 = !empty($settings['tp_shape_image_4']['id']) ? wp_get_attachment_image_url($settings['tp_shape_image_4']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_4']['url'];
                        $tp_shape_image_alt_4 = get_post_meta($settings["tp_shape_image_4"]["id"], "_wp_attachment_image_alt", true);
                    }
                    if (!empty($settings['tp_shape_image_5']['url'])) {
                        $tp_shape_image_5 = !empty($settings['tp_shape_image_5']['id']) ? wp_get_attachment_image_url($settings['tp_shape_image_5']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_5']['url'];
                        $tp_shape_image_alt_5 = get_post_meta($settings["tp_shape_image_5"]["id"], "_wp_attachment_image_alt", true);
                    }

                    $this->add_render_attribute('title_args', 'class', 'd1 mb-24 title wow fadeInDown tp-el-title');

                    // Link
                    if ('2' == $settings['tp_banner_btn_link_type']) {
                        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_banner_btn_page_link']));
                        $this->add_render_attribute('tp-button-arg', 'target', '_self');
                        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
                        $this->add_render_attribute('tp-button-arg', 'class', 'cmn--btn tp-el-btn');
                    } else {
                        if (!empty($settings['tp_banner_btn_link']['url'])) {
                            $this->add_link_attributes('tp-button-arg', $settings['tp_banner_btn_link']);
                            $this->add_render_attribute('tp-button-arg', 'class', 'cmn--btn tp-el-btn');
                        }
                    }

                    // Link 2
                    if ('2' == $settings['tp_banner-two_btn_link_type']) {
                        $this->add_render_attribute('tp-button-two-arg', 'href', get_permalink($settings['tp_banner-two_btn_page_link']));
                        $this->add_render_attribute('tp-button-two-arg', 'target', '_self');
                        $this->add_render_attribute('tp-button-two-arg', 'rel', 'nofollow');
                        $this->add_render_attribute('tp-button-two-arg', 'class', 'cmn--btn outline__btn tp-el-btn-two');
                    } else {
                        if (!empty($settings['tp_banner-two_btn_link']['url'])) {
                            $this->add_link_attributes('tp-button-two-arg', $settings['tp_banner-two_btn_link']);
                            $this->add_render_attribute('tp-button-two-arg', 'class', 'cmn--btn outline__btn tp-el-btn-two');
                        }
                    }

                    ?>

            <section class="banner__section bgadd overhid ralt tp-el-section">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xl-6 col-lg-6">
                            <div class="banner__content ralt">

                                <?php if (!empty($settings['tp_banner_section_title_show'])) : ?>
                                    <?php if (!empty($settings['tp_banner_sub_title'])) : ?>
                                        <h4 class="sub ralt base mb-16 wow fadeInDown tp-el-sub-title" data-wow-duration="0.4s">
                                            <?php echo tp_kses($settings['tp_banner_sub_title']); ?>
                                        </h4>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['tp_banner_title'])) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['tp_banner_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            tp_kses($settings['tp_banner_title'])
                                        );
                                    endif; ?>

                                    <?php if (!empty($settings['tp_banner_description'])) : ?>
                                        <p class="mb-40 title wow fadeInDown tp-el-des" data-wow-duration="0.8s">
                                            <?php echo tp_kses($settings['tp_banner_description']); ?>
                                        </p>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <div class="btn__grp d-flex align-items-center wow fadeInDown" data-wow-duration="1s">

                                    <?php if (!empty($settings['tp_banner_btn_text'])) : ?>
                                        <a <?php echo $this->get_render_attribute_string('tp-button-arg'); ?>>
                                            <span>
                                                <?php echo tp_kses($settings['tp_banner_btn_text']); ?>
                                            </span>
                                        </a>
                                    <?php endif; ?>

                                    <a <?php echo $this->get_render_attribute_string('tp-button-two-arg'); ?>>
                                        <span>
                                            <?php echo tp_kses($settings['tp_banner-two_btn_text']); ?>
                                        </span>
                                    </a>

                                </div>

                                <?php if (!empty($tp_shape_image_5)) : ?>
                                    <div class="ball">
                                        <img src="<?php echo esc_url($tp_shape_image_5); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_5); ?>">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5">
                            <div class="banner__shapethumb ralt">

                                <?php if ($tp_thumbnail_image) : ?>
                                    <div class="thumb">
                                        <img src="<?php echo esc_url($tp_thumbnail_image); ?>" class="w-100" alt="<?php echo esc_attr($tp_thumbnail_image_alt); ?>">
                                    </div>
                                <?php endif; ?>

                                <?php if ($tp_shape_image) : ?>
                                    <div class="circle__thumb">
                                        <img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (!empty($tp_shape_image_2)) : ?>
                    <div class="wallet">
                        <img src="<?php echo esc_url($tp_shape_image_2) ?>" alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
                    </div>
                <?php endif; ?>

                <?php if (!empty($tp_shape_image_3)) : ?>
                    <div class="hand-wallet">
                        <img src="<?php echo esc_url($tp_shape_image_3); ?>" alt="<?php esc_attr($tp_shape_image_alt_3); ?>">
                    </div>
                <?php endif; ?>

                <?php if (!empty($tp_shape_image_4)) : ?>
                    <div class="mobile-wallet">
                        <img src="<?php echo esc_url($tp_shape_image_4); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_4); ?>">
                    </div>
                <?php endif; ?>
            </section>



<?php endif;
    }
}

$widgets_manager->register(new TP_Hero_Banner());
