<?php

/**
 * @package OKFNWP
 */

?>

<div class="col-md-6 post--blog post--excerpt">

	<?php get_template_part( 'content-post-thumb' ); ?>

	<h4 class="post-title"><a class="post-title_link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	<p class="post__meta">
	<?php
	// translators: %1$s stands for the post publish date
	echo esc_html( sprintf( __( 'Posted %1$s', 'okfnwp' ), get_the_date() ) );
	?>
	</p>

	<?php

	the_excerpt();
	okfn_read_more_btn();

	?>
</div>
