<?php
/** page-event.php
 *
 * Template Name: Event
 *
 * @author		Roberto Ulloa
 * @package		sharonchin
 * @since		1.0.0 - 14.06.2013
 */

get_header(); ?>

<section id="mandibunga" class="span12 event fullpage-content">
	<?php tha_content_before(); ?>
	<div id="content" class="content" role="main">
		<?php tha_content_top();
		the_post();
		get_template_part( '/partials/content', 'event' );
		tha_content_bottom(); 
		?>

		<div class="share top-splitter text-center">
			<?php dynamic_sidebar( 'social-share-bar' ); ?>
		</div>

		<?php 
		$contact = get_post_meta($post->ID, 'contact-event', TRUE); 
		if ($contact !== '') {
		?>
			<div class="top-splitter ">
				<div class="row">
					<div class="span2"><h4 class="nospacings">Contact</h4></div>
					<div class="span10 small-gray">
						<?php echo $contact; ?>
					</div>
				</div>
			</div>
		<?php }?>

		<div class="top-splitter ">
			<h4 class="bottom-spacer">Latest Posts about <?php echo the_title(); ?></h4>
			<?php
			$event = get_post_meta($post->ID, 'event', TRUE);
			if($event === '') {
				echo "<h2>There is no custom field indicating the tag that should be used for this event (for example 'weeds') </h2>";
			} else {
				$args=array(
					'post_type' => array('post','news','archive'),
					'orderby' => 'date',
					'order' => 'DESC',
					'tag' => $event,
					'posts_per_page' => 5,
					'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1
				);
				$wp_query = new WP_query( $args );
				if ( $wp_query->have_posts() ) { 
					while ( $wp_query->have_posts() ) { 
						$wp_query->the_post();
						get_template_part( '/partials/content', 'event-item' );
					}
				} else {
					echo "<h2> No posts, news or work tagged with the $event tag </h2>";
				}
			}
			?>
		</div>
	</div><!-- #content -->
	<?php 
	sharonchin_content_nav( 'nav-below' );
	wp_reset_query();
	tha_content_after(); ?>


</section><!-- .section -->

<?php
get_footer();


/* End of file page.php */
/* Location: ./wp-content/themes/sharonchin/page.php */
