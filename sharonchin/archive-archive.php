<?php
/** archive-blog.php
 *
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @author		Konstantin Obenland
 * @package		Sharon Chin Theme
 * @since		1.0.0 - 07.02.2012
 */

get_header(); ?>

<div id="primary" class="span8 archive">
	<?php tha_content_before(); ?>
	<div class="content archive nomargin archive-archive">
		<div id="content" role="main" >
			<?php tha_content_top();
			if ( have_posts() ) : ?>
				<!--<h6 class="page-title">
					<?php
					if ( is_day() ) :
						printf( __( 'Daily Archive: %s', 'sharonchin' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archive: %s', 'sharonchin' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archive: %s', 'sharonchin' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
					else :
						_e( 'Archive', 'sharonchin' );
					endif; ?>
				</h6>-->
				<div class="clearfix"></div>
				<?php
				while ( have_posts() ) { 
					the_post();
					get_template_part( '/partials/content', 'list-item' );
				}?>
			<?php else :
				get_template_part( '/partials/content', 'not-found' );
			endif;
			tha_content_bottom(); ?>
		</div><!-- #content -->
		<?php tha_content_after(); ?>
	</div><!-- .content -->
	<?php sharonchin_content_nav( 'nav-below' ); ?>
</div><!-- #primary -->

<?php
get_sidebar('archive');
get_footer();


/* End of file archive.php */
/* Location: ./wp-content/themes/sharonchin/archive.php */
