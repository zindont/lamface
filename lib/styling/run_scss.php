<?php
if (!class_exists('WP_Filesystem')) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
}

WP_Filesystem();

if (!class_exists('scssc')) {
    require_once('scss.php');
}
require_once('static.php');
