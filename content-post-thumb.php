<?php

/**
 * @package OKFNWP
 */
$categories = get_the_category();

if ( has_post_thumbnail() ) :
	$thumb = get_the_post_thumbnail( $post, 'small' );
elseif ( okfn_get_first_image_url_from_post_content() ) :
	$thumb = sprintf( '<img class="attachment-small size-small wp-post-image" src="%s" alt="">', okfn_get_first_image_url_from_post_content() );
else :
	$thumb = null;
endif;

if ( $thumb ) :

	?>
  <div class="post__thumb">
	<?php

	echo '<a class="post__thumb-link" href="' . esc_url( get_permalink() ) . '">' . wp_kses_post( $thumb ) . '</a>';

	if ( $categories ) :
		echo wp_kses_post( sprintf( '<a href="%1$s" class="post__category">%2$s</a>', get_category_link( $categories[0]->term_id ), $categories[0]->name ) );
	endif;

	?>
  </div>
	<?php
endif;
