<?php
/**
 * The template used for displaying flexible page content in flexible-content.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

$carousel_images = get_sub_field('flexible_content_carousel_images');
$carousel_title = get_sub_field('flexible_content_carousel_title');

// var_dump($all_images);

	if ( $carousel_title ) : ?>
				
		<h2><?php echo $carousel_title; ?></h2>

	<?php	
	endif; ?>

	<div class="clear"></div> 

	<?php
	if ( $carousel_images ) : ?>

		<div class="flexible-row">

			<div class="flexslider">
			
				<ul class="slides">
 
				<?php foreach ( $carousel_images as $image ) : ?>


					<li>
						<div class="column span2 flex-image">
							
							<img src="<?php echo $image['sizes']['gallery']; ?>" alt="<?php echo $image['alt']; ?>" />
							<?php echo wpautop($image['caption']); ?>
						
						</div>

						<div class="column span2">
							<h1><?php echo $image['title']; ?></h1>
							<?php echo wpautop($image['description']); ?>
						
						</div>
					</li>
	


				<?php 
				endforeach; ?>

				</ul>
			</div>
			 	
		</div>
		
		<div class="clear"></div> 
	
	<?php 
	endif; ?>