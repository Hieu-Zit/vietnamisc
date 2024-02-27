<?php

// COLOR SCHEME
if ( is_file( dirname(__FILE__) . '/../../../../plugins/bold-page-builder/content_elements_misc/misc.php' ) ) {
	require_once( dirname(__FILE__) . '/../../../../plugins/bold-page-builder/content_elements_misc/misc.php' );
}
if ( function_exists('bt_bb_get_color_scheme_param_array') ) {
	$color_scheme_arr = bt_bb_get_color_scheme_param_array();
} else {
	$color_scheme_arr = array();
}

if ( is_file( dirname(__FILE__) . '/../../../../plugins/bold-page-builder/content_elements_misc/fonts.php' ) ) {
	require_once( dirname(__FILE__) . '/../../../../plugins/bold-page-builder/content_elements_misc/fonts.php' );
}


// IMAGE SLIDER - GAP, PAGING DESIGN, ACTIVE DOT COLOR, INACTIVE COLOR
if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_slider', 'show_dots' );
	bt_bb_remove_params( 'bt_bb_slider', 'show_arrows' );
	bt_bb_remove_params( 'bt_bb_slider', 'arrows_size' );
}

if ( function_exists( 'bt_bb_add_params' ) ) {
	bt_bb_add_params( 'bt_bb_slider', array(
		array( 'param_name' => 'gap', 'type' => 'dropdown', 'heading' => esc_html__( 'Gap', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
			'value' => array(
				esc_html__( 'None', 'ajani' ) => '',
				esc_html__( 'Extra small', 'ajani' ) => 'extrasmall',
				esc_html__( 'Small', 'ajani' ) => 'small',
				esc_html__( 'Normal', 'ajani' ) => 'normal',
				esc_html__( 'Medium', 'ajani' ) => 'medium',
				esc_html__( 'Large', 'ajani' ) => 'large',
				esc_html__( 'Extra large', 'ajani' ) => 'extralarge'
			)
		),
		array( 'param_name' => 'paging_design', 'type' => 'dropdown', 'heading' => esc_html__( 'Paging design', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
			'value' => array(
				esc_html__( 'Dots', 'ajani' ) => 'dots',
				esc_html__( 'Numbers', 'ajani' ) => 'numbers'
			)
		),
		array( 'param_name' => 'show_dots', 'type' => 'dropdown', 'heading' => esc_html__( 'Dots navigation', 'ajani' ),'group' => esc_html__( 'Design', 'ajani' ),
			'value' => array(
				esc_html__( 'Bottom', 'ajani' ) => 'bottom',
				esc_html__( 'Below', 'ajani' ) => 'below',
				esc_html__( 'Side', 'ajani' ) => 'side',
				esc_html__( 'Outside', 'ajani' ) => 'outside',
				esc_html__( 'Hide', 'ajani' ) => 'hide'
			)
		),
		array( 'param_name' => 'active_dot_color', 'type' => 'dropdown', 'heading' => esc_html__( 'Active dot color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
			'value' => array(
				esc_html__( 'Accent', 'ajani' ) => 'accent',
				esc_html__( 'Alternate', 'ajani' ) => 'alternate',
				esc_html__( 'Dark', 'ajani' ) => 'dark',
				esc_html__( 'Light', 'ajani' ) => 'light'
			)
		),
		array( 'param_name' => 'inactive_dot_color', 'type' => 'dropdown', 'heading' => esc_html__( 'Inactive dot color / Paging color for Numbers page design', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
			'value' => array(
				esc_html__( 'Light', 'ajani' ) => 'light',
				esc_html__( 'Dark', 'ajani' ) => 'dark',
				esc_html__( 'Transparent light', 'ajani' ) => 'transparent_light',
				esc_html__( 'Transparent dark', 'ajani' ) => 'transparent_dark'
			)
		),
		array( 'param_name' => 'arrows_position', 'type' => 'dropdown', 'heading' => esc_html__( 'Arrows position', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
			'value' => array(
				esc_html__( 'Bottom', 'ajani' ) => 'bottom',
				esc_html__( 'Below', 'ajani' ) => 'below',
				esc_html__( 'Side', 'ajani' ) => 'side',
				esc_html__( 'Outside', 'ajani' ) => 'outside',
				esc_html__( 'Hide', 'ajani' ) => 'hide'
			)
		),
		array( 'param_name' => 'arrows_style', 'type' => 'dropdown', 'heading' => esc_html__( 'Arrows color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
			'value' => array(
				esc_html__( 'Inherit', 'ajani' ) => 'inherit',
				esc_html__( 'Light', 'ajani' ) => 'light',
				esc_html__( 'Dark', 'ajani' ) => 'dark'				
			)
		),
	));
}

function ajani_bt_bb_slider_class( $class, $atts ) {
	if ( isset( $atts['gap'] ) && $atts['gap'] != '' ) {
		$class[] = 'bt_bb_gap_' . $atts['gap'];
	}
	if ( isset( $atts['paging_design'] ) && $atts['paging_design'] != '' ) {
		$class[] = 'bt_bb_paging_design_' . $atts['paging_design'];
	}
	if ( isset( $atts['active_dot_color'] ) && $atts['active_dot_color'] != '' ) {
		$class[] = 'bt_bb_active_dot_color_' . $atts['active_dot_color'];
	}
	if ( isset( $atts['inactive_dot_color'] ) && $atts['inactive_dot_color'] != '' ) {
		$class[] = 'bt_bb_inactive_dot_color_' . $atts['inactive_dot_color'];
	}
	if ( isset( $atts['arrows_position'] ) && $atts['arrows_position'] != '' ) {
		$class[] = 'bt_bb_arrows_position_' . $atts['arrows_position'];
	}
	if ( isset( $atts['arrows_style'] ) && $atts['arrows_style'] != '' ) {
		$class[] = 'bt_bb_arrows_style_' . $atts['arrows_style'];
	}
	if ( isset( $atts['show_dots'] ) && $atts['show_dots'] != '' ) {
		$class[] = 'bt_bb_show_dots_' . $atts['show_dots'];
	}
	
	return $class;
}
add_filter( 'bt_bb_slider_class', 'ajani_bt_bb_slider_class', 10, 2 );


// SLIDER - GAP, PAGING DESIGN, SHOW DOTS, ACTIVE DOTS COLOR, INACTIVE COLOR, ARROWS POSITION, ARROWS STYLE
if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_content_slider', 'gap' );
	bt_bb_remove_params( 'bt_bb_content_slider', 'show_dots' );
	bt_bb_remove_params( 'bt_bb_content_slider', 'arrows_size' );
}

if ( function_exists( 'bt_bb_add_params' ) ) {
	bt_bb_add_params( 'bt_bb_content_slider', array(
		array( 'param_name' => 'gap', 'type' => 'dropdown', 'heading' => esc_html__( 'Gap', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
			'value' => array(
				esc_html__( 'None', 'ajani' ) => '',
				esc_html__( 'Extra small', 'ajani' ) => 'extrasmall',
				esc_html__( 'Small', 'ajani' ) => 'small',
				esc_html__( 'Normal', 'ajani' ) => 'normal',
				esc_html__( 'Medium', 'ajani' ) => 'medium',
				esc_html__( 'Large', 'ajani' ) => 'large',
				esc_html__( 'Extra large', 'ajani' ) => 'extralarge'
			)
		),
		array( 'param_name' => 'paging_design', 'type' => 'dropdown', 'heading' => esc_html__( 'Paging design', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
			'value' => array(
				esc_html__( 'Dots', 'ajani' ) => 'dots',
				esc_html__( 'Numbers', 'ajani' ) => 'numbers'
			)
		),
		array( 'param_name' => 'show_dots', 'type' => 'dropdown', 'heading' => esc_html__( 'Dots navigation', 'ajani' ),'group' => esc_html__( 'Design', 'ajani' ),
				'value' => array(
					esc_html__( 'Bottom', 'ajani' ) => 'bottom',
					esc_html__( 'Below', 'ajani' ) => 'below',
					esc_html__( 'Side', 'ajani' ) => 'side',
					esc_html__( 'Outside', 'ajani' ) => 'outside',
					esc_html__( 'Hide', 'ajani' ) => 'hide'
				)
			),
		array( 'param_name' => 'active_dot_color', 'type' => 'dropdown', 'heading' => esc_html__( 'Active dot color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
			'value' => array(
				esc_html__( 'Accent', 'ajani' ) => 'accent',
				esc_html__( 'Alternate', 'ajani' ) => 'alternate',
				esc_html__( 'Dark', 'ajani' ) => 'dark',
				esc_html__( 'Light', 'ajani' ) => 'light'
			)
		),
		array( 'param_name' => 'inactive_dot_color', 'type' => 'dropdown', 'heading' => esc_html__( 'Inactive dot color / Paging color for Numbers page design', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
			'value' => array(
				esc_html__( 'Light', 'ajani' ) => 'light',
				esc_html__( 'Dark', 'ajani' ) => 'dark',
				esc_html__( 'Transparent light', 'ajani' ) => 'transparent_light',
				esc_html__( 'Transparent dark', 'ajani' ) => 'transparent_dark'
			)
		),
		array( 'param_name' => 'arrows_position', 'type' => 'dropdown', 'heading' => esc_html__( 'Arrows position', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
			'value' => array(
				esc_html__( 'Bottom', 'ajani' ) => 'bottom',
				esc_html__( 'Below', 'ajani' ) => 'below',
				esc_html__( 'Side', 'ajani' ) => 'side',
				esc_html__( 'Outside', 'ajani' ) => 'outside',
				esc_html__( 'Hide', 'ajani' ) => 'hide'
			)
		),
		array( 'param_name' => 'arrows_style', 'type' => 'dropdown', 'heading' => esc_html__( 'Arrows color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
			'value' => array(
				esc_html__( 'Inherit', 'ajani' ) => 'inherit',
				esc_html__( 'Light', 'ajani' ) => 'light',
				esc_html__( 'Dark', 'ajani' ) => 'dark'				
			)
		),
	));
}

function ajani_bt_bb_content_slider_class( $class, $atts ) {
	if ( isset( $atts['paging_design'] ) && $atts['paging_design'] != '' ) {
		$class[] = 'bt_bb_paging_design_' . $atts['paging_design'];
	}
	if ( isset( $atts['active_dot_color'] ) && $atts['active_dot_color'] != '' ) {
		$class[] = 'bt_bb_active_dot_color_' . $atts['active_dot_color'];
	}
	if ( isset( $atts['inactive_dot_color'] ) && $atts['inactive_dot_color'] != '' ) {
		$class[] = 'bt_bb_inactive_dot_color_' . $atts['inactive_dot_color'];
	}
	if ( isset( $atts['arrows_position'] ) && $atts['arrows_position'] != '' ) {
		$class[] = 'bt_bb_arrows_position_' . $atts['arrows_position'];
	}
	if ( isset( $atts['arrows_style'] ) && $atts['arrows_style'] != '' ) {
		$class[] = 'bt_bb_arrows_style_' . $atts['arrows_style'];
	}
	if ( isset( $atts['show_dots'] ) && $atts['show_dots'] != '' ) {
		$class[] = 'bt_bb_show_dots_' . $atts['show_dots'];
	}
	
	return $class;
}
add_filter( 'bt_bb_content_slider_class', 'ajani_bt_bb_content_slider_class', 10, 2 );


// BUTTON - SHAPE, ICON COLOR SCHEME, ICON SIZE
if ( function_exists( 'bt_bb_remove_params' ) ) {
	bt_bb_remove_params( 'bt_bb_button', 'shape' );
}

if ( function_exists( 'bt_bb_add_params' ) ) {
	$color_scheme_arr = bt_bb_get_color_scheme_param_array();
		
	bt_bb_add_params( 'bt_bb_button', array(
		array( 'param_name' => 'icon_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon Color Scheme', 'ajani' ), 'value' => $color_scheme_arr, 'preview' => true, 'group' => esc_html__( 'Design', 'ajani' ) ),
		array( 'param_name' => 'shape', 'type' => 'dropdown', 'heading' => esc_html__( 'Shape', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
			'value' => array(
				esc_html__( 'Inherit', 'ajani' ) => 'inherit',
				esc_html__( 'Square', 'ajani' ) => 'square',
				esc_html__( 'Soft Rounded', 'ajani' ) => 'soft_rounded',
				esc_html__( 'Hard Rounded', 'ajani' ) => 'hard_rounded',
				esc_html__( 'Full Rounded', 'ajani' ) => 'full_rounded'
			)
		),
		array( 'param_name' => 'icon_size', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon Size', 'ajani' ), 'description' => 'Icon sizes','group' => esc_html__( 'Design', 'ajani' ),
			'value' => array(
				esc_html__( 'Normal', 'ajani' ) => 'normal',
				esc_html__( 'Larger', 'ajani' ) => 'larger'
			)
		),
	));
}

function ajani_bt_bb_button_class( $class, $atts ) {
	if ( isset( $atts['icon_color_scheme'] ) && $atts['icon_color_scheme'] != '' ) {
		$class[] = 'bt_bb_icon_color_scheme_' . bt_bb_get_color_scheme_id( $atts['icon_color_scheme'] );
	}
	if ( isset( $atts['icon_size'] ) && $atts['icon_size'] != '' ) {
		$class[] = 'bt_bb_icon_size_' . $atts['icon_size'];
	}	
	return $class;
}

function ajani_bt_bb_button_style( $style, $atts ) {
	if ( isset( $atts['icon_color_scheme'] ) && $atts['icon_color_scheme'] != '' ) {
	
		$icon_color_scheme_id = NULL;
		if ( is_numeric ( $atts['icon_color_scheme'] ) ) {
			$icon_color_scheme_id = $atts['icon_color_scheme'];
		} else if ( $atts['icon_color_scheme'] != '' ) {
			$icon_color_scheme_id = bt_bb_get_color_scheme_id( $atts['icon_color_scheme'] );
		}
		$icon_color_scheme_colors = bt_bb_get_color_scheme_colors_by_id( $icon_color_scheme_id - 1 );
		if ( $icon_color_scheme_colors ) $style .= '; --icon-primary-color:' . $icon_color_scheme_colors[0] . '; --icon-secondary-color:' . $icon_color_scheme_colors[1] . ';';
	}
	return $style;
}

add_filter( 'bt_bb_button_class', 'ajani_bt_bb_button_class', 10, 2 );
add_filter( 'bt_bb_button_style', 'ajani_bt_bb_button_style', 10, 2 );



// ICON - STYLE, TEXT COLOR SCHEME, TEXT SIZE, SHAPE, ICON PADDING, SIZE
if ( function_exists( 'bt_bb_remove_params' ) ) {	
	bt_bb_remove_params( 'bt_bb_icon', 'style' );
	bt_bb_remove_params( 'bt_bb_icon', 'shape' );
	bt_bb_remove_params( 'bt_bb_icon', 'size' );
}

if ( function_exists( 'bt_bb_add_params' ) ) {
	$color_scheme_arr = bt_bb_get_color_scheme_param_array();
	
	bt_bb_add_params( 'bt_bb_icon', array(
		array( 'param_name' => 'style', 'type' => 'dropdown', 'heading' => esc_html__( 'Style', 'ajani' ), 'preview' => true, 'group' => esc_html__( 'Design', 'ajani' ),
			'value' => array(
				esc_html__( 'Filled', 'ajani' ) => 'filled',
				esc_html__( 'Filled with light background', 'ajani' ) => 'filled_with_light_background',
				esc_html__( 'Outline', 'ajani' ) => 'outline',
				esc_html__( 'Borderless', 'ajani' ) => 'borderless'
			)
		),
		array( 'param_name' => 'text_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Text Color Scheme', 'ajani' ), 'value' => $color_scheme_arr, 'preview' => true, 'group' => esc_html__( 'Design', 'ajani' ) ),
		array( 'param_name' => 'text_size', 'type' => 'dropdown', 'heading' => esc_html__( 'Text Size', 'ajani' ), 'description' => 'Predefined text sizes','group' => esc_html__( 'Design', 'ajani' ),
			'value' => array(
				esc_html__( 'Inherit', 'ajani' ) => '',
				esc_html__( 'Extra Small', 'ajani' ) => 'extrasmall',
				esc_html__( 'Small', 'ajani' ) => 'small',
				esc_html__( 'Normal', 'ajani' ) => 'normal',
				esc_html__( 'Medium', 'ajani' ) => 'medium',
				esc_html__( 'Large', 'ajani' ) => 'large',
				esc_html__( 'Extra large', 'ajani' ) => 'extralarge'
			)
		),
		array( 'param_name' => 'shape', 'type' => 'dropdown', 'heading' => esc_html__( 'Shape', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
			'value' => array(
				esc_html__( 'Square', 'ajani' ) => 'square',
				esc_html__( 'Soft Rounded', 'ajani' ) => 'soft_rounded',
				esc_html__( 'Hard Rounded', 'ajani' ) => 'hard_rounded',
				esc_html__( 'Circle', 'ajani' ) => 'circle'
			)
		),
		array( 'param_name' => 'icon_padding', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon Padding', 'ajani' ), 'preview' => true,
			'value' => array(
				esc_html__( 'Regular', 'ajani' ) 		=> 'regular',
				esc_html__( 'No padding', 'ajani' ) 	=> 'none'
			)
		),
		array( 'param_name' => 'size', 'type' => 'dropdown', 'default' => 'small', 'heading' => esc_html__( 'Size', 'ajani' ), 'preview' => true, 'group' => esc_html__( 'Design', 'ajani' ), 'responsive_override' => true,
			'value' => array(
				esc_html__( 'Tiny', 'ajani' ) => 'tiny',
				esc_html__( 'Extra Small', 'ajani' ) => 'extrasmall',
				esc_html__( 'Small', 'ajani' ) => 'small',
				esc_html__( 'Normal', 'ajani' ) => 'normal',
				esc_html__( 'Medium', 'ajani' ) => 'medium',
				esc_html__( 'Large', 'ajani' ) => 'large',
				esc_html__( 'Extra large', 'ajani' ) => 'extralarge',
				esc_html__( 'Huge', 'ajani' ) => 'huge'
			)
		),
	));
}

function ajani_bt_bb_icon_class( $class, $atts ) {
	if ( isset( $atts['text_color_scheme'] ) && $atts['text_color_scheme'] != '' ) {
		$class[] = 'bt_bb_text_color_scheme_' . bt_bb_get_color_scheme_id( $atts['text_color_scheme'] );
	}
	if ( isset( $atts['text_size'] ) && $atts['text_size'] != '' ) {
		$class[] = 'bt_bb_text_size_' . $atts['text_size'];
	}
	if ( isset( $atts['icon_padding'] ) && $atts['icon_padding'] != '' ) {
		$class[] = 'bt_bb_icon_padding_' . $atts['icon_padding'];
	}
	return $class;
}


function ajani_bt_bb_icon_style( $style, $atts ) {
	if ( isset( $atts['text_color_scheme'] ) && $atts['text_color_scheme'] != '' ) {
	
		$text_color_scheme_id = NULL;
		if ( is_numeric ( $atts['text_color_scheme'] ) ) {
			$text_color_scheme_id = $atts['text_color_scheme'];
		} else if ( $atts['text_color_scheme'] != '' ) {
			$text_color_scheme_id = bt_bb_get_color_scheme_id( $atts['text_color_scheme'] );
		}
		$text_color_scheme_colors = bt_bb_get_color_scheme_colors_by_id( $text_color_scheme_id - 1 );
		if ( $text_color_scheme_colors ) $style .= '; --text-primary-color:' . $text_color_scheme_colors[0] . '; --text-secondary-color:' . $text_color_scheme_colors[1] . ';';
	}
	return $style;
}

add_filter( 'bt_bb_icon_class', 'ajani_bt_bb_icon_class', 10, 2 );
add_filter( 'bt_bb_icon_style', 'ajani_bt_bb_icon_style', 10, 2 );


// CONTACT FORM 7 - SUBMIT STYLE, SIZE, ALIGNMENT, INOUT STYLE, BACKGROUND
if ( function_exists( 'bt_bb_add_params' ) ) {
	bt_bb_add_params( 'bt_bb_contact_form_7', array(
		array( 'param_name' => 'submit_button_style', 'type' => 'dropdown', 'heading' => esc_html__( 'Submit button style', 'ajani' ), 
			'value' => array(
				esc_html__( 'Accent', 'ajani' ) => 'accent',
				esc_html__( 'Alternate', 'ajani' ) => 'alternate'
			)
		),
		array( 'param_name' => 'submit_button_size', 'default' => 'small', 'type' => 'dropdown', 'heading' => esc_html__( 'Submit button size', 'ajani' ),
			'value' => array(
				esc_html__( 'Inherit', 'ajani' ) => 'normal',
				esc_html__( 'Small', 'ajani' ) => 'small',
				esc_html__( 'Normal', 'ajani' ) => 'normal',
				esc_html__( 'Medium', 'ajani' ) => 'medium',
				esc_html__( 'Large', 'ajani' ) => 'large'				
			)
		),
		array( 'param_name' => 'submit_button_alignment', 'default' => 'inherit', 'type' => 'dropdown', 'heading' => esc_html__( 'Submit button alignment', 'ajani' ),
			'value' => array(
				esc_html__( 'Inherit', 'ajani' ) => 'inherit',
				esc_html__( 'Left', 'ajani' ) => 'left',
				esc_html__( 'Right', 'ajani' ) => 'right',
				esc_html__( 'Center', 'ajani' ) => 'center'				
			)
		),
		array( 'param_name' => 'input_fields_style', 'type' => 'dropdown', 'heading' => esc_html__( 'Input fields style', 'ajani' ), 
			'value' => array(
				esc_html__( 'Filled', 'ajani' ) => 'filled',
				esc_html__( 'Outline', 'ajani' ) => 'outline'
			)
		),
		array( 'param_name' => 'background', 'type' => 'dropdown', 'heading' => esc_html__( 'Background or border color, depending the style selected previously)', 'ajani' ),
			'value' => array(
				esc_html__( 'Inherit', 'ajani' ) => '',
				esc_html__( 'Light', 'ajani' ) => 'light',
				esc_html__( 'Transparent light', 'ajani' ) => 'transparent_light',
				esc_html__( 'Transparent dark', 'ajani' ) => 'transparent_dark'
			)
		),
	));
}

function ajani_bt_bb_contact_form_7_class( $class, $atts ) {
	if ( isset( $atts['submit_button_style'] ) && $atts['submit_button_style'] != '' ) {
		$class[] = 'bt_bb_submit_button_style' . '_' . $atts['submit_button_style'];
	}
	if ( isset( $atts['submit_button_size'] ) && $atts['submit_button_size'] != '' ) {
		$class[] = 'bt_bb_submit_button_size' . '_' . $atts['submit_button_size'];
	}
	if ( isset( $atts['submit_button_alignment'] ) && $atts['submit_button_alignment'] != '' ) {
		$class[] = 'bt_bb_submit_button_alignment' . '_' . $atts['submit_button_alignment'];
	}
	if ( isset( $atts['input_fields_style'] ) && $atts['input_fields_style'] != '' ) {
		$class[] = 'bt_bb_input_fields_style' . '_' . $atts['input_fields_style'];
	}
	if ( isset( $atts['background'] ) && $atts['background'] != '' ) {
		$class[] = 'bt_bb_background' . '_' . $atts['background'];
	}
	return $class;
}
add_filter( 'bt_bb_contact_form_7_class', 'ajani_bt_bb_contact_form_7_class', 10, 2 );



// TABS - WIDE TABS HEADER
if ( function_exists( 'bt_bb_add_params' ) ) {
	bt_bb_add_params( 'bt_bb_tabs', array(		
		array( 'param_name' => 'wide_tabs_header', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'wide_tabs_header' ),  'heading' => esc_html__( 'Wide tabs header', 'ajani' ), 'preview' => true ),
	));
}

function ajani_bt_bb_tabs_class( $class, $atts ) {
	if ( isset( $atts['wide_tabs_header'] ) && $atts['wide_tabs_header'] != '' ) {
		$class[] = "bt_bb_wide_tabs_header";
	}
	return $class;
}
add_filter( 'bt_bb_tabs_class', 'ajani_bt_bb_tabs_class', 10, 2 );


// MASONRY IMAGE GRID - GAP
if ( function_exists( 'bt_bb_remove_params' ) ) {	
	bt_bb_remove_params( 'bt_bb_masonry_image_grid', 'gap' );
}

if ( function_exists( 'bt_bb_add_params' ) ) {
	bt_bb_add_params( 'bt_bb_masonry_image_grid', array(
		array( 'param_name' => 'gap', 'type' => 'dropdown', 'heading' => esc_html__( 'Gap', 'ajani' ), 
			'value' => array(
				esc_html__( 'None', 'ajani' ) 		=> '',
				esc_html__( 'Extra small', 'ajani' ) 	=> 'extrasmall',
				esc_html__( 'Small', 'ajani' ) 		=> 'small',
				esc_html__( 'Normal', 'ajani' ) 		=> 'normal',
				esc_html__( 'Medium', 'ajani' ) 		=> 'medium',
				esc_html__( 'Large', 'ajani' ) 		=> 'large',
				esc_html__( 'Extra large', 'ajani' ) 	=> 'extralarge'
			)
		)
	));
}


/* FRONT END 
---------------------------------------------------------- */

/* OLD ELEMENTS */
function bt_bb_fe_new_params( $elements_array) {

	$elements_array[ 'bt_bb_icon' ][ 'params' ][ 'text_size' ] = array( 'ajax_filter' => array( 'class' ) );
	$elements_array[ 'bt_bb_icon' ][ 'params' ][ 'icon_padding' ] = array( 'ajax_filter' => array( 'class' ) );
	$elements_array[ 'bt_bb_icon' ][ 'params' ][ 'text_color_scheme' ] = array( 'ajax_filter' => array( 'class', 'style' ) );

	$elements_array[ 'bt_bb_button' ][ 'params' ][ 'icon_size' ] = array( 'ajax_filter' => array( 'class' ) );
	$elements_array[ 'bt_bb_button' ][ 'params' ][ 'icon_color_scheme' ] = array( 'ajax_filter' => array( 'class', 'style' ) );

    return $elements_array;
}
add_filter( 'bt_bb_fe_elements', 'bt_bb_fe_new_params' );

/* NEW ELEMENTS */
function ajani_bt_bb_fe( $elements ) {
	$elements[ 'bt_bb_contact_form_7' ] = array(
		'edit_box_selector' => '',
		'params' => array(
			'submit_button_style'				=> array( 'ajax_filter' => array( 'class' ) ),
			'submit_button_size'				=> array( 'ajax_filter' => array( 'class' ) ),
			'submit_button_alignment'			=> array( 'ajax_filter' => array( 'class' ) ),
			'input_fields_style'				=> array( 'ajax_filter' => array( 'class' ) ),
			'background'						=> array( 'ajax_filter' => array( 'class' ) ),
		),
	);
	$elements[ 'bt_bb_bulleted_list' ] = array(
		'edit_box_selector' => '',
		'params' => array(
			'icon'					=> array(),
			'icon_color_scheme'		=> array( 'ajax_filter' => array( 'class' ) ),
			'icon_size'				=> array( 'js_handler' => array( 'target_selector' => '', 'type' => 'class' ) ),
			'items'					=> array(),
		),
	);
	$elements[ 'bt_bb_card' ] = array(
		'edit_box_selector' => '',
		'params' => array(
			'image_position'  				=> array(),
			'read_more_link'      			=> array( 'js_handler' => array( 'target_selector' => 'a', 'type' => 'attr', 'attr' => 'href' ) ),
			'read_more_text'				=> array(),
			'read_more_icon'				=> array(),
			'read_more_icon_color_scheme'   => array(),		
			'style'							=> array( 'js_handler' => array( 'target_selector' => '', 'type' => 'class' ) ),
			'shape'							=> array( 'js_handler' => array( 'target_selector' => '', 'type' => 'class' ) ),
		),
	);
	$elements[ 'bt_bb_process_step' ] = array(
		'edit_box_selector' => '',
		'params' => array(
			'title'					=> array( 'js_handler' => array( 'target_selector' => '.bt_bb_process_step_title', 'type' => 'inner_html' ) ),
			'size'					=> array( 'ajax_filter' => array( 'class' ) ),
			'text'					=> array( 'js_handler' => array( 'target_selector' => '.bt_bb_process_step_text', 'type' => 'inner_html' ) ),
			'icon'					=> array(),		
		),
	);
	$elements[ 'bt_bb_quote' ] = array(
		'edit_box_selector' => '',
		'params' => array(
			'quote'					=> array( 'js_handler' => array( 'target_selector' => '', 'type' => 'inner_html' ) ),
			'quote_icon'			=> array(),	
			'quote_size'			=> array( 'js_handler' => array( 'target_selector' => '', 'type' => 'class' ) ),		
		),
	);
	$elements[ 'bt_bb_testimonial' ] = array(
		'edit_box_selector' => '',
		'params' => array(
			'layout'				=> array( 'js_handler' => array( 'target_selector' => '', 'type' => 'class' ) ),
			'image'					=> array(),	
			'image_size'			=> array( 'js_handler' => array( 'target_selector' => '', 'type' => 'class' ) ),	
			'image_shape'			=> array( 'js_handler' => array( 'target_selector' => '', 'type' => 'class' ) ),
			'star_number'			=> array(),		
			'star_color'			=> array( 'js_handler' => array( 'target_selector' => '', 'type' => 'class' ) ),
			'title'					=> array( 'js_handler' => array( 'target_selector' => '.bt_bb_testimonial_content .bt_bb_headline_content span', 'type' => 'inner_html' ) ),		
			'title_size'			=> array(),		
			'author_text'			=> array( 'js_handler' => array( 'target_selector' => '.bt_bb_testimonial_author_text', 'type' => 'inner_html' ) ),		
			'author_size'			=> array( 'js_handler' => array( 'target_selector' => '', 'type' => 'class' ) ),
			'subauthor_text'		=> array( 'js_handler' => array( 'target_selector' => 'bt_bb_testimonial_subauthor_text', 'type' => 'inner_html' ) ),
		),
	);
	$elements[ 'bt_bb_working_hours' ] = array(
		'edit_box_selector' => '',
		'params' => array(
			'wh_content'    => array(),	
			'size'			=> array( 'js_handler' => array( 'target_selector' => '', 'type' => 'class' ) ),
		),
	);
	$elements[ 'bt_bb_floating_image' ] = array(
		'edit_box_selector' => '',
		'params' => array(
			'image'      	=> array(),
		),
	);
	$elements[ 'bt_bb_floating_element' ] = array(
		'edit_box_selector' => '',
		'params' => array(
			'background_image'				=> array( 'js_handler' => array( 'target_selector' => '', 'type' => 'background_image' ) ),
		),
	);

	return $elements;
}

add_filter( 'bt_bb_fe_elements', 'ajani_bt_bb_fe' );

