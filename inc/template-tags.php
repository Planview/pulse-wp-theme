<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Product Pulse
 */

if ( ! function_exists( 'product_pulse_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function product_pulse_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'product-pulse' ); ?></h1>
		<ul class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<li class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav"></span> Older posts', 'product-pulse' ) ); ?></li>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<li class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav"></span>', 'product-pulse' ) ); ?></li>
			<?php endif; ?>

		</ul><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'product_pulse_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function product_pulse_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'product-pulse' ); ?></h1>
		<ul class="nav-links">

            <li class="nav-previous"><?php previous_post_link( '%link', _x( '<span class="meta-nav"></span> %title', 'Previous post link', 'product-pulse' ) ); ?></li>
            <li class="nav-next"><?php next_post_link(     '%link', _x( '%title <span class="meta-nav"></span>', 'Next post link',     'product-pulse' ) ); ?></li>

		</ul><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'product_pulse_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function product_pulse_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'product-pulse' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'product-pulse' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<h4><?php printf( '<cite class="fn">%s</cite>', get_comment_author() ); ?></h4>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'product-pulse' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
					<?php edit_comment_link( __( 'Edit', 'product-pulse' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'product-pulse' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				) ) );
			?>
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for product_pulse_comment()

if ( ! function_exists( 'product_pulse_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function product_pulse_posted_on() {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() )
        );

        printf( __( '<p class="meta-text"><span class="byline">By %2$s</span><span class="separator"> / </span><span class="posted-on">%1$s</span></p>', 'product-pulse' ),
            sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
                esc_url( get_permalink() ),
                $time_string
            ),
            sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                esc_html( get_the_author() )
            )
        );
    }
endif;

if ( ! function_exists( 'product_pulse_author_thumb' ) ) :
    /**
     * Prints HTML of author avatar with link to archive.
     */
    function product_pulse_author_thumb( $class ) {
        printf(
            '<a href="%1$s" class="author-thumb%2$s">%3$s</a>',
            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
            ( !empty($class) ? esc_attr( ' ' . $class ) : '' ),
            get_avatar( get_the_author_meta( 'ID' ), 24, null, get_the_author_meta( 'display_name' ) )
        );
    }
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function product_pulse_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so product_pulse_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so product_pulse_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in product_pulse_categorized_blog.
 */
function product_pulse_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'product_pulse_category_transient_flusher' );
add_action( 'save_post',     'product_pulse_category_transient_flusher' );
