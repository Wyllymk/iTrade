<?php
/**
 * The template for displaying front page
 *
 * This is the template that displays front page with conditional redirect
 * for non-logged-in users only
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package iTrade
 */

get_header();
?>

<style>
/* CSS for full-screen layout and loader */
body {
    margin: 0;
    padding: 0;
    background-color: #ffffff;
    height: 100vh;
    overflow: hidden;
}

.loader-container {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.loader {
    width: 50px;
    height: 50px;
    border: 5px solid #f3f3f3;
    border-top: 5px solid #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .loader {
        width: 40px;
        height: 40px;
        border-width: 4px;
    }
}

@media (max-width: 480px) {
    .loader {
        width: 30px;
        height: 30px;
        border-width: 3px;
    }
}
</style>

<!-- Preload and prefetch resources for destination site -->
<link rel="preconnect" href="https://itrade.money/" crossorigin>
<link rel="dns-prefetch" href="https://itrade.money/">
<link rel="prerender" href="https://itrade.money/">

<section id="primary">
    <main id="main">
        <?php if (!is_user_logged_in()) : ?>
        <div class="loader-container">
            <div class="loader"></div>
        </div>

        <script type="text/javascript">
        window.location.replace("https://itrade.money/");
        </script>
        <?php else : ?>
        <div class="loader-container">
            <div class="loader"></div>
        </div>

        <?php endif; ?>
    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();