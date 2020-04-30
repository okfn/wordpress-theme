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
    </div><!-- / .container -->
  </main>


  <?php
  $theme_options = get_option( 'theme_options_option_name' );

  if (!empty($theme_options['okfnwp_cta_message'])) {
  ?>
  <section class="footer-cta">
    <div class="container">
      <div class="text">
        <p><?php echo $theme_options['okfnwp_cta_message'] ?></p>
      </div>
      <?php
      if (!empty($theme_options['okfnwp_cta_link_text']) && !empty($theme_options['okfnwp_cta_link_url'])) {
      ?>
      <div class="link">
        <a href="<?php echo $theme_options['okfnwp_cta_link_url'] ?>"><?php echo $theme_options['okfnwp_cta_link_text'] ?></a>
      </div>
      <?php
      }
      ?>
    </div>
  </section>
  <?php
  }
  ?>
  <footer class="site-footer">
    <div class="container">
  	<div class="footer-primary">
  		<a class="footer-logo" href="https://okfn.org/">
  		  <?php include 'inc/logo.svg'; ?>
  		</a>
  		<?php

  		// Check if the required menu location exists and show any menu if it doesn't.
  		if ( has_nav_menu( 'footer-menu-1' ) ) :

  		  wp_nav_menu(
  			  array(
  				  'theme_location'  => 'footer-menu-1',
  				  'container'       => false,
  				  'items_wrap'      => '<ul class="footer-links">%3$s</ul>',
  				  'fallback_cb'     => false,
            'depth'           => 1,
  			  )
  			  );

  		else :

  		  wp_nav_menu(
  			  array(
  				  'container'       => false,
  				  'items_wrap'      => '<ul class="footer-links">%3$s</ul>',
  				  'fallback_cb'     => false,
            'depth'           => 1,
  			  )
  			  );

  		endif;

  		?>
    	</div>
    	<div class="footer-secondary">
    	  <p>
    		<a href='https://github.com/okfn/wordpress-theme/' title='Site source code'>
    		  <?php esc_html_e( 'Source code', 'okfnwp' ); ?> </a> <?php esc_html_e( 'available under the MIT license', 'okfnwp' ); ?>.
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
  </div><!-- / #page-->
  <?php
  if ( has_nav_menu( 'primary' ) ) :
    wp_nav_menu(
        array(
          'theme_location' => 'primary',
          'container'       => 'nav',
          'container_id'    => 'mmenu',
          'items_wrap'      => mobile_nav_wrap(),
          'fallback_cb'    => false,
        )
    );
  endif;

  wp_footer(); ?>
</body>
</html>
