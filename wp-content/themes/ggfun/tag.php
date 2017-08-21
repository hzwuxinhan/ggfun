<?php get_header(); get_sidebar(); ?>
<div class="cat-content-wrap">
	<div class="cat-content">
		<header class="archive-header"> 
			<h1>标签：<?php echo single_tag_title(); ?></h1>
		</header>
		
		<?php /*
		<header class="archive-header"> 
			<h1>
				<a href="<?php echo get_category_link( get_cat_ID( single_cat_title('',false) ) ); ?>"><?php single_cat_title() ?></a>
			</h1>
			<?php if ( category_description() ) echo '<div class="archive-header-info">'.category_description().'</div>'; ?>
		</header>
		<?php */?>
		
		<?php include( 'modules/excerpt.php' ); ?>
	</div>
</div>
<?php get_footer(); ?>