<?php
/**
 * [foundation] theme functions and definitions
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @category  Theme
 * @package   [foundation]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */

global $of_options, $data;

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 540;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override foundation_setup() in a child theme, add your own foundation_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links and Post Formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since [foundation] 1.0
 */
function foundation_setup() {
	// SET THEME LANGUAGES DIRECTORY
	// Theme translations can be filed in the my_theme/languages/ directory
	load_theme_textdomain( 'foundation', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style( 'stylesheets/editor-style.css' );

	// Adds support for rss links
	add_theme_support( 'automatic-feed-links' );

	// Add support for a variety of post formats (http://codex.wordpress.org/Post_Formats)
	// Child Themes inherit the post formats defined by the parent theme
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

	// Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 540, 230, true ); // Default Thumbnail Image

	// Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
	register_nav_menu( 'primary', __( 'Primary menu', 'foundation' ) );

	/* Options Framework */
	locate_template( 'options.php', true );
	locate_template( 'admin/index.php', true );

	do_action( 'foundation_setup' );
}

add_action( 'after_setup_theme', 'foundation_setup' );

/**
 * Some cleanup
 *
 * @since [foundation] 1.0
 * @return void
 */
function foundation_init() {
	// autolinks in comments
	remove_filter( 'comment_text', 'make_clickable', 9 );

	// Display the links to the general feeds: Post and Comment Feed
	remove_action( 'wp_head', 'feed_links', 2 );

	// Display the links to the extra feeds such as category feeds
	remove_action( 'wp_head', 'feed_links_extra', 3 );

	// Display the link to the Really Simple Discovery service endpoint, EditURI link
	remove_action( 'wp_head', 'rsd_link' );

	// Display the link to the Windows Live Writer manifest file.
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

	// index link
	remove_action( 'wp_head', 'index_rel_link' );

	// prev link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );

	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

	// Display relational links for the posts adjacent to the current post.
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );

	// Display the XHTML generator that is generated on the wp_head hook, WP version
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

	// remove jetpack open graph tags
	remove_action( 'wp_head', 'jetpack_og_tags' );

	add_filter( 'use_default_gallery_style', '__return_null' );

	/* Custom oEmbed Providers */

	// Add Soundcloud oEmbed
	wp_oembed_add_provider( '#http://(www\.)?soundcloud\.com/.*#i', 'http://soundcloud.com/oembed', true );

	// Add Kickstarter oEmbed
	wp_oembed_add_provider( '#http://(www\.)?kickstarter\.com/projects/.*#i', 'http://www.kickstarter.com/services/oembed', true );

	// Add Instagram oEmbed
	wp_oembed_add_provider( '#http://(www\.)?instagr(am)?\.(am|com)/.*#i', 'http://api.instagram.com/oembed', true );

	// Add Slideshare oEmbed
	wp_oembed_add_provider( '#http://(www\.)?slideshare\.net/.*#i', 'http://api.embed.ly/v1/api/oembed', true );
}

add_action( 'init', 'foundation_init' );

/**
 * Remove the WordPress version from RSS feeds
 */
add_filter( 'the_generator', '__return_false' );

/**
 * Adds custom scripts to theme header
 *
 * @since [foundation] 1.0
 * @return void
 */
function foundation_enqueue_scripts() {
	$theme   = wp_get_theme();
	$version = $theme['Version'];

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js', false, '1.8.3' );

	/**
	 *  We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() and comments_open() and get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/javascripts/modernizr.foundation.js', false, '2.6.2' );

	// Foundation scripts

	/* Minified */
	// wp_enqueue_script( 'foundation', get_template_directory_uri() . '/assets/js/libs/foundation.min.js', array( 'jquery' ), '3.0', true );

	/* Unminified */
	wp_enqueue_script( 'mediaquery', get_template_directory_uri() . '/javascripts/jquery.foundation.mediaQueryToggle.js', array( 'jquery' ), '3.0', true );
	wp_enqueue_script( 'forms', get_template_directory_uri() . '/javascripts/jquery.foundation.forms.js', array( 'jquery' ), '3.0', true );
	wp_enqueue_script( 'reveal', get_template_directory_uri() . '/javascripts/jquery.foundation.reveal.js', array( 'jquery' ), '3.0', true );
	wp_enqueue_script( 'orbit', get_template_directory_uri() . '/javascripts/jquery.foundation.orbit.js', array( 'jquery' ), '3.0', true );
	wp_enqueue_script( 'navigation', get_template_directory_uri() . '/javascripts/jquery.foundation.navigation.js', array( 'jquery' ), '3.0', true );
	wp_enqueue_script( 'buttons', get_template_directory_uri() . '/javascripts/jquery.foundation.buttons.js', array( 'jquery' ), '3.0', true );
	wp_enqueue_script( 'tabs', get_template_directory_uri() . '/javascripts/jquery.foundation.tabs.js', array( 'jquery' ), '3.0', true );
	wp_enqueue_script( 'tooltips', get_template_directory_uri() . '/javascripts/jquery.foundation.tooltips.js', array( 'jquery' ), '3.0', true );
	wp_enqueue_script( 'accordion', get_template_directory_uri() . '/javascripts/jquery.foundation.accordion.js', array( 'jquery' ), '3.0', true );
	wp_enqueue_script( 'placeholder', get_template_directory_uri() . '/javascripts/jquery.placeholder.js', array( 'jquery' ), '3.0', true );
	wp_enqueue_script( 'alerts', get_template_directory_uri() . '/javascripts/jquery.foundation.alerts.js', array( 'jquery' ), '3.0', true );
	wp_enqueue_script( 'topbar', get_template_directory_uri() . '/javascripts/jquery.foundation.topbar.js', array( 'jquery' ), '3.0', true );
	wp_enqueue_script( 'clearing', get_template_directory_uri() . '/javascripts/jquery.foundation.clearing.js', array( 'jquery' ), '3.0', true );

	wp_enqueue_script( 'app', get_template_directory_uri() . '/javascripts/app.js', array( 'jquery' ), $version, true );
}

add_action( 'wp_enqueue_scripts', 'foundation_enqueue_scripts' );

/**
 * Adds custom styles to theme header
 *
 * @since [foundation] 1.0
 * @return void
 */
function foundation_enqueue_styles() {
	$theme   = wp_get_theme();
	$version = $theme['Version'];

	wp_enqueue_style( 'fc-webicons', get_template_directory_uri() . '/stylesheets/fc-webicons.css', false, '2.0', 'all' );

	wp_enqueue_style( 'app', get_stylesheet_uri(), false, $version, 'all' );
}

add_action( 'wp_enqueue_scripts', 'foundation_enqueue_styles' );

/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 *
 * If we have a site description and we're viewing the home page or a blog posts
 * page (when using a static front page), then we will add the site description.
 *
 * If we're viewing a search result, then we're going to recreate the title entirely.
 * We're going to add page numbers to all titles as well, to the middle of a search
 * result title and the end of all other titles.
 *
 * The site title also gets added to all titles.
 *
 * @since [foundation] 1.0
 *
 * @param string $title Title generated by wp_title()
 * @param string $separator The separator passed to wp_title(). Base theme uses a vertical bar, "|", as a separator in header.php.
 * @return string The new title, ready for the <title> tag.
 */
function foundation_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() or function_exists( 'get_wpseo_options' ) )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page, $post;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'foundation' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 ) {
			$title .= " $separator " . sprintf( __( 'Page %s', 'foundation' ), $paged );
		}
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	$return = array();

	if ( $title != '' ) {
		$return[] = str_replace( " $separator ", '', apply_filters( 'the_category', $title ) );
	}

	if ( is_single() ) {
		if ( get_post_meta( $post->ID, 'title', true ) ) {
			$return[] = stripslashes( get_post_meta( $post->ID, 'seo_title', true ) );
		}
		elseif ( ! in_array( $post->post_type, array( 'post', 'page', 'attachment' ) ) ) {
			$post_type_obj = get_post_type_object( $post->post_type );
			$return[] = apply_filters( 'post_type_archive_title', $post_type_obj->labels->name );
		}
	}

	// Add a page number if necessary:
	if ( $paged >= 2 or $page >= 2 ) {
		$return[] = sprintf( __( 'Page %s', 'foundation' ), max( $paged, $page ) );
	}

	// Add the site name to the end:
	$return[] = get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description and ( is_home() or is_front_page() ) ) {
		$return[] = $site_description;
	}

	// Return the new title to wp_title():
	return implode( " $separator ", $return );
}

add_filter( 'wp_title', 'foundation_filter_wp_title', 10, 3 );

/**
 * Adds code to header
 *
 * @since [foundation] 1.0
 * @return string misc
 */
function foundation_header() {
	?>
	<!-- For third-generation iPad with high-resolution Retina display: -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="apple-touch-icon-144x144-precomposed.png?1333401433">
	<!-- For iPhone with high-resolution Retina display: -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114x114-precomposed.png?1333401433">
	<!-- For first- and second-generation iPad: -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72x72-precomposed.png?1333401433">
	<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
	<link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png?1333401433">
	<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
	<link rel="shortcut icon" href="favicon.ico?1333401433" type="image/x-icon" />
	<?php
	do_action( 'foundation_header' );
}

add_action( 'wp_head', 'foundation_header', 10 );

/**
 * Adds code to footer
 *
 * @since [foundation] 1.0
 * @return string misc
 */
function foundation_footer() {}

add_action( 'wp_footer', 'foundation_footer', 10 );

/**
 * Defines widget areas
 *
 * @since [foundation] 1.0
 * @return void
 */
function foundation_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Primary widget area', 'foundation' ),
			'id'            => 'primary-widget-area',
			'description'   => __( '', 'foundation' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'foundation_widgets_init' );

/**
 * Clean up output of stylesheet <link> tags
 *
 * @since [foundation] 1.0
 */
function foundation_clean_style_tag( $input ) {
	preg_match_all( "!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches );
	// Only display media if it's print
	$media = $matches[3][0] == 'print' ? ' media="print"' : '';

	return '<link rel="stylesheet" href="' . $matches[ 2 ][ 0 ] . '"' . $media . '>' . "\n";
}

add_filter( 'style_loader_tag', 'foundation_clean_style_tag' );

/**
 * Remove unnecessary self-closing tags
 *
 * @since [foundation] 1.0
 */
function foundation_remove_self_closing_tags( $input ) {
	return str_replace( ' />', '>', $input );
}

add_filter( 'get_avatar',          'foundation_remove_self_closing_tags' ); // <img />
add_filter( 'comment_id_fields',   'foundation_remove_self_closing_tags' ); // <input />
add_filter( 'post_thumbnail_html', 'foundation_remove_self_closing_tags' ); // <img />

/**
 * Wrap embedded media as suggested by Readability
 *
 * @link https://gist.github.com/965956
 * @link http://www.readability.com/publishers/guidelines#publisher
 * @since [foundation] 1.0
 */
function foundation_embed_wrap( $cache, $url, $attr = '', $post_ID = '' ) {
	return '<div class="entry-content-asset">' . $cache . '</div>';
}

add_filter( 'embed_oembed_html', 'foundation_embed_wrap', 10, 4 );
add_filter( 'embed_googlevideo', 'foundation_embed_wrap', 10, 2 );

/**
 * Remove height/width attributes on images so they can be responsive
 *
 * @since [foundation] 1.0
 */
function foundation_remove_thumbnail_dimensions( $html, $id, $alt, $title ) {
	return preg_replace(
		array(
			'/\s+width="\d+"/i',
			'/\s+height="\d+"/i',
			'/alt=""/i',
		),
		array(
			'',
			'',
			'',
			'alt="' . $title . '"',
		),
		$html
	);
}

add_filter( 'post_thumbnail_html', 'foundation_remove_thumbnail_dimensions', 10, 4 );
add_filter( 'image_send_to_editor', 'foundation_remove_thumbnail_dimensions', 10, 4 );
add_filter( 'get_image_tag', 'foundation_remove_thumbnail_dimensions', 10, 4 );

/**
 * Clean the output of attributes of images in editor.
 *
 * @link http://www.sitepoint.com/wordpress-change-img-tag-html/
 * @since [foundation] 1.0
 */
function foundation_image_tag_class( $class, $id, $align, $size ) {
	$align = 'align' . esc_attr( $align );
	return $align;
}

add_filter( 'get_image_tag_class', 'foundation_image_tag_class', 0, 4 );

/**
 * Add thumbnail class to thumbnail links
 *
 * @since [foundation] 1.0
 */
function foundation_add_class_attachment_link( $html ) {
	$postid = get_the_ID();
	$html   = str_replace( '<a', '<a class="th"', $html );

	return $html;
}

add_filter( 'wp_get_attachment_link', 'foundation_add_class_attachment_link', 10, 1 );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since [foundation] 1.0
 */
function foundation_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}

add_filter( 'attachment_link', 'foundation_enhanced_image_navigation', 10, 2 );

/**
 * Replace various active menu class names with "active"
 * Remove the id="" on nav menu items
 * Return 'menu-slug' for nav menu classes
 *
 * @since [foundation] 1.0
 */
function foundation_wp_nav_menu_class( $classes, $item ) {
	$slug    = sanitize_title( $item->title );
	$classes = preg_replace( '/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes );
	$classes = preg_replace( '/^((menu|page)[-_\w+]+)+/', '', $classes );

	$classes[] = 'menu-' . $slug;

	return array_filter( array_unique( $classes ), 'is_element_empty' );
}

add_filter( 'nav_menu_css_class', 'foundation_wp_nav_menu_class', 10, 2 );
add_filter( 'nav_menu_item_id', '__return_null' );

/**
 * Check if $element is empty
 *
 * @since [foundation] 1.0
 */
function is_element_empty( $element ) {
	$element = trim( $element );

	return ( bool ) ! empty( $element );
}

/**
 * Create a graceful fallback to wp_page_menu
 *
 * @since [foundation] 1.0
 */
function foundation_page_menu() {
	$args = array(
		'sort_column' => 'menu_order, post_title',
		'menu_class'  => 'side-nav two mobile-four columns',
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
		'show_home'   => false,
		'link_before' => '',
		'link_after'  => '',
	);

	wp_page_menu( $args );
}

/**
 * Navigation Menu Adjustments
 *
 * @since [foundation] 1.0
 */
class Foundation_Navigation extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"flyout\">\n";
	}

	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		$id_field = $this->db_fields['id'];
		if ( ! empty( $children_elements[ $element->$id_field ] ) ) {
			$element->classes[] = 'has-flyout';
		}
		Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

/**
 * Adds extra info to language attributes string
 *
 * @since [foundation] 1.0
 */
function foundation_language_attributes() {
	$attr   = array();
	$output = '';

	if ( function_exists( 'is_rtl' ) ) {
		if ( is_rtl() == 'rtl' ) {
			$attr[] = 'dir="rtl"';
		}
	}

	$lang = get_bloginfo( 'language' );

	if ( $lang and $lang !== 'en-US' ) {
		$attr[] = "lang=\"$lang\"";
	}
	else {
		$attr[] = 'lang="en"';
	}

	return implode( ' ', $attr );
}

add_filter( 'language_attributes', 'foundation_language_attributes' );

/**
 * remove the p from around imgs
 *
 * @link https://gist.github.com/975026
 * @since [foundation] 1.0
 */
function foundation_filter_ptags_on_images( $content ) {
	// Replace br tags inside figures
	$content = preg_replace( '/(<figure .*>)?<br\s?\/?>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*/iU', '\1\2\3\4', $content );
	// do a regular expression replace...
	// find all p tags that have just
	// <p>maybe some white space<img all stuff up to /> then maybe whitespace </p>
	// replace it with just the image tag...
	$content = preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
	// now pass that through and do the same for iframes...
	return preg_replace( '/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content );
}

add_filter( 'the_content', 'foundation_filter_ptags_on_images' );

/**
 * Adds browser detection body class
 * Adds extra classes to body tag on custom taxonomies
 *
 * @since [foundation] 1.0
 */
function foundation_body_classes( $classes ) {
	global $wp_query, $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if ( isset( $wp_query->query_vars['taxonomy'] ) or isset( $wp_query->query_vars['term'] ) ) {
		array_push( $classes, 'custom-taxonomy-archive', 'custom-taxonomy-' . ( isset( $wp_query->query_vars[ 'taxonomy' ] ) ? get_query_var( 'taxonomy' ) : get_query_var( 'term' ) ) . '-archive' );
	}

	if ( $is_lynx ) $classes[]       = 'lynx';
	elseif ( $is_gecko ) $classes[]  = 'gecko';
	elseif ( $is_opera ) $classes[]  = 'opera';
	elseif ( $is_NS4 ) $classes[]    = 'ns4';
	elseif ( $is_safari ) $classes[] = 'safari';
	elseif ( $is_chrome ) $classes[] = 'chrome';
	elseif ( $is_IE ) $classes[]     = 'ie';
	else $classes[]                  = 'unknown';

	if ( $is_iphone ) $classes[] = 'iphone';

	// Add post/page slug
	if ( is_single() or is_page() and ! is_front_page() ) {
		$classes[] = basename( get_permalink() );
	}

	// Remove unnecessary classes
	$home_id_class  = 'page-id-' . get_option( 'page_on_front' );
	$remove_classes = array(
		'page-template-default',
		$home_id_class,
	);

	$classes = array_diff( $classes, $remove_classes );

	return $classes;
}

add_filter( 'body_class', 'foundation_body_classes' );

/**
 * Modifies output of custom post formats.
 *
 * @since [foundation] 1.0
 */
function foundation_custom_content( $content ) {
	/* Check if we're displaying a 'quote' post. */
	if ( has_post_format( 'quote' ) ) {
		/* Match any <blockquote> elements. */
		preg_match( '/<blockquote.*?>/', $content, $matches );

		/* If no <blockquote> elements were found, wrap the entire content in one. */
		if ( empty( $matches ) ) {
			$content = "<blockquote>{$content}</blockquote>";
		}
	}
	elseif ( has_post_format( 'aside' ) and ! is_singular() ) {
		preg_match( '/<p>(.*?)<\/p>(?!\s*<p>)/', $content, $matches );

		$content = str_replace( $matches[1], $matches[1] . ' <a href="' . get_permalink() . '">&#8734;</a>', $content );
	}

	return $content;
}

add_filter( 'the_content', 'foundation_custom_content' );

/**
 * Remove <p> and <br /> in the shortcodes
 *
 * @since [foundation] 1.0
 */
function foundation_shortcode_empty_paragraph_fix( $content ) {
	$array = array(
		'<p>['    => '[',
		']</p>'   => ']',
		']<br />' => ']',
	);

	// replace the strings in the $content
	$content = strtr( $content, $array );

	return $content;
}

add_filter( 'the_content', 'foundation_shortcode_empty_paragraph_fix' );

/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own foundation_entry_meta() to override in a child theme.
 *
 * @since [foundation] 1.0
 */
function foundation_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'foundation' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'foundation' ) );

	$date = sprintf(
		'<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf(
		'<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'foundation' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'foundation' );
	}
	elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'foundation' );
	}
	else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'foundation' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since [foundation] 1.0
 */
function foundation_continue_reading_link() {
	$read_more_link = ' <a href="' . get_permalink() . '" class="more-link">' . __( 'Continue reading', 'foundation' ) . '</a>';

	return $read_more_link;
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts ) with foundation_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since [foundation] 1.0
 */
function foundation_auto_excerpt_more( $more ) {
	return foundation_continue_reading_link();
}

add_filter( 'excerpt_more', 'foundation_auto_excerpt_more' );
add_filter( 'the_content_more_link', 'foundation_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since [foundation] 1.0
 */
function foundation_custom_excerpt_more( $output ) {
	if ( has_excerpt() and ! is_attachment() ) {
		$output .= foundation_continue_reading_link();
	}
	return $output;
}

add_filter( 'get_the_excerpt', 'foundation_custom_excerpt_more' );

/**
 * Adds nofollow rel atribute to content links
 *
 * @since [foundation] 1.0
 */
function foundation_nofollow_links_in_post( $text ) {
	global $post;

	if ( get_post_meta( $post->ID, 'nofollow_links', true ) ) {
		preg_match_all( '/<a.*? href=\"(.*? )\".*?>(.*? )<\/a>/i', $text, $links );
		$match_count = count( $links[0] );

		for ( $i = 0; $i < $match_count; ++$i ) {
			if ( ! preg_match( '/rel=[\"\']*nofollow[\"\']*/', $links[0][$i] ) ) {
				preg_match_all( '/<a.*? href=\"(.*? )\"(.*? )>(.*? )<\/a>/i', $links[0][$i], $link_text );

				$search  = '>'.$link_text[3][0].'</a>';
				$replace = ' rel="nofollow">'.$link_text[3][0].'</a>';

				$text = str_replace( $search, $replace, $text );
			}
		}
	}

	return $text;
}

add_action( 'the_content', 'foundation_nofollow_links_in_post' );

/**
 * Custom tag clould args
 *
 * @since [foundation] 1.0
 */
function foundation_widget_tag_cloud_args( $args ) {
	$args['number']   = 20; // show less tags
	$args['largest']  = 13; // make largest and smallest the same
	$args['smallest'] = 13;
	$args['unit']     = 'px';
	$args['format']   = 'list'; // ul with a class of wp-tag-cloud
	// $args['exclude']  = array(20, 80, 92); // exclude tags by ID
	// $args['taxonomy'] = array('post_tag', 'ingredients'); // add post tags and ingredients taxonomy

	return $args;
}

add_filter( 'widget_tag_cloud_args', 'foundation_widget_tag_cloud_args' );

/**
 * Filter tag clould output so that it can be styled by CSS
 *
 * @since [foundation] 1.0
 */
function foundation_add_tag_class( $taglinks ) {
	$tags  = explode( '</a>', $taglinks );
	$regex = "#(.*tag-link[-])(.*)(' title.*)#e";
	foreach ( $tags as $tag ) {
		$tagn[] = preg_replace( $regex, "('$1$2 label tag-'.get_tag($2)->slug.'$3')", $tag );
	}

	return implode( '</a>', $tagn );
}

add_filter( 'wp_tag_cloud', 'foundation_add_tag_class' );

/**
 * Outputs WP Pagenavi pagination or wordpress navigation
 *
 * @since [foundation] 1.0
 */
function pagination( $query = false ) {
	global $wp_query;

	if ( is_single() ) {
		?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Post Navigation', 'foundation' ); ?></h1>
		<?php
		if ( $previous = get_previous_post() ):?>
				<div class="nav-previous alignleft">
					<a href="<?php echo get_permalink( $previous );?>" title="<?php printf( __( 'Permalink to %s', 'foundation' ), get_the_title( $previous ) );?>"><?php _e( 'Previous', 'foundation' ); ?></a>
				</div>
			<?php endif;?>
		<?php
		if ( $next = get_next_post() ):?>
				<div class="nav-next alignright">
					<a href="<?php echo get_permalink( $next );?>" title="<?php printf( __( 'Permalink to %s', 'foundation' ), get_the_title( $next ) );?>"><?php _e( 'Next', 'foundation' ); ?></a>
				</div>
			<?php endif;?>
		</nav>
	<?php
	} else {
		if ( $wp_query->max_num_pages > 1 ) {
			if ( function_exists( 'wp_pagenavi' ) ) {
				$args = array( 'options' => PageNavi_Core::$options->get_defaults() );

				if ( $query ) {
					$args[ 'query' ] = $query;
				}

				wp_pagenavi( $args );
			} else {
				//get_template_part( 'templates/pager' );
				$big = 999999999; // This needs to be an unlikely integer

				// For more options and info view the docs for paginate_links()
				// http://codex.wordpress.org/Function_Reference/paginate_links
				$paginate_links = paginate_links(
					array(
						'base'      => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
						'current'   => max( 1, get_query_var( 'paged' ) ),
						'total'     => $wp_query->max_num_pages,
						'mid_size'  => 5,
						'prev_next' => True,
						'prev_text' => __( '&larr;' ),
						'next_text' => __( '&rarr;' ),
						'type'      => 'array',
					)
				);

				// Display the pagination if more than one page is found
				if ( $paginate_links ) {
					foreach ( $paginate_links as $link ) {
						if ( strpos( $link, 'prev' ) !== false or strpos( 'next', $link ) !== false ) {
							$links[] = '<li class="arrow">' . $link . '</li>';
						}
						elseif ( strpos( $link, 'current' ) !== false ) {
							preg_match( '/<span[^>]+>(\d+)<\/span>/i', $link , $m );

							$links[] = '<li class="current"><a href="">' . $m[1] . '</a></li>';
						}
						else {
							$links[] = '<li>' . $link . '</li>';
						}
					}


					echo '<ul class="pagination">';
					echo implode( "\n", $links );
					echo '</ul>';
				}
			}
		}
	}
}

add_action( 'pagination', 'pagination' );

/**
 * Template for comments and pingbacks.
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since [foundation] 1.0
 */
function foundation_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) {
		case 'pingback' :
		case 'trackback' :
			// Display trackbacks differently than normal comments.
			?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<p><?php _e( 'Pingback:', 'foundation' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'foundation' ), '<span class="edit-link">', '</span>' ); ?></p>
			<?php
		break;
		default :
			// Proceed with normal comments.
			global $post;
			?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment">
					<header class="comment-meta comment-author vcard clearfix">
			<?php
				echo get_avatar( $comment, 44 );
				printf(
					'<cite class="fn">%1$s %2$s</cite>',
					get_comment_author_link(),
					// If current post author is also comment author, make it known visually.
					( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'foundation' ) . '</span>' : ''
				);
				printf(
					'<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
					esc_url( get_comment_link( $comment->comment_ID ) ),
					get_comment_time( 'c' ),
					/* translators: 1: date, 2: time */
					sprintf( __( '%1$s at %2$s', 'foundation' ), get_comment_date(), get_comment_time() )
				);
			?>
			</header>

			<?php
			if ( '0' == $comment->comment_approved ):
				?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'foundation' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment clearfix">
				<?php comment_text(); ?>
			</section>

			<div class="reply">
				<?php edit_comment_link( __( 'Edit', 'foundation' ), '<span class="edit-link">', '</span> / ' ); ?>
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'foundation' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
			</article>
			<?php
			break;
	} // end comment_type check
}

/**
 * Redirect to post when search query returns single result
 *
 * @see http://wpsnipp.com/index.php/functions-php/redirect-to-post-when-search-query-returns-single-result/
 * @since [foundation] 1.0
 */
function foundation_single_result() {
	if ( is_search() ) {
		global $wp_query;
		if  ( $wp_query->post_count == 1 ) {
			wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
		}
	}
}
add_action( 'template_redirect', 'foundation_single_result' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since [foundation] 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function foundation_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'foundation_customize_register' );

/* SHORTCODES */

// Allow shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );

/**
 * The supported attributes for the shortcode are 'id', 'align', 'width', and 'caption'.
 *
 * @since [foundation] 1.0
 */
function foundation_shortcode_caption( $atts, $content = null ) {
	extract(
		shortcode_atts(
			array(
				'id'		=> '',
				'align'		=> 'alignnone',
				'width'		=> '',
				'caption'	=> '',
			), $atts
		)
	);

	if ( 1 > ( int ) $width )
		return $content;

	if ( empty( $caption ) ) {
		preg_match( '/(<img[^>]+>)[ ]?(.*)/i', $content, $match );
		$content = $match[1];
		$caption = $match[2];
	}

	$idtag = ( $id ) ? 'id="' . esc_attr( $id ) . '" ' : '';

	$out[] = '<figure ' . $idtag . 'aria-describedby="figcaption_' . $id . '" class="post-image wp-caption ' . $align . '">';
	$out[] = do_shortcode( $content );
	$out[] = '<figcaption id="figcaption_' . $id . '" class="caption wp-caption-text">' . wpautop( wptexturize( $caption ) ) . '</figcaption>';
	$out[] = '</figure>';

	return implode( "\n", $out );
}

add_shortcode( 'wp_caption', 'foundation_shortcode_caption' );
add_shortcode( 'caption', 'foundation_shortcode_caption' );

/**
 * Gallery shortcode.
 *
 * @since [foundation] 1.0
 */
function foundation_gallery_shortcode( $attr ) {
	global $post, $wp_locale;

	$output = array();

	$args = array( 'post_type' => 'attachment', 'numberposts' => - 1, 'post_status' => null, 'post_parent' => $post->ID );
	$attachments = get_posts( $args );
	if ( $attachments ) {
		$i = 0;
		$output[] = '<ul class="block-grid three-up">';
		foreach ( $attachments as $attachment ) {
			$active = ( $i == 0) ? ' active' : '';
			$caption = wpautop( wptexturize( esc_attr( trim( strip_tags( $attachment->post_excerpt ) ) ) ) );
			$data_caption = $caption ? ' data-caption="' . $caption . '"' : '';
			$output[] = '<li class="item' . $active . '">';
			$output[] = '<a href="' . get_attachment_link( $attachment->ID ) . '">';
			$output[] = '<img' . $data_caption . ' src="' . wp_get_attachment_image_src( $attachment->ID , 'full' ) . '" alt="' . esc_attr( trim( strip_tags( $attachment->post_title ) ) ) . '">';
			$output[] = '</a>';
			$output[] = '</li>';
			++$i;
		}
		$output[] = '</ul>';
	}

	return implode( "\n", $output );
}

// removes standard shortcode
remove_shortcode( 'gallery', 'gallery_shortcode' );
add_shortcode( 'gallery', 'foundation_gallery_shortcode' );


/* ADMIN STUFF */

/**
 * Remove unnecessary dashboard widgets
 *
 * @link http://www.deluxeblogtips.com/2011/01/remove-dashboard-widgets-in-wordpress.html
 * @since [foundation] 1.0
 */
function foundation_remove_dashboard_widgets() {
	// Incoming Links Widget
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );

	// Plugins Widget
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );

	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );

	// Sitepress WPML Plugin Widget
	remove_meta_box( 'icl_dashboard_widget', 'dashboard', 'normal' );

	// Yoast's SEO Plugin Widget
	remove_meta_box( 'yoast_db_widget', 'dashboard', 'normal' );
}

add_action( 'admin_init', 'foundation_remove_dashboard_widgets' );

/**
 * Adds custom menu to admin bar
 *
 * @since [foundation] 1.0
 */
function foundation_bar_menu( $wp_admin_bar ) {
	if ( ! is_super_admin() or ! is_admin_bar_showing() )
		return;

	/**
	 * Change "Howdy"
	 */
	// get the node that contains "howdy"
	$my_account = $wp_admin_bar->get_node( 'my-account' );
	// change the "howdy"
	$my_account->title = str_replace( 'Howdy,', __( 'Hi,', 'foundation' ), $my_account->title );
	// remove the original node
	$wp_admin_bar->remove_node( 'my-account' );
	// add back our modified version
	$wp_admin_bar->add_node( $my_account );

	/**
	 * Removing the "W" menu
	 * I have nothing against it, but I *never* use it
	 */
	$wp_admin_bar->remove_menu( 'wp-logo' );

	/**
	 * Create a "Favorites" menu
	 * First, just create the parent menu item
	 */
	$wp_admin_bar->add_menu(
		array(
			'id'  => 'favorites',
			'parent' => 'top-secondary', // puts it on the right-hand side
			'title'  => __( 'Favorites', 'foundation' ),
		)
	);

	/**
	 * Then add links to it
	 * This link goes to the All Settings page,
	 * so only show it to users that have appropriate privileges
	 */
	if ( current_user_can( 'manage_options' ) ) {
		$wp_admin_bar->add_menu(
			array(
				'id'  => 'all-settings',
				'parent' => 'favorites',
				'title'  => __( 'Options', 'foundation' ),
				'href'  => admin_url( 'options.php' ),
			)
		);
	}

	// This one goes to the list of the current user's posts
	$wp_admin_bar->add_menu(
		array(
			'id'  => 'my-posts',
			'parent' => 'favorites',
			'title'  => __( 'My Posts', 'foundation' ),
			'href'  => admin_url( 'edit.php?post_type=post&author=' . get_current_user_id() ),
		)
	);

	// MySQL query and script execution timer output
	$wp_admin_bar->add_menu(
		array(
			'id'  => 'do_query_bar',
			'parent' => 'top-secondary', // puts it on the right-hand side
			'title'  => get_num_queries() . 'Q - ' . timer_stop() . 's', // link title
			'href'  => '#',
			'meta'  => false,
		)
	);
}

add_action( 'admin_bar_menu', 'foundation_bar_menu', '1000' );

/**
 * This simple hack will remove the AIM, Yahoo and Jabber fields and will replace them with a bunch of other social network profiles.
 *
 * @since [foundation] 1.0
 */
function foundation_user_contactmethods( $contactmethods ) {
	unset( $contactmethods['aim'], $contactmethods['yim'], $contactmethods['jabber'] );

	// Add Location
	$contactmethods['user_location'] = __( 'Location', 'foundation' );

	// Add Facebook
	$contactmethods['user_fb'] = __( 'Facebook', 'foundation' );

	// Add Pinterest
	$contactmethods['user_pt'] = __( 'Pinterest', 'foundation' );

	// Add Twitter
	$contactmethods['user_tw'] = __( 'Twitter', 'foundation' );

	// Add Linkedin
	$contactmethods['user_lk'] = __( 'Linkedin', 'foundation' );

	// Add Github
	$contactmethods['user_gh'] = __( 'Github', 'foundation' );

	// Add Google+
	$contactmethods['google_profile'] = __( 'Google+ profile', 'foundation' );

	return $contactmethods;
}

add_filter( 'user_contactmethods', 'foundation_user_contactmethods' );

/**
 * Allow more HTML tags in the editor
 * Add more languages to spell check
 *
 * @since [foundation] 1.0
 */
function foundation_change_mce_options( $array ) {
	$ext = 'pre[id|name|class|style],iframe[id|class|title|style|align|frameborder|height|longdesc|marginheight|marginwidth|name|scrolling|src|width]';

	if ( isset( $array['extended_valid_elements'] ) ) {
		$array['extended_valid_elements'] .= ','.$ext;
	}
	else {
		$array['extended_valid_elements'] = $ext;
	}

	// Add block format elements you want to show in dropdown
	$array['theme_advanced_blockformats'] = 'h1,h2,h3,h4,p,code,blockquote';
	$array['theme_advanced_disable']      = 'strikethrough,underline,forecolor,justifyfull';
	$array[ 'spellchecker_languages' ]    = '+Spanish=sp, English=en';

	return $array;
}

add_filter( 'tiny_mce_before_init', 'foundation_change_mce_options' );

/**
 * Define custom styles for the dropdown menu
 *
 * @since [foundation] 1.0
 */
function foundation_style_formats( $settings ) {
	$style_formats = array(
		array(
			'title'    => __( 'Button', 'foundation' ),
			'selector' => 'a',
			'classes'  => 'button',
			'exact'    => true,
		),
		array(
			'title'    => __( 'Lead', 'foundation' ),
			'selector' => 'p',
			'classes'  => 'lead',
		),
		array(
			'title'    => __( 'Label', 'foundation' ),
			'inline'   => 'span',
			'classes'  => 'label',
		),
		array(
			'title'    => __( 'Panel', 'foundation' ),
			'block'    => 'div',
			'classes'  => 'panel',
			'wrapper'  => true,
		),
		array(
			'title'    => __( 'Panel callout', 'foundation' ),
			'block'    => 'div',
			'classes'  => 'panel callout',
			'wrapper'  => true,
		),
		array(
			'title'    => __( 'Radius (Panel, Label, Button)', 'foundation' ),
			'selector' => 'a.button, span.label, div.panel, div.panel.callout',
			'classes'  => 'radius',
		),
		array(
			'title'    => __( 'Round (Label, Button)', 'foundation' ),
			'selector' => 'a.button, span.label',
			'classes'  => 'round',
		),
		array(
			'title'    => __( 'Alert (Label, Button)', 'foundation' ),
			'selector' => 'a.button, span.label',
			'classes'  => 'alert',
		),
		array(
			'title'    => __( 'Message (Label, Button)', 'foundation' ),
			'selector' => 'a.button, span.label',
			'classes'  => 'success',
		),
		array(
			'title'    => __( 'Secondary (Label, Button)', 'foundation' ),
			'selector' => 'a.button, span.label',
			'classes'  => 'secondary',
		),
		array(
			'title'    => __( 'Subheader (Header)', 'foundation' ),
			'selector' => 'h1, h2, h3, h4, h5, h6',
			'classes'  => 'subheader',
		),
		array(
			'title'    => __( 'Keyborad', 'foundation' ),
			'inline'   => 'kbd',
		),
	);

	$settings['style_formats'] = json_encode( apply_filters( 'foundation_style_formats', $style_formats ) );

	return $settings;
}

add_filter( 'tiny_mce_before_init', 'foundation_style_formats' );

/**
 * Add the Styles dropdown to the visual editor
 *
 * @since [foundation] 1.0
 */
function foundation_add_mce_button( $buttons ) {
	if ( ! in_array( 'styleselect', $buttons ) ) {
		$buttons[] = 'styleselect';
	}

	return $buttons;
}

add_filter( 'mce_buttons_2', 'foundation_add_mce_button' );

/**
 * Adds previous/next links to post edition window
 *
 * @since [foundation] 1.0
 */
function foundation_add_navigation_edit_posts() {
	if ( isset( $_GET['post'] ) and isset( $_GET['action'] ) and $_GET['action'] == 'edit' ) {
		global $post;

		$args = array(
			'public'   => true,
			'_builtin' => false,
		);
		$output   = 'names'; // names or objects, note names is the default
		$operator = 'and'; // 'and' or 'or'

		$post_types = get_post_types( $args, $output, $operator );

		$post_types['post'] = 'post';
		$post_types['page'] = 'page';

		if ( is_object( $post ) and in_array( $post->post_type, $post_types ) ) {
			$wtf = array( true, false );
			foreach ( $wtf as $prev ) {
				$p = get_adjacent_post( false, '', $prev );

				if ( ! empty( $p ) ) {
					echo '<script>
					jQuery(function($) {
						$(".wrap h2" )
						.append(\'<a class="add-new-h2" href="' . admin_url( 'post.php?action=edit&post=' . $p->ID ) . '" title="' . __( 'Editar', 'foundation' ) . ' ' . apply_filters( 'the_title', $p->post_title ) . '">' . ( $prev ? '&laquo; ' : '' ) . apply_filters( 'the_title', $p->post_title ) . ( ! $prev ? ' &raquo;' : '' ) . '</a>\' );
					});
					</script>';
				}
			}
		}
	}
}

add_action( 'admin_head', 'foundation_add_navigation_edit_posts' );

/**
 * Custom Login Logo Support
 *
 * @since [foundation] 1.0
 */
function foundation_custom_login_logo() {
	echo '<style type="text/css">
		h1 a { background-image:url(' . get_template_directory_uri() . '/images/login-logo.png) !important; }
	</style>';
}

add_action( 'login_head', 'foundation_custom_login_logo' );

/**
 * Custom Login URL
 *
 * @since [foundation] 1.0
 */
function foundation_wp_login_url() {
	return home_url();
}

add_filter( 'login_headerurl', 'foundation_wp_login_url' );

/**
 * Custom Login Title
 *
 * @since [foundation] 1.0
 */
function foundation_wp_login_title() {
	return get_option( 'blogname' );
}

add_filter( 'login_headertitle', 'foundation_wp_login_title' );

/**
 * Custom Backend Footer
 *
 * @since [foundation] 1.0
 */
function foundation_custom_admin_footer() {
	$credits = '<span id="footer-thankyou">Crafted by <a href="//alexsancho.name" target="_blank">Alex Sancho</a></span>.';

	echo apply_filters( 'foundation_custom_admin_footer', $credits );
}

// adding it to the admin area
add_filter( 'admin_footer_text', 'foundation_custom_admin_footer' );
