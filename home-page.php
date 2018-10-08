<?php
/*
Template Name: Home
 */

/* body class="magazine" */
add_filter('body_class','browser_body_class');
function browser_body_class($classes = '') {
  array_push($classes,"magazine home-template");
  return $classes;
}

    // Get options
    global $options;
	foreach ($options as $value) {
		if (isset($value['id'], $value['std'])):
		  $option_value = get_option($value['id'], $value['std']);
		  if (isset($option_value)):
			if (version_compare(PHP_VERSION, '7.0.0', '>=')) {
			  ${$value['id']} = $option_value;
			} else {
			  $$value['id'] = $option_value;
			}
		  endif;
		endif;
	  }
		if (!empty($okfn_home_featured)) {
		  $featured_cat = $okfn_home_featured;
		} else {
			$featured_cat = 'Featured';
		}
?>

<?php get_header() ?>
<div class="row">
  <div id="content" class="span12">
    <div class="padder">

    <?php do_action( 'template_notices' ) ?>

    <div class="page" id="blog-latest" role="main">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
		<?php endwhile; endif; ?>
    <h3 class="blog-latest-heading"><?php echo __("From our Blog", "okfn")?></h3>
    <div class="posts">
    <?php
    /* =================== */
    /* == Magazine Body == */
    /* =================== */
      $post_filter_main = array('category_name' => $featured_cat, 'posts_per_page' => 1 );

      $idsToSkip = array();
      // Print the main post
      query_posts( $post_filter_main );
      if (have_posts()) {
        the_post();
      //echo_magazine_post($post, true);
        // Skip that post's ID in the remining section
      //array_push($idsToSkip, $post->ID);
      }

      // Query remaining posts
      $post_filter_etc = array('category_name' => $featured_cat, 'posts_per_page' => 4, 'post__not_in' => $idsToSkip);

      // Print the remaining posts
      query_posts( $post_filter_etc );
      while (have_posts()) {
        the_post();
        echo_magazine_post($post, false);
      }
    /* =================== */
    ?>
    </div>
    </div>

    </div><!-- .padder -->
</div><!-- #content -->
<?php //get_sidebar() ?>
</div>
<?php get_footer() ?>


<script>
	jQuery(document).ready(function() {
          jQuery(".post.preview .text").dotdotdot({});
					jQuery(".post.preview .text h2").dotdotdot({});
        });
</script>
