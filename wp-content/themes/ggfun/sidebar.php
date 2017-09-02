<aside class="sidebar">	
<?php /*?><style>
.lmnr .lpic{padding:10px 10px 5px}
.lmnr .lcode{padding:5px 10px 10px; text-align:center}
.lmnr .lcode .ltitle{background:#999; color:#fff; text-align:left}
.lmnr .ltitle p{text-indent:2em}
.lmnr .lcode a{display:block; background:#999; height:30px; overflow:hidden; margin-top:10px; line-height:30px; color:#fff}
</style>
<div class="widget widget_meta lmnr">
	<div class="lpic"><img src="http://ww1.sinaimg.cn/bmiddle/44d511fejw1efkoy8eazcj20c8083abe.jpg" width="280" height="150" /></div>
    <div class="lcode">
    	<div class="ltitle">
        	<p>姓名：abc</p>
            <p>abc的简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介</p>
        </div>
        <a href="#">它的资料</a>
        <a href="#">它的资料</a>
        <a href="#">它的资料</a>
        <a href="#">它的资料</a>
        <a href="#">它的资料</a>
        <a href="#">它的资料</a>
        <a href="#">它的资料</a>
    </div>
</div><?php */?>
<?php 

if (is_single()){?>

    <div class="modA sbkk">
        <div class="thA">
            <span class="mark s1">随便看看 ^-^</span>
            <span class="subMark"><?php echo date('Y年m月d日', time());?></span>   
        </div>
        <div class="tbA">
            <ul class="pxb">
              <?php if (have_posts()):$args=array('showposts'=>'10','caller_get_posts' => 1, 'orderby' => 'meta_value', 'meta_key' => 'views', 'order' => 'desc' );$my_query=new WP_Query($args);$i=1;while ($my_query->have_posts()) : $my_query->the_post(); $do_not_duplicate = $post->ID;$ii='';if($i<10){$ii = '0'.$i;}else{$ii = $i;}?>
              <li><em class="view"><?php deel_views(''); ?></em> <a href="<?php the_permalink() ?>" title="<?php the_title(); ?> - <?php bloginfo('name'); ?>"><?php the_title(); ?></a></li>
              <?php $i++;endwhile;endif; ?>
            </ul>
        </div>
    </div>

<?php
    if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_postsidebar')) : endif; 
}else if (is_page()){
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_pagesidebar')) : endif; 
}else if (is_home()){
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_sidebar')) : endif; 
}else if (is_category()){
	
	//栏目内容
	// $skey = get_option('cat_meta_key_'.$cat);
	// if($skey){
	// 	echo '<div class="widget widget_meta lmnr">';
	// 		echo '<div class="lpic"><img src="'.$skey['pic'].'" width="280" height="150" /></div>';
	// 		echo '<div class="lcode">';
	// 		echo stripslashes($skey['code']);
	// 		echo '</div>';
	// 	echo '</div>';
	// }
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_othersidebar')) : endif; 
}else {
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_othersidebar')) : endif; 
}

if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_sitesidebar')) : endif; 

?>

</aside>