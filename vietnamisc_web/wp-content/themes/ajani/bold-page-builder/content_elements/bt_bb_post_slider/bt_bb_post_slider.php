<?php

class bt_bb_post_slider extends BT_BB_Element {
	
	public $auto_play = '';
	
	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'number'				=> '',
			'category'				=> '',
			'height'    			=> '',
			'show_dots' 			=> '',
			'animation' 			=> '',
			'gap' 					=> '',
			'pause_on_hover'     	=> '',
			'slides_to_show' 		=> '',
			'auto_play' 			=> '',
			'overflow'				=> '',
			'target'				=> '',
			'show_category'			=> '',
			'show_date'				=> '',
			'show_author'			=> '',
			'show_comments'			=> '',
			'show_excerpt'			=> '',
			'show_read_more'		=> '',
			'show_image'			=> '',
			'size'					=> '',
			'active_dot_color'		=> '',
			'inactive_dot_color'	=> '',
			'background_color'				=> '',
			'shape'							=> '',
			'style'							=> '',
			'image_position'				=> '',
			'read_more_text'				=> '',
			'read_more_icon'				=> '',
			'read_more_icon_color_scheme'   => '',
			'paging_design'					=> '',
			'arrows_position'				=> '',
			'arrows_style'					=> '',
			'image_size'					=> ''
		) ), $atts, $this->shortcode ) );

		wp_enqueue_script( 
			'bt_bb_post_slider',
			get_template_directory_uri() . '/bold-page-builder/content_elements/bt_bb_post_slider/bt_bb_post_slider.js',
			array( 'jquery' )
		);
		
		$class = array( $this->shortcode );		
		$slider_class = array( 'slick-slider' );
		
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
		
		if ( $gap != '' ) {
			$class[] = $this->prefix . 'gap' . '_' . $gap;
		}
		
		if ( $show_dots != '' ) {
			$class[] = $this->prefix . 'show_dots_' . $show_dots;
		}
		
		if ( $height != '' ) {
			$class[] = $this->prefix . 'height' . '_' . $height;
		}
		
		if ( $animation != '' ) {
			$class[] = $this->prefix . 'animation' . '_' . $animation;
		}
		if ( $show_read_more != '' ) {
			$class[] = $this->prefix . 'show_read_more' . '_' . $show_read_more;
		}
		if ( $overflow != '' ) {
			$class[] = $this->prefix . 'overflow' . '_' . $overflow;
		}
		
		if ( $active_dot_color != '' ) {
			$class[] = $this->prefix . 'active_dot_color' . '_' . $active_dot_color;
		}
		if ( $inactive_dot_color != '' ) {
			$class[] = $this->prefix . 'inactive_dot_color' . '_' . $inactive_dot_color;
		}
		if ( $background_color != '' ) {
			$class[] = $this->prefix . 'background_color' . '_' . $background_color;
		}
		if ( $shape != '' ) {
			$class[] = $this->prefix . 'shape' . '_' . $shape;
		}
		if ( $style != '' ) {
			$class[] = $this->prefix . 'style' . '_' . $style;
		}
		if ( $image_position != '' ) {
			$class[] = $this->prefix . 'image_position' . '_' . $image_position;
		}
		if ( $paging_design != '' ) {
			$class[] = $this->prefix . 'paging_design' . '_' . $paging_design;
		}
		if ( $arrows_position != '' ) {
			$class[] = $this->prefix . 'arrows_position' . '_' . $arrows_position;
		}
		if ( $arrows_style != '' ) {
			$class[] = $this->prefix . 'arrows_style' . '_' . $arrows_style;
		}

		$data_slick  = ' data-slick=\'{ "lazyLoad": "progressive", "cssEase": "ease-out", "speed": "600"';
		
		if ( $animation == 'fade' ) {
			$data_slick .= ', "fade": true';
			$slider_class[] = 'fade';
			$slides_to_show = 1;
		}
		
		$data_slick  .= ', "prevArrow": "&lt;button type=\"button\" class=\"slick-prev\" aria-label=\"' . esc_html__( 'Previous', 'ajani' ) . '\" tabindex=\"0\" role=\"button\"&gt;&lt;/button&gt;", "nextArrow": "&lt;button type=\"button\" class=\"slick-next\" aria-label=\"' . esc_html__( 'Next', 'ajani' ) . '\" tabindex=\"0\" role=\"button\"&gt;&lt;/button&gt;"';
	
		if ( $height != 'keep-height' ) {
			$data_slick .= ', "adaptiveHeight": true';
		}
		
		if ( $show_dots != 'hide' ) {
			$data_slick .= ', "dots": true' ;
		}
		
		if ( $slides_to_show > 1 ) {
			$data_slick .= ',"slidesToShow": ' . intval( $slides_to_show );
			$class[] = $this->prefix . 'multiple_slides';
		}
		
		if ( $auto_play != '' ) {
			$data_slick .= ',"autoplay": true, "autoplaySpeed": ' . intval( $auto_play );
		}
		
		if ( $pause_on_hover == 'no' ) {
			$data_slick .= ',"pauseOnHover": false';
		}

		if ( is_rtl() ) {
			$data_slick .= ', "rtl": true' ;
		}
		
		if ( $slides_to_show > 1 ) {
			$data_slick .= ', "responsive": [';
			if ( $slides_to_show > 1 ) {
				$data_slick .= '{ "breakpoint": 480, "settings": { "slidesToShow": 1, "slidesToScroll": 1 } }';	
			}
			if ( $slides_to_show > 2 ) {
				$data_slick .= ',{ "breakpoint": 768, "settings": { "slidesToShow": 2, "slidesToScroll": 2 } }';	
			}
			if ( $slides_to_show > 3 ) {
				$data_slick .= ',{ "breakpoint": 920, "settings": { "slidesToShow": 3, "slidesToScroll": 3 } }';	
			}
			if ( $slides_to_show > 4 ) {
				$data_slick .= ',{ "breakpoint": 1024, "settings": { "slidesToShow": 3, "slidesToScroll": 3 } }';	
			}				
			$data_slick .= ']';
		}
		$data_slick = $data_slick . '}\' ';
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		
		$show = array( 'category' => false, 'excerpt' => false,  'read_more' => false,'author' => false, 'date' => false,
			'comments' => false, 'target' => '_self','image' => false, 'size' => 'large', 
			'read_more_text' => '', 'read_more_icon' => '', 'read_more_icon_color_scheme' => '', 
			'background_color'  => '', 'image_position' => '' );
		
		if ( $show_category == 'show_category' ) {
			$show['category'] = true;
		}
		if ( $show_excerpt == 'show_excerpt' ) {
			$show['excerpt'] = true;
		}
		if ( $show_date == 'show_date' ) {
			$show['date'] = true;
		}
		if ( $show_comments == 'show_comments' ) {
			$show['comments'] = true;
		}
		if ( $show_author == 'show_author' ) {
			$show['author'] = true;
		}
		if ( $show_read_more == 'show_read_more' ) {
			$show['read_more'] = true;
		}
		if ( $show_image == 'show_image' ) {
			$show['image'] = true;
		}
		if ( $size != '' ) {
			$show['size'] = $size;
		}
		if ( $target != '' ) {
			$show['target'] = $target;
		}
		
		if ( $read_more_text != '' ) {
			$show['read_more_text'] = $read_more_text;
		}
		if ( $read_more_icon != '' ) {
			$show['read_more_icon'] = $read_more_icon;
		}
		if ( $read_more_icon_color_scheme != '' ) {
			$show['read_more_icon_color_scheme'] = $read_more_icon_color_scheme;
		}
		if ( $background_color != '' ) {
			$show['background_color'] = $background_color;
		}
		if ( $image_position != '' ) {
			$show['image_position'] = $image_position;
		}
		
		if ( $number > 1000 || $number == '' ) {
			$number = 1000;
		} else if ( $number < 1 ) {
			$number = 1;
		}
		
		$posts = bt_bb_get_posts( $number, 0, $category, 'post' );

		$output = $this->slider_content($posts, $show);
		
		$output = '<div' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . ' data-slides="' . esc_attr( $slides_to_show ) . '"><div class="' . implode( ' ', $slider_class ) . '" ' . $data_slick .  '>' . $output . '</div></div>';	
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );
		
		return $output;		
	}
	
	static function slider_content($posts, $show){
		$output = '';
		$class	= array();	
		
		$prefix         = 'bt_bb_';
		$shortcode      = 'bt_bb_post_slider';
		
		foreach( $posts as $post_item ) {
				$post_thumbnail_id = get_post_thumbnail_id( $post_item['ID'] ); 
				$img = wp_get_attachment_image_src( $post_thumbnail_id, $show['size'] );
				$img_src = isset($img[0]) ? $img[0] : BoldThemes_Customize_Default::$data['blog_image_default'];		

				if ( $img_src ) {
					$style_attr = ' ';					
					$hw = 0;
					if ( $img_src != '' && is_array($img) && $img[1] > 0 ) {
						$hw = $img[2] / $img[1];
					}
				}else{
					$class[] = ' bt_bb_post_slider_item_inner_no_image';
					$style_attr = ' ';

					$post_thumbnail_id = attachment_url_to_postid( boldthemes_get_option( 'blog_image_default' ) );
					if ( is_numeric( $post_thumbnail_id ) ) {
						$img = wp_get_attachment_image_src( $post_thumbnail_id, $show['size'] );
						$img_src = isset($img[0]) ? $img[0] : BoldThemes_Customize_Default::$data['blog_image_default'];
					}
				}

				$alt = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
				$alt = $alt != '' ? $alt : $post_item['title'];
				
				$background_color_style = $show['background_color'] != '' ? ' style="background-color: ' . $show['background_color'] . '"' : '';
			
				$output .= '<div class="bt_bb_grid_item" ' . $style_attr . '>'
						. '<div class="bt_bb_grid_item_inner"' . $background_color_style . '>';
					
					if ( $show['image'] ) {
						if ( $post_thumbnail_id != '' ) {
							if ( $show['image_position'] == 'image_above_content' ) {
								$output .= '<div class="bt_bb_grid_item_post_thumbnail">'
										. '<a href="' . esc_url_raw( $post_item['permalink'] ) . '" target="' . esc_attr( $show['target'] ) . '">'
											. '<img src="' . esc_url_raw( $img_src ) . '" alt="' . esc_attr( $alt ) . '" title="' . esc_attr( $post_item['title'] ) . '">'
										. '</a>'
									. '</div>';
							}else{
								$output .= '<div class="bt_bb_grid_item_post_thumbnail">'
										. '<a href="' . esc_url_raw( $post_item['permalink'] ) . '" target="' . esc_attr( $show['target'] ) . '" style="background-image: url(' . esc_url_raw( $img_src ) . ');">'
										. '</a>'
									. '</div>';
							}
						}
					}
					
					$output .= '<div class="bt_bb_grid_item_inner_content">';
				
								$output .= '<div class="bt_bb_grid_item_inner_content_wrapper">';
										
										$output .= '<h5 class="bt_bb_grid_item_title">'
											. '<a href="' . esc_url_raw( $post_item['permalink'] ) . '" title="' . esc_attr( $post_item['title'] ) . '">' . $post_item['title'] . '</a>'
										. '</h5>';	
										
										if ( $show['excerpt'] ) {
											$output .= '<div class="bt_bb_grid_item_excerpt">' . $post_item['excerpt'] . '</div>';
										}
								$output .= '</div>'									
								. '</div>';

								if ( $show['category'] ) {
									$output .= '<div class="bt_bb_grid_item_category">';
										$output .= $post_item['category_list'];
									$output .= '</div>';
								}

								if ( $show['date']  || $show['author']  || $show['comments']  ) {

									$meta_output = '<div class="bt_bb_grid_item_meta">';

										if ( $show['date'] ) {
											$meta_output .= '<span class="bt_bb_grid_item_date">';
												$meta_output .= get_the_date( '', $post_item['ID'] );
											$meta_output .= '</span>';
										}

										if ( $show['author'] ) {
											$meta_output .= '<span class="bt_bb_grid_item_author">';
												$meta_output .= esc_html__( 'by', 'ajani' ) . ' ' . $post_item['author'];
											$meta_output .= '</span>';
										}

										if ( $show['comments'] && $post_item['comments'] != '' ) {
											$meta_output .= '<span class="bt_bb_grid_item_comments">';
												$meta_output .= $post_item['comments'];
											$meta_output .= '</span>';
										}

									$meta_output .= '</div>';

									$output .= $meta_output;		
								}

								if ( ($show['read_more'] && $show['read_more_text'] != '') || ( $show['read_more_icon'] != '' && $show['read_more_icon'] != 'no_icon'  ) ) {
									$icon_html = '';
									$read_more_icon_class = '';
									$read_more_text_html = '';
									$read_more_icon_style	= '';

									if ( $show['read_more_icon'] != '' && $show['read_more_icon'] != 'no_icon'  ) {	
										$icon_html = bt_bb_icon::get_html( $show['read_more_icon'], '' );
										$icon_html = '<div class="bt_bb_grid_item_icon">' . $icon_html . '</div>';	
									}

									$read_more_icon_color_scheme = $show['read_more_icon_color_scheme']; 
									$read_more_icon_color_scheme_id = NULL;
									if ( is_numeric ( $read_more_icon_color_scheme ) ) {
										$read_more_icon_color_scheme_id = $read_more_icon_color_scheme;
									} else if ( $read_more_icon_color_scheme != '' ) {
										$read_more_icon_color_scheme_id = bt_bb_get_color_scheme_id( $read_more_icon_color_scheme );
									}
									$read_more_icon_color_scheme_colors = bt_bb_get_color_scheme_colors_by_id( $read_more_icon_color_scheme_id - 1 );
									if ( $read_more_icon_color_scheme_colors ) $read_more_icon_style .= ' --post-slider-read-more-icon-primary-color:' . $read_more_icon_color_scheme_colors[0] . '; --post-slider-read-more-icon-secondary-color:' . $read_more_icon_color_scheme_colors[1] . ';';
									if ( $read_more_icon_color_scheme != '' ) $read_more_icon_class =  ' bt_bb_read_more_icon_color_scheme_' .  $read_more_icon_color_scheme_id;

									$read_more_icon_style_attr = '';
									if ( $read_more_icon_style != '' ) {
										$read_more_icon_style_attr = ' ' . 'style="' . esc_attr( $read_more_icon_style ) . '"';
									}

									if ( $show['read_more_icon'] != '' && $show['read_more_icon'] != 'no_icon'  ) {	
										$icon_html = bt_bb_icon::get_html( $show['read_more_icon'], '' );
										$icon_html = '<div class="bt_bb_grid_item_icon">' . $icon_html . '</div>';	
									}
									
									if ( $show['read_more_text'] != '' ) {	
										$read_more_text_html = '<span>' . esc_html__( $show['read_more_text'], 'ajani' ) . ' </span>';										
									}
									
									$output .= '<div class="bt_bb_grid_item_read_more' . $read_more_icon_class . '"' . $read_more_icon_style_attr . '>';
											$output .= '<a href="' . esc_url_raw( $post_item['permalink'] ) . '">' . $read_more_text_html . $icon_html . '</a>';
									$output .= '</div>';
								}
						
						$output .= '</div>';
				$output .= '</div>';
			
		}
		
		return $output;
	}
	
	function map_shortcode() {
		
		require_once( WP_PLUGIN_DIR   .  '/bold-page-builder/content_elements_misc/misc.php' );
		$color_scheme_arr = bt_bb_get_color_scheme_param_array();
		
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Post Slider', 'ajani' ), 'description' => esc_html__( 'Slider with posts', 'ajani' ), 'container' => 'vertical', 'toggle' => true, 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'number', 'type' => 'textfield', 'heading' => esc_html__( 'Number of items', 'ajani' ), 'description' => esc_html__( 'Enter number of items or leave empty to show all (up to 1000)', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'category', 'type' => 'textfield', 'heading' => esc_html__( 'Category', 'ajani' ), 'description' => esc_html__( 'Enter category slugs separated by "," or leave empty to show all', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'height', 'type' => 'dropdown', 'preview' => true, 'heading' => esc_html__( 'Size', 'ajani' ),
					'value' => array(
						esc_html__( 'Auto', 'ajani' ) => 'auto',
						esc_html__( 'Keep height', 'ajani' ) => 'keep-height',
						esc_html__( 'Half screen', 'ajani' ) => 'half_screen',
						esc_html__( 'Full screen', 'ajani' ) => 'full_screen'
					)
				),
				array( 'param_name' => 'animation', 'type' => 'dropdown', 'heading' => esc_html__( 'Animation', 'ajani' ), 'description' => esc_html__( 'If fade is selected, number of slides to show will be 1', 'ajani' ),
					'value' => array(
						esc_html__( 'Default', 'ajani' ) => 'slide',
						esc_html__( 'Fade', 'ajani' ) => 'fade'
					)
				),
				array( 'param_name' => 'show_dots', 'type' => 'dropdown', 'heading' => esc_html__( 'Dots navigation', 'ajani' ),
					'value' => array(
						esc_html__( 'Below', 'ajani' ) => 'below',
						esc_html__( 'Outside', 'ajani' ) => 'outside',
						esc_html__( 'Hide', 'ajani' ) => 'hide'
					)
				),
				array( 'param_name' => 'pause_on_hover', 'default' => 'yes', 'type' => 'dropdown', 'heading' => esc_html__( 'Pause slideshow on hover', 'ajani' ),
					'value' => array(
						esc_html__( 'Yes', 'ajani' ) => 'yes',
						esc_html__( 'No', 'ajani' ) => 'no'
					)
				),
				array( 'param_name' => 'slides_to_show', 'type' => 'textfield', 'preview' => true, 'default' => 1, 'heading' => esc_html__( 'Number of slides to show', 'ajani' ), 'description' => esc_html__( 'e.g. 3', 'ajani' ) ),
				array( 'param_name' => 'gap', 'type' => 'dropdown', 'heading' => esc_html__( 'Gap', 'ajani' ),
					'value' => array(
						esc_html__( 'None', 'ajani' ) => '',
						esc_html__( 'Extra small', 'ajani' ) => 'extrasmall',
						esc_html__( 'Small', 'ajani' ) => 'small',
						esc_html__( 'Normal', 'ajani' ) => 'normal',
						esc_html__( 'Medium', 'ajani' ) => 'medium',
						esc_html__( 'Large', 'ajani' ) => 'large',
						esc_html__( 'Extra large', 'ajani' ) => 'extralarge'
					)
				),
				array( 'param_name' => 'auto_play', 'type' => 'textfield', 'heading' => esc_html__( 'Autoplay interval (ms)', 'ajani' ), 'description' => esc_html__( 'e.g. 2000', 'ajani' ) ),
				array( 'param_name' => 'overflow', 'type' => 'dropdown', 'heading' => esc_html__( 'Overflow elements', 'ajani' ), 
					'value' => array(
						esc_html__( 'Yes', 'ajani' ) => 'yes',
						esc_html__( 'No', 'ajani' ) => 'no'
					)
				),
				array( 'param_name' => 'show_category', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'show_category' ), 'heading' => esc_html__( 'Show category', 'ajani' ), 'group' => esc_html__( 'Show', 'ajani' ), 'preview' => true
				),
				array( 'param_name' => 'show_date', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'show_date' ), 'heading' => esc_html__( 'Show date', 'ajani' ), 'group' => esc_html__( 'Show', 'ajani' ), 'preview' => true
				),
				array( 'param_name' => 'show_author', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'show_author' ), 'heading' => esc_html__( 'Show author', 'ajani' ), 'group' => esc_html__( 'Show', 'ajani' ), 'preview' => true
				),
				array( 'param_name' => 'show_comments', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'show_comments' ), 'heading' => esc_html__( 'Show number of comments', 'ajani' ), 'group' => esc_html__( 'Show', 'ajani' ), 'preview' => true
				),
				array( 'param_name' => 'show_excerpt', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'show_excerpt' ), 'heading' => esc_html__( 'Show excerpt', 'ajani' ), 'group' => esc_html__( 'Show', 'ajani' ), 'preview' => true
				),
				array( 'param_name' => 'show_read_more', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'show_read_more' ), 'heading' => esc_html__( 'Show read more', 'ajani' ), 'group' => esc_html__( 'Show', 'ajani' ), 'preview' => true 
				),
				array( 'param_name' => 'show_image', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'show_image' ), 'heading' => esc_html__( 'Show image', 'ajani' ), 'group' => esc_html__( 'Show', 'ajani' ), 'preview' => true
				),
				array( 'param_name' => 'target', 'type' => 'dropdown', 'heading' => esc_html__( 'Target', 'ajani' ),'group' => esc_html__( 'Show', 'ajani' ),
					'value' => array(
						esc_html__('Self (open in same tab)', 'ajani' ) => '_self',
						esc_html__('Blank (open in new tab)', 'ajani' ) => '_blank',
					)
				),
				array( 'param_name' => 'size', 'type' => 'dropdown', 'heading' => esc_html__( 'Image size', 'ajani' ), 'group' => esc_html__( 'Image', 'ajani' ), 'preview' => true,
					'value' => bt_bb_get_image_sizes()
				),
				array( 'param_name' => 'active_dot_color', 'type' => 'dropdown', 'heading' => esc_html__( 'Active dot color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Accent', 'ajani' ) => 'accent',
						esc_html__( 'Alternate', 'ajani' ) => 'alternate',
						esc_html__( 'Dark', 'ajani' ) => 'dark',
						esc_html__( 'Light', 'ajani' ) => 'light'
					)
				),
				array( 'param_name' => 'inactive_dot_color', 'type' => 'dropdown', 'heading' => esc_html__( 'Inactive dot color / Paging color for Numbers page design', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Light', 'ajani' ) => 'light',
						esc_html__( 'Dark', 'ajani' ) => 'dark',
						esc_html__( 'Transparent light', 'ajani' ) => 'transparent_light',
						esc_html__( 'Transparent dark', 'ajani' ) => 'transparent_dark'
					)
				),
				array( 'param_name' => 'background_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Background color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'shape', 'type' => 'dropdown', 'heading' => esc_html__( 'Shape', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Square', 'ajani' ) => 'square',
						esc_html__( 'Soft Rounded', 'ajani' ) => 'soft_rounded',
						esc_html__( 'Hard Rounded', 'ajani' ) => 'hard_rounded'
					)
				),
				array( 'param_name' => 'style', 'type' => 'dropdown', 'heading' => esc_html__( 'Style', 'ajani' ), 'preview' => true, 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Flat', 'ajani' ) => 'flat',
						esc_html__( 'Shadowed', 'ajani' ) => 'shadowed',
						esc_html__( 'Bordered', 'ajani' ) => 'bordered'
					)
				),
				array( 'param_name' => 'image_position', 'default' => '', 'type' => 'dropdown', 'group' => esc_html__( 'Image', 'ajani' ), 'heading' => esc_html__( 'Image position', 'ajani' ), 
					'value' => array(
						esc_html__( 'Image above content', 'ajani' )		=> 'image_above_content',
						esc_html__( 'Image beneath content', 'ajani' )	=> 'image_beneath_content'
					)
				),
				array( 'param_name' => 'read_more_text', 'type' => 'textfield', 'heading' => esc_html__( 'Read more text', 'ajani' ), 'group' => esc_html__( 'Read more', 'ajani' ), 'value' => '' ), 
				array( 'param_name' => 'read_more_icon', 'type' => 'iconpicker', 'heading' => esc_html__( 'Read more icon', 'ajani' ), 'group' => esc_html__( 'Read more', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'read_more_icon_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Read more color scheme', 'ajani' ), 'value' => $color_scheme_arr, 'preview' => true, 'group' => esc_html__( 'Read more', 'ajani' ) ),
				array( 'param_name' => 'paging_design', 'type' => 'dropdown', 'heading' => esc_html__( 'Paging design', 'ajani' ), 'preview' => true, 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Dots', 'ajani' ) => 'dots',
						esc_html__( 'Numbers', 'ajani' ) => 'numbers'
					)
				),
				array( 'param_name' => 'arrows_position', 'default' => '', 'type' => 'dropdown', 'group' => esc_html__( 'Design', 'ajani' ), 'heading' => esc_html__( 'Arrows position', 'ajani' ), 
					'value' => array(
						esc_html__( 'Below', 'ajani' )	=> 'below',
						esc_html__( 'Outside', 'ajani' )	=> 'outside',
						esc_html__( 'Hide', 'ajani' )		=> 'hide'
					)
				),
				array( 'param_name' => 'arrows_style', 'type' => 'dropdown', 'heading' => esc_html__( 'Arrows color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Inherit', 'ajani' ) => 'inherit',
						esc_html__( 'Light', 'ajani' ) => 'light',
						esc_html__( 'Dark', 'ajani' ) => 'dark'				
					)
				),
			)
		) );
	}
}