<?php

/*
Plugin Name: Módulo de Banner
Plugin URI: http://www.bindigital.com.br
Description: Módulo de Banner. Para inserir execute a shortcode [banner]. Requer Plugin ACF Advanced Custom Fields 
Version: 1.0
Author: Tiago Pires
Author URI: http://www.bindigital.com.br
*/

/* --------------------------------------------------------------------------------- */
/* BANNER */

class Banner{
	
	public function banner() {
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
			'supports'            => array( 'title', 'thumbnail' ),
			'taxonomies'          => array( ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-format-image',
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'query_var'           => 'banner',
			'rewrite'             => $rewrite,
			'capability_type'     => 'post',
		);
		register_post_type( 'Banner', $args );
	}

	public function front_banner(){
			
		echo '<ul class="banner">';
		
            	$banner = new WP_Query(array('post_type'=>'banner'));
				while($banner->have_posts()) : $banner->the_post();
				
					$hab_link = get_field("habilitar_link");
					$link = get_field("campo_link");
					
					if(has_post_thumbnail()) :
	                    echo '<li>';
							if($hab_link!=FALSE) { echo '<a href="'.$link.'" title="'.get_the_title().'" rel="external" class="link_banner">'; }
								the_post_thumbnail('full');
							if($hab_link!=FALSE) { echo '</a>'; }
	                    echo '</li>';
					endif;
					
				endwhile; wp_reset_postdata();
			
        echo '</ul> <div class="pagnav"></div>';	
				
	}
	
	public function __construct(){
		// Banner
		add_action( 'init', array($this, 'banner'), 0 );

		// Shortcode Banner
		add_shortcode( 'banner', array($this, 'front_banner'));
	}

}


function banner(){ $banner = new Banner; }
add_action('init', 'banner');
