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
class TP_List extends Widget_Base {

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
		return 'tp-list';
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
		return __( 'List', 'tpcore' );
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

		$this->start_controls_section(
		 'tp_list_sec',
			 [
			   'label' => esc_html__( 'Info List', 'tpcore' ),
			   'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			 ]
		);

		// $this->add_control(
		// 	'tp_text_title',
		// 	 [
		// 		'label'       => esc_html__( 'Title', 'tpcore' ),
		// 		'type'        => \Elementor\Controls_Manager::TEXT,
		// 		'default'     => esc_html__( 'TP Heading Control', 'tpcore' ),
		// 		'placeholder' => esc_html__( 'Your Title', 'tpcore' ),
		// 		'label_block' => true
		// 	 ]
		// );
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
		'tp_text_list_title',
		  [
			'label'   => esc_html__( 'Title', 'tpcore' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'default'     => esc_html__( 'Default-value', 'tpcore' ),
			'label_block' => true,
		  ]
		);

		// $repeater->add_control(
		// 'tp_text_list_des',
		//   [
		// 	'label'   => esc_html__( 'Des', 'tpcore' ),
		// 	'type'        => \Elementor\Controls_Manager::TEXT,
		// 	'default'     => esc_html__( 'Default-value', 'tpcore' ),
		// 	'label_block' => true,
		//   ]
		// );
		$repeater->add_control(
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
				'condition' => [
                    'tp_design_style' => ['layout-4']
                ]

			]
		);
		$repeater->add_control(
			'tp_box_icon_svg',
			[
				'show_label' => false,
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
				'condition' => [
					'tp_box_icon_type' => 'svg',
					'tp_design_style' => ['layout-4']
				]
			]
		);

		$repeater->add_control(
			'tp_box_icon_image',
			[
				'label' => esc_html__('Upload Icon Image', 'tpcore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'tp_box_icon_type' => 'image',
					'tp_design_style' => ['layout-4']
				]
			]
		);

		if (tp_is_elementor_version('<', '2.6.0')) {
			$repeater->add_control(
				'tp_box_icon',
				[
					'show_label' => false,
					'type' => Controls_Manager::ICON,
					'label_block' => true,
					'default' => 'fa fa-star',
					'condition' => [
						'tp_box_icon_type' => 'icon',
						'tp_design_style' => ['layout-4']
					]
				]
			);
		} else {
			$repeater->add_control(
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
						'tp_design_style' => ['layout-4']
					]
				]
			);
		}
		
		$this->add_control(
		  'tp_text_list_list',
		  [
			'label'       => esc_html__( 'Features List', 'tpcore' ),
			'type'        => \Elementor\Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
			  [
				'tp_text_list_title'   => esc_html__( 'Neque sodales', 'tpcore' ),
			  ],
			  [
				'tp_text_list_title'   => esc_html__( 'Adipiscing elit', 'tpcore' ),
			  ],
			  [
				'tp_text_list_title'   => esc_html__( 'Mauris commodo', 'tpcore' ),
			  ],
			],
			'title_field' => '{{{ tp_text_list_title }}}',
		  ]
		);

		$this->end_controls_section();

		
    }

    protected function style_tab_content(){
        $this->tp_section_style_controls('list_section', 'Section Style', '.ele-section');
        # repeater
        $this->tp_icon_style('rep_icon', 'Repeater Icon', '.tp-el-rep-icon');
        $this->tp_basic_style_controls('rep_title', 'Repeater Title', '.tp-el-rep-title');
        $this->tp_basic_style_controls('rep_des', 'Repeater Description', '.tp-el-rep-des');
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

<?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>

	<ul class="task__listwrap">
		<?php foreach ($settings['tp_text_list_list'] as $key => $item) : ?>
			<li class="d-flex gap-2 align-items-center wow fadeInUp" data-wow-duration="1.7s">
				<i class="material-symbols-outlined base">
				task_alt
				</i>
				<span class="contentbox fz-20 fw-500 title inter">
				<?php echo tp_kses($item['tp_text_list_title']); ?>
				</span>
			</li>
		<?php endforeach; ?>
	</ul>

	
<!--Default style-->
<?php else: ?>


<ul class="app__listwrap">
	<?php foreach ($settings['tp_text_list_list'] as $key => $item) : ?>
		<li>
			<a class="d-flex align-items-center wow fadeInUp">
				<i class="material-symbols-outlined round50 d-flex align-items-center justify-content-center text-white">
					south
				</i>
				<span class="fz-20 fw-500 inter title">
					<?php echo tp_kses($item['tp_text_list_title']); ?>
				</span>
			</a>
		</li>
	<?php endforeach; ?>
</ul>


<?php endif; 
	}
}

$widgets_manager->register( new TP_List() ); 