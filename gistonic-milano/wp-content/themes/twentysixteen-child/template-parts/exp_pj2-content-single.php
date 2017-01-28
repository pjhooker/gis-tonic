<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<script>
	console.log("file: template-parts/exp_pj2-content-single.php caricato");
</script>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php /* the_title( '<h1 class="entry-title">', '</h1>' ); */?>

	</header><!-- .entry-header -->

	<?php twentysixteen_excerpt(); ?>

	<?php twentysixteen_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		
			$location = get_field('map');

			$lat=$location['lat'];
			$lng=$location['lng'];
			$address=$location['address'];

			echo "<h2>Location</h2>";
			echo "Latitude: " . $lat . " | " . "Longitude: " . $lng . "<br>";
			echo "Indirizzo: " . $address;
		
			echo "<h2>Contenuto</h2>";		
		
			the_content();

	?>
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css" />
		<script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
		
		<div id="mapid" style="height: 300px;"></div>
		
		<script>
			
			//var mymap = L.map('mapid').setView([51.505, -0.09], 13);
			var mymap = L.map('mapid').setView([
				<?php echo $lat; ?>, 
				<?php echo $lng; ?>
			], 13);
			
			L.tileLayer('http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
				maxZoom: 19,
				attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, Tiles courtesy of <a href="http://hot.openstreetmap.org/" target="_blank">Humanitarian OpenStreetMap Team</a>'
			}).addTo(mymap);
			
			//var marker = L.marker([51.5, -0.09]).addTo(mymap);
			var marker = L.marker([
				<?php echo $lat; ?>, 
				<?php echo $lng; ?>
			]).addTo(mymap);
			
		</script>
		
		
	<?php
		
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

			if ( '' !== get_the_author_meta( 'description' ) ) {
				get_template_part( 'template-parts/biography' );
			}
		?>
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
<?php
	$post_thumbnail_id = get_post_thumbnail_id();
	$image_title = get_post($post_thumbnail_id)->post_title;
	$caption = str_replace("'", "&rsquo;",  get_post($post_thumbnail_id)->post_excerpt);
	$thumb_url=wp_get_attachment_url( get_post($post_thumbnail_id)->ID);
	$thumb_plink=get_permalink( get_post($post_thumbnail_id)->ID);

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
