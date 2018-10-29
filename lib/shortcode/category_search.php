<?php

if ( ! function_exists( 'lf_category_search_template' ) ) {
	
	function lf_category_search_template( $attr, $content ) {
		$title = '';
		ob_start();
		extract( shortcode_atts( array(
			'title' => '',
		), $attr ) );
		?>
        <div class="lf-cate-search">
            <div class="lf-search-form">
                <input type="text" class="lf-input" placeholder="<?php echo $title; ?>">
                <div class="lf-btn-search lf-btn-search-js"></div>
            </div>
        </div>
		<?php
		
		return ob_get_clean();
	}
	
}