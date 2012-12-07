<?php
/**
 * The template for displaying Search Results pages.
 *
 * @category  Theme
 * @package   [starter]
 * @author    Alex Sancho
 * @copyright 2012 Alex Sancho
 * @license   http://opensource.org/licenses/mit-license.php MIT Licensed
 */

get_header();
?>

	<section id="primary" class="site-content">
		<div id="content" role="main">
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'starter' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
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
