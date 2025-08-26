<?php if (!defined('THINK_PATH')) exit(); if(is_array($links)): $i = 0; $__LIST__ = array_slice($links,0,12,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-xs-4 col-md-2 col-mm-6 cooperation_img" data-move-y="50px">
      <a href="<?php echo ($vo["url"]); ?>" target="_blank">
            <img src="__ROOT__/Uploads/<?php echo ($vo["photo"]); ?>" class="img-thumbnail" alt="<?php echo ($vo["name"]); ?>" title="<?php echo ($vo["name"]); ?>">
      </a>
</div><?php endforeach; endif; else: echo "" ;endif; ?>