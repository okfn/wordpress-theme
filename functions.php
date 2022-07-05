<?php
/**
 * OKFNWP functions and definitions
 *
 * @package OKFNWP
 */
// Set a fixed, maximum allowed width for any content in the theme
if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

/**
 * Add theme Options page
 */
require_once 'inc/class-okfnthemeoptions.php';

/**
 * Add theme Shortcodes from the old OKI WordPress theme
 * https://github.com/oki-archive/wordpress-theme-okfn
 */
require_once 'inc/shortcodes.php';

/**
 * Shortcodes
 */
require_once 'inc/latest-posts.php';


/**
 * Template tags
 */
require_once 'inc/template-tags.php';

/*
 * Initialize the OKFN WordPress theme and set up several required options
 */

function okfn_theme_setup() {

	// Load translated strings for the theme, placed in /languages in
	// https://codex.wordpress.org/I18n_for_WordPress_Developers
	load_theme_textdomain( 'okfnwp', get_template_directory() . '/languages' );

	/**
	 * Add theme support for features
	 */
	add_theme_support( 'html5' );
	add_theme_support( 'menus' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 50,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		)
	);
	add_theme_support( 'post-thumbnails' );

	/**
	 * Post thumbnails
	 */
	set_post_thumbnail_size( 730, 450, array( 'center', 'center' ) );
	add_image_size( 'small', 370, 370, array( 'center', 'center' ) );

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support( 'title-tag' );

	/**
	 * Backwards compatible Custom Header images
	 */
	global $wp_version;

	if ( version_compare( $wp_version, '3.4', '>=' ) ) :
		add_theme_support(
			'custom-header',
			array(
				'width'       => 1200,
				'height'      => 300,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => false,
			)
		);
  else :
	  add_custom_image_header( $wp_head_callback, $admin_head_callback );
  endif;

  /**
   * Register menus
   */
register_nav_menus(
	array(
		'primary'       => 'Primary',
		'footer-menu-1' => __( 'Footer Menu 1', 'okfnwp' ),
//        'footer-menu-2' => 'Footer Menu 2'
	)
	);
}

add_action( 'after_setup_theme', 'okfn_theme_setup' );

function okfn_widgets_init() {
	/**
	 * Register sidebars
	 */
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'okfnwp' ),
			'id'            => 'sidebar',
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'okfn_widgets_init' );

// Backwards compatibility function for Title Tag theme support
if ( ! function_exists( '_wp_render_title_tag' ) ) :

	function okfn_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}

	add_action( 'wp_head', 'okfn_render_title' );
endif;

/**
 * Enqueue stylesheets
 */
function enqueue_stylesheets() {

	wp_enqueue_style( 'stylesheet', get_template_directory_uri() . '/style.css', null, filemtime( get_stylesheet_directory() . '/style.css' ) );
}

add_action( 'wp_print_styles', 'enqueue_stylesheets' );

/**
 * Enqueue scripts
 */
function enqueue_scripts() {

	if ( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
		wp_register_script(
			'jquery',
			get_template_directory_uri() . '/assets/js/jquery.min.js',
			false,
			false,
			false
		);
		  wp_enqueue_script( 'jquery' );
	}

	wp_register_script(
		'bootstrap',
		get_template_directory_uri() . '/assets/js/bootstrap.min.js',
		array( 'jquery' ),
		false,
		false
	);
	wp_enqueue_script( 'bootstrap' );

	wp_register_script(
		'mmenu',
		get_template_directory_uri() . '/assets/js/jquery.mmenu.all.js',
		array( 'jquery' ),
		false,
		false
	);
	wp_enqueue_script( 'mmenu' );

	wp_register_script(
		'okfn-wp',
		get_template_directory_uri() . '/assets/js/main.min.js',
		array( 'jquery' ),
		'1.0.0',
		true
	);
	wp_enqueue_script( 'okfn-wp' );

	/* Validate user comments with Google reCAPTCHA */
	wp_register_script(
		'okfn_recaptcha_validator',
		get_template_directory_uri() . '/assets/js/okfn-recaptcha-validator.min.js',
		array( 'jquery' ),
		false,
		true
	);

	$translation_array = array( 'templateUrl' => get_stylesheet_directory_uri() );

	wp_localize_script( 'okfn_recaptcha_validator', 'template_url', $translation_array );

	if ( is_single() && comments_open() ) {
		wp_enqueue_script( 'recaptcha', '//www.google.com/recaptcha/api.js', array(), array(), true );
		wp_enqueue_script( 'okfn_recaptcha_validator' );

	}
}

add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );


/**
 * Fetch Menu object to output name
 */
function get_menu_by_location( $location ) {
	$menus = get_nav_menu_locations();

	if ( ! isset( $menus[ $location ] ) ) {
		return false;
	}

	$menu = get_term( $menus[ $location ], 'nav_menu' );

	return $menu;
}


// Show title on home page
add_filter( 'wp_title', 'wp_title_for_home', 10, 2 );

function wp_title_for_home( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	$title .= get_bloginfo( 'name', 'display' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		// translators: %s stands for page number
		$title = "$title $sep " . sprintf( __( 'Page %s', 'okfnwp' ), max( $paged, $page ) );
	}

	return $title;
}

/*
 * Remove the content editor for the page which is set as a Front page to make it
 * obvious that the page content shouldn't be editted.
 */

add_action( 'edit_form_after_title', 'okfn_front_page_editor_notice' );

function okfn_front_page_editor_notice() {
	$page_on_front = get_option( 'page_on_front' );
	global $post;

	if ( isset( $page_on_front ) && $page_on_front === $post->ID ) {
		// remove_post_type_support('page', 'editor');
		?>
		<div class="notice notice-warning inline">
		<p><?php esc_html_e( 'You are currently editing the page that shows your front page content.', 'okfnwp' ); ?></p>
		</div>
		<?php
	}
}

/* Define some global variables */

function okfn_global_vars() {
	global $rendered_posts_ids;
	$rendered_posts_ids = array();
}

add_action( 'wp', 'okfn_global_vars' );

// Get the post categories which will be featured on the Home page from the
// most recently updated 20 posts. Once the categories are extracted
function okfn_get_featured_cats() {
	global $frontpage_categories;

	if ( ! isset( $frontpage_categories ) ) :
		$frontpage_categories = array();
  endif;

	// Get 20 latest posts ordered by date of modification
	$okfn_recent_posts = get_posts(
		array(
			'posts_per_page' => 20,
			'fields'         => 'ids',
		)
	);

	// Extract the IDs of the largest unique categories assigned
	// to the 20 latest posts
	foreach ( $okfn_recent_posts as $value ) :
		// Must use wp_get_post_terms() here as we need the categories ordered by the
		// total number of posts they contain
		$frontpage_categories = array_unique( array_merge( $frontpage_categories, wp_get_post_terms( $value, 'category', array( 'fields' => 'ids' ) ) ) );
  endforeach;
}

add_action( 'wp', 'okfn_get_featured_cats' );

// When a post is rendered in a template, remember its ID, so that no duplicate
// post appear in the listings.
function okfn_save_rendered_post_id( $post ) {
	global $rendered_posts_ids;

	if ( isset( $post ) && ! in_array( $post->ID, $rendered_posts_ids ) ) :
		array_push( $rendered_posts_ids, $post->ID );
  endif;
}

// Check if a post has not already been rendered in the loop
function okfn_is_post_rendered( $post ) {
	global $rendered_posts_ids;
	global $post; // Required!

	if ( isset( $post ) && in_array( $post->ID, $rendered_posts_ids ) ) :
		return true;
  else :
	  return false;
  endif;
}

function okfn_get_first_image_url_from_post_content() {
	global $post;

	$first_img_url = '';
	$is_image_file = false;

	// Match <img> tags within post content
	$image_urls = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );

	if ( $image_urls ) :

		$first_img_url = $matches[1][0];

  endif;

	if ( empty( $first_img_url ) ) :

		// Reset value if no image is available
		$first_img_url = false;

  endif;

	return $first_img_url;
}

/* Add Google captcha field to Comment form before the submit button */

add_filter( 'comment_form_submit_button', 'okfn_google_captcha' );

function okfn_google_captcha( $submit_button ) {
	wp_nonce_field( 'g-recaptcha-check', 'g-recaptcha' );
	return '<div class="g-recaptcha" data-sitekey= "' . okfn_get_recaptcha_public_key() . '"></div>' . $submit_button;
}

function okfn_get_recaptcha_public_key() {

	if ( defined( 'RECAPTCHA_PUBLIC_KEY' ) ) :
		$recaptcha_public_key = RECAPTCHA_PUBLIC_KEY;
  else :
	  $recaptcha_public_key = '6Lf7NCITAAAAALKEyDJtNygRuXv9NsiINqYWF5Y3';
  endif;

  return $recaptcha_public_key;
}

// Remove WordPress generator meta tag to hide current WP version
add_filter( 'the_generator', '__return_false' );

// Fix inconsistencies in the src and srcset content for images
add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );

// Add custom RSS feed
add_feed( 'enclosure', 'oki_custom_rss2_feed' );

function oki_custom_rss2_feed() {
	load_template( TEMPLATEPATH . '/oki-feed-rss2.php' );
}

// Generate a permalink to an author image on Gravatar, with specific size
function okfn_get_avatar_img_url( $image_size ) {
	$user_id = get_the_author_meta( 'id' );

	if ( validate_gravatar( $user_id ) ) :
		return str_replace( 'http:', 'https:', esc_url( remove_query_arg( array( 'd', 'r' ), get_avatar_url( $user_id, array( 'size' => $image_size ) ) ) ) );
  endif;
}

/**
 * Utility function to check if a gravatar exists for a given email or id
 *
 * @param int|string|object $id_or_email A user ID,  email address, or comment object
 * @return bool if the gravatar exists or not
 * https://gist.github.com/justinph/5197810
 */
function validate_gravatar( $id_or_email ) {
	// id or email code borrowed from wp-includes/pluggable.php
	$email = '';
	if ( is_numeric( $id_or_email ) ) {
		$id   = (int) $id_or_email;
		$user = get_userdata( $id );
		if ( $user ) {
			$email = $user->user_email;
		}
	} elseif ( is_object( $id_or_email ) ) {
		// No avatar for pingbacks or trackbacks
		$allowed_comment_types = apply_filters( 'get_avatar_comment_types', array( 'comment' ) );
		if ( ! empty( $id_or_email->comment_type ) && ! in_array( $id_or_email->comment_type, (array) $allowed_comment_types ) ) {
			return false;
		}

		if ( ! empty( $id_or_email->user_id ) ) {
			$id   = (int) $id_or_email->user_id;
			$user = get_userdata( $id );
			if ( $user ) {
				$email = $user->user_email;
			}
		} elseif ( ! empty( $id_or_email->comment_author_email ) ) {
			$email = $id_or_email->comment_author_email;
		}
	} else {
		$email = $id_or_email;
	}

	$hashkey = md5( strtolower( trim( $email ) ) );
	$uri     = 'https://www.gravatar.com/avatar/' . $hashkey . '?d=404';

	$data = wp_cache_get( $hashkey );
	if ( false === $data ) {
		$response = wp_remote_head( $uri );
		if ( is_wp_error( $response ) ) {
			$data = 'not200';
		} else {
			$data = $response['response']['code'];
		}
		  wp_cache_set( $hashkey, $data, $group = '', $expire = 60 * 5 );
	}
	if ( '200' == $data ) {
		return true;
	} else {
		return false;
	}
}


// Add search button to main nav via items_wrap
// default value of 'items_wrap' is <ul id="%1$s" class="%2$s">%3$s</ul>'
function main_nav_wrap() {
	$wrap  = '<ul class="primary nav">';
	$wrap .= '%3$s';
	$wrap .= '<li class="search"><label for="search"><span class="icon-search" aria-hidden="true" id="display-search-bar"></span><span class="sr-only">Search</span></label></li>';
	$wrap .= '</ul>';
	return $wrap;
}

// Add secondary nav to offcanvas menu via items_wrap
function mobile_nav_wrap() {
	$wrap  = '<ul id="%1$s" class="%2$s">'; // default value
	$wrap .= '%3$s';
	ob_start();
	include 'inc/secondary-nav-items.php';
	$wrap .= ob_get_contents();
	ob_end_clean();
	$wrap .= '</ul>';
	return $wrap;
}
