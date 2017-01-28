<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php _e( 'Featured', 'twentysixteen' ); ?></span>
		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<?php twentysixteen_excerpt(); ?>

	<div class="entry-content">

		<div class="su-row">

			<div class="su-column su-column-size-1-3">
				<div class="su-column-inner su-clearfix"><?php twentysixteen_post_thumbnail(); ?></div>
			</div>
			<div class="su-column su-column-size-2-3">
				<div class="su-column-inner su-clearfix">
					<?php
						/* translators: %s: Name of current post */
						/*the_content( sprintf(
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
							get_the_title()
						) );
						*/
						$content=Strip_text(get_the_content(), 250, $lastString = "");
						echo $content;
						echo " <i><a href='".get_permalink()."'>Continua >>></a></i>";

						wp_link_pages( array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
							'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
							'separator'   => '<span class="screen-reader-text">, </span>',
						) );
					?>
				</div>
			</div>
		</div>


	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php twentysixteen_entry_meta(); ?>
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
