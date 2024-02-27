(function( $ ) {
	"use strict";
	
	var bt_bb_portfilio_slider_resize = function( root ) {
		root.each(function() {
			$( this ).find( '.bt_bb_grid_item' ).each(function() {
				$( this ).find( '.bt_bb_grid_item_post_thumbnail' ).height( Math.floor( $( this ).width() * $( this ).data( 'hw' ) ) );
			});
		});
	}

	$( document ).ready(function() {
		bt_bb_portfilio_slider_resize( $( '.bt_bb_portfolio_slider' ) );
	});
	
})( jQuery );