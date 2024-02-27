<?php


class bt_bb_floating_element extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts', array(
			'background_image'      		=> '',
			'background_color'				=> '',
			'inline_css_style'      		=> '',
			'horizontal_position'  			=> 'left',
			'vertical_position'  			=> 'top',
			'animation_style'  				=> 'ease_out',
			'animation_delay'  				=> 'default',
			'animation_duration'  			=> '',
			'animation_speed'  				=> '1.0',
			'lazy_load'  					=> 'no'
		) ), $atts, $this->shortcode ) );
		
		wp_enqueue_script(
			'bt_bb_floating_element',
			get_template_directory_uri() . '/bold-page-builder/content_elements/bt_bb_floating_element/bt_bb_floating_element.js',
			array( 'jquery' ),
			'',
			true
		);
		
		$class = array( $this->shortcode );

		if ( $el_class != '' ) {
			$class[] = $el_class;
		}

		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}
		if ( $horizontal_position != '' ) {
			$class[] = $this->shortcode . '_horizontal_position' . '_' . $horizontal_position;
		}
		if ( $vertical_position != '' ) {
			$class[] = $this->shortcode . '_vertical_position' . '_' . $vertical_position;
		}
		if ( $animation_delay != '' ) {
			$class[] = $this->shortcode . '_animation_delay' . '_' . $animation_delay;
		}
		if ( $animation_duration != '' ) {
			$class[] = $this->shortcode . '_animation_duration' . '_' . $animation_duration;
		}
		if ( $animation_style != '' ) {
			$class[] = $this->shortcode . '_animation_style' . '_' . $animation_style;
		}	
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );		
	
		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}	
		
		$style_attr_span = "";
		if ( $inline_css_style != '' ) {
				$style_attr_span .=  esc_attr( $inline_css_style );
		}
		if ( $background_color != '' ) {
			if ( strpos( $background_color, '#' ) !== false ) {
				$background_color = bt_bb_hex2rgb( $background_color );
				$opacity = 1;
				$style_attr_span .= 'background-color: rgba(' . $background_color[0] . ', ' . $background_color[1] . ', ' . $background_color[2] . ', ' . $opacity . ');';
			}else{
				$style_attr_span .= 'background-color: ' . $background_color . ';';
			}
		}
		$background_data_attr = "";
		if ( $background_image != '' ) {
			$background_image = wp_get_attachment_image_src( $background_image, 'full' );
			if ( isset($background_image[0]) ){
				$background_image_url = $background_image[0];
				if ( $lazy_load == 'yes' ) {
					$blank_image_src = BT_BB_Root::$path . 'img/blank.gif';
					$style_attr_span .= 'background-image:url(\'' . $background_image_url . '\');';
					$background_data_attr .= ' data-background_image_src=\'' . $background_image_url . '\'';
					$class[] = 'btLazyLoadBackground';
				} else {
					$style_attr_span .= 'background-image:url(\'' . $background_image_url . '\');';				
				}
			}
		}
		if ( $style_attr_span != '' ) {
				$style_attr_span = ' ' . 'style="' . esc_attr( $style_attr_span ) . '"';
		}
		
		$output = '';		
		$output .=  '<div class="' . esc_attr( $this->shortcode . '_html') . '" data-speed="' . esc_attr( $animation_speed ) . '"><span ' . $style_attr_span . '></span></div>';
		$output = '<div' . $id_attr . ' class="' . esc_attr( implode( ' ', $class ) ) . '"' . $style_attr . $background_data_attr . ' data-speed="' . esc_attr( $animation_speed ) . '">' . ( $output ) . '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;
		
	}
	function map_shortcode() {

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Floating element', 'ajani' ), 'description' => esc_html__( 'Absolute positioned CSS styled floating element.', 'ajani' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'background_image', 'type' => 'attach_image', 'preview' => true, 'heading' => esc_html__( 'Background image', 'ajani' ) 
				),
				array( 'param_name' => 'background_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Background color', 'ajani' ) ),
				array( 'param_name' => 'inline_css_style', 'type' => 'textfield', 'heading' => esc_html__( 'Inline css style', 'ajani' ), 'preview' => true ),
				
				array( 'param_name' => 'vertical_position', 'preview' => true, 'default' => '', 'type' => 'dropdown', 'heading' => esc_html__( 'Vertical position', 'ajani' ), 
					'value' => array(
						esc_html__( 'Default', 'ajani' ) 				=> 'default',
						esc_html__( 'Top (absolute)', 'ajani' ) 		=> 'top',
						esc_html__( 'Middle (absolute)', 'ajani' ) 	=> 'middle',
						esc_html__( 'Bottom (absolute)', 'ajani' ) 	=> 'bottom'
					)
				),
				array( 'param_name' => 'horizontal_position', 'preview' => true, 'default' => '', 'type' => 'dropdown', 'heading' => esc_html__( 'Horizontal position', 'ajani' ), 
					'value' => array(
						esc_html__( 'Default', 'ajani' ) 				=> 'default',
						esc_html__( 'Left (absolute)', 'ajani' ) 		=> 'left',
						esc_html__( 'Center (absolute)', 'ajani' ) 	=> 'center',
						esc_html__( 'Right (absolute)', 'ajani' ) 	=> 'right'
					)
				),
				array( 'param_name' => 'lazy_load', 'type' => 'dropdown', 'default' => 'no', 'heading' => esc_html__( 'Lazy load this image', 'ajani' ),
					'value' => array(
						esc_html__( 'No', 'ajani' ) 	=> 'no',
						esc_html__( 'Yes', 'ajani' ) 	=> 'yes'
					)
				),
				array( 'param_name' => 'animation_style', 'preview' => true, 'default' => 'ease_out', 'type' => 'dropdown', 'group' => esc_html__( 'Animation', 'ajani' ), 'heading' => esc_html__( 'Animation style (check https://easings.net/en)', 'ajani' ), 
					'value' => array(
						esc_html__( 'Ease out (default)', 'ajani' ) 		=> 'ease_out',
						esc_html__( 'Ease out sine', 'ajani' ) 			=> 'ease_out_sine',
						esc_html__( 'Ease in', 'ajani' ) 					=> 'ease_in',
						esc_html__( 'Ease in sine', 'ajani' ) 			=> 'ease_in_sine',
						esc_html__( 'Ease in out', 'ajani' ) 				=> 'ease_in_out',
						esc_html__( 'Ease in out sine', 'ajani' ) 		=> 'ease_in_out_sine',
						esc_html__( 'Ease in out bounce', 'ajani' ) 		=> 'ease_in_out_back'
					)
				),
				array( 'param_name' => 'animation_delay', 'default' => '', 'type' => 'dropdown', 'group' => esc_html__( 'Animation', 'ajani' ), 'heading' => esc_html__( 'Animation delay', 'ajani' ), 
					'value' => array(
						esc_html__( 'Default', 'ajani' ) 				=> 'default',
						esc_html__( '0ms', 'ajani' ) 					=> '0',
						esc_html__( '100ms', 'ajani' ) 				=> '100',
						esc_html__( '200ms', 'ajani' ) 				=> '200',
						esc_html__( '300ms', 'ajani' ) 				=> '300',
						esc_html__( '400ms', 'ajani' ) 				=> '400',
						esc_html__( '500ms', 'ajani' ) 				=> '500',
						esc_html__( '600ms', 'ajani' ) 				=> '600',
						esc_html__( '700ms', 'ajani' ) 				=> '700',
						esc_html__( '800ms', 'ajani' ) 				=> '800',
						esc_html__( '900ms', 'ajani' ) 				=> '900',
						esc_html__( '1000ms', 'ajani' ) 				=> '1000'
					)
				),
				array( 'param_name' => 'animation_duration', 'preview' => true, 'default' => '', 'type' => 'dropdown', 'group' => esc_html__( 'Animation', 'ajani' ), 'heading' => esc_html__( 'Animation duration', 'ajani' ), 
					'value' => array(
						esc_html__( 'Default', 'ajani' ) 				=> 'default',
						esc_html__( '0ms', 'ajani' ) 					=> '0',
						esc_html__( '100ms', 'ajani' ) 				=> '100',
						esc_html__( '200ms', 'ajani' ) 				=> '200',
						esc_html__( '300ms', 'ajani' ) 				=> '300',
						esc_html__( '400ms', 'ajani' ) 				=> '400',
						esc_html__( '500ms', 'ajani' ) 				=> '500',
						esc_html__( '600ms', 'ajani' ) 				=> '600',
						esc_html__( '700ms', 'ajani' ) 				=> '700',
						esc_html__( '800ms', 'ajani' ) 				=> '800',
						esc_html__( '900ms', 'ajani' ) 				=> '900',
						esc_html__( '1000ms', 'ajani' ) 				=> '1000',
						esc_html__( '1100ms', 'ajani' ) 				=> '1100',
						esc_html__( '1200ms', 'ajani' ) 				=> '1200',
						esc_html__( '1300ms', 'ajani' ) 				=> '1300',
						esc_html__( '1400ms', 'ajani' ) 				=> '1400',
						esc_html__( '1500ms', 'ajani' ) 				=> '1500',
						esc_html__( '2000ms', 'ajani' ) 				=> '2000',
						esc_html__( '2500ms', 'ajani' ) 				=> '2500',
						esc_html__( '3000ms', 'ajani' ) 				=> '3000',
						esc_html__( '3500ms', 'ajani' ) 				=> '3500',
						esc_html__( '4000ms', 'ajani' ) 				=> '4000',
						esc_html__( '5000ms', 'ajani' ) 				=> '5000',
						esc_html__( '6000ms', 'ajani' ) 				=> '6000'
					)
				),
				array( 'param_name' => 'animation_speed', 'preview' => true, 'default' => '1.0', 'type' => 'dropdown', 'group' => esc_html__( 'Animation', 'ajani' ), 'heading' => esc_html__( 'Animation s', 'ajani' ), 
					'value' => array(
						esc_html__( '0 (none)', 'ajani' ) 				=> '0',
						esc_html__( '0.4 (very short)', 'ajani' ) 		=> '0.4',
						esc_html__( '0.6', 'ajani' ) 						=> '0.6',
						esc_html__( '0.8', 'ajani' ) 						=> '0.8',
						esc_html__( '1.0', 'ajani' ) 						=> '1.0',
						esc_html__( '1.2 (default)', 'ajani' ) 			=> '1.2',
						esc_html__( '1.4', 'ajani' ) 						=> '1.4',
						esc_html__( '1.6 (long)', 'ajani' ) 				=> '1.6',
						esc_html__( '1.8', 'ajani' ) 						=> '1.8',
						esc_html__( '2.0 (very long)', 'ajani' ) 			=> '2.0',
						esc_html__( '2.5 (very very long)', 'ajani' ) 	=> '2.5'
					)
				)
			)
		) );
	}
}
