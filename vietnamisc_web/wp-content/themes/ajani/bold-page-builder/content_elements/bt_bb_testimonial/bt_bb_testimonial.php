<?php

class bt_bb_testimonial extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'layout'				=> '',
			'image'					=> '',
			'image_size'			=> 'full',
			'image_shape'			=> '',
			'star_number'			=> '',	
			'star_color'			=> '',
			'title'					=> '',	
			'title_size'			=> '',	
			'author_text'			=> '',	
			'author_size'			=> '',
			'subauthor_text'		=> ''
		) ), $atts, $this->shortcode ) );
		
		$html_tag = "h3";

		$title			= html_entity_decode( $title, ENT_QUOTES, 'UTF-8' );
		$author_text	= html_entity_decode( $author_text, ENT_QUOTES, 'UTF-8' );
		$subauthor_text = html_entity_decode( $subauthor_text, ENT_QUOTES, 'UTF-8' );
		
		$title = nl2br( $title );
		$author_text = nl2br( $author_text );	
		$subauthor_text = nl2br( $subauthor_text );	

		$class = array( $this->shortcode );
		$data_override_class = array();
		
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
		
		if ( $layout != '' ) {
			$class[] = $this->prefix . 'layout' . '_' . $layout;
		}
		
		if ( $image_shape != '' ) {
			$class[] = $this->prefix . 'image_shape' . '_' . $image_shape;
		}

		if ( $star_color != '' ) {
			$class[] = $this->prefix . 'star_color' . '_' . $star_color;
		}
		
		$this->responsive_data_override_class(
			$class, $data_override_class,
			array(
				'prefix' => $this->prefix,
				'param' => 'title_size',
				'value' => $title_size
			)
		);
		
		$this->responsive_data_override_class(
			$class, $data_override_class,
			array(
				'prefix' => $this->prefix,
				'param' => 'author_size',
				'value' => $author_size
			)
		);

		if ( $image == '' ) {
			$class[] = 'NoImage';
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		$class_attr = implode( ' ', $class );
		
		if ( $el_class != '' ) {
			$class_attr = $class_attr . ' ' . $el_class;
		}	
		
		// IMAGE
		if ( $image_size != 'full' && $image_size != '' ) {
			$image_size = esc_attr( $image_size ); 
		} else {
			$image_size = 'full';
		}
		
		$content = do_shortcode( $content );
		
		$image_output = '';
		if ( $image != '' ) {
			$image_output =  '<div class="' . esc_attr( $this->shortcode . '_image') . '">' . do_shortcode( '[bt_bb_image image="' . esc_attr( $image ) . '" size="' . esc_attr( $image_size ) . '" shape="' . esc_attr( $image_shape ) . '" caption="' . esc_attr( $title ) . '" ignore_fe_editor="true"]' ) . '</div>';
		}	

		$output = '<div' . $id_attr . ' class="' . esc_attr( $class_attr ) . '"' . $style_attr . '>';

				// image
				if ( $layout == 'image_above_all' || $layout == 'image_next_to_content' || $layout == 'image_next_to_content_larger' ) {
					$output .=  $image_output;
				}
			
				if ( ( $title != '' ) || ( $author_text != '' ) || ( $subauthor_text != '' ) || ( $star_number != '' ) ) {
					// content
					$output .=  '<div class="' . esc_attr( $this->shortcode . '_content') . '">';

							if ( $title != '' ) 
								$output .= do_shortcode('[bt_bb_headline headline="' . esc_attr( $title ) . '" html_tag="'. esc_attr( $html_tag ) . '" size="'. esc_attr( $title_size ) . '" ignore_fe_editor="true"]');

							if ( $star_number != '' ) {
								$output .= '<div class="btReviewStars">
										<div class="star-rating">
											<span style="width:' . wp_kses_post( $star_number * 20 ) . '%;">
												<strong class="rating">' . wp_kses_post( $star_number  ) . '</strong>
											</span>
										</div>
									</div>';
							 }
							 // image
							 if ( $layout == 'image_below_title') {
								$output .=  $image_output;
							 }

							$output .= ( $content );

							$output .= '<div class="' . esc_attr( $this->shortcode . '_author_content' ) . '">';
									// image
									if ( $layout == 'image_next_to_author') {
										$output .=  $image_output;
									}
									
										$output .= '<div class="' . esc_attr( $this->shortcode . '_author_wrap' ) . '">';
									if ( $author_text != '' ) {
										$output .= '<div class="' . esc_attr( $this->shortcode . '_author_text' ) . '">' . $author_text . '</div>';
									}

									if ( $subauthor_text != '' ) {
										$output .= '<div class="' . esc_attr( $this->shortcode . '_subauthor_text' ) . '">' . $subauthor_text . '</div>';
									}
										$output .= '</div>';
										
							$output .= '</div>';

					$output .= '</div>';
				}

		$output .= '</div>';

		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );
			
		return $output;

	}


	function map_shortcode() {

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Testimonial', 'ajani' ), 'description' => esc_html__( 'Testimonial with text and title', 'ajani' ), 'container' => 'vertical', 'accept' => array( 'bt_bb_quote' => true ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'layout', 'type' => 'dropdown', 'heading' => esc_html__( 'Layout', 'ajani' ), 
					'value' => array(
						esc_html__( 'Image above all', 'ajani' ) 			=> 'image_above_all',
						esc_html__( 'Image next to content', 'ajani' ) 	=> 'image_next_to_content',
						esc_html__( 'Image next to content, larger', 'ajani' ) 	=> 'image_next_to_content_larger',
						esc_html__( 'image next to author', 'ajani' ) 	=> 'image_next_to_author',
						esc_html__( 'Image below title', 'ajani' ) 		=> 'image_below_title',
					)
				),
				array( 'param_name' => 'image', 'type' => 'attach_image', 'preview' => true, 'heading' => esc_html__( 'Image', 'ajani' ),  'group' => esc_html__( 'Image', 'ajani' ) 
				),
				array( 'param_name' => 'image_size', 'type' => 'dropdown', 'heading' => esc_html__( 'Image size', 'ajani' ),  'group' => esc_html__( 'Image', 'ajani' ), 'preview' => true,
					'value' => bt_bb_get_image_sizes()
				),
				array( 'param_name' => 'image_shape', 'type' => 'dropdown', 'heading' => esc_html__( 'Image shape', 'ajani' ),  'group' => esc_html__( 'Image', 'ajani' ), 
					'value' => array(
						esc_html__( 'Square', 'ajani' )		 => 'square',
						esc_html__( 'Soft Rounded', 'ajani' ) => 'soft_rounded',
						esc_html__( 'Hard Rounded', 'ajani' ) => 'hard_rounded',
						esc_html__( 'Circle', 'ajani' )		=> 'circle'
					)
				),
				array( 'param_name' => 'star_number', 'type' => 'dropdown', 'heading' => esc_html__( 'Star number', 'ajani' ),  'group' => esc_html__( 'Star', 'ajani' ), 
					'value' => array(
						esc_html__( 'no stars', 'ajani' ) => '',
						esc_html__( '1', 'ajani' ) => '1',
						esc_html__( '2', 'ajani' ) => '2',
						esc_html__( '3', 'ajani' ) => '3',
						esc_html__( '4', 'ajani' ) => '4',
						esc_html__( '5', 'ajani' ) => '5',
					)
				),
				array( 'param_name' => 'star_color', 'type' => 'dropdown', 'heading' => esc_html__( 'Star color', 'ajani' ),  'group' => esc_html__( 'Star', 'ajani' ),
					'value' => array(
						esc_html__( 'Inherit', 'ajani' )		=> 'inherit',
						esc_html__( 'Light', 'ajani' )		=> 'light',
						esc_html__( 'Dark', 'ajani' )			=> 'dark',
						esc_html__( 'Accent', 'ajani' )		=> 'accent',
						esc_html__( 'Alternate', 'ajani' )	=> 'alternate'
					)
				),
				array( 'param_name' => 'title', 'type' => 'textfield', 'heading' => esc_html__( 'Title', 'ajani' ), ),
				array( 'param_name' => 'title_size', 'type' => 'dropdown', 'heading' => esc_html__( 'Title size', 'ajani' ), 'responsive_override' => true,
					'value' => array(
						esc_html__( 'Inherit', 'ajani' )		=> 'inherit',
						esc_html__( 'Extra Small', 'ajani' )	=> 'extrasmall',
						esc_html__( 'Small', 'ajani' ) 		=> 'small',
						esc_html__( 'Normal', 'ajani' ) 		=> 'normal',
						esc_html__( 'Medium', 'ajani' ) 		=> 'medium',
						esc_html__( 'Large', 'ajani' ) 		=> 'large',
						esc_html__( 'Large', 'ajani' ) 		=> 'extralarge'
					)
				),
				array( 'param_name' => 'author_text', 'type' => 'textfield', 'heading' => esc_html__( 'Author text', 'ajani' ), ),
				array( 'param_name' => 'author_size', 'type' => 'dropdown', 'heading' => esc_html__( 'Author text size', 'ajani' ), 'responsive_override' => true,
					'value' => array(
						esc_html__( 'Normal', 'ajani' ) 		=> 'normal',
						esc_html__( 'Medium', 'ajani' ) 		=> 'medium',
						esc_html__( 'Large', 'ajani' ) 		=> 'large',
					)
				),
				array( 'param_name' => 'subauthor_text', 'type' => 'textfield', 'heading' => esc_html__( 'Subauthor text', 'ajani' ), ),
			))
		);
	}
}