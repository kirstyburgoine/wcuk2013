<?php
/**
 * Template Name: Flexible Content Template, No Sidebar
 *
 * Description: Demo of how flexible content can be used to create multi column layouts.
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
		while ( have_posts() ) : the_post(); 

			// Set the count to zero
			$content_count = 0; ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>

				<div class="entry-content">

					<?php the_content(); ?>
					
					<div class="clear"></div> 

				</div><!-- .entry-content -->

					<hr />

					<?php 
					// ------------------------------------------------------------------------------------------
					// create a new loop for the content using has_sub_field()
					while ( has_sub_field('flexible_content') ) : ?>

						<?php 
						// increase the count with each loop through and add a horizontal rule
						// This divides each flexible content area rather than each column
						if ( $content_count++ > 0 ) : ?>
							<hr />
						<?php 
						endif; ?>

						<div class="flexible-content">
							
							<?php 
							// get the template part dependant on what has been created in the page admin
							get_template_part('content-flexible', get_row_layout()); 
							// get_row_layout() will return the current layout created within the flexible content field
							?>
						
						</div>

					<?php 
					endwhile; ?>

				
					

			</article><!-- #post -->

			<?php //comments_template( '', true ); ?>
			
			
		<?php 
		endwhile; // end of the loop. ?>

		</div><!-- #content -->
	
	</div><!-- #primary -->

<?php get_footer(); ?>