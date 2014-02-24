<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to product_pulse_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package Product Pulse
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php _e('Comments', 'product-pulse');
				// printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'product-pulse' ),
				//  	number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'product-pulse' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'product-pulse' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'product-pulse' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ul class="comment-list">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use product_pulse_comment() to format the comments.
				 * If you want to override this in a child theme, then you can
				 * define product_pulse_comment() and that will be used instead.
				 * See product_pulse_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'product_pulse_comment', 'end-callback' => 'product_pulse_end_comment' ) );
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'product-pulse' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'product-pulse' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'product-pulse' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'product-pulse' ); ?></p>
	<?php endif; ?>

	<?php comment_form(array(
        'id_submit'         => 'commentsubmit',
        'title_reply'       => __( 'Post a Comment' ),
        'title_reply_to'    => __( 'Post a Comment to %s' ),
        'cancel_reply_link' => __( 'Cancel Comment' ),
        'label_submit'      => __( 'Submit Comment' ),

        'comment_field' =>  '<div class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) .
            '</label><div class="input-wrapper"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
            '</textarea></div></div>',

        'comment_notes_before' => '<p class="comment-notes">' .
            __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) .
            '</p>',

        'comment_notes_after' => '',

        'fields' => apply_filters( 'comment_form_default_fields', array(

                'author' =>
                    '<div class="comment-form-author">' .
                    '<label for="author">' . __( 'Name', 'domainreference' ) .
                    ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
                    '<div class="input-wrapper"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                    '" size="30"' . $aria_req . ' /></div></div>',

                'email' =>
                    '<div class="comment-form-email"><label for="email">' . __( 'Email', 'domainreference' ) .
                    ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
                    '<div class="input-wrapper"><input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                    '" size="30"' . $aria_req . ' /></div></div>',

                'url' =>
                    ''
            )
        ),
    )); ?>

</div><!-- #comments -->
