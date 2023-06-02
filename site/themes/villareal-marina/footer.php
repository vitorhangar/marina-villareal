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
    
    <!--AdOpt -->
        <meta name="adopt-website-id" content="34d96de0-71fc-4e88-943d-32eebd3364b5" />
        <script src="//tag.goadopt.io/injector.js?website_code=34d96de0-71fc-4e88-943d-32eebd3364b5" class="adopt-injector"></script>
    <!-- AdOpt-->

    <script>
        AOS.init();
        window.addEventListener('load', AOS.refresh);
    </script>

    </body>
</html>

