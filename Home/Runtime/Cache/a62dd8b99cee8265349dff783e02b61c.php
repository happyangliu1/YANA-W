<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ($article["etitle"]); ?></title>
    <meta name="keywords" content="<?php echo ($article["ekeywords"]); ?>" />
    <meta name="description" content="<?php echo ($article["edescription"]); ?>" />
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
	
<link type="text/css" rel="stylesheet" href="../Public/fonts/font-awesome/css/font-awesome.min.css"/>
<link type="text/css" rel="stylesheet" href="../Public/fonts/ionicons/css/ionicons.min.css"/>
<link type="text/css" rel="stylesheet" href="../Public/fonts/medical-icons/style.css"/>

<div class="top_bg">
	<div class="container">
		<span class="top_name">Welcome: <?php echo (C("web_ename")); ?></span>
		<?php if(C("is_bilingual")!= 0): ?><div class="top_lang">
				<a href="<?php echo W('Index',array('cnen'=>'cn','lang'=>'c'));?>" title="Chinese"><img src="../Public/images/Chinese.gif" alt="Chinese"></a>&nbsp;&nbsp;
	            <a href="<?php echo W('Index',array('cnen'=>'en','lang'=>'e'));?>" title="English"><img src="../Public/images/English.gif" alt="English"></a>&nbsp;
			    <a href="__ROOT__/en/inquiry" target="_blank" class="nav_inquiry"><i class="fa fa-shopping-cart"></i></a>
			</div><?php endif; ?>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-9 col-md-5">
			<a href="<?php echo (C("web_url")); ?>"><img src="__ROOT__/Uploads/<?php echo (C("web_logo")); ?>" class="logo" alt="<?php echo (C("web_name")); ?>"/></a>
		</div>                  
		<div class="col-xs-12 col-sm-3 col-md-7">
			<div class="top_email">
				<i class="fa fa-envelope" aria-hidden="true"></i>
				<a href="mailto:<?php echo (C("web_email")); ?>"><?php echo (C("web_email")); ?></a>                      
				<span class="phone"><i class="fa fa-phone" aria-hidden="true"></i><?php echo (C("web_tel")); ?></span>
			</div>
			<div class="top_search">
				<form id="searchform" method="get" action="<?php echo U('Search/index',array('g'=>'e'));?>">
					<div class="input-group search_group">
						<input type="text" name="name" class="form-control input-sm" placeholder="Product search">
						<span class="input-group-btn">
							<span id="search_submit" onclick="searchform.submit();" title="Product search" class="fa fa-search btn-lg" aria-hidden="true"></span>
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

      <?php echo W('Nav',array('lang'=>'e'));?>

</header>
      <div class="page_bg" style="background: url(__ROOT__/Uploads/<?php echo W('Flash',array('id'=>4));?>) center top no-repeat;"></div>

      <div class="container">
            <div class="bread_bg">    
                  <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="bread_nav">
                                    <span class="fa fa-home" aria-hidden="true"></span>&nbsp;<?php echo W('Bread',array('id'=>$article['pid'],'lang'=>'e'));?>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
   
      <!-- main -->
      <div class="container">    
            <div class="row">

                 <!-- right -->
                 <div class="col-xs-12 col-sm-8 col-md-9" style="float:right">
                        <div class="right_head">
                              <h2><span><?php echo ($articlelist["ename"]); ?></span></h2>
                        </div>
                        <div class="right_contents">
                              <h1 class="right_contents_h1"><?php echo ($article["etitle"]); ?></h1>
                              <?php echo ($article["econtents"]); ?>
                        </div>
                        <div class="point">
                              <span class="to_prev col-xs-12 col-sm-6 col-md-6"><?php echo ($prevnext["prev"]); ?></span>
                              <span class="to_next col-xs-12 col-sm-6 col-md-6"><?php echo ($prevnext["next"]); ?></span>
                        </div>

                        <div class="relevant_new"> 
                              <div class="right_head">
                                    <h2><span>RELATED NEWS</span></h2>
                              </div>
                              <ul class="right_new">
                                    <?php if(is_array($related)): $i = 0; $__LIST__ = array_slice($related,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                                          <a href="<?php echo W('Href',array('url'=>$vo['url'],'id'=>$vo['id'],'type'=>'New','lang'=>'e'));?>" title="<?php echo ($vo["etitle"]); ?>"><?php echo (mb_substr($vo["etitle"],0,80,'utf-8')); ?></a>
                                          <span class="right_new_time"><?php echo (date('Y-m-d',$vo["time"])); ?></span>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>        
                              </ul>
                        </div>
                  </div>

                  <!-- left -->
                  <div class="col-xs-12 col-sm-4 col-md-3">
                        <h3 class="left_h3"><span>CATEGORIES</span></h3>
                        <div class="left_column">
                              <?php echo W('Left',array('id'=>$article['bid'],'type'=>'new','lang'=>'e'));?>
                        </div>
                        <div class="left_news">
                              <h3 class="left_h3"><span>LATEST NEWS</span></h3>
                              <?php echo W('List',array('table'=>'New','bid'=>2,'id'=>2,'lang'=>'e'));?>
                        </div>
                        <div class="left_contact">
      <h2 class="left_h3">CONTACT US</h2>
      <p style="padding-top:8px;">Contact: <?php echo (C("web_econtacts")); ?></p>
      <p>Phone: <?php echo (C("web_phone")); ?></p>
      <p>Tel: <?php echo (C("web_tel")); ?></p>
      <p>Email: <?php echo (C("web_email")); ?></p>
      <p>Add: <?php echo (C("web_eadd")); ?></p>
</div>
                  </div>

            </div>
      </div> 
    
      <nav class="navbar navbar-default navbar-fixed-bottom mfoot_box">
<div class="mfoot_nav btn-group dropup">
	<a class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><span class="fa fa-share btn-lg" aria-hidden="true"></span>Share</a>  
	<div class="dropdown-menu mfoot_eshare">
		<!-- AddToAny BEGIN -->
		<div class="a2a_kit a2a_kit_size_32 a2a_default_style" style="display: inline-block; float:left;">
			<a class="a2a_dd" href="https://www.addtoany.com/share_save"></a>
			<a class="a2a_button_facebook"></a>
			<a class="a2a_button_twitter"></a>
			<a class="a2a_button_whatsapp"></a>
			<a class="a2a_button_linkedin"></a>
		</div>
		<!-- AddToAny END -->
		<script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
	</div>
</div>

<div class="mfoot_nav"><a href="<?php echo W('Listhref',array('id'=>31,'lang'=>'e'));?>"><span class="fa fa-phone btn-lg" aria-hidden="true"></span>Inquiry</a></div>
<div class="mfoot_nav"  aria-hidden="true"  data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	<button id="foot_btn" type="button"  data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" style="width:100%; border: 0px; background: transparent;">
		<span class="fa fa-th-list btn-lg"></span>Menu
	</button>
</div>
<div class="mfoot_nav"><a id="gototop" href="#"><span class="fa fa-arrow-circle-up" aria-hidden="true"></span>Top</a></div>
</nav>

<footer>
<div class="container">    
	<div class="row">
			
		<div class="col-xs-12 col-sm-4 col-md-4 footer_contact">
			<p>Call Us: <?php echo (C("web_tel")); ?></p>
			<p>Email Us: <a style="color:#333" href="mailto:<?php echo (C("web_email")); ?>"> <?php echo (C("web_email")); ?></a></p>
			<p>Address: <?php echo (C("web_eadd")); ?></p>
			<p>Whatsapp: <?php echo (C("web_icp")); ?></p>
		</div>
		<div class="col-xs-12 col-sm-8 col-md-8">
			<?php echo W('Foot',array('lang'=>'e'));?>			
		</div>
		
	</div>
</div> 
</footer>

<div class="footer-bar">
	<div>	
		
		<?php if(C("is_translate")!= 0): ?><p class="translation-links" style="padding:0px; text-align:center;">	
          <A href="#" data-lang="de"><IMG border=0 
                  align=absMiddle src="/w980/Home/Tpl/default/Public/images/ico_deutsch1.gif" width=20 
                  height=14> <SPAN style="COLOR: #666">Deutsch</SPAN></A> 
				  
				  <A href="#" data-lang="es"><IMG border=0 
                  align=absMiddle src="/w980/Home/Tpl/default/Public/images/ico_espanol.gif" width=20 
                  height=14> <SPAN style="COLOR: #666">Espanol</SPAN></A>
				   
				  <A href="#" data-lang="fr"><IMG border=0 
                  align=absMiddle src="/w980/Home/Tpl/default/Public/images/ico_francies.gif" width=20 
                  height=14> <SPAN style="COLOR: #666">Francais</SPAN></A> 
				  
				  <A href="#" data-lang="it"><IMG border=0 
                  align=absMiddle src="/w980/Home/Tpl/default/Public/images/ico_italino.gif" width=20 
                  height=14> <SPAN style="COLOR: #666">Italiano</SPAN></A>
				   
				  <A href="#" data-lang="pt"><IMG border=0 
                  align=absMiddle src="/w980/Home/Tpl/default/Public/images/ico_portgues.gif" width=20 
                  height=14> <SPAN style="COLOR: #666">Portugues</SPAN></A>
				   
          <A href="#" data-lang="ja"><IMG border=0 
                  align=absMiddle src="/w980/Home/Tpl/default/Public/images/ico_japan.jpg" width=20 
                  height=14> <SPAN style="COLOR: #666">Japanese</SPAN></A> 
				  
				  <A href="#" data-lang="ko"><IMG border=0 
                  align=absMiddle src="/w980/Home/Tpl/default/Public/images/ico_korea.jpg" width=20 
                  height=14> <SPAN style="COLOR: #666">Korean</SPAN></A> 
				  
				  <A href="#" data-lang="ar"><IMG border=0 
                  align=absMiddle src="/w980/Home/Tpl/default/Public/images/ico_arabia.jpg" width=20 
                  height=14> <SPAN style="COLOR: #666">Arabic</SPAN></A>
				   
				  <A href="#" data-lang="ru"><IMG border=0 
                  align=absMiddle src="/w980/Home/Tpl/default/Public/images/ico_russia.jpg" width=20 
                  height=14> <SPAN style="COLOR: #666">Russian</SPAN></A>
        </p>

          <!-- Code provided by Google -->
          <div id="google_translate_element" style="display:none;"></div>
          <script type="text/javascript">
            function googleTranslateElementInit() {
              new google.translate.TranslateElement({pageLanguage: 'en', autoDisplay: false}, 'google_translate_element'); //remove the layout
            }
          </script>
          <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>


          <script type="text/javascript">
              function triggerHtmlEvent(element, eventName) {
          var event;
          if(document.createEvent) {
              event = document.createEvent('HTMLEvents');
              event.initEvent(eventName, true, true);
              element.dispatchEvent(event);
          } else {
              event = document.createEventObject();
              event.eventType = eventName;
              element.fireEvent('on' + event.eventType, event);
          }
          }
                      <!-- Flag click handler -->
          $('.translation-links a').click(function(e) {

            e.preventDefault();
            var lang = $(this).data('lang');
            $('#google_translate_element select option').each(function(){
               // console.log($(this).val());
              if($(this).val().indexOf(lang) > -1) {
                  $(this).parent().val($(this).val());
                  var container = document.getElementById('google_translate_element');
                  var select = container.getElementsByTagName('select')[0];
                  triggerHtmlEvent(select, 'change');
              }
          });
          });

          </script><?php endif; ?>

		<p><?php echo (C("web_ecopyright")); ?>&nbsp;<a href="https://www.soonidea.cn" style="color: #666;">POWERED BY YUKE&nbsp;</a><a href="__ROOT__/e_sitemap.html" target="_blank" >Sitemap</a><?php echo (C("web_count")); ?> </p>
	</div>
</div>

<?php echo W('Online',array('lang'=>'e'));?>

<?php echo (C("web_baidu")); ?>

    
  </body>
</html>