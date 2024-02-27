<?php

class bt_bb_card extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts', array(
			'image_position'  				=> '',
			'read_more_link'      			=> '',
			'read_more_text'				=> '',
			'read_more_icon'				=> '',
			'read_more_icon_color_scheme'   => '',			
			'background_color'				=> '',			
			'style'							=> '',
			'shape'							=> ''			
		) ), $atts, $this->shortcode ) );
		
		$class = array( $this->shortcode );		
		
		if ( $el_class != '' ) {
			$class[] = $el_class;
		}
		
		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}
		
		if ( $image_position != '' ) {
			$class[] = $this->prefix . 'image_position' . '_' . $image_position;
		}
		
		if ( $style != '' ) {
			$class[] = $this->prefix . 'style' . '_' . $style;
		}
				
		if ( $shape != '' ) {
			$class[] = $this->prefix . 'shape' . '_' . $shape;
		}	
		
		if ( $background_color != '' ) {
			$el_style .= 'background-color: ' . $background_color . ';--bg-color: ' . $background_color . ';';
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );		
	
		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}
		
		$output = '<div class="bt_bb_card_content"><div class="bt_bb_card_content_inner">';
		
		$output .= do_shortcode( $content );		
		
		if ( $read_more_text != '' || ( $read_more_icon != '' && $read_more_icon != 'no_icon' ) ) {
			$read_more_icon_output	= '';
			$read_more_icon_class	= '';
			$read_more_text_html	= '';
			$read_more_icon_style	= '';

			$read_more_icon_color_scheme_id = NULL;
			if ( is_numeric ( $read_more_icon_color_scheme ) ) {
				$read_more_icon_color_scheme_id = $read_more_icon_color_scheme;
			} else if ( $read_more_icon_color_scheme != '' ) {
				$read_more_icon_color_scheme_id = bt_bb_get_color_scheme_id( $read_more_icon_color_scheme );
			}
			$read_more_icon_color_scheme_colors = bt_bb_get_color_scheme_colors_by_id( $read_more_icon_color_scheme_id - 1 );
			if ( $read_more_icon_color_scheme_colors ) $read_more_icon_style .= ' --card-read-more-icon-primary-color:' . $read_more_icon_color_scheme_colors[0] . '; --card-read-more-icon-secondary-color:' . $read_more_icon_color_scheme_colors[1] . ';';
			if ( $read_more_icon_color_scheme != '' ) $read_more_icon_class =  ' bt_bb_read_more_icon_color_scheme_' .  $read_more_icon_color_scheme_id;

			$read_more_icon_style_attr = '';
			if ( $read_more_icon_style != '' ) {
				$read_more_icon_style_attr = ' ' . 'style="' . esc_attr( $read_more_icon_style ) . '"';
			}
				
			if ( $read_more_icon != '' && $read_more_icon != 'no_icon' ) {				
				$read_more_icon_output = bt_bb_icon::get_html( $read_more_icon, '' );
				$read_more_icon_output = '<div class="bt_bb_grid_item_icon">' . $read_more_icon_output . '</div>';
			}
			if ( $read_more_text != '' ) {	
				$read_more_text_html = '<span>' . ( $read_more_text ) . ' </span>';										
			}

			$output .= '<div class="bt_bb_card_read_more' . $read_more_icon_class . '"' . $read_more_icon_style_attr . '>';
					$output .= '<a href="' . esc_url_raw( bt_bb_get_url( $read_more_link ) ) . '">' . $read_more_text_html . ' '  . $read_more_icon_output . '</a>';
			$output .= '</div>';
		}
		
		$output .= '</div></div>';
		
		$output = '<div' . $id_attr . ' class="' . esc_attr( implode( ' ', $class ) ) . '"' . $style_attr . '>' . ( $output ) . '</div>';

		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}

	function map_shortcode() {

		require_once( WP_PLUGIN_DIR   .  '/bold-page-builder/content_elements_misc/misc.php' );
		$color_scheme_arr = bt_bb_get_color_scheme_param_array();

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Card', 'ajani' ), 'description' => esc_html__( 'Card, title and text', 'ajani' ), 'container' => 'vertical', 'accept' => array( 'bt_bb_image' => true, 'bt_bb_icon' => true, 'bt_bb_text' => true, 'bt_bb_headline' => true, 'bt_bb_separator' => true, 'bt_bb_service' => true, 'bt_bb_testimonial' => true ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'image_position', 'default' => '', 'type' => 'dropdown', 'heading' => esc_html__( 'Image position', 'ajani' ), 
					'value' => array(
						esc_html__( 'Image above content', 'ajani' )		=> 'image_above_content',
						esc_html__( 'Image beneath content', 'ajani' )	=> 'image_beneath_content'
					)
				),
				array( 'param_name' => 'read_more_link', 'type' => 'textfield', 'heading' => esc_html__( 'Read more link', 'ajani' ) ),				
				array( 'param_name' => 'read_more_text', 'type' => 'textfield', 'heading' => esc_html__( 'Read more text', 'ajani' ), 'value' => '' ), 
				array( 'param_name' => 'read_more_icon', 'type' => 'iconpicker', 'heading' => esc_html__( 'Read more icon', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'read_more_icon_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Read more color scheme', 'ajani' ), 'value' => $color_scheme_arr, 'preview' => true ),
				array( 'param_name' => 'background_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Background color', 'ajani' ),  'preview' => true ),
				array( 'param_name' => 'style', 'type' => 'dropdown', 'heading' => esc_html__( 'Style', 'ajani' ), 
					'value' => array(
						esc_html__( 'Flat', 'ajani' ) => 'flat',
						esc_html__( 'Shadowed', 'ajani' ) => 'shadowed',
						esc_html__( 'Bordered', 'ajani' ) => 'bordered'
					)
				),
				array( 'param_name' => 'shape', 'type' => 'dropdown', 'heading' => esc_html__( 'Shape', 'ajani' ), 
					'value' => array(
						esc_html__( 'Square', 'ajani' ) => 'square',
						esc_html__( 'Soft Rounded', 'ajani' ) => 'soft_rounded',
						esc_html__( 'Hard Rounded', 'ajani' ) => 'hard_rounded'
					)
				),
				)
			)
		);
	}
}