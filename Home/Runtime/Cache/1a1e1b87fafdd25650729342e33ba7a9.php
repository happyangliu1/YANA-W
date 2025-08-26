<?php if (!defined('THINK_PATH')) exit();?><ul class="left_nav_ul" id="firstpane">
      <?php if(is_array($bigclass)): $i = 0; $__LIST__ = $bigclass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
            <a class="biglink" href="<?php echo W('Listhref',array('url'=>$vo['url'],'id'=>$vo['id'],'link'=>$vo['link'],'lang'=>'c'));?>"><?php echo ($vo["name"]); ?></a><span class="menu_head">+</span>
      
            <ul class="left_snav_ul menu_body">
            <?php if(is_array($smallclass)): $i = 0; $__LIST__ = $smallclass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$svo): $mod = ($i % 2 );++$i; if(($svo["pid"]) == $vo["id"]): ?><li><a href="<?php echo W('Listhref',array('url'=>$svo['url'],'id'=>$svo['id'],'link'=>$svo['link'],'lang'=>'c'));?>"><?php echo ($svo["name"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>