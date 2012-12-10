<?php
/**
 * The template for displaying Search Results pages.
 *
 * @category  Theme
 * @package   [foundation]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */

get_header();

if ( have_posts() ):
	?>
	<header class="page-header">
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'foundation' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	</header>
	<?php
	/* Start the Loop */
	while ( have_posts() ):
		the_post();

		get_template_part( 'content', get_post_format() );
	endwhile;

	do_action( 'pagination' );
else:
	get_template_part( 'content', 'none' );
endif;

get_footer();
