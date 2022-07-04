<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package OKFNWP
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
  <div class="entry-content">
	  <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'okfnwp' ); ?></p>
	<?php get_search_form(); ?>
  </div>
</article>
