<?php

// Sidebars 
if ( function_exists('register_sidebar') )
register_sidebar(array(
	'name' => 'sidebar',
	'before_widget' => '<div id="%1$s" class="box_sidebar"><div class="cabecalho%1$s">',
	'after_widget' => '</div>',
	'before_title' => '</div><h3 class="txtIndent">',
	'after_title' => '</h3>',
));