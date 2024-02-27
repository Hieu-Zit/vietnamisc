<?php

class bt_bb_separator extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'top_spacing'		=> '',
			'bottom_spacing'	=> '',
			'border_style'		=> '',
			'border_color'		=> '',
			'border_width'		=> '',
			'text'				=> '',
			'text_size'			=> '',
			'text_color'		=> '',
			'text_weight'		=> ''			
		) ), $atts, $this->shortcode ) );
		
		$class = array( $this->shortcode );
		
		if ( $el_class != '' ) {
			$class[] = $el_class;
		}
		
		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}
		
		$this->responsive_data_override_class(
			$class, $data_override_class,
			array(
				'prefix' => $this->prefix,
				'param' => 'top_spacing',
				'value' => $top_spacing
			)
		);
		
		$this->responsive_data_override_class(
			$class, $data_override_class,
			array(
				'prefix' => $this->prefix,
				'param' => 'bottom_spacing',
				'value' => $bottom_spacing
			)
		);
		
		if ( $border_style != '' ) {
			$class[] = $this->prefix . 'border_style' . '_' . $border_style;
		}
		
		if ( $border_color != '' ) {
			$class[] = $this->prefix . 'border_color' . '_' . $border_color;
		}

		if ( $border_width != '' ) {
			//$el_style = $el_style . 'border-width: ' . $border_width . ';';
			if ( $border_style == 'none' ) {
				$el_style = $el_style . 'border-color: transparent; border-style: solid;';
			}
		}
		
		$text_style = '';
		$text = html_entity_decode( $text, ENT_QUOTES, 'UTF-8' );
		if ( $text != '' ) {
			$text = nl2br( $text );
			$class[] = esc_attr( $this->shortcode ) . '_text';
			
			$text_class = array( esc_attr( $this->shortcode ) . '_text' );
			if ( $text_size != '' ) {
				$class[] = $this->prefix . 'text_size' . '_' . $text_size;
				$text_class[] = $this->prefix . 'text_size' . '_' . $text_size;
			}
			if ( $text_color != '' ) {
				$text_style .= 'color: ' . $text_color . ';';
			}
			if ( $text_weight != '' ) {
				$class[] = $this->prefix . 'text_weight' . '_' . $text_weight;
				$text_class[] = $this->prefix . 'text_weight' . '_' . $text_weight;
			}
			
			if ( $border_width != '' ) {
				$text_style .= 'border-width: ' . $border_width . ';';
				if ( $border_style == 'none' ) {
					$text_style = $text_style . 'border-color: transparent; border-style: solid;';
				}
			}
			
			$text_style = ' style="' . esc_attr( $text_style ) . '"';
			
			$text = '<span class="bt_bb_separator_text_border" ' . $text_style . '></span><span class="' . implode( ' ', $text_class ) . '"' . $text_style . '>' . $text . '</span><span  class="bt_bb_separator_text_border" ' . $text_style . '></span>';
		}else{
			if ( $border_width != '' ) {
				$el_style = $el_style . 'border-width: ' . $border_width . ';';
				if ( $border_style == 'none' ) {
					$el_style = $el_style . 'border-color: transparent; border-style: solid;';
				}
			}
		}
		
		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		
		$output = '<div' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . ' data-bt-override-class="' . htmlspecialchars( json_encode( $data_override_class, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '">' . $text . '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );
		
		return $output;

	}

	function map_shortcode() {
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Separator', 'ajani' ), 'description' => esc_html__( 'Separator line', 'ajani' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array( 
				array( 'param_name' => 'top_spacing', 'type' => 'dropdown', 'heading' => esc_html__( 'Top spacing', 'ajani' ), 'preview' => true,
					'value' => array(
						esc_html__( 'No spacing', 'ajani' ) => 'none',
						esc_html__( 'Extra small', 'ajani' ) => 'extra_small',
						esc_html__( 'Small', 'ajani' ) => 'small',		
						esc_html__( 'Normal', 'ajani' ) => 'normal',
						esc_html__( 'Medium', 'ajani' ) => 'medium',
						esc_html__( 'Large', 'ajani' ) => 'large',
						esc_html__( 'Extra large', 'ajani' ) => 'extra_large',
						esc_html__( '5px', 'ajani' ) => '5',
						esc_html__( '10px', 'ajani' ) => '10',
						esc_html__( '15px', 'ajani' ) => '15',
						esc_html__( '20px', 'ajani' ) => '20',
						esc_html__( '25px', 'ajani' ) => '25',
						esc_html__( '30px', 'ajani' ) => '30',
						esc_html__( '35px', 'ajani' ) => '35',
						esc_html__( '40px', 'ajani' ) => '40',
						esc_html__( '45px', 'ajani' ) => '45',
						esc_html__( '50px', 'ajani' ) => '50',
						esc_html__( '60px', 'ajani' ) => '60',
						esc_html__( '70px', 'ajani' ) => '70',
						esc_html__( '80px', 'ajani' ) => '80',
						esc_html__( '90px', 'ajani' ) => '90',
						esc_html__( '100px', 'ajani' ) => '100',
						esc_html__( '110px', 'ajani' ) => '110',
						esc_html__( '120px', 'ajani' ) => '120',
						esc_html__( '130px', 'ajani' ) => '130',
						esc_html__( '140px', 'ajani' ) => '140',
						esc_html__( '150px', 'ajani' ) => '150'
					)
				),
				array( 'param_name' => 'bottom_spacing', 'type' => 'dropdown', 'heading' => esc_html__( 'Bottom spacing', 'ajani' ), 'preview' => true,
					'value' => array(
						esc_html__( 'No spacing', 'ajani' ) 	=> 'none',
						esc_html__( 'Extra small', 'ajani' ) 	=> 'extra_small',
						esc_html__( 'Small', 'ajani' ) 		=> 'small',		
						esc_html__( 'Normal', 'ajani' ) 		=> 'normal',
						esc_html__( 'Medium', 'ajani' ) 		=> 'medium',
						esc_html__( 'Large', 'ajani' ) 		=> 'large',
						esc_html__( 'Extra large', 'ajani' ) 	=> 'extra_large',
						esc_html__( '5px', 'ajani' ) 			=> '5',
						esc_html__( '10px', 'ajani' ) 		=> '10',
						esc_html__( '15px', 'ajani' ) 		=> '15',
						esc_html__( '20px', 'ajani' ) 		=> '20',
						esc_html__( '25px', 'ajani' ) 		=> '25',
						esc_html__( '30px', 'ajani' ) 		=> '30',
						esc_html__( '35px', 'ajani' ) => '35',
						esc_html__( '40px', 'ajani' ) => '40',
						esc_html__( '45px', 'ajani' ) => '45',
						esc_html__( '50px', 'ajani' ) => '50',
						esc_html__( '60px', 'ajani' ) => '60',
						esc_html__( '70px', 'ajani' ) => '70',
						esc_html__( '80px', 'ajani' ) => '80',
						esc_html__( '90px', 'ajani' ) => '90',
						esc_html__( '100px', 'ajani' ) => '100',
						esc_html__( '110px', 'ajani' ) => '110',
						esc_html__( '120px', 'ajani' ) => '120',
						esc_html__( '130px', 'ajani' ) => '130',
						esc_html__( '140px', 'ajani' ) => '140',
						esc_html__( '150px', 'ajani' ) => '150'
					)
				),				
				array( 'param_name' => 'border_style', 'type' => 'dropdown', 'heading' => esc_html__( 'Border style', 'ajani' ), 'preview' => true,
					'value' => array(
						esc_html__( 'None', 'ajani' ) 	=> 'none',
						esc_html__( 'Solid', 'ajani' ) 	=> 'solid',
						esc_html__( 'Dotted', 'ajani' ) 	=> 'dotted',
						esc_html__( 'Dashed', 'ajani' ) 	=> 'dashed'
					)
				),
				array( 'param_name' => 'border_color', 'type' => 'dropdown', 'heading' => esc_html__( 'Border color', 'ajani' ), 'preview' => true,
					'value' => array(
						esc_html__( 'Default', 'ajani' ) 			=> '',
						esc_html__( 'Dark transparent color', 'ajani' ) 		=> 'dark_transparent',
						esc_html__( 'Light transparent color', 'ajani' ) 		=> 'light_transparent',
						esc_html__( 'Dark color', 'ajani' ) 		=> 'dark',
						esc_html__( 'Light color', 'ajani' ) 		=> 'light',
						esc_html__( 'Accent color', 'ajani' ) 	=> 'accent',
						esc_html__( 'Alternate color', 'ajani' ) 	=> 'alternate',
						esc_html__( 'Gray color', 'ajani' ) 		=> 'gray'
					)
				),
				array( 'param_name' => 'border_width', 'type' => 'textfield', 'heading' => esc_html__( 'Border width', 'ajani' ), 'description' => esc_html__( 'E.g. 5px or 1em', 'ajani' ) ),
				array( 'param_name' => 'text', 'type' => 'textfield', 'heading' => esc_html__( 'Text', 'ajani' ), 'group' => esc_html__( 'Text', 'ajani' ) ),
				array( 'param_name' => 'text_size', 'type' => 'dropdown', 'heading' => esc_html__( 'Text size', 'ajani' ), 'group' => esc_html__( 'Text', 'ajani' ), 'preview' => true,
					'value' => array(
						esc_html__( 'Small', 'ajani' ) => 'small',		
						esc_html__( 'Normal', 'ajani' ) => 'normal',
						esc_html__( 'Medium', 'ajani' ) => 'medium',
						esc_html__( 'Large', 'ajani' ) => 'large'
					)
				),
				array( 'param_name' => 'text_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Text color', 'ajani' ), 'group' => esc_html__( 'Text', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'text_weight', 'type' => 'dropdown', 'heading' => esc_html__( 'Text font weight', 'ajani' ), 'group' => esc_html__( 'Text', 'ajani' ),
					'value' => array(
						esc_html__( 'Default', 'ajani' ) => '',
						esc_html__( 'Normal', 'ajani' ) => 'normal',
						esc_html__( 'Bold', 'ajani' ) => 'bold',
						esc_html__( 'Bolder', 'ajani' ) => 'bolder',
						esc_html__( 'Lighter', 'ajani' ) => 'lighter',
						esc_html__( 'Light', 'ajani' ) => 'light',
						esc_html__( 'Thin', 'ajani' ) => 'thin',
						esc_html__( 'Font weight 100', 'ajani' ) => '100',
						esc_html__( 'Font weight 200', 'ajani' ) => '200',
						esc_html__( 'Font weight 300', 'ajani' ) => '300',
						esc_html__( 'Font weight 400', 'ajani' ) => '400',
						esc_html__( 'Font weight 500', 'ajani' ) => '500',
						esc_html__( 'Font weight 600', 'ajani' ) => '600',
						esc_html__( 'Font weight 700', 'ajani' ) => '700',
						esc_html__( 'Font weight 800', 'ajani' ) => '800',
						esc_html__( 'Font weight 900', 'ajani' ) => '900'
					)
				),
			)
		) );
	}
}