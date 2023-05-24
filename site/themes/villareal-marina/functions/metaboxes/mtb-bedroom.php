<?php


class MTB_Bedroom {

    // -----------------------------------------------------------------------------

    public function __construct() {
        $this->createMetaboxContent();
    }

    // -----------------------------------------------------------------------------

    public function createMetaboxContent(){
        $bedroom = new Odin_Metabox(
            'quartos',
            'Informações do Quarto',
            'bedroom',
            'normal',
            'high'
        );

        $bedroom->set_fields(
            array(
                
                array(
                    'id'          => 'bedroom_images', // Obrigatório
                    'label'       => __( 'Galeria de fotos:', 'odin' ), // Obrigatório
                    'type'        => 'image_plupload', // Obrigatório
                    'default'     => '', // Opcional (deve ser o id de uma imagem em mídias, separe os ids com virtula)
                    'description' => __( 'O tamanho de imagem ideal é 560x330', 'odin' ), // Opcional
                ),
                array(
                    'id'   => 'separator1', // Obrigatório
                    'type' => 'separator' // Obrigatório
                ),
                array(
                    'id'          => 'couple_bed', // Obrigatório
                    'label'       => __( 'Quantidade cama de casal:', 'odin' ), // Obrigatório
                    'type'        => 'text',
                    'attributes'  => array( // Optional (html input elements)
                        'type' => 'number',
                        'max'  => 10,
                        'min'  => 0
                    )
                ),
                array(
                    'id'          => 'single_bed', // Obrigatório
                    'label'       => __( 'Quantidade cama de solteiro:', 'odin' ), // Obrigatório
                    'type'        => 'text',
                    'attributes'  => array( // Optional (html input elements)
                        'type' => 'number',
                        'max'  => 10,
                        'min'  => 0
                    )
                )
            )
        );
    }
}

new MTB_Bedroom();