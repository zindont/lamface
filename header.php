<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lamface
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

	<?php //if ( is_home() ) : ?>
		<script src="<?= get_template_directory_uri() ?>/plugins/owlcarousel2-2.3.4/dist/owl.carousel.min.js"></script>
		<link rel="stylesheet" href="<?= get_template_directory_uri() ?>/plugins/owlcarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    	<link rel="stylesheet" href="<?= get_template_directory_uri() ?>/plugins/owlcarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
	<?php //endif; ?>
	<script type="text/javascript">
		var ajaxurl = "/wp-admin/admin-ajax.php";
		var lamface_ajax_obj = {"ajaxurl":"http://lamface.com/api/", "url":"/"};
    </script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site wrapper">
	<header id="masthead" class="main-header">
        <!-- Logo -->
        <a href="<?php echo home_url() ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">
                LOGO MINI
            </span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">
                lamface.com
            </span>
        </a>
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu hidden">
                <?php if (is_user_logged_in()): ?>
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <?php get_template_part( 'inc/codestar/templates/header/dropdown', 'messages-menu' ) ?>
                        <!-- Notifications -->
                        <?php get_template_part( 'inc/codestar/templates/header/dropdown', 'notifications-menu' ) ?>
                        <!-- Tasks -->
                        <?php get_template_part( 'inc/codestar/templates/header/dropdown', 'task-menu' ) ?>
                        <!-- User Account -->
                        <?php get_template_part( 'inc/codestar/templates/header/dropdown', 'user-menu' ) ?>
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                <?php endif ?>
            </div>
        </nav>
	</header><!-- #masthead -->
	
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		<?php get_sidebar( 'left-menu' ) ?>
	</aside>

	<div id="menu-left" class="site-header main-sidebar hidden">
		<div class="scroller">
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$lamface_description = get_bloginfo( 'description', 'display' );
				if ( $lamface_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $lamface_description; /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'lamface' ); ?></button>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
				?>
			</nav><!-- #site-navigation -->
			<div class="left-sidebar">
				<?php dynamic_sidebar( 'left-sidebar' ); ?>
			</div><!-- #left-sidebar -->
		</div><!-- #wrapper -->
		<div id="profile-menu">
			<ul>
				<li><a href="/ho-so/"><i class="fa fa-user"></i></a></li>
				<li><i class="fa fa-archive"></i></li>
				<li><i class="fa fa-question-circle"></i></li>
				<li onclick="javascript:clickToLogOut()"><i class="fa fa-sign-out"></i></li>
			</ul>
		</div><!-- #profile-menu -->
	</div><!-- #masthead -->

	<div id="content" class="site-content content-wrapper">
