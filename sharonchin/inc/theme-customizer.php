<?php
/** theme-customizer.php
 * 
 * Implementation of the Theme Customizer for Themes
 * @link		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
 * 
 * @author		Konstantin Obenland
 * @package		Sharon Chin Theme
 * @since		1.4.0 - 05.05.2012
 */


/**
 * Registers the theme setting controls with the Theme Customizer
 * 
 * @author	Konstantin Obenland
 * @since	1.4.0 - 05.05.2012
 * 
 * @param	WP_Customize	$wp_customize
 * 
 * @return	void
 */
function sharonchin_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport	= 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	
	$wp_customize->add_section( 'sharonchin_theme_layout', array(
		'title'		=>	__( 'Layout', 'sharonchin' ),
		'priority'	=>	99,
	) );
	$wp_customize->add_section( 'sharonchin_navbar_options', array(
			'title'		=>	__( 'Navbar Options', 'sharonchin' ),
			'priority'	=>	101,
	) );
	
	// Add settings
	foreach ( array_keys( sharonchin_get_default_theme_options() ) as $setting ) {
		$wp_customize->add_setting( "sharonchin_theme_options[{$setting}]", array(
			'default'		=>	sharonchin_options()->$setting,
			'type'			=>	'option',
			'transport'		=>	'postMessage',
		) );
	}
	
	// Theme Layout
	$wp_customize->add_control( 'sharonchin_theme_layout', array(
		'label'		=>	__( 'Default Layout', 'sharonchin' ),
		'section'	=>	'sharonchin_theme_layout',
		'settings'	=>	'sharonchin_theme_options[theme_layout]',
		'type'		=>	'radio',
		'choices'	=>	array(
			'content-sidebar'	=>	__( 'Content on left', 'sharonchin' ),
			'sidebar-content'	=>	__( 'Content on right', 'sharonchin' )
		),
	) );
	
	// Sitename in Navbar
	$wp_customize->add_control( 'sharonchin_navbar_site_name', array(
		'label'		=>	__( 'Add site name to navigation bar.', 'sharonchin' ),
		'section'	=>	'sharonchin_navbar_options',
		'settings'	=>	'sharonchin_theme_options[navbar_site_name]',
		'type'		=>	'checkbox',
	) );
	
	// Searchform in Navbar
	$wp_customize->add_control( 'sharonchin_navbar_searchform', array(
		'label'		=>	__( 'Add searchform to navigation bar.', 'sharonchin' ),
		'section'	=>	'sharonchin_navbar_options',
		'settings'	=>	'sharonchin_theme_options[navbar_searchform]',
		'type'		=>	'checkbox',
	) );
	
	// Navbar Colors
	$wp_customize->add_control( 'sharonchin_navbar_inverse', array(
		'label'		=>	__( 'Use inverse color on navigation bar.', 'sharonchin' ),
		'section'	=>	'sharonchin_navbar_options',
		'settings'	=>	'sharonchin_theme_options[navbar_inverse]',
		'type'		=>	'checkbox',
	) );
	
	// Navbar Position
	$wp_customize->add_control( 'sharonchin_navbar_position', array(
		'label'		=>	__( 'Navigation Bar Position', 'sharonchin' ),
		'section'	=>	'sharonchin_navbar_options',
		'settings'	=>	'sharonchin_theme_options[navbar_position]',
		'type'		=>	'radio',
		'choices'	=>	array(
			'static'				=>	__( 'Static.', 'sharonchin' ),
			'navbar-fixed-top'		=>	__( 'Fixed on top.', 'sharonchin' ),
			'navbar-fixed-bottom'	=>	__( 'Fixed at bottom.', 'sharonchin' ),
		),
	) );
}
add_action( 'customize_register', 'sharonchin_customize_register' );


/**
 * Adds controls to change settings instantly
 *
 * @author	Konstantin Obenland
 * @since	1.4.0 - 05.05.2012
 *
 * @return	void
 */
function sharonchin_customize_enqueue_scripts() {
	wp_enqueue_script( 'sharonchin-customize', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), _sharonchin_version(), true );
	wp_localize_script( 'sharonchin-customize', 'sharonchin_customize', array(
		'sitename'		=>	get_bloginfo( 'name', 'display' ),
		'searchform'	=>	sharonchin_navbar_searchform( false )
	) );
}
add_action( 'customize_preview_init', 'sharonchin_customize_enqueue_scripts' );


/* End of file theme-customizer.php */
/* Location: ./wp-content/themes/sharonchin/inc/theme-customizer.php */