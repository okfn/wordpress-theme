<?php
/**
 * Custom template tags
 *
 * @package OKFNWP
 */

 /**
  * Pagination links builder function
  *
  * @return void
  */
function okf_paging_nav() {
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links(
		array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $wp_query->max_num_pages,
			'current'   => $paged,
			'mid_size'  => 1,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => __( '&larr; Previous', 'okfnwp' ),
			'next_text' => __( 'Next &rarr;', 'okfnwp' ),
		)
	);

	if ( $links ) :
		?>
		<nav class="blog-pagination" role="navigation">
		<?php echo wp_kses_post( $links ); ?>
		</nav><!-- .blog-pagination -->
		<?php
	endif;
}

/**
 * Breadcrumbs builder function
 *
 * @return void
 */
function okf_breadcrumbs() {

	// Don't show breadcrumbs on the Home page.
	if ( is_home() ) :
		return;
	endif;

	global $post;

	echo '<ol class="breadcrumb">';
	echo '<li class="breadcrumb-item"><a class="breadcrumb-item_link" href="' . esc_url( home_url() ) . '">' . esc_html__( 'Home', 'okfnwp' ) . '</a></li>';

	// Temporarily disable this link in the breadcrumbs.

	// @ignore Temporary tests ignore for the commented out code.
	// if (!is_page() && !is_404()) :
	// echo '<li><a href="' . get_permalink(get_option('page_for_posts')) . '">' . __('Blog', 'okfn') . '</a></li>';
	// endif;

	if ( is_404() ) :
		echo '<li class="breadcrumb-item active">' . esc_html__( 'Page Not Found', 'okfnwp' ) . '</li>';
  endif;

	if ( is_category() || is_single() ) :
		$category = get_the_category();
		$category = $category[0];
		echo '<li class="breadcrumb-item"><a class="breadcrumb-item_link" href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></li>';
  endif;

	if ( is_single() ) :
		echo '<li class="breadcrumb-item active">' . wp_kses_post( get_the_title() ) . '</li>';
  endif;

	if ( is_page() ) :
		if ( $post->post_parent ) :
			$anc   = get_post_ancestors( $post->ID );
			$title = get_the_title();
			foreach ( $anc as $ancestor ) :
				$output = '<li class="breadcrumb-item"><a class="breadcrumb-item_link" href="' . get_permalink( $ancestor ) . '" title="' . get_the_title( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a></li>';
			endforeach;
			echo wp_kses_post( $output );
			echo '<li class="breadcrumb-item active">' . esc_html( $title ) . '</li>';
			else :
				echo '<li class="breadcrumb-item active">' . wp_kses_post( get_the_title() ) . '</li>';
				endif;
  endif;

	if ( is_tag() ) :
		echo '<li class="breadcrumb-item active">' . single_tag_title( '', false ) . '</li>';

  elseif ( is_day() ) :
	  echo '<li class="breadcrumb-item active">' . esc_html__( 'Archive for', 'okfnwp' ) . ' ' . esc_html( get_the_time( 'F jS Y' ) ) . '</li>';

  elseif ( is_month() ) :
	  echo '<li class="breadcrumb-item active">' . esc_html__( 'Archive for', 'okfnwp' ) . ' ' . esc_html( get_the_time( 'F Y' ) ) . '</li>';

  elseif ( is_year() ) :
	  echo '<li class="breadcrumb-item active">' . esc_html__( 'Archive for', 'okfnwp' ) . ' ' . esc_html( get_the_time( 'Y' ) ) . '</li>';

  elseif ( is_author() ) :
	  echo '<li class="breadcrumb-item active">' . esc_html__( 'Author Archive', 'okfnwp' ) . '</li>';

  elseif ( get_query_var( 'paged' ) && ! empty( get_query_var( 'paged' ) ) ) :
	  echo '<li class="breadcrumb-item active">' . esc_html__( 'Blog Archives', 'okfnwp' ) . '</li>';

  elseif ( is_search() ) :
	  echo '<li class="breadcrumb-item active">' . esc_html__( 'Search Results', 'okfnwp' ) . '</li>';
  endif;

  echo '</ol>';
}

/**
 * Render a single Read more anchor
 *
 * @return void
 */
function okfn_read_more_btn() {
	?>
  <a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'okfnwp' ); ?></a>
	<?php
}

/**
 * Backwards compatible function for rendering custom theme logos, where supported
 *
 * @return void
 */
function okfn_theme_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
