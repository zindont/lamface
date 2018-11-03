<?php
/* 
Template Name: Archives
*/
get_header(); ?>
<?php 
/* get cat info*/
$id   = get_query_var( 'fanpages_id', 1 );
global $wpdb;
$cates = $wpdb->get_results( 
	"
		SELECT * 
		FROM ltt_ff_cate
		WHERE cate_id = $id
	"
);
if($cates){
	$cate = $cates[0];
}
// echo Codestar_Lamface_Base::codestar_get_total_saved_posts(get_current_user_id());
if(isset($cate)):
?>
	<section id="primary" class="content-area content">
		<div class="box box-default">
            <div class="box-header with-border content-header">
				<h1>Content <?php echo $cate->cate_name;?></h1>
				<?php 				
				// Breadcrumb
				do_action( 'codestar_breadcrumbs' );
				?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<main id="main" class="site-main col-md-12 col-lg-9">
					<?php require( get_template_directory() . '/filter.php' ); ?> 

					<div class="clr h20">&nbsp;</div>

						<div id='bulkff_content'></div>
						<script>
							jQuery(".order-class").change(function (e) {
								jQuery(".bulkff_form_submit").click();
							});
						</script>
				</main><!-- #main -->
				<div id="menu-right" class="col-md-12 col-lg-3">
					<?php get_sidebar(); ?>
				</div>
            </div>
            <!-- /.box-body -->
		</div>
		<!-- /.box -->
	</section><!-- #primary -->
<?php else:?>
	<section id="primary" class="content-area content">
		<div class="box box-default">
            <div class="box-header with-border content-header">
				<h1>Content</h1>
				<?php 				
				// Breadcrumb
				do_action( 'codestar_breadcrumbs' );
				?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<main id="main" class="site-main col-md-12 col-lg-9">
					<p>Không có dữ liệu, vui lòng thử lại sau, cảm ơn.</p>
				</main><!-- #main -->
				<div id="menu-right" class="col-md-12 col-lg-3">
					<?php get_sidebar(); ?>
				</div>
            </div>
            <!-- /.box-body -->
		</div>
		<!-- /.box -->
	</section><!-- #primary -->
<?php endif;?>
<?php get_footer(); ?>