<?php

class bt_bb_column extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {

		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'width'                  => '',
			'width_lg'               => '',
			'width_md'               => '',
			'width_sm'               => '',
			'width_xs'               => '',
			'align'                  => 'left',
			'vertical_align'         => 'top',
			'padding'                => 'normal',
			'order'                  => '',
			'background_image'       => '',
			'lazy_load'              => 'no',
			'inner_background_image' => '',
			'color_scheme'           => '',
			'background_color'       => '',
			'inner_background_color' => '',
			'opacity'                => '',
			'top_border'             => '',
			'bottom_border'          => '',
			'left_border'            => '',
			'right_border'           => '',
			'border_color'           => '',
			'border_width'           => ''
		) ), $atts, $this->shortcode ) );

		$class = array( $this->shortcode );
		$data_override_class = array();
		
		$class[] = $this->get_responsive_class( $width, 'xl' );
		
		if ( $width_xs != '' ) {
			$class[] = $this->get_responsive_class( $width_xs, 'xs' );
		}
		if ( $width_sm != '' ) {
			$class[] = $this->get_responsive_class( $width_sm, 'sm' );
		}
		if ( $width_md != '' ) {
			$class[] = $this->get_responsive_class( $width_md, 'md' );
		}
		if ( $width_lg != '' ) {
			$class[] = $this->get_responsive_class( $width_lg, 'lg' );
		}

		if ( $el_class != '' ) {
			$class[] = $el_class;
		}
		
		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = 'id="' . esc_attr( $el_id ) . '"';
		}

		$color_scheme_id = NULL;
		if ( is_numeric ( $color_scheme ) ) {
			$color_scheme_id = $color_scheme;
		} else if ( $color_scheme != '' ) {
			$color_scheme_id = bt_bb_get_color_scheme_id( $color_scheme );
		}
		$color_scheme_colors = bt_bb_get_color_scheme_colors_by_id( $color_scheme_id - 1 );
		if ( $color_scheme_colors ) $el_style .= '; --column-primary-color:' . $color_scheme_colors[0] . '; --column-secondary-color:' . $color_scheme_colors[1] . ';';
		if ( $color_scheme != '' ) $class[] = $this->prefix . 'color_scheme_' .  $color_scheme_id;
		
		$this->responsive_data_override_class(
			$class, $data_override_class,
			array(
				'prefix' => $this->prefix,
				'param' => 'align',
				'value' => $align
			)
		);
		
		if ( $vertical_align != '' ) {
			$class[] = $this->prefix . 'vertical_align' . '_' . $vertical_align;
		}

		$this->responsive_data_override_class(
			$class, $data_override_class,
			array(
				'prefix' => $this->prefix,
				'param' => 'padding',
				'value' => $padding
			)
		);
		
		$this->responsive_override_class(
			$class,
			array(
				'prefix' => $this->prefix,
				'ignore' => '0',
				'param'  => 'order',
				'value'  => $order
			)
		);
		
		if ( $top_border != '' ) {
			$class[] = "bt_bb_top_border";
		}
		if ( $bottom_border != '' ) {
			$class[] = "bt_bb_bottom_border";
		}
		if ( $left_border != '' ) {
			$class[] = "bt_bb_left_border";
		}
		if ( $right_border != '' ) {
			$class[] = "bt_bb_right_border";
		}
		if ( $border_width != '' ) {
			$class[] = 'bt_bb_border_width' . '_' . $border_width;
		}

		if ( $background_color != '' ) {
			if ( strpos( $background_color, '#' ) !== false ) {
				$background_color = bt_bb_hex2rgb( $background_color );
				if ( $opacity == '' ) {
					$opacity = 1;
				}
				$el_style .= 'background-color:rgba(' . $background_color[0] . ', ' . $background_color[1] . ', ' . $background_color[2] . ', ' . $opacity . ');';
			} else {
				$el_style .= 'background-color:' . $background_color . ';';
			}
		}
		
		$el_inner_style = '';
		
		if ( $inner_background_color != '' ) {
			if ( strpos( $inner_background_color, '#' ) !== false ) {
				$inner_background_color = bt_bb_hex2rgb( $inner_background_color );
				if ( $opacity == '' ) {
					$opacity = 1;
				}
				$el_inner_style .= 'background-color:rgba(' . $inner_background_color[0] . ', ' . $inner_background_color[1] . ', ' . $inner_background_color[2] . ', ' . $opacity . ');';
			} else {
				$el_inner_style .= 'background-color:' . $inner_background_color . ';';
			}
		}
		
		if ( $border_color != '' ) {
			if ( strpos( $border_color, '#' ) !== false ) {
				$border_color = bt_bb_hex2rgb( $border_color );				
				$el_inner_style .= 'border-color:rgba(' . $border_color[0] . ', ' . $border_color[1] . ', ' . $border_color[2] . ', 1 );';
			} else {
				$el_inner_style .= 'border-color:' . $border_color . ';';
			}
		}
		
		$inner_class = array( $this->shortcode . '_content' );
		$background_data_attr = '';
		$inner_background_data_attr = '';
		
		if ( $background_image != '' ) {
			$background_image = wp_get_attachment_image_src( $background_image, 'full' );
			if ( $background_image ) {
				$background_image_url = $background_image[0];
				if ( $lazy_load == 'yes' ) {
					$blank_image_src = BT_BB_Root::$path . 'img/blank.gif';
					$el_style .= 'background-image:url(\'' . $blank_image_src . '\');';
					$background_data_attr .= ' data-background_image_src=\'' . $background_image_url . '\'';
					$class[] = 'btLazyLoadBackground';
				} else {
					$el_style .= 'background-image:url(\'' . $background_image_url . '\');';				
				}
			}
				
			$class[] = 'bt_bb_column_background_image';
		}
		
		if ( $inner_background_image != '' ) {
			$inner_background_image = wp_get_attachment_image_src( $inner_background_image, 'full' );
			$inner_background_image_url = $inner_background_image[0];
			if ( $lazy_load == 'yes' ) {
				$blank_image_src = BT_BB_Root::$path . 'img/blank.gif';
				$el_inner_style .= 'background-image:url(\'' . $blank_image_src . '\');';
				$inner_background_data_attr .= ' data-background_image_src="' . esc_attr( $inner_background_image_url ) . '"';
				$inner_class[] = 'btLazyLoadBackground';
			} else {
				$el_inner_style .= 'background-image:url(\'' . $inner_background_image_url . '\');';				
			}
			$class[] = 'bt_bb_column_inner_background_image';
		}
		
		if ( $el_inner_style != '' ) {
			$el_inner_style = ' style="' . esc_attr( $el_inner_style ) . '"';
		}
		
		$style_attr = '';

		if ( $el_style != '' ) {
			$style_attr = 'style="' . esc_attr( $el_style ) . '"';
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );

		$output = '<div ' . $id_attr . ' class="' . implode( ' ', $class ) . '" ' . $style_attr . $background_data_attr . ' data-width="' . esc_attr( $this->get_width2( $width ) ) . '" data-bt-override-class="' . htmlspecialchars( json_encode( $data_override_class, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '">';
			$output .= '<div class="' . esc_attr( implode( ' ', $inner_class ) ) . '"' . $el_inner_style . $inner_background_data_attr . '>';
				$output .= '<div class="' . esc_attr( $this->shortcode . '_content_inner' ) . '">';
					$output .= do_shortcode( $content );
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}
	
	function get_responsive_class( $width, $size ) {
		
		$width = $this->get_width1( $width );

		$class = 'col-' . $size . '-' . $width;
		
		return $class;
	}
	
	function get_width1( $width ) {
		$array = explode( '/', $width );

		if ( empty( $array ) || $array[0] == 0 || $array[1] == 0 ) {
			$width = 12;
		} else {
			$top = $array[0];
			$bottom = $array[1];
			$width = 12 * $top / $bottom;
			if ( $width < 1 || $width > 12 ) {
				$width = 12;
			}
		}
		
		$width = str_replace( '.', '_', $width );
		
		return $width;
	}
	
	function get_width2( $width ) {
		$array = explode( '/', $width );

		if ( empty( $array ) || $array[0] == 0 || $array[1] == 0 ) {
			$width = 12;
		} else {
			$top = $array[0];
			$bottom = $array[1];
			$width = 12 * $top / $bottom;
			if ( $width < 1 || $width > 12 ) {
				$width = 12;
			}
		}
		
		return $width;
	}

	function map_shortcode() {
		require_once( WP_PLUGIN_DIR   .  '/bold-page-builder/content_elements_misc/misc.php' );
		$color_scheme_arr = bt_bb_get_color_scheme_param_array();
		
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Column', 'ajani' ), 'description' => esc_html__( 'Column element', 'ajani' ), 'width_param' => 'width', 'container' => 'vertical', 'accept' => array( 'bt_bb_section' => false, 'bt_bb_row' => false, 'bt_bb_column' => false, 'bt_bb_column_inner' => false, 'bt_bb_tab_item' => false, 'bt_bb_accordion_item' => false, 'bt_bb_cost_calculator_item' => false, 'bt_cc_group' => false, 'bt_cc_multiply' => false, 'bt_cc_item' => false, 'bt_bb_content_slider_item' => false, 'bt_bb_google_maps_location' => false, '_content' => false ), 'accept_all' => true, 'toggle' => false, 'responsive_override' => true,
			'params' => array(
				array( 'param_name' => 'align', 'type' => 'dropdown', 'heading' => esc_html__( 'Align', 'ajani' ), 'preview' => true, 'responsive_override' => true,
					'value' => array(
						esc_html__( 'Left', 'ajani' ) => 'left',
						esc_html__( 'Center', 'ajani' ) => 'center',
						esc_html__( 'Right', 'ajani' ) => 'right'
					)
				),
				array( 'param_name' => 'vertical_align', 'type' => 'dropdown', 'heading' => esc_html__( 'Vertical align', 'ajani' ), 'preview' => true,
					'value' => array(
						esc_html__( 'Top', 'ajani' )     => 'top',
						esc_html__( 'Middle', 'ajani' )  => 'middle',
						esc_html__( 'Bottom', 'ajani' )  => 'bottom'
					)
				),				
				array( 'param_name' => 'padding', 'type' => 'dropdown', 'heading' => esc_html__( 'Padding', 'ajani' ), 'preview' => true,
					'responsive_override' => true, 'value' => array(
						esc_html__( 'Normal', 'ajani' ) 		=> 'normal',
						esc_html__( 'Double', 'ajani' ) 		=> 'double',
						esc_html__( 'Text indent', 'ajani' ) 		=> 'text_indent',
						esc_html__( '0px', 'ajani' ) 			=> '0',
						esc_html__( '5px', 'ajani' ) 			=> '5',
						esc_html__( '10px', 'ajani' ) 		=> '10',
						esc_html__( '15px', 'ajani' ) 		=> '15',
						esc_html__( '20px', 'ajani' ) 		=> '20',
						esc_html__( '25px', 'ajani' ) 		=> '25',
						esc_html__( '30px', 'ajani' ) 		=> '30',
						esc_html__( '35px', 'ajani' ) 		=> '35',
						esc_html__( '40px', 'ajani' ) 		=> '40',
						esc_html__( '45px', 'ajani' ) 		=> '45',
						esc_html__( '50px', 'ajani' ) 		=> '50',
						esc_html__( '60px', 'ajani' ) 		=> '60',
						esc_html__( '70px', 'ajani' ) 		=> '70',
						esc_html__( '80px', 'ajani' ) 		=> '80',
						esc_html__( '90px', 'ajani' ) 		=> '90',
						esc_html__( '100px', 'ajani' ) 		=> '100',
						esc_html__( '110px', 'ajani' ) 		=> '110',
						esc_html__( '120px', 'ajani' ) 		=> '120',
						esc_html__( '130px', 'ajani' ) 		=> '130',
						esc_html__( '140px', 'ajani' ) 		=> '140',
						esc_html__( '150px', 'ajani' ) 		=> '150'		
					)
				),
				array( 'param_name' => 'order', 'type' => 'dropdown', 'heading' => esc_html__( 'Order', 'ajani' ), 'default' => '0', 'responsive_override' => true, 'description' => esc_html__( 'Columns are placed in the visual order according to selected order, lowest values first.', 'ajani' ),
					'value' => array(
						esc_html__( ' -5', 'ajani' ) => '-5',
						esc_html__( ' -4', 'ajani' ) => '-4',
						esc_html__( ' -3', 'ajani' ) => '-3',
						esc_html__( ' -2', 'ajani' ) => '-2',
						esc_html__( ' -1', 'ajani' ) => '-1',
						esc_html__( ' 0 (default)', 'ajani' ) => '0',
						esc_html__( ' 1', 'ajani' ) => '1',
						esc_html__( ' 2', 'ajani' ) => '2',
						esc_html__( ' 3', 'ajani' ) => '3',
						esc_html__( ' 4', 'ajani' ) => '4',
						esc_html__( ' 5', 'ajani' ) => '5'
					)
				),
				array( 'param_name' => 'background_image', 'type' => 'attach_image',  'preview' => true, 'heading' => esc_html__( 'Background image', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
				array( 'param_name' => 'inner_background_image', 'type' => 'attach_image',  'preview' => true, 'heading' => esc_html__( 'Inner background image', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
				array( 'param_name' => 'lazy_load', 'type' => 'dropdown', 'default' => 'yes', 'heading' => esc_html__( 'Lazy load background image', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'No', 'ajani' ) => 'no',
						esc_html__( 'Yes', 'ajani' ) => 'yes'
					) ),
				array( 'param_name' => 'color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Color scheme', 'ajani' ), 'description' => esc_html__( 'Define color schemes in Bold Builder settings or define accent and alternate colors in theme customizer (if avaliable)', 'ajani' ), 'value' => $color_scheme_arr, 'preview' => true, 'group' => esc_html__( 'Design', 'ajani' )  ),
				array( 'param_name' => 'background_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Background color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
				array( 'param_name' => 'inner_background_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Inner background color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
				array( 'param_name' => 'opacity', 'type' => 'textfield', 'heading' => esc_html__( 'Background color opacity (deprecated)', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
				array( 'param_name' => 'top_border', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'top_border' ), 'group' => esc_html__( 'Design', 'ajani' ), 'heading' => esc_html__( 'Top Border', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'bottom_border', 'type' => 'checkbox', 'group' => esc_html__( 'Design', 'ajani' ), 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'bottom_border' ), 'heading' => esc_html__( 'Bottom Border', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'left_border', 'type' => 'checkbox', 'group' => esc_html__( 'Design', 'ajani' ), 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'left_border' ), 'heading' => esc_html__( 'Left Border', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'right_border', 'type' => 'checkbox', 'group' => esc_html__( 'Design', 'ajani' ), 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'right_border' ), 'heading' => esc_html__( 'Right Border', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'border_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Border color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'border_width', 'type' => 'textfield', 'heading' => esc_html__( 'Border width', 'ajani' ), 'description' => esc_html__( 'Enter value in numbers, it will be calculater as pixels, e.g. 5 will mean 5px. Maximum value is 20.', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
	
			)
		) );
	}
	
	static function hex2rgb( $hex ) {
		$hex = str_replace( '#', '', $hex );
		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgb = array( $r, $g, $b );
		return $rgb;
	}
}