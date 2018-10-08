<?php get_header() ?>
<div class="row">
	<div id="content" class="search-page span8">
		<div class="padder">

		<div class="page" id="blog-search" role="main">

			<!--<h2 class="pagetitle"><?php _e( 'Site', 'buddypress' ) ?></h2> -->

			<?php if (have_posts()) : ?>
      <h1 class="pagetitle">
      Search Results for <?php the_search_query(); ?>
      </h1>
				<!--<h3 class="pagetitle"><?php _e( 'Search Results', 'buddypress' ) ?></h3> -->

				<?php while (have_posts()) : the_post(); ?>

					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<!--<div class="author-box">
							<?php echo get_avatar( get_the_author_meta( 'email' ), '50' ); ?>
							<p><?php printf( _x( 'by %s', 'Post written by...', 'buddypress' ), get_the_author_posts_link() ) ?></p>
						</div> -->

						<div class="post-content">
							<h3 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'buddypress' ) ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

							<!--<p class="date"><?php printf( __( '%1$s <span>in %2$s</span>', 'buddypress' ), get_the_date(), get_the_category_list( ', ' ) ); ?></p> -->

							<div class="entry">
								<?php //the_content( __( 'Read the rest of this entry &rarr;', 'buddypress' ) ); ?>
                <?php the_excerpt(); ?>
							</div>

							<!--<p class="postmetadata"><?php the_tags( '<span class="tags">' . __( 'Tags: ', 'buddypress' ), ', ', '</span>' ); ?> <span class="comments"><?php comments_popup_link( __( 'No Comments &#187;', 'buddypress' ), __( '1 Comment &#187;', 'buddypress' ), __( '% Comments &#187;', 'buddypress' ) ); ?></span></p> -->
						</div>

					</div>

				<?php endwhile; ?>

			<?php else : ?>

				<h2 class="center"><?php _e( 'No posts found. Try a different search?', 'buddypress' ) ?></h2>
				<?php get_search_form() ?>

			<?php endif; ?>

		</div>

		</div><!-- .padder -->
	</div><!-- #content -->
  <div id="sidebar" class="span4" role="complementary">
	<?php get_sidebar() ?>
  </div>
</div>
<?php get_footer() ?>
