<?php
/**
 * @package Product Pulse
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
        <div class="entry-actions">
            <a class="addthis_button_compact label label-warning" addthis:url="<?php the_permalink(); ?>" addthis:title="<?php echo esc_attr(get_the_title()); ?>"><span class=""><span class="glyphicon glyphicon-plus"></span> <?php _e('Share', 'product-pulse'); ?></span></a>
        </div>
		<div class="entry-meta">
            <?php product_pulse_author_thumb('pull-left'); ?>
			<?php product_pulse_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'product-pulse' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

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
