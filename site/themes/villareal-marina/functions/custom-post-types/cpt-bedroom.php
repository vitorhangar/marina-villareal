<?php

if( !defined( 'WPINC' ) )
  die();

class CPT_Bedroom{

	// -----------------------------------------------------------------------------

	public function __construct() {
		$this->create_post_type();
	}

	// -----------------------------------------------------------------------------

	function create_post_type() {

		$bedroom = new Odin_Post_Type(
			'Evento',
			'bedroom'
		);

		$bedroom->set_arguments(
			array(
				'supports'            => array( 'title' ),
				'hierarchical'        => false,
				'public'              => true,
				'publicly_queryable'  => true,
				'menu_icon'           => 'dashicons-admin-multisite',
				'with_front' => false,
        		'exclude_from_search' => true
			)
		);

		$bedroom->set_labels(
			array(
				'menu_name'          => 'Eventos',
				'singular_name'      => 'Evento',
				'add_new'            => 'Adicionar novo evento',
				'add_new_item'       => 'Adicionar novo evento',
				'edit_item'          => 'Editar Evento',
				'new_item'           => 'Novo Evento',
				'all_items'          => 'Todos os Eventos',
				'view_item'          => 'Ver Evento',
				'search_items'       => 'Procurar Evento',
				'not_found'          => 'Nenhum Evento encontrado',
				'not_found_in_trash' => 'Nenhum Evento encontrado na lixeira',
				'parent_item_colon'  => '',
			)
		);

	}

	// -----------------------------------------------------------------------------
}

new CPT_Bedroom;
