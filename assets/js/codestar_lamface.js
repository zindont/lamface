var ADMIN_PATH  = '/wp-admin';
var $mansoryGrid = ''; 

jQuery(document).ready(function($) {
	initExpands();
	initMansory();
	initBrokenImages();
	initNotifications();
	initOnlineUsers();

	$('.lf-cate-list .lf-cate-header .extends i').click(function (e) {
		console.log('asds');
		var w_c_element = $(this).parents('.lf-cate-list').find('.lf-cate-body');
		console.log(w_c_element);

		if (w_c_element.css('display') == 'none') {
			w_c_element.show();
		}
		else {
			w_c_element.hide();
		}
	});

	$('body').append('<div class="modal micromodal-slide" id="modal-default" aria-hidden="true"><div class="modal__overlay" tabindex="-1" data-micromodal-close><div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title"> <header class="modal__header"><h2 class="modal__title" id="modal-1-title"> Micromodal</h2> <button class="modal__close" aria-label="Close modal" data-micromodal-close></button> </header> <main class="modal__content" id="modal-1-content"><p> Try hitting the <code>tab</code> key and notice how the focus stays within the modal itself. Also, <code>esc</code> to close modal.</p> </main> <footer class="modal__footer"> <!--button class="modal__btn modal__btn-primary">Continue</button--> <button class="modal__btn fr" data-micromodal-close aria-label="Close this dialog window">Đóng</button> </footer></div></div></div>');
	$('.load-more').click(function(){
		$.ajax({
			type : "post", //Phương thức truyền post hoặc get
			dataType : "json", //Dạng dữ liệu trả về xml, json, script, or html
			url : ADMIN_PATH + '/admin-ajax.php', //Đường dẫn chứa hàm xử lý dữ liệu. Mặc định của WP như vậy
			data : {
				action: "foo_page", //Tên action
				page: $('#page').val()
				// website : '',//Biến custom truyền vào xử lý. $_POST['website']
			},
			async: false,
			context: this,
			beforeSend: function(){
				//Làm gì đó trước khi gửi dữ liệu vào xử lý
			},
			success: function(response) {
				//Làm gì đó khi dữ liệu đã được xử lý
				if(response.success) {
					//console.log(response.data);
					var $items = $(response.data);
					$mansoryGrid.append( $items ).isotope( 'appended', $items );
					//console.log(response.data);
					initMansory();
				}
				else {
					console.log('Đã có lỗi xảy ra');
				}
							
			},
			error: function( jqXHR, textStatus, errorThrown ){
				//Làm gì đó khi có lỗi xảy ra
				console.log( 'The following error occured: ' + textStatus, errorThrown );
			}
		});
		return false;
	});
});

function initMansory() {
	$mansoryGrid = jQuery('.mansory-grid').isotope({
	  itemSelector: '.mansory-grid .item-featured',
	  percentPosition: true,
	  masonry: {
	    // use outer width of grid-sizer for columnWidth
	    columnWidth: '.grid-sizer',
	    gutter: 15
	  }
	})
	// layout Isotope after each image loads
	$mansoryGrid.imagesLoaded().progress( function() {
		initExpands();
		$mansoryGrid.isotope('layout');
	});
}

function initExpands() {
	jQuery.each(jQuery('.mansory-grid .desc'), function(key, value) {
		if (jQuery(this).height() > 100) {
			jQuery(this).attr('style', 'height:100px !important; overflow-y:hidden !important');
			jQuery(this).parent().find('.click-expanding').show();
		}
	});
}

jQuery(".order-class").change(function (e) {
	jQuery(".bulkff_form_submit").click();
});

function descExpanding(id) {
	jQuery('#' + jQuery.trim(id) + ' .desc').attr('style', 'height: auto !important; overflow-y: none !important');
	jQuery('#' + jQuery.trim(id) + ' .click-expanding').hide();
	jQuery('#' + jQuery.trim(id) + ' .click-contracting').show();
}

function descContracting(id) {
	jQuery('#' + jQuery.trim(id) + ' .desc').attr('style', 'height: 100px !important; overflow-y: hidden !important');
	jQuery('#' + jQuery.trim(id) + ' .click-contracting').hide();
	jQuery('#' + jQuery.trim(id) + ' .click-expanding').show();
}

// Initial config for setting up modals
MicroModal.init({
	openTrigger: 'data-custom-open',
	disableScroll: false,
	awaitCloseAnimation: true
});

function clickToShow(id) {
	id = jQuery.trim(id);
	var imgs = jQuery('#' + id + ' .slider .active img');
	var slider = '<div class="slider owl-carousel">';
	jQuery.each(imgs, function(key, value) {
		slider += '<img src="' + jQuery(value).attr('src') + '" />';
	});
	slider += '</div>'

	jQuery('#modal-default .modal__title').html(jQuery('#' + id + ' .title').html());
	jQuery('#modal-default .modal__content').html('<img width="100%" src="' + jQuery('#' + id + ' .avatar img').attr('src') + '" />' + slider + '<div class="clr">&nbsp;</div>' + jQuery('#' + id + ' .desc').html());
	
	jQuery('#modal-default .owl-carousel').owlCarousel({
		loop:true,
		margin:10,
		nav:true,
		responsive: {
			0: {
				items:1
			},
			600: {
				items:3
			},
			1000: {
				items:5
			}
		},
		navigation : true,
		navigationText : ['<span class="fa-stack"><i class="fa fa-circle fa-stack-1x"></i><i class="fa fa-chevron-circle-left fa-stack-1x fa-inverse"></i></span>','<span class="fa-stack"><i class="fa fa-circle fa-stack-1x"></i><i class="fa fa-chevron-circle-right fa-stack-1x fa-inverse"></i></span>'],
	});
	jQuery('#modal-default .owl-carousel .owl-next').show();
	MicroModal.show('modal-default'); // [1]
}

function clickToLogOut() {
	jQuery('#modal-default .modal__title').html('Đăng xuất');
	jQuery('#modal-default .modal__content').html('Bạn có chắc là bạn muốn đăng xuất hay không?');
	MicroModal.show('modal-default'); // [1]
}

function initBrokenImages() {
	jQuery("img").on('error', function(){
		jQuery(this).unbind("error").attr("src", "/img/broken.png");
	});
}

function initNotifications() {
	setInterval(function(){
		jQuery.ajax({
			type : "post", //Phương thức truyền post hoặc get
			dataType : "json", //Dạng dữ liệu trả về xml, json, script, or html
			url : ajaxurl, //Đường dẫn chứa hàm xử lý dữ liệu. Mặc định của WP như vậy
			data : {
				action: "notif", //Tên action
				//param1 : 'pram value',//Biến truyền vào xử lý. $_POST['website']
			},
			context: this,
			beforeSend: function(){
				//Làm gì đó trước khi gửi dữ liệu vào xử lý
			},
			success: function(response) {
				//Làm gì đó khi dữ liệu đã được xử lý
				if(response.success) {
					//alert(response.data);
					var flag = true; if (typeof(Storage) === "undefined") {		
						flag = false;
					}
					
					response.data.forEach(function(object) {
						if (localStorage.getItem(object.path, "") == null)
						{
							//console.log(response);
							//console.log(object);
							jQuery.notify.addStyle('foo', {
								html: 
									"<div>" +
										"<div class='avatar' data-notify-html='avatar'></div>" +
										//"<div class='title' data-notify-text='title'/>" +
										"<div class='body' data-notify-html='body'></div>" +
										"<div class='clr'></div>" +
									"</div>"
								});
							jQuery.notify( {
								avatar: object.avatar,
								//title: 'Hellow world',
								body: "<a target='_blank' href='" + object.path.replace(" ", "") + "'><b>" + object.user_name + "</b> " + object.message + "</a>"
								}, { 
								position: 'right bottom',
								style: 'foo',
								autoHide: true,
							});
							jQuery('.notifyjs-foo-base').addClass('effect1');

							localStorage.setItem(object.path, "");					
						}
					});					
				}
				else {
					alert('Đã có lỗi xảy ra');
				}
			},
			error: function( jqXHR, textStatus, errorThrown ){
				//Làm gì đó khi có lỗi xảy ra
				console.log( 'The following error occured: ' + textStatus, errorThrown );
			}
		});	
	}, 5000);
}

function initOnlineUsers() {
	setInterval(function(){
		jQuery.ajax({
			type : "post", //Phương thức truyền post hoặc get
			dataType : "json", //Dạng dữ liệu trả về xml, json, script, or html
			url : ajaxurl, //Đường dẫn chứa hàm xử lý dữ liệu. Mặc định của WP như vậy
			data : {
				action: "get_online_users", //Tên action
				//param1 : 'pram value',//Biến truyền vào xử lý. $_POST['website']
			},
			context: this,
			beforeSend: function(){
				//Làm gì đó trước khi gửi dữ liệu vào xử lý
			},
			success: function(response) {
				//Làm gì đó khi dữ liệu đã được xử lý
				if(response.success) {
					//alert(response.data);
					response.data.forEach(function(object) {
						var html = '<div class="user-item"><div class="avatar">' + object.avatar + '</div><div class="name">' + object.display_name + '</div></div>';
						jQuery('.online-users').html(html);
					});			
				}
				else {
					alert('Đã có lỗi xảy ra');
				}
			},
			error: function( jqXHR, textStatus, errorThrown ){
				//Làm gì đó khi có lỗi xảy ra
				console.log( 'The following error occured: ' + textStatus, errorThrown );
			}
		});	
	}, 5000);
}