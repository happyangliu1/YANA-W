<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<?php if(C("is_index")!= 1): ?><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo (C("seo_etitle")); ?> <?php if(C("web_name")!= ''): ?>- <?php echo (C("web_ename")); endif; ?></title>
    <meta name="keywords" content="<?php echo (C("seo_ekeywords")); ?>" />
    <meta name="description" content="<?php echo (C("seo_edescription")); ?>" />
    <?php echo (C("web_Google_Verification")); ?>
    	<link rel="icon" href="favicon.ico"/>
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
	<?php echo (C("web_Google_All")); ?>
  </head>
<body>
<?php if(C("show_tishi")== '1'): ?><div class="nlyz">
    <div class="nlyz_main">
    	<div class="col-xs-12 col-md-12 nlzy_text">
    		<div class="years_title">敬请开启</div>  
    		<p class="nlyz_ms">亲爱的渔课用户，您的网站交付啦！请您开启网站。</p>
    		<p>交付只是服务的开始而非结束，请您注意以下事项：</p>
    		<div class="Tips">
    		<p>1，设计图有需要调整的地方请与我们继续沟通</p>
    		<p>2，请及时登录《 <a class="ht" href="<?php echo (C("WEB_URL")); ?>/Kogin" target="_blank">网站后台</a> 》，修改您的基本信息和联系方式</p>
    		<p>3，有任何问题请到您的专属服务群反馈</p>
    		</div>
    		<p class="seeyou">感恩遇见，让我们一起携手做好您的外贸网站，助您的业务一臂之力。</p>
    		<div class="nlyz_btn">
    			<a class="over_gb">开启网站</a>
    			<a class="nlyz_gb">不再提示</a>
    		</div>
    	</div>
    	<div class="close_x">X</div>
    </div>
    </div>
    
    <script>
        $(".over_gb").click(function(){
          $(".nlyz").hide();
        });	
        $(".close_x").click(function(){
          $(".nlyz").hide();
        });	
        
        $(".nlyz_gb").click(function(){
            $.ajax({
               type: "POST",
               url: "__URL__/showtishi",
               data: {},
               async: false,    
              success : function(result) {
                $(".nlyz").hide();
              }
            });
        });
        </script><?php endif; ?>
<?php echo (C("web_Google_Events")); ?>
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

<?php echo W('Flash',array('type'=>'flash','lang'=>'e'));?>
	<script type="text/javascript">
		$('.bxslider').bxSlider({
			adaptiveHeight: true,
			infiniteLoop: true,
			hideControlOnEnd: true,
			auto:true
		});
	</script>


<div class="about_bg">
	<div class="container">    
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="col-xs-12 col-sm-6 col-md-6" data-move-y="-40px">
					<img class="about_img" src="__ROOT__/Uploads/<?php echo W('Flash',array('type'=>3,'id'=>9));?>" alt="About us">
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6" data-move-y="40px">
					<h3 class="about_h3"><?php echo ($titledata["NAME1"]); ?></h3>
					<p class="about_p"><?php echo ($titledata["NAME2"]); ?></p>
					<?php echo W( 'About',array( 'id'=>25,'len'=>450,'lang'=>'e'));?>
					<a href="<?php echo W('Listhref',array('id'=>25,'lang'=>'e'));?>" class="about_btn">READ MORE</a>
				</div>
			</div>
		</div>
	</div>
</div>

	<div class="container">    
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="product_index">
					<div class="product_head" data-move-y="-30px">
						<h2><?php echo ($titledata["NAME4"]); ?></h2>
						<span></span>
					</div>
					<div class="product_list">
						<?php echo W('List',array('table'=>'Product','bid'=>1,'id'=>5,'lang'=>'e'));?>						
					</div>
				</div>
			</div>
		</div>
	</div>
    
	<div class="container">    
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="product_index">
					<div class="product_head" data-move-y="-30px">
						<h2><?php echo ($titledata["NAME5"]); ?></h2>
						<span></span>
					</div>
					<div class="product_list">
						<?php echo W('List',array('table'=>'Product','bid'=>1,'id'=>6,'lang'=>'e'));?>						
					</div>
				</div>
			</div>
		</div>
	</div>
    
	<div class="container">    
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="product_index">
					<div class="product_head" data-move-y="-30px">
						<h2><?php echo ($titledata["NAME6"]); ?></h2>
						<span></span>
					</div>
					<div class="product_list">
						<?php echo W('List',array('table'=>'Product','bid'=>1,'id'=>7,'lang'=>'e'));?>						
					</div>
				</div>
			</div>
		</div>
	</div>

<script src="../Public/js/jquery.smoove.min.js"></script>
<script>$('.product_head,.product_img,.case_head,.case_img,.advantage_head,.advantage_list,.about_head,.js_about_left,.js_about_right,.news_head,.news_img,.cooperation_head,.cooperation_img').smoove({offset:'10%'});</script>
<?php echo W('Link',array('type'=>1,'lang'=>'e'));?>    
<?php echo W('Tags',array('lang'=>'e'));?>      	      	     
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
			<p class="footer_menu_first">Contact Us</p>
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
                  align=absMiddle src="/Home/Tpl/default/Public/images/ico_deutsch1.gif" width=20 
                  height=14> <SPAN style="COLOR: #666">Deutsch</SPAN></A> 
				  
				  <A href="#" data-lang="es"><IMG border=0 
                  align=absMiddle src="/Home/Tpl/default/Public/images/ico_espanol.gif" width=20 
                  height=14> <SPAN style="COLOR: #666">Espanol</SPAN></A>
				   
				  <A href="#" data-lang="fr"><IMG border=0 
                  align=absMiddle src="/Home/Tpl/default/Public/images/ico_francies.gif" width=20 
                  height=14> <SPAN style="COLOR: #666">Francais</SPAN></A> 
				  
				  <A href="#" data-lang="it"><IMG border=0 
                  align=absMiddle src="/Home/Tpl/default/Public/images/ico_italino.gif" width=20 
                  height=14> <SPAN style="COLOR: #666">Italiano</SPAN></A>
				   
				  <A href="#" data-lang="pt"><IMG border=0 
                  align=absMiddle src="/Home/Tpl/default/Public/images/ico_portgues.gif" width=20 
                  height=14> <SPAN style="COLOR: #666">Portugues</SPAN></A>
				   
          <A href="#" data-lang="ja"><IMG border=0 
                  align=absMiddle src="/Home/Tpl/default/Public/images/ico_japan.jpg" width=20 
                  height=14> <SPAN style="COLOR: #666">Japanese</SPAN></A> 
				  
				  <A href="#" data-lang="ko"><IMG border=0 
                  align=absMiddle src="/Home/Tpl/default/Public/images/ico_korea.jpg" width=20 
                  height=14> <SPAN style="COLOR: #666">Korean</SPAN></A> 
				  
				  <A href="#" data-lang="ar"><IMG border=0 
                  align=absMiddle src="/Home/Tpl/default/Public/images/ico_arabia.jpg" width=20 
                  height=14> <SPAN style="COLOR: #666">Arabic</SPAN></A>
				   
				  <A href="#" data-lang="ru"><IMG border=0 
                  align=absMiddle src="/Home/Tpl/default/Public/images/ico_russia.jpg" width=20 
                  height=14> <SPAN style="COLOR: #666">Russian</SPAN></A>
        </p>

          <!-- Code provided by Google -->
          <div id="google_translate_element" style="display:none;"></div>
          <script type="text/javascript">
            function googleTranslateElementInit() {
              new google.translate.TranslateElement({pageLanguage: 'en', autoDisplay: false}, 'google_translate_element'); //remove the layout
            }
          </script>
          <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" async type="text/javascript"></script>


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


	
  </body><?php endif; ?>

<?php if(C("is_index")!= 0): ?><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website under construction</title>
    <meta name="keywords" content="<?php echo (C("seo_keywords")); ?>" />
    <meta name="description" content="<?php echo (C("seo_description")); ?>" />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
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
	<?php echo (C("web_Google_All")); ?>
  </head>
  <body style="font-family: 'Roboto', sans-serif; font-size: 100%; background:url(images/1.jpg) no-repeat 0px 0px; background-size:cover; background-attachment: fixed; padding:3em 0;">
     <div class="agile" style="text-align: center; margin-top:200px;">
     	<div class="container">
			<h1 style=" font-size: 1.5em; color: #fff; text-transform: uppercase;">
			  <span style="font-family: 'Playfair Display', serif; font-size: 3em;">We'll be here soon </span>
			</h1>
			<div class="wthree-info">
				<p style="color: #FFFFFF; font-size: 2em; margin: 1em 0 0 0; font-weight: 100;">Our Web Site is Under Construct Now, please come to visit again later. </p>
			</div>
        </div>
   </div>

  </body><?php endif; ?>
	
</html>