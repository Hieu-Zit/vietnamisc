<?php

/* General */
BoldThemes_Customize_Default::$data['accent_color'] = '#ff3b2b';
BoldThemes_Customize_Default::$data['alternate_color'] = '#06305f';
BoldThemes_Customize_Default::$data['page_background_color'] = '#eeeeec';
BoldThemes_Customize_Default::$data['logo_height'] = '140';
BoldThemes_Customize_Default::$data['heading_style'] = 'default';
BoldThemes_Customize_Default::$data['hide_headline'] = false;
BoldThemes_Customize_Default::$data['supertitle_position'] = true;
BoldThemes_Customize_Default::$data['template_skin'] = 'light';
BoldThemes_Customize_Default::$data['sidebar'] = 'right';
BoldThemes_Customize_Default::$data['page_width'] = 'boxed1600';
BoldThemes_Customize_Default::$data['sidebar_use_dash'] = true;
BoldThemes_Customize_Default::$data['disable_preloader'] = true;

BoldThemes_Customize_Default::$data['image_404'] = '';
BoldThemes_Customize_Default::$data['back_to_top'] = false;
BoldThemes_Customize_Default::$data['back_to_top_style'] = 'accent';
BoldThemes_Customize_Default::$data['back_to_top_text'] = '';



/* Header and footer */
//BoldThemes_Customize_Default::$data['logo_height'] = '140';
BoldThemes_Customize_Default::$data['menu_type'] = 'horizontal-right';
BoldThemes_Customize_Default::$data['header_style'] = 'transparent-dark';
BoldThemes_Customize_Default::$data['boxed_menu'] = true;
BoldThemes_Customize_Default::$data['below_menu'] = false;
BoldThemes_Customize_Default::$data['sticky_header'] = true;
BoldThemes_Customize_Default::$data['hide_menu'] = false;
BoldThemes_Customize_Default::$data['footer_dark_skin'] = false;
BoldThemes_Customize_Default::$data['page_headline_style'] = 'dark-light';
BoldThemes_Customize_Default::$data['show_logo_and_logo_widgets'] = false;
BoldThemes_Customize_Default::$data['boxed_menu_width'] = '1600'; 

BoldThemes_Customize_Default::$data['menu_background'] = '';
BoldThemes_Customize_Default::$data['menu_background_opacity'] = '';

/* Typography */
BoldThemes_Customize_Default::$data['body_font'] = 'Roboto Condensed';
BoldThemes_Customize_Default::$data['heading_font'] = 'Vidaloka';
BoldThemes_Customize_Default::$data['heading_supertitle_font'] = 'PT Serif';
BoldThemes_Customize_Default::$data['heading_subtitle_font'] = 'PT Serif';
BoldThemes_Customize_Default::$data['menu_font'] = 'Roboto Condensed';
BoldThemes_Customize_Default::$data['buttons_shape'] = 'soft-rounded';
BoldThemes_Customize_Default::$data['button_font'] = 'Roboto Condensed';
BoldThemes_Customize_Default::$data['headline_text_letter_spacing'] = '-30';
BoldThemes_Customize_Default::$data['menu_font_size'] = '16';
BoldThemes_Customize_Default::$data['headline_style'] = 'normal';
BoldThemes_Customize_Default::$data['subsuper_headline_style'] = 'italic';
BoldThemes_Customize_Default::$data['accent_button_dark_text'] = false;


/* Blog */
BoldThemes_Customize_Default::$data['blog_grid_gallery_columns'] = '3';
BoldThemes_Customize_Default::$data['blog_grid_gallery_gap'] = 'normal';
BoldThemes_Customize_Default::$data['blog_list_view'] = 'standard';
BoldThemes_Customize_Default::$data['blog_single_view'] = 'standard';
BoldThemes_Customize_Default::$data['blog_author'] = true;
BoldThemes_Customize_Default::$data['blog_date'] = true;
BoldThemes_Customize_Default::$data['blog_side_info'] = false;
BoldThemes_Customize_Default::$data['blog_author_info'] = true;
BoldThemes_Customize_Default::$data['blog_use_dash'] = true;
BoldThemes_Customize_Default::$data['blog_image_default'] = '';

/* Portfolio */
BoldThemes_Customize_Default::$data['pf_grid_gallery_columns'] = '3';
BoldThemes_Customize_Default::$data['pf_grid_gallery_gap'] = 'normal';
BoldThemes_Customize_Default::$data['pf_single_view'] = 'standard';
BoldThemes_Customize_Default::$data['pf_list_view'] = 'columns';
BoldThemes_Customize_Default::$data['pf_use_dash'] = true;
BoldThemes_Customize_Default::$data['pf_image_default'] = '';
BoldThemes_Customize_Default::$data['pf_settings_page_slug'] = '';

/* Shop */
BoldThemes_Customize_Default::$data['shop_use_dash'] = true;
BoldThemes_Customize_Default::$data['shop_product_columns'] = '2';


// HEADING STYLE
BoldThemes_Customize_Default::$data['heading_style'] = 'default';

if ( ! function_exists( 'boldthemes_customize_heading_style' ) ) {
	function boldthemes_customize_heading_style( $wp_customize ) {
		
		$wp_customize->add_setting( BoldThemesFramework::$pfx . '_theme_options[heading_style]', array(
			'default'           => BoldThemes_Customize_Default::$data['heading_style'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'heading_style', array(
			'label'     => esc_html__( 'Heading Style', 'ajani' ),
			'section'   => BoldThemesFramework::$pfx . '_typography_section',
			'settings'  => BoldThemesFramework::$pfx . '_theme_options[heading_style]',
			'priority'  => 95,
			'type'      => 'select',
			'choices'   => array(
				'default' => esc_html__( 'Default', 'ajani' ),
				'compact' => esc_html__( 'Compact (small line height + bold)', 'ajani' )
			)
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_heading_style' );

require_once( get_template_directory() . '/php/after_framework/functions.php' );
require_once( get_template_directory() . '/php/after_framework/customize_params.php' );