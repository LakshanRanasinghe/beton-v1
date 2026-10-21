<?php
// Dayz Beton
/**
 * Beton functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Beton
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.2');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function beton_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Beton, use a find and replace
	 * to change 'beton' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('beton', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'beton'),
			'menu-2' => esc_html__('Mobile', 'beton'),
			'footer-menu-01' => esc_html__('Footer Menu 01', 'beton'),
			'footer-menu-02' => esc_html__('Footer Menu 02', 'beton'),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'beton_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'beton_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function beton_content_width()
{
	$GLOBALS['content_width'] = apply_filters('beton_content_width', 640);
}
add_action('after_setup_theme', 'beton_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function beton_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'beton'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'beton'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
	register_sidebar(array(
		'name' => esc_html__('Footer Widget 1', 'beton'),
		'id' => 'footer-widget-1',
		'description' => esc_html__('Add widgets here for the first footer section.', 'beton'),
		'before_widget' => '<div class="footer-widget footer-widget-1">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="footer-widget-title">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => esc_html__('Footer Widget 2', 'beton'),
		'id' => 'footer-widget-2',
		'description' => esc_html__('Add widgets here for the second footer section.', 'beton'),
		'before_widget' => '<div class="footer-widget footer-widget-2">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="footer-widget-title">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => esc_html__('Footer Widget 3', 'beton'),
		'id' => 'footer-widget-3',
		'description' => esc_html__('Add widgets here for the third footer section.', 'beton'),
		'before_widget' => '<div class="footer-widget footer-widget-3">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="footer-widget-title">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name' => esc_html__('Footer Widget 4', 'beton'),
		'id' => 'footer-widget-4',
		'description' => esc_html__('Add widgets here for the fourth footer section.', 'beton'),
		'before_widget' => '<div class="footer-widget footer-widget-4">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="footer-widget-title">',
		'after_title' => '</h4>',
	));
}
add_action('widgets_init', 'beton_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function beton_scripts()
{
	wp_enqueue_style('beton-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('beton-style', 'rtl', 'replace');

	wp_enqueue_script('beton-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('jquery-cookie', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js', array('jquery'), '1.4.1', true);
	wp_enqueue_script('beton', get_stylesheet_directory_uri() . '/js/beton.js', array('jquery'), '1.2.25', true);
	wp_enqueue_script('beton-checkout', get_stylesheet_directory_uri() . '/js/beton-woocommerce.js', array('jquery'), '1.2.6', true);

	//New scripts for beton revolution - 25.03.2026
	wp_enqueue_script('beton-revolution', get_stylesheet_directory_uri() . '/js/beton-revolution.js', array('jquery'), filemtime(get_stylesheet_directory() . '/js/beton-revolution.js'), true);
	wp_enqueue_script('beton-slider', get_stylesheet_directory_uri() . '/js/beton-slider.js', array('jquery'), '1.0.0', true);

	global $wpdb;
	$table_name = $wpdb->prefix . 'postcodes';

	// Fetch all names
	$postcodes = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

	wp_localize_script('beton', 'betonData', [
		'postcodes' => $postcodes,
		'ajax_url' => admin_url('admin-ajax.php')
	]);

	wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3');
	wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', array(), '1.11.3');
	wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), '5.3.3', true);
	wp_enqueue_style('custom', get_stylesheet_directory_uri() . '/css/custom.css', array('bootstrap'), '1.0.15');
	// wp_enqueue_style('g-fonts', 'https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', array(), '1.0.0');
	// wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/regular.min.css', array(), '6.6.0' );

	// 1. Enqueue the Select2 CSS
	wp_enqueue_style('select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', array(), '4.1.0');
	wp_enqueue_script('select2-js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), '4.1.0', true);

	//New styles for beton revolution - 25.03.2026
	wp_enqueue_style('beton-revolution', get_stylesheet_directory_uri() . '/css/beton-revolution.css', array(), filemtime(get_stylesheet_directory() . '/css/beton-revolution.css'));
	wp_enqueue_style('beton-checkout', get_stylesheet_directory_uri() . '/css/checkout.css', array(), '1.0.0');

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'beton_scripts');

/**
 * Implement the Bootstrap Nav Walker
 */
require get_template_directory() . '/inc/bootstrap-nav-walker.php';
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Custom Database Migrations
 */
require get_template_directory() . '/inc/database/migration.php';

// Calculating the distance
add_action('wp_ajax_calculate_travel_distance', 'distance_calculator');
add_action('wp_ajax_nopriv_calculate_travel_distance', 'distance_calculator');
/**
* Calculates the shortest round-trip driving distance (km) between a set of
* configured origins and the city posted by the visitor, using the
* Google Routes API (computeRouteMatrix) instead of the legacy Distance Matrix API.
*
* Requirements:
*  - "Routes API" must be enabled for the project in Google Cloud Console.
*  - The API key must be allowed to call the Routes API (check key restrictions).
*/
function distance_calculator()
{
	if ( ! isset( $_POST['city'] ) || empty( $_POST['city'] ) ) {
		wp_send_json_error( 'You can\'t calculate distance without city name.' );
	}
 
	$apiKey = get_field( 'google_map_api_key', 'option' );
	$places = get_field( 'distance_calculation_locations', 'option' );
 
	if ( empty( $places ) ) {
		$places = '4651CJ|2807KE|Den+Bosch|Haarlem|Venlo';
	}
 
	// The option still uses the legacy pipe-separated format; convert it to Routes API waypoints.
	$origins = array();
	foreach ( array_filter( array_map( 'trim', explode( '|', $places ) ) ) as $place ) {
		$origins[] = array(
			'waypoint' => array( 'address' => str_replace( '+', ' ', $place ) ),
		);
	}
 
	$destination = sanitize_text_field( wp_unslash( $_POST['city'] ) );
 
	$request_body = array(
		'origins'      => $origins,
		'destinations' => array(
			array( 'waypoint' => array( 'address' => $destination . ', Nederland' ) ),
		),
		'travelMode'   => 'DRIVE',
		'regionCode'   => 'NL',
	);
 
	$response = wp_remote_post(
		'https://routes.googleapis.com/distanceMatrix/v2:computeRouteMatrix',
		array(
			'timeout' => 15,
			'headers' => array(
				'Content-Type'     => 'application/json',
				'X-Goog-Api-Key'   => $apiKey,
				// The Routes API requires a field mask; only request what we use (keeps billing in the lowest tier).
				'X-Goog-FieldMask' => 'originIndex,destinationIndex,distanceMeters,duration,condition,status',
			),
			'body'    => wp_json_encode( $request_body ),
		)
	);
 
	$raw    = is_wp_error( $response ) ? $response->get_error_message() : wp_remote_retrieve_body( $response );
	$result = json_decode( $raw, true );
 
	wc_get_logger()->debug( $raw, array( 'source' => 'distance-calculator' ) );
 
	// On success the Routes API returns a JSON array of elements; on failure an object with an "error" key.
	if ( is_wp_error( $response ) || ! is_array( $result ) || isset( $result['error'] ) ) {
		wp_mail( explode( ',', get_field( 'failsafe_email_notifier', 'option' ) ), 'Google Routes API error', $raw );
		$result = array();
	}
 
	$distances = array();
	foreach ( $result as $element ) {
		$route_exists = ! isset( $element['condition'] ) || 'ROUTE_EXISTS' === $element['condition'];
		if ( $route_exists && ! empty( $element['distanceMeters'] ) ) {
			$distances[] = (int) $element['distanceMeters'];
		}
	}
 
	if ( empty( $distances ) ) {
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			if ( function_exists( 'wc_setcookie' ) ) {
				wc_setcookie( 'travelling_distance', floatval( 0 ), time() + 31556926 );
			} else {
				setcookie( 'travelling_distance', floatval( 0 ), time() + 31556926, '/' );
			}
			$_COOKIE['travelling_distance'] = 0;
			wp_send_json_success( array( 'distance' => 0, 'error' => 'Result given empty by the Google Routes API.' ) );
		}
		return false;
	}
 
	$smallestdistance = round( min( $distances ), -3 ) / 1000;
	$smallestdistance = ceil( $smallestdistance * 2 ); // going and return trip
 
	if ( function_exists( 'wc_setcookie' ) ) {
		wc_setcookie( 'travelling_distance', floatval( $smallestdistance ), time() + 31556926 );
	} else {
		setcookie( 'travelling_distance', floatval( $smallestdistance ), time() + 31556926, '/' );
	}
	$_COOKIE['travelling_distance'] = floatval( $smallestdistance );
 
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		wp_send_json_success( array( 'distance' => floatval( $smallestdistance ) ) );
	}
	return floatval( $smallestdistance );
}
// function distance_calculator()
// {
// 	if (!isset($_POST['city']) && empty($_POST['city'])) {
// 		wp_send_json_error('You can\'t calculate distance without city name.');
// 	}

// 	$apiKey = get_field('google_map_api_key', 'option'); //'AIzaSyDxa70NdYIOvdhAoiwzmJXMR3uPd8wK21g'; // change API key (Pieter's : AIzaSyAUblC2E3wGEvnhe9YzXegrcU_AAcFsMzg)
// 	$places = get_field('distance_calculation_locations', 'option');

// 	if (empty($places)) {
// 		$origin = "4651CJ|2807KE|Den+Bosch|Haarlem|Venlo";
// 	} else {
// 		$origin = $places;
// 	}

// 	// global $wpdb;
// 	// $destination = $wpdb->get_row("SELECT `city_name` FROM `{$wpdb->prefix}postcodes` WHERE `zip` LIKE '%$destination_postcode%'");
// 	$destination = sanitize_text_field($_POST['city']);

// 	$url = 'https://maps.googleapis.com/maps/api/distancematrix/json?sensor=false&origins=' . $origin . '&destinations=' . urlencode($destination) . '+Nederland&key=' . $apiKey;

// 	$ch = curl_init();
// 	curl_setopt($ch, CURLOPT_URL, $url);
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
// 	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
// 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// 	$response = curl_exec($ch);
// 	curl_close($ch);

// 	$result = (array) json_decode($response);

// 	wc_get_logger()->debug(json_encode($result));

// 	if ($result['error_message']) {
// 		wp_mail(explode(',', get_field('failsafe_email_notifier', 'option')), 'Google Distance error', $response);
// 	}
// 	if (empty($result) or empty($result['rows'][0]->elements[0]->distance->value)) {
// 		if (defined('DOING_AJAX') && DOING_AJAX) {
// 			if (function_exists('wc_setcookie')) {
// 				wc_setcookie('travelling_distance', floatval(0), time() + 31556926);
// 			} else {
// 				setcookie('travelling_distance', floatval(0), time() + 31556926, '/');
// 			}
// 			$_COOKIE['travelling_distance'] = 0;
// 			wp_send_json_success(['distance' => 0, 'error' => 'Result given empty by the google map API.']);
// 			wp_die();
// 		} else {
// 			return false;
// 		}
// 	} else {
// 		$distances = array();
// 		foreach ($result['rows'] as $ele) {
// 			if (!empty($ele->elements[0]->distance->text)) {
// 				$distances[] = $ele->elements[0]->distance->value;
// 			}
// 		}
// 		$smallestdistance = round(min($distances), -3) / 1000;
// 		$smallestdistance = ceil($smallestdistance * 2); //going and return trip
// 		if (function_exists('wc_setcookie')) {
// 			wc_setcookie('travelling_distance', floatval($smallestdistance), time() + 31556926);
// 		} else {
// 			setcookie('travelling_distance', floatval($smallestdistance), time() + 31556926, '/');
// 		}
// 		$_COOKIE['travelling_distance'] = floatval($smallestdistance);

// 		if (defined('DOING_AJAX') && DOING_AJAX) {
// 			wp_send_json_success(['distance' => floatval($smallestdistance)]);
// 		} else {
// 			return floatval($smallestdistance);
// 		}
// 	}
// }

function getBetonDiscountPercentage($number, $discounts)
{
	if (!is_array($discounts)) {
		return 0;
	}
	foreach ($discounts as $discount) {
		if (floatval($number) > $discount['min_range'] && $number <= $discount['max_range']) {
			return $discount['discount_percentage'];
		}
	}
	return 0; // Return null if no matching range is found
}

function getDataByProperty($array, $filter_name, $filter_value)
{
	if (!is_array($array)) {
		return null;
	}
	foreach ($array as $item) {
		if (isset($item[$filter_name]) && sanitize_title($item[$filter_name]) === $filter_value) {
			return $item;
		}
	}
	return null; // Return null if not found
}

add_action('wp_ajax_beton_calculator', 'beton_calculator');
add_action('wp_ajax_nopriv_beton_calculator', 'beton_calculator');
function beton_calculator($data = null)
{
	if ($data !== null && is_array($data) && count($data) > 0) {
		$_POST = $data;
	}
	// if (!wp_verify_nonce($_REQUEST['nonce'], "beton_calculator_nonce")) {
	// 	exit("No naughty business please");
	// }

	if (!isset($_POST['city']) || !isset($_POST['cubic_meters']) || !isset($_POST['area_code'])) {
		wp_send_json_error('No enough parameters to run the calculation.');
		return;
	}
	$city = sanitize_text_field($_POST['city']);
	$cubic_meters = sanitize_text_field($_POST['cubic_meters']);
	$area_code = sanitize_text_field($_POST['area_code']);
	$selected_application = sanitize_text_field($_POST['application']);
	$selected_compounds = rest_sanitize_array($_POST['compounds']);
	$selected_release_method = sanitize_text_field($_POST['release_method']);
	$selected_pump_type = sanitize_text_field($_POST['pump_type']);
	$selected_pumping_distance = sanitize_text_field($_POST['pumping_distance']);
	$selected_performance = sanitize_text_field($_POST['performance']);
	$selected_layer_thickness = sanitize_text_field($_POST['layer_thickness']);
	$selected_rooms = sanitize_text_field($_POST['rooms_count']);
	$selected_butterfly_floor = sanitize_text_field($_POST['butterfly_floor']);
	$selected_surface = sanitize_text_field($_POST['surface']);
	$selected_ground_floor = sanitize_text_field($_POST['selected_floor']);

	$seller_prices = get_field('beton_sellers', 'option');
	$beton_discounts = get_field('discounts', 'option');

	$sub_total = 0;
	$response_data_set = [];
	$response_data_set['cubic_meters_formatted'] = $cubic_meters;

	$price_index = array_search($area_code, array_column(json_decode(json_encode((array) $seller_prices), TRUE), 'area_code'));

	$seller_price_data = $seller_prices[$price_index];
	if ($cubic_meters < $seller_price_data['offset']) {
		$beton_price = (floatval($seller_price_data['seller_price']) * floatval($cubic_meters)) + (floatval($seller_price_data['offset']) - floatval($cubic_meters)) * floatval($seller_price_data['price_underload']);
	} else {
		$beton_price = floatval($seller_price_data['seller_price']) * floatval($cubic_meters);
	}
	$discount_percentage = getBetonDiscountPercentage($cubic_meters, $beton_discounts);
	if ($discount_percentage > 0) {
		$beton_price = $beton_price - (($beton_price / 100) * $discount_percentage);
	}
	$response_data_set['beton_price'] = $beton_price;
	$response_data_set['beton_price_formatted'] = wc_price($beton_price);
	$sub_total += $beton_price;

	// New beton fee (Brandstoftoeslag & Laagwatertoeslag)
	if ($cubic_meters > 0) {
		$brandstof_rate = floatval(get_field('brandstoftoeslag', 'option')) ?: 3.50;
		$brandstoftoeslag = floatval($cubic_meters) * $brandstof_rate;
		$response_data_set['brandstoftoeslag'] = $brandstoftoeslag;
		$response_data_set['brandstoftoeslag_formatted'] = wc_price($brandstoftoeslag);
		$sub_total += $brandstoftoeslag;

		$laagwater_rate = floatval(get_field('laagwatertoeslag', 'option')) ?: 5.00;
		$laagwatertoeslag = floatval($cubic_meters) * $laagwater_rate;
		$response_data_set['laagwatertoeslag'] = $laagwatertoeslag;
		$response_data_set['laagwatertoeslag_formatted'] = wc_price($laagwatertoeslag);
		$sub_total += $laagwatertoeslag;
	}

	$pricingData = get_field('application', 'option');
	$application_data = getDataByProperty($pricingData['application_items'], 'product_name', $selected_application);
	$application_price = floatval($application_data['price_excl_tax']) * floatval($cubic_meters);

	$response_data_set['application_price'] = $application_price;

	$response_data_set['application_type'] = $application_data['product_name'];

	$response_data_set['application_price_formatted'] = '<span>' . $pricingData['application_items_title'] . '<span class="text-15 text-light-gray"> : ' . $application_data['product_name'] . '</span></span><span class="' . ($application_price <= 0 ? 'beton-price-zero-entry' : '') . '">' . wc_price($application_price) . '</span>';

	// $sub_total += $application_price;
	// Compounds
	$compound_total = 0;
	if (!empty($selected_compounds) && is_array($selected_compounds)) {
		$pricingData = get_field('application', 'option');
		foreach ($selected_compounds as $compound) {
			$compound_data = getDataByProperty($pricingData['compound_items'], 'product_name', $compound);
			if (empty($compound_data) || !isset($compound_data['price_excl_tax'])) {
				continue;
			}
			$compound_price = $compound_data['price_excl_tax'] * $cubic_meters;
			$response_data_set[$compound] = $compound_price;
			$compound_total += $compound_price;
			$response_data_set[$compound . '_formatted'] = '<span>' . $compound_data['product_name'] . '</span><span>' . wc_price($compound_price) . '</span>';
		}
	}

	$application_compound_total = $compound_total + $application_price;
	$response_data_set['application_compound_total'] = $application_compound_total;
	$response_data_set['application_compound_total_formatted'] = '<span>' . __('Totaal', 'beton') . '</span><span>' . wc_price($application_compound_total) . '</span>';
	$sub_total += $application_compound_total;

	$travel_distance = isset($_COOKIE['travelling_distance']) ? $_COOKIE['travelling_distance'] : 0;

	if ($selected_release_method !== 'gutter') {
		if ($selected_pump_type == 'mini') {
			$mini_pump_cost = get_field('mini_betonpomp_cost', 'option');
			$pump_callout_fee = get_field('mini_pump_call-out_fee', 'option');
			$pump_callout_min_distance_cost = get_field('call-out_min_distance', 'option');
			$pumping_cost = get_field('pumping_distance_cost_per_m', 'option');
			$pumping_extra_hose_cost = get_field('extra_pipeline_trolley_cost', 'option');
			$all_in_price = get_field('all-in_price', 'option');
			$ground_flooring_cost = get_field('ground_floor_cost', 'option');
			$travel_cost = $travel_distance * $pump_callout_fee;

			if ($travel_cost < $pump_callout_min_distance_cost) {
				$travel_cost = $pump_callout_min_distance_cost;
			}

			$response_data_set['pump_callout_cost'] = $travel_cost;
			$response_data_set['pump_callout_cost_formatted'] = wc_price($travel_cost);
			$sub_total += $travel_cost;

			$pumping_cost = $selected_pumping_distance * $pumping_cost;
			$response_data_set['pumping_cost'] = $pumping_cost;
			$response_data_set['pumping_cost_formatted'] = wc_price($pumping_cost);
			$sub_total += $pumping_cost;

			if ($selected_pumping_distance > 100) {
				$response_data_set['pumping_extra_hose_cost'] = $pumping_extra_hose_cost;
				$response_data_set['pumping_extra_hose_cost_formatted'] = wc_price($pumping_extra_hose_cost);
				$sub_total += $pumping_extra_hose_cost;
			} else {
				//$response_data_set['pumping_extra_hose_cost_formatted'] = wc_price(0);
				// unset($response_data_set['pumping_extra_hose_cost']);
				// unset($response_data_set['pumping_extra_hose_cost_formatted']);
				// $sub_total -= $pumping_extra_hose_cost;
			}

			$pumping_hours = 2;
			$remaining = 0;
			if ($cubic_meters > 12) {
				$remaining = ($cubic_meters - 12) * 5;
			}
			if ($selected_pumping_distance >= 70) {
				$remaining += $selected_pumping_distance - 70;
			}

			$pumping_hours = $pumping_hours + ($remaining / 60);

			$whole_hours = floor($pumping_hours);      // 1
			$fraction_hour = $pumping_hours - $whole_hours; // .25

			if ($whole_hours >= 2 && !empty($fraction_hour)) {
				$mini_pump_cost = $mini_pump_cost * $pumping_hours;
			} elseif ($whole_hours >= 2) {
				$mini_pump_cost = $mini_pump_cost * $whole_hours;
			} else {
				$mini_pump_cost = $mini_pump_cost * 2;
			}
			$response_data_set['pump_cost'] = $mini_pump_cost;
			$response_data_set['pump_cost_formatted'] = wc_price($mini_pump_cost);
			$sub_total += $mini_pump_cost;

			if ($selected_performance == 'allIn') {
				$extra_price = 0;
				$allInConcreteThreshold = get_field('all_in_concrete_threshold', 'option');
				$allInConcreteThresholdOverPrice = get_field('overlimit_price_per_cubic_m', 'option');

				// 				wc_get_logger()->debug( 'All in price1: ' . $all_in_price);

				if ($cubic_meters > floatval($allInConcreteThreshold)) {
					$all_in_price += (floatval($cubic_meters) - floatval($allInConcreteThreshold)) * 5;

					$all_in_price += (floatval($cubic_meters) - floatval($allInConcreteThreshold)) * floatval($allInConcreteThresholdOverPrice);
				}

				// 				wc_get_logger()->debug( 'All in price2: ' . $all_in_price);
// 				wc_get_logger()->debug( 'All in concrete threshold: ' . $allInConcreteThreshold);
// 				wc_get_logger()->debug( 'All in concrete threshold over price: ' . $allInConcreteThresholdOverPrice);
// 				wc_get_logger()->debug( 'Cubic meters: ' . $cubic_meters);
// 				wc_get_logger()->debug( 'Calc amount: ' . (floatval($cubic_meters) - floatval($allInConcreteThreshold)) * floatval($allInConcreteThresholdOverPrice));

				if ($selected_pumping_distance > 40) {
					$extra_price += ($selected_pumping_distance - 40);
				}

				$thickness_cost = 0;
				if ($selected_layer_thickness == '5-10') {
					$thickness_cost = $all_in_price * 0.1;
					$all_in_price += $thickness_cost;
				} elseif ($selected_layer_thickness == '11-15') {
					$thickness_cost = $all_in_price * 0.05;
					$all_in_price += $thickness_cost;
				}
				if ($thickness_cost > 0) {
					$response_data_set['thickness_cost'] = $thickness_cost;
					$response_data_set['thickness_cost_formatted'] = wc_price($thickness_cost);
					// $sub_total += $thickness_cost;
				}

				if ($selected_rooms > 0) {
					$room_cost = $selected_rooms * 15;

					//Start - New code lines - 2/9/2025
					// $flooring_price = get_field('oppervlakte', 'option');	

					// foreach($flooring_price as $floor_price){
					// 	if($floor_price['size'] == $selected_surface){
					// 		if(!empty($floor_price['total_cost'][$selected_rooms . '_rooms'])) {
					// 			$room_cost = $floor_price['total_cost'][$selected_rooms . '_rooms'];
					// 		} else {
					// 			$room_cost = $selected_rooms * 15;
					// 		}
					// 		break;
					// 	}
					// }
					//End - New code lines - 2/9/2025

					$extra_price += $room_cost;
					$response_data_set['rooms_cost'] = $room_cost;
					$response_data_set['rooms_formatted'] = wc_price($room_cost);
					// $sub_total += $room_cost;
				}

				if ($travel_distance > 40) {
					$extra_price += ($travel_distance * 0.35);
				}

				if (boolval($selected_butterfly_floor) !== false || intval($selected_butterfly_floor) !== 0) {
					// $extra_price += 50;

					// $flooring_price = get_field('oppervlakte', 'option');
					// $butterfly_price = 0;
					// foreach($flooring_price as $floor_price){
					// wc_get_logger()->debug('surface: ' . ($selected_surface) . ' and loop ' . $floor_price['size']);

					// 	if($floor_price['size'] == $selected_surface){
					// 		$butterfly_price = $floor_price['cost'];
					// 		break;
					// 	}
					// }
					// if($selected_rooms > 0){
					// 	$butterfly_price += $selected_rooms * 25;
					// }

					$butterfly_price = butterfly_coster($selected_surface, $selected_rooms);
					$response_data_set['butterfly_floor_cost'] = $butterfly_price;
					$response_data_set['butterfly_floor_formatted'] = wc_price($butterfly_price);
					$sub_total += $butterfly_price;
				}

				if (boolval($selected_ground_floor) !== false || intval($selected_ground_floor) !== 0) {
					$extra_price += floatval($ground_flooring_cost);
					// $response_data_set['ground_floor_cost'] = $ground_flooring_cost;
					// $response_data_set['ground_floor_formatted'] = wc_price($ground_flooring_cost);
					// wc_get_logger()->debug('ground floor selected so ground_flooring_cost there: ' . ($selected_ground_floor));
				}

				$all_in_price += $extra_price;

				$response_data_set['allIn_cost'] = $all_in_price;
				$response_data_set['allIn_formatted'] = wc_price($all_in_price);
				$sub_total += $all_in_price;
			}
		} elseif ($selected_pump_type == 'boom') {

			$boomPumpPricing = get_field('boom_pumping_prices', 'option');

			if ($boomPumpPricing) {
				$firstBoomPompDistance = $boomPumpPricing[0]['pumping_distance'];

				if (empty($selected_pumping_distance) OR intval($selected_pumping_distance) < $firstBoomPompDistance) {
					$selected_pumping_distance = $firstBoomPompDistance;
				}

				foreach ($boomPumpPricing as $boomPumpPrice) {

					if ((int) $selected_pumping_distance !== (int) $boomPumpPrice['pumping_distance']) {
						continue;
					}

					$boom_price = 0;

					$boomPompPricingLogics = $boomPumpPrice['pricing_logic'];

					if (!empty($boomPompPricingLogics)) {
						foreach ($boomPompPricingLogics as $logic) {
							$threshold = (float) $logic['cubic_meters'];
							$operand = trim($logic['operand']);
							$base_price = (float) $logic['boom_price'];
							$addition_by = (float) $logic['addition_by'];

							$comparison = false;

							switch ($operand) {
								case '<':
									$comparison = $cubic_meters < $threshold;
									break;
								case '<=':
									$comparison = $cubic_meters <= $threshold;
									break;
								case '>':
									$comparison = $cubic_meters > $threshold;
									break;
								case '>=':
									$comparison = $cubic_meters >= $threshold;
									break;
							}

							if ($comparison) {

								// PRICE FORMULA:
								// If addition_by = 0 - fixed price
								// If addition_by > 0 - base + (cubic_meters * addition_by)

								if ($addition_by > 0) {
									$boom_price = $base_price + ($cubic_meters * $addition_by);
								} else {
									$boom_price = $base_price;
								}

								break; // stop after first matching rule
							}
						}
					}

					// EXTRA RULE: Minimum price enforcement
					$firstBoomPompPricingLogicMeters = $boomPumpPricing[0]['pricing_logic'][0]['cubic_meters'];
					$boomPompFailSafeLimit = $boomPumpPrice['fail_safe_limit'];
					$boomPompFailSafeValue = $boomPumpPrice['fail_safe_value'];

					if ((int) $selected_pumping_distance === (int) $boomPumpPricing[0]['pumping_distance']) {
						if ($cubic_meters > $firstBoomPompPricingLogicMeters && $boom_price < $boomPompFailSafeLimit) {
							$boom_price = $boomPompFailSafeValue;
						}
					} else {
						if ($boom_price < $boomPompFailSafeLimit) {
							$boom_price = $boomPompFailSafeValue;
						}
					}

				}

			} else {

				if (empty($selected_pumping_distance) OR intval($selected_pumping_distance) < 20) {
					$selected_pumping_distance = 20;
				}

				$boom_price = 0;

				switch ((int) $selected_pumping_distance) {
					case 20:
						if ($cubic_meters <= 7) {
							$boom_price = 300;
						} elseif ($cubic_meters < 51) {
							$boom_price = 275 + ($cubic_meters * 6.25);
						} elseif ($cubic_meters < 101) {
							$boom_price = 275 + ($cubic_meters * 5.50);
						} elseif ($cubic_meters < 151) {
							$boom_price = 275 + ($cubic_meters * 5.1);
						} elseif ($cubic_meters < 201) {
							$boom_price = 275 + ($cubic_meters * 4.9);
						} elseif ($cubic_meters < 301) {
							$boom_price = 275 + ($cubic_meters * 4.55);
						} elseif ($cubic_meters < 401) {
							$boom_price = 275 + ($cubic_meters * 4.40);
						} elseif ($cubic_meters < 501) {
							$boom_price = 275 + ($cubic_meters * 4.20);
						} elseif ($cubic_meters < 601) {
							$boom_price = 275 + ($cubic_meters * 4.05);
						} elseif ($cubic_meters >= 601) {
							$boom_price = 275 + ($cubic_meters * 3.95);
						}
						if ($cubic_meters > 7 && $boom_price < 375) {
							$boom_price = 375;
						}
						break;
					case 30:
						if ($cubic_meters < 51) {
							$boom_price = 285 + ($cubic_meters * 6.35);
						} elseif ($cubic_meters < 101) {
							$boom_price = 285 + ($cubic_meters * 5.60);
						} elseif ($cubic_meters < 151) {
							$boom_price = 285 + ($cubic_meters * 5.2);
						} elseif ($cubic_meters < 201) {
							$boom_price = 285 + ($cubic_meters * 5.0);
						} elseif ($cubic_meters < 301) {
							$boom_price = 285 + ($cubic_meters * 4.65);
						} elseif ($cubic_meters < 401) {
							$boom_price = 285 + ($cubic_meters * 4.50);
						} elseif ($cubic_meters < 501) {
							$boom_price = 285 + ($cubic_meters * 4.30);
						} elseif ($cubic_meters < 601) {
							$boom_price = 285 + ($cubic_meters * 4.15);
						} elseif ($cubic_meters >= 601) {
							$boom_price = 285 + ($cubic_meters * 4.05);
						}
						if ($boom_price < 385) {
							$boom_price = 385;
						}
						break;
					case 38:
						if ($cubic_meters < 101) {
							$boom_price = 415 + ($cubic_meters * 5.2);
						} elseif ($cubic_meters < 201) {
							$boom_price = 415 + ($cubic_meters * 4.70);
						} elseif ($cubic_meters < 301) {
							$boom_price = 415 + ($cubic_meters * 4.40);
						} elseif ($cubic_meters < 401) {
							$boom_price = 415 + ($cubic_meters * 4.15);
						} elseif ($cubic_meters < 501) {
							$boom_price = 415 + ($cubic_meters * 3.65);
						} elseif ($cubic_meters >= 501) {
							$boom_price = 415 + ($cubic_meters * 3.45);
						}
						if ($boom_price < 540) {
							$boom_price = 540;
						}
						break;
					case 48:
						if ($cubic_meters < 51) {
							$boom_price = 650 + ($cubic_meters * 5.7);
						} elseif ($cubic_meters < 1001) {
							$boom_price = 650 + ($cubic_meters * 5.4);
						}
						if ($boom_price < 1050) {
							$boom_price = 1050;
						}
						break;
					case 54:
						if ($cubic_meters < 51) {
							$boom_price = 790 + ($cubic_meters * 5.7);
						} elseif ($cubic_meters < 1001) {
							$boom_price = 790 + ($cubic_meters * 5.4);
						}
						if ($boom_price < 1250) {
							$boom_price = 1250;
						}
						break;
					case 59:
						if ($cubic_meters < 51) {
							$boom_price = 900 + ($cubic_meters * 5.7);
						} elseif ($cubic_meters < 1001) {
							$boom_price = 900 + ($cubic_meters * 5.4);
						}
						if ($boom_price < 1400) {
							$boom_price = 1400;
						}
						break;
				}

			}

			$response_data_set['pump_cost'] = $boom_price;
			$response_data_set['pump_cost_formatted'] = wc_price($boom_price);
			$sub_total += $boom_price;

			if ($selected_performance == 'allIn') {
				$all_in_price = get_field('all-in_price', 'option');
				$ground_flooring_cost = get_field('ground_floor_cost', 'option');

				$extra_price = 0;
				$remaining_concrete = 0;
				$remaining_pump_distance = 0;

				if ($cubic_meters > 12) {
					$remaining_concrete = $cubic_meters - 12;
					$all_in_price += ($remaining_concrete * 4);
				}
				if ($selected_pumping_distance > 40) {
					$remaining_pump_distance = $selected_pumping_distance - 40;
					$extra_price += ($remaining_pump_distance * 1);
				}


				if (isset($selected_layer_thickness)) {
					$thickness_pricing = get_field('thickness_pricing', 'option');
					$thickness_prices = [];
					foreach ($thickness_pricing as $thickness_price) {
						$thickness_prices[$thickness_price['thickness']] = $thickness_price['cost'];
					}
					wc_get_logger()->debug(json_encode($thickness_prices));
					if ($selected_layer_thickness == '5-10') {
						$all_in_price += ($all_in_price * $thickness_prices['5-10']);

					} elseif ($selected_layer_thickness == '11-15') {
						$all_in_price += ($all_in_price * $thickness_prices['11-15']);
					}
				}

				if (isset($selected_rooms) && $selected_rooms >= 1) {
					$extra_price += (intval($selected_rooms) * 35);
				}

				// if($travel_distance > 40){
				// 	$extra_price += ($travel_distance * 0.5);
				// 	wc_get_logger()->debug('travel_distance > 40 : travel_distance ' . $travel_distance);
				// }

				if (boolval($selected_ground_floor) !== false || intval($selected_ground_floor) !== 0) {
					$extra_price += floatval($ground_flooring_cost);
				}

				$all_in_price += ($extra_price);
				$all_in_price += 100; //extra man voor giekpomp

				$response_data_set['allIn_cost'] = $all_in_price;
				$response_data_set['allIn_formatted'] = wc_price($all_in_price);
				$sub_total += $all_in_price;

				if (boolval($selected_butterfly_floor) !== false || intval($selected_butterfly_floor) !== 0) {
					$butterfly_price = butterfly_coster($selected_surface, $selected_rooms);
					$response_data_set['butterfly_floor_cost'] = $butterfly_price;
					$response_data_set['butterfly_floor_formatted'] = wc_price($butterfly_price);
					$sub_total += $butterfly_price;
				}
			}
		}
	}

	$response_data_set['sub_total'] = $sub_total;
	$response_data_set['sub_total_formatted'] = wc_price($sub_total);
	$response_data_set['btw'] = ($sub_total / 100) * 21;
	$response_data_set['btw_formatted'] = wc_price($response_data_set['btw']);

	$response_data_set['sub_total_btw'] = $sub_total + $response_data_set['btw'];
	$response_data_set['total_formatted'] = wc_price($response_data_set['sub_total_btw']);

	// 	wc_get_logger()->debug(json_encode($response_data_set));

	if ($data !== null && is_array($data) && count($data) > 0) {
		return $response_data_set;
	} else {
		wp_send_json_success([
			'dynamic_pricing' => $response_data_set
		]);
	}
}

function butterfly_coster($selected_surface, $selected_rooms): float
{
	$flooring_price = get_field('oppervlakte', 'option');
	$butterfly_price = 0;
	if (is_array($flooring_price)) {
		foreach ($flooring_price as $floor_price) {
			if (isset($floor_price['size']) && $floor_price['size'] == $selected_surface) {
				$butterfly_price = floatval($floor_price['cost']);
				break;
			}
		}
	}
	if ($selected_rooms > 0) {
		$butterfly_price += $selected_rooms * 25;
	}
	return (float) $butterfly_price;
}

// New butterfly_coster function updated at - 2/9/2025
// function butterfly_coster($selected_surface, $selected_rooms) : float {
// 	$flooring_price = get_field('oppervlakte', 'option');
// 	$butterfly_price = 0;
// 	foreach($flooring_price as $floor_price){
// 		if($floor_price['size'] == $selected_surface){
// 			if($selected_rooms > 0){
// 				if(!empty($floor_price['total_cost']['butterfly_' . $selected_rooms . '_rooms'])) {
// 					$butterfly_price = $floor_price['total_cost']['butterfly_' . $selected_rooms . '_rooms'];
// 				} else {
// 					$butterfly_price = $floor_price['cost'];
// 					$butterfly_price += $selected_rooms * 25;
// 				}
// 			} else {
// 				$butterfly_price = $floor_price['cost'];
// 			}
// 			break;
// 		}
// 	}
// 	return $butterfly_price;
// }

function theme_wc_setup()
{
	remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
	add_action('woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 20);
}
add_action('after_setup_theme', 'theme_wc_setup');

add_action('wp_ajax_save_quotation', 'save_quotation');
add_action('wp_ajax_nopriv_save_quotation', 'save_quotation');
function save_quotation($calc_data = null)
{

	if (empty($calc_data)) {
		$data = $_POST;
		unset($data['action']);

		wc_get_logger()->debug(json_encode($data));

		$data['city'] = $data['postalcode'];
		$calc_data = $data;
		$calc_data['application'] = isset($_POST['application_product']) ? $_POST['application_product'] : '';
		$calc_data['compounds'] = isset($_POST['composition']) ? $_POST['composition'] : [];
		$calc_data['release_method'] = isset($_POST['unloading']) ? $_POST['unloading'] : '';
		$raw_pump_type = isset($_POST['pump_type']) ? $_POST['pump_type'] : (isset($_POST['pump-type']) ? $_POST['pump-type'] : '');
		$is_boom_post = (stripos($raw_pump_type, 'boom') !== false || stripos($raw_pump_type, 'giek') !== false);
		$calc_data['pump_type'] = $is_boom_post ? 'boom' : 'mini';
		$calc_data['pumping_distance'] = !$is_boom_post
			? (isset($_POST['pumping_distance']) ? $_POST['pumping_distance'] : (isset($_POST['pump_type_grp_pumping_distance']) ? $_POST['pump_type_grp_pumping_distance'] : 0))
			: (isset($_POST['boom_pumping_distance']) ? $_POST['boom_pumping_distance'] : (isset($_POST['pump_type_grp_boom_pumping_distance']) ? $_POST['pump_type_grp_boom_pumping_distance'] : 0));
		$calc_data['performance'] = isset($_POST['uitvoering']) ? $_POST['uitvoering'] : '';
		$calc_data['layer_thickness'] = isset($_POST['layer-thickness']) ? $_POST['layer-thickness'] : '';
		$calc_data['rooms_count'] = isset($_POST['nos_rooms']) ? $_POST['nos_rooms'] : 0;
		$calc_data['butterfly_floor'] = isset($_POST['butterfly-floor']) ? $_POST['butterfly-floor'] : 0;
		$calc_data['surface'] = isset($_POST['surace-sqm']) ? $_POST['surace-sqm'] : '';
		$calc_data['selected_floor'] = isset($_POST['flooring']) ? $_POST['flooring'] : 0;
	} else {
		$data = $calc_data;
	}

	$calcuated_data = beton_calculator($calc_data);
	// 	wc_get_logger()->debug('Data to save quotation');
// 	wc_get_logger()->debug(json_encode($calcuated_data));

	$quote = array(
		'post_title' => 'New Price Quotation',
		'post_status' => 'publish',
		'post_type' => 'concrete_quotation'
	);
	$quote_id = wp_insert_post($quote);

	$data['beton_samenstelling_cubic_meters'] = $data['cubic_meters'];
	$data['beton_samenstelling_postalcode'] = $data['postalcode'];
	$data['beton_cost'] = $calcuated_data['beton_price'];

	$data['additional_butterfly-floor'] = isset($data['butterfly-floor']) ? $data['butterfly-floor'] : 0;
	$data['additional_flooring'] = isset($data['flooring']) ? $data['flooring'] : 0;
	$data['additional_nos_rooms'] = isset($data['nos_rooms']) ? $data['nos_rooms'] : 0;
	$data['additional_layer-thickness'] = isset($data['layer-thickness']) ? $data['layer-thickness'] : '';
	$data['additional_surace-sqm'] = isset($data['surace-sqm']) ? $data['surace-sqm'] : '';
	$data['travelling_distance'] = isset($_COOKIE['travelling_distance']) ? $_COOKIE['travelling_distance'] : 0;

	if (isset($data['unloading']) && $data['unloading'] == 'pump') {
		$raw_pt = isset($data['pump_type']) ? $data['pump_type'] : (isset($data['pump-type']) ? $data['pump-type'] : '');
		$is_b = (stripos($raw_pt, 'boom') !== false || stripos($raw_pt, 'giek') !== false);
		$norm_pt = $is_b ? 'boom' : 'mini';
		$data['pump_type'] = $norm_pt;
		$data['pump_type_grp_pump_type'] = $norm_pt;
		if (isset($data['pumping_distance'])) {
			$data['pump_type_grp_pumping_distance'] = $data['pumping_distance'];
		}
		if (isset($data['boom_pumping_distance'])) {
			$data['pump_type_grp_boom_pumping_distance'] = $data['boom_pumping_distance'];
		}
	}

	foreach ($data as $key => $value) {
		// update_field($key, $value, $quote_id);
		update_post_meta($quote_id, $key, $value);
	}

	$quote_update = array(
		'ID' => $quote_id,
		'post_title' => 'Offerte #' . $quote_id
	);
	wp_update_post($quote_update);

	$totals = array(
		'totals_brandstoftoeslag' => $calcuated_data['brandstoftoeslag'] ?? 0,
		'totals_laagwatertoeslag' => $calcuated_data['laagwatertoeslag'] ?? 0,
		'totals_aantal_cost' => $calcuated_data['sub_total_btw'] ?? 0,
		'totals_toepassing_cost' => $calcuated_data['application_price'] ?? 0,
		'totals_hoog_vloeibaar_cost' => $calcuated_data['hoog-vloeibaar'] ?? 0,
		'totals_snelhardend_cost' => $calcuated_data['snelhardend'] ?? 0,
		'totals_vlinderbeton_cost' => $calcuated_data['vlinderbeton'] ?? 0, //new line added - 2025.12.09
		'totals_fijn_grind_cost' => $calcuated_data['fijn-grind'] ?? 0,
		'totals_extra_hoge_sterkte_cost' => $calcuated_data['hoge-sterkte'] ?? 0,
		'totals_top_totals' => $calcuated_data['application_compound_total'] ?? 0,
		'totals_pump_cost' => $calcuated_data['pump_cost'] ?? 0,
		'totals_voorrijkosten_cost' => $calcuated_data['pump_callout_cost'] ?? 0,
		'totals_pumping_distance_cost' => $calcuated_data['pumping_cost'] ?? 0,
		'totals_toeslag_extra_leidingwagen_cost' => $calcuated_data['pumping_extra_hose_cost'] ?? 0,
		'totals_all-in_uitvoering_cost' => $calcuated_data['allIn_cost'] ?? 0,
		'totals_vlindervloer_cost' => $calcuated_data['butterfly_floor_cost'] ?? 0,
		'totals_subtotal' => $calcuated_data['sub_total'] ?? 0,
		'totals_btw' => $calcuated_data['btw'] ?? 0,
		'totals_grand_total' => $calcuated_data['sub_total_btw'] ?? 0,
	);
	foreach ($totals as $key => $value) {
		// update_field($key, $value, $quote_id);
		update_post_meta($quote_id, $key, $value);
	}

	do_action('acf/save_post', $quote_id);

	$pdf_data = quotation_html($quote_id);

	if (isset($calc_data['api_request']) && $calc_data['api_request'] == true) {
		return $pdf_data;
	} else {
		send_quotation_email($pdf_data, $data['user_email'], $quote_id);

		wp_send_json_success([
			'status' => 'mail-sent',
			'redirect' => get_field('thank_you_page', 'option')
		]);
	}
}

function custom_wc_price($price, $args = array())
{
	$original_price = $price;
	$price = (float) $price;

	$thousand_sep = isset($args['thousand_separator']) ? $args['thousand_separator'] : (function_exists('wc_get_price_thousand_separator') ? wc_get_price_thousand_separator() : '.');
	$decimal_sep = isset($args['decimal_separator']) ? $args['decimal_separator'] : (function_exists('wc_get_price_decimal_separator') ? wc_get_price_decimal_separator() : ',');
	$decimals = isset($args['decimals']) ? absint($args['decimals']) : (function_exists('wc_get_price_decimals') ? wc_get_price_decimals() : 2);

	$negative = $price < 0;
	$formatted_number = number_format($negative ? $price * -1 : $price, $decimals, $decimal_sep, $thousand_sep);

	if (apply_filters('woocommerce_price_trim_zeros', false) && $decimals > 0) {
		$formatted_number = wc_trim_zeros($formatted_number);
	}
	$currency_symbol = function_exists('get_woocommerce_currency_symbol') ? get_woocommerce_currency_symbol() : '€';
	$return = ($negative ? '-' : '') . $currency_symbol . ' ' . $formatted_number;

	return $return;
}

function findReplaceValue(string $seekValue): ?string
{
	$data = get_field('replacer', 'option');
	if (is_array($data)) {
		foreach ($data as $item) {
			if (!empty($item['seek']) && strtolower($item['seek']) === strtolower($seekValue)) {
				return $item['replace'];
			}
		}
	}

	return $seekValue; // return false if not found
}

function test_pdf()
{
	if (empty($_GET['download_pdf'])) {
		return;
	}

	// echo $data['html'];
	$quote_id = $_GET['download_pdf'];
	$data = quotation_html($quote_id);

	// 	send_quotation_email($data, 'harshana@dayzsolutions.com', $quote_id);

	stream_pdf_file($data['html'], $data['id'], $data['title'], true);
}
add_action('init', 'test_pdf');

function quotation_html($quote_id)
{
	$m = function ($key) use ($quote_id) {
		$val = get_post_meta($quote_id, $key, true);
		if ($val !== '' && $val !== null && $val !== false) {
			return $val;
		}
		$fallbacks = [
			'pump_type' => ['pump_type_grp_pump_type', 'pump_type_pump_type'],
			'pumping_distance' => ['pump_type_grp_pumping_distance', 'pump_type_pumping_distance'],
			'boom_pumping_distance' => ['pump_type_grp_boom_pumping_distance', 'pump_type_boom_pumping_distance'],
			'unloading' => ['release_method'],
			'beton_samenstelling_postalcode' => ['postalcode'],
			'beton_samenstelling_cubic_meters' => ['cubic_meters'],
			'application_product' => ['application'],
			'additional_surace-sqm' => ['surace-sqm'],
			'additional_layer-thickness' => ['layer-thickness'],
			'additional_flooring' => ['flooring'],
			'additional_nos_rooms' => ['nos_rooms'],
			'additional_butterfly-floor' => ['butterfly-floor'],
		];
		if (isset($fallbacks[$key])) {
			foreach ($fallbacks[$key] as $fb) {
				$v = get_post_meta($quote_id, $fb, true);
				if ($v !== '' && $v !== null && $v !== false) {
					return $v;
				}
			}
		}
		return '';
	};
	$city = $m('beton_samenstelling_postalcode');
	$cubic_m = floatval($m('beton_samenstelling_cubic_meters'));
	$per_m3 = $cubic_m > 0 ? $cubic_m : 1;
	$cubic_label = $m('beton_samenstelling_cubic_meters');

	$created = get_the_date('Y-m-d', $quote_id);
	if (!$created) {
		$created = current_time('Y-m-d');
	}
	$date = date('d-m-Y', strtotime($created));
	$valid_until = date('d-m-Y', strtotime('+1 month', strtotime($created)));

	// Build line items: type = 'head' | 'line' | 'info'
	$rows = [];
	$rows[] = ['head', 'Beton'];
	$rows[] = ['line', $cubic_label . ' m³ beton' . ($city ? ' te ' . $city : ''), $cubic_label . ' m³', custom_wc_price(floatval($m('beton_cost')) / $per_m3), custom_wc_price($m('beton_cost'))];

	$brandstoftoeslag = floatval($m('totals_brandstoftoeslag'));
	if ($brandstoftoeslag > 0) {
		$rows[] = ['line', findReplaceValue('Brandstoftoeslag'), $cubic_label . ' m³', custom_wc_price($brandstoftoeslag / $per_m3), custom_wc_price($brandstoftoeslag)];
	}

	$laagwatertoeslag = floatval($m('totals_laagwatertoeslag'));
	if ($laagwatertoeslag > 0) {
		$rows[] = ['line', findReplaceValue('Laagwatertoeslag'), $cubic_label . ' m³', custom_wc_price($laagwatertoeslag / $per_m3), custom_wc_price($laagwatertoeslag)];
	}

	$totals_toepassing = $m('totals_toepassing_cost');
	if (!empty($totals_toepassing) && floatval($totals_toepassing) > 0) {
		$application_product = trim(strtolower($m('application_product')));
		$seek = (!empty($application_product) && $application_product != '0') ? 'Toepassing - ' . $application_product : 'Toepassing';
		$rows[] = ['line', findReplaceValue($seek), $cubic_label, custom_wc_price(floatval($totals_toepassing) / $per_m3), custom_wc_price($totals_toepassing)];
	}

	$compounds = [
		'totals_hoog_vloeibaar_cost' => 'Hoog vloeibaar',
		'totals_snelhardend_cost' => 'Snelhardend',
		'totals_fijn_grind_cost' => 'Fijn grind',
		'totals_extra_hoge_sterkte_cost' => 'Hoge sterkte',
		'totals_vlinderbeton_cost' => 'Vlinderbeton',
	];
	foreach ($compounds as $key => $label) {
		$cost = floatval($m($key));
		if ($cost > 0) {
			$rows[] = ['line', findReplaceValue($label), $cubic_label, custom_wc_price($cost / $per_m3), custom_wc_price($cost)];
		}
	}

	$rows[] = ['head', findReplaceValue('Los methode')];
	$unloading = $m('unloading');
	if ($unloading) {
		$rows[] = ['line', $unloading == 'pump' ? 'Pomp' : ($unloading == 'gutter' ? 'Uit de goot / kruiwagen' : $unloading), '', '', ''];
	}

	$pump_type = trim((string) $m('pump_type'));
	$boom_dist = $m('boom_pumping_distance');
	$pumping_dist = $m('pumping_distance');
	$callout = floatval($m('totals_voorrijkosten_cost'));

	$is_boom = false;
	$is_mini = false;
	if ($callout > 0 || stripos($pump_type, 'mini') !== false) {
		$is_mini = true;
	} elseif (stripos($pump_type, 'boom') !== false || stripos($pump_type, 'giek') !== false) {
		if (floatval($pumping_dist) > 0 && empty($boom_dist) && floatval($m('totals_pumping_distance_cost')) > 0) {
			$is_mini = true;
		} else {
			$is_boom = true;
		}
	} else {
		if (floatval($boom_dist) > 0 && floatval($pumping_dist) == 0) {
			$is_boom = true;
		} else {
			$is_mini = true;
		}
	}

	$pump_cost = floatval($m('totals_pump_cost'));
	if ($pump_cost > 0) {
		$label = $is_mini ? 'Mini betonpomp' : ('Giekpomp' . (!empty($boom_dist) ? ': ' . $boom_dist . 'm' : ''));
		$rows[] = ['line', $label, '', '', custom_wc_price($pump_cost)];
	}
	if ($callout > 0) {
		$rows[] = ['line', findReplaceValue('Voorrijkosten'), '1', custom_wc_price($callout), custom_wc_price($callout)];
	}
	$extra_hose = floatval($m('totals_toeslag_extra_leidingwagen_cost'));
	if ($extra_hose > 0) {
		$rows[] = ['line', findReplaceValue('Toeslag extra leidingwagen'), '', '', custom_wc_price($extra_hose)];
	}

	$distance = floatval($pumping_dist);
	$distance_price = floatval($m('totals_pumping_distance_cost'));
	if ($unloading != 'gutter') {
		if ($distance > 0 && ($is_mini || $distance_price > 0)) {
			$unit_price = $distance > 0 ? ($distance_price / $distance) : 0;
			$rows[] = ['line', findReplaceValue('Pompafstand'), $distance . 'm', custom_wc_price($unit_price), $distance_price > 0 ? custom_wc_price($distance_price) : ''];
		}
	}
	$all_in = floatval($m('totals_all-in_uitvoering_cost'));
	if ($all_in > 0) {
		$rows[] = ['line', findReplaceValue('All-in uitvoering'), '1', custom_wc_price($all_in), custom_wc_price($all_in)];
		$butterfly = floatval($m('totals_vlindervloer_cost'));
		if ($butterfly > 0) {
			$rows[] = ['line', findReplaceValue('Vlindervloer'), '', '', custom_wc_price($butterfly)];
		}
		$details = [
			'additional_surace-sqm' => ['Oppervlakte', ' m²'],
			'additional_layer-thickness' => ['Laagdikte', ''],
			'additional_flooring' => ['Verdiepingsvloer', ''],
			'additional_nos_rooms' => ['Aantal vertrekken', ''],
		];
		foreach ($details as $key => $def) {
			$val = $m($key);
			if (!empty($val)) {
				$rows[] = ['info', findReplaceValue($def[0]), $val . $def[1]];
			}
		}
	}

	$logo = wp_get_attachment_image(get_theme_mod('custom_logo'), 'medium');

	ob_start();
	?>
	<!DOCTYPE html>
	<html lang="nl">

	<head>
		<meta charset="utf-8">
		<title>Offerte #<?php echo esc_html($quote_id); ?> - Betonbestellen</title>
		<style>
			@page { margin: 30px 0 70px 0; }
			body { font-family: 'DejaVu Sans', Helvetica, Arial, sans-serif; font-size: 10px; color: #1f2937; margin: 0; line-height: 1.5; }
			table { border-collapse: collapse; width: 100%; }
			tr { page-break-inside: avoid; }
			td, th { vertical-align: top; }
			.top-bar { position: fixed; top: -30px; left: 0; right: 0; height: 8px; background: #FCA01A; }
			.page { padding: 12px 44px 0 44px; }
			.logo img { max-height: 46px; width: auto; }
			.brand-name { font-size: 16px; font-weight: bold; color: #111827; }
			.title { font-size: 30px; font-weight: bold; color: #111827; letter-spacing: 1px; text-align: right; }
			.title-sub { text-align: right; color: #9A3412; font-size: 11px; font-weight: bold; }
			.muted { color: #6b7280; }
			.label { font-size: 8px; text-transform: uppercase; letter-spacing: 1px; color: #9ca3af; font-weight: bold; }
			.val { font-size: 11px; font-weight: bold; color: #111827; }
			.meta { margin-top: 22px; background: #f8fafc; border: 1px solid #e5e7eb; }
			.meta td { padding: 9px 16px; width: 25%; }
			.items { margin-top: 22px; }
			.items th { background: #111827; color: #fff; font-size: 8.5px; text-transform: uppercase; letter-spacing: 1px; padding: 9px 12px; text-align: left; }
			.items td { padding: 5px 12px; border-bottom: 1px solid #eef0f3; }
			.items .head td { background: #FFF7ED; color: #9A3412; font-weight: bold; text-transform: uppercase; font-size: 8.5px; letter-spacing: 1px; border-bottom: 1px solid #FFEDD5; padding: 6px 12px; }
			.items .info td { color: #6b7280; font-size: 9px; padding-top: 2px; padding-bottom: 2px; }
			.r, .items th.r { text-align: right; }
			.totals { margin-top: 14px; page-break-inside: avoid; }
			.totals td { padding: 3px 12px; }
			.grand td { background: #FCA01A; color: #111827; font-size: 13px; font-weight: bold; padding: 8px 14px; }
			.notes { margin-top: 20px; page-break-inside: avoid; }
			.notes td { padding-right: 20px; font-size: 9px; color: #4b5563; }
			.footer { position: fixed; bottom: -70px; left: 0; right: 0; background: #111827; color: #d1d5db; padding: 14px 44px; font-size: 8.5px; }
			.footer b { color: #fff; }
			.terms { margin-top: 14px; page-break-inside: avoid; font-size: 7.5px; color: #9ca3af; line-height: 1.4; }
		</style>
	</head>

	<body>
		<div class="top-bar"></div>
		<div class="footer">
			<table>
				<tr>
					<td style="width: 34%;"><b>BetonBestellen B.V.</b><br>Ondernemersweg 4, 4691 SL Tholen</td>
					<td style="width: 33%;">Tel: 0166-604035<br>info@betonbestellen.nl</td>
					<td style="width: 33%; text-align: right;">KvK 66382386<br>BTW NL8565.25.352.B01</td>
				</tr>
			</table>
		</div>
		<div class="page">
			<table>
				<tr>
					<td style="width: 50%;">
						<div class="logo"><?php echo $logo ? $logo : '<span class="brand-name">BetonBestellen B.V.</span>'; ?></div>
					</td>
					<td style="width: 50%;">
						<div class="title">OFFERTE</div>
						<div class="title-sub">#<?php echo esc_html($quote_id); ?></div>
					</td>
				</tr>
			</table>

			<table class="meta">
				<tr>
					<td>
						<div class="label">Offertenummer</div>
						<div class="val">#<?php echo esc_html($quote_id); ?></div>
					</td>
					<td>
						<div class="label">Offertedatum</div>
						<div class="val"><?php echo esc_html($date); ?></div>
					</td>
					<td>
						<div class="label">Geldig tot</div>
						<div class="val"><?php echo esc_html($valid_until); ?></div>
					</td>
					<td>
						<div class="label">Aanvrager</div>
						<div class="val" style="font-size: 9px;"><?php echo esc_html($m('user_email')); ?></div>
					</td>
				</tr>
			</table>

			<table class="items">
				<thead>
					<tr>
						<th style="width: 46%;">Omschrijving</th>
						<th style="width: 16%;">Aantal</th>
						<th style="width: 18%;" class="r">Prijs</th>
						<th style="width: 20%;" class="r">Totaal</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($rows as $row): ?>
						<?php if ($row[0] === 'head'): ?>
							<tr class="head"><td colspan="4"><?php echo esc_html($row[1]); ?></td></tr>
						<?php elseif ($row[0] === 'info'): ?>
							<tr class="info"><td><?php echo esc_html($row[1]); ?></td><td colspan="3"><?php echo esc_html($row[2]); ?></td></tr>
						<?php else: ?>
							<tr>
								<td><?php echo esc_html($row[1]); ?></td>
								<td><?php echo esc_html($row[2]); ?></td>
								<td class="r"><?php echo $row[3]; ?></td>
								<td class="r"><strong><?php echo $row[4]; ?></strong></td>
							</tr>
						<?php endif; ?>
					<?php endforeach; ?>
				</tbody>
			</table>

			<table class="totals">
				<tr>
					<td style="width: 52%;"></td>
					<td>
						<table>
							<tr>
								<td class="muted">Subtotaal</td>
								<td class="r"><strong><?php echo custom_wc_price($m('totals_subtotal')); ?></strong></td>
							</tr>
							<tr>
								<td class="muted">BTW 21%</td>
								<td class="r"><strong><?php echo custom_wc_price($m('totals_btw')); ?></strong></td>
							</tr>
							<tr class="grand">
								<td>Totaal</td>
								<td class="r"><?php echo custom_wc_price($m('totals_grand_total')); ?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

			<table class="notes">
				<tr>
					<td style="width: 50%;">
						<div class="label">Betaling</div>
						Bank: NL67 ABNA 0548 7707 43<br>
						t.n.v. BetonBestellen B.V.
					</td>
					<td style="width: 50%;">
						<div class="label">Geldigheid</div>
						Deze offerte is geldig tot <?php echo esc_html($valid_until); ?>.
					</td>
				</tr>
			</table>

			<div class="terms">Op al onze leveringen en werkzaamheden zijn van toepassing de Algemene Verkoopvoorwaarden van de Vereniging van Ondernemingen van Betonmortelfabrikanten in Nederland voor het verpompen van betonmortel conform laatstelijk gedeponeerde versie ter griffie van de Arrondissementsrechtbank te 's-Gravenhage.</div>
		</div>

	</body>

	</html>
	<?php
	$html = ob_get_clean();
	return ['html' => $html, 'id' => $quote_id, 'title' => get_the_title($quote_id)];
}

// function test_pdf()
// {
// 	if (empty($_GET['download_pdf'])) {
// 		return;
// 	}

// 	// echo $data['html'];
// 	$quote_id = 160;
// 	$data = quotation_html(160);

// 	send_quotation_email($data, 'harshana@dayzsolutions.com', $quote_id);

// 	// stream_pdf_file($data['html'], $data['id'], $data['title'], true);
// }
// add_action('init', 'test_pdf');

function stream_pdf_file($contents, $id, $title, $is_stream = false)
{
	// Include autoloader 
	require_once 'inc/dompdf/autoload.inc.php';

	// Instantiate and use the dompdf class   
	$dompdf = new Dompdf\Dompdf();
	$dompdf->set_option('enable_html5_parser', TRUE);
	$dompdf->loadHtml($contents);
	// (Optional) Setup the paper size and orientation 
	$dompdf->setPaper('A4', 'Portrait');
	$dompdf->set_option('isRemoteEnabled', true);
	// Render the HTML as PDF 
	$dompdf->render();

	if (ob_get_level() > 0) {
		ob_end_clean();
	}

	if ($is_stream) {
		$dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
		return;
	} else {
		$pdf = $dompdf->output();
		$upload = wp_upload_bits($title . '.pdf', null, $pdf);
		if (empty($upload['error'])) {
			$attachment = array(
				'post_mime_type' => 'application/pdf',
				'post_title'     => sanitize_file_name($title),
				'post_content'   => '',
				'post_status'    => 'inherit'
			);
			$attach_id = wp_insert_attachment($attachment, $upload['file'], $id);
			return $attach_id;
		}
		return false;
	}
	exit(0);
}

function send_quotation_email($data, $email, $quote_id)
{
	$pdf_id = stream_pdf_file($data['html'], $data['id'], $data['title']);

	$to = $email;
	$headers = array();

	// Attachments: generated quotation PDF + optional static guides if present on disk
	$mail_attachment = array();
	$pdf_file = $pdf_id ? get_attached_file($pdf_id) : false;
	if ($pdf_file && file_exists($pdf_file)) {
		$mail_attachment[] = $pdf_file;
	}
	if (defined('WP_CONTENT_DIR')) {
		$aandacht_pdf = WP_CONTENT_DIR . '/uploads/2022/06/aandachtspunten.pdf';
		if (file_exists($aandacht_pdf)) {
			$mail_attachment[] = $aandacht_pdf;
		}
		$alv_pdf = WP_CONTENT_DIR . '/uploads/2022/06/alv.pdf';
		if (file_exists($alv_pdf)) {
			$mail_attachment[] = $alv_pdf;
		}
	}

	$unloading_method      = get_post_meta($quote_id, 'unloading', true) ?: get_post_meta($quote_id, 'release_method', true);
	$butterfly_floor       = get_post_meta($quote_id, 'additional_butterfly-floor', true) ?: get_post_meta($quote_id, 'butterfly-floor', true);
	$performance           = get_post_meta($quote_id, 'uitvoering', true) ?: get_post_meta($quote_id, 'performance', true);
	$cubic_m               = get_post_meta($quote_id, 'beton_samenstelling_cubic_meters', true) ?: get_post_meta($quote_id, 'cubic_meters', true);
	$city                  = get_post_meta($quote_id, 'beton_samenstelling_postalcode', true) ?: get_post_meta($quote_id, 'postalcode', true);
	$pump_type             = get_post_meta($quote_id, 'pump_type', true) ?: (get_post_meta($quote_id, 'pump_type_grp_pump_type', true) ?: get_post_meta($quote_id, 'pump_type_pump_type', true));
	$pumping_distance      = get_post_meta($quote_id, 'pumping_distance', true) ?: (get_post_meta($quote_id, 'pump_type_grp_pumping_distance', true) ?: get_post_meta($quote_id, 'pump_type_pumping_distance', true));
	$boom_pumping_distance = get_post_meta($quote_id, 'boom_pumping_distance', true) ?: (get_post_meta($quote_id, 'pump_type_grp_boom_pumping_distance', true) ?: get_post_meta($quote_id, 'pump_type_boom_pumping_distance', true));
	$total_cost            = get_post_meta($quote_id, 'totals_grand_total', true);

	if ($performance == 'allIn') {
		$dynamic_p = 'U heeft gekozen voor een All-in uitvoering waarbij het beton volledig ontzorgd wordt gestort.';
	} else {
		$dynamic_p = 'U heeft gekozen om het beton zelf te storten.';
	}

	$is_pump = in_array(strtolower((string) $unloading_method), ['pump', 'pomp']);

	if ($performance != 'allIn' and !$is_pump) {
		$dynamic_mail_txt = get_field('method_one', 'option');
	} elseif ($performance !== 'allIn' and $is_pump) {
		$dynamic_mail_txt = get_field('method_two', 'option');
	} elseif ($performance == 'allIn' and $is_pump and $butterfly_floor == 0) {
		$dynamic_mail_txt = get_field('method_three', 'option');
	} elseif ($performance == 'allIn' and $is_pump and $butterfly_floor) {
		$dynamic_mail_txt = get_field('method_four', 'option');
	}

	if (!isset($dynamic_mail_txt) or empty($dynamic_mail_txt)) {
		$dynamic_mail_txt = '<p style="margin: 0 0 12px; font-size: 14px; color: #475569; line-height: 1.6;">' . esc_html($dynamic_p) . '</p>
			<div style="background-color: #FFF7ED; border: 1px solid #FFEDD5; border-radius: 8px; padding: 16px 18px; margin: 18px 0;">
				<h4 style="margin: 0 0 8px; font-size: 14px; font-weight: 700; color: #9A3412; text-transform: uppercase; letter-spacing: 0.04em;">
					Belangrijke aandachtspunten voor de levering:
				</h4>
				<ul style="margin: 0; padding-left: 18px; font-size: 13px; color: #9A3412; line-height: 1.6;">
					<li style="margin-bottom: 6px;"><strong>Voldoende manschappen:</strong> Zorg voor voldoende helpers bij het verwerken. Er geldt een maximale lostijd van 45 min t/m 7 m³ en 75 min bij 15 m³.</li>
					<li style="margin-bottom: 6px;"><strong>Opstelplaats betonmixer:</strong> Maak voldoende vrije ruimte vrij voor de vrachtwagen (afmeting vergelijkbaar met een vuilniswagen).</li>
					<li style="margin-bottom: 6px;"><strong>Vergunning / Ontheffing:</strong> In sommige binnensteden is een doorgangs- of parkeervergunning vereist. Vraag deze tijdig aan.</li>
					<li><strong>Algemene voorwaarden:</strong> Op al onze leveringen zijn de leveringsvoorwaarden van toepassing (<a href="https://betonbestellen.nl/alv.pdf" target="_blank" style="color: #9A3412; font-weight: 700; text-decoration: underline;">zie alv.pdf</a>).</li>
				</ul>
			</div>';
	}

	$logo_url          = get_template_directory_uri() . '/images/beton-bestellen-white.png';
	$pay_url           = wc_get_checkout_url() . '?pay-url=' . encrypt_code($quote_id);
	$site_url          = home_url('/');
	$alv_url           = 'https://betonbestellen.nl/alv.pdf';

	$is_boom = (stripos($pump_type, 'boom') !== false || stripos($pump_type, 'giek') !== false);
	if ($is_pump) {
		if ($is_boom) {
			$unloading_label = 'Giekpomp' . (!empty($boom_pumping_distance) ? " ({$boom_pumping_distance}m)" : '');
		} else {
			$unloading_label = 'Mini betonpomp' . (!empty($pumping_distance) ? " ({$pumping_distance}m)" : '');
		}
	} else {
		$unloading_label = 'Uit de goot / kruiwagen';
	}
	$performance_label = ($performance == 'allIn') ? 'All-in ontzorgd' : 'Zelf storten';

	$html = '<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Offerte #' . esc_html($quote_id) . ' - Betonbestellen.nl</title>
</head>
<body style="margin: 0; padding: 0; background-color: #F4F6F8; font-family: \'Manrope\', -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation" style="background-color: #F4F6F8; width: 100%; margin: 0; padding: 32px 0;">
		<tr>
			<td align="center" valign="top">
				<div style="max-width: 600px; width: 100%; margin: 0 auto;">
					<!-- Main Card Container -->
					<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation" style="background-color: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(6, 12, 53, 0.04); max-width: 600px; width: 100%;">
						
						<!-- Header -->
						<tr>
							<td align="center" style="background-color: #060C35; padding: 28px 24px 24px; text-align: center; border-bottom: 3px solid #FCA01A;">
								<a href="' . esc_url($site_url) . '" target="_blank" style="text-decoration: none; display: inline-block;">
									<img src="' . esc_url($logo_url) . '" alt="Betonbestellen.nl" width="200" style="max-width: 200px; width: 200px; height: auto; border: 0; display: block; margin: 0 auto;" />
								</a>
							</td>
						</tr>

						<!-- Sub-heading Ribbon -->
						<tr>
							<td align="center" style="background-color: #0A1344; padding: 12px 24px; text-align: center;">
								<span style="color: #F8FAFC; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; display: inline-block;">
									Vrijblijvende Offerte &bull; #' . esc_html($quote_id) . '
								</span>
							</td>
						</tr>

						<!-- Body -->
						<tr>
							<td style="padding: 32px 32px 28px; text-align: left; color: #334155; font-size: 15px; line-height: 1.6;">
								
								<!-- Hero Badge & Title -->
								<div style="text-align: center; margin-bottom: 24px;">
									<table border="0" cellpadding="0" cellspacing="0" align="center" role="presentation" style="margin: 0 auto 14px;">
										<tr>
											<td style="background-color: #FFF7ED; border: 1px solid #FFEDD5; border-radius: 20px; padding: 5px 14px;">
												<span style="font-size: 12px; font-weight: 700; color: #C2410C; letter-spacing: 0.05em; text-transform: uppercase;">
													📄 Offerte gereed (PDF bijgevoegd)
												</span>
											</td>
										</tr>
									</table>

									<h1 style="font-size: 24px; font-weight: 800; color: #060C35; line-height: 1.3; margin: 0 0 10px;">
										Uw beton offerte is gereed
									</h1>

									<p style="font-size: 15px; color: #475569; line-height: 1.6; margin: 0 auto; max-width: 480px;">
										Geachte heer / mevrouw,<br>
										Hierbij ontvangt u ons vrijblijvende prijsvoorstel voor de levering van ca. <strong>' . esc_html($cubic_m) . ' m³</strong> beton te <strong>' . esc_html($city) . '</strong>.
									</p>
								</div>

								<!-- Quote Specification Card -->
								<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation" style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; margin-bottom: 24px; overflow: hidden;">
									<tr>
										<td style="padding: 14px 18px; border-bottom: 1px solid #E2E8F0; background-color: #F1F5F9;">
											<strong style="color: #060C35; font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em;">
												Overzicht Offerteberekening
											</strong>
										</td>
									</tr>
									<tr>
										<td style="padding: 16px 18px;">
											<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation">
												<tr>
													<td style="padding: 4px 0; font-size: 13px; color: #64748B;">Betonvolume:</td>
													<td align="right" style="padding: 4px 0; font-size: 14px; font-weight: 700; color: #060C35;">' . esc_html($cubic_m) . ' m³</td>
												</tr>
												<tr>
													<td style="padding: 4px 0; font-size: 13px; color: #64748B;">Locatie / Postcode:</td>
													<td align="right" style="padding: 4px 0; font-size: 14px; font-weight: 600; color: #1E293B;">' . esc_html($city) . '</td>
												</tr>
												<tr>
													<td style="padding: 4px 0; font-size: 13px; color: #64748B;">Loswijze:</td>
													<td align="right" style="padding: 4px 0; font-size: 14px; font-weight: 600; color: #1E293B;">' . esc_html($unloading_label) . '</td>
												</tr>';

	if ($is_pump && !$is_boom && !empty($pumping_distance) && floatval($pumping_distance) > 0) {
		$html .= '<tr>
					<td style="padding: 4px 0; font-size: 13px; color: #64748B;">Pompafstand:</td>
					<td align="right" style="padding: 4px 0; font-size: 14px; font-weight: 600; color: #1E293B;">' . esc_html($pumping_distance) . 'm</td>
				</tr>';
	}

	$html .= '<tr>
					<td style="padding: 4px 0; font-size: 13px; color: #64748B;">Uitvoering:</td>
					<td align="right" style="padding: 4px 0; font-size: 14px; font-weight: 600; color: #1E293B;">' . esc_html($performance_label) . '</td>
				</tr>';

	if (!empty($total_cost) && floatval($total_cost) > 0) {
		$html .= '<tr>
					<td style="padding: 12px 0 2px; font-size: 14px; font-weight: 800; color: #060C35; border-top: 1px dashed #CBD5E1;">Totaalbedrag (incl. 21% btw):</td>
					<td align="right" style="padding: 12px 0 2px; font-size: 17px; font-weight: 800; color: #C2410C; border-top: 1px dashed #CBD5E1;">' . wc_price($total_cost) . '</td>
				</tr>';
	}

	$html .= '</table>
										</td>
									</tr>
								</table>

								<!-- Dynamic Text / Method notes -->
								<div style="margin-bottom: 24px; font-size: 14px; color: #334155; line-height: 1.6;">
									' . $dynamic_mail_txt . '
								</div>

								<!-- CTA Button -->
								<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation" style="margin: 28px 0 24px;">
									<tr>
										<td align="center">
											<table border="0" cellpadding="0" cellspacing="0" role="presentation">
												<tr>
													<td align="center" style="background-color: #FCA01A; border-radius: 8px;">
														<a href="' . esc_url($pay_url) . '" target="_blank" style="display: inline-block; background-color: #FCA01A; color: #060C35 !important; font-family: \'Manrope\', Arial, sans-serif; font-size: 15px; font-weight: 800; text-decoration: none; padding: 15px 32px; border-radius: 8px; border: none; letter-spacing: 0.02em;">
															Afrekenen & Datum Reserveren &rarr;
														</a>
													</td>
												</tr>
											</table>
											<p style="margin: 10px 0 0; font-size: 12px; color: #64748B; text-align: center;">
												Veilig en direct betalen via iDeal om uw gewenste datum direct vast te leggen.
											</p>
										</td>
									</tr>
								</table>

								<!-- PDF Attachment Notification Callout -->
								<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation" style="background-color: #EFF6FF; border: 1px solid #BFDBFE; border-radius: 8px; margin-bottom: 24px;">
									<tr>
										<td style="padding: 14px 18px;">
											<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation">
												<tr>
													<td style="vertical-align: top; width: 28px; font-size: 20px; line-height: 1;">📎</td>
													<td style="vertical-align: top; font-size: 13px; color: #1E40AF; line-height: 1.5;">
														<strong>PDF-offerte bijgevoegd:</strong> De volledige offerte inclusief prijsspecificatie en leveringsvoorwaarden vindt u als PDF-bijlage bij deze e-mail.
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>

								<!-- Closing text -->
								<p style="margin: 0 0 4px; font-size: 14px; color: #475569;">
									Wij vertrouwen erop u hiermee een passende aanbieding te hebben gedaan. Heeft u vragen of wenst u een afspraak telefonisch in te plannen? Neem gerust contact met ons op.
								</p>
								<p style="margin: 16px 0 0; font-size: 14px; color: #060C35; font-weight: 700;">
									Met vriendelijke groet,<br>
									<span style="font-weight: 500; color: #475569;">Het team van</span> BetonBestellen.nl BV
								</p>

							</td>
						</tr>
					</table><!-- /Main Card Container -->

					<!-- Footer Outside Card -->
					<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation" style="max-width: 600px; width: 100%; margin: 24px auto 0; text-align: center;">
						<tr>
							<td align="center" valign="top">
								<!-- Support card -->
								<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation" style="background-color: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 12px; padding: 20px 24px; margin-bottom: 20px; text-align: center;">
									<tr>
										<td align="center">
											<h4 style="margin: 0 0 6px; font-size: 15px; font-weight: 700; color: #060C35; text-align: center;">
												Vragen over deze offerte?
											</h4>
											<p style="margin: 0 0 12px; font-size: 13px; color: #64748B; text-align: center;">
												Neem gerust direct contact op met onze planners:
											</p>
											<table border="0" cellpadding="0" cellspacing="0" align="center" role="presentation">
												<tr>
													<td style="padding: 0 14px;">
														<a href="tel:0854831710" style="color: #060C35; font-size: 13px; font-weight: 700; text-decoration: none;">📞 085-4831710</a>
													</td>
													<td style="padding: 0 14px;">
														<a href="mailto:info@betonbestellen.nl" style="color: #060C35; font-size: 13px; font-weight: 700; text-decoration: none;">✉️ info@betonbestellen.nl</a>
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
											<a href="https://g.page/r/CcvazzN6aWu0EAI/review" target="_blank" style="color: #C2410C; font-size: 13px; font-weight: 600; text-decoration: none;">
												⭐ Uw ervaring delen? <span style="text-decoration: underline;">Schrijf een Google review</span>
											</a>
										</td>
									</tr>
								</table>

								<!-- Legal & Company Links -->
								<p style="margin: 0 0 8px; font-size: 12px; color: #94A3B8; line-height: 1.6;">
									<a href="' . esc_url($site_url) . '" style="color: #64748B; text-decoration: none; font-weight: 600;">Betonbestellen.nl</a> &bull;
									<a href="' . esc_url($alv_url) . '" target="_blank" style="color: #64748B; text-decoration: none; font-weight: 600;">Algemene Voorwaarden</a>
								</p>

								<p style="margin: 0; font-size: 11px; color: #94A3B8; line-height: 1.5;">
									&copy; ' . esc_html(date('Y')) . ' BetonBestellen.nl BV. Alle rechten voorbehouden.
								</p>
							</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
</body>
</html>';

	$content_type = function () {
		return 'text/html';
	};
	add_filter('wp_mail_content_type', $content_type);
	// $headers[] = 'Cc: info@betonbestellen.nl';
	wp_mail($to, 'Offerte van Betonbestellen.nl (#' . $quote_id . ')', $html, $headers, $mail_attachment);
	remove_filter('wp_mail_content_type', $content_type);
	$url_r = get_permalink(get_page_by_path('offerte-aanvraag'));
	$url_r = add_query_arg('quotation', 'sent', $url_r);
	if ($pdf_id) {
		wp_delete_attachment($pdf_id); //DELETE PDF
	}
	return ['redirect_url' => $url_r];
}

add_action('wp_ajax_concrete_add_to_cart', 'concrete_add_to_cart');
add_action('wp_ajax_nopriv_concrete_add_to_cart', 'concrete_add_to_cart');
function concrete_add_to_cart()
{
	wc_get_logger()->debug('Adding to cart (cacl data): ' . json_encode($_POST));
	$data = $_POST;
	unset($data['action']);
	WC()->cart->empty_cart(); // Empty the cart before add newly
	$cart_item_key = WC()->cart->add_to_cart(get_field('beton_product', 'option'));

	if ($cart_item_key) {
		if (!empty($_POST['user_email'])) {
			WC()->session->set('billing_email', sanitize_email($_POST['user_email']));
		}
		wp_send_json_success([
			'message' => 'Product added to cart successfully!',
			'cart_item_key' => $cart_item_key,
			'redirect' => wc_get_checkout_url()
		]);
	} else {
		wp_send_json_error(['message' => 'Failed to add product to cart.']);
	}

	wp_die(); // Terminate to ensure no extra output
}

function override_checkout_email_field($fields)
{
	$billing_email = WC()->session->get('billing_email');
	if (!is_null($billing_email)) {
		$fields['billing']['billing_email']['default'] = $billing_email;
	}

	$fields['shipping']['shipping_email'] = array(
		'label' => __('Email Address', 'woocommerce'),
		'placeholder' => _x('Email', 'placeholder', 'woocommerce'),
		'required' => true,
		'class' => array('form-row-wide'),
		'clear' => true
	);
	return $fields;
}

add_filter('woocommerce_checkout_fields', 'override_checkout_email_field');

//Add custom cart item data
function beton_cart_item_data($cart_item_data, $product_id, $variation_id)
{
	if (isset($_POST['action']) && $_POST['action'] == 'concrete_add_to_cart') {
		$data = $_POST;
		unset($data['action']);

		$data['city'] = $data['postalcode'];
		$calc_data = $data;
		$calc_data['application'] = isset($_POST['application_product']) ? $_POST['application_product'] : '';
		$calc_data['compounds'] = isset($_POST['composition']) ? $_POST['composition'] : [];
		$calc_data['release_method'] = isset($_POST['unloading']) ? $_POST['unloading'] : '';
		$calc_data['pumping_distance'] = (isset($_POST['pump_type']) && $_POST['pump_type'] == 'mini' ? (isset($_POST['pumping_distance']) ? $_POST['pumping_distance'] : 0) : (isset($_POST['boom_pumping_distance']) ? $_POST['boom_pumping_distance'] : 0));
		$calc_data['performance'] = isset($_POST['uitvoering']) ? $_POST['uitvoering'] : '';
		$calc_data['layer_thickness'] = isset($_POST['layer-thickness']) ? $_POST['layer-thickness'] : '';
		$calc_data['rooms_count'] = isset($_POST['nos_rooms']) ? $_POST['nos_rooms'] : 0;
		$calc_data['butterfly_floor'] = isset($_POST['butterfly-floor']) ? $_POST['butterfly-floor'] : 0;
		$calc_data['surface'] = isset($_POST['surace-sqm']) ? $_POST['surace-sqm'] : '';
		$calc_data['selected_floor'] = isset($_POST['flooring']) ? $_POST['flooring'] : 0;

		$calcuated_data = beton_calculator($calc_data);

		wc_get_logger()->debug('1Adding to cart (cacl data): ' . json_encode($calcuated_data));
		wc_get_logger()->debug('3Adding to cart (cacl data): ' . json_encode($data));

		if ($calcuated_data['beton_price'] && $calcuated_data['cubic_meters_formatted']) {
			$cart_item_data['concrete_value'] = $calcuated_data['beton_price'];
			$cubic_meters = number_format($calcuated_data['cubic_meters_formatted'], 2);
			$cart_item_data['concrete_label'] = "Beton: {$cubic_meters}m³";

			$cart_item_data['hidden_concrete_qty_value'] = $cubic_meters;
			$cart_item_data['hidden_concrete_qty_label'] = 'Concrete Cubic meters';
		}

		if (isset($calcuated_data['brandstoftoeslag']) && $calcuated_data['brandstoftoeslag'] > 0) {
			$cart_item_data['brandstoftoeslag_value'] = $calcuated_data['brandstoftoeslag'];
			$cart_item_data['brandstoftoeslag_label'] = "Brandstoftoeslag";
		}

		if (isset($calcuated_data['laagwatertoeslag']) && $calcuated_data['laagwatertoeslag'] > 0) {
			$cart_item_data['laagwatertoeslag_value'] = $calcuated_data['laagwatertoeslag'];
			$cart_item_data['laagwatertoeslag_label'] = "Laagwatertoeslag";
		}

		if (isset($calcuated_data['application_price'])) {
			$cart_item_data['applications_label'] = "Toepassing";
			$cart_item_data['applications_value'] = $calcuated_data['application_price'];
			$cart_item_data['hidden_application_type_label'] = $calcuated_data['application_type'];
		}

		if (!empty($data['composition']) && is_array($data['composition'])) {
			$cart_item_data['compositions_label'] = ucwords(str_replace('-', ' ', implode(', ', $data['composition'])));
			$cart_item_data['compositions_value'] = $calcuated_data['application_compound_total'] - $calcuated_data['application_price'];

			foreach ($data['composition'] as $composition) {
				if (isset($calcuated_data[$composition])) {
					$cart_item_data['hidden_' . $composition . '_label'] = ucwords(str_replace('-', ' ', $composition));
					$cart_item_data['hidden_' . $composition . '_value'] = $calcuated_data[$composition];
				}
			}
		}

		if (isset($data['unloading'])) {
			$cart_item_data['unloading_label'] = "Loswijze";
			$cart_item_data['unloading_value'] = $data['unloading'] == 'pump' ? 'Pomp' : "Uit de goot";
		}

		if (isset($calcuated_data['pump_cost'])) {
			if ($data['pump_type'] == 'mini') {
				$custom_pump_label = 'Mini betonpomp';
			} else {
				$custom_pump_label = 'Giekpomp -' . (isset($_POST['boom_pumping_distance']) ? $_POST['boom_pumping_distance'] : '') . 'm';
			}
			$cart_item_data['pump_label'] = $custom_pump_label;
			$cart_item_data['pump_value'] = $calcuated_data['pump_cost'];
		}

		if (isset($calcuated_data['pump_callout_cost'])) {
			$cart_item_data['callout_label'] = "Voorrijkosten";
			$cart_item_data['callout_value'] = $calcuated_data['pump_callout_cost'];
		}

		if (isset($calcuated_data['pumping_cost'])) {
			$cart_item_data['pumping_label'] = "Pompafstand - {$data['pumping_distance']}m";
			$cart_item_data['pumping_value'] = $calcuated_data['pumping_cost'];
		}

		// if(isset($data['pumping_distance'])){
		// 	$cart_item_data['hidden_pumping_distance_label'] = "Pumping Distance";
		// 	$cart_item_data['hidden_pumping_distance_value'] = $calc_data['pumping_distance'];
		// }

		if (isset($data['pumping_distance'])) {
			$cart_item_data['hidden_pumping_distance_value_extra'] = $calc_data['pumping_distance'];
		}

		if (isset($calcuated_data['pumping_extra_hose_cost'])) {
			$cart_item_data['pumping_value'] = $calcuated_data['pumping_cost'] + $calcuated_data['pumping_extra_hose_cost'];
		}

		if (isset($calcuated_data['allIn_cost'])) {
			$cart_item_data['allin_label'] = "All-in";
			$cart_item_data['allin_value'] = $calcuated_data['allIn_cost'];

			if (isset($_POST['surace-sqm'])) {
				$cart_item_data['surface_label'] = "Oppervlak";
				$cart_item_data['surface_value'] = $_POST['surace-sqm'];
			}

			if (isset($_POST['nos_rooms'])) {
				$cart_item_data['number_of_rooms_label'] = "Aantal Kamers";
				$cart_item_data['number_of_rooms_value'] = $_POST['nos_rooms'];
			}

			if (isset($_POST['layer-thickness'])) {
				$cart_item_data['hidden_layer_thickness_extra'] = $_POST['layer-thickness'];
			}

			if (isset($calc_data['selected_floor'])) {
				if ($calc_data['selected_floor'] == 1) {
					$cart_item_data['hidden_selected_floor_extra'] = true;
				} else {
					$cart_item_data['hidden_selected_floor_extra'] = false;
				}
			}
		}

		if (isset($calcuated_data['butterfly_floor_cost'])) {
			$cart_item_data['butterfly_floor_label'] = "Vlindervloer";
			$cart_item_data['butterfly_floor_value'] = $calcuated_data['butterfly_floor_cost'];
		}

		//Attach data that webhook needed
		if (!empty($data['composition']) && is_array($data['composition'])) {
			foreach ($data['composition'] as $compound) {
				if ($compound == 'hoge-sterkte') {
					$cart_item_data['hidden_sterkte_extra'] = "C30/37";
				}

				if ($compound == 'hoog-vloeibaar') {
					$cart_item_data['hidden_consitstentie_extra'] = "F4";
				}

				if ($compound == 'vlinderbeton') {
					$cart_item_data['hidden_milleuklasse_extra'] = "XC4";
				}

				if ($compound == 'fijn-grind') {
					$cart_item_data['hidden_grind_extra'] = "16";
				}

				if ($compound == 'snelhardend') {
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
				if ($_POST['application_product'] == 'funderingsbalk') {
					$cart_item_data['hidden_milleuklasse_extra'] = "XC3";
				} else {
					$cart_item_data['hidden_milleuklasse_extra'] = "XC2";
				}
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

			if ($_POST['application_product'] == 'funderingsbalk') {
				$cart_item_data['hidden_milleuklasse_extra'] = "XC3";
			} else {
				$cart_item_data['hidden_milleuklasse_extra'] = "XC2";
			}

			$cart_item_data['hidden_grind_extra'] = "32mm";
			$cart_item_data['hidden_portlandc_extra'] = "geen";
		}

		$cart_item_data['sub_total'] = $calcuated_data['sub_total'];
		$cart_item_data['sub_total_custom'] = $calcuated_data['sub_total'];
		// wc_get_logger()->debug('Calculated data before Adding to cart: ' . json_encode($calcuated_data));

	}
	wc_get_logger()->debug('Adding Cart Item Data: ' . json_encode($cart_item_data));

	return $cart_item_data;
}
add_filter('woocommerce_add_cart_item_data', 'beton_cart_item_data', 5, 3);

//Display custom item data in the cart
function beton_get_item_data($item_data, $cart_item_data)
{
	// echo '<pre>';
	// print_r($cart_item_data);
	// echo '</pre>';
	foreach ($cart_item_data as $label => $cart_item) {
		if (str_ends_with($label, 'label') && !str_starts_with($label, 'hidden_')) {
			$value = $cart_item_data[str_replace('label', 'value', $label)];
			$item_data[] = array(
				'key' => $cart_item_data[$label],
				'value' => is_numeric($value) ? wc_price($value) : wc_clean($value)
			);
		}
	}

	return $item_data;
}
add_filter('woocommerce_get_item_data', 'beton_get_item_data', 10, 2);

//Add custom meta to order
function beton_checkout_create_order_line_item($item, $cart_item_key, $values, $order)
{
	// wc_get_logger()->debug('Adding to order: ' . json_encode($values));

	foreach ($values as $label => $cart_item) {
		if (str_ends_with($label, 'label') && !str_ends_with($label, 'extra')) {
			$value_key = str_replace('label', 'value', $label);
			$value = isset($values[$value_key]) ? $values[$value_key] : '';
			if ($label == 'number_of_rooms_label') {
				$item->add_meta_data($values[$label], wc_clean($value), true);
			} elseif ($label == 'surface_label') {
				$item->add_meta_data($values[$label], wc_clean($value) . ' m²', true);
			} else {
				$item->add_meta_data($values[$label], is_numeric($value) ? wc_price($value) : wc_clean($value), true);
			}
			$item->add_meta_data('raw_' . $value_key, $value, true);
			$item->add_meta_data('raw_' . $label, $values[$label], true);
		}

		if (in_array($label, ['hidden_sterkte_extra', 'hidden_consitstentie_extra', 'hidden_milleuklasse_extra', 'hidden_grind_extra', 'hidden_portlandc_extra', 'hidden_selected_floor_extra', 'hidden_layer_thickness_extra', 'hidden_pumping_distance_value_extra'])) {
			$item->add_meta_data('raw_' . $label, $values[$label], true);
		}
	}
}
add_action('woocommerce_checkout_create_order_line_item', 'beton_checkout_create_order_line_item', 10, 4);

add_action('woocommerce_before_calculate_totals', function ($cart_object) {
	foreach ($cart_object->get_cart() as $cart_item_key => $cart_item) {
		$product = $cart_item['data'];
		// 		wc_get_logger()->debug( 'Cart item at calculate_totals: ' . json_encode($cart_item) );

		$sub_total = isset($cart_item['sub_total_custom']) ? floatval($cart_item['sub_total_custom']) : '';

		if (!empty($sub_total)) {
			$cart_item['data']->set_price($sub_total);
		}
	}
});

add_filter('woocommerce_order_item_get_formatted_meta_data', function ($formatted_meta, $item) {
	$skippers = [
		'Hoog Vloeibaar',
		'Extra Hoge Sterkte',
		'Snelhardend',
		'Fijn Grind',
		'Concrete Cubic meters'
	];
	foreach ($formatted_meta as $key => $meta) {
		if (str_contains($meta->key, 'raw') || str_contains($meta->key, 'hidden') || is_numeric($meta->key) || in_array($meta->key, $skippers)) {
			unset($formatted_meta[$key]);
		}
	}
	return $formatted_meta;
}, 10, 2);

function dayz_gcal($order, $orddd)
{
	if (!isset($orddd->order_weblink)) {
		$orddd->order_weblink = '';
	}

	$metaLine = '';
	foreach ($order->get_items() as $item_id => $item) {
		$allmeta = $item->get_meta_data();
		foreach ($allmeta as $meta) {
			$value = '';
			if ('Beton' === $meta->key) {
				$value = number_format($meta->value, 2) . 'm³ : ' . wc_price(wc_get_order_item_meta($item_id, 'aantal_price', true));
			} elseif ('Toepassing' === $meta->key && !empty(wc_get_order_item_meta($item_id, 'application_price', true))) {
				$value = $meta->value . ': ' . wc_price(wc_get_order_item_meta($item_id, 'application_price', true));
			} elseif ('Samenstelling' === $meta->key && !empty(wc_get_order_item_meta($item_id, 'composition_total_price', true))) {
				$value = $meta->value . ': ' . wc_price(wc_get_order_item_meta($item_id, 'composition_total_price', true));
			} elseif ('Pomp' === $meta->key && !empty(wc_get_order_item_meta($item_id, 'pump_total', true))) {
				$value = $meta->value . ': ' . wc_price(floatval(wc_get_order_item_meta($item_id, 'pump_total', true)));
			} elseif ('Voorrijkosten' === $meta->key && !empty(wc_get_order_item_meta($item_id, 'Voorrijkosten', true))) {
				$value = wc_price(wc_get_order_item_meta($item_id, 'Voorrijkosten', true));
			} elseif ('Pompafstand' === $meta->key && !empty(wc_get_order_item_meta($item_id, 'pumping_distance_total', true))) {
				if (wc_get_order_item_meta($item_id, 'mini_extra_horse', true)) {
					$extra = wc_get_order_item_meta($item_id, 'mini_extra_horse', true);
				} else {
					$extra = 0;
				}
				$value = $meta->value . ': ' . wc_price(floatval(wc_get_order_item_meta($item_id, 'pumping_distance_total', true)) + floatval($extra));
			} elseif ('Vlindervloer' === $meta->key && !empty(wc_get_order_item_meta($item_id, 'butterfly_floor', true))) {
				$value = $meta->value . ': ' . wc_price(floatval(wc_get_order_item_meta($item_id, 'butterfly_floor', true)));
			} elseif ('Uitvoering' === $meta->key && (!empty(wc_get_order_item_meta($item_id, 'all-in-total', true)))) {
				$additional = 0;
				if (!empty(wc_get_order_item_meta($item_id, 'all-in-total', true))) {
					$additional += floatval(wc_get_order_item_meta($item_id, 'all-in-total', true));
				}
				$value = $meta->value . ': ' . wc_price($additional);
			} elseif ($meta->key == 'Laagdikte') {
				$value = $meta->value;
			} elseif ($meta->key == 'Oppervlakte') {
				$value = $meta->value;
			} elseif ($meta->key == 'Hoog vloeibaar') {
				$value = wc_price($meta->value);
			} elseif ($meta->key == 'Fijn grind') {
				$value = wc_price($meta->value);
			} else {
				continue;
			}
			$metaLine .= $meta->key . ': ' . wp_strip_all_tags($value) . ' | ';
		}
	}

	// Find time difference from Greenwich as GCal asks UTC.
	$summary = str_replace(
		array('SITE_NAME', 'CLIENT', 'PRODUCTS', 'PRODUCT_WITH_QTY', 'ORDER_DATE_TIME', 'ORDER_DATE', 'ORDER_NUMBER', 'PRICE', 'PHONE', 'NOTE', 'FULL_ADDRESS', 'ADDRESS', 'EMAIL', 'ORDER_WEBLINK'),
		array(get_bloginfo('name'), $orddd->client_name, $orddd->products, $metaLine, $orddd->order_date_time, $orddd->order_date, $orddd->id, $orddd->order_total, $orddd->client_phone, $orddd->order_note, $orddd->client_full_address, $orddd->client_address, $orddd->client_email, urlencode($orddd->order_weblink)),
		get_option('orddd_calendar_event_summary')
	);

	$description = str_replace(
		array('SITE_NAME', 'CLIENT', 'PRODUCTS', 'PRODUCT_WITH_QTY', 'ORDER_DATE_TIME', 'ORDER_DATE', 'ORDER_NUMBER', 'PRICE', 'PHONE', 'NOTE', 'FULL_ADDRESS', 'ADDRESS', 'EMAIL', 'ORDER_WEBLINK'),
		array(get_bloginfo('name'), $orddd->client_name, $orddd->products, $metaLine, $orddd->order_date_time, $orddd->order_date, $orddd->id, $orddd->order_total, $orddd->client_phone, $orddd->order_note, $orddd->client_full_address, $orddd->client_address, $orddd->client_email, urlencode($orddd->order_weblink)),
		get_option('orddd_calendar_event_description')
	);

	if ($orddd->start_time == '' && $orddd->end_time == '') {
		$start = strtotime($orddd->start);
		$end = strtotime($orddd->end . '+1 day');

		$gmt_start = date('Ymd', $start);
		$gmt_end = date('Ymd', $end);
	} elseif ($orddd->end_time == '') {
		$start = strtotime($orddd->start . ' ' . $orddd->start_time);
		$end = strtotime($orddd->end . ' ' . $orddd->start_time);

		$gmt_start = get_gmt_from_date(date('Y-m-d H:i:s', $start), 'Ymd\THis\Z');
		$gmt_end = get_gmt_from_date(date('Y-m-d H:i:s', $end), 'Ymd\THis\Z');
	} else {
		$start = strtotime($orddd->start . ' ' . $orddd->start_time);
		$end = strtotime($orddd->end . ' ' . $orddd->end_time);

		$gmt_start = get_gmt_from_date(date('Y-m-d H:i:s', $start), 'Ymd\THis\Z');
		$gmt_end = get_gmt_from_date(date('Y-m-d H:i:s', $end), 'Ymd\THis\Z');
	}

	if (get_option('orddd_calendar_event_location') != '') {
		$location = str_replace(array('FULL_ADDRESS', 'ADDRESS_SHIP', 'ADDRESS', 'CITY'), array($orddd->client_full_address, $orddd->client_address, $orddd->client_address, $orddd->client_city), get_option('orddd_calendar_event_location'));
	} else {
		$location = get_bloginfo('description');
	}

	$param = array(
		'action' => 'TEMPLATE',
		'text' => $summary,
		'dates' => $gmt_start . '/' . $gmt_end,
		'location' => $location,
		'details' => $description,
	);

	return esc_url(
		add_query_arg(
			array($param, $start, $end),
			'http://www.google.com/calendar/event'
		)
	);
}

/**
 * translate 'optional' string behind the oreder note field in checkout
 */
add_filter('woocommerce_form_field', 'translate_optional_text', 10, 4);

function translate_optional_text($field, $key, $args, $value)
{
	if ('order_comments' === $key) {
		$field = str_replace('(optional)', '(optioneel)', $field);
	}
	return $field;
}

add_filter('dayz_moneybird_document_lines', 'dayz_moneybird_addon_document_lines', 10, 2);
function dayz_moneybird_addon_document_lines($lines, $order)
{
	if (empty($order)) {
		return;
	}

	$matchData = array(
		'Beton' => 'aantal_price',
		'Samenstelling' => 'composition_total_price',
		'Hoog vloeibaar' => 'composition_price_hoog-vloeibaar',
		'Snelhardend' => 'composition_price_snelhardend',
		'Fijn grind' => 'composition_price_fijn-grind',
		'Vlinderbeton' => 'composition_price_vlinderbeton',
		'Extra hoge sterkte' => 'composition_price_extra-hoge-sterkte',
		'Toepassing' => 'application_price',
		'Pomp' => 'pump_total',
		'Pompafstand' => 'pumping_distance_total',
		'Uitvoering' => 'all-in-total',
		'Vlindervloer' => 'butterfly_floor',
		'Voorrijkosten' => 'Voorrijkosten',
		// 'Forfait' => 'Forfait'
	);

	$subMeta = ['Oppervlakte', 'Laagdikte', 'Aantal vertrekken'];
	$add_formatted_more = ['Toeslag extra leidingwagen' => 'mini_extra_horse'];
	$replacers = get_field('replacer', 'option');

	foreach ($order->get_items() as $item_id => $item) {
		/* @var $item \WC_Order_Item_Product */
		$product = $item->get_product();
		if (!$product) {
			throw new \Exception("Product not found.");
		}
			// Custom
			$deviations = array(
				'raw_applications_label' => 'raw_applications_value',
				'raw_concrete_label' => 'raw_hidden_concrete_qty_value',
				'raw_hidden_hoog-vloeibaar_label' => 'raw_hidden_concrete_qty_value',
				'raw_hidden_extra-hoge-sterkte_label' => 'raw_hidden_concrete_qty_value',
				'raw_hidden_hoge-sterkte_label' => 'raw_hidden_concrete_qty_value',
				'raw_hidden_vlinderbeton_label' => 'raw_hidden_concrete_qty_value',
				'raw_hidden_snelhardend_label' => 'raw_hidden_concrete_qty_value',
				'raw_hidden_fijn-grind_label' => 'raw_hidden_concrete_qty_value',
				'raw_pumping_label' => 'raw_pumping_value', //'raw_hidden_pumping_distance_value'
				'raw_brandstoftoeslag_label' => 'raw_hidden_concrete_qty_value',
				'raw_laagwatertoeslag_label' => 'raw_hidden_concrete_qty_value',
// 				'raw_compositions_label' => 'raw_compositions_value'
			);

			$skipping = array('raw_hidden_concrete_qty_label', 'raw_hidden_pumping_distance_label', 'raw_compositions_label');

			// 			if($item->get_meta('raw_compositions_label') == $item->get_meta('raw_hidden_snelhardend_label')){
// 				$skipping[] = 'raw_hidden_snelhardend_label';			
// 			}

			// 			if(str_contains($item->get_meta('raw_compositions_label'), $item->get_meta('raw_hidden_snelhardend_label'))){
// 			    $skipping[] = 'raw_hidden_snelhardend_label';
// 			}

			foreach ($item->get_meta_data() as $meta) {
				if (str_contains($meta->key, 'raw_') && !in_array($meta->key, $skipping)) {
					if (str_contains($meta->key, 'label') && $meta->key !== 'raw_compositions_label') {
						$value = $item->get_meta(str_replace('label', 'value', $meta->key));
						// 						echo 'meta key : ' . $meta->key . '<br>';
// 						echo 'value : ' . $value . '<br>';
						if (isset($deviations[$meta->key])) {
							$qty = $item->get_meta($deviations[$meta->key]);
							if ($qty > 0) {
								$value = $value / $qty;
							}
						} else {
							$qty = 1;
						}

						// if(is_string($value)){
						//     $value = 0;
						// }
						// $formatted_meta[$meta->value] = $value;

						$description = $meta->value;
						$ledger_account_id = null;
						if (str_contains($description, 'Beton') && !str_contains($description, 'betonpomp')) {
							$ledger_account_id = '450784868029171239'; //Omzet Beton
							$value = $item->get_meta('raw_concrete_value');
							// 							$qty = $item->get_meta('raw_hidden_concrete_qty_value');

							preg_match('/([\d.]+)/', $item->get_meta('raw_concrete_label'), $matches);
							$qty = $matches[1] ?? 1;
							$value = $value / $qty;
						}

						if (in_array($description, ['Hoog vloeibaar', 'Snelhardend', 'Fijn grind', 'Extra hoge sterkte', 'Vlinderbeton'])) {
							$ledger_account_id = '450784868029171239'; //Omzet Beton
						}

						if (str_contains($description, 'All-in') || str_contains($description, 'Vlindervloer')) {
							$ledger_account_id = '450784890512737433'; //OMZET ALLIN
						}

						if (str_contains($description, 'Pomp')) {
							$ledger_account_id = '450784950650668889'; //OMZET POMPHUUR
						}

						if (str_contains($description, 'Mini betonpomp')) {
							$ledger_account_id = '450784950650668889'; //Mini Pomp
						}
						if (str_contains($description, 'Voorrijkosten')) {
							$ledger_account_id = '450784884723549721'; //OMZET VOORRIJKOSTEN
						}
						if (str_contains($description, 'Pompafstand')) {
							$ledger_account_id = '450784996710417861'; //OMZET SLANGEN
							$pumpVal = $item->get_meta('raw_pumping_value');
							preg_match('/(\d+)\s*m\b/', $pumpVal, $matches);
							if (!empty($matches[1])) {
								$qty = $matches[1];
							}
							$qty = $item->get_meta('raw_pumping_value') / 2.5;
							$value = 2.5;
						}
						if (str_contains($description, 'Brandstoftoeslag')) {
							$ledger_account_id = '450784868029171239'; //Omzet Beton
							$qty = $item->get_meta('raw_hidden_concrete_qty_value');
							$value = 3.5;
						}
						if (str_contains($description, 'Laagwatertoeslag')) {
							$ledger_account_id = '450784868029171239'; //Omzet Beton
							$qty = $item->get_meta('raw_hidden_concrete_qty_value');
							$value = 5.0;
						}
						if (str_contains($description, 'Giekpomp')) {
							$pompafstand = $item->get_meta('raw_hidden_pumping_distance_value');
							if (!empty($pompafstand)) {
								$description .= ': ' . $pompafstand . 'm';
							}
						}

						if (str_contains($description, 'Aantal Kamers')) {
							$description .= ' : ' . $value;
							$qty = $value;
							$value = 0;
						}

						if (str_contains($description, 'Oppervlak')) {
							$value = 0;
							$description .= ' : ' . $item->get_meta('Oppervlak');
						}

						if (str_contains('Loswijze', $description) && floatval($value) == 0) {
							continue;
						}

						if (str_contains('Toepassing', $description) && floatval($value) == 0) {
							continue;
						}

						foreach ($replacers as $replace) {
							if ($replace['seek'] == $description) {
								$description = $replace['replace'];
							}
						}

						// Format cost
						$cost = number_format(floatval($value), 2, '.', '');

						$lastLineItem = end($lines);
						$line_item = array(
							'description' => $description,
							'price' => floatval($cost),
							'amount' => floatval($qty),
							'tax_rate_id' => $lastLineItem['tax_rate_id'],
							'row_order' => $lastLineItem['row_order'] + 1
						);
						if (!empty($ledger_account_id)) {
							$line_item['ledger_account_id'] = $ledger_account_id;
						}
						$lines[] = $line_item;

					} elseif ($meta->key == 'raw_compositions_label' && empty($item->get_meta('raw_hidden_hoog-vloeibaar_label'))) {
						$value = $item->get_meta(str_replace('label', 'value', $meta->key));
						$cost = number_format(floatval($value), 2, '.', '');
						$description = $meta->value;
						$lastLineItem = end($lines);
						$ledger_account_id = null;
						if (in_array($description, ['Hoog vloeibaar', 'Snelhardend', 'Fijn grind', 'Extra hoge sterkte', 'Vlinderbeton'])) {
							$ledger_account_id = '450784868029171239'; //Omzet Beton
						}
						$line_item = array(
							'description' => $description,
							'price' => floatval($cost),
							'amount' => floatval(1),
							'tax_rate_id' => $lastLineItem['tax_rate_id'],
							'row_order' => $lastLineItem['row_order'] + 1
						);
						if (!empty($ledger_account_id)) {
							$line_item['ledger_account_id'] = $ledger_account_id;
						}
						$lines[] = $line_item;
					}
				}
			}
		}
	// $lines = array_filter($lines, function($item) {
	// 	return $item['description'] !== 'Hoge Sterkte';
	// });

	// Reindex array
	$lines = array_values($lines);

	// 	if(!isset($_GET['test'])){
	array_shift($lines); //remove the first line (main product)
// 	}
	return $lines;
}

add_action('dayz_moneybird_after_invoice_generate', function ($order, $mb_doc) {

	// Moneybird values (object)
	$excl_tax = isset($mb_doc->total_price_excl_tax) ? floatval($mb_doc->total_price_excl_tax) : 0;
	$incl_tax = isset($mb_doc->total_price_incl_tax) ? floatval($mb_doc->total_price_incl_tax) : 0;

	// WooCommerce values
	$order_sub_total = floatval($order->get_subtotal());
	$order_inc_tax = floatval($order->get_total());

	// Compare values
	$subtotal_matches = abs($excl_tax - $order_sub_total) < 0.5;
	$total_matches = abs($incl_tax - $order_inc_tax) < 0.5;

	// Email recipients
	$to = "pieter@dayzsolutions.com, harshana@dayzsolutions.com";

	// Shared HTML message body
	$html_body = "
        <h3>Moneybird vs WooCommerce Calculation Check</h3>

        <h4>Moneybird Document</h4>
        <p><strong>excl_tax:</strong> {$excl_tax}<br>
        <strong>incl_tax:</strong> {$incl_tax}</p>

        <h4>WooCommerce Order</h4>
        <p><strong>Order Subtotal:</strong> {$order_sub_total}<br>
        <strong>Order Total Incl Tax:</strong> {$order_inc_tax}</p>

        <p><strong>Order ID:</strong> {$order->get_id()}</p>
    ";

	// If values DO NOT match → send mismatch email
	if (!$subtotal_matches || !$total_matches) {

		$subject = "⚠️ MISMATCH ALERT — Order #{$order->get_id()} Totals Do Not Match";

		wp_mail(
			$to,
			$subject,
			"
            <p style='color: #b30000; font-size: 16px;'><strong>Mismatch detected:</strong></p>
            {$html_body}
            ",
			['Content-Type: text/html; charset=UTF-8']
		);

	} else {

		// If values DO match → send success email
		$subject = "✅ Totals MATCH — Order #{$order->get_id()} Verified";

		wp_mail(
			$to,
			$subject,
			"
            <p style='color: #008000; font-size: 16px;'><strong>All totals match successfully.</strong></p>
            {$html_body}
            ",
			['Content-Type: text/html; charset=UTF-8']
		);
	}

}, 10, 2);


add_action('wp_head', function () {

	if (!isset($_GET['test'])) {
		return;
	}

	$order = wc_get_order($_GET['test']);
	$test = dayz_moneybird_addon_document_lines([], $order);

	echo '<pre>';
	print_r($test);
	echo '</pre>';

});

add_action('dayz_moneybird_after_invoice_generate', function ($order, $mb_doc) {
	$mbAPi = new WC_MoneyBird2();
	$mbapi_collect = $mbAPi->dayz_load_api_connector();
	$order_id = $order->get_id();
	$invoice_id = trim($order->get_meta('moneybird_invoice_id', true));
	$notes = '';
	$deliveryDate = get_post_meta($order_id, '_orddd_delivery_date', true);
	$deliveryTime = get_post_meta($order_id, '_orddd_time_slot', true);
	if ($order->get_formatted_shipping_address()) {
		$notes .= 'VerzendmethodenBewerken: ' . $order->get_formatted_shipping_address();
	}
	if (!empty($deliveryDate) and !empty($deliveryTime)) {
		$notes .= ' | Leveringsdatum: ' . $deliveryDate . ', Gewenst levertijdslot: ' . $deliveryTime;
	}

	if (!empty($deliveryDate) and !empty($deliveryTime)) {
		$delivery = 'Leveringsdatum: ' . $deliveryDate . ', Gewenst levertijdslot: ' . $deliveryTime;
	}
	if (!empty($mbapi_collect) && is_object($mbapi_collect)) {
		$mbapi_collect->dayz_createSalesInvoiceNote($invoice_id, $delivery);
	}
}, 10, 2);

// add_filter('dayz_moneybird_document_custom_fields', 'dayz_moneybird_addon_document_custom_fields', 10, 2);
function dayz_moneybird_addon_document_custom_fields($custom_fields, $order)
{
	$deliveryDate = get_post_meta($order->get_id(), '_shipping_dayz_date_mapper_date', true);
	$deliveryTime = get_post_meta($order->get_id(), '_shipping_dayz_date_mapper_timeslots', true);
	if (!empty($deliveryDate) and !empty($deliveryTime)) {
		$custom_fields[] = array(
			'id' => 450664252407023519,
			'value' => $deliveryDate . ', Gewenst levertijdslot: ' . $deliveryTime,
		);
	}
	if (empty($order->get_shipping_address_1())) {
		$address = str_replace('<br/>', ',', $order->get_formatted_billing_address());
	} else {
		$address = str_replace('<br/>', ',', $order->get_formatted_shipping_address());
	}
	$custom_fields[] = array(
		'id' => 450677096878966316,
		'value' => str_replace('<br/>', ', ', $address),
	);
	return $custom_fields;
}
// add_action('init', function() {
//     $uri = $_SERVER['REQUEST_URI'];
//     // Check if URI is not the homepage and ends with a slash
//     if ($uri != '/' && substr($uri, -1) == '/') {
//     // Properly trim the slash and perform a 301 redirect
//         wp_redirect(rtrim($uri, '/'), 301);
//         exit();
//     }
// });
// 
function encrypt_code($code)
{
	if (empty($code)) {
		return '';
	}

	$default_secure_auth_key = '0ba9a3f00578e986813891a38555f50a';
	$key = defined('SECURE_AUTH_KEY') ? SECURE_AUTH_KEY : $default_secure_auth_key;
	$encryption_key = base64_decode($key);

	$iv = substr(openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc')), 0, 16);
	$encrypted = openssl_encrypt($code, 'aes-256-cbc', $encryption_key, OPENSSL_RAW_DATA, $iv);

	$payload = base64_encode($encrypted . '::' . $iv);

	// Make the base64 URL-safe
	$url_safe_payload = rtrim(strtr($payload, '+/', '-_'), '=');

	return $url_safe_payload;
}

function decrypt_code($code)
{
	if (empty($code) || !is_string($code)) {
		return '';
	}

	$default_secure_auth_key = '0ba9a3f00578e986813891a38555f50a';
	$key = defined('SECURE_AUTH_KEY') ? SECURE_AUTH_KEY : $default_secure_auth_key;
	$encryption_key = base64_decode($key);

	// Revert the URL-safe base64 back to normal
	$base64 = strtr($code, '-_', '+/');
	$mod = strlen($base64) % 4;
	if ($mod > 0) {
		$base64 .= str_repeat('=', 4 - $mod);
	}

	$decoded = base64_decode($base64, true);
	if ($decoded === false || !str_contains($decoded, '::')) {
		return '';
	}

	$parts = explode('::', $decoded, 2);
	if (count($parts) < 2) {
		return '';
	}

	$decrypted = openssl_decrypt($parts[0], 'aes-256-cbc', $encryption_key, OPENSSL_RAW_DATA, $parts[1]);
	return $decrypted !== false ? $decrypted : '';
}

//Google tag after order success
add_action('woocommerce_thankyou', 'dayz_gtag_on_order_complete');
// add_action('wp_head', function(){
//     if(!isset($_GET['event-test'])){return;}
//     dayz_gtag_on_order_complete(1834);
// });

function dayz_gtag_on_order_complete($order_id)
{
	if (!$order_id)
		return;

	$order = wc_get_order($order_id);
	$total_incl_tax = $order->get_total();
	$total_excl_tax = $order->get_subtotal();

	?>
	<script>
		jQuery(document).ready(function ($) {
			window.dataLayer = window.dataLayer || [];
			dataLayer.push({
				'event': 'orderSuccess',
				'orderId': <?php echo json_encode($order_id); ?>,
				'orderTotalInclTax': <?php echo json_encode((float) $total_incl_tax); ?>,
				'orderTotalExclTax': <?php echo json_encode((float) $total_excl_tax); ?>,
				'timestamp': new Date().toISOString(),
			});
		});
	</script>
	<?php
}

add_filter('woocommerce_available_payment_gateways', 'custom_disable_cheque_for_others');

function custom_disable_cheque_for_others($available_gateways)
{
	if (is_admin()) {
		return $available_gateways;
	}

	// Allow only for logged-in user ID 5
	if (is_user_logged_in()) {
		$current_user_id = get_current_user_id();
		if ($current_user_id == 5) {
			return $available_gateways; // allow all
		}
	}

	// Remove cheque payment method for everyone else
	if (isset($available_gateways['cheque'])) {
		unset($available_gateways['cheque']);
	}

	return $available_gateways;
}

add_action('wp_head', function () {
	if (!isset($_GET['tttt']))
		return;

	// 	echo decrypt_code('v+etEB6PxOxCPcvwe3I1KDo6BnrWdGkjEPWte4j4TlHtlA==');
	$order = wc_get_order(3472);
	if (!$order) {
		echo '<pre>Order not found</pre>';
		return;
	}

	foreach ($order->get_items() as $item_id => $item) {
		echo '<h4>Item ID: ' . $item_id . '</h4>';

		$all_meta = $item->get_formatted_meta_data();
		// $formatted_meta = [];
		// foreach ($all_meta as $meta) {
		//     $formatted_meta[$meta->key] = $meta->value;
		// }

		echo '<pre>All Meta (formatted): ';
		print_r($all_meta);
		echo '</pre>';
	}

	echo '<pre>All: ';
	print_r($order->get_meta_data());
	echo '</pre>';
});

add_filter('woocommerce_order_item_get_formatted_meta_data', function ($formatted_meta, $order_item) {
	$exists = false;

	foreach ($formatted_meta as $meta) {
		if ($meta->key === 'Hoog Vloeibaar' || $meta->display_key === 'Hoog Vloeibaar') {
			$exists = true;
			break;
		}
	}

	// If not found, add it dynamically
	if (!$exists) {
		$newMeta = new stdClass();
		$newMeta->key = 'Hoog Vloeibaar';
		$newMeta->value = $order_item->get_meta('Hoog Vloeibaar'); // or default value
		$newMeta->display_key = 'Hoog Vloeibaar';
		$newMeta->display_value = $order_item->get_meta('Hoog Vloeibaar');

		// Add with a fake ID (since WC keys by meta_id)
		$formatted_meta['custom_hoog_vloeibaar'] = $newMeta;
	}

	// 	echo '<pre>All Meta (formatted): ';
// 	print_r($order_item->get_meta('Hoog Vloeibaar'));
// 	echo '</pre>';

	return $formatted_meta;
}, 20, 2);


/**
 * Set a minimum order amount for checkout
 */
add_action('woocommerce_checkout_process', 'wc_minimum_order_amount');
add_action('woocommerce_before_cart', 'wc_minimum_order_amount');

function wc_minimum_order_amount()
{
	// Set this variable to specify a minimum order value
	$minimum = 200;

	if (WC()->cart->total < $minimum) {

		if (is_cart()) {

			wc_print_notice(
				sprintf(
					'Your current order total is %s — you must have an order with a minimum of %s to place your order ',
					wc_price(WC()->cart->total),
					wc_price($minimum)
				),
				'error'
			);

		} else {

			wc_add_notice(
				sprintf(
					'Your current order total is %s — you must have an order with a minimum of %s to place your order',
					wc_price(WC()->cart->total),
					wc_price($minimum)
				),
				'error'
			);

		}
	}
}


//Custom API end point
add_action('rest_api_init', function () {
	// GET endpoint
	register_rest_route('acf/v1', '/group/beton_opties', array(
		array(
			'methods' => 'GET',
			'callback' => 'get_structured_acf_options',
			'permission_callback' => 'woocommerce_basic_permissions'
		),
		array(
			'methods' => 'POST',
			'callback' => 'update_acf_group_data',
			'permission_callback' => 'woocommerce_basic_permissions'
		)
	));

	register_rest_route('cpt/v1', '/create_quotation', array(
		array(
			'methods' => 'POST',
			'callback' => 'create_quotation',
			'permission_callback' => 'woocommerce_basic_permissions'
		)
	));

	register_rest_route('def/v1', '/calculate_quotation', array(
		array(
			'methods' => 'POST',
			'callback' => 'calculate_quotation',
			'permission_callback' => 'woocommerce_basic_permissions'
		)
	));

	register_rest_route('def/v1', '/get_beton_unit_price', array(
		array(
			'methods' => 'POST',
			'callback' => 'get_beton_unit_price',
			'permission_callback' => 'woocommerce_basic_permissions'
		)
	));

});


//Permission verify
function woocommerce_basic_permissions(WP_REST_Request $request)
{
	$headers = $request->get_headers();

	if (!isset($headers['authorization'][0])) {
		return false;
	}

	$auth_header = $headers['authorization'][0];
	if (strpos($auth_header, 'Basic ') !== 0) {
		return false;
	}

	$auth_value = base64_decode(substr($auth_header, 6));
	list($consumer_key, $consumer_secret) = explode(':', $auth_value);

	global $wpdb;

	$consumer_key = wc_api_hash(sanitize_text_field($consumer_key));

	$user = $wpdb->get_row(
		$wpdb->prepare(
			"SELECT key_id, user_id, permissions, consumer_key, consumer_secret, nonces FROM {$wpdb->prefix}woocommerce_api_keys WHERE consumer_key = %s",
			$consumer_key
		)
	);

	if (empty($user) || !hash_equals($user->consumer_secret, $consumer_secret)) {
		return false;
	}

	return true;
}


//Calculate qoutation
function calculate_quotation($request)
{
	$externalData = $request->get_json_params();

	//externalData coming from API request
	if ($externalData) {
		$data = $externalData;
		//wc_get_logger()->debug(json_encode($data));
		$postalCode = $externalData['postalcode'] ?? '';
		$area_code = get_area_code_from_postal_code($postalCode);

		if (is_wp_error($area_code)) {
			return $area_code;
		}
		$externalData['area_code'] = $area_code;

		$data['city'] = $postalCode;
		$calc_data = $data;
		$calc_data['area_code'] = $externalData['area_code'];
		$calc_data['surace-sqm'] = $externalData['surace_sqm'];
		$calc_data['layer-thickness'] = $externalData['layer_thickness'];
		$calc_data['butterfly-floor'] = $externalData['butterfly_floor'];

		$calc_data['application'] = $externalData['application_product'];
		$calc_data['compounds'] = $externalData['composition'];
		$calc_data['release_method'] = $externalData['unloading'];
		$calc_data['pumping_distance'] = (isset($externalData['pump_type']) && $externalData['pump_type'] == 'mini' ? $externalData['pumping_distance'] : $externalData['boom_pumping_distance']);
		$calc_data['performance'] = $externalData['uitvoering'];
		$calc_data['layer_thickness'] = $externalData['layer_thickness'];
		$calc_data['rooms_count'] = $externalData['nos_rooms'];
		$calc_data['butterfly_floor'] = $externalData['butterfly_floor'];
		$calc_data['surface'] = $externalData['surace_sqm'];
		$calc_data['selected_floor'] = $externalData['flooring'];

		if (isset($data['is_b2b_customer']) && boolval($data['is_b2b_customer']) == true) {
			$calc_data = array(
				'cubic_meters' => $data['cubic_meters'],
				'city' => $data['postalcode'],
				'area_code' => $data['area_code'],
				'pump_type' => $data['pump_type'],
				'pumping_distance' => (isset($externalData['pump_type']) && $externalData['pump_type'] == 'mini' ? $externalData['pumping_distance'] : $externalData['boom_pumping_distance']),
			);

			// wc_get_logger()->debug('B2B Customer :'. json_encode($calc_data));
			$calaluted_pricings = beton_calculator($calc_data);
			$calaluted_pricings['sub_total'] = $calaluted_pricings['sub_total'] - $calaluted_pricings['beton_price'];
			$calaluted_pricings['beton_price'] = 0;

			$calaluted_pricings['btw'] = ($calaluted_pricings['sub_total'] / 100) * 21;
			$calaluted_pricings['btw_formatted'] = wc_price($calaluted_pricings['btw']);

			$calaluted_pricings['sub_total_btw'] = $calaluted_pricings['btw'] + $calaluted_pricings['sub_total'];
			$calaluted_pricings['total_formatted'] = wc_price($calaluted_pricings['sub_total_btw']);
			$calaluted_pricings['pump_cost'] = 0;
			// wc_get_logger()->debug('B2B Customer Calcs :'. json_encode($calaluted_pricings));

		} else {
			wc_get_logger()->debug('Calcs :' . json_encode($calc_data));
			$calaluted_pricings = beton_calculator($calc_data);
		}


		if (isset($data['has_override_amount']) && boolval($data['has_override_amount']) === true) {
			$prevCalcData = $calaluted_pricings;

			if (isset($data['is_webshop_order']) && boolval($data['is_webshop_order']) === true) {
				$calaluted_pricings['beton_price'] = $prevCalcData['beton_price'] ?? 0;
				$calaluted_pricings['beton_price_formatted'] = wc_price($calaluted_pricings['beton_price']);

				if (isset($data['has_override_length']) && boolval($data['has_override_length']) === true) {
					$calaluted_pricings['pumping_extra_hose_cost'] = $prevCalcData['pumping_extra_hose_cost'] ?? 0;
					$calaluted_pricings['pumping_extra_hose_cost_formatted'] = wc_price($calaluted_pricings['pumping_extra_hose_cost']);
					$calaluted_pricings['pump_callout_cost'] = $prevCalcData['pump_callout_cost'] ?? 0;
					$calaluted_pricings['pumping_cost'] = $prevCalcData['pumping_cost'] ?? 0;
					$calaluted_pricings['pump_cost'] = $prevCalcData['pump_cost'] ?? 0;
				}
			} else {
				$calaluted_pricings['beton_price'] = $prevCalcData['beton_price'] ?? 0;
				$calaluted_pricings['beton_price_formatted'] = wc_price($prevCalcData['beton_price'] ?? 0);

				$calaluted_pricings['pumping_extra_hose_cost'] = $prevCalcData['pumping_extra_hose_cost'] ?? 0;
				$calaluted_pricings['pumping_extra_hose_cost_formatted'] = wc_price($calaluted_pricings['pumping_extra_hose_cost']);

				$calaluted_pricings['application_price'] = $prevCalcData['application_price'] ?? 0;
				$calaluted_pricings['application_compound_total'] = $prevCalcData['application_compound_total'] ?? 0;
				$calaluted_pricings['pump_callout_cost'] = $prevCalcData['pump_callout_cost'] ?? 0;
				$calaluted_pricings['pumping_cost'] = $prevCalcData['pumping_cost'] ?? 0;
				$calaluted_pricings['pump_cost'] = $prevCalcData['pump_cost'] ?? 0;
			}

			// Recompute sub_total cleanly
			$override_sub_total = ($calaluted_pricings['beton_price'] ?? 0)
				+ ($calaluted_pricings['brandstoftoeslag'] ?? 0)
				+ ($calaluted_pricings['laagwatertoeslag'] ?? 0)
				+ ($calaluted_pricings['application_compound_total'] ?? 0)
				+ ($calaluted_pricings['pump_callout_cost'] ?? 0)
				+ ($calaluted_pricings['pumping_cost'] ?? 0)
				+ ($calaluted_pricings['pumping_extra_hose_cost'] ?? 0)
				+ ($calaluted_pricings['pump_cost'] ?? 0)
				+ ($calaluted_pricings['allIn_cost'] ?? 0)
				+ ($calaluted_pricings['butterfly_floor_cost'] ?? 0);

			$calaluted_pricings['sub_total'] = $override_sub_total;
			$calaluted_pricings['sub_total_formatted'] = wc_price($override_sub_total);
			$calaluted_pricings['btw'] = ($override_sub_total / 100) * 21;
			$calaluted_pricings['btw_formatted'] = wc_price($calaluted_pricings['btw']);
			$calaluted_pricings['sub_total_btw'] = $override_sub_total + $calaluted_pricings['btw'];
			$calaluted_pricings['total_formatted'] = wc_price($calaluted_pricings['sub_total_btw']);
		}

		$calaluted_pricings = array_filter($calaluted_pricings, function ($key) {
			return !str_ends_with($key, '_formatted');
		}, ARRAY_FILTER_USE_KEY);

		$formatted_calaluted_pricings = [
			'beton_price' => $calaluted_pricings['beton_price'] ?? 0,
			'toeslagen' => [
				'brandstoftoeslag' => $calaluted_pricings['brandstoftoeslag'] ?? 0,
				'laagwatertoeslag' => $calaluted_pricings['laagwatertoeslag'] ?? 0,
				'toeslagen_totaal' => ($calaluted_pricings['brandstoftoeslag'] ?? 0) + ($calaluted_pricings['laagwatertoeslag'] ?? 0),
			],
			'toepassing' => $calaluted_pricings['application_price'] ?? 0,
			'samenstelling' => [
				'hoog-vloeibaar' => $calaluted_pricings['hoog-vloeibaar'] ?? 0,
				'snelhardend' => $calaluted_pricings['snelhardend'] ?? 0,
				'fijn-grind' => $calaluted_pricings['fijn-grind'] ?? 0,
				'vlinderbeton' => $calaluted_pricings['vlinderbeton'] ?? 0,
				'application_compound_total' => $calaluted_pricings['application_compound_total'] ?? 0,
			],
			'pomp_data' => [
				'voorrijkosten' => $calaluted_pricings['pump_callout_cost'] ?? 0,
				'pompkosten' => $calaluted_pricings['pumping_cost'] ?? 0,
				'pompafstand' => $calaluted_pricings['pumping_extra_hose_cost'] ?? 0,
				'los_methode' => $calaluted_pricings['pump_cost'] ?? 0,
			],
			'laten_storten' => [
				'rooms_cost' => $calaluted_pricings['rooms_cost'] ?? 0,
				'butterfly_floor_cost' => $calaluted_pricings['butterfly_floor_cost'] ?? 0,
				'allIn_cost' => $calaluted_pricings['allIn_cost'] ?? 0,
			],
			'sub_total' => $calaluted_pricings['sub_total'] ?? 0,
			'btw' => $calaluted_pricings['btw'] ?? 0,
			'sub_total_btw' => $calaluted_pricings['sub_total_btw'] ?? 0,
		];

		$used_keys = [
			'beton_price',
			'brandstoftoeslag',
			'laagwatertoeslag',
			'application_price',
			'hoog-vloeibaar',
			'snelhardend',
			'fijn-grind',
			'vlinderbeton',
			'application_compound_total',
			'pump_callout_cost',
			'pumping_cost',
			'pumping_extra_hose_cost',
			'pump_cost',
			'rooms_cost',
			'butterfly_floor_cost',
			'allIn_cost',
			'sub_total',
			'btw',
			'sub_total_btw',
		];

		foreach ($calaluted_pricings as $key => $value) {
			if (!in_array($key, $used_keys, true)) {
				$formatted_calaluted_pricings[$key] = $value;
			}
		}

		return rest_ensure_response(array(
			'success' => true,
			'message' => 'Your data is calculated successfully',
			'raw_calculation' => $calaluted_pricings,
			'formatted_calculation' => $formatted_calaluted_pricings
		));

	} else {
		return new WP_Error('no_data', 'No data provided', array('status' => 400));
	}

}

//Get area code from db
function get_area_code_from_postal_code($postalCode)
{
	$firstFourDigits = substr($postalCode, 0, 4);

	if (strlen($firstFourDigits) !== 4 || !is_numeric($firstFourDigits)) {
		return new WP_Error(
			'no_data',
			'Invalid postal code format',
			array('status' => 400)
		);
	}

	global $wpdb;
	$table_name = $wpdb->prefix . 'postcodes';

	$query = $wpdb->prepare(
		"SELECT area_code
		 FROM $table_name
		 WHERE FIND_IN_SET(%s, REPLACE(zip, ' ', '')) > 0",
		$firstFourDigits
	);

	$area_code = $wpdb->get_var($query);

	if (empty($area_code)) {
		return new WP_Error(
			'no_data',
			'Invalid postal code format',
			array('status' => 400)
		);
	}

	return $area_code;
}

//Create a quotation and send pdf
function create_quotation($request)
{

	$externalData = $request->get_json_params();

	if ($externalData) {
		$data = $externalData;
		//wc_get_logger()->debug(json_encode($data));

		$postalCode = $externalData['postalcode'] ?? '';
		$area_code = get_area_code_from_postal_code($postalCode);

		if (is_wp_error($area_code)) {
			return $area_code;
		}
		$externalData['area_code'] = $area_code;

		$data['city'] = $data['postalcode'];
		$calc_data = $data;

		$calc_data['api_request'] = true;
		$calc_data['area_code'] = $externalData['area_code'];
		$calc_data['surace-sqm'] = $externalData['surace_sqm'];
		$calc_data['layer-thickness'] = $externalData['layer_thickness'];
		$calc_data['butterfly-floor'] = $externalData['butterfly_floor'];

		$calc_data['application'] = $externalData['application_product'];
		$calc_data['compounds'] = $externalData['composition'];
		$calc_data['release_method'] = $externalData['unloading'];
		$calc_data['pumping_distance'] = (isset($externalData['pump_type']) && $externalData['pump_type'] == 'mini' ? $externalData['pumping_distance'] : $externalData['boom_pumping_distance']);
		$calc_data['performance'] = $externalData['uitvoering'];
		$calc_data['layer_thickness'] = $externalData['layer_thickness'];
		$calc_data['rooms_count'] = $externalData['nos_rooms'];
		$calc_data['butterfly_floor'] = $externalData['butterfly_floor'];
		$calc_data['surface'] = $externalData['surace_sqm'];
		$calc_data['selected_floor'] = $externalData['flooring'];

		$pdf_data = save_quotation($calc_data);

		$pdf_id = stream_pdf_file($pdf_data['html'], $pdf_data['id'], $pdf_data['title']);
		$pdf_link = wp_get_attachment_url($pdf_id);

		return rest_ensure_response(array(
			'success' => true,
			'message' => 'Your quotation is generated successfully.',
			'pdf_link' => $pdf_link,
		));

	} else {
		return new WP_Error('no_data', 'No data provided', array('status' => 400));
	}

}

//Update beton ACFs
function update_acf_group_data($request)
{
	$data = $request->get_json_params();

	// Validate that we have data
	if (empty($data)) {
		return new WP_Error('no_data', 'No data provided', array('status' => 400));
	}

	$updated_fields = array();

	// Update General settings
	if (isset($data['general'])) {
		$general = $data['general'];
		if (isset($general['distance_calculation_locations'])) {
			update_field('distance_calculation_locations', $general['distance_calculation_locations'], 'option');
			$updated_fields[] = 'distance_calculation_locations';
		}
		if (isset($general['google_map_api_key'])) {
			update_field('google_map_api_key', $general['google_map_api_key'], 'option');
			$updated_fields[] = 'google_map_api_key';
		}
		if (isset($general['failsafe_email_notifier'])) {
			update_field('failsafe_email_notifier', $general['failsafe_email_notifier'], 'option');
			$updated_fields[] = 'failsafe_email_notifier';
		}
		if (isset($general['beton_product'])) {
			update_field('beton_product', $general['beton_product'], 'option');
			$updated_fields[] = 'beton_product';
		}
		if (isset($general['thank_you_page'])) {
			update_field('thank_you_page', $general['thank_you_page'], 'option');
			$updated_fields[] = 'thank_you_page';
		}
	}

	// Update Sellers
	if (isset($data['sellers'])) {
		$sellers = $data['sellers'];
		if (isset($sellers['beton_sellers'])) {
			update_field('beton_sellers', $sellers['beton_sellers'], 'option');
			$updated_fields[] = 'beton_sellers';
		}
		if (isset($sellers['discounts'])) {
			update_field('discounts', $sellers['discounts'], 'option');
			$updated_fields[] = 'discounts';
		}
	}

	// Update Application Pricing
	if (isset($data['application_pricing'])) {
		update_field('application', $data['application_pricing'], 'option');
		$updated_fields[] = 'application';
	}

	// Update Mini Pump Pricing
	if (isset($data['mini_pump_pricing'])) {
		$mini_pump = $data['mini_pump_pricing'];
		if (isset($mini_pump['mini_betonpomp_cost'])) {
			update_field('mini_betonpomp_cost', $mini_pump['mini_betonpomp_cost'], 'option');
			$updated_fields[] = 'mini_betonpomp_cost';
		}
		if (isset($mini_pump['call_out_min_distance'])) {
			update_field('call-out_min_distance', $mini_pump['call_out_min_distance'], 'option');
			$updated_fields[] = 'call-out_min_distance';
		}
		if (isset($mini_pump['mini_pump_call_out_fee'])) {
			update_field('mini_pump_call-out_fee', $mini_pump['mini_pump_call_out_fee'], 'option');
			$updated_fields[] = 'mini_pump_call-out_fee';
		}
		if (isset($mini_pump['pumping_distance_cost_per_m'])) {
			update_field('pumping_distance_cost_per_m', $mini_pump['pumping_distance_cost_per_m'], 'option');
			$updated_fields[] = 'pumping_distance_cost_per_m';
		}
		if (isset($mini_pump['extra_pipeline_trolley_cost'])) {
			update_field('extra_pipeline_trolley_cost', $mini_pump['extra_pipeline_trolley_cost'], 'option');
			$updated_fields[] = 'extra_pipeline_trolley_cost';
		}
		if (isset($mini_pump['pump_price_per_cubic_m'])) {
			update_field('pump_price_per_cubic_m', $mini_pump['pump_price_per_cubic_m'], 'option');
			$updated_fields[] = 'pump_price_per_cubic_m';
		}
		if (isset($mini_pump['surcharge_for_pumping_distance_over_limit'])) {
			update_field('surcharge_for_pumping_distance_over_limit', $mini_pump['surcharge_for_pumping_distance_over_limit'], 'option');
			$updated_fields[] = 'surcharge_for_pumping_distance_over_limit';
		}
	}

	// Update Giekpomp Pricing
	if (isset($data['giekpomp_pricing'])) {
		$giekpomp = $data['giekpomp_pricing'];
		if (isset($giekpomp['boom_pumping_prices'])) {
			update_field('boom_pumping_prices', $giekpomp['boom_pumping_prices'], 'option');
			$updated_fields[] = 'boom_pumping_prices';
		}
	}

	// Update All-in Pricing
	if (isset($data['all_in_pricing'])) {
		$all_in = $data['all_in_pricing'];
		if (isset($all_in['all_in_price'])) {
			update_field('all-in_price', $all_in['all_in_price'], 'option');
			$updated_fields[] = 'all-in_price';
		}
		if (isset($all_in['ground_floor_cost'])) {
			update_field('ground_floor_cost', $all_in['ground_floor_cost'], 'option');
			$updated_fields[] = 'ground_floor_cost';
		}
		if (isset($all_in['thickness_pricing'])) {
			update_field('thickness_pricing', $all_in['thickness_pricing'], 'option');
			$updated_fields[] = 'thickness_pricing';
		}
		if (isset($all_in['all_in_tooltip'])) {
			update_field('all_in_tooltip', $all_in['all_in_tooltip'], 'option');
			$updated_fields[] = 'all_in_tooltip';
		}
		if (isset($all_in['opties_verdiepingsvloer_tooltip'])) {
			update_field('opties_verdiepingsvloer_tooltip', $all_in['opties_verdiepingsvloer_tooltip'], 'option');
			$updated_fields[] = 'opties_verdiepingsvloer_tooltip';
		}
		if (isset($all_in['opties_vlindervloer_tooltip'])) {
			update_field('opties_vlindervloer_tooltip', $all_in['opties_vlindervloer_tooltip'], 'option');
			$updated_fields[] = 'opties_vlindervloer_tooltip';
		}
		if (isset($all_in['all_in_concrete_threshold'])) {
			update_field('all_in_concrete_threshold', $all_in['all_in_concrete_threshold'], 'option');
			$updated_fields[] = 'all_in_concrete_threshold';
		}
		if (isset($all_in['overlimit_price_per_cubic_m'])) {
			update_field('overlimit_price_per_cubic_m', $all_in['overlimit_price_per_cubic_m'], 'option');
			$updated_fields[] = 'overlimit_price_per_cubic_m';
		}
	}

	// Update Floor Pricing
	if (isset($data['floor_pricing'])) {
		$floor = $data['floor_pricing'];
		if (isset($floor['oppervlakte'])) {
			update_field('oppervlakte', $floor['oppervlakte'], 'option');
			$updated_fields[] = 'oppervlakte';
		}
	}

	// Update Offerte Factuur Benaming
	if (isset($data['offerte_factuur_benaming'])) {
		$offerte = $data['offerte_factuur_benaming'];
		if (isset($offerte['replacer'])) {
			update_field('replacer', $offerte['replacer'], 'option');
			$updated_fields[] = 'replacer';
		}
	}

	// Update date blocker
	if (isset($data['date_blocker'])) {
		$dates_for_days = isset($data['date_blocker']['dates_for_days']) ? $data['date_blocker']['dates_for_days'] : [];
		$blocked_dates = isset($data['date_blocker']['blocked_dates']) ? $data['date_blocker']['blocked_dates'] : [];
		$blocked_days = isset($data['date_blocker']['blocked_days']) ? $data['date_blocker']['blocked_days'] : [];

		$refine_blocked_dates = array_values(array_diff($blocked_dates, $dates_for_days));

		update_option('dayz_date_mapper_blocked_days_names', $blocked_days);
		update_option('dayz_date_mapper_blocked_days', $dates_for_days);
		update_option('dayz_blocked_dates', $refine_blocked_dates);
		$updated_fields[] = 'date_blocker';
	}

	// Clear any relevant caches
	wp_cache_delete('alloptions', 'options');

	return rest_ensure_response(array(
		'success' => true,
		'message' => 'ACF options updated successfully',
		'updated_fields' => $updated_fields,
		'total_updated' => count($updated_fields)
	));
}


//Get Beton ACFs
function get_structured_acf_options($request)
{
	$structured_data = array(
		'general' => array(),
		'sellers' => array(),
		'application_pricing' => array(),
		'mini_pump_pricing' => array(),
		'giekpomp_pricing' => array(),
		'all_in_pricing' => array(),
		'floor_pricing' => array(),
		'offerte_factuur_benaming' => array()
	);

	// Get all ACF options
	$all_options = get_fields('option');

	if (!$all_options) {
		return new WP_Error('no_options', 'No ACF options found', array('status' => 404));
	}

	// General settings
	$structured_data['general'] = array(
		'distance_calculation_locations' => $all_options['distance_calculation_locations'] ?? '',
		'google_map_api_key' => $all_options['google_map_api_key'] ?? '',
		'failsafe_email_notifier' => $all_options['failsafe_email_notifier'] ?? '',
		'beton_product' => $all_options['beton_product'] ?? '',
		'thank_you_page' => $all_options['thank_you_page'] ?? ''
	);

	// Sellers
	$structured_data['sellers'] = array(
		'beton_sellers' => $all_options['beton_sellers'] ?? array(),
		'discounts' => $all_options['discounts'] ?? array()
	);

	// Application Pricing
	$structured_data['application_pricing'] = $all_options['application'] ?? array();

	// Mini Pump Pricing
	$structured_data['mini_pump_pricing'] = array(
		'mini_betonpomp_cost' => $all_options['mini_betonpomp_cost'] ?? '',
		'call_out_min_distance' => $all_options['call-out_min_distance'] ?? '',
		'mini_pump_call_out_fee' => $all_options['mini_pump_call-out_fee'] ?? '',
		'pumping_distance_cost_per_m' => $all_options['pumping_distance_cost_per_m'] ?? '',
		'extra_pipeline_trolley_cost' => $all_options['extra_pipeline_trolley_cost'] ?? '',
		'pump_price_per_cubic_m' => $all_options['pump_price_per_cubic_m'] ?? '',
		'surcharge_for_pumping_distance_over_limit' => $all_options['surcharge_for_pumping_distance_over_limit'] ?? ''
	);

	// Giekpomp Pricing
	$structured_data['giekpomp_pricing'] = array(
		'boom_pumping_prices' => $all_options['boom_pumping_prices'] ?? array()
	);

	// All-in Pricing
	$structured_data['all_in_pricing'] = array(
		'all_in_price' => $all_options['all-in_price'] ?? '',
		'ground_floor_cost' => $all_options['ground_floor_cost'] ?? '',
		'thickness_pricing' => $all_options['thickness_pricing'] ?? array(),
		'all_in_tooltip' => $all_options['all_in_tooltip'] ?? '',
		'opties_verdiepingsvloer_tooltip' => $all_options['opties_verdiepingsvloer_tooltip'] ?? '',
		'opties_vlindervloer_tooltip' => $all_options['opties_vlindervloer_tooltip'] ?? '',
		'all_in_concrete_threshold' => $all_options['all_in_concrete_threshold'] ?? '',
		'overlimit_price_per_cubic_m' => $all_options['overlimit_price_per_cubic_m'] ?? ''
	);

	// Floor Pricing
	$structured_data['floor_pricing'] = array(
		'oppervlakte' => $all_options['oppervlakte'] ?? array()
	);

	// Offerte Factuur Benaming
	$structured_data['offerte_factuur_benaming'] = array(
		'replacer' => $all_options['replacer'] ?? array()
	);

	return rest_ensure_response($structured_data);
}


function get_beton_unit_price($request)
{
	$externalData = $request->get_json_params();

	if (empty($externalData) || !isset($externalData['order_id'])) {
		return new WP_Error('no_data', 'No order ID provided', array('status' => 400));
	}

	$order_id = intval($externalData['order_id']);
	$order = wc_get_order($order_id);
	$travel_distance = get_post_meta($order_id, '_shipping_travel_distance', true);

	if (!$order) {
		return new WP_Error('invalid_order', 'Order not found', array('status' => 404));
	}

	// Collect all line items
	$line_items = array();
	$raw_meta_items = array(); // Array to store raw meta items

	foreach ($order->get_items() as $item_id => $item) {
		/* @var $item \WC_Order_Item_Product */
		$product = $item->get_product();

		// Store raw item data
		$raw_meta_items[$item_id] = array(
			'product_id' => $item->get_product_id(),
			'product_name' => $item->get_name(),
			'quantity' => $item->get_quantity(),
			'total' => $item->get_total(),
			'subtotal' => $item->get_subtotal(),
			'meta_data' => array()
		);

		if (!$product) {
			continue; // Skip if product not found
		}

		// Deviations map for special calculations
		$deviations = array(
			'raw_applications_label' => 'raw_applications_value',
			'raw_concrete_label' => 'raw_hidden_concrete_qty_value',
			'raw_hidden_hoog-vloeibaar_label' => 'raw_hidden_concrete_qty_value',
			'raw_hidden_extra-hoge-sterkte_label' => 'raw_hidden_concrete_qty_value',
			'raw_hidden_snelhardend_label' => 'raw_hidden_concrete_qty_value',
			'raw_hidden_fijn-grind_label' => 'raw_hidden_concrete_qty_value',
			'raw_pumping_label' => 'raw_pumping_value',
			'raw_brandstoftoeslag_label' => 'raw_hidden_concrete_qty_value',
			'raw_laagwatertoeslag_label' => 'raw_hidden_concrete_qty_value',
		);

		$skipping = array('raw_hidden_concrete_qty_label', 'raw_hidden_pumping_distance_label');

		// Process each meta item
		foreach ($item->get_meta_data() as $meta) {
			// Store raw meta data
			$raw_meta_items[$item_id]['meta_data'][] = array(
				'meta_id' => $meta->id,
				'key' => $meta->key,
				'value' => $meta->value,
				'display_key' => $meta->key,
				'display_value' => $meta->value
			);

			if (!str_contains($meta->key, 'raw_') || in_array($meta->key, $skipping)) {
				continue;
			}

			if (str_contains($meta->key, 'label') && $meta->key !== 'raw_compositions_label') {
				$value_key = str_replace('label', 'value', $meta->key);
				$total_value = $item->get_meta($value_key);
				$qty = 1;
				$unit_price = $total_value;

				// Handle deviations that need quantity division
				if (isset($deviations[$meta->key])) {
					$qty_key = $deviations[$meta->key];
					$qty = $item->get_meta($qty_key);

					if ($qty > 0) {
						$unit_price = $total_value / $qty;
					} else {
						$unit_price = $total_value;
					}
				}

				$description = $meta->value;

				// Handle special cases - USING YOUR ORIGINAL CODE
				if (str_contains($description, 'Toepassing')) {
					$application_value = floatval($item->get_meta('raw_applications_value'));

					$unit_price = $application_value;
					$qty = 1;

					$total_value = $unit_price;
				}

				if (str_contains($description, 'Pompafstand')) {
					$total_value = $item->get_meta('raw_pumping_value');
					preg_match('/(\d+)\s*m\b/', $total_value, $matches);
					if (!empty($matches[1])) {
						$qty = $matches[1];
					}
					$unit_price = $total_value / $qty;
				}

				// Format description
				if (str_contains($description, 'Giekpomp')) {
					$pompafstand = $item->get_meta('raw_hidden_pumping_distance_value');
					if (!empty($pompafstand)) {
						$description .= ': ' . $pompafstand . 'm';
					}
				}

				if (str_contains($description, 'Aantal Kamers')) {
					$description .= ': ' . $total_value;
					$qty = $total_value;
					$unit_price = 0;
				}

				if (str_contains($description, 'Oppervlak')) {
					$unit_price = 0;
					$total_value = 0;
				}

				if (str_contains($description, 'Voorrijkosten')) {
					$pump_callout_fee = get_field('mini_pump_call-out_fee', 'option');
					$pump_callout_min_distance_cost = get_field('call-out_min_distance', 'option');
					$travel_cost = $total_value;

					if ($travel_cost > $pump_callout_min_distance_cost && $pump_callout_fee > 0) {
						$backcal_travel_distance = $travel_cost / $pump_callout_fee;
					} else {
						$backcal_travel_distance = 0;
					}
				}

				// Get product tax rate
				$tax_rate = 0;
				$tax_class = $product->get_tax_class();
				$tax_rates = WC_Tax::get_rates($tax_class);
				if (!empty($tax_rates)) {
					$tax_rate = reset($tax_rates)['rate']; // Get first tax rate
				}

				// Calculate tax amount
				$tax_amount = ($total_value * $tax_rate) / 100;

				// Collect line item data
				$line_items[] = array(
					'item_id' => $item_id,
					'product_id' => $product->get_id(),
					'product_name' => $product->get_name(),
					'description' => $description,
					'quantity' => floatval($qty),
					'unit_price' => round(floatval($unit_price), 2),
					'total' => round(floatval($total_value), 2),
					'tax_rate' => floatval($tax_rate),
					'tax_amount' => round(floatval($tax_amount), 2),
					'total_with_tax' => round(floatval($total_value + $tax_amount), 2),
				);

			} elseif ($meta->key == 'raw_compositions_label' && empty($item->get_meta('raw_hidden_hoog-vloeibaar_label'))) {
				// Handle composition label
				$value_key = str_replace('label', 'value', $meta->key);
				$total_value = $item->get_meta($value_key);
				$description = $meta->value;

				// Get product tax rate
				$tax_rate = 0;
				$tax_class = $product->get_tax_class();
				$tax_rates = WC_Tax::get_rates($tax_class);
				if (!empty($tax_rates)) {
					$tax_rate = reset($tax_rates)['rate'];
				}

				// Calculate tax amount
				$tax_amount = ($total_value * $tax_rate) / 100;

				// Collect line item data
				$line_items[] = array(
					'item_id' => $item_id,
					'product_id' => $product->get_id(),
					'product_name' => $product->get_name(),
					'description' => $description,
					'quantity' => 1,
					'unit_price' => round(floatval($total_value), 2),
					'total' => round(floatval($total_value), 2),
					'tax_rate' => floatval($tax_rate),
					'tax_amount' => round(floatval($tax_amount), 2),
					'total_with_tax' => round(floatval($total_value + $tax_amount), 2),
				);
			}
		}
	}

	// Get order totals directly from WooCommerce order object
	$order_totals = array(
		'subtotal' => round(floatval($order->get_subtotal()), 2),
		'tax_total' => round(floatval($order->get_total_tax()), 2),
		'grand_total' => round(floatval($order->get_total()), 2),
		'shipping_total' => round(floatval($order->get_shipping_total()), 2),
		'discount_total' => round(floatval($order->get_discount_total()), 2),
	);

	// Return the response
	return rest_ensure_response(array(
		'success' => true,
		'message' => 'Line items collected successfully.',
		'travel_distance' => !empty($travel_distance) ? $travel_distance : $backcal_travel_distance,
		'line_items' => $line_items,
		'order_totals' => $order_totals, // Order totals from WooCommerce
		'count' => count($line_items),
		'raw_meta_count' => count($raw_meta_items),
		//'raw_meta_items' => $raw_meta_items, // Return raw meta items
	));
}


// add_action('wp_head', function() {
//     if (!isset($_GET['missings'])) return;

//     $order = wc_get_order(3109);
//     if (!$order) {
//         echo '<pre>Order not found</pre>';
//         return;
//     }

//     foreach ($order->get_items() as $item_id => $item) {
//         echo '<h4>Item ID: ' . $item_id . '</h4>';

//         // Method 1: Get ALL meta data (including hidden)
//         echo '<h5>All Raw Meta Data:</h5>';
//         $all_raw_meta = $item->get_meta_data();
//         echo '<pre>';
//         print_r($all_raw_meta);
//         echo '</pre>';

//         // Method 2: Check specific keys
//         echo '<h5>Specific Raw Keys:</h5>';
//         $specific_keys = array(
//             'raw_application_label',
//             'raw_application_value',
//             'raw_concrete_label',
//             'raw_concrete_value',
//             'raw_hidden_concrete_qty_label',
//             'raw_hidden_concrete_qty_value'
//         );

//         foreach ($specific_keys as $key) {
//             $value = $item->get_meta($key);
//             if ($value) {
//                 echo "Key: <strong>$key</strong> = $value<br>";
//             }
//         }

//         // Method 3: See what filters are applied
//         echo '<h5>Applied Filters:</h5>';
//         $has_filter = has_filter('woocommerce_order_item_get_formatted_meta_data');
//         if ($has_filter) {
//             echo 'Filters found on woocommerce_order_item_get_formatted_meta_data<br>';
//             // Get all attached functions
//             global $wp_filter;
//             if (isset($wp_filter['woocommerce_order_item_get_formatted_meta_data'])) {
//                 echo '<pre>';
//                 print_r($wp_filter['woocommerce_order_item_get_formatted_meta_data']);
//                 echo '</pre>';
//             }
//         } else {
//             echo 'No filters on woocommerce_order_item_get_formatted_meta_data<br>';
//         }
//     }
// });

// Looking to send emails in production? Check out our Email API/SMTP product!
function mailtrap($phpmailer)
{
	$phpmailer->isSMTP();
	$phpmailer->Host = 'sandbox.smtp.mailtrap.io';
	$phpmailer->SMTPAuth = true;
	$phpmailer->Port = 2525;
	$phpmailer->Username = 'eed38a9afbe321';
	$phpmailer->Password = 'f59464676b3a24';
}

add_action('phpmailer_init', 'mailtrap');