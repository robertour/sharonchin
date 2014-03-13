<?php
/** content-lilypad.php
 *
 * A template for displaying the title and excerpt of the document.
 *
 * @author		Roberto Ulloa
 * @package		Sharon Chin Theme
 * @since		3.0.0 - 05.03.2013
 */


tha_entry_before(); ?> 
<div class="span4 lilypad" >
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
			<?php
				the_title( '<h3 class="entry-title"><a href="' . get_permalink() .'" title="' . sprintf( esc_attr__( 'Permalink to %s', 'sharonchin' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h3>' );?>
				<div class="entry-meta">
					<?php sharonchin_posted_on(); ?>
				</div><!-- .entry-meta -->
			</header><!-- .entry-header -->


			<div class="entry-summary ">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->


			<!--<footer class="entry-meta">
				<?php
				//$categories_list = get_the_category_list( _x( ', ', 'used between list items, there is a space after the comma', 'sharonchin' ) );

				//if ( 'post' == get_post_type() AND $categories_list ) // Hide category text for pages on Search
				//	printf( '<span class="cat-links block">' . __( 'Posted in %1$s.', 'sharonchin' ) . '</span>', $categories_list );
				?>
			</footer> #entry-meta -->

		</div><!-- .caption lilytext-->
		<div class="clearfix"></div>
		<?php tha_entry_bottom(); ?>
	</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- .lilypad -->
<?php tha_entry_after();


/* End of file content-lilypad.php */
/* Location: ./wp-content/themes/sharonchin/partials/content-lilypad.php */
