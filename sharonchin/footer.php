<?php
/** footer.php
 *
 * @author		Konstantin Obenland
 * @package		Sharon Chin Theme
 * @since		1.0.0	- 05.02.2012
 */

				tha_footer_before(); ?>
				<div id="end-page" class="bordener">
					<div id="end-page1" class="borderdraw" "><!-- --></div>
					<div id="end-page2" class="borderdraw" "><!-- --></div>
				</div>
			</div><!-- #page -->
			
			<footer id="colophon" role="contentinfo" class="row">
				<div id="top-left-black" class="borderdraw"></div>
				<div id="top-left-white" class="borderdraw"></div>
				<div id="top-right-black" class="borderdraw"></div>
				<div id="top-right-white" class="borderdraw"></div>
				<div id="left-black" class="borderdraw"></div>
				<div id="left-white" class="borderdraw"></div>
				<div id="bottom-black" class="borderdraw"></div>
				<div id="bottom-white" class="borderdraw"></div>
				<div id="right-center-black" class="borderdraw"></div>
				<div id="right-center-white" class="borderdraw"></div>
				<div id="right-fill-box" class="borderdraw"></div>
				<div id="right-line" class="borderdraw"></div>

				<?php tha_footer_top(); ?>
				<div id="page-footer" class="clearfix">
						<div id="the-footer-content">
							<?php wp_nav_menu( array(
								'container'			=>	'nav',
								'container_class'	=>	'subnav',
								'theme_location'	=>	'footer-menu',
								'menu_class'		=>	'credits nav nav-pills pull-left',
								'depth'				=>	3,
								'fallback_cb'		=>	'sharonchin_credits',
								'walker'			=>	new SiteMap_Nav_Walker,
							) );
							?>
							<!--<div id="site-generator"<?php echo has_nav_menu('footer-menu') ? ' class="footer-nav-menu"' : ''; ?>>
								<a	href="<?php echo esc_url( __( 'http://wordpress.org/', 'sharonchin' ) ); ?>"
									title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'sharonchin' ); ?>"
									target="_blank"
									rel="generator"><?php printf( _x( 'Proudly powered by %s', 'WordPress', 'sharonchin' ), 'WordPress' ); ?></a>
							</div>-->
						</div><!-- #the-footer-content -->
				</div><!-- #page-footer .well .clearfix -->

				<?php tha_footer_bottom(); ?>
			</footer><!-- #colophon -->
			<?php tha_footer_after(); ?>
		</div><!-- .container -->
	<!-- <?php printf( __( '%d queries. %s seconds.', 'sharonchin' ), get_num_queries(), timer_stop(0, 3) ); ?> -->
	<?php wp_footer(); ?>
	</body>
</html>
<?php


/* End of file footer.php */
/* Location: ./wp-content/themes/sharonchin/footer.php */




















