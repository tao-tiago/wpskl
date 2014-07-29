<!DOCTYPE html>
<html lang="pt-br">
	<head>
		
		<meta charset="utf-8">
		
		<title>
			<?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?>
		</title>
		
		<?php wp_head() ?>
		
	</head>
	
	<body>
		
	<?php wp_nav_menu(array('theme_location'=>'menu', 'container'=>'nav', 'menu_class'=>'menu')) ?>