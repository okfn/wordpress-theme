<?php
/**
 * Display the author's name and bio within blog posts
 *
 * @package OKFNWP
 */

if ( function_exists( 'get_coauthors' ) ) :
	$okf_authors = get_coauthors( get_the_ID() );
endif;

if ( is_array( $okf_authors ) ) :

	foreach ( $okf_authors as $okf_author ) :

		$okf_author_description = get_the_author_meta( 'description', $okf_author->ID );
		$okf_avatar             = get_avatar( get_the_author_meta( 'ID' ), 80 );

		/*
		 Prepare a suitable URL for the Gravatar user profile, as recommended here:
		 *  https://en.gravatar.com/site/implement/profiles/
		 */
		$okf_avatar_url = 'https://www.gravatar.com/' . md5( get_the_author_meta( 'user_email', $okf_author->ID ) );

		if ( empty( $okf_author_description ) ) :
			$okf_author_description = __( 'No description set for this author.', 'okfnwp' );
		endif;

		if ( $okf_author ) :

			?>
			<aside class="author-info">
				<a class="author-info_link" href="<?php echo esc_url( $okf_avatar_url ); ?>">
					<span class="author-info_thumbnail"><?php echo wp_kses_post( $okf_avatar ); ?></span>
				</a>
				<h4 class="author-info_name">
				<?php

					// translators: %1$s stands for the author name.
					echo esc_html( sprintf( __( 'About %1$s', 'okfnwp' ), get_the_author_meta( 'display_name', $okf_author->ID ) ) );

				?>
					</h4>
				<p><?php echo wp_kses_post( $okf_author_description ); ?></p>
			</aside>
			<?php

		endif;

	endforeach;

endif;
