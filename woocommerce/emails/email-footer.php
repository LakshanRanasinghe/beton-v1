<?php
/**
 * Email Footer
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-footer.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 10.4.0
 */

defined( 'ABSPATH' ) || exit;

$site_url = home_url( '/' );
$alv_url  = 'https://betonbestellen.nl/alv.pdf';
?>
												</div><!-- /#body_content_inner -->
											</td>
										</tr>
									</table><!-- /#body_content -->
								</td>
							</tr>
						</table><!-- /#template_container -->

						<!-- Modern Footer Outside Card -->
						<table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_footer" role="presentation" style="max-width: 600px; width: 100%; margin: 24px auto 0; text-align: center;">
							<tr>
								<td align="center" valign="top">
									<!-- Customer Support Card -->
									<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation" style="background-color: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 12px; padding: 20px 24px; margin-bottom: 20px; text-align: center;">
										<tr>
											<td align="center">
												<h4 style="margin: 0 0 6px; font-family: 'Manrope', Arial, sans-serif; font-size: 15px; font-weight: 700; color: #060C35; text-align: center;">
													Heeft u vragen over uw bestelling?
												</h4>
												<p style="margin: 0 0 14px; font-family: 'Manrope', Arial, sans-serif; font-size: 13px; color: #64748B; line-height: 1.5; text-align: center;">
													Onze betonadviseurs staan voor u klaar om u te helpen.
												</p>
												<table border="0" cellpadding="0" cellspacing="0" align="center" role="presentation">
													<tr>
														<td style="padding: 0 14px;">
															<a href="tel:0854831710" style="color: #060C35; font-family: 'Manrope', Arial, sans-serif; font-size: 13px; font-weight: 700; text-decoration: none;">
																📞 085-4831710
															</a>
														</td>
														<td style="padding: 0 14px;">
															<a href="mailto:info@betonbestellen.nl" style="color: #060C35; font-family: 'Manrope', Arial, sans-serif; font-size: 13px; font-weight: 700; text-decoration: none;">
																✉️ info@betonbestellen.nl
															</a>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>

									<!-- Google Review Card -->
									<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation" style="background-color: #FFF7ED; border: 1px solid #FFEDD5; border-radius: 8px; padding: 12px 18px; margin-bottom: 20px; text-align: center;">
										<tr>
											<td align="center">
												<a href="https://g.page/r/CcvazzN6aWu0EAI/review" target="_blank" style="color: #C2410C; font-family: 'Manrope', Arial, sans-serif; font-size: 13px; font-weight: 600; text-decoration: none;">
													⭐ Tevreden met onze service? <span style="text-decoration: underline;">Schrijf een Google review</span>
												</a>
											</td>
										</tr>
									</table>

									<!-- Legal & Company Links -->
									<p style="margin: 0 0 8px; font-family: 'Manrope', Arial, sans-serif; font-size: 12px; color: #94A3B8; line-height: 1.6;">
										<a href="<?php echo esc_url( $site_url ); ?>" style="color: #64748B; text-decoration: none; font-weight: 600;">Betonbestellen.nl</a> &bull;
										<a href="<?php echo esc_url( $alv_url ); ?>" target="_blank" style="color: #64748B; text-decoration: none; font-weight: 600;">Algemene Voorwaarden</a> &bull;
										<a href="<?php echo esc_url( home_url( '/privacybeleid' ) ); ?>" style="color: #64748B; text-decoration: none; font-weight: 600;">Privacybeleid</a>
									</p>

									<p style="margin: 0; font-family: 'Manrope', Arial, sans-serif; font-size: 11px; color: #94A3B8; line-height: 1.5;">
										&copy; <?php echo esc_html( date( 'Y' ) ); ?> BetonBestellen.nl BV. Alle rechten voorbehouden.
									</p>
								</td>
							</tr>
						</table><!-- /#template_footer -->

					</div><!-- /#wrapper -->
				</td>
			</tr>
		</table><!-- /#outer_wrapper -->
	</body>
</html>
