<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Twelve already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @category  Theme
 * @package   [foundation]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */

get_header();

if ( have_posts() ):
	?>
	<header class="archive-header">
		<h1 class="archive-title">
	<?php
	if ( is_day() ) :
		printf( __( 'Daily Archives: %s', 'foundation' ), '<span>' . get_the_date() . '</span>' );
	elseif ( is_month() ) :
		printf( __( 'Monthly Archives: %s', 'foundation' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'foundation' ) ) . '</span>' );
	elseif ( is_year() ) :
		printf( __( 'Yearly Archives: %s', 'foundation' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'foundation' ) ) . '</span>' );
	else :
		_e( 'Archives', 'foundation' );
	endif;
	?>
		</h1>
	</header>
	<?php
	/* Start the Loop */
	while ( have_posts() ):
		the_post();

		/* Include the post format-specific template for the content. If you want to
		 * this in a child theme then include a file called called content-___.php
		 * (where ___ is the post format) and that will be used instead.
		 */
		get_template_part( 'content', get_post_format() );
	endwhile;

	do_action( 'pagination' );
else:
	get_template_part( 'content', 'none' );
endif;

get_footer();
