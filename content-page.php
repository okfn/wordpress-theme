<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package OKFNWP
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
  <div class="entry-content">
	<?php the_content(); ?>
  </div>
</article>
