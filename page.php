<?php
/*
Template Name: 默认模版
*/
$layout = of_get_option('side_bar');
$layout = (empty($layout)) ? 'right_side' : $layout;
get_header(); ?>
	<?php if($layout == 'left_side'){ ?>
		<aside id="side-bar" class="col-md-4">
				<?php dynamic_sidebar( 'sidebar_single'); ?>
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
				<footer class="entry-footer">
					<!--评论模块-->
					<?php comments_template(); ?>
				</footer>
			</article>

		<?php endwhile; // end of the loop. ?>

	</section>
	 <!--侧边栏-->
	<?php if($layout == 'right_side'){ ?>
		<aside id="side-bar" class="col-md-4">
				<?php dynamic_sidebar( 'sidebar_single'); ?>
		</aside>
	<?php } ?>
<!--底部-->
<?php get_footer(); ?>