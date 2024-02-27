<?php

class bt_bb_google_maps extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'api_key'				=> '',
			'zoom'					=> '',
			'height'				=> '',
			'custom_style'			=> '',
			'map_type'				=> 'interactive',
			'center_map'			=> '',
			'show_info_box'			=> '',
			'map_covering_image'   	=> ''
		) ), $atts, $this->shortcode ) );
		
		$class_master = 'bt_bb_map';
		
		$class = array( $this->shortcode, $class_master );
		
		if ( $el_class != '' ) {
			$class[] = $el_class;
		}

		if ( $center_map == 'yes_no_overlay' ) {
			$class[] = $this->shortcode . '_no_overlay';
			$class[] = $class_master . '_no_overlay';
		}
		
		if ( $show_info_box != '' ) {
			$class[] = $this->shortcode . '_show_info_box' . '_' . $show_info_box;
		}

		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}

		if ( $api_key != '' ) {
			wp_enqueue_script( 
				'gmaps_api',
				'https://maps.googleapis.com/maps/api/js?key=' . $api_key
			);
		} else {
			wp_enqueue_script( 
				'gmaps_api',
				'https://maps.googleapis.com/maps/api/js?v=&sensor=false'
			);
		}
		
		if ( $zoom == '' ) {
			$zoom = 14;
		}

		$style_height = '';
		if ( $height != '' && $map_type == 'interactive' ) {
			$style_height = ' ' . 'style="height:' . $height . '"';
		}
		
		$map_id = uniqid( 'map_canvas' );

		$content_html = ( do_shortcode( $content ) );

		$locations = substr_count( $content_html, 'class="bt_bb_google_maps_location ' ); // fe editor data-base contains the same value
		$locations_without_content = substr_count( $content_html, 'bt_bb_google_maps_location_without_content' );
		
		$map_coverage_image_output = '';
		if ( $map_covering_image != '' ) { 
			$alt_map_covering_image = get_post_meta($map_covering_image, '_wp_attachment_image_alt', true);
			$alt_map_covering_image = $alt_map_covering_image ? $alt_map_covering_image : $this->shortcode . '_map_covering_image';

			$map_covering_image = wp_get_attachment_image_src( $map_covering_image, 'full' );                     
			if ( isset($map_covering_image[0]) ){
				$class_attr = $class_attr . ' ' . $this->shortcode . '_with_top_coverage_image';
				$map_covering_image = $map_covering_image[0];
				$map_coverage_image_output = 
						'<div class="' . esc_attr( $this->shortcode ) . '_map_covering_image">'
							. '<img src="' . esc_url_raw($map_covering_image) . '" alt="' . esc_attr($alt_map_covering_image) . '" />'
						. '</div>';
			}
		}
	
		if ( $content != '' && $locations != $locations_without_content ) {
			$content = '<span class="' . esc_attr( $this->shortcode ) . '_content_toggler ' . esc_attr( $class_master ) . '_content_toggler"></span>'; 
			$content .= '<div class="' . esc_attr( $this->shortcode ) . '_content ' . esc_attr($class_master) . '_content">';
				$content .= '<div class="' . esc_attr( $this->shortcode ) . '_content_wrapper ' . esc_attr( $class_master ) . '_content_wrapper">' ;
				$content .= $content_html ;
				$content .= '</div>';
			$content .= '</div>';
			$class[] = $this->shortcode . '_with_content';
			$class[] = $class_master . '_with_content';
			$style_height = '';
		} else {
		   $content = $content_html;
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );

		$output = '<div class="' . esc_attr( $this->shortcode ) . '_map ' . esc_attr( $class_master ) . '_map" id="' . esc_attr( $map_id ) . '" data-height="' . esc_attr( intval( $height ) ) . '" data-api-key="' . esc_attr( $api_key ) . '" data-map-type="' . esc_attr( $map_type ) . '" data-zoom="' . esc_attr( intval( $zoom ) ) . '" data-init-finished="false" data-custom-style="' . esc_attr( $custom_style ) . '"' . $style_height . '>';
		$output .= '</div>';
		
		$output .= $content;
		$output .= $map_coverage_image_output;
		$output = '<div' . $id_attr . ' class="' . esc_attr( implode( ' ', $class ) ) . '"' . $style_attr . ' data-center="' . esc_attr( $center_map ) . '">' . $output . '</div>';

		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}

	function map_shortcode() {
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Google Maps', 'ajani' ), 'description' => esc_html__( 'Google Map with custom content', 'ajani' ), 'container' => 'vertical', 'accept' => array( 'bt_bb_google_maps_location' => true ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'api_key', 'type' => 'textfield', 'heading' => esc_html__( 'API key', 'ajani' ) ),
				array( 'param_name' => 'zoom', 'type' => 'textfield', 'heading' => esc_html__( 'Zoom (e.g. 14)', 'ajani' ) ),
				array( 'param_name' => 'height', 'type' => 'textfield', 'heading' => esc_html__( 'Height (e.g. 250px)', 'ajani' ), 'description' => esc_html__( 'Used when there is no content', 'ajani' ) ),
				array( 'param_name' => 'custom_style', 'type' => 'textarea_object', 'heading' => esc_html__( 'Custom map style array', 'ajani' ), 'description' => esc_html__( 'Find more custom styles at https://snazzymaps.com/ or https://mapstyle.withgoogle.com/
				', 'ajani' ) ),
				array( 'param_name' => 'map_type', 'type' => 'dropdown', 'default' => 'interactive', 'heading' => esc_html__( 'Map type', 'ajani' ),
					'value' => array(
						esc_html__( 'Interactive (JavaScript API)', 'ajani' ) 		=> 'interactive',
						esc_html__( 'Static (Maps Static API)', 'ajani' ) 			=> 'static'
					)
				),
				array( 'param_name' => 'center_map', 'type' => 'dropdown', 'heading' => esc_html__( 'Center map', 'ajani' ),
					'value' => array(
						esc_html__( 'No (use first location as center)', 'ajani' ) => 'no',
						esc_html__( 'Yes', 'ajani' ) => 'yes',
						esc_html__( 'Yes (without overlay initially)', 'ajani' ) => 'yes_no_overlay'
					)
				),
				array( 'param_name' => 'show_info_box', 'type' => 'dropdown', 'heading' => esc_html__( 'Show info box', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Left side', 'ajani' ) 	=> 'left',
						esc_html__( 'Right side', 'ajani' )	=> 'right'
					)
				),
				array( 'param_name' => 'map_covering_image', 'type' => 'attach_image',  'preview' => true, 'heading' => esc_html__( 'Map covering Image', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
			)
		) );
	}
}