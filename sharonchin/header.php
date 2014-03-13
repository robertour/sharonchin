<?php
/** header.php
 *
 * Displays all of the <head> section and everything up till </header>
 *
 * @author		Konstantin Obenland
 * @package		Sharon Chin Theme
 * @since		1.0 - 05.02.2012
 */

?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<?php tha_head_top(); ?>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		
		<title><?php wp_title( '&laquo;', true, 'right' ); ?></title>
		
		<?php tha_head_bottom(); ?>
		<?php wp_head(); ?>
	</head>
	
	<body <?php body_class(); ?>>
		<div class="container" >
			<div id="page" class="hfeed row">
				<?php tha_header_before(); ?>
				<header id="branding" role="banner">
					<?php tha_header_top();
					wp_nav_menu( array(
						'container'			=>	'nav',
						'container_class'	=>	'subnav clearfix',
						'theme_location'	=>	'header-menu',
						'menu_class'		=>	'nav nav-pills pull-right',
						'depth'				=>	3,
						'fallback_cb'		=>	false,
						'walker'			=>	new SharonChin_Nav_Walker,
					) ); ?>
					<nav id="access" role="navigation">
						<h3 class="assistive-text"><?php _e( 'Main menu', 'sharonchin' ); ?></h3>
						<div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'sharonchin' ); ?>"><?php _e( 'Skip to primary content', 'sharonchin' ); ?></a></div>
						<div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to secondary content', 'sharonchin' ); ?>"><?php _e( 'Skip to secondary content', 'sharonchin' ); ?></a></div>
						<?php if ( has_nav_menu( 'primary' ) OR sharonchin_options()->navbar_site_name OR sharonchin_options()->navbar_searchform ) : ?>
						<div <?php sharonchin_navbar_class(); ?>>
							<div class="navbar-inner">
								<div class="container">
									<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
									<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</a>



									<span class="brand"><?php //echo get_bloginfo( 'name' ); ?>
									<?php if ( sharonchin_options()->navbar_site_name ) : ?>
									<hgroup>
										<h1 id="site-title">
											<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
												<span><?php bloginfo( 'name' ); ?></span>
											</a>
										</h1>
										<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
									</hgroup>
									<?php endif;?>
									<?php if ( get_header_image() ) : ?>
										<a id="header-image" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
											<img src="<?php header_image(); ?>" alt="" />
										</a>
									<?php endif; // if ( get_header_image() ) ?>
									</span>

									<div class="nav-collapse">
										<?php wp_nav_menu( array(
											'theme_location'	=>	'primary',
											'menu_class'		=>	'nav pull-right',
											'depth'				=>	3,
											'fallback_cb'		=>	false,
											'walker'			=>	new SharonChin_Nav_Walker,
										) ); 
										if ( sharonchin_options()->navbar_searchform ) {
											sharonchin_navbar_searchform();
										} ?>
								    </div>
								</div>
							</div>
						</div>
						<?php endif; ?>
					</nav><!-- #access -->
					<?php if ( function_exists( 'yoast_breadcrumb' ) ) {
						yoast_breadcrumb( '<nav id="breadcrumb" class="breadcrumb">', '</nav>' );
					}
					tha_header_bottom(); ?>
				</header><!-- #branding -->
				<?php tha_header_after();?>


				<?php


/* End of file header.php */
/* Location: ./wp-content/themes/sharonchin/header.php */
