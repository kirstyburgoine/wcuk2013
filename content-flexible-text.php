<?php
/**
 * The template used for displaying flexible page content in flexible-content.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

$columns = get_sub_field('flexible_content_text_columns');
$columns_title = get_sub_field('flexible_content_text_title');

?>


			<?php 
			if ( $columns_title ) : ?>
				
				<h2><?php echo $columns_title; ?></h2>

			<?php	
			endif; ?> 

			

			<?php
			if ( $columns ) : 

				// create class names for responsive layout
				$text_count     = count($columns);
				
				
				// useful if using 12 column grid layout such as Twitter Bootstrap
				$column_count   = 12; // total columns in CSS grid
				$column_span    = $column_count / $text_count;

			?>

				<div class="flexible-row">
 
					<?php while ( has_sub_field('flexible_content_text_columns') ) : 

						$sub_title = get_sub_field('flexible_content_text_columns_title');
						$sub_image = get_sub_field('flexible_content_text_columns_image'); 
						$sub_content = get_sub_field('flexible_content_text_columns_content');
						//var_dump($sub_image); ?>
				
				
						<div class="column span<?php echo $text_count; ?>">

							<div class="entry-content">
							<?php 
							// If $text_count was replaced with $column_span this would generate 
							// your grid layout for Twitter Bootstrap ?>	

							<?php 
							if ( $sub_title ) : ?>  

								<h1><?php echo $sub_title; ?></h1>

							<?php endif; ?>
							

							<?php 
							if ( $sub_image ) : ?>  

								<img src="<?php echo $sub_image['sizes']['large']; ?>" alt="<?php $sub_image['alt']; ?>" />

							<?php endif; ?>

							<?php echo $sub_content; ?>
							</div><!-- .entry-content -->

						</div><!-- /.span -->

					<?php endwhile; ?>

			 	
				</div>
			<div class="clear"></div> 
			<?php 
			endif; ?>