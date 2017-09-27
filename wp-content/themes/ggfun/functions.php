<?php

$dname = 'D8';

add_action( 'after_setup_theme', 'deel_setup' );

include('admin/d8.php');
include('widgets/index.php');

function deel_setup(){
  
	//去除头部冗余代码
	remove_action( 'wp_head',   'feed_links_extra', 3 ); 
	remove_action( 'wp_head',   'rsd_link' ); 
	remove_action( 'wp_head',   'wlwmanifest_link' ); 
	remove_action( 'wp_head',   'index_rel_link' ); 
	remove_action( 'wp_head',   'start_post_rel_link', 10, 0 ); 
	remove_action( 'wp_head',   'wp_generator' ); 

	//隐藏admin Bar
	add_filter('show_admin_bar','hide_admin_bar');

	//关键字
	add_action('wp_head','deel_keywords');   

	//页面描述 
	add_action('wp_head','deel_description');   

	//阻止站内PingBack
	if( dopt('d_pingback_b') ){
		add_action('pre_ping','deel_noself_ping');   
	}   

	//评论回复邮件通知
	add_action('comment_post','comment_mail_notify'); 

	//自动勾选评论回复邮件通知，不勾选则注释掉 
	// add_action('comment_form','deel_add_checkbox');

	//评论表情改造，如需更换表情，img/smilies/下替换
	add_filter('smilies_src','deel_smilies_src',1,10); 

	//文章末尾增加版权
	add_filter('the_content','deel_copyright');    

	//移除自动保存和修订版本
	if( dopt('d_autosave_b') ){
		add_action('wp_print_scripts','deel_disable_autosave' );
		remove_action('pre_post_update','wp_save_post_revision' );
	}

	//去除自带js
	wp_deregister_script( 'l10n' ); 

	//修改默认发信地址
	add_filter('wp_mail_from', 'deel_res_from_email');
	add_filter('wp_mail_from_name', 'deel_res_from_name');

	//缩略图设置
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(220, 150, true); 

	add_editor_style('editor-style.css');

	//头像缓存  
	if( dopt('d_avatar_b') ){
		add_filter('get_avatar','deel_avatar');  
	}

	//定义菜单
	if (function_exists('register_nav_menus')){
		register_nav_menus( array(
			'nav' => __('网站导航'),
			'pagemenu' => __('页面导航')
		));
	}
	
	//注册自定字段
	add_action('admin_menu', 'create_meta_box');
	add_action('save_post', 'save_postdata');
}

if (function_exists('register_sidebar')){
	register_sidebar(array(
		'name'          => '全站侧栏',
		'id'            => 'widget_sitesidebar',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget_tit"><i class="s2">',
		'after_title'   => '</i><i class="upd">收起</i></h3>'
	));
	register_sidebar(array(
		'name'          => '首页侧栏',
		'id'            => 'widget_sidebar',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget_tit">',
		'after_title'   => '</h3>'
	));
	register_sidebar(array(
		'name'          => '分类/标签/搜索页侧栏',
		'id'            => 'widget_othersidebar',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget_tit">',
		'after_title'   => '</h3>'
	));
	register_sidebar(array(
		'name'          => '文章页侧栏',
		'id'            => 'widget_postsidebar',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget_tit">',
		'after_title'   => '</h3>'
	));
	register_sidebar(array(
		'name'          => '页面侧栏',
		'id'            => 'widget_pagesidebar',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget_tit">',
		'after_title'   => '</h3>'
	));
}


function deel_breadcrumbs(){
    if( !is_single() ) return false;
    $categorys = get_the_category();
    $category = $categorys[0];
    
    return '你的位置：<a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a> <small>></small> '.get_category_parents($category->term_id, true, ' <small>></small> ');
}

// 取消原有jQuery
function footerScript() {
    if ( !is_admin() ) {
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.js', false, '3.0', dopt('d_jquerybom_b') ? true : false );   
        wp_enqueue_script( 'jquery' );   
    }  
}  
add_action( 'init', 'footerScript' );


if ( ! function_exists( 'deel_paging' ) ) :
function deel_paging() {
    $p = 4;
    if ( is_singular() ) return;
    global $wp_query, $paged;
    $max_page = $wp_query->max_num_pages;
    if ( $max_page == 1 ) return; 
    echo '<div class="pagination"><ul>';
    if ( empty( $paged ) ) $paged = 1;
    // echo '<span class="pages">Page: ' . $paged . ' of ' . $max_page . ' </span> '; 
    echo '<li class="prev-page">'; previous_posts_link('上一页'); echo '</li>';

    if ( $paged > $p + 1 ) p_link( 1, '<li>第一页</li>' );
    if ( $paged > $p + 2 ) echo "<li><span>···</span></li>";
    for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { 
        if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<li class=\"active\"><span>{$i}</span></li>" : p_link( $i );
    }
    if ( $paged < $max_page - $p - 1 ) echo "<li><span> ... </span></li>";
    //if ( $paged < $max_page - $p ) p_link( $max_page, '&raquo;' );
    echo '<li class="next-page">'; next_posts_link('下一页'); echo '</li>';
    // echo '<li><span>共 '.$max_page.' 页</span></li>';
    echo '</ul></div>';
}
function p_link( $i, $title = '' ) {
    if ( $title == '' ) $title = "第 {$i} 页";
    echo "<li><a href='", esc_html( get_pagenum_link( $i ) ), "'>{$i}</a></li>";
}
endif;

function deel_strimwidth($str ,$start , $width ,$trimmarker ){
    $output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start.'}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$width.'}).*/s','\1',$str);
    return $output.$trimmarker;
}

function dopt($e){
		return stripslashes(get_option($e));
	}

if ( ! function_exists( 'deel_views' ) ) :
function deel_record_visitors(){
	if (is_singular()) 
	{
	  global $post;
	  $post_ID = $post->ID;
	  if($post_ID) 
	  {
		  $post_views = (int)get_post_meta($post_ID, 'views', true);
		  if(!update_post_meta($post_ID, 'views', ($post_views+1))) 
		  {
			add_post_meta($post_ID, 'views', 1, true);
		  }
	  }
	}
}
add_action('wp_head', 'deel_record_visitors');  

function deel_views_true($after=''){
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'post_views_count', true);
  echo $views, $after;
}

function deel_views($after=''){
	global $post;
	$post_ID = $post->ID;
	$views = (int)get_post_meta($post_ID, 'views', true);
	echo $views, $after;
  }
endif;

if ( ! function_exists( 'deel_thumbnail' ) ) :
function deel_thumbnail() {  
	global $post;  
	if ( has_post_thumbnail() ) {   
		$domsxe = simplexml_load_string(get_the_post_thumbnail());
		$thumbnailsrc = $domsxe->attributes()->src;  
		echo '<img src="'.$thumbnailsrc.'" alt="'.trim(strip_tags( $post->post_title )).'" />';
	} else {
		$content = $post->post_content;  
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);  
		$n = count($strResult[1]);  
		if($n > 0){
			echo '<img src="'.$strResult[1][0].'" alt="'.trim(strip_tags( $post->post_title )).'" />';  
		}else {
			echo '<img src="'.get_bloginfo('template_url').'/img/thumbnail.png" alt="'.trim(strip_tags( $post->post_title )).'" />';  
		}  
	}
}
endif;


/*function custom_login() {   
	echo '<link rel="stylesheet" href="' . get_bloginfo('template_directory') . '/misc/login.css">'; 
}
add_action('login_head', 'custom_login');   */


$dHasShare = false;
function deel_share(){
  echo '<div class="bshare-custom"><a title="分享到QQ空间" class="bshare-qzone"></a><a title="分享到新浪微博" class="bshare-sinaminiblog"></a><a title="分享到人人网" class="bshare-renren"></a><a title="分享到腾讯微博" class="bshare-qqmb"></a><a title="分享到网易微博" class="bshare-neteasemb"></a><a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a><span class="BSHARE_COUNT bshare-share-count">0</span></div><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>';
  global $dHasShare;
  $dHasShare = true;
}

function deel_avatar_default(){ 
  return get_bloginfo('template_directory').'/img/default.png';
}

//评论头像缓存
function deel_avatar($avatar) {
  $tmp = strpos($avatar, 'http');
  $g = substr($avatar, $tmp, strpos($avatar, "'", $tmp) - $tmp);
  $tmp = strpos($g, 'avatar/') + 7;
  $f = substr($g, $tmp, strpos($g, "?", $tmp) - $tmp);
  $w = get_bloginfo('wpurl');
  $e = ABSPATH .'avatar/'. $f .'.png';
  $t = dopt('d_avatarDate')*24*60*60; 
  if ( !is_file($e) || (time() - filemtime($e)) > $t ) 
	copy(htmlspecialchars_decode($g), $e);
  else  
	$avatar = strtr($avatar, array($g => $w.'/avatar/'.$f.'.png'));
  if ( filesize($e) < 500 ) 
	copy(get_bloginfo('template_directory').'/img/default.png', $e);
  return $avatar;
}




//关键字
function deel_keywords() {
  global $s, $post;
  $keywords = '';
  if ( is_single() ) {
		$keywords = get_post_meta($post->ID, "keywords_value", true);
		if($keywords == '') {
			if ( get_the_tags( $post->ID ) ) {
				foreach ( get_the_tags( $post->ID ) as $tag ) $keywords .= $tag->name . ', ';
			}
			foreach ( get_the_category( $post->ID ) as $category ) $keywords .= $category->cat_name . ', ';
			$keywords = substr_replace( $keywords , '' , -2);
		}
  } elseif ( is_home () )    {
		 $keywords = dopt('d_keywords');
  } elseif ( is_tag() )      {
			$tagid = get_current_tag_id();
			$yourtags = get_tag($tagid);
			$term_meta = get_option( "ludou_taxonomy_$tagid" );
			$keywords = $term_meta['tax_keywords'] ? $term_meta['tax_keywords'] : $yourtags->name;
		//  $keywords = single_tag_title('', false);
  } elseif ( is_category() ) {
			global $wp_query;
			$category_id = get_query_var('cat');
			$yourcat = get_category($category_id);
			$term_meta = get_option( "ludou_taxonomy_$category_id" );
			$keywords = $term_meta['tax_keywords'] ? $term_meta['tax_keywords'] : $yourcat->name;
  } elseif ( is_search() )   {
		 $keywords = esc_html( $s, 1 );
  } else { $keywords = trim( wp_title('', false) );
  }
  if ( $keywords ) {
		echo "<meta name=\"keywords\" content=\"$keywords\">\n";
  }
}

//网站描述
function deel_description() {
  global $s, $post;
  $description = '';
  $blog_name = get_bloginfo('name');
  if ( is_singular() ) {
	if( !empty( $post->post_excerpt ) ) {
	  $text = $post->post_excerpt;
	} else {
	  $text = $post->post_content;
	}
	$description = trim( str_replace( array( "\r\n", "\r", "\n", "　", " "), " ", str_replace( "\"", "'", strip_tags( $text ) ) ) );
	if ( !( $description ) ) $description = $blog_name . "-" . trim( wp_title('', false) );
  } elseif ( is_home () )    { $description = dopt('d_description'); // 首頁要自己加
  } elseif ( is_tag() )      { $description = $blog_name . "'" . single_tag_title('', false) . "'";
  } elseif ( is_category() ) { $description = trim(strip_tags(category_description()));
  } elseif ( is_archive() )  { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
  } elseif ( is_search() )   { $description = $blog_name . ": '" . esc_html( $s, 1 ) . "' 的搜索結果";
  } else { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
  }
  $description = mb_substr( $description, 0, 220, 'utf-8' );
  echo "<meta name=\"description\" content=\"$description\">\n";
}

function hide_admin_bar($flag) {
	return false;
}

//最新发布加new 单位'小时'
function deel_post_new($timer='48'){
  $t=( strtotime( date("Y-m-d H:i:s") )-strtotime( $post->post_date ) )/3600; 
  if( $t < $timer ) echo "<i>new</i>";
}

//修改评论表情调用路径
function deel_smilies_src ($img_src, $img, $siteurl){
	return get_bloginfo('template_directory').'/img/smilies/'.$img;
}


//阻止站内文章Pingback 
function deel_noself_ping( &$links ) {
  $home = get_option( 'home' );
  foreach ( $links as $l => $link )
  if ( 0 === strpos( $link, $home ) )
  unset($links[$l]);
}


//移除自动保存
function deel_disable_autosave() {
  wp_deregister_script('autosave');
}


//修改默认发信地址
function deel_res_from_email($email) {
	$wp_from_email = get_option('admin_email');
	return $wp_from_email;
}
function deel_res_from_name($email){
	$wp_from_name = get_option('blogname');
	return $wp_from_name;
}


//评论回应邮件通知
function comment_mail_notify($comment_id) {
  $admin_notify = '1'; // admin 要不要收回复通知 ( '1'=要 ; '0'=不要 )
  $admin_email = get_bloginfo ('admin_email'); // $admin_email 可改为你指定的 e-mail.
  $comment = get_comment($comment_id);
  $comment_author_email = trim($comment->comment_author_email);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  global $wpdb;
  if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '')
	$wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
  if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1'))
	$wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
  $notify = $parent_id ? get_comment($parent_id)->comment_mail_notify : '0';
  $spam_confirmed = $comment->comment_approved;
  if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
	$wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 发出点, no-reply 可改为可用的 e-mail.
	$to = trim(get_comment($parent_id)->comment_author_email);
	$subject = 'Hi，您在 [' . get_option("blogname") . '] 的留言有人回复啦！';
	$message = '
	<div style="color:#333;font:100 14px/24px microsoft yahei;">
	  <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
	  <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br /> &nbsp;&nbsp;&nbsp;&nbsp; '
	   . trim(get_comment($parent_id)->comment_content) . '</p>
	  <p>' . trim($comment->comment_author) . ' 给您的回应:<br /> &nbsp;&nbsp;&nbsp;&nbsp; '
	   . trim($comment->comment_content) . '<br /></p>
	  <p>点击 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看回应完整內容</a></p>
	  <p>欢迎再次光临 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
	  <p style="color:#999">(此邮件由系统自动发出，请勿回复.)</p>
	</div>';
	$from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
	$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
	wp_mail( $to, $subject, $message, $headers );
	//echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
  }
}

//自动勾选 
function deel_add_checkbox() {
  echo '<label for="comment_mail_notify" class="checkbox inline" style="padding-top:0"><input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" value="comment_mail_notify" checked="checked"/>有人回复时邮件通知我</label>';
}

//文章（包括feed）末尾加版权说明
function deel_copyright($content) {
	if( !is_page() ){
		$pid = get_the_ID();
		$name = get_post_meta($pid, 'from.name', true);
		$link = get_post_meta($pid, 'from.link', true);
		$show = false;
		if( $name ){
			$show = $name;
			if( $link ){
				$show = '<a target="_blank" href="'.$link.'">'.$show.'</a>';
			}
		}else if( $link ){
			$show = '<a target="_blank" href="'.$link.'">'.$link.'</a>';
		}
		if( $show ){
			$content.= '<p>来源：'.$show.'</p>';
		}
		// $content.= '<p>转载请注明：<a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a> &raquo; <a href="'.get_permalink().'">'.get_the_title().'</a></p>';
	}
	return $content;
}

//时间显示方式‘xx以前’
function time_ago( $type = 'commennt', $day = 7 ) {
  $d = $type == 'post' ? 'get_post_time' : 'get_comment_time';
  if (time() - $d('U') > 60*60*24*$day) return;
  echo ' (', human_time_diff($d('U'), strtotime(current_time('mysql', 0))), '前)';
}


function timeago( $ptime ) {
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if($etime < 1) return '刚刚';
    $interval = array (
        12 * 30 * 24 * 60 * 60  =>  '年前 ('.date('Y-m-d', $ptime).')',
        30 * 24 * 60 * 60       =>  '个月前 ('.date('m-d', $ptime).')',
        7 * 24 * 60 * 60        =>  '周前 ('.date('m-d', $ptime).')',
        24 * 60 * 60            =>  '天前',
        60 * 60                 =>  '小时前',
        60                      =>  '分钟前',
        1                       =>  '秒前'
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}


//评论样式
function deel_comment_list($comment, $args, $depth) {
  echo '<li '; comment_class(); echo ' id="comment-'.get_comment_ID().'">';

  //头像
  echo '<div class="c-avatar">';
  echo str_replace(' src=', ' data-original=', get_avatar( $comment->comment_author_email, $size = '36' , deel_avatar_default())); 
  echo '</div>';
  //内容
  echo '<div class="c-main" id="div-comment-'.get_comment_ID().'">';
	echo str_replace(' src=', ' data-original=', convert_smilies(get_comment_text()));
	if ($comment->comment_approved == '0'){
	  echo '<span class="c-approved">您的评论正在排队审核中，请稍后！</span><br />';
	}
	//信息
	echo '<div class="c-meta">';
		echo '<span class="c-author">'.get_comment_author_link().'</span>';
		echo get_comment_time('Y-m-d H:i '); echo time_ago(); 
		if ($comment->comment_approved !== '0'){ 
			echo comment_reply_link( array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); 
		echo edit_comment_link(__('(编辑)'),' - ','');
	  } 
	echo '</div>';
  echo '</div>';
}



//自定义域
$new_meta_boxes =
array(
	"vurl" => array(
    	"name" => "vurl",
    	"std" => "",
    	"title" => "视频地址:"),
    "keywords" => array(
    	"name" => "keywords",
    	"std" => "",
    	"title" => "关键词:"),
);

function new_meta_boxes() {
    global $post, $new_meta_boxes;
    foreach($new_meta_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];
        echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
        // 自定义字段标题
        echo'<h4>'.$meta_box['title'].'</h4>';
        // 自定义字段输入框
        echo '<textarea cols="" style="width:98%; height:4em" rows="1" name="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';
    }

}

function create_meta_box() {
    global $theme_name;
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', '自定义模块', 'new_meta_boxes', 'post', 'normal', 'high' );
    }
}

function save_postdata( $post_id ) {
    global $post, $new_meta_boxes;
    foreach($new_meta_boxes as $meta_box) {
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {
            return $post_id;
        }

        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ))
                return $post_id;
        }else {
            if ( !current_user_can( 'edit_post', $post_id ))
                return $post_id;
        }

        $data = $_POST[$meta_box['name'].'_value'];
        if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
            add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
            update_post_meta($post_id, $meta_box['name'].'_value', $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
    }
}

function custom_posts_per_page($query){
	echo is_category();
	if(is_search() || is_404() || is_category() || is_tag()){
			$query->set('posts_per_page',40);//搜索页显示所有匹配的文章，不分页
	}
}

//this adds the function above to the 'pre_get_posts' action    
add_action('pre_get_posts','custom_posts_per_page');

class Add_Key_words{
 
    function __construct(){
        
        // 分类
				add_action( 'category_add_form_fields', array( $this, 'add_tax_image_field' ) );
				add_action( 'category_edit_form_fields', array( $this, 'edit_tax_image_field' ) );
				add_action( 'edited_category', array( $this, 'save_tax_meta' ), 10, 2 );
				add_action( 'create_category', array( $this, 'save_tax_meta' ), 10, 2 );


				// 标签
				add_action( 'post_tag_add_form_fields', array( $this, 'add_tax_image_field' ) );
				add_action( 'post_tag_edit_form_fields', array( $this, 'edit_tax_image_field' ) );
				add_action( 'edited_post_tag', array( $this, 'save_tax_meta' ), 10, 2 );
				add_action( 'create_post_tag', array( $this, 'save_tax_meta' ), 10, 2 );
 
 
    } // __construct
 
    /**
     * 新建分类页面添加自定义字段输入框
     */
    public function add_tax_image_field(){
    ?>
        <div class="form-field">
            <label for="term_meta[tax_keywords]">关键字</label>
            <input type="text" name="term_meta[tax_keywords]" id="term_meta[tax_keywords]" value="" />
            <p class="description">输入关键字</p>
        </div>
		<div class="form-field">
            <label for="term_meta[tax_title]">标题</label>
            <input type="text" name="term_meta[tax_title]" id="term_meta[tax_title]" value="" />
            <p class="description">输入标题</p>
        </div>

    <?php
    } // add_tax_image_field
 
    /**
     * 编辑分类页面添加自定义字段输入框
     *
     * @uses get_option()       从option表中获取option数据
     * @uses esc_url()          确保字符串是url
     */
    public function edit_tax_image_field( $term ){
        
        // $term_id 是当前分类的id
        $term_id = $term->term_id;
        
        // 获取已保存的option
        $term_meta = get_option( "ludou_taxonomy_$term_id" );
        // option是一个二维数组
		$keywords = $term_meta['tax_keywords'] ? $term_meta['tax_keywords'] : '';
		$title = $term_meta['tax_title'] ? $term_meta['tax_title'] : '';
    ?>
        
        
        <tr class="form-field">
            <th scope="row">
                <label for="term_meta[tax_keywords]">关键字</label>
                <td>
                    <input type="text" name="term_meta[tax_keywords]" id="term_meta[tax_keywords]" value="<?php echo $keywords; ?>" />
                    <p class="description">输入关键字</p>
                </td>
            </th>
        </tr>
		<tr class="form-field">
            <th scope="row">
                <label for="term_meta[tax_title]">标题</label>
                <td>
                    <input type="text" name="term_meta[tax_title]" id="term_meta[tax_title]" value="<?php echo $title; ?>" />
                    <p class="description">输入标题</p>
                </td>
            </th>
        </tr>
       
        
    <?php
    } // edit_tax_image_field
 
    /**
     * 保存自定义字段的数据
     *
     * @uses get_option()      从option表中获取option数据
     * @uses update_option()   更新option数据，如果没有就新建option
     */
    public function save_tax_meta( $term_id ){
 
        if ( isset( $_POST['term_meta'] ) ) {
            
            // $term_id 是当前分类的id
            $t_id = $term_id;
            $term_meta = array();
            
            // 获取表单传过来的POST数据，POST数组一定要做过滤
			$term_meta['tax_keywords'] = isset ( $_POST['term_meta']['tax_keywords'] ) ?  $_POST['term_meta']['tax_keywords'] : '';
			$term_meta['tax_title'] = isset ( $_POST['term_meta']['tax_title'] ) ?  $_POST['term_meta']['tax_title'] : '';

            // 保存option数组
            update_option( "ludou_taxonomy_$t_id", $term_meta );
 
        } // if isset( $_POST['term_meta'] )
    } // save_tax_meta
 
} // Ludou_Tax_Image
 
$wptt_tax_image = new Add_Key_words();

function get_current_tag_id() {
	$current_tag = single_tag_title('', false);//获得当前TAG标签名称
	$tags = get_tags();//获得所有TAG标签信息的数组
	foreach($tags as $tag) {
		if($tag->name == $current_tag) return $tag->term_id; //获得当前TAG标签ID，其中term_id就是tag ID
	}
}

function setPostViews($postID) {
	$count_key = 'post_views_count';
	$currentDay_key = 'view_day';
	$currentDay = get_post_meta($postID,$currentDay_key,true);
	$count = get_post_meta($postID, $count_key, true);
	date_default_timezone_set('PRC');
	$currentTime = date('Ymd', time());
	if($currentDay == $currentTime) {
		if($count == ''){
			$count = 1;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, $count);
		}else {
			$count++;
		    update_post_meta($postID, $count_key, $count);
		}
	}else {
		if($currentDay == '') {
			$currentDay = $currentTime;
			$count = 1;
			delete_post_meta($postID, $count_key);
			delete_post_meta($postID, $currentDay_key);
			add_post_meta($postID, $count_key, $count);
			add_post_meta($postID, $currentDay_key, $currentDay);
		}else {
			$currentDay = $currentTime;
			$count = 1;
			update_post_meta($postID, $count_key, $count);
			update_post_meta($postID, $currentDay_key, $currentDay);
		}
	}
}
