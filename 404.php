<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package OKFNWP
 */

get_header();
?>

<div class="col-md-12">
  <?php
	// Include the page content template.
	get_template_part( 'content', 'none' );
	?>
</div>

<?php
get_footer();
