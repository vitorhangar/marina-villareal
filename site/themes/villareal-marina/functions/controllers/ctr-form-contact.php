<?php

class CTR_FormContact {

    // Executar essa função apenas na ativação do tema
    static function activation() {
        global $wpdb;
        self::setup_table();
        $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->contact} (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `data` datetime NOT NULL,
          `nome` varchar(50) NOT NULL,
          `email` varchar(50) NOT NULL,
          `telefone` varchar(18) NOT NULL,
          `assunto` varchar(50) NOT NULL,
          `mensagem` text,
          `aceite_termos` int(1) NOT NULL,
          `lixeira` int(1) DEFAULT '0',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

    private static function setup_table() {
        global $wpdb;
        $wpdb->contact = $wpdb->prefix . 'contact';
        array_push( $wpdb->tables, $wpdb->contact );
    }

    function __construct() {
        add_action( 'init', array( 'CTR_FormContact', 'init' ) );

        add_action( 'after_switch_theme', array( 'CTR_FormContact', 'activation' ) );

        add_action( 'admin_menu',           array( 'CTR_Form_Contact_List_table', 'admin_menu' ) );
        add_filter( 'set-screen-option',    array( 'CTR_Form_Contact_List_table', 'set_option' ), 10, 3 );

        // Validar e Salvar dados do Contact Form 7
        if ( isset($_POST['Contato']) ) {
            add_filter( 'wpcf7_posted_data', array( 'CTR_FormContact', 'get_data' ) );
            add_filter( 'wpcf7_skip_mail', array( 'CTR_FormContact', 'save_data' ), 10, 2 );
            add_action( 'wpcf7_before_send_mail', array( 'CTR_FormContact', 'checkIfFakeMailIsFilled' ) );
        }

        if(isset($_GET['contatos'])){
            self::export_dados();
        }
    }

    static function checkIfFakeMailIsFilled($form) {
        if(isset($_POST["mail"]) && $_POST["mail"] )
            exit;

        if(isset($_POST["email"]) && $_POST["email"] )
            exit;

        return true;
    }

    static function export_dados(){

        // Nao permitir visualizacao fora do Painel de Administracao
        // $usuario_logado = wp_get_current_user();
        // $is_admin = $usuario_logado->caps['administrator'];

        // if ( !$is_admin ) {
        //     echo 'Apenas administradores podem visualizar o conteúdo da página.';
        //     exit;
        // }

        global $wpdb;

        $query = "SELECT * FROM ".$wpdb->prefix."contact WHERE lixeira=0";

        $query .= ' ORDER BY data DESC';

        $regs = $wpdb->get_results($query);

        header('Content-Description: File Transfer');
        header('Content-Type: text/csv; charset=ISO-8859-1');
        header('Content-Transfer-Encoding: binary');
        header('Content-Disposition: attachment; filename = "contatos.csv"'); 
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');

        echo "ID;Data;Nome;E-mail;Telefone;Assunto;Mensagem\n";

        foreach ($regs as $reg) {

            $data = explode(" ", $reg->data);
            $day = date("d-m-Y", strtotime($data[0]));
            $hour = $data[1];
            echo utf8_decode($reg->id.";".$day." ".$hour.";".json_decode($reg->nome).";".$reg->email.";".$reg->telefone.";".json_decode($reg->assunto).";".json_decode($reg->mensagem)."\n");
        }
        exit;
    }

    static function init() {
        self::setup_table();
    }

    // Obter dados do Contact Form 7
    static function get_data($data) {

        global $contato_data;

        // Para que a data seja cadastrada corretamente
        date_default_timezone_set('America/Sao_Paulo');
        $contato_data['data'] = date('Y-m-d H:i:s');

        $contato_data['nome'] = isset($data['nome-contato']) ? json_encode($data['nome-contato']) : '';
        $contato_data['email'] = isset($data['abtyswd3-contato']) ? $data['abtyswd3-contato'] : '';
        $contato_data['telefone'] = isset($data['telefone-contato']) ? $data['telefone-contato'] : '';
        $contato_data['assunto'] = isset($data['assunto-contato']) ? json_encode($data['assunto-contato']) : '';
        $contato_data['mensagem'] = isset($data['mensagem-contato']) ? json_encode($data['mensagem-contato']) : '';
        $contato_data['aceite_termos'] = isset($data['lgpd-checkbox'][0]) ? $data['lgpd-checkbox'][0] : 0;

        $contato_data['lixeira'] = 0;

        return $data;
    }

    // Salvar dados no BD se tiverem sido corretamente validados
    static function save_data($skip_mail, $contact_form) {

        global $wpdb;
        global $contato_data;
      
        $res = $wpdb->insert($wpdb->contact, $contato_data);

        if(is_wp_error($res)){
            var_export('Erro ao inserir seu contato.'); exit;
        }
        return $skip_mail;
    }
}

new CTR_FormContact();

// $obj = new CTR_FormContact();
// $obj->activation();