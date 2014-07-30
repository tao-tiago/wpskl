<?php

// Enable post thumbnails
if(!function_exists( 'post-thumbnails' )){
	add_theme_support( 'post-thumbnails' );
};

# add_image_size( $name, $width = 0, $height = 0, $crop = false );