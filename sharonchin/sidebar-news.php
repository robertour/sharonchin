<?php
/** sidebar-news.php
 *
 * @author		Roberto Ulloa
 * @package		Sharon Chin Theme
 * @since		3.0.0 - 13.03.2014
 */

tha_sidebars_before(); ?>
<section id="secondary" class="widget-area span4" role="complementary">
	<?php tha_sidebar_top(); 
		if ( ! dynamic_sidebar( 'announcement' )
			&& !dynamic_sidebar( 'personal-statement' )
			&& !dynamic_sidebar( 'mailchimp' )
			&& !dynamic_sidebar( 'social-bar' ) ) {
		the_widget( 'WP_Widget_Meta', array(), array(
			'before_widget'	=>	'<aside id="meta" class="widget well widget_meta">',
			'after_widget'	=>	'</aside>',
			'before_title'	=>	'<h3 class="widget-title">',
			'after_title'	=>	'</h3>',
		) );
		}
	?>

	<!--
	<div class="sidebar-block">
		<aside id="feature-announcement" class="widget well widget_featured">
			<?php
			#get_last_post_of_tag( 'news' ,'featured')
			?>
		</aside>
	</div> <!-- .sidebar-block -->
	

	<?php dynamic_sidebar( 'announcement' ); ?>



	<div class="sidebar-block">
		<aside id="archive-news" class="widget well widget_archives main-well">
			<ul class="nav nav-pills nav-stacked">
			<li class="nav-header ">News Archive</li>
			<?php get_cpt_archives( 'news', true ); ?>
			</ul>
		</aside>
	</div> <!-- .sidebar-block -->

	<div class="sidebar-block">
		<?php
		dynamic_sidebar( 'mailchimp' );
		dynamic_sidebar( 'social-bar' ); 
		?>
	</div><!-- .sidebar-block -->

	<?php 
	dynamic_sidebar( 'news' ); 
	tha_sidebar_bottom(); 
	?>
</section><!-- #secondary .widget-area -->
<?php tha_sidebars_after();


/* End of file sidebar-news.php */
/* Location: ./wp-content/themes/sharonchin/sidebar-news.php */
