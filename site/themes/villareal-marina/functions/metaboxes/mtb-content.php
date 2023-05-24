<?php


class MTB_Content {

    // -----------------------------------------------------------------------------

    public function __construct() {
        $this->createMetaboxContent();
    }

    // -----------------------------------------------------------------------------

    public function createMetaboxContent(){
        $content_home_info = new Odin_Metabox(
            'informacoes_do_site',
            'INFORMAÇÕES DO SITE',
            'content',
            'normal',
            'high'
        );

        $content_home_info->set_fields(
            array(
                array(
                    'description' => '<b style="font-size: 20px">INFORMAÇÕES DO SITE</b>',
                ),

                    array(
                        'id'          => 'endereco',
                        'label'       => __( 'Endereço:', 'odin' ),
                        'type'        => 'text',
                    ),

                    array(
                        'id'          => 'endereco_link',
                        'label'       => __( 'Link do endereço (Google Maps):', 'odin' ),
                        'type'        => 'text',
                    ),

                    array(
                        'id'          => 'endereco_link_embed',
                        'label'       => __( 'Link do endereço (Embed ex.: ...google.com/maps/embed?pb=...):', 'odin' ),
                        'type'        => 'textarea',
                    ),
                    
                    array(
                        'id'          => 'telefone',
                        'label'       => __( 'Telefone:', 'odin' ),
                        'type'        => 'text',
                        'placeholder' => 'Ex.: +55 (47) 3086-1800'
                    ),

                    array(
                        'id'          => 'email',
                        'label'       => __( 'E-mail:', 'odin' ),
                        'type'        => 'text',
                    ),

                    array(
                        'id'          => 'facebook',
                        'label'       => __( 'Facebook:', 'odin' ),
                        'type'        => 'text',
                    ),

                    array(
                        'id'          => 'instagram',
                        'label'       => __( 'Instagram:', 'odin' ),
                        'type'        => 'text',
                    ),
            )
        );

        // -----------------------------------------------------------------------------

        $content_home = new Odin_Metabox(
            'home',
            'HOME',
            'content',
            'normal',
            'high'
        );

        $content_home->set_fields(
            array(

                array(
                    'id'          => 'about_title',
                    'label'       => __( 'SOBRE - Título:', 'odin' ),
                    'type'        => 'text',
                ),

                array(
                    'id'          => 'about_text',
                    'label'       => __( 'SOBRE - Texto:', 'odin' ),
                    'type'        => 'editor',
                ),

                array(
                    'id'          => 'about_images', // Obrigatório
                    'label'       => __( 'SOBRE - Galeria de fotos:', 'odin' ), // Obrigatório
                    'type'        => 'image_plupload', // Obrigatório
                    'default'     => '', // Opcional (deve ser o id de uma imagem em mídias, separe os ids com virtula)
                    'description' => __( 'O tamanho de imagem ideal é 560x330', 'odin' ), // Opcional
                ),

                array(
                    'id'   => 'separator1',
                    'type' => 'separator'
                ),

                array(
                    'id'          => 'beach_title',
                    'label'       => __( 'A Praia - Título:', 'odin' ),
                    'type'        => 'text',
                ),

                array(
                    'id'          => 'beach_text',
                    'label'       => __( 'A Praia - Texto:', 'odin' ),
                    'type'        => 'editor',
                ),

                array(
                    'id'          => 'beach_images', // Obrigatório
                    'label'       => __( 'A Praia - Galeria de fotos:', 'odin' ), // Obrigatório
                    'type'        => 'image_plupload', // Obrigatório
                    'default'     => '', // Opcional (deve ser o id de uma imagem em mídias, separe os ids com virtula)
                    'description' => __( 'O tamanho de imagem ideal é 560x330', 'odin' ), // Opcional
                ),

                array(
                    'id'   => 'separator1',
                    'type' => 'separator'
                ),

                array(
                    'id'          => 'details_1_title',
                    'label'       => __( 'DETALHES 1º - Título:', 'odin' ),
                    'type'        => 'text',
                ),

                array(
                    'id'          => 'details_1_text',
                    'label'       => __( 'DETALHES 1º - Texto:', 'odin' ),
                    'type'        => 'editor',
                ),

                array(
                    'id'          => 'details_1_image', // Obrigatório
                    'label'       => __( 'DETALHES 1º - Imagem:', 'odin' ), // Obrigatório
                    'type'        => 'image', // Obrigatório
                    'description' => __( 'O tamanho de imagem ideal é 560x330', 'odin' ), // Opcional
                ),

                array(
                    'id'   => 'separator1',
                    'type' => 'separator'
                ),

                array(
                    'id'          => 'details_2_title',
                    'label'       => __( 'DETALHES 2º - Título:', 'odin' ),
                    'type'        => 'text',
                ),

                array(
                    'id'          => 'details_2_text',
                    'label'       => __( 'DETALHES 2º - Texto:', 'odin' ),
                    'type'        => 'editor',
                ),

                array(
                    'id'          => 'details_2_image', // Obrigatório
                    'label'       => __( 'DETALHES 2º - Imagem:', 'odin' ), // Obrigatório
                    'type'        => 'image', // Obrigatório
                    'description' => __( 'O tamanho de imagem ideal é 560x330', 'odin' ), // Opcional
                ),

            )
        );

        // -----------------------------------------------------------------------------

        $contato = new Odin_Metabox(
            'contato',
            'CONTATO',
            'content',
            'normal',
            'high'
        );

        $contato->set_fields(
            array(
                array(
                    'id'          => 'page_contato_title',
                    'label'       => __( 'Título:', 'odin' ),
                    'type'        => 'text',
                ),

                array(
                    'id'          => 'page_contato_text',
                    'label'       => __( 'Texto:', 'odin' ),
                    'type'        => 'textarea',
                ),
            )
        );
    }
}

new MTB_Content();