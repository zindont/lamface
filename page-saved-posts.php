<?php
/*
 Template Name: Saved Posts Page Template
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
$count = 0;
?>
<script type="text/javascript" src="<?php echo get_template_directory_uri().'/bulkff/assets/js/jquery.twbsPagination.min.js';?>"></script>

	<section id="primary" class="content-area content">
		<div class="box box-default">
			<?php while ( have_posts() ) :?>
				<div class="box-header with-border content-header">
					<?php the_post();?>
					<?php 
						the_title( '<h1 class="entry-title">', '</h1>' );
						// Breadcrumb
						do_action( 'codestar_breadcrumbs' );
					?>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<main id="main" class="site-main col-xs-12">
							<?php 
							$user_id = get_current_user_id();
							$path = $_SERVER['DOCUMENT_ROOT'] . "/tmp/" . $user_id . ".user";
							$arr  = json_decode( file_get_contents( $path ), true );
							// var_dump($arr[0]);
							//echo( '<h1>Mẫu quảng cáo đã lưu</h1>' );
							if ( count( $arr) == 0 ):
								$arr = array();
							else:?>
								<div class="mansory-grid"><div class="grid-sizer"></div><div class="category-post">
								<?php foreach( $arr as $it):?>
									<?php
									// $additional = json_decode( $item->post_additional'] );
									$count++;
									if($count<$show_from || $count>$show_to) continue;
									
									global $wpdb; $result = $wpdb->get_results( 'SELECT * FROM ' . 'ltt_ff_posts_' . trim($it['cat_id']) . ' WHERE post_id = \'' . $it['post_id'] . '\'', OBJECT );
									$item = $result[0];
									$interactive = json_decode($item->post_additional); 
									?>
									<div class="item-featured" id="<?php echo trim( $item->post_id ); ?>">
										<div class="wrap">
											<div class="avatar">
												<?php
												if ( $item->media_type == "video" ) {
													?>
													<img src="<?php echo $item->image_url; ?>" alt="" onclick="clickToShow('<?php echo $item->post_id; ?>');return false;">
													<img class='pview_video' src="<?php echo SITE_URL; ?>wp-content/themes/flatsome/bulkff/assets/images/play.png">
													<?php
												} else {
													if ( ! empty( $item->image_url ) ) {
														?>
														<div class="thumb-img">
															<img src="<?php echo $item->image_url; ?>" alt="" onclick="clickToShow('<?php echo $item->post_id; ?>');return false;">
															<?php
															$medias = explode( ",", $item->medias );
															if ( count( $medias ) > 1 && false) {
																?>
																<div class="slider">
																	<div class="owl-carousel owl-theme">
																		<?php
																		foreach ( $medias as $img ) {
																			?>
																			<a><img aconclick="im_img(this);" src='<?php echo $img; ?>'></a>
																			<?php
																		}
																		?>
																	</div>
																</div>
																<?php
															}
															?>
														</div>
														<?php
													} else {
														?>
														<div class="thumb-img">
															<img src="/wp-content/themes/flatsome/assets/img/placeholder-image.jpg" alt="" onclick="clickToShow('<?php echo $item->post_id; ?>');return false;">
														</div>
														<?php
													}
												}
												?>
											</div>
											<div class="desc" onclick="clickToShow('<?php echo $item->post_id; ?>', <?php echo trim($it['cat_id']); ?>);return false;"><?php echo $item->post_text; ?></div>
											<div class="click-expanding" onclick="javascript:descExpanding('<?php echo $item->post_id; ?>')">
												<div class="breaker"></div>
												<div class="inner"><i class="fa fa-plus"></i> Mở rộng</div>
											</div>
											<div class="click-contracting" onclick="javascript:descContracting('<?php echo $item->post_id; ?>')">
												<div class="breaker"></div>
												<div class="inner"><i class="fa fa-minus"></i> Thu gọn</div>
											</div>
											<div class="meta-wrap">
												<ul class="meta">
													<?php
													if ( ! empty( $additional->likes ) ) {
														?>
														<li>
															<i class="fa fa-thumbs-up"></i><strong><?php echo $additional->likes; ?></strong>
														</li>
														<?php
													}
													if ( ! empty( $additional->comments ) ) {
														?>
														<li>
															<i class="fa fa-comments"></i><strong><?php echo $additional->comments; ?></strong>
														</li>
														<?php
													}
													if ( ! empty( $additional->shares ) ) {
														?>
														<li>
															<i class="fa fa-share-alt"></i><strong><?php echo $additional->shares; ?></strong>
														</li>
														<?php
													}
													?>
												</ul>
											</div>
											
											<div class="clr">&nbsp;</div>
											
											<div class="bottom" onclick="clickToShow('<?php echo $item->post_id; ?>', <?php echo trim($it['cat_id']); ?>);return false;">
												<div class="shop">
													<a href="<?php echo $item->user_link; ?>" class="img" target="_blank">
														<img src="<?php echo $item->user_pic; ?>" alt="<?php echo $item->user_screenname; ?>">
													</a>
													<div class="shortInfo">
														<a href="<?php echo $item->user_link; ?>" target="_blank"><?php echo $item->user_screenname; ?></a>
														<p class="date">
															<a href="<?php echo $item->post_permalink; ?>" target="_blank"><?php echo date( 'd/m/Y',
																	$item->post_timestamp ) ?></a></p>
													</div>
													<div class="lf-wishlist">
														<a href="javascript:;" class="wishlist">
															<div class="img-wishlist"></div>
															<span class="count-wishlist"><?php echo $item->wishlist; ?></span> </a>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach;?>
							<?php endif;?>

						</main><!-- #main -->
					</div>
										
					<div class="pagination-wrap">
						<ul class="pagination" id="pagination-page"></ul>
						<div class="pagination-wrap-more">
							<div class="pagination-text">-- Có tất cả <?php echo ceil(count($arr)/12); ?> trang --</div>
						</div>
					</div>
					<!-- /.pagination -->
				</div>
				<!-- /.box-body -->
				<script>
					jQuery(document).ready(function(){
						jQuery('#pagination-page').twbsPagination({
							totalPages: <?php echo ceil(count($arr)/12);?>,
							visiblePages: 3,
							startPage: <?php echo $current_page;?>,
							first: '<span class="fa fa-angle-double-left"></span>',
							prev: '<span class="fa fa-angle-left"></span>',
							next: '<span class="fa fa-angle-right"></span>',
							last: '<span class="fa fa-angle-double-right"></span>',
							initiateStartPageClick: false,
							onPageClick: function (event, page) {
								var url = '<?php echo get_permalink();?>'+page+'/';
								window.location = url;
							}
						});
					});
				</script>
			<?php endwhile; // End of the loop.?>
		</div>
		<!-- /.box -->
	</section><!-- #primary -->
<?php get_footer(); ?>
