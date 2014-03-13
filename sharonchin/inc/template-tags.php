<?php
/** template-tags.php
 * 
 * Implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 * 
 * @author		Konstantin Obenland
 * @package		Sharon Chin Theme
 * @since		1.2.4 - 07.04.2012
 * Text Domain: inc
 */



if ( ! function_exists( 'sharonchin_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 *
 * To be honest - I'm pretty proud of this function. Through a lot of trial and
 * error, I was able to use a core WordPress function (paginate_links()) and
 * adjust it in a way, that the end result is a legitimate pagination.
 * A pagination many developers buy (code) expensively with Plugins like
 * WP Pagenavi. No need! WordPress has it all!
 *
 * @return	void
 */
function sharonchin_content_nav() {
	global $wp_query, $wp_rewrite;

	$paged			=	( get_query_var( 'paged' ) ) ? intval( get_query_var( 'paged' ) ) : 1;

	$pagenum_link	=	html_entity_decode( get_pagenum_link() );
	$query_args		=	array();
	$url_parts		=	explode( '?', $pagenum_link );
	
	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}
	$pagenum_link	=	remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link	=	trailingslashit( $pagenum_link ) . '%_%';
	
	$format			=	( $wp_rewrite->using_index_permalinks() AND ! strpos( $pagenum_link, 'index.php' ) ) ? 'index.php/' : '';
	$format			.=	$wp_rewrite->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
	
	$links	=	paginate_links( array(
		'base'		=>	$pagenum_link,
		'format'	=>	$format,
		'total'		=>	$wp_query->max_num_pages,
		'current'	=>	$paged,
		'mid_size'	=>	3,
		'type'		=>	'list',
		'prev_text'	=> __('< NEWER', 'sharonchin' ),	
		'next_text'	=> __('OLDER >', 'sharonchin' ),
		'add_args'	=>	array_map( 'urlencode', $query_args )
	) );

	if ( $links ) {
		echo "<nav class=\"pagination pagination-right clearfix\">{$links}</nav>";
	}
}
endif;



if ( ! function_exists( 'sharonchin_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 *
 * To be honest - I'm pretty proud of this function. Through a lot of trial and
 * error, I was able to user a core WordPress function (paginate_links()) and
 * adjust it in a way, that the end result is a legitimate pagination.
 * A pagination many developers buy (code) expensively with Plugins like
 * WP Pagenavi. No need! WordPress has it all!
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @return	void
 */
function sharonchin_content_nav() {
	global $wp_query, $wp_rewrite;

	$paged			=	( get_query_var( 'paged' ) ) ? intval( get_query_var( 'paged' ) ) : 1;

	$pagenum_link	=	html_entity_decode( get_pagenum_link() );
	$query_args		=	array();
	$url_parts		=	explode( '?', $pagenum_link );
	
	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}
	$pagenum_link	=	remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link	=	trailingslashit( $pagenum_link ) . '%_%';
	
	$format			=	( $wp_rewrite->using_index_permalinks() AND ! strpos( $pagenum_link, 'index.php' ) ) ? 'index.php/' : '';
	$format			.=	$wp_rewrite->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
	
	$links	=	paginate_links( array(
		'base'		=>	$pagenum_link,
		'format'	=>	$format,
		'total'		=>	$wp_query->max_num_pages,
		'current'	=>	$paged,
		'mid_size'	=>	3,
		'type'		=>	'list',
		'add_args'	=>	array_map( 'urlencode', $query_args )
	) );

	if ( $links ) {
		echo "<nav class=\"pagination pagination-centered clearfix\">{$links}</nav>";
	}
}
endif;


if ( ! function_exists( 'sharonchin_comment_nav' ) ) :
/**
 * Display navigation to next/previous comments pages when applicable
 *
 * @author	Konstantin Obenland
 * @since	1.5.0 - 19.05.2012
 *
 * @return	void
 */
function sharonchin_comment_nav() {
	if ( get_comment_pages_count() > 1 AND get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
	<nav class="comment-nav well">
		<h1 class="assistive-text"><?php _e( 'Comment navigation', 'sharonchin' ); ?></h1>
		<div class="nav-previous alignleft"><?php next_comments_link( __( '&larr; Newer Comments', 'sharonchin' ) ); ?></div>
		<div class="nav-next alignright"><?php previous_comments_link( __( 'Older Comments &rarr;', 'sharonchin' ) ); ?></div>
	</nav>
	<?php endif; // check for comment navigation
}
endif;


if ( ! function_exists( 'sharonchin_posted_on' ) ) :
/**
* Prints HTML with meta information for the current post-date/time and author,
* comment and edit link
*
* @author	Roberto Ulloa
*
* @return	void
*/
function sharonchin_posted_on() {
	$categories_list = get_the_category_list( _x( ', ', 'used between list items, there is a space after the comma', 'sharonchin' ) );
	if ( ! $categories_list) {
		$categories_list = get_post_type();
	}
	printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date date" datetime="%3$s" pubdate><span class="date updated">%4$s</span></time></a> <span class="sep"> </span> <span class="sep"> by </span> <span class="category vcard"><span class="fn"><a class="url n" href="%5$s" title="%6$s" rel="categories">%7$s</a></span></span> <span class="sep"> in </span>  %8$s', 'sharonchin' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'sharonchin' ), get_the_author() ) ),
			get_the_author(),
			$categories_list
	);
	if ( comments_open() AND ! post_password_required() ) { ?>
		<span class="sep"> | </span>
		<span class="comments-link">
			<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'sharonchin' ) . '</span>', __( '<strong>1</strong> Reply', 'sharonchin' ), __( '<strong>%</strong> Replies', 'sharonchin' ) ); ?>
		</span>
		<?php
	}
	edit_post_link( __( 'Edit', 'sharonchin' ), '<span class="sep">&nbsp;</span><span class="edit-link label">', '</span>' );
}
endif;

if ( ! function_exists( 'sharonchin_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author,
* comment and edit link
*
* @author	Konstantin Obenland
* @since	1.0.0 - 05.02.2012
*
* @return	void
*/
function sharonchin_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'sharonchin' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'sharonchin' ), get_the_author() ) ),
			get_the_author()
	);
	if ( comments_open() AND ! post_password_required() ) { ?>
		<span class="sep"> | </span>
		<span class="comments-link">
			<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'sharonchin' ) . '</span>', __( '<strong>1</strong> Reply', 'sharonchin' ), __( '<strong>%</strong> Replies', 'sharonchin' ) ); ?>
		</span>
		<?php
	}
	edit_post_link( __( 'Edit', 'sharonchin' ), '<span class="sep">&nbsp;</span><span class="edit-link label">', '</span>' );
}
endif;


if ( ! function_exists( 'sharonchin_link_pages' ) ) :
/**
 * Displays page links for paginated posts
 *
 * It's basically the wp_link_pages() function, altered to fit to the Bootstrap
 * markup needs for paginations (unordered list).
 * @see		wp_link_pages()
 *
 * @author	Konstantin Obenland
 * @since	1.1.0 - 09.03.2012
 *
 * @param	array	$args
 *
 * @return	string
 */
function sharonchin_link_pages( $args = array() ) {
	wp_link_pages( array( 'echo' => 0 ));
	$defaults = array(
		'next_or_number'	=> 'number',
		'nextpagelink'		=> __('Next page', 'sharonchin'),
		'previouspagelink'	=> __('Previous page', 'sharonchin'),
		'pagelink'			=> '%',
		'echo'				=> true
	);

	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'sharonchin_link_pages_args', $r );
	extract( $r, EXTR_SKIP );

	global $page, $numpages, $multipage, $more, $pagenow;

	$output = '';
	if ( $multipage ) {
		if ( 'number' == $next_or_number ) {
			$output .= '<nav class="pagination clear"><ul><li><span class="dots">' . __('Pages:', 'sharonchin') . '</span></li>';
			for ( $i = 1; $i < ($numpages + 1); $i++ ) {
				$j = str_replace( '%', $i, $pagelink );
				if ( ($i != $page) || ((!$more) && ($page!=1)) ) {
					$output .= '<li>' . _wp_link_page($i) . $j . '</a></li>';
				}
				if ($i == $page) {
					$output .= '<li class="current"><span>' . $j . '</span></li>';
				}
				
			}
			$output .= '</ul></nav>';
		} else {
			if ( $more ) {
				$output .= '<nav class="pagination clear"><ul><li><span class="dots">' . __('Pages:', 'sharonchin') . '</span></li>';
				$i = $page - 1;
				if ( $i && $more ) {
					$output .= '<li>' . _wp_link_page( $i ) . $previouspagelink. '</a></li>';
				}
				$i = $page + 1;
				if ( $i <= $numpages && $more ) {
					$output .= '<li>' . _wp_link_page( $i ) . $nextpagelink. '</a></li>';
				}
				$output .= '</ul></nav>';
			}
		}
	}

	if ( $echo )
		echo $output;

	return $output;
}
endif;


if ( ! function_exists( 'sharonchin_navbar_searchform' ) ) :
/**
 * Returns or echoes searchform mark up, specifically for the navbar.
*
* @author	Konstantin Obenland
* @since	1.5,0 - 14.05.2012
* 
* @param	bool	$echo	Optional. Whether to echo the form
*
* @return	void
*/
function sharonchin_navbar_searchform( $echo = true ) {
	$searchform = '	<form id="searchform" class="navbar-search pull-right" method="get" action="' . esc_url( home_url( '/' ) ) . '">
						<label for="s" class="assistive-text hidden">' . __( 'Search', 'sharonchin' ) . '</label>
						<input type="search" class="search-query" name="s" id="s" placeholder="' . esc_attr__( 'Search', 'sharonchin' ) . '" />
					</form>';

	if ( $echo )
		echo $searchform;

	return $searchform;
}
endif;


if ( ! function_exists( 'sharonchin_navbar_class' ) ) :
/**
 * Adds Sharon Chin Theme navbar classes
 *
 * @author	WordPress.org
 * @since	1.4.0 - 12.05.2012
 *
 * @return	void
 */
function sharonchin_navbar_class() {
	$classes	=	array( 'navbar' );

	if ( 'static' != sharonchin_options()->navbar_position )
		$classes[]	=	sharonchin_options()->navbar_position;
	
	if ( sharonchin_options()->navbar_inverse )
		$classes[]	=	'navbar-inverse';
	
	apply_filters( 'sharonchin_navbar_classes', $classes );

	echo 'class="' . join( ' ', $classes ) . '"';
}
endif;


if ( ! function_exists( 'sharonchin_comments_link' ) ) :
/**
 * Displays the link to the comments popup window for the current post ID.
 *
 * Is not meant to be displayed on single posts and pages. Should be used on the
 * lists of posts
 *
 * @since	2.0.0 - 01.09.2012
 *
 * @param	string	$zero		The string to display when no comments
 * @param	string	$one		The string to display when only one comment is available
 * @param	string	$more		The string to display when there are more than one comment
 * @param	string	$css_class	The CSS class to use for comments
 * @param	string	$none		The string to display when comments have been turned off
 * 
 * @return	void
 */
function sharonchin_comments_link( $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {
	$number = get_comments_number();
	$class  = empty( $css_class ) ? '' : ' class="' . esc_attr( $css_class ) . '"';
	
	if ( false === $zero ) $zero = __( 'No Comments', 'sharonchin' );
	if ( false === $one  ) $one  = __( '1 Comment', 'sharonchin' );
	if ( false === $more ) $more = __( '% Comments', 'sharonchin' );
	if ( false === $none ) $none = __( 'Comments Off', 'sharonchin' );

	if ( 0 == $number AND ! comments_open() AND ! pings_open() ) {
		echo '<span' . $class . '>' . $none . '</span>';
		return;
	}

	if ( post_password_required() ) {
		echo '<span' . $class . '>' . __( 'Enter your password to view comments.' , 'sharonchin' ) . '</span>';
		return;
	}
	
	if ( 1 < $number )
		$comments_number = str_replace( '%', number_format_i18n( $number ), $more );
	else
		$comments_number = ( 0 == $number ) ? $zero : $one;
	
	$link = sprintf( '<a href="%1$s"%2$s%3s title="%4$s">%5$s</a>',
		( 0 == $number ) ? '#respond' : '#comments',
		$class,
		apply_filters( 'comments_popup_link_attributes', '' ),
		esc_attr( sprintf( __( 'Comment on %s' , 'sharonchin' ), the_title_attribute( array('echo' => 0 ) ) ) ),
		apply_filters( 'comments_number', $comments_number, $number )
	);
	
	echo apply_filters( 'sharonchin_comments_link', $link, $zero, $one, $more, $css_class, $none );
}
endif;


/* End of file template-tags.php */
/* Location: ./wp-content/themes/sharonchin/inc/template-tags.php */
