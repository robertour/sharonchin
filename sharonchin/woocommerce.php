<?php
/** woocommerce.php
 *
 * Woocommerce base.
 *
 * @author		Roberto Ulloa
 * @package		Sharon Chin Theme
 * @since		3.0.0 - 13-03-2014
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

/* End of file woocommerce.php */
/* Location: ./wp-content/themes/sharonchin/woocommerce.php */
