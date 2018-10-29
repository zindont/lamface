<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lamface
 */

get_header();
?>

<section id="primary" class="content-area content">
	<div class="box box-default">
		<div class="box-header with-border content-header">
			<?php while ( have_posts() ) :?>
			<?php the_post();?>
			<?php 
				the_title( '<h1 class="entry-title">', '</h1>' );
				// Breadcrumb
				do_action( 'codestar_breadcrumbs' );
			?>
			<?php endwhile; // End of the loop.?>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="row">
				<main id="main" class="site-main">

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

				</main><!-- #main -->
				</row>
            </div>
            <!-- /.box-body -->
		</div>
		<!-- /.box -->
	</section><!-- #primary -->
<?php get_footer(); ?>
