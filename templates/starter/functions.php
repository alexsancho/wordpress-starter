<?php
/**
 * [starter] theme functions and definitions
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * Copyright (c) 2012, Alex Sancho
 *
 * @category  Theme
 * @package   [starter]
 * @author    Alex Sancho
 * @copyright 2012 Alex Sancho
 * @license   http://opensource.org/licenses/mit-license.php MIT Licensed
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 940;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override starter_setup() in a child theme, add your own starter_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links and Post Formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since [starter] 1.0
 */
function starter_setup() {
	// SET THEME LANGUAGES DIRECTORY
	// Theme translations can be filed in the my_theme/languages/ directory
	load_theme_textdomain( 'starter', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style( 'stylesheets/editor-style.css' );

	// Adds support for rss links
	add_theme_support( 'automatic-feed-links' );

	// Add support for a variety of post formats (http://codex.wordpress.org/Post_Formats)
	// Child Themes inherit the post formats defined by the parent theme
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

	// Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 670, 230, true ); // Default Thumbnail Image

	// Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
	register_nav_menu( 'primary', __( 'Primary menu', 'starter' ) );

	do_action( 'starter_setup' );
}

add_action( 'after_setup_theme', 'starter_setup' );

/**
 * Some cleanup
 *
 * @since [starter] 1.0
 * @return void
 */
function starter_init() {
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
}

add_action( 'init', 'starter_init' );

/**
 * Remove the WordPress version from RSS feeds
 */
add_filter( 'the_generator', '__return_false' );

/**
 * Adds custom scripts to theme header
 *
 * @since [starter] 1.0
 * @return void
 */
function starter_enqueue_scripts() {
	$theme  = wp_get_theme();
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

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/javascripts/modernizr.min.js', false, '2.6.2' );
	wp_enqueue_script( 'app', get_template_directory_uri() . '/javascripts/app.js', array( 'jquery' ), $version, true );
}

add_action( 'wp_enqueue_scripts', 'starter_enqueue_scripts' );

/**
 * Adds custom styles to theme header
 *
 * @since [starter] 1.0
 * @return void
 */
function starter_enqueue_styles() {
	$theme  = wp_get_theme();
	$version = $theme['Version'];

	wp_enqueue_style( 'app', get_stylesheet_uri(), false, $version, 'all' );
}

add_action( 'wp_enqueue_scripts', 'starter_enqueue_styles' );

/**
 * Adds code to header
 *
 * @since [starter] 1.0
 * @return string misc
 */
function starter_header() {
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
	do_action( 'starter_header' );
}

add_action( 'wp_head', 'starter_header', 10 );

/**
 * Adds code to footer
 *
 * @since [starter] 1.0
 * @return string misc
 */
function starter_footer() {}

add_action( 'wp_footer', 'starter_footer', 10 );

/**
 * Defines widget areas
 *
 * @since [starter] 1.0
 * @return void
 */
function starter_widgets_init() {
	register_sidebar(
	register_sidebar(
		array(
			'name'          => __( 'Primary widget area', 'starter' ),
			'id'            => 'primary-widget-area',
			'description'   => __( '', 'starter' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'starter_widgets_init' );

/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own starter_entry_meta() to override in a child theme.
 *
 * @since [starter] 1.0
 */
function starter_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'starter' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'starter' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'starter' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'starter' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'starter' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'starter' );
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
 * Outputs WP Pagenavi pagination or wordpress navigation
 *
 * @since [starter] 1.0
 */
function pagination( $query = false ) {
	global $wp_query;

	if ( is_single() ) {
?>
	<nav id="comment-nav-below" class="navigation" role="navigation">
		<h1 class="assistive-text section-heading"><?php _e( 'Post Navigation', 'starter' ); ?></h1>
		<?php if ( $previous = get_previous_post() ):?>
			<div class="nav-previous alignleft">
				<a href="<?php echo get_permalink( $previous );?>" title="<?php printf( __( 'Permalink to %s', 'starter' ), get_the_title( $previous ));?>"><?php _e( '&larr; Previous', 'starter' ); ?></a>
			</div>
		<?php endif;?>
		<?php if ( $next = get_next_post() ):?>
			<div class="nav-next alignright">
				<a href="<?php echo get_permalink( $next );?>" title="<?php printf( __( 'Permalink to %s', 'starter' ), get_the_title( $next ));?>"><?php _e( 'Next &rarr;', 'starter' ); ?></a>
			</div>
		<?php endif;?>
	</nav>
<?php
	}
	else {
		if ( $wp_query->max_num_pages > 1 ) {
			if ( function_exists( 'wp_pagenavi' ) ) {
				$args = array( 'options' => PageNavi_Core::$options->get_defaults() );

				if ( $query ) {
					$args[ 'query' ] = $query;
				}

				wp_pagenavi( $args );
			}
			else {
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
						'prev_text' => __('<'),
						'next_text' => __('>'),
						'type'      => 'list'
					)
				);

				// Display the pagination if more than one page is found
				if ( $paginate_links ) {
					echo '<ul class="pagination">';
					echo $paginate_links;
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
 * @since [starter] 1.0
 */
function starter_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
			$show_avatar = get_option( 'show_avatars' ) ? '' : 'no-avatar';
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="row">
			<?php if ( get_option( 'show_avatars' ) ):?>
				<div class="alignleft">
					<?php echo get_avatar( $comment, 68 );?>
				</div>
			<?php endif;?>
			<div class="alignright">
				<div class="comment-author vcard">
					<?php if ($comment->comment_approved == '0') : ?>
						<p class="meta"><span class="label"><em><?php _e( 'Your comment is on the moderation queue', 'starter' ); ?></em></span></p>
					<?php else:?>
						<?php printf( __( '%s', 'starter' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
						<span class="slash">&nbsp;/&nbsp;</span>
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-permalink">
							<?php printf( __( '%1$s, %2$s', 'starter' ), get_comment_date(),  get_comment_time() ); ?>
						</a>
						<?php comment_reply_link( array_merge( $args, array( 'before' => '<div class="alignright">', 'after' => '</div>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					<?php endif; ?>
				</div>
				<div class="comment-body"><?php comment_text(); ?></div>
			</div>
		</div>
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'starter' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'starter' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since [starter] 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function starter_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'starter_customize_register' );

