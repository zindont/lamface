<?php

add_filter( 'rewrite_rules_array','my_insert_rewrite_rules' );
add_filter( 'query_vars','my_insert_query_vars' );
add_action( 'wp_loaded','my_flush_rules' );

// flush_rules() if our rules are not yet included
function my_flush_rules(){
	$rules = get_option( 'rewrite_rules' );

	if ( ! isset( $rules['(fanpages)/(\d*)$'] ) ) {
		global $wp_rewrite;
	   	$wp_rewrite->flush_rules();
	}
}

// Adding a new rule
function my_insert_rewrite_rules( $rules )
{
	$newrules = array();
	$newrules['(fanpages)/(\d*)$'] = 'index.php?fanpages=1&fanpages_id=$matches[2]';
	return $newrules + $rules;
}

// Adding the id var so that WP recognizes it
function my_insert_query_vars( $vars )
{
    array_push($vars, 'fanpages', 'fanpages_id');
    return $vars;
}

// Adding custom template page
add_filter('template_include', 'archive_fanpage_include_template', 1000, 1);
function archive_fanpage_include_template( $template ){
    if( get_query_var( 'fanpages' ) ){
        $new_template = WP_CONTENT_DIR.'/themes/lamface/archive-fanpages.php';
        if( file_exists( $new_template ) )
            $template = $new_template;
    }
    return $template;
}