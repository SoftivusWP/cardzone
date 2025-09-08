<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_IconBox extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'iconbox';
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
    public function get_title() {
        return __( 'Icon Box', 'cardzone' );
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
    public function get_icon() {
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
    public function get_categories() {
        return [ 'tpcore' ];
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
    public function get_script_depends() {
        return [ 'cardzone' ];
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
    protected function register_controls() {

        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'cardzone'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'cardzone'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'cardzone'),
                    'layout-2' => esc_html__('Layout 2', 'cardzone'),
                    'layout-3' => esc_html__('Layout 3', 'cardzone'),
                    'layout-4' => esc_html__('Layout 4', 'cardzone'),
                    'layout-5' => esc_html__('Layout 5', 'cardzone'),
                    'layout-6' => esc_html__('Layout 6', 'cardzone'),
                    'layout-7' => esc_html__('Layout 7', 'cardzone'),
                    'layout-8' => esc_html__('Layout 8', 'cardzone'),
                    'layout-9' => esc_html__('Layout 9', 'cardzone'),
                    'layout-10' => esc_html__('Layout 10', 'cardzone')
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tp_features',
            [
                'label' => esc_html__('Icon Box', 'cardzone'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'cardzone' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_bg_image',
            [
                'label' => esc_html__('BG Image', 'cardzone'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_bg_image' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
            'tp_features_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'cardzone'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'cardzone'),
                    'icon' => esc_html__('Icon', 'cardzone'),
                    'svg' => esc_html__('SVG', 'cardzone'),
                ],
            ]
        );

        $this->add_control(
            'tp_features_image',
            [
                'label' => esc_html__('Upload Icon Image', 'cardzone'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_features_icon_type' => 'image'
                ]

            ]
        );

        $this->add_control(
            'tp_features_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'cardzone'),
                'condition' => [
                    'tp_features_icon_type' => 'svg'
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_features_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_features_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tp_features_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_features_icon_type' => 'icon'
                    ]
                ]
            );
        }

        // $this->add_control(
        //     'tp_image_feature',
        //     [
        //         'label' => esc_html__( 'Choose Image', 'tp-core' ),
        //         'type' => \Elementor\Controls_Manager::MEDIA,
        //         'default' => [
        //             'url' => \Elementor\Utils::get_placeholder_image_src(),
        //         ],
        //         'condition' => [
        //             'tp_design_style' => ['layout-6']
        //         ]
        //     ]
        // );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ],
                'condition' => [
                    'tp_design_style' => ['layout-4']
                ]
                
            ]
        );

        $this->add_control(
            'tp_features_title', [
                'label' => esc_html__('Title', 'cardzone'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Icon Box Title', 'cardzone'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6', 'layout-7', 'layout-8', 'layout-9', 'layout-10']
                ]
            ]
        );

        $this->add_control(
            'tp_features_count', [
                'label' => esc_html__('Count', 'cardzone'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('01', 'cardzone'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => ['layout-9']
                ]
            ]
        );

        $this->add_control(
            'tp_features_url', [
                'label' => esc_html__('URL', 'cardzone'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'cardzone'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-7', 'layout-8', 'layout-9', 'layout-10']
                ]
            ]
        ); 

        $this->add_control(
            'tp_features_description',
            [
                'label' => esc_html__('Description XL', 'cardzone'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2', 'layout-4', 'layout-5', 'layout-6', 'layout-7', 'layout-8', 'layout-9', 'layout-10']
                ]
            ]
        );

        // Right angle switch
        $this->add_control(
			'tp_right_angle_switcher',
			[
				'label' => esc_html__( 'Right Angle', 'cardzone' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'cardzone' ),
				'label_off' => esc_html__( 'No', 'cardzone' ),
				'return_value' => 'yes',
				'default' => '0',
                'separator' => 'before',
                'condition' => [
                    'tp_design_style' => ['layout-1']
                ]
			]
		);

        // Right angle switch
        $this->add_control(
            'tp_right_angle_switcher_two',
            [
                'label' => esc_html__( 'Right Angle', 'cardzone' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'cardzone' ),
                'label_off' => esc_html__( 'No', 'cardzone' ),
                'return_value' => 'yes',
                'default' => '0',
                'separator' => 'before',
                'condition' => [
                    'tp_design_style' => ['layout-2']
                ]
            ]
        );

        // creative animation start
        $this->add_control(
			'tp_creative_anima_switcher',
			[
				'label' => esc_html__( 'Active Animation', 'cardzone' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'cardzone' ),
				'label_off' => esc_html__( 'No', 'cardzone' ),
				'return_value' => 'yes',
				'default' => '0',
                'separator' => 'before',
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2', 'layout-3', 'layout-4']
                ]
			]
		);

        $this->add_control(
            'tp_anima_type',
            [
                'label' => __( 'Animation Type', 'cardzone' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'tpfadeUp' => __( 'tpfadeUp', 'cardzone' ),
                    'tpfadeInDown' => __( 'tpfadeInDown', 'cardzone' ),
                    'tpfadeLeft' => __( 'tpfadeLeft', 'cardzone' ),
                    'tpfadeRight' => __( 'tpfadeRight', 'cardzone' ),
                ],
                'default' => 'tpfadeUp',
                'frontend_available' => true,
                'style_transfer' => true,
                'condition' => [
                    'tp_creative_anima_switcher' => 'yes',
                    
                ],
            ]
        );
        
        $this->add_control(
            'tp_anima_dura', [
                'label' => esc_html__('Animation Duration', 'cardzone'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('0.3s', 'cardzone'),
                'condition' => [
                    'tp_creative_anima_switcher' => 'yes',
                    
                ],
            ]
        );
        
        $this->add_control(
            'tp_anima_delay', [
            'label' => esc_html__('Animation Delay', 'cardzone'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('0.6s', 'cardzone'),
            'condition' => [
                'tp_creative_anima_switcher' => 'yes',
                
            ],
            ]
        );
        //Animation end


        //Button Style
        $this->add_control(
            'tp_btn_link_switcher',
            [
                'label' => esc_html__( 'Add Button link', 'cardzone' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'cardzone' ),
                'label_off' => esc_html__( 'No', 'cardzone' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'condition' => [
                    'tp_design_style' => ['layout-7', 'style-8', 'layout-10']
                ]
            ]
        );

        $this->add_control(
            'tp_btn_btn_text',
            [
                'label' => esc_html__('Button Text', 'cardzone'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'cardzone'),
                'title' => esc_html__('Enter button text', 'cardzone'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_link_switcher' => 'yes',
                    'tp_design_style' => ['layout-7', 'style-8', 'layout-10']
                ],
            ]
        );

        $this->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__( 'Button Link Type', 'cardzone' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_btn_link_switcher' => 'yes',
                    'tp_design_style' => ['layout-7', 'style-8', 'layout-10']
                ],
            ]
        );
        
        $this->add_control(
            'tp_btn_link',
            [
                'label' => esc_html__( 'Button Link link', 'cardzone' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'cardzone' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'tp_btn_link_type' => '1',
                    'tp_btn_link_switcher' => 'yes',
                    'tp_design_style' => ['layout-7', 'style-8', 'layout-10']
                ],
            ]
        );

        $this->add_control(
            'tp_btn_page_link',
            [
                'label' => esc_html__( 'Select Button Link Page', 'cardzone' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_link_switcher' => 'yes',
                    'tp_design_style' => ['layout-7', 'style-8', 'layout-10']
                ],
            ]
        );


        $this->add_responsive_control(
            'tp_align',
            [
                'label' => esc_html__('Alignment', 'cardzone'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'cardzone'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'cardzone'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'cardzone'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ],
                 'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $this->end_controls_section();

        //******************
        // Style Tab Start 
        //******************
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Style', 'cardzone' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .main-bg-color',
                
			]
		);

        $this->add_control(
			'icon_bg_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Icon BG Color', 'cardzone' ),
				'selectors' => [
					'{{WRAPPER}} .boxes4' => 'background: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'icon__count_bg_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Icon Count BG', 'cardzone' ),
				'selectors' => [
					'{{WRAPPER}} .count' => 'background: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'title_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Title Color', 'cardzone' ),
				'selectors' => [
					'{{WRAPPER}} .main-title' => 'color: {{VALUE}}',
				],
                'separator' => 'before'
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .main-title',
			]
		);

        $this->add_control(
			'description_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Description Color', 'cardzone' ),
				'selectors' => [
					'{{WRAPPER}} .description-style' => 'color: {{VALUE}}',
				],
                'separator' => 'before'
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography_description',
				'selector' => '{{WRAPPER}} .description-style',
			]
		);

        $this->add_control(
			'btn_bg_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Button BG Color', 'cardzone' ),
				'selectors' => [
					'{{WRAPPER}} .feature-btn-color' => 'background: {{VALUE}}',
				],
                'separator' => 'before'
			]
		);

        $this->add_control(
			'btn_title_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Button Title Color', 'cardzone' ),
				'selectors' => [
					'{{WRAPPER}} .feature-btn-color' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography_btn',
				'selector' => '{{WRAPPER}} .feature-btn-typo',
			]
		);

        // $this->add_control(
        //     'tp_image',
        //     [
        //         'label' => esc_html__( 'Choose Image', 'tp-core' ),
        //         'type' => \Elementor\Controls_Manager::MEDIA,
        //         'default' => [
        //             'url' => \Elementor\Utils::get_placeholder_image_src(),
        //         ],
        //     ]
        // );

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
    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>

        <?php if ( $settings['tp_design_style']  == 'layout-2' ):
            $this->add_render_attribute('title_args', 'class', 'research__title');

            $right_angel_switch_two = $settings['tp_right_angle_switcher_two'] ? 'tershape2': null;
        ?>

        <div class="howwork__item transition main-bg-color <?php echo $settings['tp_align']; ?>">
            <div class="thumb transition <?php echo esc_attr($right_angel_switch_two); ?> m-auto round50 shadow1">

                <?php if($settings['tp_features_icon_type'] == 'icon') : ?>
                    <?php if (!empty($settings['tp_features_icon']) || !empty($settings['tp_features_selected_icon']['value'])) : ?>
                        <span><?php tp_render_icon($settings, 'tp_features_icon', 'tp_features_selected_icon'); ?></span>
                    <?php endif; ?>
                <?php elseif( $settings['tp_features_icon_type'] == 'image' ) : ?>
                    <span>
                        <?php if (!empty($settings['tp_features_image']['url'])): ?>
                            <img class="light" src="<?php echo $settings['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                        <?php endif; ?>
                    </span>
                <?php else : ?>
                    <span>
                        <?php if (!empty($settings['tp_features_icon_svg'])): ?>
                            <?php echo $settings['tp_features_icon_svg']; ?>
                        <?php endif; ?>
                    </span>
                <?php endif; ?>

            </div>
            <div class="content mt-24">
                <h4 class="title mb-16">
                    <?php if(!empty($settings['tp_features_title'])): ?>
                        <a class="features-title main-title" href="<?php echo esc_url($settings['tp_features_url']); ?>">
                            <?php echo tp_kses($settings['tp_features_title' ]); ?>
                        </a>
                    <?php endif; ?>
                </h4>

                <?php if(!empty($settings['tp_features_description'])): ?>
                    <p class="fz-14 fw-400 inter title description-style">
                        <?php echo tp_kses($settings['tp_features_description']); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>



<!--Style 3-->
<?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
    $this->add_render_attribute('title_args', 'class', 'research__title');
?>

    <div class="select__cardbox main-bg-color boxes1 d-flex align-items-center">
        <div class="thumb transition d-flex align-items-center justify-content-center">

            <?php if($settings['tp_features_icon_type'] == 'icon') : ?>
                <?php if (!empty($settings['tp_features_icon']) || !empty($settings['tp_features_selected_icon']['value'])) : ?>
                    <span><?php tp_render_icon($settings, 'tp_features_icon', 'tp_features_selected_icon'); ?></span>
                <?php endif; ?>
            <?php elseif( $settings['tp_features_icon_type'] == 'image' ) : ?>
                <span>
                    <?php if (!empty($settings['tp_features_image']['url'])): ?>
                        <img class="light" src="<?php echo $settings['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                    <?php endif; ?>
                </span>
            <?php else : ?>
                <span>
                    <?php if (!empty($settings['tp_features_icon_svg'])): ?>
                        <?php echo $settings['tp_features_icon_svg']; ?>
                    <?php endif; ?>
                </span>
            <?php endif; ?>
            
        </div>
        <?php if(!empty($settings['tp_features_title'])): ?>
            <h4 class="title features-title main-title">
                <?php echo tp_kses($settings['tp_features_title' ]); ?>
            </h4>
        <?php endif; ?>
    </div>


<!--Style 4-->
<?php elseif ( $settings['tp_design_style']  == 'layout-4' ):
    $this->add_render_attribute('title_args', 'class', 'research__title');
?>

<ul class="choose__listwrap">        
    <li class="d-flex align-items-center wow fadeInUp" data-wow-duration="1.9s">
        <?php if($settings['tp_features_icon_type'] == 'icon') : ?>
            <?php if (!empty($settings['tp_features_icon']) || !empty($settings['tp_features_selected_icon']['value'])) : ?>
                <span><?php tp_render_icon($settings, 'tp_features_icon', 'tp_features_selected_icon'); ?></span>
            <?php endif; ?>
        <?php elseif( $settings['tp_features_icon_type'] == 'image' ) : ?>
            <span>
                <?php if (!empty($settings['tp_features_image']['url'])): ?>
                    <img class="light" src="<?php echo $settings['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                <?php endif; ?>
            </span>
        <?php else : ?>
            <span>
                <?php if (!empty($settings['tp_features_icon_svg'])): ?>
                    <?php echo $settings['tp_features_icon_svg']; ?>
                <?php endif; ?>
            </span>
        <?php endif; ?>
    <span class="contentbox">
    <?php if(!empty($settings['tp_features_title'])): ?>
        <span class="fz-24 d-block mb-1 main-title fw-600 inter title">
            <?php echo tp_kses($settings['tp_features_title' ]); ?>
        </span>
    <?php endif; ?>

    <?php if(!empty($settings['tp_features_description'])): ?>
        <span class="ptext2 fz-16 fw-400 inter">
            <?php echo tp_kses($settings['tp_features_description description-style']); ?>
        </span>
    <?php endif; ?>
    </span>
    </li>
</ul>



<!--Style 5-->
<?php elseif ( $settings['tp_design_style']  == 'layout-5' ):
    $this->add_render_attribute('title_args', 'class', 'research__title');
?>

<div class="d-flex author-box janas__item gap-3 align-items-center">
    <div class="icon">
        <?php if($settings['tp_features_icon_type'] == 'icon') : ?>
            <?php if (!empty($settings['tp_features_icon']) || !empty($settings['tp_features_selected_icon']['value'])) : ?>
                <span><?php tp_render_icon($settings, 'tp_features_icon', 'tp_features_selected_icon'); ?></span>
            <?php endif; ?>
        <?php elseif( $settings['tp_features_icon_type'] == 'image' ) : ?>
            <span>
                <?php if (!empty($settings['tp_features_image']['url'])): ?>
                    <img class="light" src="<?php echo $settings['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                <?php endif; ?>
            </span>
        <?php else : ?>
            <span>
                <?php if (!empty($settings['tp_features_icon_svg'])): ?>
                    <?php echo $settings['tp_features_icon_svg']; ?>
                <?php endif; ?>
            </span>
        <?php endif; ?>

    </div>
    <div class="content">
    <?php if(!empty($settings['tp_features_title'])): ?>
        <span class="fz-18 fw-500 d-block main-title title mb-1">
            <?php echo tp_kses($settings['tp_features_title' ]); ?>
        </span>
    <?php endif; ?>
    <?php if(!empty($settings['tp_features_description'])): ?>
        <span class="fz-14 ptext description-style">
            <?php echo tp_kses($settings['tp_features_description']); ?>
        </span>
    <?php endif; ?>
    </div>
</div>


<!--Style 6-->
<?php elseif ( $settings['tp_design_style']  == 'layout-6' ):
    $this->add_render_attribute('title_args', 'class', 'research__title');
?>

<ul class="choose__listwrap provide__listwrap">
    <li class="d-flex wow fadeInDown">
        
        <?php if($settings['tp_features_icon_type'] == 'icon') : ?>
            <?php if (!empty($settings['tp_features_icon']) || !empty($settings['tp_features_selected_icon']['value'])) : ?>
                <span><?php tp_render_icon($settings, 'tp_features_icon', 'tp_features_selected_icon'); ?></span>
            <?php endif; ?>
        <?php elseif( $settings['tp_features_icon_type'] == 'image' ) : ?>
            <span>
                <?php if (!empty($settings['tp_features_image']['url'])): ?>
                    <img class="light" src="<?php echo $settings['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                <?php endif; ?>
            </span>
        <?php else : ?>
            <span>
                <?php if (!empty($settings['tp_features_icon_svg'])): ?>
                    <?php echo $settings['tp_features_icon_svg']; ?>
                <?php endif; ?>
            </span>
        <?php endif; ?>

        <span class="contentbox">
            <?php if(!empty($settings['tp_features_title'])): ?>
                <span class="fz-24 d-block mb-1 fw-600 inter title main-title">
                    <?php echo tp_kses($settings['tp_features_title' ]); ?>
                </span>
            <?php endif; ?>
            <?php if(!empty($settings['tp_features_description'])): ?>
                <span class="ptext2 fz-16 fw-400 inter description-style">
                    <?php echo tp_kses($settings['tp_features_description']); ?>
                </span>
            <?php endif; ?>
        </span>
    </li>
</ul>



<!--Style 7-->
<?php elseif ( $settings['tp_design_style']  == 'layout-7' ):
    $this->add_render_attribute('title_args', 'class', 'research__title');

    // btn Link
    if ('2' == $settings['tp_btn_link_type']) {
        $link = get_permalink($settings['tp_btn_page_link']);
        $target = '_self';
        $rel = 'nofollow';
    } else {
        $link = !empty($settings['tp_btn_link']['url']) ? $settings['tp_btn_link']['url'] : '';
        $target = !empty($settings['tp_btn_link']['is_external']) ? '_blank' : '';
        $rel = !empty($settings['tp_btn_link']['nofollow']) ? 'nofollow' : '';
    }

?>

<div class="top__items bgwhite round16 bgwhite main-bg-color">
    <div class="icon m-auto d-flex align-items-center base justify-content-center boxes4 round50">
        
        <?php if($settings['tp_features_icon_type'] == 'icon') : ?>
            <?php if (!empty($settings['tp_features_icon']) || !empty($settings['tp_features_selected_icon']['value'])) : ?>
                <span><?php tp_render_icon($settings, 'tp_features_icon', 'tp_features_selected_icon'); ?></span>
            <?php endif; ?>
        <?php elseif( $settings['tp_features_icon_type'] == 'image' ) : ?>
            <span>
                <?php if (!empty($settings['tp_features_image']['url'])): ?>
                    <img class="light" src="<?php echo $settings['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                <?php endif; ?>
            </span>
        <?php else : ?>
            <span>
                <?php if (!empty($settings['tp_features_icon_svg'])): ?>
                    <?php echo $settings['tp_features_icon_svg']; ?>
                <?php endif; ?>
            </span>
        <?php endif; ?>

    </div>
    <div class="content text-center mt-24">

        <?php if(!empty($settings['tp_features_title'])): ?>
            <h4 class="mb-16 title">
                <a href="<?php echo esc_url($settings['tp_features_url']); ?>" class="title main-title">
                    <?php echo tp_kses($settings['tp_features_title' ]); ?>
                </a>
            </h4>
        <?php endif; ?>

        <?php if(!empty($settings['tp_features_description'])): ?>
            <p class="fz-16 fw-400 inter ptext2 mb-30 style-description">
                <?php echo tp_kses($settings['tp_features_description']); ?>
            </p> 
        <?php endif; ?>

        <a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" class="cmn--btn outline__btn feature-btn-color">
            <span class="feature-btn-typo">
                <?php echo tp_kses($settings['tp_btn_btn_text']); ?>
            </span>
        </a>
    </div>
</div>



<!--Style 8-->
<?php elseif ( $settings['tp_design_style']  == 'layout-8' ):
    $this->add_render_attribute('title_args', 'class', 'research__title');

    // btn Link
    if ('2' == $settings['tp_btn_link_type']) {
        $link = get_permalink($settings['tp_btn_page_link']);
        $target = '_self';
        $rel = 'nofollow';
    } else {
        $link = !empty($settings['tp_btn_link']['url']) ? $settings['tp_btn_link']['url'] : '';
        $target = !empty($settings['tp_btn_link']['is_external']) ? '_blank' : '';
        $rel = !empty($settings['tp_btn_link']['nofollow']) ? 'nofollow' : '';
    }

?>

<div class="top__categorieswrap">
    <div class="top__items d-flex align-items-center wow fadeInDown main-bg-color">
        <div class="icon d-flex align-items-center justify-content-center boxes4 boxes1 round50">

            <?php if($settings['tp_features_icon_type'] == 'icon') : ?>
                <?php if (!empty($settings['tp_features_icon']) || !empty($settings['tp_features_selected_icon']['value'])) : ?>
                    <span><?php tp_render_icon($settings, 'tp_features_icon', 'tp_features_selected_icon'); ?></span>
                <?php endif; ?>
            <?php elseif( $settings['tp_features_icon_type'] == 'image' ) : ?>
                <span>
                    <?php if (!empty($settings['tp_features_image']['url'])): ?>
                        <img class="light" src="<?php echo $settings['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                    <?php endif; ?>
                </span>
            <?php else : ?>
                <span>
                    <?php if (!empty($settings['tp_features_icon_svg'])): ?>
                        <?php echo $settings['tp_features_icon_svg']; ?>
                    <?php endif; ?>
                </span>
            <?php endif; ?>

        </div>
        <div class="content">

            <h4 class="mb-16">
                <a href="<?php echo esc_url($settings['tp_features_url']); ?>" class="title main-title">
                    <?php echo tp_kses($settings['tp_features_title' ]); ?>
                </a>
            </h4>

            <?php if(!empty($settings['tp_features_description'])): ?>
                <p class="fz-16 fw-400 inter ptext2 description-style">
                    <?php echo tp_kses($settings['tp_features_description']); ?> 
                </p>
            <?php endif; ?>

        </div>
        
        <a href="<?php echo esc_url($settings['tp_features_url']); ?>" class="arrow boxes4 round50 d-flex align-items-center">
            <i class="material-symbols-outlined">
            chevron_right
            </i>
        </a>

    </div>
</div>


<!--Style 9-->
<?php elseif ( $settings['tp_design_style']  == 'layout-9' ):
    $this->add_render_attribute('title_args', 'class', 'research__title');
?>

<div class="howwork__item transition text-center">
    <div class="work__icon boxes4 arrow1 d-flex align-items-center justify-content-center m-auto ralt round50 shadow1">

    <?php if(!empty($settings['tp_features_count'])): ?>
        <span class="badge count basebg d-flex align-items-center justify-content-center fz-18 fw-600 text-white inter round50">
            <?php echo tp_kses($settings['tp_features_count' ]); ?>
        </span>
    <?php endif; ?>
            <?php if($settings['tp_features_icon_type'] == 'icon') : ?>
                <?php if (!empty($settings['tp_features_icon']) || !empty($settings['tp_features_selected_icon']['value'])) : ?>
                    <span><?php tp_render_icon($settings, 'tp_features_icon', 'tp_features_selected_icon'); ?></span>
                <?php endif; ?>
            <?php elseif( $settings['tp_features_icon_type'] == 'image' ) : ?>
                <span>
                    <?php if (!empty($settings['tp_features_image']['url'])): ?>
                        <img class="light" src="<?php echo $settings['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                    <?php endif; ?>
                </span>
            <?php else : ?>
                <span>
                    <?php if (!empty($settings['tp_features_icon_svg'])): ?>
                        <?php echo $settings['tp_features_icon_svg']; ?>
                    <?php endif; ?>
                </span>
            <?php endif; ?>
    </div>
    <div class="content mt-24">
    <?php if(!empty($settings['tp_features_title'])): ?>
        <h4 class="title mb-16">
            <a class="main-title" href="<?php echo esc_url($settings['tp_features_url']); ?>">
                <?php echo tp_kses($settings['tp_features_title' ]); ?>
            </a>
        </h4>
    <?php endif; ?>
        <?php if(!empty($settings['tp_features_description'])): ?>
            <p class="fz-14 fw-400 inter title description-style">
                <?php echo tp_kses($settings['tp_features_description']); ?>
            </p>
        <?php endif; ?>
    </div>
</div>



<!--Style 10-->
<?php elseif ( $settings['tp_design_style']  == 'layout-10' ):
    $this->add_render_attribute('title_args', 'class', 'research__title');

    // btn Link
    if ('2' == $settings['tp_btn_link_type']) {
        $link = get_permalink($settings['tp_btn_page_link']);
        $target = '_self';
        $rel = 'nofollow';
    } else {
        $link = !empty($settings['tp_btn_link']['url']) ? $settings['tp_btn_link']['url'] : '';
        $target = !empty($settings['tp_btn_link']['is_external']) ? '_blank' : '';
        $rel = !empty($settings['tp_btn_link']['nofollow']) ? 'nofollow' : '';
    }
?>

<div class="top__cardnew__wrap">
    <div class="top__items round16 main-bg-color wow fadeInUp" data-wow-duration="1.2s">
        <div class="icon m-auto d-flex align-items-center base justify-content-center boxes4 round50">
            <?php if($settings['tp_features_icon_type'] == 'icon') : ?>
                <?php if (!empty($settings['tp_features_icon']) || !empty($settings['tp_features_selected_icon']['value'])) : ?>
                    <span><?php tp_render_icon($settings, 'tp_features_icon', 'tp_features_selected_icon'); ?></span>
                <?php endif; ?>
            <?php elseif( $settings['tp_features_icon_type'] == 'image' ) : ?>
                <span>
                    <?php if (!empty($settings['tp_features_image']['url'])): ?>
                        <img class="light" src="<?php echo $settings['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                    <?php endif; ?>
                </span>
            <?php else : ?>
                <span>
                    <?php if (!empty($settings['tp_features_icon_svg'])): ?>
                        <?php echo $settings['tp_features_icon_svg']; ?>
                    <?php endif; ?>
                </span>
            <?php endif; ?>
        </div>
        <div class="content text-center mt-24">
        <?php if(!empty($settings['tp_features_title'])): ?>
            <h4 class="mb-16 ">
                <a href="<?php echo esc_url($settings['tp_features_url']); ?>" class="title main-title">
                    <?php echo tp_kses($settings['tp_features_title' ]); ?>
                </a>
            </h4>
        <?php endif; ?>
            <?php if(!empty($settings['tp_features_description'])): ?>
                <p class="fz-16 fw-400 inter description-style ptext2 mb-30">
                    <?php echo tp_kses($settings['tp_features_description']); ?>
                </p>
            <?php endif; ?>
            <a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" class="cmn--btn outline__btn feature-btn-color">
                <span class="feature-btn-typo">
                    <?php echo tp_kses($settings['tp_btn_btn_text']); ?>
                </span>
            </a>
        </div>
    </div>
</div>




<!--Default Style-->
<?php else: 
    // btn Link
    if ('2' == $settings['tp_btn_link_type']) {
        $link = get_permalink($settings['tp_btn_page_link']);
        $target = '_self';
        $rel = 'nofollow';
    } else {
        $link = !empty($settings['tp_btn_link']['url']) ? $settings['tp_btn_link']['url'] : '';
        $target = !empty($settings['tp_btn_link']['is_external']) ? '_blank' : '';
        $rel = !empty($settings['tp_btn_link']['nofollow']) ? 'nofollow' : '';
    }

     $right_angel_switch = $settings['tp_right_angle_switcher'] ? 'tershape1': null;

?>


<div class="howwork__item transition main-bg-color <?php echo $settings['tp_align']; ?> wow fadeInDown" data-wow-duration="0.5s">
    <div class="thumb transition <?php echo esc_attr($right_angel_switch); ?> m-auto round50 shadow1">

            <?php if($settings['tp_features_icon_type'] == 'icon') : ?>
                <?php if (!empty($settings['tp_features_icon']) || !empty($settings['tp_features_selected_icon']['value'])) : ?>
                    <span><?php tp_render_icon($settings, 'tp_features_icon', 'tp_features_selected_icon'); ?></span>
                <?php endif; ?>
            <?php elseif( $settings['tp_features_icon_type'] == 'image' ) : ?>
                <span>
                    <?php if (!empty($settings['tp_features_image']['url'])): ?>
                        <img class="light" src="<?php echo $settings['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                    <?php endif; ?>
                </span>
            <?php else : ?>
                <span>
                    <?php if (!empty($settings['tp_features_icon_svg'])): ?>
                        <?php echo $settings['tp_features_icon_svg']; ?>
                    <?php endif; ?>
                </span>
            <?php endif; ?>

    </div>
    <div class="content mt-24">
        <h4 class="title mb-16">
            <?php if(!empty($settings['tp_features_title'])): ?>
                <a class="features-title main-title" href="<?php echo esc_url($settings['tp_features_url']); ?>">
                    <?php echo tp_kses($settings['tp_features_title' ]); ?>
                </a>
            <?php endif; ?>
        </h4>
        <?php if(!empty($settings['tp_features_description'])): ?>
            <p class="fz-14 fw-400 inter title description-style">
                <?php echo tp_kses($settings['tp_features_description']); ?>
            </p>
        <?php endif; ?>
    </div>
</div>


        <?php endif; ?>
        <?php
    }
}

$widgets_manager->register( new TP_IconBox() );
