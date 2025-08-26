<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ($article["title"]); ?></title>
    <meta name="keywords" content="<?php echo ($article["keywords"]); ?>" />
    <meta name="description" content="<?php echo ($article["description"]); ?>" />
    <meta name="applicable-device"content="pc,mobile">
    <link href="__PUBLIC__/css/bootstrap.css" rel="stylesheet">
    <link href="../Public/css/bxslider.css" rel="stylesheet">
    <link href="../Public/css/style.css" rel="stylesheet">
    <script src="__PUBLIC__/js/jquery.min.js"></script>
    <script src="../Public/js/bxslider.min.js"></script>
    <script src="../Public/js/common.js"></script>
    <script src="__PUBLIC__/js/bootstrap.js"></script>
    <!--[if lt IE 9]>
        <script src="https://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
      <header>

<link type="text/css" rel="stylesheet" href="__PUBLIC__/fonts/font-awesome/css/font-awesome.min.css"/>
<link type="text/css" rel="stylesheet" href="__PUBLIC__/fonts/ionicons/css/ionicons.min.css"/>
<link type="text/css" rel="stylesheet" href="__PUBLIC__/fonts/medical-icons/style.css"/>

<?php if(C("is_bilingual")!= 0): ?><div class="top_bg">
	<div class="container">
		<span class="top_name">
			<p class="left_h1">
				<a href="mailto:<?php echo (C("web_email")); ?>"><i class="fa fa-envelope" aria-hidden="true"></i> Email: <?php echo (C("web_email")); ?></a>
				<span><i class="fa fa-phone" aria-hidden="true"></i>Tel: <?php echo (C("web_tel")); ?></span>
			</p>
		</span>
		<div class="top_lang">语言选择：
			<a href="<?php echo W('Index',array('cnen'=>'cn','lang'=>'c'));?>" title="中文版"><img src="../Public/images/Chinese.gif" alt="中文版"></a>
				  ∷&nbsp;
			<a href="<?php echo W('Index',array('cnen'=>'en','lang'=>'e'));?>" title="English"><img src="../Public/images/English.gif" alt="英文版"></a>
		</div>
	</div>
</div><?php endif; ?>

      <?php echo W('Nav',array('lang'=>'c'));?>

</header>
      <div class="page_bg" style="background: url(__ROOT__/Uploads/<?php echo W('Flash',array('id'=>4));?>) center top no-repeat;"></div>

      <div class="bread_bg">
            <div class="container">    
                  <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="bread_nav">
                                    <span>您的位置：</span><?php echo W('Bread',array('id'=>$article['pid'],'lang'=>'c'));?>
                              </div>
                        </div>
                  </div>
            </div>
      </div>

      <div class="container">    
            <div class="row">

                  <!-- right -->
                  <div class="col-xs-12 col-sm-8 col-md-9" style="float:right">
                        <div class="right_head">
                              <h2><span><?php echo ($articlelist["name"]); ?></span></h2>
                        </div>

                        <h1 class="right_contents_h1"><?php echo ($article["name"]); ?></h1>
                        <div class="download_btn">
                              <?php if($article["link"] == ''): ?><a href="__ROOT__/?m=common&a=down&id=<?php echo ($article["id"]); ?>" class="btn btn-info page-btn" role="button" target="_blank">
                              <?php else: ?>
                              <a href="<?php echo ($article["link"]); ?>" class="btn btn-info page-btn" role="button" target="_blank"><?php endif; ?>
                              <span class="fa fa-download " aria-hidden="true"></span> &nbsp;点击下载 </a>
                        </div>

                        <div class="right_contents">
                              <?php echo ($article["contents"]); ?>
                        </div>

                        <div class="point">
                              <span class="to_prev col-xs-12 col-sm-6 col-md-6"><?php echo ($prevnext["prev"]); ?></span>
                              <span class="to_next col-xs-12 col-sm-6 col-md-6"><?php echo ($prevnext["next"]); ?></span>
                        </div>

                        <div class="relevant_new"> 
                              <div class="right_head">
                                    <h2><span>相关下载</span></h2>
                              </div>
                              <ul class="right_new">
                                    <?php if(is_array($related)): $i = 0; $__LIST__ = array_slice($related,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                                          <a href="<?php echo W('Href',array('url'=>$vo['url'],'id'=>$vo['id'],'type'=>'Download','lang'=>'c'));?>"><?php echo (mb_substr($vo["title"],0,60,'utf-8')); ?></a>
                                          <span class="right_new_time"><?php echo (date('Y-m-d',$vo["time"])); ?></span>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>        
                              </ul>
                        </div>

                  </div>

                  <!-- left -->
                  <div class="col-xs-12 col-sm-4 col-md-3">
                        <h3 class="left_h3"><span>导航栏目</span></h3>
                        <div class="left_column">
                              <?php echo W('Left',array('id'=>$article['bid'],'type'=>'download','lang'=>'c'));?>
                        </div>
                        <div class="left_news">
                              <h3 class="left_h3"><span>新闻中心</span></h3>
                              <?php echo W('List',array('table'=>'New','bid'=>2,'id'=>2,'lang'=>'c'));?>
                        </div>
                        <div class="left_contact">
      <h2 class="left_h3"><span>联系我们</span></h2>
      <p style="padding-top:8px;">联系人：<?php echo (C("web_contacts")); ?></p>
      <p>手机：<?php echo (C("web_phone")); ?></p>
      <p>电话：<?php echo (C("web_tel")); ?></p>
      <p>邮箱：<?php echo (C("web_email")); ?></p>
      <p>地址： <?php echo (C("web_add")); ?></p>
</div>
                  </div>

           </div>
      </div> 

      <nav class="navbar navbar-default navbar-fixed-bottom mfoot_box">

      <div class="mfoot_nav btn-group dropup">
            <a class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><span class="fa fa-share btn-lg" aria-hidden="true"></span>分享</a>  
            <div class="dropdown-menu mfoot_share">
                  <div class="bdsharebuttonbox" style="display: inline-block; float:left;">
                        <a href="#" class="bds_more" data-cmd="more"></a>
                        <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                        <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                        <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
                        <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
                        <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                  </div>
                  <script>
                        window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='//bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
                  </script>
            </div>
      </div>

      <div class="mfoot_nav">
            <a href="<?php echo W('Listhref',array('id'=>31,'lang'=>'c'));?>"><span class="fa fa-phone btn-lg" aria-hidden="true"></span>询价</a>
      </div>

      <div class="mfoot_nav"  aria-hidden="true"  data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <button id="foot_btn" type="button"  data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" style="width:100%; border: 0px; background: transparent;">
                  <span class="fa fa-th-list btn-lg"></span>
                  分类
            </button>
      </div>

      <div class="mfoot_nav">
            <a id="gototop" href="#"><span class="fa fa-arrow-circle-up" aria-hidden="true"></span>顶部</a>
      </div>

</nav>

<footer>
	<div class="container">    
		<div class="row">
			<div class="col-xs-12 col-sm-3 col-md-3 fot">
				<p class="footer_menu_first">公司简介</p>
				<p style="color:white;font-size:13px;"> <?php echo W('About',array('id'=>25,'len'=>80,'lang'=>'c'));?> </p>
				<a class="footer-m" href="<?php echo W('Listhref',array('id'=>25));?>">MORE + </a>                       					                       
			</div>				 
			<div id="nam1" class="col-xs-12 col-sm-5 col-md-5 ">
				<?php echo W('Foot',array('lang'=>'c'));?>			
			</div>
			<div class="col-xs-12 col-sm-3 col-md-3 fot">
				<p class="footer_menu_first">联系我们</p>
				<p>Tel: <?php echo (C("web_tel")); ?></p>
				<p>Phone: <?php echo (C("web_phone")); ?></p>
				<p>E-mail: <?php echo (C("web_email")); ?></p>
				<p>Add: <?php echo (C("web_add")); ?></p>
			</div>

		</div>
	</div> 
	
<div class="footer-bar">                                              
	<div class="container">    
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">  
				<div style="text-align:center;" class="col-md-12 col-sm-12">	  
					<p style=" margin-top:10px;"><?php echo (C("web_copyright")); ?>&nbsp;<a href="__ROOT__/c_sitemap.html" target="_blank">Sitemap</a>&nbsp;<?php echo (C("web_count")); ?></p>              
				</div>
				<div style="text-align:right;display: none;" class="col-md-6 col-sm-12 fot_icon">
					<a href="<?php echo (C("msn_account")); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
					<a href="<?php echo (C("msn_name")); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
					<a href="<?php echo (C("alibaba_account")); ?>" target="_blank"><i class="fa fa-google-plus" ></i></a>
					<a href="<?php echo (C("alibaba_name")); ?>" target="_blank"><i class="fa fa-skype"></i></a>
					<a href="<?php echo (C("taobao_account")); ?>" target="_blank"><i class="fa fa-instagram" ></i></a>
					<a href="<?php echo (C("1688_account")); ?>" target="_blank"><i class="fa fa-youtube"></i></a>
				</div>
				<?php if(C("is_translate")!= 0): ?><p style="padding:0px 0 0px 25px;text-align: center;">	<SCRIPT language=javascript src="/e25/Home/Tpl/default/Public/images/lang.js"></SCRIPT>
                  <A 
                  href='javascript:translator("en|de")'><IMG border=0 
                  align=absMiddle src="/e25/Home/Tpl/default/Public/images/ico_deutsch1.gif" width=20 
                  height=14> <SPAN style="COLOR: #fff">Deutsch</SPAN></A> 
				  
				  <A href='javascript:translator("en|es")'><IMG border=0 
                  align=absMiddle src="/e25/Home/Tpl/default/Public/images/ico_espanol.gif" width=20 
                  height=14> <SPAN style="COLOR: #fff">Espanol</SPAN></A>
				   
				  <A href='javascript:translator("en|fr")'><IMG border=0 
                  align=absMiddle src="/e25/Home/Tpl/default/Public/images/ico_francies.gif" width=20 
                  height=14> <SPAN style="COLOR: #fff">Francais</SPAN></A> 
				  
				  <A href='javascript:translator("en|it")'><IMG border=0 
                  align=absMiddle src="/e25/Home/Tpl/default/Public/images/ico_italino.gif" width=20 
                  height=14> <SPAN style="COLOR: #fff">Italiano</SPAN></A>
				   
				  <A href='javascript:translator("en|pt")'><IMG border=0 
                  align=absMiddle src="/e25/Home/Tpl/default/Public/images/ico_portgues.gif" width=20 
                  height=14> <SPAN style="COLOR: #fff">Portugues</SPAN></A>
				   
                  <A href='javascript:translator("en|ja")'><IMG border=0 
                  align=absMiddle src="/e25/Home/Tpl/default/Public/images/ico_japan.jpg" width=20 
                  height=14> <SPAN style="COLOR: #fff">Japanese</SPAN></A> 
				  
				  <A href='javascript:translator("en|ko")'><IMG border=0 
                  align=absMiddle src="/e25/Home/Tpl/default/Public/images/ico_korea.jpg" width=20 
                  height=14> <SPAN style="COLOR: #fff">Korean</SPAN></A> 
				  
				  <A href='javascript:translator("en|ar")'><IMG border=0 
                  align=absMiddle src="/e25/Home/Tpl/default/Public/images/ico_arabia.jpg" width=20 
                  height=14> <SPAN style="COLOR: #fff">Arabic</SPAN></A>
				   
				  <A href='javascript:translator("en|ru")'><IMG border=0 
                  align=absMiddle src="/e25/Home/Tpl/default/Public/images/ico_russia.jpg" width=20 
                  height=14> <SPAN style="COLOR: #fff">Russian</SPAN></A> </p><?php endif; ?>






			</div>	
		</div>
	</div>		
</div>

</footer>


<?php echo W('Online',array('lang'=>'c'));?>

<?php echo (C("web_baidu")); ?>
    
  </body>
</html>