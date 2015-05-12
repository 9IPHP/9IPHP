<article class="well clearfix entry-common" id="post-<?php echo $post->ID?>">
	<header class="entry-header">
		<?php if ( has_post_thumbnail() ) {?>
			<div class="entry-cover hidden-xs">
				<?php echo get_the_post_thumbnail($post_id, 'full');?>
			</div>
		<?php }?>
		<p><a title="首页" href="<?php echo get_option('home'); ?>/"><i class="fa fa-home"></i>首页</a> &raquo; <?php $cats = get_the_category(); $cat = $cats[0]; echo get_category_parents($cat->term_id,true," &raquo; "); ?>正文</p>
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1>
		<div class="clearfix entry-meta">
			<span class="pull-left">
				<time class="entry-date fa fa-calendar" datetime="<?php the_time("Y/m/d H:i:s");?>">
					&nbsp;<?php the_time("Y/m/d");?>
				</time>
				<span class="dot">|</span>
				<span class="categories-links fa fa-folder-o"> <?php the_category(','); ?></span>
				<span class="dot">|</span>
				<span class="fa fa-user"> <?php the_author_posts_link(); ?></span>
			</span>
			<span class="visible-lg visible-md visible-sm pull-left">
				<span class="dot">|</span>
				<span class="fa fa-comments-o comments-link"> <a href="<?php the_permalink() ?>#comments"><?php comments_number('暂无评论', '1 条评论', '% 条评论'); ?></a></span>
				<span class="dot">|</span>
				<span class="fa fa-eye"> <?php echo specs_get_post_views(get_the_ID());?> views</span>
			</span>
		</div>

	</header>
	<div class="entry-content clearfix">
		<?php
			$ads_show = of_get_option('show_ads_page_top', false);
			$ads = of_get_option('ads_page_top', false);
			if($ads_show && $ads){
				echo '<div class="ads_page_top">' . $ads . '</div>';
			}
		?>
		<?php the_content(); ?>
		<div class="pull-right single-pages">
			<?php link_pages('<p>Pages: ', '</p>', 'number'); ?>
		</div>

	</div>
	<footer class="entry-footer">
		<div class="footer-tag clearfix">
			<div class="pull-left">
				<?php if ( get_the_tags() ) { the_tags('', ' ', ''); } else{ echo '<p class="label label-specs">本文暂无标签</p>';  } ?>
			</div>
		</div>
		<?php
			$ads_show_pos = of_get_option('ads_show_pos', false);
			$ads = of_get_option('ads_index_list', false);
			if($ads_show_pos['single'] && $ads){
				echo '<div class="ads_page_footer">' . $ads . '</div>';
			}
		?>
		<!-- 文章版权信息 -->
		<h6 class="copyright">
			转载请注明来源：<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> - <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>
		</h6>
		<!-- 文章版权信息 -->
		<!--上一篇下一篇-->
		<ul class="pager clearfix">
			<li class="previous">
				<?php
				$prev_post = get_previous_post(TRUE);
				if(!empty($prev_post)):?>
				<a title="<?php echo $prev_post->post_title;?>" href="<?php echo get_permalink($prev_post->ID);?>">上一篇</a>
				<?php endif;?>
			</li>
			<li class="next">
				<?php
				$next_post = get_next_post(TRUE);
				if(!empty($next_post)):?>
				<a title="<?php echo $next_post->post_title;?>" href="<?php echo get_permalink($next_post->ID);?>">下一篇</a>
				<?php endif;?>
			</li>
		</ul>
		<!--上一篇下一篇-->
		<!--分享-->
		<?php
			$share_btn_pos = of_get_option('share_btn_pos', false);
			if ($share_btn_pos['single']) {
		?>
			<div id="share_box" class="bdsharebuttonbox" data-tag="share_2">
				<a href="#" class="bds bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
				<a href="#" class="bds bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
				<a href="#" class="bds bds_douban" data-cmd="douban" title="分享到豆瓣网"></a>
				<a href="#" class="bds bds_renren" data-cmd="renren" title="分享到人人网"></a>
				<a href="#" class="bds bds_weixin" data-cmd="weixin" title="分享到微信"></a>
				<a href="#" class="bds bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
				<a href="#" class="bds bds_more" data-cmd="more"></a>
				<a class="bds_count" data-cmd="count"></a>
				<script type="text/javascript">
				window._bd_share_config={
				    "common":{
				        "bdSnsKey":{},
				        "bdMini":"2",
				        "bdMiniList":false,
				        "bdStyle":"0",
				        "bdText":"一篇好文,推荐之-【<?php htmlspecialchars_decode(the_title(), ENT_QUOTES);?>】（来自:<?php echo htmlspecialchars_decode(get_bloginfo('name'), ENT_QUOTES); ?>）",
				        "bdPic" : "<?php echo _9iphp_post_image();?>",
				        "bdDesc": "<?php echo strip_tags(get_the_excerpt());?>",
				        "bdUrl": "<?php the_permalink() ?>"
				    },
				    "share" : [{
				        "tag" : "share_1",
				        "bdSize" : "16"
				    },
				    {
				        "tag" : "share_2",
				        "bdSize" : "32"
				    }]
				};
				with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
				</script>
			</div>
		<?php } ?>
		<!--分享-->
		<!--相关文章-->
		<?php
			if(!of_get_option('disable_related_posts')){
		?>
			<div class="related-posts">
				<div class="related-title">
					你可能也喜欢：
				</div>
				<?php $specs_related = of_get_option("archives_related") ? of_get_option("archives_related") : 5;specs_relatedpost($specs_related);?>
			</div>
		<?php } ?>
		<!--相关文章-->
	</footer>
	<?php comments_template( '', true ); ?>
</article>
