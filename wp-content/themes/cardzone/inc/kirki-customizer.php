<?php


new \Kirki\Panel(
    'panel_id',
    [
        'priority'    => 10,
        'title'       => esc_html__( 'Theme Options', 'cardzone' ),
        'description' => esc_html__( 'Cardzone Theme Description.', 'cardzone' ),
    ]
);

// header_top_section
function header_top_section(){
    // header_top_bar section 
    new \Kirki\Section(
        'header_top_section',
        [
            'title'       => esc_html__( 'Header Info', 'cardzone' ),
            'description' => esc_html__( 'Header Section Information.', 'cardzone' ),
            'panel'       => 'panel_id',
            'priority'    => 100,
        ]
    );
    // header_top_bar section 

    new \Kirki\Field\Radio_Image(
        [
            'settings'    => 'header_layout_custom',
            'label'       => esc_html__( 'Chose Header Style', 'cardzone' ),
            'section'     => 'header_top_section',
            'priority'    => 10,
            'choices'     => [
                'header_1'   => get_template_directory_uri() . '/inc/img/header/header-1.png',
                'header_2' => get_template_directory_uri() . '/inc/img/header/header-2.png',
            ],
            'default'     => 'header_1',
        ]
    );  

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_right_switch',
            'label'       => esc_html__( 'Header Right Switch', 'cardzone' ),
            'description' => esc_html__( 'Header Right switch On/Off', 'cardzone' ),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'cardzone' ),
                'off' => esc_html__( 'Disable', 'cardzone' ),
            ],
        ]
    ); 

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_preloader_switch',
            'label'       => esc_html__( 'Header Preloader Switch', 'cardzone' ),
            'description' => esc_html__( 'Header Preloader switch On/Off', 'cardzone' ),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'cardzone' ),
                'off' => esc_html__( 'Disable', 'cardzone' ),
            ],
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_search_switch',
            'label'       => esc_html__( 'Header Search Switch', 'cardzone' ),
            'description' => esc_html__( 'Header Search switch On/Off', 'cardzone' ),
            'section'     => 'header_top_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'cardzone' ),
                'off' => esc_html__( 'Disable', 'cardzone' ),
            ],
        ]
    ); 

    new \Kirki\Field\Text(
        [
            'settings' => 'header_button_text',
            'label'    => esc_html__( 'Button Text', 'cardzone' ),
            'section'  => 'header_top_section',
            'default'  => esc_html__( 'Apply Now', 'cardzone' ),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\URL(
        [
            'settings' => 'header_button_link',
            'label'    => esc_html__( 'Button URL', 'cardzone' ),
            'section'  => 'header_top_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );      

}
header_top_section();



// header_side_section
function header_side_section(){
    // header_top_bar section 
    new \Kirki\Section(
        'header_side_section',
        [
            'title'       => esc_html__( 'Header Side Info', 'cardzone' ),
            'description' => esc_html__( 'Header Side Information.', 'cardzone' ),
            'panel'       => 'panel_id',
            'priority'    => 110,
        ]
    );
    // header_side_section section 

    // header_side_logo_section 
    new \Kirki\Field\Image(
        [
            'settings'    => 'header_side_logo',
            'label'       => esc_html__( 'Header Side Logo', 'cardzone' ),
            'description' => esc_html__( 'Header Side Default/Primary Logo Here', 'cardzone' ),
            'section'     => 'header_side_section',
            // 'default'     => get_template_directory_uri() . '/assets/img/logo/logo-black.png',
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_side_info_switch',
            'label'       => esc_html__( 'Header Side Info Switch', 'cardzone' ),
            'description' => esc_html__( 'Header Side Info switch On/Off', 'cardzone' ),
            'section'     => 'header_side_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'cardzone' ),
                'off' => esc_html__( 'Disable', 'cardzone' ),
            ],
        ]
    );  

    new \Kirki\Field\Textarea(
        [
            'settings'    => 'header_top_offcanvas_textarea',
            'label'       => esc_html__( 'Offcanvas About Us', 'cardzone' ),
            'section'     => 'header_side_section',
            'default'     => esc_html__( 'Web designing in a powerful way of just not an only professions. We have tendency to believe the idea that smart looking .', 'cardzone' ),
        ]
    );

    // Contacts Text 
    new \Kirki\Field\Text(
        [
            'settings' => 'header_side_contacts_text',
            'label'    => esc_html__( 'Contacts Text', 'cardzone' ),
            'section'  => 'header_side_section',
            'default'  => esc_html__( 'CONTACT US', 'cardzone' ),
            'priority' => 10,
        ]
    );

}
header_side_section();


// header_bg_color_section
function header_bg_section(){
    // header_top_bar section 
    new \Kirki\Section(
        'header_bg_section',
        [
            'title'       => esc_html__( 'Header Color', 'cardzone' ),
            'description' => esc_html__( 'Header Style', 'cardzone' ),
            'panel'       => 'panel_id',
            'priority'    => 120,
        ]
    );
 

    new \Kirki\Field\COLOR(
        [
        'settings'    => 'header_menu_bg_color',
        'label'       => esc_html__('Header BG Color', 'cardzone'),
        'description' => esc_html__('This is a Header BG Color control.', 'cardzone'),
        'section'     => 'header_bg_section',
        'default'     => '',
        'priority'    => 10,
        ]
    ); 

    new \Kirki\Field\COLOR(
        [
        'settings'    => 'header_menu_color',
        'label'       => esc_html__('Header Menu Color', 'cardzone'),
        'description' => esc_html__('This is a Header BG Color control.', 'cardzone'),
        'section'     => 'header_bg_section',
        'default'     => '',
        'priority'    => 10,
        ]
    ); 

    new \Kirki\Field\COLOR(
        [
        'settings'    => 'header_menu_hover_color',
        'label'       => esc_html__('Header Menu Hover Color', 'cardzone'),
        'description' => esc_html__('This is a Header BG Color control.', 'cardzone'),
        'section'     => 'header_bg_section',
        'default'     => '',
        'priority'    => 10,
        ]
    ); 

    new \Kirki\Field\COLOR(
        [
        'settings'    => 'header_menu_dropdown_bg_color',
        'label'       => esc_html__('Menu Dropdown Bg Color', 'cardzone'),
        'description' => esc_html__('This is a Header BG Color control.', 'cardzone'),
        'section'     => 'header_bg_section',
        'default'     => '',
        'priority'    => 10,
        ]
    ); 

    new \Kirki\Field\COLOR(
        [
        'settings'    => 'header_menu_dropdown_hover_color',
        'label'       => esc_html__('Menu Dropdown Hover Color', 'cardzone'),
        'description' => esc_html__('This is a Header BG Color control.', 'cardzone'),
        'section'     => 'header_bg_section',
        'default'     => '',
        'priority'    => 10,
        ]
    ); 
    
    new \Kirki\Field\COLOR(
        [
        'settings'    => 'header_menu_dropdown_hover_color',
        'label'       => esc_html__('Menu Dropdown Hover Color', 'cardzone'),
        'description' => esc_html__('This is a Header BG Color control.', 'cardzone'),
        'section'     => 'header_bg_section',
        'default'     => '',
        'priority'    => 10,
        ]
    ); 

    new \Kirki\Field\COLOR(
        [
            'type'        => 'color',
            'settings'    => 'custom_menu_css_buttom',
            'label'       => esc_html__('Menu Button BG', 'cardzone'),
            'description' => esc_html__('This is a Button bg color control.', 'cardzone'),
            'section'     => 'header_bg_section',
            'default'     => '',
            'priority'    => 10,
        ]
    ); 

    new \Kirki\Field\COLOR(
        [
        'type'        => 'color',
        'settings'    => 'custom_menu_css_buttom_color',
        'label'       => esc_html__('Menu Button Color', 'cardzone'),
        'description' => esc_html__('This is a Button color control.', 'cardzone'),
        'section'     => 'header_bg_section',
        'default'     => '',
        'priority'    => 12,
        ]
    ); 


}
header_bg_section();


// header_social_section
function header_social_section(){
    // header_top_bar section 
    new \Kirki\Section(
        'header_social_section',
        [
            'title'       => esc_html__( 'Social Area', 'cardzone' ),
            'description' => esc_html__( 'Social URL.', 'cardzone' ),
            'panel'       => 'panel_id',
            'priority'    => 120,
        ]
    );
    

    new \Kirki\Field\URL(
        [
            'settings' => 'header_facebook_link',
            'label'    => esc_html__( 'Facebook URL', 'cardzone' ),
            'section'  => 'header_social_section',
            'default'  => '#',
            'priority' => 10,
        ]
    ); 

    new \Kirki\Field\URL(
        [
            'settings' => 'header_twitter_link',
            'label'    => esc_html__( 'Twitter URL', 'cardzone' ),
            'section'  => 'header_social_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );  

    new \Kirki\Field\URL(
        [
            'settings' => 'header_linkedin_link',
            'label'    => esc_html__( 'Linkedin URL', 'cardzone' ),
            'section'  => 'header_social_section',
            'default'  => '#',
            'priority' => 10,
        ]
    ); 

    new \Kirki\Field\URL(
        [
            'settings' => 'header_instagram_link',
            'label'    => esc_html__( 'Instagram URL', 'cardzone' ),
            'section'  => 'header_social_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );  

    new \Kirki\Field\URL(
        [
            'settings' => 'header_youtube_link',
            'label'    => esc_html__( 'Youtube URL', 'cardzone' ),
            'section'  => 'header_social_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );  

    new \Kirki\Field\URL(
        [
            'settings' => 'header_fb_link',
            'label'    => esc_html__( 'Facebook URL', 'cardzone' ),
            'section'  => 'header_social_section',
            'default'  => '#',
            'priority' => 10,
        ]
    );  

}
header_social_section();


// header_logo_section
function header_logo_section(){
    // header_logo_section section 
    new \Kirki\Section(
        'header_logo_section',
        [
            'title'       => esc_html__( 'Header Logo', 'cardzone' ),
            'description' => esc_html__( 'Header Logo Settings.', 'cardzone' ),
            'panel'       => 'panel_id',
            'priority'    => 130,
        ]
    );

    // header_logo_section section 
    new \Kirki\Field\Image(
        [
            'settings'    => 'header_logo',
            'label'       => esc_html__( 'Header Logo', 'cardzone' ),
            'description' => esc_html__( 'Theme Default/Primary Logo Here', 'cardzone' ),
            'section'     => 'header_logo_section',
            'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
        ]
    );
    new \Kirki\Field\Image(
        [
            'settings'    => 'header_secondary_logo',
            'label'       => esc_html__( 'Header Secondary Logo', 'cardzone' ),
            'description' => esc_html__( 'Theme Secondary Logo Here', 'cardzone' ),
            'section'     => 'header_logo_section',
            'default'     => get_template_directory_uri() . '/assets/img/logo/logolisht.png',
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings'    => 'preloader_logo',
            'label'       => esc_html__( 'Preloader Icon', 'cardzone' ),
            'description' => esc_html__( 'Preloader Icon Logo Here', 'cardzone' ),
            'section'     => 'header_logo_section',
            'default'     => get_template_directory_uri() . '/assets/img/logo/preloder.png',
        ]
    );
}
header_logo_section();


// header_logo_section
function header_breadcrumb_section(){
    // header_logo_section section 
    new \Kirki\Section(
        'header_breadcrumb_section',
        [
            'title'       => esc_html__( 'Breadcrumb', 'cardzone' ),
            'description' => esc_html__( 'Breadcrumb Settings.', 'cardzone' ),
            'panel'       => 'panel_id',
            'priority'    => 160,
        ]
    );

    // header_logo_section section 
    new \Kirki\Field\Image(
        [
            'settings'    => 'breadcrumb_image',
            'label'       => esc_html__( 'Breadcrumb Image', 'cardzone' ),
            'description' => esc_html__( 'Breadcrumb Image add/remove', 'cardzone' ),
            'section'     => 'header_breadcrumb_section',
        ]
    );


    new \Kirki\Field\Color(
        [
            'settings'    => 'breadcrumb_bg_color',
            'label'       => esc_html__( 'Breadcrumb BG Color', 'cardzone' ),
            'description' => esc_html__( 'You can change breadcrumb bg color from here.', 'cardzone' ),
            'section'     => 'header_breadcrumb_section',
            'default'     => '#0d3f84',
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'breadcrumb_shape_switch',
            'label'       => esc_html__( 'Shape Switch', 'cardzone' ),
            'description' => esc_html__( 'Breadcrumb Shape On/Off', 'cardzone' ),
            'section'     => 'header_breadcrumb_section',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'cardzone' ),
                'off' => esc_html__( 'Disable', 'cardzone' ),
            ],
        ]
    );  

    new \Kirki\Field\Image(
        [
            'settings'    => 'breadcrumb_shape_image',
            'label'       => esc_html__( 'Breadcrumb Shape Image', 'cardzone' ),
            'description' => esc_html__( 'Breadcrumb Shape Image add/remove', 'cardzone' ),
            'section'     => 'header_breadcrumb_section',
        ]
    );

    new \Kirki\Field\Dimensions(
        [
            'settings'    => 'breadcrumb_padding',
            'label'       => esc_html__( 'Dimensions Control', 'cardzone' ),
            'description' => esc_html__( 'Description', 'cardzone' ),
            'section'     => 'header_breadcrumb_section',
            'default'     => [
                'padding-top'  => '',
                'padding-bottom' => '',
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings'    => 'breadcrumb_typography',
            'label'       => esc_html__( 'Typography Control', 'cardzone' ),
            'description' => esc_html__( 'The full set of options.', 'cardzone' ),
            'section'     => 'header_breadcrumb_section',
            'priority'    => 10,
            'transport'   => 'auto',
            'default'     => [
                'font-family'     => '',
                'variant'         => '',
                'color'           => '',
                'font-size'       => '',
                'line-height'     => '',
                'text-align'      => '',
            ],
            'output'      => [
                [
                    'element' => '.tpbreadcrumb-title',
                ],
            ],
        ]
    );


}
header_breadcrumb_section();

// header_logo_section
function full_site_typography(){
    // header_logo_section section 
    new \Kirki\Section(
        'full_site_typography',
        [
            'title'       => esc_html__( 'Typography', 'cardzone' ),
            'description' => esc_html__( 'Typography Settings.', 'cardzone' ),
            'panel'       => 'panel_id',
            'priority'    => 190,
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings'    => 'cardzone_typo_body',
            'label'       => esc_html__( 'Typography Body Text', 'cardzone' ),
            'description' => esc_html__( 'Body Typography Control.', 'cardzone' ),
            'section'     => 'full_site_typography',
            'priority'    => 10,
            'transport'   => 'auto',
            'default'     => [
                'font-family'     => '',
                'variant'         => '',
                'color'           => '',
                'font-size'       => '',
                'line-height'     => '',
                'text-align'      => '',
            ],
            'output'      => [
                [
                    'element' => 'body',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings'    => 'cardzone_typo_h1',
            'label'       => esc_html__( 'Typography Heading 1 Font', 'cardzone' ),
            'description' => esc_html__( 'H1 Typography Control.', 'cardzone' ),
            'section'     => 'full_site_typography',
            'priority'    => 10,
            'transport'   => 'auto',
            'default'     => [
                'font-family'     => '',
                'variant'         => '',
                'color'           => '',
                'font-size'       => '',
                'line-height'     => '',
                'text-align'      => '',
            ],
            'output'      => [
                [
                    'element' => 'h1',
                ],
            ],
        ]
    );


    new \Kirki\Field\Typography(
        [
            'settings'    => 'cardzone_typo_h2',
            'label'       => esc_html__( 'Typography Heading 2 Font', 'cardzone' ),
            'description' => esc_html__( 'H2 Typography Control.', 'cardzone' ),
            'section'     => 'full_site_typography',
            'priority'    => 10,
            'transport'   => 'auto',
            'default'     => [
                'font-family'     => '',
                'variant'         => '',
                'color'           => '',
                'font-size'       => '',
                'line-height'     => '',
                'text-align'      => '',
            ],
            'output'      => [
                [
                    'element' => 'h2',
                ],
            ],
        ]
    );


    new \Kirki\Field\Typography(
        [
            'settings'    => 'cardzone_typo_h3',
            'label'       => esc_html__( 'Typography Heading 3 Font', 'cardzone' ),
            'description' => esc_html__( 'H3 Typography Control.', 'cardzone' ),
            'section'     => 'full_site_typography',
            'priority'    => 10,
            'transport'   => 'auto',
            'default'     => [
                'font-family'     => '',
                'variant'         => '',
                'color'           => '',
                'font-size'       => '',
                'line-height'     => '',
                'text-align'      => '',
            ],
            'output'      => [
                [
                    'element' => 'h3',
                ],
            ],
        ]
    );


    new \Kirki\Field\Typography(
        [
            'settings'    => 'cardzone_typo_h4',
            'label'       => esc_html__( 'Typography Heading 4 Font', 'cardzone' ),
            'description' => esc_html__( 'H4 Typography Control.', 'cardzone' ),
            'section'     => 'full_site_typography',
            'priority'    => 10,
            'transport'   => 'auto',
            'default'     => [
                'font-family'     => '',
                'variant'         => '',
                'color'           => '',
                'font-size'       => '',
                'line-height'     => '',
                'text-align'      => '',
            ],
            'output'      => [
                [
                    'element' => 'h4',
                ],
            ],
        ]
    );


    new \Kirki\Field\Typography(
        [
            'settings'    => 'cardzone_typo_h5',
            'label'       => esc_html__( 'Typography Heading 5 Font', 'cardzone' ),
            'description' => esc_html__( 'H5 Typography Control.', 'cardzone' ),
            'section'     => 'full_site_typography',
            'priority'    => 10,
            'transport'   => 'auto',
            'default'     => [
                'font-family'     => '',
                'variant'         => '',
                'color'           => '',
                'font-size'       => '',
                'line-height'     => '',
                'text-align'      => '',
            ],
            'output'      => [
                [
                    'element' => 'h5',
                ],
            ],
        ]
    );


    new \Kirki\Field\Typography(
        [
            'settings'    => 'cardzone_typo_h6',
            'label'       => esc_html__( 'Typography Heading 6 Font', 'cardzone' ),
            'description' => esc_html__( 'H6 Typography Control.', 'cardzone' ),
            'section'     => 'full_site_typography',
            'priority'    => 10,
            'transport'   => 'auto',
            'default'     => [
                'font-family'     => '',
                'variant'         => '',
                'color'           => '',
                'font-size'       => '',
                'line-height'     => '',
                'text-align'      => '',
            ],
            'output'      => [
                [
                    'element' => 'h6',
                ],
            ],
        ]
    );

    new \Kirki\Field\Typography(
        [
            'settings'    => 'full_site_typography_settings',
            'label'       => esc_html__( 'Typography Control', 'cardzone' ),
            'description' => esc_html__( 'The full set of options.', 'cardzone' ),
            'section'     => 'full_site_typography',
            'priority'    => 10,
            'transport'   => 'auto',
            'default'     => [
                'font-family'     => '',
                'variant'         => '',
                'color'           => '',
                'font-size'       => '',
                'line-height'     => '',
                'text-align'      => '',
            ],
            'output'      => [
                [
                    'element' => '.tpbreadcrumb-title',
                ],
            ],
        ]
    );
}
full_site_typography();







// header_logo_section
function footer_layout_section(){
    // header_logo_section section 
    new \Kirki\Section(
        'footer_layout_section',
        [
            'title'       => esc_html__( 'Footer', 'cardzone' ),
            'description' => esc_html__( 'Footer Settings.', 'cardzone' ),
            'panel'       => 'panel_id',
            'priority'    => 190,
        ]
    );
    // footer_widget_number section 
    new \Kirki\Field\Select(
        [
            'settings'    => 'footer_widget_number',
            'label'       => esc_html__( 'Footer Widget Number', 'cardzone' ),
            'section'     => 'footer_layout_section',
            'default'     => '4',
            'placeholder' => esc_html__( 'Choose an option', 'cardzone' ),
            'choices'     => [
                '1' => esc_html__( '1', 'cardzone' ),
                '2' => esc_html__( '2', 'cardzone' ),
                '3' => esc_html__( '3', 'cardzone' ),
                '4' => esc_html__( '4', 'cardzone' ),
            ],
        ]
    );

    new \Kirki\Field\Radio_Image(
        [
            'settings'    => 'footer_layout',
            'label'       => esc_html__( 'Footer Layout Control', 'cardzone' ),
            'section'     => 'footer_layout_section',
            'priority'    => 10,
            'choices'     => [
                'footer_1'   => get_template_directory_uri() . '/inc/img/footer/footer-1.png',
                'footer_2' => get_template_directory_uri() . '/inc/img/footer/footer-2.png',
            ],
            'default'     => 'footer_1',
        ]
    );

    // footer_layout_section 
    new \Kirki\Field\Image(
        [
            'settings'    => 'footer_bg_image',
            'label'       => esc_html__( 'Footer BG Image', 'cardzone' ),
            'description' => esc_html__( 'Footer Image add/remove', 'cardzone' ),
            'section'     => 'footer_layout_section',
        ]
    );

    // footer_layout_section
    new \Kirki\Field\Color(
        [
            'settings'    => 'footer_bg_color',
            'label'       => esc_html__( 'Footer BG Color', 'cardzone' ),
            'description' => esc_html__( 'You can change footer bg color from here.', 'cardzone' ),
            'section'     => 'footer_layout_section',
            'default'     => '',
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'footer_layout_2_switch',
            'label'       => esc_html__( 'Footer Style 2 Switch', 'cardzone' ),
            'description' => esc_html__( 'Footer Style 2 On/Off', 'cardzone' ),
            'section'     => 'footer_layout_section',
            'default'     => 'off',
            'choices'     => [
                'on'  => esc_html__( 'Enable', 'cardzone' ),
                'off' => esc_html__( 'Disable', 'cardzone' ),
            ],
        ]
    );           

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'footer_copyright_switch',
            'label'       => esc_html__( 'Footer Copyright On/Off', 'cardzone' ),
            'section'     => 'footer_layout_section',
            'default'     => true,
            'priority' => 10,
        ]
    ); 

    new \Kirki\Field\Text(
        [
            'settings' => 'footer_copyright',
            'label'    => esc_html__( 'Footer Copyright', 'cardzone' ),
            'section'  => 'footer_layout_section',
            'default'  => esc_html__( 'Copyright &copy; 2024 Pixelaxis. All Rights Reserved', 'cardzone' ),
            'priority' => 10,
        ]
    );  

    new \Kirki\Field\textarea(
        [
            'settings'    => 'footer_bottom_menu',
            'label'       => esc_html__( 'Footer Bottom Menu', 'cardzone' ),
            'section'     => 'footer_layout_section',
            'default'     => esc_html__( 'Footer Bottom menu', 'cardzone' ),
            'priority' => 10,
        ]
    );   

}
footer_layout_section();

// blog_section
function blog_section(){
    // blog_section section 
    new \Kirki\Section(
        'blog_section',
        [
            'title'       => esc_html__( 'Blog Section', 'cardzone' ),
            'description' => esc_html__( 'Blog Section Settings.', 'cardzone' ),
            'panel'       => 'panel_id',
            'priority'    => 150,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'cardzone_blog_btn_switch',
            'label'       => esc_html__( 'Blog BTN On/Off', 'cardzone' ),
            'section'     => 'blog_section',
            'default'     => true,
            'priority' => 10,
        ]
    ); 

    // blog_section BTN 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'cardzone_blog_cat',
            'label'    => esc_html__( 'Blog Category Meta On/Off', 'cardzone' ),
            'section'  => 'blog_section',
            'default'  => false,
            'priority' => 10,
        ]
    );

    // blog_section Author Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'cardzone_blog_author',
            'label'    => esc_html__( 'Blog Author Meta On/Off', 'cardzone' ),
            'section'  => 'blog_section',
            'default'  => true,
            'priority' => 10,
        ]
    );
    // blog_section Date Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'cardzone_blog_date',
            'label'    => esc_html__( 'Blog Date Meta On/Off', 'cardzone' ),
            'section'  => 'blog_section',
            'default'  => true,
            'priority' => 10,
        ]
    );

    // blog_section Comments Meta 
    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'cardzone_blog_comments',
            'label'    => esc_html__( 'Blog Comments Meta On/Off', 'cardzone' ),
            'section'  => 'blog_section',
            'default'  => true,
            'priority' => 10,
        ]
    );


    // blog_section Blog BTN text 
    new \Kirki\Field\Text(
        [
            'settings' => 'cardzone_blog_btn',
            'label'    => esc_html__( 'Blog Button Text', 'cardzone' ),
            'section'  => 'blog_section',
            'default'  => "Read More",
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings' => 'cardzone_singleblog_social',
            'label'    => esc_html__( 'Single Blog Social Share', 'cardzone' ),
            'section'  => 'blog_section',
            'default'  => false,
            'priority' => 10,
        ]
    );

}
blog_section();


// 404 section
function error_404_section(){
    // 404_section section 
    new \Kirki\Section(
        'error_404_section',
        [
            'title'       => esc_html__( '404 Page', 'cardzone' ),
            'description' => esc_html__( '404 Page Settings.', 'cardzone' ),
            'panel'       => 'panel_id',
            'priority'    => 150,
        ]
    );



    new \Kirki\Field\Image(
        [
            'settings'    => 'cardzone_404_bg',
            'label'       => esc_html__( '404 Image.', 'cardzone' ),
            'description' => esc_html__( '404 Image.', 'cardzone' ),
            'section'     => 'error_404_section',
            
        ]
    );




    // 404_section 
    new \Kirki\Field\Text(
        [
            'settings' => 'cardzone_error_404',
            'label'    => esc_html__( 'Not Found 404', 'cardzone' ),
            'section'  => 'error_404_section',
            'default'  => "404",
            'priority' => 10,
        ]
    );
    // 404_section 
    new \Kirki\Field\Text(
        [
            'settings' => 'cardzone_error_text',
            'label'    => esc_html__( 'Not Found 404', 'cardzone' ),
            'section'  => 'error_404_section',
            'default'  => "Oops! The page you are looking for does not exist. It might have been moved or deleted.",
            'priority' => 10,
        ]
    );




    // 404_section description
    new \Kirki\Field\Text(
        [
            'settings' => 'cardzone_error_link_text',
            'label'    => esc_html__( 'Error Link Text', 'cardzone' ),
            'section'  => 'error_404_section',
            'default'  => "Back To Home",
            'priority' => 10,
        ]
    );


}
error_404_section();

// theme color section
function theme_color_section(){
    new \Kirki\Section(
        'theme_color_section',
        [
            'title'       => esc_html__( 'Theme Color', 'cardzone' ),
            'description' => esc_html__( 'cardzone theme color Settings.', 'cardzone' ),
            'panel'       => 'panel_id',
            'priority'    => 150,
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings'    => 'cardzone_color_1',
            'label'       => esc_html__( 'Theme Color 1', 'cardzone' ),
            'description' => esc_html__( 'this is theme color 1 control.', 'cardzone' ),
            'section'     => 'theme_color_section',
            'default'     => '#1A4DBE',
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings'    => 'cardzone_color_2',
            'label'       => esc_html__( 'Theme Color 2', 'cardzone' ),
            'description' => esc_html__( 'this is theme color 2 control.', 'cardzone' ),
            'section'     => 'theme_color_section',
            'default'     => '#FF826B',
        ]
    );
    new \Kirki\Field\Color(
        [
            'settings'    => 'cardzone_gra_color_1',
            'label'       => esc_html__( 'Gradient Color 1', 'cardzone' ),
            'description' => esc_html__( 'this is theme gradient 1 color control.', 'cardzone' ),
            'section'     => 'theme_color_section',
            'default'     => '#004D6E',
        ]
    );
}
theme_color_section();