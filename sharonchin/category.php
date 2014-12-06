<?php
/** category.php
 *
 * The template for displaying Category Archive pages.
 *
 * @author		Roberto Ulloa
 * @package		Sharon Chin Theme
 * @since		3.0.0 - 01.10.2013
 */

get_header(); ?>

<section id="primary" class="span8 category">
	<?php tha_content_before(); ?>
		<?php tha_content_top();
		if ( have_posts() ) : ?>
			<div class="content archive nomargin category">
				<header class="page-header">
					<h3 class="page-title"><?php
						printf( __( 'Category Archives: %s', 'sharonchin' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?></h3>
	
					<?php if ( $category_description = category_description() ) {
						echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
					} ?>
				</header><!-- .page-header -->
				<div class="row">
					<div id="masonry" class="js-masonry">
						<?php 

						$args=array(
							'post_type' => array('post','news','archive'),
							'orderby' => 'date',
							'order' => 'DESC',
							'cat' => get_query_var('cat'),
							'posts_per_page' => 5,
							'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1
						);
						$wp_query = new WP_query( $args );
						while ( have_posts() ) {
							the_post();
							get_template_part( '/partials/content', 'lilypad' );
						}?>
					</div>
				</div> <!-- #row -->
			</div> <!-- .content -->
			<?php
			sharonchin_content_nav( 'nav-below' );
		else :
			get_template_part( '/partials/content', 'not-found' );
		endif;
		tha_content_bottom(); ?>
	<?php tha_content_after(); ?>
</section><!-- #primary -->

<?php
get_sidebar();
wp_reset_query();
get_footer();


/* End of file index.php */
/* Location: ./wp-content/themes/sharonchin/category.php */
