<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package lamface
 */

get_header();
?>

	<section id="primary" class="content-area content">
		<div class="box box-default">
            <div class="box-header with-border content-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'lamface' ); ?></h1>
				<?php 
				// Breadcrumb
				do_action( 'codestar_breadcrumbs' );
				?>
            </div>
            <!-- /.box-header -->
            <div class="box-body error-page">
        		<h2 class="headline text-yellow"> 404</h2>
				<div class="error-content">
					<h3><i class="fa fa-warning text-yellow"></i> <?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'lamface' ); ?></h3>

					<p>
						We could not find the page you were looking for.
						Meanwhile, you may <a href="/">return to dashboard</a> or try using the search form.
					</p>
					<?php //get_search_form();?>
					<form role="search" method="get" class="search-form" action="/">
						<div class="input-group">
						<input type="text" name="search" class="form-control" placeholder="Search">

						<div class="input-group-btn">
							<button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
							</button>
						</div>
						</div>
						<!-- /.input-group -->
					</form>
				</div><!-- .error-content -->
            </div>
            <!-- /.box-body -->
    	</div>
	</section><!-- #primary -->

<?php
get_footer();
