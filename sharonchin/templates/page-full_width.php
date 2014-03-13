<?php
/** page-full_width.php
 *
 * Template Name: Full Width
 *
 * This template has no sidebar.
 *
 * @author		Roberto Ulloa
 * @package		sharonchin
 * @since		1.0.0 - 14.06.2013
 */

get_header(); ?>

<section id="primary" class="span12 full">
	<?php tha_content_before(); ?>
	<div id="content" role="main">
		<?php tha_content_top();
		
		the_post();
		get_template_part( '/partials/content', 'page' );
		comments_template( '', true );
		
		tha_content_bottom(); ?>
	</div><!-- #content -->
	<?php tha_content_after(); ?>
</section><!-- #primary -->

<?php
get_footer();


/* End of file _full_width.php */
/* Location: ./wp-content/themes/sharonchin/_full_width.php */
