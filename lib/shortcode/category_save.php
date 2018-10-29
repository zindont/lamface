<?php

if ( ! function_exists( 'lf_category_save_template' ) ) {
	
	function lf_category_save_template( $attr, $content ) {
		$page = $id = $title = '';
		ob_start();
		extract( shortcode_atts( array(
			'title' => '',
			'id'    => '',
			'page'  => '16',
			'zone'	=> 'most-save-zone'
		), $attr ) );
		if ( empty( $id ) ) {
			return false;
		}
		
		global $wpdb;
		$data = $wpdb->get_results( "SELECT * FROM ( SELECT * FROM `ltt_ff_posts_$id`  ORDER BY rand() LIMIT 0,{$page} ) q ORDER BY `ff_posts_id` DESC",
			ARRAY_A );
		?>
        <div class="homepage-normal-zone-header"><i>&nbsp;</i><?= $title ?></div>
        <div class="<?= $zone ?> owl-carousel owl-theme">            
			<?php lf_get_item_post_short( $data, $id ); ?>
		</div>
		<script>
		jQuery('.<?= $zone ?>').owlCarousel({
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
					items:3
				}
			},
			navigation : true,
			navigationText : ['<span class="fa-stack"><i class="fa fa-circle fa-stack-1x"></i><i class="fa fa-chevron-circle-left fa-stack-1x fa-inverse"></i></span>','<span class="fa-stack"><i class="fa fa-circle fa-stack-1x"></i><i class="fa fa-chevron-circle-right fa-stack-1x fa-inverse"></i></span>'],
		});
		jQuery('.<?= $zone ?> .slider .owl-carousel').owlCarousel({
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
		<?php
		return ob_get_clean();
	}
	
}