<?php

class bt_bb_bulleted_list extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts', array(
			'icon'							=> 'no_icon',
			'icon_color_scheme'				=> '',
			'icon_size'						=> '',			
			'items'							=> ''
		) ), $atts, $this->shortcode ) );
		
		$class = array( $this->shortcode );

		if ( $el_class != '' ) {
			$class[] = $el_class;
		}

		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}

		
		$icon_color_scheme_id = NULL;
		if ( is_numeric ( $icon_color_scheme ) ) {
			$icon_color_scheme_id = $icon_color_scheme;
		} else if ( $icon_color_scheme != '' ) {
			$icon_color_scheme_id = bt_bb_get_color_scheme_id( $icon_color_scheme );
		}
		$icon_color_scheme_colors = bt_bb_get_color_scheme_colors_by_id( $icon_color_scheme_id - 1 );
		if ( $icon_color_scheme_colors ) $el_style .= '; --bulleted-list-icon-primary-color:' . $icon_color_scheme_colors[0] . '; --bulleted-list-icon-secondary-color:' . $icon_color_scheme_colors[1] . ';';
		if ( $icon_color_scheme != '' ) $class[] = $this->prefix . 'icon_color_scheme_' .  $icon_color_scheme_id;
		
		/*if ( $icon_color_scheme != '' ) {
			$class[] = $this->prefix . 'icon_color_scheme' . '_' . bt_bb_get_color_scheme_id( $icon_color_scheme );
		}*/
		if ( $icon_size != '' ) {
			$class[] = $this->prefix . 'icon_size' . '_' . $icon_size;
		}

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		
		$icon_html = '';
		if ( $icon != '' && $icon != 'no_icon'  ) {	
			$icon_html = bt_bb_icon::get_html( $icon, '' );
			$icon_html = '<span class="' . esc_attr( $this->shortcode . '_icon' ) . '">' . $icon_html . '</span> ';
		}
		
		$output = '';
		if ( $items != '' ) {  
			if ( function_exists( 'bt_get_items_list' ) ) {
				$output .= bt_get_items_list( $items, $icon_html );
			}
		}
		
		$output = '<div' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . '><div class="' . esc_attr( $this->shortcode ) . '_content">'. $output . '</div></div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );
		
		return $output;
		
	}

	function map_shortcode() {
		
		require_once( WP_PLUGIN_DIR   .  '/bold-page-builder/content_elements_misc/misc.php' );
		$color_scheme_arr = bt_bb_get_color_scheme_param_array();
		
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Bulleted list with icons', 'ajani' ), 'description' => esc_html__( 'Bulleted list with icons', 'ajani' ), 'container' => 'vertical', 
			'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'icon', 'type' => 'iconpicker', 'heading' => esc_html__( 'Icon', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'icon_size', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon size', 'ajani' ), 
					'value' => array(
						esc_html__( 'Normal', 'ajani' ) 		=> 'normal',
						esc_html__( 'Large', 'ajani' ) 		=> 'large'
					)
				),
				array( 'param_name' => 'icon_color_scheme', 'type' => 'dropdown', 'default' => '',  'heading' => esc_html__( 'Icon color scheme', 'ajani' ),
					'value' => $color_scheme_arr ),
				array( 'param_name' => 'items', 'type' => 'textarea', 'heading' => esc_html__( 'Items', 'ajani' ) ),
				
				)
			)
		);
	}
}
