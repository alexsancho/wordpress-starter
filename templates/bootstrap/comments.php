<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to bootstrap_comment() which is
 * located in the functions.php file.
 *
 * @category  Theme
 * @package   [bootstrap]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf(
					_n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'bootstrap' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>'
				);
			?>
		</h2>

		<ul class="commentlist media-list">
			<?php wp_list_comments( array( 'callback' => 'bootstrap_comment', 'style' => 'ol' ) ); ?>
		</ul>

	<?php
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ):
		// are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation nav nav-pills clearfix" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'bootstrap' ); ?></h1>
			<div class="nav-previous pull-left"><?php previous_comments_link( __( '&larr; Older Comments', 'bootstrap' ) ); ?></div>
			<div class="nav-next pull-right"><?php next_comments_link( __( 'Newer Comments &rarr;', 'bootstrap' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php
	/* If there are no comments and comments are closed, let's leave a note.
	 * But we only want the note on posts and pages that had comments in the first place.
	 */
	if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'bootstrap' ); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php bootstrap_comment_form(); ?>

</div>
