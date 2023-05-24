<?php

if( !defined( 'WPINC' ) )
  die();

class CPT_Content{

	// -----------------------------------------------------------------------------

	public function __construct() {
		$this->create_post_type();
	}

	// -----------------------------------------------------------------------------

	function create_post_type() {

		$content = new Odin_Post_Type(
			'Conteúdo',
			'content'
		);

		$content->set_arguments(
			array(
				'supports'            => array( 'title' ),
				'hierarchical'        => false,
				'public'              => true,
				'publicly_queryable'  => true,
				'menu_icon'           => 'dashicons-align-right',
				'with_front' => false,
        		'exclude_from_search' => true
			)
		);

		$content->set_labels(
			array(
				'menu_name'          => 'Conteúdos',
				'singular_name'      => 'Conteúdo',
				'add_new'            => 'Adicionar novo conteúdo',
				'add_new_item'       => 'Adicionar novo conteúdo',
				'edit_item'          => 'Editar conteúdo',
				'new_item'           => 'Novo conteúdo',
				'all_items'          => 'Todos os conteúdos',
				'view_item'          => 'Ver conteúdo',
				'search_items'       => 'Procurar conteúdos',
				'not_found'          => 'Nenhum conteúdo encontrada',
				'not_found_in_trash' => 'Nenhum conteúdo encontrada na lixeira',
				'parent_item_colon'  => '',
			)
		);

	}

	// -----------------------------------------------------------------------------
}

new CPT_Content;
