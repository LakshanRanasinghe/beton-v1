<?php
/**
 * Email Header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-header.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 10.4.0
 */

use Automattic\WooCommerce\Utilities\FeaturesUtil;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$email_improvements_enabled = FeaturesUtil::feature_is_enabled( 'email_improvements' );
$store_name                 = $store_name ?? get_bloginfo( 'name', 'display' );

// Default fallback logo if not customized in WooCommerce settings
$logo_img = get_option( 'woocommerce_email_header_image' );
if ( empty( $logo_img ) ) {
	$logo_img = get_template_directory_uri() . '/images/beton-bestellen-white.png';
}

if ( apply_filters( 'woocommerce_is_email_preview', false ) ) {
	$img_transient = get_transient( 'woocommerce_email_header_image' );
	$logo_img      = false !== $img_transient ? $img_transient : $logo_img;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<meta name="x-apple-disable-message-reformatting">
		<title><?php echo esc_html( $store_name ); ?></title>
		<!--[if mso]>
		<noscript>
			<xml>
				<o:OfficeDocumentSettings>
					<o:PixelsPerInch>96</o:PixelsPerInch>
				</o:OfficeDocumentSettings>
			</xml>
		</noscript>
		<![endif]-->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
		<style>
			@media only screen and (max-width: 600px) {
				.email-card { width: 100% !important; border-radius: 0 !important; }
				.content-cell { padding: 24px 16px !important; }
				.address-col { display: block !important; width: 100% !important; margin-bottom: 16px !important; }
			}
		</style>
	</head>
	<body <?php echo is_rtl() ? 'rightmargin' : 'leftmargin'; ?>="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="margin: 0; padding: 0; background-color: #F4F6F8; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%;">
		<table width="100%" id="outer_wrapper" role="presentation" border="0" cellpadding="0" cellspacing="0" style="background-color: #F4F6F8; width: 100%; margin: 0; padding: 32px 0;">
			<tr>
				<td align="center" valign="top">
					<div id="wrapper" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>" style="max-width: 600px; width: 100%; margin: 0 auto;">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_container" class="email-card" role="presentation" style="background-color: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(6, 12, 53, 0.04); width: 100%; max-width: 600px;">
							<!-- Header -->
							<tr>
								<td align="center" valign="top" style="background-color: #060C35; padding: 28px 24px 24px; text-align: center; border-bottom: 3px solid #FCA01A;">
									<?php if ( ! empty( $logo_img ) ) : ?>
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank" style="text-decoration: none; display: inline-block;">
											<img src="<?php echo esc_url( $logo_img ); ?>" alt="<?php echo esc_attr( $store_name ); ?>" width="200" style="max-width: 200px; width: 200px; height: auto; border: 0; display: block; margin: 0 auto;" />
										</a>
									<?php else : ?>
										<h2 style="color: #FFFFFF; font-family: 'Manrope', Arial, sans-serif; font-size: 24px; font-weight: 800; margin: 0; letter-spacing: -0.5px;">
											<?php echo esc_html( $store_name ); ?>
										</h2>
									<?php endif; ?>
								</td>
							</tr>
							<!-- End Header -->

							<!-- Optional Email Heading Bar -->
							<?php if ( ! empty( $email_heading ) ) : ?>
							<tr>
								<td id="header_wrapper" align="center" valign="top" style="background-color: #0A1344; padding: 14px 24px; text-align: center;">
									<span style="color: #F8FAFC; font-family: 'Manrope', Arial, sans-serif; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; display: inline-block;">
										<?php echo esc_html( $email_heading ); ?>
									</span>
								</td>
							</tr>
							<?php endif; ?>

							<!-- Body -->
							<tr>
								<td align="center" valign="top" id="template_body" style="background-color: #FFFFFF;">
									<table border="0" cellpadding="0" cellspacing="0" width="100%" id="body_content" role="presentation">
										<tr>
											<td valign="top" id="body_content_inner_cell" class="content-cell" style="padding: 32px 32px 24px;">
												<div id="body_content_inner" style="color: #334155; font-family: 'Manrope', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; font-size: 15px; line-height: 1.6; text-align: left;">
