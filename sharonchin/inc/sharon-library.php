<?php
/** sharon-library.php
 * 
 * Implementation of functions for sharonchin theme
 *
 * @author		Roberto Ulloa
 * @package		Sharon Chin Theme
 * @since		12-03-2014
 * /

/**
 * Get the last news of certain tag
 * @param  $tag the post we need the tag
 * @return string of html 
 */
function get_last_post_of_tag( $post_type ,$tag){

	$html = false;

	$args=array(
		'tag' => $tag,
		'post_type' => $post_type
	);

	$my_query = new WP_query( $args );
	if( $my_query->have_posts() ) {
		$html = '';
		if( $my_query->have_posts() ) {
			$my_query->the_post();
			get_template_part( '/partials/content', 'mini-lilypad' );
		}
	}

	wp_reset_query();
	return $html;
}



/**
 * Get the related art of a ppost
 * @param  $post the post we need the art
 * @return string of html 
 */
function get_related_art($post){
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
function get_art_type($id){
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
function get_format_type($id){
	$format = '';
	$formats = get_the_terms($id, 'archive-post-format');
	if ( $formats ) {
		usort($formats, '_usort_terms_by_ID');
		$format = $formats[0]->slug;
	}
	return $format;
}


function get_related($post, $post_types){
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
 * Get a montlhy year archive list for a custom post type filter by the taxonomy
 * @param  string  $cpt  Slug of the custom post type
 * @param  boolean $echo Whether to echo the output
 * @return array		 Return the output as an array to be parsed on the template level
 */
function get_cpt_year_archives( $cpt, $echo = false )
{
	global $wpdb; 

	if ($cpt === 'post'){
		$base_url = get_site_url() . '/';
	} else {
		$base_url = get_site_url() . '/' . $cpt . '/';
	}


		$sql = $wpdb->prepare("SELECT *, count(*) as count FROM $wpdb->posts 
			WHERE $wpdb->posts.post_type = %s AND $wpdb->posts.post_status = 'publish' 
			GROUP BY YEAR($wpdb->posts.post_date) 
			ORDER BY $wpdb->posts.post_date DESC", $cpt);

/*  DEACTIVATE FILTER
	if (get_query_var( 'taxonomy' ) ){
		$taxonomy = get_query_var( 'taxonomy' );
		$term = get_query_var( 'term' );
		$term = get_term_by('name', $term, $taxonomy);
		$sql = $wpdb->prepare("SELECT *, count(*) as count FROM $wpdb->posts 
			INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id)
			INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
			WHERE $wpdb->posts.post_type = %s AND $wpdb->posts.post_status = 'publish' 
			AND $wpdb->term_taxonomy.taxonomy = %s AND $wpdb->term_taxonomy.term_id = %s 
			GROUP BY YEAR($wpdb->posts.post_date) 
			ORDER BY $wpdb->posts.post_date DESC", $cpt, $taxonomy, $term->term_id);
		$base_url = $base_url . '/'. $term->slug;
	}
	else {
		$sql = $wpdb->prepare("SELECT *, count(*) as count FROM $wpdb->posts 
			WHERE $wpdb->posts.post_type = %s AND $wpdb->posts.post_status = 'publish' 
			GROUP BY YEAR($wpdb->posts.post_date) 
			ORDER BY $wpdb->posts.post_date DESC", $cpt);
	}*/
	$results = $wpdb->get_results($sql);

	if ( $results )
	{
		$archive = array();
		foreach ($results as $r)
		{
			$year = date('Y', strtotime( $r->post_date ) );
			$month = date('F', strtotime( $r->post_date ) );
			$month_num = date('m', strtotime( $r->post_date ) );
			$link = $base_url . $year;
			$this_archive = array( 'month' => $month, 'year' => $year, 'link' => $link, 'count'=> $r->count);
			array_push( $archive, $this_archive );
		}

		if( !$echo )
			return $archive;
		foreach( $archive as $a )
		{
			if (is_year() && strval(get_the_date( 'Y' )) === $a['year']){
				echo '<li class="active"><a href="' . $a['link'] . '">' . $a['year'] . ' (' . $a['count'] . ')</a> </li>';
			}
			else{
				echo '<li ><a href="' . $a['link'] . '">' . $a['year'] . ' (' . $a['count'] . ')</a> </li>';
			}
		}
	}
	return false;
}

/**
 * Get a montlhy archive list for a custom post type
 * @param  string  $cpt  Slug of the custom post type
 * @param  boolean $echo Whether to echo the output
 * @return array		 Return the output as an array to be parsed on the template level
 */
function get_cpt_archives( $cpt, $echo = false )
{
	global $wpdb; 
	$sql = $wpdb->prepare("SELECT *, count(*) as count FROM $wpdb->posts WHERE post_type = %s AND post_status = 'publish' GROUP BY YEAR($wpdb->posts.post_date), MONTH($wpdb->posts.post_date) ORDER BY $wpdb->posts.post_date DESC", $cpt);
	$results = $wpdb->get_results($sql);

	if ($cpt === 'post'){
		$base_url = get_site_url() . '/';
	} else {
		$base_url = get_site_url() . '/' . $cpt . '/';
	}

	if ( $results )
	{
		$archive = array();
		foreach ($results as $r)
		{
			$year = date('Y', strtotime( $r->post_date ) );
			$month = date('F', strtotime( $r->post_date ) );
			$month_num = date('m', strtotime( $r->post_date ) );
			$link = $base_url . $year . '/' . $month_num;
			$this_archive = array( 'month' => $month, 'year' => $year, 'link' => $link, 'count'=> $r->count);
			array_push( $archive, $this_archive );
		}

		if( !$echo )
			return $archive;

		foreach( $archive as $a )
		{
			if (is_month() && get_the_date( 'Y' ) === $a['year'] && get_the_date( 'F' ) === $a['month']){
				echo '<li class="active"><a href="' . $a['link'] . '">' . $a['month'] . ' ' . $a['year'] . ' (' . $a['count'] . ')</a></li>';
			}else{
				echo '<li><a href="' . $a['link'] . '">' . $a['month'] . ' ' . $a['year'] . ' (' . $a['count'] . ')</a></li>';
			}
		}
	}
	return false;
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


 /**
 * Split and wrap title
 *
 * @author	Roberto Ulloa
 * @since	1.0.0 - 14.07.2013
 *
 * @param	int	$postID
 *
 * @return	string
 */
function get_split_title($postID) {
    $title = get_the_title($postID);
    $lines = explode(' ', $title);
    $output = false;
    $count = 0;
    foreach( $lines as $line ) {
        $count++;
        $output .= '<span class="line-'.$count.'">'.$line.'</span> ';
    }
    return $output;
}



/**
 * Get a category (taxonomy based) archive list for a custom post type
 * @param  string  $cpt  Slug of the custom post type
 * @param  boolean $echo Whether to echo the output
 * @return array		 Return the output as an array to be parsed on the template level
 */
function get_cpt_taxonomy_archives( $cpt, $taxonomy, $echo = false )
{
	global $wpdb; 

	$sql = $wpdb->prepare("SELECT *, $wpdb->terms.slug as tax, $wpdb->terms.name as tax_name, count(*) as count FROM $wpdb->posts 
		INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id)
		INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
		INNER JOIN $wpdb->terms ON ($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
		WHERE $wpdb->posts.post_type = %s AND $wpdb->posts.post_status = 'publish' 
		AND $wpdb->term_taxonomy.taxonomy = %s 
		GROUP BY $wpdb->terms.slug 
		ORDER BY $wpdb->term_taxonomy.description ASC", $cpt, $taxonomy);

	$results = $wpdb->get_results($sql);

	if ( $results )
	{
		$archive = array();
		foreach ($results as $r)
		{
			$link = get_site_url() . '/' . $cpt . '/' . $r->tax;
			$this_archive = array( 'tax' => $r->tax, 'tax_name' => $r->tax_name, 'link' => $link, 'count'=> $r->count);
			array_push( $archive, $this_archive );
		}

		if( !$echo )
			return $archive;

		$term = get_query_var( 'term' );
		$total_count = 0;
		foreach( $archive as $a )
		{
			if ($term === $a['tax']){
				echo '<li class="active"><a href="' . $a['link'] . '">' . $a['tax_name'] . ' (' . $a['count'] . ')</a></li>';
			} else {
				echo '<li><a href="' . $a['link'] . '">' . $a['tax_name'] . ' (' . $a['count'] . ')</a></li>';
			}
			$total_count += $a['count'];
		}
		/*
		if ($term){
			echo '<li><a href="' . get_site_url() . '/' . $cpt . '/' . '">All (' . $total_count  . ')</a></li>';
		} else {
			echo '<li class="active"><a href="' . get_site_url() . '/' . $cpt . '/' . '">All (' . $total_count  . ')</a></li>';
		}*/
	}
	return false;
}



/* End of file sharon-library.php */
/* Location: ./wp-content/themes/sharonchin/inc/sharon-library.php  */
