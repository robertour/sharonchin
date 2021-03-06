<?php
/** page-about.php
 *
 * Template Name: About
 *
 * @author		Roberto Ulloa
 * @package		Sharon Chin Theme
 * @since		3.0.0 - 14.06.2013
 */

get_header(); ?>

<section id="primary" class="span12 about">
	<?php tha_content_before(); ?>
	<div id="content" class="content" role="main">
		<?php tha_content_top();
		
		the_post();
		get_template_part( '/partials/content', 'page' );
		comments_template( '', true );
		
		tha_content_bottom(); ?>
	</div><!-- #content -->
	<?php tha_content_after(); ?>
</section><!-- #primary -->

<?php
get_sidebar('about');
get_footer();


/* End of file page-about.php */
/* Location: ./wp-content/themes/sharonchin/page-about.php */
