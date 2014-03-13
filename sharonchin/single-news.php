<?php
/** single-news.php
 *
 * The Template for displaying all single posts.
 *
 * @author		Roberto Ulloa
 * @package		Sharon Chin Theme
 * @since		3.0.0 - 13.03.2014
 */

get_header(); ?>

<section id="primary" class="span8">
	
	<?php tha_content_before(); ?>
	<div id="content" class="content single single-news" role="main">
		<?php tha_content_top();

		while ( have_posts() ) {
			the_post();
			get_template_part( '/partials/content', 'standard' );
			//comments_template();
		} ?>
		<?php tha_content_bottom(); ?>
	</div><!-- #content -->
	<nav id="nav-single" class="pager">
		<h3 class="assistive-text"><?php _e( 'Post navigation', 'sharonchin' ); ?></h3>
		<?php previous_post_link( '<span class="previous">%link </span>', sprintf( '%1$s', __( '< PREVIOUS NEWS', 'sharonchin' ) ) ); ?>
		<span class="home"><a href="<?php echo home_url() . '/news/'; ?>">BACK TO NEWS</a></span>
		<span class="top"><a href="#">BACK TO TOP</a></span>
		<?php next_post_link( '<span class="next">%link</span>', sprintf( '%1$s', __( 'NEXT NEWS >', 'sharonchin' ) ) ); ?>
	</nav><!-- #nav-single -->
	<?php tha_content_after(); ?>
</section><!-- #primary -->

<?php
get_sidebar('news');
get_footer();


/* End of file single-news.php */
/* Location: ./wp-content/themes/sharonchin/single-news.php */
