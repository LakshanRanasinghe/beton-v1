<?php
/**
 * Customer processing order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-processing-order.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 10.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_email_header', $email_heading, $email );

$first_name     = $order->get_billing_first_name();
$order_number   = $order->get_order_number();
$date_created   = wc_format_datetime( $order->get_date_created() );
$payment_method = $order->get_payment_method_title();

// Delivery date and timeslot meta
$delivery_date = $order->get_meta( '_shipping_dayz_date_mapper_date' );
if ( empty( $delivery_date ) ) {
	$delivery_date = $order->get_meta( '_orddd_delivery_date' );
}
if ( empty( $delivery_date ) && isset( $_COOKIE['ddm_selected_date'] ) ) {
	$delivery_date = sanitize_text_field( wp_unslash( $_COOKIE['ddm_selected_date'] ) );
}

$delivery_time = $order->get_meta( '_shipping_dayz_date_mapper_timeslots' );
if ( empty( $delivery_time ) ) {
	$delivery_time = $order->get_meta( '_orddd_time_slot' );
}
if ( empty( $delivery_time ) && isset( $_COOKIE['ddm_selected_timeslots'] ) ) {
	$delivery_time = sanitize_text_field( wp_unslash( $_COOKIE['ddm_selected_timeslots'] ) );
}
?>

<!-- Status Badge & Greeting Hero -->
<div style="text-align: center; margin-bottom: 28px;">
	<table border="0" cellpadding="0" cellspacing="0" align="center" role="presentation" style="margin: 0 auto 16px;">
		<tr>
			<td style="background-color: #DCFCE7; border: 1px solid #BBF7D0; border-radius: 20px; padding: 6px 14px; text-align: center;">
				<span style="font-family: 'Manrope', Arial, sans-serif; font-size: 12px; font-weight: 700; color: #15803D; letter-spacing: 0.05em; text-transform: uppercase;">
					Bestelling in behandeling
				</span>
			</td>
		</tr>
	</table>

	<h1 style="font-family: 'Manrope', Arial, sans-serif; font-size: 26px; font-weight: 800; color: #060C35; line-height: 1.25; margin: 0 0 12px; text-align: center;">
		Bedankt voor uw bestelling!
	</h1>

	<p style="font-family: 'Manrope', Arial, sans-serif; font-size: 15px; color: #475569; line-height: 1.6; margin: 0 auto; max-width: 480px; text-align: center;">
		Beste <?php echo esc_html( $first_name ? $first_name : 'klant' ); ?>, wij hebben uw bestelling succesvol ontvangen. Onze planners gaan direct aan de slag en nemen spoedig contact met u op om de betonlevering af te stemmen.
	</p>
</div>

<!-- Order Quick Summary Card -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation" style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; margin-bottom: 24px;">
	<tr>
		<td style="padding: 16px 20px;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation">
				<tr>
					<td style="padding: 4px 0; font-family: 'Manrope', Arial, sans-serif; font-size: 13px; color: #64748B;">
						Ordernummer:
					</td>
					<td align="right" style="padding: 4px 0; font-family: 'Manrope', Arial, sans-serif; font-size: 14px; font-weight: 700; color: #060C35;">
						#<?php echo esc_html( $order_number ); ?>
					</td>
				</tr>
				<tr>
					<td style="padding: 4px 0; font-family: 'Manrope', Arial, sans-serif; font-size: 13px; color: #64748B;">
						Datum:
					</td>
					<td align="right" style="padding: 4px 0; font-family: 'Manrope', Arial, sans-serif; font-size: 14px; font-weight: 600; color: #1E293B;">
						<?php echo esc_html( $date_created ); ?>
					</td>
				</tr>
				<?php if ( ! empty( $payment_method ) ) : ?>
				<tr>
					<td style="padding: 4px 0; font-family: 'Manrope', Arial, sans-serif; font-size: 13px; color: #64748B;">
						Betaalmethode:
					</td>
					<td align="right" style="padding: 4px 0; font-family: 'Manrope', Arial, sans-serif; font-size: 14px; font-weight: 600; color: #1E293B;">
						<?php echo esc_html( $payment_method ); ?>
					</td>
				</tr>
				<?php endif; ?>
			</table>
		</td>
	</tr>
</table>

<!-- Delivery Date / Timeslot Card (if available) -->
<?php if ( ! empty( $delivery_date ) || ! empty( $delivery_time ) ) : ?>
<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation" style="background-color: #EFF6FF; border: 1px solid #BFDBFE; border-radius: 10px; margin-bottom: 28px;">
	<tr>
		<td style="padding: 16px 20px;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation">
				<tr>
					<td style="vertical-align: top; width: 36px; padding-right: 12px;">
						<span style="font-size: 24px; line-height: 1;">🗓️</span>
					</td>
					<td style="vertical-align: top;">
						<h4 style="margin: 0 0 4px; font-family: 'Manrope', Arial, sans-serif; font-size: 14px; font-weight: 700; color: #1E3A8A; text-transform: uppercase; letter-spacing: 0.05em;">
							Gewenste Leverplanning
						</h4>
						<p style="margin: 0; font-family: 'Manrope', Arial, sans-serif; font-size: 14px; color: #1E40AF; line-height: 1.5;">
							<?php if ( ! empty( $delivery_date ) ) : ?>
								<strong>Datum:</strong> <?php echo esc_html( $delivery_date ); ?><br>
							<?php endif; ?>
							<?php if ( ! empty( $delivery_time ) ) : ?>
								<strong>Tijdslot:</strong> <?php echo esc_html( $delivery_time ); ?><br>
							<?php endif; ?>
							<span style="font-size: 12px; color: #3B82F6; display: inline-block; margin-top: 4px;">
								<em>Onze transporteur bevestigt de definitieve aankomsttijd vooraf telefonisch.</em>
							</span>
						</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php endif; ?>

<!-- Section Title -->
<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation" style="margin-bottom: 16px;">
	<tr>
		<td>
			<h2 style="font-family: 'Manrope', Arial, sans-serif; font-size: 18px; font-weight: 800; color: #060C35; margin: 0;">
				Overzicht van uw bestelling
			</h2>
		</td>
	</tr>
</table>

<?php
/**
 * Hook: woocommerce_email_order_details
 * Shows order items and totals table.
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Hook: woocommerce_email_order_meta
 */
echo '<div class="delivery-date-wrapper">';
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );
echo '</div>';

/**
 * Hook: woocommerce_email_customer_details
 * Shows billing/shipping addresses.
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Hook: woocommerce_email_footer
 */
do_action( 'woocommerce_email_footer', $email );
