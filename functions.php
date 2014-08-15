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

if(!defined('Wp_Images')) {
	define( 'Wp_Images', get_template_directory_uri().'/src/images');
}

// Includes
get_template_part('includes/Custom_Functions');
get_template_part('includes/Custom_Admin');
get_template_part('includes/sidebar');
get_template_part('includes/menu');
get_template_part('includes/thumbs');