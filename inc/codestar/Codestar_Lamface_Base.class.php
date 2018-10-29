<?php 

/**
 * Codestar_Lamface_Base
 * @author info@zindo.info
 */
class Codestar_Lamface_Base {
	
	function __construct(){
		// Require
		require_once get_template_directory() . '/inc/codestar/Codestar_Breadcrumbs.class.php';
		// require_once get_template_directory() . '/inc/codestar/Codestar_Lamface_Cron.class.php';
		require_once get_template_directory() . '/inc/codestar/Codestar_Lamface_Theme_Activation.class.php';
		// Filter
		add_filter( 'body_class', array($this, 'codestar_lamface_body_classes') );

		// Actions
		add_action( 'codestar_breadcrumbs', array($this, 'codestar_lamface_print_breadcrumbs'), 10, 1 );
		add_action( 'after_setup_theme', array($this, 'codestar_lamface_global_constant'), 10, 1 );
		add_action( 'after_setup_theme', array($this, 'codestar_lamface_firstly_hooks'), 30, 1 );
	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function codestar_lamface_body_classes( $classes ) {
		// AdminLTE skin class
		$classes[] = 'skin-blue';

		return $classes;
	}

	/**
	 * Functions to print breadcumbs
	 *
	 */
	function codestar_lamface_print_breadcrumbs()	{
		Codestar_Breadcrumbs::breadcrumb();
	}

	/**
	 * Global constant
	 */
	public function codestar_lamface_global_constant($value='')	{
		if ( defined( 'LF_SYSTEM_HISTORIES' ) ) {
			define('LF_SYSTEM_HISTORIES', 'lf_system_histories');
		}
	}

	/**
	 * Firstly hook
	 */
	public function codestar_lamface_firstly_hooks() {
		new Codestar_Lamface_Theme_Activation();
	}

	// get total contents
	public static function codestar_get_total_posts($cat_id='') {
		global $wpdb;
		$table_post = 'ltt_ff_posts_';
		$table_cat = 'ltt_ff_cate';
	
		if($cat_id){ //get cat total
			$table_post_name = $table_post.$cat_id;
			$total = $wpdb->get_var("SELECT COUNT(*) as total FROM $table_post_name WHERE post_status='approved'");
			return $total;
		}else{
			//get cate list
			//echo 'cat list here';
			$cats = $wpdb->get_results("SELECT * FROM $table_cat");
			$total = 0;
			foreach($cats as $cat){
				$table_post_name = $table_post.$cat->cate_id;
				$count = $wpdb->get_var("SELECT COUNT(*) as total FROM $table_post_name WHERE post_status='approved'");
				$total+= $count;
			}
			return number_format_i18n($total);
		}
	}

	// get total fanpages
	public static function codestar_get_total_fanpages($cat_id='') {
		global $wpdb;
		$table_post = 'ltt_ff_posts_';
		$table_cat = 'ltt_ff_cate';
	
		if($cat_id){ //get cat total
			$table_post_name = $table_post.$cat_id;
			$total = $wpdb->get_var("SELECT COUNT(DISTINCT feed_id) FROM $table_post_name");
			return $total;
		}else{
			//get cate list
			//echo 'cat list here';
			$cats = $wpdb->get_results("SELECT * FROM $table_cat");
			$total = 0;
			foreach($cats as $cat){
				$table_post_name = $table_post.$cat->cate_id;
				$count = $wpdb->get_var("SELECT COUNT(DISTINCT feed_id) FROM $table_post_name");
				$total+= $count;
			}
			return number_format_i18n($total);
		}
	}

	// get total saved pages
	public static function codestar_get_total_saved_pages($user_id, $cat_id = '') {
		global $wpdb;
		$total_saved_pages = 0;
	
		if($user_id){ //get cat total
			$bulk_page = get_user_meta($user_id, '_bulk_page');
			$saved_pages = unserialize($bulk_page[0]);
			if($cat_id){
				$total_saved_pages = count($saved_pages[$cat_id]);
			}else{
				foreach ($saved_pages as $saved_page) {
					$total_saved_pages += count($saved_page);
				}
			}
		}
		return number_format_i18n($total_saved_pages);
	}

	// get total saved posts
	public static function codestar_get_total_saved_posts($user_id, $cat_id = '') {
		global $wpdb;
		$total_saved_posts = 0;
	
		if($user_id){ //get cat total
			$bulk_posts = get_user_meta($user_id, '_fb_meta_custom');
			$saved_posts = unserialize($bulk_posts[0]);
			if($cat_id){
				$total_saved_posts = count($saved_posts[$cat_id]);
			}else{
				foreach ($saved_posts as $saved_post) {
					$total_saved_posts += count($saved_post);
				}
			}
		}
		return number_format_i18n($total_saved_posts);
	}

	
	public static function codestar_get_list_posts_total_in_pages(){
		global $wpdb;
		$table_post = 'ltt_ff_posts_';
		$table_cat = 'ltt_ff_cate';
		$result = array();
		
		//get cate list
		//echo 'cat list here';
		$cats = $wpdb->get_results("SELECT * FROM $table_cat");
		$fanpages = array();
		foreach($cats as $cat){
			$table_post_name = $table_post.$cat->cate_id;
			$fps = $wpdb->get_results( "SELECT COUNT(post_id) as total, feed_id FROM $table_post_name GROUP BY feed_id");
			foreach($fps as $fp){
				if(isset($fanpages[$fp->feed_id])){
					$fanpages[$fp->feed_id] = $fanpages[$fp->feed_id] + (int)$fp->total;
				}else{
					$fanpages[$fp->feed_id] = (int)$fp->total;
				}
			}
		}
		return $fanpages;
	}
	
}
new Codestar_Lamface_Base();