<?php if (!defined('THINK_PATH')) exit(); if($new): if(is_array($new)): $i = 0; $__LIST__ = array_slice($new,0,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p class="left"> 
		<i class="fa fa-file-text-o" aria-hidden="true"  ></i> &nbsp;
		<a style="font-size:12px;" href="<?php echo W('Href',array('url'=>$vo['url'],'id'=>$vo['id'],'type'=>'new','lang'=>'e'));?>" title="<?php echo ($vo["etitle"]); ?>"><?php echo (mb_substr($vo["etitle"],0,30,'utf-8')); ?></a>
		<span style="color:white;" >&nbsp;<?php echo (date('Y-m-d',$vo["time"])); ?></span>
	</p><?php endforeach; endif; else: echo "" ;endif; endif; ?>