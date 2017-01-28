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
      <div class="well bs-component" id="main-container">

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
}
?>

<script>

	//$("#send_email_button").click(scriviemail($("#youremail").val));

		//console.log("http://gistonic-milano.1hi.it/tools/scrivi_photo.php?msg="+msg+"&photo="+photo+"&lat="+lat+"&lng="+lng);
		//var dimenticatiAPI = "http://gistonic-milano.1hi.it/tools/scrivi_photo.php?msg="+msg+"&photo="+photo+"&lat="+lat+"&lng="+lng;
		//$.getJSON(dimenticatiAPI, function(data){});
		$('#main-container').html(''
		+'Grazie per avere inviato la tua foto ... puoi inserirne un altra se vuoi >> <a  href="http://gistonic-milano.1hi.it/send-gpx/">VAI</a>'
		+'');



</script>
