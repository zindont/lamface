<?php
    
add_action( 'wp_ajax_get_online_users', 'get_online_users' );
add_action( 'wp_ajax_nopriv_get_online_users', 'get_online_users' ); // unauthorize still doing function
function get_online_users() {
    // # it's should will be converted to store proceduce instead of query following below
    global $wpdb; 
    $user       = wp_get_current_user();
    $total_rows = $wpdb->get_results( 'SELECT COUNT(uid) AS total, MAX(uid) AS max_uid FROM ' . $wpdb->prefix . 'online_users', OBJECT );
    $check_user = $wpdb->get_results( 'SELECT uid FROM ' . $wpdb->prefix . 'online_users WHERE display_name = \'' . $user->display_name   . '\'', OBJECT );
    if ( count( $check_user ) <= 0 )
    {
        $response   = $wpdb->insert( $wpdb->prefix . 'online_users', 
                            array(  
                                'display_name'  => $user->display_name,
                                'avatar'	    => get_avatar( $user->user_email, 60 )
                            ),
                            array( '%s', '%s' )
                        );
                    }
                   //var_dump($total_rows[0]);
    if ( intval( $total_rows[0]->total ) > 10 ) {
        $wpdb->query( 
            $wpdb->prepare( 'DELETE FROM ' .  $wpdb->prefix . 'online_users WHERE uid < ' . ( intval( $total_rows[0]->max_uid ) - 10 ) )
        );
    }
    $data = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'online_users ORDER BY uid DESC', ARRAY_A );
	wp_send_json_success($data);
	die();
}
