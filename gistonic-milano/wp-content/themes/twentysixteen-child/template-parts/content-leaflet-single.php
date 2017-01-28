<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
 $postid = get_the_ID();

 $zoom=get_field('zoom');
 $lat = get_only_location($postid,'lat');
 $lng = get_only_location($postid,'lng');

?>

			<script type='text/javascript' src='<?php $mapjs = get_field('mapjs'); echo $mapjs; ?>'></script> <!-- MAP -->
			<script type='text/javascript' src='<?php $stylejs = get_field('stylejs'); echo $stylejs; ?>'></script> <!-- STYLE -->

			<div id="map"></div> <!-- this is the initial look of the map. in most cases it is done externally using something like a map.css stylesheet were you can specify the look of map elements, like background color tables and so on.-->

			<script>

				var markers_t = {};
				// MAP
				var map = L.map('map', { zoomControl:true }).setView([<?php echo $lat; ?>,<?php echo $lng; ?>], <?php echo $zoom; ?>);
				var feature_group = new L.featureGroup([]);


				//map.addLayer(googleLayer);

				var basemap_0 = L.tileLayer(project_tile, {
					minZoom: 0,
					maxZoom: 22,
					attribution: attribution_tile
				});
				basemap_0.addTo(map);

				var title = new L.Control();
				title.onAdd = function (map) {
					this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
					this.update();
					return this._div;
			    };
			    title.update = function () {
					this._div.innerHTML = '<h2><?php the_title( '', '' ); ?></h2>Un progetto di <a href="http://gistonic-milano.1hi.it/">GIStonic MILANO</a>'
				};
				title.addTo(map);

				var baseMaps = {
					'OSM Standard': basemap_0
				};

				L.control.layers(baseMaps).addTo(map);
				L.control.scale({options: {position: 'bottomleft',maxWidth: 100,metric: true,imperial: false,updateWhenIdle: false}}).addTo(map);

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
