<?php
/** content-gallery.php
 *
 * The template for displaying posts in the Gallery Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @author		Konstantin Obenland
 * @package		Sharon Chin Theme
 * @since		1.0.0 - 07.02.2012
 */


tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php tha_entry_top(); ?>
	
	<header class="page-header">
		<hgroup>
			<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() .'" title="' . sprintf( esc_attr__( 'Permalink to %s', 'sharonchin' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<h3 class="entry-format"><?php echo get_post_format_string(get_post_format()); ?></h3>
		</hgroup>

		<div class="entry-meta">
			<?php sharonchin_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	
	<div class="entry-content row">
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
			$sharonchin_images		=	array_slice( $sharonchin_images, 0, 10 );
		?>
		
		<div class="span3">
			<?php the_excerpt(); ?>
	
			<p class="gallery-meta">
				<em>
				<?php
				printf(
					_n( 'This gallery contains <strong>%1$s photo</strong>.', 'This gallery contains <strong>%1$s photos</strong>.', $sharonchin_total_images, 'sharonchin' ),
					number_format_i18n( $sharonchin_total_images )
				); ?>
				</em>
			</p>
		</div>
		<div id="gallery-slider" class="carousel slide span5">

			<!-- Carousel items -->
			<div class="carousel-inner">
				<?php foreach ( $sharonchin_images as $sharonchin_image ) : ?>
				<figure class="item">
					<?php echo wp_get_attachment_image( $sharonchin_image->ID, array( 470, 353 ) ); 
					if ( has_excerpt( $sharonchin_image->ID ) ) :?>
					<figcaption class="carousel-caption">
						<h4><?php echo get_the_title( $sharonchin_image->ID ); ?></h4>
						<p><?php echo apply_filters( 'get_the_excerpt', $sharonchin_image->post_excerpt ); ?></p>
					</figcaption>
					<?php endif; ?>
				</figure>
				<?php endforeach; ?>
			</div>
		
			<!-- Carousel nav -->
			<a class="carousel-control left" href="#gallery-slider" data-slide="prev"><?php _ex( '&lsaquo;', 'carousel-control', 'sharonchin' ); ?></a>
			<a class="carousel-control right" href="#gallery-slider" data-slide="next"><?php _ex( '&rsaquo;', 'carousel-control', 'sharonchin' ); ?></a>
		</div><!-- #gallery-slider -->
				
		<?php endif; /* if images */ ?>
	</div><!-- .entry-content -->
	
	<?php tha_entry_bottom(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php tha_entry_after();


/* End of file content-gallery.php */
/* Location: ./wp-content/themes/sharonchin/partials/content-gallery.php */