<?php

/* --------------------------------------------------------------------------------- */
/* BANNER */

function banner() {
	$labels = array(
		'name'                => 'Banners',
		'singular_name'       => 'Banner',
		'menu_name'           => 'Banners',
		'parent_item_colon'   => 'Banner Pai:',
		'all_items'           => 'Todos Banners',
		'view_item'           => 'Ver Banner',
		'add_new_item'        => 'Adicionar Novo Banner',
		'add_new'             => 'Novo Banner',
		'edit_item'           => 'Editar Banner',
		'update_item'         => 'Atualizar Banner',
		'search_items'        => 'Buscar Banner',
		'not_found'           => 'Nenhum Banner Encontrado',
		'not_found_in_trash'  => 'Nenhum Banner Encontrado na Lixeira',
	);
	$rewrite = array(
		'slug'                => 'banner',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => false,
	);
	$args = array(
		'label'               => 'Banners',
		'description'         => 'Banner',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'          => array( ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		#'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'banner',
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'Banner', $args );
}

register_taxonomy( 'tipo', 'banner', array( 'label' => __( 'Tipo' ), 'rewrite' => array( 'slug' => 'tipo' ), 'hierarchical' => true, ) );

add_action( 'init', 'banner', 0 );
