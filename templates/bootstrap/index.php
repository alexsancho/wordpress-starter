<?php
/**
 * The main template file.
 *
 * @category  Theme
 * @package   [bootstrap]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */

	get_header();

	/* Run the loop to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-index.php and that will be used instead.
	 */
	get_template_part( 'loop', 'index' );

	get_footer();
