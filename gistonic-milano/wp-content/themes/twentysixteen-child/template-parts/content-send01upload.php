<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css" /> <!-- we will us e this as the styling script for our webmap-->

	<!-- qgis2leaf -->
	<script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script> <!-- this is the javascript file that does the magic-->

	<div class="row">
	      <div class="col-md-12">
	        <div class="well bs-component">
	          <div class="form-horizontal">
	            <fieldset>
	              <div class="form-group is-empty" id="send_photo_button" >

								</div>
	            </fieldset>
						</div>
<div id="map" style="width: 100%; height: 800px"></div>

	</div>
</div>
</div>
<?php

// https://cube3x.com/upload-files-to-wordpress-media-library-using-php/
if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
$uploadedfile = $_FILES['file'];
$upload_overrides = array( 'test_form' => false );
$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
if ( $movefile ) {
    $wp_filetype = $movefile['type'];
    $filename = $movefile['file'];
    $wp_upload_dir = wp_upload_dir();
    $attachment = array(
        'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ),
        'post_mime_type' => $wp_filetype,
        'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
        'post_content' => '',
        'post_status' => 'inherit'
    );

    $attach_id = wp_insert_attachment( $attachment, $filename);

    // Run the wp_insert_attachment function. This adds the file to the media library and generates the thumbnails. If you wanted to attch this image to a post, you could pass the post id as a third param and it'd magically happen.
    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
    wp_update_attachment_metadata($attach_id,  $attach_data);

    $attach_url= wp_get_attachment_url($attach_id);

    //$exif = exif_read_data($attach_url);
    //$lng = getGps($exif["GPSLongitude"], $exif['GPSLongitudeRef']);
    //$lat = getGps($exif["GPSLatitude"], $exif['GPSLatitudeRef']);

}
?>

<script>

	getLocation();

	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		}
		else {
			//add_point();
		}
	}

	function showPosition(position) {
			console.log(position);


			var lat = position.coords.latitude;
			var lng = position.coords.longitude;

			var map = new L.Map('map', {center: new L.LatLng(lat, lng), zoom: 17});
			var osm = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
							maxZoom: 18,
							attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
									'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
									'Imagery © <a href="http://mapbox.com">Mapbox</a>'
					});

			map.addLayer(osm);

			var photo = <?php echo $attach_id; ?>

			var marker = L.marker([lat, lng]).addTo(map);



			$( "#send_photo_button" ).html( ""
			+"<div class='col-md-12'>"
			+"<input type='text' class='form-control' style='cursor: auto;' placeholder='Descrizione'  id='yourmsg'>"
			+"<button id='send_photo_button' onclick='scriviphoto($(\"#yourmsg\").val(),"+photo+","+lat+","+lng+")' class='btn btn-raised btn-danger' style='width:100%'>Invia</button></div>"
			+"<span class='material-input'></span>");

	}
	//$("#send_email_button").click(scriviemail($("#youremail").val));

	function scriviphoto(msg,photo,lat,lng){
		console.log("http://gistonic-milano.1hi.it/tools/scrivi_photo.php?msg="+msg+"&photo="+photo+"&lat="+lat+"&lng="+lng);
		var dimenticatiAPI = "http://gistonic-milano.1hi.it/tools/scrivi_photo.php?msg="+msg+"&photo="+photo+"&lat="+lat+"&lng="+lng;
		$.getJSON(dimenticatiAPI, function(data){});

		$('#myModal').modal('show');
		$('.modal-body').html(''
		+'Grazie per avere inviato la tua foto ... puoi inserirne un altra se vuoi >> <a  href="http://gistonic-milano.1hi.it/send-photo-slot/">VAI</a>'
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
