<?php if (!defined('THINK_PATH')) exit();?><div class="col-xs-4 col-md-4 footer_menu">
      <?php if(is_array($footnav)): $i = 0; $__LIST__ = $footnav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["level"] == 0 and $i != 1): ?></div>
      <div class="col-xs-4 col-md-4 footer_menu"><?php endif; ?>
            <p <?php if($vo["level"] == 0): ?>class="footer_menu_first"<?php endif; ?>><a target="_blank" href="<?php echo ($vo["eurl"]); ?>"><?php echo ($vo["ename"]); ?></a></p><?php endforeach; endif; else: echo "" ;endif; ?>
</div>