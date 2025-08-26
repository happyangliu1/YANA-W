<?php if (!defined('THINK_PATH')) exit(); if(C("is_online")!= 0): ?><!--客服面板-->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/eonline.css" />

<div id="service">
	<div id="ser_main">
		<a rel="nofollow" id="floatShow1" href="javascript:void(0);" title="Open">&nbsp;</a> 
	</div>
	
	<div id="online">
		<div class="onlineMenu">
			<ul> 
				<li class="online_title"><i class="fa fa-comments-o" style="font-size:30px; margin-right:5px;" aria-hidden="true"></i>online service</li> 				
				<?php if(C("skype_account")!= ''): if(is_array($online_skype)): foreach($online_skype as $key=>$vo): ?><li class="call">
							<div class="msggroup">
								<a href="skype:<?php echo ($online_skype["$key"]); ?>?chat" title="<?php echo ($key); ?>"><i class="fa fa-skype" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp; <?php echo ($key); ?></a>
							</div>
						</li><?php endforeach; endif; endif; ?>
				
				<li class="call"><a rel="nofollow" title="<?php echo (C("web_icp")); ?>" href="https://api.whatsapp.com/send?phone=<?php echo (C("web_icp")); ?>"><i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo (C("web_icp")); ?></a></li>  
				<li class="call"><a rel="nofollow" title="<?php echo (C("web_email")); ?>" href="mailto:<?php echo (C("web_email")); ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;<?php echo (C("web_email")); ?></a></li>
				<?php if(C("qq_account")!= ''): if(is_array($online_qq)): foreach($online_qq as $key=>$vo): ?><li class="call">
							<div class="msggroup">
								<a target="_blank" title="<?php echo ($key); ?>" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($online_qq["$key"]); ?>&site=qq&menu=yes"><i class="fa fa-qq" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($key); ?></a>
							</div>
						</li><?php endforeach; endif; endif; ?>        
				<li class="call">
                	<div class="qrcodePanel">
                		<p><i class="fa fa-weixin" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;We chat</p>
                		<img style="width:180px;height:180px;" src="__ROOT__/Uploads/<?php echo (C("web_qrcode")); ?>"> 
                	</div>                                                                          
                </li>
			</ul>
		</div>
	</div>
</div>


<div class="goTop">
	<a rel="nofollow"  class="totop" style="display: inline;"></a>
</div>

    <script type="text/javascript" src="__PUBLIC__/js/online.js"></script><?php endif; ?>