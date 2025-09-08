<?php

// tp metabox 
add_filter( 'tp_meta_boxes', 'themepure_metabox' );


function themepure_metabox( $meta_boxes ) {
	
	$prefix     = 'cardzone';
	
	$meta_boxes[] = array(
		'metabox_id'       => $prefix . '_page_meta_box',
		'title'    => esc_html__( 'TP Page Info', 'cardzone' ),
		'post_type'=> ['page', 'post', 'tp-portfolios', 'listing-card', 'card-feature', ],
		'context'  => 'normal',
		'priority' => 'core',
		'fields'   => array( 
			array(
				'label'    => esc_html__( 'Hide Breadcrumb?', 'cardzone' ),
				'id'      => "{$prefix}_check_bredcrumb",
				'type'    => 'switch',
				'default' => 'on',
				'conditional' => array()
			),	
			
			array(
				'label'    => esc_html__( 'Show Breadcrumb Image?', 'cardzone' ),
				'id'      => "{$prefix}_check_bredcrumb_img",
				'type'    => 'switch',
				'default' => 'on',
				'conditional' => array()
			), 
            array(
				
				'label'    => esc_html__( 'Breadcrumb Background', 'cardzone' ),
				'id'      => "{$prefix}_breadcrumb_bg",
				'type'    => 'image',
				'default' => '',
				'conditional' => array(
					"{$prefix}_check_bredcrumb_img", "==", "on"
				)
			),	
			array(
				'label'    => esc_html__( 'Logo', 'cardzone' ),
				'id'      => "{$prefix}_page_logo",
				'type'    => 'image',
				'default' => '',
				'conditional' => array()
			),
			array(
				'label'    => esc_html__( 'Breadcrumb Shape Image', 'cardzone' ),
				'id'      => "{$prefix}_breadcrumb_shape",
				'type'    => 'image',
				'default' => '',
				'conditional' => array()
			),
            array(
				'label'    => esc_html__( 'Enable Secondary Logo', 'cardzone' ),
				'id'      => "{$prefix}_en_secondary_logo",
				'type'    => 'switch',
				'default' => 'off',
				'conditional' => array()
			),
            array(
				
				'label'    => esc_html__( 'Footer BG', 'cardzone' ),
				'id'      => "{$prefix}_footer_bg_image",
				'type'    => 'image',
				'default' => '',
				'conditional' => array()
			),

            array(
				'label' => 'Footer BG Color',
				'id'   	=> "{$prefix}_footer_bg_color",
				'type' 	=> 'colorpicker',
				'default' 	  => '',
				'conditional' => array()
			),


      // multiple buttons group field like multiple radio buttons
			array(
				'label'   => esc_html__( 'Header', 'cardzone' ),
				'id'      => "{$prefix}_header_tabs",
				'desc'    => '',
				'type'    => 'tabs',
				'choices' => array(
					'default' => esc_html__( 'Default', 'cardzone' ),
					'custom' => esc_html__( 'Custom', 'cardzone' ),
					// 'elementor' => esc_html__( 'Elementor', 'cardzone' ),
				),
				'default' => 'default',
				'conditional' => array()
			), 

      // select field dropdown
			array(
				
				'label'           => esc_html__('Select Header Style', 'cardzone'),
				'id'              => "{$prefix}_header_style",
				'type'            => 'select',
				'options'         => array(
					'header_1' => esc_html__( 'Header 1', 'cardzone' ),
					'header_2' => esc_html__( 'Header 2', 'cardzone' ),
					'header_3' => esc_html__( 'Header 3', 'cardzone' ),
					
				),
				'placeholder'     => esc_html__( 'Select a header', 'cardzone' ),
				'conditional' => array(
					"{$prefix}_header_tabs", "==", "custom"
				),
				'default' => 'header_1',
				'parent' => "{$prefix}_header_tabs"
			),

      // multiple buttons group field like multiple radio buttons
			array(
				'label'   => esc_html__( 'Footer', 'cardzone' ),
				'id'      => "{$prefix}_footer_tabs",
				'desc'    => '',
				'type'    => 'tabs',
				'choices' => array(
					'default' => esc_html__( 'Default', 'cardzone' ),
					'custom' => esc_html__( 'Custom', 'cardzone' ),
					// 'elementor' => esc_html__( 'Elementor', 'cardzone' ),
				),
				'default' => 'default',
				'conditional' => array()
			), 

      // select field dropdown
			array(
				
				'label'           => esc_html__('Select Footer Style', 'cardzone'),
				'id'              => "{$prefix}_footer_style",
				'type'            => 'select',
				'options'         => array(
					'footer_1' => esc_html__( 'Footer 1', 'cardzone' ),
					'footer_2' => esc_html__( 'Footer 2', 'cardzone' ),
					
				),
				'placeholder'     => esc_html__( 'Select a footer', 'cardzone' ),
				'conditional' => array(
					"{$prefix}_footer_tabs", "==", "custom"
				),
				'default' => 'footer_1',
				'parent' => "{$prefix}_footer_tabs"
			),

      // select field dropdown
			array(
				
				'label'           => esc_html__('Select Footer Template', 'cardzone'),
				'id'              => "{$prefix}_footer_template",
				'type'            => 'select_posts',
				'placeholder'     => esc_html__( 'Select a template', 'cardzone' ),
                'post_type'       => 'tp-footer',
				'conditional' => array(
					"{$prefix}_footer_tabs", "==", "elementor"
				),
				'default' => '',
				'parent' => "{$prefix}_footer_tabs"
			),
		),
	);

    $meta_boxes[] = array(
		'metabox_id'       => $prefix . '_post_gallery_meta',
		'title'    => esc_html__( 'TP Gallery Post', 'cardzone' ),
		'post_type'=> 'post',
		'context'  => 'normal',
		'priority' => 'core',
		'fields'   => array( 
            array(
				'label'    => esc_html__( 'Gallery', '' ),
				'id'      => "{$prefix}_post_gallery",
				'type'    => 'gallery',
				'default' => '',
				'conditional' => array(),
			),
		),
		'post_format' => 'gallery'
	);       

	$meta_boxes[] = array(
		'metabox_id'       => $prefix . '_post_video_meta',
		'title'    => esc_html__( 'TP Video Post', 'cardzone' ),
		'post_type'=> 'post',
		'context'  => 'normal',
		'priority' => 'core',
		'fields'   => array( 
			array(
				'label'    => esc_html__( 'Video', 'cardzone' ),
				'id'      => "{$prefix}_post_video",
				'type'    => 'text',
				'default' => '',
				'conditional' => array(),
				'placeholder'     => esc_html__( 'Place your video url.', 'cardzone' ),
			),
		),
		'post_format' => 'video'
	);	

	$meta_boxes[] = array(
		'metabox_id'       => $prefix . '_post_audio_meta',
		'title'    => esc_html__( 'TP Audio Post', 'cardzone' ),
		'post_type'=> 'post',
		'context'  => 'normal',
		'priority' => 'core',
		'fields'   => array( 
			array(
				'label'    => esc_html__( 'Audio', 'cardzone' ),
				'id'      => "{$prefix}_post_audio",
				'type'    => 'text',
				'default' => '',
				'conditional' => array(),
				'placeholder'     => esc_html__( 'Place your audio url..', 'cardzone' ),
			),
		),
		'post_format' => 'audio'
	);

	$meta_boxes[] = array(
		'metabox_id'       => $prefix . '_post_audio_meta',
		'title'    => esc_html__( 'TP Audio Post', 'cardzone' ),
		'post_type'=> 'listing-card',
		'context'  => 'normal',
		'priority' => 'core',
		'fields'   => array( 
			array(
				'label' => 'Textarea Field',
				'id'    => "{$prefix}_your_id",
				'type'  => 'textarea', // specify the type field
				'placeholder' => 'Type...',
				'default'     => '',
				'conditional' => array()
			)
		),
		
	);

	return $meta_boxes;


	
}










