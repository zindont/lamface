<?php
    global $wpdb;
    $feed_id = $_POST["feed_id"];
    //Khai báo biến
    $number_item = POST_NUMBER;
    $table_name_post = TABLE_POST;
    $main = "";
    //end
    $datas = $wpdb->get_results("SELECT * FROM $table_name_post WHERE feed_id = $feed_id LIMIT 0,100000000",OBJECT);
    if($datas && count($datas) > 0){
        ob_start();
        bulkff_show_item($datas);
        $main = ob_get_clean();
    }
?>
<div class='bulkff-list'>
    <?php echo $main;?>
</div>
<script>isotope_action();</script>