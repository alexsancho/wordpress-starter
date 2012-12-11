<?php
/**
 * The template for displaying posts in the Quote post format
 *
 * @category  Theme
 * @package   [bootstrap]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading', 'bootstrap' ) ); ?>
		</div>

		<footer class="entry-meta">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'bootstrap' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php echo get_the_date(); ?></a>
			<?php if ( comments_open() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'bootstrap' ) . '</span>', __( '1 Reply', 'bootstrap' ), __( '% Replies', 'bootstrap' ) ); ?>
			</div>
			<?php endif; // comments_open() ?>
			<?php edit_post_link( __( 'Edit', 'bootstrap' ), '<span class="edit-link">', '</span>' ); ?>
		</footer>
	</article>
