<?php
/** sidebar-blog.php
 *
 * @author		Roberto Ulloa
 * @package		sharonchin
 * @since		1.0.0	- 05.02.2013
 */

tha_sidebars_before(); ?>
<section id="secondary" class="widget-area span4" role="complementary">
	<?php 
	tha_sidebar_top(); 
	if ( ! dynamic_sidebar( 'announcement' ) ) {
		the_widget( 'WP_Widget_Meta', array(), array(
			'before_widget'	=>	'<aside id="meta" class="widget well widget_meta">',
			'after_widget'	=>	'</aside>',
			'before_title'	=>	'<h3 class="widget-title">',
			'after_title'	=>	'</h3>',
		) );
	}
	?> 
	<?php tha_sidebar_bottom(); ?>
</section><!-- #secondary .widget-area -->
<?php tha_sidebars_after();


/* End of file sidebar.php */
/* Location: ./wp-content/themes/sharonchin/sidebar.php */
