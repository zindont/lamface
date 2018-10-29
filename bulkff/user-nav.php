<?php
    //Kiểm tra bộ lọc
    $boloc = "";
    $nav = $_POST["nav"];
    $p_key = $key = $_POST["key"];
    $p_suget = $suget = $_POST["suget"];
    $p_like = $like = $_POST["like"];
    $p_comment = $comment = $_POST["comment"];
    $p_share = $share = $_POST["share"];
    $p_daterange = $daterange = $_POST["daterange"];
    if($key != ""){
        switch ($suget) {
            case "post_header":
                $boloc.=" AND post_header LIKE '%$key%'";
                break;
            case "user_screenname":
                $boloc.=" AND user_screenname LIKE '%$key%'";
                break;
            case "post_text":
                $boloc.=" AND post_text LIKE '%$key%'";
                break;
            default:
                $boloc.=" AND (post_header LIKE '%$key%' OR user_screenname LIKE '%$key%' OR post_text LIKE '%$key%')";
        }
    }
    if($like != ""){
        $like = bulkff_explode($like);
        $like_1 = $like[0];$like_2 = $like[1];
        $boloc.=" AND JSON_EXTRACT(post_additional,'$.likes') BETWEEN $like_1 AND $like_2";
    }
    if($comment != ""){
        $comment = bulkff_explode($comment);
        $comment_1 = $comment[0];$comment_2 = $comment[1];
        $boloc.=" AND JSON_EXTRACT(post_additional,'$.comments') BETWEEN $comment_1 AND $comment_2";
    }
    if($share != ""){
        $share = bulkff_explode($share);
        $share_1 = $share[0];$share_2 = $share[1];
        $boloc.=" AND JSON_EXTRACT(post_additional,'$.shares') BETWEEN $share_1 AND $share_2";
    }
    if($daterange != ""){
        $date = bulkff_explode(str_replace(" ","",$daterange));
        $date_1 = explode("/",$date[0]);
        $date_2 = explode("/",$date[1]);
        $date_1 = strtotime($date_1[2]."/".$date_1[1]."/".$date_1[0]);
        $date_2 = strtotime($date_2[2]."/".$date_2[1]."/".$date_2[0]);
        $boloc.=" AND post_timestamp BETWEEN $date_1 AND $date_2";
    }
    //end
    global $wpdb;global $current_user;
    //Khai báo biến
    $number_item = POST_NUMBER;
    $table_name_post = TABLE_POST;
    //$table_name_stream = "ltt_ff_streams";
    $table_name_stream_data = TABLE_STREAM_DATA;
    $main = "";
    $meta = $cat_list = array();
    //end
    $uid = $current_user->ID;
    $bulkff_meta = get_user_meta( $uid, "_fb_meta_custom",true);
    if($bulkff_meta){
        $meta = str_replace(array("[","]",'"'),"",$bulkff_meta);
        $meta = explode(",",$meta);
    }
    $in = "'".implode("','",$meta)."'";
    

    $first = ($nav-1)*$number_item;
    $datas = $wpdb->get_results("SELECT * FROM $table_name_post WHERE post_id IN ($in) $boloc LIMIT $first,$number_item",OBJECT);
    if($datas && count($datas) > 0){
        bulkff_show_item($datas);
    }
?>