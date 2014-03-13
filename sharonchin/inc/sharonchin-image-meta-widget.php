<?php
/** sharonchin-image-meta-widget.php
 *
 * @author	Konstantin Obenland
 * @package	Sharon Chin Theme
 * @since	1.1.0 - 08.03.2012
 */


class SharonChin_Image_Meta_Widget extends WP_Widget {


	///////////////////////////////////////////////////////////////////////////
	// METHODS, PUBLIC
	///////////////////////////////////////////////////////////////////////////
	
	/**
	 * Constructor
	 *
	 * @author	Konstantin Obenland
	 * @since	1.1.0 - 08.03.2012
	 * @access	public
	 *
	 * @return	SharonChin_Image_Meta_Widget
	 */
	public function __construct() {
		
		parent::__construct( 'sharonchin-image-meta', __( 'Sharon Chin Theme Image Meta Widget', 'sharonchin' ), array(
			'classname'		=>	'sharonchin-image-meta',
			'description'	=>	__( 'Displays meta information on image attachment pages', 'sharonchin' )
		) );
	}


	/**
	 * Displays the widget content
	 *
	 * @author	Konstantin Obeland
	 * @since	1.1.0 - 08.03.2012
	 * @access	public
	 *
	 * @param	array	$args
	 * @param	array	$instance
	 *
	 * @return	void
	 */
	public function widget( $args, $instance ) {
		
		if ( is_attachment() ) {
			extract( $args );
			
			$title		=	apply_filters( 'widget_title', empty($instance['title'] ) ? __( 'Info', 'sharonchin' ) : $instance['title'] );
			$image_meta	=	wp_get_attachment_metadata();
			
			echo $before_widget . $before_title . $title . $after_title;
			
			?>
			<dl class="dl-horizontal">
				<?php if ( $image_meta['image_meta']['created_timestamp'] ) : ?>
				<dt><?php _e( 'Created:', 'sharonchin' ); ?></dt>
				<dd><?php echo date_i18n( get_option( 'date_format' ), $image_meta['image_meta']['created_timestamp'] ); ?></dd>
				<?php endif; ?>
				
				<dt><?php _e( 'Full size:', 'sharonchin' ); ?></dt>
				<dd><?php echo wp_get_attachment_link( '', 'full', false, false, sprintf(__( '%s pixels', 'sharonchin' ), $image_meta['width'] . ' &times; ' . $image_meta['height'] ) ); ?></dd>
				
				<?php if ( $image_meta['image_meta']['aperture'] ) : ?>
				<dt><?php _e( 'Aperture:', 'sharonchin' ); ?></dt>
				<dd>f/<?php echo $image_meta['image_meta']['aperture']; ?></dd>
				<?php endif;
				
				if ( $image_meta['image_meta']['focal_length'] ) : ?>
				<dt><?php _e( 'Focal length:', 'sharonchin' ); ?></dt>
				<dd><?php echo $image_meta['image_meta']['focal_length']; ?> mm</dd>
				<?php endif;
				
				if ( $image_meta['image_meta']['iso'] ): ?>
				<dt><?php _e( 'Iso:', 'sharonchin' ); ?></dt>
				<dd><?php echo $image_meta['image_meta']['iso']; ?></dd>
				<?php endif;
				
				if ( $image_meta['image_meta']['shutter_speed'] ) : ?>
				<dt><?php _e( 'Shutter:', 'sharonchin' ); ?></dt>
				<dd>
				<?php
					// shutter speed handler
					if ( ( 1 / $image_meta['image_meta']['shutter_speed'] ) > 1 ) {
					echo "1/";
						if ( number_format_i18n( ( 1 / $image_meta['image_meta']['shutter_speed'] ), 1 ) ==  number_format_i18n( ( 1 / $image_meta['image_meta']['shutter_speed'] ), 0 ) ) {
							printf( __( '%d sec.', 'sharonchin' ), number_format_i18n( ( 1 / $image_meta['image_meta']['shutter_speed'] ), 0, '.', '' ) );
						} else {
							printf( __( '%d sec.', 'sharonchin' ), number_format_i18n( ( 1 / $image_meta['image_meta']['shutter_speed'] ), 1, '.', '' ) );
						}
					} else {
						printf( __( '%d sec.', 'sharonchin' ), number_format_i18n( $image_meta['image_meta']['shutter_speed'] ) );
					}
				 ?>
				</dd>
				<?php endif;
				
				if ( trim( $image_meta['image_meta']['camera'], '<,>' ) ) : ?>
				<dt><?php _e( 'Camera:', 'sharonchin' ); ?></dt>
				<dd><?php echo trim( $image_meta['image_meta']['camera'], '<,>' ); ?></dd>
				<?php endif; ?>
				
			</dl>
			<?php
			
			echo $after_widget;
		}
	}

	
	/**
	 * Updates the widget settings
	 *
	 * @author	Konstantin Obenland
	 * @since	1.1.0 - 08.03.2012
	 * @access	public
	 *
	 * @param	array	$new_instance
	 * @param	array	$old_instance
	 *
	 * @return	array
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance			=	$old_instance;
		$instance['title']	=	strip_tags( $new_instance['title'] );

		return $instance;
	}

	
	/**
	 * Displays the widget's settings form
	 *
	 * @author	Konstantin Obenland
	 * @since	1.1.0 - 08.03.2012
	 * @access	public
	 *
	 * @param	array	$instance
	 *
	 * @return	void
	 */
	public function form( $instance ) {
		$instance	=	wp_parse_args( (array) $instance, array(
			'title'	=>	'',
		) );
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'sharonchin' ); ?>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</label></p>
		<?php
	}
} // End of class SharonChin_Image_Meta_Widget



/* End of file sharonchin-image-meta-widget.php */
/* Location: ./wp-content/themes/sharonchin/sharonchin-image-meta-widget.php */