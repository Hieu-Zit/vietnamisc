<?php

class bt_bb_service extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'icon'         => '',
			'title'        => '',
			'text'         => '',
			'url'          => '',
			'target'       => '',
			'color_scheme' => '',
			'style'        => '',
			'size'         => '',
			'shape'        => '',
			'align'        => '',			
			'icon_padding'	=> '',
			'font'			=> '',
			'font_subset'	=> '',
			'font_weight'   => '',
			'size_headline' => '',
			'read_more_text' => '', 
			'read_more_icon' => '', 
			'read_more_icon_color_scheme' => ''
		) ), $atts, $this->shortcode ) );
		
		if ( $font != '' && $font != 'inherit' ) {
			require_once( WP_PLUGIN_DIR   . '/bold-page-builder/content_elements_misc/misc.php' );
			bt_bb_enqueue_google_font( $font, $font_subset );
		}
		
		$el_style_font = '';
		if ( $font != '' && $font != 'inherit' ) {
			$el_style_font = 'font-family:\'' . urldecode_deep( $font ) . '\';';
		}
		
		$style_attr_font = '';
		if ( $el_style_font != '' ) {
			$style_attr_font = ' ' . 'style="' . esc_attr( $el_style_font ) . '"';
		}

		$class = array( $this->shortcode );
		$data_override_class = array();

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
		if ( $color_scheme_colors ) $el_style .= '; --service-primary-color:' . $color_scheme_colors[0] . '; --service-secondary-color:' . $color_scheme_colors[1] . ';';
		if ( $color_scheme != '' ) $class[] = $this->prefix . 'color_scheme_' .  $color_scheme_id;

		if ( $style != '' ) {
			$class[] = $this->prefix . 'style' . '_' . $style;
		}
		
		if ( $icon_padding != '' ) {
			$class[] = $this->prefix . 'icon_padding' . '_' . $icon_padding;
		}
		
		if ( $font_weight != '' ) {
			$class[] = $this->prefix . 'font_weight_' . $font_weight ;
		}
		
		if ( $size_headline != '' ) {
			$class[] = $this->prefix . 'size_headline_' . $size_headline ;
		}

		$this->responsive_data_override_class(
			$class, $data_override_class,
			array(
				'prefix' => $this->prefix,
				'param' => 'size',
				'value' => $size
			)
		);

		if ( $shape != '' ) {
			$class[] = $this->prefix . 'shape' . '_' . $shape;
		}

		$this->responsive_data_override_class(
			$class, $data_override_class,
			array(
				'prefix' => $this->prefix,
				'param' => 'align',
				'value' => $align
			)
		);
		
		$link = bt_bb_get_url( $url );

		if ( $icon != '' ) {
			$icon_title = wp_strip_all_tags($title);
			$icon = bt_bb_icon::get_html( $icon, '', $link, $icon_title, $target );
		}

		if ( $link != '' ) {
			if ( $title != '' ) $title = '<a href="' . esc_url( $link ) . '" target="' . esc_attr( $target ) . '">' . $title . '</a>';
		} 

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}

		$class = apply_filters( $this->shortcode . '_class', $class, $atts );

		$output = $icon;

		$output .= '<div class="' . esc_attr( $this->shortcode ) . '_content">';
			if ( $title != '' ) $output .= '<div class="' . esc_attr( $this->shortcode ) . '_content_title"' . $style_attr_font . '>' . $title . '</div>';
			if ( $text != '' ) $output .= '<div class="' . esc_attr( $this->shortcode ) . '_content_text">' . nl2br( $text ) . '</div>';
			
			if ( $read_more_text != '' || ( $read_more_icon != '' && $read_more_icon != 'no_icon' ) ) {
				$read_more_icon_output	= '';
				$read_more_icon_class	= '';
				$read_more_text_html = '';
				$read_more_icon_style	= '';

				$read_more_icon_color_scheme_id = NULL;
				if ( is_numeric ( $read_more_icon_color_scheme ) ) {
					$read_more_icon_color_scheme_id = $read_more_icon_color_scheme;
				} else if ( $read_more_icon_color_scheme != '' ) {
					$read_more_icon_color_scheme_id = bt_bb_get_color_scheme_id( $read_more_icon_color_scheme );
				}
				$read_more_icon_color_scheme_colors = bt_bb_get_color_scheme_colors_by_id( $read_more_icon_color_scheme_id - 1 );
				if ( $read_more_icon_color_scheme_colors ) $read_more_icon_style .= ' --service-read-more-icon-primary-color:' . $read_more_icon_color_scheme_colors[0] . '; --service-read-more-icon-secondary-color:' . $read_more_icon_color_scheme_colors[1] . ';';
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

				$output .= '<div class="bt_bb_grid_item_read_more' . $read_more_icon_class . '"' . $read_more_icon_style_attr . '>';
						$output .= '<a href="' . esc_url_raw( $link ) . '" target="' . esc_attr( $target ) . '">' . $read_more_text_html . ' '  . $read_more_icon_output . '</a>';
				$output .= '</div>';
			}

		$output .= '</div>';
		
		

		$output = '<div' . $id_attr . ' class="' . esc_attr( implode( ' ', $class ) ) . '"' . $style_attr . ' data-bt-override-class="' . htmlspecialchars( json_encode( $data_override_class, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '">' . $output . '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}

	function map_shortcode() {

		require_once( WP_PLUGIN_DIR   .  '/bold-page-builder/content_elements_misc/misc.php' );
		$color_scheme_arr = bt_bb_get_color_scheme_param_array();

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Service', 'ajani' ), 'description' => esc_html__( 'Icon with text', 'ajani' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'icon', 'type' => 'iconpicker', 'heading' => esc_html__( 'Icon', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'title', 'type' => 'textfield', 'heading' => esc_html__( 'Title', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'text', 'type' => 'textarea', 'heading' => esc_html__( 'Text', 'ajani' ) ),
				array( 'param_name' => 'url', 'type' => 'link', 'heading' => esc_html__( 'URL', 'ajani' ), 'description' => esc_html__( 'Enter full or local URL (e.g. https://www.bold-themes.com or /pages/about-us) or post slug (e.g. about-us) or search for existing content.', 'ajani' ) ),
				array( 'param_name' => 'target', 'type' => 'dropdown', 'heading' => esc_html__( 'Target', 'ajani' ),
					'value' => array(
						esc_html__( 'Self (open in same tab)', 'ajani' ) => '_self',
						esc_html__( 'Blank (open in new tab)', 'ajani' ) => '_blank',
					)
				),
				array( 'param_name' => 'align', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon position', 'ajani' ), 'responsive_override' => true,
					'value' => array(
						esc_html__( 'Inherit', 'ajani' ) => 'inherit',
						esc_html__( 'Left', 'ajani' ) => 'left',
						esc_html__( 'Center', 'ajani' ) => 'center',
						esc_html__( 'Right', 'ajani' ) => 'right'
					)
				),
				array( 'param_name' => 'size', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon size', 'ajani' ), 'responsive_override' => true, 'preview' => true, 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Tiny', 'ajani' ) => 'tiny',
						esc_html__( 'Extra small', 'ajani' ) => 'extrasmall',
						esc_html__( 'Small', 'ajani' ) => 'small',				
						esc_html__( 'Normal', 'ajani' ) => 'normal',
						esc_html__( 'Medium', 'ajani' ) => 'medium',
						esc_html__( 'Large', 'ajani' ) => 'large',
						esc_html__( 'Extra large', 'ajani' ) => 'extralarge',
						esc_html__( 'Huge', 'ajani' ) => 'huge'
					)
				),
				array( 'param_name' => 'color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Color scheme', 'ajani' ), 'description' => esc_html__( 'Define color schemes in Bold Builder settings or define accent and alternate colors in theme customizer (if avaliable)', 'ajani' ), 'value' => $color_scheme_arr, 'preview' => true, 'group' => esc_html__( 'Design', 'ajani' ) ),
				array( 'param_name' => 'style', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon style', 'ajani' ), 'preview' => true, 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Filled', 'ajani' ) => 'filled',
						esc_html__( 'Filled with light background', 'ajani' ) => 'filled_with_light_background',
						esc_html__( 'Outline', 'ajani' ) => 'outline',
						esc_html__( 'Borderless', 'ajani' ) => 'borderless'
					)
				),
				array( 'param_name' => 'shape', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon shape', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Square', 'ajani' ) => 'square',
						esc_html__( 'Soft Rounded', 'ajani' ) => 'soft_rounded',
						esc_html__( 'Hard Rounded', 'ajani' ) => 'hard_rounded',
						esc_html__( 'Circle', 'ajani' ) => 'circle'
					)
				),
				array( 'param_name' => 'icon_padding', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon padding', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Regular', 'ajani' ) => 'regular',
						esc_html__( 'No padding', 'ajani' ) => 'none',
					)
				),
				array( 'param_name' => 'font', 'type' => 'dropdown', 'heading' => esc_html__( 'Font', 'ajani' ), 'group' => esc_html__( 'Font', 'ajani' ), 'preview' => true,
					'value' => array( esc_html__( 'Inherit', 'ajani' ) => 'inherit' ) + BT_BB_Root::$font_arr
				),
				array( 'param_name' => 'font_subset', 'type' => 'textfield', 'heading' => esc_html__( 'Google Font subset', 'ajani' ), 'group' => esc_html__( 'Font', 'ajani' ), 'value' => 'latin,latin-ext', 'description' => 'E.g. latin,latin-ext,cyrillic,cyrillic-ext' ),
				array( 'param_name' => 'font_weight', 'type' => 'dropdown', 'heading' => esc_html__( 'Font weight', 'ajani' ), 'group' => esc_html__( 'Font', 'ajani' ),
					'value' => array(
						esc_html__( 'Default', 'ajani' )		=> '',
						esc_html__( 'Normal', 'ajani' ) 		=> 'normal',
						esc_html__( 'Bold', 'ajani' ) 		=> 'bold',
						esc_html__( 'Bolder', 'ajani' ) 		=> 'bolder',
						esc_html__( 'Lighter', 'ajani' )		=> 'lighter',
						esc_html__( 'Light', 'ajani' ) 		=> 'light',
						esc_html__( 'Thin', 'ajani' ) 		=> 'thin',
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
				array( 'param_name' => 'size_headline', 'type' => 'dropdown', 'heading' => esc_html__( 'Headline Size', 'ajani' ), 'description' => esc_html__( 'Predefined heading sizes', 'ajani' ),'group' => esc_html__( 'Font', 'ajani' ),
					'value' => array(
						esc_html__( 'Inherit', 'ajani' ) 	=> 'inherit',
						esc_html__( 'Extra Small', 'ajani' ) => 'extrasmall',
						esc_html__( 'Small', 'ajani' ) 		=> 'small',
						esc_html__( 'Normal', 'ajani' ) 		=> 'normal',
						esc_html__( 'Medium', 'ajani' ) 		=> 'medium',
						esc_html__( 'Large', 'ajani' ) 		=> 'large',
						esc_html__( 'Extra large', 'ajani' ) => 'extralarge',
						esc_html__( 'Huge', 'ajani' ) 		=> 'huge'
					)
				),
				array( 'param_name' => 'read_more_text', 'type' => 'textfield', 'heading' => esc_html__( 'Read more text', 'ajani' ), 'group' => esc_html__( 'Read more', 'ajani' ), 'value' => '' ), 
				array( 'param_name' => 'read_more_icon', 'type' => 'iconpicker', 'heading' => esc_html__( 'Read more icon', 'ajani' ), 'group' => esc_html__( 'Read more', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'read_more_icon_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Read more color scheme', 'ajani' ), 'value' => $color_scheme_arr, 'preview' => true, 'group' => esc_html__( 'Read more', 'ajani' ) ),
			)
		) );
	}
}