<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(), array( 'parent-style' ) );
    wp_enqueue_style( 'shortcodes-css', 'http://gistonic-milano.1hi.it/wp-content/plugins/shortcodes-ultimate/assets/css/box-shortcodes.css', false );
    wp_register_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'fontawesome');
}

function themeslug_enqueue_script1() {

  //wp_dequeue_script( 'jquery' );
  //wp_deregister_script( 'jquery' );

  wp_enqueue_script( 'jquery_main', 'https://code.jquery.com/jquery-2.1.4.min.js', 10, null );
  wp_enqueue_script( 'jquery_ui', 'https://code.jquery.com/jquery-1.11.3.min.js',  10, null );
  //wp_enqueue_script( 'jquery_migrate', 'http://gistonic-milano.1hi.it/wp-includes/js/jquery/jquery-migrate.min.js',  10, null );

}

add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_script1' );

if ( ! function_exists( 'twentysixteen_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * Create your own twentysixteen_post_thumbnail() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
    <h1 class="h1-post-thumbnail"><span><?php the_title(); ?></span></h1>
    <div class="info-thumb" id="box-info-thumb"></div>
    <button onclick="onClick_showFotoInfo()" class="button-thumb-bottom-right">
      <i class="fa fa-exclamation-circle" style="font-size:10px;color:#FFFFFF"></i>
    </button>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" style="box-shadow: 0 0 0 0 currentColor;">
    <?php the_post_thumbnail('thumbnail', array('alt' => the_title_attribute( 'echo=0' )));  ?>
	</a>

	<?php endif; // End is_singular()
}
endif;

function wpcustom_inspect_scripts_and_styles() {
  global $wp_scripts;
  global $wp_styles;

  // Runs through the queue scripts
  foreach( $wp_scripts->queue as $handle ) :
  $scripts_list .= $handle . ' | ';
  endforeach;

  // Runs through the queue styles
  foreach( $wp_styles->queue as $handle ) :
  $styles_list .= $handle . ' | ';
  endforeach;

  printf('Scripts: %1$s  Styles: %2$s',
  $scripts_list,
  $styles_list);
}

function wpbeginner_remove_version() {
  return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');

/*
 * http://www.denisbouquet.com/remove-wordpress-emoji-code/
 *
 */

add_action( 'init', function(){

  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');

  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );

} );



function themeslug_enqueue_style() {
  global $post;
  $category = get_the_category();
  $catslug=$category[0]->slug;
  if($catslug=='mappe'){

    wp_dequeue_style( 'parent-style' );
    wp_deregister_style( 'parent-style' );
    wp_dequeue_style( 'child-style' );
    wp_deregister_style( 'child-style' );
    wp_dequeue_style( 'admin-bar' );
    wp_deregister_style( 'admin-bar' );
  }
}

function themeslug_enqueue_script() {
  global $post;
  $category = get_the_category();
  $catslug=$category[0]->slug;
  if($catslug=='mappe'){


    wp_dequeue_script( 'admin-bar' );
    wp_deregister_script( 'admin-bar' );
    wp_dequeue_script( 'twentysixteen-html5' );
    wp_deregister_script( 'twentysixteen-html5' );

    //wp_enqueue_script( 'jquery_main', 'https://code.jquery.com/jquery-2.1.4.min.js', 10, null );
    //wp_enqueue_script( 'jquery_ui', 'https://code.jquery.com/jquery-1.11.3.min.js',  10, null );

  }
}

add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_script' );

function Strip_text($data, $size, $lastString = ""){
 $data = strip_tags($data);
 if(mb_strlen($data, 'utf-8') > $size){
     $result = mb_substr($data,0,mb_strpos($data,' ',$size,'utf-8'),'utf-8');
         if(mb_strlen($result, 'utf-8') <= 0){
         $result = mb_substr($data,0,$size,'utf-8');
         $result = mb_substr($result, 0, mb_strrpos($result, ' ','utf-8'),'utf-8');;
     }
     if(strlen($lastString) > 0) {
         $result .= $lastString;
     }
 }else{
 $result = $data;
 }
 return $result;
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

function my_myme_types($mime_types){
    $mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
    $mime_types['gpx'] = 'application/gpx+xml'; //Adding gpx files
    $mime_types['geojson'] = 'application/vnd.geo+json'; //Adding gpx files
    return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);

function theme_geodata_enqueue_style() {
  global $post;
  if( is_singular( array('geodata') ) ){
    wp_dequeue_style( 'parent-style' );
    wp_deregister_style( 'parent-style' );
    //wp_dequeue_style( 'child-style' );
    //wp_deregister_style( 'child-style' );
    wp_enqueue_style( 'leafletjs_css', 'http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css', false );
    wp_enqueue_style( 'bootstrap_css', 'http://www.cityplanner.it/experiment_host/supply/css/bootstrap_twentysixteen.min.css', false );

    wp_enqueue_style( 'mbootstrap1_css', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/material-fullpalette.css', false );
    wp_enqueue_style( 'mbootstrap2_css', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/material.css', false );
    wp_enqueue_style( 'mbootstrap3_css', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/ripples.css', false );
    wp_enqueue_style( 'mbootstrap4_css', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/roboto.css', false );
    wp_enqueue_style( 'mbootstrap5_css', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/fonts/Material-Design-Icons.svg', false );

    wp_enqueue_style( 'ionicons_css', 'http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', false );
    wp_enqueue_style( 'geodata_css', 'http://gistonic-milano.1hi.it/wp-content/themes/twentysixteen-child/style-geodata.css', false );

    wp_register_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'fontawesome');
  }
}

function theme_geodata_enqueue_script() {
  global $post;


    //wp_dequeue_script( 'jquery' );
    //wp_deregister_script( 'jquery' );
    wp_enqueue_script( 'jquery_main', 'https://code.jquery.com/jquery-2.1.4.min.js', 10, null );
    wp_enqueue_script( 'jquery_ui', 'https://code.jquery.com/jquery-1.11.3.min.js',  10, null );

    wp_enqueue_script( 'bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', 10, null  );
    wp_enqueue_script( 'leafletjs_js', 'http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js', 1, null  );

}

add_action( 'wp_enqueue_scripts', 'theme_geodata_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'theme_geodata_enqueue_script' );
