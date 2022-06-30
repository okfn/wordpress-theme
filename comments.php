<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package OKFNWP
 */
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

  <?php if ( have_comments() ) : ?>

	<h2 class="comments-title">
		<?php
		  // translators: %1$s stands for number of comments and %2$s for the post title
		esc_html( printf( esc_html( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'okfnwp' ) ), esc_html( number_format_i18n( get_comments_number() ) ), get_the_title() ) );
		?>
	</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	  <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<h1 class="sr-only"><?php esc_html_e( 'Comment navigation', 'okfnwp' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'okfnwp' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'okfnwp' ) ); ?></div>
	  </nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>

	<ol class="comment-list">
		<?php
		wp_list_comments(
			array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 34,
			)
		);
		?>
	</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	  <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<h1 class="sr-only"><?php esc_html_e( 'Comment navigation', 'okfnwp' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'okfnwp' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'okfnwp' ) ); ?></div>
	  </nav><!-- #comment-nav-below -->
	<?php endif; // Check for comment navigation. ?>

		<?php if ( ! comments_open() ) : ?>
	  <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'okfnwp' ); ?></p>
	<?php endif; ?>

  <?php endif; // have_comments() ?>

  <?php comment_form(); ?>

</div><!-- #comments -->
