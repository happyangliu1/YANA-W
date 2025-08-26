<?php if (!defined('THINK_PATH')) exit(); if($tags): ?><div class="tags_box">
    <div class="container">
	<span class="tags_title"><a href="<?php echo U('Tags/index',array('lang'=>'e'));?>" role="button">TAGS</a></span>
	<button id="tags_btn" class="glyphicon glyphicon-plus" aria-hidden="true"></button>
	<span class="tags_rows">
	      <?php if(is_array($tags)): $i = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo W('Taghref',array('id'=>$vo['id'],'type'=>$vo['type'],'lang'=>'e'));?>" role="button"  target="_blank"><?php echo ($vo["ename"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
	</span>
    </div>
</div><?php endif; ?>