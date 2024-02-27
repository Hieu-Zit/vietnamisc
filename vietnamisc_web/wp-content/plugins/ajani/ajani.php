<?php

/**
 * Plugin Name: Ajani Plugin
 * Description: Shortcodes and widgets by BoldThemes.
 * Version: 1.1.5
 * Author: BoldThemes
 * Author URI: http://bold-themes.com
 * Text Domain: bt_plugin 
 */

require_once( 'framework_bt_plugin/framework.php' );

$bt_plugin_dir = plugin_dir_path( __FILE__ );

if ( ! function_exists( 'bt_load_plugin_textdomain' ) ) {
	function bt_load_plugin_textdomain() {

		$domain = 'bt_plugin';
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_plugin_textdomain( $domain, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

	}
}
add_action( 'plugins_loaded', 'bt_load_plugin_textdomain' );

if ( ! function_exists( 'bt_widget_areas' ) ) {
	function bt_widget_areas() {
		register_sidebar( array (
			'name' 			=> esc_html__( 'Header Left Widgets', 'bt_plugin' ),
			'id' 			=> 'header_left_widgets',
			'before_widget' => '<div class="btTopBox %2$s">', 
			'after_widget' 	=> '</div>'
		));
		register_sidebar( array (
			'name' 			=> esc_html__( 'Header Right Widgets', 'bt_plugin' ),
			'id' 			=> 'header_right_widgets',
			'before_widget' => '<div class="btTopBox %2$s">',
			'after_widget' 	=> '</div>'
		));
		register_sidebar( array (
			'name' 			=> esc_html__( 'Header Menu Widgets', 'bt_plugin' ),
			'id' 			=> 'header_menu_widgets',
			'before_widget' => '<div class="btTopBox %2$s">',
			'after_widget' 	=> '</div>'
		));
		register_sidebar( array (
			'name' 			=> esc_html__( 'Header Logo Widgets', 'bt_plugin' ),
			'id' 			=> 'header_logo_widgets',
			'before_widget' => '<div class="btTopBox %2$s">',
			'after_widget' 	=> '</div>'
		));
		register_sidebar( array (
			'name' 			=> esc_html__( 'Footer Widgets', 'bt_plugin' ),
			'id' 			=> 'footer_widgets',
			'before_widget' => '<div class="btBox %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h4><span>',
			'after_title' 	=> '</span></h4>',
		));
	}
}
add_action( 'widgets_init', 'bt_widget_areas', 30 );

/* Portfolio */

if ( ! function_exists( 'bt_create_portfolio' ) ) {
	function bt_create_portfolio() {
		register_post_type( 'portfolio',
			array(
				'labels' => array(
					'name'          => __( 'Portfolio', 'bt_plugin' ),
					'singular_name' => __( 'Portfolio Item', 'bt_plugin' )
				),
				'public'        => true,
				'has_archive'   => true,
				'menu_position' => 5,
				'supports'      => array( 'title', 'editor', 'thumbnail', 'author', 'comments', 'excerpt' ),
				'rewrite'       => array( 'with_front' => false, 'slug' => 'portfolio' )
			)
		);
		register_taxonomy( 'portfolio_category', 'portfolio', array( 'hierarchical' => true, 'label' => __( 'Portfolio Categories', 'bt_plugin' ) ) );
	}
}
add_action( 'init', 'bt_create_portfolio' );

if ( ! function_exists( 'bt_get_url' ) ) {
	function bt_get_url( $link, $post_type = 'page' ) {
		if ( substr( $link, 0, 4 ) == 'www.' ) {
			return 'http://' . $link;
		}
		return bt_get_permalink_by_slug( $link, $post_type );
	}
}

if ( ! function_exists( 'bt_get_permalink_by_slug' ) ) {
	function bt_get_permalink_by_slug( $link, $post_type = 'page' ) {
		if ( 
			$link != '' && 
			$link != '#' && 
			substr( $link, 0, 5 ) != 'http:' && 
			substr( $link, 0, 6 ) != 'https:' && 
			substr( $link, 0, 7 ) != 'mailto:' && 
			substr( $link, 0, 4 ) != 'tel:' 
		) {
			global $wpdb;
			$page = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type= %s", $link, $post_type ) );
			if ( $page ) {
				return get_permalink( $page );
			}
		}
		return $link;
	}
}

if ( ! function_exists( 'bt_get_items_list' ) ) {
	function bt_get_items_list( $items, $icon_html = '' ) {
		$output = '';
		if ( $items != '' ) {                    
			if ( base64_encode(base64_decode($items, true)) === $items){
				$items = base64_decode( $items );
			}
                        
			$items_arr = preg_split( '/$\R?^/m', $items );

			$output .= '<ul>';
				foreach ( $items_arr as $item ) {
					$output .= '<li>' . $icon_html . $item . '</li>';
				}
			$output .= '</ul>';
		
		}
		return $output;
	}
}

if ( ! function_exists( 'bt_rewrite_flush' ) ) {
	function bt_rewrite_flush() {
		// First, we "add" the custom post type via the above written function.
		// Note: "add" is written with quotes, as CPTs don't get added to the DB,
		// They are only referenced in the post_type column with a post entry, 
		// when you add a post of this CPT.
		bt_create_portfolio();

		// ATTENTION: This is *only* done during plugin activation hook in this example!
		// You should *NEVER EVER* do this on every page load!!
		flush_rewrite_rules();
	}
}
register_activation_hook( __FILE__, 'bt_rewrite_flush' );

/**
 * Back To Top, shortcode - [bt_back_to_top back_to_top ="true" back_to_top_text="value"]
 */
if ( ! function_exists( 'bt_back_to_top' ) ) {
	function bt_back_to_top() {
		if ( boldthemes_get_option( 'back_to_top' ) ) {
			$back_to_top_html = do_shortcode( '[bt_back_to_top back_to_top="'. boldthemes_get_option( 'back_to_top' ).'" back_to_top_text="' . boldthemes_get_option( 'back_to_top_text' ) .  '" back_to_top_style="' . boldthemes_get_option( 'back_to_top_style' ) .  '"]' );
			echo $back_to_top_html;			
		}
	}
}

add_filter( 'safe_style_css', function( $styles ) {
    $styles[] = 'display';
	return $styles;
} );

require_once( 'widgets/widgets.php' );
require_once( 'shortcodes/shortcodes.php' );