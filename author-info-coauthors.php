<?php

/**
 * Display the author's name and bio within blog posts
 *
 * @package OKFNWP
 */
if ( function_exists( 'get_coauthors' ) ) :
	$authors = get_coauthors( get_the_ID() );
endif;

if ( is_array( $authors ) ) :

	foreach ( $authors as $author ) :

		$author_description = get_the_author_meta( 'description', $author->ID );
		$avatar             = get_avatar( get_the_author_meta( 'ID' ), 80 );

		/* Prepare a suitable URL for the Gravatar user profile, as recommended here:
         *  https://en.gravatar.com/site/implement/profiles/
         */
		$avatar_url = 'https://www.gravatar.com/' . md5( get_the_author_meta( 'user_email', $author->ID ) );

		if ( empty( $author_description ) ) :
			$author_description = __( 'No description set for this author.', 'okfnwp' );
		endif;

		if ( $author ) :

			?>
			<aside class="author-info">
				<a class="author-info_link" href="<?php echo esc_url( $avatar_url ); ?>">
					<span class="author-info_thumbnail"><?php echo wp_kses_post( $avatar ); ?></span>
				</a>
				<h4 class="author-info_name">
				<?php

					// translators: %1$s stands for the author name
					echo esc_html( sprintf( __( 'About %1$s' ), get_the_author_meta( 'display_name', $author->ID ) ) );

					?>
					</h4>
				<p><?php echo wp_kses_post( $author_description ); ?></p>
			</aside>
			<?php

		endif;

	endforeach;

endif;
