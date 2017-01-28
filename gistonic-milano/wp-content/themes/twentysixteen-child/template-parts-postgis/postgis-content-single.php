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
<div class="su-row">
	<div class="su-column su-column-size-2-3">
		<textarea rows="4" cols="50" id="sql-string">select st_asgeojson(st_simplify(geom,0.01)) as geojson from pg_cittametropolitane</textarea>
	</div>
	<div class="su-column su-column-size-1-3">
		<div id="response">
			<select size="5" id="list_pg_table">
			</select>
		</div>
	</div>
</div>
<div class="su-row">
	<div class="su-column su-column-size-3-3" style="text-align:center;">
		<button id="esegui">Esegui</button>
		<button id="sql1">SQL simplify 0.05</button>
		<button id="sql2">SQL centroid</button>
		<button id="sql3">SQL buffer</button>
	</div>
</div>

<script>
	$( "#sql1" ).on( "click", function() {
		$( "#sql-string" ).val("select st_asgeojson(st_simplify(geom,0.05)) as geojson from pg_cittametropolitane");
	});
	$( "#sql2" ).on( "click", function() {
		$( "#sql-string" ).val("select st_asgeojson(st_centroid(geom)) as geojson from pg_cittametropolitane");
	});
	$( "#sql3" ).on( "click", function() {
		$( "#sql-string" ).val("select st_asgeojson(st_buffer(st_simplify(geom,0.05),0.01)) as geojson from pg_cittametropolitane");
	});
</script>
<?php // text area ?>



<?php // text area END ?>




	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>

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
	  var tableAPI = "http://107.170.34.247/api/test/api01.php";
		var tableAPI2 = "http://107.170.34.247/api/test/api02.php";

    //Predefined callback function
    var pt_ristoranti = new L.featureGroup();


    dataString = {token : "ABC",A:1,B:2,query:"x",value:0,responseType:"geometry"};
    $.ajax({
        dataType: "jsonp",
        url: tableAPI + '?callback=runCallback',
        data: dataString
    });

    dataString1= {token : "ABC",A:1,B:2,query:"centroid",value:0,responseType:"geometry"};
    $.ajax({
        dataType: "jsonp",
        url: tableAPI + '?callback=runCallback1',
        data: dataString1
    });

    dataString2= {token : "ABC",A:1,B:2,query:"buffer",value:0,responseType:"geometry"};
    $.ajax({
        dataType: "jsonp",
        url: tableAPI + '?callback=runCallback2',
        data: dataString2
    });

    dataString3= {token : "ABC",A:1,B:2,query:"full",value:0,responseType:"geometry"};
    $.ajax({
        dataType: "jsonp",
        url: tableAPI + '?callback=runCallback4',
        data: dataString3
    });


		dataString4= {token : "ABC",A:1,B:2,query:"list_table",value:0,responseType:"nogeometry"};
    $.ajax({
        dataType: "jsonp",
        url: tableAPI + '?callback=runCallback4',
        data: dataString4
    });

		$( "#esegui" ).on( "click", function() {
			var sql_string = $( "#sql-string" ).val();
		  console.log( $( "#sql-string" ).val() );
			dataString5= {token : "ABC",A:1,B:2,query:"custom_sql",value:sql_string,responseType:"geometry"};
			$.ajax({
					dataType: "jsonp",
					url: tableAPI2 + '?callback=runCallback5',
					data: dataString5
			});
			function runCallback1(data) {
	      //console.log(JSON.stringify(data.response));

	      var geojsonLayer = L.geoJson(data.response);
	      pt_ristoranti.addLayer(geojsonLayer);
	      pt_ristoranti.addTo(mymap);

	    }

		});

		function invia_string(){
			console.log("Inviata");
		}

		function runCallback(data) {
      //console.log(JSON.stringify(data.response));

      var geojsonLayer = L.geoJson(data.response);
      pt_ristoranti.addLayer(geojsonLayer);
      pt_ristoranti.addTo(mymap);

    }

    function runCallbacknogeometry(data) {
			//console.log("test4");
			//console.log(JSON.stringify(data.response));

			$.each( data.response, function( key, value ) {
			  //console.log( value.nogeometry );
				console.log(JSON.stringify(value.features[0].nogeometry));
				$.each( value.features[0].nogeometry, function( key, value ) {
					//console.log( value.nogeometry );
					//console.log(JSON.stringify(value.features[0].nogeometry));
					$('#list_pg_table').append($("<option></option>")
						.attr("value",1)
						.text(value.table_name));
				});

			});

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
