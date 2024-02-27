<?php

class bt_bb_price_list extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'title'        => '',
			'subtitle'     => '',
			'currency'     => '',
			'price'        => '',			
			'items'        => '',
			'background_image'			=> '',
			'background_color'			=> '',
			'shape'						=> '',
			'color_scheme' => ''
		) ), $atts, $this->shortcode ) );

		$class = array( $this->shortcode );

		if ( $el_class != '' ) {
			$class[] = $el_class;
		}

		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}

		$color_scheme_id = NULL;
		if ( is_numeric ( $color_scheme ) ) {
			$color_scheme_id = $color_scheme;
		} else if ( $color_scheme != '' ) {
			$color_scheme_id = bt_bb_get_color_scheme_id( $color_scheme );
		}
		$color_scheme_colors = bt_bb_get_color_scheme_colors_by_id( $color_scheme_id - 1 );
		if ( $color_scheme_colors ) $el_style .= '; --price-list-primary-color:' . $color_scheme_colors[0] . '; --price-list-secondary-color:' . $color_scheme_colors[1] . ';';
		if ( $color_scheme != '' ) $class[] = $this->prefix . 'color_scheme_' .  $color_scheme_id;
		
		if ( $background_image != '' ) {
			$background_image_style = '';
			$background_image = wp_get_attachment_image_src( $background_image, 'full' );
			$background_image_url = $background_image ? $background_image[0] : '';
			if ( $background_image_url != '' ) {
				$background_image_style = 'background-image:url(\'' . $background_image_url . '\');';				
			}
			$el_style = $el_style .  $background_image_style;	
			$class[] = $this->prefix . 'background_image';
		}
		
		if ( $background_color != '' ) {
			$el_style = $el_style . 'background-color:' . $background_color . ';';
		}	
		
		if ( $shape != '' ) {
			$class[] = $this->prefix . 'shape' . '_' . $shape;
		}

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		
		$output = '<div class="' . esc_attr( $this->shortcode ) . '_title">' . $title . '</div>';
		$output .= '<div class="' . esc_attr( $this->shortcode ) . '_subtitle">' . $subtitle . '</div>';
		$output .= '<div class="' . esc_attr( $this->shortcode ) . '_price"><span class="' . esc_attr( $this->shortcode ) . '_currency">' . $currency . '</span><span class="' . esc_attr( $this->shortcode ) . '_amount">' . $price . '</span></div>';
		$output .= do_shortcode( $content );
		if ( $items != '' ) {            
			if ( function_exists( 'bt_get_items_list' ) ) {
				$output .= bt_get_items_list( $items );
			}
		}
		
		$output = '<div' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . '>' . $output . '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;
	}

	function map_shortcode() {
		
		require_once( WP_PLUGIN_DIR   .  '/bold-page-builder/content_elements_misc/misc.php' );
		$color_scheme_arr = bt_bb_get_color_scheme_param_array();			
		
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Price List', 'ajani' ), 'description' => esc_html__( 'List of items with total price', 'ajani' ), 'container' => 'vertical', 'accept' => array( 'bt_bb_button' => true ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'title', 'type' => 'textfield', 'heading' => esc_html__( 'Title', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'subtitle', 'type' => 'textfield', 'heading' => esc_html__( 'Subtitle', 'ajani' ) ),
				array( 'param_name' => 'currency', 'type' => 'textfield', 'heading' => esc_html__( 'Currency', 'ajani' ) ),
				array( 'param_name' => 'price', 'type' => 'textfield', 'heading' => esc_html__( 'Price', 'ajani' ) ),				
				array( 'param_name' => 'items', 'type' => 'textarea_object', 'heading' => esc_html__( 'Items', 'ajani' ) ),
				array( 'param_name' => 'color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Color scheme', 'ajani' ), 'description' => esc_html__( 'Define color schemes in Bold Builder settings or define accent and alternate colors in theme customizer (if avaliable)', 'ajani' ), 'value' => $color_scheme_arr, 'preview' => true ),
				array( 'param_name' => 'background_image', 'type' => 'attach_image', 'preview' => true, 'heading' => esc_html__( 'Background image', 'ajani' ) 
				),
				array( 'param_name' => 'background_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Background color', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'shape', 'type' => 'dropdown', 'heading' => esc_html__( 'Shape', 'ajani' ), 
					'value' => array(
						esc_html__( 'Inherit', 'ajani' ) => 'inherit',
						esc_html__( 'Square', 'ajani' ) => 'square',
						esc_html__( 'Soft Rounded', 'ajani' ) => 'soft_rounded',
						esc_html__( 'Hard Rounded', 'ajani' ) => 'hard_rounded',
						esc_html__( 'Full Rounded', 'ajani' ) => 'full_rounded'
						)
				),
			)
		) );
	}
}