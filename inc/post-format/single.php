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
				echo '<div class="pull-right ads_page_top">' . $ads . '</div>';
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
				echo '<div class="ads_page_footer">';
				echo (strpos($ads, '<script') === false) ? '<script>'.$ads.'</script> | ' : $ads;
				echo '</div>';
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
		<ul class="share list-unstyled list-inline clearfix">
			<li class="text-center hidden-xs"><strong>分享到 <i class="fa fa-share-alt"></i></strong></li>
			<li class="text-center"><a href="javascript:;" id="share-weibo" title="分享到新浪微博"><i class="fa fa-weibo"></i></a></li>
			<li class="text-center"><a href="javascript:;" id="share-tencent" title="分享到腾讯微博"><i class="fa fa-tencent-weibo"></i></a></li>
			<li class="text-center"><a href="javascript:;" id="share-qzone" title="分享到QQ空间"><i class="fa fa-qq"></i></a></li>
			<li class="text-center"><a href="javascript:;" id="share-renren" title="分享到人人网"><i class="fa fa-renren"></i></a></li>
			<li class="text-left">
				<a class="text-center" href="javascript:;" id="share-weixin" title="分享到微信" data-toggle="modal" data-target="#myModal">
					<i class="fa fa-wechat"></i>
				</a>
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel">扫描二维码，分享到微信</h4>
							</div>
							<div class="modal-body text-center">
								<p><img src="http://api.k780.com:88/?app=qr.get&data=<?php echo urlencode(get_permalink()); ?>&level=L&size=6"></p>
								<p>打开微信，点击 “发现”<br/>使用 “扫一扫”，可分享到朋友圈</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</li>
		</ul>
		<!--分享-->

		<!--相关文章-->
		<div class="related-posts">
			<div class="related-title">
				你可能也喜欢：
			</div>
			<?php $specs_related = of_get_option("archives_related") ? of_get_option("archives_related") : 5;specs_relatedpost($specs_related);?>
		</div>
		<!--相关文章-->
	</footer>
	<?php comments_template( '', true ); ?>
</article>