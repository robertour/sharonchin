<?php
/** sidebar.php
 *
 * @author		Konstantin Obenland
 * @package		Sharon Chin Theme
 * @since		1.0.0	- 05.02.2012
 */

tha_sidebars_before(); ?>
<section id="secondary" class="widget-area span4" role="complementary">
	<?php tha_sidebar_top(); 


	$defaults = array(
		'theme_location'  => '',
		'menu'            => 'about_side_menu',
		'container'       => '',
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => 'nav nav-pills nav-stacked',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul id="%1$s" class="%2$s"><li class="nav-header">About</li>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
	);
	?>
	
	<?php dynamic_sidebar( 'announcement' ); ?>	
	<div class="sidebar-block">
		<aside id="about-submenu" class="widget well widget_sidemenu main-well">
		<?php wp_nav_menu( $defaults );	?>
		</aside>
	</div>
	
	<div class="sidebar-block">
		<?php
		dynamic_sidebar( 'mailchimp' );
		dynamic_sidebar( 'social-bar' ); 
		?>
	</div><!-- .sidebar-block -->
	<?php tha_sidebar_bottom(); ?>
</section><!-- #secondary .widget-area -->
<?php tha_sidebars_after();


/* End of file sidebar.php */
/* Location: ./wp-content/themes/sharonchin/sidebar.php */
