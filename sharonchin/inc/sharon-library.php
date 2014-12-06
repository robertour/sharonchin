<?php
/** sharon-library.php
 * 
 * Implementation of functions for sharonchin theme
 *
 * @author		Roberto Ulloa
 * @package		Sharon Chin Theme
 * @since		12-03-2014
 * @updated		3.1.3 - 19.07.2014
 * /


/**
 * Get the related art of a ppost
 * @param  $post the post we need the art
 * @return string of html 
 */
function sharonchin_get_related_art($post){
	$orig_post = $post;
	global $post;
	$categories = get_the_category($post->ID);
	$html = false;
	if ($categories) {
		$category_ids = array();
		foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

		$args=array(
			'category__in' => $category_ids,
			'post__not_in' => array($post->ID),
			'post_type' => array('archive'),
			'posts_per_page'=> 10, // Number of related posts that will be shown.
			'ignore_sticky_posts'=>1
		);

		$my_query = new WP_query( $args );
		if( $my_query->have_posts() ) {
			$html = '';
			while( $my_query->have_posts() ) {
				$my_query->the_post();
				$html .= '<li><a href="' . get_permalink() . '" rel="bookmark" title="'. get_the_title() . '">'. get_art_type(get_the_ID()) . ': '. get_the_title() .'</a></li>';
			}
		}
	}

	$post = $orig_post;
	wp_reset_query();
	return $html;
}



/**
 * Get the art type
 * @param  $id of item archive
 * @return string of art type
 */
function sharonchin_get_art_type($id){
	$art = 'Art';
	$arts = get_the_terms($id, 'archive');
	if ( $arts ) {
		usort($arts, '_usort_terms_by_ID');
		$art = $arts[0]->name;
	}
	return $art;
}



/**
 * Get the format art
 * @param  $id of item archive
 * @return string of the format art
 */
function sharonchin_get_format_type($id){
	$format = '';
	$formats = get_the_terms($id, 'archive-post-format');
	if ( $formats ) {
		usort($formats, '_usort_terms_by_ID');
		$format = $formats[0]->slug;
	}
	return $format;
}



/**
 * Get the related posts according to a type
 * @param  $post to be related with, $post_types that should be included
 * @return the related posts
 */
function sharonchin_get_related($post, $post_types){
	$orig_post = $post;
	global $post;
	$categories = get_the_category($post->ID);
	$html = false;
	if ($categories) {
		$category_ids = array();
		foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

		$args=array(
			'category__in' => $category_ids,
			'post__not_in' => array($post->ID),
			'post_type' => $post_types,
			'posts_per_page'=> 10, // Number of related posts that will be shown.
			'ignore_sticky_posts'=>1
		);

		$my_query = new WP_query( $args );
		if( $my_query->have_posts() ) {
			$html = '';
			while( $my_query->have_posts() ) {
				$my_query->the_post();
				$html .= '<li><a href="' . get_permalink() . '" rel="bookmark" title="'. get_the_title() . '">'. get_the_time('j M Y') . ': '. get_the_title() .'</a></li>';
			}
		}
	}

	$post = $orig_post;
	wp_reset_query();
	return $html;
}



/**
 * Replaces "[...]" (appended to automatically generated excerpts) 
 * with an ellipsis and sharonchin_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @author	Roberto Ulloa
 * @since	1.0.0 - 14.06.2013
 *
 * @param	string	$more
 *
 * @return	string
 */
function sharonchin_auto_excerpt_more( $more ) {
	return '&hellip;' . sharonchin_continue_reading_link();
}
add_filter( 'excerpt_more', 'sharonchin_auto_excerpt_more' );



/**
 * Adds a pretty link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @author	Roberto Ulloa
 * @since	1.0.0 - 14.06.2013
 *
 * @param	string	$output
 *
 * @return	string
 */
function sharonchin_custom_excerpt_more( $output ) {
	if ( has_excerpt() AND ! is_attachment() ) {
		$output .= sharonchin_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'sharonchin_custom_excerpt_more' );


/* End of file sharon-library.php */
/* Location: ./wp-content/themes/sharonchin/inc/sharon-library.php  */
