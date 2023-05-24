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
			'Quarto',
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
				'menu_name'          => 'Quartos',
				'singular_name'      => 'Quarto',
				'add_new'            => 'Adicionar novo Quarto',
				'add_new_item'       => 'Adicionar novo Quarto',
				'edit_item'          => 'Editar Quarto',
				'new_item'           => 'Novo Quarto',
				'all_items'          => 'Todos os Quartos',
				'view_item'          => 'Ver Quarto',
				'search_items'       => 'Procurar Quarto',
				'not_found'          => 'Nenhum Quarto encontrado',
				'not_found_in_trash' => 'Nenhum Quarto encontrado na lixeira',
				'parent_item_colon'  => '',
			)
		);

	}

	// -----------------------------------------------------------------------------
}

new CPT_Bedroom;
