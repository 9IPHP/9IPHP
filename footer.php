    </section>
</div>
<footer id="body-footer">
    <div  class="container clearfix">
        Copyright © 2014 <?php bloginfo('name'); ?> |
        <?php $site_analytics = of_get_option('site_analytics', false); if($site_analytics){ echo (strpos($site_analytics, '<script') === false) ? '<script>'.$site_analytics.'</script> | ' : $site_analytics . ' | '; } ?>
        Theme By <a href="http://9iphp.com" title="Specs' Bolg" target="_blank">Specs</a>
    </div>
    <ul id="jump" class="visible-lg">
        <li><a id="top" href="#top" title="返回顶部" style="display:none;"><i class="fa fa-arrow-circle-up"></i></a></li>
    </ul>
</footer>
<?php wp_footer(); ?>
<script type="text/javascript">// <![CDATA[
$.fn.smartFloat = function() {
    var position = function(element) {
        var top = element.position().top, pos = element.css("position");
        $(window).scroll(function() {
            var scrolls = $(this).scrollTop();
            if (scrolls > top) {
                if (window.XMLHttpRequest) {
                    element.css({
                        position: "fixed",
                        top: "65px"
                    });
                } else {
                    element.css({
                        top: scrolls
                    });
                }
            }else {
                element.css({
                    position: pos,
                    top: top
                });
            }
        });
    };
    return $(this).each(function() {
        position($(this));
    });
};

//绑定
$("#float").smartFloat();
// ]]></script>

</body>
</html>
