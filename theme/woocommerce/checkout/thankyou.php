<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="min-h-screen flex flex-col items-center justify-between">
    <!-- Header Section -->
    <div
        class="mx-auto flex w-full items-center justify-center text-white bg-[rgba(0,9,18,0.85)] backdrop-blur-[12.5px] p-3 rounded-lg">
        <div class="flex w-full max-w-sm items-center justify-between text-white md:w-11/12 md:max-w-6xl">
            <a href="<?php echo esc_url( site_url( '/' ) ); ?>" class="flex items-center space-x-4 !no-underline">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="logo"
                    class="!my-0 size-10">
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
                <button href="#"
                    class="cursor-pointer w-full rounded-lg border border-[#3980F5] bg-[#010706] text-white py-1 px-6 hover:bg-[#3980F5]/10 transition-colors">
                    <?php esc_html_e( 'Login', 'itrade' ); ?>
                </button>
            </div>
            <div class="flex md:hidden items-center justify-center space-x-4">
                <button href="#"
                    class="whitespace-nowrap w-full rounded-lg border border-[#3980F5] bg-[#010706] text-white py-1 px-6 hover:bg-[#3980F5]/10 transition-colors">
                    <?php esc_html_e( 'Начать сейчас', 'itrade' ); ?>
                </button>
            </div>
        </div>
    </div>

    <div class="mx-auto mt-20 mb-10 flex max-w-sm flex-col items-center justify-center md:max-w-5xl">

        <?php
		if ( $order ) :

			do_action( 'woocommerce_before_thankyou', $order->get_id() );
			?>

        <?php if ( $order->has_status( 'failed' ) ) : ?>

        <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed z-20">
            <?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?>
        </p>

        <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions z-20">
            <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>"
                class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
            <?php if ( is_user_logged_in() ) : ?>
            <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"
                class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
            <?php endif; ?>
        </p>

        <?php else : ?>

        <div class="align-center flex flex-col items-center justify-center z-20">
            <h1 class="mt-20 text-center text-white">
                <span class="font-light">
                    <?php esc_html_e( 'Your order ', 'itrade' ); ?>
                </span>
                <span class="font-light text-ai-green">
                    <?php esc_html_e( '#', 'itrade' ); ?><?php echo $order->get_order_number(); ?><br>
                </span>
                <?php esc_html_e( 'has been successfully placed!', 'itrade' ); ?>
            </h1>
            <img decoding="async" src="<?php echo get_template_directory_uri(); ?>/assets/img/tick.svg" alt="tick"
                class="my-0 size-40 sm:mr-2">

        </div>

        <?php endif; ?>

        <?php else : ?>

        <?php wc_get_template( 'checkout/order-received.php', array( 'order' => false ) ); ?>

        <?php endif; ?>

    </div>

    <!-- Footer Section -->
    <div
        class="mt-5 hidden md:flex items-center justify-center w-full bg-[rgba(0,9,18,0.85)] backdrop-blur-[12.5px] p-3">
        <div class="flex max-w-sm items-center justify-between text-white md:w-full md:max-w-6xl p-3">
            <div class="flex items-start justify-center space-y-4 flex-col">
                <a href="<?php echo esc_url( site_url( '/' ) ); ?>" class="flex items-center space-x-4 !no-underline">
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
                    class="whitespace-nowrap !no-underline px-4 py-1 !m-0 !text-white hover:!text-white/50 transition-colors">
                    <?php esc_html_e( 'itradesupport@gmail.com', 'itrade' ); ?>
                </a>

                <div class="flex items-center justify-center space-x-4">
                    <a href="#" class="px-4 py-1 !m-0 hover:drop-shadow-white-glow">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/whatsapp.png" alt="whatsapp"
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

    <div class="mt-5 flex md:hidden items-center justify-center w-full bg-[rgba(0,9,18,0.85)] backdrop-blur-[12.5px]">
        <div class="flex flex-col items-center justify-between text-white w-full p-3 space-y-4">
            <div class="flex items-start justify-between w-full space-x-4">
                <a href="<?php echo esc_url( site_url( '/' ) ); ?>" class="flex items-center space-x-4 !no-underline">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="logo"
                        class="!my-0 size-10">
                    <span class="text-white !no-underline text-2xl font-bold">
                        <?php esc_html_e( 'iTrade', 'itrade' ); ?>
                    </span>
                </a>
                <div class="flex items-center justify-center space-x-4">
                    <a href="#" class="px-4 py-1 !m-0 hover:drop-shadow-white-glow">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/whatsapp.png" alt="whatsapp"
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
                    class="whitespace-nowrap !no-underline !m-0 !text-white hover:!text-white/50 transition-colors">
                    <?php esc_html_e( 'itradesupport@gmail.com', 'itrade' ); ?>
                </a>
            </div>
            <div class="flex items-center justify-around w-full space-x-4">
                <a href="#"
                    class="whitespace-nowrap !no-underline !m-0 !text-white hover:bg-white/10 transition-colors">
                    <?php esc_html_e( 'Как это работает', 'itrade' ); ?>
                </a>
                <a href="#"
                    class="whitespace-nowrap !no-underline !m-0 !text-white hover:bg-white/10 transition-colors">
                    <?php esc_html_e( 'Условия', 'itrade' ); ?>
                </a>
                <a href="#"
                    class="whitespace-nowrap !no-underline !m-0 !text-white hover:bg-white/10 transition-colors">
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

</div>