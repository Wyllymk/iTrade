<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package iTrade
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

add_filter( 'woocommerce_checkout_fields', 'itrade_customize_checkout_fields' );
function itrade_customize_checkout_fields( $fields ) {
	// Remove unwanted fields
	unset( $fields['billing']['billing_company'] );
	unset( $fields['billing']['billing_address_2'] );

	// remove shipping fields
	unset( $fields['order']['order_comments'] );
	unset( $fields['shipping']['shipping_first_name'] );
	unset( $fields['shipping']['shipping_last_name'] );
	unset( $fields['shipping']['shipping_company'] );
	unset( $fields['shipping']['shipping_country'] );
	unset( $fields['shipping']['shipping_address_1'] );
	unset( $fields['shipping']['shipping_address_2'] );
	unset( $fields['shipping']['shipping_city'] );
	unset( $fields['shipping']['shipping_state'] );
	unset( $fields['shipping']['shipping_postcode'] );

	return $fields;
}



function custom_billing_title( $translated_text, $text, $domain ) {
	if ( $text === 'Billing details' && $domain === 'woocommerce' ) {
		return 'Billing Details';
	}
	return $translated_text;
}
add_filter( 'gettext', 'custom_billing_title', 20, 3 );

function restrict_cart_to_single_product( $cart_item_data, $product_id ) {
	// Get the current cart instance
	$cart = WC()->cart;

	// Clear the cart if it contains any products
	if ( ! empty( $cart->get_cart() ) ) {
		$cart->empty_cart();
	}

	return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'restrict_cart_to_single_product', 10, 2 );

add_action( 'template_redirect', 'check_login_and_redirect' );

function check_login_and_redirect() {
	if ( ! is_user_logged_in() ) {
		$current_page = get_current_page_type();

		// List of restricted pages/post types
		$restricted_pages = array(
			'shop',
			'cart',			
			'product'
 		);

		if ( in_array( $current_page, $restricted_pages ) ) {
			$external_url = 'https://itrade.money/';

			// Perform the redirect
			wp_redirect( $external_url );
			exit;
		}
	}
}

function get_current_page_type() {
	global $post;

	if ( is_shop() ) {
		return 'shop';
	}
	if ( is_cart() ) {
		return 'cart';
	}
	if ( is_front_page() ) {
		return 'home';
	}
	if ( is_account_page() ) {
		return 'account';
	}
	if ( is_product() ) {
		return 'product';
	}

	return '';
}

add_filter(
	'woocommerce_add_to_cart_redirect',
	function ( $url, $adding_to_cart ) {
		return wc_get_checkout_url();
	},
	10,
	2
);

add_action(
	'template_redirect',
	function () {
		if ( is_singular( 'product' ) ) {
			// The external URL to redirect to
			$external_url = 'https://itrade.money/';

			// Perform the redirect
			wp_redirect( $external_url );
			exit;
		}
	}
);

add_filter( 'woocommerce_payment_complete_order_status', 'change_zero_dollar_order_status', 10, 3 );
function change_zero_dollar_order_status( $status, $order_id, $order ) {
	if ( $order->get_total() == 0 ) {
		return 'completed'; // Change to 'on-hold' or 'pending'
	}
	return $status;
}