<?php
/** content-event.php
 *
 * The template for displaying event content
 *
 * @author		Roberto Ulloa
 * @package		Sharon Chin
 * @since		1.0.0 - 28.08.2013
 */


tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php tha_entry_top(); ?>

	<header class="page-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<div class="row big-slider">
		<div class="span12 gallery-span">
			<?php

			$sharonchin_images = get_children( array(
				'post_parent'		=>	$post->ID,
				'post_type'			=>	'attachment',
				'post_mime_type'	=>	'image',
				'orderby'			=>	'menu_order',
				'order'				=>	'ASC',
				'numberposts'		=>	999
			) );

			if ( $sharonchin_images ) :
				$sharonchin_total_images	=	count( $sharonchin_images );
			?>
				<div id="archive-gallery" >
					<div class="nav-carousel-control">
						<!-- Carousel nav -->
						<a class="carousel-control" href="#gallery-slider" data-slide="prev"><?php _ex( '&lt; Previous', 'carousel-control', 'sharonchin' ); ?></a> |
						<a class="carousel-control" href="#gallery-slider" data-slide="next"><?php _ex( 'Next Image &gt;', 'carousel-control', 'sharonchin' ); ?></a>
						<span> ( <span id="slide-counter">1</span> of <?php echo number_format_i18n( $sharonchin_total_images ); ?> )</span>
					</div>
					<div id="gallery-slider" class="carousel slide" data-interval="false">
						<!-- Carousel items -->
						<div class="carousel-inner">
							<?php $i = 0; foreach ( $sharonchin_images as $sharonchin_image ) : ?>
							<figure class="item">
								<?php 
								echo wp_get_attachment_image( $sharonchin_image->ID, 'full' );  
								if ( has_excerpt( $sharonchin_image->ID ) ) :?>
								<figcaption class="carousel-caption">
									<h4><?php echo get_the_title( $sharonchin_image->ID ); ?></h4>
									<p><?php echo apply_filters( 'get_the_excerpt', $sharonchin_image->post_excerpt ); ?></p>
								</figcaption>
								<?php endif; ?>
							</figure>
							<?php endforeach; ?>
						</div>
					</div><!-- #gallery-slider -->
				</div> <!-- gallery-container -->
			<?php endif; /* if images */ ?>
		</div> <!-- gallery-span -->
	</div>

	<div class="entry-content clearfix">
		<div class="row <?php echo basename(get_permalink()); ?>">
			<?php
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sharonchin' ) );
			sharonchin_link_pages(); ?>
		</div>
	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', 'sharonchin' ), '<footer class="entry-meta"><span class="edit-link label">', '</span></footer>' );
	
	tha_entry_bottom(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php tha_entry_after();


/* End of file content-page.php */
/* Location: ./wp-content/themes/sharonchin/partials/content-event.php */
