<?php

class Custom_Functions{
	
	// Calls
	public static function call(){
		// Style
		wp_enqueue_style( "general" , Wp_Styles."/style.css");
		// Scripts
		wp_deregister_script( "jquery" );
		wp_enqueue_script( "custom_jquery" , Wp_Scripts."/custom_jquery.js", array(), false, false);
	}
	
	// Paginate
	public static function paginate( $args = array() )
	{
	    global $wp_query;

	    $defaults = array(
	        'big_number' => 999999999,
	        'base'       => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
	        'format'     => '?paged=%#%',
	        'current'    => max( 1, get_query_var( 'paged' ) ),
	        'total'      => $wp_query->max_num_pages,
	        'prev_next'  => true,
	        'end_size'   => 1,
	        'mid_size'   => 2,
	        'type'       => 'list'
	    );

	    $args = wp_parse_args( $args, $defaults );

	    extract( $args, EXTR_SKIP );
	
	    if ( $total == 1 ) return;
	
	    $paginate_links = apply_filters( 'paginate', paginate_links( array(
	        'base'      => $base,
	        'format'    => $format,
	        'current'   => $current,
	        'total'     => $total,
	        'prev_next' => $prev_next,
	        'end_size'  => $end_size,
	        'mid_size'  => $mid_size,
	        'type'      => $type
	    ) ) );

	    echo $paginate_links;
	}
	
}


// Scripts
add_action( 'wp_enqueue_scripts', array( 'Custom_Functions' , 'call') );


// Remove unecessary wp head tags
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'parent_post_rel_link' );
remove_action( 'wp_head', 'start_post_rel_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );


// Disable XMLrpc
add_filter( 'xmlrpc_enabled', '__return_false' );


// Hidden Bar Admin
add_filter('show_admin_bar', '__return_false');


// Insert page slug with class in body
function add_body_class( $classes )
{
    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}
add_filter( 'body_class', 'add_body_class' );
