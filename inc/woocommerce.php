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
			$post_data = array(
				'Aantal m³' => get_post_meta($post_id, 'beton_samenstelling_cubic_meters', true),
				'Postalcode' => get_post_meta($post_id, 'beton_samenstelling_postalcode', true),
				'Toepassing' => get_post_meta($post_id, 'application_application_product', true),
				'Loswijze' => get_post_meta($post_id, 'unloading', true),
				'Samenstelling' => implode(', ', get_post_meta($post_id, 'composition', true) ? get_post_meta($post_id, 'composition', true) : array()),
				'Pomp type' => get_post_meta($post_id, 'pump_type_pump_type', true),
				'M-Pompafstand' => get_post_meta($post_id, 'pump_type_pumping_distance', true),
				'B-Pompafstand' => get_post_meta($post_id, 'pump_type_boom_pumping_distance', true),
				'Uitvoering' => get_post_meta($post_id, 'performance_uitvoering', true),
				'Oppervlakte' => get_post_meta($post_id, 'additional_surace-sqm', true),
				'Laagdikte' => get_post_meta($post_id, 'additional_layer-thickness', true),
				'Aantal vertrekken' => get_post_meta($post_id, 'additional_nos_rooms', true),
				'Verdiepingsvloer / Floor' => get_post_meta($post_id, 'additional_flooring', true),
				'Vlindervloer / Butterfly floor' => get_post_meta($post_id, 'additional_butterfly', true),
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
			echo wc_price(get_post_meta($post_id, 'totals_btw_21', true)); // 
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
		'pump-type' => get_post_meta($quote_id, 'pump_type_grp_pump_type', true),
		'pumping_distance' => get_post_meta($quote_id, 'pump_type_grp_pumping_distance', true),
		'boom_pumping_distance' => get_post_meta($quote_id, 'pump_type_grp_boom_pumping_distance', true),
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
	
// 	wc_get_logger()->debug( 'Setting quote ID: ' . $quote_id, array('source' => 'beton-logs') );

		WC()->cart->empty_cart();
		
		$cart_item_data = array('custom_price' => get_post_meta($quote_id, 'totals_subtotal', true));   

		$cart_item_key = WC()->cart->add_to_cart( get_field('beton_product', 'option'), 1, 0, [], $cart_item_data );

		// $cart_item = WC()->cart->get_cart_item( $cart_item_key );
		
		// $cart_item['data']->set_price( get_post_meta($quote_id, 'totals_subtotal', true) );
		// WC()->cart->set_session();
		// WC()->cart->calculate_totals();

		// WC()->cart->cart_contents[ $cart_item_key ]['custom_price'] = get_post_meta($quote_id, 'totals_subtotal', true); // your custom price



	// }
	wp_redirect(wc_get_checkout_url());
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
// 	wc_get_logger()->debug( 'Quote ID when adding meta: ' . $quote_id, array('source' => 'beton-logs') );

	if(isset( $_COOKIE['quotation_id'] ) ){
		$quote_id = $_COOKIE['quotation_id'];
	}
	if (empty($quote_id)) {
		return $cart_item_data;
	}
	
	$calc_data = array(
		'area_code' => get_post_meta($quote_id, 'area_code', true),
		'cubic_meters' => get_post_meta($quote_id, 'beton_samenstelling_cubic_meters', true),
		'postalcode' => get_post_meta($quote_id, 'beton_samenstelling_postalcode', true),
		'application' => get_post_meta($quote_id, 'application_product', true),
		'release_method' => get_post_meta($quote_id, 'unloading', true),
		'compounds' => get_post_meta($quote_id, 'composition', true),
		'pump_type' => get_post_meta($quote_id, 'pump_type_grp_pump_type', true),
		'pumping_distance' => get_post_meta($quote_id, 'pump_type_grp_pumping_distance', true),
		'boom_pumping_distance' => get_post_meta($quote_id, 'pump_type_grp_boom_pumping_distance', true),
		'performance' => get_post_meta($quote_id, 'uitvoering', true),
		'surface' => get_post_meta($quote_id, 'additional_surace-sqm', true),
		'layer_thickness' => get_post_meta($quote_id, 'additional_layer-thickness', true),
		'rooms_count' => get_post_meta($quote_id, 'additional_nos_rooms', true),
		'selected_floor' => get_post_meta($quote_id, 'additional_flooring', true),
		'butterfly_floor' => get_post_meta($quote_id, 'additional_butterfly-floor', true),
		'user_email' => get_post_meta($quote_id, 'user_email', true),
		'quote_id' => $quote_id,
	);

	setcookie('travelling_distance', get_post_meta($quote_id, 'travelling_distance', true), time() + 31556926);

	$calc_data['city'] = $calc_data['postalcode'];
	$calc_data['pumping_distance'] = (isset($calc_data['pump_type']) && $calc_data['pump_type'] == 'mini' ? $calc_data['pumping_distance'] : 				$calc_data['boom_pumping_distance']);

	$calcuated_data = beton_calculator($calc_data);
	$beton_price = get_post_meta($quote_id, 'beton_cost', true);
	if($beton_price && $calc_data['cubic_meters']){
		$cart_item_data['concrete_value'] = $beton_price;
		$cubic_meters = number_format($calc_data['cubic_meters'], 2);
		$cart_item_data['concrete_label'] = "Beton: {$cubic_meters}m³";
	}

	if(isset($calcuated_data['application_price'])){
		$cart_item_data['application_label'] = "Toepassing";
		$cart_item_data['application_value'] = get_field('totals_toepassing_cost', $quote_id);
	}

	if(get_field('totals_top_totals', $quote_id)){
		$cart_item_data['compositions_label'] = ucwords(str_replace('-', ' ', implode(', ', $calc_data['compounds'])));
		$cart_item_data['compositions_value'] = get_field('totals_top_totals', $quote_id) - get_field('totals_toepassing_cost', $quote_id);
	}

	if(isset($calc_data['release_method'])){
		$cart_item_data['unloading_label'] = "Loswijze";
// 		wc_get_logger()->debug( 'Calcdata when adding meta2: ' . json_encode($calc_data), array('source' => 'beton-logs') );
// 		wc_get_logger()->debug( '$cart_item_data when adding meta2: ' . json_encode($cart_item_data), array('source' => 'beton-logs') );
		
		$cart_item_data['unloading_value'] = $calc_data['release_method'] == 'pump' ? 'Pomp' : "Uit de goot";
		
		
	}

	if(get_field('totals_pump_cost', $quote_id) && get_field('pump_type', $quote_id)){
		$cart_item_data['pump_label'] = (get_field('pump_type', $quote_id) == 'mini' ? 'Mini betonpomp' : 'Giekpomp');
		$cart_item_data['pump_value'] = get_field('totals_pump_cost', $quote_id);
	}

	if($callout_value = get_field('totals_voorrijkosten_cost', $quote_id)){
		$cart_item_data['callout_label'] = "Voorrijkosten";
		$cart_item_data['callout_value'] = $callout_value;
	}

	if($pumping_distance_cost = get_field('totals_pumping_distance_cost', $quote_id)){
		$pumping_distance = get_field('pump_type', $quote_id) == 'mini' ? get_field('pumping_distance', $quote_id) : get_field('boom_pumping_distance', $quote_id);
		$cart_item_data['pumping_label'] = "Pompafstand - {$pumping_distance}m";
		$cart_item_data['pumping_value'] = $pumping_distance_cost;
	}

	if($toeslag_extra_leidingwagen_cost = get_field('totals_toeslag_extra_leidingwagen_cost', $quote_id)){
		$cart_item_data['pumping_value'] = get_field('totals_pumping_distance_cost', $quote_id) + $toeslag_extra_leidingwagen_cost;
	}

	if($allIn_cost = get_field('totals_all-in_uitvoering_cost', $quote_id)){
		$cart_item_data['allin_label'] = "All-in";
		$cart_item_data['allin_value'] = $allIn_cost;
	}

	if($vlindervloer_cost = get_field('totals_vlindervloer_cost', $quote_id)){
		$cart_item_data['butterfly_floor_label'] = "Vlindervloer";
		$cart_item_data['butterfly_floor_value'] = $vlindervloer_cost;
	}
	
	if (!empty(get_field('composition', $quote_id))) {
		$composition = get_field('composition', $quote_id);
		foreach ($composition as $id => $item) {
			$cart_item_data['raw_' . str_replace('-', '_', $item) . '_value'] = get_field('totals_' . str_replace('-', '_', $item) . '_cost', $quote_id);
			$cart_item_data['raw_' . str_replace('-', '_', $item) . '_label'] = ucwords(str_replace('-', ' ', $item));
		}
	}

	$cart_item_data['sub_total'] = get_field('totals_subtotal', $quote_id);

	if(isset($cart_item_data['allin_value']) && floatval($cart_item_data['allin_value']) > 0){
		$cart_item_data['unloading_value'] = "Alles-in-één met pomp";
	}
	
	wc_get_logger()->debug( 'new test: ' . json_encode($cart_item_data), array('source' => 'beton-logs') );
	
	if(isset($cart_item_data['pump_label']) && str_contains($cart_item_data['pump_label'], 'pomp')){
		$cart_item_data['unloading_value'] = $cart_item_data['pump_label'];	
	}
    
    return $cart_item_data;
}
add_filter('woocommerce_add_cart_item_data', 'beton_add_cart_item_data_via_pay_url', 15, 3);
