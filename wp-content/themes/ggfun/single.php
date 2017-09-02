<?php get_header(); ?>

<div class="article">
<div class="content-wrap">
	<div class="content">
		<?php setPostViews(get_the_ID()); ?>

		<?php while (have_posts()) : the_post(); ?>
		
        <?php
		$bfy = get_post_meta($post->ID,'vurl_value',true);
		if($bfy){
		?>
        <?php } ?>

        
        
		<?php if( dopt('d_adpost_01_b') ) echo '<div class="banner banner-post">'.dopt('d_adpost_01').'</div>'; ?>
		
		<article class="article-content">
			<header class="article-header">
				<h1 class="article-title"><?php the_title(); ?></h1>
			</header>
			<?php /*?>
			<div class="vauthor">
	                <span>文章简介：<?php echo strip_tags(get_the_excerpt()); ?></span>
	        </div>
	        <?php */ ?>
			<div class="vvedio"><?php echo $bfy; ?></div>
		
		</article>
                

		<?php endwhile;  ?>


		<div class="breadcrumbs"><?php echo deel_breadcrumbs() ?></div>

		
		<div class="art-info">
			<div class="meta">
				<time class="muted"><i class="ico icon-time icon12"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) )?></time>
				<span class="muted"><i class="ico icon-eye-open icon12"></i> <?php deel_views('浏览'); ?></span>
				<?php if ( comments_open() ) echo '<span class="muted"><i class="icon-comment icon12"></i> <a href="'.get_comments_link().'">'.get_comments_number('去', '1', '%').'评论</a></span>'; ?>
				<?php deel_share(); ?>
			</div>


			<div class="art-sumary">
				文章简介：<?php echo strip_tags(get_the_excerpt()); ?>				
			</div>

		</div>

		<footer class="article-footer">
			<?php the_tags('<div class="article-tags">所属专辑： ','',' </div>'); ?>
			
				<?php the_category('',''); ?>
		</footer>

        <div class="modA mb" id="tabB">
            <?php echo stripslashes(get_option( 'd_new_tab'));?>
        </div>
		<?php if( dopt('d_adpost_02_b') ) echo '<div class="banner banner-related">'.dopt('d_adpost_02').'</div>'; ?>

        <!-- div标签放在页面需要展示的位置  -->
		<div id="cyQing" role="cylabs" data-use="qing"></div>
		<?php comments_template('', true); ?>
		<!-- 如果页面已有畅言的评论框，以下代码放在评论框代码的后面，来读取评论框的配置，否则需在div标签或代码中配置sid、cid(分类id) -->
		<!-- 如果页面同时使用多个实验室项目，以下代码只需要引入一次，只配置上面的div标签即可 -->
		<script type="text/javascript" charset="utf-8" src="http://changyan.itc.cn/js/??lib/jquery.js,changyan.labs.js?appid=cyreEWc8O"></script>

		<?php if( dopt('d_adpost_03_b') ) echo '<div class="banner banner-comment">'.dopt('d_adpost_03').'</div>'; ?>

	</div>
</div>
<?php get_sidebar();?>
</div>
<?php get_footer(); ?>
<script src="http://js.3conline.com/min/temp/v2/core-pc_v1,dpl-tab_v2.js"></script>
<script>
new pc.tab({target:pc.getElems('#tabB .tcon'),control:pc.getElems('#tabB .thA i')});

</script>