<!DOCTYPE html><html><head>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    function keywords(){
        if( is_home() || is_front_page() ){ echo of_get_option('site_keywords'); }
        elseif( is_category() ){ single_cat_title(); }
        elseif( is_single() ){
            echo trim(wp_title('',FALSE)).',';
            if ( has_tag() ) {foreach((get_the_tags()) as $tag ) { echo $tag->name.','; } }//循环所有标签
            foreach((get_the_category()) as $category) { echo $category->cat_name.','; } //循环所有分类目录
        }
        elseif( is_search() ){ the_search_query(); }
        else{ echo trim(wp_title('',FALSE)); }
    }
    function description(){
        if( is_home() || is_front_page() ){ echo trim(of_get_option('site_description')); }
        elseif( is_category() ){ $description = strip_tags(category_description());echo trim($description);}
        elseif( is_single() ){ 
		if(get_the_excerpt()){
			echo get_the_excerpt();
		}else{
			global $post;
                        $description = trim( str_replace( array( "\r\n", "\r", "\n", "　", " "), " ", str_replace( "\"", "'", strip_tags( $post->post_content ) ) ) );
                        echo mb_substr( $description, 0, 220, 'utf-8' );
		}
	}
        elseif( is_search() ){ echo '“';the_search_query();echo '”为您找到结果 ';global $wp_query;echo $wp_query->found_posts;echo ' 个'; }
        elseif( is_tag() ){  $description = strip_tags(tag_description());echo trim($description); }
        else{ $description = strip_tags(term_description());echo trim($description); }
    }
    ?>
    <meta name="description" content="<?php description();?>">
    <meta name="keywords" content="<?php keywords();?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php if(is_404()){ ?>
        <meta http-equiv='refresh' content=5;URL="<?php bloginfo('url'); ?>">
    <?php } ?>
	<?php wp_head(); ?>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
      <script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php
// background image or pattern
switch (of_get_option('background_mode')) {
	case 'image':
		if(of_get_option('background_image')){
            $isShowBlur = of_get_option('show_blur_bg');
            if ($isShowBlur) {
                $show_blur_bg = "-webkit-filter:blur(".$isShowBlur.");";
            }
 echo '<div style="position: fixed; z-index: -1; width: 100%; height: 100%; left: 0; top: 0; background-repeat: no-repeat;background-size: cover; background-image: url('.of_get_option('background_image').');'.$show_blur_bg.'" >'.(of_get_option('show_stripe') ? '<div id="stripe"></div>' : ''). '</div>';

			//echo '<div class="specs_background">'.(of_get_option('show_stripe') ? '<div id="stripe"></div>' : ''). '<img src="'.of_get_option('background_image').'"></div>';
		}
	break;
	case 'pattern':
		if( of_get_option('background_pattern_custom') ){
			echo '<div style="background-image: url(\''.of_get_option('background_pattern_custom').'\')" id="background_pattern"></div>';
		}elseif (of_get_option('background_pattern')) {
			echo '<div style="background-image: url(\''.get_template_directory_uri() . '/inc/theme-options/images/pattern/large/'.of_get_option('background_pattern').'\')" id="background_pattern"></div>';
		}
	break;
}
?>
<header style="top:0px;">

    <div id="masthead" role="banner" class="hidden-xs"> 
     <?php 
        if(!of_get_option('hide_header_title'))
            { ?>
		<div class="top-banner">
			<div class="container">
				<?php
				$site_logo = of_get_option('site_logo');
				if ( !empty( $site_logo ) ) { ?>
					<a class="brand brand-image" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<img class="header-logo" src="<?php echo $site_logo; ?>"  alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">

						<h1 class="hidden-xs"><?php if(of_get_option('show_blogdescription')){ ?>
							<small><?php bloginfo( 'description' ); ?></small>
							<?php } ?>
						</h1>
					</a>
				<?php }else{ ?>
					<a class="brand brand-text" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<h1>
							<?php bloginfo( 'name' ); ?>
							<?php if(of_get_option('site_description')){ ?>
								<small><?php bloginfo( 'description' ); ?></small>
							<?php } ?>
						</h1>
					</a>
				<?php } ?>
				<div class="top-social pull-right hidden-xs">
					<?php echo (!of_get_option('social_sina')) 	? '' : '<a id="s_sina_weibo" title="新浪微博" target="_blank" href="' . of_get_option('social_sina') . '" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-weibo"></i></a>'; ?>
					<?php echo (!of_get_option('social_tencent')) 	? '' : '<a id="s_tencent_weibo" title="腾讯微博" target="_blank" href="' . of_get_option('social_tencent') . '" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-tencent-weibo"></i></a>'; ?>
					<?php echo (!of_get_option('social_email')) 	? '' : '<a id="s_email" title="EMAIL" target="_blank" href="mailto:' . of_get_option('social_email') . '" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-envelope-o"></i></a>'; ?>
					<?php echo (!of_get_option('social_github')) 	? '' : '<a id="s_github" title="GITHUB" target="_blank" href="' . of_get_option('social_github') . '" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-github"></i></a>'; ?>
					<?php echo (!of_get_option('social_google_plus')) 	? '' : '<a id="s_google_plus" title="GOOGLE+" target="_blank" href="' . of_get_option('social_google_plus') . '" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-google-plus-square"></i></a>'; ?>
					<?php echo (!of_get_option('social_rss')) 	? '' : '<a id="s_rss" title="RSS" target="_blank" href="' . of_get_option('social_rss') . '" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-rss-square"></i></a>'; ?>
				</div>
			</div>
		</div>
         <?php } ?>
<!--header widget -->
<?php
if( is_home())
{
if (   is_active_sidebar( 'first-header-widget-area'  )
        && is_active_sidebar( 'second-header-widget-area' )
        && is_active_sidebar( 'third-header-widget-area'  )
        && is_active_sidebar( 'fourth-header-widget-area' )
    ) : ?>
    <aside class="header-widget row hidden-xs hidden-sm">
        <div class="first col-md-3 col-xs-12"><?php dynamic_sidebar( 'first-header-widget-area' ); ?></div>
        <div class="second col-md-3 col-xs-12"><?php dynamic_sidebar( 'second-header-widget-area' ); ?></div>
        <div class="third col-md-3 col-xs-12"><?php dynamic_sidebar( 'third-header-widget-area' ); ?></div>
        <div class="fourth col-md-3 col-xs-12"><?php dynamic_sidebar( 'fourth-header-widget-area' ); ?></div>
    </aside>
    <?php elseif ( is_active_sidebar( 'first-header-widget-area'  )
        && is_active_sidebar( 'second-header-widget-area' )
        && is_active_sidebar( 'third-header-widget-area'  )
        && ! is_active_sidebar( 'fourth-header-widget-area' )
    ) : ?>
    <aside class="header-widget row hidden-xs hidden-sm">
        <div class="first col-md-4 col-xs-12"><?php dynamic_sidebar( 'first-header-widget-area' ); ?></div>
        <div class="second col-md-4 col-xs-12"><?php dynamic_sidebar( 'second-header-widget-area' ); ?></div>
        <div class="third col-md-4 col-xs-12"><?php dynamic_sidebar( 'third-header-widget-area' ); ?></div>
    </aside>
    <?php elseif ( is_active_sidebar( 'first-header-widget-area'  )
        && is_active_sidebar( 'second-header-widget-area' )
        && ! is_active_sidebar( 'third-header-widget-area'  )
    ) : ?>
    <aside class="header-widget row hidden-xs hidden-sm">
        <div class="first col-md-6 col-xs-12"><?php dynamic_sidebar( 'first-header-widget-area' ); ?></div>
        <div class="second col-md-6 col-xs-12"><?php dynamic_sidebar( 'second-header-widget-area' ); ?></div>
    </aside>
    <?php elseif ( is_active_sidebar( 'first-header-widget-area'  )
        && ! is_active_sidebar( 'second-header-widget-area' )
    ) :
    ?>
    <aside class="header-widget row hidden-xs hidden-sm">
        <div class="first col-md-12 col-xs-12"><?php dynamic_sidebar( 'first-header-widget-area' ); ?></div>
    </aside>
    <?php endif;} ?> 
    <!--end header widget -->

	</div>
    <nav id="nav" class="navbar navbar-default container-fluid <?php echo of_get_option('menu_style')?>" role="navigation" style="z-index:1000; margin: 0px; border-radius: 0px; padding: 0px;">
        <div class="container">
        
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="fa fa-bars"></span>
                </button>
				<?php $site_logo_mini = of_get_option('site_logo_mini');?>
				<a class="navbar-brand visible-xs" href="<?php echo home_url( '/' ); ?>" <?php if($site_logo_mini) echo "style='padding:2px 10px'"; ?>>
					<?php
					if ( !empty( $site_logo_mini ) ) {?>
						<img  class="header-logo" src="<?php echo $site_logo_mini; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					<?php }else{
						bloginfo( 'name' );
					}?>
				</a>
            </div>
       
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse " id="navbar-collapse">
                <?php if ( has_nav_menu( 'primary' ) ) {

                    wp_nav_menu( array('theme_location' => 'primary','container' => '','container_class' => '','container_id' => '','menu_class' => 'nav navbar-nav','items_wrap' => '<ul class="%2$s">%3$s</ul>','walker' => new Bootstrap_Walker )); //左侧主菜单
                    }else{
                    echo '<ul class="nav navbar-nav">';
                    wp_list_pages('sort_column=menu_order&title_li=');
                    echo '</ul>';
                } 
                $hide_search_box = of_get_option('hide_search_box'); 
                if(!$hide_search_box) {
                    ?>

                <form action="<?php echo home_url( '/' ); ?>" method="get" id="searchform" class="navbar-form navbar-right visible-lg" role="search">
                    <div class="form-group">
                        <input type="text" name='s' id='s' class="form-control" placeholder="这里有你想要的" x-webkit-speech>
                        <button class="btn btn-danger" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                    <!--<button type="submit" class="btn btn-primary">Submit</button>-->
                </form>
                <?php } ?>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>


</header>
<div class="container main_container">
   <section class="row">
