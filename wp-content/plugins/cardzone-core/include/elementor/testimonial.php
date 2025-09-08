<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Testimonial extends Widget_Base {

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
		return 'tp-testimonial';
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
		return __( 'Testimonial', 'tpcore' );
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
                    'layout-3' => esc_html__('Layout 3', 'tpcore')
                    
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // Review group
        $this->start_controls_section(
            'review_list',
            [
                'label' => esc_html__( 'Review List', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
                    'style_3' => __( 'Style 3', 'tpcore' )
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        // rating
        $repeater->add_control(
            'tp_testi_rating',
            [
                'label' => esc_html__('Select Rating Count', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__('Single Star', 'tpcore'),
                    '2' => esc_html__('2 Star', 'tpcore'),
                    '3' => esc_html__('3 Star', 'tpcore'),
                    '4' => esc_html__('4 Star', 'tpcore'),
                    '5' => esc_html__('5 Star', 'tpcore'),
                ],
                'default' => '5',
                'condition' => [
                    'repeater_condition' => ['style_1']
                ]
            ]
        );

        $repeater->add_control(
            'reviewer_image',
            [
                'label' => esc_html__( 'Reviewer Image', 'tpcore' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_3', 'style_4', 'style_5', 'style_6']
                ]
            ]
        );
        $repeater->add_control(
            'review_content',
            [
                'label' => esc_html__( 'Review Content', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'Aklima The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections Bonorum et Malorum original.',
                'placeholder' => esc_html__( 'Type your review content here', 'tpcore' ),
            ]
        );
        $repeater->add_control(
            'reviewer_name', [
                'label' => esc_html__( 'Reviewer Name', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Rasalina William' , 'tpcore' ),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2', 'style_3', 'style_5', 'style_7']
                ]
            ]
        );

        $repeater->add_control(
            'reviewer_title', [
                'label' => esc_html__( 'Reviewer Designation', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'CEO at YES Germany' , 'tpcore' ),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2', 'style_3']
                ]
            ]
        );

        $this->add_control(
            'reviews_list',
            [
                'label' => esc_html__( 'Review List', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'tpcore' ),
                        'reviewer_title' => esc_html__( 'CEO at YES Germany', 'tpcore' ),
                        'review_content' => esc_html__( 'Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'tpcore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'tpcore' ),
                        'reviewer_title' => esc_html__( 'CEO at YES Germany', 'tpcore' ),
                        'review_content' => esc_html__( 'Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'tpcore' ),
                    ],
                    [
                        'reviewer_name' => esc_html__( 'Rasalina William', 'tpcore' ),
                        'reviewer_title' => esc_html__( 'CEO at YES Germany', 'tpcore' ),
                        'review_content' => esc_html__( 'Construction can be defined as the art of building something. These construction quotes will put into perspective the fact that construction can be', 'tpcore' ),
                    ],

                ],
                'title_field' => '{{{ reviewer_name }}}',
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
                    'tp_design_style' => ['layout-1', 'layout-2']
                ]
            ]
        ); 

        $this->end_controls_section();

        
        // _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'tp-core'),
                'condition' => [
                    'tp_design_style' => 'layout-4'
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

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('testi_section', 'Section - Style', '.tp-el-section');
        $this->start_controls_section(
            'tp_additional_styling',
            [
                'label' => esc_html__('Additional Style', 'tp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //1
        $this->add_control(
			'client_name_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Client Name Color', 'cardzone' ),
				'selectors' => [
					'{{WRAPPER}} .client_name' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography_client',
				'selector' => '{{WRAPPER}} .client_designation',
			]
		);

        //2
        $this->add_control(
			'client_designation_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Client Designation Color', 'cardzone' ),
				'selectors' => [
					'{{WRAPPER}} .client_designation' => 'color: {{VALUE}}',
				],
                'separator' => 'before'
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography_designation',
				'selector' => '{{WRAPPER}} .client_designation',
			]
		);

        //3
        $this->add_control(
            'client_description_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => esc_html__( 'Client Text Color', 'cardzone' ),
                'selectors' => [
                    '{{WRAPPER}} .client_text' => 'color: {{VALUE}}',
                ],
                'separator' => 'before'
            ]
        );

          //Dot color
          $this->add_control(
            'client_dot_color',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => esc_html__( 'Client Text Color', 'cardzone' ),
                'selectors' => [
                    '{{WRAPPER}} .slider_dot' => 'background: {{VALUE}}',
                ],
                'separator' => 'before'
            ]
        );
        $this->end_controls_section();
        //Style end



            // tp_btn_button_group
            $this->start_controls_section(
                'tp_btn_button_group',
                [
                    'label' => esc_html__('Button', 'tpcore'),
                    'condition' => [
                        'tp_design_style' => ['layout-4']
                    ]
                ]
            );
    
            $this->add_control(
                'tp_btn_button_show',
                [
                    'label' => esc_html__( 'Show Button', 'tpcore' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'tpcore' ),
                    'label_off' => esc_html__( 'Hide', 'tpcore' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );
    
            $this->add_control(
                'tp_btn_text',
                [
                    'label' => esc_html__('Button Text', 'tpcore'),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__('Button Text', 'tpcore'),
                    'title' => esc_html__('Enter button text', 'tpcore'),
                    'label_block' => true,
                    'condition' => [
                        'tp_btn_button_show' => 'yes'
                    ],
                ]
            );
            $this->add_control(
                'tp_btn_link_type',
                [
                    'label' => esc_html__('Button Link Type', 'tpcore'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        '1' => 'Custom Link',
                        '2' => 'Internal Page',
                    ],
                    'default' => '1',
                    'label_block' => true,
                    'condition' => [
                        'tp_btn_button_show' => 'yes'
                    ],
                ]
            );
    
            $this->add_control(
                'tp_btn_link',
                [
                    'label' => esc_html__('Button link', 'tpcore'),
                    'type' => Controls_Manager::URL,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'placeholder' => esc_html__('https://your-link.com', 'tpcore'),
                    'show_external' => false,
                    'default' => [
                        'url' => '#',
                        'is_external' => true,
                        'nofollow' => true,
                        'custom_attributes' => '',
                    ],
                    'condition' => [
                        'tp_btn_link_type' => '1',
                        'tp_btn_button_show' => 'yes'
                    ],
                    'label_block' => true,
                ]
            );
            $this->add_control(
                'tp_btn_page_link',
                [
                    'label' => esc_html__('Select Button Page', 'tpcore'),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'options' => tp_get_all_pages(),
                    'condition' => [
                        'tp_btn_link_type' => '2',
                        'tp_btn_button_show' => 'yes'
                    ]
                ]
            );
    
            $this->add_responsive_control(
                'tp_align',
                [
                    'label' => esc_html__('Alignment', 'tpcore'),
                    'type' => Controls_Manager::CHOOSE,
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
                    ],
                    'default' => 'center',
                    'toggle' => false,
                    'selectors' => [
                        '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                    ]
                ]
            ); 
            $this->end_controls_section();

             
        // shape
        $this->start_controls_section(
            'tp_shape',
                [
                    'label' => esc_html__( 'Shape Section', 'tpcore' ),
                    'condition' => [
                        'tp_design_style' => 'layout-4',
                    ]
                ]
            );
    
            $this->add_control(
            'tp_shape_switch',
                [
                    'label'        => esc_html__( 'Shape On/Off', 'tpcore' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Show', 'tpcore' ),
                    'label_off'    => esc_html__( 'Hide', 'tpcore' ),
                    'return_value' => 'yes',
                    'default'      => '0',
                ]
            );
    
            $this->add_control(
                'tp_shape_image_1',
                [
                    'label' => esc_html__( 'Choose Shape Image 1', 'tp-core' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'tp_shape_switch' => 'yes',
                    ]
                ]
            );
    
            $this->add_control(
                'tp_shape_image_2',
                [
                    'label' => esc_html__( 'Choose Shape Image 2', 'tp-core' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'tp_shape_switch' => 'yes',
                    ]
                ]
            );
    
            $this->add_control(
                'tp_shape_image_3',
                [
                    'label' => esc_html__( 'Choose Shape Image 3', 'tp-core' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'tp_shape_switch' => 'yes',
                    ]
                ]
            );
    
            $this->add_control(
                'tp_shape_image_4',
                [
                    'label' => esc_html__( 'Choose Shape Image 4', 'tp-core' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'tp_shape_switch' => 'yes',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                    'exclude' => ['custom'],
                    'condition' => [
                        'tp_shape_switch' => 'yes',
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
	protected function render() {
		$settings = $this->get_settings_for_display();
	?>

<script>
jQuery(document).ready(function($) {

    $(".testimonial__slider").owlCarousel({
		loop: true,
		margin: 10,
		smartSpeed: 2500,
		autoplayTimeout: 2500,
		autoplay: false,
		nav: true,
		dots: false,
		responsiveClass: true,
		navText: [
			'<i class="fas fa-chevron-left"></i>',
			'<i class="fas fa-chevron-right"></i>',
		],
		responsive: {
			0: {
				items: 1,
			},
			575: {
				items: 1,
			},
			767: {
				items: 1,
			},
			991: {
				items: 1,
			},
			1199: {
				items: 1,
			},
			1499: {
				items: 1,
			},
			1999: {
				items: 1,
			},
		},
	});

    $(".testimonial__wraptwo").owlCarousel({
		loop: true,
		margin: 24,
		smartSpeed: 2500,
		autoplayTimeout: 2500,
		autoplay: false,
		nav: false,
		dots: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1,
			},
			575: {
				items: 1,
			},
			767: {
				items: 2,
			},
			991: {
				items: 2,
			},
			1199: {
				items: 3,
			},
			1499: {
				items: 3,
			},
			1999: {
				items: 3,
			},
		},
	});

    })

    </script>

<!--testimonial style 2 -->
<?php if ( $settings['tp_design_style']  == 'layout-2' ):

    $this->add_render_attribute('title_args', 'class', 'tp-section-title pb-50');
    // Link
        if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn theme-bg');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn theme-bg');
        }
    }

?>

<div class="testimonial__wraptwo owl-theme owl-carousel">
        <?php foreach ($settings['reviews_list'] as $index => $item) :
            if ( !empty($item['reviewer_image']['url']) ) {
                $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

        <div class="testimonial__items ralt bgadd round16">
            <div class="quote round50 m-auto d-flex align-items-center justify-content-center">

                <i class="material-symbols-outlined base">
                    format_quote
                </i>

            </div>
            <div class="ratting mb-16 mt-24 justify-content-center d-flex align-items-center gap-2">

                <?php
                    $tp_rating = $item['tp_testi_rating'];
                    $tp_rating_minus = 5-$item['tp_testi_rating'];
                    for($i=1; $i<=$tp_rating; $i++) :
                    ?>
                    <i class="fa-solid fa-star"></i>
                    <?php endfor; ?>
                    <?php
                    for($i=1; $i<=$tp_rating_minus; $i++) :
                    ?>
                    <i class="fa-regular fa-star"></i>
                <?php endfor; ?>

            </div>
            <?php if(!empty($item['review_content'])): ?>
                <p class="ptext3 inter fz-20 text-center fw-400 mb-30">
                    <?php echo tp_kses($item['review_content']); ?>
                </p>
            <?php endif; ?>
            <div class="d-flex justify-content-center align-items-center gap-3">
            <?php if(!empty($tp_reviewer_image)): ?>
               <div class="thumb">
                    <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_attr( $tp_reviewer_image_alt); ?>">
               </div>
            <?php endif; ?>
               <div class="cont">
                <?php if(!empty($item['reviewer_name'])): ?>
                    <span class="fz-20 fw-600 inter ptext">
                        <?php echo tp_kses($item['reviewer_name']); ?>
                    </span>
                <?php endif; ?>
                <?php if(!empty($item['reviewer_title'])): ?>
                    <span class="fz-16 d-block ptext fw-400 inter">
                        <?php echo tp_kses($item['reviewer_title']); ?>
                    </span>
                <?php endif; ?>
               </div>
            </div>
        </div>
         <?php endforeach; ?>
      </div>



    <!--testimonial style 3 -->
<?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
    $this->add_render_attribute('title_args', 'class', 'tp-section-title pb-50');
    // Link
        if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn theme-bg');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn theme-bg');
        }
    }

?>


<div class="tp-testimonial-3-area tp-testimonial-3-wrap fix pb-80">
    <div class="container">
       
        <div class="tp-testimonial-wrapper p-relative">
            <div class="tp-testimonial-3-arrow-box d-none d-xxl-block">
            <button class="testimonial-prev">
                <svg width="91" height="24" viewBox="0 0 91 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.939339 13.0607C0.353554 12.4749 0.353554 11.5251 0.939339 10.9393L10.4853 1.39339C11.0711 0.807604 12.0208 0.807605 12.6066 1.39339C13.1924 1.97918 13.1924 2.92893 12.6066 3.51471L4.12132 12L12.6066 20.4853C13.1924 21.0711 13.1924 22.0208 12.6066 22.6066C12.0208 23.1924 11.0711 23.1924 10.4853 22.6066L0.939339 13.0607ZM91 13.5L2 13.5L2 10.5L91 10.5L91 13.5Z" fill="currentcolor"/>
                </svg>                  
            </button>
            <button class="testimonial-next">
                <svg width="91" height="24" viewBox="0 0 91 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M90.0607 13.0607C90.6464 12.4749 90.6464 11.5251 90.0607 10.9393L80.5147 1.39339C79.9289 0.807604 78.9792 0.807605 78.3934 1.39339C77.8076 1.97918 77.8076 2.92893 78.3934 3.51471L86.8787 12L78.3934 20.4853C77.8076 21.0711 77.8076 22.0208 78.3934 22.6066C78.9792 23.1924 79.9289 23.1924 80.5147 22.6066L90.0607 13.0607ZM1.31134e-07 13.5L89 13.5L89 10.5L-1.31134e-07 10.5L1.31134e-07 13.5Z" fill="currentcolor"/>
                </svg>                  
            </button>
            </div>
            <div class="swiper-container tp-testimonial-3-active">

                <div class="swiper-wrapper">

                    <?php foreach ($settings['reviews_list'] as $index => $item) :
                        if ( !empty($item['reviewer_image']['url']) ) {
                            $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                            $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                    ?>

                    <div class="swiper-slide">
                        <div class="tp-testimonial-3-item">
                            <div class="tp-testimonial-3-author-thumb-box p-relative d-flex align-items-center mb-30">
                            <?php if(!empty($tp_reviewer_image)): ?>
                                <div class="tp-testimonial-3-author-thumb">
                                    <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_attr( $tp_reviewer_image_alt); ?>">
                                </div>
                            <?php endif; ?>          
                            <div class="tp-testimonial-3-author-info">
                                <h4 class="tp-testimonial-3-title">Esther Howard</h4>
                                <span>Marketing Coordinator</span>
                            </div>
                            </div>
                            <div class="tp-testimonial-3-content p-relative">
                            <div class="tp-testimonial-3-text">
                                <p>loborti viverra laoreet matti ullamcorper posuere viverra Aliquam eros justo, posuere lobortis non, Aliquam eros justo, posuere loborti viverra  posuere lobortis laorematullamcorpeposuere viverra loborti viverra laoreet  ullamcorper  viverra  posuere lobo</p>
                            </div>
                            <div class="tp-testimonial-3-quot">
                                <span>
                                    <svg width="25" height="19" viewBox="0 0 25 19" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                        d="M0 0.125V9.5H6.25C6.25 12.9453 3.44844 15.75 0 15.75V18.875C5.16953 18.875 9.375 14.6695 9.375 9.5V0.125H0ZM15.625 0.125V9.5H21.875C21.875 12.9453 19.0734 15.75 15.625 15.75V18.875C20.7945 18.875 25 14.6695 25 9.5V0.125H15.625Z"
                                        fill="currentcolor"/>
                                    </svg>
                                </span>
                            </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div> 
    </div>
</div>



<!--Default Style-->
<?php else:
    $this->add_render_attribute('title_args', 'class', 'tp-section-title tp-split-text tp-split-in-right');

    // thumbnail
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
?>

    <div class="testimonial__content">
        <div class="testimonial__slider owl-theme owl-carousel wow fadeInUp">
        <?php foreach ($settings['reviews_list'] as $index => $item) :
            if ( !empty($item['reviewer_image']['url']) ) {
                $tp_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url( $item['reviewer_image']['id'], $settings['thumbnail_size_size']) : $item['reviewer_image']['url'];
                $tp_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
            }
        ?>

            <div class="testimonial__items ralt bgadd round16 tp-el-section">
                <div class="ratting mb-16 d-flex align-items-center gap-2">
                    <?php
                        $tp_rating = $item['tp_testi_rating'];
                        $tp_rating_minus = 5-$item['tp_testi_rating'];
                        for($i=1; $i<=$tp_rating; $i++) :
                        ?>
                        <i class="fa-solid fa-star"></i>
                        <?php endfor; ?>
                        <?php
                        for($i=1; $i<=$tp_rating_minus; $i++) :
                        ?>
                        <i class="fa-regular fa-star"></i>
                    <?php endfor; ?>
                </div>
                <p class="ptext3 inter fz-18 fw-400 mb-30 client_text">
                    <?php echo tp_kses($item['review_content']); ?>
                </p>
                <div class="d-flex align-items-center gap-3">
                <div class="thumb">
                    <img src="<?php echo esc_url($tp_reviewer_image); ?>" alt="<?php echo esc_attr( $tp_reviewer_image_alt); ?>"> 
                </div>
                <div class="cont">
                    <span class="fz-20 fw-600 inter ptext client_name">
                        <?php echo tp_kses($item['reviewer_name']); ?>
                    </span>
                    <span class="fz-16 d-block ptext fw-400 inter client_designation">
                        <?php echo tp_kses($item['reviewer_title']); ?>
                    </span>
                </div>
                </div>
            </div>

        <?php endforeach; ?>

        </div>
    </div>

<?php endif; 
	}
}

$widgets_manager->register( new TP_Testimonial() );