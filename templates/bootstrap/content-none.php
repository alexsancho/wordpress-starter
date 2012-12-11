<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @category  Theme
 * @package   [bootstrap]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */
?>

	<article id="post-0" class="post no-results not-found">
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Nothing Found', 'bootstrap' ); ?></h1>
		</header>

		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'bootstrap' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</article>
