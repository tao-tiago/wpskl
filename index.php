<?php get_header() ?>
		
	<?php 
		if(have_posts()) : while(have_posts()) : the_post();

				// Date
				the_date("d/m/Y");
		
				// Title
				the_title();
				
				// Limit Caracters Content
				the_content();
				
			endwhile;
				
				// Paginate
				Custom_Functions::paginate();
		else :
			
			echo "No Post!";
			
		endif;
	?>
	
	<?php get_sidebar() ?>
		
<?php get_footer() ?>