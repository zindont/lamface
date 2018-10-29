<link rel="stylesheet" type="text/css" href="<?php echo BULKFF_ASSETS;?>/css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo BULKFF_ASSETS;?>/css/style.css?v=3">
<script type="text/javascript" src="<?php echo BULKFF_ASSETS;?>/js/moment.min.js"></script>
<script type="text/javascript" src="<?php echo BULKFF_ASSETS;?>/js/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo BULKFF_ASSETS;?>/js/owl.carousel.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BULKFF_ASSETS;?>/css/daterangepicker.css">
<script src="<?php echo BULKFF_ASSETS;?>/js/isotope.pkgd.min.js"></script>
<script src="<?php echo BULKFF_ASSETS;?>/js/script.js?v=1"></script>
<div class='container'>
    <form id="bulkff_form_user" class='bulkff_form'>
        <input type="text" name="key" placeholder="Từ khóa">
        <select class='small' name="suget">
            <option value="">Lọc theo</option>
            <option value="post_header">Tiêu đề</option>
            <option value="user_screenname">Tên facebook</option>
            <option value="post_text">Nội dung</option>
        </select>
        <select class='small' name="like">
            <option value="">Like</option>
            <option value="0-20">< 20</option>
			<option value="21-50">21- 50</option>
			<option value="50-100">50 - 100</option>			
            <option value="100-300">100 - 300</option>
            <option value="300-1000">300 - 1000</option>
            <option value="1000-10000000">> 1000</option>
        </select>
        <select class='small' name="comment">
            <option value="">Comment</option>
            <option value="0-20">< 20</option>
			<option value="21-50">21- 50</option>
			<option value="50-100">50 - 100</option>			
            <option value="100-300">100 - 300</option>
            <option value="300-1000">300 - 1000</option>
            <option value="1000-10000000">> 1000</option>
        </select>
        <select class='small' name="share">
            <option value="">Share</option>
            <option value="0-20">< 20</option>
			<option value="21-50">21- 50</option>
			<option value="50-100">50 - 100</option>			
            <option value="100-300">100 - 300</option>
            <option value="300-1000">300 - 1000</option>
            <option value="1000-10000000">> 1000</option>
        </select>
        <input type="text" value="" name="daterange" placeholder="Date">
        <button type="submit">Lọc</button>
    </form>
</div>
<div id='bulkff_content'>
    <?php
        global $wpdb;
        global $current_user;
        //Khai báo biến
        $number_item = POST_NUMBER;
        $table_name_post = TABLE_POST;
        //$table_name_stream = "ltt_ff_streams";
        $table_name_stream_data = TABLE_STREAM_DATA;
        $boloc = $main = $meta = $list_page = "";
        $cat_list = array();
        //end
        $uid = $current_user->ID;
        $bulkff_meta = get_user_meta( $uid, "_fb_meta_custom",true);
        if($bulkff_meta){
            $meta = str_replace(array("[","]",'"'),"",$bulkff_meta);
            $meta = explode(",",$meta);
        }
        $in = "'".implode("','",$meta)."'";
        $total = $wpdb->get_var("SELECT COUNT(*) FROM $table_name_post WHERE post_id IN ($in)");
        $datas = $wpdb->get_results("SELECT * FROM $table_name_post WHERE post_id IN ($in) LIMIT 0,$number_item",OBJECT);
        //Lấy tất cả fanpage
        if($datas && count($datas) > 0){
            foreach ($datas as $item) {
                if (!in_array($item->feed_id, $cat_list)){
                    array_push($cat_list,$item->feed_id);
                    ob_start();
                    ?>
                    <div class="ff-shop">
                        <a target="_blank" href="<?php echo $item->user_link;?>" class="img" target="_blank">
                            <img src="<?php echo $item->user_pic;?>" alt="<?php echo $item->user_screenname;?>">
                        </a>
                        <div class="shortInfo">
                            <a target="_blank" href="<?php echo $item->user_link;?>" target="_blank"><?php echo $item->user_screenname;?></a>
                        </div>
                    </div>
                    <?php
                    $html = ob_get_clean();
                    $list_page.=$html;
                }
            }
            ob_start();
            bulkff_show_item($datas);
            $main = ob_get_clean();
        }
        //kết thúc
    ?>
    <div class="row row_full">
        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 w_75">
            <div id="bulkff-content">
                <div class='bulkff-list'>
                    <?php echo $main;?>
                </div>
                <?php
                    if($total > $number_item){
                        $count_nav = $total/$number_item;
                        if($total%$number_item!=0) $count_nav++;
                        ?>
                        <div class='bulkff_nav'>
                            <select class='bulkff_select' 
                                onchange="bulkff_navuser_change(this);" 
                                data-key="" 
                                data-suget="" 
                                data-like="" 
                                data-comment="" 
                                data-share="" 
                                data-daterange="">
                            <?php
                                for ($i=1; $i <= $count_nav; $i++) {
                                    ?>
                                    <option><?php echo $i;?></option>
                                    <?php
                                }
                            ?>
                            </select>
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 w_25">
            <div class='bulkff_cats'>
                <h3 class='bulkff_tabs'>
                    <a class="bulkff_tab active" data-id="tab1">Page đã lưu</a>
                </h3>
                <div id="tab1" class='blukff_tab_content active blukff_tab_content2'>
                    <?php get_page_save();?>
                </div>
            </div>
        </div>
    </div>
    <script>isotope_action();</script>
</div>