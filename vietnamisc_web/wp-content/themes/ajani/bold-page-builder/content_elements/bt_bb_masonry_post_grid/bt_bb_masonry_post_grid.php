<?php

class bt_bb_masonry_post_grid extends BT_BB_Element {

	function __construct() {
		parent::__construct();
		add_action( 'wp_ajax_bt_bb_get_grid', array( __CLASS__, 'bt_bb_get_grid_callback' ) );
		add_action( 'wp_ajax_nopriv_bt_bb_get_grid', array( __CLASS__, 'bt_bb_get_grid_callback' ) );
	}

	static function bt_bb_get_grid_callback() {	
		check_ajax_referer( 'bt-bb-masonry-post-grid-nonce', 'bt-bb-masonry-post-grid-nonce' );
		
		bt_bb_masonry_post_grid::dump_grid( 
				intval( $_POST['number'] ), 
				intval( $_POST['offset'] ), 
				sanitize_text_field( $_POST['category'] ), 
				$_POST['show'], 
				$_POST['date_design'], 
				$_POST['post-type'],
				$_POST['background_color'],
				sanitize_text_field( $_POST['shape'] ),
				sanitize_text_field( $_POST['style'] ),
				sanitize_text_field( $_POST['image_position'] ),
				sanitize_text_field( $_POST['read_more_text'] ), 
				$_POST['read_more_icon'], 
				$_POST['read_more_icon_color_scheme']
			);
		die();
	}
	
	static function dump_grid( 
			$number, 
			$offset, 
			$category, 
			$show, 
			$date_design, 
			$post_type,
			$background_color, 
			$shape,
			$style,
			$image_position,
			$read_more_text, 
			$read_more_icon, 
			$read_more_icon_color_scheme
		) {
		
		$show = unserialize( urldecode( $show ) );
		
		$prefix         = 'bt_bb_';
		$shortcode      = 'bt_bb_grid';
		$class = array();
		
		$date_design_format         = '';
		$date_design_format_day     = '';
		$date_design_format_month   = '';
		if ( $date_design != '' ) {
			$class[] = $prefix . 'date_design' . '_' . $date_design;
			switch ( $date_design ){
				case 'triangle':
					$date_design_format         = 'j M';
					$date_design_format_day     = 'j';
					$date_design_format_month   = 'M';
					break;
				case 'rounded':
					$date_design_format         = 'j M';
					$date_design_format_day     = 'j';
					$date_design_format_month   = 'M';
					break;
				default:
					$date_design_format         = '';
					$date_design_format_day     = '';
					$date_design_format_month   = '';
					break;                            
			}
		}

		$output = '';		

		$posts = bt_bb_get_posts( $number, $offset, $category, $post_type );

		foreach( $posts as $item ) {
			
			$post_thumbnail_id = get_post_thumbnail_id( $item['ID'] ); 
			$img = wp_get_attachment_image_src( $post_thumbnail_id, $show['size'] );
			$img_src = isset($img[0]) ? $img[0] : BoldThemes_Customize_Default::$data['blog_image_default'];		
			
			if ( $img_src ) {
				$style_attr = ' ';
				
				$hw = 0;
				if ( $img_src != '' ) {
					$hw = $img[2] / $img[1];
				}
			}else{
				$class[] = ' bt_bb_grid_item_inner_content_no_image';
				$style_attr = ' ';

				$blog_image_default_id = attachment_url_to_postid( boldthemes_get_option( 'blog_image_default' ) );
				if ( is_numeric( $blog_image_default_id ) ) {
					$img = wp_get_attachment_image_src( $blog_image_default_id, $show['size'] );
					$img_src = isset($img[0]) ? $img[0] : BoldThemes_Customize_Default::$data['blog_image_default'];
				}
			}			
			
			$alt = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
			$alt = $alt != '' ? $alt : $item['title'];
			
			$background_color_style = $background_color != '' ? ' style="background-color: ' . bt_bb_rgb2hex2rgb( $background_color ) . ';"' : '';	
			
			$output .= '<div class="bt_bb_grid_item" data-image-position="' . esc_attr( $image_position ) . '" data-hw="' . esc_attr( $hw ) . '" data-src="' . esc_url_raw( $img_src ) . '" data-alt="' . esc_attr( $alt ) . '">'
					. '<div class="bt_bb_grid_item_inner"' . $background_color_style . '>';
				
					 $output .= '<div class="bt_bb_grid_item_post_thumbnail">'
							. '<a href="' . esc_url_raw( $item['permalink'] ) . '" title="' . esc_attr( $item['title'] ) . '" style="background-image: url(' . esc_url_raw( $img_src ) . ');"></a>'
							. '</div>';
					
					$output .= '<div class="bt_bb_grid_item_inner_content">';				
						$output .= '<div class="bt_bb_grid_item_inner_content_wrapper">';				
								$output .= '<h5 class="bt_bb_grid_item_title">'
											. '<a href="' . esc_url_raw( $item['permalink'] ) . '" title="' . esc_attr( $item['title'] ) . '">' . $item['title'] . '</a>'
										. '</h5>';

								if ( $show['excerpt'] ) {
									$output .= '<div class="bt_bb_grid_item_excerpt">' . $item['excerpt'] . '</div>';
								}
					
					$output .= '</div>'									
						. '</div>';

					if ( $show['category'] ) {
						$output .= '<div class="bt_bb_grid_item_category">';
							$output .= $item['category_list'];
						$output .= '</div>';
					}

					if ( $show['date'] || $show['author'] || $show['comments'] ) {
				
						$meta_output = '<div class="bt_bb_grid_item_meta">';

							if ( $show['date'] ) {
								$meta_output .= '<span class="bt_bb_grid_item_date">';
									if ( $date_design_format_day != '' && $date_design_format_month != '' ){
											$meta_output .= '<span class="' . esc_attr( $shortcode ) . '_item_date ' . esc_attr( $shortcode ) . '_item_date_day">';
												$meta_output .= get_the_date( $date_design_format_day, $item['ID'] );
											$meta_output .= '</span>';
											$meta_output .= '<span class="' . esc_attr( $shortcode ) . '_item_date ' . esc_attr( $shortcode ) . '_item_date_month">';
												$meta_output .= get_the_date( $date_design_format_month, $item['ID'] );
											$meta_output .= '</span>';
									}else{
											$meta_output .= get_the_date( $date_design_format, $item['ID'] );
									}            
								$meta_output .= '</span>';
							}

							if ( $show['author'] ) {
								$meta_output .= '<span class="bt_bb_grid_item_author">';
									$meta_output .= esc_html__( 'by', 'ajani' ) . ' ' . $item['author'];
								$meta_output .= '</span>';
							}

							if ( $show['comments'] && $item['comments'] != '' ) {
								$meta_output .= '<span class="bt_bb_grid_item_comments">';
									$meta_output .= $item['comments'];
								$meta_output .= '</span>';
							}
				
						$meta_output .= '</div>';
		
						$output .= $meta_output;
					}
					
					if ( $show['share'] ) {
						$output .= '<div class="bt_bb_grid_item_share">' . $item['share'] . '</div>';
					}
					
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
						if ( $read_more_icon_color_scheme_colors ) $read_more_icon_style .= ' --masonry-post-grid-read-more-icon-primary-color:' . $read_more_icon_color_scheme_colors[0] . '; --masonry-post-grid-read-more-icon-secondary-color:' . $read_more_icon_color_scheme_colors[1] . ';';
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
								$output .= '<a href="' . esc_url_raw( $item['permalink'] ) . '">' . $read_more_text_html . ' '  . $read_more_icon_output . '</a>';
						$output .= '</div>';
					}


				$output .= '</div>';
			$output .= '</div>';
		}
		
		$allowed = array(
			'a' => array(
				'class'       => true,
				'href'        => true,
				'rel'         => true,
				'title'       => true,
				'target'      => true,
				'data-*'	  => true,
				'style'			=> true,
			),
			'div' => array(
				'class'    => true,
				'data-*'   => true,
				'style'    => true,
			),
			'span' => array(
				'class' => true,
				'data-*' => true,
			),
			'img' => array(
				'src' => true,
				'alt' => true,
			),
			'h1' => array(
				
			),
			'h2' => array(
				
			),
			'h3' => array(
				
			),
			'h4' => array(
				
			),
			'h5' => array(
				'class' => true,
			),
			'h6' => array(
				
			),
			'ul' => array(
				'class' => true,
			),
			'li' => array(
				
			)
		);
		
		echo wp_kses( $output, $allowed );
		
		wp_die(); 
	}
	
	
	
	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(			
			'number'          => '',
			'auto_loading'    => '',
			'columns'         => '',
			'size'			  => '',
			'gap'             => '',
			'category'        => '',
			'category_filter' => '',
			'show_category'   => '',
			'show_date'       => '',
			'show_author'     => '',
			'show_comments'   => '',
			'show_excerpt'    => '',
			'show_share'      => '',
			'background_color'				=> '',
			'shape'							=> '',
			'style'							=> '',
			'switch_styles_on_odd_even'     => '',
			'image_position'				=> '',
			'read_more_text'				=> '',
			'read_more_icon'				=> '',
			'read_more_icon_color_scheme'   => '',
			'show_same_height'				=> ''
		) ), $atts, $this->shortcode ) );
		
		$post_type = 'post';
		
		wp_enqueue_script( 'jquery-masonry' );

		wp_enqueue_script( 
			'bt_bb_post_grid',
			get_template_directory_uri() . '/bold-page-builder/content_elements/bt_bb_masonry_post_grid/bt_bb_post_grid.js',
			array( 'jquery' )
		);
		
		wp_localize_script( 'bt_bb_post_grid', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

		$class = array( $this->shortcode, 'bt_bb_grid_container' );

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
		
		if ( $show_same_height == 'show_same_height' ) {
			$class[] = $this->prefix . 'show_same_height';
		}

		if ( $columns != '' ) {
			$class[] = $this->prefix . 'columns' . '_' . $columns;
		}
		
		if ( $gap != '' ) {
			$class[] = $this->prefix . 'gap' . '_' . $gap;
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
		if ( $switch_styles_on_odd_even != '' ) {
			$class[] = $this->prefix . 'switch_styles';
		}
		
		$date_design = '';
		if ( $date_design != '' ) {
			$class[] = $this->prefix . 'date_design' . '_' . $date_design;
		}
		
		if ( $number > 1000 || $number == '' ) {
			$number = 1000;
		} else if ( $number < 1 ) {
			$number = 1;
		}

		$show = array( 'category' => false, 'date' => false, 'author' => false, 'comments' => false, 'excerpt' => false, 
			'share' => false, 'size' => 'large', 'switch_styles_on_odd_even' => false );
		if ( $show_category == 'show_category' ) {
			$show['category'] = true;
		}
		if ( $show_date == 'show_date' ) {
			$show['date'] = true;
		}
		if ( $show_author == 'show_author' ) {
			$show['author'] = true;
		}
		if ( $show_comments == 'show_comments' ) {
			$show['comments'] = true;
		}
		if ( $show_excerpt == 'show_excerpt' ) {
			$show['excerpt'] = true;
		}
		if ( $show_share == 'show_share' ) {
			$show['share'] = true;
		}
		if ( $size != '' ) {
			$show['size'] = $size;
		}		
		if ( $show_share == 'switch_styles_on_odd_even' ) {
			$show['switch_styles_on_odd_even'] = true;
		}

		$output = '';
		
		if ( $category_filter == 'yes' ) {
			if ( $post_type == 'post' ) {
				$cat_arr = get_categories();
				$cats = array();
				if ( $category != '' ) {
					$cat_slug_arr = explode( ',', $category );
					$cat_id_arr = get_terms( array( 'category' ), array( 'fields' => 'ids' ), array( 'slug' => $cat_slug_arr ) );
					foreach ( $cat_arr as $cat ) {
						if ( in_array( $cat->slug, $cat_slug_arr ) || in_array( $cat->parent, $cat_id_arr ) ) {
							$cats[] = $cat;
						}
					}
				} else {
					$cats = $cat_arr;
				}
			}
			
			$output .= '<div class="bt_bb_post_grid_filter">';
				$output .= '<span class="bt_bb_post_grid_filter_item active" data-category="">' . esc_html__( 'All', 'ajani' ) . '</span>';
				foreach ( $cats as $cat ) {
					$output .= '<span class="bt_bb_post_grid_filter_item" data-category="' . esc_attr( $cat->slug ) . '">' . $cat->name . '</span>';
				}
			$output .= '</div>';
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );

		$output .= '<div class="bt_bb_masonry_post_grid_content bt_bb_grid_hide" '
				. 'data-bt-bb-masonry-post-grid-nonce="' . esc_attr( wp_create_nonce( 'bt-bb-masonry-post-grid-nonce' ) ) . '" '
				. 'data-number="' . esc_attr( $number ) . '" '
				. 'data-category="' . esc_attr( $category ) . '" '
				. 'data-show="' . esc_attr( urlencode( serialize( $show ) ) ) . '" '
				. 'data-auto-loading="' . esc_attr( $auto_loading ) . '" '
				. 'data-post-type="' . esc_attr( $post_type ) . '" '
				. 'data-date-design="' . esc_attr( $date_design ) . '" '
				. 'data-background-color="' . esc_attr( $background_color ) . '" '
				. 'data-shape="' . esc_attr( $shape ) . '" '
				. 'data-style="' . esc_attr( $style ) . '" '
				. 'data-image-position="' . esc_attr( $image_position ) . '" '
				. 'data-read-more-text="' . esc_attr( $read_more_text ) . '" '
				. 'data-read-more-icon="' . esc_attr( $read_more_icon ) . '" '
				. 'data-read-more-icon-color-scheme="' . esc_attr( $read_more_icon_color_scheme ) . '"'
				. '>'
				. '<div class="bt_bb_grid_sizer"></div></div>';

		$output .= '<div class="bt_bb_post_grid_loader"></div>';

		$output = '<div' . $id_attr . ' class="' . esc_attr( implode( ' ', $class ) ) . '"' . $style_attr . ' data-columns="' . esc_attr( $columns ) . '">' . $output . '</div>';

		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;

	}

	function map_shortcode() {
		require_once( WP_PLUGIN_DIR   .  '/bold-page-builder/content_elements_misc/misc.php' );
		$color_scheme_arr = bt_bb_get_color_scheme_param_array();
		
		$array = array();
		
		$array = array_merge( $array, array(
			array( 'param_name' => 'size', 'type' => 'dropdown', 'heading' => esc_html__( 'Image Size', 'ajani' ), 'preview' => true,
					'value' => bt_bb_get_image_sizes()
			),
			array( 'param_name' => 'number', 'type' => 'textfield', 'heading' => esc_html__( 'Number of items', 'ajani' ), 'description' => esc_html__( 'Enter number of items or leave empty to show all (up to 1000)', 'ajani' ), 'preview' => true ),
			array( 'param_name' => 'auto_loading', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'auto_loading' ), 'heading' => esc_html__( 'Load more items on scroll', 'ajani' ), 'preview' => true
			),
			array( 'param_name' => 'columns', 'type' => 'dropdown', 'heading' => esc_html__( 'Columns', 'ajani' ), 'preview' => true,
				'value' => array(
					esc_html__( '1', 'ajani' ) => '1',
					esc_html__( '2', 'ajani' ) => '2',
					esc_html__( '3', 'ajani' ) => '3',
					esc_html__( '4', 'ajani' ) => '4',
					esc_html__( '5', 'ajani' ) => '5',
					esc_html__( '6', 'ajani' ) => '6'
				)
			),
			array( 'param_name' => 'gap', 'type' => 'dropdown', 'heading' => esc_html__( 'Gap', 'ajani' ),
				'value' => array(
					esc_html__('No gap', 'ajani' ) => 'no_gap',
					esc_html__('Extra Small', 'ajani' ) => 'extrasmall',
					esc_html__('Small', 'ajani' ) => 'small',
					esc_html__('Normal', 'ajani' ) => 'normal',
					esc_html__('Medium', 'ajani' ) => 'medium',
					esc_html__('Large', 'ajani' ) => 'large',
					esc_html__('Extra Large', 'ajani' ) => 'extralarge'
				)
			),
			array( 'param_name' => 'category', 'type' => 'textfield', 'heading' => esc_html__( 'Category', 'ajani' ), 'description' => esc_html__( 'Enter category slug or leave empty to show all', 'ajani' ), 'preview' => true ),
			array( 'param_name' => 'category_filter', 'type' => 'dropdown', 'heading' => esc_html__( 'Category filter', 'ajani' ),
				'value' => array(
					esc_html__( 'No', 'ajani' ) => 'no',
					esc_html__( 'Yes', 'ajani' ) => 'yes'
				)
			),
			array( 'param_name' => 'show_same_height', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'show_same_height' ), 'heading' => esc_html__( 'Show all items in  the same height', 'ajani' ), 'preview' => true
			),			
			array( 'param_name' => 'show_category', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'show_category' ), 'heading' => esc_html__( 'Show category', 'ajani' ), 'preview' => true
			),
			array( 'param_name' => 'show_date', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'show_date' ), 'heading' => esc_html__( 'Show date', 'ajani' ), 'preview' => true
			),
			array( 'param_name' => 'show_author', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'show_author' ), 'heading' => esc_html__( 'Show author', 'ajani' ), 'preview' => true
			),
			array( 'param_name' => 'show_comments', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'show_comments' ), 'heading' => esc_html__( 'Show number of comments', 'ajani' ), 'preview' => true
			),
			array( 'param_name' => 'show_excerpt', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'show_excerpt' ), 'heading' => esc_html__( 'Show excerpt', 'ajani' ), 'preview' => true
			),
			array( 'param_name' => 'show_share', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'show_share' ), 'heading' => esc_html__( 'Show share icons', 'ajani' ), 'preview' => true 
			),
			array( 'param_name' => 'background_color', 'type' => 'colorpicker', 'heading' => esc_html__( 'Background color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ), 'preview' => true ),
			array( 'param_name' => 'shape', 'type' => 'dropdown', 'heading' => esc_html__( 'Shape', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
				'value' => array(
					esc_html__( 'Square', 'ajani' ) => 'square',
					esc_html__( 'Soft Rounded', 'ajani' ) => 'soft_rounded',
					esc_html__( 'Hard Rounded', 'ajani' ) => 'hard_rounded'
				)
			),
			array( 'param_name' => 'style', 'type' => 'dropdown', 'heading' => esc_html__( 'Style', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
				'value' => array(
					esc_html__( 'Flat', 'ajani' ) => 'flat',
					esc_html__( 'Shadowed', 'ajani' ) => 'shadowed',
					esc_html__( 'Bordered', 'ajani' ) => 'bordered'
				)
			),
			array( 'param_name' => 'switch_styles_on_odd_even', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'switch_styles_on_odd_even' ), 'heading' => esc_html__( 'Switch image position styles on odd/even', 'ajani' ),  'group' => esc_html__( 'Design', 'ajani' ), 'preview' => true 
			),
			array( 'param_name' => 'image_position', 'type' => 'dropdown', 'heading' => esc_html__( 'Image position', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
				'value' => array(
					esc_html__( 'Image above content', 'ajani' ) => 'image_above_content',
					esc_html__( 'Image beneath content', 'ajani' ) => 'image_beneath_content'
				)
			),
			array( 'param_name' => 'read_more_text', 'type' => 'textfield', 'heading' => esc_html__( 'Read more text', 'ajani' ), 'group' => esc_html__( 'Read more', 'ajani' ), 'value' => '' ), 
			array( 'param_name' => 'read_more_icon', 'type' => 'iconpicker', 'heading' => esc_html__( 'Read more icon', 'ajani' ), 'group' => esc_html__( 'Read more', 'ajani' ), 'preview' => true ),
			array( 'param_name' => 'read_more_icon_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Read more color scheme', 'ajani' ), 'value' => $color_scheme_arr, 'preview' => true, 'group' => esc_html__( 'Read more', 'ajani' ) ),
		) );

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Masonry Post Grid', 'ajani' ), 'description' => esc_html__( 'Masonry grid with posts', 'ajani' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => $array
		) );
	} 
}