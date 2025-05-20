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
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<!-- Header Section -->
<div
    class="mx-auto flex w-full items-center justify-center text-white bg-[rgba(0,9,18,0.85)] backdrop-blur-[12.5px] p-3 rounded-lg">
    <div class="flex w-full max-w-sm items-center justify-between text-white md:w-11/12 md:max-w-6xl">
        <a href="https://itrader.com" class="flex items-center space-x-4 !no-underline">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="logo" class="!my-0 size-10">
            <span class="text-white !no-underline text-2xl font-bold">
                <?php esc_html_e( 'iTrade', 'itrade' ); ?>
            </span>
        </a>
        <div
            class="hidden md:flex items-center justify-center space-x-4 rounded-lg border border-white/8 bg-[#0B0C16] bg-[linear-gradient(55deg,rgba(14,16,29,0)_40.49%,#121525_99.37%)] p-3 space-y-4">
            <!-- Menu Items -->
            <a href="#"
                class="whitespace-nowrap !no-underline px-4 py-1 !m-0 !text-white hover:bg-white/10 rounded-lg transition-colors">
                <?php esc_html_e( 'Как это работает', 'itrade' ); ?>
            </a>
            <a href="#"
                class="whitespace-nowrap !no-underline px-4 py-1 !m-0 !text-white hover:bg-white/10 rounded-lg transition-colors">
                <?php esc_html_e( 'Условия', 'itrade' ); ?>
            </a>
            <a href="#"
                class="whitespace-nowrap !no-underline px-4 py-1 !m-0 !text-white hover:bg-white/10 rounded-lg transition-colors">
                <?php esc_html_e( 'Поддержка', 'itrade' ); ?>
            </a>

            <!-- Styled Button -->
            <button
                class="w-full rounded-lg border border-[#3980F5] bg-[#010706] text-white py-1 px-6 hover:bg-[#3980F5]/10 transition-colors">
                <?php esc_html_e( 'Login', 'itrade' ); ?>
            </button>
        </div>
        <div class="flex md:hidden items-center justify-center space-x-4">
            <button
                class="whitespace-nowrap w-full rounded-lg border border-[#3980F5] bg-[#010706] text-white py-1 px-6 hover:bg-[#3980F5]/10 transition-colors">
                <?php esc_html_e( 'Начать сейчас', 'itrade' ); ?>
            </button>
        </div>
    </div>
</div>
<!-- Form Section -->
<div class="mx-auto mt-5 max-w-sm md:max-w-6xl">
    <!-- Header Section -->
    <div class="items-center justify-start text-white md:flex">
        <!-- Go Back Section -->
        <a id="prev_button" class="flex items-center no-underline" href="javascript:void(0)">
            <img decoding="async" src="<?php echo get_template_directory_uri(); ?>/assets/img/chevron-left.png"
                alt="back" class="!my-0 size-5 sm:mr-2">
            <span class="text-white no-underline hover:text-gray-800">
                <?php esc_html_e( 'Go Back', 'itrade' ); ?>
            </span>
        </a>
    </div>

    <!-- Checkout Section -->
    <form name="checkout" method="post" class="checkout woocommerce-checkout"
        action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data"
        aria-label="<?php echo esc_attr__( 'Checkout', 'woocommerce' ); ?>">

        <?php if ( $checkout->get_checkout_fields() ) : ?>

        <div id="coupon_display"></div>
        <!-- Customer Details -->
        <div id="customer_details" class="first-column">
            <!-- <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?> -->
            <?php do_action( 'woocommerce_checkout_billing' ); ?>
        </div>

        <!-- Coupon Details -->
        <div id="coupon_details" class="second-column text-white">
            <div
                class="mb-2 p-3 flex w-full flex-col flex-nowrap lg:mb-4 rounded-xl border border-[#333546] bg-[linear-gradient(55deg,rgba(14,16,29,0)_40.49%,#121525_99.37%)] bg-[#0B0C16]">
                <h3 class="text-white">
                    <?php esc_html_e( 'Apply Coupon Code', 'itrade' ); ?>
                </h3>
                <p class="">
                    <?php esc_html_e( 'If you have a coupon code, please apply it below', 'itrade' ); ?>
                </p>
                <div class="flex-1">
                    <!-- Coupon Code Input -->
                    <div id="coupon_div" class="w-full flex flex-col items-center space-y-2">
                        <input type="text" id="custom_coupon_code" name="coupon_code" placeholder="Coupon Code"
                            class="w-full rounded-lg border border-[#333546] bg-[#141629] text-white px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#04C7B5] placeholder-gray-400" />
                        <button type="button" id="apply_coupon_button"
                            class="w-full rounded-lg bg-gradient-to-r from-[#04C7B5] to-[#3980F5] shadow-[0_3px_45px_0_rgba(13,187,192,0.65)] text-white px-5 py-3 border-none cursor-pointer transition-all hover:opacity-90 hover:-translate-y-0.5">
                            <?php esc_html_e( 'Apply Coupon Code', 'itrade' ); ?>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Payment Details -->
            <div id="payment_details"
                class="p-3 mb-5 rounded-xl border border-[#333546] bg-linear-(--my-gradient) bg-[#0B0C16]">
                <h3 id="order_review_heading" class="rounded-lg font-bold !text-white">
                    <?php esc_html_e( 'Your Order Summary', 'itrade' ); ?>
                </h3>

                <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>

                <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

            </div>

            <!-- Payment Gateways -->
            <div id="payment_gateways"
                class="p-3 rounded-xl border border-[#333546] bg-linear-(--my-gradient) bg-[#0B0C16]">
                <h3 id="order_review_heading" class="rounded-lg font-bold !text-white">
                    <?php esc_html_e( 'Payment Details', 'itrade' ); ?>
                </h3>

                <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>

                <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

            </div>
        </div>

        <?php endif; ?>

    </form>
    <?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
</div>

<!-- Footer Section -->
<div class="mt-5 hidden md:flex items-center justify-center w-full bg-[rgba(0,9,18,0.85)] backdrop-blur-[12.5px] p-3">
    <div class="flex max-w-sm items-center justify-between text-white md:w-full md:max-w-6xl p-3">
        <div class="flex items-start justify-center space-y-4 flex-col">
            <a href="https://itrader.com" class="flex items-center space-x-4 !no-underline">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="logo"
                    class="!my-0 size-10">
                <span class="text-white !no-underline text-2xl font-bold">
                    <?php esc_html_e( 'iTrade', 'itrade' ); ?>
                </span>
            </a>
            <p class="!text-[#787878]">
                <?php esc_html_e( '© 2025 ITrade, все права защищены', 'itrade' ); ?>
            </p>
        </div>
        <div class="flex flex-col items-center justify-center space-y-4 space-y-4">
            <!-- Menu Items -->
            <div class="flex items-center justify-center space-x-4">
                <a href="#"
                    class="whitespace-nowrap !no-underline px-4 py-1 !m-0 !text-white hover:bg-white/10 rounded-lg transition-colors">
                    <?php esc_html_e( 'Как это работает', 'itrade' ); ?>
                </a>
                <a href="#"
                    class="whitespace-nowrap !no-underline px-4 py-1 !m-0 !text-white hover:bg-white/10 rounded-lg transition-colors">
                    <?php esc_html_e( 'Условия', 'itrade' ); ?>
                </a>
                <a href="#"
                    class="whitespace-nowrap !no-underline px-4 py-1 !m-0 !text-white hover:bg-white/10 rounded-lg transition-colors">
                    <?php esc_html_e( 'Поддержка', 'itrade' ); ?>
                </a>
            </div>
            <div class="flex items-center justify-center space-x-4">
                <a href="#"
                    class="whitespace-nowrap !no-underline !text-[#787878] px-4 py-1 !m-0 hover:bg-white/10 rounded-lg transition-colors">
                    <?php esc_html_e( 'Политика конфиденциальности', 'itrade' ); ?>
                </a>
                <a href="#"
                    class="whitespace-nowrap !no-underline !text-[#787878] px-4 py-1 !m-0 hover:bg-white/10 rounded-lg transition-colors">
                    <?php esc_html_e( 'Условия использования', 'itrade' ); ?>
                </a>
            </div>

        </div>
        <div class="flex flex-col items-center justify-center space-y-4">
            <!-- Menu Items -->
            <a href="#"
                class="whitespace-nowrap !no-underline px-4 py-1 !m-0 !text-white hover:text-white/50 transition-colors">
                <?php esc_html_e( 'itradesupport@gmail.com', 'itrade' ); ?>
            </a>

            <div class="flex items-center justify-center space-x-4">
                <a href="#" class="px-4 py-1 !m-0 hover:drop-shadow-white-glow">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Whatsapp.png" alt="whatsapp"
                        class="!my-0 size-10">
                </a>
                <a href="#" class="px-4 py-1 !m-0 hover:drop-shadow-white-glow">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/black.png" alt="telegram"
                        class="!my-0 size-10">
                </a>
            </div>
        </div>
    </div>

</div>

<div class="mt-5 flex md:hidden items-center justify-center w-full bg-[rgba(0,9,18,0.85)] backdrop-blur-[12.5px] p-3">
    <div class="flex flex-col items-center justify-between text-white w-full p-3 space-y-4">
        <div class="flex items-start justify-between w-full space-x-4">
            <a href="https://itrader.com" class="flex items-center space-x-4 !no-underline">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="logo"
                    class="!my-0 size-10">
                <span class="text-white !no-underline text-2xl font-bold">
                    <?php esc_html_e( 'iTrade', 'itrade' ); ?>
                </span>
            </a>
            <div class="flex items-center justify-center space-x-4">
                <a href="#" class="px-4 py-1 !m-0 hover:drop-shadow-white-glow">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Whatsapp.png" alt="whatsapp"
                        class="!my-0 size-10">
                </a>
                <a href="#" class="px-4 py-1 !m-0 hover:drop-shadow-white-glow">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/black.png" alt="telegram"
                        class="!my-0 size-10">
                </a>
            </div>
        </div>
        <div class="flex items-center justify-center">
            <a href="mailto:itradesupport@gmail.com"
                class="whitespace-nowrap !no-underline !m-0 !text-white hover:text-white/50 transition-colors">
                <?php esc_html_e( 'itradesupport@gmail.com', 'itrade' ); ?>
            </a>
        </div>
        <div class="flex items-center justify-around w-full space-x-4">
            <a href="#" class="whitespace-nowrap !no-underline !m-0 !text-white hover:bg-white/10 transition-colors">
                <?php esc_html_e( 'Как это работает', 'itrade' ); ?>
            </a>
            <a href="#" class="whitespace-nowrap !no-underline !m-0 !text-white hover:bg-white/10 transition-colors">
                <?php esc_html_e( 'Условия', 'itrade' ); ?>
            </a>
            <a href="#" class="whitespace-nowrap !no-underline !m-0 !text-white hover:bg-white/10 transition-colors">
                <?php esc_html_e( 'Поддержка', 'itrade' ); ?>
            </a>
        </div>
        <div class="flex items-center justify-center">
            <p class="!text-[#787878]">
                <?php esc_html_e( '© 2025 ITrade, все права защищены', 'itrade' ); ?>
            </p>
        </div>
        <div class="flex items-center justify-around w-full space-x-4">
            <a href="#" class="!no-underline !text-white !m-0 hover:bg-white/10 transition-colors">
                <?php esc_html_e( 'Политика конфиденциальности', 'itrade' ); ?>
            </a>
            <a href="#" class="!no-underline !text-white !m-0 hover:bg-white/10 transition-colors">
                <?php esc_html_e( 'Условия использования', 'itrade' ); ?>
            </a>
        </div>
    </div>

</div>

<?php
get_footer();