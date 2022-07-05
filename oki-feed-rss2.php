<?php
/**
 * RSS2 Feed Template for displaying RSS2 Posts feed.
 *
 * @package WordPress
 */

// phpcs:ignoreFile
// File is ingored because it is not written based on WordPress Community Standards and requires a refactor

header( 'Content-Type: ' . feed_content_type( 'rss2' ) . '; charset=' . esc_attr( get_bloginfo( 'charset' ) ), true );
$more = 1;

echo '<?xml version="1.0" encoding="' . esc_attr( get_bloginfo( 'charset' ) ) . '"?' . '>';

/**
 * Fires between the xml and rss tags in a feed.
 *
 * @since 4.0.0
 *
 * @param string $context Type of feed. Possible values include 'rss2', 'rss2-comments',
 *                        'rdf', 'atom', and 'atom-comments'.
 */

do_action( 'rss_tag_pre', 'rss2' );
?>
<rss version="2.0"
	 xmlns:content="http://purl.org/rss/1.0/modules/content/"
	 xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	 xmlns:dc="http://purl.org/dc/elements/1.1/"
	 xmlns:atom="http://www.w3.org/2005/Atom"
	 xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	 xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	 <?php
		/**
		 * Fires at the end of the RSS root to add namespaces.
		 *
		 * @since 2.0.0
		 */

		do_action( 'rss2_ns' );
		?>
	 >

  <channel>
	<title><?php wp_title_rss(); ?></title>
	<atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
	<link><?php bloginfo_rss( 'url' ); ?></link>
	<description><?php bloginfo_rss( 'description' ); ?></description>
	<lastBuildDate><?php echo esc_html( mysql2date( 'D, d M Y H:i:s +0000', get_lastpostmodified( 'GMT' ), false ) ); ?></lastBuildDate>
	<language><?php bloginfo_rss( 'language' ); ?></language>
	<sy:updatePeriod>
	<?php
	  $okf_duration = 'hourly';

	  /**
	   * Filters how often to update the RSS feed.
	   *
	   * @since 2.1.0
	   *
	   * @param string $okf_duration The update period. Accepts 'hourly', 'daily', 'weekly', 'monthly',
	   *                         'yearly'. Default 'hourly'.
	   */

	  echo esc_html( apply_filters( 'rss_update_period', $okf_duration ) );
	?>
	  </sy:updatePeriod>
	<sy:updateFrequency>
	<?php
	  $okf_frequency = '1';

	  /**
	   * Filters the RSS update frequency.
	   *
	   * @since 2.1.0
	   *
	   * @param string $okf_frequency An integer passed as a string representing the frequency
	   *                          of RSS updates within the update period. Default '1'.
	   */

	  echo esc_html( apply_filters( 'rss_update_frequency', $okf_frequency ) );
	?>
	  </sy:updateFrequency>
	<?php
	/**
	 * Fires at the end of the RSS2 Feed Header.
	 *
	 * @since 2.0.0
	 */

	do_action( 'rss2_head' );

	while ( have_posts() ) :
		the_post();
		?>
	  <item>
		<title><?php the_title_rss(); ?></title>
		<link><?php the_permalink_rss(); ?></link>
		<?php if ( get_comments_number() || comments_open() ) : ?>
		  <comments><?php comments_link_feed(); ?></comments>
		<?php endif; ?>
		<pubDate><?php echo esc_html( mysql2date( 'D, d M Y H:i:s +0000', get_post_time( 'Y-m-d H:i:s', true ), false ) ); ?></pubDate>
		<dc:creator><![CDATA[<?php the_author(); ?>]]></dc:creator>
		<?php
		$gravatar_img = okfn_get_avatar_img_url( 264 );
		if ( ! empty( $gravatar_img ) ) :
			?>
		  <enclosure url="<?php echo esc_attr( $gravatar_img ); ?>" length="N/A" type="image/jpeg" />
			<?php
		endif;
		the_category_rss( 'rss2' )
		?>
		<guid isPermaLink="false"><?php the_guid(); ?></guid>
		<?php if ( get_option( 'rss_use_excerpt' ) ) : ?>
		  <description><![CDATA[<?php the_excerpt_rss(); ?>]]></description>
		<?php else : ?>
		  <description><![CDATA[<?php the_excerpt_rss(); ?>]]></description>
			<?php $content = get_the_content_feed( 'rss2' ); ?>
			<?php if ( strlen( $content ) > 0 ) : ?>
			<content:encoded><![CDATA[<?php echo wp_kses_post( $content ); ?>]]></content:encoded>
		  <?php else : ?>
			<content:encoded><![CDATA[<?php the_excerpt_rss(); ?>]]></content:encoded>
		  <?php endif; ?>
		<?php endif; ?>
		<?php if ( get_comments_number() || comments_open() ) : ?>
		  <wfw:commentRss><?php echo esc_url( get_post_comments_feed_link( null, 'rss2' ) ); ?></wfw:commentRss>
		  <slash:comments><?php echo esc_html( get_comments_number() ); ?></slash:comments>
		<?php endif; ?>
		<?php rss_enclosure(); ?>
		<?php
		/**
		 * Fires at the end of each RSS2 feed item.
		 *
		 * @since 2.0.0
		 */

		do_action( 'rss2_item' );
		?>
	  </item>
	<?php endwhile; ?>
  </channel>
</rss>
