<?php
/**
 * Email Order Items
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-items.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 10.4.0
 */

use Automattic\WooCommerce\Utilities\FeaturesUtil;

defined( 'ABSPATH' ) || exit;

$margin_side = is_rtl() ? 'left' : 'right';
$email_improvements_enabled = FeaturesUtil::feature_is_enabled( 'email_improvements' );
$hidden_meta = array(
	'Vlinderbeton',
	'Hoge Sterkte',
	'Hoog Vloeibaar',
	'raw_concrete_value',
	'raw_hidden_concrete_qty_value',
	'raw_pumping_value'
);

foreach ( $items as $item_id => $item ) :
	$product       = $item->get_product();
	$sku           = '';
	$purchase_note = '';
	$image         = '';

	if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
		continue;
	}

	if ( is_object( $product ) ) {
		$sku           = $product->get_sku();
		$purchase_note = $product->get_purchase_note();
		$image         = $product->get_image( $image_size );
	}

	$order_item_name = apply_filters( 'woocommerce_order_item_name', $item->get_name(), $item, false );
	$qty             = $item->get_quantity();
	$refunded_qty    = $order->get_qty_refunded_for_item( $item_id );
	if ( $refunded_qty ) {
		$qty_display = '<del>' . esc_html( $qty ) . '</del> <ins>' . esc_html( $qty - ( $refunded_qty * -1 ) ) . '</ins>';
	} else {
		$qty_display = esc_html( $qty );
	}
	$formatted_subtotal = $order->get_formatted_line_subtotal( $item );
	?>
	<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>" style="border-bottom: 1px solid #F1F5F9;">
		<!-- Product Details & Specs -->
		<td style="padding: 16px 18px; vertical-align: top; font-family: 'Manrope', Arial, sans-serif; text-align: left;">
			<div style="font-size: 15px; font-weight: 700; color: #060C35; line-height: 1.4; margin-bottom: 4px;">
				<?php echo wp_kses_post( $order_item_name ); ?>
				<?php if ( $show_sku && $sku ) : ?>
					<span style="font-size: 12px; font-weight: 500; color: #94A3B8;">(<?php echo esc_html( $sku ); ?>)</span>
				<?php endif; ?>
			</div>

			<?php
			do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, $plain_text );

			$meta_data = $item->get_formatted_meta_data();
			if ( ! empty( $meta_data ) ) :
				?>
				<table border="0" cellpadding="0" cellspacing="0" style="margin-top: 8px; width: 100%; border-collapse: collapse;" role="presentation">
					<?php
					foreach ( $meta_data as $meta ) {
						$key = trim( $meta->display_key );

						// Skip internal or technical keys
						if ( in_array( $key, $hidden_meta, true ) || str_starts_with( $key, '_' ) || str_starts_with( $key, 'raw_' ) ) {
							continue;
						}

						$value = wp_kses_post( $meta->display_value );
						$value = preg_replace( '/<\/?p[^>]*>/', '', $value );
						?>
						<tr>
							<td style="padding: 3px 0; font-family: 'Manrope', Arial, sans-serif; font-size: 13px; color: #64748B; vertical-align: top; line-height: 1.5;">
								<span style="color: #060C35; font-weight: 600;"><?php echo esc_html( $meta->display_key ); ?>:</span>
								<span style="color: #334155;"><?php echo $value; ?></span>
							</td>
						</tr>
						<?php
					}
					?>
				</table>
				<?php
			endif;

			do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, $plain_text );
			?>
		</td>

		<!-- Quantity -->
		<td align="right" style="padding: 16px 16px; vertical-align: top; font-family: 'Manrope', Arial, sans-serif; font-size: 14px; font-weight: 600; color: #475569; text-align: right; white-space: nowrap;">
			<span style="display: inline-block; background-color: #F1F5F9; border-radius: 6px; padding: 4px 10px; font-size: 13px; font-weight: 700; color: #1E293B;">
				&times; <?php echo wp_kses_post( apply_filters( 'woocommerce_email_order_item_quantity', $qty_display, $item ) ); ?>
			</span>
		</td>

		<!-- Price Subtotal -->
		<td align="right" style="padding: 16px 18px; vertical-align: top; font-family: 'Manrope', Arial, sans-serif; font-size: 14px; font-weight: 700; color: #060C35; text-align: right; white-space: nowrap;">
			<?php echo wp_kses_post( $formatted_subtotal ); ?>
		</td>
	</tr>

	<?php if ( $show_purchase_note && $purchase_note ) : ?>
	<tr>
		<td colspan="3" style="padding: 12px 18px; background-color: #F8FAFC; border-bottom: 1px solid #E2E8F0; font-family: 'Manrope', Arial, sans-serif; font-size: 13px; color: #475569;">
			<?php echo wp_kses_post( wpautop( do_shortcode( $purchase_note ) ) ); ?>
		</td>
	</tr>
	<?php endif; ?>

<?php endforeach; ?>
