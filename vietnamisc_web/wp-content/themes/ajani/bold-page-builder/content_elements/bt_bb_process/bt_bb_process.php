<?php
class bt_bb_process extends BT_BB_Element {

	function handle_shortcode( $atts, $content ) {
		extract( shortcode_atts( apply_filters( 'bt_bb_extract_atts_' . $this->shortcode, array(
			'orientation'				=> '',
			'show_steps'				=> '',
			'shape'						=> '',
			'icon_color_scheme'			=> '',
			'icon_size'					=> '',
			'title_weight'				=> '',
			'line_width'				=> '',
			'line_color'				=> '',
			'line_style'				=> '',
			'close_items_initially'		=> 'no',
			'align_icons'				=> ''			
		) ), $atts, $this->shortcode ) );
		
		$class = array( $this->shortcode );
		
		if ( $el_class != '' ) {
			$class[] = $el_class;
		}
		
		$id_attr = '';
		if ( $el_id != '' ) {
			$id_attr = ' ' . 'id="' . esc_attr( $el_id ) . '"';
		}
		
		if ( $orientation != '' ) {
			$class[] = $this->prefix . 'orientation' . '_' . $orientation;
		}
		if ( $show_steps != '' ) {
			$class[] = $this->prefix . 'show_steps' . '_' . $show_steps;
		}
		if ( $shape != '' ) {
			$class[] = $this->prefix . 'shape' . '_' . $shape;
		}
		$icon_color_scheme_id = NULL;
		if ( is_numeric ( $icon_color_scheme ) ) {
			$icon_color_scheme_id = $icon_color_scheme;
		} else if ( $icon_color_scheme != '' ) {
			$icon_color_scheme_id = bt_bb_get_color_scheme_id( $icon_color_scheme );
		}
		$icon_color_scheme_colors = bt_bb_get_color_scheme_colors_by_id( $icon_color_scheme_id - 1 );
		if ( $icon_color_scheme_colors ) $el_style .= '; --process-icon-primary-color:' . $icon_color_scheme_colors[0] . '; --process-icon-secondary-color:' . $icon_color_scheme_colors[1] . ';';
		if ( $icon_color_scheme != '' ) $class[] = $this->prefix . 'icon_color_scheme_' .  $icon_color_scheme_id;

		if ( $icon_size != '' ) {
			$class[] = $this->prefix . 'icon_size' . '_' . $icon_size;
		}
		if ( $line_width != '' ) {
			$class[] = $this->prefix . 'line_width' . '_' . $line_width;
		}
		if ( $line_color != '' ) {
			$class[] = $this->prefix . 'line_color' . '_' . $line_color;
		}
		if ( $line_style != '' ) {
			$class[] = $this->prefix . 'line_style' . '_' . $line_style;
		}
		if ( $title_weight != '' ) {
			$class[] = $this->prefix . 'title_weight' . '_' . $title_weight;
		}
		
		if ( $close_items_initially != '' ) {
			$class[] = $this->prefix . 'close_items_initially';
		}
		if ( $align_icons != '' ) {
			$class[] = $this->prefix . 'align_icons' . '_' . $align_icons;
		}
		
		$style_attr = '';
		if ( $el_style != '' ) {
			$style_attr = ' ' . 'style="' . esc_attr( $el_style ) . '"';
		}
		
		$class = apply_filters( $this->shortcode . '_class', $class, $atts );
		
		$data_attr = '';
		if ( $close_items_initially == 'close_items_initially' ) {
			$data_attr = ' ' . 'data-closed=closed';
		}
		
		$content = do_shortcode( $content );
		
		$step_count = $this->get_count_process_step( $content, 'bt_bb_process_step_item_count' );
		
		$output = '<div' . $id_attr . ' class="' . implode( ' ', $class ) . '"' . $style_attr . $data_attr . ' data-slides="' . esc_attr(  $step_count ) . '">' . $content . '</div>';
		
		$output = apply_filters( 'bt_bb_general_output', $output, $atts );
		$output = apply_filters( $this->shortcode . '_output', $output, $atts );
		
		return $output;
		
	}
	
	static function get_count_process_step( $content, $needle ) {
		$offset = 0;
		$allpos = array();
		while (($pos = mb_strpos($content, $needle, $offset)) !== FALSE) {
			$offset   = $pos + 1;
			$allpos[] = $pos;
		}
		return count($allpos);
	}
	
	function map_shortcode() {
		
		require_once( WP_PLUGIN_DIR   .  '/bold-page-builder/content_elements_misc/misc.php' );
		$color_scheme_arr = bt_bb_get_color_scheme_param_array();
		
		bt_bb_map( $this->shortcode, array( 'name' => esc_html__( 'Process', 'ajani' ), 
			'description' => esc_html__( 'Process', 'ajani' ), 'container' => 'vertical', 
			'accept' => array( 'bt_bb_process_step' => true ), 'icon' => $this->prefix_backend . 'icon' . '_' . $this->shortcode,
			'params' => array( 
				array( 'param_name' => 'orientation', 'type' => 'dropdown', 'heading' => esc_html__( 'Orientation', 'ajani' ), 'description' => esc_html__( 'Horizontal orientation becomes vertical below 992px width.', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Vertical', 'ajani' ) => '',
						esc_html__( 'Horizontal', 'ajani' ) => 'horizontal'
					)
				),
				array( 'param_name' => 'show_steps', 'type' => 'dropdown', 'heading' => esc_html__( 'How many steps to show', 'ajani' ), 'description' => esc_html__( 'Only applicable on horizontal process element.', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( '2', 'ajani' ) => '2',
						esc_html__( '3', 'ajani' ) => '3',
						esc_html__( '4', 'ajani' ) => '4',
						esc_html__( '5', 'ajani' ) => '5',
						esc_html__( '6', 'ajani' ) => '6'
					)
				),
				array( 'param_name' => 'shape', 'type' => 'dropdown', 'heading' => esc_html__( 'Shape', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Square', 'ajani' ) => 'square',
						esc_html__( 'Soft Rounded', 'ajani' ) => 'soft_rounded',
						esc_html__( 'Hard Rounded', 'ajani' ) => 'hard_rounded',
						esc_html__( 'Circle', 'ajani' ) => 'circle'
					)
				),
				array( 'param_name' => 'title_weight', 'type' => 'dropdown', 'heading' => esc_html__( 'Title font weight', 'ajani' ), 'preview' => true, 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Inherit', 'ajani' ) => 'inherit',
						esc_html__( 'Normal', 'ajani' ) => 'normal',
						esc_html__( 'Bold', 'ajani' ) => 'bold'
					)
				),
				array( 'param_name' => 'icon_color_scheme', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon Color Scheme', 'ajani' ), 'value' => $color_scheme_arr, 'preview' => true, 'group' => esc_html__( 'Icon', 'ajani' ) ),
				array( 'param_name' => 'icon_size', 'type' => 'dropdown', 'heading' => esc_html__( 'Icon size', 'ajani' ), 'group' => esc_html__( 'Icon', 'ajani' ),
					'value' => array(
						esc_html__( 'Regular', 'ajani' ) => '',
						esc_html__( 'Smaller', 'ajani' ) => 'small'
					)
				),
				array( 'param_name' => 'line_width', 'type' => 'dropdown', 'heading' => esc_html__( 'Line width', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ), 'preview' => true,
					'value' => array(
						esc_html__( '1px', 'ajani' ) 			=> '1',
						esc_html__( '2px', 'ajani' ) 			=> '2',
						esc_html__( '3px', 'ajani' )			=> '3',
						esc_html__( '4px', 'ajani' )			=> '4'
					)
				),
				array( 'param_name' => 'line_color', 'type' => 'dropdown', 'heading' => esc_html__( 'Line color', 'ajani' ), 'group' => esc_html__( 'Design', 'ajani' ), 'preview' => true,
					'value' => array(
						esc_html__( 'Default', 'ajani' ) 			=> '',
						esc_html__( 'Dark transparent color', 'ajani' ) 		=> 'dark_transparent',
						esc_html__( 'Light transparent color', 'ajani' ) 		=> 'light_transparent',
						esc_html__( 'Dark color', 'ajani' ) 		=> 'dark',
						esc_html__( 'Light color', 'ajani' ) 		=> 'light',
						esc_html__( 'Accent color', 'ajani' ) 	=> 'accent',
						esc_html__( 'Alternate color', 'ajani' ) 	=> 'alternate'
					)
				),
				array( 'param_name' => 'line_style', 'type' => 'dropdown', 'heading' => esc_html__( 'Line style', 'ajani' ), 'preview' => true, 'group' => esc_html__( 'Design', 'ajani' ),
					'value' => array(
						esc_html__( 'Solid', 'ajani' ) => 'solid',
						esc_html__( 'Dotted', 'ajani' ) => 'dotted',
						esc_html__( 'Dashed', 'ajani' ) => 'dashed'
					)
				),
				array( 'param_name' => 'close_items_initially', 'type' => 'checkbox', 'value' => array( esc_html__( 'Yes', 'ajani' ) => 'close_items_initially' ), 'group' => esc_html__( 'Design', 'ajani' ), 'heading' => esc_html__( 'Close all items initially', 'ajani' ), 'preview' => true ),
				array( 'param_name' => 'align_icons', 'type' => 'dropdown', 'heading' => esc_html__( 'Align icons', 'ajani' ), 'description' => esc_html__( 'Only applicable on vertical process element', 'ajani' ), 'group' => esc_html__( 'Icon', 'ajani' ),
					'value' => array(
						esc_html__( 'Left', 'ajani' ) => 'left',
						esc_html__( 'Right', 'ajani' ) => 'right'
					)
				),
			)
		) );
	}
}

