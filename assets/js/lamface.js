var $mansoryGrid = ''; 

(function ($) {
    "use strict";

    function form_update($form, $k, $v) {
        var getVal = $form.find("[name='" + $k + "']").val();
        if (getVal != $v) {
            $form.find("[name='" + $k + "']").val($v);
            $form.find("[name='" + $k + "']").trigger('change');
        }
    }

    function form_get($form, $k) {
        return $form.find("[name='" + $k + "']").val();
    }

    function scroll() {
        setTimeout(function () {
            $('html, body').stop().animate({
                scrollTop: 0
            }, 1000);
        }, 400);
    }

    function check_number($number, $maxPage) {
        if (Number.isInteger(parseInt($number)) && (parseInt($number) <= parseInt($maxPage))) {
            return true;
        }
        return false;
    }

    /*
    function initMansory() {
        $mansoryGrid = $('.mansory-grid').isotope({
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
    }*/

    function form_ajax($form, $1) {
        $.ajax({
            type: 'POST',
            url: lamface_ajax_obj['ajaxurl'],
            dataType: 'json',
            cache: false,
            data: $form.serializeArray(),
            beforeSend: function () {
                if ($1 == '1') {
                    $("body").append('<div id="bg_ovlay"><span class="icon_loading_custom"></span></div>');
                    $('html').addClass('show_popup');
                } else {
                    $form.addClass('loading');
                }
            },
            success: function (response) {
                if (response) {
                    if (response['status'] == 'success') {
                        $('#bulkff_content').html(response['data']);
                        isotope_action();
                        if (response['count_result'] > 0) {
                            $('#pagination').twbsPagination({
                                totalPages: response['count_result'],
                                visiblePages: 6,
                                startPage: response['current_result'],
                                first: '<span class="fa fa-angle-double-left"></span>',
                                prev: '<span class="fa fa-angle-left"></span>',
                                next: '<span class="fa fa-angle-right"></span>',
                                last: '<span class="fa fa-angle-double-right"></span>',
                                onPageClick: function (event, page) {
                                    form_update($form, 'pagination', page);
                                }
                            });
                            initMansory();
                        }
                        if (response['count_fan_page'] > 0) {
                            $('#pagination-page').twbsPagination({
                                totalPages: response['count_fan_page'],
                                visiblePages: 3,
                                startPage: response['current_fan_page'],
                                first: '<span class="fa fa-angle-double-left"></span>',
                                prev: '<span class="fa fa-angle-left"></span>',
                                next: '<span class="fa fa-angle-right"></span>',
                                last: '<span class="fa fa-angle-double-right"></span>',
                                onPageClick: function (event, page) {
                                    form_update($form, 'pagination-page', page);
                                }
                            });
                        }

                        if ($('.bulkff_cats').length > 0) {
                            $('.user-tabs').html($('.bulkff_cats').html());
                            $('.bulkff_cats').html('');
                        }

                        //$('.bulkff_tab[data-id=tab1], #tab1').hide();
                        // $('.bulkff_tab[data-id=tab2]').click();
                    }
                }
                if ($1 == '1') {
                    $("#bg_ovlay").fadeOut(200, function () {
                        $("#bg_ovlay").remove();
                        $('html').removeClass('show_popup');
                    });
                } else {
                    $form.removeClass('loading');
                }
                scroll();
            }
        });
    }

    $(document).ready(function () {
        if ($('.cate-fanpage-slider').length) {
            $(".cate-fanpage-slider .owlCarousel").owlCarousel({
                loop: true,
                autoplay: true,
                nav: true,
                items: 1,
                margin: 10,
                navigation: true,
                stopOnHover: true,
                smartSpeed: 100,
                autoplayTimeout: 4000,
                responsive: {
                    320: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    1200: {
                        items: 4
                    },
                    1400: {
                        items: 6
                    }
                }
            });
        }
        if ($(".category-slider").length) {
            $(".category-slider .bulkff-list").owlCarousel({
                loop: true,
                autoplay: true,
                nav: true,
                items: 1,
                navigation: true,
                stopOnHover: true,
                smartSpeed: 100,
                autoplayTimeout: 4000,
                responsive: {
                    320: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    1200: {
                        items: 3
                    }
                }
            });
        }

        if ($('.lf-cate-list').length) {
            $(document.body).on('click', '.lf-cate-header', function () {
                $(this).parent().find('.lf-cate-body').slideToggle("slow");
            });
        }
        if ($('.lf-cate-search').length) {
            $(document.body).on('click', '.lf-btn-search-js', function () {
                var $this = $(this);
                var key = $this.parent().find('.lf-input').val();
                if (key) {
                    $.ajax({
                        type: 'POST',
                        url: lamface_ajax_obj['ajaxurl'],
                        dataType: 'json',
                        cache: false,
                        data: {
                            'action': 'cate_search',
                            'key': key,
                        },
                        beforeSend: function () {
                            $this.addClass('active');
                            $this.removeClass('lf-btn-search-js');
                            $this.parent().removeClass('error');
                        },
                        success: function (response) {
                            if (response) {
                                if (response['status'] === 'success') {
                                    window.location.replace(lamface_ajax_obj['url'] + response['data']);
                                } else {
                                    $this.parent().addClass('error');
                                }
                            } else {
                                $this.parent().addClass('error');
                            }
                            $this.addClass('lf-btn-search-js');
                            $this.removeClass('active');
                        }
                    });
                } else {
                    $this.parent().addClass('error');
                }
            });
        }
        if ($('#bulkff_form').length) {
            var form = $('.bulkff_form');
            form_ajax(form, 0);
            $(document.body).on('change', '[name="pagination"]', function () {
                form_ajax(form, 1);
                return false;
            });
            $(document.body).on('change', '[name="pagination-page"]', function () {
                form_ajax(form, 1);
                return false;
            });

            $('.bulkff_form_submit').click(function (e) {
                console.log('filter has been fired !');
                form_ajax(form, 1);
                return false;
            });

            $(document.body).on('click', '.get_posts_page', function () {
                $(this).parent().parent().parent().find('.active').removeClass('active');
                $(this).parent().addClass('active');
                var feed_id = $(this).data('id');
                form_update(form, 'action', 'list_page');
                form_update(form, 'feed_id', feed_id);
                if (form_get(form, 'pagination') == 1) {
                    form_update(form, 'pagination', '1');
                    form_ajax(form, 1);
                } else {
                    form_update(form, 'pagination', '1');
                }
                return false;
            });


            $(document.body).on('click', '.bulkff_tab', function () {
                var _this = $(this);
                if (_this.attr('href')) {
                    return true;
                }
                if (!_this.hasClass("active")) {
                    $(".bulkff_tab,.blukff_tab_content").removeClass("active");
                    _this.addClass("active");
                    $("#" + _this.data("id")).addClass("active");
                }
                return false;
            });
            $(document.body).on('click', '.pagination-wrap-more .pagination-text', function () {
                $(this).next('.pagination-input').slideToggle("slow");
            });

            $(document.body).on('click', '.pagination-button-js', function () {
                var page = $(this).parent().find('input').val();
                var maxPage = $(this).data('max');
                if (check_number(page, maxPage)) {
                    $(this).parent().removeClass('error');
                    form_update(form, 'pagination', page);
                } else {
                    $(this).parent().addClass('error');
                }
            });

            $(document.body).on('click', '.pagination-page-button-js', function () {
                var page = $(this).parent().find('input').val();
                var maxPage = $(this).data('max');
                if (check_number(page, maxPage)) {
                    $(this).parent().removeClass('error');
                    form_update(form, 'pagination-page', page);
                } else {
                    $(this).parent().addClass('error');
                }
            });

            $(document.body).on('click', '.delete-action-js', function () {
                var select = $('.admin-delete-select').val();
                var listItem = $('.bulkff-content-list');
                var user = $("[name='user']").val();
                var cat = $("[name='cat']").val();
                if (select === 'un_select') {
                    listItem.find('input[type=checkbox]').prop('checked', false);
                } else if (select === 'select_all') {
                    listItem.find('input[type=checkbox]').prop('checked', true);
                } else if (select === 'delete_item') {
                    if (confirm("Bạn có muốn xóa những item đã chọn?")) {
                        var arr = [];
                        var del = $('.delete_post_list:checked');

                        del.each(function (i) {
                            arr[i++] = $(this).val();
                        });
                        $.ajax({
                            type: 'POST',
                            url: lamface_ajax_obj['ajaxurl'],
                            dataType: 'json',
                            cache: false,
                            data: {
                                'action': 'delete',
                                'user': user,
                                'cat': cat,
                                'id': arr
                            },
                            beforeSend: function () {
                                $(this).addClass('loading');
                            },
                            success: function (response) {
                                if (response) {
                                    if (response['status'] == 'success') {
                                        alert('Xoa thanh cong!');
                                        del.parent().parent().parent().parent().remove();
                                    } else {
                                        alert('Xoa khong thanh cong - hoặc đã xóa trong csdl.');
                                    }
                                } else {
                                    alert('Xoa khong thanh cong - hoặc đã xóa trong csdl.');
                                }
                                $(this).removeClass('loading');
                            }
                        });
                    }

                } else if (select === 'delete_all') {
                    if (confirm("Bạn có muốn xóa fanpage này?")) {
                        var fanpage = $("[name='feed_id']").val();
                        $.ajax({
                            type: 'POST',
                            url: lamface_ajax_obj['ajaxurl'],
                            dataType: 'json',
                            cache: false,
                            data: {
                                'action': 'delete_fanpage',
                                'user': user,
                                'cat': cat,
                                'id': fanpage
                            },
                            beforeSend: function () {
                                $(this).addClass('loading');
                            },
                            success: function (response) {
                                if (response) {
                                    if (response['status'] == 'success') {
                                        alert('Xoa thanh cong!');
                                        $('.bulkff-content-list').remove();
                                    } else {
                                        alert('Xoa khong thanh cong - hoặc đã xóa trong csdl.');
                                    }
                                } else {
                                    alert('Xoa khong thanh cong - hoặc đã xóa trong csdl.');
                                }
                                $(this).removeClass('loading');
                            }
                        });
                    }

                }
            });
        }
    });

    $(window).on('load', function () {
        (function ($) {

        })(jQuery);
    });

})(jQuery);