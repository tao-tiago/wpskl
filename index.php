<?php get_header() ?>
		
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
		
		<?php get_sidebar() ?>
		
<?php get_footer() ?>