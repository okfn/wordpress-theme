<?php
/**
 * @package OKFNWP
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post post--excerpt' ); ?>>
  <header class="post-header">
	<?php
	if ( is_single() ) :
		the_title( '<h1 class="entry-title">', '</h1>' );
	else :
		the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
	endif;
	?>
  </header>
  <div class="entry-content">
	<?php the_excerpt(); ?>
  </div>
</article>
