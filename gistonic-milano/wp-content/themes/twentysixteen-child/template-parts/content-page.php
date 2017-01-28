<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php /* the_title( '<h1 class="entry-title">', '</h1>' ); */?>

	</header><!-- .entry-header -->

	<?php twentysixteen_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
				get_the_title()
			),
			'<footer class="entry-footer"><span class="edit-link">',
			'</span></footer><!-- .entry-footer -->'
		);
	?>

</article><!-- #post-## -->
<?php
	$post_thumbnail_id = get_post_thumbnail_id();
	$args = array( 'post_type' => 'attachment', 'orderby' => 'menu_order', 'order' => 'ASC', 'post_mime_type' => 'image' ,'post_status' => null, 'numberposts' => null, 'post_parent' => $post->ID );

	$attachments = get_posts($args);
	if ($attachments) {
		foreach ( $attachments as $attachment ) {
		  $alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
			$image_title = $attachment->post_title;
			$caption = str_replace("'", "&rsquo;",  $attachment->post_excerpt);
			$description = $image->post_content;
			$thumb_url=wp_get_attachment_url( $attachment->ID);
			$thumb_plink=get_permalink( $attachment->ID);
		}
	}
?>
<script>
function onClick_showFotoInfo() {
	$('#box-info-thumb').html('<div style="background-color:rgba(255,255,255,0.8);padding:5px;">'
	+'<h3><?php echo $image_title; ?></h3>'
	+'<p><?php echo $caption; ?></p>'
	+'<p><a href="<?php echo $thumb_plink;?>" target="_blank">Apri allegato</a></p>'
	+'<button onclick="onClick_showFotoInfo_clear()">ok</button>'
	+'</div>');
}
function onClick_showFotoInfo_clear() {
	$('#box-info-thumb').html('');
}
</script>
