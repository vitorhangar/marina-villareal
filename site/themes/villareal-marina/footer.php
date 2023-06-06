<?php
/**
 * Footer (Rodapé do site)
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

?>

<?php inc('partials/footer/main-footer'); ?>

<?php wp_footer() ?>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,700;1,900&display=swap">

    <link rel="stylesheet" href='<?= theme_url( 'public/css/lightbox.css' ) ?>'>
    <link rel="stylesheet" href='<?= theme_url( 'public/css/aos.css' ) ?>'>
    <link rel="stylesheet" href='<?= theme_url( 'public/css/style.css' ) ?>?v=0.3.10'>

	<script>var BASE_URL = '<?= get_site_url() ?>';</script>
    <script>var THEME_URL = '<?= theme_url() ?>';</script>

    <!-- <script src="<?//= theme_url('public/vendors/lazysizes.min.js'); ?>" async></script> -->
    <script src="<?= theme_url('public/vendors/jquery.min.js') ?>">             </script>
    <script src="<?= theme_url('public/vendors/slick.min.js') ?>">              </script>
    <script src="<?= theme_url('public/vendors/bootstrap-notify.min.js') ?>">   </script>
    <script src="<?= theme_url('public/vendors/aos.js')?>">                     </script>
    <script src="<?= theme_url('public/vendors/lightbox.js') ?>">               </script>
    <script src="<?= theme_url('public/js/main.min.js')?>?v=0.3.7">             </script>
    <script src="<?= theme_url('public/vendors/datedropper.pro.min.js'); ?>">   </script>
    
    <meta name="adopt-website-id" content="fbe22524-6ba2-46d9-bc30-440d5100cc1a" />
    <script src="//tag.goadopt.io/injector.js?website_code=fbe22524-6ba2-46d9-bc30-440d5100cc1a" 
    class="adopt-injector"></script>

    <script>
        AOS.init();
        window.addEventListener('load', AOS.refresh);
    </script>

    </body>
</html>

