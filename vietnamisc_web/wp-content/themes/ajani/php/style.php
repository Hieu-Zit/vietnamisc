<?php

   $prev_text = esc_html__( 'Previous', 'ajani' );
   $next_text = esc_html__( 'Next', 'ajani' );
   
   $prev_next_style_css = sanitize_text_field('
		button.slick-arrow.slick-next:before,
		button.mfp-arrow.mfp-arrow-right:before,
		button.pswp__button.pswp__button--arrow--right:before
		{
			content: "' . $next_text . '" !important;
		}

		button.slick-arrow.slick-prev:before,
		button.mfp-arrow.mfp-arrow-left:before,
		button.pswp__button.pswp__button--arrow--left:before
		{
			content: "' . $prev_text . '" !important;
		}
', array() );

