/**
 * Front-end JavaScript
 *
 * The JavaScript code you place here will be processed by esbuild. The output
 * file will be created at `../theme/js/script.min.js` and enqueued in
 * `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
	// Elements
	const couponDiv = document.getElementById('coupon_div');
	const couponAccepted = document.getElementById('coupon_accepted');
	const couponDisplay = document.getElementById('coupon_display');
	const applyCouponButton = document.getElementById('apply_coupon_button');
	const customCouponCode = document.getElementById('custom_coupon_code');
	const couponCode = document.getElementById('coupon_code');

	// Clear notices function
	function clearCouponNotices() {
		if (couponDisplay) couponDisplay.innerHTML = '';
	}

	// Reset apply button to default state
	function resetApplyButton() {
		if (applyCouponButton) {
			applyCouponButton.disabled = false;
			applyCouponButton.textContent = 'Apply Coupon';
		}
	}

	// 1. Handle custom coupon form submission
	if (applyCouponButton) {
		applyCouponButton.addEventListener('click', function (e) {
			e.preventDefault();
			applyCustomCoupon();
		});
	}

	// 2. Handle Enter key in coupon input
	if (customCouponCode) {
		customCouponCode.addEventListener('keypress', function (e) {
			if (e.which === 13) {
				e.preventDefault();
				applyCustomCoupon();
			}
		});
	}

	// 3. Apply coupon via default WooCommerce form (hidden)
	function applyCustomCoupon() {
		var couponCodeValue = customCouponCode.value.trim();

		if (!couponCodeValue) {
			displayInCustomDiv('Please enter a coupon code', 'error');
			return;
		}

		clearCouponNotices();

		// Set the value in the WooCommerce coupon field
		if (couponCode) couponCode.value = couponCodeValue;

		// Find the actual WooCommerce coupon form
		var wcCouponForm = document.querySelector('form.checkout_coupon');

		if (wcCouponForm) {
			// Update button state
			if (applyCouponButton) {
				applyCouponButton.disabled = true;
				applyCouponButton.textContent = 'Applying...';
			}

			// Create a new submit event
			var submitEvent = new Event('submit', {
				bubbles: true,
				cancelable: true,
			});

			// Dispatch the event on the WooCommerce form
			wcCouponForm.dispatchEvent(submitEvent);

			// If the form wasn't prevented from submitting, submit it
			if (!submitEvent.defaultPrevented) {
				wcCouponForm.submit();
			}
			// Set timeout to reset button after 3 seconds if no response
			setTimeout(resetApplyButton, 3000);
		} else {
			displayInCustomDiv('Could not find coupon form', 'error');
			resetApplyButton();
		}
	}

	// 4. Display messages in your custom div
	function displayInCustomDiv(message, type) {
		var alertClass =
			type === 'error' ? 'woocommerce-error' : 'woocommerce-message';
		couponDisplay.innerHTML =
			'<div class="' +
			alertClass +
			'" role="alert">' +
			message +
			'</div>';
	}

	// 5. Intercept ALL WooCommerce messages and redirect to your div
	function interceptWooCommerceMessages() {
		var messages = document.querySelectorAll(
			'.woocommerce-message:not(#coupon_display *), .woocommerce-error:not(#coupon_display *), .coupon-error-notice:not(#coupon_display *)'
		);

		if (messages.length) {
			messages.forEach(function (msg) {
				var isCouponErrorNotice = msg.classList.contains(
					'coupon-error-notice'
				);

				if (isCouponErrorNotice) {
					couponDisplay.innerHTML =
						'<div class="woocommerce-error" role="alert">' +
						msg.textContent +
						'</div>';
					// Reset button when we get a response
					resetApplyButton();
				} else {
					couponDisplay.innerHTML = msg.outerHTML;
				}
				msg.remove();
			});
		}
	}

	// 6. Run interceptors on these events:
	document.body.addEventListener('updated_checkout', handleCouponEvents);
	document.body.addEventListener('updated_cart_totals', handleCouponEvents);
	document.body.addEventListener('applied_coupon', handleCouponEvents);
	document.body.addEventListener('removed_coupon', handleCouponEvents);

	function handleCouponEvents() {
		interceptWooCommerceMessages();
		resetApplyButton();

		if (applyCouponButton) {
			applyCouponButton.disabled = false;
			applyCouponButton.textContent = 'Apply Coupon';
		}

		const hasCoupons =
			document.querySelectorAll('.cart-discount').length > 0;
		if (hasCoupons) {
			couponDiv.style.display = 'none';
			couponAccepted.style.display = 'flex';
			sessionStorage.setItem('couponApplied', 'true');
		} else {
			couponDiv.style.display = 'flex';
			couponAccepted.style.display = 'none';
			sessionStorage.setItem('couponApplied', 'false');
		}
	}

	// 7. Message check interval
	setInterval(interceptWooCommerceMessages, 500);

	// 8. MutationObserver for dynamic notices
	const observer = new MutationObserver(function (mutations) {
		mutations.forEach(function (mutation) {
			mutation.addedNodes.forEach(function (node) {
				if (
					node.nodeType === 1 &&
					node.classList.contains('coupon-error-notice')
				) {
					interceptWooCommerceMessages();
				}
			});
		});
	});
	observer.observe(document.body, { childList: true, subtree: true });
});
