<?php
/** page-standard.php
 *
 * Template Name: Standard
 *
 * This is just a copy of the default. It has the sidebar and the content.
 *
 * @author		Roberto Ulloa
 * @package		sharonchin
 * @since		3.0.0 - 14.06.2013
 */

get_header(); ?>

<div id="primary" class="span8 standard">
	<?php tha_content_before(); ?>
	<div id="content" role="main">
		<?php tha_content_top();
		
		the_post();
		get_template_part( '/partials/content', 'page' );
		comments_template();

		tha_content_bottom(); ?>
	</div><!-- #content -->
	<?php tha_content_after(); ?>
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();


/* End of file page-standard.php */
/* Location: ./wp-content/themes/sharonchin/page-standard.php */
