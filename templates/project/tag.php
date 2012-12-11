<?php
/**
 * The template for displaying Tag pages.
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @category  Theme
 * @package   [starter]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */

get_header();

if ( have_posts() ):
	?>
	<header class="archive-header">
		<h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'starter' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
	<?php
	if ( tag_description() ):
		// Show an optional tag description
		?>
		<div class="archive-meta"><?php echo tag_description(); ?></div>
	<?php endif; ?>
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
