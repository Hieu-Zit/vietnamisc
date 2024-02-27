<?php

/**
 * Default header el class
 */
if ( ! function_exists( 'boldthemes_header_headline_el_class' ) ) {
	function boldthemes_header_headline_el_class( ) {
		return ''; 
	}
}
add_filter( 'boldthemes_header_headline_el_class', 'boldthemes_header_headline_el_class' );

/**
 * Default header el style
 */
if ( ! function_exists( 'boldthemes_header_headline_el_style' ) ) {
	function boldthemes_header_headline_el_style( ) {
		return ''; 
	}
}
add_filter( 'boldthemes_header_headline_el_style', 'boldthemes_header_headline_el_style' );

/**
 * Default header dash
 */
if ( ! function_exists( 'boldthemes_header_headline_dash' ) ) {
	function boldthemes_header_headline_dash(  ) {
		return 'bottom';
	}
}
add_filter( 'boldthemes_header_headline_dash', 'boldthemes_header_headline_dash' );

/**
 * Default header dash type
 */
if ( ! function_exists( 'boldthemes_header_headline_dash_type' ) ) {
	function boldthemes_header_headline_dash_type( $dash_type) {
		return ( $dash_type != '' ) ? "bt_bb_dash_type_" . $dash_type : 'bt_bb_dash_type_line'; 
	}
}
add_filter( 'boldthemes_header_headline_dash_type', 'boldthemes_header_headline_dash_type', 10, 1 );


/**
 * Product headline size
 */
if ( ! function_exists( 'boldthemes_product_list_headline_size' ) ) {
	function boldthemes_product_list_headline_size ( ) {
		return 'small';
	}
}
add_filter( 'boldthemes_product_list_headline_size', 'boldthemes_product_list_headline_size' );

/**
 * Header headline output
 */

if ( ! function_exists( 'boldthemes_header_headline' ) ) {
	function boldthemes_header_headline( $arg = array() ) {

		$extra_class = 'btPageHeadline';
		$el_style = apply_filters( 'boldthemes_header_headline_el_style', '' );
		$el_class = apply_filters( 'boldthemes_header_headline_el_class', '' );
		
		$dash  = '';
		$dash_type  = '';
		$use_dash = boldthemes_get_option( 'sidebar_use_dash' );
		if ( is_singular( 'post' ) ) {
			$use_dash = boldthemes_get_option( 'blog_use_dash' );
		} else if ( is_singular( 'product' ) ) {
			$use_dash = boldthemes_get_option( 'shop_use_dash' );
		}  else if ( is_singular( 'portfolio' ) ) {
			$use_dash = boldthemes_get_option( 'pf_use_dash' );
		} 
		if ( $use_dash ) {
			$dash  = apply_filters( 'boldthemes_header_headline_dash', 'top' );
			$el_class  .= ' ' . apply_filters( 'boldthemes_header_headline_dash_type', 'line' );
		}
		
		if ( is_front_page() ) {
			$title = get_bloginfo( 'description' );
		} else if ( is_singular() ) {
			$title = get_the_title();
		} else {
			$title = wp_title( '', false );
		}
		
		$excerpt = '';
		
		if ( BoldThemesFramework::$page_for_header_id != '' ) {
			$feat_image = wp_get_attachment_url( get_post_thumbnail_id( BoldThemesFramework::$page_for_header_id ) );
			
			$excerpt = boldthemes_get_the_excerpt( BoldThemesFramework::$page_for_header_id );
			if ( ! $feat_image ) {
				if ( is_singular() && ! is_singular( 'product' ) ) {
					$feat_image = wp_get_attachment_url( get_post_thumbnail_id() );
				} else {
					$feat_image = false;
				}
			}
		} else {
			if ( is_singular() ) {
				$feat_image = wp_get_attachment_url( get_post_thumbnail_id() );
			} else {
				$feat_image = false;
			}
			if ( is_singular() ) {
				$excerpt = boldthemes_get_the_excerpt( get_the_ID() );
			}
		}
		
		$parallax = isset( $arg['parallax'] ) ? $arg['parallax'] : apply_filters( 'boldthemes_header_headline_parallax', '0.8' );
		$parallax_class = 'bt_bb_parallax';
		if ( wp_is_mobile() ) {
			$parallax = 0;
			$parallax_class = '';
		}
		
		$supertitle = '';
		$subtitle = $excerpt;
		
		$breadcrumbs = isset( $arg['breadcrumbs'] ) ? $arg['breadcrumbs'] : true;
		
		if ( $breadcrumbs ) {
			$heading_args = boldthemes_breadcrumbs( false, $title, $subtitle );
			$supertitle = $heading_args['supertitle'];
			$title = $heading_args['title'];
			$subtitle = $heading_args['subtitle'];
		}
		
		if ( $title != '' || $supertitle != '' || $subtitle != '' ) {
			$extra_class .= $feat_image ? ' bt_bb_background_image ' . apply_filters( 'boldthemes_header_headline_gradient', 'bt_bb_background_overlay_dark_solid' ) . ' ' . $parallax_class . ' ' . apply_filters( 'boldthemes_header_headline_skin', 'btDarkSkin' ) . ' ' : ' ';
			echo '<section class="bt_bb_section gutter bt_bb_vertical_align_top ' . esc_attr( $extra_class ) . '" style="background-image:url(' . esc_url( $feat_image ) . ')" data-parallax="' . esc_attr( $parallax ) . '" data-parallax-offset="-250">';
				echo '<div class="bt_bb_port port">';
					echo '<div class="bt_bb_cell bt_bb_align_center">';
						echo '<div class="bt_bb_cell_inner">';
							echo '<div class = "bt_bb_row">';
								echo '<div class="bt_bb_column">';
									echo '<div class="bt_bb_column_content">';
										echo wp_kses_post( boldthemes_get_heading_html( 
											array(
												'superheadline' => $supertitle,
												'headline' => $title,
												'subheadline' => $subtitle,
												'html_tag' => "h1",
												'size' => apply_filters( 'boldthemes_header_headline_size', 'large' ),
												'dash' => $dash,
												'el_style' => $el_style,
												'el_class' => $el_class
											)
										) );
										echo '</div><!-- /rowItemContent -->' ;
									echo '</div><!-- /rowItem -->';
							echo '</div><!-- /boldRow -->';
						echo '</div><!-- boldCellInner -->';	
					echo '</div><!-- boldCell -->';			
				echo '</div><!-- port -->';
			echo '</section>';
		}
		
	}
}

/**
 * Returns custom header class
 *
 * @return string
 */
if ( ! function_exists( 'boldthemes_get_body_class' ) ) {
	function boldthemes_get_body_class( $extra_class ) {
		
		if ( boldthemes_get_option( 'alt_logo' ) ) {
			$extra_class[] = 'btHasAltLogo';
		}
		
		if ( boldthemes_get_option( 'menu_font_size' ) ) {
			$menu_font_size = boldthemes_get_option( 'menu_font_size' );
			$extra_class[]  = 'btMenuFontSize' . $menu_font_size;
		}
		
		if ( boldthemes_get_option( 'headline_text_letter_spacing' ) ) {
			$headline_text_letter_spacing = boldthemes_get_option( 'headline_text_letter_spacing' );
			$extra_class[]  = 'btHeaderLetterSpacing' . $headline_text_letter_spacing;
		}
		
		if ( boldthemes_get_option( 'shop_product_columns' ) ) {
			$extra_class[]  = 'btProductColumns' . boldthemes_get_option( 'shop_product_columns' );
		}
		
		if ( boldthemes_get_option( 'blog_grid_gallery_gap' ) ) {
			$extra_class[]  = 'btBlogGridGalleryGap' . boldthemes_convert_param_to_camel_case( boldthemes_get_option( 'blog_grid_gallery_gap' ) );
		}
		
		if ( boldthemes_get_option( 'pf_grid_gallery_gap' ) ) {
			$extra_class[]  = 'btPortfolioGridGalleryGap' . boldthemes_convert_param_to_camel_case( boldthemes_get_option( 'pf_grid_gallery_gap' ) );
		}
		
		if ( boldthemes_get_option( 'boxed_menu_width' ) ) {
			$extra_class[]  = 'btBoxedMenuWidth' . boldthemes_get_option( 'boxed_menu_width' );
		}
		
		$show_logo_and_logo_widgets = false;
		$menu_type = boldthemes_get_option( 'menu_type' );
		if ( $menu_type == 'horizontal-center' ) {
			$extra_class[] = 'btMenuCenterEnabled'; 
		} else if ( $menu_type == 'horizontal-left' ) {
			$extra_class[] = 'btMenuLeftEnabled';
		}  else if ( $menu_type == 'horizontal-right' ) {
			$extra_class[] = 'btMenuRightEnabled';
		} else if ( $menu_type == 'horizontal-below-left' ) {
			$extra_class[] = 'btMenuLeftEnabled';
			$extra_class[] = 'btMenuBelowLogo';
			$show_logo_and_logo_widgets = true;
		} else if ( $menu_type == 'horizontal-below-center' ) {
			$extra_class[] = 'btMenuCenterBelowEnabled';
			$extra_class[] = 'btMenuBelowLogo';
			$show_logo_and_logo_widgets = true;
		} else if ( $menu_type == 'horizontal-below-right' ) {
			$extra_class[] = 'btMenuRightEnabled';
			$extra_class[] = 'btMenuBelowLogo';
			$show_logo_and_logo_widgets = true;
		} else if ( $menu_type == 'vertical-left' ) {
			$extra_class[] = 'btMenuVerticalLeftEnabled';
		} else if ( $menu_type == 'vertical-right' ) {
			$extra_class[] = 'btMenuVerticalRightEnabled';
		} else if ( $menu_type == 'fullscreen-center' ) {
			$extra_class[] = 'btMenuFullScreenCenter';
		} else if ( $menu_type == 'vertical-fullscreen' ) {
			$extra_class[] = 'btMenuVerticalFullscreenEnabled';
		} else {
			$extra_class[] = 'btMenuRightEnabled';
		}

		if ( boldthemes_get_option( 'sticky_header' ) ) {
			$extra_class[] = 'btStickyEnabled';
		}

		if ( boldthemes_get_option( 'hide_menu' ) ) {
			$extra_class[] = 'btHideMenu';
		}

		if ( boldthemes_get_option( 'hide_headline' ) || boldthemes_get_option( 'hide_headline' ) == 'hide' ) {
			$extra_class[] = 'btHideHeadline';
		}

		$template_skin = boldthemes_get_option( 'template_skin' );
		if ( $template_skin == '' ) $template_skin = 'light';
		if ( $template_skin != '' ) {
			$extra_class[] = 'bt' . boldthemes_convert_param_to_camel_case( $template_skin ) . 'Skin';
		}

		if ( boldthemes_get_option( 'below_menu' ) ) {
			$extra_class[] = 'btBelowMenu';
		}

		if ( ! boldthemes_get_option( 'sidebar_use_dash' ) ) {
			$extra_class[] = 'btNoDashInSidebar';
		}

		if ( boldthemes_get_option( 'disable_preloader' ) ) {
			$extra_class[] = 'noBodyPreloader';
		} else {
			$extra_class[] = 'bodyPreloader'; 
		}
		
		$buttons_shape = boldthemes_get_option( 'buttons_shape' );
		if ( $buttons_shape != '' ) {
			$extra_class[] = 'bt' . boldthemes_convert_param_to_camel_case( $buttons_shape ) . 'Buttons';
		}
		
		$header_style = boldthemes_get_option( 'header_style' );
		if ( $header_style != '' ) {
			$extra_class[] =  'bt' . boldthemes_convert_param_to_camel_case( $header_style ) . 'Header';
		} else {
			$extra_class[] =  'btTransparentDarkHeader';
		}
		
		if ( boldthemes_get_option( 'page_width' ) != 'no_change' ) {
			if ( boldthemes_get_option( 'page_width' ) == 'boxed' ) {
				$extra_class[] = 'btBoxedPage';
			}else{
				$extra_class[] = 'btBoxedPage' . boldthemes_convert_param_to_camel_case(  boldthemes_get_option( 'page_width' ) );
			}
		}
		
		if ( boldthemes_get_option( 'headline_style' ) ) {
			$headline_style = boldthemes_convert_param_to_camel_case( boldthemes_get_option( 'headline_style' ) );
			$extra_class[]  = 'btHeadlineStyle' . $headline_style;
		}
		
		if ( boldthemes_get_option( 'subsuper_headline_style' ) ) {
			$subsuper_headline_style = boldthemes_convert_param_to_camel_case( boldthemes_get_option( 'subsuper_headline_style' ) );
			$extra_class[]  = 'btSubSuperHeadlineStyle' . $subsuper_headline_style;
		}

		BoldThemesFramework::$sidebar = boldthemes_get_option( 'sidebar' );
		
		global $wp_registered_sidebars;
		$widget_areas = array_keys( $wp_registered_sidebars );
	

		if ( ! ( ( BoldThemesFramework::$sidebar == 'left' || BoldThemesFramework::$sidebar == 'right' ) && ! is_404() )
			|| 
			( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_checkout() || is_cart() ) && in_array( 'bt_shop_sidebar', $widget_areas ) && ! is_active_sidebar( 'bt_shop_sidebar' ) )
			||
			( ( ! function_exists( 'is_woocommerce' ) || ! ( is_woocommerce() || is_checkout() || is_cart() ) )  && ! is_active_sidebar( 'primary_widget_area' ) )
			) {
			BoldThemesFramework::$has_sidebar = false;
			$extra_class[] = 'btNoSidebar';
		} else {
			BoldThemesFramework::$has_sidebar = true;
			if ( BoldThemesFramework::$sidebar == 'left' ) {
				$extra_class[] = 'btWithSidebar btSidebarLeft';
			} else {
				$extra_class[] = 'btWithSidebar btSidebarRight';
			}
		}		
		
		$animations = boldthemes_rwmb_meta( BoldThemesFramework::$pfx . '_animations' );
		if ( $animations == 'half_page' ) {
			$extra_class[] = 'btHalfPage';
		}
		
		if ( boldthemes_get_option( 'sticky_header' ) && $show_logo_and_logo_widgets && boldthemes_get_option( 'show_logo_and_logo_widgets' ) ) {
			$extra_class[] = 'btMenuBelowLogoShowArea';
		}
		
		if ( boldthemes_get_option( 'page_background_color' ) ) {
			$extra_class[] = 'btPageBackgroundColor_' . boldthemes_get_option( 'page_background_color' );
		}
		
		$page_headline_style = boldthemes_get_option( 'page_headline_style' );
		if ( $page_headline_style != '' ) {
			$extra_class[] =  'btPageHeadline' . boldthemes_convert_param_to_camel_case( $page_headline_style );
		} else {
			$extra_class[] =  'btPageHeadlineTransparentDark';
		}
		
		if ( boldthemes_get_option( 'accent_button_dark_text' ) ) {
			$extra_class[] = 'btAccentButtonDarkText';
		}
		
		$extra_class = apply_filters( 'boldthemes_extra_class', $extra_class );
		
		return $extra_class;
	}
}

require_once( get_template_directory() . '/php/before_framework/functions.php' );
require_once( get_template_directory() . '/php/before_framework/customize_params.php' );