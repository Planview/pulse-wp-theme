<?php
/**
 * @package Product Pulse
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>


        <div class="entry-actions">
            <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
                <span class="comments-link"><?php comments_popup_link( __( '<span class="glyphicon glyphicon-comment"></span> 0', 'product-pulse' ), __( '<span class="glyphicon glyphicon-comment"></span> 1', 'product-pulse' ), __( '<span class="glyphicon glyphicon-comment"></span> %', 'product-pulse' ) ); ?></span>
            <?php endif; ?>
            <a class="addthis_button_compact label label-warning" addthis:url="<?php the_permalink(); ?>" addthis:title="<?php echo esc_attr(get_the_title()); ?>"><span class=""><span class="glyphicon glyphicon-plus"></span> Share</span></a>
        </div>
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
            <?php product_pulse_author_thumb('pull-left'); ?>
			<?php product_pulse_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'product-pulse' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'product-pulse' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ' ', 'product-pulse' ) );
				if ( $categories_list && product_pulse_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'product-pulse' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ' ', 'product-pulse' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'product-pulse' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>


		<?php edit_post_link( __( 'Edit', 'product-pulse' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
