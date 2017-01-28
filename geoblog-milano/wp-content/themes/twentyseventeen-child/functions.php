<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}


function get_only_location($ID,$LATLNG){

    $location = get_field('map',$ID);

    $lat=$location['lat'];
    $lng=$location['lng'];
    $address=$location['address'];


  if ($LATLNG=='lat'){return $lat;}
  else if ($LATLNG=='lng'){return $lng;}
  else if ($LATLNG=='address'){return $address;}
  //else if ($LATLNG=='verify'){return $esistecoordinate;}
  else{}
}

?>