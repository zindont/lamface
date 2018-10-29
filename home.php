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
						<div class="col-md-4 col-sm-6 col-xs-12">
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
						<div class="col-md-4 col-sm-6 col-xs-12">
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
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="info-box">
								<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

								<div class="info-box-content">
									<span class="info-box-text text-uppercase">Tổng kịch bản</span>
										<span class="info-box-number">2,000</span>
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
									<?php echo do_shortcode('[lf_category_fanpage id="13" page="5"]'); ?>
								</div>
							</div>
						</div>
            <div class="col-md-3">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Members</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger">8 New Members</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    <li>
                      <img src="dist/img/user1-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Alexander Pierce</a>
                      <span class="users-list-date">Today</span>
                    </li>
                    <li>
                      <img src="dist/img/user8-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Norman</a>
                      <span class="users-list-date">Yesterday</span>
                    </li>
                    <li>
                      <img src="dist/img/user7-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Jane</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                      <img src="dist/img/user6-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">John</a>
                      <span class="users-list-date">12 Jan</span>
                    </li>
                    <li>
                      <img src="dist/img/user2-160x160.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Alexander</a>
                      <span class="users-list-date">13 Jan</span>
                    </li>
                    <li>
                      <img src="dist/img/user5-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Sarah</a>
                      <span class="users-list-date">14 Jan</span>
                    </li>
                    <li>
                      <img src="dist/img/user4-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Nora</a>
                      <span class="users-list-date">15 Jan</span>
                    </li>
                    <li>
                      <img src="dist/img/user3-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Nadia</a>
                      <span class="users-list-date">15 Jan</span>
                    </li>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">View All Users</a>
                </div>
                <!-- /.box-footer -->
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
