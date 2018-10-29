<?php
$shortcodes = array(
	'danhmuc',
	'category_search',
	'category_fanpage',
	'category_post',
	'category_save',
	'category_view',
);

foreach ( $shortcodes as $shortcode ) {
	require $shortcode . '.php';
	add_shortcode( 'lf_' . $shortcode, 'lf_' . $shortcode . '_template' );
}