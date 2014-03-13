<?php
/** content-archive.php
 *
 * The template for displaying posts in the Archive Post Category 
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @author		Konstantin Obenland
 * @package		Sharon Chin Theme
 * @since		1.0.0 - 07.02.2012
 */

tha_entry_before(); ?>
<article id="archive-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php tha_entry_top(); ?>
	<div class="row">
		<div class="span7 pull-right gallery-span">
			<?php
			if ( $sharonchin_images ) :
				$sharonchin_total_images	=	count( $sharonchin_images );
				//$sharonchin_images		=	array_slice( $sharonchin_images, 0, 10 );
				$the_mini_thumnails		="";
			?>
				<div id="archive-gallery" class="gallery-container">
					<div class="nav-carousel-control">
						<!-- Carousel nav -->
						<a class="carousel-control" href="#gallery-slider" data-slide="prev"><?php _ex( '&lt; Previous', 'carousel-control', 'sharonchin' ); ?></a> |
						<a class="carousel-control" href="#gallery-slider" data-slide="next"><?php _ex( 'Next Image &gt;', 'carousel-control', 'sharonchin' ); ?></a>
						<span class="nav-carousel-counter"> ( <span id="slide-counter">1</span> of <?php echo number_format_i18n( $sharonchin_total_images ); ?> )</span>
					</div>
					<div id="gallery-slider" class="carousel slide" data-interval="false">

						<!-- Carousel items -->
						<div class="carousel-inner">
							<?php $i = 0; foreach ( $sharonchin_images as $sharonchin_image ) : ?>
							<figure class="item">
								<?php 
								//echo wp_get_attachment_image( $sharonchin_image->ID, array( 1000, 800 ) );
								// 
								$the_mini_thumbnails .= '<li><a data-id="'.$i++.'" href="#archive-gallery" >'.wp_get_attachment_image( $sharonchin_image->ID, 'mini-thumbnail' ).'</a></li>';
								echo wp_get_attachment_image( $sharonchin_image->ID, 'slider' );  
								if ( has_excerpt( $sharonchin_image->ID ) ) :?>
								<figcaption class="carousel-caption">
									<!--<h4><?php echo get_the_title( $sharonchin_image->ID ); ?></h4>-->
									<p><?php echo apply_filters( 'get_the_excerpt', $sharonchin_image->post_excerpt ); ?></p>
								</figcaption>
								<?php endif; ?>
							</figure>
							<?php endforeach; ?>
						</div>
					</div><!-- #gallery-slider -->
				</div><!-- #gallery-container -->
				<div class="gallery-thumbnails"><ul><?php echo $the_mini_thumbnails ?></ul></div>


			<?php endif; /* if images */ ?>

		</div> <!-- gallery-span -->

		<div class="span5">
			<div class="archive-container">
				<header class="page-header ">
					<div class="media-crumbs">
						<?php echo $art_type . ' &gt; ' . strval(get_the_date( 'Y' ));?>
					</div>
					<hgroup>
						<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() .'" title="' . sprintf( esc_attr__( 'Permalink to %s', 'sharonchin' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h2>' ); ?>
					</hgroup>
					<?php if ($art_type === 'Writing') { 
						$the_author = get_post_meta($post->ID, 'author', TRUE);
						if($the_author === '') { ?>
							<div class="media-author">
								by <?php the_author(); ?>
							</div>
					<?php } else { ?> 
							<div class="media-author">
								by <?php echo $the_author; ?>
							</div>
					<?php } } ?>
				</header><!-- .entry-header -->
				<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sharonchin' ) );
				//comments_template();
				?>
				</div>

				<div class="share top-splitter">
					<?php dynamic_sidebar( 'social-share-bar' ); ?>
				</div>

				<?php
				$related_art = get_related_art($post);
				$related_posts = get_related($post, array('post', 'news'));
				if ($related_art or $related_posts) {
				?>
					<div class="related top-splitter">
						<?php if ($related_art) { ?>
							<ul class="nav nav-pills nav-stacked related-art">
								<li class="nav-header"> Related Work ></li>
								<?php echo $related_art; ?>
							</ul>
						<?php } 
						if ($related_posts) { ?>
							<ul class="nav nav-pills nav-stacked related-posts top-spacer">
								<li class="nav-header"> Related Posts ></li>
								<?php echo $related_posts; ?>
							</ul>
						<?php } ?>
					</div>
				<?php }?>
			</div> <!-- archive-container -->
		</div> <!-- .span5 -->

	</div><!-- .entry-content -->


	<?php tha_entry_bottom(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php tha_entry_after();
/* End of file content-gallery.php */
/* Location: ./wp-content/themes/sharonchin/partials/content-gallery.php */
