<?php

get_template_part('includes/thumbs');
#get_template_part('includes/paged');


/* SIDEBAR */ 
if ( function_exists('register_sidebar') )
register_sidebar(array(
	'name' => 'sidebar',
	'before_widget' => '<div id="%1$s" class="box_sidebar"><div class="cabecalho%1$s">',
	'after_widget' => '</div>',
	'before_title' => '</div><h3 class="txtIndent">',
	'after_title' => '</h3>',
));


/* MENU */
register_nav_menus( array(
	'menu' => __( 'Menu Principal' ),
	'menu-footer' => __( 'Menu Rodapé' )
));


/* Limitar número caracteres conteúdo -------------- */
function except_limit($maximo) {
$except = get_the_excerpt();
if ( strlen($except) > $maximo ) {
$continue = '...';
}
$except = mb_substr( $except, 0, $maximo, 'UTF-8' );
echo $except.$continue;
}
/* ------------------------------------------------ */
  

/* CHAMADAS */
/* Styles */
add_action( 'wp_enqueue_scripts', 'generalcall' );
function generalcall(){
	#wp_enqueue_style("reset", get_bloginfo('template_directory')."/css/reset.css");
	#wp_enqueue_style("general", get_bloginfo('template_directory')."/css/general.css");
/* Scripts */
	wp_enqueue_script("jquery");
	#wp_enqueue_script("jcycle", get_bloginfo('template_directory')."/js/jquery.cycle.all.js");
}
