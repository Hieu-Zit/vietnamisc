<?php

class bt_bb_progress_bar extends BT_BB_Element {
	
	 function  bb_exist(){
            if ( file_exists( WP_PLUGIN_DIR . '/bold-page-builder/bold-builder.php' ) ) { return true; }
            return false;
        }

	function handle_shortcode( $atts, $content ) {
		
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'text'        		=> '',
			'percentage'        => '',
			'show_text_pct'		=> '',
			'color_scheme' 		=> '',
			'size'        		=> '',
			'align'        		=> '',
			'style'        		=> '',
			'shape'        		=> ''
		) ), $atts, $this->shortcode ) );	

		$class = array( $this->shortcode );

		if ( $text == '' ) {
			$text = $percentage . "%";
		}
		
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
		if ( $color_scheme_colors ) $el_style .= '; --primary-color:' . $color_scheme_colors[0] . '; --secondary-color:' . $color_scheme_colors[1] . ';';
		if ( $color_scheme != '' ) $class[] = $this->prefix . 'color_scheme_' .  $color_scheme_id;
		
		$this->responsive_data_override_class(
			$class, $data_override_class,
			array(
				'prefix' => $this->prefix,
				'param' => 'align',
				'value' => $align
			)
		);
		
		$this->responsive_data_override_class(
			$class, $data_override_class,
			array(
				'prefix' => $this->prefix,
				'param' => 'size',
				'value' => $size
			)
		);

		if ( $style != '' ) {
			$class[] = $this->prefix . 'style' . '_' . $style;
		}		

		if ( $shape != '' ) {
			$class[] = $this->prefix . 'shape' . '_' . $shape;
		}

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );

		$content = do_shortcode( $content );

		$output = '';
		
		$output_text = '';		
		if ( $text != '' ){
			$output_text .= '<span class="bt_bb_progress_bar_text">' . $text . '</span>';
		}		
		if ( $show_text_pct != ''){
			$output_text .= '<span class="bt_bb_progress_bar_percent">' . $percentage . '%</span>';
		}

		$output .= '<div' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . ' data-bt-override-class="' . htmlspecialchars( json_encode( $data_override_class, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '"><div class="bt_bb_progress_bar_bg"></div><div class="bt_bb_progress_bar_inner animate" style="width:' . $percentage . '%">' . $output_text . '</div></div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}

	function map_shortcode() {
		
		if ( !$this->bb_exist() ) { return false; }
		require_once( WP_PLUGIN_DIR   . '/bold-page-builder/content_elements_misc/misc.php' );
		$color_scheme_arr = bt_bb_get_color_scheme_param_array();			
		
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Progress Bar', 'ajani' ), 'description' => esc_html__( 'Progress bar', 'ajani' ), 'container' => 'vertical', 'accept' => false, 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'percentage', 'type' => 'textfield', 'heading' => esc_html__( 'Percentage', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'text', 'type' => 'textfield', 'heading' => esc_html__( 'Text', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'size', 'type' => 'dropdown', 'heading' => esc_html__( 'Size', 'ajani' ), 'preview' => true,
					'responsive_override' => true, 'value' => array(
						esc_html__( 'Normal', 'ajani' ) => 'normal',
						esc_html__( 'Small', 'ajani' ) => 'small'
					)
				),
				array( 'param_name' => 'show_text_pct', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'true' ), 'heading' => esc_html__( 'Show text and percentage', 'ajani' ), 'preview' => true,
				),
				array( 'param_name' => 'align', 'type' => 'dropdown', 'heading' => esc_html__( 'Align', 'ajani' ), 'preview' => true,
					'responsive_override' => true, 'value' => array(
						esc_html__( 'Inherit', 'ajani' ) => 'inherit',
						esc_html__( 'Left', 'ajani' ) => 'left',
						esc_html__( 'Right', 'ajani' ) => 'right',
						esc_html__( 'Center', 'ajani' ) => 'center'					
					)
				),
				array( 'param_name' => 'color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Color scheme', 'ajani' ), 'value' => $color_scheme_arr, 'preview' => true, 'group' => esc_html__( 'Design', 'ajani' ) ),
				array( 'param_name' => 'style', 'type' => 'dropdown', 'heading' => esc_html__( 'Style', 'ajani' ), 'preview' => true, 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Filled', 'ajani' ) => 'filled',
						esc_html__( 'Line', 'ajani' ) => 'line',
						esc_html__( 'Outline', 'ajani' ) => 'outline'
					)
				),
				array( 'param_name' => 'shape', 'type' => 'dropdown', 'heading' => esc_html__( 'Shape', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Square', 'ajani' ) => 'square',
						esc_html__( 'Rounded', 'ajani' ) => 'rounded',
					)
				)				
			)
		) );
	}
}