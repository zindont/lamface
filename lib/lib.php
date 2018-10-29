<?php

require_once( 'aq_resizer.php' );
//require_once( 'styling/run_scss.php' );
require_once( 'lf-functions.php' );
require_once( 'shortcode/shortcode.php' );


/**
 * Enqueue style and script
 */
if ( ! function_exists( 'lamface_module_scripts' ) ) {
	function lamface_module_scripts() {
		//wp_enqueue_style( 'lamface-awesome', get_template_directory_uri() . '/bulkff/assets/css/font-awesome.min.css',
			//array(), '1.0',
			//'all' );
		//wp_enqueue_style( 'lamface-carousel', get_template_directory_uri() . '/bulkff/assets/css/owl.carousel.css',
		//	array(), '1.0',
			//'all' );
		wp_enqueue_style( 'lamface-style', get_template_directory_uri() . '/bulkff/assets/css/style.css', array(),
			'1.0',
			'all' );
		wp_enqueue_style( 'lamface-css', get_template_directory_uri() . '/assets/css/lamface-pure.css', array(), '1.1',
			'all' );
		
		
		wp_enqueue_script( 'lamface-datepicker', get_template_directory_uri() . '/bulkff/assets/js/daterangepicker.js',
			array(),
			'1.0.0',
			true );
		//wp_enqueue_script( 'lamface-carousel', get_template_directory_uri() . '/bulkff/assets/js/owl.carousel.min.js',
			//array(),
			//'1.0.0',
			//true );
		wp_enqueue_script( 'lamface-script', get_template_directory_uri() . '/bulkff/assets/js/script.js', array(),
			'1.0.0',
			true );
		wp_enqueue_script( 'lamface-js', get_template_directory_uri() . '/assets/js/lamface.js', array(),
			'1.0.0',
			true );
		wp_localize_script( 'lamface-js', 'lamface_ajax_obj', array(
			'ajaxurl' => site_url() . '/api/',
			'url'     => site_url(),
		) );
	}
}

add_action( 'wp_enqueue_scripts', 'lamface_module_scripts', 110 );