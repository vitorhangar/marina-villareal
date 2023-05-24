<?php
require_once get_template_directory() . '/core/classes/class-taxonomy.php';

function odin_bedroom_taxonomy() {
    $bedroom = new Odin_Taxonomy(
        'Atributo', // Nome (Singular) da nova Taxonomia.
        'bedroom', // Slug do Taxonomia.
        array('bedroom') // Nome do tipo de conteúdo que a taxonomia irá fazer parte.
    );

    $bedroom->set_labels(
        array(
            'menu_name' => __( 'Atributos +', 'odin' )
        )
    );

    $bedroom->set_arguments(
        array(
            'hierarchical' => false
        )
    );
}

add_action( 'init', 'odin_bedroom_taxonomy', 1 );