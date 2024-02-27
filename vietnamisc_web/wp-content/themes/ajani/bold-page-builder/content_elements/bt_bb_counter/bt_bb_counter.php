<?php

class bt_bb_counter extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'number'   => '',
			'size'     => '',
			'font'     => '',
			'font_subset'    => '',
			'font_color'     => ''
		) ), $atts, $this->shortcode ) );
		
		if ( isset( $font ) && $font != '' && $font != 'inherit' ) {
			if ( function_exists('bt_bb_enqueue_google_font') ) {
				bt_bb_enqueue_google_font( $font, $font_subset );
			}
		}
		
		$class = array( $this->shortcode, 'bt_bb_counter_holder'); 
		
		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}
		
		if ( $font != '' && $font != 'inherit' ) {
			$el_style .= 'font-family:\'' . urldecode_deep( $font ) . '\';';
		}
		
		if ( $font_color != '' ){
			$el_style .= 'color: ' . $font_color . ';';
		}

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}

		$this->responsive_data_override_class(
			$class, $data_override_class,
			array(
				'prefix' => $this->prefix,
				'param' => 'size',
				'value' => $size
			)
		);
				
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		$class_attr = implode( ' ', $class );
		
		if ( $el_class != '' ) {
			$class_attr = $class_attr . ' ' . $el_class;
		}
		
		$strlen = mb_strlen( $number, 'UTF-8' );
		$number = $this->msplit( $number );

		$output = '';
		$output .= '<div' . $id_attr . ' class="' . esc_attr( $class_attr ) . '"' . $style_attr . ' data-bt-override-class="' . htmlspecialchars( json_encode( $data_override_class, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '">';
			$output .= '<span class="bt_bb_counter animate" data-digit-length="' . esc_attr( $strlen ) . '">';			
				for ( $i = 0; $i < $strlen; $i++ ) {	
					if ( ctype_digit( $number[ $i ] ) ) {
						$output .= '<span class="onedigit p' . ( $strlen - $i ) . ' d' . $number[ $i ] . '" data-digit="' . esc_attr( $number[ $i ] ) . '">';
							for ( $j = 0; $j <= 9; $j++ ) {
								$output .= '<span class="n' . $j . '">' . $j . '</span>';
							}
							$output .= '<span class="n0">0</span>';	
						$output .= '</span>';							
					} else {
						$output .= '<span class="onedigit p' . ( $strlen - $i ) . ' d0" data-digit="' . esc_attr( $number[ $i ] ) . '">';	
							for ( $j = 0; $j <= 9; $j++ ) {
								$output .= '<span class="n' . $j . '"> &nbsp; </span>';
							}
							$output .= '<span class="n0 t">' . $number[ $i ] . '</span>';	
						$output .= '</span>';
					}
				}			
			$output .= '</span>';
		$output .= '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );
			
		return $output;
	}
	
	function msplit( $str, $len = 1 ) {
		$arr = array();
		$length = mb_strlen( $str, 'UTF-8' );
		for ( $i = 0; $i < $length; $i += $len ) {
			$arr[] = mb_substr( $str, $i, $len, 'UTF-8' );
		}
		return $arr;
	}

	function map_shortcode() {

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Counter', 'ajani' ), 'description' => esc_html__( 'Animated counter', 'ajani' ),  
			'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(				
				array( 'param_name' => 'number', 'type' => 'textfield', 'heading' => esc_html__( 'Number', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'size', 'type' => 'dropdown', 'heading' => esc_html__( 'Size', 'ajani' ), 'preview' => true,
					'responsive_override' => true, 'value' => array(
						esc_html__( 'Inherit', 'ajani' ) 	=> 'inherit',
						esc_html__( 'Extra Small', 'ajani' ) => 'xsmall',
						esc_html__( 'Small', 'ajani' ) 		=> 'small',
						esc_html__( 'Normal', 'ajani' ) 		=> 'normal',
						esc_html__( 'Medium', 'ajani' ) 		=> 'medium',
						esc_html__( 'Large', 'ajani' ) 		=> 'large',
						esc_html__( 'Extra large', 'ajani' ) => 'xlarge',
						esc_html__( 'Huge', 'ajani' ) 		=> 'huge',
						esc_html__( 'Extra huge', 'ajani' ) 		=> 'xhuge'
				) ),
				array( 'param_name' => 'font', 'type' => 'dropdown', 'heading' => esc_html__( 'Font', 'ajani' ), 'group' => esc_html__( 'Font', 'ajani' ), 'preview' => true,
					'value' => array( esc_html__( 'Inherit', 'ajani' ) => 'inherit' ) + BT_BB_Root::$font_arr
				),
				array( 'param_name' => 'font_subset', 'type' => 'textfield', 'heading' => esc_html__( 'Google Font subset', 'ajani' ), 'group' => esc_html__( 'Font', 'ajani' ), 'value' => 'latin,latin-ext', 'description' => 'E.g. latin,latin-ext,cyrillic,cyrillic-ext' ),
				array( 'param_name' => 'font_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Font color', 'ajani' ), 'group' => esc_html__( 'Font', 'ajani' ), 'preview' => true ),
			)
		) );

	}
}