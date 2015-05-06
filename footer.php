    </section>
</div>
<footer id="body-footer">
    <?php
    /* The footer widget area is triggered if any of the areas
     * have widgets. So let's check that first.
     *
     * If none of the sidebars have widgets, then let's bail early.
     */
    /*if (   is_active_sidebar( 'first-footer-widget-area'  )
        && is_active_sidebar( 'second-footer-widget-area' )
        && is_active_sidebar( 'third-footer-widget-area'  )
        && is_active_sidebar( 'fourth-footer-widget-area' )
    ) : ?>
    <aside class="footer-widget row">
        <div class="first col-md-3 col-xs-12"><?php dynamic_sidebar( 'first-footer-widget-area' ); ?></div>
        <div class="second col-md-3 col-xs-12"><?php dynamic_sidebar( 'second-footer-widget-area' ); ?></div>
        <div class="third col-md-3 col-xs-12"><?php dynamic_sidebar( 'third-footer-widget-area' ); ?></div>
        <div class="fourth col-md-3 col-xs-12"><?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?></div>
    </aside>
    <?php elseif ( is_active_sidebar( 'first-footer-widget-area'  )
        && is_active_sidebar( 'second-footer-widget-area' )
        && is_active_sidebar( 'third-footer-widget-area'  )
        && ! is_active_sidebar( 'fourth-footer-widget-area' )
    ) : ?>
    <aside class="footer-widget row">
        <div class="first col-md-4 col-xs-12"><?php dynamic_sidebar( 'first-footer-widget-area' ); ?></div>
        <div class="second col-md-4 col-xs-12"><?php dynamic_sidebar( 'second-footer-widget-area' ); ?></div>
        <div class="third col-md-4 col-xs-12"><?php dynamic_sidebar( 'third-footer-widget-area' ); ?></div>
    </aside>
    <?php elseif ( is_active_sidebar( 'first-footer-widget-area'  )
        && is_active_sidebar( 'second-footer-widget-area' )
        && ! is_active_sidebar( 'third-footer-widget-area'  )
    ) : ?>
    <aside class="footer-widget row">
        <div class="first col-md-6 col-xs-12"><?php dynamic_sidebar( 'first-footer-widget-area' ); ?></div>
        <div class="second col-md-6 col-xs-12"><?php dynamic_sidebar( 'second-footer-widget-area' ); ?></div>
    </aside>
    <?php elseif ( is_active_sidebar( 'first-footer-widget-area'  )
        && ! is_active_sidebar( 'second-footer-widget-area' )
    ) :
    ?>
    <aside class="footer-widget row">
        <div class="first col-md-12 col-xs-12"><?php dynamic_sidebar( 'first-footer-widget-area' ); ?></div>
    </aside>
    <?php endif; */?>
    <div  class="container clearfix bottomcp">
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
