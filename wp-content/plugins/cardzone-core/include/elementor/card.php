<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Card extends Widget_Base {

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
		return 'tp-card';
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
		return __( 'Card', 'cardzonecore' );
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
		return [ 'cardzonecore' ];
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
        // $this->style_tab_content();
    }   

	protected function register_controls_section() {

        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'cardzonecore'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'cardzonecore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'cardzonecore'),
                    'layout-2' => esc_html__('Layout 2', 'cardzonecore'),
                    'layout-3' => esc_html__('Layout 3', 'cardzonecore'),
                    'layout-4' => esc_html__('Layout 4', 'cardzonecore'),
                    'layout-5' => esc_html__('Layout 5', 'cardzonecore'),
                    'layout-6' => esc_html__('Layout 6', 'cardzonecore')
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // fact group
        $this->start_controls_section(
            'tp_fact',
            [
                'label' => esc_html__('Fact List', 'cardzonecore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'cardzonecore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_fact_number', [
                'label' => esc_html__('Number', 'cardzonecore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('17', 'cardzonecore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_fact_symbol', [
                'label' => esc_html__('Symbol', 'cardzonecore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('K', 'cardzonecore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_fact_title', [
                'label' => esc_html__('Title', 'cardzonecore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Satisficed Client Review', 'cardzonecore'),
                'label_block' => true,
            ]
        );


        //Fact Icon
        $this->add_control(
            'tp_features_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'cardzonecore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'cardzonecore'),
                    'icon' => esc_html__('Icon', 'cardzonecore'),
                    'svg' => esc_html__('SVG', 'cardzonecore'),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2']
                ]
            ]
        );

        $this->add_control(
            'tp_features_image',
            [
                'label' => esc_html__('Upload Icon Image', 'cardzonecore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_features_icon_type' => 'image'
                ],
                // 'condition' => [
                //     'tp_design_style' => ['layout-1']
                // ]
                
            ]
        );

        $this->add_control(
            'tp_features_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'cardzonecore'),
                'condition' => [
                    'tp_features_icon_type' => 'svg'
                ],
                // 'condition' => [
                //     'tp_design_style' => ['layout-1']
                // ]
                
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
                    ],
                    // 'condition' => [
                    //     'tp_design_style' => ['layout-1']
                    // ]
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
                    ],
                    // 'condition' => [
                    //     'tp_design_style' => ['layout-1']
                    // ]
                ]
            );
        }


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

        $this->add_control(
			'title_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Title Color', 'cardzone' ),
				'selectors' => [
					'{{WRAPPER}} .fact-title' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .fact-title',
			]
		);


        $this->add_control(
			'number_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Number Color', 'cardzone' ),
				'selectors' => [
					'{{WRAPPER}} .fact-number' => 'color: {{VALUE}}',
				],
                'separator' => 'before'
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography_number',
				'selector' => '{{WRAPPER}} .fact-number',
			]
		);

        $this->add_control(
			'symbol_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Symbol Color', 'cardzone' ),
				'selectors' => [
					'{{WRAPPER}} .symbol-style' => 'color: {{VALUE}}',
				],
                'separator' => 'before'
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography_symbol',
				'selector' => '{{WRAPPER}} .symbol-style',
			]
		);

        
        $this->add_control(
			'icon_bg_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Icon Background Color', 'cardzone' ),
				'selectors' => [
					'{{WRAPPER}} .icon-bg' => 'background: {{VALUE}}',
				],
                'separator' => 'before'
			]
		);

        $this->end_controls_section();


        // section column
        // $this->tp_columns('col', ['layout-1', 'layout-2', 'layout-5']);

	}

    

    // style_tab_content
    // protected function style_tab_content(){
    //     $this->tp_section_style_controls('fact_section', 'Section - Style', '.tp-el-section');
    // }

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

        // $query_args = TP_Helper::get_query_args('post', 'category', $this->get_settings());

        // // The Query
        // $query = new \WP_Query($query_args);


        // $filter_list = $settings['category'];


        // $args = array(
        //     'post_type' => 'tp-cards',       // Custom post type name
        //     'posts_per_page' => 1,        // Number of posts to display
        //     'orderby' => 'date',          // Order by date
        //     'order' => 'DESC',            // Sort in descending order
        // );
        // $query = new WP_Query($args);


		// ?>

<?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>


    <div class="we__counting">
        <div class="counter__items odometer-item wow fadeInDown">
            <div class="counter__content d-flex align-items-center">

                <div class="iconbox d-flex align-items-center justify-content-center round50 icon-bg bgwhite">
                    <?php if($settings['tp_features_icon_type'] == 'icon') : ?>
                        <?php if (!empty($settings['tp_features_icon']) || !empty($settings['tp_features_selected_icon']['value'])) : ?>
                            <?php tp_render_icon($settings, 'tp_features_icon', 'tp_features_selected_icon'); ?>
                        <?php endif; ?>
                    <?php elseif( $settings['tp_features_icon_type'] == 'image' ) : ?>
                        <?php if (!empty($settings['tp_features_image']['url'])): ?>
                            <img class="light" src="<?php echo $settings['tp_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                        <?php endif; ?>
                    <?php else : ?>
                        <?php if (!empty($settings['tp_features_icon_svg'])): ?>
                            <?php echo $settings['tp_features_icon_svg']; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <div class="content">
                        <div class="d-flex mb-1 align-items-center">
                        <span class="odometer base fact-number" data-odometer-final="<?php echo tp_kses($settings['tp_fact_number']); ?>">
                            0
                        </span>
                        <span class="added base symbol-style">
                            <?php echo tp_kses($settings['tp_fact_symbol']); ?>
                        </span>
                        </div>

                        <?php if(!empty($settings['tp_fact_title'])) : ?>
                            <span class="fz-16 fw-400 ptext2 fact-title inter">
                                <?php echo tp_kses($settings['tp_fact_title']); ?>
                            </span>
                        <?php endif; ?>
                </div>
            </div>
        </div>
    </div>



    <div class="tp-funfact-2-item-box d-none">
        <ul>
            <li>
                <div class="tp-funfact-2-item  text-center text-md-start">
                    <h5 class="tp-funfact-2-title"><i class="purecounter" data-purecounter-duration="1" data-purecounter-end="<?php echo tp_kses($settings['tp_fact_number']); ?>">0</i>k</h5>
                    <?php if(!empty($settings['tp_fact_title'])): ?>
                        <span><?php echo tp_kses($settings['tp_fact_title']); ?></span>
                    <?php endif; ?>
                </div>
            </li>
        </ul>
    </div>


<!-- Style 3-->
<?php elseif ( $settings['tp_design_style']  == 'layout-3' ): ?>

    <div class="tp-funfact-area tp-funfact-style-2">
        <div class="tp-funfact-item p-relative">
            <h6 class="tp-funfact-number"><i class="purecounter" data-purecounter-duration="1" data-purecounter-end="<?php echo tp_kses($settings['tp_fact_number']); ?>">0</i>k</h6>
            <?php if(!empty($settings['tp_fact_title'])): ?>
                <span><?php echo tp_kses($settings['tp_fact_title']); ?></span>
            <?php endif; ?>
        </div>
    </div>



<!--Default style-->
<?php else : ?>


<!-- Card Review Here -->
<section class="popular__card bgadd ralt pt-120 pb-120">
   <div class="container">
      <div class="row justify-content-center mb-40">
         <div class="col-lg-6 col-md-9">
            <div class="section__title text-center">
               <h4 class="sub ralt base mb-16 wow fadeInDown">
                  Most Popular Cards
               </h4>
               <h2 class="title wow fadeInUp">
                  Top Credit Cards on Our Marketplace
               </h2>
               <p class="ptext2 fz-16 fw-400 inter wow fadeInDown">
                  Looking for a credit card that's trusted and highly rated? Look no further than our Most Popular Cards section
               </p>
            </div>
         </div>
      </div>
      <div class="popular__tabs">
         <div class="nav nav-tabs mb-60" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
               <span class="icon">
                  <i class="material-symbols-outlined">
                     new_releases
                  </i>
               </span>
               <span>
                  Best of 2023
               </span>
            </button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
               <span class="icon">
                  <i class="material-symbols-outlined">
                     bar_chart_4_bars
                  </i>
               </span>
               <span>
                  0% ARP
               </span>
            </button>
            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
               <span class="icon">
                  <i class="material-symbols-outlined">
                     local_atm
                  </i>
               </span>
               <span>
                  Cash Back
               </span>
            </button>
            <button class="nav-link" id="nav-contact-tab1" data-bs-toggle="tab" data-bs-target="#nav-contact1" type="button" role="tab" aria-controls="nav-contact1" aria-selected="false">
               <span class="icon">
                  <i class="material-symbols-outlined">
                     bluetooth_drive
                  </i>
               </span>
               <span>
                  Travels
               </span>
            </button>
         </div>
         <div class="tab-content" id="nav-tabContent">

            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
               <div class="row g-4">

       


               <?php
// WP_Query arguments
$args = array(
    'post_type' => 'tp-cards',   // Custom post type name
    'posts_per_page' => 10,      // Number of posts to display
    'orderby' => 'date',         // Order by date
    'order' => 'DESC',           // Sort in descending order
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        // Get post thumbnail URL
        $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
        // Get post title
        $post_title = get_the_title();
        // Get post content
        $post_content = get_the_content();
        // Get post permalink
        $post_permalink = get_permalink();
        ?>

        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6">
            <div class="popular__items round16">
                <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $post_title ); ?>" class="w-100">
                <div class="content text-center">
                    <h4 class="title mb-16"><?php echo esc_html( $post_title ); ?></h4>
                    <p class="fz-16 mb-30 inter ptext"><?php echo esc_html( $post_content ); ?></p>
                    <a href="<?php echo esc_url( $post_permalink ); ?>" class="cmn--btn gap-2 outline__btn d-flex align-items-center">
                        <span>View Details</span>
                        <span class="icon"><i class="material-symbols-outlined">arrow_right_alt</i></span>
                    </a>
                </div>
            </div>
        </div>

        <?php
    }
    // Restore original Post Data
    wp_reset_postdata();
} else {
    // No posts found
    echo 'No posts found.';
}
?>



    
                  
               </div>
            </div>

            
            
           
         </div>
      </div>
   </div>
</section>
<!-- Card Review End -->



    

<?php endif; 
        
	}
}

$widgets_manager->register( new TP_Card() );

