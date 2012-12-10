<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @category  Theme
 * @package   [foundation]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */

get_header( get_post_format() );

while ( have_posts() ):
	the_post();

	/* If you want to overload this in a child theme then include a file
	 * called content-single.php and that will be used instead.
	 */
	get_template_part( 'content', 'page' );

	comments_template( '', true );
endwhile;

get_footer( get_post_format() );
