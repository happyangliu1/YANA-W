<?php if (!defined('THINK_PATH')) exit(); if(is_array($new)): $i = 0; $__LIST__ = array_slice($new,0,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-xs-6 col-md-3 news_img" data-move-y="50px">
	<a href="<?php echo W('Href',array('url'=>$vo['url'],'id'=>$vo['id'],'type'=>'new','lang'=>'e'));?>">
		<img src="__ROOT__/Uploads/<?php echo ($vo["thumb"]); ?>" class="opacity_img" alt="<?php echo ($vo["etitle"]); ?>">
	</a>
	<p class="news_title">
		<a href="<?php echo W('Href',array('url'=>$vo['url'],'id'=>$vo['id'],'type'=>'new','lang'=>'e'));?>" title="<?php echo ($vo["etitle"]); ?>"><?php echo (mb_substr($vo["etitle"],0,40,'utf-8')); ?></a>
	</p>
	<p class="news_desc"><?php echo (mb_substr($vo["edescription"],0,60,'utf-8')); ?></p>
</div><?php endforeach; endif; else: echo "" ;endif; ?>