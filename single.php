<?php
	$layout = of_get_option('side_bar');
	$layout = (empty($layout)) ? 'right_side' : $layout;

	get_header();
	if($layout == 'left_side'){ ?>
		<aside id="side-bar" class="col-md-4">
			<?php dynamic_sidebar( 'sidebar_single'); ?>
		</aside>
	<?php } ?>
	<section class='<?php echo ($layout == 'single') ? 'col-md-12' : 'col-md-8'; ?>' >
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php specs_set_post_views(get_the_ID()); ?>
		<?php get_template_part( 'inc/post-format/single', get_post_format() ); ?>

		<?php endwhile; endif;?>
		

	</section>
	<!--侧边栏-->
	<?php if($layout == 'right_side'){ ?>
	<aside id="side-bar" class="col-md-4">
			<?php dynamic_sidebar( 'sidebar_single'); ?>
	</aside>
	<?php } ?>
<?php get_footer(); ?>