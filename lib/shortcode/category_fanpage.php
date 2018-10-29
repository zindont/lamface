<?php

if ( ! function_exists( 'lf_category_fanpage_template' ) ) {
	
	function lf_category_fanpage_template( $attr, $content ) {
		$page = $id = $title = '';
		ob_start();
		extract( shortcode_atts( array(
			'title' => '',
			'id'    => '',
			'page'  => '',
		), $attr ) );
		if ( empty( $id ) ) {
			return false;
		}
		global $wpdb;
		$data      = $wpdb->get_results( "SELECT DISTINCT feed_id, post_header, user_link  FROM `ltt_ff_posts_$id` ORDER BY `ff_posts_id` DESC LIMIT 0,{$page}",
			ARRAY_A );
		$cateArray = $wpdb->get_results( "SELECT `cate_name`,`cate_url` FROM `ltt_ff_cate` WHERE `cate_id` = {$id}",
			ARRAY_A );
		$urlCate   = array_values( $cateArray[0] )[1];
		
		?>
		
		<?php if (!empty($title)): ?>
	        <div class="content-block-header">
				<?php echo $title; ?>
	        </div>			
		<?php endif ?>

        <div class="top-fanpages owl-carousel owl-theme">
				<?php
				foreach ( $data as $item ) {
					$idFace = explode( '.com/', $item['user_link'] );
					$image  = "http://graph.facebook.com/" . trim( $idFace['1'] ) . "/picture?width=247&height=300";
					if ( ! empty( $urlCate ) ) {
						$fullUrl = site_url() . $urlCate . '?feed_id=' . trim( $idFace['1'] );
					} else {
						$fullUrl = 'javascript:;';
					}
					?>
					<a target="_blank" href="<?php echo $fullUrl; ?>" class="" title="<?php echo $item['post_header']; ?>">
                    <div class="item-fanpage">
                        <div class="avatar">
                            <img src="<?php echo $image; ?>" title="<?php echo $item['post_header']; ?>"/>
                        </div>
						<div class="name"><?php echo $item['post_header']; ?></div>
						<div class="overlay"></div>                  
                    </div>
					</a>
					<?php
				}
				?>
        </div>
		<script>
				jQuery('.top-fanpages').owlCarousel({
					loop:true,
					margin:10,
					nav:true,
					responsive: {
						0:{
							items:1
						},
						600:{
							items:3
						},
						1000:{
							items:5
						}
					},
					navigation : true,
					navigationText : ['<span class="fa-stack"><i class="fa fa-circle fa-stack-1x"></i><i class="fa fa-chevron-circle-left fa-stack-1x fa-inverse"></i></span>','<span class="fa-stack"><i class="fa fa-circle fa-stack-1x"></i><i class="fa fa-chevron-circle-right fa-stack-1x fa-inverse"></i></span>'],
				});
				jQuery(document).ready(function($) {
					$('.top-fanpages').mouseover(function (e) {
						$('.top-fanpages .owl-nav .owl-next, .top-fanpages .owl-nav .owl-prev').attr('style', 'display: inline-block !important');
					});
					$('.top-fanpages').mouseout(function (e) {
						$('.top-fanpages .owl-nav .owl-next, .top-fanpages .owl-nav .owl-prev').attr('style', 'display: none !important');
					});
				});
				</script>
		<?php
		
		return ob_get_clean();
	}
	
}