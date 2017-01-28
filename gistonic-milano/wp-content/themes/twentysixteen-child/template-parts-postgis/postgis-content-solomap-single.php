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
	console.log("file: postgis-content-single.php >> caricato");
</script>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' );?>

	</header><!-- .entry-header -->

	<?php twentysixteen_excerpt(); ?>

	<?php twentysixteen_post_thumbnail(); ?>

	<div>
		<?php

			$location = get_field('map');
			$lat=$location['lat'];
			$lng=$location['lng'];
			$address=$location['address'];

			echo "<h2>Map center</h2>";
			echo "Latitude: " . $lat . " | " . "Longitude: " . $lng . "<br>";
			echo "Indirizzo: " . $address;

			echo "<h2>Contenuto</h2>";
			the_content();

?>

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>

	<script type='text/javascript' src='<?php $mapjs = get_field('mapjs'); echo $mapjs; ?>'></script> <!-- MAP -->
	<script type='text/javascript' src='<?php $stylejs = get_field('stylejs'); echo $stylejs; ?>'></script> <!-- STYLE -->

	<div id="mapid" style="height: 400px;"></div>

	<script>

		var mymap = L.map('mapid',{ zoomControl: false}).setView([<?php echo $lat; ?>, <?php echo $lng; ?>], 10);

  	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw', {
  		maxZoom: 18,
  		attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
  			'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
  			'Imagery © <a href="http://mapbox.com">Mapbox</a>',
  		id: 'mapbox.streets'
  	}).addTo(mymap);

	  //var tableAPI = "http://www.cityplanner.it/cassonet/api/test/";
	  var tableAPI = "http://107.170.34.247/api/test/api_<?php echo get_field('geometry_name');?>.php";
		console.log(tableAPI);
    //Predefined callback function
    var geometry = new L.featureGroup();


    dataString = {token : "ABC",A:1,B:2,query:"x",value:0,responseType:"geometry"};
    $.ajax({
        dataType: "jsonp",
        url: tableAPI + '?callback=runCallback',
        data: dataString
    });

		function runCallback(data) {
      //console.log(JSON.stringify(data.response));
			crea_mappa(data);

    }

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

		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
<?php
	$post_thumbnail_id = get_post_thumbnail_id();
	$image_title = get_post($post_thumbnail_id)->post_title;
	$caption = str_replace("'", "&rsquo;",  get_post($post_thumbnail_id)->post_excerpt);
	$thumb_url=wp_get_attachment_url( get_post($post_thumbnail_id)->ID);
	$thumb_plink=get_permalink( get_post($post_thumbnail_id)->ID);
?>
