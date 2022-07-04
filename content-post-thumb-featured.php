<?php
/**
 * The featured post thumbnail template.
 *
 * @package OKFNWP
 */

$okf_categories = get_the_category();

if ( has_post_thumbnail() ) :

	?>
	<div class="post__thumb">
		<?php

		echo wp_kses_post( '<a class="post__thumb-link" href="' . get_permalink() . '">' . get_the_post_thumbnail( $post, 'large' ) . '</a>' );

		if ( $okf_categories ) :
			echo wp_kses_post( sprintf( '<a href="%1$s" class="post__category">%2$s</a>', get_category_link( $okf_categories[0]->term_id ), $okf_categories[0]->name ) );
		endif;

		?>
	</div>
<?php else : ?>
	<div class="post__thumb">
		<a href="<?php the_permalink(); ?>">
			<img class="attachment-small size-small wp-post-image" src="<?php echo wp_kses_post( okfn_get_first_image_url_from_post_content() ); ?>" alt="">
		</a>
	</div>
	<?php
endif;
