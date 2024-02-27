<?php
// Widgets for Ajani theme by BoldThemes

function ajani_register_widgets() {
	register_widget( 'BB_Button_Widget' );
}
add_action( 'widgets_init', 'ajani_register_widgets' );

// BB_Button_Widget
if ( ! class_exists( 'BB_Button_Widget' ) ) {
	class BB_Button_Widget extends WP_Widget {

		function __construct() {
			parent::__construct(
				'bt_advance_button_widget', // Base ID
				__( 'BB Button', 'bt_plugin' ), // Name
				array( 'description' => __( 'Button with icon, text, link, color scheme, size, shape.', 'bt_plugin' ) ) // Args
			);
            $this->prefix = 'bt_button_widget';
		}
		
		public function widget( $args, $instance ) {	                    
			$icon   = ! empty( $instance['icon'] ) ? $instance['icon'] : '';
			$icon_position = ( ! empty( $instance['icon_position'] ) ) ? $instance['icon_position'] : 'left';
			$icon_size = ( ! empty( $instance['icon_size'] ) ) ? $instance['icon_size'] : 'normal';
			$text   = ! empty( $instance['text'] ) ? $instance['text'] : '';
			$url    = ! empty( $instance['url'] ) ? $instance['url'] : '';
			$target = ! empty( $instance['target'] ) ? $instance['target'] : '_self';
			$style  = ! empty( $instance['style'] ) ? $instance['style'] : 'filled';
			$css    = ! empty( $instance['css'] ) ? $instance['css'] : '';
			$size    = ! empty( $instance['size'] ) ? $instance['size'] : 'small';
			$shape    = ! empty( $instance['shape'] ) ? $instance['shape'] : 'inherit';
			$color_scheme = ! empty( $instance['color_scheme'] ) ? $instance['color_scheme'] : '';
			$color_scheme_icon = ! empty( $instance['color_scheme_icon'] ) ? $instance['color_scheme_icon'] : '';

			$class = array( );
			$extra_class = array( $css );			
			
			if ( $icon != '' && $icon != 'no_icon' ) {
					$class[] = 'btIconWidget ';
			}   
			if ( $icon_position != '' ) {
					$class[] = 'btIconWidget' . boldthemes_convert_param_to_camel_case( $icon_position );
					$extra_class[] = "bt_bb_icon_position_" . $icon_position;
			}			
			
			if ( $icon_size != '' ) {
					$extra_class[] = "bt_bb_icon_size_" . $icon_size;
			}
			
			if ( $color_scheme_icon != '' ) {
					$extra_class[] = 'bt_bb_icon_color_scheme_' . bt_bb_get_color_scheme_id( $color_scheme_icon );
			}

			$args['before_widget'] = '<div class="btBox widget_' . $this->prefix . ' ' . implode( ' ', $class ) . '">';
                       
			echo $args['before_widget'];

					if ( ! empty( $instance['title'] ) ) {
						echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
					}

					$output = '';
					$output .= do_shortcode('[bt_bb_button '
							. 'text="'.esc_attr( $text ).'" '
							. 'icon="'.esc_attr( $icon ).'" '
							. 'icon_position="'.esc_attr( $icon_position ) .'" '
							. 'url="'.esc_attr( $url ).'" '
							. 'target="'.esc_attr( $target ).'" '
							. 'color_scheme="'.esc_attr( $color_scheme ).'" '
							. 'style="'.esc_attr( $style ).'" '
							. 'size="'.esc_attr( $size ).'" '
							. 'shape="'.esc_attr( $shape ).'" '
							. 'el_class="'.esc_attr( implode( ' ', $extra_class ) ).'" '
							.']');
					echo $output;
                        
			echo $args['after_widget'];

		}
		
		public function form( $instance ) {	
			$icon				= ! empty( $instance['icon'] ) ? $instance['icon'] : '';
			$icon_position		= ! empty( $instance['icon_position'] ) ? $instance['icon_position'] : 'left';
			$icon_size			= ( ! empty( $instance['icon_size'] ) ) ? $instance['icon_size'] : 'normal';
			$text				= ! empty( $instance['text'] ) ? $instance['text'] : '';
			$url				= ! empty( $instance['url'] ) ? $instance['url'] : '';
			$target				= ! empty( $instance['target'] ) ? $instance['target'] : '';
			$style				= ! empty( $instance['style'] ) ? $instance['style'] : 'filled';
			$css				= ! empty( $instance['css'] ) ? $instance['css'] : '';			
			$size				= ! empty( $instance['size'] ) ? $instance['size'] : 'small';
			$shape				= ! empty( $instance['shape'] ) ? $instance['shape'] : 'inherit';
			$color_scheme		= ! empty( $instance['color_scheme'] ) ? $instance['color_scheme'] : 'accent-light';
			$color_scheme_icon	= ! empty( $instance['color_scheme_icon'] ) ? $instance['color_scheme_icon'] : 'accent-light';

			$icon_arr = array();
			if ( function_exists( 'boldthemes_get_icon_fonts_bb_array' ) ) {
				$icon_arr = boldthemes_get_icon_fonts_bb_array();
			} else {
                if ( class_exists( 'BoldThemes_BB_Settings') ) {
					require_once( WP_PLUGIN_DIR . '/bold-page-builder/content_elements_misc/fa_icons.php' );
					require_once( WP_PLUGIN_DIR . '/bold-page-builder/content_elements_misc/s7_icons.php' );
					if ( function_exists( 'bt_bb_fa_icons' ) && function_exists( 'bt_bb_s7_icons' ) ) {
						$icon_arr = array( 'Font Awesome' => bt_bb_fa_icons(), 'S7' => bt_bb_s7_icons() );
					}
				}
			}
			
			require_once( WP_PLUGIN_DIR . '/bold-page-builder/content_elements_misc/misc.php' );
			$color_scheme_arr = bt_bb_get_color_scheme_param_array();

			$clear_display = $icon != '' ? 'block' : 'none';
			
			$icon_set = '';
			$icon_code = '';
			$icon_name = '';

			if ( $icon != '' ) {
				$icon_set = substr( $icon, 0, -5 );
				$icon_code = substr( $icon, -4 );
				$icon_code = '&#x' . $icon_code;
				foreach( $icon_arr as $k => $v ) {
					foreach( $v as $k_inner => $v_inner ) {
						if ( $icon == $v_inner ) {
							$icon_name = $k_inner;
						}
					}
				}
			}
                        
			?>
			<div class="bt_bb_iconpicker_widget_container">
				<label for="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>"><?php _e( 'Icon:', 'bt_plugin' ); ?></label>
				<div class="bt_bb_iconpicker">
					<input type="hidden" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon' ) ); ?>">
					<div class="bt_bb_iconpicker_select">
						<div class="bt_bb_icon_preview bt_bb_icon_preview_<?php echo $icon_set; ?>" data-icon="<?php echo $icon; ?>" data-icon-code="<?php echo $icon_code; ?>"></div>
						<div class="bt_bb_iconpicker_select_text"><?php echo $icon_name; ?></div>
						<i class="fa fa-close bt_bb_iconpicker_clear" style="display:<?php echo $clear_display; ?>"></i>
						<i class="fa fa-angle-down"></i>
					</div>
					<div class="bt_bb_iconpicker_filter_container">
						<input type="text" class="bt_bb_filter" placeholder="<?php _e( 'Filter...', 'bt_plugin' ); ?>">
					</div>
					<div class="bt_bb_iconpicker_icons">
						<?php
						$icon_content = '';
						foreach( $icon_arr as $k => $v ) {
							$icon_content .= '<div class="bt_bb_iconpicker_title">' . $k . '</div>';
							foreach( $v as $k_inner => $v_inner ) {
								$icon = $v_inner;
								$icon_set = substr( $icon, 0, -5 );
								$icon_code = substr( $icon, -4 );
								$icon_content .= '<div class="bt_bb_icon_preview bt_bb_icon_preview_' . $icon_set . '" data-icon="' . $icon . '" data-icon-code="&#x' . $icon_code . '" title="' . $k_inner . '"></div>';
							}
						}
						echo $icon_content;
						?>
					</div>
				</div>
			</div>
            <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'icon_position' ) ); ?>"><?php _e( 'Icon Position:', 'bt_plugin' ); ?></label> 
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon_position' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_position' ) ); ?>">
					<?php
					$icon_position_arr = array("Left" => "left", "Right" => "right");
					foreach( $icon_position_arr as $key => $value ) {
						if ( $value == $icon_position ) {
							echo '<option value="' . $value . '" selected>' . $key . '</option>';
						} else {
							echo '<option value="' . $value . '">' . $key . '</option>';
						}
					}
					?>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'color_scheme_icon' ) ); ?>"><?php _e( 'Icon Color Scheme:', 'bt_plugin' ); ?></label> 
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'color_scheme_icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'color_scheme_icon' ) ); ?>">
					<?php
					foreach( $color_scheme_arr as $key => $value ) {
						if ( $value == $color_scheme_icon ) {
							echo '<option value="' . $value . '" selected>' . $key . '</option>';
						} else {
							echo '<option value="' . $value . '">' . $key . '</option>';
						}
					}
					?>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'icon_size' ) ); ?>"><?php _e( 'Icon Size:', 'bt_plugin' ); ?></label> 
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_size' ) ); ?>">
					<?php
					$icon_size_arr = array("Normal" => "normal", "Larger" => "larger");
					foreach( $icon_size_arr as $key => $value ) {
						if ( $value == $icon_size ) {
							echo '<option value="' . $value . '" selected>' . $key . '</option>';
						} else {
							echo '<option value="' . $value . '">' . $key . '</option>';
						}
					}
					?>
				</select>
			</p>
            <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php _e( 'Text:', 'bt_plugin' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>"><?php _e( 'URL or slug:', 'bt_plugin' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>">
			</p>
                        <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php _e( 'Target:', 'bt_plugin' ); ?></label> 
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>">
					<?php
					$target_arr = array("Self" => "_self", "Blank" => "_blank", "Parent" => "_parent", "Top" => "_top");
					foreach( $target_arr as $key => $value ) {
						if ( $value == $target ) {
							echo '<option value="' . $value . '" selected>' . $key . '</option>';
						} else {
							echo '<option value="' . $value . '">' . $key . '</option>';
						}
					}
					?>
				</select>
			</p>
            <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>"><?php _e( 'Style:', 'bt_plugin' ); ?></label> 
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'style' ) ); ?>">
					<?php
					$style_arr = array("Outline" => "outline", "Filled" => "filled", "Clean" => "clean");
					foreach( $style_arr as $key => $value ) {
						if ( $value == $style ) {
							echo '<option value="' . $value . '" selected>' . $key . '</option>';
						} else {
							echo '<option value="' . $value . '">' . $key . '</option>';
						}
					}
					?>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php _e( 'Size:', 'bt_plugin' ); ?></label> 
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>">
					<?php
					$size_arr = array("Small" => "small", "Medium" => "medium", "Normal" => "normal", "Large" => "large");
					foreach( $size_arr as $key => $value ) {
						if ( $value == $size ) {
							echo '<option value="' . $value . '" selected>' . $key . '</option>';
						} else {
							echo '<option value="' . $value . '">' . $key . '</option>';
						}
					}
					?>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'shape' ) ); ?>"><?php _e( 'Shape:', 'bt_plugin' ); ?></label> 
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'shape' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'shape' ) ); ?>">
					<?php
					$shape_arr = array("Inherit" => "inherit", "Square" => "square", "Soft Rounded" => "soft_rounded", "Hard Rounded" => "hard_rounded", "Full Rounded" => "full_rounded");
					foreach( $shape_arr as $key => $value ) {
						if ( $value == $shape ) {
							echo '<option value="' . $value . '" selected>' . $key . '</option>';
						} else {
							echo '<option value="' . $value . '">' . $key . '</option>';
						}
					}
					?>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'color_scheme' ) ); ?>"><?php _e( 'Color scheme:', 'bt_plugin' ); ?></label> 
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'color_scheme' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'color_scheme' ) ); ?>">
					<?php
					foreach( $color_scheme_arr as $key => $value ) {
						if ( $value == $color_scheme ) {
							echo '<option value="' . $value . '" selected>' . $key . '</option>';
						} else {
							echo '<option value="' . $value . '">' . $key . '</option>';
						}
					}
					?>
				</select>
			</p>			
             <p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'css' ) ); ?>"><?php _e( 'CSS extra class:', 'bt_plugin' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'css' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'css' ) ); ?>" type="text" value="<?php echo esc_attr( $css ); ?>">
			</p>
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['icon']					= ( ! empty( $new_instance['icon'] ) ) ? strip_tags( $new_instance['icon'] ) : strip_tags( $old_instance['icon'] );
			$instance['icon_position']			= ( ! empty( $new_instance['icon_position'] ) ) ? strip_tags( $new_instance['icon_position'] ) : '';
			$instance['icon_size']				= ( ! empty( $new_instance['icon_size'] ) ) ? strip_tags( $new_instance['icon_size'] ) : '';
			$instance['text']					= ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';
			$instance['url']					= ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
			$instance['target']					= ( ! empty( $new_instance['target'] ) ) ? strip_tags( $new_instance['target'] ) : '';
			$instance['style']					= ( ! empty( $new_instance['style'] ) ) ? strip_tags( $new_instance['style'] ) : '';
			$instance['css']					= ( ! empty( $new_instance['css'] ) ) ? strip_tags( $new_instance['css'] ) : '';
			$instance['size']					= ( ! empty( $new_instance['size'] ) ) ? strip_tags( $new_instance['size'] ) : '';
			$instance['shape']					= ( ! empty( $new_instance['shape'] ) ) ? strip_tags( $new_instance['shape'] ) : '';
			$instance['color_scheme']			= ( ! empty( $new_instance['color_scheme'] ) ) ? strip_tags( $new_instance['color_scheme'] ) : '';
			$instance['color_scheme_icon']		= ( ! empty( $new_instance['color_scheme_icon'] ) ) ? strip_tags( $new_instance['color_scheme_icon'] ) : '';
			
			return $instance;
		}
		
	}
}