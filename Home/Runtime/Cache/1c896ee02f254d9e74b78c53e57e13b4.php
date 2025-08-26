<?php if (!defined('THINK_PATH')) exit(); if(is_array($flash)): $i = 0; $__LIST__ = array_slice($flash,0,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-xs-6 col-sm-6 col-md-3">
	<div class="cl">
      <div class="advantage_left"  data-move-y="60px">
      	<a href="<?php echo ($vo["link"]); ?>" target="_blank"><img src="__ROOT__/Uploads/<?php echo ($vo["photo"]); ?>" alt="<?php echo ($vo["title"]); ?>" class="opacity_img"></a>
		<div class="vca">
			<h3><?php echo (mb_substr($vo["title"],0,40,'utf-8')); ?></h3>
			<div class="re"><a href="<?php echo ($vo["link"]); ?>"><b>了解更多 →</b></a></div>
		</div>
      </div>
	</div>
</div><?php endforeach; endif; else: echo "" ;endif; ?>