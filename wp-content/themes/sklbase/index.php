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
		
		<?php 
			if(have_posts()) : while(have_posts()) : the_post();
			
					the_date("d/m/Y");
					the_title();
					the_content();
					
				endwhile;
				
			else :
				
				echo "No Post!";
				
			endif;
		?>
		
		<?php wp_footer() ?>
		
	</body>
</html>