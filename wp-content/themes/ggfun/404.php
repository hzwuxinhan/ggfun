<?php get_header(); get_sidebar();  ?>
<div class="cat-content-wrap">
	<div class="cat-content">
	<div class="404h1">
		<h2 class="404h2">404</h2>
		抱歉，沒有找到您需要的内容！
	</div>
	<h1 class="page-title 404h3">给您推荐以下内容：</h1>
	<?php 
		$args = array(
		    'order'   => DESC,
		    'caller_get_posts' => 1,
		    'posts_per_page' => 40
		);
   		query_posts($args);
	?>
	<?php include( 'modules/excerpt.php' ); ?>
</div>
</div>
<?php get_footer(); ?>