<?php
/**
 * The single template file.
 *
 * @category  Theme
 * @package   [starter]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */

get_header( get_post_format() );

if ( have_posts() ):
	while ( have_posts() ):
		the_post();

		/* If you want to overload this in a child theme then include a file
		 * called content-single.php and that will be used instead.
		 */
		 get_template_part( 'content', 'single' );

		 /* Display navigation to next/previous pages when applicable */
		 do_action( 'pagination' );

		 comments_template( '', true );
	 endwhile;
else:
	 get_template_part( 'content', 'none' );
endif;

get_footer( get_post_format() );
