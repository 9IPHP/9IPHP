<?php
	/*
	Template Name: 样式参考页面
	*/
?>

<?php get_header(); ?>
		<header class="bs-masthead well">
			<h1>CSS样式参考</h1>
			<div class="alert alert-info"><p>通过对应的CSS样式调用，我们可以把自己的文章变得更加丰富多彩。</p></div>
		</header>
		<section class="well">
			<div id="btn-css">
				<div class="page-header">
					<h1>按钮样式CSS</h1>
				</div>
				<h3>样式预览：</h3>
				<div class="alert">
					<button type="button" class="btn btn-default">默认</button>

					<button type="button" class="btn btn-primary">主要</button>

					<button type="button" class="btn btn-success">成功</button>

					<button type="button" class="btn btn-info">信息</button>

					<button type="button" class="btn btn-warning">警告</button>

					<button type="button" class="btn btn-danger">危险</button>

					<button type="button" class="btn btn-link">链接</button>
				</div>
				<h3>代码调用：</h3>
				<div class="alert">
					<p><code>&lt;button type="button" class="btn btn-default"&gt;默认&lt;/button&gt;</code></p>
					<p><code>&lt;button type="button" class="btn btn-primary"&gt;主要&lt;/button&gt;</code></p>
					<p><code>&lt;button type="button" class="btn btn-success"&gt;成功&lt;/button&gt;</code></p>
					<p><code>&lt;button type="button" class="btn btn-info"&gt;信息&lt;/button&gt;</code></p>
					<p><code>&lt;button type="button" class="btn btn-warning"&gt;警告&lt;/button&gt;</code></p>
					<p><code>&lt;button type="button" class="btn btn-danger"&gt;危险&lt;/button&gt;</code></p>
					<p><code>&lt;button type="button" class="btn btn-link"&gt;链接&lt;/button&gt;</code></p>
				</div>
				<h3>说明：这些btn类都可以放入到a标签中进行使用</h3>
				<div class="alert">
					<p><code>&lt;a href="#" class="btn btn-default"&gt;默认&lt;/a&gt;</code></p>
				</div>
			</div>
			<br>
			<div id="alert-css">
				<div class="page-header">
					<h1>背景样式CSS</h1>
				</div>
				<h3>样式预览：</h3>
				<div class="alert">
					<div class="alert alert-success">这是成功背景框</div>
					<div class="alert alert-info">这是信息背景框</div>
					<div class="alert alert-warning">这是警告背景框</div>
					<div class="alert alert-danger">这是危险背景框</div>
				</div>
				<h3>代码调用：</h3>
				<div class="alert">
					<p><code>&lt;div class="alert alert-success"&gt;这是成功背景框&lt;/div&gt;</code></p>
					<p><code>&lt;div class="alert alert-info"&gt;这是信息背景框&lt;/div&gt;</code></p>
					<p><code>&lt;div class="alert alert-warning"&gt;这是警告背景框&lt;/div&gt;</code></p>
					<p><code>&lt;div class="alert alert-danger"&gt;这是危险背景框&lt;/div&gt;</code></p>
				</div>
				<h3>说明：如果想要给背景框添加关闭按钮，则要添加一个class以及一个button标签</h3>
				<div class="alert">
					<div class="alert alert-warning alert-dismissable">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  警告框！这是一个可以关闭的警告框。
					</div>
					<p><code>&lt;div class="alert alert-warning alert-dismissable"&gt;</code></p>
					<p><code> &lt;button type="button" class="close" data-dismiss="alert" aria-hidden="true"&gt;&times;&lt;/button&gt;</code></p>
					<p><code>警告框！这是一个可以关闭的警告框。</code></p>
					<p><code>&lt;/div&gt;</code></p>
				</div>
			</div>
			<br>
			<div id="block-css">
				<div class="page-header">
					<h1>引用文段样式CSS</h1>
				</div>
				<h3>样式预览：</h3>
				<div class="alert">
					<blockquote>这是引用文段样式</blockquote>
				</div>
				<h3>代码调用：</h3>
				<div class="alert">
					<p><code>&lt;blockquote&gt;这是引用文段样式&lt;/blockquote&gt;</code></p>
				</div>
				<h3>说明：可以在文章编辑器上的小按钮快速调用该样式</h3>
			</div>
			<div id="block-panel">
				<div class="page-header">
					<h1>折叠样式CSS</h1>
				</div>
				<h3>样式预览：</h3>
				<div class="panel-group" id="accordion">
					 <div class="panel panel-default">
						<div class="panel-heading">
							  <h4 class="panel-title">
								<a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									Collapsible Group Item #1
								</a>
							  </h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in">
							<div class="panel-body">
								Collapsible Group Item #1 Content
							</div>
						</div>
					 </div>
					 <div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									Collapsible Group Item #2
								</a>
							</h4>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse">
							<div class="panel-body">
								Collapsible Group Item #2 Content
							</div>
						</div>
					 </div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
									Collapsible Group Item #3
								</a>
							</h4>
						</div>
						<div id="collapseThree" class="panel-collapse collapse">
							<div class="panel-body">
								Collapsible Group Item #3 Content
							</div>
						</div>
					</div>
				</div>
				<h3>代码调用：</h3>
				<div class="alert">
					<p><code>&lt;div class=&quot;panel-group&quot; id=&quot;accordion&quot;&gt;</code></p>
					 <p><code>&lt;div class=&quot;panel panel-default&quot;&gt;</code></p>
						<p><code>&lt;div class=&quot;panel-heading&quot;&gt;</code></p>
							  <p><code>&lt;h4 class=&quot;panel-title&quot;&gt;</code></p>
								<p><code>&lt;a data-toggle=&quot;collapse&quot; data-toggle=&quot;collapse&quot; data-parent=&quot;#accordion&quot; href=&quot;#collapseOne&quot;&gt;</code></p>
									<p><code>Collapsible Group Item #1</code></p>
								<p><code>&lt;/a&gt;</code></p>
							  <p><code>&lt;/h4&gt;</code></p>
						<p><code>&lt;/div&gt;</code></p>
						<p><code>&lt;div id=&quot;collapseOne&quot; class=&quot;panel-collapse collapse in&quot;&gt;</code></p>
							<p><code>&lt;div class=&quot;panel-body&quot;&gt;</code></p>
								<p><code>Collapsible Group Item #1 Content</code></p>
							<p><code>&lt;/div&gt;</code></p>
						<p><code>&lt;/div&gt;</code></p>
					 <p><code>&lt;/div&gt;</code></p>
					 <p><code>&lt;div class=&quot;panel panel-default&quot;&gt;</code></p>
						<p><code>&lt;div class=&quot;panel-heading&quot;&gt;</code></p>
							<p><code>&lt;h4 class=&quot;panel-title&quot;&gt;</code></p>
								<p><code>&lt;a data-toggle=&quot;collapse&quot; data-toggle=&quot;collapse&quot; data-parent=&quot;#accordion&quot; href=&quot;#collapseTwo&quot;&gt;</code></p>
									<p><code>Collapsible Group Item #2</code></p>
								<p><code>&lt;/a&gt;</code></p>
							<p><code>&lt;/h4&gt;</code></p>
						<p><code>&lt;/div&gt;</code></p>
						<p><code>&lt;div id=&quot;collapseTwo&quot; class=&quot;panel-collapse collapse&quot;&gt;</code></p>
							<p><code>&lt;div class=&quot;panel-body&quot;&gt;</code></p>
								<p><code>Collapsible Group Item #2 Content</code></p>
							<p><code>&lt;/div&gt;</code></p>
						<p><code>&lt;/div&gt;</code></p>
					 <p><code>&lt;/div&gt;</code></p>
					<p><code>&lt;div class=&quot;panel panel-default&quot;&gt;</code></p>
						<p><code>&lt;div class=&quot;panel-heading&quot;&gt;</code></p>
							<p><code>&lt;h4 class=&quot;panel-title&quot;&gt;</code></p>
								<p><code>&lt;a data-toggle=&quot;collapse&quot; data-toggle=&quot;collapse&quot; data-parent=&quot;#accordion&quot; href=&quot;#collapseThree&quot;&gt;</code></p>
									<p><code>Collapsible Group Item #3</code></p>
								<p><code>&lt;/a&gt;</code></p>
							<p><code>&lt;/h4&gt;</code></p>
						<p><code>&lt;/div&gt;</code></p>
						<p><code>&lt;div id=&quot;collapseThree&quot; class=&quot;panel-collapse collapse&quot;&gt;</code></p>
							<p><code>&lt;div class=&quot;panel-body&quot;&gt;</code></p>
								<p><code>Collapsible Group Item #3 Content</code></p>
							<p><code>&lt;/div&gt;</code></p>
						<p><code>&lt;/div&gt;</code></p>
					<p><code>&lt;/div&gt;</code></p>
				<p><code>&lt;/div&gt;</code></p>
				</div>
			</div>
			<div id="block-qiangdiao">
				<div class="page-header">
					<h1>强调Class</h1>
				</div>
				<h3>样式预览：</h3>
				<div class="bs-example">
					  <p class="text-muted">Fusce dapibus, tellus ac cursus commodo, tortor mauris nibh.</p>
					  <p class="text-primary">Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
					  <p class="text-success">Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
					  <p class="text-info">Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
					  <p class="text-warning">Etiam porta sem malesuada magna mollis euismod.</p>
					  <p class="text-danger">Donec ullamcorper nulla non metus auctor fringilla.</p>
				</div>
				<h3>代码调用：</h3>
				<p><code>&lt;p class=&quot;text-muted&quot;&gt;...&lt;/p&gt;</code></p>
				<p><code>&lt;p class=&quot;text-primary&quot;&gt;...&lt;/p&gt;</code></p>
				<p><code>&lt;p class=&quot;text-success&quot;&gt;...&lt;/p&gt;</code></p>
				<p><code>&lt;p class=&quot;text-info&quot;&gt;...&lt;/p&gt;</code></p>
				<p><code>&lt;p class=&quot;text-warning&quot;&gt;...&lt;/p&gt;</code></p>
				<p><code>&lt;p class=&quot;text-danger&quot;&gt;...&lt;/p&gt;</code></p>
			</div>
			<div id="block-qiangdiao">
				<div class="page-header">
					<h1>进度条效果</h1>
				</div>
				<h3>样式预览：</h3>
				<div class="bs-example">
					<div class="progress progress-striped active">
						<div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
							<span class="sr-only">45% Complete</span>
						</div>
					</div>
				</div>
				<h3>代码调用：</h3>
				<p><code>&lt;div class=&quot;progress progress-striped active&quot;&gt;</code></p>
				<p><code>&lt;div class=&quot;progress-bar&quot;  role=&quot;progressbar&quot; aria-valuenow=&quot;45&quot; aria-valuemin=&quot;0&quot; aria-valuemax=&quot;100&quot; style=&quot;width: 45%&quot;&gt;</code></p>
				<p><code>&lt;span class=&quot;sr-only&quot;&gt;45% Complete&lt;/span&gt;</code></p>
				<p><code>&lt;/div&gt;</code></p>
				<p><code>&lt;/div&gt;</code></p>
			</div>
			<div id="block-qiangdiao">
				<div class="page-header">
					<h1>面板</h1>
				</div>
				<h3>样式预览：</h3>
				<div class="bs-example">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Panel title</h3>
						</div>
						<div class="panel-body">
							Panel content
						</div>
					</div>
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title">Panel title</h3>
						</div>
						<div class="panel-body">
							Panel content
						</div>
					</div>
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Panel title</h3>
						</div>
						<div class="panel-body">
							Panel content
						</div>
					</div>
					<div class="panel panel-warning">
						<div class="panel-heading">
							<h3 class="panel-title">Panel title</h3>
						</div>
						<div class="panel-body">
							Panel content
						</div>
					</div>
					<div class="panel panel-danger">
						<div class="panel-heading">
							<h3 class="panel-title">Panel title</h3>
						</div>
						<div class="panel-body">
							Panel content
						</div>
					</div>
				</div>
				<h3>代码调用：</h3>
				<p><code>&lt;div class=&quot;panel panel-primary&quot;&gt;...&lt;/div&gt;</code></p>
				<p><code>&lt;div class=&quot;panel panel-success&quot;&gt;...&lt;/div&gt;</code></p>
				<p><code>&lt;div class=&quot;panel panel-info&quot;&gt;...&lt;/div&gt;</code></p>
				<p><code>&lt;div class=&quot;panel panel-warning&quot;&gt;...&lt;/div&gt;</code></p>
				<p><code>&lt;div class=&quot;panel panel-danger&quot;&gt;...&lt;/div&gt;</code></p>
			</div>
			
			
		</section>
<?php get_footer(); ?>