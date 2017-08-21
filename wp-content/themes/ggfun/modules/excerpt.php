<?php if( dopt('d_adindex_02_b') ) printf('<div class="banner banner-sticky">'.dopt('d_adindex_02').'</div>'); ?>
<?php  
$_author = dopt('d_post_author_b');
$_time = dopt('d_post_time_b');
$_views = dopt('d_post_views_b');
$_comment = dopt('d_post_comment_b');
$vindex = 0;
?>

<div class="glist">
<div class="gcl">
<div class="gcll">
<?php while ( have_posts() ) : the_post(); ?>


<?php  

$_thumbnail = false;
if( has_post_thumbnail() || !dopt('d_thumbnail_b') ){
	$_thumbnail = true;
}
//$thistime = get_the_time('Y-m-d');
$thistime = get_the_time('m月d日');
?>

<?php if($vindex==0){?>
<div class="mtime"><em></em>&nbsp;<?php echo $thistime;?></div>
<div class="lpic clearfix">
<?php }?>

<?php if($thistime!=$ntitme && $vindex>0){?>
</div>
<div class="mtime"><em></em>&nbsp;<?php echo $thistime;?></div>
<div class="lpic clearfix">
<?php }?>

<?php if( $_thumbnail ){ ?>
<div class="focus">
<a href="<?php the_permalink(); ?>" class="thumbnail"><?php deel_thumbnail(); ?></a>
<i><a href="<?php the_permalink() ?>" title="<?php the_title(); ?> - <?php bloginfo('name'); ?>"><?php the_title(); ?></a></i>
<i>播放：<?php deel_views(''); ?>&nbsp;&nbsp;<?php if( !$_comment ){ ?>评论：<?php if ( comments_open() ) echo '<a href="'.get_comments_link().'">'.get_comments_number('0', '1', '%').'评论</a>';?><?php } ?></i>
</div><?php } ?>
<?php 
$vindex++;
$ntitme = $thistime;
endwhile; wp_reset_query(); ?>
</div>
</div>
</div>
<?php deel_paging(); ?>