<?php
/*
Template Name: 无侧边栏
*/
get_header(); ?>
        <section class='col-md-12' >

            <?php while ( have_posts() ) : the_post(); ?>
				<article class="well clearfix page" id="post-100">
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
						<?php comments_template( '', true ); ?>
					</footer>
				</article>
				
            <?php endwhile; // end of the loop. ?>
            
        </section>
<!--底部-->
<?php get_footer(); ?>