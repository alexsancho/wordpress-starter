<?php
/**
 * The main template file.
 *
 * Copyright (c) 2012, Alex Sancho
 *
 * @category  Theme
 * @package   [starter]
 * @author    Alex Sancho
 * @copyright 2012 Alex Sancho
 * @license   http://opensource.org/licenses/mit-license.php MIT Licensed
 */

	get_header();

	/* Run the loop to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-index.php and that will be used instead.
	 */
	get_template_part( 'loop', 'index' );

	get_footer();
