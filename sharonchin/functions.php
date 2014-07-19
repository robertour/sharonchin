<?php
/** functions.php
 *
 * @author		Roberto Ulloa
 * @package		Sharon Chin Theme
 * @since		3.1.0 - 13-03-2014
 * @updated		3.1.3 - 19.07.2014
 */


if ( ! function_exists( 'sharonchin_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @author	WordPress.org
 * @since	1.0.0 - 05.02.2012
 *
 * @return	void
 */
function sharonchin_setup() {
	global $content_width;
	
	if ( ! isset( $content_width ) ) {
		$content_width = 770;
	}
	
	load_theme_textdomain( 'sharonchin', get_template_directory() . '/lang' );
	
	add_theme_support( 'automatic-feed-links' );
	
	add_theme_support( 'post-thumbnails' );
	
	add_theme_support( 'tha_hooks', array( 'all' ) );

	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'chat', 'video', 'image', 'link', 'list-item', 'quote', 'status' ) );

	// Implement the Theme Customizer script
	require_once( get_template_directory() . '/inc/theme-customizer.php' );
	
	/**
	 * Custom template tags for this theme.
	 */
	require_once( get_template_directory() . '/inc/template-tags.php' );
	
	/**
	 * Custom template tags for this theme.
	 */
	require_once( get_template_directory() . '/inc/sharon-library.php' );
	
	/**
	 * Implement the Custom Header feature
	 */
	require_once( get_template_directory() . '/inc/custom-header.php' );
	
	/**
	 * Custom Nav Menu handler for the Navbar.
	 */
	require_once( get_template_directory() . '/inc/nav-menu-walker.php' );
	
	/**
	 * Theme Hook Alliance
	 */
	require_if_theme_supports( 'tha_hooks', get_template_directory() . '/inc/tha-theme-hooks.php' );
	
	/**
	 * Including three menu (header-menu, primary and footer-menu).
	 * Primary is wrapping in a navbar containing div (wich support responsive variation)
	 * Header-menu and Footer-menu are inside pills dropdown menu
	 * 
	 * @since	1.2.2 - 07.04.2012
	 * @see		http://codex.wordpress.org/Function_Reference/register_nav_menus
	 */
	register_nav_menus( array(
		'primary'		=>	__( 'Main Navigation', 'sharonchin' ),
		'header-menu'  	=>	__( 'Header Menu', 'sharonchin' ),
		'footer-menu' 	=>	__( 'Footer Menu', 'sharonchin' )
	) );
	
	/* Add Image sizes */
	add_image_size( 'archive-item', 275, 225, true ); // Hard Crop Mode
	add_image_size( 'lilypad', 342, 9999); // Soft Crop Mode
	add_image_size( 'slider', 620, 9999); // Soft Crop Mode
	add_image_size( 'mini-thumbnail', 9999, 60); // Soft Crop Mode

	
} // sharonchin_setup
endif;
add_action( 'after_setup_theme', 'sharonchin_setup' );


/**
 * Returns the options object for Sharon Chin Theme.
 *
 * @author	Automattic
 * @since	1.3.0 - 06.04.2012
 *
 * @return	stdClass	Theme Options
 */
function sharonchin_options() {
	return (object) wp_parse_args(
		get_option( 'sharonchin_theme_options', array() ),
		sharonchin_get_default_theme_options()
	);
}


/**
 * Returns the default options for Sharon Chin Theme.
 *
 * @author	Automattic
 * @since	1.3.0 - 06.04.2012
 *
 * @return	void
 */
function sharonchin_get_default_theme_options() {
	$default_theme_options	=	array(
		'theme_layout'		=>	'content-sidebar',
		'navbar_site_name'	=>	false,
		'navbar_searchform'	=>	true,
		'navbar_inverse'	=>	true,
		'navbar_position'	=>	'static',
	);

	return apply_filters( 'sharonchin_default_theme_options', $default_theme_options );
}


/**
 * Adds Sharon Chin Theme layout classes to the array of body classes.
 *
 * @author	WordPress.org
 * @since	1.3.0 - 06.04.2012
 *
 * @return	void
 */
function sharonchin_layout_classes( $existing_classes ) {
	$classes = array( sharonchin_options()->theme_layout );
	$classes = apply_filters( 'sharonchin_layout_classes', $classes );

	return array_merge( $existing_classes, $classes );
}
add_filter( 'body_class', 'sharonchin_layout_classes' );


/**
 * Adds Custom Background support
 *
 * @author	Konstantin Obenland
 * @since	1.2.5 - 11.04.2012
 *
 * @return	void
 */
function sharonchin_custom_background_setup() {
	
	$args = apply_filters( 'sharonchin_custom_background_args',  array(
		'default-color'	=>	'EFEFEF',
	) );
	
	add_theme_support( 'custom-background', $args );
	
}
add_action( 'after_setup_theme', 'sharonchin_custom_background_setup' );


/**
 * Register the sidebars.
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @return	void
 */
function sharonchin_widgets_init() {

	if ( function_exists('register_sidebar') ) {
		register_sidebar( array(
			'name'			=>	__( 'Main Sidebar', 'sharonchin' ),
			'id'			=>	'main',
			'before_widget'	=>	'<aside id="%1$s" class="widget well announcement %2$s">',
			'after_widget'	=>	'</aside>',
			'before_title'	=>	'<div class="nav-header">',
			'after_title'	=>	'</div>',
		) );
	}


	include_once( 'inc/sharonchin-image-meta-widget.php' );
	register_widget( 'SharonChin_Image_Meta_Widget' );
	
	include_once( 'inc/sharonchin-gallery-widget.php' );
	register_widget( 'SharonChin_Gallery_Widget' );
}
add_action( 'widgets_init', 'sharonchin_widgets_init' );


/**
 * Registration of theme scripts and styles
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @return	void
 */
function sharonchin_register_scripts_styles() {

	if ( ! is_admin() ) {
		$theme_version = sharonchin_version();
		$suffix = ( defined('SCRIPT_DEBUG') AND SCRIPT_DEBUG ) ? '' : '.min';
		$bootstrap_css_dependencies = array();
		
		/**
		 * Scripts
		 */
		
				// Use less just in local server.
		if( WP_DEBUG === true ){

			// Register the bootstrap.less
			wp_register_style( 
				'lesscss', 
				get_stylesheet_directory_uri() . '/less/bootstrap.less', 
				//$bootstrap_css_dependencies,
				array(),
				'2.3.2'
			);


		} else {
			/**
			 * Styles
			 */
			wp_register_style(
				'tw-bootstrap',
				get_template_directory_uri() . "/css/bootstrap{$suffix}.css",
				array(),
				'2.0.3'
			);
		
			wp_register_style(
				'sharonchin',
				get_template_directory_uri() . "/style{$suffix}.css",
				array('tw-bootstrap'),
				$theme_version
			);
		}
	}
}
add_action( 'init', 'sharonchin_register_scripts_styles' );


/**
 * Properly enqueue frontend scripts
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @return	void
 */
function sharonchin_print_scripts() {
	$suffix = ( defined('SCRIPT_DEBUG') AND SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script('tw-bootstrap', get_template_directory_uri() . "/js/bootstrap{$suffix}.js");
	wp_enqueue_script('sharonchin', get_template_directory_uri() . "/js/sharonchin{$suffix}.js");
	wp_enqueue_script( 'masonry' , get_stylesheet_directory_uri() . "/js/masonry.pkgd{$suffix}.js");
	wp_enqueue_script('imagesloaded', get_stylesheet_directory_uri() . "/js/imagesloaded.pkgd{$suffix}.js");
	wp_enqueue_script('sharon', get_stylesheet_directory_uri() . "/js/sharon.js");

	if( WP_DEBUG === true ){
		wp_enqueue_script( 'delete-cache', get_stylesheet_directory_uri() . '/js/delete_cache.js');
		wp_enqueue_script('lessjs', get_stylesheet_directory_uri() . '/js/less-1.4.1.min.js');
		wp_enqueue_style('lesscss');
	} else {
		wp_enqueue_style('sharon-bootstrap');
	}
	wp_enqueue_style('sharonchin');
}
add_action( 'wp_enqueue_scripts', 'sharonchin_print_scripts' );


/**
 * Add headers to the less files!
 *
 * @author	Roberto Ulloa
 * @since	1.0.0 - 12.07.2013
 *
 * @return	void
 */
function sharonchin_enqueue_less_styles($tag, $handle) {
	global $wp_styles;
	$match_pattern = '/\.less$/U';
	if ( preg_match( $match_pattern, $wp_styles->registered[$handle]->src ) ) {
		$handle = $wp_styles->registered[$handle]->handle;
		$media = $wp_styles->registered[$handle]->args;
		$href = $wp_styles->registered[$handle]->src . '?ver=' . $wp_styles->registered[$handle]->ver;
		$rel = isset($wp_styles->registered[$handle]->extra['alt']) && $wp_styles->registered[$handle]->extra['alt'] ? 'alternate stylesheet' : 'stylesheet/less';
		$title = isset($wp_styles->registered[$handle]->extra['title']) ? "title='" . esc_attr( $wp_styles->registered[$handle]->extra['title'] ) . "'" : '';
		$tag = "<link rel='stylesheet' id='$handle' $title href='$href' type='text/less' media='$media' />";
	}
	return $tag;
	}
add_filter( 'style_loader_tag', 'sharonchin_enqueue_less_styles', 5, 2);

/**
 * Adds IE specific scripts
 * 
 * Respond.js has to be loaded after Theme styles
 *
 * @author	Konstantin Obenland
 * @since	1.7.0 - 11.06.2012
 *
 * @return	void
 */
function sharonchin_print_ie_scripts() {
	?>
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.min.js" type="text/javascript"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js" type="text/javascript"></script>
	<![endif]-->
	<?php
}
add_action( 'wp_head', 'sharonchin_print_ie_scripts', 11 );


/**
 * Properly enqueue comment-reply script
 *
 * @author	Konstantin Obenland
 * @since	1.4.0 - 08.05.2012
 *
 * @return	void
 */
function sharonchin_comment_reply() {
	if ( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'comment_form_before', 'sharonchin_comment_reply' );


function sharonchin_add_editor_styles() {
	add_editor_style( 'custom-editor-style.css' );
}
add_action( 'init', 'sharonchin_add_editor_styles' );

/**
 * Properly enqueue frontend styles
 *
 * Since 'tw-bootstrap' was registered as a dependency, it'll get enqueued
 * automatically
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @return	void
 */
function sharonchin_print_styles() {
	if ( is_child_theme() ) {
		wp_enqueue_style( 'sharonchin-child', get_stylesheet_uri(), array( 'sharonchin' ) );
	} else {
		wp_enqueue_style( 'sharonchin' );
	}
	
	if ( 'static' != sharonchin_options()->navbar_position ) {
		$top_bottom	=	str_replace( 'navbar-fixed-', '', sharonchin_options()->navbar_position );
		$css		=	"body > .container{margin-{$top_bottom}:68px;}@media(min-width: 980px){body > .container{margin-{$top_bottom}:58px;}}";
	
		if ( is_admin_bar_showing() AND 'top' == $top_bottom )
			$css	.=	'.navbar.navbar-fixed-top{margin-top:28px;}';
	
		if ( function_exists( 'wp_add_inline_style' ) )
			wp_add_inline_style( 'sharonchin', $css );
		else
			echo "<style type='text/css'>\n{$css}\n</style>\n";
	}
}
add_action( 'wp_enqueue_scripts', 'sharonchin_print_styles' );


if ( ! function_exists( 'sharonchin_credits' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author,
 * comment and edit link
 *
 * @author	Konstantin Obenland
 * @since	1.2.2 - 07.04.2012
 *
 * @return	void
 */
function sharonchin_credits() {
	printf(
		'<span class="credits alignleft">' . __( '&copy; %1$s <a href="%2$s">%3$s</a>, all rights reserved.', 'sharonchin' ) . '</span>',
		date( 'Y' ),
		home_url( '/' ),
		get_bloginfo( 'name' )
	);
}
endif;


/**
 * Returns the blogname if no title was set.
 *
 * @author	Konstantin Obenland
 * @since	1.1.0 - 18.03.2012
 *
 * @param	string	$title
 * @param	string	$sep
 *
 * @return	string
 */
function sharonchin_wp_title( $title, $sep ) {
	
	if ( ! is_feed() ) {
		$title .= get_bloginfo( 'name' );
		
		if ( is_front_page() ) {
			$title .= " {$sep} " . get_bloginfo( 'description' );
		}
	}

	return $title;
}
add_filter( 'wp_title', 'sharonchin_wp_title', 1, 2 );


/**
 * Returns a "Read More" link for excerpts
 *
 * @author	Roberto Ulloa
 * @since	1.0.0 - 14.06.2013
 *
 * @param	string	$more
 *
 * @return	string
 */
function sharonchin_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Read more <span class="meta-nav">&rarr;</span>', 'sharonchin' ) . '</a>';
}

/**
 * Get the wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @author	WordPress.org
 * @since	1.0.0 - 05.02.2012
 *
 * @param	array	$args
 *
 * @return	array
 */
function sharonchin_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'sharonchin_page_menu_args' );


/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @author	Automattic
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$url
 * @param	int		$id
 *
 * @return	string
 */
function sharonchin_enhanced_image_navigation( $url, $id ) {
    
	if ( is_attachment() AND wp_attachment_is_image( $id ) ) {
		$image = get_post( $id );
		if ( $image->post_parent AND $image->post_parent != $id )
			$url .= '#primary';
    }
    
    return $url;
}
add_filter( 'attachment_link', 'sharonchin_enhanced_image_navigation', 10, 2 );


/**
 * Displays comment list, when there are any
 *
 * @author	Konstantin Obenland
 * @since	1.7.0 - 16.06.2012
 *
 * @return	void
 */
function sharonchin_comments_list() {
	if ( post_password_required() ) : ?>
		<div id="comments">
			<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'sharonchin' ); ?></p>
		</div><!-- #comments -->
		<?php
		return;
	endif;
	
	
	if ( have_comments() ) : ?>
		<div id="comments">
			<h2 id="comments-title">
				<?php printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'sharonchin' ),
						number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?>
			</h2>
		
			<?php sharonchin_comment_nav(); ?>
		
			<ol class="commentlist unstyled">
				<?php wp_list_comments( array( 'callback' => 'sharonchin_comment' ) ); ?>
			</ol><!-- .commentlist .unstyled -->
		
			<?php sharonchin_comment_nav(); ?>
		
		</div><!-- #comments -->
	<?php endif;
}
add_action( 'comment_form_before', 'sharonchin_comments_list', 0 );
add_action( 'comment_form_comments_closed', 'sharonchin_comments_list', 1 );


/**
 * Echoes comments-are-closed message when post type supports comments and we're
 * not on a page
 *
 * @author	Konstantin Obenland
 * @since	1.7.0 - 16.06.2012
 *
 * @return	void
 */
function sharonchin_comments_closed() {
	if ( ! is_page() AND post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'sharonchin' ); ?></p>
	<?php endif;
}
add_action( 'comment_form_comments_closed', 'sharonchin_comments_closed' );


/**
 * Filters comments_form() default arguments
 *
 * @author	Konstantin Obenland
 * @since	1.7.0 - 16.06.2012
 *
 * @param	array	$defaults
 *
 * @return	array
 */
function sharonchin_comment_form_defaults( $defaults ) {
	return wp_parse_args( array(
		'comment_field'			=>	'<div class="comment-form-comment control-group"><label class="control-label" for="comment">' . _x( 'Comment', 'noun', 'sharonchin' ) . '</label><div class="controls"><textarea class="span7" id="comment" name="comment" rows="8" aria-required="true"></textarea></div></div>',
		'comment_notes_before'	=>	'',
		'comment_notes_after'	=>	'<div class="form-allowed-tags control-group"><label class="control-label">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'sharonchin' ), '</label><div class="controls"><pre>' . allowed_tags() . '</pre></div>' ) . '</div>
									 <div class="form-actions">',
		'title_reply'			=>	'<legend>' . __( 'Leave a reply', 'sharonchin' ) . '</legend>',
		'title_reply_to'		=>	'<legend>' . __( 'Leave a reply to %s', 'sharonchin' ). '</legend>',
		'must_log_in'			=>	'<div class="must-log-in control-group controls">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'sharonchin' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) ) ) . '</div>',
		'logged_in_as'			=>	'<div class="logged-in-as control-group controls">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'sharonchin' ), admin_url( 'profile.php' ), wp_get_current_user()->display_name, wp_logout_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) ) ) . '</div>',
	), $defaults );
}
add_filter( 'comment_form_defaults', 'sharonchin_comment_form_defaults' );


if ( ! function_exists( 'sharonchin_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own sharonchin_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	object	$comment	Comment data object.
 * @param	array	$args
 * @param	int		$depth		Depth of comment in reference to parents.
 *
 * @return	void
 */
function sharonchin_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	if ( 'pingback' == $comment->comment_type OR 'trackback' == $comment->comment_type ) : ?>
	
		<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<p class="row">
				<strong class="ping-label span1"><?php _e( 'Pingback:', 'sharonchin' ); ?></strong>
				<span class="span7"><?php comment_author_link(); edit_comment_link( __( 'Edit', 'sharonchin' ), '<span class="sep">&nbsp;</span><span class="edit-link label">', '</span>' ); ?></span>
			</p>
	
	<?php else:
		$offset	=	$depth - 1;
		$span	=	7 - $offset; ?>
		
		<li  id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<article id="comment-<?php comment_ID(); ?>" class="comment row">
				<div class="comment-author-avatar span1<?php if ($offset) echo " offset{$offset}"; ?>">
					<?php echo get_avatar( $comment, 70 ); ?>
				</div>
				<footer class="comment-meta span<?php echo $span; ?>">
					<p class="comment-author vcard">
						<?php
							/* translators: 1: comment author, 2: date and time */
							printf( __( '%1$s <span class="says">said</span> on %2$s:', 'sharonchin' ),
								sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
								sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
									esc_url( get_comment_link( $comment->comment_ID ) ),
									get_comment_time( 'c' ),
									/* translators: 1: date, 2: time */
									sprintf( __( '%1$s at %2$s', 'sharonchin' ), get_comment_date(), get_comment_time() )
								)
							);
							edit_comment_link( __( 'Edit', 'sharonchin' ), '<span class="sep">&nbsp;</span><span class="edit-link label">', '</span>' ); ?>
					</p><!-- .comment-author .vcard -->
	
					<?php if ( ! $comment->comment_approved ) : ?>
					<div class="comment-awaiting-moderation alert alert-info"><em><?php _e( 'Your comment is awaiting moderation.', 'sharonchin' ); ?></em></div>
					<?php endif; ?>
	
				</footer><!-- .comment-meta -->
	
				<div class="comment-content span<?php echo $span; ?>">
					<?php
					comment_text();
					comment_reply_link( array_merge( $args, array(
						'reply_text'	=>	__( 'Reply <span>&darr;</span>', 'sharonchin' ),
						'depth'			=>	$depth,
						'max_depth'		=>	$args['max_depth']
					) ) ); ?>
				</div><!-- .comment-content -->
			</article><!-- #comment-<?php comment_ID(); ?> .comment -->
			
	<?php endif; // comment_type
}
endif; // ends check for sharonchin_comment()


/**
 * Adds markup to the comment form which is needed to make it work with Bootstrap
 * needs
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$html
 *
 * @return	string
 */
function sharonchin_comment_form_top() {
	echo '<div class="form-horizontal">';
}
add_action( 'comment_form_top', 'sharonchin_comment_form_top' );


/**
 * Adds markup to the comment form which is needed to make it work with Bootstrap
 * needs
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$html
 *
 * @return	string
 */
function sharonchin_comment_form() {
	echo '</div></div>';
}
add_action( 'comment_form', 'sharonchin_comment_form' );


/**
 * Custom author form field for the comments form
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$html
 *
 * @return	string
 */
function sharonchin_comment_form_field_author( $html ) {
	$commenter	=	wp_get_current_commenter();
	$req		=	get_option( 'require_name_email' );
	$aria_req	=	( $req ? " aria-required='true'" : '' );
	
	return	'<div class="comment-form-author control-group">
				<label for="author" class="control-label">' . __( 'Name', 'sharonchin' ) . '</label>
				<div class="controls">
					<input id="author" name="author" type="text" value="' . esc_attr(  $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />
					' . ( $req ? '<p class="help-inline"><span class="required">' . __('required', 'sharonchin') . '</span></p>' : '' ) . '
				</div>
			</div>';
}
add_filter( 'comment_form_field_author', 'sharonchin_comment_form_field_author');


/**
 * Custom HTML5 email form field for the comments form
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$html
 *
 * @return	string
 */
function sharonchin_comment_form_field_email( $html ) {
	$commenter	=	wp_get_current_commenter();
	$req		=	get_option( 'require_name_email' );
	$aria_req	=	( $req ? " aria-required='true'" : '' );
	
	return	'<div class="comment-form-email control-group">
				<label for="email" class="control-label">' . __( 'Email', 'sharonchin' ) . '</label>
				<div class="controls">
					<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />
					<p class="help-inline">' . ( $req ? '<span class="required">' . __('required', 'sharonchin') . '</span>, ' : '' ) . __( 'will not be published', 'sharonchin' ) . '</p>
				</div>
			</div>';
}
add_filter( 'comment_form_field_email', 'sharonchin_comment_form_field_email');


/**
 * Custom HTML5 url form field for the comments form
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$html
 *
 * @return	string
 */
function sharonchin_comment_form_field_url( $html ) {
	$commenter	=	wp_get_current_commenter();
	
	return	'<div class="comment-form-url control-group">
				<label for="url" class="control-label">' . __( 'Website', 'sharonchin' ) . '</label>
				<div class="controls">
					<input id="url" name="url" type="url" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30" />
				</div>
			</div>';
}
add_filter( 'comment_form_field_url', 'sharonchin_comment_form_field_url');


/**
 * Adjusts an attechment link to hold the class of 'thumbnail' and make it look
 * pretty
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$link
 * @param	int		$id			Post ID.
 * @param	string	$size		Default is 'thumbnail'. Size of image, either array or string.
 * @param	bool	$permalink	Default is false. Whether to add permalink to image.
 * @param	bool	$icon		Default is false. Whether to include icon.
 * @param	string	$text		Default is false. If string, then will be link text.
 *
 * @return	string
 */
function sharonchin_get_attachment_link( $link, $id, $size, $permalink, $icon, $text ) {
	return ( ! $text ) ? str_replace( '<a ', '<a class="thumbnail" ', $link ) : $link;
}
add_filter( 'wp_get_attachment_link', 'sharonchin_get_attachment_link', 10, 6 );


/**
 * Adds the 'hero-unit' class for extra big font on sticky posts
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	array	$classes
 *
 * @return	array
 */
function sharonchin_post_classes( $classes ) {

	if ( is_sticky() AND is_home() ) {
		$classes[] = 'hero-unit';
	}
	
	return $classes;
}
add_filter( 'post_class', 'sharonchin_post_classes' );


/**
 * Callback function to display galleries (in HTML5)
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$content
 * @param	array	$attr
 *
 * @return	string
 */
function sharonchin_post_gallery( $content, $attr ) {
	global $instance, $post;
	$instance++;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( ! $attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract( shortcode_atts( array(
		'order'			=>	'ASC',
		'orderby'		=>	'menu_order ID',
		'id'			=>	$post->ID,
		'itemtag'		=>	'figure',
		'icontag'		=>	'div',
		'captiontag'	=>	'figcaption',
		'columns'		=>	3,
		'size'			=>	'thumbnail',
		'include'		=>	'',
		'exclude'		=>	''
	), $attr ) );


	$id = intval( $id );
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( $include ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts( array(
			'include'			=>	$include,
			'post_status'		=>	'inherit',
			'post_type'			=>	'attachment',
			'post_mime_type'	=>	'image',
			'order'				=>	$order,
			'orderby'			=>	$orderby
		) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( $exclude ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array(
			'post_parent'		=>	$id,
			'exclude'			=>	$exclude,
			'post_status'		=>	'inherit',
			'post_type'			=>	'attachment',
			'post_mime_type'	=>	'image',
			'order'				=>	$order,
			'orderby'			=>	$orderby
		) );
	} else {
		$attachments = get_children( array(
			'post_parent'		=>	$id,
			'post_status'		=>	'inherit',
			'post_type'			=>	'attachment',
			'post_mime_type'	=>	'image',
			'order'				=>	$order,
			'orderby'			=>	$orderby
		) );
	}

	if ( empty( $attachments ) )
		return;

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
		return $output;
	}
	
	$itemtag	=	tag_escape( $itemtag );
	$captiontag	=	tag_escape( $captiontag );
	$columns	=	intval( min( array( 8, $columns ) ) );
	$float		=	(is_rtl()) ? 'right' : 'left';

	if ( 4 > $columns )
		$size = 'full';
	
	$selector	=	"gallery-{$instance}";
	$size_class	=	sanitize_html_class( $size );
	$output		=	"<ul id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class} thumbnails'>";

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$comments = get_comments( array(
			'post_id'	=>	$id,
			'count'		=>	true,
			'type'		=>	'comment',
			'status'	=>	'approve'
		) );
		
		$link = wp_get_attachment_link( $id, $size, ! ( isset( $attr['link'] ) AND 'file' == $attr['link'] ) );
		$clear_class = ( 0 == $i++ % $columns ) ? ' clear' : '';
		$span = 'span' . floor( 8 / $columns );
		
		$output .= "<li class='{$span}{$clear_class}'><{$itemtag} class='gallery-item'>";
		$output .= "<{$icontag} class='gallery-icon'>{$link}</{$icontag}>\n";
			
		if ( $captiontag AND ( 0 < $comments OR trim( $attachment->post_excerpt ) ) ) {
			$comments	=	( 0 < $comments ) ? sprintf( _n('%d comment', '%d comments', $comments, 'sharonchin'), $comments ) : '';
			$excerpt	=	wptexturize( $attachment->post_excerpt );
			$out		=	($comments AND $excerpt) ? " $excerpt <br /> $comments " : " $excerpt$comments ";
			$output		.=	"<{$captiontag} class='wp-caption-text gallery-caption'>{$out}</{$captiontag}>\n";
		}
		$output .= "</{$itemtag}></li>\n";
	}
	$output .= "</ul>\n";
	
	return $output;
}
add_filter( 'post_gallery', 'sharonchin_post_gallery', 10, 2 );


/**
 * HTML 5 caption for pictures
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$empty
 * @param	array	$attr
 * @param	string	$content
 *
 * @return	string
 */
function sharonchin_img_caption_shortcode( $empty, $attr, $content ) {

	extract( shortcode_atts( array(
		'id'		=>	'',
		'align'		=>	'alignnone',
		'width'		=>	'',
		'caption'	=>	''
	), $attr ) );

	if ( 1 > (int) $width OR empty( $caption ) ) {
		return $content;
	}

	if ( $id ) {
		$id = 'id="' . $id . '" ';
	}

	return '<figure ' . $id . 'class="wp-caption thumbnail ' . $align . '" style="width: '.$width.'px;">
				' . do_shortcode( str_replace( 'class="thumbnail', 'class="', $content ) ) . '
				<figcaption class="wp-caption-text">' . $caption . '</figcaption>
			</figure>';
}
add_filter( 'img_caption_shortcode', 'sharonchin_img_caption_shortcode', 10, 3 );


/**
 * Returns a password form which dispalys nicely with Bootstrap
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$form
 *
 * @return	string	Sharon Chin Theme password form
 */
function sharonchin_the_password_form( $form ) {
	return '<form class="post-password-form form-horizontal" action="' . home_url( 'wp-pass.php' ) . '" method="post"><legend>'. __( 'This post is password protected. To view it please enter your password below:', 'sharonchin' ) . '</legend><div class="control-group"><label class="control-label" for="post-password-' . get_the_ID() . '">' . __( 'Password:', 'sharonchin' ) .'</label><div class="controls"><input name="post_password" id="post-password-' . get_the_ID() . '" type="password" size="20" /></div></div><div class="form-actions"><button type="submit" class="post-password-submit submit btn btn-primary">' . __( 'Submit', 'sharonchin' ) . '</button></div></form>';
}
add_filter( 'the_password_form', 'sharonchin_the_password_form' );


/**
 * Modifies the category dropdown args for widgets on 404 pages
 *
 * @author	Konstantin Obenland
 * @since	1.5.0 - 19.05.2012
 *
 * @param	array	$args
 *
 * @return	array
 */
function sharonchin_widget_categories_dropdown_args( $args ) {
	if ( is_404() ) {
		$args	=	wp_parse_args( $args, array(
			'orderby'		=>	'count',
			'order'			=>	'DESC',
			'show_count'	=>	1,
			'title_li'		=>	'',
			'number'		=>	10
		) );
	}
	return $args;
}
add_filter( 'widget_categories_dropdown_args', 'sharonchin_widget_categories_dropdown_args' );


/**
 * Adds the .thumbnail class when images are sent to editor
 * 
 * @author	Konstantin Obenland
 * @since	2.0.0 - 29.08.2012
 * 
 * @param	string	$html
 * @param	int		$id
 * @param	string	$caption
 * @param	string	$title
 * @param	string	$align
 * @param	string	$url
 * @param	string	$size
 * @param	string	$alt
 * 
 * @return	string	Image HTML
 */
function sharonchin_image_send_to_editor( $html, $id, $caption, $title, $align, $url, $size, $alt ) {
	if ( $url ) {
		$html = str_replace( '<a ', '<a class="thumbnail" ', $html );
	} else {
		$html = str_replace( 'class="', 'class="thumbnail ', $html );
	}

	return $html;
}
add_filter( 'image_send_to_editor', 'sharonchin_image_send_to_editor', 10, 8 );


/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @author	WordPress.org
 * @since	2.0.0 - 29.08.2012
 * 
 * @return	void
 */
function sharonchin_content_width() {
	if ( is_attachment() ) {
		global $content_width;
		$content_width = 940;
	}
}
add_action( 'template_redirect', 'sharonchin_content_width' );


/**
 * Returns the Theme version string
 *
 * @author	Konstantin Obenland
 * @since	1.2.4 - 07.04.2012
 * @access	private
 *
 * @return	string	Sharon Chin Theme version
 */
function sharonchin_version() {
	
	if ( function_exists( 'wp_get_theme' ) ) {
		$theme_version	=	wp_get_theme()->get( 'Version' );
	}
	else {
		$theme_data		=	wp_get_theme( get_template_directory() . '/style.css' );
		$theme_version	=	$theme_data['Version'];
	}
	
	return $theme_version;
}



/**
 * Related with a bug discussed in this post
 * http://wordpress.stackexchange.com/questions/71157/undefined-property-stdclasslabels-in-general-template-php-post-type-archive
 * @author	Roberto Ulloa
 * @since	1.0.0 - 10.07.2013
 *
 * @return void
 */
function sharonchin_wpse_71157_parse_query( $wp_query )
{
	if ( $wp_query->is_post_type_archive && $wp_query->is_tax )
		$wp_query->is_post_type_archive = false;
}
add_action( 'parse_query', 'sharonchin_wpse_71157_parse_query' );




/* End of file functions.php */
/* Location: ./wp-content/themes/sharonchin/functions.php */



