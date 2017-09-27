<?php get_header();$mdt = stripslashes(get_option('d_new_top'));$mdt = explode('-----',$mdt);$read = stripslashes(get_option('d_new_read'));$read = explode('-----',$read);?>
<div class="p1 con mb clearfix">
	<div class="colA">
    	<div class="slide mb slider-pic" id="tabA">
           <dl class="clearfix">
           
            	<?php echo stripslashes(get_option( 'd_new_jdt'));?>
            </dl>
        </div>
        <div class="modA" id="tabB">
        	<?php echo stripslashes(get_option( 'd_new_tab'));?>
        </div>
    </div>
    <div class="colB">
    	<div class="modA sbkk">
        <div class="thA">
          <span class="mark s1">点击排行榜 ^-^</span>
          <span class="subMark"><?php date_default_timezone_set('PRC');echo date('Y年m月d日', time());?></span>	
        </div>
        <div class="tbA">
          <ul class="pxb">
              <?php if (have_posts()):
              $meta_query=array(
                  array(
                    'key' => 'view_day',
                    'value' => date('Ymd', time()),
                  )
              );
              $args=array('meta_query'=>$meta_query,'showposts'=>'10','caller_get_posts' => 1, 'orderby' => 'meta_value_num','meta_key'=>'post_views_count','order' => 'desc' );
              $my_query=new WP_Query($args);
              $i=1;
              while ($my_query->have_posts()) : $my_query->the_post();
                $do_not_duplicate = $post->ID;
                $ii='';
                if($i<10){
                  $ii = '0'.$i;
                  }else{
                    $ii = $i;
              }
              ?>
              <li>
                <em class="view"><?php deel_views_true(''); ?></em> 
                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?> - <?php bloginfo('name'); ?>"><?php the_title(); ?></a></li>
              <?php $i++;endwhile;endif; ?>
            </ul>
        </div>
      </div>
    </div>
</div>

<div class="p2 con conA mb clearfix">
    <?php
      foreach($mdt as $mdtindex => $onemdt) {
        $submdt = stripslashes($onemdt);$submdt = explode('|||',$submdt);
    ?>
      <div class="modA" id="tdsup<?php echo $mdtindex; ?>">
        <div class="thA">
          <?php
              foreach($submdt as $submdtindex => $onesubmdt ) {
          ?>
          <i class="toc"><?php echo $onesubmdt;?></i>
          <?php
              }
          ?>
          <span class="subMark s3"><span class="ico"></span><a href="#">more</a></span>
        </div>
        <div class="tbA">
          <?php 
            $subread = stripslashes($read[$mdtindex]);
            $subread = explode('|||',$subread);
            foreach($subread as $subreadindex => $onesubread) {
          ?>
          <div class="toc-item">

            <div class="lpic">
              <ul class="clearfix">
                    <?php if (have_posts()):$args=array('showposts'=>'18','category__in' => array( $onesubread ),'caller_get_posts' => 1);
                    $my_query=new WP_Query($args);
                    while ($my_query->have_posts()) : $my_query->the_post(); 
                    $do_not_duplicate = $post->ID;
                    // print_r($posts);
                    ?>
                    <li class="focus">
                      <a href="<?php the_permalink(); ?>" class="thumbnail" title="<?php the_title(); ?> - <?php bloginfo('name'); ?>">
                        <em class="cov"><em class="covs"></em></em>
                        <?php deel_thumbnail(); ?>

                        <i class="tit"><?php the_title(); ?></i>
                        <i class="tim">
                          <span class="tv"><?php deel_views(''); ?></span>
                          <span class="tt"><?php the_time('Y-m-d');?></span>                  
                        </i>
                      </a>
                    </li>
                    <?php endwhile;endif; ?>
              </ul>
            </div>

          </div>


          <?php
            }
          ?>

            
        </div>
      </div>
     <?php }
    ?>
    
</div>


<div style="display: block;" class="rollto"><button class="btn btn-inverse" data-type="totop" title="回顶部"><i class="icon-eject icon-white"></i></button></div>

<?php get_footer(); ?>

<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
<script src="http://js.3conline.com/min/temp/v1/lib-jquery1.4.2,dpl-jquery.slide.js"></script>

<script>

new Slide({
    target: $('#tabA dd div'),
    control: $('#tabA dt a'),
    effect: 'slide',
    autoPlay: true,
    onchange: function() {
        
    }
});

new Slide({
  target:$('#tabB .tcon'),
  control:$('#tabB .thA i')
});



for(var i=0;i< <?php echo sizeof($mdt) ?>;i++) {
  (function(e){
    var na = $('#tdsup'+e+' .toc .subMark a'),
      s3a = $('#tdsup'+e+' .s3 a');
    new Slide({
      target: $('#tdsup'+e+' .toc-item'),
      control: $('#tdsup'+e+' .toc'),
      onchange: function() {
        s3a.attr('href',na.eq(this.curPage).attr('href'));
      }
    });
  })(i)
  
}

</script>