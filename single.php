<?php
/**
 * The template for displaying all single posts.
 *
 * @package OKFNWP
 */
get_header();
?>

<div class="main col-lg-8">
  <?php
	// Start the Loop.
	while ( have_posts() ) :
		the_post();

		// Include the page content template.
		get_template_part( 'content', 'single' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
  endwhile;
	?>
</div>

<?php
get_sidebar();
get_footer();
