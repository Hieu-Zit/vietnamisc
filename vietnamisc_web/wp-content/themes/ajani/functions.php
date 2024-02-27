<?php

// Register action/filter callbacks

add_action( 'after_setup_theme', 'ajani_register_menus' );
add_action( 'wp_enqueue_scripts', 'ajani_enqueue_scripts_styles' );
add_action( 'tgmpa_register', 'ajani_register_plugins' );
add_action( 'wp_enqueue_scripts', 'ajani_load_fonts' );
add_action( 'admin_init', 'ajani_theme_add_editor_styles' );
add_action( 'admin_enqueue_scripts', 'ajani_load_fonts' );
add_action( 'admin_enqueue_scripts', 'ajani_load_admin_style' );

add_action( 'widgets_init', 'ajani_widget_area' );

add_filter( 'bt_bb_color_scheme_arr', 'ajani_color_schemes' );

add_filter( 'body_class', 'ajani_body_class' );

add_filter( 'tiny_mce_before_init', 'ajani_editor_dynamic_styles' );

add_theme_support( 'customize-selective-refresh-widgets' );

// callbacks

/**
 * Register navigation menus
 */
if ( ! function_exists( 'ajani_register_menus' ) ) {
	function ajani_register_menus() {
		register_nav_menus( array (
			'primary' => esc_html__( 'Primary Menu', 'ajani' ),
			'footer'  => esc_html__( 'Footer Menu', 'ajani' )
		));
	}
}

/**
 * Enqueue scripts and styles
 */
if ( ! function_exists( 'ajani_enqueue_scripts_styles' ) ) {
	function ajani_enqueue_scripts_styles() {
		
		BoldThemesFramework::$crush_vars_def = array( 'accentColor', 'alternateColor', 'bodyFont', 'menuFont', 'headingFont', 'headingSuperTitleFont', 'headingSubTitleFont', 'buttonFont', 'logoHeight' );
		
		// Custom accent color and font style
		$boldthemes_add_override_css = false;		
		
		$accent_color = boldthemes_get_option( 'accent_color' );
		$alternate_color = boldthemes_get_option( 'alternate_color' );
		$body_font = urldecode( boldthemes_get_option( 'body_font' ) );
		$menu_font = urldecode( boldthemes_get_option( 'menu_font' ) );
		$heading_font = urldecode( boldthemes_get_option( 'heading_font' ) );
		$heading_supertitle_font = urldecode( boldthemes_get_option( 'heading_supertitle_font' ) );
		$heading_subtitle_font = urldecode( boldthemes_get_option( 'heading_subtitle_font' ) );
		$button_font = urldecode( boldthemes_get_option( 'button_font' ) );
		$logo_height = urldecode( boldthemes_get_option( 'logo_height' ) );

		if ( $accent_color != '' ) {
			BoldThemesFramework::$crush_vars['accentColor'] = $accent_color;
			if ( $accent_color != BoldThemes_Customize_Default::$data['accent_color'] ) {
				$boldthemes_add_override_css = true;
			}
		}

		if ( $alternate_color != '' ) {
			BoldThemesFramework::$crush_vars['alternateColor'] = $alternate_color;
			if ( $alternate_color != BoldThemes_Customize_Default::$data['alternate_color'] ) {
				$boldthemes_add_override_css = true;
			}
		}
		if ( $body_font != '' ) {
			if ( $body_font == 'no_change' ) {
				$body_font = BoldThemes_Customize_Default::$data['body_font'];
			}
			BoldThemesFramework::$crush_vars['bodyFont'] = $body_font;
			if ( $body_font != BoldThemes_Customize_Default::$data['body_font'] ) {
				$boldthemes_add_override_css = true;
			}
		}

		if ( $menu_font != '' ) {
			if ( $menu_font == 'no_change' ) {
				$menu_font = BoldThemes_Customize_Default::$data['menu_font'];
			}
			BoldThemesFramework::$crush_vars['menuFont'] = $menu_font;
			if ( $menu_font != BoldThemes_Customize_Default::$data['menu_font'] ) {
				$boldthemes_add_override_css = true;
			}
		}
		
		if ( $heading_font != '' ) {
			if ( $heading_font == 'no_change' ) {
				$heading_font = BoldThemes_Customize_Default::$data['heading_font'];
			}
			BoldThemesFramework::$crush_vars['headingFont'] = $heading_font;
			if ( $heading_font != BoldThemes_Customize_Default::$data['heading_font'] ) {
				$boldthemes_add_override_css = true;
			}
		}

		if ( $heading_supertitle_font != '' ) {
			if ( $heading_supertitle_font == 'no_change' ) {
				$heading_supertitle_font = BoldThemes_Customize_Default::$data['heading_supertitle_font'];
			}
			BoldThemesFramework::$crush_vars['headingSuperTitleFont'] = $heading_supertitle_font;
			if ( $heading_supertitle_font != BoldThemes_Customize_Default::$data['heading_supertitle_font'] ) {
				$boldthemes_add_override_css = true;
			}
		}

		if ( $heading_subtitle_font != '' ) {
			if ( $heading_subtitle_font == 'no_change' ) {
				$heading_subtitle_font = BoldThemes_Customize_Default::$data['heading_subtitle_font'];
			}
			BoldThemesFramework::$crush_vars['headingSubTitleFont'] = $heading_subtitle_font;
			if ( $heading_subtitle_font != BoldThemes_Customize_Default::$data['heading_subtitle_font'] ) {
				$boldthemes_add_override_css = true;
			}
		}
		
		if ( $button_font != '' ) {
			if ( $button_font == 'no_change' ) {
				$button_font = BoldThemes_Customize_Default::$data['button_font'];
			}
			BoldThemesFramework::$crush_vars['buttonFont'] = $button_font;
			if ( $button_font != BoldThemes_Customize_Default::$data['button_font'] ) {
				$boldthemes_add_override_css = true;
			}
		}
		
		if ( $logo_height != '' ) {
			BoldThemesFramework::$crush_vars['logoHeight'] = $logo_height;
			if ( $logo_height != BoldThemes_Customize_Default::$data['logo_height'] ) {
				$boldthemes_add_override_css = true;
			}
		}
		
		// Create override file without local settings

		if ( function_exists( 'boldthemes_csscrush_file' ) ) {
			boldthemes_csscrush_file( get_theme_file_path( 'style.crush.css' ), array( 'source_map' => true, 'minify' => false, 'output_file' => 'style', 'formatter' => 'block', 'boilerplate' => false, 'vars' => BoldThemesFramework::$crush_vars, 'plugins' => array( 'loop', 'ease' ), 'vendor_target' => 'all' ) );
		}

		// custom theme css
		wp_enqueue_style( 'ajani-style', get_parent_theme_file_uri( 'style.css' ), array(), false, 'screen' );
		wp_enqueue_style( 'ajani-print', get_parent_theme_file_uri( 'print.css' ), array(), false, 'print' );

		// external js
		wp_enqueue_script( 'fancySelect', get_parent_theme_file_uri( 'framework/js/fancySelect.js' ), array( 'jquery' ), '', true );

		// custom theme js
		wp_enqueue_script( 'ajani-header-misc', get_parent_theme_file_uri( 'framework/js/header.misc.js' ), array( 'jquery' ), '', true );
		wp_enqueue_script( 'ajani-misc', get_parent_theme_file_uri( 'framework/js/misc.js' ), array( 'jquery' ), '', true );
		
		wp_enqueue_script( 'ajani-slider-count-items', get_parent_theme_file_uri( 'bold-page-builder/content_elements_misc/js/bt_bb_slider_count_items.js' ), array( 'jquery' ), '', true );
		
		wp_add_inline_script( 'ajani-header-misc', boldthemes_set_global_uri(), 'before' );
		
		if ( file_exists( get_parent_theme_file_path( 'css-override.php' ) ) && $boldthemes_add_override_css ) {
			require_once( get_parent_theme_file_path( 'css-override.php' ) );
			wp_add_inline_style( 'ajani-style', $css_override );
		}
		
		if ( file_exists( get_parent_theme_file_path( 'icons.php' ) ) ) {
			require_once( get_parent_theme_file_path( 'icons.php' ) );
			wp_add_inline_style( 'ajani-style', $icons );
		}

		if ( boldthemes_get_option( 'custom_js' ) != '' ) {
			wp_add_inline_script( 'ajani-misc', boldthemes_get_option( 'custom_js' ) );
		}
		
		if ( file_exists( get_parent_theme_file_path( '/php/style.php' ) ) ) {
			require_once( get_parent_theme_file_path( '/php/style.php' ) );
			wp_add_inline_style( 'ajani-style', $prev_next_style_css );
		}
		
	}
}

/**
 * Register the required plugins for this theme
 */
if ( ! function_exists( 'ajani_register_plugins' ) ) {
	function ajani_register_plugins() {

		$plugins = array(
	 
			array(
				'name'               => esc_html__( 'Ajani', 'ajani' ), // The plugin name.
				'slug'               => 'ajani', // The plugin slug (typically the folder name).
				'source'             => get_parent_theme_file_path( 'plugins/ajani.zip' ), // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '1.1.5', ///!do not change this comment! E.g. 1.0.0. If set, the active plugin must be this version or higher.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			),
			array(
				'name'               => esc_html__( 'Cost Calculator', 'ajani' ), // The plugin name.
				'slug'               => 'bt' . '_cost_calculator', // The plugin slug (typically the folder name).
				'source'             => get_parent_theme_file_path( 'plugins/' . 'bt' . '_cost_calculator.zip' ), // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '2.2.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			),
			array(
				'name'               => esc_html__( 'Bold Timeline Lite', 'ajani' ), // The plugin name.
				'slug'               => 'bold-timeline-lite', // The plugin slug (typically the folder name).
				'required'           => false, // If false, the plugin is only 'recommended' instead of required.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			),
			array(
				'name'               => esc_html__( 'Bold Builder', 'ajani' ), // The plugin name.
				'slug'               => 'bold-page-builder', // The plugin slug (typically the folder name).
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			),
			array(
				'name'               => esc_html__( 'BoldThemes WordPress Importer', 'ajani' ), // The plugin name.
				'slug'               => 'bt' . '_wordpress_importer', // The plugin slug (typically the folder name).
				'source'             => get_parent_theme_file_path( 'plugins/' . 'bt' . '_wordpress_importer.zip' ), // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '2.7.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			),
			array(
				'name'               => esc_html__( 'Meta Box', 'ajani' ), // The plugin name.
				'slug'               => 'meta-box', // The plugin slug (typically the folder name).
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			),
			array(
				'name'               => esc_html__( 'Contact Form 7', 'ajani' ), // The plugin name.
				'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			),
			array(
				'name'               => esc_html__( 'Lightweight Sidebar Manager', 'ajani' ), // The plugin name.
				'slug'               => 'sidebar-manager', // The plugin slug (typically the folder name).
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			)
		);
	 
		$config = array(
			'default_path' => '',                      // Default absolute path to pre-packaged plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
			'strings'      => array(
				'page_title'                      => esc_html__( 'Install Required Plugins', 'ajani' ),
				'menu_title'                      => esc_html__( 'Install Plugins', 'ajani' ),
				'installing'                      => esc_html__( 'Installing Plugin: %s', 'ajani' ), // %s = plugin name.
				'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'ajani' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'ajani' ), // %1$s = plugin name(s).
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'ajani' ), // %1$s = plugin name(s).
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'ajani' ), // %1$s = plugin name(s).
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'ajani' ), // %1$s = plugin name(s).
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'ajani' ), // %1$s = plugin name(s).
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'ajani' ), // %1$s = plugin name(s).
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'ajani' ), // %1$s = plugin name(s).
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'ajani' ), // %1$s = plugin name(s).
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'ajani' ),
				'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'ajani' ),
				'return'                          => esc_html__( 'Return to Required Plugins Installer', 'ajani' ),
				'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'ajani' ),
				'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'ajani' ), // %s = dashboard link.
				'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
			)
		);
	 
		tgmpa( $plugins, $config );
	 
	}
}

/**
 * Loads custom Google Fonts
 */
if ( ! function_exists( 'ajani_load_fonts' ) ) {
	function ajani_load_fonts() {
		$body_font = boldthemes_custom_font( urldecode( boldthemes_get_option( 'body_font' ) ) );
		$heading_font = boldthemes_custom_font( urldecode( boldthemes_get_option( 'heading_font' ) ) );
		$menu_font = boldthemes_custom_font( urldecode( boldthemes_get_option( 'menu_font' ) ) );
		$heading_subtitle_font = boldthemes_custom_font( urldecode( boldthemes_get_option( 'heading_subtitle_font' ) ) );
		$heading_supertitle_font = boldthemes_custom_font( urldecode( boldthemes_get_option( 'heading_supertitle_font' ) ) );
		$button_font = urldecode( boldthemes_get_option( 'button_font' ) );
		
		$font_families = array();
		
		if ( $body_font != '' ) {
			if ( $body_font == 'no_change' ) {
				$body_font = BoldThemes_Customize_Default::$data['body_font'];
			}
			$font_families[] = $body_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
		} else {
			/*
			Translators: If there are characters in your language that are not supported
			by chosen font(s), translate this to 'off'. Do not translate into your own language.
			 */
			if ( 'off' !== _x( 'on', 'Lato font: on or off', 'ajani' ) ) {
				$font_families[] = 'Lato' . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			}
		}
		
		if ( $heading_font != '' ) {
			if ( $heading_font == 'no_change' ) {
				$heading_font = BoldThemes_Customize_Default::$data['heading_font'];
			}
			$font_families[] = $heading_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
		} else {
			/*
			Translators: If there are characters in your language that are not supported
			by chosen font(s), translate this to 'off'. Do not translate into your own language.
			 */
			if ( 'off' !== _x( 'on', 'Lato font: on or off', 'ajani' ) ) {
				$font_families[] = 'Lato' . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			}
		}
		
		if ( $menu_font != '' ) {
			if ( $menu_font == 'no_change' ) {
				$menu_font = BoldThemes_Customize_Default::$data['menu_font'];
			}
			$font_families[] = $menu_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
		} else {
			/*
			Translators: If there are characters in your language that are not supported
			by chosen font(s), translate this to 'off'. Do not translate into your own language.
			 */
			if ( 'off' !== _x( 'on', 'Lato font: on or off', 'ajani' ) ) {
				$font_families[] = 'Lato' . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			}
		}

		if ( $heading_subtitle_font != '' ) {
			if ( $heading_subtitle_font == 'no_change' ) {
				$heading_subtitle_font = BoldThemes_Customize_Default::$data['heading_subtitle_font'];
			}
			$font_families[] = $heading_subtitle_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
		} else {
			/*
			Translators: If there are characters in your language that are not supported
			by chosen font(s), translate this to 'off'. Do not translate into your own language.
			 */
			if ( 'off' !== _x( 'on', 'Lato font: on or off', 'ajani' ) ) {
				$font_families[] = 'Lato' . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			}
		}

		if ( $heading_supertitle_font != '' ) {
			if ( $heading_supertitle_font == 'no_change' ) {
				$heading_supertitle_font = BoldThemes_Customize_Default::$data['heading_supertitle_font'];
			}
			$font_families[] = $heading_supertitle_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
		} else {
			/*
			Translators: If there are characters in your language that are not supported
			by chosen font(s), translate this to 'off'. Do not translate into your own language.
			 */
			if ( 'off' !== _x( 'on', 'Lato font: on or off', 'ajani' ) ) {
				$font_families[] = 'Lato' . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			}
		}
		
		if ( $button_font != '' ) {
			if ( $button_font == 'no_change' ) {
				$button_font = BoldThemes_Customize_Default::$data['button_font'];
			}
			$font_families[] = $button_font . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
		} else {
			/*
			Translators: If there are characters in your language that are not supported
			by chosen font(s), translate this to 'off'. Do not translate into your own language.
			 */
			if ( 'off' !== _x( 'on', 'Lato font: on or off', 'ajani' ) ) {
				$font_families[] = 'Lato' . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			}
		}

		if ( count( $font_families ) > 0 ) {
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);
			$font_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
			wp_enqueue_style( 'ajani-fonts', $font_url, array(), '1.0.0' );
			add_editor_style( $font_url );
		}
	}
}

if ( ! function_exists( 'ajani_load_admin_style' ) ) {
	function ajani_load_admin_style() {
		if ( function_exists( 'boldthemes_csscrush_file' ) ) {
			boldthemes_csscrush_file( get_theme_file_path( 'admin-style.crush.css' ), array( 'source_map' => true, 'minify' => false, 'output_file' => 'admin-style', 'formatter' => 'block', 'boilerplate' => false, 'vars' => BoldThemesFramework::$crush_vars, 'plugins' => array( 'loop', 'ease' ) ) );
		}
		wp_enqueue_style( 'ajani-admin-style', get_parent_theme_file_uri( 'admin-style.css' ) );
		require_once( get_parent_theme_file_path( 'admin-style.php' ) );
		wp_add_inline_style( 'ajani-admin-style', $admin_style );
	}
}

/**
 * TinyMCE style
 */
if ( ! function_exists( 'ajani_theme_add_editor_styles' ) ) {
	function ajani_theme_add_editor_styles() {
	    add_editor_style( 'admin-style.css' );
	}
}

/**
 * Add FontAwesome to TinyMCE editor
 */
if ( ! function_exists( 'ajani_editor_dynamic_styles' ) ) {
	function ajani_editor_dynamic_styles( $mceInit ) {
	    $styles = '@font-face{font-family:\"FontAwesome\";src:url(\"' . get_parent_theme_file_uri( 'fonts/FontAwesome/FontAwesome.woff' ) . '\") format(\"woff\"),url(\"' . get_parent_theme_file_uri( 'fonts/FontAwesome/FontAwesome.ttf' ) . '\") format(\"truetype\");}';
	    if ( isset( $mceInit['content_style'] ) ) {
	        $mceInit['content_style'] .= ' ' . ( $styles ) . ' ';
	    } else {
	        $mceInit['content_style'] = $styles . ' ';
	    }
	    return $mceInit;
	}
}

/**
 * Add class to body
 *
 * @return string 
 */
if ( ! function_exists( 'ajani_body_class' ) ) {
	function ajani_body_class( $extra_class ) {
		if ( boldthemes_get_option( 'heading_style' ) ) {
			$extra_class[] =  'btHeadingStyle_' . boldthemes_get_option( 'heading_style' );
		}
		return $extra_class;
	}
}

/**
 * Shop sidebar
 */
if ( ! function_exists( 'ajani_widget_area' ) ) {
	function ajani_widget_area() {
		if ( class_exists( 'woocommerce' ) ) {
			register_sidebar( array (
				'name' 			=> esc_html__( 'Shop Sidebar', 'ajani' ),
				'id' 			=> 'bt_shop_sidebar',
				'description'   => 'WooCommerce sidebar',
				'before_widget' => '<div class="btBox %2$s">',
				'after_widget' 	=> '</div>',
				'before_title' 	=> '<h4><span>',
				'after_title' 	=> '</span></h4>',
			));
		}
	}
}

// Change number or products per row 
add_filter('loop_shop_columns', 'ajani_shop_loop_columns');
if (!function_exists('ajani_shop_loop_columns')) {
	function ajani_shop_loop_columns() {
		if ( boldthemes_get_option( 'shop_product_columns' ) ) {
			return boldthemes_get_option( 'shop_product_columns' ); 
		}
		return 2; 
	}
}

/**
 * Change number of products that are displayed per page (shop page)
 * $cols contains the current number of products per page based on the value stored on Options -> Reading
 */
add_filter( 'loop_shop_per_page', 'ajani_loop_shop_per_page', 20 );
if (!function_exists('ajani_loop_shop_per_page')) {
	function ajani_loop_shop_per_page( $cols ) {
		if ( boldthemes_get_option( 'shop_product_columns' ) ) {
			if ( boldthemes_get_option( 'shop_product_columns' ) == 2 || boldthemes_get_option( 'shop_product_columns' ) == 4 ) {
				return 8;
			}
		}
		return $cols;
	}
}

// Change shop share settings 
add_filter('boldthemes_shop_share_settings', 'ajani_shop_share_settings');
if (!function_exists('ajani_shop_share_settings')) {
	function ajani_shop_share_settings() {
		$boldthemes_shop_share_settings = array( 'xsmall', 'filled', 'circle' );
		return $boldthemes_shop_share_settings; 
	}
}

/* SVG Icon array */

if ( ! function_exists( 'bt_bb_get_svg_icons_param_array' ) ) {
	function bt_bb_get_svg_icons_param_array() {
	    return array(
			esc_html__( 'No icon', 'ajani' ) 									=> 'no_icon',
			esc_html__( 'Analysis (gradient)', 'ajani' ) 						=> 'analysis_1',
			esc_html__( 'Artificial intelligence (gradient)', 'ajani' ) 		=> 'artificial_intelligence_1',
			esc_html__( 'Bank (gradient)', 'ajani' ) 							=> 'bank',
			esc_html__( 'Bill (gradient)', 'ajani' ) 							=> 'bill',
			esc_html__( 'Blog (gradient)', 'ajani' ) 							=> 'blog',
			esc_html__( 'Blueprint (gradient)', 'ajani' ) 					=> 'blueprint',
			esc_html__( 'Calculator (gradient)', 'ajani' ) 					=> 'calculator',
			esc_html__( 'Check list (gradient)', 'ajani' ) 					=> 'check_list',
			esc_html__( 'Cloud computing (gradient)', 'ajani' ) 				=> 'cloud_computing',
			esc_html__( 'Coins (gradient)', 'ajani' ) 						=> 'coins',
			esc_html__( 'Collaboration (gradient)', 'ajani' ) 				=> 'collaboration',
			esc_html__( 'Compass', 'ajani' ) 									=> 'compass',
			esc_html__( 'Contract (gradient)', 'ajani' ) 						=> 'contract_1',
			esc_html__( 'Costumer (gradient)', 'ajani' ) 						=> 'costumer',
			esc_html__( 'Coupon (gradient)', 'ajani' ) 						=> 'coupon',
			esc_html__( 'Creative (gradient)', 'ajani' ) 						=> 'creative',
			esc_html__( 'Eart (gradient)', 'ajani' ) 							=> 'eart',
			esc_html__( 'Hand note (gradient)', 'ajani' ) 					=> 'hand_note',
			esc_html__( 'Help (gradient)', 'ajani' ) 							=> 'help',
			esc_html__( 'Homework (gradient)', 'ajani' ) 						=> 'homework',
			esc_html__( 'House (gradient)', 'ajani' ) 						=> 'house',
			esc_html__( 'Id card (gradient)', 'ajani' ) 						=> 'id_card',
			esc_html__( 'Innovation (gradient)', 'ajani' ) 					=> 'innovation',
			esc_html__( 'Like (gradient)', 'ajani' ) 							=> 'like_1',
			esc_html__( 'Line chart (gradient)', 'ajani' ) 					=> 'line_chart',
			esc_html__( 'Local network (gradient)', 'ajani' ) 				=> 'local_network',
			esc_html__( 'Money (gradient)', 'ajani' ) 						=> 'money_1',
			esc_html__( 'Money report (gradient)', 'ajani' ) 					=> 'money_report',
			esc_html__( 'Multiple users (gradient)', 'ajani' ) 				=> 'multiple_users',
			esc_html__( 'Network (gradient)', 'ajani' ) 						=> 'network',
			esc_html__( 'Objetive (gradient)', 'ajani' ) 						=> 'objetive',
			esc_html__( 'Payment (gradient)', 'ajani' ) 						=> 'payment',
			esc_html__( 'Pie chart (gradient)', 'ajani' ) 					=> 'pie_chart',
			esc_html__( 'Piggy_bank (gradient)', 'ajani' ) 					=> 'piggy_bank',
			esc_html__( 'Plan (gradient)', 'ajani' ) 							=> 'plan',
			esc_html__( 'Project management_1 (gradient)', 'ajani' ) 			=> 'project_management_1',
			esc_html__( 'Recognition (gradient)', 'ajani' ) 					=> 'recognition',
			esc_html__( 'Reload (gradient)', 'ajani' ) 						=> 'reload',
			esc_html__( 'Report (gradient)', 'ajani' ) 						=> 'report',
			esc_html__( 'Route (gradient)', 'ajani' ) 						=> 'route',
			esc_html__( 'Settings (gradient)', 'ajani' ) 						=> 'settings_1',
			esc_html__( 'Shield (gradient)', 'ajani' ) 						=> 'shield',
			esc_html__( 'Sketch (gradient)', 'ajani' ) 						=> 'sketch_1',
			esc_html__( 'Speech bubble (gradient)', 'ajani' ) 				=> 'speech_bubble',
			esc_html__( 'Stats line chart (gradient)', 'ajani' ) 				=> 'stats_line_chart',
			esc_html__( 'Stop watch (gradient)', 'ajani' ) 					=> 'stop_watch',
			esc_html__( 'Study (gradient)', 'ajani' ) 						=> 'study',
			esc_html__( 'Support (gradient)', 'ajani' ) 						=> 'suppport',
			esc_html__( 'Telephone call (gradient)', 'ajani' ) 				=> 'telephone_call',
			esc_html__( 'Think (gradient)', 'ajani' ) 						=> 'think',
			esc_html__( 'Vector (gradient)', 'ajani' ) 						=> 'vector',
			esc_html__( 'Wallet (gradient)', 'ajani' ) 						=> 'wallet_1',

			esc_html__( 'Accounting (pastel)', 'ajani' ) 						=> 'ico_accounting',
			esc_html__( 'Cashflow (pastel)', 'ajani' ) 						=> 'ico_cashflow',
			esc_html__( 'Forecast (pastel)', 'ajani' ) 						=> 'ico_forecast',
			esc_html__( 'Funds (pastel)', 'ajani' ) 							=> 'ico_funds',
			esc_html__( 'Planning (pastel)', 'ajani' ) 						=> 'ico_planning',
			esc_html__( 'Targetmarketing (pastel)', 'ajani' ) 				=> 'ico_targetmarketing',
			esc_html__( 'Head consultancy (pastel)', 'ajani' ) 				=> 'ico_head_consultancy',
			esc_html__( 'Head facilitation (pastel)', 'ajani' ) 				=> 'ico_head_facilitation',
			esc_html__( 'Head merge (pastel)', 'ajani' ) 						=> 'ico_head_merge',
			esc_html__( 'Head strategy (pastel)', 'ajani' ) 					=> 'ico_head_strategy',

			esc_html__( 'Head discovery (arrow)', 'ajani' ) 					=> 'ico_discovery',
			esc_html__( 'Head journey (arrow)', 'ajani' ) 					=> 'ico_journey',
			esc_html__( 'Head messaging (arrow)', 'ajani' ) 					=> 'ico_messaging',
			esc_html__( 'Head target (arrow)', 'ajani' ) 						=> 'ico_target'

		);
	}
}

/* Get icon HTML */

if ( ! function_exists( 'bt_bb_get_svg_icon_html' ) ) {
	function bt_bb_get_svg_icon_html( $icon ) {				
		ob_start();
		require( dirname(__FILE__) . '/bold-page-builder/content_elements_misc/svg/' . $icon . '.svg' );
		return ob_get_clean();							
	}	
}


/**
*
* Function Name: rgb2hex2rgb() for wp_kses allowed
* $color => HEX or RGB
* Returns RGB or HEX color format depending on given value.
* 
* $hexString = bt_bb_rgb2hex2rgb('255,255,255');
* $rgbArray = bt_bb_rgb2hex2rgb('#FFFFFF');
*
**/
function bt_bb_rgb2hex2rgb($color){ 
		if(!$color) return false; 
		if ( strpos( $color, '#' ) === false ) {
			$color = implode(",", bt_bb_hex2rgb( $color ));  
		}
		$color = trim($color); 		
		if(preg_match("/^[0-9ABCDEFabcdef\#]+$/i", $color)){
			$hex = str_replace('#','', $color);
			if(!$hex) return false;
			if(strlen($hex) == 3):
			   $result['r'] = hexdec(substr($hex,0,1).substr($hex,0,1));
			   $result['g'] = hexdec(substr($hex,1,1).substr($hex,1,1));
			   $result['b'] = hexdec(substr($hex,2,1).substr($hex,2,1));
			else:
			   $result['r'] = hexdec(substr($hex,0,2));
			   $result['g'] = hexdec(substr($hex,2,2));
			   $result['b'] = hexdec(substr($hex,4,2));
			endif;       
		}elseif (preg_match("/^[0-9]+(,| |.)+[0-9]+(,| |.)+[0-9]+$/i", $color)){ 
			$rgbstr = str_replace(array(',',' ','.'), ':', $color); 
			$rgbarr = explode(":", $rgbstr);
			$result = '#';
			$result .= str_pad(dechex($rgbarr[0]), 2, "0", STR_PAD_LEFT);
			$result .= str_pad(dechex($rgbarr[1]), 2, "0", STR_PAD_LEFT);
			$result .= str_pad(dechex($rgbarr[2]), 2, "0", STR_PAD_LEFT);
			$result = strtoupper($result); 
		}else{
			$result = false;
		}

		return $result; 
} 

require_once( get_parent_theme_file_path( 'php/before_framework.php' ) );

require_once( get_parent_theme_file_path( 'framework/framework.php' ) );

require_once( get_parent_theme_file_path( 'php/config.php' ) );

require_once( get_parent_theme_file_path( 'php/after_framework.php' ) );