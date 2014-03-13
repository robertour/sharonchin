<?php
/** sidebar.php
 *
 * @author		Konstantin Obenland
 * @package		Sharon Chin Theme
 * @since		1.0.0	- 05.02.2012
 */

tha_sidebars_before(); ?>
<section id="secondary" class="widget-area span4" role="complementary">
	<?php tha_sidebar_top(); ?>
	<?php dynamic_sidebar( 'announcement' );?>
	<?php dynamic_sidebar( 'archive' ); ?>

	<aside id="archive-category" class="widget well widget_archives">
		<div class="nav-header">
			<a class="thick-hover" href="<?php echo get_site_url() . '/archive/'; ?>" ><span style="text-transform: none">View All Works</a>
		</div>
	</aside>

	<div class="sidebar-block">
		<aside id="archive-category" class="widget well widget_archives main-well">
			<ul class="nav nav-pills nav-stacked">
			<li class="nav-header">Browse by Category</li>
			<?php get_cpt_taxonomy_archives( 'archive', 'archive', true ) ?>
			</ul>
		</aside>
	</div>

	<div class="sidebar-block">
		<aside id="archive-date" class="widget well widget_archives">
			<ul class="nav nav-pills nav-stacked">
			<li class="nav-header">Browse by Year</li>
				<?php get_cpt_year_archives( 'archive', true ); ?>
			</ul>
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
