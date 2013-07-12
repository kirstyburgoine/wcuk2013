<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); 


				$post_code = get_field('post_code');
				//var_dump($post_code);
				?>


				<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
				<script>
					
					function initialize() {

					  var myLatlng = new google.maps.LatLng(<?php echo $post_code['coordinates']; ?>);
					  var mapOptions = {
					    zoom: 15,
					    center: myLatlng,
					    mapTypeId: google.maps.MapTypeId.ROADMAP
					  }
					  var map = new google.maps.Map(document.getElementById('map-single'), mapOptions);

					  var image = '<?php bloginfo( 'stylesheet_directory' ); ?>/images/marker.png';
					  var myLatLng = new google.maps.LatLng(<?php echo $post_code['coordinates']; ?>);
					  var marker = new google.maps.Marker({
					      position: myLatLng,
					      map: map,
					      icon: image
					  });
					}

					google.maps.event.addDomListener(window, 'load', initialize);
				</script>


			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>


<?php get_footer(); ?>