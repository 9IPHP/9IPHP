$(function(){
	//归档文章
	$('#archives a.month').each(function(){
        var num=$(this).parents('.panel').find('li').size();
        var text=$(this).text();
        $(this).html(text+'<em> ( '+num+' 篇文章 )</em>');
    });
});
$(document).on("click",".share li a",
	function(){
		var id = $(this).attr('id');
		var title = encodeURIComponent(document.title);
		var url = encodeURIComponent(document.location);
		var img = $(".entry-content img").length > 0 ? $(".entry-content img").eq(0).attr("src") : "";
		var desc = $("meta[name=description]").attr('content');
		switch (id) {
			case "share-weibo":
				shareUrl = "http://service.weibo.com/share/share.php?title=" + title + "&url=" + url + "&pic=" + img;
				break;
			case "share-tencent":
				shareUrl = "http://share.v.t.qq.com/index.php?c=share&a=index&title=" + title + "&url=" + url + "&pic=" + img;
				break;
			case "share-qzone":
				shareUrl = "http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?title=" + title + "&url=" + url + "&pics=" + img + "&desc=" + desc;
				break;
			case "share-renren":
				shareUrl = "http://widget.renren.com/dialog/share?title=" + title + "&resourceUrl=" + url + "&pic=" + img + "&description=" + desc;
				break;
			default:
				break;
		}
		if (shareUrl) {
			window.open(shareUrl);
		}
	}
)
$(document).on("click", ".commentnav a",//评论翻页标签名
    function() {

        var baseUrl = $(this).attr("href"),
        commentsHolder = $("#commentshow"),//评论内容容器名，要包住评论内容和分页菜单
        id = $(this).parent().data("post-id"),
        page = 1,
        concelLink = $("#cancel-comment-reply-link");
        /comment-page-/i.test(baseUrl) ? page = baseUrl.split(/comment-page-/i)[1].split(/(\/|#|&).*$/)[0] : /cpage=/i.test(baseUrl) && (page = baseUrl.split(/cpage=/)[1].split(/(\/|#|&).*$/)[0]);
        concelLink.click();
        var ajax_data = {
            action: "ajax_comment_page_nav",
            um_post: id,
            um_page: page
        };
        commentsHolder.html('<div id="JSloading" class="alert alert-warning"><i class="fa fa-spinner fa-spin"></i> loading..</div>')
        $.post(SPECS.um_ajaxurl, ajax_data,
        function(data) {
            commentsHolder.html(data);
            $("body, html").animate({
                scrollTop: commentsHolder.offset().top - 50
            },
            1e3)
        });
        return false;
    }
);
