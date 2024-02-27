<?php

/* GENERAL SECTION 
-------------------------------------------------------------- */

// PAGE BACKGROUND COLOR
if ( ! function_exists( 'boldthemes_customize_page_background_color' ) ) {
	function boldthemes_customize_page_background_color( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[page_background_color]', array(
			'default'           => BoldThemes_Customize_Default::$data['page_background_color'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_background_color', array(
			'label'    => esc_html__( 'Page Background Color', 'ajani' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[page_background_color]',
			'priority' => 27,
			'context'  => BoldThemesFramework::$pfx . '_page_background_color'
		)));
	}
}
add_action( 'customize_register', 'boldthemes_customize_page_background_color' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_page_background_color' );



// CUSTOM 404 IMAGE
if ( ! function_exists( 'boldthemes_customize_image_404' ) ) {
	function boldthemes_customize_image_404( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[image_404]', array(
			'default'           => BoldThemes_Customize_Default::$data['image_404'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_image'
		));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'image_404', array(
			'label'    => esc_html__( 'Custom Error 404 Page Image', 'ajani' ),
			'description'    => esc_html__( 'Set static image as a background on Error page. Minimum recommended size: 1920x1080px', 'ajani' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[image_404]',
			'priority' => 121,
			'context'  => BoldThemesFramework::$pfx . '_image_404'
		)));
	}
}
add_action( 'customize_register', 'boldthemes_customize_image_404' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_image_404' );

// BACK TO TOP 
if ( ! function_exists( 'boldthemes_customize_back_to_top' ) ) {
	function boldthemes_customize_back_to_top( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[back_to_top]', array(
			'default'           => BoldThemes_Customize_Default::$data['back_to_top'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'back_to_top', array(
			'label'     => esc_html__( 'Enable back to top.', 'ajani' ),
			'description'    => esc_html__( 'Checking this enables the small feature that shows the styled back to top element at the bottom of the page, which appears after some scrolling.', 'ajani' ),
			'section'   => BoldThemesFramework::$pfx . '_general_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[back_to_top]',
			'priority'  => 110,
			'type'     => 'checkbox'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_back_to_top' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_back_to_top' );

// BACK TO TOP STYLE
if ( ! function_exists( 'boldthemes_customize_back_to_top_style' ) ) {
	function boldthemes_customize_back_to_top_style( $wp_customize ) {		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[back_to_top_style]', array(
			'default'           => BoldThemes_Customize_Default::$data['back_to_top_style'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'back_to_top_style', array(
			'label'     => esc_html__( 'Back to top style.', 'ajani' ),
			'description'    => esc_html__( 'Style of back to top element at the bottom of the page, which appears after some scrolling.', 'ajani' ),
			'section'   => BoldThemesFramework::$pfx . '_general_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[back_to_top_style]',
			'priority'  => 111,
			'type'      => 'select',
			'choices'   => array(
				'accent'		=> esc_html__( 'Accent', 'ajani' ),
				'alternate'   	=> esc_html__( 'Alternate', 'ajani' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_back_to_top_style' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_back_to_top_style' );

// BACK TO TOP TEXT
if ( ! function_exists( 'boldthemes_customize_back_to_top_text' ) ) {
	function boldthemes_customize_back_to_top_text( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[back_to_top_text]', array(
			'default'           => BoldThemes_Customize_Default::$data['back_to_top_text'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'back_to_top_text', array(
			'label'    => esc_html__( 'Back to Top Text', 'ajani' ),
			'description'    => esc_html__( 'You can add text to your back to top button, but if you leave it blank you\'ll get only an arrow pointing upwards, which is also nice.', 'ajani' ),
			'section'  => BoldThemesFramework::$pfx . '_general_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[back_to_top_text]',
			'priority' => 112,
			'type'     => 'text'
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_back_to_top_text' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_back_to_top_text' );



/* HEADER AND FOOTER SECTION 
-------------------------------------------------------------- */

// PAGE HEADLINE STYLE
if ( ! function_exists( 'boldthemes_customize_page_headline_style' ) ) {
	function boldthemes_customize_page_headline_style( $wp_customize ) {
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[page_headline_style]', array(
			'default'           => BoldThemes_Customize_Default::$data['page_headline_style'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'page_headline_style', array(
			'label'     => esc_html__( 'Page Headline Style', 'ajani' ),
			'description'    => esc_html__( 'Select page headline style for all the pages on the site.', 'ajani' ),
			'section'   => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[page_headline_style]',
			'priority'  => 63,
			'type'      => 'select',
			'choices'   => array(
				'light-dark'  	=> esc_html__( 'Light font, darker background', 'ajani' ),
				'dark-light'   	=> esc_html__( 'Dark font, lighter background', 'ajani' ),
				'light-accent'	=> esc_html__( 'Light font, accent background', 'ajani' ),
				'dark-accent' 	=> esc_html__( 'Dark font, accent background', 'ajani' ),
				'light-alternate'	=> esc_html__( 'Light font, alternate background', 'ajani' ),
				'dark-alternate' 	=> esc_html__( 'Dark font, alternate background', 'ajani' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_page_headline_style' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_page_headline_style' );

// Show logo and logo widgets
if ( ! function_exists( 'boldthemes_customize_show_logo_and_logo_widgets' ) ) {
	function boldthemes_customize_show_logo_and_logo_widgets( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[show_logo_and_logo_widgets]', array(
			'default'           => BoldThemes_Customize_Default::$data['show_logo_and_logo_widgets'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'show_logo_and_logo_widgets', array(
			'label'    => esc_html__( 'Expanded sticky header', 'ajani' ),
			'description'    => esc_html__( 'Enabling this will show logo and logo widgets on a sticky header when selected Menu Type is below logo.', 'ajani' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[show_logo_and_logo_widgets]',
			'priority' => 61,
			'type'     => 'checkbox'
		));	
	}
}
add_action( 'customize_register', 'boldthemes_customize_show_logo_and_logo_widgets' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_show_logo_and_logo_widgets' );

// Boxed menu witdh
if ( ! function_exists( 'boldthemes_customize_boxed_menu_width' ) ) {
	function boldthemes_customize_boxed_menu_width( $wp_customize ) {
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[boxed_menu_width]', array(
			'default'           => BoldThemes_Customize_Default::$data['boxed_menu_width'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'boxed_menu_width', array(
			'label'     => esc_html__( 'Boxed menu witdh', 'ajani' ),
			'description'    => esc_html__( 'Select Boxed menu width. The selected width will also influence on footer when you\'re using widgets in it.', 'ajani' ),
			'section'   => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[boxed_menu_width]',
			'priority'  => 61,
			'type'      => 'select',
			'choices'   => array(
				'1200'  	=> esc_html__( '1200px', 'ajani' ),
				'1300'   	=> esc_html__( '1300px', 'ajani' ),
				'1400'		=> esc_html__( '1400px', 'ajani' ),
				'1500'		=> esc_html__( '1500px', 'ajani' ),
				'1600'		=> esc_html__( '1600px', 'ajani' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_boxed_menu_width' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_boxed_menu_width' );



/* TYPOGRAPHY SECTION 
-------------------------------------------------------------- */

// MENU FONT SIZE
if ( ! function_exists( 'boldthemes_customize_menu_font_size' ) ) {
	function boldthemes_customize_menu_font_size( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[menu_font_size]', array(
			'default'           => BoldThemes_Customize_Default::$data['menu_font_size'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'menu_font_size', array(
			'label'     => esc_html__( 'Menu Font Size', 'ajani' ),
			'description'    => esc_html__( 'Set the font size you wish which will affect only the menu and menu widgets.', 'ajani' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[menu_font_size]',
			'priority'  => 100,
			'type'      => 'select',
			'choices'   => array(
				'14'  	=> esc_html__( '14px', 'ajani' ),
				'15'  	=> esc_html__( '15px', 'ajani' ),
				'16'  	=> esc_html__( '16px', 'ajani' ),
				'17'  	=> esc_html__( '17px', 'ajani' ),
				'18'  	=> esc_html__( '18px', 'ajani' ),
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_menu_font_size' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_menu_font_size' );

// BUTTONS FONT
if ( ! function_exists( 'boldthemes_customize_button_font' ) ) {
	function boldthemes_customize_button_font( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[button_font]', array(
			'default'           => urlencode( BoldThemes_Customize_Default::$data['button_font'] ),
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'button_font', array(
			'label'     => esc_html__( 'Button Font', 'ajani' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[button_font]',
			'priority'  => 99,
			'type'      => 'select',
			'choices'   => BoldThemesFramework::$customize_fonts
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_button_font' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_button_font' );

// Show default accent button with dark text
if ( ! function_exists( 'boldthemes_customize_accent_button_dark_text' ) ) {
	function boldthemes_customize_accent_button_dark_text( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[accent_button_dark_text]', array(
			'default'           => BoldThemes_Customize_Default::$data['accent_button_dark_text'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_checkbox'
		));
		$wp_customize->add_control( 'accent_button_dark_text', array(
			'label'    => esc_html__( 'Set all the buttons to have dark text', 'ajani' ),
			'description'    => esc_html__( 'Enabling this will make all buttons throughout the theme that you can\'t control with Bold Builder have dark text instead of white (when light font blends in the accent background too much', 'ajani' ),
			'section'  => BoldThemesFramework::$pfx . '_typo_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[accent_button_dark_text]',
			'priority' => 99,
			'type'     => 'checkbox'
		));	
	}
}
add_action( 'customize_register', 'boldthemes_customize_accent_button_dark_text' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_accent_button_dark_text' );

// Headline text letter spacing
if ( ! function_exists( 'boldthemes_customize_headline_text_letter_spacing' ) ) {
	function boldthemes_customize_headline_text_letter_spacing( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[headline_text_letter_spacing]', array(
			'default'           => urlencode( BoldThemes_Customize_Default::$data['headline_text_letter_spacing'] ),
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'headline_text_letter_spacing', array(
			'label'     => esc_html__( 'Headline text letter spacing', 'ajani' ),
			'description'    => esc_html__( 'If the font has too much or too little kerning you can control the headlines with this option.', 'ajani' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[headline_text_letter_spacing]',
			'priority'  => 100,
			'type'      => 'select',
			'choices'   => array(
				'0'		=> esc_html__( '0', 'ajani' ),
				'-15'	=> esc_html__( '-15', 'ajani' ),
				'-30'	=> esc_html__( '-30', 'ajani' ),
				'-45'	=> esc_html__( '-45', 'ajani' ),
				'15'	=> esc_html__( '15', 'ajani' ),
				'30'	=> esc_html__( '30', 'ajani' ),
				'45'	=> esc_html__( '45', 'ajani' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_headline_text_letter_spacing' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_headline_text_letter_spacing' );

// Headline style
if ( ! function_exists( 'boldthemes_customize_headline_style' ) ) {
	function boldthemes_customize_headline_style( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[headline_style]', array(
			'default'           => urlencode( BoldThemes_Customize_Default::$data['headline_style'] ),
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'headline_style', array(
			'label'     => esc_html__( 'Headline style', 'ajani' ),
			'description'    => esc_html__( 'You can set the font weight of all the headlines throughout the theme here.', 'ajani' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[headline_style]',
			'priority'  => 101,
			'type'      => 'select',
			'choices'   => array(
				'bold'			=> esc_html__( 'Bold', 'ajani' ),
				'bolder'		=> esc_html__( 'Bolder', 'ajani' ),
				'lighter'		=> esc_html__( 'Lighter', 'ajani' ),
				'bold-italic'	=> esc_html__( 'Bold Italic', 'ajani' ),
				'bolder-italic'	=> esc_html__( 'Bolder Italic', 'ajani' ),
				'lighter-italic'=> esc_html__( 'Lighter Italic', 'ajani' ),
				'normal'		=> esc_html__( 'Normal', 'ajani' ),
				'italic'		=> esc_html__( 'Italic', 'ajani' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_headline_style' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_headline_style' );

// Subheadline / Superheadline style
if ( ! function_exists( 'boldthemes_customize_subsuper_headline_style' ) ) {
	function boldthemes_customize_subsuper_headline_style( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[subsuper_headline_style]', array(
			'default'           => urlencode( BoldThemes_Customize_Default::$data['subsuper_headline_style'] ),
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'subsuper_headline_style', array(
			'label'     => esc_html__( 'Subheadline / Superheadline style', 'ajani' ),
			'description'    => esc_html__( 'You can set the font style of all the subheadlines and superheadlines throughout the theme here.', 'ajani' ),
			'section'   => BoldThemesFramework::$pfx . '_typo_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[subsuper_headline_style]',
			'priority'  => 102,
			'type'      => 'select',
			'choices'   => array(
				'normal'	=> esc_html__( 'Normal', 'ajani' ),
				'italic'	=> esc_html__( 'Italic', 'ajani' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_subsuper_headline_style' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_subsuper_headline_style' );



/* BLOG SECTION 
-------------------------------------------------------------- */

// POST DEFAULT IMAGE
if ( ! function_exists( 'boldthemes_customize_blog_image_default' ) ) {
	function boldthemes_customize_blog_image_default( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[blog_image_default]', array(
			'default'           => BoldThemes_Customize_Default::$data['blog_image_default'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_image'
		));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'blog_image_default', array(
			'label'    => esc_html__( 'Post Default Image', 'ajani' ),
			'description'    => esc_html__( 'To make all of the post tiles and grids nice, you can select a default image - which will shown up there even if your post doesn\'t have a featured image selected.', 'ajani' ),
			'section'  => BoldThemesFramework::$pfx . '_blog_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[blog_image_default]',
			'priority' => 7,
			'context'  => BoldThemesFramework::$pfx . '_blog_image_default'
		)));
	}
}
add_action( 'customize_register', 'boldthemes_customize_blog_image_default' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_blog_image_default' );



/* PORTFOLIO SECTION 
-------------------------------------------------------------- */

// PORTFOLIO DEFAULT IMAGE
if ( ! function_exists( 'boldthemes_customize_pf_image_default' ) ) {
	function boldthemes_customize_pf_image_default( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[pf_image_default]', array(
			'default'           => BoldThemes_Customize_Default::$data['pf_image_default'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_image'
		));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'pf_image_default', array(
			'label'    => esc_html__( 'Portflio Default Image', 'ajani' ),
			'description'    => esc_html__( 'To make all of the portfolio tiles and grids nice, you can select a default image - which will shown up there even if your portfolio item doesn\'t have a featured image selected.', 'ajani' ),
			'section'  => BoldThemesFramework::$pfx . '_pf_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[pf_image_default]',
			'priority' => 8,
			'context'  => BoldThemesFramework::$pfx . '_pf_image_default'
		)));
	}
}
add_action( 'customize_register', 'boldthemes_customize_pf_image_default' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_pf_image_default' );



/* SHOP SECTION 
-------------------------------------------------------------- */

// PRODUCT COLUMNS
if ( ! function_exists( 'boldthemes_customize_shop_product_columns' ) ) {
	function boldthemes_customize_shop_product_columns( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[shop_product_columns]', array(
			'default'           => BoldThemes_Customize_Default::$data['shop_product_columns'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_select'
		));
		$wp_customize->add_control( 'shop_product_columns', array(
			'label'    => esc_html__( 'Product Columns', 'ajani' ),
			'description'    => esc_html__( 'Set the number of product columns for your default WooCommerce shop page here.', 'ajani' ),
			'section'  => BoldThemesFramework::$pfx . '_shop_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[shop_product_columns]',
			'priority' => 50,
			'type'      => 'select',
			'choices'   => array(
				'2'		=> esc_html__( '2', 'ajani' ),
				'3'		=> esc_html__( '3', 'ajani' ),
				'4'		=> esc_html__( '4', 'ajani' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_shop_product_columns' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_shop_product_columns' );

if ( ! function_exists( 'boldthemes_customize_menu_background' ) ) {
	function boldthemes_customize_menu_background( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[menu_background]', array(
			'default'           => BoldThemes_Customize_Default::$data['menu_background'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'boldthemes_sanitize_image'
		));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'menu_background', array(
			'label'    => esc_html__( 'Fullscreen Menu Background Image', 'ajani' ),
			'description'    => esc_html__( 'Set static image as a vertical fullscreen menu background. Minimum recommended size: 1920x1080px', 'ajani' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[menu_background]',
			'priority' => 62,
			'context'  => BoldThemesFramework::$pfx . '_menu_background'
		)));
	}
}

add_action( 'customize_register', 'boldthemes_customize_menu_background' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_menu_background' );

// VERTICAL FULLSCREEN MENU IMAGE BACKGROUND OPACITY
if ( ! function_exists( 'boldthemes_customize_menu_background_opacity' ) ) {
	function boldthemes_customize_menu_background_opacity( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[menu_background_opacity]', array(
			'default'           => BoldThemes_Customize_Default::$data['menu_background_opacity'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'menu_background_opacity', array(
			'label'    => esc_html__( 'Fullscreen Menu Background Opacity', 'ajani' ),
			'description'    => esc_html__( 'Set opacity for static image background when vertical fullscreen menu is used. Ex. 0.8', 'ajani' ),
			'section'  => BoldThemesFramework::$pfx . '_header_footer_section',
			'settings' => BoldThemesFramework::$pfx . '_theme_options[menu_background_opacity]',
			'priority' => 62,
			'type'     => 'text'
		));
	}
}

add_action( 'customize_register', 'boldthemes_customize_menu_background_opacity' );
add_action( 'boldthemes_customize_register', 'boldthemes_customize_menu_background_opacity' );