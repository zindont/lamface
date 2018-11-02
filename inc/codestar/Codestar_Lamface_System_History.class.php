<?php 
/**
 * 
 */
class Codestar_Lamface_System_History {

	function __construct() {
		if (! defined('LF_SYSTEM_HISTORIES')) {
			// Something wrong
			trigger_error('Table LF_SYSTEM_HISTORIES doesn\'t exist. Please contact info@zindo.info');
			return;
		}

		add_action( 'codestar_lamface_save_system_history', array($this, 'codestar_lamface_save_system_history'), 10, 3 );
	}

	public function codestar_lamface_save_system_history($target_code, $type, $cat) {
		global $table_prefix, $wpdb, $current_user;

		switch ($type) {
			case 'fanpage':
				$message = 'Đã lưu page: <strong>' . $this->getFanPageNameById($target_code, $cat) . '</strong>';
				break;
			case 'content':
				$message = 'Đã lưu bài viết: <strong>' . $this->getPostTitleById($target_code, $cat) . '</strong>';
				break;			
			default:
				$message = 'Đã lưu bài viết: ';
				break;
		}

	    if (function_exists('get_wp_user_avatar')) {
	        $avatarUrl = get_wp_user_avatar($current_user->ID);
	    } else {
	        $avatarUrl = get_avatar($current_user->ID);
	    }

	    $avatarUrl = $this->scrapeImage($avatarUrl);
	    
		$table_name = $table_prefix . LF_SYSTEM_HISTORIES;
		$recordData = array(
			'target_name' => $current_user->get('user_nicename'),
			'target_code' => (string) $target_code,
			'target_url' => '#',
			'target_image' => $avatarUrl,
			'target_message' => $message,
		);
		$wpdb->replace( $table_name, $recordData );
	}

	private function getFanPageNameById($page_id, $cat) {
		global $wpdb;
		
		$post_table = 'ltt_ff_posts_' . $cat;
		$rowObject = $wpdb->get_row( "SELECT * FROM {$post_table} WHERE feed_id = '{$page_id}'" );

		return $rowObject->post_header;
	}

	private function getPostTitleById($post_id, $cat) {
		global $wpdb;
		
		$post_table = 'ltt_ff_posts_' . $cat;
		$rowObject = $wpdb->get_row( "SELECT * FROM {$post_table} WHERE post_id = '{$post_id}'" );

		return $rowObject->post_header;
	}

	private function scrapeImage($text) {
	    $pattern = '/src=[\'"]?([^\'" >]+)[\'" >]/';
	    preg_match($pattern, $text, $link);
	    $link = $link[1];
	    $link = urldecode($link);
	    return $link;
	}
}