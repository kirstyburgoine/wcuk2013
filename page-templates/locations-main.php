<?php
/**
 * Template Name: All Locations Template, No Sidebar
 *
 * Description: Demo of how the locations field can be used to easily update Google maps.
 *
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">

		<div id="content" role="main">

		<?php 
		while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>

				<div class="entry-content">

					<?php the_content(); ?>

					<hr />

				</div><!-- .entry-content -->

				<?php
				// --------------------------------------------------------
				// --------------------------------------------------------
				// Add map container outside of entry-content ?>
				<div id="map-canvas"></div>
					
			</article><!-- #post -->

			<?php //comments_template( '', true ); ?>
			
			
		<?php 
		endwhile; // end of the loop. ?>

		</div><!-- #content -->
	
	</div><!-- #primary -->

<?php 
// -----------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------
// This is the main locations section, so we want to show markers for all the child pages
//
// -----------------------------------------------------------------------------------------
// Get the coordinates for each marker

$args = array(
  'post_type' => 'page',
  'meta_key' => 'post_code',
  'posts_per_page' => -1
);

query_posts($args);

$l = 0;
$marker = array();

if ( have_posts () ) : while ( have_posts() ) : the_post();
	$l++;

	// Get the details for the map and markers
	$post_code = get_field('post_code');
	$link = get_permalink();
	  
	$marker[] = "['".get_the_title()."', ". $post_code['coordinates'] .", ". $l. ", '<h3>".get_the_title()."</h3><a href=\"". $link ."\" class=read-more>Find out more &rarr;</a>']";


 endwhile; endif; wp_reset_query();

// -----------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------
?>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

<script>

var infowindow = null;

    function initialize() {

        var myOptions = {
        zoom: 6,
        center: new google.maps.LatLng(54.533832507944304,-4.37255859375),
        mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

        setMarkers(map, sites);
        infowindow = new google.maps.InfoWindow({
                content: "loading..."
            });
        /*
        var bikeLayer = new google.maps.BicyclingLayer();
        bikeLayer.setMap(map); */
    }



  var sites = [
    <?php 
    $numItems = count($marker);
    $i = 0;

    foreach ( $marker as $m ) { 

      if(++$i === $numItems) {
        echo $m;
      } else {
          echo $m.",";
      }

     } ?>
  ];



    function setMarkers(map, markers) {

      var image = {
        url: '<?php bloginfo( 'stylesheet_directory' ); ?>/images/marker.png',
        // This marker is 38 pixels wide by 45 pixels tall.
        size: new google.maps.Size(38, 45),
        // The origin for this image is 0,0.
        origin: new google.maps.Point(0,0),
        // The anchor for this image is the base of the flagpole at 0,45.
        anchor: new google.maps.Point(0, 45)
    };

        for (var i = 0; i < markers.length; i++) {
            var sites = markers[i];
            var siteLatLng = new google.maps.LatLng(sites[1], sites[2]);
            var marker = new google.maps.Marker({
                position: siteLatLng,
                map: map,
                icon: image,
                title: sites[0],
                zIndex: sites[2],
                html: sites[4]
            });

            var contentString = "Some content";

            google.maps.event.addListener(marker, "click", function () {
                //alert(this.html);
                infowindow.setContent(this.html);
                infowindow.open(map, this);
            });
        }
    }
// --------------------------------------------------------------------------------------------------
google.maps.event.addDomListener(window, 'load', initialize);



</script>



<?php get_footer(); ?>