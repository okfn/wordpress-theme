<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package OKFNWP
 */
get_header();
?>

<div class="col-lg-8">
  <?php
  if ( have_posts() ) :
		// Start the Loop.
		while ( have_posts() ) :
the_post();

			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			get_template_part( 'content', get_post_type() );

			endwhile;
		// Previous/next post navigation.
		paging_nav();

  endif;
  ?>
</div>
<?php
get_sidebar();
get_footer();
