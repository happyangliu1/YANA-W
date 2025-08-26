<?php if (!defined('THINK_PATH')) exit(); if($links): ?><div class="link_box">
	<div class="container">
		<span class="link_title">链接</span>
		<button id="link_btn" class="glyphicon glyphicon-plus" aria-hidden="true"></button>
		<span class="link_list">
			<?php if(is_array($links)): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a target="_blank" href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
		</span>
	</div>
</div><?php endif; ?>