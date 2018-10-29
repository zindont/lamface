<?php

if ( ! function_exists( 'lf_category_post_template' ) ) {
	
	function lf_category_post_template( $attr, $content ) {
		$page = $id = $title = '';
		ob_start();
		extract( shortcode_atts( array(
			'title' => '',
			'id'    => '',
			'page'  => '18',
		), $attr ) );
		if ( empty( $id ) ) {
			return false;
		}
		global $wpdb;
		$data = $wpdb->get_results( "SELECT * FROM ( SELECT * FROM `ltt_ff_posts_$id`  ORDER BY rand() LIMIT 0,{$page} ) q ORDER BY `ff_posts_id` DESC",
			ARRAY_A );
		?>
		<!-- <div class="category-post"> -->
			<?php lf_get_item_post_short( $data, $id ); ?>
		<!-- </div> -->
		<?php		
		return ob_get_clean();
	}
}

if ( ! function_exists( 'lf_category_post_more_template' ) ) {
	
	function lf_category_post_more_template( $attr, $content, $data ) {
		$page = $id = $title = '';
		ob_start();
		extract( shortcode_atts( array(
			'title' => '',
			'id'    => '',
			'page'  => '18',
		), $attr ) );
		if ( empty( $id ) ) {
			return false;
		}
		?>
		<?php lf_render_more_item( $data, $id ); ?>
		<?php		
		return ob_get_clean();
	}
	
}

function foo_page() {
	global $wpdb;
	$_cat_uid = 13; $_page_init = 18;
	$page  	= isset($_POST['page']) ? $_POST['page'] : 0;
	$start 	= $page == 0 ? 0 : $page * $attr['page'] -1;

	$data 	= $wpdb->get_results( "SELECT * FROM ( SELECT * FROM `ltt_ff_posts_$_cat_uid`  ORDER BY rand() LIMIT $start, $_page_init ) q ORDER BY `ff_posts_id` DESC", ARRAY_A );
	//$result = var_dump( $data );
	$result = lf_category_post_more_template( array( 'id' => $_cat_uid ), "", $data );
	wp_send_json_success( $result );
	die();
}
add_action( 'wp_ajax_foo_page', 'foo_page' );
add_action( 'wp_ajax_nopriv_foo_page', 'foo_page' );