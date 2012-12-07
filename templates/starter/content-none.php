<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @category  Theme
 * @package   [starter]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */
?>

	<article id="post-0" class="post no-results not-found">
		<header class="entry-header">
			<h2 class="entry-title"><?php _e( 'Nothing Found', 'starter' ); ?></h2>
		</header>

		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'starter' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</article>
