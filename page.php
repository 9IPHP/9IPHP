<?php
/*
Template Name: 默认模版
*/
$layout = of_get_option('side_bar');
$layout = (empty($layout)) ? 'right_side' : $layout;
get_header(); ?>
	<?php if($layout == 'left_side'){ ?>
		<aside class="col-md-4 hidden-xs hidden-sm">
			<div id="sidebar">
				<?php dynamic_sidebar( 'sidebar_single'); ?>
			</div>
		</aside>
	<?php } ?>
	<section class='<?php echo ($layout == 'single') ? 'col-md-12' : 'col-md-8'; ?>' >

		<?php while ( have_posts() ) : the_post(); ?>
			<article class="well clearfix page" id="post">
				<header class="entry-header">
					<h1 class="entry-title">
						<?php the_title(); ?>
					</h1>
				</header>
				<div class="page-content">
					<?php the_content(); ?>
				</div>
				<!--分享-->
				<?php
					$share_btn_pos = of_get_option('share_btn_pos', false);
					if ($share_btn_pos['page']) {
				?>
					<div class="bdsharebuttonbox share" id="share_box">
						<a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
						<a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
						<a href="#" class="bds_douban" data-cmd="douban" title="分享到豆瓣网"></a>
						<a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
						<a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
						<a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
						<a href="#" class="bds_more" data-cmd="more"></a>
					</div>
					<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["tsina","qzone","douban","renren","weixin","tqq"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["tsina","qzone","douban","renren","weixin","tqq"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
				<?php } ?>
				<!--分享-->
				<footer class="entry-footer">
					<!--评论模块-->
					<?php comments_template(); ?>
				</footer>
			</article>

		<?php endwhile; // end of the loop. ?>

	</section>
	 <!--侧边栏-->
	<?php if($layout == 'right_side'){ ?>
		<aside class="col-md-4 hidden-xs hidden-sm">
			<div id="sidebar">
				<?php dynamic_sidebar( 'sidebar_single'); ?>
			</div>
		</aside>
	<?php } ?>
<!--底部-->
<?php get_footer(); ?>