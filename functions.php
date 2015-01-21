<?php

define( '_9IPHP_VERSION', 1.3 );
//require_once(TEMPLATEPATH . '/inc/themeset.php');
require_once(TEMPLATEPATH . '/inc/widgets.php');


require_once(TEMPLATEPATH . '/inc/theme-options.php');

//特色图片支持
add_theme_support( 'post-thumbnails' );
/*  Add support for the multiple Post Formats  */
add_theme_support( 'post-formats', array('status')); 
add_filter( 'pre_option_link_manager_enabled', '__return_true' );
//注册菜单
if(!function_exists('specs_register_nav_menu')){
	function specs_register_nav_menu() {
		register_nav_menus(
			array(
				'primary'	=>	'头部主菜单', // Register the Primary menu
				// Copy and paste the line above right here if you want to make another menu,
				// just change the 'primary' to another name
			)
		);
	}
}
add_action( 'after_setup_theme', 'specs_register_nav_menu' );


class Bootstrap_Walker extends Walker_Nav_Menu
{
    function start_lvl( &$output, $depth = 0, $args = array() )
    {
        $tabs = str_repeat("\t", $depth);
        // If we are about to start the first submenu, we need to give it a dropdown-menu class
        if ($depth == 0 || $depth == 1) { //really, level-1 or level-2, because $depth is misleading here (see note above)
            $output .= "\n{$tabs}<ul class=\"dropdown-menu\">\n";
        } else {
            $output .= "\n{$tabs}<ul>\n";
        }
    }
    function end_lvl( &$output, $depth = 0, $args = array() )
    {
        if ($depth == 0) { // This is actually the end of the level-1 submenu ($depth is misleading here too!)

            // we don't have anything special for Bootstrap, so we'll just leave an HTML comment for now
            $output .= '<!--.dropdown-->';
        }
        $tabs = str_repeat("\t", $depth);
        $output .= "\n{$tabs}</ul>\n";
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
    {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        /* If this item has a dropdown menu, add the 'dropdown' class for Bootstrap */
        if ($item->hasChildren) {
            $classes[] = 'dropdown';
            // level-1 menus also need the 'dropdown-submenu' class
            if($depth == 1) {
                $classes[] = 'dropdown-submenu';
            }
        }

        /* This is the stock Wordpress code that builds the <li> with all of its attributes */
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';
        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $item_output = $args->before;

        /* If this item has a dropdown menu, make clicking on this link toggle it */
        if ($item->hasChildren && $depth == 0) {
            $item_output .= '<a'. $attributes .' class="dropdown-toggle" data-toggle="dropdown">';
        } else {
            $item_output .= '<a'. $attributes .'>';
        }

        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

        /* Output the actual caret for the user to click on to toggle the menu */
        if ($item->hasChildren && $depth == 0) {
            $item_output .= '<i class="icon-angle-down"></i></a>';
        } else {
            $item_output .= '</a>';
        }

        $item_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        return;
    }

    /* Close the <li>
     * Note: the <a> is already closed
     * Note 2: $depth is "correct" at this level
     */
    function end_el ( &$output, $item, $depth = 0, $args = array() )
    {
        $output .= '</li>';
        return;
    }

    /* Add a 'hasChildren' property to the item
     * Code from: http://wordpress.org/support/topic/how-do-i-know-if-a-menu-item-has-children-or-is-a-leaf#post-3139633
     */
    function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        // check whether this item has children, and set $item->hasChildren accordingly
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);

        // continue with normal behavior
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}
//改变菜单输出样式以适应Bootstrap菜单
class themeslug_walker_nav_menu extends Walker_Nav_Menu {
    // add classes to ul sub-menus
    function start_lvl( &$output, $depth ) {
        // depth dependent classes
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0

        // build html
        $output .= "\n" . $indent . '<ul class="dropdown-menu">' . "\n";
    }
    // add main/sub classes to li's and links
    function start_el( &$output, $item, $depth, $args ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

        // passed classes
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
        // build html
        $output .= $indent . '<li class="' . $class_names . '">';

        // link attributes
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ! empty( $item->data_toggle ) ? ' data-toggle="'   . esc_attr( $item->data_toggle ) .'"' : '';
        $attributes .= ! empty( $item->a_class ) ? ' class="'   . esc_attr( $item->a_class ) .'"' : '';
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );
        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
//修改拥有二级菜单的顶级菜单项
add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
function add_menu_parent_class( $items ) {
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'dropdown';
			$item->title = $item->title.'<b class="caret"></b>';
			$item->a_class = 'dropdown-toggle';
			//$item->data_toggle = 'dropdown';
		}
	}
	return $items;
}
//添加active为当前激活的菜单CSS类
function current_menu_class( $classes ) {
     if ( in_array('current-menu-item', $classes ) OR in_array( 'current-menu-ancestor', $classes ) )
          $classes[] = 'active';
     return $classes;
}
add_filter( 'nav_menu_css_class', 'current_menu_class' );
//图片延迟加载
add_filter ('the_content', 'lazyload');
function lazyload($content) {
	global $post;
	$loadimg_url=get_bloginfo('template_directory').'/images/lazy_loading.gif';
	if(!is_page()) {
		$content=preg_replace('/<img(.+)src=[\'"]([^\'"]+)[\'"](.*)>/i',"<img\$1data-original=\"\$2\" src=\"$loadimg_url\"\$3>",$content);
	}
	return $content;
}
//站点标题
function twentytwelve_wp_title( $title, $sep ) {
    global $paged, $page;
    if ( is_feed() )
        return $title;
    $title .= get_bloginfo( 'name' );
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";
    if ( $paged >= 2 || $page >= 2 )
        $title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );
    return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );
//加载脚本
function specs_theme_scripts() {
    global $pagenow;
    if(!is_admin()){
        $dir = get_template_directory_uri();
        wp_enqueue_script( 'jquerylib', $dir . '/js/jquery.min.js' , array(), '1.11.0');
        wp_enqueue_script( 'bootstrap', $dir . '/inc/bootstrap-3.2.0/js/bootstrap.min.js', array(), '3.2.0');
		wp_enqueue_script( 'lazyload', $dir . '/js/jquery.lazyload.js', array(), '1.19');
		wp_enqueue_script( 'magnific-popup', $dir . '/inc/magnific/jquery.magnific-popup.js', array(), '0.9.9');
        wp_enqueue_script( '9iphp', $dir . '/js/9iphp.js', array(), _9IPHP_VERSION);
        wp_enqueue_style( 'bootstrap-style', $dir . '/inc/bootstrap-3.2.0/css/bootstrap.min.css', array(), '3.2.0');
        wp_enqueue_style( 'awesome-style', $dir . '/inc/font-awesome/css/font-awesome.min.css', array(), '4.1.0');
		wp_enqueue_style( 'magnific-popup-style', $dir . '/inc/magnific/magnific-popup.css', array(), '2.1.5');
        wp_enqueue_style( '9iphp-style', get_stylesheet_uri(), array(), _9IPHP_VERSION);
        if(is_page_template('page-comment-tj.php')){
            wp_enqueue_script( 'highcharts', 'http://code.highcharts.com/highcharts.js', array(), '3.0.10',true);
        }
		if(is_singular()){
			wp_enqueue_script( 'single', get_template_directory_uri() . '/js/single.js', array(), '1.00', true);
		}
		if(!of_get_option('disable_fixed_header')){
			wp_enqueue_script( 'fixed-top', $dir . '/js/fixed-top.js', array(), _9IPHP_VERSION);
		}
    }
}
add_action('wp_enqueue_scripts', 'specs_theme_scripts');
/**
 * 9IPHP <Content images add the magnific class> in the theme.
 *
 * 文章中图片增加magnific属性
 * @version 1.0
 * @package Specs
 * @copyright 2014 all rights reserved
 *
 */

add_filter('the_content', 'magnific_class_replace');
function magnific_class_replace ($content){
	global $post;
    $pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
    $replacement = '<a$1href=$2$3.$4$5 class="magnific" rel="magnific" $6>$7</a>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}
add_filter('the_content', 'add_table_class');
function add_table_class($content){
	global $post;
	$pattern = "/<table>/i";
	$replacement = "<table class='table'>";
	$content = preg_replace($pattern, $replacement, $content);
    return $content;
}
/**
 * 9IPHP <Calendar add class> in the theme.
 *
 * 为日历增加样式
 * @version 1.0
 * @package Specs
 * @copyright 2014 all rights reserved
 *
 */
add_filter('get_calendar','calendar_class_add');
function calendar_class_add($content){
	return preg_replace("/<table(.*)>/i","<table class='table' $1>",$content);
}

/**
 * 9IPHP <POST time format> in the theme.
 *
 *
 * @version 1.0
 * @package Specs
 * @copyright 2014 all rights reserved
 *
 */
function past_date() {
    global $post;
    $suffix = '前';
    $day = ' 天';
    $hour = ' 小时';
    $minute = ' 分钟';
    $second = ' 秒';
    $m = 60;
    $h = 3600;
    $d = 86400;
    $post_time = get_post_time('G', true, $post);
    $past_time = time() - $post_time;
    if ($past_time < $m) {
        $past_date = $past_time . $second;
    } else if ($past_time < $h) {
        $past_date = $past_time / $m;
        $past_date = floor($past_date);
        $past_date .= $minute;
    } else if ($past_time < $d) {
        $past_date = $past_time / $h;
        $past_date = floor($past_date);
        $past_date .= $hour;
    } else if ($past_time < $d * 30) {
        $past_date = $past_time / $d;
        $past_date = floor($past_date);
        $past_date .= $day;
    } else {
        the_time('Y/m/d');
        return;
    }
    echo $past_date . $suffix;
}
add_filter('past_date', 'past_date');

remove_action('pre_post_update','wp_save_post_revision');
add_action('wp_print_scripts','disable_autosave');
function disable_autosave(){  wp_deregister_script('autosave'); }
/**
 * 9IPHP <Cut the string> in the theme.
 * 字符串截取函数
 *
 * @version 1.0
 * @package Specs
 * @copyright 2014 all rights reserved
 *
 */
function specs_string_cut($string, $sublen, $start = 0, $code = 'UTF-8') {
     if($code == 'UTF-8') {
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);
        if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen)) . "...";
        return join('', array_slice($t_string[0], $start, $sublen));
    } else {
        $start = $start * 2;
        $sublen = $sublen * 2;
        $strlen = strlen($string);
        $tmpstr = '';

        for($i = 0; $i < $strlen; $i++) {
            if($i >= $start && $i < ($start + $sublen)) {
                if(ord(substr($string, $i, 1)) > 129) $tmpstr .= substr($string, $i, 2);
                else $tmpstr .= substr($string, $i, 1);
            }
            if(ord(substr($string, $i, 1)) > 129) $i++;
        }
            if(strlen($tmpstr) < $strlen ) $tmpstr .= "...";
            return $tmpstr;
    }
}
/**
 * 9IPHP <Get the latest comments> in the theme.
 *
 * 获取最新文章评论内容
 * @version 1.0
 * @package Specs
 * @copyright 2014 all rights reserved
 *
 */
function specs_latest_comments_list($list_number=5, $avatar_size=32, $cut_length=20) {
	global $wpdb;
	global $admin_email;
	//print_r($admin_email);
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url,comment_author_email, comment_content AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND user_id != '1' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $list_number" ;
	//echo $sql;
	$comments = $wpdb->get_results($sql);

	foreach ($comments as $comment) {
	  $output .= "\n<a class=\"list-group-item\" href=\"" . get_the_permalink($comment->comment_post_ID) . "#comments\" title=\"发表在 " .$comment->post_title . "\">".get_avatar( $comment, $avatar_size )." " . convert_smilies(specs_string_cut(strip_tags($comment->com_excerpt), $cut_length))."&nbsp;</a></span></a>";
	}

	//$output = convert_smilies($output);

	return $output;
}
/**
 * 9IPHP <Post views statistics> in the theme.
 *
 * 文章阅读量统计
 * @version 1.0
 * @package Specs
 * @copyright 2014 all rights reserved
 *
 */

function specs_set_post_views($postID) {
	if (!current_user_can('level_10')) {
	    $count_key = 'post_views_count';
	    $count = get_post_meta($postID, $count_key, true);
	    if($count==''){
	        $count = 0;
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	    }else{
	      $count++;
	      update_post_meta($postID, $count_key, $count);
	    }
	}
}
function specs_get_post_views($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
/**
 * 9IPHP <Posts pagination> in the theme.
 *
 * 列表分页
 * @version 1.0
 * @package Specs
 * @copyright 2014 all rights reserved
 *
 */
function specs_pages($range = 5){
    global $paged, $wp_query;
    if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
    if($max_page > 1){if(!$paged){$paged = 1;}
	echo "<ul class='pagination pull-right'>";
        if($paged != 1){
            echo "<li><a href='" . get_pagenum_link(1) . "' class='extend' title='首页'>&laquo;</a></li>";
        }
        if($paged>1) echo '<li><a href="' . get_pagenum_link($paged-1) .'" class="prev" title="上一页">&lt;</a></li>';
        if($max_page > $range){
            if($paged < $range){
                for($i = 1; $i <= ($range + 1); $i++){
                    echo "<li"; if($i==$paged)echo " class='active'";echo "><a href='" . get_pagenum_link($i) ."'>$i</a></li>";
                }
            }
            elseif($paged >= ($max_page - ceil(($range/2)))){
                for($i = $max_page - $range; $i <= $max_page; $i++){
                    echo "<li";
                    if($i==$paged)
                        echo " class='active'";echo "><a href='" . get_pagenum_link($i) ."'>$i</a></li>";
                }
            }
            elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
                for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
                    echo "<li";
                    if($i==$paged)echo " class='active'";
                    echo "><a href='" . get_pagenum_link($i) ."'>$i</a></li>";
                }
            }
        }
        else{
            for($i = 1; $i <= $max_page; $i++){
                echo "<li";
                if($i==$paged)echo " class='active'";
                echo "><a href='" . get_pagenum_link($i) ."'>$i</a></li>";
            }
        }
        if($paged<$max_page) echo '<li><a href="' . get_pagenum_link($paged+1) .'" class="next" title="下一页">&gt;</a></li>';
        if($paged != $max_page){
            echo "<li><a href='" . get_pagenum_link($max_page) . "' class='extend' title='尾页'>&raquo;</a></li>";
        }
        echo "</ul>";
	}
}


/**
 * 9IPHP <Archives> in the theme.
 *
 * 归档文章
 * @version 1.0
 * @package Specs
 * @copyright 2014 all rights reserved
 *
 */
function specs_archives_list() {
    if( !$output = get_option('specs_archives_list') ){
        $output = '';
        $the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' ); //update: 加上忽略置顶文章
        $year=0; $mon=0; $i=0; $j=0;
        while ( $the_query->have_posts() ) : $the_query->the_post();
            $year_tmp = get_the_time('Y');
            $mon_tmp = get_the_time('m');
            $y=$year; $m=$mon;
            if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';
            if ($year != $year_tmp && $year > 0) $output .= '</ul>';
            if ($year != $year_tmp) {
                $year = $year_tmp;
                $output .= '<h3 class="al_year">'. $year .' 年</h3><ul class="al_mon_list">'; //输出年份
            }
            if ($mon != $mon_tmp) {
                $mon = $mon_tmp;
                $output .= '<li><span class="al_mon">'. $mon .' 月</span><ul class="al_post_list">'; //输出月份
            }
            $output .= '<li>'. get_the_time('d日: ') .'<a href="'. get_permalink() .'" title="'.get_the_title().'">'. get_the_title() .'</a> <em>('. get_comments_number('0', '1', '%') .')</em></li>'; //输出文章日期和标题
        endwhile;
        wp_reset_postdata();
        $output .= '</ul></li></ul>';
        update_option('specs_archives_list', $output);
    }
    echo $output;
}
function clear_archives_cache() {
    update_option('specs_archives_list', ''); // 清空 specs_archives_list
}
add_action('save_post', 'clear_archives_cache'); // 新发表文章/修改文章时

/**
 * 9IPHP <Related posts> in the theme.
 *
 *
 * @version 1.0
 * @package Specs
 * @copyright 2014 all rights reserved
 *
 */

function specs_relatedpost($post_num = 5) {
	global $post;
    echo '<ul>';
    $exclude_id = $post->ID;
    $posttags = get_the_tags(); $i = 0;
    if ( $posttags ) {
        $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
        $args = array(
            'post_status' => 'publish',
            'tag__in' => explode(',', $tags),
            'post__not_in' => explode(',', $exclude_id),
            'ignore_sticky_posts' => 1,
            'orderby' => 'comment_date',
            'posts_per_page' => $post_num
        );
        query_posts($args);
        while( have_posts() ) { the_post(); ?>
            <li>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a>
            </li>
            <?php
            $exclude_id .= ',' . $post->ID; $i ++;
        }
		wp_reset_query();
    }
    if ( $i < $post_num ) {
        $cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
        $args = array(
            'category__in' => explode(',', $cats),
            'post__not_in' => explode(',', $exclude_id),
            'ignore_sticky_posts' => 1,
            'orderby' => 'comment_date',
            'posts_per_page' => $post_num - $i
        );
        query_posts($args);
        while( have_posts() ) { the_post(); ?>
            <li>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a>
            </li>
            <?php $i++;
        }
		wp_reset_query();
    }
    if ( $i  == 0 )  echo '<li>没有相关文章!</li>';
    echo '</ul>';
}

/**
 * 9IPHP <Most commented posts in the past several days> in the theme.
 *
 *
 * @version 1.0
 * @package Specs
 * @copyright 2014 all rights reserved
 *
 */
function most_comm_posts($days=30, $nums=5) { //$days参数限制时间值，单位为‘天’，默认是30天；$nums是要显示文章数量
	global $wpdb;
    date_default_timezone_set("PRC");
	$today = date("Y-m-d H:i:s"); //获取今天日期时间
	$daysago = date( "Y-m-d H:i:s", strtotime($today) - ($days * 24 * 60 * 60) );  //Today - $days
	$result = $wpdb->get_results("SELECT comment_count, ID, post_title, post_date FROM $wpdb->posts WHERE post_date BETWEEN '$daysago' AND '$today' and post_type='post' and post_status='publish' ORDER BY comment_count DESC LIMIT 0 , $nums");
	$output = '';
	if(empty($result)) {
		$output = '<li>None data.</li>';
	} else {
		foreach ($result as $topten) {
			$postid = $topten->ID;
			$title = $topten->post_title;
			$commentcount = $topten->comment_count;
			if ($commentcount >= 0) {
				//$output .= '<li><a href="'.get_permalink($postid).'" title="'.$title.'">'.$title.'</a> ('.$commentcount.')</li>';

                $output .= '<a class="list-group-item visible-lg" title="'. $title .'" href="'.get_permalink($postid).'" rel="bookmark">';
                    $output .= specs_string_cut(strip_tags($title), 18);
                    $output .= '<i class="fa fa-comment badge"> '.$commentcount.'</i>';
                $output .= '</a>';
                $output .= '<a class="list-group-item visible-md" title="'. $title .'" href="'.get_permalink($postid).'" rel="bookmark">';
                    $output .= specs_string_cut(strip_tags($title), 12);
                    $output .= '<i class="fa fa-comment badge"> '.$commentcount.'</i>';
                $output .= '</a>';
			}
		}
	}
	echo $output;
}
/**
 * 9IPHP <Get post thumb> in the theme.
 *
 *
 * @version 1.0
 * @package Specs
 * @copyright 2014 all rights reserved
 *
 */
function specs_get_post_thumb(){
	global $post;
	if ( has_post_thumbnail() ) {
		echo get_the_post_thumbnail($post_id, 'full');
	} else {
		$cats=get_the_category();
		foreach($cats as $cat){
			$catsID[] = $cat->cat_ID;
		}
		$thumb = "http://img-specs.qiniudn.com/9iphp_thumb_";
		if(is_array($catsID)){
			if(array_search("47", $catsID) > -1){$thumb .="linux";}
			elseif(array_search("32", $catsID) > -1){$thumb .="sql";}
			elseif(array_search("30", $catsID) > -1){$thumb .="html5";}
			elseif(array_search("16", $catsID) > -1){$thumb .="jquery";}
			elseif(array_search("13", $catsID) > -1){$thumb .="dede";}
			elseif(array_search("1", $catsID) > -1){$thumb .="wordpress";}
			elseif(array_search("2", $catsID) > -1){$thumb .="php";}
			else{ $thumb .= "smile";}
		}else{
			$thumb .= "smile";
		}
		$thumb .= ".jpg";

		echo '<img src="'.$thumb.'"/>';
	}
}
/**
 * 9IPHP <Get post title first letter> in the theme.
 * 拼音首字母
 *
 * @version 1.0
 * @package Specs
 * @copyright 2014 all rights reserved
 *
 */
function specs_getfirstchar($s0){
	$fchar = ord($s0{0});
	if($fchar >= ord("A") and $fchar <= ord("z") )return strtoupper($s0{0});
	$s1 = iconv("UTF-8","gb2312", $s0);
	$s2 = iconv("gb2312","UTF-8", $s1);
	if($s2 == $s0){$s = $s1;}else{$s = $s0;}
	$asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
	if($asc >= -20319 and $asc <= -20284) return "A";
	if($asc >= -20283 and $asc <= -19776) return "B";
	if($asc >= -19775 and $asc <= -19219) return "C";
	if($asc >= -19218 and $asc <= -18711) return "D";
	if($asc >= -18710 and $asc <= -18527) return "E";
	if($asc >= -18526 and $asc <= -18240) return "F";
	if($asc >= -18239 and $asc <= -17923) return "G";
	if($asc >= -17922 and $asc <= -17418) return "H";
	if($asc >= -17417 and $asc <= -16475) return "J";
	if($asc >= -16474 and $asc <= -16213) return "K";
	if($asc >= -16212 and $asc <= -15641) return "L";
	if($asc >= -15640 and $asc <= -15166) return "M";
	if($asc >= -15165 and $asc <= -14923) return "N";
	if($asc >= -14922 and $asc <= -14915) return "O";
	if($asc >= -14914 and $asc <= -14631) return "P";
	if($asc >= -14630 and $asc <= -14150) return "Q";
	if($asc >= -14149 and $asc <= -14091) return "R";
	if($asc >= -14090 and $asc <= -13319) return "S";
	if($asc >= -13318 and $asc <= -12839) return "T";
	if($asc >= -12838 and $asc <= -12557) return "W";
	if($asc >= -12556 and $asc <= -11848) return "X";
	if($asc >= -11847 and $asc <= -11056) return "Y";
	if($asc >= -11055 and $asc <= -10247) return "Z";
	return null;
}
function specs_pinyin($zh){
	$ret = "";
    $s1 = iconv("UTF-8","gb2312", $zh);
    $s2 = iconv("gb2312","UTF-8", $s1);
    if($s2 == $zh){$zh = $s1;}
    $s1 = substr($zh,$i,1);
    $p = ord($s1);
    if($p > 160){
        $s2 = substr($zh,$i++,2);
        $ret .= specs_getfirstchar($s2);
    }else{
        $ret .= $s1;
    }
	return strtoupper($ret);
}
/**
 * 9IPHP <Get all tags> in the theme.
 * 标签页面
 *
 * @version 1.0
 * @package Specs
 * @copyright 2014 all rights reserved
 * @reference http://codex.wordpress.org/Function_Reference/get_terms
 */
function specs_show_tags() {
	if(!$output = get_option('specs_tags_list')){
		$categories = get_terms( 'post_tag', array(
			'orderby'    => 'count',
			'hide_empty' => 1
		 ) );
		foreach($categories as $v){
			for($i = 65; $i <= 90; $i++){
				if(specs_pinyin($v->name) == chr($i)){
					$r[chr($i)][] = $v;
				}
			}
			for($i=48;$i<=57;$i++){
				if(specs_pinyin($v->name) == chr($i)){
					$r[chr($i)][] = $v;
				}
			}
		}
		ksort($r);
		$output = "<ul class='list-inline clearfix text-center' id='tag_letter'>";
		for($i=65;$i<=90;$i++){
			$tagi = $r[chr($i)];
			if(is_array($tagi)){
				$output .= "<li class='col-sm-1 col-xs-2'><a href='#".chr($i)."'>".chr($i)."</a></li>";
			}else{
				$output .= "<li class='col-sm-1 col-xs-2'>".chr($i)."</li>";
			}
		}
		for($i=48;$i<=57;$i++){
			$tagi = $r[chr($i)];
			if(is_array($tagi)){
				$output .= "<li class='col-sm-1 col-xs-2'><a href='#".chr($i)."'>".chr($i)."</a></li>";
			}else{
				$output .= "<li class='col-sm-1 col-xs-2'>".chr($i)."</li>";
			}
		}
		$output .= "</ul>";
		$output .= "<ul id='all_tags' class='list-unstyled'>";
		for($i=65;$i<=90;$i++){
			$tagi = $r[chr($i)];
			if(is_array($tagi)){
				$output .= "<li id='".chr($i)."'><h4 class='tag_name'>".chr($i)."</h4>";
				foreach($tagi as $tag){
					$output .= "<a href='".get_tag_link($tag->term_id)."'>".$tag->name."(".specs_post_count_by_tag($tag->term_id).")</a>";
				}
			}
		}
		for($i=48;$i<=57;$i++){
			$tagi = $r[chr($i)];
			if(is_array($tagi)){
				$output .= "<li id='".chr($i)."'><h4 class='tag_name'>".chr($i)."</h4>";
				foreach($tagi as $tag){
					$output .= "<a href='".get_tag_link($tag->term_id)."'>".$tag->name."(".specs_post_count_by_tag($tag->term_id).")</a>";
				}
			}
		}
		$output .= "</ul>";
		update_option('specs_tags_list', $output);
	}
    echo $output;
}
function clear_tags_cache() {
    update_option('specs_tags_list', ''); // 清空 specs_archives_list
}
add_action('save_post', 'clear_tags_cache'); // 新发表文章/修改文章时
/**
 * 9IPHP <Get post count by tag term_id> in the theme.
 * 根据标签ID活动标签文章数
 *
 * @version 1.0
 * @package Specs
 * @copyright 2014 all rights reserved
 *
 * $type: include exclude or slug
 *
 */
function specs_post_count_by_tag ( $arg ,$type = 'include'){
    $args=array(
        $type => $arg,
    );
    $tags = get_tags($args);
    if ($tags) {
        foreach ($tags as $tag) {
            return $tag->count;
        }
    }
}
/**
 * 9IPHP <Comments statistics> in the theme.
 * 用户评论统计
 *
 * @version 1.0
 * @package Specs
 * @copyright 2014 all rights reserved
 *
 * $month: month
 *
 */
function specs_comments_tj($nums = 10,$month=0){
    if(!$result = get_option("mostactive")){
        global $wpdb;
        //$time = time();

        $sql = "select comment_author_email,comment_author,comment_author_url,count(*) as total from(select * from  $wpdb->comments order by comment_ID desc) tmp where ";
        if($month){
            $sql .= "comment_date > date_sub( NOW(), INTERVAL $month MONTH) and ";
        }
        $sql .= "user_id!='1' and comment_author_email!='' AND comment_approved = '1' group by comment_author_email order by total desc limit $nums";
        //echo $sql;
        $comments = $wpdb->get_results($sql);
        foreach($comments as $v){
            $result[]=array($v->comment_author,(int)$v->total,$v->comment_author_email,$v->comment_author_url);
        }
        update_option('mostactive', $result);
    }
    return $result;
}
function clear_mostactive() {
  update_option('mostactive', ''); // 清空 mostactive
}
add_action('comment_post', 'clear_mostactive'); // 新评论发生时
add_action('edit_comment', 'clear_mostactive'); // 评论被编辑过
/**
 * 9IPHP <Editor> in the theme.
 * 编辑器增强
 *
 * @version 1.0
 * @package Specs
 * @copyright 2014 all rights reserved
 *
 *
 */
function specs_add_quicktags(){
    if(wp_script_is('quicktags')){
?>
    <script type="text/javascript">
        QTags.addButton('alert-success','成功背景','<div class="alert alert-success">','</div>');
        QTags.addButton('alert-info','信息背景','<div class="alert alert-info">','</div>');
        QTags.addButton('alert-warning','警告背景','<div class="alert alert-warning">','</div>');
        QTags.addButton('alert-danger','危险背景','<div class="alert alert-danger">','</div>');
        QTags.addButton('dismiss-success','可关闭成功','<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>','</div>');
        QTags.addButton('dismiss-info','可关闭信息','<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>','</div>');
        QTags.addButton('dismiss-warning','可关闭警告','<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>','</div>');
        QTags.addButton('dismiss-danger','可关闭危险','<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>','</div>');
    </script>
<?php
    }
}
add_action('admin_print_footer_scripts','specs_add_quicktags');

/**
 * 9IPHP <Comments List> in the theme.
 * 评论列表
 *
 * @version 1.0
 * @package Specs
 * @copyright 2014 all rights reserved
 *
 *
 */
function specs_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);


?>
	<li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <div class="comment-wrap" id="comment-<?php comment_ID() ?>">
        <div class="comment-author pull-left">
        <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        </div>
        <div class="comment-body">
            <h4>
                <?php printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === get_queried_object()->post_author ) ? '<small class="label label-primary">博主</small>' : ''
					); ?>
                <span class="comment-date">
                    <?php printf( __('%1$s'), get_comment_date("Y/m/d H:i") ); ?>
                </span>
            </h4>
            <?php if ( $comment->comment_approved == '0' ) : ?>
                <p class="comment-awaiting-moderation text-danger"><?php echo "您的评论正在等待审核"; ?></p>
            <?php endif; ?>
            <p>
                <?php if($comment->comment_parent){// 如果存在父级评论
                $comment_parent_href = get_comment_ID( $comment->comment_parent );
                $comment_parent = get_comment($comment->comment_parent);
                ?>
                <span class="comment-to plr">@</span>
                <span class="reply-comment-author">
                    <a href="#comment-<?php echo $comment_parent_href;?>" title="<?php echo specs_string_cut(strip_tags(apply_filters('the_content', $comment_parent->comment_content)), 100); ?>">
                        <?php echo $comment_parent->comment_author;?>
                    </a>
                </span>
                <?php }?>
                <?php echo convert_smilies(get_comment_text()); ?>
            </p>

            <div class="reply clearfix">
                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => '<div class="label label-danger pull-right">回复</div>','depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div>

        </div>
    </div>
<?php
}
//Ajax评论
function ajax_comment_scripts() {
	global $pagenow;
    if(is_singular()){
		wp_enqueue_script( 'base', get_template_directory_uri() . '/js/comments-ajax.js', array(), '1.00', true);
        //wp_enqueue_script( 'single', get_template_directory_uri() . '/js/single.js', array(), '1.00', true);
		wp_localize_script('base', 'SPECS', array(
        "um_ajaxurl" => admin_url('admin-ajax.php')
		));
	}
}
add_action('wp_enqueue_scripts', 'ajax_comment_scripts');
add_action('wp_ajax_nopriv_ajax_comment', 'ajax_comment');
add_action('wp_ajax_ajax_comment', 'ajax_comment');
function ajax_comment(){
    global $wpdb;
    $comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;
    $post = get_post($comment_post_ID);
    if ( empty($post->comment_status) ) {
        do_action('comment_id_not_found', $comment_post_ID);
        ajax_comment_err(__('Invalid comment status.'));
    }
    $status = get_post_status($post);
    $status_obj = get_post_status_object($status);
    if ( !comments_open($comment_post_ID) ) {
        do_action('comment_closed', $comment_post_ID);
        ajax_comment_err(__('Sorry, comments are closed for this item.'));
    } elseif ( 'trash' == $status ) {
        do_action('comment_on_trash', $comment_post_ID);
        ajax_comment_err(__('Invalid comment status.'));
    } elseif ( !$status_obj->public && !$status_obj->private ) {
        do_action('comment_on_draft', $comment_post_ID);
        ajax_comment_err(__('Invalid comment status.'));
    } elseif ( post_password_required($comment_post_ID) ) {
        do_action('comment_on_password_protected', $comment_post_ID);
        ajax_comment_err(__('Password Protected'));
    } else {
        do_action('pre_comment_on_post', $comment_post_ID);
    }
    $comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
    $comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
    $comment_author_url   = ( isset($_POST['url']) )     ? trim($_POST['url']) : null;
    $comment_content      = ( isset($_POST['comment']) ) ? trim($_POST['comment']) : null;
    $user = wp_get_current_user();
    if ( $user->exists() ) {
        if ( empty( $user->display_name ) )
            $user->display_name=$user->user_login;
        $comment_author       = $wpdb->escape($user->display_name);
        $comment_author_email = $wpdb->escape($user->user_email);
        $comment_author_url   = $wpdb->escape($user->user_url);
        $user_ID			  = $wpdb->escape($user->ID);
        if ( current_user_can('unfiltered_html') ) {
            if ( wp_create_nonce('unfiltered-html-comment_' . $comment_post_ID) != $_POST['_wp_unfiltered_html_comment'] ) {
                kses_remove_filters();
                kses_init_filters();
            }
        }
    } else {
        if ( get_option('comment_registration') || 'private' == $status )
            ajax_comment_err('对不起，您必须登录后才能进行评论');
    }
    $comment_type = '';
    if ( get_option('require_name_email') && !$user->exists() ) {
        if ( 6 > strlen($comment_author_email) || '' == $comment_author )
            ajax_comment_err('错误: 请填写如下信息 (姓名, 电子邮件)');
        elseif ( !is_email($comment_author_email))
            ajax_comment_err('错误: 请输入正确的邮件地址');
    }
    if ( '' == $comment_content )
        ajax_comment_err('请输入回复内容');
    $dupe = "SELECT comment_ID FROM $wpdb->comments WHERE comment_post_ID = '$comment_post_ID' AND ( comment_author = '$comment_author' ";
    if ( $comment_author_email ) $dupe .= "OR comment_author_email = '$comment_author_email' ";
    $dupe .= ") AND comment_content = '$comment_content' LIMIT 1";
    if ( $wpdb->get_var($dupe) ) {
        ajax_comment_err('重复回复，貌似您已经回复过该信息');
    }
    if ( $lasttime = $wpdb->get_var( $wpdb->prepare("SELECT comment_date_gmt FROM $wpdb->comments WHERE comment_author = %s ORDER BY comment_date DESC LIMIT 1", $comment_author) ) ) {
        $time_lastcomment = mysql2date('U', $lasttime, false);
        $time_newcomment  = mysql2date('U', current_time('mysql', 1), false);
        $flood_die = apply_filters('comment_flood_filter', false, $time_lastcomment, $time_newcomment);
        if ( $flood_die ) {
            ajax_comment_err('您回复速度太快了，请稍后在进行回复');
        }
    }
    $comment_parent = isset($_POST['comment_parent']) ? absint($_POST['comment_parent']) : 0;
    $commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');

    $comment_id = wp_new_comment( $commentdata );

    $comment = get_comment($comment_id);
    do_action('set_comment_cookies', $comment, $user);
    $comment_depth = 1;
    $tmp_c = $comment;
    while($tmp_c->comment_parent != 0){
        $comment_depth++;
        $tmp_c = get_comment($tmp_c->comment_parent);
    }
    $GLOBALS['comment'] = $comment;	//your comments here	edit start
    ?>
<li class="comments" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="comment-wrap">
        <div class="comment-author pull-left">
        <?php  echo get_avatar( $comment, 50 ); ?>
        </div>
        <div class="comment-body">
            <h4>
                <?php printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<small class="label label-primary">博主</small>' : ''
					); ?>
                <span class="comment-date">
                    刚刚
                </span>
            </h4>
            <?php if ( $comment->comment_approved == '0' ) : ?>
                <p class="comment-awaiting-moderation text-danger"><?php echo "您的评论正在等待审核"; ?></p>
            <?php endif; ?>
            <?php comment_text(); ?>
        </div>
    </div>
    <?php die();

}
function ajax_comment_err($a) {
    header('HTTP/1.0 500 Internal Server Error');
    header('Content-Type: text/plain;charset=UTF-8');
    echo $a;
    exit;
}
/* 评论作者链接新窗口打开 */
function specs_comment_author_link() {
    $url    = get_comment_author_url( $comment_ID );
    $author = get_comment_author( $comment_ID );
    if ( empty( $url ) || 'http://' == $url )
        return $author;
    else
        return "<a target='_blank' href='$url' rel='external nofollow' class='url'>$author</a>";
}
add_filter('get_comment_author_link', 'specs_comment_author_link');

//Ajax评论分页
//wp_enqueue_script( 'base', true);
add_action('wp_ajax_nopriv_ajax_comment_page_nav', 'ajax_comment_page_nav');
add_action('wp_ajax_ajax_comment_page_nav', 'ajax_comment_page_nav');
function ajax_comment_page_nav(){
    global $post,$wp_query, $wp_rewrite;
    $postid = $_POST["um_post"];
    $pageid = $_POST["um_page"];
    $comments = get_comments('post_id='.$postid);
    $post = get_post($postid);
    if( 'desc' != get_option('comment_order') ){
        $comments = array_reverse($comments);
    }
    $wp_query->is_singular = true;
    $baseLink = '';
    if ($wp_rewrite->using_permalinks()) {
        $baseLink = '&base=' . user_trailingslashit(get_permalink($postid) . 'comment-page-%#%', 'commentpaged');
    }
    echo '<ul class="commentlist">';
    wp_list_comments('callback=specs_comment&max_depth=10000&type=comment&avatar_size=50&page=' . $pageid . '&per_page=' . get_option('comments_per_page'), $comments);//注意修改mycomment这个callback
    echo '</ul>';
    echo '<p class="commentnav text-center" data-post-id="'.$postid.'">';
    paginate_comments_links('current=' . $pageid . '&prev_text=«&next_text=»');
    echo '</p>';
    die;
}


function comment_mail_notify($comment_id) {
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
    if (($parent_id != '') && ($spam_confirmed != 'spam')) {
        $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 發出點, no-reply 可改為可用的 e-mail.
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = '你在 ' . get_option('blogname') .' 的留言有了新回复';
		$message = '
			<div style="background: #F1F1F1;width: 100%;padding: 50px 0;">
				<div style="background: #FFF;width: 750px;margin: 0 auto;">
					<div style="padding: 10px 60px;background: #50A5E6;color: #FFF;font-size: 24px; font-weight: bold;"><a href="' . get_option('home') . '" style="text-decoration: none;color: #FFF;">' . get_option('blogname') . '</a></div>
					<h1 style="text-align: center;font-size: 26px;line-height: 50px;margin: 30px 60px;font-weight: bold;font-family: 宋体,微软雅黑,serif;">
						你在 [' . get_option('blogname') . '] 的留言有了新回复
					</h1>
					<div style="border-bottom: 1px solid #333;height: 0px;margin: 0 60px;"></div>
					<div style="margin: 30px 60px;color: #363636;">
						<p style="font-size: 16px;font-weight: bold;line-height: 30px;">Hi，' . trim(get_comment($parent_id)->comment_author) . '！</p>
						<div style="font-size: 16px;">
							<p><strong>你曾在本博客《' . get_the_title($comment->comment_post_ID) . '》的留言为：</strong></p>
							<blockquote style="border-left: 4px solid #ddd; padding: 5px 10px; line-height: 22px;">' . trim(get_comment($parent_id)->comment_content) . '</blockquote>
						</div>
						<div style="font-size: 16px;">
							<p><strong>' . trim($comment->comment_author) . ' 给你的回复为：</strong></p>
							<blockquote style="border-left: 4px solid #ddd; padding: 5px 10px; line-height: 22px;">' . trim($comment->comment_content) . ' </blockquote>
						</div>
						<p style="font-size: 16px;line-height: 30px;">
							你可以点击此链接 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '" style="text-decoration: none;color: #50A5E6;">查看完整回复内容</a> | 欢迎再次来访 <a href="' . get_option('home') . '" style="text-decoration: none;color: #50A5E6;">' . get_option('blogname') . '</a>
						</p>
						<p style="color: #999;">(此邮件由系统自动发出，请勿回复！)</p>
					</div>
					<div style="border-bottom: 1px solid #dfdfdf;height: 0px;margin: 0 60px;"></div>
					<div style="text-align: right;padding: 30px 60px;color: #999;">
						<p>Powered by ' . get_option('blogname') .'</p>
					</div>
				</div>
			</div>';

        $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail( $to, $subject, $message, $headers );
    }
}
add_action('comment_post', 'comment_mail_notify');

//评论表情替换
add_filter('smilies_src','custom_smilies_src',1,10);
function custom_smilies_src ($img_src, $img, $siteurl){
    return get_bloginfo('template_directory').'/images/smilies/'.$img;
}

/*评论通过邮件通知*/
add_action('comment_unapproved_to_approved', 'specs_comment_approved');
function specs_comment_approved($comment) {
    if(is_email($comment->comment_author_email)) {

        $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 發出點, no-reply 可改為可用的 e-mail.
        $to = trim($comment->comment_author_email);
        $post_link = get_permalink($comment->comment_post_ID);
        $subject = '你在 ' . get_option('blogname') .' 的留言已通过审核';
		$message = '
			<div style="background: #F1F1F1;width: 100%;padding: 50px 0;">
				<div style="background: #FFF;width: 750px;margin: 0 auto;">
					<div style="padding: 10px 60px;background: #50A5E6;color: #FFF;font-size: 24px; font-weight: bold;"><a href="' . get_option('home') . '" style="text-decoration: none;color: #FFF;">' . get_option('blogname') . '</a></div>
					<h1 style="text-align: center;font-size: 26px;line-height: 50px;margin: 30px 60px;font-weight: bold;font-family: 宋体,微软雅黑,serif;">
						你在 [' . get_option('blogname') . '] 的留言通过了审核
					</h1>
					<div style="border-bottom: 1px solid #333;height: 0px;margin: 0 60px;"></div>
					<div style="margin: 30px 60px;color: #363636;">
						<p style="font-size: 16px;font-weight: bold;line-height: 30px;">Hi，' . trim($comment->comment_author) . '！</p>
						<div style="font-size: 16px;">
							<p><strong>你在本博客《' . get_the_title($comment->comment_post_ID) . '》中的留言：</strong></p>
							<blockquote style="border-left: 4px solid #ddd; padding: 5px 10px; line-height: 22px;">'. trim($comment->comment_content) . '</blockquote>
							<p>
								通过了管理员的审核。
							</p>
						</div>

						<p style="font-size: 16px;line-height: 30px;">
							你可以点击此链接 <a href="'.get_comment_link( $comment->comment_ID ).'" style="text-decoration: none;color: #50A5E6;" >查看完整回复内容</a> | 欢迎再次来访 <a href="' . get_option('home') . '" style="text-decoration: none;color: #50A5E6;">' . get_option('blogname') . '</a>
						</p>
						<p style="color: #999;">(此邮件由系统自动发出，请勿回复！)</p>
					</div>
					<div style="border-bottom: 1px solid #dfdfdf;height: 0px;margin: 0 60px;"></div>
					<div style="text-align: right;padding: 30px 60px;color: #999;">
						<p>Powered by ' . get_option('blogname') .'</p>
					</div>
				</div>
			</div>';

        $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail( $to, $subject, $message, $headers );
    }
}
//首页幻灯片
function specs_slide(){
	if( !$output = get_option('specs_slides') ){
		$output = '';
		$specs_slide_on = of_get_option("show_slide") ? of_get_option("show_slide") : 0;
		if($specs_slide_on){
			for($i=1; $i<6; $i++){
				$specs_slide{$i} = of_get_option("specs_slide{$i}") ? of_get_option("specs_slide{$i}") : "";
				$specs_slide_url{$i} = of_get_option("specs_slide_url{$i}") ? of_get_option("specs_slide_url{$i}") : "";
				if($specs_slide{$i} ){
					$slides[] = $specs_slide{$i};
					$slides_url[] = $specs_slide_url{$i};
				}
			}
			$count = count($slides);
			//print_r($slides);print_r($slides_url);
			$output .= '<div id="slide" class="carousel slide" data-ride="carousel">';
			$output .= '<ol class="carousel-indicators">';
			for($i=0; $i<$count; $i++){
				$output .= '<li data-target="#slide" data-slide-to="'.$i.'"';
				if($i==0) $output .= 'class="active"';
				$output .= '></li>';
			};
			$output .='</ol>';
			$output .= '<div class="carousel-inner" role="listbox">';
			for($i=0;$i<$count;$i++){
				$output .= '<div class="item';
				if($i==0) $output .= ' active';
				$output .= '">';
				if(!empty($slides_url[$i])){
					$output .= '<a href="'.$slides_url[$i].'"><img src="'.$slides[$i].'"/></a>';
				}else{
					$output .= '<img src="'.$slides[$i].'"/>';
				}
				$output .= "</div>";
			};
			$output .= '</div>';
			$output .= '<a class="left carousel-control" href="#slide" role="button" data-slide="prev">';
			$output .= '<span class="glyphicon glyphicon-chevron-left"></span>';
			$output .= '<span class="sr-only">Previous</span></a>';
			$output .= '<a class="right carousel-control" href="#slide" role="button" data-slide="next">';
			$output .= '<span class="glyphicon glyphicon-chevron-right"></span>';
			$output .= '<span class="sr-only">Next</span></a></div>';
			update_option('specs_slides', $output);
		}
	}
	echo $output;
}

function clear_slides(){
	update_option('specs_slides', ''); // 清空 specs_slides
}
add_action( 'optionsframework_after_validate', 'clear_slides' );

// add span tag around categories post count
if(!function_exists('cat_count_span')){
	function cat_count_span($links) {
		return str_replace(array('</a> (',')'), array('</a> <span class="badge pull-right">','</span>'), $links);
	}
}
add_filter('wp_list_categories', 'cat_count_span');
function _9iphp_custom_css() {

	$css_options = array(
		'background_color' 					=> of_get_option('background_color'),
		);

	if(!empty($css_options)){ ?>
	<style type="text/css">
	<?php
		echo (!empty($css_options['background_color'])) ? 'body{ background: '.$css_options['background_color']. '; } ' : '';
	?>
	</style>
<?php }
}
add_action( 'wp_head', '_9iphp_custom_css', 100 );
//更改摘要长度及后缀
function _9iphp_excerpt_length($length) {
    return 170;
}
add_filter('excerpt_length', '_9iphp_excerpt_length');
function _9iphp_excerpt_more($more) {
    return '......';
}
add_filter('excerpt_more', '_9iphp_excerpt_more');

function _9iphp_post_thumbnail( $width = 255,$height = 130 ){
    global $post;
    $content = $post->post_content;
    preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
    $n = count($strResult[1]);
    if($n > 0){
        return '<img class="thumb pull-left" src="'.get_bloginfo('template_directory').'/images/lazy_loading.gif" data-original="'.get_bloginfo("template_url").'/timthumb.php?w='.$width.'&amp;h='.$height.'&amp;src='.$strResult[1][0].'" title="'.get_the_title().'" alt="'.get_the_title().'"/>';
    }
}
//Gravatar头像替换
function _9iphp_replace_avatar($avatar) {
  $avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "secure.gravatar.com", $avatar);
  return $avatar;
}
add_filter( 'get_avatar', '_9iphp_replace_avatar', 10, 3 );
