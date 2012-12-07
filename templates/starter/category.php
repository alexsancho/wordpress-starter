<?php
/**
 * The template for displaying Category pages.
 *
 * Used to display archive-type pages for posts in a category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @category  Theme
 * @package   [starter]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */

	get_header();
?>

	<section id="primary" class="site-content">
		<div id="content" role="main">
		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Category Archives: %s', 'starter' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>

	<?php
	if ( category_description() ):
		// Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
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
?>
		</div>
	</section>
<?php
	get_footer();
