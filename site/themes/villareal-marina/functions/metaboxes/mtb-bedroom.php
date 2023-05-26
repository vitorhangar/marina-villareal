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
            )
        );
    }
}

new MTB_Bedroom();