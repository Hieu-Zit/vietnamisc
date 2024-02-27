<?php
class bt_bb_quote extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'quote'					=> '',
			'quote_icon'			=> '',
			'quote_icon_color'		=> '',
			'quote_icon_size'		=> '',
			'quote_size'			=> '',
			'quote_font_weight'		=> '',
			'quote_font'			=> '',
			'quote_font_subset'   	=> '',
			'quote_line_height'		=> ''			
		) ), $atts, $this->shortcode ) );
		
		if ( $quote_font != '' && $quote_font != 'inherit' ) {
			require_once( WP_PLUGIN_DIR   .  '/bold-page-builder/content_elements_misc/misc.php' );
			bt_bb_enqueue_google_font( $quote_font, $quote_font_subset );
		}
		
		$class = array( $this->shortcode );
		
		if ( $el_class != '' ) {
			$class[] = $el_class;
		}
		
		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}

		if ( $quote_font != '' && $quote_font != 'inherit' ) {
			$el_style .= 'font-family:\'' . urldecode_deep( $quote_font ) . '\';';
		}
		if ( $quote_size != '' ) {
			$el_style .= 'font-size:' . $quote_size . ';';
		}
		
		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}
		
		
		if ( $quote_icon_size != '' ) {
			$class[] = $this->prefix . 'icon_size_' . $quote_icon_size;
		}
		
		if ( $quote_font_weight != '' ) {
			$class[] = $this->prefix . 'font_weight_' . $quote_font_weight ;
		}
		
		if ( $quote_line_height != '' ) {
			$class[] = $this->prefix . 'line_height_' . $quote_line_height;
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		
		if ( $quote_icon == '' || $quote_icon == 'no_icon' ) {
			$quote = $quote;
		} else {
			$quote_icon_style = '';
			if ( $quote_icon_color != '' ) {				
				$quote_icon_style = ' style="color:' . $quote_icon_color . '"';
			}
			$quote = $quote . '<span' . $quote_icon_style . '>' . bt_bb_icon::get_html( $quote_icon, '', '', '' ) . '</span>';
		}
		
		$output = '<div' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . '>' . $quote . '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );
		
		return $output;
		
	}
	
	function map_shortcode() {
		
		require_once( WP_PLUGIN_DIR   .  '/bold-page-builder/content_elements_misc/misc.php' );
		$color_scheme_arr = bt_bb_get_color_scheme_param_array();
		
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Quote', 'ajani' ), 'description' => esc_html__( 'Quote', 'ajani' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array( 
				array( 'param_name' => 'quote', 'type' => 'textfield', 'heading' => esc_html__( 'Quote', 'ajani' ), 'description' => esc_html__( 'Quote text', 'ajani' ) ),
				array( 'param_name' => 'quote_icon', 'type' => 'iconpicker', 'heading' => esc_html__( 'Icon', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'quote_icon_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Icon color', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'quote_icon_size', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon Size compared to quote font size', 'ajani' ), 'description' => 'Icon sizes',
					'value' => array(
						esc_html__( 'Same as quote', 'ajani' ) 	=> 'inherit',
						esc_html__( '0.5 smaller', 'ajani' ) => 'extrasmall',
						esc_html__( '0.6x smaller', 'ajani' ) 		=> 'small',
						esc_html__( '1.25x larger', 'ajani' ) 		=> 'normal',
						esc_html__( '1.33x larger', 'ajani' ) 		=> 'medium',
						esc_html__( '1.5x larger', 'ajani' ) 		=> 'large',
						esc_html__( '1.66x larger', 'ajani' ) => 'extralarge',
						esc_html__( '2x larger', 'ajani' ) 		=> 'huge'
					)
				),
				array( 'param_name' => 'quote_size', 'type' => 'textfield', 'heading' => esc_html__( 'Custom font size', 'ajani' ), 'group' => esc_html__( 'Font', 'ajani' ), 'description' => esc_html__( 'E.g. 20px or 1.5rem', 'ajani' ) ),
				array( 'param_name' => 'quote_font_weight', 'type' => 'dropdown', 'heading' => esc_html__( 'Font weight', 'ajani' ), 'group' => esc_html__( 'Font', 'ajani' ),
					'value' => array(
						esc_html__( 'Default', 'ajani' ) => '',
						esc_html__( 'Normal', 'ajani' ) => 'normal',
						esc_html__( 'Bold', 'ajani' ) => 'bold',
						esc_html__( 'Bolder', 'ajani' ) => 'bolder',
						esc_html__( 'Lighter', 'ajani' ) => 'lighter',
						esc_html__( 'Light', 'ajani' ) => 'light',
						esc_html__( 'Thin', 'ajani' ) => 'thin',
						esc_html__( 'Font weight 100', 'ajani' ) => '100',
						esc_html__( 'Font weight 200', 'ajani' ) => '200',
						esc_html__( 'Font weight 300', 'ajani' ) => '300',
						esc_html__( 'Font weight 400', 'ajani' ) => '400',
						esc_html__( 'Font weight 500', 'ajani' ) => '500',
						esc_html__( 'Font weight 600', 'ajani' ) => '600',
						esc_html__( 'Font weight 700', 'ajani' ) => '700',
						esc_html__( 'Font weight 800', 'ajani' ) => '800',
						esc_html__( 'Font weight 900', 'ajani' ) => '900'
					)
				),
				array( 'param_name' => 'quote_font', 'type' => 'dropdown', 'heading' => esc_html__( 'Font', 'ajani' ), 'group' => esc_html__( 'Font', 'ajani' ), 'preview' => true,
					'value' => array( esc_html__( 'Inherit', 'ajani' ) => 'inherit' ) + BT_BB_Root::$font_arr
				),
				array( 'param_name' => 'quote_font_subset', 'type' => 'textfield', 'heading' => esc_html__( 'Google Font subset', 'ajani' ), 'group' => esc_html__( 'Font', 'ajani' ), 'value' => 'latin,latin-ext', 'description' => esc_html__( 'E.g. latin,latin-ext,cyrillic,cyrillic-ext', 'ajani' ) ),
				array( 'param_name' => 'quote_line_height', 'type' => 'dropdown', 'heading' => esc_html__( 'Line height', 'ajani' ), 'preview' => true,
					'value' => array(
						esc_html__( 'Line height 1', 'ajani' ) => '1',		
						esc_html__( 'Line height 1.25', 'ajani' ) => '1_25',
						esc_html__( 'Line height 1.5', 'ajani' ) => '1_5',
						esc_html__( 'Line height 1.75', 'ajani' ) => '1_75',
						esc_html__( 'Line height 2', 'ajani' ) => '2'
					)
				),
			)
		) );
	}
}
