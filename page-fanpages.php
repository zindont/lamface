<?php
/*
 Template Name: Fanpages Template
 */
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
global $wp_query;
$all_vars = $wp_query->query_vars;
$current_page = ($all_vars['page'])? $all_vars['page'] : 1;
$item_per_page = 12;
$show_from = (($current_page-1)*$item_per_page)+1;
$show_to = $current_page*$item_per_page;
$current_url = home_url(add_query_arg(array(),$wp_query->request));
var_dump($current_url);
var_dump($current_page);
var_dump($show_from);
var_dump($show_to);
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
					<main id="main" class="site-main col-xs-12">
						<?php //showSavePosts() ?>
						<?php 
							$user_id = get_current_user_id();
							global $wpdb;
							$table_post = 'ltt_ff_posts_';
							$table_cat = 'ltt_ff_cate';
							//get cate list
							$cats = $wpdb->get_results("SELECT * FROM $table_cat");
							$fanPages = $uniqe_fps = array();
							$total_fanpages = Codestar_Lamface_Base::codestar_get_list_posts_total_in_pages();
							foreach($cats as $cat){
								$table_post_name = $table_post.$cat->cate_id;
								$fps      = $wpdb->get_results( "SELECT DISTINCT feed_id,user_screenname,user_pic,user_link FROM $table_post_name");
								$fanPages = array_merge($fanPages,$fps);
							}?>
							<div class="box box-danger">
								<div class="box-body no-padding">
									<ul class="users-list clearfix">
										<?php foreach($fanPages as $fanPage):?>
											<?php 
												$feed_id = $fanPage->feed_id;
												$user_screenname = $fanPage->user_screenname;
												$user_pic = $fanPage->user_pic;
												$user_link = $fanPage->user_link;
												if(in_array($feed_id,$uniqe_fps)){
													continue;
												}
												$uniqe_fps[] = $feed_id;
												if($show_from>$show_to) continue;
												$show_from++;
											?>
											<li>
												<img src="<?php echo $user_pic;?>" alt="<?php echo $user_screenname;?>" width="50px">
												<a class="users-list-name" href="<?php echo $user_link;?>" target="_blank"><?php echo $user_screenname;?></a>
												<span class="users-list-date"><?php echo $total_fanpages[$feed_id];?> Content</span>
											</li>
										<?php endforeach ;?>
									</ul>
									<!-- /.users-list -->
									
									<div class="pagination-wrap">
										<ul class="pagination" id="pagination-page"></ul>
										<div class="pagination-wrap-more">
											<div class="pagination-text">-- Có tất cả <?php echo ceil(count($uniqe_fps)/12); ?> trang --</div>
										</div>
									</div>
									<!-- /.pagination -->
								</div>
								<!-- /.box-body -->
							</div>
							<script>
								jQuery(document).ready(function(){
									jQuery('#pagination-page').twbsPagination({
										totalPages: <?php echo ceil(count($uniqe_fps)/12);?>,
										visiblePages: 3,
										startPage: <?php echo $current_page;?>,
										first: '<span class="fa fa-angle-double-left"></span>',
										prev: '<span class="fa fa-angle-left"></span>',
										next: '<span class="fa fa-angle-right"></span>',
										last: '<span class="fa fa-angle-double-right"></span>',
										onPageClick: function (event, page) {
											form_update($form, 'pagination-page', page);
										}
									});
								});
							</script>
							<?php
							
							/*$keyFanPage = array_unique( array_column( $fanPage, 'feed_id' ) );
							$l          = 0;
							foreach ( $fanPage as $r ) {
								if ( in_array( $l, array_keys( $keyFanPage ) ) ) {
									?>
									<div class="shop">
										<?php
										if ( is_user_login() ) {
											?>
											<a class="bulkff_save_page" onclick="bulkff_save_page(this,'<?php echo trim($r['feed_id']); ?>', <?php echo $cat; ?>);return false;">
												<?php
												if ( in_array( $r['feed_id'], $meta_page ) ) {
													echo "Đã lưu page";
												} else {
													echo "Lưu page";
												}
												?>
											</a>
											<?php
										}
										?>
										<a target="_blank" href="<?php echo $r['user_link']; ?>" class="img get_posts_page" data-id="<?php echo $r['feed_id']; ?>">
											<img src="<?php echo $r['user_pic']; ?>" alt="<?php echo $r['user_screenname']; ?>">
										</a>
										<div class="shortInfo <?php echo ! empty( $feed_id_post ) && $feed_id_post == $r['feed_id'] ? 'active' : ''; ?>">
											<a target="_blank" href="<?php echo $r['user_link']; ?>" class="get_posts_page" data-id="<?php echo $r['feed_id']; ?>"><?php echo $r['user_screenname']; ?></a>
											<p> <?php echo codestar_api_get_posts_total($cat,$r['feed_id'])?> Contents</p>
										</div>
										<div class="clr"></div>
									</div>
									<?php
								}
								$l ++;
							}*/
						?>

					</main><!-- #main -->
				</row>
            </div>
            <!-- /.box-body -->
		</div>
		<!-- /.box -->
	</section><!-- #primary -->
<?php get_footer(); ?>
