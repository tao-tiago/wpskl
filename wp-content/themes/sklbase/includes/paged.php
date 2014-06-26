<?php

function paginate( $args = array() )
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