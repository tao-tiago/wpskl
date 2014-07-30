<?php get_header() ?>
		
		<?php 
			if(have_posts()) : while(have_posts()) : the_post();

					// Date
					the_date("d/m/Y");
			
					// Title
					the_title();
					
					// Limit Caracters Content
					$limit = new Custom_Functions();
					echo $limit->limit(get_the_content(), 52);
					
				endwhile;
					
					// Paginate
					$paginate = new Custom_Functions();
					echo $paginate->paginate();
			else :
				
				echo "No Post!";
				
			endif;
		?>
		
		<?php get_sidebar() ?>
		
<?php get_footer() ?>