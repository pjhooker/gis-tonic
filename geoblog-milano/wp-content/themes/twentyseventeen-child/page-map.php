<?php
/**
 * Template Name: map1
 *
 */


?>

<!DOCTYPE html>
<html>
<head>
	
	<title>Quick Start - Leaflet</title>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>

	<style type="text/css">
		body {
	padding: 0;
	margin: 0;
}
html, body, #map {
	height: 100%;
	width: 100%;
	padding: 0;
	margin: 0;
}



#map{
	position: absolute;
}
	</style>
</head>
<body>



<div id="map"></div>

<script>

	var map = L.map('map').setView([45.463388, 9.187559], 13);

	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
			'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="http://mapbox.com">Mapbox</a>',
		id: 'mapbox.streets'
	}).addTo(map);


<?php
  // The Query to show a specific Custom Field
  $the_query = new WP_Query( array( 'posts_per_page' => -1, 'post_type' => 'instagram','post_status' => 'publish' ) );

  $i=0;
  // The Loop
  while ( $the_query->have_posts() ) : $the_query->the_post();
    $lat=0;
    $postid   = get_the_ID();
    $title   = get_the_title();
		$content_map=0;

		if(!empty(get_field('map',$postid))){
			$content_map=1;
		}
		else{
			if(!empty(get_field('instagram_location_lat',$postid))){
				$content_map=2;
			}
		}

		if(!$content_map==0){
			if($content_map==1){
				$lat=get_only_location($postid,"lat");
				$lng=get_only_location($postid,"lng");
			}
			else{
				$lat=get_field("instagram_location_lat",$postid);
				$lng=get_field("instagram_location_long",$postid);
			}
			?>
				console.log("<?php echo $title;?>");

			     L.marker([<?php echo $lat;?>, <?php echo $lng;?>]).addTo(map);

			<?php	
		}

    
  endwhile;
  // Reset Post Data
  wp_reset_postdata();
?>



</script>



</body>
</html>
