<?php
/** content-list-item.php
 *
 * A template for displaying the title and excerpt of the document.
 *
 * @author		Roberto Ulloa
 * @package		Sharon Chin Theme
 * @since		3.0.0 - 05.03.2013
 * @updated		3.1.3 - 19.07.2014
 */


tha_entry_before(); ?> 

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="archive-thumbnail">
			<?php tha_entry_top(); 
			$has_image = ''; ?>
			<div class="media">
				<?php if ( has_post_thumbnail() ) { ?>
				<a class="thumbnail pull-left" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<div class="crop">
						<?php
							the_post_thumbnail( 'archive-item' );
							$has_image = 'has_image'; 
						?>
					</div>
				</a>
				<?php } ?>
				<div class="media-body <?php echo $has_image; ?>">
					<?php $art_type = sharonchin_get_art_type(get_the_ID()); ?>
					<div class="media-crumbs">
						<?php echo $art_type . ' &gt; ' . strval(get_the_date( 'Y' ));?>
					</div>
					<div class="media-header">
						<?php the_title( '<h4 class="media-heading entry-title"><a href="' . get_permalink() .'" title="' . sprintf( esc_attr__( 'Permalink to %s', 'sharonchin' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h3>' );?>

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
					</div>
					
					<div class="media-content <?php echo $has_image; ?>">
						<div class="media-bottom">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</div>
			</div>
			<?php tha_entry_bottom(); ?>
		</div> <!-- .thumbnail -->
	</article><!-- #post-<?php the_ID(); ?> -->


<?php tha_entry_after();


/* End of file content-list-item.php */
/* Location: ./wp-content/themes/sharonchin/partials/content-list-item.php */
