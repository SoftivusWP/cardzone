<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_CTA extends Widget_Base {

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
		return 'tp-cta';
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
		return __( 'CTA', 'tpcore' );
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


	// controls file 
	protected function register_controls_section(){
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
                    'layout-2' => esc_html__('Layout 2', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // title/content
        $this->tp_section_title_render_controls('cta', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', ['layout-1', 'layout-2']);

        $this->tp_button_render('about', 'Button', ['layout-3']);  

        // subscriber form
        $this->start_controls_section(
            'tp_subs_sec',
            [
                'label' => esc_html__('Subscriber Section', 'tp-core'),
                'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2']
                ]
            ]
        );
        
        $this->add_control(
        'form_shortcode',
            [
            'label'   => esc_html__( 'Newsletter Shortcode', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( '[enter shortcode here]', 'tpcore' ),
            'label_block' => true,
            ]
        );

        $this->end_controls_section();

        
        
        // shape
        $this->start_controls_section(
        'tp_shape',
            [
                'label' => esc_html__( 'Shape Section', 'tpcore' ),
                'condition' => [
                    'tp_design_style' => ['layout-1']
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
        

        // $this->add_group_control(
        //     Group_Control_Image_Size::get_type(),
        //     [
        //         'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
        //         'exclude' => ['custom'],
        //         'condition' => [
        //             'tp_shape_switch' => 'yes',
        //         ]
        //     ]
        // );

        $this->end_controls_section();


	}

	// style_tab_content
	protected function style_tab_content(){
        
        $this->tp_section_style_controls('cta_section', 'Section Style', '.ele-section'); 

        $this->tp_basic_style_controls('heading_subtitle', 'Section - Subtitle', '.tp-el-subtitle', ['layout-1', 'layout-2']);
        $this->tp_basic_style_controls('heading_title', 'Section - Title', '.tp-el-title', ['layout-1', 'layout-2']);
        $this->tp_basic_style_controls('heading_desc', 'Section - Description', '.tp-el-des', ['layout-1', 'layout-2']);
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



<?php if ( $settings['tp_design_style']  == 'layout-2' ) : 

   // Link
    if ('2' == $settings['tp_about_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_about_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn theme-bg');
    } else {
        if ( ! empty( $settings['tp_about_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_about_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn theme-bg');
        }
    } 

 $this->add_render_attribute('title_args', 'class', 'tp-newsletter-title mb-0 tp-split-text tp-split-in-right');     
?>


<div class="tp-newsletter-area theme-bg p-relative pt-70 pb-80">
    <div class="tp-newsletter-shape-1">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/newsletter/shape-1-1.png" alt="">
    </div>
    <div class="container">
        <div class="tp-newsletter-wrap">
            <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6">
                <div class="tp-newsletter-content">

                    <?php if ( !empty($settings['tp_cta_sub_title']) ) : ?>
                        <span class="tp-section-subtitle text-light"><?php echo tp_kses($settings['tp_cta_sub_title']); ?></span>
                    <?php endif; ?>

                    <?php
                        if ( !empty($settings['tp_cta_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['tp_cta_title_tag'] ),
                            $this->get_render_attribute_string( 'title_args' ),
                            tp_kses( $settings['tp_cta_title' ] )
                            );
                        endif;
                    ?>

                    <?php if ( !empty($settings['tp_cta_description']) ) : ?>
                        <p><?php echo tp_kses($settings['tp_cta_description']); ?></p>
                    <?php endif; ?>


                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="tp-newsletter-input-wrap d-flex align-items-center justify-content-lg-end">

                    <?php if( !empty($settings['form_shortcode']) ) : ?>
                    <?php echo do_shortcode( $settings['form_shortcode'] ); ?>
                    <?php else : ?>
                    <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                    <?php endif; ?>
                    
                </div>
            </div> 
            </div>
        </div> 
    </div>
</div>




<!--Default Style-->
<?php else:
    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
    $this->add_render_attribute('title_args', 'class', 'mb-24 title tp-el-title wow fadeInDown');
?>


<div class="subcribtion">
    <div class="container">
        <div class="subcribtion__wrapper ralt ele-section">
        <div class="subscribe__content">


        <?php if(!empty($settings['tp_cta_section_title_show'])): ?>
            <?php if ( !empty($settings['tp_cta_sub_title']) ) : ?>
                <span class="tp-section-subtitle tp-el-subtitle pb-10"><?php echo tp_kses($settings['tp_cta_sub_title']); ?></span>
            <?php endif; ?>

            <?php
                if ( !empty($settings['tp_cta_title' ]) ) :
                    printf( '<%1$s %2$s>%3$s</%1$s>',
                    tag_escape( $settings['tp_cta_title_tag'] ),
                    $this->get_render_attribute_string( 'title_args' ),
                    tp_kses( $settings['tp_cta_title' ] )
                    );
                endif;
            ?>

            <?php if ( !empty($settings['tp_cta_description']) ) : ?>
                <p class="mb-40 title tp-el-des wow fadeInUp"><?php echo tp_kses($settings['tp_cta_description']); ?></p>
            <?php endif; ?>
        <?php endif; ?>
    
            <div class="d-flex align-items-center wow fadeInDown">
                <?php if( !empty($settings['form_shortcode']) ) : ?>
                    <?php echo do_shortcode( $settings['form_shortcode'] ); ?>
                <?php else : ?>
                    <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                <?php endif; ?>
            </div>
        </div>

        <?php if(!empty($tp_shape_image)): ?>
            <div class="ball">
                <img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
            </div>
        <?php endif; ?>

        <div class="rarrow1">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rocket-arrow.png" alt="img">
        </div>
        <div class="rarrow2">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rocket-arrowright.png" alt="img">
        </div>
        </div>
    </div>
</div>



<div class="tp-newsletter-area d-none theme-bg p-relative pt-70 pb-80 fix">
    <?php if(!empty($settings['tp_shape_switch'])): ?>
        <div class="tp-newsletter-shape-1">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/newsletter/shape-1-1.png" alt="">
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="tp-newsletter-wrap">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="tp-newsletter-content">
                        <?php if ( !empty($settings['tp_cta_sub_title']) ) : ?>
                            <span class="tp-section-subtitle text-light"><?php echo tp_kses($settings['tp_cta_sub_title']); ?></span>
                        <?php endif; ?>
                        <?php
                            if ( !empty($settings['tp_cta_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['tp_cta_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                tp_kses( $settings['tp_cta_title' ] )
                                );
                            endif;
                        ?>
                        <?php if ( !empty($settings['tp_cta_description']) ) : ?>
                            <p><?php echo tp_kses($settings['tp_cta_description']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <div class="col-xl-6 col-lg-6">
                <div class="tp-newsletter-input-wrap d-flex align-items-center justify-content-lg-end">

                    <?php if( !empty($settings['form_shortcode']) ) : ?>
                        <?php echo do_shortcode( $settings['form_shortcode'] ); ?>
                    <?php else : ?>
                        <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                    <?php endif; ?>

                </div>
            </div>
            </div>
        </div>
    </div>
</div>


<?php endif; 
	}
}

$widgets_manager->register( new TP_CTA() );