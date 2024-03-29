<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package OKFNWP
 */

get_header();
?>

<div class="col-md-12">
  <?php
	if ( have_posts() ) :
		?>
		<div class="row">
		<?php
		// Start the Loop.
		while ( have_posts() ) :
			the_post();

			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			get_template_part( 'content', 'blog' );

			endwhile;
		?>
		</div>
		<?php
		// Previous/next post navigation.
		okf_paging_nav();

  endif;
	?>
</div>

<?php
get_footer();
