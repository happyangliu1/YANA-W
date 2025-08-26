<?php if (!defined('THINK_PATH')) exit();?><!-- Fixed navbar -->
<nav id="top_nav" class="navbar navbar-default navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<span id="search_btn" class="glyphicon glyphicon-search" aria-hidden="true"></span>
            <a class="navbar-brand" href="#">CATEGORIES</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo W('Index',array('cnen'=>'cn','lang'=>'c'));?>">网站首页</a></li>
				<?php if(is_array($appnav)): foreach($appnav as $key=>$vo): if(isset($vo['two'])): ?><li class="dropdown">
							<a href="<?php echo W('Listhref',array('url'=>$vo['url'],'id'=>$vo['id'],'link'=>$vo['link'],'lang'=>'c'));?>"><?php echo ($vo["name"]); ?></a>
							<a href="<?php echo W('Listhref',array('url'=>$vo['url'],'id'=>$vo['id'],'link'=>$vo['link'],'lang'=>'c'));?>" id="app_menudown" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="fa fa-angle-down"></span></a>
							<ul class="dropdown-menu nav_small" role="menu">             
								<?php if(is_array($vo["two"])): foreach($vo["two"] as $key=>$svo): ?><li class="dropdown">
										<a href="<?php echo W('Listhref',array('url'=>$svo['url'],'id'=>$svo['id'],'link'=>$svo['link'],'lang'=>'c'));?>"><?php echo ($svo["name"]); ?> </a>                        
										<ul class="dropdown-menu2" >
											<?php if(is_array($svo["three"])): foreach($svo["three"] as $key=>$ssvo): ?><li class="dropdown"><a href="<?php echo W('Listhref',array('url'=>$ssvo['url'],'id'=>$ssvo['id'],'link'=>$ssvo['link'],'lang'=>'c'));?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
													<?php echo ($ssvo["name"]); ?></a></li><?php endforeach; endif; ?>
									</li>
										</ul><?php endforeach; endif; ?>
							</ul>
						</li>
						<?php else: ?>
						<li>
							<a href="<?php echo W('Listhref',array('url'=>$vo['url'],'id'=>$vo['id'],'link'=>$vo['link'],'lang'=>'c'));?>"><?php echo ($vo["name"]); ?></a>
						</li><?php endif; endforeach; endif; ?>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>