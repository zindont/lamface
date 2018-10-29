
function isotope_action(){
    // if(jQuery(window).outerWidth() > 768){
    //     setTimeout(function(){
    //         jQuery('.bulkff-list').isotope({itemSelector: '.item'});
    //     },2000);
    // }
    if(jQuery(".slide_bulkff").length > 0){
        jQuery(".slide_bulkff").owlCarousel({
            loop: true,
            autoplay:true,
            items: 1,
            nav: true,
            navigation : true,
            stopOnHover : true,
            smartSpeed : 100,
            autoplayTimeout: 4000,
            responsive: {
                320 :{
                    items: 2
                },
                768 :{
                    items: 3
                },
                1200 :{
                    items: 3
                }
            }
        });
    }
}

jQuery(window).on('load', function () {
    (function ($) {
        isotope_action();
        if ($(".category-slider").length) {
            $(".category-slider .bottom_stick").css('z-index',1);
        }
    })(jQuery);
});

jQuery(document).ready(function(){
    jQuery('input[name="daterange"]').daterangepicker({
        autoUpdateInput: false,
        locale: {
            format: 'DD/MM/YYYY'
        }
    }, function(start_date, end_date) {
        jQuery('input[name="daterange"]').val(start_date.format('DD/MM/YYYY')+' - '+end_date.format('DD/MM/YYYY'));
    });

    jQuery("#bulkff_form_user").on("submit",function(){
        jQuery("body").append("<div id='bg_ovlay'><span class='icon_loading_custom'></span></div>");
        jQuery("html").addClass('show_popup');
        var _this = jQuery(this);
        var data = {
            action: "bulkff_form_user",
            postdata: _this.serialize()
        };
        jQuery.post(ajaxurl,data, function(html) {
            jQuery("#bulkff-content").html(html);
            jQuery("#bg_ovlay").fadeOut(200,function(){
                jQuery("#bg_ovlay").remove();
                jQuery("html").removeClass('show_popup');
            });
        });
        return false;
    });
});


function im_img(elem){
    var _this = jQuery(elem);
    _this.parents(".thumb").find(" > img").attr("src",_this.attr("src"));
}
function bulkff_show_item(elem,id,cat){
    var _this = jQuery(elem);
    var data = {
        action: "bulkff_quickview",
        id: id,
        cat: cat
    };
    jQuery("body").append("<div id='bg_ovlay'><span class='icon_loading_custom'></span></div>");
    jQuery("html").addClass('show_popup');
    jQuery.post(ajaxurl,data, function(html){
        jQuery("#bg_ovlay").html(html);
        jQuery("#bg_ovlay").click(function(e){
            if(jQuery(e.target).closest('.bulkff_show_item').length === 0) {
                jQuery("#bg_ovlay").fadeOut(200,function(){
                    jQuery("#bg_ovlay").remove();
                    jQuery("html").removeClass('show_popup');
                });
            }
        });
        if(jQuery(".slide_bulkff_quickview").length > 0){
            jQuery(".slide_bulkff_quickview").owlCarousel({
                loop: false,
                autoplay:true,
                items: 1,
                nav: true,
                navigation : true,
                stopOnHover : true,
                smartSpeed : 100,
                autoplayTimeout: 4000,
                responsive: {
                    320 :{
                        items: 2
                    },
                    768 :{
                        items: 7
                    },
                    1200 :{
                        items: 7
                    }
                }
            });
        }
    });
    return false;
}





//start
/*
function bulkff_page_change(elem,key){
    var _this = jQuery(elem);
    var _form = jQuery("form.bulkff_form");
    if(!_this.hasClass("active")){
        jQuery("body").append("<div id='bg_ovlay'><span class='icon_loading_custom'></span></div>");
        _form.find("input[name='page']").val(key);
        _form.find("input[name='nav']").val(1);
        var data = {
            action: "bulk_get_datas",
            postdata: _form.serialize()
        };
        jQuery.post(ajaxurl,data, function(html) {
            jQuery(".bulkff_nav a").removeClass("active");
            _this.addClass("active");
            jQuery(".bulkff-list").html(html);
            var newItems = jQuery(html);
            jQuery(".bulkff-list").isotope( 'destroy' );
            isotope_action();
            jQuery("#bg_ovlay").fadeOut(700,function(){
                jQuery("#bg_ovlay").remove();
            });
        });
    }
}
*/




function bulkff_nav_change(elem){
    var _this = jQuery(elem);
    if(!_this.hasClass("active")){
        _this.addClass("active");
        jQuery("body").append("<div id='bg_ovlay'><span class='icon_loading_custom'></span></div>");
        jQuery("html").addClass('show_popup');
        var data = {
            action: "bulkff_nav_change",
            nav: _this.find(':selected').val(),
            cat: _this.data("cat"),
            key: _this.data("key"),
            suget: _this.data("suget"),
            like: _this.data("like"),
            comment: _this.data("comment"),
            share: _this.data("share"),
            daterange: _this.data("daterange")
        };
        jQuery.post(ajaxurl,data, function(html) {
            jQuery(".bulkff-list").html(html);
            var newItems = jQuery(html);
            jQuery(".bulkff-list").isotope( 'destroy' );
            isotope_action();
            jQuery("#bg_ovlay").fadeOut(700,function(){
                jQuery("#bg_ovlay").remove();
                jQuery("html").removeClass('show_popup');
                _this.removeClass("active");
            });
        });
    }
}
function bulkff_navuser_change(elem){
    var _this = jQuery(elem);
    if(!_this.hasClass("active")){
        _this.addClass("active");
        jQuery("body").append("<div id='bg_ovlay'><span class='icon_loading_custom'></span></div>");
        jQuery("html").addClass('show_popup');
        var data = {
            action: "bulkff_navuser_change",
            nav: _this.find(':selected').val(),
            uid: _this.data("uid"),
            key: _this.data("key"),
            suget: _this.data("suget"),
            like: _this.data("like"),
            comment: _this.data("comment"),
            share: _this.data("share"),
            daterange: _this.data("daterange")
        };
        jQuery.post(ajaxurl,data, function(html) {
            jQuery(".bulkff-list").html(html);
            var newItems = jQuery(html);
            jQuery(".bulkff-list").isotope( 'destroy' );
            isotope_action();
            jQuery("#bg_ovlay").fadeOut(700,function(){
                jQuery("#bg_ovlay").remove();
                jQuery("html").removeClass('show_popup');
                _this.removeClass("active");
            });
        });
    }
}
function bulkff_save(elem,post_id,cat){
    var data = {
        action: "bulkff_user",
        post_id: post_id,
        cat: cat,
    };
    jQuery.post(ajaxurl,data, function(html) {
        if(parseInt(html) == 2){
            jQuery(elem).html("Đã lưu bài viết");
        }else{
            jQuery(elem).html("Lưu bài viết");
        }
    });
}
function bulkff_save_page(elem,feed_id,cat){
    var data = {
        action: "bulkff_save_page",
        feed_id: feed_id,
        cat: cat,
    };
    var feedID = jQuery('.'+ feed_id);
    jQuery.post(ajaxurl,data, function(html) {
        if(parseInt(html) == 2){
            jQuery(elem).html("Đã lưu page");
            jQuery.each(feedID,function () {
                jQuery(this).find('.save-page .save_ffbb').html("Đã lưu page");
            });
        }else{
            jQuery(elem).html("Lưu page");
            jQuery.each(feedID,function () {
                jQuery(this).find('.save-page .save_ffbb').html("Lưu page");
            });
        }
    });
}