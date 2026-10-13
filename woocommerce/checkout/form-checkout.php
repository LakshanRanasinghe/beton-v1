<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (!defined('ABSPATH')) {
	exit;
}

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
	echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
	return;
}

?>

<div class="bpc-checkout-page">
	<div class="container p-0">
		<div class="row g-4 align-items-start bpc-main-row">

			<form name="checkout" method="post" class="checkout woocommerce-checkout row p-0"
				action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

				<!-- ══════ LEFT: CHECKOUT FORM ══════ -->
				<div class="col-lg-8 px-md-0">
					<div class="bpc-form-card">
						<?php if ($checkout->get_checkout_fields()): ?>
							<?php do_action('woocommerce_checkout_before_customer_details'); ?>

							<div class="bpc-form-section">
								<div class="bpc-form-section-head">
									<span class="bpc-form-section-title">Bedrijfsgegevens (Optioneel)</span>
									<span class="bpc-form-section-hr"></span>
								</div>

								<div class="checkout-personal-info-fields">
									<div class="form-row mb-2">
										<label class="label fs-lg" l10ntranslate="">Besteltype</label>
										<div class="d-if">
											<label data-tab="order-type-radio-1" for="order-type-private" l10ntranslate=""
												class="is_active">
												<input class="mr-1r ng-untouched ng-pristine ng-valid"
													formcontrolname="custom_order_type" id="order-type-private"
													name="custom_order_type" type="radio" value="0" checked>&nbsp; Privé
											</label> &nbsp;&nbsp;
											<label data-tab="order-type-radio-2" for="order-type-business" l10ntranslate="">
												<input formcontrolname="custom_order_type" id="order-type-business"
													name="custom_order_type" type="radio" value="1"
													class="ng-untouched ng-pristine ng-valid px-pixel-10">&nbsp; Bedrijf
											</label>
										</div>
									</div>
									<p class="form-row d-none" id="custom_company_field">
										<!-- <label for="custom_company" class="">Bedrijfsnaam&nbsp;</label> -->
										<span class="woocommerce-input-wrapper">
											<input type="text" class="input-text px-pixel-10 " name="custom_company"
												id="custom_company" placeholder="Bedrijfsnaam" value=""
												autocomplete="organization">
										</span>
										<span id="custom_company_error" class="text-danger text-12 d-none">Voer uw bedrijfsnaam
											in.</span>
									</p>

									<p class="form-row validate-eu-vat-number d-none" id="custom_eu_vat_number_field"
										data-priority="200">
										<!-- <label for="custom_eu_vat_number" class="">EU BTW-nummer</label> -->
										<span class="woocommerce-input-wrapper">
											<input type="text" class="input-text" name="custom_eu_vat_number"
												id="custom_eu_vat_number" value="" placeholder="EU BTW-nummer">
										</span><span id="custom_eu_vat_number_error" class="text-danger text-12 d-none">Het
											veld
											"EU BTW-nummer" is verplicht.</span>
									</p>

									<p class="form-row form-row-first validate-required" id="custom_first_name_field">
										<!-- <label for="custom_first_name" class="">Voornaam&nbsp;<abbr class="required"
												title="vereist">*</abbr></label> -->
										<span class="woocommerce-input-wrapper">
											<input type="text" class="input-text px-pixel-10" name="custom_first_name"
												id="custom_first_name" placeholder="Voornaam *" value=""
												aria-required="true" autocomplete="given-name" required>
										</span><span id="custom_first_name_error" class="text-danger text-12 d-none">Voer
											uw
											voornaam in.</span>
									</p>

									<p class="form-row form-row-last validate-required" id="custom_last_name_field">
										<!-- <label for="custom_last_name" class="">Achternaam&nbsp;<abbr class="required"
												title="vereist">*</abbr></label> -->
										<span class="woocommerce-input-wrapper">
											<input type="text" class="input-text px-pixel-10 " name="custom_last_name"
												id="custom_last_name" placeholder="Achternaam *" value=""
												aria-required="true" autocomplete="family-name" required>
										</span><span id="custom_last_name_error" class="text-danger text-12 d-none">Voer uw
											achternaam in.</span>
									</p>

									<p class="form-row form-row-first validate-required validate-email"
										id="custom_email_field">
										<!-- <label for="custom_email" class="">E-mailadres&nbsp;<abbr class="required"
											title="vereist">*</abbr></label> -->
										<span class="woocommerce-input-wrapper">
											<input type="email" class="input-text px-pixel-10" name="custom_email"
												id="custom_email" placeholder="E-mailadres *" value="" aria-required="true"
												autocomplete="email username" required>
										</span>
										<span id="custom_email_error" class="text-danger text-12 mt-2 d-none">Voer een
											geldig
											e-mailadres in.</span>
									</p>

									<p class="form-row form-row-last validate-required validate-phone"
										id="custom_phone_field">
										<!-- <label for="custom_phone" class="">Telefoon&nbsp;<abbr class="required"
											title="vereist">*</abbr></label> -->
										<span class="woocommerce-input-wrapper">
											<input type="tel" class="input-text px-pixel-10 " name="custom_phone"
												id="custom_phone" placeholder="Telefoon *" value="" aria-required="true"
												autocomplete="tel" required>
										</span>
										<span id="custom_phone_error" class="text-danger text-12 d-none">Voer een geldig
											telefoonnummer in.</span>
									</p>
								</div>
							</div>

							<div class="bpc-form-divider"></div>

							<div class="bpc-form-section" id="customer_details">
								<div class="bpc-form-section-head">
									<span class="bpc-form-section-title">Afleveradres</span>
									<span class="bpc-form-section-hr"></span>
									<!-- Location icon -->
									<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<mask id="mask0_151_3815" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
											y="0" width="20" height="20">
											<rect width="20" height="20" fill="#D9D9D9" />
										</mask>
										<g mask="url(#mask0_151_3815)">
											<path
												d="M8.81733 11.7886L6.8815 9.85251C6.76608 9.73723 6.62101 9.6782 6.44629 9.67543C6.27171 9.67279 6.124 9.73182 6.00317 9.85251C5.88247 9.97334 5.82212 10.1197 5.82212 10.2917C5.82212 10.4636 5.88247 10.61 6.00317 10.7308L8.29004 13.0177C8.44074 13.1683 8.6165 13.2436 8.81733 13.2436C9.01817 13.2436 9.19393 13.1683 9.34462 13.0177L13.9809 8.38147C14.0962 8.26605 14.1552 8.12098 14.158 7.94626C14.1606 7.77168 14.1016 7.62397 13.9809 7.50314C13.86 7.38244 13.7137 7.32209 13.5417 7.32209C13.3698 7.32209 13.2234 7.38244 13.1025 7.50314L8.81733 11.7886ZM10.0015 17.9167C8.9065 17.9167 7.87726 17.7089 6.91379 17.2933C5.95032 16.8778 5.11226 16.3138 4.39962 15.6015C3.68698 14.8891 3.12275 14.0514 2.70692 13.0883C2.29122 12.1253 2.08337 11.0963 2.08337 10.0015C2.08337 8.90647 2.29115 7.87723 2.70671 6.91376C3.12226 5.95029 3.68622 5.11223 4.39858 4.39959C5.11094 3.68695 5.94865 3.12272 6.91171 2.70689C7.87476 2.29119 8.90372 2.08334 9.99858 2.08334C11.0936 2.08334 12.1228 2.29112 13.0863 2.70668C14.0498 3.12223 14.8878 3.68619 15.6005 4.39855C16.3131 5.11091 16.8773 5.94862 17.2932 6.91168C17.7089 7.87473 17.9167 8.90369 17.9167 9.99855C17.9167 11.0936 17.7089 12.1228 17.2934 13.0863C16.8778 14.0497 16.3139 14.8878 15.6015 15.6004C14.8891 16.3131 14.0514 16.8773 13.0884 17.2931C12.1253 17.7088 11.0964 17.9167 10.0015 17.9167Z"
												fill="#F3F4F6" />
										</g>
									</svg>

								</div>
								<div class="checkout-content-wrapper checkout-billing-shipping-fields-wrapper">
									<div class="checkout-shipping-fields">
										<?php do_action('woocommerce_checkout_shipping'); ?>
									</div>

								</div>
							</div>

						<?php endif; ?>

						<div class="bpc-form-divider"></div>

						<div class="bpc-form-section checkout-billing-content-wrapper">
							<div class="checkout-billing-fields-wrapper checkout-content-wrapper">
								<h5 id="billing-to-different-address" class="pt-2 pb-1 mb-0">
									<label
										class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
										<input id="billing-to-different-address-checkbox"
											class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
											type="checkbox" name="billing_to_different_address" checked>
										<span>Factuuradres is
											hetzelfde als afleveradres</span>
									</label>
								</h5>
								<div class="checkout-billing-fields col2-set pb-1 pt-2 d-none">
									<?php do_action('woocommerce_checkout_billing'); ?>
								</div>
							</div>

						</div>
						<?php do_action('woocommerce_checkout_after_customer_details'); ?>

						<input type="hidden" name="dayz_date_mapper_date" id="dayz_date_mapper_date" required=""
							value="<?php echo isset($_COOKIE['ddm_selected_date']) ? esc_attr(sanitize_text_field(wp_unslash($_COOKIE['ddm_selected_date']))) : ''; ?>">

						<input type="hidden" name="dayz_date_mapper_timeslots_collection"
							id="dayz_date_mapper_timeslots_collection" required=""
							value="<?php echo isset($_COOKIE['ddm_selected_timeslots']) ? esc_attr(sanitize_text_field(wp_unslash($_COOKIE['ddm_selected_timeslots']))) : ''; ?>">
					</div>
				</div>


				<!-- <div class="col-lg-6 ps-lg-5 review-section">
					

					<h2 id="order_review_heading" class="pb-4 pt-sm-4 pt-0 text-uppercase d-flex align-items-center">
						<img src="<?php //echo site_url(); ?>/wp-content/uploads/2025/03/icon-euro.png" alt="Euro"
							style="height: 30px;">&nbsp;Uw bestelling</h2>

					

					<div id="order_review" class="woocommerce-checkout-review-order">
						
					</div>

					

					<?php //echo apply_filters('woocommerce_order_button_html', '<button type="submit" class="button alt w-100 oswald-600 text-sm-20 text-white text-uppercase border-2 border-orange bg-orange rounded-0 px-6 py-2 mb-3" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr('Doorgaan') . '" data-value="' . esc_attr('Doorgaan') . '">' . esc_html('Doorgaan') . '</button>'); // @codingStandardsIgnoreLine ?>

				</div> -->
				<!-- ══════ RIGHT: ORDER SUMMARY ══════ -->
				<div class="col-lg-4 px-md-0">
					<div class="bpc-summary">

						<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

						<!-- Header -->
						<div class="bpc-summary-header">
							<h3>Bestel Overzicht</h3>
						</div>

						<?php do_action('woocommerce_checkout_before_order_review'); ?>

						<!-- Body sections -->
						<div class="bpc-summary-body">
							<?php do_action('woocommerce_checkout_order_review'); ?>

						</div><!-- /.bpc-summary-body -->



						<?php do_action('woocommerce_checkout_after_order_review'); ?>

					</div><!-- /.bpc-summary -->
				</div><!-- /.col-lg-4 -->

			</form>
		</div>
	</div>

	<?php do_action('woocommerce_after_checkout_form', $checkout); ?>