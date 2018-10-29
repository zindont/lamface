<?php

if ( ! function_exists( 'lf_danhmuc_template' ) ) {
	
	function lf_danhmuc_template( $attr, $content ) {
		$active = $image = $title = $id = '';
		ob_start();
		extract( shortcode_atts( array(
			'image'  => '',
			'id'     => '',
			'title'  => '',
			'active' => 'false',
		), $attr ) );
		
		global $wpdb;
		$idList = explode( ',', $id );
		if ( is_array( $idList ) ) {
			$count = 0;
			$lists = array();
			foreach ( $idList as $item ) {
				$countArray     = $wpdb->get_results( "SELECT COUNT(ff_posts_id) FROM `ltt_ff_posts_$item`",
					ARRAY_A );
				$cateArray      = $wpdb->get_results( "SELECT `cate_id`, `cate_name`,`cate_url` FROM `ltt_ff_cate` WHERE `cate_id` = $item LIMIT 0, 1",
					ARRAY_A );
				$countFormat    = number_format_i18n( array_values( $countArray[0] )[0] );
				$cate_uid		= array_values( $cateArray[0] )[0];
				$nameFormat     = array_values( $cateArray[0] )[1];
				$urlFormat      = array_values( $cateArray[0] )[2];
				$lists[ $item ] = array( $cate_uid, $countFormat, $nameFormat, $urlFormat );
				$count          += $countFormat;
			}
		}
		?>
        <div class="lf-cate-list">
            <div class="lf-cate-header">
                <div class="title"><?php echo $title; ?></div>
                <div class="count">(<?php echo $count; ?>)</div>
                <div class="extends"><i class="fa fa-plus-circle"></i></div>
            </div>
            <div class="lf-cate-body" <?php echo $active == 'true' ? 'style="display: block"' : ''; ?>>
				<?php
				if ( is_array( $lists ) ) {
					foreach ( $lists as $item ) {
						?>
                        <div class="item">
                            <a href="/fanpages/<?= $item[0] ?>" class="">
                                <div class="name">
                                    + <?php echo $item[2]; ?>
                                </div>
                                <div class="count">
                                    (<?php echo $item[1]; ?>)
                                </div>
                            </a>
                        </div>
						<?php
					}
				}
				?>
			</div>
			<div class="clr"></div>
        </div>
		<?php
		
		return ob_get_clean();
	}
	
}