<?php
/**
 * Email Styles
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-styles.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 10.4.0
 */

defined( 'ABSPATH' ) || exit;

// Brand Color Palette
$bg              = '#F4F6F8';
$body            = '#FFFFFF';
$base            = '#060C35'; // Deep brand navy
$base_text       = '#1E293B'; // Charcoal primary text
$text            = '#334155'; // Slate body text
$muted_text      = '#64748B'; // Muted labels
$accent          = '#FCA01A'; // Vibrant brand orange
$accent_light    = '#FFF7ED';
$accent_border   = '#FFEDD5';
$border_color    = '#E2E8F0';
$table_header_bg = '#F8FAFC';
$font_family     = "'Manrope', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif";

?>
body {
	background-color: <?php echo esc_attr( $bg ); ?>;
	padding: 0;
	margin: 0;
	-webkit-text-size-adjust: 100%;
	-ms-text-size-adjust: 100%;
}

#wrapper {
	background-color: <?php echo esc_attr( $bg ); ?>;
	margin: 0;
	padding: 32px 16px;
	-webkit-text-size-adjust: none !important;
	width: 100%;
	font-family: <?php echo $font_family; ?>;
}

#outer_wrapper {
	background-color: <?php echo esc_attr( $bg ); ?>;
}

#template_container {
	background-color: <?php echo esc_attr( $body ); ?>;
	border: 1px solid <?php echo esc_attr( $border_color ); ?>;
	border-radius: 12px;
	overflow: hidden;
	max-width: 600px;
	width: 100%;
	margin: 0 auto;
	box-shadow: 0 4px 20px rgba(6, 12, 53, 0.04);
}

#template_header {
	background-color: <?php echo esc_attr( $base ); ?>;
	color: #ffffff;
	border-bottom: 3px solid <?php echo esc_attr( $accent ); ?>;
	text-align: center;
}

#template_header_image {
	background-color: <?php echo esc_attr( $base ); ?>;
	padding: 26px 24px 20px !important;
	text-align: center;
}

#template_header_image p {
	margin: 0 !important;
	text-align: center;
}

#template_header_image img {
	max-width: 200px !important;
	height: auto !important;
	display: inline-block;
}

#header_wrapper {
	padding: 0 24px 20px;
	display: block;
	text-align: center;
}

#header_wrapper h1 {
	color: #ffffff;
	font-family: <?php echo $font_family; ?>;
	font-size: 24px;
	font-weight: 700;
	line-height: 1.3;
	margin: 0;
	text-shadow: none;
}

#template_body {
	background-color: <?php echo esc_attr( $body ); ?>;
}

#body_content {
	background-color: <?php echo esc_attr( $body ); ?>;
}

#body_content table td {
	padding: 0;
}

#body_content_inner_cell {
	padding: 32px 32px 24px !important;
}

#body_content_inner {
	color: <?php echo esc_attr( $text ); ?>;
	font-family: <?php echo $font_family; ?>;
	font-size: 15px;
	line-height: 1.6;
	text-align: left;
}

h1, h2, h3, h4, h5, h6 {
	color: <?php echo esc_attr( $base ); ?>;
	font-family: <?php echo $font_family; ?>;
	font-weight: 700;
	line-height: 1.3;
	margin: 0 0 16px;
	text-align: left;
}

h1 {
	font-size: 24px;
}

h2 {
	font-size: 20px;
	color: <?php echo esc_attr( $base ); ?>;
}

h3 {
	font-size: 16px;
}

p {
	margin: 0 0 16px;
	color: <?php echo esc_attr( $text ); ?>;
	font-size: 15px;
	line-height: 1.6;
}

a {
	color: <?php echo esc_attr( $base ); ?>;
	font-weight: 600;
	text-decoration: underline;
}

a:hover {
	color: <?php echo esc_attr( $accent ); ?>;
}

/* Order items & details tables */
table.email-order-details {
	width: 100%;
	border-collapse: separate;
	border-spacing: 0;
	margin-bottom: 24px;
	border: 1px solid <?php echo esc_attr( $border_color ); ?>;
	border-radius: 8px;
	overflow: hidden;
}

table.email-order-details thead tr {
	background-color: <?php echo esc_attr( $table_header_bg ); ?>;
	border-bottom: 1px solid <?php echo esc_attr( $border_color ); ?>;
}

table.email-order-details th {
	color: <?php echo esc_attr( $muted_text ); ?>;
	font-family: <?php echo $font_family; ?>;
	font-size: 12px;
	font-weight: 700;
	text-transform: uppercase;
	letter-spacing: 0.05em;
	padding: 12px 16px;
	border-bottom: 1px solid <?php echo esc_attr( $border_color ); ?>;
}

table.email-order-details td {
	padding: 14px 16px;
	font-size: 14px;
	color: <?php echo esc_attr( $text ); ?>;
	border-bottom: 1px solid <?php echo esc_attr( $border_color ); ?>;
	vertical-align: top;
}

.order-item-name {
	font-weight: 700;
	color: <?php echo esc_attr( $base ); ?>;
	font-size: 15px;
	margin-bottom: 6px;
}

.email-order-item-meta {
	font-size: 13px;
	line-height: 1.6;
	color: <?php echo esc_attr( $muted_text ); ?>;
	margin-top: 6px;
}

.email-order-item-meta span:first-child {
	color: <?php echo esc_attr( $base ); ?>;
	font-weight: 600;
}

.email-order-item-meta span:last-child {
	color: <?php echo esc_attr( $text ); ?>;
}

/* Totals table rows */
tr.order-totals th {
	background-color: <?php echo esc_attr( $table_header_bg ); ?>;
	color: <?php echo esc_attr( $base ); ?>;
	font-weight: 600;
	font-size: 14px;
	padding: 12px 16px;
	border-bottom: 1px solid <?php echo esc_attr( $border_color ); ?>;
}

tr.order-totals td {
	background-color: <?php echo esc_attr( $table_header_bg ); ?>;
	font-weight: 600;
	font-size: 14px;
	color: <?php echo esc_attr( $base ); ?>;
	padding: 12px 16px;
	border-bottom: 1px solid <?php echo esc_attr( $border_color ); ?>;
}

tr.order-totals-grand th {
	background-color: <?php echo esc_attr( $accent_light ); ?> !important;
	color: <?php echo esc_attr( $base ); ?> !important;
	font-size: 16px !important;
	font-weight: 800 !important;
	padding: 14px 16px !important;
	border-bottom: none !important;
}

tr.order-totals-grand td {
	background-color: <?php echo esc_attr( $accent_light ); ?> !important;
	color: <?php echo esc_attr( $accent ); ?> !important;
	font-size: 18px !important;
	font-weight: 800 !important;
	padding: 14px 16px !important;
	border-bottom: none !important;
}

/* Customer address cards */
#addresses {
	width: 100%;
	margin-top: 24px;
	margin-bottom: 24px;
	border-collapse: separate;
	border-spacing: 12px 0;
}

#addresses td {
	vertical-align: top;
	padding: 0;
	width: 50%;
}

#addresses .address-title {
	display: block;
	font-size: 14px;
	font-weight: 700;
	color: <?php echo esc_attr( $base ); ?>;
	margin-bottom: 8px;
	text-transform: uppercase;
	letter-spacing: 0.04em;
}

#addresses address {
	border: 1px solid <?php echo esc_attr( $border_color ); ?> !important;
	border-radius: 8px !important;
	padding: 16px !important;
	background-color: <?php echo esc_attr( $table_header_bg ); ?> !important;
	font-style: normal !important;
	line-height: 1.6 !important;
	min-height: 110px;
	color: <?php echo esc_attr( $text ); ?> !important;
	font-size: 14px !important;
}

#addresses address a {
	color: <?php echo esc_attr( $base ); ?>;
	text-decoration: none;
}

/* Delivery callout badge */
.delivery-date-card {
	background: #F0FDF4;
	border: 1px solid #BBF7D0;
	border-radius: 8px;
	padding: 16px 20px;
	margin: 20px 0 24px;
}

.delivery-date-card-title {
	color: #166534;
	font-size: 15px;
	font-weight: 700;
	margin-bottom: 6px;
}

.delivery-date-card-desc {
	color: #15803D;
	font-size: 14px;
	margin: 0;
	line-height: 1.5;
}

/* Attention points callout */
.attention-card {
	background: <?php echo esc_attr( $accent_light ); ?>;
	border: 1px solid <?php echo esc_attr( $accent_border ); ?>;
	border-radius: 8px;
	padding: 16px 20px;
	margin: 20px 0;
}

.attention-card h4 {
	color: #9A3412;
	font-size: 14px;
	font-weight: 700;
	margin: 0 0 8px;
}

.attention-card ul {
	margin: 0;
	padding-left: 20px;
	color: #9A3412;
	font-size: 13px;
	line-height: 1.6;
}

.attention-card li {
	margin-bottom: 6px;
}

/* Primary CTA Button */
.btn-primary {
	display: inline-block;
	background-color: <?php echo esc_attr( $accent ); ?>;
	color: #ffffff !important;
	font-family: <?php echo $font_family; ?>;
	font-size: 15px;
	font-weight: 700;
	line-height: 1;
	text-decoration: none !important;
	padding: 14px 28px;
	border-radius: 8px;
	text-align: center;
	border: none;
	cursor: pointer;
}

.btn-primary:hover {
	background-color: #E28C10;
}

/* Email Footer */
#template_footer {
	background-color: <?php echo esc_attr( $bg ); ?>;
	padding: 24px 16px 36px;
	text-align: center;
}

#template_footer table {
	max-width: 600px;
	width: 100%;
	margin: 0 auto;
}

#template_footer td {
	text-align: center;
	padding: 0;
}

.footer-support {
	background: #FFFFFF;
	border: 1px solid <?php echo esc_attr( $border_color ); ?>;
	border-radius: 12px;
	padding: 20px 24px;
	margin-bottom: 20px;
	text-align: center;
}

.footer-support-title {
	font-size: 15px;
	font-weight: 700;
	color: <?php echo esc_attr( $base ); ?>;
	margin-bottom: 6px;
}

.footer-support-text {
	font-size: 13px;
	color: <?php echo esc_attr( $muted_text ); ?>;
	margin-bottom: 12px;
}

.footer-contact-links {
	font-size: 13px;
	color: <?php echo esc_attr( $base ); ?>;
}

.footer-contact-links a {
	color: <?php echo esc_attr( $base ); ?>;
	text-decoration: none;
	font-weight: 600;
	margin: 0 8px;
}

.footer-credit {
	font-size: 12px;
	color: <?php echo esc_attr( $muted_text ); ?>;
	line-height: 1.6;
	margin-top: 16px;
}

.footer-credit a {
	color: <?php echo esc_attr( $muted_text ); ?>;
	text-decoration: underline;
	font-weight: 500;
}

@media screen and (max-width: 600px) {
	#template_container {
		width: 100% !important;
		border-radius: 0 !important;
		border-left: none !important;
		border-right: none !important;
	}
	#body_content_inner_cell {
		padding: 24px 16px 20px !important;
	}
	#addresses td {
		display: block !important;
		width: 100% !important;
		margin-bottom: 16px !important;
	}
	#addresses {
		border-spacing: 0 !important;
	}
}
