/**
 * Create by: Specs
 * Version: 1.2
 * Url: http://9iphp.com/
 */
$(function(){
	$.fn.postLike = function() {
		if ($(this).hasClass('done')) {
			return false;
		} else {
			var id = $(this).data("id"),
				action = $(this).data('action'),
				rateHolder = $(this).children('.count'),
				that = this;
			var ajax_data = {
				action: "specs_zan",
				um_id: id,
				um_action: action
			};
			$.post("/wp-admin/admin-ajax.php", ajax_data,
				function(response) {
					if (response.status == 200) {
						$(that).addClass('done');
						$(that).attr('data-original-title', '您已赞过该文章');
						$(rateHolder).html(response.data);
					}
				},'json');
			return false;
		}
	};
	if (jQuery(window).width() > 768) {
		$("a").tooltip();
		dropDown();
	}
	//导航二级菜单
	function dropDown() {
		var dropDownLi = jQuery('li.dropdown');

		dropDownLi.mouseover(function() {
			jQuery(this).addClass('open');
		}).mouseout(function() {
			jQuery(this).removeClass('open');
		});
	}
	$("#top").click(function() {
		$('body,html').animate({
			scrollTop: 0
		},
		1000);
		return false;
	});
	$('.magnific').magnificPopup({
		type: 'image',
		gallery:{
			enabled:true
		}
		// other options
	});

	//微信二维码
    $("#weixin").mouseover(function(){
        document.getElementById("EWM").style.display = 'block';
    })
    $("#weixin").mouseout(function(){
        document.getElementById("EWM").style.display = 'none';
    })

	//警告框链接加样式
	$(".alert").children("p").children("a").addClass("alert-link");
	$(".alert").children("a").addClass("alert-link");

	//侧边栏分类目录
	$("#widget-cats li").addClass("list-group-item");

	$("select").addClass("form-control");
	$("#commentform #submit").addClass('btn btn-danger btn-block');
	if ($("#main").height() > $("#sidebar").height()) {
		var footerHeight = 0;
		if ($('#main-footer').length > 0) {
			footerHeight = $('#main-footer').outerHeight(true);
		}
		$('#sidebar').affix({
			offset: {
				top: $('#sidebar').offset().top - 65,
				bottom: $('footer#body-footer').outerHeight(true) + footerHeight
			}
		});
	}
});
$(document).on("click", ".specsZan", function() {
	$('body').addClass('is-loading');
	$(this).postLike();
});
//返回顶部
$(window).scroll(function() {
	if ($(window).scrollTop() > 100) {
		$('#top').show();
	} else {
		$('#top').hide();
	}
});