<?php

function lf_get_item_post( $data, $cat ) {
	
	if ( is_user_logged_in() ) {
		$fb_meta_custom = get_user_meta( get_current_user_id(), '_fb_meta_custom', true );
		if ( $fb_meta_custom ) {
			$fbArray = unserialize( $fb_meta_custom );
			$meta    = $fbArray[ $cat ];
		} else {
			$meta = array();
		}
		
		$bulkff_meta_page = get_user_meta( get_current_user_id(), '_bulk_page', true );
		if ( $bulkff_meta_page ) {
			$pageArray = unserialize( $bulkff_meta_page );
			$metaPage  = $pageArray[ $cat ];
		} else {
			$metaPage = array();
		}
	}
	
	if ( is_array( $data ) && ! empty( $data ) ) {
		foreach ( $data as $item ) {
			$additional = json_decode( $item['post_additional'] );
			?>
            <div class="item th_laoth <?php echo trim( $item['feed_id'] ); ?>">
                <div class="wrap">
                    <div class="thumb">
						<?php
						if ( $item['media_type'] == "video" ) {
							?>
                            <img src="<?php echo $item['image_url']; ?>" alt="" onclick="clickToShow('<?php echo $item['post_id']; ?>');return false;">
                            <img class='pview_video' src="<?php echo SITE_URL; ?>wp-content/themes/flatsome/bulkff/assets/images/play.png">
							<?php
						} else {
							if ( ! empty( $item['image_url'] ) ) {
								?>
                                <div class="thumb-img">
                                    <img src="<?php echo $item['image_url']; ?>" alt="" onclick="clickToShow('<?php echo $item['post_id']; ?>');return false;">
									<?php
									$medias = explode( ",", $item['medias'] );
									if ( count( $medias ) > 1 ) {
										?>
                                        <div class="bottom_stick">
                                            <div class="slide_bulkff">
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
                                    <img src="/wp-content/themes/flatsome/assets/img/placeholder-image.jpg" alt="" onclick="clickToShow('<?php echo $item['post_id']; ?>');return false;">
                                </div>
								<?php
							}
						}
						?>
                    </div>
					<div class="desc" onclick="clickToShow('<?php echo $item['post_id']; ?>');return false;"><?php echo $item['post_text']; ?></div>
					<div class="clr"></div>
                    <div class="meta-wrap">
                        <ul class="meta">
							<?php
							if ( ! empty( $additional->likes ) ) {
								?>
                                <li>
                                    <i class="lf-icon lf-icon-like"></i><strong><?php echo $additional->likes; ?></strong>
                                </li>
								<?php
							}
							if ( ! empty( $additional->comments ) ) {
								?>
                                <li>
                                    <i class="lf-icon lf-icon-comment"></i><strong><?php echo $additional->comments; ?></strong>
                                </li>
								<?php
							}
							if ( ! empty( $additional->shares ) ) {
								?>
                                <li>
                                    <i class="lf-icon lf-icon-share"></i><strong><?php echo $additional->shares; ?></strong>
                                </li>
								<?php
							}
							?>
                        </ul>
                        <div class="meta-page">
							<?php
							if ( is_user_logged_in() ) {
								?>
                                <div class="meta-page-save save-post">
                                    <a class="save_ffbb " href="javascript:;" onclick="bulkff_save(this,'<?php echo $item['post_id']; ?>',<?php echo $cat; ?>);return false;">
										<?php echo ( in_array( $item['post_id'],
											$meta ) ) ? "Đã lưu bài viết" : "Lưu bài viết"; ?>
                                    </a>
                                </div>
                                <div class="meta-page-save save-page">
                                    <a class="save_ffbb " href="javascript:;" onclick="bulkff_save_page(this,'<?php echo trim( $item['feed_id'] ); ?>',<?php echo $cat; ?>);return false;">
										<?php echo ( in_array( $item['feed_id'],
											$metaPage ) ) ? "Đã lưu page" : "Lưu page" ?>
                                    </a>
                                </div>
								<?php
							} ?>
                        </div>
                    </div>
                    
                    <div class="bottom" onclick="clickToShow('<?php echo $item['post_id']; ?>');return false;">
                        <div class="ff-shop">
                            <a href="<?php echo $item['user_link']; ?>" class="img" target="_blank">
                                <img src="<?php echo $item['user_pic']; ?>" alt="<?php echo $item['user_screenname']; ?>">
                            </a>
                            <div class="shortInfo">
                                <a href="<?php echo $item['user_link']; ?>" target="_blank"><?php echo $item['user_screenname']; ?></a>
                                <p class="date">
                                    <a href="<?php echo $item['post_permalink']; ?>" target="_blank"><?php echo date( 'd/m/Y',
											$item['post_timestamp'] ) ?></a></p>
                            </div>
                            <div class="lf-wishlist">
                                <a href="javascript:;" class="wishlist">
                                    <div class="img-wishlist"></div>
                                    <span class="count-wishlist"><?php echo $item['wishlist']; ?></span> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php
		}
	}
}

function lf_get_item_post_short( $data, $cat ) {
	
	if ( is_user_logged_in() ) {
		$fb_meta_custom = get_user_meta( get_current_user_id(), '_fb_meta_custom', true );
		if ( $fb_meta_custom ) {
			$fbArray = unserialize( $fb_meta_custom );
			$meta    = $fbArray[ $cat ];
		} else {
			$meta = array();
		}
		
		$bulkff_meta_page = get_user_meta( get_current_user_id(), '_bulk_page', true );
		if ( $bulkff_meta_page ) {
			$pageArray = unserialize( $bulkff_meta_page );
			$metaPage  = $pageArray[ $cat ];
		} else {
			$metaPage = array();
		}
	}
	
	if ( is_array( $data ) && ! empty( $data ) ) {
		foreach ( $data as $item ) {
			$additional = json_decode( $item['post_additional'] );
			?>
            <div class="item-featured" id="<?php echo trim( $item['post_id'] ); ?>">
                <div class="wrap">
                    <div class="avatar">
						<?php
						if ( $item['media_type'] == "video" ) {
							?>
                            <img src="<?php echo $item['image_url']; ?>" alt="" onclick="clickToShow('<?php echo $item['post_id']; ?>');return false;">
                            <img class='pview_video' src="<?php echo SITE_URL; ?>wp-content/themes/flatsome/bulkff/assets/images/play.png">
							<?php
						} else {
							if ( ! empty( $item['image_url'] ) ) {
								?>
                                <div class="thumb-img">
                                    <img src="<?php echo $item['image_url']; ?>" alt="" onclick="clickToShow('<?php echo $item['post_id']; ?>');return false;">
									<?php
									$medias = explode( ",", $item['medias'] );
									if ( count( $medias ) > 1 ) {
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
                                    <img src="/wp-content/themes/flatsome/assets/img/placeholder-image.jpg" alt="" onclick="clickToShow('<?php echo $item['post_id']; ?>');return false;">
                                </div>
								<?php
							}
						}
						?>
                    </div>
					<div class="desc" onclick="clickToShow('<?php echo $item['post_id']; ?>');return false;">
						<?php echo $item['post_text']; ?>						
					</div>
					<div class="click-expanding" onclick="javascript:descExpanding('<?php echo $item['post_id']; ?>')">
						<div class="breaker"></div>
						<div class="inner"><i class="fa fa-plus"></i> Mở rộng</div>
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
                        <div class="meta-page">
							<?php
							if ( is_user_logged_in() ) {
								?>
                                <div class="meta-page-save save-post">
                                    <a class="save_ffbb " href="javascript:;" onclick="bulkff_save(this,'<?php echo $item['post_id']; ?>',<?php echo $cat; ?>);return false;">
										<?php echo ( in_array( $item['post_id'],
											$meta ) ) ? "Đã lưu bài viết" : "Lưu bài viết"; ?>
                                    </a>
                                </div>
                                <div class="meta-page-save save-page">
                                    <a class="save_ffbb " href="javascript:;" onclick="bulkff_save_page(this,'<?php echo trim( $item['feed_id'] ); ?>',<?php echo $cat; ?>);return false;">
										<?php echo ( in_array( $item['feed_id'],
											$metaPage ) ) ? "Đã lưu page" : "Lưu page" ?>
                                    </a>
                                </div>
								<?php
							} ?>
                        </div>
                    </div>
                    <div class="clr">&nbsp;</div>
                    <div class="bottom" onclick="clickToShow('<?php echo $item['post_id']; ?>');return false;">
                        <div class="shop">
                            <a href="<?php echo $item['user_link']; ?>" class="img" target="_blank">
                                <img src="<?php echo $item['user_pic']; ?>" alt="<?php echo $item['user_screenname']; ?>">
                            </a>
                            <div class="shortInfo">
                                <a href="<?php echo $item['user_link']; ?>" target="_blank"><?php echo wp_trim_words($item['user_screenname'], 10, '...'); ?></a>
                                <p class="date">
                                    <a href="<?php echo $item['post_permalink']; ?>" target="_blank"><?php echo date( 'd/m/Y',
											$item['post_timestamp'] ) ?></a></p>
                            </div>
                            <div class="wishlist">
                                <a href="javascript:;" class="wishlist">
									<i class="fa fa-heart"></i><span class="count-wishlist"><?php echo $item['wishlist']; ?></span> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php
		}
	}
}


function lf_render_more_item( $data ) {	
	
	if ( is_array( $data ) && ! empty( $data ) ) {
		foreach ( $data as $item ) {
			$additional = json_decode( $item['post_additional'] );
			?>
            <div class="item-featured" id="<?php echo trim( $item['post_id'] ); ?>">
                <div class="wrap">
                    <div class="avatar">
						<?php
						if ( $item['media_type'] == "video" ) {
							?>
                            <img src="<?php echo $item['image_url']; ?>" alt="" onclick="clickToShow('<?php echo $item['post_id']; ?>');return false;">
                            <img class='pview_video' src="<?php echo SITE_URL; ?>wp-content/themes/flatsome/bulkff/assets/images/play.png">
							<?php
						} else {
							if ( ! empty( $item['image_url'] ) ) {
								?>
                                <div class="thumb-img">
                                    <img src="<?php echo $item['image_url']; ?>" alt="" onclick="clickToShow('<?php echo $item['post_id']; ?>');return false;">
									<?php
									$medias = explode( ",", $item['medias'] );
									if ( count( $medias ) > 1 ) {
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
                                    <img src="/wp-content/themes/flatsome/assets/img/placeholder-image.jpg" alt="" onclick="clickToShow('<?php echo $item['post_id']; ?>');return false;">
                                </div>
								<?php
							}
						}
						?>
                    </div>
					<div class="desc" onclick="clickToShow('<?php echo $item['post_id']; ?>');return false;">
						<?php echo $item['post_text']; ?>						
					</div>
					<div class="click-expanding" onclick="javascript:descExpanding('<?php echo $item['post_id']; ?>')">
						<div class="breaker"></div>
						<div class="inner"><i class="fa fa-plus"></i> Mở rộng</div>
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
                        <div class="meta-page">
							<?php
							if ( is_user_logged_in() ) {
								?>
                                <div class="meta-page-save save-post">
                                    <a class="save_ffbb " href="javascript:;" onclick="bulkff_save(this,'<?php echo $item['post_id']; ?>',<?php echo $cat; ?>);return false;">
										<?php echo ( in_array( $item['post_id'],
											$meta ) ) ? "Đã lưu bài viết" : "Lưu bài viết"; ?>
                                    </a>
                                </div>
                                <div class="meta-page-save save-page">
                                    <a class="save_ffbb " href="javascript:;" onclick="bulkff_save_page(this,'<?php echo trim( $item['feed_id'] ); ?>',<?php echo $cat; ?>);return false;">
										<?php echo ( in_array( $item['feed_id'],
											$metaPage ) ) ? "Đã lưu page" : "Lưu page" ?>
                                    </a>
                                </div>
								<?php
							} ?>
                        </div>
                    </div>
                    <div class="clr">&nbsp;</div>
                    <div class="bottom" onclick="clickToShow('<?php echo $item['post_id']; ?>');return false;">
                        <div class="shop">
                            <a href="<?php echo $item['user_link']; ?>" class="img" target="_blank">
                                <img src="<?php echo $item['user_pic']; ?>" alt="<?php echo $item['user_screenname']; ?>">
                            </a>
                            <div class="shortInfo">
                                <a href="<?php echo $item['user_link']; ?>" target="_blank"><?php echo wp_trim_words($item['user_screenname'], 10, '...'); ?></a>
                                <p class="date">
                                    <a href="<?php echo $item['post_permalink']; ?>" target="_blank"><?php echo date( 'd/m/Y',
											$item['post_timestamp'] ) ?></a></p>
                            </div>
                            <div class="wishlist">
                                <a href="javascript:;" class="wishlist">
									<i class="fa fa-heart"></i><span class="count-wishlist"><?php echo $item['wishlist']; ?></span> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php
		}
	}
}