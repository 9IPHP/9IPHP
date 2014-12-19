<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	$background_mode = array(
		'image' => '图片',
		'pattern' => '图案',
		'color' => '纯色'
	);

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/inc/theme-options/images/';

	$options = array();

	$options[] = array(
		'name' => '站点 && 主题',
		'type' => 'heading');
	$options[] = array(
		'name' => '关键词',
		'desc' => '站点关键词，以英文逗号分割',
		'id' => 'site_keywords',
		'placeholder' => '站点关键词,如:PHP,Wordpress',
		'type' => 'text');
	$options[] = array(
		'name' => '站点描述',
		'desc' => '站点描述',
		'id' => 'site_description',
		'std' => '',
		'type' => 'textarea');
	$options[] = array(
		'name' => '统计代码',
		'desc' => '统计代码（百度统计/CNZZ等，不需要写<script>标签）',
		'id' => 'site_analytics',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => '站点大LOGO',
		'desc' => '用于电脑/iPad屏幕尺寸显示，不添加则显示站点标题(200*50)',
		'id' => 'site_logo',
		'type' => 'upload');
	$options[] = array(
		'name' => '站点小LOGO',
		'desc' => '用于手机屏幕尺寸显示，不添加则显示站点标题(150*50)',
		'id' => 'site_logo_mini',
		'type' => 'upload');
	$options[] = array(
		'name' => '站点副标题',
		'desc' => '是否显示站点副标题',
		'id' => 'show_blogdescription',
		'std' => '1',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
			'1' => '是',
			'0' => '否')
	);
	$options[] = array(
		'name' => '主题背景',
		'desc' => '选择你需要的背景类型',
		'id' => 'background_mode',
		'std' => 'image',
		'type' => 'radio',
		'options' => $background_mode);
	$options[] = array(
		'name' => '背景图片',
		'desc' => '在这里上传你喜欢的背景图片(建议尺寸：1920*1200)',
		'id' => 'background_image',
		'std' => get_template_directory_uri() . '/images/bg-full.jpg',
		'class' => 'background_image',
		'type' => 'upload');
	$options[] = array(
		'name' => '显示覆盖条纹',
		'desc' =>'取消选中以移除背景图片上的覆盖条纹',
		'id' => 'show_stripe',
		'std' => '1',
		'class' => 'background_image',
		'type' => 'checkbox');
	$options[] = array(
		'name' => '选择一个背景图案',
		'desc' => '从列表选择一个背景图案或自己上传一张',
		'id' => "background_pattern",
		'std' => "light_noise_diagonal.png",
		'type' => "images",
		'class' => "hidden background_pattern",
		'options' => array(
			'az_subtle.png' => $imagepath . '/pattern/sample/az_subtle_50.png',
			'cloth_alike.png' => $imagepath . '/pattern/sample/cloth_alike_50.png',
			'cream_pixels.png' => $imagepath . '/pattern/sample/cream_pixels_50.png',
			'gray_jean.png' => $imagepath . '/pattern/sample/gray_jean_50.png',
			'grid.png' => $imagepath . '/pattern/sample/grid_50.png',
			'light_noise_diagonal.png' => $imagepath . '/pattern/sample/light_noise_diagonal_50.png',
			'light_paper.png' => $imagepath . '/pattern/sample/light_paper_50.png',
			'noise_lines.png' => $imagepath . '/pattern/sample/noise_lines_50.png',
			'pw_pattern.png' => $imagepath . '/pattern/sample/pw_pattern_50.png',
			'shattered.png' => $imagepath . '/pattern/sample/shattered_50.png',
			'squairy_light.png' => $imagepath . '/pattern/sample/squairy_light_50.png',
			'striped_lens.png' => $imagepath . '/pattern/sample/striped_lens_50.png',
			'textured_paper.png' => $imagepath .'/pattern/sample/textured_paper_50.png')
	);
	$options[] = array(
		'name' => '上传图案',
		'desc' => '上传新的图案.使用此功能将覆盖上面的选择',
		'id' => 'background_pattern_custom',
		'class' => 'background_pattern',
		'type' => 'upload');
	$options[] = array(
		'name' => '背景颜色',
		'desc' => '选择背景颜色(只有选择自定义背景颜色时才起作用)',
		'id' => 'background_color',
		'std' => '#E1E1E1',
		'class' => "hidden background_color",
		'type' => 'color' );
	$options[] = array(
		'name' => '博客整体布局',
		'desc' => '选择你喜欢的整体布局,显示左边栏，右边栏或者不显示任何边栏。默认:显示右边栏',
		'id' => "side_bar",
		'std' => "right_side",
		'type' => "images",
		'options' => array(
			'single' => $imagepath . '1col.png',
			'left_side' => $imagepath . '2cl.png',
			'right_side' => $imagepath . '2cr.png')
	);
	$options[] = array(
		'name' => '禁用菜单固定在顶部',
		'desc' => '选中此项，禁用菜单固定在顶部',
		'id' => 'disable_fixed_header',
		'std' => '0',
		'type' => 'checkbox');
	$options[] = array(
		'name' => '文章 && 页面',
		'type' => 'heading');
	$options[] = array(
		'name' => '热门文章',
		'desc' => '文章评论数大于等于 N 为热门文章',
		'id' => 'archives_hot',
		'std' => '30',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
			'10' => '10',
			'20' => '20',
			'30' => '30',
			'50' => '50',
			'100' => '100')
	);
	$options[] = array(
		'name' => '最新文章',
		'desc' => '文章发布小于等于 N 为最新文章',
		'id' => 'archives_new',
		'std' => '3',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'5' => '5',
			'10' => '10')
	);
	$options[] = array(
		'name' => '相关文章',
		'desc' => '文章页相关文章数量',
		'id' => 'archives_related',
		'std' => '5',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9',
			'10' => '10')
	);
	$options[] = array(
		'name' => '文章缩略图',
		'desc' => '列表页是否显示文章缩略图(由于SAE不能显示，建议关闭)，需要同时开启"启用文章摘要"',
		'id' => 'show_thumb',
		'std' => '1',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
			'1' => '是',
			'0' => '否')
	);
	$options[] = array(
		'name' => '分享按钮位置',
		'desc' => '分享按钮出现的位置',
		'id' => 'share_btn_pos',
		'std' => array(
				'page' => 0,
				'single' => 1),
		'type' => 'multicheck',
		'options' => array(
			'single' => '文章',
			'page' => '页面'));
	$options[] = array(
		'name' => '禁用文章末尾的相关文章',
		'desc' => '选中此项，禁用文章末尾的相关文章',
		'id' => 'disable_related_posts',
		'std' => '0',
		'type' => 'checkbox');
	$options[] = array(
		'name' => '启用文章摘要',
		'desc' => '选中此项，只显示文章摘要，否则显示整篇文章',
		'id' => 'enable_excerpt',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => '社会化组件',
		'type' => 'heading');
	$options[] = array(
		'name' => '新浪微博',
		'desc' => '你的新浪微博链接',
		'id' => 'social_sina',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => '腾讯微博',
		'desc' => '你的腾讯微博链接',
		'id' => 'social_tencent',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => 'GOOGLE+',
		'desc' => '你的GOOGLE+链接',
		'id' => 'social_google_plus',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => 'GITHUB',
		'desc' => '你的GITHUB链接',
		'id' => 'social_github',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => '邮箱',
		'desc' => '你的邮箱',
		'id' => 'social_email',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => 'RSS',
		'desc' => '你的RSS链接',
		'id' => 'social_rss',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => '幻灯片',
		'type' => 'heading');
	$options[] = array(
		'name' => '是否启用幻灯片',
		'desc' => '选择是否启用幻灯片（图片宽度建议750+,高度自选）',
		'id' => 'show_slide',
		'std' => '0',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
			'1' => '是',
			'0' => '否')
	);
	$options[] = array(
		'name' => '图片1',
		'desc' => '请上传图片',
		'id' => 'specs_slide1',
		'type' => 'upload');
	$options[] = array(
		'name' => '链接1',
		'desc' => '图片1对应链接(链接可以留空)',
		'id' => 'specs_slide_url1',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => '图片2',
		'desc' => '请上传图片',
		'id' => 'specs_slide2',
		'type' => 'upload');
	$options[] = array(
		'name' => '链接2',
		'desc' => '图片2对应链接(链接可以留空)',
		'id' => 'specs_slide_url2',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => '图片3',
		'desc' => '请上传图片',
		'id' => 'specs_slide3',
		'type' => 'upload');
	$options[] = array(
		'name' => '链接3',
		'desc' => '图片3对应链接(链接可以留空)',
		'id' => 'specs_slide_url3',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => '图片4',
		'desc' => '请上传图片',
		'id' => 'specs_slide4',
		'type' => 'upload');
	$options[] = array(
		'name' => '链接4',
		'desc' => '图片4对应链接(链接可以留空)',
		'id' => 'specs_slide_url4',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => '图片5',
		'desc' => '请上传图片',
		'id' => 'specs_slide5',
		'type' => 'upload');
	$options[] = array(
		'name' => '链接5',
		'desc' => '图片5对应链接(链接可以留空)',
		'id' => 'specs_slide_url5',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => '广告位',
		'type' => 'heading');
	$options[] = array(
		'name' => '是否启用列表页广告（740*X）',
		'desc' => '显示在文章列表页及文章底部的广告（选中后才会出现）',
		'id' => 'ads_show_pos',
		'std' => array(
				'index' => 0,
				'single' => 0),
		'type' => 'multicheck',
		'options' => array(
			'index' => '列表页中间',
			'single' => '文章页底部'));
	$options[] = array(
		'name' => '列表页广告代码',
		'desc' => '显示在文章列表页及文章底部的广告代码',
		'id' => 'ads_index_list',
		'std' => '',
		'type' => 'textarea');
	$options[] = array(
		'name' => '列表页广告出现位置',
		'desc' => '列表页广告出现在第 N+1 篇文章之后',
		'id' => 'ads_index_list_pos',
		'std' => '1',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
			'0' => '0',
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
			'6' => '6',
			'7' => '7',
			'8' => '8',
			'9' => '9')
	);
	$options[] = array(
		'name' => '是否启用文章页右侧浮动广告',
		'desc' => '选择是否启用文章页右侧浮动广告（建议宽度350px以内）',
		'id' => 'show_ads_page_top',
		'std' => '0',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
			'1' => '是',
			'0' => '否')
	);
	$options[] = array(
		'name' => '文章页右侧浮动广告代码',
		'desc' => '浮动在文章页右侧的广告代码',
		'id' => 'ads_page_top',
		'std' => '',
		'type' => 'textarea');

	return $options;
}