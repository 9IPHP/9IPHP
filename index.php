<?php
$layout = of_get_option('side_bar');
$layout = (empty($layout)) ? 'right_side' : $layout;
$only_sider = of_get_option('only_sider');
get_header(); ?>
		<!--[if lt IE 8]>
		<div id="ie-warning" class="alert alert-danger fade in visible-lg">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<i class="fa fa-warning"></i> 请注意，本博客不支持低于IE8的浏览器，为了获得最佳效果，请下载最新的浏览器，推荐下载 <a href="http://www.google.cn/intl/zh-CN/chrome/" target="_blank"><i class="fa fa-compass"></i> Chrome</a>
            </div>
		<![endif]-->
		<?php if($layout == 'left_side'){ ?>
		<aside class="col-md-4 hidden-xs hidden-sm">
			<div id="sidebar">
				<?php dynamic_sidebar( 'sidebar_home'); ?>
			</div>
		</aside>
		<?php } ?>
		
        <section id='main' class='<?php echo ($layout == 'single') ? 'col-md-12' : 'col-md-8'; ?>' >
			<!--首页幻灯片-->
			<?php
				if(is_home()){

					if (of_get_option('show_slide')) {
						$postStyle = of_get_option('data-poststyle'); 
						echo '<div class="'.$postStyle.'"  style="padding:0px;overflow-x: hidden;overflow-y: hidden;">';
						specs_slide();
						echo '</div>';
					}
					
				}elseif(is_category()){
			?>
					<header class=" <?php echo of_get_option('data-poststyle');?> archive-header well">
						<h1 class="archive-title">
							分类目录：<?php echo single_cat_title( '', false );?>
						</h1>
						<div class="archive-meta">
						<?php if ( category_description() ) : // Show an optional category description ?>
							<?php echo category_description(); ?>
						<?php else: ?>
							以下是分类 <?php echo single_cat_title( '', false );?> 下的所有文章
						<?php endif;?>
						</div>
					</header>
			<?php
				}elseif(is_author()){
			?>
					<header class="author-header well clearfix <?php echo of_get_option('data-poststyle');?>">
						<div class="pull-left author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 50 ) ); ?>
						</div>
						<div class="author-meta">
							<h1 class="author-title">
								作者：<?php echo get_the_author();?>
							</h1>
							<?php if ( get_the_author_meta( 'description' ) ) : ?>
								<div class="archive-meta"><?php the_author_meta( 'description' ); ?></div>
							<?php endif; ?>
						</div>
					</header>
			<?php
				}elseif(is_tag()){
			?>
					<header class="archive-header well">
						<h1 class="archive-title">
							标签目录：<?php echo single_cat_title( '', false );?>
						</h1>
						<?php if ( category_description() ) : // Show an optional category description ?>
							<div class="archive-meta"><?php echo category_description(); ?></div>
						<?php else: ?>
							以下是与标签 “<?php echo single_cat_title( '', false );?>” 相关联的文章
						<?php endif;?>
					</header>
			<?php
				}elseif(is_search()){
			?>
					<header class="archive-header well">
						<h1 class="archive-title">
							搜索结果：<?php the_search_query(); ?>
						</h1>
						<div class="navbar navbar-default">
							<form class="navbar-form" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
								<div class="input-group">
									<input type="text" class="form-control" value="<?php the_search_query(); ?>" name="s" id="s" >
									<span class="input-group-btn">
									<button type="submit" class="btn btn-danger" id="searchsubmit"> 搜 索 </button>
									</span>
								</div>
							</form>
						</div>
					</header>
			<?php
				}
			?>
			<?php if(!$only_sider){?>
						<!--首页文章列表模块-->
			            <?php
							if ( have_posts() ) {
								while ( have_posts() ){
									the_post();
									get_template_part( 'inc/post-format/content', get_post_format() );
									$ads_show_pos = of_get_option('ads_show_pos', false);
									$ads = of_get_option('ads_index_list', false);
									$ads_pos = of_get_option('ads_index_list_pos',1);
									if($ads_show_pos['index'] && $ads){
										if ($wp_query->current_post == $ads_pos ){
											echo '<div class="ads_index_list">' . $ads . '</div>';
										}
									}
								}
							}else{
						?>
						<article class="<?php echo of_get_option('data-poststyle');?> alert alert-warning "><?php _e('非常抱歉，没有相关文章。'); ?></article>
						<?php } ?>
						<!--首页文章列表模块-->
						<!--分页-->
						<?php specs_pages(3);?>
			        <?php }else{
			        ?>
						<section >
							<?php
								if(is_home()){
									$postStyle = of_get_option('data-poststyle'); 
									echo '<div class="'.$postStyle.'"  style="padding:0px;overflow-x: hidden;overflow-y: hidden;">';
									specs_slide();
									echo '</div>';
								}
							?>
							<div id="main"  class="row-fluid">
								<?php dynamic_sidebar( 'sidebar_plus'); ?>		
							</div> 
						</section>
			       <?php } ?>
					
        </section>
        
        <!--侧边栏-->
		<?php if($layout == 'right_side'){ ?>
		<aside class="col-md-4 hidden-xs hidden-sm">
			<div id="sidebar">
				<?php dynamic_sidebar( 'sidebar_home'); ?>
			</div>
		</aside>
		<?php } ?>
<?php get_footer(); ?>
