<article class="well clearfix">
	<header class="entry-header">
		<?php if ( has_post_thumbnail() ) {?>
			<a href="<?php the_permalink() ?>" class="entry-cover">
			<?php echo get_the_post_thumbnail($post_id, 'full');?>
			</a>
		<?php }?>
		<h1 class="entry-title">
			<a href="<?php the_permalink() ?>" title="<?php the_title();?>">
				<?php the_title(); ?>
				<?php if( is_sticky() && is_home()) echo '<span class="label label-primary entry-tag">置顶</span>';?>
				<?php $id=$post->ID; $comments = get_post($id)->comment_count;$hots = of_get_option("archives_hot") ? of_get_option("archives_hot") : 30;if($comments>=$hots) echo '<span class="label label-danger entry-tag">HOT</span>';?>
				<?php $time = get_post_time(); $days = of_get_option("archives_new") ? of_get_option("archives_new") : 3; if(time()-$time < 24*3600*$days) echo '<span class="label label-new entry-tag">New</span>';?>
			</a>
		</h1>
		<div class="clearfix entry-meta">
			<span class="pull-left">
				<time class="entry-date fa fa-calendar" datetime="<?php the_time("Y/m/d H:i:s");?>">
					&nbsp;<?php past_date() ?>
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
	<div class="entry-summary entry-content clearfix">
		<?php
			if (of_get_option('show_thumb') && !has_post_thumbnail() && of_get_option('enable_excerpt')) {
				echo '<a href="'.get_permalink().'">' . _9iphp_post_thumbnail(220, 120) . '</a>';
			}
			if(of_get_option('enable_excerpt')){
				the_excerpt();
			}else{
				the_content(''); 
			}
		?>
	</div>
	<footer class="entry-footer clearfix visible-lg visible-md visible-sm">
		<div class="pull-left footer-tag">
			<?php if ( get_the_tags() ) { the_tags('', ' ', ''); } else{ echo '<p class="label label-specs">本文暂无标签</p>';  } ?>
		</div>


		<a class="pull-right more-link" href="<?php the_permalink() ?>" title="阅读全文">阅读全文&raquo;</a>
	</footer>
</article>
