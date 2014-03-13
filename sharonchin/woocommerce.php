<?php
/** page.php
 *
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @author		Konstantin Obenland
 * @package		Sharon Chin Theme
 * @since		1.0.0 - 07.02.2012
 */

get_header(); ?>

<section id="primary" class="span12 shop">
	<?php tha_content_before(); ?>
	<div id="content" class="content nomargin" role="main">
		<?php tha_content_top();

		//the_post();
		//get_template_part( '/partials/content', 'page' );
		woocommerce_content();
		//comments_template();

		tha_content_bottom(); ?>
	</div><!-- #content -->
	<?php tha_content_after(); ?>
</section><!-- #primary -->

<?php
get_sidebar('shop');
get_footer();

/* End of file page.php */
/* Location: ./wp-content/themes/sharonchin/page.php */
