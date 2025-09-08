<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Portfolio_Post extends Widget_Base {

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
		return 'tp-portfolio-post';
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
		return __( 'Portfolio Post', 'tpcore' );
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

        //Button group start
        $this->start_controls_section(
            'tp_layout_btn',
            [
                'label' => esc_html__('Button', 'tpcore'),
                'condition' => [
                    'tp_design_style' => ['layout-2']
                ]
            ]
        );

        $this->add_control(
            'button-title',
            [
                'label' => esc_html__('Contact Button Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Contact', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button-url',
            [
                'label' => esc_html__('Contact Button URL', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'label_block' => true,
            ]
        );

        //apply btn start
        $this->add_control(
            'button-title-apply',
            [
                'label' => esc_html__('Apply Button', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Apply', 'tpcore'),
                'label_block' => true,
                'separator' => 'before'
            ]
        );

        // $this->add_control(
        //     'button-url-apply',
        //     [
        //         'label' => esc_html__('Apply Button URL', 'tpcore'),
        //         'type' => \Elementor\Controls_Manager::TEXT,
        //         'default' => esc_html__('#', 'tpcore'),
        //         'label_block' => true,
        //     ]
        // );

        $this->end_controls_section();
        //Button group end

        // title/content
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',$control_condition = ['layout-3']);
        
        // Product Query
        $this->tp_query_controls('tp-portfolios-id', 'Portfolio', 'tp-portfolios', 'portfolios-cat', '6', '10', );

        // $this->tp_query_controls('blog', 'Blog');


        // tp_post__columns_section
       // $this->tp_columns('col', ['layout-1','layout-2','layout-3']);

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('portfolio_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('section_sub_title', 'Section - Sub Title', '.tp-el-sub-title', 'layout-3');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title', 'layout-3');
        $this->tp_basic_style_controls('section_des', 'Section - Description', '.tp-el-des', 'layout-3');
        $this->tp_link_controls_style('section_btn', 'Section - Button', '.tp-el-btn', ['layout-1', 'layout-2', 'layout-3']);
        # repeater
        $this->tp_basic_style_controls('rep_subtitle', 'Repeater Subtitle', '.tp-el-rep-sub-title' , ['layout-1', 'layout-2', 'layout-3']);
        $this->tp_basic_style_controls('rep_title', 'Main Title', '.tp-el-rep-title' , ['layout-1', 'layout-2', 'layout-3']);

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

    $query = new \WP_Query(
         array(
             'post_type'      => 'tp-portfolios',
             'posts_per_page' => -1,
             'offset'         => 0,
             'post_status'    => 'publish', 
            //  'post__in'          => $settings['services_category'],
         )
    );
     
        /**
         * Setup the post arguments.
        */
        $query_args = TP_Helper::get_query_args('tp-portfolios', 'portfolios-cat', $this->get_settings());

      //  // The Query
      //  $query = new \WP_Query($query_args);

      //  $filter_list = $settings['category'];

      //  $portfolio_filter_btn_active = 1; // for filter button active

        ?>

<?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>

   <section class="popular__card popular__card_style_two ralt tp-el-section">
   <div class="container">
      <div class="category-filter">
         <button class="filter-button portfolio-card-style" data-filter="all"><?php echo esc_html('All'); ?></button>
         <?php
         $terms = get_terms(array(
            'taxonomy' => 'portfolios-cat',
            'hide_empty' => true,
         ));
         if (!empty($terms) && !is_wp_error($terms)) :
            foreach ($terms as $term) :
         ?>
            <button class="filter-button portfolio-card-style" data-filter="<?php echo esc_attr($term->slug); ?>"> <?php echo esc_html($term->name); ?></button>
         <?php
            endforeach;
         endif;
         ?>
      </div>

      <div class="tab-content" id="nav-tabContent">
         <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="row g-4 justify-content-center">
               <?php
               // Check if the query has posts
               if ($query->have_posts()) :
                  while ($query->have_posts()) : $query->the_post();
                     $post_terms = get_the_terms(get_the_ID(), 'portfolios-cat');
                     $term_classes = '';
                     if (!empty($post_terms) && !is_wp_error($post_terms)) {
                        foreach ($post_terms as $post_term) {
                           $term_classes .= ' ' . $post_term->slug;
                        }
                     }
               ?>

                  <div class="col-xxl-8 col-xl-12 col-lg-12 col-md-12 filter-item <?php echo esc_attr($term_classes); ?>">
                     <div class="popular__items popular__v2 round16">
                        <div class="card__boxleft">
                           <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>

                           <?php if (!empty(get_field('cta_title'))) : ?>
                              <span class="aplication ralt mb-15 d-block fz-14 fw-400 inter ptext2"><?php echo wp_kses_post(get_field('cta_title')); ?></span>
                           <?php endif; ?>

                           <?php if (!empty(get_field('rating_title'))) : ?>
                              <div class="d-flex mb-16 fz-18 fw-400 inter ptext2 gap-1 align-items-center">
                                 <i class="material-symbols-outlined ratting fz-24 mb-2">star</i>
                                 <?php echo wp_kses_post(get_field('rating_title')); ?>
                              </div>
                           <?php endif; ?>

                           <div class="d-flex flex-wrap gap-4 align-items-center">
                              <?php if (!empty($settings['button-title'])) : ?>
                                 <a href="<?php echo esc_url($settings['button-url']); ?>" class="compare__btn d-flex align-items-center">
                                    <i class="material-symbols-outlined round50 justify-content-center base d-flex align-items-center fs-16">compare_arrows</i>
                                    <span class="fz-14 fw-400 inter"><?php echo esc_html($settings['button-title']); ?></span>
                                 </a>
                              <?php endif; ?>

                              <a href="<?php the_permalink(); ?>" class="compare__btn d-flex align-items-center">
                                 <i class="material-symbols-outlined round50 justify-content-center base d-flex align-items-center fs-16">arrow_right_alt</i>
                                 <span class="fz-14 fw-400 inter "><?php echo esc_html__('Details', 'tpcore'); ?></span>
                              </a>
                           </div>
                        </div>
                        <div class="card__boxright">
                           <div class="d-flex mb-30 align-items-center justify-content-between flex-wrap gap-3">
                              <h3 class="title mb-16 tp-el-rep-title"><?php the_title(); ?></h3>
                              <a href="<?php the_permalink(); ?>" class="cmn--btn"><span><?php echo esc_html($settings['button-title-apply']); ?></span></a>
                           </div>
                           <div class="d-flex card__btngrp align-items-center">
                              <?php foreach ($terms as $term) : ?>
                                 <a href="<?php echo esc_url(get_term_link($term)); ?>" class="ctband__item d-flex align-items-center gap-1">
                                    <i class="material-symbols-outlined base fz-18">sell</i>
                                    <span class="fz-14 fw-500 inter base"><?php echo esc_html($term->name); ?></span>
                                 </a>
                              <?php endforeach; ?>
                           </div>
                           <div class="bank__detals d-flex align-items-center">
                              <?php if (!empty(get_field('card_info_repeater_left'))) : ?>
                                 <ul class="bankd__wrap">
                                    <?php if (have_rows('card_info_repeater_left')) : ?>
                                       <?php while (have_rows('card_info_repeater_left')) : the_row(); ?>
                                          <li class="d-flex align-items-center justify-content-between">
                                             <span class="fz-14 fw-400 ptext2 inter"><?php echo esc_html(get_sub_field('title')); ?></span>
                                             <span class="fz-14 fw-400 inter title"><?php echo esc_html(get_sub_field('value')); ?></span>
                                          </li>
                                       <?php endwhile ?>
                                    <?php endif; ?>
                                 </ul>
                              <?php endif; ?>

                              <?php if (!empty(get_field('card_info_repeater_right'))) : ?>
                                 <ul class="bankd__wrap left__border">
                                    <?php if (have_rows('card_info_repeater_right')) : ?>
                                       <?php while (have_rows('card_info_repeater_right')) : the_row(); ?>
                                          <li class="d-flex align-items-center justify-content-between">
                                             <span class="fz-14 fw-400 ptext2 inter"><?php echo esc_html(get_sub_field('title')); ?></span>
                                             <span class="fz-14 fw-400 inter title"><?php echo esc_html(get_sub_field('value')); ?></span>
                                          </li>
                                       <?php endwhile ?>
                                    <?php endif; ?>
                                 </ul>
                              <?php endif; ?>
                           </div>
                           <?php if (!empty(get_field('card_short_description'))) : ?>
                              <p class="card__info fz-16 inter ptext"><?php echo wp_kses_post(get_field('card_short_description')); ?></p>
                           <?php endif; ?>
                        </div>
                     </div>
                  </div>
               <?php
                  endwhile;
               endif;

               wp_reset_postdata();
               ?>
            </div>
         </div>
      </div>
   </div>
</section>

<script>
   document.addEventListener('DOMContentLoaded', function() {
      var filterButtons = document.querySelectorAll('.filter-button');
      var filterItems = document.querySelectorAll('.filter-item');

      filterButtons.forEach(function(button) {
         button.addEventListener('click', function() {
            var filterValue = this.getAttribute('data-filter');

            filterItems.forEach(function(item) {
               if (filterValue === 'all' || item.classList.contains(filterValue)) {
                  item.style.display = 'block';
               } else {
                  item.style.display = 'none';
               }
            });
         });
      });
   });
</script>




<!--Default style-->
<?php else: ?>
   
<section class="popular__card ralt tp-el-section">
   <div class="container">

      <div class="category-filter">
         <button class="filter-button portfolio-card-style" data-filter="all"><?php echo esc_html('All'); ?></button>
         <?php
         $terms = get_terms(array(
            'taxonomy' => 'portfolios-cat',
            'hide_empty' => true,
         ));
         if (!empty($terms) && !is_wp_error($terms)) :
            foreach ($terms as $term) :
         ?>

            <button class="filter-button portfolio-card-style" data-filter="<?php echo esc_attr($term->slug); ?>"> <?php echo esc_html($term->name); ?></button>
         <?php
            endforeach;
         endif;
         ?>
      </div>

      <div class="tab-content" id="nav-tabContent">
         <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
               <div class="row g-4">
                  <?php
                  // Nested WP_Query for custom post type 'tp-portfolios' posts
                  if ($query->have_posts()) :
                     while ($query->have_posts()) : $query->the_post();
                        $post_terms = get_the_terms(get_the_ID(), 'portfolios-cat');
                        $term_classes = '';
                        if (!empty($post_terms) && !is_wp_error($post_terms)) {
                           foreach ($post_terms as $post_term) {
                              $term_classes .= ' ' . $post_term->slug;
                           }
                        }
                  ?>
                  
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 filter <?php echo esc_attr($term_classes); ?>">
                           <div class="popular__items round16">
                              <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
                              <div class="content text-center">
                                 
                                 <h4 class="title mb-16">
                                    <?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?>
                                 </h4>

                           <?php if (!empty($settings['tp_post_content'])):
                            $tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
                           ?>

                     <p class="fz-16 mb-30 inter ptext tp-el-rep-des"><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?>
                     </p>
                     <?php endif; ?>


                        <?php if(!empty($settings['tp_post_button'])): ?>
                           <a href="<?php the_permalink(); ?>" class="cmn--btn gap-2 outline__btn d-flex align-items-center ">
                              <span>
                              <?php echo tp_kses($settings['tp_post_button']); ?>
                              </span>
                              <span class="icon">
                                 <i class="material-symbols-outlined">
                                    arrow_right_alt
                                 </i>
                              </span>
                           </a>
                        <?php endif; ?>
                                 
                              </div>
                           </div>
                        </div>
                  <?php
                     endwhile;
                     wp_reset_postdata();  endif;
                  ?>
               </div>
            </div>
         </div>
   </div>
</section>

<?php endif;
	}

}

$widgets_manager->register( new TP_Portfolio_Post() );