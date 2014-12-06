<?php
/** searchform.php
 *
 * The template for displaying search forms
 *
 * @author		Konstantin Obenland
 * @package		Sharon Chin Theme
 * @since		1.0.0 - 07.02.2012
 */
?>
<form method="get" id="searchform" class="form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="s" class="assistive-text hidden"><?php _e( 'Search', 'sharonchin' ); ?></label>
	<div class="input-append">
		<input id="s" class="span2 search-query" type="search" name="s" placeholder="<?php esc_attr_e( 'Search', 'sharonchin' ); ?>"><!--
	 --><button class="btn btn-primary" name="submit" id="searchsubmit" type="submit"><?php _e( 'Go', 'sharonchin' ); ?></button>
   	</div>
</form>
<?php


/* End of file searchform.php */
/* Location: ./wp-content/themes/sharonchin/searchform.php */