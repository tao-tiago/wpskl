<?php

// Customiza a URL da logo no login
function custom_logo_login_url() { return home_url(); }

// Customiza o titulo da logo no login
function custom_logo_login_title() { return get_bloginfo( 'name' ); }

// Customiza o rodapé no admin
function custom_admin_footer() { echo '<a target="_blank" href="http://www.seudominioaqui.com.br">Nome da empresa</a> &copy; ' . date( 'Y' ); }

// Esconde a versão do WordPress no admin
function hide_footer_version() { return ''; }

// Remove o logo do WordPress da barra de topo
function remove_logo_toolbar( $wp_toolbar ) {
	global $wp_admin_bar;
	$wp_toolbar->remove_node( 'wp-logo' );
}

// Esconde links desnecessários do menu lateral no admin
function hide_admin_menu_links() {
	# remove_menu_page( 'tools.php' );
	# remove_submenu_page( 'themes.php', 'theme-editor.php' );
}

// Remove widgets do dashboard
function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
}

// Fix problem accentuation in images upload
function sanitize_file_name_in_upload($filename) {
    $info = pathinfo($filename);
    $extension = empty($info['extension']) ? '' : '.' . $info['extension'];
    $name = basename($filename, $extension);

	return strtolower(sanitize_title($name)).$extension;
}


function theme_setup() {

	// Custom logo
	add_action( 'login_head', 'custom_logo_login' );
	
	// Custom logo url
	add_filter( 'login_headerurl', 'custom_logo_login_url' );
	
	// Custom logo title
	add_filter( 'login_headertitle', 'custom_logo_login_title' );
	
	// Custom admin footer
	add_filter( 'admin_footer_text', 'custom_admin_footer' );
	
	// Hide WP version on admin footer
	add_filter( 'update_footer', 'hide_footer_version', 999 );
	
	// Remove WP logo from admin toolbar
	add_action( 'admin_bar_menu', 'remove_logo_toolbar', 999 );
	
	// Hide unecessary menu links on admin sidebar
	add_action( 'admin_menu', 'hide_admin_menu_links' );
	
	// Remove default dashboard widgets
	add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );
	
	// Fix problem accentuation in images upload
	add_filter('sanitize_file_name', 'sanitize_file_name_in_upload', 10);

}

add_action( 'admin_init', 'theme_setup' );
