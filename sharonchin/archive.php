<?php
/** archive.php
 *
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @author		Roberto Ulloa
 * @package		Sharon Chin Theme
 * @since		3.0.0 - 07.08.2013
 */

get_header(); ?>
<div id="primary" class="span8 blog">
	<?php tha_content_before(); ?>
		<?php tha_content_top();
		if ( have_posts() ) {?>
		<div class="content archive nomargin archive-blog">
			<div class="row">
				<div id="masonry" class="js-masonry">
					<?php while ( have_posts() ) {
						the_post();
						get_template_part( '/partials/content', 'lilypad' );
					}?>
				</div>
			</div> <!-- #row -->
		</div> <!-- .content -->
		<?php sharonchin_content_nav( 'nav-below' );
		}
		else {
			get_template_part( '/partials/content', 'not-found' );
		}
		tha_content_bottom(); ?>
	<?php tha_content_after(); ?>
</div><!-- #primary -->

<?php
get_sidebar('blog');
get_footer();


/* End of file archive.php */
/* Location: ./wp-content/themes/sharonchin/archive.php */
