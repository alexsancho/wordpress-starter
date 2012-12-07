<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * @category  Theme
 * @package   [starter]
 * @author    Alex Sancho
 * @copyright 2012 Alex Sancho
 * @license   http://opensource.org/licenses/mit-license.php MIT Licensed
 */
?>
	<div id="primary" class="site-content">
		<div id="content" role="main">
<?php
	/* If there are no posts to display, such as an empty archive page */
	if ( have_posts() ):

		while ( have_posts() ):
			the_post();

			get_template_part( 'content', get_post_format() );

			comments_template( '', true );
		endwhile;

		/* Display navigation to next/previous pages when applicable */
		do_action( 'pagination' );
	else:
		get_template_part( 'content', 'none' );
	endif;
?>
		</div>
	</div>
