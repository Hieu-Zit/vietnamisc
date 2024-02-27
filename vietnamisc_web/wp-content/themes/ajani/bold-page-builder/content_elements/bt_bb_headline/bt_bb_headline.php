<?php
class bt_bb_headline extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'headline'      		=> '',
			'html_tag'      		=> '',
			'font'          		=> '',
			'font_subset'   		=> '',
			'size'     				=> '',
			'font_size'     		=> '',
			'font_weight'   		=> '',
			'color_scheme'  		=> '',
			'color'         		=> '',
			'supertitle_position'   => '',
			'dash'          		=> '',
			'align'         		=> '',
			'url'           		=> '',
			'target'        		=> '',
			'superheadline' 		=> '',
			'subheadline'   		=> '',			
			'image'  				=> '',
			'dash_type'				=> '',
			'dash_color'			=> '',
			'dash_custom_color'   	=> '',
			'headline_side_text'	=> '',
			'side_text_size'		=> '',
			'side_text_color'		=> '',
			'line_height'			=> ''
		) ), $atts, $this->shortcode ) );		

		$superheadline = html_entity_decode( $superheadline, ENT_QUOTES, 'UTF-8' );
		$subheadline = html_entity_decode( $subheadline, ENT_QUOTES, 'UTF-8' );
		$headline = html_entity_decode( $headline, ENT_QUOTES, 'UTF-8' );
		$headline_side_text = html_entity_decode( $headline_side_text, ENT_QUOTES, 'UTF-8' );

		if ( $font != '' && $font != 'inherit' ) {
			require_once( WP_PLUGIN_DIR   .  '/bold-page-builder/content_elements_misc/misc.php' );
			bt_bb_enqueue_google_font( $font, $font_subset );
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
		
		$html_tag_class =  array( 'bt_bb_headline_tag' );
		$html_tag_style = '';
		$html_tag_style_arr = array();
		if ( $font != '' && $font != 'inherit' ) {
			$el_style .= ';' . 'font-family:\'' . urldecode_deep( $font ) . '\';';
			$html_tag_style_arr[] = 'font-family:\'' . urldecode_deep( $font ) . '\';';
		}
		
		$h_span_bg_style = '';
		if ( $image != '' && is_numeric( $image ) ) {
			$post_image = get_post( $image );
			if ( $post_image == '' ) return;
			$image = wp_get_attachment_image_src( $image, $size );
			if ( isset( $image[0] ) ){
				$image = $image[0];
				$class[] = "btHasBgImage";
				$h_span_bg_style = "style = \"background-image:url('" . $image . "')\"";
			}			
		}
		
		if ( $font_size != '' ) {
			$html_tag_style_arr[] = 'font-size:' . $font_size  ;
		}
		if ( count( $html_tag_style_arr ) > 0 ) {
			$html_tag_style = ' style="' . implode( '; ', $html_tag_style_arr ) . '"';
		}
		
		if ( $font_weight != '' ) {
			$class[] = $this->prefix . 'font_weight_' . $font_weight ;
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

		if ( $dash != '' ) {
			$class[] = $this->prefix . 'dash' . '_' . $dash;
		}
		
		if ( $dash_type != '' ) {
			$class[] = $this->prefix . 'dash_type_' . $dash_type;
		}
		
		if ( $dash_color != '' && $dash_custom_color == '' ) {
			$class[] = $this->prefix . 'dash_color_' . $dash_color;
		}
		
		if ( $line_height != '' ) {
			$html_tag_class[] = $this->prefix . 'line_height_' . $line_height;
		}
		
		if ( $color != '' ) {
			$el_style .= 'color:' . $color . ';border-color:' . $color . ';';
		}
		
		if ( $dash_custom_color != '' ) {
			$class[] = $this->prefix . 'dash_color_custom';
			$el_style .= '--dash-color:' . $dash_custom_color . ';';
		}
		
		$this->responsive_data_override_class(
			$class, $data_override_class,
			array(
				'prefix' => $this->prefix,
				'param' => 'size',
				'value' => $size
			)
		);
		
		if ( $target == '' ) {
			$target = '_self';
		}
		
		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}

		$superheadline_inside = '';
		$superheadline_outside = '';
		
		if ( $superheadline != '' ) {
			$class[] = $this->prefix . 'superheadline';
			if ( $supertitle_position == 'outside' ) { 
				$superheadline_outside = '<span class="' . esc_attr( $this->shortcode ) . '_superheadline">' . $superheadline . '</span>';
			} else {
				$superheadline_inside = '<span class="' . esc_attr( $this->shortcode ) . '_superheadline">' . $superheadline . '</span>';
			}
		}
		
		if ( $subheadline != '' ) {
			$class[] = $this->prefix . 'subheadline';
			$subheadline = '<div class="' . esc_attr( $this->shortcode ) . '_subheadline">' . $subheadline . '</div>';
			$subheadline = nl2br( $subheadline );
		}
		
		$headline_side_text = html_entity_decode( $headline_side_text, ENT_QUOTES, 'UTF-8' );
		if ( $headline_side_text != '' ) {
			$class[] = $this->prefix . 'headline_side_text';
			$headline_side_class = array( $this->prefix . 'headline_side_text' );
			if ( $side_text_size != '' ) {
				$class[] = $this->prefix . 'side_text_size_' . $side_text_size;
				$headline_side_class[] = $this->prefix . 'side_text_size_' . $side_text_size;
			}
			$headline_side_style = '';
			if ( $side_text_color != '' ) {
				$headline_side_style = 'color: ' . $side_text_color . ';';
			}
			$headline_side_style_attr = '';
			if ( $headline_side_style != '' ) {
				$headline_side_style_attr = ' ' . 'style="' . esc_attr( $headline_side_style ) . '"';
			}		
			
			$headline_side_text = '<span class="' . implode( ' ', $headline_side_class ) . '"' . $headline_side_style_attr . '>' . $headline_side_text . '</span>';
			$headline_side_text = nl2br( $headline_side_text );
		}

		$this->responsive_data_override_class(
			$class, $data_override_class,
			array(
				'prefix' => $this->prefix,
				'param' => 'align',
				'value' => $align
			)
		);
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		
		if ( $headline != '' ) {
			if ( $url != '' ) {
				$url_title = strip_tags( str_replace( array("\n", "\r"), ' ', $headline ) );
				$link = bt_bb_get_url( $url );
				// IMPORTANT: esc_attr must be used instead of esc_url(_raw)
				$headline = '<a href="' . esc_attr( $link ) . '" target="' . esc_attr( $target ) . '" title="' . esc_attr( $url_title )  . '">' . $headline . '</a>';
			}		
			$headline = '<span class="' . esc_attr( $this->shortcode ) . '_content">' . $headline_side_text . '<span ' . $h_span_bg_style . '>' . $headline . '</span></span>';			
		}
		
		$headline = nl2br( $headline );
		
		$superheadline_outside_class = $this->shortcode . '_superheadline_outside';

		$output = '<header' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . ' data-bt-override-class="' . htmlspecialchars( json_encode( $data_override_class, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '">';
		if ( $superheadline_outside != '' ) $output .= '<div class="' . esc_attr( $superheadline_outside_class ) . '">' . $superheadline_outside . '</div>';
		if ( $headline != '' || $superheadline_inside != '' ) $output .= '<' . $html_tag . $html_tag_style . ' class="' . implode( ' ', $html_tag_class ) . '">' . $superheadline_inside . $headline . '</' . $html_tag . '>';
		$output .= $subheadline . '</header>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}

	function map_shortcode() {

		require_once( WP_PLUGIN_DIR   .  '/bold-page-builder/content_elements_misc/fonts1.php' );
		require_once( WP_PLUGIN_DIR   .  '/bold-page-builder/content_elements_misc/misc.php' );
		$color_scheme_arr = bt_bb_get_color_scheme_param_array();

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Headline', 'ajani' ), 'description' => esc_html__( 'Headline with custom Google fonts', 'ajani' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode, 'highlight' => true,
			'params' => array(
				array( 'param_name' => 'superheadline', 'type' => 'textfield', 'heading' => esc_html__( 'Superheadline', 'ajani' ) ),
				array( 'param_name' => 'headline', 'type' => 'textarea', 'heading' => esc_html__( 'Headline', 'ajani' ), 'preview' => true, 'preview_strong' => true ),
				array( 'param_name' => 'subheadline', 'type' => 'textarea', 'heading' => esc_html__( 'Subheadline', 'ajani' ) ),
				array( 'param_name' => 'html_tag', 'type' => 'dropdown', 'heading' => esc_html__( 'HTML tag', 'ajani' ), 'preview' => true,
					'value' => array(
						esc_html__( 'h1', 'ajani' ) 	=> 'h1',
						esc_html__( 'h2', 'ajani' ) 	=> 'h2',
						esc_html__( 'h3', 'ajani' ) 	=> 'h3',
						esc_html__( 'h4', 'ajani' ) 	=> 'h4',
						esc_html__( 'h5', 'ajani' ) 	=> 'h5',
						esc_html__( 'h6', 'ajani' ) 	=> 'h6'
					)
				), 
				array( 'param_name' => 'line_height', 'type' => 'dropdown', 'heading' => esc_html__( 'HTML tag line height', 'ajani' ), 'preview' => true,
					'value' => array(
						esc_html__( 'Default 1.2', 'ajani' )				=> '',
						esc_html__( 'Line height 1', 'ajani' )		=> '1',
						esc_html__( 'Line height 1.5', 'ajani' )		=> '1_5',
						esc_html__( 'Line height 1.75', 'ajani' )		=> '1_75',
						esc_html__( 'Line height 2', 'ajani' )		=> '2'
					)
				), 	
				array( 'param_name' => 'size', 'type' => 'dropdown', 'heading' => esc_html__( 'Size', 'ajani' ), 'description' => esc_html__( 'Predefined heading sizes, independent of html tag', 'ajani' ), 'responsive_override' => true,
					'value' => array(
						esc_html__( 'Inherit', 'ajani' ) 	=> 'inherit',
						esc_html__( 'Extra Small', 'ajani' ) => 'extrasmall',
						esc_html__( 'Small', 'ajani' ) 		=> 'small',
						esc_html__( 'Normal', 'ajani' ) 		=> 'normal',
						esc_html__( 'Medium', 'ajani' ) 		=> 'medium',
						esc_html__( 'Large', 'ajani' ) 		=> 'large',
						esc_html__( 'Extra large', 'ajani' ) => 'extralarge',
						esc_html__( 'Huge', 'ajani' ) 		=> 'huge',
						esc_html__( 'Extra huge', 'ajani' ) 		=> 'extrahuge'
					)
				),				
				array( 'param_name' => 'align', 'type' => 'dropdown', 'heading' => esc_html__( 'Alignment', 'ajani' ), 'responsive_override' => true,
					'value' => array(
						esc_html__( 'Inherit', 'ajani' ) 	=> 'inherit',
						esc_html__( 'Left', 'ajani' ) 		=> 'left',
						esc_html__( 'Center', 'ajani' ) 		=> 'center',
						esc_html__( 'Right', 'ajani' )		=> 'right'
					)
				),
				array( 'param_name' => 'dash', 'type' => 'dropdown', 'heading' => esc_html__( 'Dash', 'ajani' ), 'description' => esc_html__( 'You can use \'behind\' only with dash type diamond and circle.', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'None', 'ajani' ) 			=> 'none',
						esc_html__( 'Top', 'ajani' ) 			=> 'top',
						esc_html__( 'Bottom', 'ajani' ) 			=> 'bottom',
						esc_html__( 'Top and bottom', 'ajani' ) 	=> 'top_bottom',
						esc_html__( 'Behind', 'ajani' ) => 'behind'
					)
				),
				array( 'param_name' => 'dash_type', 'type' => 'dropdown', 'heading' => esc_html__( 'Dash type', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Line', 'ajani' ) => 'line',
						esc_html__( 'Diamond', 'ajani' ) => 'diamond',
						esc_html__( 'Circle', 'ajani' ) => 'circle'
					)
				),
				array( 'param_name' => 'dash_color', 'type' => 'dropdown', 'heading' => esc_html__( 'Dash color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Accent', 'ajani' ) => 'accent',
						esc_html__( 'Alternate', 'ajani' ) => 'alternate'
					)
				),
				array( 'param_name' => 'dash_custom_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Dash custom color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Color scheme', 'ajani' ), 'description' => esc_html__( 'Define color schemes in Bold Builder settings or define accent and alternate colors in theme customizer (if avaliable)', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ), 'value' => $color_scheme_arr, 'preview' => true ),
				array( 'param_name' => 'color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'supertitle_position', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'outside' ), 'heading' => esc_html__( 'Put supertitle outside H tag', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'font', 'type' => 'dropdown', 'heading' => esc_html__( 'Font', 'ajani' ), 'group' => esc_html__( 'Font', 'ajani' ), 'preview' => true,
					'value' => array( esc_html__( 'Inherit', 'ajani' ) => 'inherit' ) + BT_BB_Root::$font_arr
				),
				array( 'param_name' => 'font_subset', 'type' => 'textfield', 'heading' => esc_html__( 'Google Font subset', 'ajani' ), 'group' => esc_html__( 'Font', 'ajani' ), 'value' => 'latin,latin-ext', 'description' => esc_html__( 'E.g. latin,latin-ext,cyrillic,cyrillic-ext', 'ajani' ) ),
				array( 'param_name' => 'font_size', 'type' => 'textfield', 'heading' => esc_html__( 'Custom font size', 'ajani' ), 'group' => esc_html__( 'Font', 'ajani' ), 'description' => esc_html__( 'E.g. 20px or 1.5rem', 'ajani' ) ),
				array( 'param_name' => 'font_weight', 'type' => 'dropdown', 'heading' => esc_html__( 'Font weight', 'ajani' ), 'group' => esc_html__( 'Font', 'ajani' ),
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
				array( 'param_name' => 'url', 'type' => 'link', 'heading' => esc_html__( 'URL', 'ajani' ), 'description' => esc_html__( 'Enter full or local URL (e.g. https://www.bold-themes.com or /pages/about-us) or post slug (e.g. about-us) or search for existing content.', 'ajani' ), 'group' => esc_html__( 'URL', 'ajani' ) ),
				array( 'param_name' => 'target', 'type' => 'dropdown', 'heading' => esc_html__( 'Target', 'ajani' ), 'group' => esc_html__( 'URL', 'ajani' ),
					'value' => array(
						esc_html__( 'Self (open in same tab)', 'ajani' ) => '_self',
						esc_html__( 'Blank (open in new tab)', 'ajani' ) => '_blank'
					)
				),
				array( 'param_name' => 'headline_side_text', 'type' => 'textfield', 'heading' => esc_html__( 'Headline side text', 'ajani' ) ),
				array( 'param_name' => 'side_text_size', 'type' => 'dropdown', 'default' => 'small', 'heading' => esc_html__( 'Headline side text size', 'ajani' ), 'preview' => true, 
					'value' => array(
						esc_html__( 'Normal', 'ajani' ) => 'normal',
						esc_html__( 'Medium', 'ajani' ) => 'medium',
						esc_html__( 'Large', 'ajani' ) => 'large',
						esc_html__( 'Extra large', 'ajani' ) => 'extralarge'
					)
				),
				array( 'param_name' => 'side_text_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Headline side text color', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'image', 'type' => 'attach_image', 'heading' => esc_html__( 'Background image', 'ajani' ), 'preview' => true, 'group' => esc_html__( 'Font', 'ajani' ) ),
			)
		) );
	}
}