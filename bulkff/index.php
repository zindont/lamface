<?php
//update_user_meta( get_current_user_id(), '_bulk_page', '' );
//update_user_meta( get_current_user_id(), '_fb_meta_custom', '' );
//$post  = get_user_meta( get_current_user_id(), '_fb_meta_custom', true );
//$page  = get_user_meta( get_current_user_id(), '_bulk_page', true );
//echo '<pre>';print_r( unserialize($post) );echo '</pre>';
?>
<script type="text/javascript" src="<?php echo BULKFF_ASSETS; ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo BULKFF_ASSETS; ?>/js/jquery.twbsPagination.min.js"></script>
<script type="text/javascript" src="<?php echo BULKFF_ASSETS; ?>/js/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BULKFF_ASSETS; ?>/css/daterangepicker.css">
<script src="<?php echo BULKFF_ASSETS; ?>/js/isotope.pkgd.min.js"></script>

<?php $id 	= $args['id']; ?>
<?php $tags = bulkff_tags($id); //var_dump($tags); ?>
<form id="bulkff_form" class='bulkff_form'>
    <div class='container'>
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
        <input type="hidden" name="cat" value="<?php echo $args['id']; ?>">
        <input type="hidden" name="action" value="loading">
        <input type="hidden" name="user" value="<?php echo get_current_user_id(); ?>">
        <input type="hidden" name="feed_id" value="<?php echo ! empty( $_GET['feed_id'] ) ? $_GET['feed_id'] : ''; ?>">
        <input type="hidden" name="pagination" value="1"> <input type="hidden" name="pagination-page" value="1">
        <button type="submit" class="bulkff_form_submit">Lọc</button>
		
		<div class="clr"></div>

		<select name="tags_search" style="width:185px" class="order-class">
			<option value="0">&#xf015; Xếp theo sản phẩm</option>
			<?php foreach ($tags as $row) : ?>
				<option value="<?= $row->tag ?>">• <?= $row->tag ?></option>
			<?php endforeach; ?>
        </select>
		
        <select name="likes_count" style="width:120px" class="order-class">
			<option value="0">&#xf164; Xếp theo like</option>
            <option value="1">• Like tăng dần</option>
            <option value="2">• Like giảm dần</option>
            <option value="3">• Ngẫu nhiên</option>
        </select>
		
		<select name="comments_count" style="width:160px" class="order-class">
			<option value="0">&#xf075; Xếp theo comment</option>
            <option value="1">• Bình luận tăng dần</option>
            <option value="2">• Bình luận giảm dần</option>
            <option value="3">• Ngẫu nhiên</option>
        </select>
		
		<select name="shares_count" style="width:140px" class="order-class">
			<option value="0">&#xf064; Xếp theo share</option>
            <option value="1">• Shares tăng dần</option>
            <option value="2">• Shares giảm dần</option>
            <option value="3">• Ngẫu nhiên</option>
        </select>
		
		<select name="words_count" style="width:125px" class="order-class">
			<option value="0">&#xf15c; Số từ content</option>
            <option value="1">• < 20</option>
            <option value="2">• 20 - 50</option>
            <option value="3">• 50 - 100</option>
			<option value="4">• 100 - 200</option>
			<option value="5">• > 200</option>
        </select>
		
		<select name="interactions_count" style="width:160px" class="order-class">
			<option value="0">&#xf0c0; Xếp theo tương tác</option>
            <option value="1">• Được lưu nhiều nhất</option>
            <option value="2">• Được xem nhiều nhất</option>
        </select>
    </div>
    <div id='bulkff_content'>
    
    </div>
</form>
<script>
	jQuery(".order-class").change(function (e) {
		jQuery(".bulkff_form_submit").click();
	});
</script>