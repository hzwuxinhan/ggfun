</section>
<footer class="footer">
    <div class="footer-inner">
        <div class="copyright pull-left">
        	<?php if( dopt('d_tqq_b') || dopt('d_weibo_b') || dopt('d_facebook_b') || dopt('d_twitter_b') ){ ?>

                <?php if( dopt('d_tqq_b') ) echo '<a href="'.dopt('d_tqq').'" target="_blank">腾讯微博</a>'; ?>
                <?php if( dopt('d_mail_b') ) echo '<a href="'.dopt('d_mail').'" target="_blank"><img src="'.dopt('d_mail_icon').'"></a>'; ?>
                <?php if( dopt('d_qq_b') ) echo '<a href="'.dopt('d_qq').'" target="_blank"><img src="'.dopt('d_qq_icon').'"></a>'; ?>
                <?php if( dopt('d_weibo_b') ) echo '<a href="'.dopt('d_weibo').'" target="_blank"><img src="'.dopt('d_weibo_icon').'"></a>'; ?>
                <?php if( dopt('d_facebook_b') ) echo '<a href="'.dopt('d_facebook').'" target="_blank">Facebook</a>'; ?>
                <?php if( dopt('d_twitter_b') ) echo '<a href="'.dopt('d_twitter').'" target="_blank">Twitter</a>'; ?>
            <?php } ?>
            版权所有，保留一切权利！ &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>
        </div>
        <div class="trackcode pull-right">
            <?php if( dopt('d_track_b') ) echo dopt('d_track'); ?>
        </div>
    </div>
</footer>
<?php 
wp_footer(); 
global $dHasShare; 
if($dHasShare == true){ 
    echo '<script id="bdshare_js" data="type=tools&amp;uid='.(dopt('d_bdshare')?dopt('d_bdshare'):13688).'" ></script><script id="bdshell_js"></script><script>document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?t=" + new Date().getHours();</script>';
} 
if( dopt('d_footcode_b') ) echo dopt('d_footcode'); 
?>
</body>
</html>
<script src="http://js.3conline.com/min/temp/v1/lib-jquery1.4.2.js"></script>
<script>
$('.upd').live('click',function(){
    var fd = $(this).parent().next();
    if($(this).hasClass('upds')){
        $(this).removeClass('upds');
        $(this).html('收起');
        fd.show();
    }else{
        $(this).addClass('upds');
        $(this).html('展开');
        fd.hide();
    }
    
    
})

<?php 
	if(is_category()) {
        ?>
        $(".navbar .nav").html($(".navbar .nav").html().replace(/1/,""))
        <?php
	}
?>
</script>