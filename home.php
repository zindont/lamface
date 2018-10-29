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
										<div class="col-xs-12 col-md-9">
											<input type="hidden" value="0" name="page" />
											<div class="mansory-grid">
												<div class="grid-sizer"></div>
												<?php echo do_shortcode('[lf_category_post id="13" title="MẪU QUẢNG CÁO MỚI NHẤT" page="5" ]'); ?>
											</div>
										</div>
										<div class="col-xs-12 col-md-3">
											<!-- Info Boxes Style 2 -->
											<div class="info-box bg-yellow">
												<span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

												<div class="info-box-content">
													<span class="info-box-text">Inventory</span>
													<span class="info-box-number">5,200</span>

													<div class="progress">
														<div class="progress-bar" style="width: 50%"></div>
													</div>
													<span class="progress-description">
																50% Increase in 30 Days
															</span>
												</div>
												<!-- /.info-box-content -->
											</div>
											<!-- /.info-box -->
											<div class="info-box bg-green">
												<span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

												<div class="info-box-content">
													<span class="info-box-text">Mentions</span>
													<span class="info-box-number">92,050</span>

													<div class="progress">
														<div class="progress-bar" style="width: 20%"></div>
													</div>
													<span class="progress-description">
																20% Increase in 30 Days
															</span>
												</div>
												<!-- /.info-box-content -->
											</div>
											<!-- /.info-box -->
											<div class="info-box bg-red">
												<span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

												<div class="info-box-content">
													<span class="info-box-text">Downloads</span>
													<span class="info-box-number">114,381</span>

													<div class="progress">
														<div class="progress-bar" style="width: 70%"></div>
													</div>
													<span class="progress-description">
																70% Increase in 30 Days
															</span>
												</div>
												<!-- /.info-box-content -->
											</div>
											<!-- /.info-box -->
											<div class="info-box bg-aqua">
												<span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>

												<div class="info-box-content">
													<span class="info-box-text">Direct Messages</span>
													<span class="info-box-number">163,921</span>

													<div class="progress">
														<div class="progress-bar" style="width: 40%"></div>
													</div>
													<span class="progress-description">
																40% Increase in 30 Days
															</span>
												</div>
												<!-- /.info-box-content -->
											</div>
											<!-- /.info-box -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12 col-md-9">
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
								</div>
							</div>
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
													<!-- /.box-body -->
												</div>
									</div>
								</div>
							</div>
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
								</div>
							</div>
						</div>
            <div class="col-md-3">
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
								<div class="box box-success">
									<div class="box-header with-border">
										<h3 class="box-title">Nhật ký hệ thống</h3>

										<div class="box-tools pull-right">
											<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
											</button>
											<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
											</button>
										</div>
									</div>
									<!-- /.box-header -->
									<div class="box-body">
										<!-- Conversations are loaded here -->
										<div class="direct-chat-messages">
											<!-- Message. Default to the left -->
											<div class="direct-chat-msg">
												<div class="direct-chat-info clearfix">
													<span class="direct-chat-name pull-left">Alexander Pierce</span>
													<span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
												</div>
												<!-- /.direct-chat-info -->
												<img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
												<!-- /.direct-chat-img -->
												<div class="direct-chat-text">
													Is this template really for free? That's unbelievable!
												</div>
												<!-- /.direct-chat-text -->
											</div>
											<!-- /.direct-chat-msg -->

											<!-- Message to the right -->
											<div class="direct-chat-msg right">
												<div class="direct-chat-info clearfix">
													<span class="direct-chat-name pull-right">Sarah Bullock</span>
													<span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
												</div>
												<!-- /.direct-chat-info -->
												<img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
												<!-- /.direct-chat-img -->
												<div class="direct-chat-text">
													You better believe it!
												</div>
												<!-- /.direct-chat-text -->
											</div>
											<!-- /.direct-chat-msg -->

											<!-- Message. Default to the left -->
											<div class="direct-chat-msg">
												<div class="direct-chat-info clearfix">
													<span class="direct-chat-name pull-left">Alexander Pierce</span>
													<span class="direct-chat-timestamp pull-right">23 Jan 5:37 pm</span>
												</div>
												<!-- /.direct-chat-info -->
												<img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
												<!-- /.direct-chat-img -->
												<div class="direct-chat-text">
													Working with AdminLTE on a great new app! Wanna join?
												</div>
												<!-- /.direct-chat-text -->
											</div>
											<!-- /.direct-chat-msg -->

											<!-- Message to the right -->
											<div class="direct-chat-msg right">
												<div class="direct-chat-info clearfix">
													<span class="direct-chat-name pull-right">Sarah Bullock</span>
													<span class="direct-chat-timestamp pull-left">23 Jan 6:10 pm</span>
												</div>
												<!-- /.direct-chat-info -->
												<img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
												<!-- /.direct-chat-img -->
												<div class="direct-chat-text">
													I would love to.
												</div>
												<!-- /.direct-chat-text -->
											</div>
											<!-- /.direct-chat-msg -->

										</div>
										<!--/.direct-chat-messages-->

										<!-- Contacts are loaded here -->
										<div class="direct-chat-contacts">
											<ul class="contacts-list">
												<li>
													<a href="#">
														<img class="contacts-list-img" src="dist/img/user1-128x128.jpg" alt="User Image">

														<div class="contacts-list-info">
																	<span class="contacts-list-name">
																		Count Dracula
																		<small class="contacts-list-date pull-right">2/28/2015</small>
																	</span>
															<span class="contacts-list-msg">How have you been? I was...</span>
														</div>
														<!-- /.contacts-list-info -->
													</a>
												</li>
												<!-- End Contact Item -->
												<li>
													<a href="#">
														<img class="contacts-list-img" src="dist/img/user7-128x128.jpg" alt="User Image">

														<div class="contacts-list-info">
																	<span class="contacts-list-name">
																		Sarah Doe
																		<small class="contacts-list-date pull-right">2/23/2015</small>
																	</span>
															<span class="contacts-list-msg">I will be waiting for...</span>
														</div>
														<!-- /.contacts-list-info -->
													</a>
												</li>
												<!-- End Contact Item -->
												<li>
													<a href="#">
														<img class="contacts-list-img" src="dist/img/user3-128x128.jpg" alt="User Image">

														<div class="contacts-list-info">
																	<span class="contacts-list-name">
																		Nadia Jolie
																		<small class="contacts-list-date pull-right">2/20/2015</small>
																	</span>
															<span class="contacts-list-msg">I'll call you back at...</span>
														</div>
														<!-- /.contacts-list-info -->
													</a>
												</li>
												<!-- End Contact Item -->
												<li>
													<a href="#">
														<img class="contacts-list-img" src="dist/img/user5-128x128.jpg" alt="User Image">

														<div class="contacts-list-info">
																	<span class="contacts-list-name">
																		Nora S. Vans
																		<small class="contacts-list-date pull-right">2/10/2015</small>
																	</span>
															<span class="contacts-list-msg">Where is your new...</span>
														</div>
														<!-- /.contacts-list-info -->
													</a>
												</li>
												<!-- End Contact Item -->
												<li>
													<a href="#">
														<img class="contacts-list-img" src="dist/img/user6-128x128.jpg" alt="User Image">

														<div class="contacts-list-info">
																	<span class="contacts-list-name">
																		John K.
																		<small class="contacts-list-date pull-right">1/27/2015</small>
																	</span>
															<span class="contacts-list-msg">Can I take a look at...</span>
														</div>
														<!-- /.contacts-list-info -->
													</a>
												</li>
												<!-- End Contact Item -->
												<li>
													<a href="#">
														<img class="contacts-list-img" src="dist/img/user8-128x128.jpg" alt="User Image">

														<div class="contacts-list-info">
																	<span class="contacts-list-name">
																		Kenneth M.
																		<small class="contacts-list-date pull-right">1/4/2015</small>
																	</span>
															<span class="contacts-list-msg">Never mind I found...</span>
														</div>
														<!-- /.contacts-list-info -->
													</a>
												</li>
												<!-- End Contact Item -->
											</ul>
											<!-- /.contatcts-list -->
										</div>
										<!-- /.direct-chat-pane -->
									</div>
									<!-- /.box-body -->
								</div>
							</div>
              <!--/.box -->
            </div>
					</div>

					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header with-border">
										<h3 class="box-title">XEM NHIỀU NHẤT 24H QUA</h3>
										<div class="box-tools pull-right">
											<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
											</button>
											<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
											</button>
										</div>
								</div>
								<div class="box-body">
									<!-- DoShortcode Xem nhiều nhất 24h qua -->
									<?php echo do_shortcode('[lf_category_view id="13" page="5" zone="most-like-zone"]'); ?>
								</div>
							</div>
						</div>
					</div>

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
					<?php /*
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
