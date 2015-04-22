<?php
/*
Template Name: 友情链接
*/
$layout = of_get_option('side_bar');
$layout = (empty($layout)) ? 'right_side' : $layout;
get_header();
$linkcats = $wpdb->get_results("SELECT T1.name AS name FROM $wpdb->terms T1,
    						   $wpdb->term_taxonomy T2 WHERE T1.term_id = T2.term_id
							   AND T2.taxonomy = 'link_category'");
?>
	<?php if($layout == 'left_side'){ ?>
		<aside class="col-md-4 hidden-xs hidden-sm">
			<div id="sidebar">
				<?php dynamic_sidebar( 'sidebar_single'); ?>
			</div>
		</aside>
	<?php } ?>
	<section id='main' class='<?php echo ($layout == 'single') ? 'col-md-12' : 'col-md-8'; ?>' >
		<?php while ( have_posts() ) : the_post(); ?>
			<article class="well clearfix page">
				<header class="entry-header">
					<h1 class="entry-title">
						<?php the_title(); ?>
					</h1>
				</header>
				<div class="page-content">
					<?php the_content(); ?>
					<?php if($linkcats) : foreach($linkcats as $linkcat) : ?>
					<!-- 开始输出links-->
					<div class="linkcaption">
					  <h6><?php echo $linkcat->name; ?></h6>
					</div>
					<!-- 输出分类-->
					<div class="links">
					  <!--开始ul-->
					  <ul class="clearfix list-unstyled">
						<?php $bookmarks = get_bookmarks('orderby=date&category_name=' . $linkcat->name);if ( !empty($bookmarks) ) {foreach ($bookmarks as $bookmark) {echo '<li class="col-sm-4"><a href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" ><img src="' . $bookmark->link_url . '/favicon.ico" onerror="javascript:this.src=\''.get_template_directory_uri().'/images/grey.gif\'" />' . $bookmark->link_name . '</a></li>';}} ?>
					  </ul>
					  <div class="clearfix"></div>
					</div>
					<!-- end link-content -->
					<?php endforeach; endif; ?>
				</div>
				<footer class="entry-footer">
					<!--评论模块-->
					<?php comments_template( '', true ); ?>
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
