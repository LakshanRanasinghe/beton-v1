<?php
/**
 * Order details table shown in emails.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-details.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 10.4.0
 */

use Automattic\WooCommerce\Utilities\FeaturesUtil;

defined( 'ABSPATH' ) || exit;

$text_align = is_rtl() ? 'right' : 'left';
$email_improvements_enabled = FeaturesUtil::feature_is_enabled( 'email_improvements' );

if ( $email_improvements_enabled ) {
	add_filter( 'woocommerce_order_shipping_to_display_shipped_via', '__return_false' );
}

do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email );
?>

<div style="margin-bottom: 28px;">

	<!-- Main Order Items & Totals Table Container -->
	<table cellspacing="0" cellpadding="0" border="0" width="100%" role="presentation" style="width: 100%; border-collapse: separate; border-spacing: 0; border: 1px solid #E2E8F0; border-radius: 10px; overflow: hidden; font-family: 'Manrope', Arial, sans-serif; background-color: #FFFFFF;">
		
		<!-- Table Header -->
		<thead>
			<tr style="background-color: #F8FAFC;">
				<th scope="col" style="text-align: <?php echo esc_attr( $text_align ); ?>; padding: 12px 18px; font-family: 'Manrope', Arial, sans-serif; font-size: 12px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #E2E8F0;">
					<?php esc_html_e( 'Product', 'woocommerce' ); ?>
				</th>
				<th scope="col" style="text-align: right; padding: 12px 16px; font-family: 'Manrope', Arial, sans-serif; font-size: 12px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #E2E8F0; width: 80px;">
					<?php esc_html_e( 'Aantal', 'woocommerce' ); ?>
				</th>
				<th scope="col" style="text-align: right; padding: 12px 18px; font-family: 'Manrope', Arial, sans-serif; font-size: 12px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #E2E8F0; width: 110px;">
					<?php esc_html_e( 'Totaal', 'woocommerce' ); ?>
				</th>
			</tr>
		</thead>

		<!-- Table Items -->
		<tbody>
			<?php
			echo wc_get_email_order_items(
				$order,
				array(
					'show_sku'      => $sent_to_admin,
					'show_image'    => false,
					'image_size'    => array( 32, 32 ),
					'plain_text'    => $plain_text,
					'sent_to_admin' => $sent_to_admin,
				)
			);
			?>
		</tbody>

		<!-- Table Totals -->
		<tfoot>
			<?php
			$item_totals = $order->get_order_item_totals();

			if ( $item_totals ) {
				$i = 0;
				$total_rows = count( $item_totals );

				foreach ( $item_totals as $key => $total ) {
					$i++;
					$is_grand_total = ( 'order_total' === $key || $i === $total_rows );
					?>
					<tr style="<?php echo $is_grand_total ? 'background-color: #FFF7ED;' : 'background-color: #F8FAFC;'; ?>">
						<th scope="row" colspan="2" style="text-align: left; padding: <?php echo $is_grand_total ? '14px 18px' : '11px 18px'; ?>; font-family: 'Manrope', Arial, sans-serif; font-size: <?php echo $is_grand_total ? '15px' : '13px'; ?>; font-weight: <?php echo $is_grand_total ? '800' : '600'; ?>; color: #060C35; border-top: <?php echo $is_grand_total ? '2px solid #FDBA74' : '1px solid #E2E8F0'; ?>;">
							<?php echo wp_kses_post( $total['label'] ); ?>
						</th>
						<td style="text-align: right; padding: <?php echo $is_grand_total ? '14px 18px' : '11px 18px'; ?>; font-family: 'Manrope', Arial, sans-serif; font-size: <?php echo $is_grand_total ? '17px' : '13px'; ?>; font-weight: <?php echo $is_grand_total ? '800' : '600'; ?>; color: <?php echo $is_grand_total ? '#C2410C' : '#1E293B'; ?>; border-top: <?php echo $is_grand_total ? '2px solid #FDBA74' : '1px solid #E2E8F0'; ?>;">
							<?php echo wp_kses_post( $total['value'] ); ?>
						</td>
					</tr>
					<?php
				}
			}
			?>
		</tfoot>

	</table>

	<!-- Customer Note Callout (if present) -->
	<?php if ( $order->get_customer_note() ) : ?>
	<table cellspacing="0" cellpadding="0" border="0" width="100%" role="presentation" style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; margin-top: 16px;">
		<tr>
			<td style="padding: 14px 18px;">
				<strong style="color: #060C35; font-family: 'Manrope', Arial, sans-serif; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.04em;">
					💬 <?php esc_html_e( 'Opmerking bij uw bestelling:', 'woocommerce' ); ?>
				</strong>
				<p style="margin: 6px 0 0; color: #475569; font-family: 'Manrope', Arial, sans-serif; font-size: 14px; line-height: 1.5;">
					<?php echo wp_kses( nl2br( wc_wptexturize_order_note( $order->get_customer_note() ) ), array( 'br' => array() ) ); ?>
				</p>
			</td>
		</tr>
	</table>
	<?php endif; ?>

</div>

<?php
if ( $email_improvements_enabled ) {
	remove_filter( 'woocommerce_order_shipping_to_display_shipped_via', '__return_false' );
}

do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email );
