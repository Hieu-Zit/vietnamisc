<?php
class bt_bb_process_step extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'title'						=> '',
			'size'						=> '',
			'text'						=> '',
			'icon'						=> ''			
		) ), $atts, $this->shortcode ) );
		
		wp_enqueue_script(
			'bt_bb_process_step',
			get_template_directory_uri() . '/bold-page-builder/content_elements/bt_bb_process_step/bt_bb_process_step.js',
			array( 'jquery' ),
			'',
			true
		);
		
		$title = html_entity_decode( $title, ENT_QUOTES, 'UTF-8' );
		$text  = html_entity_decode( $text, ENT_QUOTES, 'UTF-8' );
		
		$title = nl2br( $title );
		$text = nl2br( $text );	
		
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
				'param' => 'size',
				'value' => $size
			)
		);
		
		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}
		
		$class[] = 'bt_bb_process_step_item_count';
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		
		$output = '';
		// ICON		
		if ( $icon != '' && $icon != 'no_icon'  ) {	
			$icon_html = bt_bb_icon::get_html( $icon, '' );
			$output .= '<div class="' . esc_attr( $this->shortcode . '_icon' ) . '">' . $icon_html . '</div>';			
		}
		
		if ( $title != '' ) {
			$title = '<h4 class="' . esc_attr( $this->shortcode ) . '_title">' . $title . '</h4>';	
		}
		if ( $text != '' ) {
			$text = '<span class="' . esc_attr( $this->shortcode ) . '_text">' . $text . '</span>';	
		}
		
		$output = '<div' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . '>' . $output . '<div class="' . esc_attr( $this->shortcode ) . '_content">'. $title . $text . '</div></div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );
		
		return $output;
		
	}
	
	function map_shortcode() {
		
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Process step', 'ajani' ), 
			'as_child' => array( 'only' => 'bt_bb_process' ), 
			'description' => esc_html__( 'Process step', 'ajani' ),'accept' => array( 'bt_bb_section' => false, 'bt_bb_row' => false, 'bt_bb_column' => false, 'bt_bb_column_inner' => false, 'bt_bb_tabs' => false, 'bt_bb_tab_item' => false, 'bt_bb_accordion' => false, 'bt_bb_accordion_item' => false, 'bt_bb_cost_calculator_item' => false, 'bt_cc_group' => false, 'bt_cc_multiply' => false, 'bt_cc_item' => false, 'bt_bb_content_slider_item' => false, 'bt_bb_google_maps_location' => false, '_content' => false ),'accept_all' => true, 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array( 
				array( 'param_name' => 'title', 'type' => 'textfield', 'heading' => esc_html__( 'Title', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'size', 'type' => 'dropdown', 'heading' => esc_html__( 'Title size', 'ajani' ), 'description' => esc_html__( 'Predefined title sizes, independent of html tag', 'ajani' ), 'responsive_override' => true,
					'value' => array(
						esc_html__( 'Inherit', 'ajani' ) 	=> 'inherit',
						esc_html__( 'Extra Small', 'ajani' ) => 'extrasmall',
						esc_html__( 'Small', 'ajani' ) 		=> 'small',
						esc_html__( 'Normal', 'ajani' ) 		=> 'normal',
						esc_html__( 'Medium', 'ajani' ) 		=> 'medium',
						esc_html__( 'Large', 'ajani' ) 		=> 'large'
					)
				),
				array( 'param_name' => 'text', 'type' => 'textarea', 'heading' => esc_html__( 'Text', 'ajani' ) ),
				array( 'param_name' => 'icon', 'type' => 'iconpicker', 'heading' => esc_html__( 'Icon', 'ajani' ), 'preview' => true ),
			)
		) );
	}
}



