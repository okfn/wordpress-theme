<?php
/**
 * The post thumbnail template
 *
 * @package OKFNWP
 */

$okf_categories = get_the_category();

if ( has_post_thumbnail() ) :
	$okf_thumb = get_the_post_thumbnail( $post, 'small' );
elseif ( okfn_get_first_image_url_from_post_content() ) :
	$okf_thumb = sprintf( '<img class="attachment-small size-small wp-post-image" src="%s" alt="">', okfn_get_first_image_url_from_post_content() );
else :
	$okf_thumb = null;
endif;

if ( $okf_thumb ) :

	?>
  <div class="post__thumb">
	<?php

	echo '<a class="post__thumb-link" href="' . esc_url( get_permalink() ) . '">' . wp_kses_post( $okf_thumb ) . '</a>';

	if ( $okf_categories ) :
		echo wp_kses_post( sprintf( '<a href="%1$s" class="post__category">%2$s</a>', get_category_link( $okf_categories[0]->term_id ), $okf_categories[0]->name ) );
	endif;

	?>
  </div>
	<?php
endif;
