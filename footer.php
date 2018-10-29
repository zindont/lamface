<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lamface.com
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="main-footer">
		<div class="pull-right hidden-xs">
		    <b>Version</b> 1.0.0
	    </div>
	    <strong>Copyright &copy; 2018 <a href="https://zindo.info">Codestar</a>.</strong> All rights reserved.
	</footer><!-- #colophon -->

	<!-- Control Sidebar -->
	<aside class="control-sidebar control-sidebar-dark">
		<?php get_sidebar( 'right' ) ?>
	</aside>
	<!-- /.control-sidebar -->
	<!-- Add the sidebar's background. This div must be placed
	   immediately after the control sidebar -->
	<div class="control-sidebar-bg"></div>	
</div><!-- #page.wrapper -->

<?php wp_footer(); ?>

</body>
</html>
