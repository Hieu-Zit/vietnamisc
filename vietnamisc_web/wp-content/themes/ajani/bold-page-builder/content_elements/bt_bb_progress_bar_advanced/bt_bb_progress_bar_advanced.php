<?php
class bt_bb_progress_bar_advanced extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts', array(
			'type'        		=> '',
			'percentage'        => '',
			'duration'        	=> '',
			'easing'        	=> '',
			'text'        		=> '',			
			'icon'				=> '',
			'url'				=> '',
			'target'			=> '',
			'size'        		=> '',
			'thickness'			=> '',
			'trail_thickness'	=> '',
			'color_from' 		=> '',
			'color_to' 			=> '',
			'text_color' 		=> '',
			'trail_color'       => '',
			'fill_color'		=> '',
			'transparent'         => ''
		) ), $atts, $this->shortcode ) );

		$pb_id = rand(1000, 100000);

		$content_elements_path		= get_parent_theme_file_uri( 'bold-page-builder/content_elements/bt_bb_progress_bar_advanced/' );
		$content_elements_misc_path_js	= get_parent_theme_file_uri( 'bold-page-builder/content_elements_misc/js/' );
		$content_elements_misc_path_css	= get_parent_theme_file_uri( 'bold-page-builder/content_elements_misc/css/' );

		wp_enqueue_script( 
			'bt_bb_progressbar_advanced_js',
			$content_elements_path . 'bb_progressbar_advanced.js',
			array( 'jquery' ),
			'',
			true
		);

		wp_enqueue_script( 
			'bt_bb_progressbar_advanced',
			$content_elements_misc_path_js . 'bt_bb_progress_bar_advanced.js',
			array( 'jquery' ),
			'',
			true
		);
				
		$class = array( $this->shortcode );
        
		$class[] = 'animate-adv_progressbar';
		
		if ( $el_class != '' ) {
			$class[] = $el_class;
		}

		if ( $transparent != '' ) {
			$class[] = $this->prefix . 'trail_transparent';
		}

		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}

		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}
		
		if ( $size != '' ) {
			$class[] = $this->prefix . 'size' . '_' . $size;
		}		
		
		if ( $percentage == '' ){
			$percentage = 100;
		}
		
		if ( $fill_color != '' ){
			if ( strpos( $fill_color, '#' ) !== false ) {
				$fill_color = $this->hex2rgba($fill_color, 0.5);
			}
		}
		
		$container				= 'container_' . $pb_id;
		$container_text			= $text;
		$container_percentage	= $percentage / 100;
		$container_duration		= ( $duration == '' ) ? '1400' : $duration;	
		$container_easing		= ( $easing == '') ? 'linear' : $easing;
		
		$container_text_color	= ( $text_color == '') ? '' : $text_color;	
		$container_color_from	= ( $color_from == '') ? '#eee' : $color_from;
		$container_color_to		= ( $color_to == '') ? '#000' : $color_to;		
		$container_trail_color	= ( $trail_color == '') ? '#eee' : $trail_color;
		$container_fill			= ( $fill_color) ? $fill_color : null;
		

		if ( $color_to == "" && $color_from != "") {
                    $container_color_to = $container_color_from;
		}

		$container_icon		=  $icon;

		switch( $thickness ){
			case 'small':	$container_depth_from	= 1;	$container_depth_to		= 1;	$container_stroke_width = 1;	$container_trail_width	= 1;break;
			case 'normal':	$container_depth_from	= 2;	$container_depth_to		= 2;	$container_stroke_width = 2;	$container_trail_width	= 2;break;
			case 'medium':	$container_depth_from	= 4;	$container_depth_to		= 4;	$container_stroke_width = 4;	$container_trail_width	= 4;break;
			case 'large':	$container_depth_from	= 6;	$container_depth_to		= 6;	$container_stroke_width = 6;	$container_trail_width	= 6;break;
			case 'xlarge':	$container_depth_from	= 10;	$container_depth_to		= 10;	$container_stroke_width = 10;	$container_trail_width	= 10;break;
			default:break;
		}

		switch( $trail_thickness ){
			case 'small':	$container_trail_width	= 1;break;
			case 'normal':	$container_trail_width	= 2;break;
			case 'medium':	$container_trail_width	= 4;break;
			case 'large':	$container_trail_width	= 6;break;
			case 'xlarge':	$container_trail_width	= 10;break;
			default:break;
		}

		$link = '';

		if ( $url != '' && $url != '#' && substr( $url, 0, 4 ) != 'http' && substr( $url, 0, 5 ) != 'https' && substr( $url, 0, 6 ) != 'mailto' ) {
			$link = bt_bb_get_permalink_by_slug( $url );
		} else {
			$link = $url;
		}

		if ( $container_color_to == "" ) {
			$container_color_to = $container_color_from;
		}
		
		$content = do_shortcode( $content );
		$data = ' data-container="' . esc_attr( $container ) . '"';
		$data .= ' data-container-pbid="' . esc_attr( $pb_id ) . '"';
		$data .= ' data-container-type="' . esc_attr( $type ) . '"';
		$data .= ' data-container-percentage="' . esc_attr( $container_percentage ) . '"';
		$data .= ' data-container-text-color="' . esc_attr( $container_text_color ) . '"';
		$data .= ' data-container-stroke-width="' . esc_attr( $container_stroke_width ) . '"';
		$data .= ' data-container-trail-color="' . esc_attr( $container_trail_color ) . '"';
		$data .= ' data-container-trail-width="' . esc_attr( $container_trail_width ) . '"';
		$data .= ' data-container-easing="' . esc_attr( $container_easing ) . '"';
		$data .= ' data-container-color-from="' . esc_attr( $container_color_from ) . '"';
		$data .= ' data-container-depth-from="' . esc_attr( $container_depth_from ) . '"';
		$data .= ' data-container-color-to="' . esc_attr( $container_color_to ) . '"';
		$data .= ' data-container-depth-to="' . esc_attr( $container_depth_to ) . '"';
		$data .= ' data-container-fill="' . esc_attr( $container_fill ) . '"';
		$data .= ' data-container-icon="' . esc_attr( $container_icon ) . '"';
		$data .= ' data-container-duration="' . esc_attr( $container_duration ) . '"';
		$data .= ' data-container-text="' . esc_attr( $container_text ) . '"';

		$output = '';

		$class = apply_filters( $this->shortcode . '_class', $class, $atts );

		if ( $link != '' ) {
			$target_attr = 'target="_self"';
			if ( $target != '' ) {
				$target_attr = ' ' . 'target="' . ( $target ) . '"';
			}
			$output .= '<a href="' . esc_url_raw( $link ) . '" ' . $target_attr.'>';
		}

			$output .= '<div' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . ' ' . $data . '>';	
				$output .= '<div id="container_' . $pb_id . '" class="container"></div>';
				if ( $container_text != '' ) {
					$output .= '<p>' . $container_text . '</p>';
				}
			$output .= '</div>';

		if ( $link != '' ) {
			$output .= '</a>';
		}

		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );
			
		return $output;

	}

	static function get_icon_html( $icon, $text = '' ) {
		$icon_set	= substr( $icon, 0, -5 );
		$icon		= substr( $icon, -4 );
		return '<span data-ico-' . esc_attr( $icon_set ) . '="&#x' . esc_attr( $icon ) . ';" class="bt_bb_icon_holder">' . $text . '</span>';
	}

	
	static function hex2rgba($color, $opacity = false) {
	 
		$default = 'rgb(0,0,0)';
	 
		
		if(empty($color))
			  return $default; 
	 
		
		if ($color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

	   
		if (strlen($color) == 6) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {			
			return $default;
		}

		
		$rgb =  array_map('hexdec', $hex);

	   
		if($opacity){
			if(abs($opacity) > 1)
					$opacity = 1.0;
			$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
		} else {
			$output = 'rgb('.implode(",",$rgb).')';
		}

		
		return $output;
	}

	function map_shortcode() {
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Advanced Progress bar', 'ajani' ), 'description' => esc_html__( 'Advanced Progress bar', 'ajani' ), 'container' => 'vertical', 'accept' => false, 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'type', 'type' => 'dropdown', 'heading' => esc_html__( 'Progress Bar Type', 'ajani' ), 'preview' => true,
					'value' => array(
						esc_html__( 'Semi circle', 'ajani' ) => 'semi-circle',
						esc_html__( 'Circle', 'ajani' ) => 'circle'
					)
				),
				array( 'param_name' => 'percentage', 'type' => 'textfield', 'heading' => esc_html__( 'Percentage', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'duration', 'type' => 'textfield', 'heading' => esc_html__( 'Animation duration', 'ajani' ), 'preview' => true ),
						array( 'param_name' => 'easing', 'type' => 'dropdown', 'heading' => esc_html__( 'Easing', 'ajani' ), 'preview' => true,
					'value' => array(
						esc_html__( 'Linear', 'ajani' ) => 'linear',
						esc_html__( 'Ease In Out', 'ajani' ) => 'easeInOut',
						esc_html__( 'Bounce', 'ajani' ) => 'bounce'
					)
				),
				array( 'param_name' => 'text', 'type' => 'textfield', 'heading' => esc_html__( 'Text below the icon or percentage', 'ajani' ), 'preview' => true ),				
				array( 'param_name' => 'icon', 'type' => 'iconpicker', 'heading' => esc_html__( 'Icon', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'url', 'type' => 'textfield', 'heading' => esc_html__( 'URL', 'ajani' ) ),
				array( 'param_name' => 'target', 'type' => 'dropdown', 'heading' => esc_html__( 'URL Target', 'ajani' ),
					'value' => array(
						esc_html__( 'Self (open in same tab)', 'ajani' ) => '_self',
						esc_html__( 'Blank (open in new tab)', 'ajani' ) => '_blank',
					)
				),
				array( 'param_name' => 'size', 'type' => 'dropdown', 'heading' => esc_html__( 'Progress bar size', 'ajani' ), 'preview' => true,
					'value' => array(
						esc_html__( 'Extra small', 'ajani' ) => 'extrasmall',
						esc_html__( 'Small', 'ajani' ) => 'small',
						esc_html__( 'Normal', 'ajani' ) => 'normal',
						esc_html__( 'Medium', 'ajani' ) => 'medium',
						esc_html__( 'Large', 'ajani' ) => 'large',
						esc_html__( 'Extra large', 'ajani' ) => 'extralarge',
						esc_html__( 'Huge', 'ajani' ) => 'huge'
					)
				),
				array( 'param_name' => 'thickness', 'type' => 'dropdown', 'heading' => esc_html__( 'Progress bar thickness', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Small', 'ajani' ) => 'small',
						esc_html__( 'Normal', 'ajani' ) => 'normal',
						esc_html__( 'Medium', 'ajani' ) => 'medium',
						esc_html__( 'Large', 'ajani' ) => 'large',
						esc_html__( 'Extra large', 'ajani' ) => 'xlarge'
					)
				),
				array( 'param_name' => 'trail_thickness', 'type' => 'dropdown', 'heading' => esc_html__( 'Progress bar trail thickness', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Same as progress bar', 'ajani' ) => 'progressbar',
						esc_html__( 'Small', 'ajani' ) => 'small',
						esc_html__( 'Normal', 'ajani' ) => 'normal',
						esc_html__( 'Medium', 'ajani' ) => 'medium',
						esc_html__( 'Large', 'ajani' ) => 'large',
						esc_html__( 'Extra large', 'ajani' ) => 'xlarge'
					)
				),
				array( 'param_name' => 'color_from', 'type' => 'colorpicker', 'heading' => esc_html__( 'Starting Progress Bar Background color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
				array( 'param_name' => 'color_to', 'type' => 'colorpicker', 'heading' => esc_html__( 'Ending Progress Bar Background color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
				array( 'param_name' => 'text_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Text color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
				array( 'param_name' => 'trail_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Color for lighter trail stroke underneath the actual progress path', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
				array( 'param_name' => 'fill_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Fill color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
				array( 'param_name' => 'transparent', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'show_transparent_trail' ), 'heading' => esc_html__( 'Show trail as semi transparent', 'ajani' ), 'description' => esc_html__( 'Makes the progress bar trail semi transparent, at opacity od 10%.', 'ajani' ), 'preview' => true, 'group' => esc_html__( 'Design', 'ajani' ) )
			)
		) );
	}
}

