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
class TP_Contact_Info extends Widget_Base {

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
		return 'tp-contact-info';
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
		return __( 'Contact Info', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // Contact group
        $this->start_controls_section(
            '_TP_contact_info',
            [
                'label' => esc_html__('Contact List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
                    'style_3' => __( 'Style 3', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'tp_box_icon_type',
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
        $this->add_control(
            'tp_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type' => 'svg',
                ]
            ]
        );

        $this->add_control(
            'tp_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type' => 'image',
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tp_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type' => 'icon',
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tp_box_selected_icon',
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
                        'tp_box_icon_type' => 'icon',
                    ]
                ]
            );
        }

        $this->add_control(
            'tp_contact_info_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title Here', 'tpcore'),
                'label_block' => true,
            ]
        );  

        $this->add_control(
            'tp_contact_info_desc',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Description Here', 'tpcore'),
                'label_block' => true,
            ]
        ); 

        $this->add_control(
            'tp_phone_number_switcher',
            [
                'label' => esc_html__( 'Phone Switch', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
    

        $this->add_control(
            'tp_contact_number_one',
            [
                'label' => esc_html__('Number One', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('(907) 555-0101', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_phone_number_switcher' => 'yes'
                ]
            ]
        );  

        $this->add_control(
            'tp_contact_number_two',
            [
                'label' => esc_html__('Number Two', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('(252) 555-0126', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_phone_number_switcher' => 'yes'
                ]
            ]
        );  



        //email swithc
        $this->add_control(
            'tp_email_switcher',
            [
                'label' => esc_html__( 'Email Switch', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'tp_email_one_test',
            [
                'label' => esc_html__('Email One', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('info@example.com', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_email_switcher' => 'yes'
                ]
            ]
        );  

        $this->add_control(
            'tp_email_two',
            [
                'label' => esc_html__('Email Two', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('info@softivus.com', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_email_switcher' => 'yes'
                ]
            ]
        );  
        

        $this->end_controls_section();

	}

    //TAB_STYLE
    protected function style_tab_content(){
        $this->tp_section_style_controls('section_style', 'Section', '.tp-el-section');
        // rep
        // $this->tp_icon_style('rep_icon', 'Contact List Icon/Image/SVG', '.tp-el-rep-icon', ['layout-1', 'layout-2', 'layout-3']);
        // $this->tp_text_link_controls_style('rep_title', 'Contact List Title', '.tp-el-rep-title', ['layout-1', 'layout-2', 'layout-3']);
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
    


<!--Default style-->
<?php else:
    $this->add_render_attribute('title_args', 'class', 'contact-inner-title-sm tp-el-title');
?>

<div class="help__emailitem text-center round16">
    <div class="icon round50 bgwhite d-flex align-items-center justify-content-center">
        <?php if($settings['tp_box_icon_type'] == 'icon') : ?>
        <?php if (!empty($settings['tp_box_icon']) || !empty($settings['tp_box_selected_icon']['value'])) : ?>
        <span class="tp-el-rep-icon"><?php tp_render_icon($settings, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
        <?php endif; ?>
        <?php elseif( $settings['tp_box_icon_type'] == 'image' ) : ?>
        <?php if (!empty($settings['tp_box_icon_image']['url'])): ?>
        <span class="tp-el-rep-icon"><img src="<?php echo $settings['tp_box_icon_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>"></span>
        <?php endif; ?>
        <?php else : ?>
        <?php if (!empty($settings['tp_box_icon_svg'])): ?>
        <span class="tp-el-rep-icon"><?php echo $settings['tp_box_icon_svg']; ?></span>
        <?php endif; ?>
        <?php endif; ?>
    </div>

    <?php if(!empty($settings['tp_contact_info_title'])): ?>
        <h5 class="fw-600 title mb-16">
            <?php echo tp_kses($settings['tp_contact_info_title']); ?>
        </h5>
    <?php endif; ?>


    <?php if(!empty($settings['tp_contact_info_desc'])): ?>
        <span class="fz-16 d-block inter title">
            <?php echo tp_kses($settings['tp_contact_info_desc']); ?>
        </span>
    <?php endif; ?>

    <?php if(!empty($settings['tp_phone_number_switcher'])): ?>
        <span class="fz-16 d-block inter title">
            <?php if(!empty($settings['tp_contact_number_two'])): ?>
                <a href="tel:<?php echo esc_attr($settings['tp_contact_number_one']); ?>"><?php echo esc_html($settings['tp_contact_number_one']) ?></a>
            <?php endif; ?>
        </span>
   
        <span class="fz-16 d-block inter title">
            <?php if(!empty($settings['tp_contact_number_two'])): ?>
                <a href="tel:<?php echo esc_attr($settings['tp_contact_number_two']); ?>"><?php echo esc_html($settings['tp_contact_number_two']) ?></a>
            <?php endif; ?>
        </span>
    <?php endif; ?>


    <?php if(!empty($settings['tp_email_switcher'])): ?>
        <!--Email 02-->
        <span class="fz-16 d-block inter title">
            <?php if(!empty($settings['tp_email_one'])): ?>
                <a href="mailto:<?php echo esc_attr($settings['tp_email_one']); ?>"><?php echo esc_html($settings['tp_email_one']) ?></a>
            <?php endif; ?>
        </span>

        <span class="fz-16 d-block inter title">
            <?php if(!empty($settings['tp_email_two'])): ?>
                <a href="mailto:<?php echo esc_attr($settings['tp_email_two']); ?>"><?php echo esc_html($settings['tp_email_two']) ?></a>
            <?php endif; ?>
        </span>
    <?php endif; ?>

</div>


<?php endif;
	}
}

$widgets_manager->register( new TP_Contact_Info() );