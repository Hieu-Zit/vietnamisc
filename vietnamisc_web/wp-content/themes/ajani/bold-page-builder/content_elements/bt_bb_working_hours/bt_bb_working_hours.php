<?php

class bt_bb_working_hours extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts', array(
			'wh_content'    => '',
			'size'			=> '',
			'color_scheme'  => ''
		) ), $atts, $this->shortcode ) );

		$class = array( $this->shortcode );
		
		if ( $el_class != '' ) {
			$class[] = $el_class;
		}
		
		if ( $size != '' ) {
			$class[] = $this->prefix . 'size' . '_' . $size;
		}

		$color_scheme_id = NULL;
		if ( is_numeric ( $color_scheme ) ) {
			$color_scheme_id = $color_scheme;
		} else if ( $color_scheme != '' ) {
			$color_scheme_id = bt_bb_get_color_scheme_id( $color_scheme );
		}
		$color_scheme_colors = bt_bb_get_color_scheme_colors_by_id( $color_scheme_id - 1 );
		if ( $color_scheme_colors ) $el_style .= '; --working-hours-primary-color:' . $color_scheme_colors[0] . '; --working-hours-secondary-color:' . $color_scheme_colors[1] . ';';
		if ( $color_scheme != '' ) $class[] = $this->prefix . 'color_scheme_' .  $color_scheme_id;

		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}		

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );		

		$output_inner = '';
		$has_link = '';
		$items_arr = preg_split( '/$\R?^/m', $wh_content );
		
		foreach ( $items_arr as $item ) {
			$output_inner .= '<div class="' . esc_attr( $this->shortcode ) . '_inner_row"><div class="' . esc_attr( $this->shortcode ) . '_inner_wrapper">';
			$item_arr = explode( ';', $item );
			$output_inner .= '<div class="' . esc_attr( $this->shortcode ) . '_inner_title">' . $item_arr[0] . '</div>';
			unset( $item_arr[0] );
			$link = array_pop($item_arr);
		
			foreach ( $item_arr as $inner_item ) {
				$output_inner .= '<div class="' . esc_attr( $this->shortcode ) . '_inner_content">' . $inner_item . '</div>';
			}
				
			if( $link != '' && !ctype_space($link) ) {
				$link_arr = explode( ',', $link );
				
				$link_title = isset( $link_arr[0] ) ? $link_arr[0] : '';
				$link_url	= isset( $link_arr[1] ) ? $link_arr[1] : '#';
				if ( $link_title != '' ){
					$output_inner .= '<div class="' . esc_attr( $this->shortcode ) . '_inner_link">';
					$output_inner .=  '<a href="' . esc_attr( $link_url ) . '" title="' . esc_attr( $link_title ) . '">' . $link_title . '</a>';
					$output_inner .= '</div>';
				}
				$has_link = ' ' . $this->shortcode . '_has_link';
			}
			$output_inner .= '</div></div>';
		}

		$output = '<div class="btWorkingHours ' . esc_attr( implode( ' ', $class ) ) . $has_link . '" ' . $style_attr . '>';
			$output .= '<div class="btWorkingHoursInner">';
				$output .= $output_inner;
			$output .= '</div>';
		$output .= '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}

	function map_shortcode() {
		
		require_once( WP_PLUGIN_DIR   . '/bold-page-builder/content_elements_misc/misc.php' );
		$color_scheme_arr = bt_bb_get_color_scheme_param_array();			
		
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Working Hours', 'ajani' ), 'description' => esc_html__( 'Working hours element', 'ajani' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode, 'highlight' => true,
			'params' => array(
				array( 'param_name' => 'size', 'type' => 'dropdown', 'heading' => esc_html__( 'Size', 'ajani' ), 'preview' => true,
						'value' => array(
							esc_html__( 'Small', 'ajani' ) => 'small',
							esc_html__( 'Normal', 'ajani' ) => 'normal',
							esc_html__( 'Large', 'ajani' ) => 'large'
						)
				),				
				array( 
					'param_name' => 'wh_content', 
					'type' => 'textarea', 
					'heading' => esc_html__( 'Working Hours', 'ajani' ) , 
					'description' => esc_html__( 'value;value;URL title,URL separated by new line (leave ; at the end to remove link)', 'ajani' ) 
				),
				array( 
					'param_name' => 'color_scheme', 
					'type' => 'dropdown', 
					'heading' => esc_html__( 'Color scheme', 'ajani' ), 
					'value' => $color_scheme_arr, 'preview' => true 							
				),	
			)
		) );
	}
}