<?php

class bt_bb_section extends BT_BB_Element {
    
        function  bb_exist(){
            if ( file_exists( WP_PLUGIN_DIR . '/bold-page-builder/bold-builder.php' ) ) { return true; }
            return false;
        }

	function handle_shortcode( $atts, $content ) {
                if ( !$this->bb_exist() ) { return false; }
            
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
				'layout'                	=> '',
				'full_screen'           	=> '',
				'vertical_align'        	=> '',
				'top_spacing'           	=> '',
				'bottom_spacing'        	=> '',
				'negative_margin'        	=> '',
				'color_scheme'          	=> '',
				'background_color'      	=> '',
				'background_image'      	=> '',
				'lazy_load'					=> 'no',
				'background_video_yt'   	=> '',
				'yt_video_settings'     	=> '',
				'background_video_mp4'  	=> '',
				'background_video_ogg'  	=> '',
				'background_video_webm' 	=> '',
				'show_video_on_mobile' 		=> '',
				'parallax'              	=> '',
				'parallax_offset'       	=> '',
			'background_position'    	=> '',
			'background_size'               => '',
					'top_section_coverage_image'    => '',
					'bottom_section_coverage_image' => '',
			'allow_content_outside'         => 'no',
			'background_overlay_custom_css' => '',
			'background_overlay_color'		=> ''
		) ), $atts, $this->shortcode ) );

		$class = array( $this->shortcode );

		wp_enqueue_script(
			'bt_bb_elements',
			 plugins_url() . '/bold-page-builder/content_elements/bt_bb_section/bt_bb_elements.js',
			 array( 'jquery' ),
			 '',
			 true
		);

		$show_video_on_mobile = ( $show_video_on_mobile == 'show_video_on_mobile' || $show_video_on_mobile == 'yes' ) ? 1 : 0;
		
		if ( $negative_margin != '' ) {
			$class[] = $this->prefix . 'negative_margin' . '_' . $negative_margin;
		}

		$color_scheme_id = NULL;
		if ( is_numeric ( $color_scheme ) ) {
			$color_scheme_id = $color_scheme;
		} else if ( $color_scheme != '' ) {
			$color_scheme_id = bt_bb_get_color_scheme_id( $color_scheme );
		}
		$color_scheme_colors = bt_bb_get_color_scheme_colors_by_id( $color_scheme_id - 1 );
		if ( $color_scheme_colors ) $el_style .= '; --section-primary-color:' . $color_scheme_colors[0] . '; --section-secondary-color:' . $color_scheme_colors[1] . ';';
		if ( $color_scheme != '' ) $class[] = $this->prefix . 'color_scheme_' .  $color_scheme_id;
		
		if ( $background_color != '' ) {
			$el_style = $el_style . ';' . 'background-color:' . $background_color . ';';
		}

		if ( $layout != '' ) {
			$class[] = $this->prefix . 'layout' . '_' . $layout;
		}

		if ( $full_screen == 'yes' ) {
			$class[] = $this->prefix . 'full_screen';
		}

		if ( $vertical_align != '' ) {
			$class[] = $this->prefix . 'vertical_align' . '_' . $vertical_align;
		}

		$data_parallax_attr = '';
		if ( $parallax != '' && ! wp_is_mobile() ) {
			$parallax = -$parallax;
			$data_parallax_attr = 'data-parallax="' . esc_attr( $parallax ) . '" data-parallax-offset="' . esc_attr( intval( $parallax_offset ) ) . '"';
			$class[] = $this->prefix . 'parallax';
		}
		$background_data_attr = '';

		if ( $background_image != '' ) {
			$background_image = wp_get_attachment_image_src( $background_image, 'full' );
			$background_image_url = $background_image ? $background_image[0] : '';
			if ( $lazy_load == 'yes' ) {
				$blank_image_src = BT_BB_Root::$path . 'img/blank.gif';
				$background_image_style = 'background-image:url(\'' . $blank_image_src . '\');';
				$background_data_attr .= ' data-background_image_src="\'' . $background_image_url . '\'"';
				$class[] = 'btLazyLoadBackground';
			} else {
				$background_image_style = 'background-image:url(\'' . $background_image_url . '\');';
				
			}
			$el_style = $background_image_style . $el_style;	
			$class[] = $this->prefix . 'background_image';
		}
		
		if ( $background_overlay_custom_css != '' ) {
			$class[] = $this->prefix . 'background_overlay_custom_css' . '_' . $background_overlay_custom_css;
		}

		$section_coverage_image_output = '';

		if ( $top_section_coverage_image != '' ) { 
			$alt_top_section_coverage_image = get_post_meta($top_section_coverage_image, '_wp_attachment_image_alt', true);
			$alt_top_section_coverage_image = $alt_top_section_coverage_image ? $alt_top_section_coverage_image : $this->shortcode . '_top_section_coverage_image';

			$top_section_coverage_image = wp_get_attachment_image_src( $top_section_coverage_image, 'full' );                     
			if ( isset($top_section_coverage_image[0]) ){
				$top_section_coverage_image = $top_section_coverage_image[0];
				$section_coverage_image_output .= 
						'<div class="' . esc_attr( $this->shortcode ) . '_top_section_coverage_image">'
							. '<img src="' . esc_url_raw($top_section_coverage_image) . '" alt="' . esc_attr($alt_top_section_coverage_image) . '" />'
						. '</div>';
				$class[] = $this->shortcode . '_with_top_coverage_image';
			}
		}
		
		if ( $bottom_section_coverage_image != '' ) {  
			$alt_bottom_section_coverage_image = get_post_meta($bottom_section_coverage_image, '_wp_attachment_image_alt', true);
			$alt_bottom_section_coverage_image = $alt_bottom_section_coverage_image ? $alt_bottom_section_coverage_image : $this->shortcode . '_bottom_section_coverage_image';

			$bottom_section_coverage_image = wp_get_attachment_image_src( $bottom_section_coverage_image, 'full' );
			if ( isset($bottom_section_coverage_image[0]) ){
				$bottom_section_coverage_image = $bottom_section_coverage_image[0];                    
				$section_coverage_image_output .= 
						'<div class="' . esc_attr( $this->shortcode ) . '_bottom_section_coverage_image">'
							. '<img src="' . esc_url_raw($bottom_section_coverage_image) . '" alt="' . esc_attr($alt_bottom_section_coverage_image) . '" />'
						. '</div>';
				$class[] = $this->shortcode . '_with_bottom_coverage_image';
			}
		}
		
		$id_attr = '';
		if ( $el_id == '' ) {
			$el_id = uniqid( 'bt_bb_section' );
		}
		$id_attr = 'id="' . esc_attr( $el_id ) . '"';

		$background_video_attr = '';

		$video_html = '';

		if ( $background_video_yt != '' ) {
			wp_enqueue_style( 'bt_bb_style_yt', plugins_url() . '/bold-page-builder/content_elements/bt_bb_section/jquery.mb.YTPlayer.min.css' );
			wp_enqueue_script( 
				'bt_bb_yt',
				plugins_url() . '/bold-page-builder/content_elements/bt_bb_section/jquery.mb.YTPlayer.min.js',
				array( 'jquery' ),
				'',
				true
			);

			$class[] = $this->prefix . 'background_video_yt';

			if ( $yt_video_settings == '' ) {
				$yt_video_settings = 'showControls:false,showYTLogo:false,startAt:0,loop:true,mute:true,stopMovieOnBlur:false,opacity:1';
				// $yt_video_settings = '';
			}
			
			$yt_video_settings .= $show_video_on_mobile ? ',useOnMobile:true' : ',useOnMobile:false';
			
			$yt_video_settings .= '';

			$yt_video_settings .= ',useNoCookie:false';
			
			$background_video_attr = ' ' . 'data-property="{videoURL:\'' . $background_video_yt . '\',containment:\'#' . $el_id . '\',' . $yt_video_settings . '}"';
			
			$video_html .= '<div class="' . $this->prefix . 'background_video_yt_inner" ' . $background_video_attr . ' ></div>';
			
			$proxy = new BT_BB_YT_Video_Proxy( $this->prefix, $el_id );

			add_action( 'wp_footer', array( $proxy, 'js_init' ) );

		} else if ( ( $background_video_mp4 != '' || $background_video_ogg != '' || $background_video_webm != '' ) && ! ( wp_is_mobile() && ! $show_video_on_mobile ) ) {
			$class[] = $this->prefix . 'video';
			$video_html = '<video autoplay loop muted playsinline onplay="bt_bb_video_callback( this )">';
			if ( $background_video_mp4 != '' ) {
				$video_html .= '<source src="' . esc_url_raw( $background_video_mp4 ) . '" type="video/mp4">';
			}
			if ( $background_video_ogg != '' ) {
				$video_html .= '<source src="' . esc_url_raw( $background_video_ogg ) . '" type="video/ogg">';
			}
			if ( $background_video_webm != '' ) {
				$video_html .= '<source src="' . esc_url_raw( $background_video_webm ) . '" type="video/webm">';
			}
			$video_html .= '</video>';
		}

		$background_position_style  = $background_position  != '' ? 'background-position:' . $background_position . ';' : '';
		$background_size_style      = $background_size      != '' ? 'background-size:' . $background_size . ';' : '';

		$style_attr = '';
		$el_style = apply_filters( $this->shortcode . '_style', $el_style, $atts );
		if ( $el_style != '' || $background_position_style != '' || $background_size_style != '' ) {
			$style_attr = 'style="' . esc_attr( $el_style . $background_position_style . $background_size_style ) . '"';
		}  

		$this->responsive_data_override_class(
			$class, $data_override_class,
			array(
				'prefix' => $this->prefix,
				'param' => 'top_spacing',
				'value' => $top_spacing
			)
		);
		
		$this->responsive_data_override_class(
			$class, $data_override_class,
			array(
				'prefix' => $this->prefix,
				'param' => 'bottom_spacing',
				'value' => $bottom_spacing
			)
		);

		if ( $allow_content_outside == 'yes' ) {
			$class[] = $this->shortcode . '_allow_content_outside';
		}

		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		$class_attr = implode( ' ', $class );

		if ( $el_class != '' ) {
			$class_attr = $class_attr . ' ' . $el_class;
		}   
		
		$style_attr_overlay = '';
		if ( $background_overlay_color != '' ) {
			$style_attr_overlay .= 'background-color: ' . $background_overlay_color . ';';
		}  
		if ( $background_overlay_custom_css != '' ) {
			$style_attr_overlay .= $background_overlay_custom_css;
	    }
		
		if ( $style_attr_overlay != '' ) {
			$style_attr_overlay = ' style="' . esc_attr( $style_attr_overlay ) . '"';
		}
		

		$output = '<section ' . $id_attr . ' ' . $data_parallax_attr . $background_data_attr . ' class="' . esc_attr( $class_attr ) . '" ' . $style_attr . $background_video_attr . '  data-bt-override-class="' . htmlspecialchars( json_encode( $data_override_class, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '">'
				. '<span class="' . esc_attr( $this->prefix ) . 'overlay"' . $style_attr_overlay . '></span>';
		$output .= $video_html;
		$output .= '<div class="' . esc_attr( $this->prefix ) . 'port">';
		$output .= '<div class="' . esc_attr( $this->prefix ) . 'cell">';
		$output .= '<div class="' . esc_attr( $this->prefix ) . 'cell_inner">';
		$output .= do_shortcode( $content );
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';		
		$output .= $section_coverage_image_output;
		$output .= '</section>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}

	function map_shortcode() {
		if ( !$this->bb_exist() ) { return false; }
		require_once( WP_PLUGIN_DIR   . '/bold-page-builder/content_elements_misc/misc.php' );
		$color_scheme_arr = bt_bb_get_color_scheme_param_array();

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Section', 'ajani' ), 'description' => esc_html__( 'Basic root element', 'ajani' ), 'root' => true, 'container' => 'vertical', 'accept' => array( 'bt_bb_row' => true ), 'toggle' => true, 'auto_add' => 'bt_bb_row', 'show_settings_on_create' => false,
			'params' => array( 
				array( 'param_name' => 'layout', 'type' => 'dropdown', 'default' => 'boxed_1200', 'heading' => esc_html__( 'Layout', 'ajani' ), 'group' => esc_html__( 'General', 'ajani' ), 'weight' => 0, 'preview' => true,
					'value' => array(
						esc_html__( 'Boxed (800px)', 'ajani' ) => 'boxed_800',
						esc_html__( 'Boxed (900px)', 'ajani' ) => 'boxed_900',
						esc_html__( 'Boxed (1000px)', 'ajani' ) => 'boxed_1000',
						esc_html__( 'Boxed (1100px)', 'ajani' ) => 'boxed_1100',
						esc_html__( 'Boxed (1200px)', 'ajani' ) => 'boxed_1200',
						esc_html__( 'Boxed (1300px)', 'ajani' ) => 'boxed_1300',
						esc_html__( 'Boxed (1400px)', 'ajani' ) => 'boxed_1400',
						esc_html__( 'Boxed (1500px)', 'ajani' ) => 'boxed_1500',
						esc_html__( 'Boxed (1600px)', 'ajani' ) => 'boxed_1600',
						esc_html__( 'Wide', 'ajani' ) => 'wide'
					)
				),
				array( 'param_name' => 'top_spacing', 'type' => 'dropdown', 'heading' => esc_html__( 'Top spacing', 'ajani' ), 'preview' => true,
					'responsive_override' => true, 'value' => array(
						esc_html__( 'No spacing', 'ajani' ) 	=> 'none',
						esc_html__( 'Extra small', 'ajani' ) 	=> 'extra_small',
						esc_html__( 'Small', 'ajani' ) 		=> 'small',		
						esc_html__( 'Normal', 'ajani' ) 		=> 'normal',
						esc_html__( 'Medium', 'ajani' ) 		=> 'medium',
						esc_html__( 'Large', 'ajani' ) 		=> 'large',
						esc_html__( 'Extra large', 'ajani' ) 	=> 'extra_large',
						esc_html__( '5px', 'ajani' ) 			=> '5',
						esc_html__( '10px', 'ajani' ) 		=> '10',
						esc_html__( '15px', 'ajani' ) 		=> '15',
						esc_html__( '20px', 'ajani' ) 		=> '20',
						esc_html__( '25px', 'ajani' ) 		=> '25',
						esc_html__( '30px', 'ajani' ) 		=> '30',
						esc_html__( '35px', 'ajani' ) 		=> '35',
						esc_html__( '40px', 'ajani' ) 		=> '40',
						esc_html__( '45px', 'ajani' ) 		=> '45',
						esc_html__( '50px', 'ajani' ) 		=> '50',
						esc_html__( '55px', 'ajani' ) 		=> '55',
						esc_html__( '60px', 'ajani' ) 		=> '60',
						esc_html__( '65px', 'ajani' ) 		=> '65',
						esc_html__( '70px', 'ajani' ) 		=> '70',
						esc_html__( '75px', 'ajani' ) 		=> '75',
						esc_html__( '80px', 'ajani' ) 		=> '80',
						esc_html__( '85px', 'ajani' ) 		=> '85',
						esc_html__( '90px', 'ajani' ) 		=> '90',
						esc_html__( '95px', 'ajani' ) 		=> '95',
						esc_html__( '100px', 'ajani' ) 		=> '100',
						esc_html__( '110px', 'ajani' ) 		=> '110',
						esc_html__( '120px', 'ajani' ) 		=> '120',
						esc_html__( '130px', 'ajani' ) 		=> '130',
						esc_html__( '140px', 'ajani' ) 		=> '140',
						esc_html__( '150px', 'ajani' ) 		=> '150',
						esc_html__( '160px', 'ajani' ) 		=> '160',
						esc_html__( '170px', 'ajani' ) 		=> '170',
						esc_html__( '180px', 'ajani' ) 		=> '180',
						esc_html__( '190px', 'ajani' ) 		=> '190',
						esc_html__( '200px', 'ajani' ) 		=> '200',
						esc_html__( '210px', 'ajani' ) 		=> '210',
						esc_html__( '220px', 'ajani' ) 		=> '220',
						esc_html__( '230px', 'ajani' ) 		=> '230',
						esc_html__( '240px', 'ajani' ) 		=> '240',
						esc_html__( '250px', 'ajani' ) 		=> '250'
					)
				),
				array( 'param_name' => 'bottom_spacing', 'type' => 'dropdown', 'heading' => esc_html__( 'Bottom spacing', 'ajani' ), 'preview' => true,
					'responsive_override' => true, 'value' => array(
						esc_html__( 'No spacing', 'ajani' ) 	=> 'none',
						esc_html__( 'Extra small', 'ajani' ) 	=> 'extra_small',
						esc_html__( 'Small', 'ajani' ) 		=> 'small',		
						esc_html__( 'Normal', 'ajani' ) 		=> 'normal',
						esc_html__( 'Medium', 'ajani' ) 		=> 'medium',
						esc_html__( 'Large', 'ajani' ) 		=> 'large',
						esc_html__( 'Extra large', 'ajani' ) 	=> 'extra_large',
						esc_html__( '5px', 'ajani' ) 			=> '5',
						esc_html__( '10px', 'ajani' ) 		=> '10',
						esc_html__( '15px', 'ajani' ) 		=> '15',
						esc_html__( '20px', 'ajani' ) 		=> '20',
						esc_html__( '25px', 'ajani' ) 		=> '25',
						esc_html__( '30px', 'ajani' ) 		=> '30',
						esc_html__( '35px', 'ajani' ) 		=> '35',
						esc_html__( '40px', 'ajani' ) 		=> '40',
						esc_html__( '45px', 'ajani' ) 		=> '45',
						esc_html__( '50px', 'ajani' ) 		=> '50',
						esc_html__( '55px', 'ajani' ) 		=> '55',
						esc_html__( '60px', 'ajani' ) 		=> '60',
						esc_html__( '65px', 'ajani' ) 		=> '65',
						esc_html__( '70px', 'ajani' ) 		=> '70',
						esc_html__( '75px', 'ajani' ) 		=> '75',
						esc_html__( '80px', 'ajani' ) 		=> '80',
						esc_html__( '85px', 'ajani' ) 		=> '85',
						esc_html__( '90px', 'ajani' ) 		=> '90',
						esc_html__( '95px', 'ajani' ) 		=> '95',
						esc_html__( '100px', 'ajani' ) 		=> '100',
						esc_html__( '110px', 'ajani' ) 		=> '110',
						esc_html__( '120px', 'ajani' ) 		=> '120',
						esc_html__( '130px', 'ajani' ) 		=> '130',
						esc_html__( '140px', 'ajani' ) 		=> '140',
						esc_html__( '150px', 'ajani' ) 		=> '150',
						esc_html__( '160px', 'ajani' ) 		=> '160',
						esc_html__( '170px', 'ajani' ) 		=> '170',
						esc_html__( '180px', 'ajani' ) 		=> '180',
						esc_html__( '190px', 'ajani' ) 		=> '190',
						esc_html__( '200px', 'ajani' ) 		=> '200',
						esc_html__( '210px', 'ajani' ) 		=> '210',
						esc_html__( '220px', 'ajani' ) 		=> '220',
						esc_html__( '230px', 'ajani' ) 		=> '230',
						esc_html__( '240px', 'ajani' ) 		=> '240',
						esc_html__( '250px', 'ajani' ) 		=> '250'
					)
				),
				array( 'param_name' => 'negative_margin', 'type' => 'dropdown', 'heading' => esc_html__( 'Negative margin', 'ajani' ), 'group' => esc_html__( 'General', 'ajani' ), 'weight' => 4, 'preview' => true,
				'value' => array(
						esc_html__( 'No margin', 'ajani' ) 	=> '',
						esc_html__( 'Small', 'ajani' ) 		=> 'small',
						esc_html__( 'Normal', 'ajani' ) 		=> 'normal',
						esc_html__( 'Medium', 'ajani' ) 		=> 'medium',
						esc_html__( 'Large', 'ajani' ) 		=> 'large',
						esc_html__( 'Extra Large', 'ajani' ) 	=> 'extralarge',
						esc_html__( '5px', 'ajani' ) 			=> '5',
						esc_html__( '10px', 'ajani' ) 		=> '10',
						esc_html__( '15px', 'ajani' ) 		=> '15',
						esc_html__( '20px', 'ajani' ) 		=> '20',
						esc_html__( '25px', 'ajani' ) 		=> '25',
						esc_html__( '30px', 'ajani' ) 		=> '30',
						esc_html__( '35px', 'ajani' ) 		=> '35',
						esc_html__( '40px', 'ajani' ) 		=> '40',
						esc_html__( '45px', 'ajani' ) 		=> '45',
						esc_html__( '50px', 'ajani' ) 		=> '50',
						esc_html__( '55px', 'ajani' ) 		=> '55',
						esc_html__( '60px', 'ajani' ) 		=> '60',
						esc_html__( '65px', 'ajani' ) 		=> '65',
						esc_html__( '70px', 'ajani' ) 		=> '70',
						esc_html__( '75px', 'ajani' ) 		=> '75',
						esc_html__( '80px', 'ajani' ) 		=> '80',
						esc_html__( '85px', 'ajani' ) 		=> '85',
						esc_html__( '90px', 'ajani' ) 		=> '90',
						esc_html__( '95px', 'ajani' ) 		=> '95',
						esc_html__( '100px', 'ajani' ) 		=> '100',
						esc_html__( '110px', 'ajani' ) 		=> '110',
						esc_html__( '120px', 'ajani' ) 		=> '120',
						esc_html__( '130px', 'ajani' ) 		=> '130',
						esc_html__( '140px', 'ajani' ) 		=> '140',
						esc_html__( '150px', 'ajani' ) 		=> '150',
						esc_html__( '160px', 'ajani' ) 		=> '160',
						esc_html__( '170px', 'ajani' ) 		=> '170',
						esc_html__( '180px', 'ajani' ) 		=> '180',
						esc_html__( '190px', 'ajani' ) 		=> '190',
						esc_html__( '200px', 'ajani' ) 		=> '200',
						esc_html__( '210px', 'ajani' ) 		=> '210',
						esc_html__( '220px', 'ajani' ) 		=> '220',
						esc_html__( '230px', 'ajani' ) 		=> '230',
						esc_html__( '240px', 'ajani' ) 		=> '240',
						esc_html__( '250px', 'ajani' ) 		=> '250'
					)
				),
				array( 'param_name' => 'full_screen', 'type' => 'dropdown', 'heading' => esc_html__( 'Full screen', 'ajani' ), 
					'value' => array(
						esc_html__( 'No', 'ajani' ) => '',
						esc_html__( 'Yes', 'ajani' ) => 'yes'
					)
				),
				array( 'param_name' => 'vertical_align', 'type' => 'dropdown', 'heading' => esc_html__( 'Vertical align (for fullscreen section)', 'ajani' ), 'preview' => true,
					'value' => array(
						esc_html__( 'Top', 'ajani' )     => 'top',
						esc_html__( 'Middle', 'ajani' )  => 'middle',
						esc_html__( 'Bottom', 'ajani' )  => 'bottom'					
					)
				),
				array( 'param_name' => 'color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Color scheme', 'ajani' ), 'value' => $color_scheme_arr, 'preview' => true, 'group' => esc_html__( 'Design', 'ajani' )  ),
				array( 'param_name' => 'background_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Background color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'background_image', 'type' => 'attach_image',  'preview' => true, 'heading' => esc_html__( 'Background image', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
				array( 'param_name' => 'lazy_load', 'type' => 'dropdown', 'default' => 'yes', 'heading' => esc_html__( 'Lazy load background image', 'ajani' ),
					'value' => array(
						esc_html__( 'No', 'ajani' ) => 'no',
						esc_html__( 'Yes', 'ajani' ) => 'yes'
					)
				),
				array( 'param_name' => 'background_overlay_custom_css', 'type' => 'textfield', 'heading' => esc_html__( 'Background overlay custom css', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
				array( 'param_name' => 'background_overlay_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Background overlay color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'background_position', 'type' => 'textfield', 'heading' => esc_html__( 'Background position in keywords (e.g. left, right, top, bottom, center) or in pixels / percentage - ineffective if parallax is used', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
				array( 'param_name' => 'background_size', 'type' => 'textfield', 'heading' => esc_html__( 'Background size (e.g. auto, cover, contain, initial, inherit or size in pixels - ineffective if parallax is used', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
				array( 'param_name' => 'top_section_coverage_image', 'type' => 'attach_image',  'preview' => true, 'heading' => esc_html__( 'Top Section Covering Image', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
				array( 'param_name' => 'bottom_section_coverage_image', 'type' => 'attach_image',  'preview' => true, 'heading' => esc_html__( 'Bottom Section Covering Image', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
			    array( 'param_name' => 'allow_content_outside', 'type' => 'dropdown', 'default' => 'no', 'heading' => esc_html__( 'Show content over top or bottom covering image', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
							esc_html__( 'No (content to be underneath top and bottom covering image)', 'ajani' ) => 'no',
							esc_html__( 'Yes (content will cover both covering images)', 'ajani' ) => 'yes'
					)
				),				
				array( 'param_name' => 'parallax', 'type' => 'textfield', 'heading' => esc_html__( 'Parallax (e.g. 0.7)', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
				array( 'param_name' => 'parallax_offset', 'type' => 'textfield', 'heading' => esc_html__( 'Parallax offset in px (e.g. -100)', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ) ),
				array( 'param_name' => 'background_video_yt', 'type' => 'textfield', 'heading' => esc_html__( 'YouTube background video', 'ajani' ), 'group' => esc_html__( 'Video', 'ajani' ) ),
				array( 'param_name' => 'yt_video_settings', 'type' => 'textfield', 'heading' => esc_html__( 'YouTube video settings (e.g. startAt:20, mute:true, stopMovieOnBlur:false)', 'ajani' ), 'group' => esc_html__( 'Video', 'ajani' ) ),
				array( 'param_name' => 'background_video_mp4', 'type' => 'textfield', 'heading' => esc_html__( 'MP4 background video', 'ajani' ), 'group' => esc_html__( 'Video', 'ajani' ) ),
				array( 'param_name' => 'background_video_ogg', 'type' => 'textfield', 'heading' => esc_html__( 'OGG background video', 'ajani' ), 'group' => esc_html__( 'Video', 'ajani' ) ),
				array( 'param_name' => 'background_video_webm', 'type' => 'textfield', 'heading' => esc_html__( 'WEBM background video', 'ajani' ), 'group' => esc_html__( 'Video', 'ajani' ) ),
				array( 'param_name' => 'show_video_on_mobile',  'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'yes' ), 'default' => '', 'heading' => esc_html__( 'Show Video on Mobile Devices', 'ajani' ), 'group' => esc_html__( 'Video', 'ajani' ) ),
			)
		) );		

	} 

}

class BT_BB_YT_Video_Proxy {
	function __construct( $prefix, $el_id ) {
		$this->prefix = $prefix;
		$this->el_id = $el_id;
	}
	public function js_init() {
		// wp_register_script( 'boldthemes-script-bt-bb-section-js-init', '' );
		// wp_enqueue_script( 'boldthemes-script-bt-bb-section-js-init' );
		// wp_add_inline_script( 'boldthemes-script-bt-bb-section-js-init', 'jQuery(function() { jQuery( "#' . esc_html( $this->el_id ) . ' .' . esc_html( $this->prefix ) . 'background_video_yt_inner" ).YTPlayer();});' );
		wp_add_inline_script( 'bt_bb_yt', 'jQuery(function() { jQuery( "#' . esc_html( $this->el_id ) . ' .' . esc_html( $this->prefix ) . 'background_video_yt_inner" ).YTPlayer();});' );
    }

}
