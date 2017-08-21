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
$thistime = get_the_time('Y-m-d');
?>









<?php if($vindex==0){?>
<div class="mtime"><em></em>&nbsp;&nbsp;&nbsp;<?php echo $thistime;?></div>
<div class="lpic clearfix">
<div class="lpic-ul">
<?php }?>

<?php if($thistime!=$ntitme && $vindex>0){?>
</div>
</div>
<div class="mtime"><em></em>&nbsp;&nbsp;&nbsp;<?php echo $thistime;?></div>
<div class="lpic clearfix">
<div class="lpic-ul">
<?php }?>


<?php if( $_thumbnail ){ ?>

<div class="focus">
  <a href="<?php the_permalink(); ?>" class="thumbnail" title="<?php the_title(); ?> - <?php bloginfo('name'); ?>">
    <em class="cov"><em class="covs"></em></em>
    <?php deel_thumbnail(); ?>

    <i class="tit"><?php the_title(); ?></i>
    <i class="tim">
      <span class="tv"><?php deel_views(''); ?></span>
      <span class="tt"><?php the_time('Y-m-d');?></span>                  
    </i>
  </a>
</div>
<?php } ?>



<?php 
$vindex++;
?>

<?php
$ntitme = $thistime;
endwhile; wp_reset_query(); ?>

</div>
</div>
</div>
<?php deel_paging(); ?>