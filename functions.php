<?php

// Variables
if(!defined('Wp_Directory')) {
	define( 'Wp_Directory', get_template_directory_uri());
}

if(!defined('Wp_Styles')) {
	define( 'Wp_Styles', get_template_directory_uri().'/src/css');
}

if(!defined('Wp_Scripts')) {
	define( 'Wp_Scripts', get_template_directory_uri().'/src/js');
}


// Includes
get_template_part('includes/sidebar');
get_template_part('includes/menu');
get_template_part('includes/theme-functions');
get_template_part('includes/custom_admin');