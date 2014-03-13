<?php
/** content.php
 *
 * The default template for displaying content
 *
 * @author		Roberto Ulloa
 * @package		Sharon Chin Theme
 * @since		3.0.0 - 05.03.2013
 */


tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php tha_entry_top(); ?>
	
	<header class="page-header">
	<?php if ( is_sticky() AND is_home() ) : ?>
		<hgroup>
			<?php the_title( '<h1 class="entry-title"><a href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'sharonchin' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h1>' ); ?>
			<h3 class="entry-format"><?php _e( 'Featured', 'sharonchin' ); ?></h3>
		</hgroup>
	<?php
		else :
			if (isset($art_type)){ ?>
				<div class="media-crumbs">
					<?php echo $art_type . ' &gt; ' . strval(get_the_date( 'Y' ));?>
				</div>
			<?php }			
			the_title( '<h1 class="entry-title"><a href="' . get_permalink() .'" title="' . sprintf( esc_attr__( 'Permalink to %s', 'sharonchin' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h1>' );
			if (isset($art_type) && $art_type === 'Writing') { 
				$the_author = get_post_meta($post->ID, 'author', TRUE);
				if($the_author === '') { ?>
					<div class="media-author">
						by <?php the_author(); ?>
					</div>
			<?php } else { ?> 
					<div class="media-author">
						by <?php echo $the_author; ?>
					</div>
			<?php } } 
		endif;
		
		$post_type = get_post_type();
		if ( 'post' == $post_type or 'news' === $post_type ) : ?>
		<div class="entry-meta">
			<?php sharonchin_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary clearfix">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content clearfix">
		<?php 
		the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sharonchin' ) );
		sharonchin_link_pages(); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php
		//$categories_list = get_the_category_list( _x( ', ', 'used between list items, there is a space after the comma', 'sharonchin' ) );
		//if ( 'post' == get_post_type() AND $categories_list ) // Hide category text for pages on Search
		//	printf( '<span class="cat-links block">' . __( 'Posted in %1$s.', 'sharonchin' ) . '</span>', $categories_list );
		?>
	
	</footer><!-- #entry-meta -->

	<div class="share top-splitter">
		<?php dynamic_sidebar( 'social-share-bar' ); ?>
	</div>

	<?php
	$related_art = get_related_art($post);
	$related_posts = get_related($post, array('post', 'news'));
	if ($related_art or $related_posts) {
	?>
		<div class="related top-splitter">
			<?php if ($related_art) { ?>
				<ul class="nav nav-pills nav-stacked related-art">
					<li class="nav-header"> Related Work ></li>
					<?php echo $related_art; ?>
				</ul>
			<?php } 
			if ($related_posts) { ?>
				<ul class="nav nav-pills nav-stacked related-posts top-spacer">
					<li class="nav-header"> Related Posts ></li>
					<?php echo $related_posts; ?>
				</ul>
			<?php } ?>
		</div>
	<?php }?>

	<div class="share top-splitter">
		<?php comments_template( '', true ); ?>
	</div>

	<?php tha_entry_bottom(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php tha_entry_after();


/* End of file content.php */
/* Location: ./wp-content/themes/sharonchin/partials/content.php */
