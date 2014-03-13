<?php
/** content-aside.php
 *
 * The template for displaying posts in the Aside Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @author		Konstantin Obenland
 * @package		Sharon Chin Theme
 * @since		1.0 - 07.02.2012
 */


tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php tha_entry_top(); ?>
	<header class="page-header">
		<hgroup>
			<?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() .'" title="' . sprintf( esc_attr__( 'Permalink to %s', 'sharonchin' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<h3 class="entry-format"><?php echo get_post_format_string( get_post_format() ); ?></h3>
		</hgroup>
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

	<footer class="entry-footer">
		<?php sharonchin_posted_on(); ?>
	</footer><!-- .entry-footer -->
	<?php tha_entry_bottom(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php tha_entry_after();


/* End of file content-aside.php */
/* Location: ./wp-content/themes/sharonchin/partials/content-aside.php */