<?php
/** single.php
 *
 * The Template for displaying all single posts.
 *
 * @author		Konstantin Obenland
 * @package		sharonchin
 * @since		1.0.0 - 05.02.2012
 */


get_header(); 

global $art_type;
global $format_type;
global $sharonchin_images;

$art_type = "";
$format_type = "";
if ( have_posts() ) {
	$art_type = get_art_type(get_the_ID());
	$format_type = get_format_type(get_the_ID());
	the_post();
	$sharonchin_images = get_children( array(
		'post_parent'		=>	$post->ID,
		'post_type'			=>	'attachment',
		'post_mime_type'	=>	'image',
		'orderby'			=>	'menu_order',
		'order'				=>	'ASC',
		'numberposts'		=>	999
	) );
}

if ( $format_type === '' ){
	$format_type = 'full-page';
	if ( $art_type === 'Writing' || $art_type === 'Press' || !$sharonchin_images) {
		$format_type = 'side-bar-page';
	} 
}

if ( $format_type === 'side-bar-page' ) {
?> 
<section id="primary" class="span12">
<?php } else { ?>
<section id="archive" class="span12 fullpage-content">
<?php }
	tha_content_before(); ?>
	<div id="content" role="main" class="content single single-archive">
		<?php tha_content_top();
			#if ( $art_type === 'Writing' || $art_type === 'Press' || !$sharonchin_images) {
			if ( $format_type === 'side-bar-page' ) {
				get_template_part('partials/content', '');
			} else {
				get_template_part('partials/content','archive');
			}
		?>
		<?php tha_content_bottom(); ?>
	</div><!-- #content -->

	<nav id="nav-single" class="pager top-splitter">
		<h3 class="assistive-text"><?php _e( 'Post navigation', 'sharonchin' ); ?></h3>
		<?php previous_post_link( '<span class="previous">%link </span>', sprintf( '%1$s', __( '< PREVIOUS WORK', 'sharonchin' ) ) ); ?>
		<span class="home"><a href="<?php echo home_url() . '/archive/'; ?>">BACK TO WORK</a></span>
		<span class="top"><a href="#">BACK TO TOP</a></span>
		<?php next_post_link( '<span class="next">%link</span>', sprintf( '%1$s', __( 'NEXT WORK >', 'sharonchin' ) ) ); ?>
	</nav><!-- #nav-single -->

	<?php tha_content_after(); ?>
</section><!-- #primary -->


<?php
#if ( $art_type === 'Writing' || $art_type === 'Press' || !$sharonchin_images) {
if ( $format_type === 'side-bar-page' ) {
	get_sidebar('archive');
}
get_footer();


/* End of file index.php */
/* Location: ./wp-content/themes/sharonchin/single.php */
