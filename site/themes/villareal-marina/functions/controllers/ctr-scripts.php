<?php

class Controller_Scripts {

    private $scriptsVersion   = null;

    public function __construct() {

        // Adicionar CSS e JS corretamente no site
        add_action( 'wp_enqueue_scripts', array( $this, 'add_css_js' ) );


        // Remover CSS e JS não utlizados
        add_filter( 'woocommerce_enqueue_styles', '__return_false' );
        add_action( 'init', array( $this, 'remove_css_js' ), 99 );

        //
        add_filter( 'clean_url', array( $this, 'handleScripts' ), 11, 1 );


        // -----------------------------------------------------------------------------

          /**
         * Add scripts to admin
         */
        add_action( 'admin_enqueue_scripts', array( $this, 'addScriptsToAdmin' ) );


        /**
         * Se utilizar o Google Maps, descomente as linhas abaixo e passe a KEY de produção.
         * Gerar aqui: https://console.developers.google.com/project/914839424257/apiui/credential
         */
        // define( 'GOOGLE_MAPS_KEY', '' );
        // $this->use_google_maps();
    }

    // -----------------------------------------------------------------------------

    public function add_css_js() {
        wp_register_script('jquery', theme_url('public/js/jquery.min.js'), null, null, true);
    }

    // -----------------------------------------------------------------------------

    public function addScriptsToAdmin() {


        $screen = get_current_screen();

        if( isset( $screen->taxonomy )  ) {
            wp_enqueue_script( 'tax_metabox_js',
            get_template_directory_uri().'/functions/vendor/tax-meta-class/js/tax-meta-clss.js',
            array( 'jquery' ) );
        }
    }

    // -----------------------------------------------------------------------------

    public function handleScripts( $url ) {

        if( $url != theme_url( 'public/js/vendor/require.js' ) )
            return $url;

        return sprintf(
            "%s' data-js='%s' data-main='%s' data-base-url='%s' data-template-url='%s",
            $url,
            'script-default',
            theme_url( 'public/js/boot' ),
            home_url(),
            theme_url()
        );
    }

    // -----------------------------------------------------------------------------

    public function use_google_maps() {
        add_action( 'wp_enqueue_scripts', array( $this, 'google_maps_script' ) );
    }

    // -----------------------------------------------------------------------------


    public function google_maps_script() {
        // Key local. Não é necessário alterar.
        $google_maps_key = 'AIzaSyCTtN8m0rSlbAxQwZdv_hLW8KLHXE4GClo';

        if( 'http://site.com.br' == home_url() ) {
            $google_maps_key = GOOGLE_MAPS_KEY;
        }

        wp_register_script( 'google-maps', 'http://maps.googleapis.com/maps/api/js?key=' . $google_maps_key . '&amp;sensor=false', array(), $this->scripts_version, $this->scripts_in_footer );

        wp_deregister_script( 'requirejs' );
        wp_dequeue_script( 'requirejs' );
        wp_register_script( 'requirejs', theme_url( 'public/js/vendor/require.js' ), array( 'google-maps' ), $this->scripts_version, $this->scripts_in_footer );

        wp_enqueue_script( 'google-maps' );
        wp_enqueue_script( 'requirejs' );
    }

    // -----------------------------------------------------------------------------

    public function remove_css_js() {
        /* WOOCOMMERCE */
        /*
        remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

        wp_dequeue_style( 'woocommerce_frontend_styles' );
        wp_dequeue_style( 'woocommerce_fancybox_styles' );
        wp_dequeue_style( 'woocommerce_chosen_styles' );
        wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
        wp_dequeue_script( 'wc_price_slider' );
        wp_dequeue_script( 'wc-single-product' );
        wp_dequeue_script( 'wc-add-to-cart' );
        wp_dequeue_script( 'wc-cart-fragments' );
        wp_dequeue_script( 'wc-checkout' );
        wp_dequeue_script( 'wc-add-to-cart-variation' );
        wp_dequeue_script( 'wc-single-product' );
        wp_dequeue_script( 'wc-cart' );
        wp_dequeue_script( 'wc-chosen' );
        wp_dequeue_script( 'woocommerce' );
        wp_dequeue_script( 'prettyPhoto' );
        wp_dequeue_script( 'prettyPhoto-init' );
        wp_dequeue_script( 'jquery-blockui' );
        wp_dequeue_script( 'jquery-placeholder' );
        wp_dequeue_script( 'jqueryui' );
        wp_dequeue_script( 'fancybox' );
        */

        $isInLoginPage = in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php') );

        if ( !is_admin() && !$isInLoginPage )  {
            wp_deregister_script( 'jquery' );
            wp_dequeue_script( 'jquery' );
        }
    }

    public function add_tag_manager_codes() {
        return array(

        );
    }

    public function add_tag_manager_in_head() {
        foreach ( $this->add_tag_manager_codes() as $code ) {
            ?>
            <!-- Google Tag Manager -->
            <!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','<?php //echo $code ?>');</script> -->
            <!-- End Google Tag Manager (noscript) -->
            <?php
        }
    }

    public function add_tag_manager_in_body() {
        foreach ( $this->add_tag_manager_codes() as $code ) {
            ?>
            <!-- Google Tag Manager (noscript) -->
            <!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $code ?>"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
            <!-- End Google Tag Manager (noscript) -->
            <?php
        }
    }
}

new Controller_Scripts;