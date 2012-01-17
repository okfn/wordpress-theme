<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ) ?>; charset=<?php bloginfo( 'charset' ) ?>" />
		<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>

		<?php do_action( 'bp_head' ) ?>

		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ?>" />

		<?php
			if ( is_singular() && bp_is_blog_page() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );

			wp_head();
		?>
    <link rel="stylesheet" href="<?php echo bloginfo('stylesheet_url'); ?>"/>
    <link rel="shortcut icon" href="<?php echo bloginfo('stylesheet_directory'); ?>/images/favicon.ico" />

    <script type="text/javascript">
      var Okfn = Okfn || {};
      // Make this variable available to Javascript
      Okfn.theme_directory = '<?php echo bloginfo('stylesheet_directory'); ?>';
    </script>

    <script type="text/javascript" src="<?php echo bloginfo('stylesheet_directory'); ?>/js/jquery.jcarousel.min.js"></script>
    <script type="text/javascript" src="<?php echo bloginfo('stylesheet_directory'); ?>/js/app.js"></script>
	</head>

	<body <?php body_class() ?> id="bp-default">

    <?php 
      /* Javascript includes */
      do_action( 'bp_before_header' ) 
    ?>
    <div class="headspace"></div>

    <header>
        <div class="topbar">
          <div class="fill">
            <div class="container">
              <a title="<?php _ex( 'Home', 'Home page banner link title', 'buddypress' ); ?>" 
                class="brand" 
                href="<?php echo home_url(); ?>"><img alt="logo" src="<?php echo bloginfo('stylesheet_directory'); ?>/images/topbar-logo%20copy.png"/><?php bp_site_name(); ?></a>
              <nav>
                <?php  
                  wp_nav_menu( array( 
                    'container' => false, 
                    'menu_class' => 'nav', 
                    'menu_id' => 'nav', 
                    'theme_location' => 'primary', 
                    'fallback_cb' => 'okfn_fallback_nav_menu' ) ) 
                  ; ?>
              </nav>
              <!-- Disabled until I've got separate images and confirmed link addresses -->
              <!--div class="featurelinks">
                <img class="featurelink" src="<?php echo bloginfo('stylesheet_directory'); ?>/images/featurelinks%20copy.png" />
              </div -->
            </div>
          </div>
        </div>

        <form action="<?php echo bp_search_form_action() ?>" method="post" class="search-form" role="search">
          <label for="search-terms" class="accessibly-hidden"><?php _e( 'Search for:', 'buddypress' ); ?></label>
          <input type="text" id="search-terms" name="search-terms" value="<?php echo isset( $_REQUEST['s'] ) ? esc_attr( $_REQUEST['s'] ) : ''; ?>" />

          <?php echo bp_search_form_type_select() ?>

          <input type="submit" name="search-submit" id="search-submit" value="<?php _e( 'Search', 'buddypress' ) ?>" />
          <?php wp_nonce_field( 'bp_search_form' ) ?>
        </form><!-- #search-form -->
        <?php do_action( 'bp_search_login_bar' ) ?>
        <?php do_action( 'bp_header' ) ?>
      </div>
    </header>
		<?php do_action( 'bp_after_header' ) ?>

    <div class="container">
      <div class="strapline">
      <div class="inner">
        We build tools and communities to promote open knowledge around the world.
      </div><!-- /inner     -->
      </div><!-- /strapline -->
    </div><!-- /container -->

		<?php do_action( 'bp_before_container' ) ?>
    <div class="container">

