<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
 $geometry_type=get_field('geometry_type');
 $file_geojson=get_field('file_geojson');
?>
<div class="row">
<article id="post-<?php the_ID(); ?>" class="col-md-12">

    <div class="page-header entry-header">
      <?php the_title( '<h1 id="navbar" class="entry-title">', '</h1>' ); ?>
    </div>

	  <div class="bs-component">

			<?php twentysixteen_post_thumbnail(); ?>

		</div>

</article><!-- #post-## -->
</div>

<div class="row">
<article id="post-<?php the_ID(); ?>-1" class="col-md-12">

		<div class="bs-component entry-content">
			<?php
				the_content();
				//print_r($file_geojson);
			?>
		</div><!-- .bs-component -->

		<div class="bs-component entry-content" style="text-align:center;">
			<a href="<?php echo $file_geojson['url']; ?>" class="btn btn-sup btn-material-pink btn-raised">
	      <i class="fa fa-download"></i>
	      <span>DOWNLOAD</span>
	      <div class="ripple-container"></div>
			</a>

		</div><!-- .bs-component -->


</article><!-- #post-## -->
</div>

<div class="row">
<article id="post-<?php the_ID(); ?>-2" class="col-md-12">


		<div class="bs-component entry-content">

			<div id="map" style="width: 100%; height: 400px"></div>

		</div><!-- .bs-component -->


</article><!-- #post-## -->
</div>

<div class="bs-docs-section clearfix">
<div class="row">
<article id="post-<?php the_ID(); ?>-3" class="col-md-12">


		<div class="bs-component entry-content">

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
		</div><!-- .bs-component -->

	<footer class="bs-component entry-footer">
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
</div>
</div>

<script>

	var geometry_t={};
	// Definizione del TileLayer da caricare come sfondo
	var project_tile ='http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png';

	// Definizione degli attribuit / licenza del Tile Layer
	var attribution_tile = '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="http://cartodb.com/attributions">CartoDB</a>';

	var map = L.map('map').setView([51.505, -0.09], 13);

	L.tileLayer(project_tile,{minZoom:0,maxZoom:22,attribution:attribution_tile}).addTo(map);

	//  LAYER 01
	$.getJSON("<?php echo $file_geojson['url']; ?>", function(data) {

		//console.log(data);

		<?php if($geometry_type=='point'){ ?>
			function_icon = 'punti';
		<?php }
		else {?>
			function_icon = 'lineepoligoni';
		<?php } ?>


		name = 'l1_1';
		geometry_t[name] = new L.featureGroup();
		var def_icon = new Array();

		def_icon["temp"] = eval(function_icon);

		var geojson = L.geoJson(
			data,
			{
				<?php if($geometry_type=='point'){ ?>
					pointToLayer: def_icon["temp"]
				<?php }
				else {?>
					onEachFeature: def_icon["temp"]
				<?php } ?>
			}
		);

		geojson.addTo(map);
		map.fitBounds(geojson.getBounds()); //opzione
	});

			// STYLE
			var lineepoligoni = function(feature, layer) {
				layer.bindPopup(''
				+'');
			  layer.setStyle({
		      color: '#DC143C',
					fillColor: '#DC143C',
		      weight: '7.0',
					dashArray: '0', //'2,10',
					opacity: '1.0',
					fillOpacity: '0.5',
			  });
			};


			// STYLE
			function punti(feature,latlng) {
				//console.log(feature.properties._storage_o.iconUrl);
				return L.marker(latlng,{
						icon: L.icon({
							iconUrl: 'http://www.cityplanner.it/supply/icon_web/mapbox-maki-51d4f10/renders/marker-24@2x.png',
							iconSize: [24,24]
						}),
						//clickable:false
				}).on('click', onClick_point);
			}

			// FUNZIONE SPECIALE ONCLICK LAYER 02 A
			function onClick_point(e) {
				$('#myModal').modal('show');
				$('.modal-body').html(''
				+'<h2><?php the_title(); ?></h2>'
				+'<a href="<?php echo $file_geojson['url']; ?>">OPEN: <?php echo $file_geojson['url']; ?></a>'
				+''
				+'');
			}

</script>

<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document" style="z-index: 2000;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<p>One fine body…</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
