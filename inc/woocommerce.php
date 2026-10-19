<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Beton
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function beton_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'beton_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function beton_woocommerce_scripts() {
	wp_enqueue_style( 'beton-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'beton-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'beton_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function beton_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'beton_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function beton_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'beton_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'beton_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function beton_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'beton_woocommerce_wrapper_before' );

if ( ! function_exists( 'beton_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function beton_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'beton_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'beton_woocommerce_header_cart' ) ) {
			beton_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'beton_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function beton_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		beton_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'beton_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'beton_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function beton_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'beton' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'beton' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'beton_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function beton_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php beton_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

add_action( 'template_redirect', 'skip_cart_redirect' );
function skip_cart_redirect(){
    // Redirect to checkout (when cart is not empty)
    if ( ! WC()->cart->is_empty() && is_cart() ) {
        wp_safe_redirect( wc_get_checkout_url() ); 
        exit();
    }
    // Redirect to shop if cart is empty
    elseif ( WC()->cart->is_empty() && is_cart() ) {
        wp_safe_redirect( wc_get_page_permalink( 'home' ) );
        exit();
    }
}

add_action("admin_init", "admin_pdf_init");
function admin_pdf_init(){
	add_meta_box("quote-pdf", "Quotation PDF", "admin_pdf_link", "concrete_quotation", "side", "default");
}

function admin_pdf_link(){
	global $post;
	echo '<a href="edit.php?post_type=concrete_quotation&pdf_generate=true&quote_id=' . $post->ID . '" target="_blank" class="button" value="steam_pdf"><span class="dashicons dashicons-pdf"></span></a>';
}

add_action('manage_concrete_quotation_posts_custom_column', 'custom_book_column', 10, 2);
function custom_book_column($column, $post_id)
{
	global $wpdb;
	$postcode = get_post_meta($post_id, 'beton_samenstelling_postalcode', true);
	switch ($column) {
		case 'city':
			$metaCity = get_post_meta($post_id, 'beton_samenstelling_postalcode', true);
			$city = $wpdb->get_row("SELECT city_name FROM {$wpdb->prefix}postcodes_2 WHERE zip LIKE '%{$postcode}%' ");
			$town = $city->city_name;
			if (preg_match('/[A-Za-z]/', $town) && !preg_match('/[0-9]/', $town)) {
				echo $town;
			} else {
				echo $metaCity;
			}
			break;
		case 'order':
			$linked_order_id = get_post_meta($post_id, 'order_id', true);
			if (!empty($linked_order_id)) {
				echo '<div style="margin-bottom: 6px;"><strong style="color: #15803d; background: #DCFCE7; padding: 2px 6px; border-radius: 4px; font-size: 11px;">Bestelling: <a href="' . get_edit_post_link($linked_order_id) . '" target="_blank" style="color: #15803d; text-decoration: underline;">#' . esc_html($linked_order_id) . '</a></strong></div>';
			}
			$post_data = array(
				'Aantal m³' => get_post_meta($post_id, 'beton_samenstelling_cubic_meters', true),
				'Postalcode' => get_post_meta($post_id, 'beton_samenstelling_postalcode', true),
				'Toepassing' => get_post_meta($post_id, 'application_product', true) ?: get_post_meta($post_id, 'application_application_product', true),
				'Loswijze' => get_post_meta($post_id, 'unloading', true),
				'Samenstelling' => implode(', ', get_post_meta($post_id, 'composition', true) ? get_post_meta($post_id, 'composition', true) : array()),
				'Pomp type' => get_post_meta($post_id, 'pump_type', true) ?: (get_post_meta($post_id, 'pump_type_grp_pump_type', true) ?: get_post_meta($post_id, 'pump_type_pump_type', true)),
				'M-Pompafstand' => get_post_meta($post_id, 'pumping_distance', true) ?: (get_post_meta($post_id, 'pump_type_grp_pumping_distance', true) ?: get_post_meta($post_id, 'pump_type_pumping_distance', true)),
				'B-Pompafstand' => get_post_meta($post_id, 'boom_pumping_distance', true) ?: (get_post_meta($post_id, 'pump_type_grp_boom_pumping_distance', true) ?: get_post_meta($post_id, 'pump_type_boom_pumping_distance', true)),
				'Uitvoering' => get_post_meta($post_id, 'uitvoering', true) ?: get_post_meta($post_id, 'performance_uitvoering', true),
				'Oppervlakte' => get_post_meta($post_id, 'additional_surace-sqm', true),
				'Laagdikte' => get_post_meta($post_id, 'additional_layer-thickness', true),
				'Aantal vertrekken' => get_post_meta($post_id, 'additional_nos_rooms', true),
				'Verdiepingsvloer / Floor' => get_post_meta($post_id, 'additional_flooring', true),
				'Vlindervloer / Butterfly floor' => get_post_meta($post_id, 'additional_butterfly-floor', true) ?: get_post_meta($post_id, 'additional_butterfly', true),
				'Email' => get_post_meta($post_id, 'user_email', true)
			);
			foreach ($post_data as $label => $value) {
				if (!empty($value)) {
					echo $label . ": " . $value . '</br>';
				}
			}
			break;
		case 'postcode':
			echo $postcode;
			break;
		case 'gclid':
			echo get_post_meta($post_id, 'gclid', true) ? get_post_meta($post_id, 'gclid', true) : '--';
			// echo '<input type="hidden" name="order_id" value="' . $post_id . '">
			// 		<input type="text" readonly class="gclid_field_c" data-order="' . $post_id . '" class="gclid_field_' . $post_id . '" id="gclid_field_' . $post_id . '" name="gclid_field" value="">
			// 		<span></span>';
			break;
		case 'tax':
			echo wc_price(get_post_meta($post_id, 'totals_btw', true) ?: get_post_meta($post_id, 'totals_btw_21', true)); // 
			break;
		case 'sub_total':
			echo wc_price(get_post_meta($post_id, 'totals_subtotal', true)); // 
			break;
		case 'total':
			echo wc_price(get_post_meta($post_id, 'totals_grand_total', true)); // 
			break;
		case 'pdf':
			echo '<a href="edit.php?post_type=concrete_quotation&pdf_generate=true&quote_id=' . $post_id . '" target="_blank" class="button" value="steam_pdf"><span class="dashicons dashicons-pdf"></span></a>';
			break;
	}
}

add_filter('manage_edit-concrete_quotation_sortable_columns', 'my_sortable_date_column');
function my_sortable_date_column($columns){
	$columns['order'] = 'Order';
	return $columns;
}
function admin_pdf_steam_quote(){
	if (!isset($_GET['pdf_generate'])) {
		return;
	}
	$quote_id = $_GET['quote_id'];
	$data = quotation_html($quote_id);
	$pdf_id = stream_pdf_file($data['html'], $data['id'], $data['title'], true);
}
add_action("admin_init", "admin_pdf_steam_quote");

add_action("admin_init", "pay_url_init");
function pay_url_init(){
	add_meta_box("pay-quote", "Pay URL", "pay_url", "concrete_quotation", "side", "default");
}

function pay_url(){
	global $post;
	$order = get_post_meta($post->ID, 'order_id', true);
	if (empty($order)) {
		echo '<p>' . wc_get_checkout_url() . '?pay-url=' . encrypt_code($post->ID) . '</p>';
		echo '<a href="' . wc_get_checkout_url() . '?pay-url=' . encrypt_code($post->ID) . '" target="_blank" class="button tagadd" style="margin: 5px;">Pay URL</a>';
	} else {
		echo '<p>Order ID : ' . $order . '</p>';
		echo '<a href="' . get_edit_post_link($order) . '" target="_blank" class="button tagadd" style="margin: 5px;">Check order</a>';
	}
}

add_action('init', 'make_payment_by_url');
function make_payment_by_url()
{
	if (!isset($_GET['pay-url']) and empty($_GET['pay-url'])) {
		return;
	}

	$quote_id = decrypt_code($_GET['pay-url']);

	// Old-site quote links (imported quotations) carry the OLD post ID, either
	// encrypted or as a plain number (the old site sent ?pay-url=<id>).
	// Map them to the imported post via the _legacy_quote_id meta, unless the
	// decrypted ID is already a quotation on this site (native or imported).
	$raw_pay_param   = sanitize_text_field( wp_unslash( $_GET['pay-url'] ) );
	$is_plain_legacy = ( ( empty( $quote_id ) || ! ctype_digit( (string) $quote_id ) ) && ctype_digit( $raw_pay_param ) );
	if ( $is_plain_legacy ) {
		$quote_id = $raw_pay_param; // Only resolved through _legacy_quote_id below.
	}
	if ( ! empty( $quote_id ) && ( $is_plain_legacy || 'concrete_quotation' !== get_post_type( $quote_id ) ) ) {
		$legacy_quote = get_posts( array(
			'post_type'      => 'concrete_quotation',
			'post_status'    => 'any',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'meta_key'       => '_legacy_quote_id',
			'meta_value'     => (string) absint( $quote_id ),
		) );
		if ( ! empty( $legacy_quote ) ) {
			$quote_id = (int) $legacy_quote[0];
		} elseif ( $is_plain_legacy ) {
			$quote_id = 0; // Never open a post by its plain ID.
		}
	}
	
	if ( !get_post_status( $quote_id ) ) {
		WC()->cart->empty_cart();
		wp_safe_redirect( wc_get_page_permalink( 'home' ) );
        exit();
	}
// 	wc_get_logger()->debug( 'Pay URL and quote ID: ' . ($_GET['pay-url']) . ' and ' . $quote_id, array('source' => 'beton-logs') );
	
	
	$post_date = get_post_time('U', true, $quote_id); // Unix timestamp
	$one_month_ago = strtotime('-1 month');

        // If older than 1 month, redirect
// 	if ($post_date < $one_month_ago) {
// 		wp_redirect(home_url('/offerte-aanvragen/'));
// 		exit;
// 	}
// 	
// 	

	$post_data = array(
		'action' => 'concrete_add_to_cart',
		'cubic_meters' => get_post_meta($quote_id, 'beton_samenstelling_cubic_meters', true),
		'postalcode' => get_post_meta($quote_id, 'beton_samenstelling_postalcode', true),
		'application_product' => get_post_meta($quote_id, 'application_product', true),
		'unloading' => get_post_meta($quote_id, 'unloading', true),
		'composition' => get_post_meta($quote_id, 'composition', true),
		'pump-type' => get_post_meta($quote_id, 'pump_type', true) ?: get_post_meta($quote_id, 'pump_type_grp_pump_type', true),
		'pumping_distance' => get_post_meta($quote_id, 'pumping_distance', true) ?: get_post_meta($quote_id, 'pump_type_grp_pumping_distance', true),
		'boom_pumping_distance' => get_post_meta($quote_id, 'boom_pumping_distance', true) ?: get_post_meta($quote_id, 'pump_type_grp_boom_pumping_distance', true),
		'uitvoering' => get_post_meta($quote_id, 'uitvoering', true),
		'surace-sqm' => get_post_meta($quote_id, 'additional_surace-sqm', true),
		'layer-thickness' => get_post_meta($quote_id, 'additional_layer-thickness', true),
		'nos_rooms' => get_post_meta($quote_id, 'additional_nos_rooms', true),
		'flooring' => get_post_meta($quote_id, 'additional_flooring', true),
		'butterfly-floor' => get_post_meta($quote_id, 'additional_butterfly-floor', true),
		'user_email' => get_post_meta($quote_id, 'user_email', true),
		'quote_id' => $quote_id,

		// 'Samenstelling' => get_post_meta($quote_id, 'composition_inputs', true),

		// 'Hoog vloeibaar' => get_post_meta($quote_id, 'totals_hoog_vloeibaar_cost', true),
		// 'Snelhardend' => get_post_meta($quote_id, 'totals_snelhardend_cost', true),
		// 'Fijn grind' => get_post_meta($quote_id, 'totals_fijn_grind_cost', true),
		// 'Vlinderbeton' => get_post_meta($quote_id, 'totals_vlinderbeton-hoge-sterkte_cost', true),
		// 'Beton' => get_post_meta($quote_id, 'beton_samenstelling_cubic_meters', true),
		// 'Extra hoge sterkte' => get_post_meta($quote_id, 'totals_extra_hoge_sterkte_cost', true),
		// 'Toepassing' => get_post_meta($quote_id, 'application_application_product', true),
		// 'Loswijze' => get_post_meta($quote_id, 'unloading', true),
		// 'Pomp' => get_post_meta($quote_id, 'pump_type_pump_type', true),
		// 'Pompafstand' => get_post_meta($quote_id, 'pump_type_pumping_distance', true) ? get_post_meta($quote_id, 'pump_type_pumping_distance', true) : get_post_meta($quote_id, 'pump_type_boom_pumping_distance', true),
		// 'Uitvoering' => get_post_meta($quote_id, 'performance_uitvoering', true),
		// 'Oppervlakte' => get_post_meta($quote_id, 'additional_surace-sqm', true),
		// 'Laagdikte' => get_post_meta($quote_id, 'additional_layer-thickness', true),
		// 'aantal_price' => get_post_meta($quote_id, 'totals_aantal_cost', true),
		// 'application_price' => get_post_meta($quote_id, 'totals_toepassing_cost', true),
		// 'composition_total_price' => get_post_meta($quote_id, 'totals_top_totals', true),
		// 'pump_total' => get_post_meta($quote_id, 'totals_pump_cost', true),
		// 'Voorrijkosten' => get_post_meta($quote_id, 'totals_voorrijkosten_cost', true),
		// 'all-in-total' => get_post_meta($quote_id, 'totals_all-in_uitvoering_cost', true),
		// 'pumping_distance_total' => get_post_meta($quote_id, 'totals_pumping_distance_cost', true),
		// 'mini_extra_horse' => get_post_meta($quote_id, 'totals_toeslag_extra_leidingwagen_cost', true),
		// 'pump_callout_fee' => get_post_meta($quote_id, 'totals_voorrijkosten_cost', true),
		// 'butterfly_floor' => get_post_meta($quote_id, 'totals_vlindervloer_cost', true),
		// 'composition_price_vlinderbeton' => get_post_meta($quote_id, 'totals_vlinderbeton', true),
	);

	// $response = wp_remote_post(home_url(), array('body' => $post_data));
	// print_r($response);
	// if (is_wp_error($response)) {
	// 	echo $response->get_error_message();
	// } else {
		// defined('WC_ABSPATH') || exit;

		// // Load cart functions which are loaded only on the front-end.
		// include_once WC_ABSPATH . 'includes/wc-cart-functions.php';
		// include_once WC_ABSPATH . 'includes/class-wc-cart.php';

		if (is_null(WC()->cart)) {
			wc_load_cart();
		}
		
		WC()->session->__unset('quotation_id');
		WC()->session->set('quotation_id', $quote_id);
		setcookie( 'quotation_id', $quote_id, time() + 3600, '/' );
		// Make the new ID visible in this same request too; otherwise the cart code
		// below reads the previous quote's cookie when a second link is opened.
		$_COOKIE['quotation_id'] = $quote_id;
	
		$quote_email = get_post_meta($quote_id, 'user_email', true);
		if (!empty($quote_email)) {
			WC()->session->set('billing_email', sanitize_email($quote_email));
		}

		WC()->cart->empty_cart();
		
		$sub_total_price = get_post_meta($quote_id, 'totals_subtotal', true);
		$cart_item_data = array(
			'custom_price' => $sub_total_price,
			'sub_total_custom' => $sub_total_price,
		);   

		$cart_item_key = WC()->cart->add_to_cart( get_field('beton_product', 'option'), 1, 0, [], $cart_item_data );

		// $cart_item = WC()->cart->get_cart_item( $cart_item_key );
		
		// $cart_item['data']->set_price( get_post_meta($quote_id, 'totals_subtotal', true) );
		// WC()->cart->set_session();
		// WC()->cart->calculate_totals();

		// WC()->cart->cart_contents[ $cart_item_key ]['custom_price'] = get_post_meta($quote_id, 'totals_subtotal', true); // your custom price



	// }
	wp_redirect(wc_get_checkout_url());
}

add_action('woocommerce_checkout_order_processed', 'beton_link_quotation_to_order', 10, 3);
function beton_link_quotation_to_order($order_id, $posted_data, $order) {
	$quote_id = (WC()->session && is_object(WC()->session)) ? WC()->session->get('quotation_id') : null;
	if (empty($quote_id) && isset($_COOKIE['quotation_id'])) {
		$quote_id = absint($_COOKIE['quotation_id']);
	}
	if (!empty($quote_id)) {
		update_post_meta($order_id, '_quotation_id', $quote_id);
		update_post_meta($quote_id, 'order_id', $order_id);
		if (WC()->session && is_object(WC()->session)) {
			WC()->session->__unset('quotation_id');
		}
		setcookie('quotation_id', '', time() - 3600, '/');
	}
}

// add_action( 'woocommerce_before_calculate_totals', function( $cart ) {
//     if ( is_admin() && ! defined( 'DOING_AJAX' ) )
//         return;

//     foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
//         if ( isset( $cart_item['custom_price'] ) ) {
//             $cart_item['data']->set_price( 500 );
//         }
//     }
// });

add_action( 'woocommerce_before_calculate_totals', 'add_custom_item_price', 10 );
function add_custom_item_price( $cart_object ) {

    // foreach ( $cart_object->get_cart() as $item_values ) {
	foreach ( $cart_object->cart_contents as $key => $value ) {
		if( isset( $value["custom_price"] ) ) {
		
        // ##  Get cart item data
        // $item_id = $item_values['data']->id; // Product ID
        // $original_price = $item_values['data']->price; // Product original price

        // ## Get your custom fields values
        // $price1 = $item_values['custom_data']['price1'];
        // $quantity = $item_values['custom_data']['quantity'];

        // // CALCULATION FOR EACH ITEM:
        // ## Make HERE your own calculation 
        // $new_price = $price1 ;

        ## Set the new item price in cart
		// if ( isset( $item_values['custom_price'] ) ) {
        	$value['data']->set_price($value["custom_price"]);
		}
    }
}

function beton_add_cart_item_data_via_pay_url($cart_item_data, $product_id, $variation_id)
{
	$quote_id = WC()->session->get('quotation_id');

	if (isset($_COOKIE['quotation_id'])) {
		$quote_id = $_COOKIE['quotation_id'];
	}
	if (empty($quote_id)) {
		return $cart_item_data;
	}

	$cubic_meters          = get_post_meta($quote_id, 'beton_samenstelling_cubic_meters', true) ?: get_post_meta($quote_id, 'cubic_meters', true);
	$postalcode            = get_post_meta($quote_id, 'beton_samenstelling_postalcode', true) ?: get_post_meta($quote_id, 'postalcode', true);
	$area_code             = get_post_meta($quote_id, 'area_code', true);
	$application           = get_post_meta($quote_id, 'application_product', true) ?: get_post_meta($quote_id, 'application', true);
	$unloading             = get_post_meta($quote_id, 'unloading', true) ?: get_post_meta($quote_id, 'release_method', true);
	$composition           = get_post_meta($quote_id, 'composition', true) ?: get_post_meta($quote_id, 'compounds', true);
	if (!is_array($composition) && !empty($composition)) {
		$composition = (array) $composition;
	}

	$pump_type             = get_post_meta($quote_id, 'pump_type', true) ?: get_post_meta($quote_id, 'pump_type_grp_pump_type', true);
	$pumping_distance      = get_post_meta($quote_id, 'pumping_distance', true) ?: get_post_meta($quote_id, 'pump_type_grp_pumping_distance', true);
	$boom_pumping_distance = get_post_meta($quote_id, 'boom_pumping_distance', true) ?: get_post_meta($quote_id, 'pump_type_grp_boom_pumping_distance', true);

	$performance           = get_post_meta($quote_id, 'uitvoering', true) ?: get_post_meta($quote_id, 'performance', true);
	$surface               = get_post_meta($quote_id, 'additional_surace-sqm', true) ?: get_post_meta($quote_id, 'surace-sqm', true);
	$layer_thickness       = get_post_meta($quote_id, 'additional_layer-thickness', true) ?: get_post_meta($quote_id, 'layer-thickness', true);
	$rooms_count           = get_post_meta($quote_id, 'additional_nos_rooms', true) ?: get_post_meta($quote_id, 'nos_rooms', true);
	$selected_floor        = get_post_meta($quote_id, 'additional_flooring', true) ?: get_post_meta($quote_id, 'flooring', true);
	$butterfly_floor       = get_post_meta($quote_id, 'additional_butterfly-floor', true) ?: get_post_meta($quote_id, 'butterfly-floor', true);

	$travel_distance = get_post_meta($quote_id, 'travelling_distance', true);
	if ($travel_distance !== '') {
		setcookie('travelling_distance', $travel_distance, time() + 31556926, '/');
		$_COOKIE['travelling_distance'] = $travel_distance;
	}

	// 1. Concrete volume
	$beton_price = get_post_meta($quote_id, 'beton_cost', true);
	if ($beton_price && $cubic_meters) {
		$cubic_meters_formatted = number_format(floatval($cubic_meters), 2);
		$cart_item_data['concrete_value'] = $beton_price;
		$cart_item_data['concrete_label'] = "Beton: {$cubic_meters_formatted}m³";
		$cart_item_data['hidden_concrete_qty_value'] = $cubic_meters_formatted;
		$cart_item_data['hidden_concrete_qty_label'] = 'Concrete Cubic meters';
	}

	$brandstoftoeslag = get_post_meta($quote_id, 'totals_brandstoftoeslag', true);
	if (!empty($brandstoftoeslag) && floatval($brandstoftoeslag) > 0) {
		$cart_item_data['brandstoftoeslag_value'] = floatval($brandstoftoeslag);
		$cart_item_data['brandstoftoeslag_label'] = "Brandstoftoeslag";
	}

	$laagwatertoeslag = get_post_meta($quote_id, 'totals_laagwatertoeslag', true);
	if (!empty($laagwatertoeslag) && floatval($laagwatertoeslag) > 0) {
		$cart_item_data['laagwatertoeslag_value'] = floatval($laagwatertoeslag);
		$cart_item_data['laagwatertoeslag_label'] = "Laagwatertoeslag";
	}

	// 2. Application (both plural and singular for template & filter compatibility)
	$application_cost = get_post_meta($quote_id, 'totals_toepassing_cost', true);
	if ($application_cost !== '' && floatval($application_cost) >= 0 && !empty($application)) {
		$app_label = ucwords(str_replace('-', ' ', $application));
		$cart_item_data['applications_label'] = "Toepassing";
		$cart_item_data['applications_value'] = $application_cost;
		$cart_item_data['application_label']  = "Toepassing";
		$cart_item_data['application_value']  = $application_cost;
		$cart_item_data['hidden_application_type_label'] = $app_label;
	}

	// 3. Compounds / Composition (Betonsoort)
	if (!empty($composition) && is_array($composition)) {
		$top_totals      = floatval(get_post_meta($quote_id, 'totals_top_totals', true));
		$toepassing_cost = floatval(get_post_meta($quote_id, 'totals_toepassing_cost', true));
		$cart_item_data['compositions_label'] = ucwords(str_replace('-', ' ', implode(', ', $composition)));
		$cart_item_data['compositions_value'] = $top_totals - $toepassing_cost;

		foreach ($composition as $item) {
			$compound_slug  = sanitize_title($item);
			$compound_cost  = get_post_meta($quote_id, 'totals_' . str_replace('-', '_', $item) . '_cost', true);
			$compound_label = ucwords(str_replace('-', ' ', $item));

			// hidden_* is required by review-order.php:203
			$cart_item_data['hidden_' . $compound_slug . '_label'] = $compound_label;
			$cart_item_data['hidden_' . $compound_slug . '_value'] = $compound_cost;

			// raw_* is also stored for compatibility
			$cart_item_data['raw_' . str_replace('-', '_', $item) . '_value'] = $compound_cost;
			$cart_item_data['raw_' . str_replace('-', '_', $item) . '_label'] = $compound_label;

			// Production webhook attributes (matching beton_cart_item_data)
			if ($item == 'hoge-sterkte') {
				$cart_item_data['hidden_sterkte_extra'] = "C30/37";
			}
			if ($item == 'hoog-vloeibaar') {
				$cart_item_data['hidden_consitstentie_extra'] = "F4";
			}
			if ($item == 'vlinderbeton') {
				$cart_item_data['hidden_milleuklasse_extra'] = "XC4";
			}
			if ($item == 'fijn-grind') {
				$cart_item_data['hidden_grind_extra'] = "16";
			}
			if ($item == 'snelhardend') {
				$cart_item_data['hidden_portlandc_extra'] = "25";
			}
		}

		if (empty($cart_item_data['hidden_sterkte_extra'])) {
			$cart_item_data['hidden_sterkte_extra'] = "C20/25";
		}
		if (empty($cart_item_data['hidden_consitstentie_extra'])) {
			$cart_item_data['hidden_consitstentie_extra'] = "S3";
		}
		if (empty($cart_item_data['hidden_milleuklasse_extra'])) {
			$cart_item_data['hidden_milleuklasse_extra'] = ($application == 'funderingsbalk') ? "XC3" : "XC2";
		}
		if (empty($cart_item_data['hidden_grind_extra'])) {
			$cart_item_data['hidden_grind_extra'] = "32";
		}
		if (empty($cart_item_data['hidden_portlandc_extra'])) {
			$cart_item_data['hidden_portlandc_extra'] = "none";
		}
	} else {
		$cart_item_data['hidden_sterkte_extra'] = "C20/25";
		$cart_item_data['hidden_consitstentie_extra'] = "S3";
		$cart_item_data['hidden_milleuklasse_extra'] = ($application == 'funderingsbalk') ? "XC3" : "XC2";
		$cart_item_data['hidden_grind_extra'] = "32mm";
		$cart_item_data['hidden_portlandc_extra'] = "geen";
	}

	// 4. Loswijze & Pomp
	if ($unloading) {
		$cart_item_data['unloading_label'] = "Loswijze";
		$cart_item_data['unloading_value'] = in_array(strtolower((string) $unloading), ['pump', 'pomp']) ? 'Pomp' : "Uit de goot";
	}

	$is_boom = (stripos($pump_type, 'boom') !== false || stripos($pump_type, 'giek') !== false);
	$is_mini = (stripos($pump_type, 'mini') !== false || (!$is_boom && !empty($pumping_distance)));

	$pump_cost = get_post_meta($quote_id, 'totals_pump_cost', true);
	if (!empty($pump_cost) && floatval($pump_cost) > 0) {
		$cart_item_data['pump_label'] = $is_mini ? 'Mini betonpomp' : ('Giekpomp' . (!empty($boom_pumping_distance) ? " - {$boom_pumping_distance}m" : ''));
		$cart_item_data['pump_value'] = $pump_cost;
	}

	$callout_val = get_post_meta($quote_id, 'totals_voorrijkosten_cost', true);
	if (!empty($callout_val) && floatval($callout_val) > 0) {
		$cart_item_data['callout_label'] = "Voorrijkosten";
		$cart_item_data['callout_value'] = $callout_val;
	}

	$pumping_distance_cost = floatval(get_post_meta($quote_id, 'totals_pumping_distance_cost', true));
	$extra_hose_cost       = floatval(get_post_meta($quote_id, 'totals_toeslag_extra_leidingwagen_cost', true));
	if ($pumping_distance_cost > 0 || $extra_hose_cost > 0) {
		$distance_num = $is_mini ? $pumping_distance : ($boom_pumping_distance ?: $pumping_distance);
		$cart_item_data['pumping_label'] = "Pompafstand - {$distance_num}m";
		$cart_item_data['pumping_value'] = $pumping_distance_cost + $extra_hose_cost;
		$cart_item_data['hidden_pumping_distance_value_extra'] = $distance_num;
	}

	// 5. All-in & Vlinderen
	$allin_cost = get_post_meta($quote_id, 'totals_all-in_uitvoering_cost', true);
	if (!empty($allin_cost) && floatval($allin_cost) > 0) {
		$cart_item_data['allin_label'] = "All-in";
		$cart_item_data['allin_value'] = $allin_cost;
		$cart_item_data['unloading_value'] = "Alles-in-één met pomp";

		if (!empty($surface)) {
			$cart_item_data['surface_label'] = "Oppervlak";
			$cart_item_data['surface_value'] = $surface;
		}

		if (!empty($rooms_count)) {
			$cart_item_data['number_of_rooms_label'] = "Aantal Kamers";
			$cart_item_data['number_of_rooms_value'] = $rooms_count;
		}

		if (!empty($layer_thickness)) {
			$cart_item_data['hidden_layer_thickness_extra'] = $layer_thickness;
		}

		$cart_item_data['hidden_selected_floor_extra'] = ($selected_floor == 1);
	}

	$vlindervloer_cost = get_post_meta($quote_id, 'totals_vlindervloer_cost', true);
	if (!empty($vlindervloer_cost) && floatval($vlindervloer_cost) > 0) {
		$cart_item_data['butterfly_floor_label'] = "Vlindervloer";
		$cart_item_data['butterfly_floor_value'] = $vlindervloer_cost;
	}

	// 6. Subtotal
	$subtotal = get_post_meta($quote_id, 'totals_subtotal', true);
	$cart_item_data['sub_total']        = $subtotal;
	$cart_item_data['sub_total_custom'] = $subtotal;
	$cart_item_data['custom_price']     = $subtotal;

	if (isset($cart_item_data['pump_label']) && str_contains($cart_item_data['pump_label'], 'pomp') && empty($cart_item_data['allin_value'])) {
		$cart_item_data['unloading_value'] = $cart_item_data['pump_label'];
	}

	return $cart_item_data;
}
add_filter('woocommerce_add_cart_item_data', 'beton_add_cart_item_data_via_pay_url', 15, 3);
