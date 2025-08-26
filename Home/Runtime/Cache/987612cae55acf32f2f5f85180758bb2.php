<?php if (!defined('THINK_PATH')) exit();?>    <!-- bxslider -->
    <div class="flash">
        <ul class="bxslider">
          <?php if(is_array($flash)): $i = 0; $__LIST__ = $flash;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["link"]); ?>"><img src="__ROOT__/Uploads/<?php echo ($vo["photo"]); ?>" alt="<?php echo ($vo["title"]); ?>" /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>