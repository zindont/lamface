<?php 
/**
 * Codestar_Lamface_Cron
 * @author info@zindo.info
 */
class Codestar_Lamface_Cron {

	function __construct() {
		add_filter( 'cron_schedules', array($this, 'codestar_lamface_cron_interval') );

		add_action( 'init', array($this, 'codestar_lamface_schedule_event' ) );
		add_action( 'codestar_cleanup_widget_system_histories', array($this, 'codestar_cleanup_widget_system_histories_exec' ) );
	}

	function codestar_lamface_cron_interval( $schedules ) {
	    $schedules['120mins'] = array(
	        'interval' => 7200,
	        'display'  => esc_html__( 'Mỗi 120 phút' ),
	    );
	 
	    return $schedules;
	}

	public function codestar_lamface_schedule_event() {
	    if (! wp_next_scheduled ( 'codestar_cleanup_widget_system_histories' )) {
	        wp_schedule_event( time(), '120mins', 'codestar_cleanup_widget_system_histories' );
	    }
	}

	public function codestar_cleanup_widget_system_histories_exec()	{
		global $wpdb;
		$table_name = $wpdb->prefix . LF_SYSTEM_HISTORIES;
		
		$results = $wpdb->get_results( "DELETE FROM {$table_name} WHERE fired_time < (SELECT DATE_SUB(NOW(), INTERVAL 120 MINUTE))", OBJECT );
	}
}
new Codestar_Lamface_Cron();