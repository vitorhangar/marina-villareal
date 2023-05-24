<?php
class Controller_Common {

    /**
     * Construtor
     */
    public function __construct() {

        /**
         * Remover metatags não utilizadas
         */
        $this->remove_metatags();
        $this->remove_emoji();


        /**
         * Classes para body
         */
        add_filter( 'body_class', array( &$this, 'body_classes' ) );


        /**
         * Depois de ativar o tema
         */
        add_action( 'after_setup_theme', array( &$this, 'setup_features' ) );

        /*
        * Buscar página que utiliza determinado template
        */
        add_filter( 'get_page_by_template' , array( $this , 'get_page_by_template' ) , 10 , 1 );


         //Generate Numeric Pagination Base on Query
        add_filter( 'generateNumericPaginationFromQuery', array( &$this, 'generateNumericPaginationFromQuery' ), 10, 2 );


        add_filter( 'jpeg_quality', array( &$this, 'setJPEGQuality' ) );


    } // __construct





    /**
     * Remover metatags não utilizadas
     */
    public function remove_metatags() {

        remove_action( 'wp_head', 'wp_generator' );
        remove_action( 'wp_head', 'rsd_link' );
        remove_action( 'wp_head', 'wlwmanifest_link' );

    } // remove_metatags





    public function body_classes( $classes ) {
        if( is_home() || is_front_page() ) {
            $classes[] = 'page-home';
        }

        return $classes;
    }





    public function setup_features() {

        /**
         * Suporte de linguagem para Odin
         */
        load_theme_textdomain( 'odin', get_template_directory() . '/languages' );

        /**
         * Registrar Menus
         */
        // register_nav_menus(array(
        //     // 'main-menu' => 'Main Menu'
        // ));

        /*
         * Adicionar suporte à Imagem Destacada
         */
        add_theme_support( 'post-thumbnails' );

        /**
         * Adicionar Feeds automaticamente
         */
        add_theme_support( 'automatic-feed-links' );

        /**
         * Support de CSS pesonalizado para o editor
         */
        add_editor_style( get_template_directory_uri() . '/admin/public/css/editor-style.css' );

    } // setup_features


    // -----------------------------------------------------------------------------

    public function get_page_by_template( $template_name ){
        $pages = get_pages(
            array(
                'meta_key' => '_wp_page_template',
                'meta_value' => $template_name
            )
        );

        $page = null;

        if( $pages ){
            $page = array_shift( $pages );
        }

        return $page;
    } // get_page_by_template

    // -----------------------------------------------------------------------------


    // -----------------------------------------------------------------------------

    public function generateNumericPaginationFromQuery( $page_count = 6, $query = "" ) {

        global $wp_query;

        $args = array(
            'range'           => 3,
            'custom_query'    => $query,
            'previous_string' => '<span aria-hidden="true">&larr;</span>',
            'next_string'     => '<span aria-hidden="true">&rarr;</span>',
            'before_output'   => '<nav><ul class="pagination">',
            'after_output'    => '</ul></nav>'
        );

        $args['range'] = (int) $args['range'] - 1;
        if ( !$args['custom_query'] )
            $args['custom_query'] = @$GLOBALS['wp_query'];
        $count = (int) $args['custom_query']->max_num_pages;
        $page  = intval( $wp_query->query['paged'] );
        $ceil  = ceil( $args['range'] / 2 );

        if ( $count <= 1 )
            return FALSE;

        if ( !$page )
            $page = 1;

        if ( $count > $args['range'] ) {
            if ( $page <= $args['range'] ) {
                $min = 1;
                $max = $args['range'] + 1;
            } elseif ( $page >= ($count - $ceil) ) {
                $min = $count - $args['range'];
                $max = $count;
            } elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) {
                $min = $page - $ceil;
                $max = $page + $ceil;
            }
        } else {
            $min = 1;
            $max = $count;
        }

        $echo = '';
        $previous = intval($page) - 1;
        $previous = esc_attr( get_pagenum_link($previous) );

        $firstpage = esc_attr( get_pagenum_link(1) );
        // if ( $firstpage && (1 != $page) )
        //     $echo .= '<li class="previous"><a href="' . $firstpage . '">' . __( 'Primeira Página', 'text-domain' ) . '</a></li>';
        if ( $previous && (1 != $page) )
            $echo .= '<li><a href="' . $previous . '" title="' . __( 'previous', 'text-domain') . '">' . $args['previous_string'] . '</a></li>';

        if ( !empty($min) && !empty($max) ) {
            for( $i = $min; $i <= $max; $i++ ) {
                if ($page == $i) {
                    $echo .= '<li class="active"><span class="active">' . $i . '</span></li>';
                } else {
                    $echo .= sprintf( '<li><a href="%s">%d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
                }
            }
        }

        $next = intval($page) + 1;
        $next = esc_attr( get_pagenum_link($next) );
        if ($next && ($count != $page) )
            $echo .= '<li><a href="' . $next . '" title="' . __( 'next', 'text-domain') . '">' . $args['next_string'] . '</a></li>';

        $lastpage = esc_attr( get_pagenum_link($count) );
        // if ( $lastpage ) {
            // $echo .= '<li class="next"><a href="' . $lastpage . '">' . __( 'Última Página', 'text-domain' ) . '</a></li>';

        if ( isset($echo) )
            echo $args['before_output'] . $echo . $args['after_output'];
    }

    // -----------------------------------------------------------------------------

    public function setJPEGQuality( ) {
        return 100;
    }


    // -----------------------------------------------------------------------------

    /** Remover scripts emoji */
    public function remove_emoji() {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');

        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
    }
    // -----------------------------------------------------------------------------

}

new Controller_Common;
