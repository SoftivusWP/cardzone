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
class TP_search_promo extends Widget_Base
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
        return 'tp-search-promo';
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
        return __('Search Promo', 'tpcore');
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


        $this->start_controls_section(
            'finview_search_card_section_genaral',
            [
                'label' => esc_html__('Search', 'bankio-core')
            ]
        );
        // $this->add_control(
        //     'finview_submit_content_style',
        //     [
        //         'type' => \Elementor\Controls_Manager::SELECT,
        //         'label' => esc_html__('Select Style', 'finview-core'),
        //         'options' => [
        //             'style_one' => esc_html__('Text', 'finview-core'),
        //             'style_two' => esc_html__('Icon', 'finview-core'),
        //         ],
        //         'default' => 'style_two',
        //     ]
        // );

        // Button text
        $this->add_control(
            'finview_placeholder',
            [
                'label' => esc_html__('Placeholder', 'bankio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Search Here', 'bankio-core'),
                'placeholder' => esc_html__('Type your text here', 'bankio-core'),
                'label_block' => true,
            ]
        );

        // Button text
        $this->add_control(
            'finview_search_button',
            [
                'label' => esc_html__('Button', 'bankio-core'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Apply', 'bankio-core'),
                
                'label_block' => true,
                
            ]
        );


        $this->end_controls_section();


        // ======================= Style =================================//

        $this->start_controls_section(
            'finview_search_box_card_section_genaral',
            [
                'label' => esc_html__('Search Box', 'bankio-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'button_search_box_bg_color',
            [
                'label' => esc_html__('BG Color', 'bankio-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .filter__search .input-group' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_search_box_color',
            [
                'label' => esc_html__('Text Color', 'bankio-core'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .form-control' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'form_bg_style_color',
            [
                'label'     => esc_html__('Placeholder Color', 'finview-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} input::placeholder' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .filter__search .input-group',
            ]
        );
        

        $this->add_responsive_control(
            'button_search_box_border_radius',
            [
                'label'      => __('Border Radius', 'bankio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .filter__search .input-group' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'button_search_box_style_margin',
            [
                'label' => esc_html__('Margin', 'bankio-core'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .filter__search .input-group' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_search_box_style_padding',
            [
                'label'      => __('Padding', 'bankio-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .filter__search .input-group' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
    .fa-search:before{
        font-family: "fontawesome" !important; 
    }
</style>

    <!-- ==== support search start ==== -->
        <div class="promot__coded">
            <form action="<?php echo esc_url(home_url('/')); ?>" method="GET" class="d-flex align-items-center">
                <input type="text"  name="s" placeholder="<?php echo esc_attr($settings['finview_placeholder']); ?>">
                <button class="cmn--btn">
                    <span>
                        <?php echo esc_html($settings['finview_search_button']); ?>
                    </span>
                </button>
            </form>
        </div>
    <!-- ==== / support search end ==== -->
<?php
    }
}

$widgets_manager->register(new TP_search_promo());
