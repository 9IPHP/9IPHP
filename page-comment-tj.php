<?php
/*
Template Name: 评论统计页
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
	<section id='main' class='<?php echo ($layout == 'single') ? 'col-md-12' : 'col-md-8'; ?>' >
		<?php while ( have_posts() ) : the_post(); ?>
			<article class="well clearfix page" id="post">
				<header class="entry-header">
					<h1 class="entry-title">
						<?php the_title(); ?>
					</h1>
				</header>
				<div class="page-content">

					<h6>近期用户评论榜 TOP 12</h6>
					<div class="row" id="comments_top_12">
						<?php
							$results = specs_comments_tj(12,3);
							if(!empty($results)) foreach($results as $v){
								//print_r($v);
								echo "<a title='".$v[0]."' class='col-md-3' href='".$v[3]."' target='_blank'>" . get_avatar($v[2],40) . "</a>";
							}
						?>
					</div>
					<!--<h6>频率图</h6>-->
					<div id="comments_tj"></div>
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
		<aside class="col-md-4 hidden-xs hidden-sm">
			<div id="sidebar">
				<?php dynamic_sidebar( 'sidebar_single'); ?>
			</div>
		</aside>
	<?php } ?>

<script>
	$(function () {

		$('#comments_tj').highcharts({
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false
			},
			title: {
				text: '近期用户评论榜 TOP 10'
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.y:.0f}</b> ({point.percentage:.1f} %)'
				//pointFormat: '{series.name}: <b> ({point.percentage:.1f} %)</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						color: '#000000',
						connectorColor: '#000000',
						format: '<b>{point.name}</b>: {point.percentage:.1f} %'
					},
					showInLegend: true
				}
			},
			series: [{
				type: 'pie',
				name: '评论',
				data:<?php
					//$results = specs_comments_tj(12,3);
					for($i=0;$i<10;$i++){
						if(is_array($results[$i])){
							$arr[] = array($results[$i][0],$results[$i][1]);
						}
					}
					echo json_encode($arr);
				?>
			}]
		});
	});
</script>

<!--底部-->

<?php get_footer(); ?>
