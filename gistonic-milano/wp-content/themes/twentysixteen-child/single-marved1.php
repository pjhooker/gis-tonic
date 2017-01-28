<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

 $category = get_the_category();
 $catslug=$category[0]->slug;
 if($catslug=='mappe'){
	 $header='leaflet';
	 $content_template='content-leaflet';
	 $footer='leaflet';
	 $layout='leaflet';
 }
 else{
	 $header='';
	 $content_template='content';
	 $footer='';
	 $layout='';
 }

get_header($header);


?>

<script>
	console.log("file: single-exp_pj.php caricato");
</script>

<?php
	if($layout=='leaflet'){

	}
	else{
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
<?php
	}
?>
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the single post content template.
			
			// originale
			// get_template_part( 'template-parts/'.$content_template, 'single' );
			// modificato per exp_pj
			get_template_part( 'template-parts/exp_pj-'.$content_template, 'single' );
		
			if($layout=='leaflet'){

			}
			else{

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

				if ( is_singular( 'attachment' ) ) {
					// Parent post navigation.
					the_post_navigation( array(
						'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'twentysixteen' ),
					) );
				} elseif ( is_singular( 'post' ) ) {
					// Previous/next post navigation.
					the_post_navigation( array(
						'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentysixteen' ) . '</span> ' .
							'<span class="screen-reader-text">' . __( 'Next post:', 'twentysixteen' ) . '</span> ' .
							'<span class="post-title">%title</span>',
						'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentysixteen' ) . '</span> ' .
							'<span class="screen-reader-text">' . __( 'Previous post:', 'twentysixteen' ) . '</span> ' .
							'<span class="post-title">%title</span>',
					) );
				}
			}

			// End of the loop.
		endwhile;
		?>

		<?php
			if($layout=='leaflet'){

			}
			else{
		?>
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
		<?php
			}
		?>


<?php get_footer($header); ?>
