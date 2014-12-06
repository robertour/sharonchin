<?php 
 /** index.php
 *
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @author		Roberto Ulloa
 * @package		sharonchin
 * @since		3.0.0 - 26.06.2013
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


/* End of file page.php */
/* Location: ./wp-content/themes/sharonchin/page.php */
