<?php
/**
 * Single Product Image
 *
 * @author		Roberto Ulloa
 * @package		Sharon Chin Theme
 * @since		3.0.0 - 13.03.2014
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

?>
<div class="images">

		<div id="archive-gallery" class="gallery-container">

			<div id="gallery-slider" class="carousel slide" data-interval="false" >
				<!-- Carousel items -->
				<div class="carousel-inner">
					<?php $i = 0; foreach ( $attachment_ids as $attachment_id ): ?>
					<figure class="item">
						<?php 
						$image_title 	= esc_attr( get_the_title( $attachment_id ) );
						echo wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
							'title' => $image_title
						) );
						?>
					</figure>
					<?php endforeach; ?>
				</div>
			</div><!-- #gallery-slider -->
		</div><!-- #gallery-container -->


</div>
	<?php do_action( 'woocommerce_product_thumbnails' ); ?>
