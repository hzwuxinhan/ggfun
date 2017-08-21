<?php get_header();$mdt = stripslashes(get_option('d_new_top'));$mdt = explode('|||',$mdt);$read = stripslashes(get_option('d_new_read'));$read = explode('|',$read);?>
<div class="p1 con mb clearfix">
	<div class="colA">
    	<div class="slide mb" id="tabA">
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
    </div>
</div>

<div class="p2 con conA mb clearfix">
    <div class="modA" id="tdsup">
        <div class="thA">
          <span class="sts s2">今日更新</span>

          <i class="toc">【<?php echo $mdt[0];?>】</i>
          <i class="toc">【<?php echo $mdt[1];?>】</i>
          <i class="toc">【<?php echo $mdt[2];?>】</i>
          <i class="toc">【<?php echo $mdt[3];?>】</i>
          <i class="toc">【<?php echo $mdt[4];?>】</i>
          <i class="toc">【<?php echo $mdt[5];?>】</i>
          <i class="toc">【<?php echo $mdt[6];?>】</i>
          
          <span class="subMark s3"><a href="#">more</a></span>
        </div>
        <div class="tbA">

          <div class="toc-item">

            <div class="lpic">
              <ul class="clearfix">
                    <?php if (have_posts()):$args=array('showposts'=>'24','category__in' => array( $read[0] ),'caller_get_posts' => 1);
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


          <div class="toc-item">

            <div class="lpic">
              <ul class="clearfix">
                    <?php if (have_posts()):$args=array('showposts'=>'24','category__in' => array( $read[1] ),'caller_get_posts' => 1);
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



          <div class="toc-item">

            <div class="lpic">
              <ul class="clearfix">
                    <?php if (have_posts()):$args=array('showposts'=>'24','category__in' => array( $read[2] ),'caller_get_posts' => 1);
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




          <div class="toc-item">

            <div class="lpic">
              <ul class="clearfix">
                    <?php if (have_posts()):$args=array('showposts'=>'24','category__in' => array( $read[3] ),'caller_get_posts' => 1);
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



          <div class="toc-item">

            <div class="lpic">
              <ul class="clearfix">
                    <?php if (have_posts()):$args=array('showposts'=>'24','category__in' => array( $read[4] ),'caller_get_posts' => 1);
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



          <div class="toc-item">

            <div class="lpic">
              <ul class="clearfix">
                    <?php if (have_posts()):$args=array('showposts'=>'24','category__in' => array( $read[5] ),'caller_get_posts' => 1);
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



          <div class="toc-item">

            <div class="lpic">
              <ul class="clearfix">
                    <?php if (have_posts()):$args=array('showposts'=>'24','category__in' => array( $read[6] ),'caller_get_posts' => 1);
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
            
        </div>
    </div>
</div>

<?php /* ?>

<div class="p2 con conA mb clearfix">
    <div class="modA">
        <div class="thA"><?php echo $mdt[1];?></div>
        <div class="tbA">
            <div class="lpic">
            <ul class="clearfix">
                  <?php if (have_posts()):$args=array('showposts'=>'24','category__in' => array( $read[1] ),'caller_get_posts' => 1);$my_query=new WP_Query($args);while ($my_query->have_posts()) : $my_query->the_post(); $do_not_duplicate = $post->ID;?>
                  <li class="focus">
                    <a href="<?php the_permalink(); ?>" class="thumbnail"><?php deel_thumbnail(); ?></a>
                    <i><a href="<?php the_permalink() ?>" title="<?php the_title(); ?> - <?php bloginfo('name'); ?>"><?php the_title(); ?></a></i>
                    <i>播放：<?php deel_views(''); ?>&nbsp;&nbsp;<?php if( !$_comment ){ ?>评论：<?php if ( comments_open() ) echo '<a href="'.get_comments_link().'">'.get_comments_number('0', '1', '%').'评论</a>';?><?php } ?></i>
                  </li>
                  <?php endwhile;endif; ?>
            </ul>
            </div>
        </div>
    </div>
</div>

<div class="p2 con conA mb clearfix">
    <div class="modA">
        <div class="thA"><?php echo $mdt[2];?></div>
        <div class="tbA">
            <div class="lpic">
            <ul class="clearfix">
                  <?php if (have_posts()):$args=array('showposts'=>'6','category__in' => array( $read[2] ),'caller_get_posts' => 1);$my_query=new WP_Query($args);while ($my_query->have_posts()) : $my_query->the_post(); $do_not_duplicate = $post->ID;?>
                  <li class="focus">
                    <a href="<?php the_permalink(); ?>" class="thumbnail"><?php deel_thumbnail(); ?></a>
                    <i><a href="<?php the_permalink() ?>" title="<?php the_title(); ?> - <?php bloginfo('name'); ?>"><?php the_title(); ?></a></i>
                    <i>播放：<?php deel_views(''); ?>&nbsp;&nbsp;<?php if( !$_comment ){ ?>评论：<?php if ( comments_open() ) echo '<a href="'.get_comments_link().'">'.get_comments_number('0', '1', '%').'评论</a>';?><?php } ?></i>
                  </li>
                  <?php endwhile;endif; ?>
            </ul>
            </div>
        </div>
    </div>
</div>

<div class="p2 con conA mb clearfix">
    <div class="modA">
        <div class="thA"><?php echo $mdt[3];?></div>
        <div class="tbA">
            <div class="lpic">
            <ul class="clearfix">
                  <?php if (have_posts()):$args=array('showposts'=>'6','category__in' => array( $read[3] ),'caller_get_posts' => 1);$my_query=new WP_Query($args);while ($my_query->have_posts()) : $my_query->the_post(); $do_not_duplicate = $post->ID;?>
                  <li class="focus">
                    <a href="<?php the_permalink(); ?>" class="thumbnail"><?php deel_thumbnail(); ?></a>
                    <i><a href="<?php the_permalink() ?>" title="<?php the_title(); ?> - <?php bloginfo('name'); ?>"><?php the_title(); ?></a></i>
                    <i>播放：<?php deel_views(''); ?>&nbsp;&nbsp;<?php if( !$_comment ){ ?>评论：<?php if ( comments_open() ) echo '<a href="'.get_comments_link().'">'.get_comments_number('0', '1', '%').'评论</a>';?><?php } ?></i>
                  </li>
                  <?php endwhile;endif; ?>
            </ul>
            </div>
        </div>
    </div>
</div>

<div class="p2 con conA mb clearfix">
    <div class="modA">
        <div class="thA"><?php echo $mdt[4];?></div>
        <div class="tbA">
            <div class="lpic">
            <ul class="clearfix">
                  <?php if (have_posts()):$args=array('showposts'=>'24','category__in' => array( $read[4] ),'caller_get_posts' => 1);$my_query=new WP_Query($args);while ($my_query->have_posts()) : $my_query->the_post(); $do_not_duplicate = $post->ID;?>
                  <li class="focus">
                    <a href="<?php the_permalink(); ?>" class="thumbnail"><?php deel_thumbnail(); ?></a>
                    <i><a href="<?php the_permalink() ?>" title="<?php the_title(); ?> - <?php bloginfo('name'); ?>"><?php the_title(); ?></a></i>
                    <i>播放：<?php deel_views(''); ?>&nbsp;&nbsp;<?php if( !$_comment ){ ?>评论：<?php if ( comments_open() ) echo '<a href="'.get_comments_link().'">'.get_comments_number('0', '1', '%').'评论</a>';?><?php } ?></i>
                  </li>
                  <?php endwhile;endif; ?>
            </ul>
            </div>
        </div>
    </div>
</div>

<div class="p2 con conA mb clearfix">
    <div class="modA">
        <div class="thA"><?php echo $mdt[5];?></div>
        <div class="tbA">
            <div class="lpic">
            <ul class="clearfix">
                  <?php if (have_posts()):$args=array('showposts'=>'6','category__in' => array( $read[5] ),'caller_get_posts' => 1);$my_query=new WP_Query($args);while ($my_query->have_posts()) : $my_query->the_post(); $do_not_duplicate = $post->ID;?>
                  <li class="focus">
                    <a href="<?php the_permalink(); ?>" class="thumbnail"><?php deel_thumbnail(); ?></a>
                    <i><a href="<?php the_permalink() ?>" title="<?php the_title(); ?> - <?php bloginfo('name'); ?>"><?php the_title(); ?></a></i>
                    <i>播放：<?php deel_views(''); ?>&nbsp;&nbsp;<?php if( !$_comment ){ ?>评论：<?php if ( comments_open() ) echo '<a href="'.get_comments_link().'">'.get_comments_number('0', '1', '%').'评论</a>';?><?php } ?></i>
                  </li>
                  <?php endwhile;endif; ?>
            </ul>
            </div>
        </div>
    </div>
</div>

<div class="p2 con conA mb clearfix">
    <div class="modA">
        <div class="thA"><?php echo $mdt[6];?></div>
        <div class="tbA">
            <div class="lpic">
            <ul class="clearfix">
                  <?php if (have_posts()):$args=array('showposts'=>'6','category__in' => array( $read[6] ),'caller_get_posts' => 1);$my_query=new WP_Query($args);while ($my_query->have_posts()) : $my_query->the_post(); $do_not_duplicate = $post->ID;?>
                  <li class="focus">
                    <a href="<?php the_permalink(); ?>" class="thumbnail"><?php deel_thumbnail(); ?></a>
                    <i><a href="<?php the_permalink() ?>" title="<?php the_title(); ?> - <?php bloginfo('name'); ?>"><?php the_title(); ?></a></i>
                    <i>播放：<?php deel_views(''); ?>&nbsp;&nbsp;<?php if( !$_comment ){ ?>评论：<?php if ( comments_open() ) echo '<a href="'.get_comments_link().'">'.get_comments_number('0', '1', '%').'评论</a>';?><?php } ?></i>
                  </li>
                  <?php endwhile;endif; ?>
            </ul>
            </div>
        </div>
    </div>
</div>


<div class="p6 con clearfix">
	<div class="pd">
	<strong>友情链接</strong>
    <?php echo stripslashes(get_option( 'd_new_link'));?>
	</div>
</div>
<?php
*/
?>

<div style="display: block;" class="rollto"><button class="btn btn-inverse" data-type="totop" title="回顶部"><i class="icon-eject icon-white"></i></button></div>

<?php get_footer(); ?>

<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
<script src="http://js.3conline.com/min/temp/v1/lib-jquery1.4.2,dpl-jquery.slide.js"></script>

<script>
// new Slide({
//   target:$('#tabA dd a'),
//   control:$('#tabA dt a'),
//   effect: 'slide'
// });

new Slide({
    target: $('#tabA dd a'),
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

var na = $('#tdsup .toc .subMark a'),
    s3a = $('#tdsup .s3 a');


new Slide({
    target: $('#tdsup .toc-item'),
    control: $('#tdsup .toc'),
    onchange: function() {
        s3a.attr('href',na.eq(this.curPage).attr('href'));
    }
});

// new Slide({
//   target:$('#tdsup .toc-item'),
//   control:$('#tdsup .toc'),
//   onchange : function(){
//     // console.log(this.curPage);
//     // console.log(na[this.curPage].href);
//     // s3a.href = na[this.curPage].href
//     s3a.attr('href',nq.eq(this.curPage).attr('href'));
//   }
// });
</script>