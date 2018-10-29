<?php
define( 'BULKFF_ASSETS', get_bloginfo( 'stylesheet_directory' ) . "/bulkff/assets" );
define( 'BULKFF_PATH', dirname( __FILE__ ) );
define( 'TABLE_POST', "ltt_ff_posts" );
define( 'TABLE_STREAM_DATA', "ltt_ff_streams_sources" );
define( 'POST_NUMBER', 12 );
//define('TABLE_POST',dirname(__FILE__));
function bulkff_as( $args, $content ) {
	ob_start();
	require_once( BULKFF_PATH . '/index.php' );
	
	return ob_get_clean();
}

add_shortcode( 'bulkff', 'bulkff_as' );

function bulkff_tags($id) {
	//delete_transient('tags');
	$tags = get_transient('tags');
	if (empty($tags)) {
		global $wpdb;
		$tags = $wpdb->get_results( 
			"
				SELECT * 
				FROM ltt_ff_tags
				WHERE cate = $id
			"
		);	
		set_transient('tags', $tags, 600);
	}
	return $tags;
}

add_action( 'wp_head', 'bulkff_ajax' );
function bulkff_ajax() {
	?>
    <script type="text/javascript">
        var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
    </script>
	<?php
}

function bulkff_get_cats( $id_stream ) {
	global $wpdb;
	global $current_user;
	$table_name_post        = TABLE_POST;
	$table_name_stream_data = TABLE_STREAM_DATA;
	$cat_list               = array();
	$list_page              = "";
	$cat_stream             = $wpdb->get_results( "SELECT feed_id FROM $table_name_stream_data WHERE `stream_id` = $id_stream",
		OBJECT );
	if ( is_user_logged_in() ) {
		$bulkff_meta_page = get_user_meta( $current_user->ID, "_bulk_page", true );
		$meta_page        = array();
		if ( $bulkff_meta_page ) {
			$meta_page = str_replace( array( "[", "]", '"' ), "", $bulkff_meta_page );
			$meta_page = explode( ",", $meta_page );
		}
	}
	foreach ( $cat_stream as $item ) {
		$feed_id = $item->feed_id;
		array_push( $cat_list, $feed_id );
		if ( ! isset( $_POST["postdata"] ) ) {
			ob_start();
			$r = $wpdb->get_results( "SELECT feed_id,user_screenname,user_pic,user_link FROM $table_name_post WHERE feed_id = '$feed_id' LIMIT 0,1",
				OBJECT );
			if ( count( $r ) > 0 ) {
				$r = $r[0];
				?>
                <div class="ff-shop">
					<?php
					if ( is_user_logged_in() ) {
						?>
                        <a class="bulkff_save_page" onclick="bulkff_save_page(this,'<?php echo $r->user_link; ?>');return false;">
							<?php
							if ( in_array( $r->user_link, $meta_page ) ) {
								echo "Đã Lưu";
							} else {
								echo "Lưu";
							}
							?>
                        </a>
						<?php
					}
					?>
                    <a target="_blank" href="<?php echo $r->user_link; ?>" class="img get_posts_page" data-id="<?php echo $r->feed_id; ?>">
                        <img src="<?php echo $r->user_pic; ?>" alt="<?php echo $r->user_screenname; ?>"> </a>
                    <div class="shortInfo">
                        <a target="_blank" href="<?php echo $r->user_link; ?>" class="get_posts_page" data-id="<?php echo $r->feed_id; ?>"><?php echo $r->user_screenname; ?></a>
                    </div>
                </div>
				<?php
			}
			$html      = ob_get_clean();
			$list_page .= $html;
		}
	}
	$in = "'" . implode( "','", $cat_list ) . "'";
	
	return json_encode( array( "in" => $in, "list_page" => $list_page ) );
}

//NAV
add_action( 'wp_ajax_bulkff_nav_change', 'bulkff_nav_change' );
add_action( 'wp_ajax_nopriv_bulkff_nav_change', 'bulkff_nav_change' );
function bulkff_nav_change() {
	require_once( BULKFF_PATH . '/nav.php' );
	die();
}

add_action( 'wp_ajax_bulkff_navuser_change', 'bulkff_navuser_change' );
add_action( 'wp_ajax_nopriv_bulkff_navuser_change', 'bulkff_navuser_change' );
function bulkff_navuser_change() {
	require_once( BULKFF_PATH . '/user-nav.php' );
	die();
}

//END NAV


//FORM
add_action( 'wp_ajax_bulkff_form', 'bulkff_form' );
add_action( 'wp_ajax_nopriv_bulkff_form', 'bulkff_form' );
function bulkff_form() {
	require_once( BULKFF_PATH . '/form-action.php' );
	die();
}

add_action( 'wp_ajax_bulkff_form_user', 'bulkff_form_user' );
add_action( 'wp_ajax_nopriv_bulkff_form_user', 'bulkff_form_user' );
function bulkff_form_user() {
	require_once( BULKFF_PATH . '/user-form-action.php' );
	die();
}

//END FORM
//Page
add_action( 'wp_ajax_bulkff_page_get', 'bulkff_page_get' );
add_action( 'wp_ajax_nopriv_bulkff_page_get', 'bulkff_page_get' );
function bulkff_page_get() {
	require_once( BULKFF_PATH . '/page.php' );
	die();
}

//End Page


function bulkff_show_item( $datas ) {
	global $current_user;
	get_currentuserinfo();
	if ( is_user_logged_in() ) {
		$fb_meta_custom = get_user_meta( $current_user->ID, "_fb_meta_custom", true );
		if ( $fb_meta_custom ) {
			$meta = str_replace( array( "[", "]", '"' ), "", $fb_meta_custom );
			$meta = explode( ",", $meta );
		} else {
			$meta = array();
		}
	}
	foreach ( $datas as $item ) {
		$additional = json_decode( $item->post_additional );
		?>
        <div class='item th_laoth'>
            <div class="wrap">
                <h4 class='title_striem'>
                    <a class="save_ffbb <?php echo ( ! is_user_logged_in() ) ? 'none_login' : ''; ?>" href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>" onclick="bulkff_save(this,'<?php echo $item->post_id; ?>');return false;">
						<?php echo ( ! is_user_logged_in() || ! in_array( $item->post_id,
								$meta ) ) ? "Lưu" : "Đã lưu" ?>
                    </a>
					<?php echo $item->post_header; ?>
                </h4>
                <div class="desc" onclick="bulkff_show_item(this,'<?php echo $item->post_id; ?>');return false;"><?php echo $item->post_text; ?></div>
                <div class="thumb">
					<?php
					if ( $item->media_type == "video" ) {
						?>
                        <img src="<?php echo $item->image_url; ?>" alt="" onclick="bulkff_show_item(this,'<?php echo $item->post_id; ?>');return false;">
                        <img class='pview_video' src="<?php echo home_url(); ?>/wp-content/themes/flatsome/bulkff/assets/images/play.png">
						<?php
					} else {
						?>
                        <img src="<?php echo $item->image_url; ?>" alt="" onclick="bulkff_show_item(this,'<?php echo $item->post_id; ?>');return false;">
						<?php
						$medias = explode( ",", $item->medias );
						if ( count( $medias ) > 0 ) {
							?>
                            <div class='bottom_stick'>
                                <div class='slide_bulkff'>
									<?php
									foreach ( $medias as $img ) {
										?>
                                        <a><img aconclick="im_img(this);" src='<?php echo $img; ?>'></a>
										<?php
									}
									?>
                                </div>
                            </div>
							<?php
						}
						?><?php
					}
					?>
                </div>
                <div class="bottom" onclick="bulkff_show_item(this,'<?php echo $item->post_id; ?>');return false;">
                    <div class="ff-shop">
                        <a href="<?php echo $item->user_link; ?>" class="img" target="_blank">
                            <img src="<?php echo $item->user_pic; ?>" alt="<?php echo $item->user_screenname; ?>"> </a>
                        <div class="shortInfo">
                            <a href="<?php echo $item->user_link; ?>" target="_blank"><?php echo $item->user_screenname; ?></a>
                            <p class="date">
                                <a href="<?php echo $item->post_permalink; ?>" target="_blank"><?php echo date( 'd/m/Y',
										$item->post_timestamp ) ?></a></p>
                        </div>
                    </div>
                </div>
                <ul class="meta">
                    <li>
                        <i class="fa fa-heart-o" aria-hidden="true"></i><strong><?php echo $additional->likes; ?></strong>
                    </li>
                    <li>
                        <i class="fa fa-comment-o" aria-hidden="true"></i><strong><?php echo $additional->comments; ?></strong>
                    </li>
                    <li>
                        <i class="fa fa-share" aria-hidden="true"></i><strong><?php echo $additional->shares; ?></strong>
                    </li>
                </ul>
            </div>
        </div>
		<?php
	}
}

function bulkff_explode( $string ) {
	$item = explode( "-", $string );
	
	return $item;
}

add_action( 'wp_ajax_bulkff_quickview', 'bulkff_quickview' );
add_action( 'wp_ajax_nopriv_bulkff_quickview', 'bulkff_quickview' );
function bulkff_quickview() {
	global $wpdb;
	$id              = $_POST["id"];
	$cat             = (int) $_POST["cat"];
	$table_name_post = "ltt_ff_posts_$cat";
	$datas           = $wpdb->get_results( "SELECT * FROM $table_name_post WHERE `post_id` =  '$id' LIMIT 0,1",
		OBJECT );
	$item            = $datas[0];
	$additional      = json_decode( $item->post_additional );
	
	ob_start();
	?>
    <div class='bulkff_show_item'>
        <div class="wrap">
            <h4 class='title_striem'><?php echo $item->post_header; ?></h4><br>
			<?php
			if ( $item->media_type == "video" ) {
				?>
                <iframe width="600" height="338" src="<?php echo str_replace( 'autoplay', "none",
					$item->media_url ); ?>" frameborder="0" allowfullscreen="" webkitallowfullscreen="" mozallowfullscreen="" autoplay="1" wmode="opaque"></iframe>
				<?php
			} else {
				?>
                <div class="thumb thumb_quick_view">
                    <img src="<?php echo $item->media_url; ?>" alt="">
					<?php
					$medias = explode( ",", $item->medias );
					if ( count( $medias ) > 1 ) {
						?>
                        <div class='bottom_stick'>
                            <div class='slide_bulkff_quickview'>
								<?php
								foreach ( $medias as $img ) {
									?>
                                    <a><img onclick="im_img(this);" src='<?php echo $img; ?>'></a>
									<?php
								}
								?>
                            </div>
                        </div>
						<?php
					}
					?>
                </div>
				<?php
			}
			?>
            <br>
            <div class="desc"><?php echo $item->post_text; ?></div>
            <div class="bottom">
                <div class="ff-shop">
                    <a href="<?php echo $item->post_permalink; ?>" class="img" target="_blank">
                        <img src="<?php echo $item->user_pic; ?>" alt="<?php echo $item->user_screenname; ?>"> </a>
                    <div class="shortInfo">
                        <a href="<?php echo $item->post_permalink; ?>" target="_blank"><?php echo $item->user_screenname; ?></a>
                        <p class="date">
                            <a href="<?php echo $item->post_permalink; ?>" target="_blank"><?php echo date( 'd/m/Y',
									$item->post_timestamp ); ?></a></p>
                    </div>
                </div>
            </div>
            <ul class="meta">
                <li><i class="fa fa-heart-o" aria-hidden="true"></i><strong><?php echo $additional->likes; ?></strong>
                </li>
                <li><i class="fa fa-share" aria-hidden="true"></i><strong><?php echo $additional->comments; ?></strong>
                </li>
                <li>
                    <i class="fa fa-comment-o" aria-hidden="true"></i><strong><?php echo $additional->shares; ?></strong>
                </li>
            </ul>
        </div>
    </div>
	<?php
	$html = ob_get_clean();
	echo $html;
	
	$data    = $wpdb->get_results( "SELECT `views` FROM `ltt_ff_posts_$cat` WHERE `post_id` = '{$id}'",
		ARRAY_A );
	$countViews = (int) array_values( $data[0] )[0] + 1;
	$table   = 'ltt_ff_posts_' . $cat;
	$update  = $wpdb->query(
		$wpdb->prepare(
			"UPDATE {$table} SET `views` = %d WHERE `post_id`= '{$id}' LIMIT 1", $countViews )
	);
	die();
}

function showSavePosts() {
	$user_id = get_current_user_id();
	$path = $_SERVER['DOCUMENT_ROOT'] . "/tmp/" . $user_id . ".user";
	$arr  = json_decode( file_get_contents( $path ), true );
	//echo( '<h1>Mẫu quảng cáo đã lưu</h1>' );
	if ( count( $arr) == 0 ) $arr = array();
	else {
		echo( '<table id="saved_posts" cellpadding="10px" cellspacing="0">' );
		echo( '<tr class="header">' );
		echo( '<td>STT</td>' );
		echo( '<td></td>' );
		echo( '<td>Fanpage</td>' );
		echo( '<td>Nội dung</td>' );
		echo( '</tr>' );
		$no = 1; foreach( $arr as $item) {
			global $wpdb; $result = $wpdb->get_results( 'SELECT * FROM ' . 'ltt_ff_posts_' . trim($item['cat_id']) . ' WHERE post_id = \'' . $item['post_id'] . '\'', OBJECT );
			$interactive = json_decode($result[0]->post_additional); 
			//var_dump($result);
			echo( '<tr class="' . ( $no % 2 == 0 ? 'even' : 'odd' ) . '">' );
			echo( '<td>' . $no . '</td>' );
			//echo( '<td><a target="_blank" href="' . str_replace(' ', '', $result[0]->post_permalink) . '"><img src="' . str_replace(' ', '', $result[0]->image_url) . '" width="100px"></a></td>' );
			echo( '<td><a class="avatar-image" target="_blank" href="' . str_replace(' ', '', $result[0]->user_link) . '"><img src="' . str_replace(' ', '', $result[0]->user_pic) . '" /></a></td>' );
			echo( '<td class="fanpage"><a href="' . str_replace(' ', '', $result[0]->user_link) . '">' . $result[0]->user_screenname . '</a><div class="clr h1"></div><i class="fa fa-thumbs-up"></i> ' . $interactive->likes . ' <i class="fa fa-comments"></i> ' . $interactive->comments . ' <i class="fa fa-share-alt"></i> ' . $interactive->shares . ' <i class="fa fa-eye"></i> ' .$result[0]->views . '</td>' );
			echo( '<td><div class="saved-post-body">' . $result[0]->post_text . '</div></td>' );
			echo( '</tr>' );
			$no++;
		}
		echo( '</table>' );
	}
}

add_action( 'wp_ajax_notif', 'get_notif' );
add_action( 'wp_ajax_nopriv_notif', 'get_notif' ); 
function get_notif() {
	global $wpdb; 
	$result_set = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'notifs ORDER BY Uid DESC LIMIT 0, 2', ARRAY_A );
	wp_send_json_success($result_set);
	die();
}

add_action( 'wp_ajax_bulkff_user', 'bulkff_user' );
add_action( 'wp_ajax_nopriv_bulkff_user', 'bulkff_user' );
function bulkff_user() {	
	$user_id     = get_current_user_id();
	$post_id     = $_POST["post_id"];
	$cat         = $_POST["cat"];
	$bulkff_meta = get_user_meta( $user_id, "_fb_meta_custom", true );

	$path = $_SERVER['DOCUMENT_ROOT'] . "/tmp/" . $user_id . ".user";
	$post = new PostModelView();
	$post->setPostId($post_id);
	$post->setCatId($cat);
	
	if ( ! empty( $bulkff_meta ) ) {
		$metaArray = unserialize( $bulkff_meta );
		if ( empty( $metaArray[ $cat ] ) ) {
			$metaArray[ $cat ] = array( $post_id );
			update_user_meta( $user_id, '_fb_meta_custom', serialize( $metaArray ) );
			$key = 2;
		} else {
			$catArray = $metaArray[ $cat ];
			if ( ( $key = array_search( $post_id, $catArray ) ) !== false ) {
				unset( $catArray[ $key ] );
				$metaArray[ $cat ] = $catArray;
				update_user_meta( $user_id, '_fb_meta_custom', serialize( $metaArray ) );
				$key = 1;
				/// #Remove post item from listing post page
				if ( !empty($post_id) ) {	
					$arr  		= json_decode( file_get_contents( $path ), true );
					$tmp_arr 	= array();
					if ( count( $arr ) > 0 ) {
						foreach( $arr as $item ) {
							if ( trim($item['post_id']) != trim($post_id) ) {
								$tmp_post = new PostModelView();
								$tmp_post->setPostId($item['post_id']);
								$tmp_post->setCatId($item['cat_id']);
								array_push( $tmp_arr, $tmp_post );
							}
						}
						file_put_contents($path, json_encode( $tmp_arr ));
					}
				}
				/// #END

			} else {
				array_push( $catArray, $post_id );
				$metaArray[ $cat ] = $catArray;
				update_user_meta( $user_id, '_fb_meta_custom', serialize( $metaArray ) );
				$key = 2;
			}
		}
	} else {
		$data = array(
			$cat => array( $post_id )
		);
		update_user_meta( $user_id, '_fb_meta_custom', serialize( $data ) );
		$key = 2;
	}
	echo $key;
	if ( $key == 2 ) {
		global $wpdb;
		$data    = $wpdb->get_results( "SELECT `wishlist` FROM `ltt_ff_posts_$cat` WHERE `post_id` = '{$post_id}'",
			ARRAY_A );
		$countWL = (int) array_values( $data[0] )[0] + 1;
		$table   = 'ltt_ff_posts_' . $cat;
		$update  = $wpdb->query(
			$wpdb->prepare(
				"UPDATE {$table} SET `wishlist` = %d WHERE `post_id`= '{$post_id}' LIMIT 1", $countWL )
		);
		
		/// #Add post item from listing post page
		if ( !empty($post_id) ) {	
			$arr  = json_decode( file_get_contents( $path ), true );
			if ( count( $arr) == 0 ) $arr = array();
			//var_dump($arr);
			if ( count( $arr ) > 0 ) {
				$flag = true; foreach( $arr as $item ) {
					if ( trim($item['post_id']) == trim($post_id) ) { $flag = false; break; }
				}
				if ( $flag ) array_push( $arr , $post );
			}
			else {
				array_push( $arr , $post );
			}
			file_put_contents($path, json_encode( $arr ));

			// # Save any action record to notif table
			$user = get_userdata( $user_id );
			global $wpdb; 
			$post = $wpdb->get_results( 'SELECT * FROM ' . 'ltt_ff_posts_' . trim($item['cat_id']) . ' WHERE post_id = \'' . $post_id . '\'', OBJECT );
			if ( count( $post ) > 0 )
			{
				$response = $wpdb->insert( 
					$wpdb->prefix . 'notifs', 
					array(  
						'user_name' => $user->user_nicename,
						'avatar'	=> get_avatar( $user->user_email, 60 ),
						'message'	=> 'đã lưu bài viết ' . $post_id . ' của fanpage <b>' . $post[0]->user_screenname . '</b>',
						'path'		=> $post[0]->post_permalink
					),
					array( '%s', '%s', '%s', '%s' )
				);

			}
		}
		/// #END

		do_action('codestar_lamface_save_system_history', $post_id, $cat);
	}
	
	die();
}

class PostModelView {
	public $post_id 	= ''; 
    public $cat_id 		= ''; 
	function __construct() {
	}
	public function setPostId($value) 	{ $this->post_id =  $value; }
	public function setCatId($value) 	{ $this->cat_id  =  $value; }
	public function getPostId() 		{ return $this->post_id; }
	public function getCatId() 			{ return $this->cat_id; }
}

add_action( 'wp_ajax_bulkff_save_page', 'bulkff_save_page' );
add_action( 'wp_ajax_nopriv_bulkff_save_page', 'bulkff_save_page' );
function bulkff_save_page() {
	$user_id     = get_current_user_id();
	$feed_id     = $_POST["feed_id"];
	$cat         = $_POST["cat"];
	$bulkff_meta = get_user_meta( $user_id, "_bulk_page", true );
	
	if ( ! empty( $bulkff_meta ) ) {
		$metaArray = unserialize( $bulkff_meta );
		if ( empty( $metaArray[ $cat ] ) ) {
			$metaArray[ $cat ] = array( $feed_id );
			update_user_meta( $user_id, '_bulk_page', serialize( $metaArray ) );
			$key = 2;
		} else {
			$catArray = $metaArray[ $cat ];
			if ( ( $key = array_search( $feed_id, $catArray ) ) !== false ) {
				unset( $catArray[ $key ] );
				$metaArray[ $cat ] = $catArray;
				update_user_meta( $user_id, '_bulk_page', serialize( $metaArray ) );
				$key = 1;
			} else {
				array_push( $catArray, $feed_id );
				$metaArray[ $cat ] = $catArray;
				update_user_meta( $user_id, '_bulk_page', serialize( $metaArray ) );
				$key = 2;
			}
		}
	} else {
		$data = array(
			$cat => array( $feed_id )
		);
		update_user_meta( $user_id, '_bulk_page', serialize( $data ) );
		$key = 2;
	}

	do_action('codestar_lamface_save_system_history', $feed_id, $cat);

	echo $key;
	die();
}

add_action( 'wp_ajax_ajax_posts_save', 'ajax_posts_save' );
add_action( 'wp_ajax_nopriv_ajax_posts_save', 'ajax_posts_save' );
function ajax_posts_save() {
	global $wpdb;
	global $current_user;
	$table_name_post = TABLE_POST;
	if ( is_user_logged_in() ) {
		$bulkff_meta_page = get_user_meta( $current_user->ID, "_bulk_page", true );
		$meta_page        = array();
		if ( $bulkff_meta_page ) {
			$meta_page = str_replace( array( "[", "]", '"' ), "", $bulkff_meta_page );
			$meta_page = explode( ",", $meta_page );
		}
		foreach ( $meta_page as $link ) {
			$r = $wpdb->get_results( "SELECT feed_id,user_screenname,user_pic,user_link FROM $table_name_post WHERE user_link = '$link' LIMIT 0,1",
				OBJECT );
			if ( count( $r ) > 0 ) {
				$r = $r[0];
				?>
                <div class="ff-shop">
                    <a class="bulkff_save_page" onclick="bulkff_save_page(this,'<?php echo $r->user_link; ?>');return false;">Đã Lưu</a>
                    <a target="_blank" href="<?php echo $r->user_link; ?>" class="img get_posts_page" data-id="<?php echo $r->feed_id; ?>">
                        <img src="<?php echo $r->user_pic; ?>" alt="<?php echo $r->user_screenname; ?>"> </a>
                    <div class="shortInfo">
                        <a target="_blank" href="<?php echo $r->user_link; ?>" class="get_posts_page" data-id="<?php echo $r->feed_id; ?>"><?php echo $r->user_screenname; ?></a>
                    </div>
                </div>
				<?php
			}
		}
	}
}

?>