<?php

if( !class_exists( 'WP_List_Table' ) )
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

class CTR_Form_Contact_List_table extends WP_List_Table {

    var $_lixeira = 0;
    var $data;

    function __construct() {
        $this->data = new Data();
        
        parent::__construct(
            array(
                'singular'  => 'Contatos',
                'plural'    => 'Contatos'
            )
        );

        $this->_lixeira = isset($_GET['lixeira']) ? $_GET['lixeira'] : 0;

        if ( isset($_GET['view']) ) {
            $this->view($_GET['view']);
        }
    }

    function no_items() {
        echo 'Nenhum registro encontrado.';
    }

    // Colunas

    function get_columns() {
        $cols = array(
            'cb'       => '<input type="checkbox" />',
            'data'     => 'Data',
            'nome'     => 'Nome',
            'email'    => 'Email',
            'telefone' => 'Telefone',
            'assunto' => 'Assunto',
        );
        return $cols;
    }

    // Ordenação

    function get_sortable_columns() {
        $cols = array(
            'data'     => array( 'data', false ),
            'nome'     => array( 'nome', true ),
            'email'    => array( 'email', true ),
            'telefone' => array( 'telefone', true ),
            'assunto'  => array( 'assunto', true ),
        );
        return $cols;
    }

    // Conteúdo

    function column_default( $item, $col_name ) {
        return $item[ $col_name ];
    }

    function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="contato_id[]" value="%s" />',
            $item[ 'id' ]
        );
    }

    function column_nome( $item ) {

        if ($this->_lixeira == 1) {
            $actions = array(
                'view' => sprintf(
                    '<a onclick="open_details(%s)" href="#">Ver</a>',
                    $item[ 'id' ]
                ),
                'untrash' => sprintf(
                    '<a href="?page=%s&action=%s&lixeira=1&contato_id=%d">Restaurar</a>',
                    'ctr_form-contact.php',
                    'untrash',
                    $item[ 'id' ]
                ),
                'delete' => sprintf(
                    '<a href="?page=%s&action=%s&lixeira=1&contato_id=%d">Excluir permanentemente</a>',
                    'ctr_form-contact.php',
                    'delete',
                    $item[ 'id' ]
                )
            );

        } else {

            $actions = array(
                'view' => sprintf(
                    '<a onclick="open_details(%s)" href="#">Ver</a>',
                    $item[ 'id' ]
                ),
                'trash' => sprintf(
                    '<a href="?page=%s&action=%s&contato_id=%d">Lixeira</a>',
                    'ctr_form-contact.php',
                    'trash',
                    $item[ 'id' ]
                )
            );
        }

        if(json_decode($item['nome'])){
            return json_decode($item['nome']).$this->row_actions( $actions );
        }else{
            return sprintf( '%1$s %2$s', $item['nome'], $this->row_actions( $actions ) );
        }
    }

    function column_assunto( $item ) {
        
        if(json_decode($item['assunto'])){
            return json_decode($item['assunto']);
        }else{
            return $item['nome'];
        }
    }

    function column_data( $item ) {
        return $this->data->bd2datahora($item['data']);
    }

    // Ações em massa

    function get_bulk_actions() {

        if ($this->_lixeira == 1) {
            return array(
                'untrash' => 'Restaurar',
                'delete' => 'Excluir permanentemente'
            );

        } else {
            return array(
                'trash' => 'Mover para a Lixeira'
            );
        }
    }

    function process_bulk_action() {

        $action = $this->current_action();
        $nregs = 0;

        $ids = false;
        if ( isset( $_POST[ 'contato_id' ] ) )
            $ids = implode( ',', $_POST[ 'contato_id' ] );
        else if ( isset( $_GET[ 'contato_id' ] ) )
            $ids = $_GET[ 'contato_id' ];

        if ($ids) {
            global $wpdb;

            switch ( $action )
            {
                case 'trash':
                    $nregs = $wpdb->query( "UPDATE {$wpdb->contact} SET lixeira=1 WHERE id IN ({$ids})" );
                    break;

                case 'untrash':
                    $nregs = $wpdb->query( "UPDATE {$wpdb->contact} SET lixeira=0 WHERE id IN ({$ids})" );
                    break;

                case 'delete':
                    $nregs = $wpdb->query( "DELETE FROM {$wpdb->contact} WHERE id IN ({$ids})" );
                    break;
            }
        }

        return $nregs;
    }

    // Consulta SQL

    function prepare_items() {
        global $wpdb;
        $columns  = $this->get_columns();
        $hidden   = get_hidden_columns( get_current_screen() );
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array( $columns, $hidden, $sortable );

        $nregs = $this->process_bulk_action();

        // conteúdo do banco de dados
        $where = 'lixeira!=1';
        if ($this->_lixeira == 1) {
            $where = 'lixeira=1';
        }

        $query = "SELECT * FROM {$wpdb->contact} WHERE ".$where;

        if ( isset( $_GET[ 's' ] ) ) {
            $q = sanitize_text_field( $_GET[ 's' ] );
            $query .= ' AND (nome LIKE "%'.$q.'%" OR email LIKE "%'.$q.'%" OR telefone LIKE "%'.$q.'%" OR assunto LIKE "%'.$q.'%")';
        }

        $orderby = !empty( $_GET[ 'orderby' ] ) ? esc_attr( $_GET[ 'orderby' ] ) : 'data';
        $order = !empty( $_GET[ 'order' ] ) ? sanitize_sql_orderby( $_GET[ 'order' ] ) : 'DESC';

        $query.= " ORDER BY {$orderby} {$order}";
        //echo $query;

        $items_total = $wpdb->query( $query );
        $items_per_page = $this->get_items_per_page( 'contatos_per_page' );

        $paged = !empty( $_GET[ 'paged' ] ) ? (int) $_GET[ 'paged' ] : 1;
        if( !$paged )
            $paged = 1;

        $pages = ceil( $items_total/$items_per_page );
        $offset = ( $paged-1 ) * $items_per_page;
        $query .= sprintf(
            ' LIMIT %d, %d',
            (int) $offset,
            (int) $items_per_page
        );

        $this->set_pagination_args(
            array(
                'total_pages'   => $pages,
                'total_items'   => $items_total,
                'per_page'      => $items_per_page,
            )
        );

        $this->items = $wpdb->get_results( $query, ARRAY_A );

        return $nregs;
    }

    // Adicionamos aqui o search_box para personaliza-lo com o botao Limpar
    function search_box( $text, $input_id ) {
        if ( empty( $_REQUEST['s'] ) && !$this->has_items() )
            return;

        $input_id = $input_id . '-search-input';

        if ( ! empty( $_REQUEST['orderby'] ) )
            echo '<input type="hidden" name="orderby" value="' . esc_attr( $_REQUEST['orderby'] ) . '" />';
        if ( ! empty( $_REQUEST['order'] ) )
            echo '<input type="hidden" name="order" value="' . esc_attr( $_REQUEST['order'] ) . '" />';
        if ( ! empty( $_REQUEST['post_mime_type'] ) )
            echo '<input type="hidden" name="post_mime_type" value="' . esc_attr( $_REQUEST['post_mime_type'] ) . '" />';
        if ( ! empty( $_REQUEST['detached'] ) )
            echo '<input type="hidden" name="detached" value="' . esc_attr( $_REQUEST['detached'] ) . '" />';

        $segmentos = '';
        if ($this->_lixeira == 1) {
            $segmentos = '&lixeira=1';
        }

        ?>
        <p class="search-box">
            <label class="screen-reader-text" for="<?php echo $input_id ?>"><?php echo $text; ?>:</label>
            <input type="search" id="<?php echo $input_id ?>" name="s" value="<?php _admin_search_query(); ?>" />
            <?php submit_button( $text, 'button', '', false, array('id' => 'search-submit') ); ?>
            <a class="button" href="?page=ctr_form-contact.php<?php echo $segmentos ?>">Limpar</a></p>
        </p>
        <?php
    }

    // Exibição dos resultados

    static function render() {

        $search = isset($_POST['s']) ? $_POST['s'] : '';
        if ($search != '') {
            $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $url = add_query_arg('s', $search, $url);
            $url = add_query_arg('paged', 1, $url);
            //echo $url; exit;
            ?>
            <script type="text/javascript">
                window.location.href = '<?php echo $url ?>';
            </script>
            <?php
            exit;
        }

        global $contatos;
        global $wpdb;
        $action = $contatos->current_action();
        $nregs = $contatos->prepare_items();
        //echo var_export($nregs);

        add_thickbox();
        ?>
        <script type="text/javascript">
        var $j = jQuery;

        $j(window).on('resize', function(){
            update_modal();
        });

        function update_modal() {
            var tamanho_largura_tela = $j(window).width();
            var tamanho_altura_tela = $j(window).height();
            var metade_largura_tela = -Math.abs( tamanho_largura_tela/2 );
            var metade_altura_tela = -Math.abs( tamanho_altura_tela/2 );

            var tamanho_largura_modal = 950;
            var tamanho_altura_modal = 450;
            var metade_largura_modal = -Math.abs( tamanho_largura_modal/2 );
            var metade_altura_modal = -Math.abs( tamanho_altura_modal/2 );

            /*console.log('Tela: '+tamanho_largura_tela+'x - '+tamanho_altura_tela+'x');
            console.log('Modal: '+tamanho_largura_modal+'x - '+tamanho_altura_modal+'x');*/

            // Adaptar tela para mobile
            if (tamanho_largura_modal > tamanho_largura_tela) {
                $j('#TB_window').css('width', tamanho_largura_tela);
                $j('#TB_ajaxContent').css('width', (tamanho_largura_tela - 30) );
                $j('#TB_window').css('margin-left', metade_largura_tela);

            } else {
                $j('#TB_window').css('width', tamanho_largura_modal);
                $j('#TB_ajaxContent').css('width', (tamanho_largura_modal - 30) );
                $j('#TB_window').css('margin-left', metade_largura_modal);
            }

            if (tamanho_altura_modal > tamanho_altura_tela) {
                $j('#TB_window').css('height', tamanho_altura_tela);
                $j('#TB_ajaxContent').css('height', (tamanho_altura_tela - 50) );
                $j('#TB_window').css('margin-top', metade_altura_tela);

            } else {
                $j('#TB_window').css('height', tamanho_altura_modal);
                $j('#TB_ajaxContent').css('height', (tamanho_altura_modal - 50) );
                $j('#TB_window').css('margin-top', metade_altura_modal);
            }
        }

        function open_details(id) {
            tb_show('Ver dados', 'admin.php?page=ctr_form-contact.php&view='+id);
        }
        </script>
        <?php

        echo '<div class="wrap">'.
            '<h2>Contatos</h2>'.
            '<a href="'.get_site_url().'/wp-admin/admin.php?page=ctr_form-contact.php&contatos=1" class="page-title-action">Exportar CSV</a>'.
            '<hr class="wp-header-end">';
            
        $class_tudo = $class_lixeira = '';
        $lixeira = isset($_GET['lixeira']) ? $_GET['lixeira'] : 0;
        if ($lixeira == 1) {
            $class_lixeira = 'current';
        } else {
            $class_tudo = 'current';
        }

        echo '<ul class="subsubsub">';
        $reg = $wpdb->get_row("SELECT COUNT(*) as nregs FROM {$wpdb->contact} WHERE lixeira!=1");
        echo '<li class="all"><a href="?page=ctr_form-contact.php" class="'.$class_tudo.'">Tudo <span class="count">('.$reg->nregs.')</span></a> |</li>';

        $reg = $wpdb->get_row("SELECT COUNT(*) as nregs FROM {$wpdb->contact} WHERE lixeira=1");
        echo '<li class="trash"><a href="?page=ctr_form-contact.php&amp;lixeira=1" class="'.$class_lixeira.'">Lixeira <span class="count">('.$reg->nregs.')</span></a></li>';
        echo '</ul>';

        if ($action == 'trash') {
            if ($nregs == 1) {
                echo '<div class="updated"><p>1 registro foi movido para a Lixeira!</p></div>';
            } else if ($nregs > 1) {
                echo '<div class="updated"><p>'.$nregs.' registros foram movidos para a Lixeira!</p></div>';
            }
        }

        if ($action == 'untrash') {
            if ($nregs == 1) {
                echo '<div class="updated"><p>1 registro foi restaurado da Lixeira!</p></div>';
            } else if ($nregs > 1) {
                echo '<div class="updated"><p>'.$nregs.' registros foram restaurados da Lixeira!</p></div>';
            }
        }

        if ($action == 'delete') {
            if ($nregs == 1) {
                echo '<div class="updated"><p>1 registro foi excluído permanentemente!</p></div>';
            } else if ($nregs > 1) {
                echo '<div class="updated"><p>'.$nregs.' registros foram excluídos permanentemente!</p></div>';
            }
        }

        echo '<form method="post">';
        $contatos->search_box( 'Pesquisar', 'custom-search' );
        $contatos->display();
        echo '</form></div>';
    }

    // Página administrativa

    static function admin_menu() {
        $hook = add_menu_page( 'Contatos', 'Contatos', 'read_private_posts', 'ctr_form-contact.php', array( 'CTR_Form_Contact_List_table', 'render' ), 'dashicons-megaphone', 3 );
        add_action( "load-$hook", array( 'CTR_Form_Contact_List_table', 'add_options' ) );
    }

    static function add_options() {
        global $contatos;
        $contatos = new CTR_Form_Contact_List_table();

        $option = 'per_page';
        $args = array(
            'label'     => 'Contatos',
            'option'    => 'contatos_per_page',
            'default'   => 10
        );
        add_screen_option( $option, $args );
    }

    function set_option( $status, $option, $value ) {
        if ( $option == 'contatos_per_page' )
            $status = $value;

        return $status;
    }

    function view($id) {
        global $wpdb;

        $reg = $wpdb->get_row( $wpdb->prepare(
            "SELECT * FROM {$wpdb->contact} WHERE id=%s",
            $id
        ) );

        if ( empty($reg) ) {
            echo '<p>O registro não foi encontrado!</p>';

        } else {
            ?>
            <table>
                <tr>
                    <td><strong>Data</strong>:</td>
                    <td><?php echo $this->data->bd2datahora($reg->data) ?></td>
                </tr>
                <?php if(json_decode($reg->nome)): ?>
                    <tr>
                        <td><strong>Nome</strong>:</td>
                        <td><?php echo json_decode($reg->nome); ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td><strong>Nome</strong>:</td>
                        <td><?php echo $reg->nome; ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td><strong>E-mail</strong>:</td>
                    <td><?php echo $reg->email ?></td>
                </tr>
                <tr>
                    <td><strong>Telefone</strong>:</td>
                    <td><?php echo $reg->telefone ?></td>
                </tr>
                <?php if(json_decode($reg->assunto)): ?>
                    <tr>
                        <td><strong>Assunto</strong>:</td>
                        <td><?php echo json_decode($reg->assunto); ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td><strong>Assunto</strong>:</td>
                        <td><?php echo $reg->assunto; ?></td>
                    </tr>
                <?php endif;?>
                <?php if(json_decode($reg->mensagem)): ?>
                    <tr>
                        <td><strong>Mensagem</strong>:</td>
                        <td><?php echo json_decode($reg->mensagem); ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td><strong>Mensagem</strong>:</td>
                        <td><?php echo $reg->mensagem; ?></td>
                    </tr>
                <?php endif; ?>
                <!-- <tr>
                    <td><strong>Aceite Newsletter</strong>:</td>
                    <td><?php //echo ($reg->aceite_newsletter == 1) ? 'Sim' : 'Não' ?></td>
                </tr> -->
                <tr>
                    <td><strong>Aceite de Termos</strong>:</td>
                    <td><?php echo ($reg->aceite_termos == 1) ? 'Sim' : 'Não' ?></td>
                </tr>
            </table>
            <script type="text/javascript">
                // Atualizar tamanho da modal
                window.setTimeout("update_modal()", 100);
            </script>
            <?php
        }
        exit;
    }
}
