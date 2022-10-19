<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package OKFNWP
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/img/favicon.ico" />
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<!-- Twitter Card data -->
		<?php
			if(is_single() || is_page()) {
			$twitter_url    = get_permalink();
			$twitter_title  = get_the_title();
			$twitter_desc   = get_the_excerpt();

			if ( has_post_thumbnail() ) {
				$twitter_thumb = get_the_post_thumbnail( $post, 'small' );
			} elseif ( okfn_get_first_image_url_from_post_content() ) {
				$twitter_thumb = okfn_get_first_image_url_from_post_content();
			} else {
				$twitter_thumb = null;
			}

			$twitter_name = get_the_author_meta('twitter');
			if (!$twitter_name) { $twitter_name = 'okfn'; }
			?>
			<meta name="twitter:card" value="summary" />
			<meta name="twitter:url" value="<?php echo $twitter_url; ?>" />
			<meta name="twitter:title" value="<?php echo $twitter_title; ?>" />
			<meta name="twitter:description" value="<?php echo $twitter_desc; ?>" />
			<?php if ($twitter_thumb) { ?>
			<meta name="twitter:image" value="<?php echo $twitter_thumb; ?>" />
			<?php } ?>
			<meta name="twitter:site" value="@okfn" />
			<meta name="twitter:creator" value="<?php echo $twitter_name ?>" />
			<? } ?>
		<!-- end Twitter Card data -->

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div id="page">
			<header class="site-header">
				<div class="header">
					<div class="container">
						<div class="brand" id="header-brand">
							<h1>
								<a class="brand_link" rel="home" href="<?php echo esc_url( home_url() ); ?>">
									<?php
									if ( has_custom_logo() ) {
										okfn_theme_logo();
									} else {
										include 'inc/logo.svg';
									}
									?>
								</a>
							</h1>
						</div>

						<a href="#mmenu" class="show-menu">
							<span class="icon-menu" aria-hidden="true"></span>
							<span class="sr-only"><?php esc_html_e( 'Open the menu', 'okfnwp' ); ?></span>
						</a>
						<nav>
							<ul id="nav-social" class="secondary nav">
								<?php require 'inc/secondary-nav-items.php'; ?>
							</ul>

							<?php
							// Check if the required menu location exists and show any menu if it doesn't.
							if ( has_nav_menu( 'primary' ) ) :

								wp_nav_menu(
									array(
										'theme_location' => 'primary',
										'container'      => false,
										'items_wrap'     => okf_main_nav_wrap(),
										'fallback_cb'    => false,
									)
								);

							else :

								wp_nav_menu(
									array(
										'container'   => false,
										'items_wrap'  => okf_main_nav_wrap(),
										'fallback_cb' => false,
									)
								);

							endif;
							?>

						</nav>
					</div>
					<div class="search-bar" id="main-search-bar">
						<div class="container">
							<?php get_search_form(); ?>
							<button class="search-bar_button cancel">
								<span class="icon-close" aria-hidden="true"></span>
								<span class="sr-only"><?php esc_html_e( 'Cancel', 'okfnwp' ); ?></span>
							</button>
						</div>
					</div>
				</div>
				<?php if ( is_front_page() ) : ?>
			</header>
					<?php
					// If a Custom Header image is selected, show it just on the front page.
					// if ( get_header_image() ) {
					// header_image()
					// }
					// @ignore Don't test commented out code.

					// Not the Front page.
				else :
					?>
				<div class="banner" id="page-banner">
					<div class="container">
						<div class="banner_text">
							<h1>
								<?php

								$okf_blog_title = __( 'Blog', 'okfnwp' );

								if ( is_single() || is_page() ) :
									the_title();
								elseif ( is_archive() || is_category() ) :
									echo esc_html( $okf_blog_title );

									// When loading the latest posts page or a static home page
									// load the title dynamically from the page title, if set.
								elseif ( is_home() ) :
									$okf_dynamic_title = get_the_title( get_option( 'page_for_posts' ) );
									if ( isset( $okf_dynamic_title ) ) :
										echo esc_html( $okf_dynamic_title );
									else :
										echo esc_html( $okf_blog_title );
									endif;
								elseif ( is_404() ) :
									$okf_error_404_title = __( 'Page Not Found', 'okfnwp' );
									echo esc_html( $okf_error_404_title );
								elseif ( is_search() ) :
									// translators: %1$s stands for the entered search term.
									$okf_search_title = sprintf( __( 'Search Results for: %1$s', 'okfnwp' ), esc_html( get_search_query() ) );
									echo esc_html( $okf_search_title );
								endif;

								?>
							</h1>
						</div>
						<?php
						// if (is_single() || is_page()) {
						// if ( has_post_thumbnail() ) {
						// echo '<div class="banner_image">';
						// the_post_thumbnail( 'small');
						// echo '</div>';
						// }
						// }
						// @ignore Don't test commented out code.
						?>
					</div>
				</div>
			</header>

			<div id="breadcrumb" role="navigation" class="d-none d-xl-block">
				<nav class="container" aria-label="breadcrumb">
					<?php okf_breadcrumbs(); ?>
				</nav>
			</div>
			<?php endif; ?>
			<main class="content">
				<div class="container">
					<div class="row">
