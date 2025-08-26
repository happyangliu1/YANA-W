<?php if (!defined('THINK_PATH')) exit(); if(is_array($photo)): $i = 0; $__LIST__ = array_slice($photo,0,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-sm-4 col-md-3 col-mm-6 case_img" data-move-y="200px">
      <a href="<?php echo W('Href',array('url'=>$vo['url'],'id'=>$vo['id'],'type'=>'Photo','lang'=>'e'));?>">
            <img src="__ROOT__/Uploads/<?php echo ($vo["thumb"]); ?>" class="img-thumbnail" alt="<?php echo ($vo["name"]); ?>">
      </a>
      <p class="product_title">
            <a href="<?php echo W('Href',array('url'=>$vo['url'],'id'=>$vo['id'],'type'=>'Photo','lang'=>'e'));?>" title="<?php echo ($vo["ename"]); ?>"><?php echo (mb_substr($vo["ename"],0,22,'utf-8')); ?></a>
      </p>
</div><?php endforeach; endif; else: echo "" ;endif; ?>