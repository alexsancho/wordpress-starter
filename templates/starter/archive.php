<?php
/**
 * The 404 error file.
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
?>
	<div id="primary" class="site-content">
		<div id="content" role="main">
		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'starter' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'starter' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'starter' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'starter' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'starter' ) ) . '</span>' );
					else :
						_e( 'Archives', 'starter' );
					endif;
				?></h1>
			</header>
<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

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
?>
		</div>
	</div>
<?php
	get_footer();
