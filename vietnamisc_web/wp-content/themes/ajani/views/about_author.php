<?php
	
	$about_author_html = '';
	
	$avatar_html = get_avatar( get_the_author_meta( 'ID' ), 280 );
	$avatar_html = str_replace ( 'width=\'280\'', 'width=\'140\'', $avatar_html );
	$avatar_html = str_replace ( 'height=\'280\'', 'height =\'140\'', $avatar_html );
	$avatar_html = str_replace ( 'width="280"', 'width="140"', $avatar_html );
	$avatar_html = str_replace ( 'height="280"', 'height ="140"', $avatar_html );
	
	$about_author_html = '<div class="btAboutAuthor">';
	
	$user_url = get_the_author_meta( 'user_url' );
	if ( $user_url != '' ) {
		$author_html = boldthemes_get_post_author( $user_url );
	} else {
		$author_html = esc_html( get_the_author_meta( 'display_name' ) );
	}
	
	if ( $avatar_html ) {
		$about_author_html .= '<div class="aaAvatar">' . $avatar_html . '</div>';
	}
	
	$description = get_the_author_meta( 'description' );
	
	$about_author_html .= '<div class="aaTxt"><h4>' . $author_html;
	$about_author_html .= '</h4>
			<p>' . $description . '</p>
		</div>
	</div>';

	if ( $description != '' ) {
		echo '<section class="btAboutAutor gutter">';
			echo '<div class="port">';

				echo '<div class="btAboutAutorContent">';
						echo wp_kses( $about_author_html, 'about_author' );
				echo '</div><!-- /btAboutAutorContent -->';

			echo '</div><!-- port -->';		
		echo '</section>';
	}

?>