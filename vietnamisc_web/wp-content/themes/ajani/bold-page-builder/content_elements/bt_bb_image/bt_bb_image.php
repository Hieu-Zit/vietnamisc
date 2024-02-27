<?php

class bt_bb_image extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'image'  							=> '',
			'size'   							=> '',
			'shape'  							=> '',
			'lazy_load'  						=> 'no',
			'image_height'  					=> '',
			'align'  							=> '',
			'caption'    						=> '',
			'url'    							=> '',
			'target' 							=> '',
			'hover_style'  						=> '',
			'content_display'  					=> '',
			'content_background_color' 			=> '',
			'content_background_opacity'	    => '',
			'content_align'						=> '',
			'remove_padding'					=> '',
			'fill_background_color'				=> ''			
		) ), $atts, $this->shortcode ) );
		
		require_once( WP_PLUGIN_DIR   . '/bold-page-builder/content_elements_misc/misc.php' );
		
		$class = array( $this->shortcode );
		
		if ( $el_class != '' ) {
			$class[] = $el_class;
		}
		
		if ( $hover_style == 'scroll' ) {
			$el_id = 'bt_bb_random_id_' . rand();
		}

		$style_attr = '';
		
		if ( $image_height != '' ) {
			$el_style .= 'height:' . $image_height . '; overflow: hidden;';
		}
		
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}	
		
		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}

		
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
		
		if ( $hover_style != '' ) {
			$class[] = $this->prefix . 'hover_style' . '_' . $hover_style;
		}
		
		if ( $content_display != '' ) {
			$class[] = $this->prefix . 'content_display' . '_' . $content_display;
		}

		if ( $content_align != '' ) {
			$class[] = $this->prefix . 'content_align' . '_' . $content_align;
		}
		
		if ( $remove_padding != '' ) {
			$class[] = $this->prefix . 'remove_padding' . '_' . $remove_padding;
		}
		
		if ( $fill_background_color != '' ) {
			$class[] = $this->prefix . 'fill_background_color' . '_' . $fill_background_color;
		}

		$alt = $caption;
		$title = $caption;
		$full_image = $image;
		$image_ = $image;
			
		if ( $image != '' && is_numeric( $image ) ) {
			$post_image = get_post( $image );
			if ( $post_image == '' ) return;
			
			if ( $alt == '' ) {
				$alt = get_post_meta($post_image->ID, '_wp_attachment_image_alt', true);
			}
			if ( $alt == '' ) {
				$alt = $post_image->post_excerpt;
			}
			if ( $title == '' ) {
				$title = $post_image->post_title;
			}
			
			$image_ = wp_get_attachment_image_src( $image, $size );
			if ( $image_ ) {
				$image_ = $image_[0];
			}
			if ( $alt == '' ) {
				$alt = $image_;
			}
			
			if ( $size == 'full' ) {
				$full_image = $image_;
			} else {
				$full_image = wp_get_attachment_image_src( $image, 'full' );
				if ( $full_image ) {
					$full_image = $full_image[0];
				} else {
					$full_image = '';
				}				
			}
		}
		
		if ( $title != '' ) {
			$title = ' title="' . esc_attr( $title ) . '"';	
		}
		$content = do_shortcode( $content );
		
		if ( $content != '' ) {
			$class[] = $this->prefix . 'content_exists';
		}
		
		$output = '';
		
		if ( ! empty( $image_ ) ) {
			if ( $lazy_load == 'yes' ) {
				$output .= '<img src = "' . BT_BB_Root::$path . 'img/blank.gif" data-full_image_src="' . esc_url_raw( $full_image ) . '" data-image_src="' . esc_url_raw( $image_ ) . '"' . $title . ' alt="' . esc_attr( $alt ) . '" class="btLazyLoadImage">';
			} else {
				$output .= '<img src="' . esc_url_raw( $image_ ) . '" data-full_image_src="' . esc_url_raw( $full_image ) . '" ' . $title . ' alt="' . esc_attr( $alt ) . '">';
			}
		}
		if ( $url != '#lightbox' ) {
			$link = bt_bb_get_url( $url );	
		} else {
			$link = $url ;
			$class[] = 'bt_bb_use_lightbox';
		}
		
		if ( ! empty( $link ) ) {
			$output = '<a href="' . esc_url( $link ) . '"  target="' . esc_attr( $target ) . '"' . $title . '>' . $output . '</a>';
		} else {
			$output = '<span>' . $output . '</span>';
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		
		$output = '<div' . $id_attr . ' class="' . esc_attr( implode( ' ', $class ) ) . '"' . $style_attr . ' data-bt-override-class="' . htmlspecialchars( json_encode( $data_override_class, JSON_FORCE_OBJECT ), ENT_QUOTES, 'UTF-8' ) . '">' . $output ;
		if ( $content != '' ) {
			$content_background_style = '';
			if ( $content_background_color != '' ) {
				if ( strpos( $content_background_color, '#' ) !== false ) {
					$content_background_color	= bt_bb_image::hex2rgb( $content_background_color );
					if ( $content_background_opacity == '' ) {
						$content_background_opacity = 1;
					}
					$content_background_style .= ' style="--bgcolor: rgba(' . $content_background_color[0] . ', ' . $content_background_color[1] . ', ' . $content_background_color[2] . ', ' . $content_background_opacity . ');background-color: rgba(' . $content_background_color[0] . ', ' . $content_background_color[1] . ', ' . $content_background_color[2] . ', ' . $content_background_opacity . ');"';
				}else{
					$content_background_style .= ' style="--bgcolor: ' . $content_background_color . ';background-color: ' . $content_background_color . ';"';
				}
			}
			$output .= '<div class="bt_bb_image_content"' . $content_background_style . '><div class="bt_bb_image_content_flex"><div class="bt_bb_image_content_inner">' . $content . '</div></div></div>';
		}
		$output .= '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );
		
		return $output;

	}

	function map_shortcode() {
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Image', 'ajani' ), 'description' => esc_html__( 'Single image', 'ajani' ), 'container' => 'vertical', 'accept' => array( 'bt_bb_button' => true, 'bt_bb_icon' => true, 'bt_bb_text' => true, 'bt_bb_headline' => true, 'bt_bb_separator' => true, 'bt_bb_testimonial' => true, 'bt_bb_quote' => true), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'image', 'type' => 'attach_image', 'heading' => esc_html__( 'Image', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'size', 'type' => 'dropdown', 'heading' => esc_html__( 'Size', 'ajani' ), 'preview' => true,
					'value' => bt_bb_get_image_sizes()
				),
				array( 'param_name' => 'image_height', 'type' => 'textfield', 'heading' => esc_html__( 'Image height', 'ajani' )),
				array( 'param_name' => 'shape', 'type' => 'dropdown', 'heading' => esc_html__( 'Shape', 'ajani' ),
					'value' => array(
						esc_html__('Square', 'ajani' ) => 'square',
						esc_html__('Soft Rounded', 'ajani' ) => 'soft_rounded',
						esc_html__('Hard Rounded', 'ajani' ) => 'hard_rounded',
						esc_html__('Circle', 'ajani' ) => 'circle'
					)
				),
				array( 'param_name' => 'lazy_load', 'type' => 'dropdown', 'default' => 'yes', 'heading' => esc_html__( 'Lazy load this image', 'ajani' ),
					'value' => array(
						esc_html__( 'No', 'ajani' ) => 'no',
						esc_html__( 'Yes', 'ajani' ) => 'yes'
					)
				),
				array( 'param_name' => 'align', 'type' => 'dropdown', 'heading' => esc_html__( 'Alignment', 'ajani' ),'responsive_override' => true,
					'value' => array(
						esc_html__( 'Inherit', 'ajani' ) => 'inherit',
						esc_html__( 'Left', 'ajani' ) => 'left',
						esc_html__( 'Right', 'ajani' ) => 'right'
					)
				),
				array( 'param_name' => 'caption', 'type' => 'textfield', 'heading' => esc_html__( 'Caption', 'ajani' ) ),
				array( 'param_name' => 'url', 'type' => 'textfield', 'heading' => esc_html__( 'URL', 'ajani' ), 'description' => esc_html__( 'Enter full or local URL (eg. https://www.bold-themes.com or /pages/about-us), post slug (eg. about-us) or #lightbox to open current image in full size', 'ajani' ), 'group' => esc_html__( 'URL', 'ajani' ) ),
				array( 'param_name' => 'target', 'type' => 'dropdown', 'heading' => esc_html__( 'Target', 'ajani' ), 'group' => esc_html__( 'URL', 'ajani' ),
					'value' => array(
						esc_html__( 'Self (open in same tab)', 'ajani' ) => '_self',
						esc_html__( 'Blank (open in new tab)', 'ajani' ) => '_blank'
					)
				),
				array( 'param_name' => 'hover_style', 'type' => 'dropdown', 'heading' => esc_html__( 'Mouse hover style', 'ajani' ), 'group' => esc_html__( 'URL', 'ajani' ),
					'value' => array(
						esc_html__( 'Simple', 'ajani' ) => 'simple',
						esc_html__( 'Flip', 'ajani' ) => 'flip',
						esc_html__( 'Zoom in', 'ajani' ) => 'zoom-in',
						esc_html__( 'To grayscale', 'ajani' ) => 'to-grayscale',
						esc_html__( 'From grayscale', 'ajani' ) => 'from-grayscale',
						esc_html__( 'Zoom in to grayscale', 'ajani' ) => 'zoom-in-to-grayscale',
						esc_html__( 'Zoom in from grayscale', 'ajani' ) => 'zoom-in-from-grayscale',
						esc_html__( 'Scroll', 'ajani' ) => 'scroll'
					)
				),
				array( 'param_name' => 'content_display', 'type' => 'dropdown', 'heading' => esc_html__( 'Show content', 'ajani' ), 'description' => esc_html__( 'Add selected elements and show them over the image', 'ajani' ), 'group' => esc_html__( 'Content', 'ajani' ),
					'value' => array(
						esc_html__( 'Always', 'ajani' ) => 'always',
						esc_html__( 'Show on hover', 'ajani' ) => 'show-on-hover',
						esc_html__( 'Hide on hover', 'ajani' ) => 'hide-on-hover'
					)
				),
				array( 'param_name' => 'content_background_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Content background color', 'ajani' ), 'group' => esc_html__( 'Content', 'ajani' ) ),
				array( 'param_name' => 'content_background_opacity', 'type' => 'textfield', 'heading' => esc_html__( 'Content background opacity (deprecated)', 'ajani' ), 'group' => esc_html__( 'Content', 'ajani' ) ),
				array( 'param_name' => 'content_align', 'type' => 'dropdown', 'heading' => esc_html__( 'Content Alignment', 'ajani' ), 'group' => esc_html__( 'Content', 'ajani' ),
					'value' => array(
						esc_html__( 'Middle', 'ajani' ) => 'middle',
						esc_html__( 'Top', 'ajani' ) => 'top',						
						esc_html__( 'Bottom', 'ajani' ) => 'bottom'
					)
				),
				array( 'param_name' => 'remove_padding', 'type' => 'dropdown', 'heading' => esc_html__( 'Padding', 'ajani' ), 'group' => esc_html__( 'Content', 'ajani' ),
					'value' => array(
						esc_html__( 'Default', 'ajani' ) => 'no',
						esc_html__( '0', 'ajani' ) => 'yes',
						esc_html__( '10px', 'ajani' ) => '10',
						esc_html__( '20px', 'ajani' ) => '20',
						esc_html__( '30px', 'ajani' ) => '30',
						esc_html__( '40px', 'ajani' ) => '40',
						esc_html__( '50px', 'ajani' ) => '50',
						esc_html__( '60px', 'ajani' ) => '60',
						esc_html__( '70px', 'ajani' ) => '70',
						esc_html__( '80px', 'ajani' ) => '80',
						esc_html__( '90px', 'ajani' ) => '90',
						esc_html__( '100px', 'ajani' ) => '100'
					)
				),
				array( 'param_name' => 'fill_background_color', 'type' => 'dropdown', 'heading' => esc_html__( 'Fill background color', 'ajani' ),'group' => esc_html__( 'Content', 'ajani' ) ,
					'value' => array(
						esc_html__( 'Full', 'ajani' ) => 'full',
						esc_html__( 'Match content height', 'ajani' ) => 'match_content_height'
					)
				),
			)
		) );
	}
	static function hex2rgb( $hex ) {
		$hex = str_replace( '#', '', $hex );
		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgb = array( $r, $g, $b );
		return $rgb;
	}
}