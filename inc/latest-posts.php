<?php

/**
 * Output latest posts in a 3 column row
 */
function latest_posts( $atts ) {

	$atts = shortcode_atts(
		array(
			'title' => __( 'Latest posts from the blog', 'okfnwp' ),
		),
		$atts
	);

	ob_start();

	?>
  <section class="list-posts">
	<h3><?php echo esc_html( $atts['title'] ); ?></h3>
	<div class="row">
	  <?php

		$posts = new WP_Query( 'post_type=post&posts_per_page=3&ignore_sticky_posts=true' );
		while ( $posts->have_posts() ) :
			$posts->the_post();

			// Get post category
			$categories = get_the_category();

			?>
			<div class="col-sm-4 col-xs-12">
			<?php get_template_part( 'content-post-thumb' ); ?>
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<?php

			the_excerpt();
			okfn_read_more_btn();

			?>
			</div>
			<?php

	  endwhile;
		wp_reset_query();

		?>
	</div>
  </section>
	<?php

	$content = ob_get_contents();
	ob_end_clean();
	return $content;

}

add_shortcode( 'latestposts', 'latest_posts' );
