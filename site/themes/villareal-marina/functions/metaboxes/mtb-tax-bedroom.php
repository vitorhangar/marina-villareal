<?php 

function bedroom_taxonomia(){

    $bedroom = new Odin_Term_Meta(
        'bedroom', // Slug/ID do Term Meta (obrigatório)
        'bedroom' // Slug da Taxonomia, sendo possível enviar apenas um valor ou um array com vários (opcional)
    );
    
    $bedroom->set_fields(
        array(
            array(
                'id'          => 'atribute_image', // Obrigatório
                'label'       => __( 'Imagem do atributo', 'odin' ), // Obrigatório
                'type'        => 'image', // Obrigatório
            ),
        )
    );

}

add_action( 'init', 'bedroom_taxonomia', 1 );

