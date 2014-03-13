<?php
/** single.php
 *
 * The Template for displaying all single posts.
 *
 * @author		Konstantin Obenland
 * @package		sharonchin
 * @since		1.0.0 - 05.02.2012
 */

get_header(); ?>

<section id="primary" class="span8">
	
	<?php tha_content_before(); ?>
	<div id="content" class="content single single-blog" role="main">
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
		<?php previous_post_link( '<span class="previous">%link</span>', sprintf( '%1$s', __( '< PREVIOUS POST', 'sharonchin' ) ) ); ?>
		<span class="home"><a href="<?php echo home_url(); ?>">BACK TO BLOG</a></span>
		<span class="top"><a href="#">BACK TO TOP</a></span>
		<?php next_post_link( '<span class="next">%link</span>', sprintf( '%1$s', __( 'NEXT POST >', 'sharonchin' ) ) ); ?>
	</nav><!-- #nav-single -->
	<?php tha_content_after(); ?>
</section><!-- #primary -->

<?php
get_sidebar('blog');
get_footer();


/* End of file index.php */
/* Location: ./wp-content/themes/sharonchin/single.php */
