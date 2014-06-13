<?php
/** header.php
 *
 * Displays all of the <head> section and everything up till </header>
 *
 * @author		Roberto Ulloa
 * @package		Sharon Chin Theme
 * @since		3.0.1 - 13-05-2014
 */

?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<title><?php wp_title( '&laquo;', true, 'right' ); ?></title>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
		<?php tha_head_top(); ?>
		<?php tha_head_bottom(); ?>
		<?php wp_head(); ?>
	</head>
	
	<body <?php body_class(); ?>>
		<div class="container" >
			<div id="page" class="hfeed row">
				<?php tha_header_before(); ?>
				<header id="branding" role="banner">
					<?php if ( has_nav_menu( 'header-menu' ) ) : ?>
					<div class="navbar">
						<div class="navbar-inner top">
							<?php tha_header_top();?>
							<a class="btn btn-navbar" data-toggle="collapse" data-target="#first">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</a>
							<div id="first" class="nav-collapse">
							<?php
								wp_nav_menu( array(
									'container'			=>	'nav',
									'container_class'	=>	'subnav clearfix',
									'theme_location'	=>	'header-menu',
									'menu_class'		=>	'nav nav-pills pull-right',
									'depth'				=>	3,
									'fallback_cb'		=>	false,
									'walker'			=>	new SharonChin_Nav_Walker,
								) ); ?>
							</div>
						</div>
					</div>
					<?php endif; ?>

					<nav id="access" class="main-nav" role="navigation">
						<h3 class="assistive-text"><?php _e( 'Main menu', 'sharonchin' ); ?></h3>
						<div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'sharonchin' ); ?>"><?php _e( 'Skip to primary content', 'sharonchin' ); ?></a></div>
						<div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to secondary content', 'sharonchin' ); ?>"><?php _e( 'Skip to secondary content', 'sharonchin' ); ?></a></div>
						<?php if ( has_nav_menu( 'primary' ) OR sharonchin_options()->navbar_site_name OR sharonchin_options()->navbar_searchform ) : ?>
						<div <?php sharonchin_navbar_class(); ?>>
							<div class="navbar-inner header">
								<div class="container">


									<span class="brand"><?php //echo get_bloginfo( 'name' ); ?>
									<?php if ( get_header_image() ) : ?>
										<a id="header-image" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
											<img src="<?php header_image(); ?>" alt="" />
										</a>
									<?php endif; // if ( get_header_image() ) ?>
										<hgroup>
										<h1 id="site-title">
											<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
												<span><?php bloginfo( 'name' ); ?></span>
											</a>
										</h1>
										<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
										</hgroup>
									</span>
									<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
									<a class="btn btn-navbar" data-toggle="collapse" data-target="#second">
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</a>
									<div id="second"class="nav-collapse">
										<?php wp_nav_menu( array(
											'theme_location'	=>	'primary',
											'menu_class'		=>	'nav pull-right',
											'depth'				=>	3,
											'fallback_cb'		=>	false,
											'walker'			=>	new SharonChin_Nav_Walker,
										) ); 
										if ( sharonchin_options()->navbar_site_name ) : ?>
											<span><?php bloginfo( 'name' ); ?></span>
										<?php endif;
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
