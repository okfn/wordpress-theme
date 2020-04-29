<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package OKFNWP
 */

?>

</div><!-- / .row -->
</div></main>
<footer class="footer">
  <div class="container">
	<div class="row footer-primary">
	  <div class="col-sm-3 col-md-2">
		<a class="footer-logo" href="https://okfn.org/">
		  <img src="https://a.okfn.org/img/oki/landscape-white-468x122.png" alt="<?php esc_html_e( 'Open Knowledge Foundation', 'okfn' ); ?>">
		</a>
	  </div>
	  <div class="col-sm-9 col-md-10">
		<?php

		// Check if the required menu location exists and show any menu if it doesn't.
		if ( has_nav_menu( 'footer-menu-1' ) ) :

		  wp_nav_menu(
			  array(
				  'theme_location'  => 'footer-menu-1',
				  'container'       => 'nav',
				  'container_class' => 'footer-menu',
				  'items_wrap'      => '<ul class="list-inline">%3$s</ul>',
				  'fallback_cb'     => false,
			  )
			  );

		else :

		  wp_nav_menu(
			  array(
				  'container'       => 'nav',
				  'container_class' => 'footer-menu',
				  'items_wrap'      => '<ul class="list-inline">%3$s</ul>',
				  'fallback_cb'     => false,
			  )
			  );

		endif;

		?>
	  </div>
	</div>
	<div class="footer-secondary">
	  <p>
		<a href='https://github.com/okfn/wordpress-theme/' title='Site source code'>
		  <i class='fa fa-code fa-lg fa-fw'></i> <?php esc_html_e( 'Source code', 'okfnwp' ); ?> </a> <?php esc_html_e( 'available under the MIT license', 'okfnwp' ); ?>.
	  </p>
	  <p>
		<a class="license" rel="license" href="https://creativecommons.org/licenses/by/4.0/">
		  <?php echo file_get_contents( get_stylesheet_directory() . '/assets/img/cc.svg', FILE_USE_INCLUDE_PATH ); ?>
		  <?php echo file_get_contents( get_stylesheet_directory() . '/assets/img/by.svg', FILE_USE_INCLUDE_PATH ); ?>
		</a>
		<?php esc_html_e( 'Content on this site, made by', 'okfnwp' ); ?>
		<a xmlns:cc="http://creativecommons.org/ns#"
		   href="https://okfn.org/"
		   property="cc:attributionName"
				   rel="cc:attributionURL"><?php esc_html_e( 'Open Knowledge Foundation', 'okfnwp' ); ?></a>, <?php esc_html_e( 'is licensed under a', 'okfnwp' ); ?>
		<a rel="license"
		   href="https://creativecommons.org/licenses/by/4.0/">
			 <?php esc_html_e( 'Creative Commons Attribution 4.0 International License', 'okfnwp' ); ?>
		</a>.
	  </p>
	  <p>
		<?php esc_html_e( 'Refer to our', 'okfnwp' ); ?> <a href="https://okfn.org/attribution/">
		  <?php esc_html_e( 'attributions page', 'okfnwp' ); ?></a> <?php esc_html_e( 'for attributions of other work on the site', 'okfnwp' ); ?>.
	  </p>
	</div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
