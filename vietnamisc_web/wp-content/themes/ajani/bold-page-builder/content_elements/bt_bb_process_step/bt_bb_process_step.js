(function( $ ) {
	"use strict";
	
	$( document ).ready(function() {		
	
			$( '.bt_bb_process  .bt_bb_process_step' ).click(function() {					
					if ( $( this ).hasClass( "bt_bb_process_on" ) ) {
						$( this ).removeClass( 'bt_bb_process_on' );
					}else{
						$( this ).siblings().removeClass( 'bt_bb_process_on' );
						$( this ).addClass( 'bt_bb_process_on' );
						$( this ).closest( '.bt_bb_process' ).find( '.bt_bb_process_step' ).removeClass( 'bt_bb_process_on' );
						$( this ).closest( '.bt_bb_process' ).find( '.bt_bb_process_step' ).eq( $( this ).index() ).addClass( 'bt_bb_process_on' );
					}	
			});

			$( '.bt_bb_process' ).each(function() {
				if ( $( this ).data( 'closed' ) != 'closed' ) {
					$( this ).find( '.bt_bb_process_step' ).first().click();
				}
			});
	
	});

})( jQuery );