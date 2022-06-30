<?php

$theme_options = get_option( 'theme_options_option_name' );

if ( ! empty( $theme_options['okfnwp_fb_id'] ) ) {
	?>
<li class="nav-item">
  <a class="facebook nav-link" href="https://www.facebook.com/<?php echo isset( $theme_options['okfnwp_fb_id'] ) ? esc_attr( $theme_options['okfnwp_fb_id'] ) : 'OKFNetwork'; ?>">Facebook</a>
</li>
	<?php
}
if ( ! empty( $theme_options['okfnwp_twitter_id'] ) ) {
	?>
<li class="nav-item">
  <a class="twitter nav-link" href="https://twitter.com/<?php echo isset( $theme_options['okfnwp_twitter_id'] ) ? esc_attr( $theme_options['okfnwp_twitter_id'] ) : 'okfn'; ?>">Twitter</a>
</li>
	<?php
}
if ( ! empty( $theme_options['okfnwp_discuss_id'] ) ) {
	?>
<li class="nav-item">
  <a class="discuss nav-link" href="https://discuss.okfn.org/<?php echo isset( $theme_options['okfnwp_discuss_id'] ) ? esc_attr( $theme_options['okfnwp_discuss_id'] ) : ''; ?>"><?php _e( 'Forum', 'okfnwp' ); ?></a>
</li>
	<?php
}
if ( ! empty( $theme_options['okfnwp_donate_url'] ) ) {
	?>
<li class="nav-item">
  <a class="nav-link" href="<?php echo $theme_options['okfnwp_donate_url']; ?>">
	<?php _e( 'Donate', 'okfnwp' ); ?>
  </a>
</li>
	<?php
}
if ( ! empty( $theme_options['okfnwp_newsletter_url'] ) ) {
	?>
<li class="nav-item">
  <a class="nav-link" href="<?php echo $theme_options['okfnwp_newsletter_url']; ?>">
	<?php _e( 'Subscribe', 'okfnwp' ); ?>
  </a>
</li>
	<?php
}
?>
