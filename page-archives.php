<?php
/*
Template Name: 归档模板
*/
$layout = of_get_option('side_bar');
$layout = (empty($layout)) ? 'right_side' : $layout;
$postStyle = of_get_option('data-poststyle');
get_header(); ?>
	<?php if($layout == 'left_side'){ ?>
		<aside class="col-md-4 hidden-xs hidden-sm">
			<div id="sidebar">
				<?php dynamic_sidebar( 'sidebar_single'); ?>
			</div>
		</aside>
	<?php } ?>
	<section id='main' class='<?php echo ($layout == 'single') ? 'col-md-12' : 'col-md-8'; ?>' >
		<?php while ( have_posts() ) : the_post(); ?>
			<article class="<?php echo $postStyle?> well clearfix page " id="post">
				<header class="entry-header">
					<h1 class="entry-title">
						<?php the_title(); ?>
					</h1>
				</header>
				<div id="archives" class="page-content">
					<?php specs_archives_list();?>
					<?php //the_content(); ?>
				</div>
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