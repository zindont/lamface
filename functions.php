<?php
/**
 * lamface functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lamface
 */

require_once "lib/lib.php";

function che_do_bao_tri() {
	if ( ! current_user_can( 'edit_themes' ) || ! is_user_logged_in() ) {
		wp_die( '<p style="text-align: center;">THÔNG BÁO</p><p style="text-align: center;">Đang nâng cấp ứng dụng content</p>' );
	}
}
//add_action( 'get_header', 'che_do_bao_tri' );

if ( ! function_exists( 'lamface_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function lamface_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on lamface, use a find and replace
		 * to change 'lamface' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'lamface', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'lamface' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'lamface_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'lamface_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lamface_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'lamface_content_width', 640 );
}
add_action( 'after_setup_theme', 'lamface_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lamface_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'lamface' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'lamface' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'lamface_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function codestar_lamface_scripts() {
	/*
	* Styles
	*/

	// Bootstrap 
	wp_enqueue_style( 'codestar_lamface-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
	
	// Font Awesome
	wp_enqueue_style( 'codestar_lamface-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );
	
	// Ion Icon
	wp_enqueue_style( 'codestar_lamface-ionicons', get_template_directory_uri() . '/assets/css/ionicons.min.css' );

	// Admin LTE
	wp_enqueue_style( 'codestar_lamface-adminlte', get_template_directory_uri() . '/assets/css/AdminLTE.min.css' );
	
	// Admin LTE Skin Blue
	wp_enqueue_style( 'codestar_lamface-skin-blue', get_template_directory_uri() . '/assets/css/skin-blue.min.css' );

	// Theme style	
	wp_enqueue_style( 'lamface-style', get_stylesheet_uri() );

	// Codestar custom style	
	wp_enqueue_style( 'codestar_lamface-custom',get_template_directory_uri() . '/assets/css/codestar-custom.css' );
	
	/* 
	* Scripts 
	*/

	// Bootstrap
	wp_enqueue_script( 'codestar_lamface-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), null, true );
	
	// AdminLTE App
	wp_enqueue_script( 'codestar_lamface-adminlte-app', get_template_directory_uri() . '/assets/js/adminlte.min.js', array('jquery'), null, true );

	/* 
	* Old section
	*/
	wp_enqueue_style( 'lamface-micromodal', get_template_directory_uri() . '/plugins/micromodal/dist/basicstyle.css' );

	wp_enqueue_script( 'lamface-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'lamface-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'lamface-lazyload', get_template_directory_uri() . '/plugins/jquery.lazy/jquery.lazy.min.js', array(), '1.7.1', true );

	wp_enqueue_script( 'lamface-mansory', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array(), '', true );
	wp_enqueue_script( 'lamface-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), '', true );
	wp_enqueue_script( 'lamface-micromodal', get_template_directory_uri() . '/plugins/micromodal/dist/micromodal.min.js', array(), '', true );
	wp_enqueue_script( 'lamface-scripts', get_template_directory_uri() . '/assets/js/codestar_lamface.js', array('jquery'), '1.1', true );
	
	// # jQuery Notify
	wp_enqueue_script( 'jquery-notify-script', get_template_directory_uri() . '/plugins/jquery.notify/notify.min.js', array(), '1.0', true );
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'codestar_lamface_scripts' );

function register_custom_sidebars() {

  // Left sidebar, located at the top of the sidebar.
  register_sidebar( array(
    'name' => __( 'Left Sidebar', 'lamface' ),
    'id' => 'left-sidebar',
    'description' => __( 'Left Sidebar', 'lamface' ),
    'before_widget' => '<section class="widget">',
    'after_widget' => '</section>',
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ) );

  // ... more calls to register_sidebar() ... 
}
add_action( 'widgets_init', 'register_custom_sidebars' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer widgets.
 */
require get_template_directory() . '/inc/template-widgets.php';

/**
 * Codestar classes
 */
require get_template_directory() . '/inc/codestar/Codestar_Lamface_Base.class.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

require_once( dirname( __FILE__ ) . '/bulkff/function.php' );

#customize urls
require get_template_directory() . '/inc/template-urls.php';
require get_template_directory() . '/inc/template-ajax.php';
