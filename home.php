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
 * @author info@zindo.info
 */

get_header();

$user_id = get_current_user_id();
global $wpdb;
$table_post = 'ltt_ff_posts_';
$table_cat = 'ltt_ff_cate';
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="content-header">
		      <h1>
		        <?php _e( 'Ứng dụng tạo content đỉnh cao', 'codestar_lamface' ) ?>
		        <small>Phiên bản <?php echo wp_get_theme()->get( 'Version' ); ?></small>
		      </h1>
		      <?php do_action( 'codestar_breadcrumbs' ) ?>
		    </section>

		    <section class="content">
					<div class="row">
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

								<div class="info-box-content">
										<span class="info-box-text text-uppercase">Tổng content</span>
									<span class="info-box-number"><?php echo Codestar_Lamface_Base::codestar_get_total_posts();?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

								<div class="info-box-content">
										<span class="info-box-text text-uppercase">Tổng fanpage</span>
									<span class="info-box-number"><?php echo Codestar_Lamface_Base::codestar_get_total_fanpages();?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text text-uppercase">Tổng kịch bản</span>
										<span class="info-box-number">2,000</span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text text-uppercase">Tổng người dùng</span>
										<span class="info-box-number"><?php $count_users = count_users(); echo number_format_i18n($count_users['total_users']);?></span>
								</div>
								<!-- /.info-box-content -->
							</div>
							<!-- /.info-box -->
						</div>
						<!-- /.col -->
					</div>

					<!-- Home content -->
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header with-border">
									<h3 class="box-title">CONTENT MỚI NHẤT</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
										</button>
										<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
										</button>
									</div>
								</div>
								<div class="box-body">
									<div class="row">
										<div class="col-xs-12 col-md-8">
											<input type="hidden" value="0" name="page" />
											<div class="mansory-grid">
												<div class="grid-sizer"></div>
												<?php echo do_shortcode('[lf_category_post id="13" title="MẪU QUẢNG CÁO MỚI NHẤT" page="3" ]'); ?>
											</div>
										</div>
										<?php if(is_user_logged_in()):?>
											<div class="col-xs-12 col-md-4">
												<p class="text-center">
													<strong>Thống kê của bạn - Gói: Basic </strong>
												</p>
												<!-- Info Boxes Style 2 -->
												<div class="info-box bg-yellow">
													<span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

													<div class="info-box-content">
														<span class="info-box-text">FANPAGE ĐÃ LƯU</span>
														<span class="info-box-number"><?php $total_saved_fanpages = Codestar_Lamface_Base::codestar_get_total_saved_pages($user_id); echo $total_saved_fanpages;?></span>

														<div class="progress">
															<div class="progress-bar" style="width: <?php echo ($total_saved_fanpages*100/50); ?>%"></div>
														</div>
														<span class="progress-description">
															Trong tổng số 50 trang
														</span>
													</div>
													<!-- /.info-box-content -->
												</div>
												<!-- /.info-box -->
												<div class="info-box bg-green">
													<span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

													<div class="info-box-content">
														<span class="info-box-text">CONTENT ĐÃ LƯU</span>
														<span class="info-box-number"><?php $total_saved_posts = Codestar_Lamface_Base::codestar_get_total_saved_posts($user_id); echo $total_saved_posts;?></span>

														<div class="progress">
															<div class="progress-bar" style="width: <?php echo ($total_saved_posts*100/150); ?>%"></div>
														</div>
														<span class="progress-description">
															Trong tổng số 150 bài
														</span>
													</div>
													<!-- /.info-box-content -->
												</div>
												<!-- /.info-box -->
												<div class="info-box bg-red">
													<span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

													<div class="info-box-content">
														<span class="info-box-text">CONTENT ĐÃ TẠO</span>
														<span class="info-box-number">9</span>

														<div class="progress">
															<div class="progress-bar" style="width: <?php echo (9*100/20);?>%"></div>
														</div>
														<span class="progress-description">
															Trong tổng số 20 bài
														</span>
													</div>
													<!-- /.info-box-content -->
												</div>
												<!-- /.info-box -->
												<div class="info-box bg-aqua">
													<span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>

													<div class="info-box-content">
														<span class="info-box-text">FANPAGE NHẬP VÀO HỆ THỐNG</span>
														<span class="info-box-number">5</span>

														<div class="progress">
															<div class="progress-bar" style="width: <?php echo (5*100/20); ?>%"></div>
														</div>
														<span class="progress-description">
															Trong tổng số 20 trang
														</span>
													</div>
													<!-- /.info-box-content -->
												</div>
												<!-- /.info-box -->
												<div class="info-box bg-black disabled">
													<span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>

													<div class="info-box-content">
														<span class="info-box-text">CONTENT ĐÃ BÁN</span>
														<span class="info-box-number">5</span>

														<div class="progress">
															<div class="progress-bar" style="width: <?php echo (5*100/20);?>%"></div>
														</div>
														<span class="progress-description">
															Trong tổng số 20 bài
														</span>
													</div>
													<!-- /.info-box-content -->
												</div>
												<!-- /.info-box -->
											</div>
										<?php endif;?>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 col-md-8">
							<div class="col-xs-12">
								<div class="box box-success">
									<div class="box-header with-border">
											<h3 class="box-title">FANPAGE MỚI NHẤT</h3>
											<div class="box-tools pull-right">
												<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
												</button>
												<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
												</button>
											</div>
									</div>
									<div class="box-body">
										<!-- DoShortcode Fanpage nổi bật -->
										<?php echo do_shortcode('[lf_category_fanpage id="13" page="8"]'); ?>
									</div>

									<div class="box-footer text-center">
										<a href="/danh-sach-fanpage/" class="uppercase">Xem tất cả</a>
									</div>
								</div>
							</div>
							<?php if(is_user_logged_in()):?>
								<div class="col-xs-12 col-md-6">
									<div class="box box-warning">
										<div class="box-header with-border">
												<h3 class="box-title">Fanpage đã lưu</h3>
												<div class="box-tools pull-right">
													<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
													</button>
													<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
													</button>
												</div>
										</div>
										<div class="box-body">
											<!-- DoShortcode Fanpage nổi bật -->
											<?php //echo do_shortcode('[lf_category_fanpage id="13" page="8"]'); ?>
											<?php 
											//get cate list
											$cats = $wpdb->get_results("SELECT * FROM $table_cat");
											$fanPages = $uniqe_fps = $saved_pages_ids = array();
											$total_fanpages = Codestar_Lamface_Base::codestar_get_list_posts_total_in_pages();
											foreach($cats as $cat){
												$table_post_name = $table_post.$cat->cate_id;
												$fps      = $wpdb->get_results( "SELECT DISTINCT feed_id,user_screenname,user_pic,user_link FROM $table_post_name");
												$fanPages = array_merge($fanPages,$fps);
											}
											$bulk_page = get_user_meta($user_id, '_bulk_page');
											$saved_pages = unserialize($bulk_page[0]);
											foreach($saved_pages as $sp){
												foreach($sp as $it){
													$saved_pages_ids[] = $it;
												}
											}
											?>
											<ul class="users-list clearfix">
												<?php $loop = 0;
												foreach($fanPages as $fanPage): 
													if($loop>7) continue;?>
													<?php 
														$feed_id = $fanPage->feed_id;
														$user_screenname = $fanPage->user_screenname;
														$user_pic = $fanPage->user_pic;
														$user_link = $fanPage->user_link;
														if(in_array($feed_id,$uniqe_fps)){
															continue;
														}
														$uniqe_fps[] = $feed_id;
														if(!in_array($feed_id,$saved_pages_ids)){
															continue;
														}
														$loop++;
													?>
													<li>
														<img src="<?php echo $user_pic;?>" alt="<?php echo $user_screenname;?>" width="50px">
														<a class="users-list-name" href="<?php echo $user_link;?>" target="_blank"><?php echo $user_screenname;?></a>
														<span class="users-list-date"><?php echo $total_fanpages[$feed_id];?> Content</span>
													</li>
												<?php endforeach ;?>
											</ul>
											<!-- /.users-list -->
										</div>
										<div class="box-footer text-center">
											<a href="/fanpage-da-luu/" class="uppercase">Xem tất cả</a>
										</div>
									</div>
								</div>
							<?php endif;?>
							<div class="col-xs-12 col-md-6">
								<div class="box box-danger">
									<div class="box-header with-border">
											<h3 class="box-title">Fanpage đưa vào hệ thống</h3>
											<div class="box-tools pull-right">
												<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
												</button>
												<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
												</button>
											</div>
									</div>
									<div class="box-body">
										<!-- DoShortcode Fanpage nổi bật -->
										<?php echo do_shortcode('[lf_category_fanpage id="13" page="8"]'); ?>
									</div>
									<div class="box-footer text-center">
										<a href="/danh-sach-fanpage/" class="uppercase">Xem tất cả</a>
									</div>
								</div>
							</div>
						</div>
            			<div class="col-xs-12 col-md-4">
							<!-- USERS LIST -->
							<div class="col-xs-12">
								<div class="box box-danger">
									<div class="box-header with-border">
										<h3 class="box-title">Thành viên mới nhất</h3>

										<div class="box-tools pull-right">
											<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
											</button>
											<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
											</button>
										</div>
									</div>
									<!-- /.box-header -->
									<div class="box-body no-padding">
										<ul class="users-list clearfix">
											<?php 
												$users = get_users(array('orderby'=>'ID','order'=>'DESC'));
												foreach($users as $user):
											?>
												<li>
													<img src="<?php echo get_avatar_url($user->ID);?>" alt="<?php echo $user->display_name;?>?>">
													<a class="users-list-name" href="#"><?php echo $user->display_name;?></a>
													<span class="users-list-date"><?php printf( __('Thành viên từ %s ', 'codestar_lamface'), 
													date( 
															"d/m/Y", 
															strtotime( $current_user->get('user_registered') ) 
													)
											) ?></span>
												</li>
											<?php endforeach;?>
										</ul>
										<!-- /.users-list -->
									</div>
									<!-- /.box-body -->
								</div>
							</div>
							<div class="col-xs-12">
								<!-- Codestar_Lamface: Nhật ký hệ thống -->
								<?php the_widget( 
										'Codestar_Lamface_System_Histories_Widgets', 
										array( 
											'title' => 'Nhật ký hệ thống',
											'numOfRows' => 3
										)
									); ?>
							</div>
							<!--/.box -->
						</div>
					</div>

					<?php if(is_user_logged_in()):?>
						<div class="row">
							<div class="col-xs-12">
								<div class="box">
									<div class="box-header with-border">
										<h3 class="box-title">Content đã lưu</h3>
										<div class="box-tools pull-right">
											<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
											</button>
											<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
											</button>
										</div>
									</div>
									<div class="box-body">
										<!-- DoShortcode Xem nhiều nhất 24h qua -->
										<?php //echo do_shortcode('[lf_category_view id="13" page="5" zone="most-like-zone"]'); ?>
										<?php 
										$path = $_SERVER['DOCUMENT_ROOT'] . "/tmp/" . $user_id . ".user";
										$arr  = json_decode( file_get_contents( $path ), true );
										if ( count( $arr) == 0 ):
											$arr = array();
										else:?>
											<div class="most-save-zone owl-carousel owl-theme">
												<?php foreach( $arr as $key => $it):
													if($key>12) continue;
													// $additional = json_decode( $item->post_additional'] );
													$result = $wpdb->get_results( 'SELECT * FROM ' . 'ltt_ff_posts_' . trim($it['cat_id']) . ' WHERE post_id = \'' . $it['post_id'] . '\'', OBJECT );
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
											</div>
											<script>
											jQuery('.most-save-zone').owlCarousel({
												loop:true,
												margin:10,
												nav:true,
												responsive: {
													0:{
														items:1
													},
													600:{
														items:2
													},
													1000:{
														items:4
													}
												},
												navigation : true,
												navigationText : ['<span class="fa-stack"><i class="fa fa-circle fa-stack-1x"></i><i class="fa fa-chevron-circle-left fa-stack-1x fa-inverse"></i></span>','<span class="fa-stack"><i class="fa fa-circle fa-stack-1x"></i><i class="fa fa-chevron-circle-right fa-stack-1x fa-inverse"></i></span>'],
											});
											jQuery('.most-save-zone .slider .owl-carousel').owlCarousel({
														loop: true,
														margin: 5,
														nav: true,
														responsive: {
															0:{
																items:1
															},
															600:{
																items:3
															},
															1000:{
																items:4
															}
														},
														navigation : true,
														navigationText : ['<span class="fa-stack"><i class="fa fa-circle fa-stack-1x"></i><i class="fa fa-chevron-circle-left fa-stack-1x fa-inverse"></i></span>','<span class="fa-stack"><i class="fa fa-circle fa-stack-1x"></i><i class="fa fa-chevron-circle-right fa-stack-1x fa-inverse"></i></span>'],
													});
											</script>
										<?php endif;?>
									</div>
									<div class="box-footer text-center">
										<a href="/mau-quang-cao-da-luu/" class="uppercase">Xem tất cả</a>
									</div>
								</div>
							</div>
						</div>
					<?php endif;?>
					<script>
						jQuery('.slider .owl-carousel').owlCarousel({
							loop: true,
							margin: 5,
							nav: true,
							responsive: {
								0:{
									items:1
								},
								600:{
									items:3
								},
								1000:{
									items:4
								}
							},
							navigation : true,
							navigationText : ['<span class="fa-stack"><i class="fa fa-circle fa-stack-1x"></i><i class="fa fa-chevron-circle-left fa-stack-1x fa-inverse"></i></span>','<span class="fa-stack"><i class="fa fa-circle fa-stack-1x"></i><i class="fa fa-chevron-circle-right fa-stack-1x fa-inverse"></i></span>'],
						});
					</script>
					<?php /*

					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header with-border">
										<h3 class="box-title">LƯU NHIỀU NHẤT 24H QUA</h3>
										<div class="box-tools pull-right">
											<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
											</button>
											<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
											</button>
										</div>
								</div>
								<div class="box-body">
									<!-- DoShortcode Xem nhiều nhất 24h qua -->
									<?php echo do_shortcode('[lf_category_save id="13" page="5" zone="most-save-zone"]'); ?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header with-border">
										<h3 class="box-title">MỚI CẬP NHẬT</h3>
								</div>
								<div class="box-body">
									<input type="hidden" value="0" name="page" />
									<div class="mansory-grid">
										<div class="grid-sizer"></div>
										<?php echo do_shortcode('[lf_category_post id="13" title="MẪU QUẢNG CÁO MỚI NHẤT" page="5" ]'); ?>
								</div>

								<div class="row">
									<div class="col-xs-12 text-center load-more">
										<button type="button" class="btn btn-default btn-lrg ajax" title="Tải thêm"><i class="fa fa-retweet"></i>&nbsp; Tải thêm mẫu tin</button>
									</div> <!-- .load-more -->							
								</div>							
							</div>
						</div>
					</div>
				</div>		*/?>      	
				</section>

		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php get_footer(); ?>
