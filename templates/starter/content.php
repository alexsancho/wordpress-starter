<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @category  Theme
 * @package   [starter]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<div class="featured-post">
			<?php _e( 'Featured post', 'starter' ); ?>
		</div>
		<?php endif; ?>
		<header class="entry-header">
			<?php the_post_thumbnail(); ?>
			<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php else : ?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'starter' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<?php endif; // is_single() ?>
			<?php if ( comments_open() ) : ?>
				<div class="comments-link">
					<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'starter' ) . '</span>', __( '1 Reply', 'starter' ), __( '% Replies', 'starter' ) ); ?>
				</div>
			<?php endif; // comments_open() ?>
		</header>

		<?php if ( is_search() ):
			// Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading', 'starter' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'starter' ), 'after' => '</div>' ) ); ?>
		</div>
		<?php endif; ?>

		<footer class="entry-meta clearfix">
			<?php starter_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'starter' ), '<span class="edit-link">', '</span>' ); ?>
			<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ):
				// If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
				<div class="author-info clearfix">
					<div class="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'starter_author_bio_avatar_size', 68 ) ); ?>
					</div>
					<div class="author-description">
						<h2><?php printf( __( 'About %s', 'starter' ), get_the_author() ); ?></h2>
						<p><?php the_author_meta( 'description' ); ?></p>
						<div class="author-link">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'starter' ), get_the_author() ); ?>
							</a>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</footer>
	</article>
