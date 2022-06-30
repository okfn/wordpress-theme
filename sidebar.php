<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package OKFNWP
 */
?>

<div class="sidebar col-lg-4">
  <?php
	if ( is_single() ) :
		// Output the author bio box on post pages
		get_template_part( 'author-info' );
  endif;
	?>
  <ul>
	<?php dynamic_sidebar( 'sidebar' ); ?>
  </ul>
</div>
