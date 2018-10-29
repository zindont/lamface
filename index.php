<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lamface
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) :
					?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
					<?php
				endif;

				?>

				<!-- DoShortcode Fanpage nổi bật -->
				<?php echo do_shortcode('[lf_category_fanpage id="13" title="FANPAGE MỚI NHẤT THAM GIA HỆ THỐNG" page="5"]'); ?>

				<!-- DoShortcode Xem nhiều nhất 24h qua -->
				<?php echo do_shortcode('[lf_category_view id="13" title="XEM NHIỀU NHẤT 24H QUA" page="5" zone="most-like-zone"]'); ?>				
				
				<div class="clr h20">&nbsp;</div>

				<!-- DoShortcode Lưu nhiều nhất 24h qua -->
				<?php echo do_shortcode('[lf_category_save id="13" title="ĐƯỢC LƯU LẠI NHIỀU NHẤT 24H QUA" page="5" zone="most-save-zone"]'); ?>
	
				

				<div class="clr mb20"></div>
				<div id='bulkff_content'></div>
				<div class="homepage-normal-zone-header"><i>&nbsp;</i> Mới cập nhật</div>
				<?php
				echo('<input type="hidden" value="0" name="page" />');
				echo('<div class="mansory-grid"><div class="grid-sizer"></div>');
				/* Start the Loop */
				//while ( have_posts() ) :
					//the_post();



					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					//get_template_part( 'template-parts/content', get_post_type() );

				//endwhile;

				?>				
				<?php echo do_shortcode('[lf_category_post id="13" title="MẪU QUẢNG CÁO MỚI NHẤT" page="5" ]'); ?>
	
				<?php

				echo('</div>');

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

			<div class="load-more">
				<i class="fa fa-retweet"></i> Tải thêm mẫu tin
			</div><!-- #load-more -->
		</main><!-- #main -->
	</div><!-- #primary -->
	
<div id="menu-right">
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
