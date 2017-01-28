<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
	$postid = get_the_ID();

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if ( is_sticky() && is_home() ) :
			echo twentyseventeen_get_svg( array( 'icon' => 'thumb-tack' ) );
		endif;
	?>
	<header class="entry-header">
		<?php
			if ( 'post' === get_post_type() ) :
				echo '<div class="entry-meta">';
					if ( is_single() ) :
						twentyseventeen_posted_on();
					else :
						echo twentyseventeen_time_link();
						twentyseventeen_edit_link();
					endif;
				echo '</div><!-- .entry-meta -->';
			endif;

			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
				echo "<p>";
				$my_date = the_date('', '', '', FALSE); echo $my_date;
				echo " by ";
				the_author();
				echo "</p>";
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
	</header><!-- .entry-header -->

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'twentyseventeen-featured-image' ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
				get_the_title()
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php
		$content_map=0;
		if(!empty(get_field('map'))){
			$content_map=1;
		}
		else{
			if(!empty(get_field('instagram_location_lat'))){
				$content_map=2;
			}
		}

		if(!$content_map==0){
			if($content_map==1){
				$lat=get_only_location($postid,"lat");
				$lng=get_only_location($postid,"lng");
			}
			else{
				$lat=get_field("instagram_location_lat");
				$lng=get_field("instagram_location_long");
			}
			?>
				<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
				<script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
				<script
				  src="https://code.jquery.com/jquery-2.2.4.min.js"
				  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
				  crossorigin="anonymous"></script>
				<script src="https://rawgit.com/pjhooker/gistipster/master/basemaps/gistips_bassemaps.js"></script>
				<script src="https://rawgit.com/pjhooker/gistipster/master/basemaps/gistips_bassemaps_list.js"></script>
				
				<div id="mapid" style="width: 100%; height: 400px;"></div>
				
				<script>
					
					$( document ).ready(function() {
						console.log( "ready!" ); 
						$.each( data, function( key, val ) { 
							var tile_name = eval(val.Tile + "_name"); 
							//$('#container').append('tile_id: ' + val.Tile + ' | tile Name: ' + tile_name); 
						});
					});

					var lat = <?php echo $lat; ?>;
					var lng = <?php echo $lng; ?>;
					
					var mymap = L.map('mapid').setView([lat, lng], 13);

					var tile1 = L.tileLayer(tile_stamen_toner, {
      			attribution: tile_stamen_toner_attr
      		}).addTo(mymap);
      		
      		/*
					L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw', {
						maxZoom: 18,
						attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
							'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
							'Imagery © <a href="http://mapbox.com">Mapbox</a>',
						id: 'mapbox.streets'
					}).addTo(mymap);
					*/

					L.marker([lat, lng]).addTo(mymap);


				</script>
			<?php
		}

	?>

	<?php if ( is_single() ) : ?>
		<?php twentyseventeen_entry_footer(); ?>
	<?php endif; ?>

</article><!-- #post-## -->
