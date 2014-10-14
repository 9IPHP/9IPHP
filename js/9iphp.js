/**
 * Create by: Specs
 * Version: 1.2
 * Url: http://9iphp.com/
 */
$(function(){
	$("a").tooltip();
	if (jQuery(window).width() > 768) {
		dropDown();
	};
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
	 //文章页图片特效
    //$('.fancybox').fancybox();
	$("select").addClass("form-control");
	//$("#commentform").addClass('form-horizontal');
	$("#commentform #submit").addClass('btn btn-danger btn-block');
	//$("#commentform .form-submit").addClass("col-xs-12");

});
//返回顶部
$(window).scroll(function() {
	if ($(window).scrollTop() > 100) {
		$('#top').show();
	} else {
		$('#top').hide();
	}
});