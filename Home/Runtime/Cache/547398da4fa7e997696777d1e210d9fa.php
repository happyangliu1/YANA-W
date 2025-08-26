<?php if (!defined('THINK_PATH')) exit(); if($new): if(is_array($new)): $i = 0; $__LIST__ = array_slice($new,0,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="index_new col-xs-12 col-md-12"  data-move-y="-80px">
	<div class="col-xs-4 col-md-3">
		<a href="<?php echo W('Href',array('url'=>$vo['url'],'id'=>$vo['id'],'type'=>'new','lang'=>'c'));?>" title="<?php echo ($vo["title"]); ?>">
			<img src="__ROOT__/Uploads/<?php echo ($vo["thumb"]); ?>" class="opacity_img" alt="<?php echo ($vo["title"]); ?>">
		</a>
	</div>
	<div class="col-xs-8 col-md-9" style="padding: 0;">
		<h3><a href="<?php echo W('Href',array('url'=>$vo['url'],'id'=>$vo['id'],'type'=>'new','lang'=>'c'));?>" title="<?php echo ($vo["title"]); ?>"><?php echo (mb_substr($vo["title"],0,50,'utf-8')); ?></a></h3>
		<p><?php echo (mb_substr($vo["description"],0,120,'utf-8')); ?></p>	 
	</div>	 
</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>