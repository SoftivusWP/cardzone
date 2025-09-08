<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Features extends Widget_Base {

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
	public function get_name() {
		return 'features';
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
		return __( 'Features', 'tpcore' );
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
		return [ 'tpcore' ];
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
     
    protected function register_controls(){
        $this->register_controls_section();
        $this->style_tab_content();
    }  

	protected function register_controls_section() {


 

        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                    'layout-4' => esc_html__('Layout 4', 'tpcore'),
                    'layout-5' => esc_html__('Layout 5', 'tpcore'),
                    'layout-6' => esc_html__('Layout 6', 'tpcore'),
                    'layout-7' => esc_html__('Layout 7', 'tpcore')
                    
                ],
                'default' => 'layout-1',
            ] 
        );

        $this->end_controls_section();
        
        // title/content
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', ['layout-6'] );

        // Features group
        $this->start_controls_section(
            'tp_features',
            [
                'label' => esc_html__('Features List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_features_title_five', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Contact Us', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => ['layout-5']
                ]
            ]
        );


        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
                    'style_3' => __( 'Style 3', 'tpcore' ),
                    'style_4' => __( 'Style 4', 'tpcore' ),
                    'style_5' => __( 'Style 5', 'tpcore' ),
                    'style_6' => __( 'Style 6', 'tpcore' ),
                    'style_7' => __( 'Style 7', 'tpcore' )
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_active_info_switcher',
            [
                'label' => esc_html__( 'Active', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'repeater_condition' => ['style_6']
                ]
            ]
        );
        
        $repeater->add_control(
            'tp_features_icon_type',
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
            'tp_features_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_features_icon_type' => 'image',
                ]

            ]
        );

        $repeater->add_control(
            'tp_features_icon_svg',
            [
                    'show_label' => false,
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                    'condition' => [
                        'tp_features_icon_type' => 'svg'
                    ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
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
            $repeater->add_control(
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

        $repeater->add_control(
            'feature_img',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'repeater_condition' => ['style_2']
                ]
            ]
        );

        $repeater->add_control(
            'tp_features_title', [
                'label' => esc_html__('Features Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2', 'style_3', 'style_4']
                ]
            ]
        ); 

        $repeater->add_control(
            'tp_features_info_title', [
                'label' => esc_html__('Feature Text', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('IMBD 9.5/10', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_5', 'style_6']
                ]
            ]
        );

        
        // $repeater->add_control(
        //     'tp_features_desc_st_four', [
        //         'label' => esc_html__('Feature Description', 'tpcore'),
        //         'description' => tp_get_allowed_html_desc( 'basic' ),
        //         'type' => \Elementor\Controls_Manager::TEXTAREA,
        //         'default' => esc_html__('Description Here', 'tpcore'),
        //         'label_block' => true,
        //         'condition' => [
        //             'repeater_condition' => ['style_3', 'style_5', 'style_6']
        //         ]
        //     ]
        // );

        $repeater->add_control(
            'tp_features_description', [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Service Description', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2', 'style_3', 'style_4']
                ]
            ]
        ); 

        $repeater->add_control(
            'tp_features_url', [
                'label' => esc_html__('URL', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2', 'style_3', 'style_4']
                ]
            ]
        ); 

        // $repeater->add_control(
        //     'tp_features_link_switcher',
        //     [
        //         'label' => esc_html__( 'Add Services link', 'tpcore' ),
        //         'type' => \Elementor\Controls_Manager::SWITCHER,
        //         'label_on' => esc_html__( 'Yes', 'tpcore' ),
        //         'label_off' => esc_html__( 'No', 'tpcore' ),
        //         'return_value' => 'yes',
        //         'default' => 'yes',
        //         'separator' => 'before',
        //         'condition' => [
        //             'repeater_condition' => ['style_1', 'style_2']
        //         ]
        //     ]
        // );

        // $repeater->add_control(
        //     'tp_features_link_type',
        //     [
        //         'label' => esc_html__( 'Service Link Type', 'tpcore' ),
        //         'type' => \Elementor\Controls_Manager::SELECT,
        //         'options' => [
        //             '1' => 'Custom Link',
        //             '2' => 'Internal Page',
        //         ],
        //         'default' => '1',
        //         'condition' => [
        //             'tp_features_link_switcher' => 'yes',
        //             'repeater_condition' => ['style_1', 'style_2']
        //         ]
        //     ]
        // );

        // $repeater->add_control(
        //     'tp_features_link',
        //     [
        //         'label' => esc_html__( 'Service Link', 'tpcore' ),
        //         'type' => \Elementor\Controls_Manager::URL,
        //         'dynamic' => [
        //             'active' => true,
        //         ],
        //         'placeholder' => esc_html__( 'https://your-link.com', 'tpcore' ),
        //         'show_external' => true,
        //         'default' => [
        //             'url' => '#',
        //             'is_external' => false,
        //             'nofollow' => false,
        //         ],
        //         'condition' => [
        //             'tp_features_link_type' => '1',
        //             'tp_features_link_switcher' => 'yes',
        //             'repeater_condition' => ['style_1', 'style_2']
        //         ]
        //     ]
        // );

        // $repeater->add_control(
        //     'tp_features_page_link',
        //     [
        //         'label' => esc_html__( 'Select Service Link Page', 'tpcore' ),
        //         'type' => \Elementor\Controls_Manager::SELECT2,
        //         'label_block' => true,
        //         'options' => tp_get_all_pages(),
        //         'condition' => [
        //             'tp_features_link_type' => '2',
        //             'tp_features_link_switcher' => 'yes',
        //         ]
        //     ]
        // );

        $repeater->add_control(
			'tp_active_switcher',
			[
				'label' => esc_html__( 'Feature Active', 'tpcore' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'tpcore' ),
				'label_off' => esc_html__( 'No', 'tpcore' ),
				'return_value' => 'yes',
				'default' => '0',
                'separator' => 'before',
                'condition' => [
                    'repeater_condition' => ['style_3', 'style_4']
                ],
                
			]
		);

        // creative animation start
        $repeater->add_control(
			'tp_creative_anima_switcher',
			[
				'label' => esc_html__( 'Active Animation', 'tpcore' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'tpcore' ),
				'label_off' => esc_html__( 'No', 'tpcore' ),
				'return_value' => 'yes',
				'default' => '0',
                'separator' => 'before',
                'condition' => [
                    'repeater_condition' => ['style_2', 'style_4']
                ],
                
			]
		);

        $repeater->add_control(
            'tp_anima_type',
            [
                'label' => __( 'Animation Type', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'tpfadeUp' => __( 'tpfadeUp', 'tpcore' ),
                    'tpfadeInDown' => __( 'tpfadeInDown', 'tpcore' ),
                    'tpfadeLeft' => __( 'tpfadeLeft', 'tpcore' ),
                    'tpfadeRight' => __( 'tpfadeRight', 'tpcore' ),
                ],
                'default' => 'tpfadeUp',
                'frontend_available' => true,
                'style_transfer' => true,
                'condition' => [
                    'tp_creative_anima_switcher' => 'yes',
                    'repeater_condition' => ['style_2', 'style_4']
                ],
            ]
        );
        
        $repeater->add_control(
            'tp_anima_dura', [
                'label' => esc_html__('Animation Duration', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('0.3s', 'tpcore'),
                'condition' => [
                    'tp_creative_anima_switcher' => 'yes',
                    'repeater_condition' => ['style_2', 'style_4']
                ],
            ]
        );
        
        $repeater->add_control(
            'tp_anima_delay', [
                'label' => esc_html__('Animation Delay', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('0.6s', 'tpcore'),
                'condition' => [
                    'tp_creative_anima_switcher' => 'yes',
                    'repeater_condition' => ['style_2', 'style_4']
                ],
            ]
        );
        //Animation end


        //Button start
        //   $repeater->add_control(
        //     'tp_btn_link_switcher',
        //     [
        //         'label' => esc_html__( 'Add Button link', 'tpcore' ),
        //         'type' => \Elementor\Controls_Manager::SWITCHER,
        //         'label_on' => esc_html__( 'Yes', 'tpcore' ),
        //         'label_off' => esc_html__( 'No', 'tpcore' ),
        //         'return_value' => 'yes',
        //         'default' => 'yes',
        //         'separator' => 'before',
        //         'condition' => [
        //             'repeater_condition' => ['style_1', 'style_2', 'style_4']
        //         ],
        //     ]
        // );

        // $repeater->add_control(
        //     'tp_btn_btn_text',
        //     [
        //         'label' => esc_html__('Button Text', 'tpcore'),
        //         'type' => Controls_Manager::TEXT,
        //         'default' => esc_html__('Button Text', 'tpcore'),
        //         'title' => esc_html__('Enter button text', 'tpcore'),
        //         'label_block' => true,
        //         'condition' => [
        //             'tp_btn_link_switcher' => 'yes',
        //             'repeater_condition' => ['style_1', 'style_2', 'style_4']
                    
        //         ],
        //     ]
        // );

        // $repeater->add_control(
        //     'tp_btn_link_type',
        //     [
        //         'label' => esc_html__( 'Button Link Type', 'tpcore' ),
        //         'type' => \Elementor\Controls_Manager::SELECT,
        //         'options' => [
        //             '1' => 'Custom Link',
        //             '2' => 'Internal Page',
        //         ],
        //         'default' => '1',
        //         'condition' => [
        //             'tp_btn_link_switcher' => 'yes',
        //             'repeater_condition' => ['style_1', 'style_2', 'style_4']
        //         ],
        //     ]
        // );
        
        // $repeater->add_control(
        //     'tp_btn_link',
        //     [
        //         'label' => esc_html__( 'Button Link link', 'tpcore' ),
        //         'type' => \Elementor\Controls_Manager::URL,
        //         'dynamic' => [
        //             'active' => true,
        //         ],
        //         'placeholder' => esc_html__( 'https://your-link.com', 'tpcore' ),
        //         'show_external' => true,
        //         'default' => [
        //             'url' => '#',
        //             'is_external' => false,
        //             'nofollow' => false,
        //         ],
        //         'condition' => [
        //             'tp_btn_link_type' => '1',
        //             'tp_btn_link_switcher' => 'yes',
                    
        //         ],
        //     ]
        // );

        // $repeater->add_control(
        //     'tp_btn_page_link',
        //     [
        //         'label' => esc_html__( 'Select Button Link Page', 'tpcore' ),
        //         'type' => \Elementor\Controls_Manager::SELECT2,
        //         'label_block' => true,
        //         'options' => tp_get_all_pages(),
        //         'condition' => [
        //             'tp_btn_link_type' => '2',
        //             'tp_btn_link_switcher' => 'yes',
        //             'repeater_condition' => ['style_1', 'style_2', 'style_4']
        //         ],
        //     ]
        // );
        //button end

        $repeater->add_control(
            'tp_services_link_switcher',
            [
                'label' => esc_html__( 'Add Services link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'condition' => [
                    'repeater_condition' => ['style_2', 'style_4']
                ]
            ]
        );
        
        $repeater->add_control(
            'tp_service_btn_text', [
                'label' => esc_html__('Button Text', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('button', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_2', 'style_4']
                ]
           
            ]
        );

        $repeater->add_control(
            'tp_services_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_services_link_switcher' => 'yes',
                    'repeater_condition' => ['style_2', 'style_4']
                ]
            ]
        );

        $repeater->add_control(
            'tp_services_link',
            [
                'label' => esc_html__( 'Service Link link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'tpcore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'tp_services_link_type' => '1',
                    'tp_services_link_switcher' => 'yes',
                    'repeater_condition' => ['style_2', 'style_4']
                ]
            ]
        );
        $repeater->add_control(
            'tp_services_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_services_link_type' => '2',
                    'tp_services_link_switcher' => 'yes',
                    'repeater_condition' => ['style_2', 'style_4']
                ]
            ]
        );

        //Button end
        $this->add_control(
            'tp_features_list',
            [
                'label' => esc_html__('Features - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_features_title' => esc_html__('Discover', 'tpcore'),
                    ],
                    [
                        'tp_features_title' => esc_html__('Define', 'tpcore')
                    ],
                    [
                        'tp_features_title' => esc_html__('Develop', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_features_title }}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
                'default' => 'thumbnail',
                'exclude' => ['custom'],
                'separator' => 'none',
                'condition' => [
                    'tp_design_style' => ['layout-7']
                ]
            ]
        ); 

        $this->end_controls_section();

           // video
           $this->start_controls_section(
            'tp_video',
                [
                    'label' => esc_html__( 'Video', 'tpcore' ),
                    'condition' => [
                        'tp_design_style' => ['layout-8']
                    ]
                ]
            );

            $this->add_control(
                'video_url',
                [
                    'label'       => esc_html__( 'Video URL', 'tpcore' ),
                    'type'        => \Elementor\Controls_Manager::TEXTAREA,
                    'default'     => esc_html__( 'https://www.youtube.com/watch?v=EW4ZYb3mCZk', 'tpcore' ),
                    'label_block' => true,
                ]
            );

            $this->end_controls_section();

            $this->tp_section_title_render_controls('feature', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', ['layout-5']);

            $this->tp_button_render('service', 'Button', 'layout-5');  
            
            $this->tp_button_render('feature', 'Button 02', 'layout-5');
            


        // _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'tp-core'),
                'condition' => [
                    'tp_design_style' => ['layout-5']
                ]
            ]
        );

        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__( 'Choose Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        
        $this->end_controls_section();

        // Style Tab Start 
        //******************
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Title Style', 'cardzone' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'icon_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Icon Color', 'cardzone' ),
				'selectors' => [
					'{{WRAPPER}} .boxes4 i' => 'color: {{VALUE}}',
				],
                // 'separator' => 'before'
			]
		);

        $this->add_control(
			'icon_bg_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Icon Background', 'cardzone' ),
				'selectors' => [
					'{{WRAPPER}} .boxes4' => 'background-color: {{VALUE}}',
				],
                // 'separator' => 'before'
			]
		);

        $this->add_control(
			'title_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Title Color', 'cardzone' ),
				'selectors' => [
					'{{WRAPPER}} .main-heading' => 'color: {{VALUE}}',
				],
                'separator' => 'before'
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .main-heading',
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
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .description-style',
			]
		);

        $this->end_controls_section();

	}
 
    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('features_section', 'Background Style', '.tp-el-section'); 
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

<?php if ( $settings['tp_design_style']  == 'layout-2' ) : ?>

<?php foreach ($settings['tp_features_list'] as $key => $item) :

       
    // btn Link
    if ('2' == $item['tp_services_link_type']) {
        $link = get_permalink($item['tp_services_page_link']);
        $target = '_self';
        $rel = 'nofollow';
    } else {
        $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
        $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
        $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
    }


    if ( !empty($item['feature_img']['url']) ) {
        $tp_team_image_url = !empty($item['feature_img']['id']) ? wp_get_attachment_image_url( $item['feature_img']['id'], $settings['thumbnail_size_size']) : $item['feature_img']['url'];
        $tp_team_image_alt = get_post_meta($item["feature_img"]["id"], "_wp_attachment_image_alt", true);
    } 

    $item_active = $item['tp_active_switcher'] ? 'active' : '';

?>

<div class="tp-service-item wow tpfadeUp" <?php echo $item['tp_creative_anima_switcher'] ? "wow ".$item['tp_anima_type'] : NULL; ?> <?php echo $item['tp_creative_anima_switcher'] ? "data-wow-duration=".$item['tp_anima_dura']." "."data-wow-delay=".$item['tp_anima_delay']." " : NULL; ?>>
    <div class="tp-service-thumb-box p-relative">
    <?php if(!empty($tp_team_image_url)): ?>
        <div class="tp-service-thumb">
            <img src="<?php echo esc_url($tp_team_image_url) ?>" alt="<?php echo esc_attr($tp_team_image_alt); ?>">
        </div>
        <div class="tp-service-icon">
            <?php if($item['tp_features_icon_type'] == 'icon') : ?>
                <?php if (!empty($item['tp_features_icon']) || !empty($item['tp_features_selected_icon']['value'])) : ?>
                <span>
                    <?php tp_render_icon($item, 'tp_features_icon', 'tp_features_selected_icon'); ?>
                </span>
                <?php endif; ?>
                <?php elseif( $item['tp_features_icon_type'] == 'image' ) : ?>
                <?php if (!empty($item['tp_features_image']['url'])): ?>
                <span>
                    <img src="<?php echo $item['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                </span>
                <?php endif; ?>
                <?php else : ?>
                    <?php if (!empty($item['tp_features_icon_svg'])): ?>
                        <span>
                            <?php echo $item['tp_features_icon_svg']; ?>
                        </span>
                    <?php endif; ?>
            <?php endif; ?>

        </div>
    <?php endif; ?>
    </div>
    <div class="tp-service-content">
        <?php if(!empty($item['tp_features_title'])): ?>
            <h4 class="tp-service-title"><a href="<?php echo tp_kses($item['tp_features_url']); ?>"><?php echo tp_kses($item['tp_features_title']); ?></a></h4>
        <?php endif; ?>
        <?php if (!empty($item['tp_features_description' ])): ?>
            <p><?php echo tp_kses($item['tp_features_description']); ?></p>
        <?php endif; ?>

        <?php if(!empty($item['tp_services_link_switcher'])): ?>
            <div class="tp-service-link">
                <a class="tp-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>"> <?php echo tp_kses($item['tp_service_btn_text']); ?> <span class="bottom-line"></span></a>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php endforeach; ?>


<!--Style 3-->
<?php elseif ( $settings['tp_design_style']  == 'layout-3' ) : ?>

<div class="tp-feature-area tp-feature-style-2">
    <div class="container">
        <div class="row">
            
        <?php foreach ($settings['tp_features_list'] as $key => $item) :
            // Link
            // if ('2' == $item['tp_features_link_type']) {
            //     $link = get_permalink($item['tp_features_page_link']);
            //     $target = '_self';
            //     $rel = 'nofollow';
            // } else {
            //     $link = !empty($item['tp_features_link']['url']) ? $item['tp_features_link']['url'] : '';
            //     $target = !empty($item['tp_features_link']['is_external']) ? '_blank' : '';
            //     $rel = !empty($item['tp_features_link']['nofollow']) ? 'nofollow' : '';
            // }

            if ( !empty($item['feature_img']['url']) ) {
                $tp_team_image_url = !empty($item['feature_img']['id']) ? wp_get_attachment_image_url( $item['feature_img']['id'], $settings['thumbnail_size_size']) : $item['feature_img']['url'];
                $tp_team_image_alt = get_post_meta($item["feature_img"]["id"], "_wp_attachment_image_alt", true);
            } 

            $item_active = $item['tp_active_switcher'] ? 'active' : '';
        ?>

            <div class="col-md-6 mb-25">
                <div class="tp-feature-item <?php echo $item_active; ?>">
                    <div class="tp-feature-icon mb-40">

                        <?php if($item['tp_features_icon_type'] == 'icon') : ?>
                            <?php if (!empty($item['tp_features_icon']) || !empty($item['tp_features_selected_icon']['value'])) : ?>
                            <span>
                                <?php tp_render_icon($item, 'tp_features_icon', 'tp_features_selected_icon'); ?>
                            </span>
                            <?php endif; ?>
                            <?php elseif( $item['tp_features_icon_type'] == 'image' ) : ?>
                            <?php if (!empty($item['tp_features_image']['url'])): ?>
                            <span>
                                <img src="<?php echo $item['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            </span>
                            <?php endif; ?>
                            <?php else : ?>
                                <?php if (!empty($item['tp_features_icon_svg'])): ?>
                                    <span>
                                        <?php echo $item['tp_features_icon_svg']; ?>
                                    </span>
                                <?php endif; ?>
                        <?php endif; ?>

                    </div>
                    <div class="tp-feature-content">

                    <?php if(!empty($item['tp_features_title'])): ?>
                        <h4 class="tp-feature-title pb-10"><a href="<?php echo tp_kses($item['tp_features_url']); ?>"><?php echo tp_kses($item['tp_features_title']); ?></a></h4>
                    <?php endif; ?>

                    <?php if (!empty($item['tp_features_description' ])): ?>
                        <div class="tp-feature-text">
                            <p><?php echo tp_kses($item['tp_features_description']); ?></p>
                        </div>
                    <?php endif; ?>

                    </div>
                </div>
            </div>

            <?php endforeach; ?>
           
        </div>
    </div>
</div>



<!--Style 4-->
<?php elseif ( $settings['tp_design_style']  == 'layout-4' ) :
    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>


<div class="tp-service-2-area tp-service-style-3 tp-service-style-4">
    <div class="container">
        <div class="row">
            
        <?php foreach ($settings['tp_features_list'] as $key => $item) :
            
            // btn Link
            if ('2' == $item['tp_services_link_type']) {
                $link = get_permalink($item['tp_services_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
            }

            // thumbnail image
            if ( !empty($item['tp_features_main_image']['url']) ) {
                $tp_features_main_image = !empty($item['tp_features_main_image']['id']) ? wp_get_attachment_image_url( $item['tp_features_main_image']['id'], 'full' ) : $item['tp_features_main_image']['url'];
                $tp_features_main_image_alt = get_post_meta($item["tp_features_main_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $item_active = $item['tp_active_switcher'] ? 'active' : '';

        ?>

            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30 <?php echo $item['tp_creative_anima_switcher'] ? "wow ".$item['tp_anima_type'] : NULL; ?> " <?php echo $item['tp_creative_anima_switcher'] ? "data-wow-duration=".$item['tp_anima_dura']." "."data-wow-delay=".$item['tp_anima_delay']." " : NULL; ?>>
                <div class="tp-service-2-item <?php echo $item_active; ?> d-flex align-items-center">
                    <div class="tp-service-2-icon">

                        <?php if($item['tp_features_icon_type'] == 'icon') : ?>
                        <?php if (!empty($item['tp_features_icon']) || !empty($item['tp_features_selected_icon']['value'])) : ?>
                        <span>
                            <?php tp_render_icon($item, 'tp_features_icon', 'tp_features_selected_icon'); ?>
                        </span>
                        <?php endif; ?>
                        <?php elseif( $item['tp_features_icon_type'] == 'image' ) : ?>
                        <?php if (!empty($item['tp_features_image']['url'])): ?>
                        <span>
                            <img src="<?php echo $item['tp_features_image']['url']; ?>"
                                alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                        </span>
                        <?php endif; ?>
                        <?php else : ?>
                        <?php if (!empty($item['tp_features_icon_svg'])): ?>
                        <span>
                            <?php echo $item['tp_features_icon_svg']; ?>
                        </span>
                        <?php endif; ?>
                        <?php endif; ?>

                    </div>
                    <div class="tp-service-2-content">

                    <?php if(!empty($item['tp_features_title'])): ?>
                        <h4 class="tp-service-2-title"><a href="<?php echo tp_kses($item['tp_features_url']); ?>"><?php echo tp_kses($item['tp_features_title']); ?></a> </h4>
                    <?php endif; ?>
                   
                        <div class="tp-service-2-text">
                        <?php if(!empty($item['tp_features_description'])): ?>
                            <p><?php echo tp_kses($item['tp_features_description']); ?></p>
                        <?php endif; ?>


                        <a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>"
                                rel="<?php echo esc_attr($rel); ?>">
                                <?php echo tp_kses($item['tp_service_btn_text']); ?></a>

                            
                        </div>
                    </div>
                </div>
            </div>
           
        <?php endforeach; ?>

        </div>
    </div>
</div>


<!--Style 5-->
<?php elseif ( $settings['tp_design_style']  == 'layout-5' ) :
    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>


<div class="tp-contact-box">
    <?php if(!empty($settings['tp_features_title_five'])): ?>
        <h4 class="tp-service-details-title mb-15"><?php echo tp_kses($settings['tp_features_title_five']); ?></h4>
    <?php endif; ?>

    <?php foreach ($settings['tp_features_list'] as $key => $item) : ?>
        <div class="tp-contact-item d-flex align-items-center">
            <div class="tp-contact-icon">

                <?php if($item['tp_features_icon_type'] == 'icon') : ?>
                <?php if (!empty($item['tp_features_icon']) || !empty($item['tp_features_selected_icon']['value'])) : ?>
                <span>
                    <?php tp_render_icon($item, 'tp_features_icon', 'tp_features_selected_icon'); ?>
                </span>
                <?php endif; ?>
                <?php elseif( $item['tp_features_icon_type'] == 'image' ) : ?>
                <?php if (!empty($item['tp_features_image']['url'])): ?>
                <span>
                    <img src="<?php echo $item['tp_features_image']['url']; ?>"
                        alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                </span>
                <?php endif; ?>
                <?php else : ?>
                <?php if (!empty($item['tp_features_icon_svg'])): ?>
                <span>
                    <?php echo $item['tp_features_icon_svg']; ?>
                </span>
                <?php endif; ?>
                <?php endif; ?>

            </div>

            <?php if(!empty($item['tp_features_desc_st_four'])): ?>
                <div class="tp-contact-text">   
                    <span><?php echo tp_kses($item['tp_features_desc_st_four']); ?></span> 
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>


<!-- Style 6-->
<?php elseif ( $settings['tp_design_style']  == 'layout-6' ) :
    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>

<div class="tp-service-details-icon-wrap pb-30 d-flex flex-wrap justify-content-between">

    <?php foreach ($settings['tp_features_list'] as $key => $item) : 
         $info_active = $item['tp_active_info_switcher'] == 'yes' ? 'active' : 'no-act';     
    ?>
        <div class="tp-service-details-icon-box black-bg mb-30 d-flex align-items-center">
            <div class="tp-service-details-icon">

                <?php if($item['tp_features_icon_type'] == 'icon') : ?>
                    <?php if (!empty($item['tp_features_icon']) || !empty($item['tp_features_selected_icon']['value'])) : ?>
                    <span class="<?php echo esc_attr($info_active); ?>">
                        <?php tp_render_icon($item, 'tp_features_icon', 'tp_features_selected_icon'); ?>
                    </span>
                    <?php endif; ?>
                    <?php elseif( $item['tp_features_icon_type'] == 'image' ) : ?>
                    <?php if (!empty($item['tp_features_image']['url'])): ?>
                    <span>
                        <img src="<?php echo $item['tp_features_image']['url']; ?>"
                            alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                    </span>
                    <?php endif; ?>
                    <?php else : ?>
                    <?php if (!empty($item['tp_features_icon_svg'])): ?>
                    <span>
                        <?php echo $item['tp_features_icon_svg']; ?>
                    </span>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
            <div class="tp-service-details-icon-text">

            <?php if(!empty($item['tp_features_info_title'])): ?>
                <h5><?php echo tp_kses($item['tp_features_info_title']); ?></h5>
            <?php endif; ?>

            <?php if(!empty($item['tp_features_desc_st_four'])): ?>
                <p><?php echo tp_kses($item['tp_features_desc_st_four']); ?></p>
            <?php endif; ?>

            </div>
        </div>
    <?php endforeach; ?>
    
</div>



<!-- Style 7-->
<?php elseif ( $settings['tp_design_style']  == 'layout-7' ) :
?>

<div class="tp-instagram-wrap d-flex justify-content-between">

    <?php foreach ($settings['tp_features_list'] as $key => $item) :   

        if ( !empty($item['feature_img']['url']) ) {
            $tp_team_image_url = !empty($item['feature_img']['id']) ? wp_get_attachment_image_url( $item['feature_img']['id'], $settings['thumbnail_size_size']) : $item['feature_img']['url'];
            $tp_team_image_alt = get_post_meta($item["feature_img"]["id"], "_wp_attachment_image_alt", true);
        } 

    ?>

    <div class="tp-instagram-thumb p-relative">
        <img src="<?php echo esc_url($tp_team_image_url); ?>" alt="<?php echo esc_attr($tp_team_image_alt); ?>">
        <div class="tp-instagram-play">
            <a href="<?php echo tp_kses($item['tp_features_title']); ?>">
                <?php if($item['tp_features_icon_type'] == 'icon') : ?>
                    <?php if (!empty($item['tp_features_icon']) || !empty($item['tp_features_selected_icon']['value'])) : ?>
                    <span class="<?php echo esc_attr($info_active); ?>">
                        <?php tp_render_icon($item, 'tp_features_icon', 'tp_features_selected_icon'); ?>
                    </span>
                    <?php endif; ?>
                    <?php elseif( $item['tp_features_icon_type'] == 'image' ) : ?>
                    <?php if (!empty($item['tp_features_image']['url'])): ?>
                    <span>
                        <img src="<?php echo $item['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                    </span>
                    <?php endif; ?>
                    <?php else : ?>
                    <?php if (!empty($item['tp_features_icon_svg'])): ?>
                    <span>
                        <?php echo $item['tp_features_icon_svg']; ?>
                    </span>
                    <?php endif; ?>
                <?php endif; ?> 
            </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>


<!--Default Style-->
<?php else: ?>

    <script>
        jQuery(document).ready(function($) {
            $(".top__ratedwrapper").owlCarousel({
                loop: true,
                margin: 0,
                smartSpeed: 500,
                autoplayTimeout: 1000,
                autoplay: false,
                nav: false,
                dots: true,
                responsiveClass: true,
                navText: [
                    '<i class="fas fa-chevron-left"></i>',
                    '<i class="fas fa-chevron-right"></i>',
                ],
                responsive: {
                    0: {
                        items: 1,
                    },
                    500: {
                        items: 2,
                    },
                    767: {
                        items: 3,
                    },
                    991: {
                        items: 3,
                    },
                    1199: {
                        items: 3,
                    },
                    1399: {
                        items: 4,
                    },
                },
            });
        })
    </script>

<section class="top__reted">
   <div class="top__ratedwrapper owl-theme owl-carousel">

    <?php foreach ($settings['tp_features_list'] as $key => $item) :
        // btn Link
        if ('2' == $item['tp_services_link_type']) {
            $link = get_permalink($item['tp_services_page_link']);
            $target = '_self';
            $rel = 'nofollow';
        } else {
            $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
            $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
            $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
    }

        // if ('2' == $item['tp_btn_link_type']) {
        //     $link = get_permalink($item['tp_btn_page_link']);
        //     $target = '_self';
        //     $rel = 'nofollow';
        // } else {
        //     $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
        //     $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
        //     $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
        // }

        $item_active = $item['tp_active_switcher'] ? 'active' : '';
    ?>
        <div class="top__items suctom__space bgwhite round16 tp-el-section">
            <div class="icon m-auto d-flex align-items-center justify-content-center boxes4 round50">
                <?php if($item['tp_features_icon_type'] == 'icon') : ?>
                <?php if (!empty($item['tp_features_icon']) || !empty($item['tp_features_selected_icon']['value'])) : ?>
                    <?php tp_render_icon($item, 'tp_features_icon', 'tp_features_selected_icon'); ?>
                <?php endif; ?>
                <?php elseif( $item['tp_features_icon_type'] == 'image' ) : ?>
                <?php if (!empty($item['tp_features_image']['url'])): ?>
                    <img src="<?php echo $item['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                <?php endif; ?>
                <?php else : ?>
                    <?php if (!empty($item['tp_features_icon_svg'])): ?>
                        <?php echo $item['tp_features_icon_svg']; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="content text-center mt-24">
                <?php if(!empty($item['tp_features_title'])): ?>
                    <h3 class="mb-16">
                        <a href="<?php echo tp_kses($item['tp_features_url']); ?>" class="title main-heading">
                            <?php echo tp_kses($item['tp_features_title' ]); ?>
                        </a>
                    </h3>
                <?php endif; ?>
                <?php if (!empty($item['tp_features_description' ])): ?>
                    <p class="fz-16 fw-400 inter ptext2 description-style mb-30">
                        <?php echo tp_kses($item['tp_features_description']); ?>
                    </p>
                <?php endif; ?>
                <?php if(!empty($item['tp_features_url'])): ?>
                    <a href="<?php echo tp_kses($item['tp_features_url']); ?>" class="arrow m-auto boxes-icon round50 d-flex align-items-center justify-content-center">
                        <i class="material-symbols-outlined">
                            chevron_right
                        </i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
      <?php endforeach; ?>
    </div>
</section>


<?php endif;
	}
}

$widgets_manager->register( new TP_Features() );