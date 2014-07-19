<?php
/** search.php
 *
 * The template for displaying Search Results pages.
 *
 * @author		Konstantin Obenland
 * @package		Sharon Chin Theme
 * @since		1.0.0 - 07.02.2012
 */

get_header(); ?>

<section id="primary" class="span8 search">
	<?php tha_content_before(); ?>
		<?php tha_content_top();
		if ( have_posts() ) : ?>
			<div class="content archive nomargin search">
				<header class="page-header">
					<h3 class="page-title">
						<?php printf( __( 'Search Results for: %s', 'sharonchin' ), '<span>' . get_search_query() . '</span>' ); ?>
					</h3>
				</header>
				<div class="row">
					<div id="masonry" class="js-masonry">
						<?php
						while ( have_posts() ) {
							the_post();
							get_template_part( '/partials/content', 'lilypad' );
						} ?>
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
get_footer();


/* End of file search.php */
/* Location: ./wp-content/themes/sharonchin/search.php */
