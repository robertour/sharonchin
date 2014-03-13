<?php
/** content-lilypad.php
 *
 * A template for displaying the title and excerpt of the document.
 *
 * @author		Konstantin Obenland
 * @package		Sharon Chin Theme
 * @since		1.0.0 - 05.02.2012
 */


tha_entry_before(); ?> 
<div class="lilypad" >
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php 
		$lilyright = '';
		tha_entry_top(); ?>

		<?php if ( has_post_thumbnail() ) : 
			$lilyright = 'lilyright';?>
			<div class="lilyimage">
				<a style="margin-left: 0" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail( 'lilypad' ); ?>
				</a>
			</div><!-- .lily-image -->
		<?php endif;?>


		<div class="caption lilytext <?php print $lilyright;?> ">
			<header class="page-header">
			<div class="label label-inverse pull-left">Featured</div>
			<?php the_title( '<h5 class="entry-title"><a href="' . get_permalink() .'" title="' . sprintf( esc_attr__( 'Permalink to %s', 'sharonchin' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h5>' );?>
			</header><!-- .entry-header -->


		</div><!-- .caption lilytext-->
		<div class="clearfix"></div>
		<?php tha_entry_bottom(); ?>
	</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- .mini-lilypad -->
<?php tha_entry_after();


/* End of file content.php */
/* Location: ./wp-content/themes/sharonchin/partials/content.php */
