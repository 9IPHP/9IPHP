<?php
    add_action("admin_menu", "option_page");

    function option_page()
    {
        //print_r($_POST);
        //echo "specs_alert_open:".$_POST['specs_alert_open'];
        file_put_contents("log.txt",json_encode($_POST));
        if (count($_POST) > 0 && isset($_POST["specs_settings"])) {
            $options = array("specs_keywords", "specs_description",  "specs_analytics", "specs_hot", "specs_new", "specs_related", "s_sina_weibo", "s_tencent_weibo","s_google_plus","s_github","s_email","site_logo","site_logo_mini","site_description","specs_slide_on","specs_slide1","specs_slide2","specs_slide3","specs_slide4","specs_slide5","specs_slide_url1","specs_slide_url2","specs_slide_url3","specs_slide_url4","specs_slide_url5");
            foreach ($options as $opt) {
                delete_option($opt, $_POST[$opt]);
                add_option($opt, trim($_POST[$opt]));
            }
        }
        $hook = add_menu_page(__("9IPHP主题 选项"), __("9IPHP主题 选项"), "edit_themes", basename(__FILE__), "specs_settings");
		add_action( $hook, 'specs_admin_scripts' );
    }

	// 引入样式
	function specs_admin_scripts() {
		global $shortname, $options;
		$dir = get_template_directory_uri();
		wp_enqueue_style( 'admin-bootstrap-style', $dir . '/inc/bootstrap-3.2.0/css/bootstrap.min.css', '', '3.2.0');
		wp_enqueue_style( 'admin-style', $dir . '/style.css', '', '1.0.0');
		wp_enqueue_script( 'admin-bootstrap', $dir . '/inc/bootstrap-3.2.0/js/bootstrap.min.js', 'jquery', '3.2.0',true);
	}

    function specs_settings()
    {
?>

<div class="wrap well">
<h1>9IPHP主题设置</h1>

<h2>说明：</h2>
<p>网站采用 <a href="http://9iphp.com/fa-icons" target="_blank">FontAwesome 4.0 图标</a>，你可以选择更换自己喜欢的图标</p>
<form method="post"  class="form-horizontal" role="form" action="">
    <input type="hidden" name="specs_settings" value="save"/>
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li class="active"><a href="#tab1" role="tab" data-toggle="tab">站点设置</a></li>
		<li><a href="#tab2" role="tab" data-toggle="tab">文章属性</a></li>
		<li><a href="#tab3" role="tab" data-toggle="tab">社会化组件</a></li>
		<li><a href="#tab4" role="tab" data-toggle="tab">SEO设置</a></li>
		<li><a href="#tab5" role="tab" data-toggle="tab">幻灯片</a></li>
		<li><a href="#tab6" role="tab" data-toggle="tab">其他设置</a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content" style="margin-top: 30px;">
		<div class="tab-pane active" id="tab1">
			<div class="form-group">
				<label for="site_logo" class="col-sm-2 control-label">站点LOGO(200*50)：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="site_logo" name="site_logo" value="<?php echo stripslashes(get_option("site_logo")); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="site_logo_mini" class="col-sm-2 control-label">站点LOGO(150*50,用于手机上显示)：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="site_logo_mini" name="site_logo_mini" value="<?php echo stripslashes(get_option("site_logo_mini")); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="site_description" class="col-sm-2 control-label">导航启用站点描述：</label>
				<div class="col-sm-6">

					<label class="radio-inline">
					  <input type="radio" name="site_description" id="site_description1" value="1" <?php if(stripslashes(get_option("site_description"))==1) echo "checked"; ?>> 是
					</label>
					<label class="radio-inline">
					  <input type="radio" name="site_description" id="site_description2" value="0" <?php if(stripslashes(get_option("site_description"))==0) echo "checked"; ?>> 否
					</label>

				</div>
			</div>
		</div>
		<div class="tab-pane" id="tab2">
			<div class="form-group">
				<label for="specs_hot" class="col-sm-2 control-label">热门文章 <small>(评论大于等于 N 为热门文章)</small>：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="specs_hot" name="specs_hot" value="<?php echo stripslashes(get_option("specs_hot")); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="specs_new" class="col-sm-2 control-label">最新文章 <small>(发布小于等于 N 天为最新文章)</small>：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="specs_new" name="specs_new" value="<?php echo stripslashes(get_option("specs_new")); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="specs_related" class="col-sm-2 control-label">相关文章  <small>(文章页相关文章数量：)</small>：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="specs_related" name="specs_related" value="<?php echo stripslashes(get_option("specs_related")); ?>"/>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="tab3">
			<div class="form-group">
				<label for="s_sina_weibo" class="col-sm-2 control-label">新浪微博：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="s_sina_weibo" name="s_sina_weibo" value="<?php echo stripslashes(get_option("s_sina_weibo")); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="s_tencent_weibo" class="col-sm-2 control-label">腾讯微博：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="s_tencent_weibo" name="s_tencent_weibo" value="<?php echo stripslashes(get_option("s_tencent_weibo")); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="s_google_plus" class="col-sm-2 control-label">GOOGLE+：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="s_google_plus" name="s_google_plus" value="<?php echo stripslashes(get_option("s_google_plus")); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="s_github" class="col-sm-2 control-label">GITHUB：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="s_github" name="s_github" value="<?php echo stripslashes(get_option("s_github")); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="s_email" class="col-sm-2 control-label">邮箱：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="s_email" name="s_email" value="<?php echo stripslashes(get_option("s_email")); ?>"/>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="tab4">
			<div class="form-group">
				<label for="specs_keywords" class="col-sm-2 control-label">关键词：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="specs_keywords" name="specs_keywords" value="<?php echo stripslashes(get_option("specs_keywords")); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="specs_description" class="col-sm-2 control-label">站点描述：</label>
				<div class="col-sm-6">
					<textarea rows="3" class="form-control" cols="60" id="specs_description" name="specs_description"><?php echo stripslashes(get_option("specs_description")); ?></textarea>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="tab5">
			<div class="form-group">
				<label class="col-sm-2 control-label">提示：</label>
				<div class="col-sm-10">
					<p class="form-control-static">宽度建议750+，高度自己看着呗，一样就行。图片对应链接可以为空</p>
				</div>
			</div>
			<div class="form-group">
				<label for="specs_slide_on" class="col-sm-2 control-label">导航启用幻灯片：</label>
				<div class="col-sm-6">

					<label class="radio-inline">
					  <input type="radio" name="specs_slide_on" id="specs_slide_on1" value="1" <?php if(stripslashes(get_option("specs_slide_on"))==1) echo "checked"; ?>> 是
					</label>
					<label class="radio-inline">
					  <input type="radio" name="specs_slide_on" id="specs_slide_on2" value="0" <?php if(stripslashes(get_option("specs_slide_on"))==0) echo "checked"; ?>> 否
					</label>

				</div>
			</div>
			<div class="form-group">
				<label for="specs_slide1" class="col-sm-2 control-label">图片1：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="specs_slide1" name="specs_slide1" value="<?php echo stripslashes(get_option("specs_slide1")); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="specs_slide_url1" class="col-sm-2 control-label">链接1：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="specs_slide_url1" name="specs_slide_url1" value="<?php echo stripslashes(get_option("specs_slide_url1")); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="specs_slide2" class="col-sm-2 control-label">图片2：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="specs_slide2" name="specs_slide2" value="<?php echo stripslashes(get_option("specs_slide2")); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="specs_slide_url2" class="col-sm-2 control-label">链接2：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="specs_slide_url2" name="specs_slide_url2" value="<?php echo stripslashes(get_option("specs_slide_url2")); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="specs_slide3" class="col-sm-2 control-label">图片3：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="specs_slide3" name="specs_slide3" value="<?php echo stripslashes(get_option("specs_slide3")); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="specs_slide_url3" class="col-sm-2 control-label">链接3：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="specs_slide_url3" name="specs_slide_url3" value="<?php echo stripslashes(get_option("specs_slide_url3")); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="specs_slide4" class="col-sm-2 control-label">图片4：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="specs_slide4" name="specs_slide4" value="<?php echo stripslashes(get_option("specs_slide4")); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="specs_slide_url4" class="col-sm-2 control-label">链接4：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="specs_slide_url4" name="specs_slide_url4" value="<?php echo stripslashes(get_option("specs_slide_url4")); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="specs_slide5" class="col-sm-2 control-label">图片5：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="specs_slide5" name="specs_slide5" value="<?php echo stripslashes(get_option("specs_slide5")); ?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="specs_slide_url5" class="col-sm-2 control-label">链接5：</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="specs_slide_url5" name="specs_slide_url5" value="<?php echo stripslashes(get_option("specs_slide_url5")); ?>"/>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="tab6">
			<div class="form-group">
				<label for="specs_analytics" class="col-sm-2 control-label">统计代码：</label>
				<div class="col-sm-6">
					<textarea rows="3" class="form-control" cols="60" id="specs_analytics" name="specs_analytics"><?php echo stripslashes(get_option("specs_analytics")); ?></textarea>
				</div>
			</div>
		</div>
	</div>
    <div class="col-sm-offset-2 col-sm-6">
		<input class="btn btn-primary" type="submit" name="Submit" value="保存设置"/>
    </div>

</form>
</div>
<?php
    }