<?php
/**
 * The template for displaying posts in the Status post format
 *
 * @category  Theme
 * @package   [bootstrap]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-header">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'bootstrap_status_avatar', '48' ) ); ?>
			<header>
				<h1 class="entry-title"><?php the_author(); ?></h1>
				<h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'bootstrap' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php echo get_the_date(); ?></a></h2>
			</header>
		</div>

		<div class="entry-content">
			<?php the_content( __( 'Continue reading', 'bootstrap' ) ); ?>
		</div>

		<footer class="entry-meta">
			<?php if ( comments_open() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'bootstrap' ) . '</span>', __( '1 Reply', 'bootstrap' ), __( '% Replies', 'bootstrap' ) ); ?>
			</div>
			<?php endif; // comments_open() ?>
			<?php edit_post_link( __( 'Edit', 'bootstrap' ), '<span class="edit-link">', '</span>' ); ?>
		</footer>
	</article>
