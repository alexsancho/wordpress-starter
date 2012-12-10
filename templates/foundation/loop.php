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
 * @package   [foundation]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */

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
