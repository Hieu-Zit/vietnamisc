<?php

require( 'google_fonts.php' );

foreach ( $fonts as $item ) {
	BT_BB_Root::$font_arr[ $item['font-name'] ] = $item['css-name'];
}

if ( property_exists( 'BoldThemesFramework', 'custom_fonts' ) ) {
	foreach ( BoldThemesFramework::$custom_fonts as $font ) {
		BT_BB_Root::$font_arr[ $font['font'] . ' ' . esc_html__( '(custom font)', 'bold-builder' ) ] = $font['font'];
	}
}

ksort( BT_BB_Root::$font_arr );
