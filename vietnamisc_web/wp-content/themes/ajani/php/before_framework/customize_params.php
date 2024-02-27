<?php
/* GENERAL SECTION 
-------------------------------------------------------------- */

// PAGE WIDTH
if ( ! function_exists( 'boldthemes_customize_page_width' ) ) {
	function boldthemes_customize_page_width( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[page_width]', array(
			'default'           => BoldThemes_Customize_Default::$data['page_width'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'page_width', array(
			'label'     => esc_html__( 'Page Width', 'ajani' ),
			'section'   => BoldThemesFramework::$pfx . '_general_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[page_width]',
			'priority'  => 95,
			'type'      => 'select',
			'choices'   => array(
				'no_change' 	=> esc_html__( 'Default', 'ajani' ),
				'boxed' 		=> esc_html__( 'Boxed 1200px', 'ajani' ),
				'boxed1400' 	=> esc_html__( 'Boxed 1400px', 'ajani' ),
				'boxed1600' 	=> esc_html__( 'Boxed 1600px', 'ajani' )	
			)
		));
	}
}

/* HEADER AND FOOTER SECTION 
-------------------------------------------------------------- */

// HEADER STYLE
if ( ! function_exists( 'boldthemes_customize_header_style' ) ) {
	function boldthemes_customize_header_style( $wp_customize ) {
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[header_style]', array(
			'default'           => BoldThemes_Customize_Default::$data['header_style'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'header_style', array(
			'label'     => esc_html__( 'Header Style', 'ajani' ),
			'description'    => esc_html__( 'Select header style for all the pages with default header turned on.', 'ajani' ),
			'section'   => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[header_style]',
			'priority'  => 62,
			'type'      => 'select',
			'choices'   => array(
				'transparent-light'  	=> esc_html__( 'Transparent Light', 'ajani' ),
				'transparent-dark'   	=> esc_html__( 'Transparent Dark', 'ajani' ),
				'accent-dark' 			=> esc_html__( 'Accent + Dark', 'ajani' ),
				'accent-light' 			=> esc_html__( 'Light + Accent ', 'ajani' ),
				'light-accent' 			=> esc_html__( 'Accent + Light', 'ajani' ),
				'light-dark' 			=> esc_html__( 'Light + Dark', 'ajani' ),
				'alternate-light' 		=> esc_html__( 'Alternate + Light', 'ajani' ),
				'light-alternate' 		=> esc_html__( 'Light + Alternate', 'ajani' ),
				'alternate-dark' 		=> esc_html__( 'Alternate + Dark', 'ajani' ),
				'dark-alternate' 		=> esc_html__( 'Dark + Alternate', 'ajani' ),
				'hidden' 				=> esc_html__( 'Hidden', 'ajani' )				
			)
		));
	}
}

// MENU TYPE
if ( ! function_exists( 'boldthemes_customize_menu_type' ) ) {
	function boldthemes_customize_menu_type( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[menu_type]', array(
			'default'           => BoldThemes_Customize_Default::$data['menu_type'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'menu_type', array(
			'label'     => esc_html__( 'Menu Type', 'ajani' ),
			'description'    => esc_html__( 'Set the menu layout for all the pages on the site. Menu can be horizontal, in line with logo or below logo, or vertical on left or right, or fullscreen vertical hidden by default.', 'ajani' ),
			'section'   => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[menu_type]',
			'priority'  => 60,
			'type'      => 'select',
			'choices'   => array(
				'horizontal-left'       => esc_html__( 'Horizontal Left', 'ajani' ),
				'horizontal-center'     => esc_html__( 'Horizontal Centered', 'ajani' ),
				'horizontal-right'      => esc_html__( 'Horizontal Right', 'ajani' ),
				'horizontal-below-left'  => esc_html__( 'Horizontal Left Below Logo', 'ajani' ),
				'horizontal-below-center'  => esc_html__( 'Horizontal Center Below Logo', 'ajani' ),
				'horizontal-below-right' => esc_html__( 'Horizontal Right Below Logo', 'ajani' ),
				'vertical-left'       => esc_html__( 'Vertical Left', 'ajani' ),
				'vertical-right'      => esc_html__( 'Vertical Right', 'ajani' ),
				'vertical-fullscreen' => esc_html__( 'Vertical Full Screen', 'ajani' )
			)
		));
	}
}

/* TYPOGRAPHY SECTION 
-------------------------------------------------------------- */

// BUTTONS SHAPE
if ( ! function_exists( 'boldthemes_customize_heading_buttons_shape' ) ) {
	function boldthemes_customize_heading_buttons_shape( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[buttons_shape]', array(
			'default'           => BoldThemes_Customize_Default::$data['buttons_shape'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'buttons_shape', array(
			'label'     => esc_html__( 'Buttons Shape', 'ajani' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[buttons_shape]',
			'priority'  => 99,
			'type'      => 'select',
			'choices'   => array(
				'square'		=> esc_html__( 'Square', 'ajani' ),
				'soft-rounded'  => esc_html__( 'Soft rounded', 'ajani' ),
				'hard-rounded'  => esc_html__( 'Hard rounded', 'ajani' ),
				'full-rounded'  => esc_html__( 'Full rounded', 'ajani' )			
			)
		));
	}
}

/* BLOG SECTION 
-------------------------------------------------------------- */

// GRID GALLERY GAP
if ( ! function_exists( 'boldthemes_customize_blog_grid_gallery_gap' ) ) {
	function boldthemes_customize_blog_grid_gallery_gap( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_grid_gallery_gap]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_grid_gallery_gap'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'blog_grid_gallery_gap', array(
			'label'     => esc_html__( 'Grid Gallery Gap', 'ajani' ),
			'description'    => esc_html__( 'Define the gap between grid gallery items in pixels.', 'ajani' ),
			'section'   => BoldThemesFramework::$pfx . '_blog_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[blog_grid_gallery_gap]',
			'priority'  => 7,
			'type'      => 'select',
			'choices'   => array(
				'no_gap'		=> esc_html__( 'No gap', 'ajani' ),
				'extra-small'	=> esc_html__( 'Extra Small', 'ajani' ),
				'small'			=> esc_html__( 'Small', 'ajani' ),
				'normal'		=> esc_html__( 'Normal', 'ajani' ),
				'medium'		=> esc_html__( 'Medium', 'ajani' ),
				'large'			=> esc_html__( 'Large', 'ajani' ),
				'extra-large'	=> esc_html__( 'Extra Large', 'ajani' )
			)
		));	
	}
}

/* PORTFOLIO SECTION 
-------------------------------------------------------------- */

// GRID GALLERY GAP
if ( ! function_exists( 'boldthemes_customize_pf_grid_gallery_gap' ) ) {
	function boldthemes_customize_pf_grid_gallery_gap( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[pf_grid_gallery_gap]', array(
			'default'           => BoldThemes_Customize_Default::$data['pf_grid_gallery_gap'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'pf_grid_gallery_gap', array(
			'label'     => esc_html__( 'Grid Gallery Gap', 'ajani' ),
			'description'    => esc_html__( 'Define the gap between grid gallery items in pixels.', 'ajani' ),
			'section'   => BoldThemesFramework::$pfx . '_pf_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[pf_grid_gallery_gap]',
			'priority'  => 8,
			'type'      => 'select',
			'choices'   => array(
				'no_gap'		=> esc_html__( 'No gap', 'ajani' ),
				'extra-small'	=> esc_html__( 'Extra Small', 'ajani' ),
				'small'			=> esc_html__( 'Small', 'ajani' ),
				'normal'		=> esc_html__( 'Normal', 'ajani' ),
				'medium'		=> esc_html__( 'Medium', 'ajani' ),
				'large'			=> esc_html__( 'Large', 'ajani' ),
				'extra-large'	=> esc_html__( 'Extra Large', 'ajani' )
			)
		));
	}
}