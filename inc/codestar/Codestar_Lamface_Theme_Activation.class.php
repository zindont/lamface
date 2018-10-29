<?php 
/**
 * Codestar_Lamface_Theme_Activation
 * @author info@zindo.info
 */
class Codestar_Lamface_Theme_Activation {

	function __construct() {
		var_dump(constant(LF_SYSTEM_HISTORIES));
		// $this->codestar_create_lf_system_histories();
	}

	public function codestar_create_lf_system_histories() {
		global $table_prefix, $wpdb;
		
		$table_name = $table_prefix . self::LF_SYSTEM_HISTORIES;
		
		if ($this->isTableExist($table_name)) {
			return false;
		}
		
	    // Table not in database. Create new table
     	$charset_collate = $wpdb->get_charset_collate();
	 
	    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
	        uid BIGINT NOT NULL AUTO_INCREMENT,
	        target_name TEXT NOT NULL,
	        target_code TEXT NOT NULL,
	        target_url TEXT NOT NULL,
	        target_image TEXT NOT NULL,
	        target_message TEXT NOT NULL,
	        fired_time TIMESTAMP NOT NULL,
	        PRIMARY KEY (uid)
	    ) $charset_collate;";
	    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	    dbDelta( $sql );
	}

	private function isTableExist($table_name) {
		global $wpdb;

		if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
			return false;
		} else{
			return true;
		}
	}
}