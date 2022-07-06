<?php
/**
 * Theme shortcodes library.
 *
 * @package OKFNWP
 */

/**
 * Name:        Pseudo Sidebar
 * Author:      Sam Smith
 * Description: Use to insert a sidebar into a single column page
 * Example:     [pseudocontent] ...Left Content... [/pseudocontent]
 *              [pseudosidebar] ...Right Content... [/pseudosidebar]
 *
 * @param array  $atts Contains shortcode attributes.
 * @param string $content Contains shortcode output.
 * @return string
 */
function okf_pseudocontent_shortcode( $atts, $content = null ) {
	return '<style type="text/css">#content {width: 100%;} #content #sidebar h5 {margin-top:0px;}</style>
<article class="span8" style="margin-left:0px;">' . do_shortcode( $content ) . '</article>';
}
add_shortcode( 'pseudocontent', 'okf_pseudocontent_shortcode' );

/**
 * Pseudo Sidebar wrapper
 *
 * @param array  $atts Contains shortcode attributes.
 * @param string $content Contains shortcode output.
 * @return string
 */
function okf_pseudosidebar_shortcode( $atts, $content = null ) {
	return '<div id="sidebar" role="complementary" class="span4 pseudo-sidebar">' . $content . '</div>';
}
add_shortcode( 'pseudosidebar', 'okf_pseudosidebar_shortcode' );

/**
 * Name: Carousel
 * Author: Sam Smith
 * Description: Use to insert a Bootstrap carousel
 * Example: [carousel]
 *             [slide img="http://slide1.jpg" class="active"]
 *             [slide img="http://slide2.jpg" caption="Caption Two"]
 *             slide img="http://slide3.jpg" heading="Heading Three" caption="Caption Three"]
 *          [/carousel]
 *
 * @param [type] $atts Contains shortcode attributes.
 * @param [type] $content Contains shortcode output.
 * @return $slide
 */
function okf_carousel_shortcode( $atts, $content = null ) {
	$args = shortcode_atts(
		array(
			'class' => '',
		),
		$atts
	);
	return '<div id="myCarousel" class="carousel slide ' . $args['class'] . '"><div class="carousel-inner">' . do_shortcode( $args['content'] ) . '</div><a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a><a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a></div><script>$("div.text-slide, div.calendar-slide").parent().addClass("not-photo");</script>';
}
add_shortcode( 'carousel', 'okf_carousel_shortcode' );

/**
 * Shortcode for [carousel] nested [slide] element
 *
 * @param array $atts Contains img, text, caption, class, heading and calendar attributes.
 * @return $slide
 */
function okf_carousel_slide_shortcode( $atts ) {
	$args = shortcode_atts(
		array(
			'img'      => '',
			'text'     => '',
			'caption'  => '',
			'class'    => '',
			'heading'  => '',
			'calendar' => '',
		),
		$atts
	);

	if ( ! empty( $args['calendar'] ) ) {
		$okf_google_calendar = '[google-calendar-events id="' . $args['calendar'] . '" type="ajax"]';
	}

	$okf_slide_open = '<div class="item ' . $args['class'] . '">';
	if ( ! empty( $args['img'] ) ) {
		$okf_slide_content = '<img src="' . $args['img'] . '">';
	} elseif ( ! empty( $args['text'] ) ) {
		$okf_slide_content = '<div class="text-slide">' . $args['text'] . '</div>';
	} elseif ( ! empty( $args['calendar'] ) ) {
		$okf_slide_content = '<div class="calendar-slide">' . do_shortcode( $okf_google_calendar ) . '</div>';
	} else {
		$okf_slide_content = '<img src="http://farm8.staticflickr.com/7174/6554801385_83acdc501d_o_d.png">';
	}
	if ( ! empty( $args['caption'] ) ) {
		$okf_slide_caption_open = '<div class="carousel-caption">';
	}
	if ( ! empty( $args['caption'] ) ) {
		$okf_slide_heading = '<h2>' . $args['caption'] . '</h2>';
	}
	if ( ! empty( $args['caption'] ) ) {
		$okf_slide_caption = '' . $args['caption'] . ' </div>';
	}
	$okf_slide_close = '</div>';

	$slide = $okf_slide_open . $okf_slide_content . $okf_slide_caption_open . $okf_slide_heading . $okf_slide_caption . $okf_slide_close;

	return $slide;
}
add_shortcode( 'slide', 'okf_carousel_slide_shortcode' );

/**
 * Name: ZCarousel
 * Author: Tom Rees
 * Description: Use to insert a zcarousel (http://zephod.github.com/jquery.zcarousel)
 * Example: [zcarousel]
 *              [zslide img="http://slide1.jpg" ] Caption here [/zslide]
 *              [zslide img="http://slide2.jpg" ] Another caption here [/zslide]
 *              [zslide img="http://slide3.jpg" ] Also here [/zslide]
 *          [/zcarousel]
 *
 * @param array  $atts Contains shortcode attributes.
 * @param string $content Contains shortcode content.
 * @return string
 */
function okf_zcarousel_shortcode( $atts, $content = null ) {
	return '<div id="zcarousel" style="width: 940px; height: 250px; "></div><script>var data=[];' . do_shortcode( $content ) . 'jQuery("#zcarousel").zcarousel(data);</script>';
}
add_shortcode( 'zcarousel', 'okf_zcarousel_shortcode' );

/**
 * Shortcode for [zcarousel] nested [zslide] element
 *
 * @param [type] $atts Contains shortcode img attribute.
 * @param [type] $content Contains shortcode content.
 * @return string
 */
function okf_zcarousel_slide_shortcode( $atts, $content = null ) {
	$args = shortcode_atts(
		array(
			'img' => '//farm8.staticflickr.com/7174/6554801385_83acdc501d_o_d.png',
		),
		$atts
	);
	return 'data.push({"url":"' . $args['img'] . '","caption":"' . $content . '"});';
}
add_shortcode( 'zslide', 'okf_zcarousel_slide_shortcode' );

/**
 * Name: Banner
 * Author: Sam Smith
 * Description: Simple banner with text on the right
 * Example: [banner bg="http://domain.com/bg-image.jpg"]Banner text here.[/banner]
 *
 * @param [type] $atts Contains bg, height, bgcolour and class shortcode attributes.
 * @param [type] $content Contains shortcode content.
 * @return string
 */
function okf_banner_shortcode( $atts, $content = null ) {
	$args      = shortcode_atts(
		array(
			'bg'       => '//assets.okfn.org/web/images/banner.png',
			'height'   => '320',
			'bgcolour' => 'd4d4d4',
			'class'    => '',
		),
		$atts
	);
	$padheight = $args['height'] - 40;
	return '<div class="static-banner ' . $args['class'] . '" style="background-image:url(' . $args['bg'] . '); height:' . $padheight . 'px; background-color:#' . $args['bgcolour'] . ';"><div class="inner">' . do_shortcode( $content ) . '</div></div>';
}

add_shortcode( 'banner', 'okf_banner_shortcode' );

/**
 * Name:        Hide Page Title
 * Author:      Sam Smith
 * Description: Use to hide the page title
 *
 * @param array $atts Contains shortcode attributes.
 * @return string
 */
function okf_notitle_shortcode( $atts ) {
	return '<style type="text/css"> .pagetitle { display: none; } </style>';
}
add_shortcode( 'notitle', 'okf_notitle_shortcode' );

/**
 * Name: Full Width
 * Author: Sam Smith
 * Description: Force content div to be 100% wide
 *
 * @param array $atts Contains shortcode attributes.
 * @return string
 */
function okf_fullwidth_shortcode( $atts ) {
	return '<script>$("#content").addClass("fullwidth");</script>';
}
add_shortcode( 'fullwidth', 'okf_fullwidth_shortcode' );


 /**
  * Name: BS Columns
  * Author: Sam Smith
  * Description: Divide single column. Span is a number of the 12 Bootstrap columns.
  * Example: [row]
  *             [column span="6"]Left Column[/column]
  *             [column span="6"]Right Column[/column]
  *          [/row]
  *
  * @param array  $atts Contains class and style shortcode attributes.
  * @param string $content Contains the shortcode content.
  * @return string
  */
function okf_row_shortcode( $atts, $content = null ) {
	$args   = shortcode_atts(
		array(
			'class' => '',
			'style' => '',
		),
		$atts
	);
	$styles = '';
	if ( ! empty( $args['style'] ) ) {
		$styles = ' style="' . $args['style'] . '"';
	}

	return '<div class="row ' . $args['class'] . '"' . $styles . '>' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'row', 'okf_row_shortcode' );

/**
 * Shortcode for [row] nested [column] element
 *
 * @param array  $atts Contains span, offset, class and style shortcode attributes.
 * @param string $content Contains the shortcode content.
 * @return string
 */
function okf_column_shortcode( $atts, $content = null ) {
	$args   = shortcode_atts(
		array(
			'span'   => '12',
			'offset' => '0',
			'class'  => '',
			'style'  => '',
		),
		$atts
	);
	$styles = '';
	if ( ! empty( $args['style'] ) ) {
		$styles = ' style="' . $args['style'] . '"';
	}

	return '<div class="span' . $args['span'] . ' offset' . $args['offset'] . ' ' . $args['class'] . '"' . $styles . '>' . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'column', 'okf_column_shortcode' );

/**
 * Name: Clear
 * Author: Sam Smith
 * Description: Clear floats
 *
 * @param array $atts Contains shortcode attributes.
 * @return string
 */
function okf_clear_shortcode( $atts ) {
	return '<br style="clear:both;" />';
}
add_shortcode( 'clear', 'okf_clear_shortcode' );

 /**
  * Name: Grid List
  * Author: Sam Smith
  * Description: Use to present a list in a grid format
  * Example: [gl]
  *             [gli title="Title One" description="Description One"]
  *             [gli title="Title Two" description="Description Two"]
  *             [gli title="Title Three" description="Description Three" link="http://link.com"]
  *          [/gl]
  *
  * @param array  $atts Contains columns shortcode attribute.
  * @param string $content Contains shortcode content.
  * @return string
  */
function okf_gridlist_shortcode( $atts, $content = null ) {
	$args = shortcode_atts(
		array(
			'columns' => '3',
		),
		$atts
	);
	return '<dl class="grid-list columns' . $args['columns'] . '">' . do_shortcode( $content ) . '<br style="clear:both;" /></dl>';
}
add_shortcode( 'gl', 'okf_gridlist_shortcode' );

/**
 * Shortcode for [gl] nested [gli] element
 *
 * @param array $atts Contains title, description, link, icon and image shortcode attributes.
 * @return string
 */
function okf_gridlist_item_shortcode( $atts ) {
	$args = shortcode_atts(
		array(
			'title'       => '',
			'description' => '',
			'link'        => '',
			'icon'        => '',
			'image'       => '',
		),
		$atts
	);

	if ( ! empty( $args['icon'] ) && ! empty( $args['link'] ) ) {
		return '<a href="' . $args['link'] . '" class="well"><dt><img src="' . $args['icon'] . '" alt="' . $args['title'] . '" class="icon"><div class="title">' . $args['title'] . '</div></dt>
							<dd>' . $args['description'] . '</dd></a>';
	} elseif ( ! empty( $args['image'] ) && ! empty( $args['link'] ) ) {
		return '<a href="' . $args['link'] . '" class="well"><dt><span class="image"><img src="' . $args['image'] . '" alt="' . $args['title'] . '"></span><h3>' . $args['title'] . '</h3></dt>
							<dd>' . $args['description'] . '</dd></a>';
	} elseif ( ! empty( $args['link'] ) ) {
		return '<a href="' . $args['link'] . '" class="well"><dt>' . $args['title'] . '</dt>
							<dd>' . $args['description'] . '</dd></a>';
	} elseif ( ! empty( $args['icon'] ) ) {
		return '<div class="well"><dt><img src="' . $args['icon'] . '" alt="' . $args['title'] . '" class="icon"><div class="title">' . $args['title'] . '</div></dt>
							<dd>' . $args['description'] . '</dd></div>';
	} elseif ( ! empty( $args['image'] ) ) {
		return '<div class="well"><dt><span class="image"><img src="' . $args['image'] . '" alt="' . $args['title'] . '"></span><h3>' . $args['title'] . '</h3></dt>
							<dd>' . $args['description'] . '</dd></div>';
	} else {
		return '<div class="well"><dt>' . $args['title'] . '</dt>
							<dd>' . $args['description'] . '</dd></div>';
	}
}
add_shortcode( 'gli', 'okf_gridlist_item_shortcode' );


// phpcs:disable

/**
 * Name:        RSS
 * Author:      Sam Smith
 * Description: RSS feed reader based on BS & http://www.kevinleary.net/display-rss-feeds-wordpress-shortcodes-simplepie-fetch_feed/
 * Example:     [rss size="10" feed="http://wordpress.org/news/feed/" date="true"]
 */

if ( function_exists( 'base_rss_feed' ) && ! function_exists( 'base_rss_shortcode' ) ) {
	function base_rss_shortcode( $atts ) {
		$args = shortcode_atts(
			array(
				'size'  => '10',
				'feed'  => 'http://wordpress.org/news/feed/',
				'date'  => false,
				'class' => '',
				'id'    => '1',
				'type'  => '',
			),
			$atts
		);

		$content = base_rss_feed( $args['size'], $args['feed'], $args['date'] );
		if ( 'ticker' == $args['type'] ) {
			return '<div id="rss' . $args['id'] . '" class="rss ticker carousel slide size' . $args['size'] . ' ' . $args['class'] . '">' . $content . '
			<a class="carousel-control left" href="#rss' . $args['id'] . '" data-slide="prev">&lsaquo;</a>
			<a class="carousel-control right" href="#rss' . $args['id'] . '" data-slide="next">&rsaquo;</a></div>
			<script>
			$("#rss' . $args['id'] . ' .feedlist li").addClass("item");
			$("#rss' . $args['id'] . ' .feedlist li:first-of-type").addClass("active");
			</script>';
		} else {
			return '<div class="rss size' . $args['size'] . ' ' . $args['class'] . '">' . $content . '</div>';
		}
	}
	add_shortcode( 'rss', 'base_rss_shortcode' );
} // phpcs:enable

/**
 * Name: Accordion
 * Author: Sam Smith
 * Description: Uses bootstrap-collapse.js
 * Example: [accordions]
 *             [accordion heading="Heading One" class="in"] tab content [/accordion]
 *             [accordion heading="Heading Two"] another content tab [/accordion]
 *          [/accordions]
 *
 * @param array  $atts Contains class shortcode attribute.
 * @param string $content Contains shortcode content.
 * @return string
 */
function okf_accordions_shortcode( $atts, $content = null ) {
	$args      = shortcode_atts(
		array(
			'class' => 'accordion',
		),
		$atts
	);
	static $id = 0;
	$id++;
	return '<div id="accordion' . $id . '" class="' . $args['class'] . '">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'accordions', 'okf_accordions_shortcode' );

/**
 * Shortcode for [accordions] nested [accordion] element
 *
 * @param array  $atts Contains heading and class shortcode attributes.
 * @param string $content Contains shortcode content.
 * @return string
 */
function okf_accordion_shortcode( $atts, $content = null ) {
	$args            = shortcode_atts(
		array(
			'heading' => 'Please enter a heading attribute like [accordion heading="My Heading"]',
			'class'   => '',
		),
		$atts
	);
	static $collapse = 0;
	$collapse++;
	return '<div class="accordion-group">
		         <div class="accordion-heading">
						   <a class="accordion-toggle" href="#collapse' . $collapse . '" data-toggle="collapse">
							   ' . $args['heading'] . '
							</a>
						 </div>
						 <div id="collapse' . $collapse . '" class="accordion-body collapse ' . $args['class'] . '">
						  <div class="accordion-inner">
							' . do_shortcode( $content ) . '
							</div>
					  </div>
					</div>';
}
add_shortcode( 'accordion', 'okf_accordion_shortcode' );

/**
 * Name: Sticky Element
 * Author: Sam Smith
 * Description: Switch element to fixed position, based on scrolling
 *
 * @param array $atts Contains scroll, class and id shortcode attributes.
 * @return string
 */
function okf_sticky_shortcode( $atts ) {
	$args = shortcode_atts(
		array(
			'scroll' => '65',
			'class'  => 'subnav',
			'id'     => '$el',
		),
		$atts
	);
	return '<script>$(window).scroll(function(e){
  ' . $args['id'] . " = $('." . $args['class'] . "');
  if ($(this).scrollTop() > " . $scroll . ' && ' . $args['id'] . ".css('position') != 'fixed'){
    $('." . $args['class'] . "').css({'position': 'fixed', 'top': '0px'});
		$('body').removeClass('top');
  }
	if ($(this).scrollTop() < " . $scroll . ' && ' . $args['id'] . ".css('position') == 'fixed') {
	  $('." . $args['class'] . "').css({'position': 'absolute', 'top': '0px'});
		$('body').addClass('top');
	}
});
$('body').addClass('sticky-" . $args['class'] . " top');
</script>";
}
add_shortcode( 'sticky', 'okf_sticky_shortcode' );

 /**
  * Name: Login Form
  * Author: http://pippinsplugins.com/wordpress-login-form-short-code/
  * Description: Display the WordPress login form within the content of one of the site’s pages
  *
  * @param array  $atts Contains redirect shortcode attribute.
  * @param string $content Contains shortcode content.
  * @return $form
  */
function okf_pippin_login_form_shortcode( $atts, $content = null ) {

	$args = shortcode_atts(
		array(
			'redirect' => '',
		),
		$atts
	);

	if ( ! is_user_logged_in() ) {
		if ( $args['redirect'] ) {
			$redirect_url = $redirect;
		} else {
			$redirect_url = get_permalink();
		}
		$form = wp_login_form(
			array(
				'echo'     => false,
				'redirect' => $redirect_url,
			)
		);
	}
	return $form;
}
add_shortcode( 'loginform', 'okf_pippin_login_form_shortcode' );

 /**
  * Name: Menu Pod
  * Author: Sam Smith
  * Description: Expanding menu
  * Example: [menupod icon="cog/bubble/heart" link="http://link.com" heading="Heading Here" subheading="Subheading Here"]
  *              [menupoditem text="Text here" link="http://link.com"]
  *          [/menupod]
  *
  * @param array  $atts Contains icon, link, heading and subheading shortcode attributes.
  * @param string $content Contains shortcode content.
  * @return string
  */
function okf_menupod_shortcode( $atts, $content = null ) {
	$args = shortcode_atts(
		array(
			'icon'       => 'cog',
			'link'       => '#',
			'heading'    => 'Heading Here',
			'subheading' => '',
		),
		$atts
	);
	return '<div class="okfn-dropdown">
		 <a href="' . $args['link'] . '" class="background-' . $args['icon'] . '">
			<h5>' . $args['heading'] . '</h5>
			<p>' . $args['subheading'] . '</p>
		</a>
		<div class="okfn-dropdown-items">'
		. do_shortcode( $content ) .
		'</div>
	</div>';
}
add_shortcode( 'menupod', 'okf_menupod_shortcode' );

/**
 * Shortcode for [menupod] nested [menupoditem] element
 *
 * @param array $atts Contains text and link shortcode attributes.
 * @return string
 */
function okf_menupoditem_shortcode( $atts ) {
	$args = shortcode_atts(
		array(
			'text' => 'Text here',
			'link' => '#',
		),
		$atts
	);

	return '<a href="' . $args['link'] . '">' . $args['text'] . '</a>';
}

add_shortcode( 'menupoditem', 'okf_menupoditem_shortcode' );

/**
 * Name: Latest Posts
 * Author: Sam Smith
 * Description: Show lastest blog posts, number to show defined by postnumber attribute
 *
 * @param array $atts Contains postnumber, category and class shortcode attributes.
 * @return string
 */
function okf_latest_posts_shortcode( $atts ) {
	$args = shortcode_atts(
		array(
			'postnumber' => '3',
			'category'   => '',
			'class'      => '',
		),
		$atts
	);

	$q = new WP_Query(
		array(
			'orderby'        => 'date',
			'posts_per_page' => '' . $args['postnumber'] . '',
			'category_name'  => '' . $args['category'] . '',
		)
	);

	$list = '<ul class="latest-posts posts' . $args['postnumber'] . ' ' . $args['class'] . '">';

	while ( $q->have_posts() ) :
		$q->the_post();
		// Extract the first img src from the post body.
		$regex = '/magazine.image\s*=\s*"?([^"\s]*)/';
		preg_match( $regex, get_the_content(), $matches );
		$post_img = '//assets.okfn.org/web/images/blog-placeholder.png';
		if ( count( $matches ) ) {
			$post_img = $matches[1];
		}

		// phpcs:ignore
		$list .= '<li><a href="' . get_permalink() . '" class="box"><span class="image" style="background-image:url(' . $post_img . ');"></span><div class="text"><h4 class="title">' . get_the_title() . '</h4><p class="date">' . get_the_date() . '</p>' . '<span>' . get_the_excerpt() . '</span></div></a></li>';

	endwhile;

	wp_reset_query();

	return $list . '</ul>
		<script>
	jQuery(document).ready(function() {
				jQuery(".latest-posts li .text").dotdotdot({
						//  configuration goes here
				});
		});
</script>';
}
add_shortcode( 'latest_posts', 'okf_latest_posts_shortcode' );

/**
 * Name: Flickr Banner
 * Author: Sam Smith
 * Description: Requires FlickrRss plugin, with this content: <span style="background-image:url(%image_small%);"></span>
 *
 * @param array  $atts Contains id, set and link shortcode attributes.
 * @param string $content Contains shortcode content.
 * @return string
 */
function okf_fbanner_shortcode( $atts, $content = null ) {
	$args = shortcode_atts(
		array(
			'id'   => '50136062@N03',
			'set'  => '72157631690090162',
			'link' => '',
		),
		$atts
	);

	if ( y == $args['link'] ) {
		$open = '<a href="//www.flickr.com/photos/' . $args['id'] . '/sets/' . $args['set'] . '/show/" class="flickr banner"><span class="inner">';
	} else {
		$open = '<div class="flickr banner"><div class="inner">';
	}
	ob_start();
	get_flickrRSS(
		array(
			'set'       => $args['set'],
			'num_items' => 18,
			'type'      => 'set',
			'id'        => $args['id'],
		)
	);
	$images = ob_get_clean();
	if ( y == $args['link'] ) {
		$close = '<div class="text">' . do_shortcode( $content ) . '</div></span></a>';
	} else {
		$close = '<div class="text">' . do_shortcode( $content ) . '</div></div></div>';
	}
	$banner = $open . $images . $close;
	return $banner;
}
add_shortcode( 'fbanner', 'okf_fbanner_shortcode' );

/**
 * Name: HeaderImage
 * Author: Sam Smith
 * Description: Put page title inside a small banner image
 *
 * @param array $atts Contains image, break, width and offset shortcode attributes.
 * @return string
 */
function okf_himg_shortcode( $atts ) {
	$args = shortcode_atts(
		array(
			'image'  => '',
			'break'  => '',
			'width'  => '340',
			'offset' => '0',
		),
		$atts
	);
	if ( ! empty( $args['image'] ) ) {
		$bgimg = 'style="background-image:url(' . $args['image'] . '); background-position: ' . $offset . 'px bottom;"';
	} else {
		$bgimg = '';
	}
	if ( ! empty( $break ) ) {
		return '<div class="himg" ' . $bgimg . '></div><style>#content h1.pagetitle {position:absolute;right:30px;top:10px;width:' . $width . 'px;height:96px;overflow:hidden;text-align:right;text-transform:uppercase;font-size:36px;line-height:31px;}#content h1.pagetitle:first-line {color:#6a6a6a;}</style><script>var html = $(".pagetitle").html();
html = html.substring(0, ' . $break . ') + "<br>" + html.substring(' . $break . ');
$(".pagetitle").html(html);</script>';
	} else {
		return '<div class="himg" ' . $bgimg . '></div><style>#content h1.pagetitle {position:absolute;right:30px;top:10px;width:' . $width . 'px;height:96px;overflow:hidden;text-align:right;text-transform:uppercase;font-size:36px;line-height:31px;}#content h1.pagetitle:first-line {color:#6a6a6a;}</style>';
	}
}
add_shortcode( 'himg', 'okf_himg_shortcode' );

/**
 * Name: MailMan
 * Author: Sam Smith
 * Description: Inline subscribe form
 *
 * @param array $atts Contains domain, list, button and popup shortcode attributes.
 * @return string
 */
function okf_mailman_shortcode( $atts ) {
	$args = shortcode_atts(
		array(
			'domain' => 'http://lists.okfn.org',
			'list'   => '',
			'button' => 'Subscribe',
			'popup'  => '',
		),
		$atts
	);

	if ( ! empty( $args['popup'] ) ) {
		$mailman = '<div class="' . $args['popup'] . ' mailman-popup"><div class="icon"></div><p>' . __( 'Get updates from', 'okfnwp' ) . ' ' . get_bloginfo( 'sitename' ) . ' ' . __( 'in your inbox', 'okfnwp' ) . '</p><form method="post" action="' . $args['domain'] . '/mailman/subscribe/' . $args['list'] . '">
<div class="field"><input name="email" type="email" placeholder="your email address"></div>
<input type="submit" name="email-button" value= "' . $button . '" class="btn btn-large btn-inverse">
</form></div>';
	} else {
		$mailman = '<form method="post" action="' . $args['domain'] . '/mailman/subscribe/' . $args['list'] . '">
<label>Name</label>
<input name="fullname" type="text">
<label>E-mail Address</label>
<input name="email" type="email">
<p style="margin-top:10px;"><input type="submit" name="email-button" value= "' . $args['button'] . '"></p>
</form>';
	}

	return $mailman;
}
add_shortcode( 'mailman', 'okf_mailman_shortcode' );

/**
 * Name: Image List
 * Author: Sam Smith
 * Description: Use to present a list in a grid format
 * Example: [il]
 *              [ili image="http://assets.okfn.org/web/images/blog-placeholder.png" title="Title One" description="Description One"]
 *              [ili image="http://assets.okfn.org/web/images/blog-placeholder.png" title="Title Two" description="Description Two"]
 *              [ili image="http://assets.okfn.org/web/images/blog-placeholder.png" title="Title Three" description="Description Three"]
 *          [/il]
 *
 * @param array  $atts Contains shortcode attributes.
 * @param string $content Contains shortcode output.
 * @return string
 */
function okf_imagelist_shortcode( $atts, $content = null ) {
	$args = shortcode_atts(
		array(),
		$atts
	);
	return '<ul class="image-list">' . do_shortcode( $content ) . '</ul>';
}
add_shortcode( 'il', 'okf_imagelist_shortcode' );

/**
 * Shortcode for generating an image list item
 *
 * @param array $atts Contains title, description, link and image shortcode attributes.
 * @return string
 */
function okf_imagelist_item_shortcode( $atts ) {
	$args = shortcode_atts(
		array(
			'title'       => '',
			'description' => '',
			'link'        => '',
			'image'       => 'http://assets.okfn.org/web/images/blog-placeholder.png',
		),
		$atts
	);

	if ( ! empty( $args['link'] ) ) {
		return '<a href="' . $args['link'] . '">
							<li>
							<span class="image" style="background-image:url(' . $args['image'] . ');"></span>
							<span class="text">
							<h3>' . $args['title'] . '</h3>
							' . $args['description'] . '
							</span>
							</li>
							</a>';
	} else {
		return '<li>
							<span class="image" style="background-image:url(' . $args['image'] . ');"></span>
							<span class="text">
							<h3>' . $args['title'] . '</h3>
							' . $args['description'] . '
							</span>
							</li>';
	}
}
add_shortcode( 'ili', 'okf_imagelist_item_shortcode' );


/**
 * Name: Scroll Me
 * Author: Sam Smith
 * Description: Makes all links which start with a # have an animated scroll to the target.
 *
 * @param array $atts Contains duration shortcode attribute.
 * @return string
 */
function okf_scrollme_shortcode( $atts ) {
	$args = shortcode_atts(
		array(
			'duration' => '900',
		),
		$atts
	);
	return "<script>
   $('a[href^=\"#\"]').on('click',function (e) {
	    e.preventDefault();
	    var target = this.hash,
	    \$target = \$(target);
	    $('html, body').stop().animate({
	        'scrollTop': \$target.offset().top
	    }, " . $args['duration'] . ", 'swing', function () {
	        window.location.hash = target;
	    });
	});
</script>";
}
add_shortcode( 'scrollme', 'okf_scrollme_shortcode' );


/**
 * Name: Tweeter
 * Author: Sam Smith
 * Description: Shows a Twitter ticket, requires JM Last Twit Shortcode plugin
 *
 * @param array $atts Contains total, user, id shortcode attributes.
 * @return string
 */
function okf_tweeter_shortcode( $atts ) {
	$args = shortcode_atts(
		array(
			'total' => '10',
			'user'  => '',
			'id'    => '1',
		),
		$atts
	);
	$open = '<div id="tweeter' . $args['id'] . '" class="tweeter carousel slide ticker">';
	if ( ! empty( $args['user'] ) ) {
		$jmlt = do_shortcode( '[jmlt count="' . $args['total'] . '" username="' . $args['user'] . '"]' );
	} else {
		$jmlt = do_shortcode( '[jmlt count="' . $args['total'] . '"]' );
	}
	$close = '</div>';

	return $open . $jmlt . $close;
}
add_shortcode( 'tweeter', 'okf_tweeter_shortcode' );
