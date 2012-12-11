<?php
/**
 * The 404 error file.
 *
 * @category  Theme
 * @package   [bootstrap]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */

get_header();
?>
		<article id="post-0" class="post error404 no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'bootstrap' ); ?></h1>
			</header>

			<div class="entry-content">
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'bootstrap' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</article>
<?php
	get_footer();
