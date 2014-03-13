<?php
/** sidebar-shop.php
 *
 * @author		Roberto Ulloa
 * @package		Sharon Chin Theme
 * @since		3.0.0 - 13.03.2014
 */

tha_sidebars_before(); ?>
<section id="secondary" class="widget-area span4" role="complementary">
	<?php 
	tha_sidebar_top();
	dynamic_sidebar( 'announcement' );
	?>
	<div class="sidebar-block">
	<?php dynamic_sidebar( 'shop-tools' ); ?>
	</div>
	<?php 

	$defaults = array(
		'theme_location'  => '',
		'menu'            => 'shop_side_menu',
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
		'items_wrap'      => '<ul id="%1$s" class="%2$s"><li class="nav-header">Shop</li>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
	);
	?>

	<div class="sidebar-block">
		<aside id="about-submenu" class="widget well widget_sidemenu main-well">
		<?php wp_nav_menu( $defaults );	?>
		</aside>
	</div>
	<div class="sidebar-block">
		<aside id="shop-categories" class="widget well widget_sidemenu main-well">
			<ul class="nav nav-pills nav-stacked">
				<li class="nav-header">Sort Items By</li>
				<li><a href="./">Default sorting</a></li>
				<li><a href="./?orderby=date">Newest first</a></li>
				<li><a href=".?orderby=price">Price: Low to High</a></li>
				<li><a href=".?orderby=price-desc">Price: High to Low</a></li>
			</ul>
		</aside>
	</div>
	<div class="sidebar-block">
		<aside id="shop-categories" class="widget well widget_sidemenu main-well">
			<ul class="nav nav-pills nav-stacked">
				<li class="nav-header">Categories</li>
				<?php 
				$current_cat = $wp_query->queried_object;
				$cat_args = array( 'show_count' => true, 'hierarchical' => false, 'taxonomy' => 'product_cat' );
				$cat_args['show_option_none'] 	= __('No product categories exist.', 'woocommerce' );
				$cat_args['current_category']	= ( $current_cat ) ? $current_cat->term_id : '';
				$li_html = "";
				$categories = get_categories( apply_filters( 'woocommerce_product_categories_widget_args', $cat_args ) );  
				foreach( $categories as $cat )
				{
					if ($cat_args['current_category'] === $cat->term_id){
						$li_html .= '<li class="active"><a href="' . get_term_link( (int) $cat->term_id, 'product_cat' ) . '">' . $cat->name . ' (' . $cat->count . ')</a></li> ';
					} else {
						$li_html .= '<li><a href="' . get_term_link( (int) $cat->term_id, 'product_cat' ) . '">' . $cat->name . ' (' . $cat->count . ')</a></li> ';
					}
					$total_count += $cat->count;
				}

				if ($current_cat){
					echo '<li><a href="' . get_site_url() . '/shop/' . '">All (' . $total_count  . ')</a></li> ' . $li_html;
				} else {
					echo '<li class="active"><a href="' . get_site_url() . '/shop/' . '">All (' . $total_count  . ')</a ></li>' . $li_html;
				}

				?>
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


/* End of file sidebar-shop.php */
/* Location: ./wp-content/themes/sharonchin/sidebar-shop.php */
