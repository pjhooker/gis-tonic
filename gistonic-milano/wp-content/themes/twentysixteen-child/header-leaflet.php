<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>

		

	<!-- Material Design fonts -->
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Bootstrap -->
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

	<!-- Bootstrap Material Design -->
  <link href="http://fezvrasta.github.io/bootstrap-material-design/dist/css/bootstrap-material-design.css" rel="stylesheet">

	<!-- qgis2leaf -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.5/leaflet.css" /> <!-- we will us e this as the styling script for our webmap-->
	<link rel="stylesheet" href="http://www.cityplanner.it/experiment_host/php/qgis2leaf/main_map/css/MarkerCluster.css" />
	<link rel="stylesheet" href="http://www.cityplanner.it/experiment_host/php/qgis2leaf/main_map/css/MarkerCluster.Default.css" />
	<link rel="stylesheet" type="text/css" href="http://www.cityplanner.it/experiment_host/php/qgis2leaf/main_map/css/own_style_full.css">

	<!-- jQuery Core & UI-->
	<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
	<script src="https://code.jquery.com/jquery-1.11.3.js"></script>

		<!-- jQuery Core & UI-->
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script> <!-- this is the javascript file that does the magic-->



	<script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>



	<script src="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script> <!-- this is the javascript file that does the magic-->
	<script src="http://www.cityplanner.it/experiment_host/php/qgis2leaf/main_map/js/leaflet.markercluster.js"></script>
	<!-- /qgis2leaf -->

</head>

<body>
