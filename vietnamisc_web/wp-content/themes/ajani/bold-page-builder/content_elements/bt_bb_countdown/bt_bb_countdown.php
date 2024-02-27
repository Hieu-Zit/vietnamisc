<?php

class bt_bb_countdown extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'datetime'			=> '',
			'size'				=> '',
			'hide_indication'	=> '',
			'show_lines'		=> '',
			'font'				=> '',
			'font_subset'		=> '',
			'number_font_weight'=> ''
		) ), $atts, $this->shortcode ) );
		
		if ( $font != '' && $font != 'inherit' ) {
			require_once( WP_PLUGIN_DIR   .  '/bold-page-builder/content_elements_misc/misc.php' );
			bt_bb_enqueue_google_font( $font, $font_subset );
		}
		
		if ( $font != '' && $font != 'inherit' ) {
			$el_style = $el_style . 'font-family:\'' . urldecode_deep( $font ) . '\';';
		}

		$class = array( $this->shortcode, 'btCounterHolder' );

		if ( $el_class != '' ) {
			$class[] = $el_class;
		}

		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
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

		if ( $size != '' ) {
			$class[] = $size;
		}

		$datetime = sanitize_text_field( $datetime );
		
		$target = strtotime( $datetime );
		$now = strtotime( 'now' );		
		$init_seconds = $target - $now;
		if ( $init_seconds < 0 ) {
			$init_seconds = 0;
		}		
		$d_text = esc_html__( 'Days', 'ajani' );
		$h_text = esc_html__( 'Hours', 'ajani' );
		$m_text = esc_html__( 'Minutes', 'ajani' );
		$s_text = esc_html__( 'Seconds', 'ajani' );
		
		if ( $hide_indication == 'yes' ) {
			$d_text = '';
			$h_text = '';
			$m_text = '';
			$s_text = '';
		}
		
		if ( $show_lines == 'yes' ) {
			$class[] = 'btCounterShowLines';
		}else{
			$class[] = 'btCounterHideLines';
		}
		
		if ( $number_font_weight != '' ) {
			$class[] = $number_font_weight;
		}

		$class = apply_filters( $this->shortcode . '_class', $class, $atts );		

		$output = '<div' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . ' data-bt-override-class="' . htmlspecialchars( json_encode( $data_override_class, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '">';
			$output .= '<div class="btCountdownHolder" data-init-seconds="' . esc_attr( $init_seconds ) . '" data-init-target-seconds="' . esc_attr( $target ) . '">';
							
				$output .= '<span class="days" data-text="' . esc_attr( $d_text ) . '"></span>';
				
				$output .= '<span class="hours"><span class="n0"><span></span><span></span></span><span class="n1"><span></span><span></span></span><span class="hours_text"><span>' . $h_text . '</span></span></span>';
				
				$output .= '<span class="minutes"><span class="n0"><span></span><span></span></span><span class="n1"><span></span><span></span></span><span class="minutes_text"><span>' . $m_text . '</span></span></span>';
				
				$output .= '<span class="seconds"><span class="n0"><span></span><span></span></span><span class="n1"><span></span><span></span></span><span class="seconds_text"><span>' . $s_text . '</span></span></span>';
			$output .= '</div>';
		$output .= '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );		

		return $output;
	}

	function map_shortcode() {

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Countdown', 'ajani' ), 'description' => esc_html__( 'Animated countdown', 'ajani' ),  
			'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'datetime', 'type' => 'textfield', 'heading' => esc_html__( 'Target date and time', 'ajani' ), 'description' => esc_html__( 'YY-mm-dd HH:mm:ss, e.g. 2017-02-22 22:45:00', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'size', 'type' => 'dropdown', 'heading' => esc_html__( 'Size', 'ajani' ), 'preview' => true,
					'responsive_override' => true, 'value' => array(
						esc_html__( 'Normal', 'ajani' ) => 'btCounterNormalSize',
						esc_html__( 'Large', 'ajani' ) => 'btCounterLargeSize'
				) ),
				array( 'param_name' => 'hide_indication', 'type' => 'dropdown', 'heading' => esc_html__( 'Hide indication', 'ajani' ), 'description' => esc_html__( 'Hide indication of days, hours, minutes and seconds', 'ajani' ),
					'value' => array(
						esc_html__( 'No', 'ajani' ) => 'no',
						esc_html__( 'Yes', 'ajani' ) => 'yes'
				) ),
				array( 'param_name' => 'show_lines', 'type' => 'dropdown', 'heading' => esc_html__( 'Show lines', 'ajani' ), 'description' => esc_html__( 'Show lines', 'ajani' ),
					'value' => array(
						esc_html__( 'No', 'ajani' ) => 'no',
						esc_html__( 'Yes', 'ajani' ) => 'yes'
				) ),
				array( 'param_name' => 'number_font_weight', 'type' => 'dropdown', 'heading' => esc_html__( 'Number font weight', 'ajani' ), 'preview' => true,
					'value' => array(
						esc_html__( 'Normal', 'ajani' ) => 'btCounterNormalNumberFontWeight',
						esc_html__( 'Bold', 'ajani' ) => 'btCounterBoldNumberFontWeight'
				) ),
				array( 'param_name' => 'font', 'type' => 'dropdown', 'heading' => esc_html__( 'Font', 'ajani' ), 'group' => esc_html__( 'Font', 'ajani' ), 'preview' => true,
					'value' => array( esc_html__( 'Inherit', 'ajani' ) => 'inherit' ) + BT_BB_Root::$font_arr
				),
				array( 'param_name' => 'font_subset', 'type' => 'textfield', 'heading' => esc_html__( 'Google Font subset', 'ajani' ), 'group' => esc_html__( 'Font', 'ajani' ), 'value' => 'latin,latin-ext', 'description' => 'E.g. latin,latin-ext,cyrillic,cyrillic-ext' ),				
			) 
		) );

	}
}