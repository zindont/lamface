<script type="text/javascript" src="<?php echo BULKFF_ASSETS; ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo BULKFF_ASSETS; ?>/js/jquery.twbsPagination.min.js"></script>
<script type="text/javascript" src="<?php echo BULKFF_ASSETS; ?>/js/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BULKFF_ASSETS; ?>/css/daterangepicker.css">
<script src="<?php echo BULKFF_ASSETS; ?>/js/isotope.pkgd.min.js"></script>

<?php
    global $wpdb;
    $id   = get_query_var( 'fanpages_id', 1 );
    $tags = bulkff_tags( $id ); //var_dump($tags); 

?>

<div class="clr h20">&nbsp;</div>

<div class="filter-zone">
    <form id="bulkff_form" class='bulkff_form'>
        <div class="below">
            <div class="filter-label fl mr5 mt10">BỘ LỌC</div>
            <div class="filter-text fl mr5">
                <input id="keywords" type="text" placeholder="Từ khóa" />
            </div>
            <div class="filter-select fl mr5">
                <select id="searh-type" style="width: 100px">
                    <option value="">Lọc theo</option>
                    <option value="data-title">Tiêu đề</option>
                    <option value="data-facebook-name">Tên facebook</option>
                    <option value="data-content">Nội dung</option>
                </select>
            </div>
            <div class="filter-select fl mr5">
                <select class="likes" name="likes" style="width: 70px">
                    <option value="">Like</option>
                    <option value="0-20">&lt; 20</option>
                    <option value="21-50">21- 50</option>
                    <option value="50-100">50 - 100</option>
                    <option value="100-300">100 - 300</option>
                    <option value="300-1000">300 - 1000</option>
                    <option value="1000-10000000">&gt; 1000</option>
                </select>
            </div>
            <div class="filter-select fl mr5">
                <select class="comments" name="comments">
                    <option value="">Comment</option>
                    <option value="0-20">&lt; 20</option>
                    <option value="21-50">21- 50</option>
                    <option value="50-100">50 - 100</option>
                    <option value="100-300">100 - 300</option>
                    <option value="300-1000">300 - 1000</option>
                    <option value="1000-10000000">&gt; 1000</option>
                </select>
            </div>
            <div class="filter-select fl mr5">
                <select class="small" name="share">
                    <option value="">Share</option>
                    <option value="0-20">&lt; 20</option>
                    <option value="21-50">21- 50</option>
                    <option value="50-100">50 - 100</option>
                    <option value="100-300">100 - 300</option>
                    <option value="300-1000">300 - 1000</option>
                    <option value="1000-10000000">&gt; 1000</option>
                </select>
            </div>
            <div class="filter-text fl mr5">
                <input id="date" type="text" placeholder="Date" />
            </div>
            <div class="filter-submit fl mr5">
                <input type="button" class="bulkff_form_submit" value="Lọc" id="submit-form" />
            </div>
            <div class="clr"></div>
        </div>
        <div class="after mt5">
            <div class="filter-select fl mr5">
                <select name="tags_search" id="tags-search" class="order-class">
                    <option value="""> Xếp sản phẩm</option>
                    <option value="Áo nỉ">• Áo nỉ</option>
                    <option value="Áo len">• Áo len</option>
                    <option value="Áo lạnh">• Áo lạnh</option>
                </select>
            </div>
            <div class="filter-select fl mr5">
                <select name="likes_count" id="likes-count" class="order-class">
                    <option value=""> Xếp like</option>
                    <option value="1">• Tăng dần</option>
                    <option value="2">• Giảm dần</option>
                    <option value="3">• Ngẫu nhiên</option>
                </select>
            </div>
            <div class="filter-select fl mr5">
                <select name="comments_count" id="comments-count" class="order-class">
                    <option value=""> Xếp comment</option>
                    <option value="1">• Tăng dần</option>
                    <option value="2">• Giảm dần</option>
                    <option value="3">• Ngẫu nhiên</option>
                </select>
            </div>
            <div class="filter-select fl mr5">
                <select name="shares_count" id="share-count" class="order-class">
                    <option value=""> Xếp share</option>
                    <option value="1">• Tăng dần</option>
                    <option value="2">• Giảm dần</option>
                    <option value="3">• Ngẫu nhiên</option>
                </select>
            </div>
            <div class="filter-select fl mr5">
                <select name="words_count" id="words-count" class="order-class">
                    <option value=""> Số từ</option>
                    <option value="1">• &lt; 20</option>
                    <option value="2">• 20 - 50</option>
                    <option value="3">• 50 - 100</option>
                    <option value="4">• 100 - 200</option>
                    <option value="5">• &gt; 200</option>
                </select>
            </div>
            <div class="filter-select fl mr5">
                <select name="interactions_count" id="interactions-count" class="order-class">
                    <option value=""> Tương tác</option>
                    <option value="1">• Lưu nhiều nhất</option>
                    <option value="2">• Xem nhiều nhất</option>
                </select>
            </div>
            <div class="clr"></div>
            <input type="hidden" name="cat" value="<?= $id ?>" />
            <input type="hidden" name="action" value="loading" />
            <input type="hidden" name="user" value="<?php echo get_current_user_id(); ?>" />
            <input type="hidden" name="feed_id" value="<?php echo ! empty( $_GET['feed_id'] ) ? $_GET['feed_id'] : ''; ?>" />
            <input type="hidden" name="pagination" value="1"> <input type="hidden" name="pagination-page" value="1" />
        </div>
    </form>
</div>