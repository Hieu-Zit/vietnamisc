<?php

class bt_bb_masonry_portfolio_tiles extends BT_BB_Element {

	function __construct() {
		parent::__construct();
		add_action( 'wp_ajax_bt_bb_get_tiles_portfolio', array( __CLASS__, 'bt_bb_get_tiles_portfolio_callback' ) );
		add_action( 'wp_ajax_nopriv_bt_bb_get_tiles_portfolio', array( __CLASS__, 'bt_bb_get_tiles_portfolio_callback' ) );
	}

	static function bt_bb_get_tiles_portfolio_callback() {	
        check_ajax_referer( 'bt-bb-masonry-portfolio-tiles-nonce', 'bt-nonce' );
		bt_bb_masonry_portfolio_tiles::dump_grid( 
				intval( $_POST['number'] ), 
				sanitize_text_field( $_POST['category'] ), 
				$_POST['show'], 
				sanitize_text_field( $_POST['format'] ) ,
				sanitize_text_field( $_POST['shape'] )
		);
		die();
	}

	static function dump_grid( $number, $category, $show, $format, $shape ) {

		$show = unserialize( urldecode( $show ) );
		$prefix         = 'bt_bb_';
		$output = '';
		$output .= '<div class="bt_bb_grid_sizer"></div>';

		$class = array();
		$cat_slug_arr = array();
		if ( $category != '' ) {
			$masonry_tiles_portfolios = bt_bb_get_posts( $number, 0, $category, 'portfolio' );	
		}else{
			$masonry_tiles_portfolios = bt_bb_get_posts( $number, 0, '', 'portfolio' );	
		}

		$format_arr = array();
		if ( $format != '' ) {
			$format_arr = explode( ',', $format );
		}	
		
		$n = 0;
		foreach( $masonry_tiles_portfolios as $item ) {
			
			$id = get_post_thumbnail_id( $item['ID'] );
			$size = $show['size'];//'boldthemes_large_square';
			$img = wp_get_attachment_image_src( $id, $size );
			
			if ( isset( $format_arr[ $n ] ) ) {				
				switch ( $format_arr[ $n ] ){
					case '11': 
						$img = wp_get_attachment_image_src( $id, $size );						
						break;
					case '21': 
						$size = 'boldthemes_large_rectangle';
						$img = wp_get_attachment_image_src( $id, 'boldthemes_large_rectangle' );
						break;
					case '12': 
						$size = 'boldthemes_large_vertical_rectangle';
						$img = wp_get_attachment_image_src( $id, 'boldthemes_large_vertical_rectangle' );
						break;
					case '22': 
						$img = wp_get_attachment_image_src( $id, $size );
						break;
					default: 
						$img = wp_get_attachment_image_src( $id, $size );
						break;
				}
			}
			

			$img_src = '';
			if ( $img ) {
				$img_src = isset($img[0]) ? $img[0] : BoldThemes_Customize_Default::$data['pf_image_default'];;
			}else{
				$pf_image_default_id = attachment_url_to_postid( boldthemes_get_option( 'pf_image_default' ) );
				if ( is_numeric( $pf_image_default_id ) ) {
					$img = wp_get_attachment_image_src( $pf_image_default_id, $size );
					$img_src = isset($img[0]) ? $img[0] : BoldThemes_Customize_Default::$data['pf_image_default'];
				}
			}

			$hw = 0;
			if ( $img_src != '' ) {
				$hw = $img[2] / $img[1];
			}

			$img_full = wp_get_attachment_image_src( $id, 'full' );
			
			$img_src_full = '';
			if ( $img_full ) {
				$img_src_full = $img_full[0];
			}else{
				$pf_image_default_id = attachment_url_to_postid( boldthemes_get_option( 'pf_image_default' ) );
				if ( is_numeric( $pf_image_default_id ) ) {
					$img_full = wp_get_attachment_image_src( $pf_image_default_id, 'full' );
					$img_src_full = isset($img_full[0]) ? $img_full[0] : BoldThemes_Customize_Default::$data['pf_image_default'];
				}
			}
			
			$tile_format = 'bt_bb_tile_format11';
			
			if ( isset( $format_arr[ $n ] ) ) {
				$tile_format = 'bt_bb_tile_format';
				if ( $format_arr[ $n ] == '21' || $format_arr[ $n ] == '12' || $format_arr[ $n ] == '22' ) {
					$tile_format .= '_' . $format_arr[ $n ];
				} else {
					$tile_format .= '11';
				}
			}
			
		
			if ( $shape != '' ) {
				$class[] = $prefix . 'shape' . '_' . $shape;
			}

			$output .= '<div class="bt_bb_grid_item ' . $tile_format . ' ' . esc_attr( implode( ' ', $class ) ) . '" data-hw="' .  esc_attr( $hw ) . '" data-src="' . esc_attr( $img_src ) . '" data-src-full="' . esc_attr( $img_src_full ) . '" data-title="' . esc_attr( $item['title'] ) . '">
							<div class="bt_bb_grid_item_inner" data-hw="' . esc_attr( $hw ) . '" >
								<div class="bt_bb_grid_item_post_thumbnail">
									<a href="' . esc_url_raw( $item['permalink'] ) . '" title="' . esc_attr( $item['title'] ) . '">
										<img class="bt_bb_grid_item_inner_image" src="' . esc_url_raw( $img_src ) . '"/>
									</a>
								</div>
								<div class="bt_bb_grid_item_inner_content"><div class="bt_bb_grid_item_inner_content_wrapper">';

								$output .= '<h5 class="bt_bb_grid_item_post_title">' . $item['title'] . '</h5>';
								

								if ( $show['excerpt'] ) {
									$output .= '<div class="bt_bb_grid_item_post_excerpt">' . $item['excerpt'] . '</div>';
								}

								$output .= '</div></div>';
							if ( $show['title'] ) {
									$output .= '<div class="bt_bb_grid_item_post_title_init"><h5>' . $item['title'] . '</h5></div>';
							}
				$output .= '</div>
			</div>';
			$n++;
		}

		echo '<div><div class="bt_bb_masonry_post_image_content">' . $output . '</div></div>';
        wp_die(); 
	}

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts', array(
			'look'	          => '',
			'number'          => '',
			'columns'         => '',
			'format'		  => '',
			'size'			  => '',
			'gap'             => '',
			'category'        => '',
			'category_filter' => '',
			'shape'			  => '',
			'show_excerpt'    => '',
			'show_title'	  => '',
			'dark_light_mode' => ''
		) ), $atts, $this->shortcode ) );

		wp_enqueue_script( 'jquery-masonry' );

		wp_enqueue_script( 
			'bt_bb_portfolio_tiles',
			get_template_directory_uri() . '/bold-page-builder/content_elements/bt_bb_masonry_portfolio_tiles/bt_bb_portfolio_tiles.js',
			array( 'jquery' )
		);
		
		wp_localize_script( 'bt_bb_portfolio_tiles', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

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

		if ( $columns != '' ) {
			$class[] = $this->prefix . 'columns' . '_' . $columns;
		}
		
		if ( $gap != '' ) {
			$class[] = $this->prefix . 'gap' . '_' . $gap;
		}
		
		if ( $shape != '' ) {
			$class[] = $this->prefix . 'shape' . '_' . $shape;
		}
		
		if ( $look != '' ) {
			$class[] = $this->prefix . 'look' . '_' . $look;
		}
		
		if ( $dark_light_mode != '' ) {
			$class[] = $this->prefix . 'dark_light_mode' . '_' . $dark_light_mode;
		}
		
		if ( $number > 1000 || $number == '' ) {
			$number = 1000;
		} else if ( $number < 1 ) {
			$number = 1;
		}

		$show = array( 'excerpt' => false, 'title' => false, 'size' => 'boldthemes_large_square' );
		if ( $show_excerpt == 'show_excerpt' ) {
			$show['excerpt'] = true;
		}
		if ( $show_title == 'show_title' ) {
			$show['title'] = true;
		}
		
		if ( $size != '' ) {
			$show['size'] = $size;
		}

		$output = '';
		
		if ( $category_filter == 'yes' ) {
			$cat_arr = get_terms( 'portfolio_category' );
			$cats = array();
			if ( $category != '' ) {
				$cat_slug_arr = explode( ',', $category );
				foreach ( $cat_arr as $cat ) {
					if ( in_array( $cat->slug, $cat_slug_arr ) ) {
						$cats[] = $cat;
					}
				}
			} else {
				$cats = $cat_arr;
			}
			$output .= '<div class="bt_bb_post_grid_filter">';
				$cat_arr = array();
				foreach ( $cats as $cat ) {
					$cat_arr[] = isset( $cat->slug ) ? $cat->slug : '';
				}
				$output .= '<span class="bt_bb_masonry_portfolio_tiles_filter_item bt_bb_post_grid_filter_item active" data-category-portfolio="' . esc_attr( join( ',', $cat_arr ) ) . '" data-format-portfolio="' . esc_attr( $format ) . '" data-post-type="portfolio">' . esc_html__( 'All', 'ajani' ) . '</span>';
				foreach ( $cats as $cat ) {
					$cat_slug = isset( $cat->slug ) ? $cat->slug : "";
					$cat_name = isset( $cat->name ) ? $cat->name : "";
					$output .= '<span class="bt_bb_masonry_portfolio_tiles_filter_item bt_bb_post_grid_filter_item" data-category-portfolio="' . esc_attr( $cat_slug ) . '"  data-format-portfolio="' . esc_attr( $format ) . '" data-post-type="portfolio">' . $cat_name . '</span>';
                                    
				}
			$output .= '</div>';
		}

		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
                
		$output .= '<div class="bt_bb_masonry_portfolio_tiles_content bt_bb_masonry_post_grid_content bt_bb_grid_hide" '
				. 'data-bt-nonce="' . esc_attr( wp_create_nonce( 'bt-bb-masonry-portfolio-tiles-nonce' ) ) . '" '
				. 'data-number-portfolio="' . esc_attr( $number ) . '" '
				. 'data-format-portfolio="' . esc_attr( $format ) . '" '
				. 'data-category-portfolio="' . esc_attr( $category ) . '"  '
				. 'data-post-type="portfolio" '
				. 'data-show-portfolio="' . urlencode( serialize( $show ) ) . '" '
				. 'data-shape="' . esc_attr( $shape ) . '"  '
				. '><div class="bt_bb_grid_sizer"></div></div>';

		$output .= '<div class="bt_bb_post_grid_loader"><span class="box1"></span><span class="box2"></span><span class="box3"></span><span class="box4"></span><span class="box5"></span></div>';
                
                $output = '<div' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . ' data-columns="' . esc_attr( $columns ) . '">' . $output . '</div>';

		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );

		return $output;
	}

	function map_shortcode() {

		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Masonry Portfolio Tiles', 'ajani' ), 'description' => esc_html__( 'Masonry tiles with portfolio', 'ajani' ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array(
				array( 'param_name' => 'number', 'type' => 'textfield', 'heading' => esc_html__( 'Number of items', 'ajani' ), 'description' => esc_html__( 'Enter number of items or leave empty to show all (up to 1000)', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'columns', 'type' => 'dropdown', 'heading' => esc_html__( 'Columns', 'ajani' ), 'preview' => true,
					'value' => array(
						esc_html__('1', 'ajani' ) => '1',
						esc_html__('2', 'ajani' ) => '2',
						esc_html__('3', 'ajani' ) => '3',
						esc_html__('4', 'ajani' ) => '4',
						esc_html__('5', 'ajani' ) => '5',
						esc_html__('6', 'ajani' ) => '6'
					)
				),
				array( 'param_name' => 'gap', 'type' => 'dropdown', 'heading' => esc_html__( 'Gap', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
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
						esc_html__('No', 'ajani' ) => 'no',
						esc_html__('Yes', 'ajani' ) => 'yes'
					)
				),
				array( 'param_name' => 'format', 'type' => 'textfield', 'preview' => true, 'heading' => esc_html__( 'Tiles format', 'ajani' ), 'description' => esc_html__( 'e.g. 11, 21, 12, 22', 'ajani' ), 'preview' => true
				),
				array( 'param_name' => 'shape', 'type' => 'dropdown', 'heading' => esc_html__( 'Shape', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Square', 'ajani' ) => 'square',
						esc_html__( 'Soft Rounded', 'ajani' ) => 'soft_rounded',
						esc_html__( 'Hard Rounded', 'ajani' ) => 'hard_rounded',
						esc_html__( 'Full Rounded', 'ajani' ) => 'full_rounded'
					)
				),
				array( 'param_name' => 'dark_light_mode', 'type' => 'dropdown', 'heading' => esc_html__( 'Dark / Light Mode', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Dark', 'ajani' ) => 'dark',
						esc_html__( 'Light', 'ajani' ) => 'light'
					)
				),
				array( 'param_name' => 'size', 'type' => 'dropdown', 'heading' => esc_html__( 'Square Image Size', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ), 'preview' => true,
					'value' => bt_bb_get_image_sizes()
				),
				array( 'param_name' => 'show_title', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'show_title' ), 'heading' => esc_html__( 'Show title', 'ajani' ), 'group' => esc_html__( 'Show', 'ajani' ),'preview' => true
				),
				array( 'param_name' => 'show_excerpt', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'show_excerpt' ), 'heading' => esc_html__( 'Show excerpt', 'ajani' ), 'group' => esc_html__( 'Show', 'ajani' ),'preview' => true
				),
			)
		) );
	} 
}