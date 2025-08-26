<?php
class SitemapAction extends CommonAction{
	public function _initialize(){
		header("Content-Type:text/html; charset=utf-8");
		if(!isset($_SESSION['uid']) || !isset($_SESSION['uname'])){
			$this->error('非法操作!');
		}
	}

	public function index(){
		$this->list=recursive(M('List')->field('id,name,ename,url,pid,sort,type,link,elink')->order('sort')->select());
		$this->buildHtml('c_sitemap','./','c_index','utf8');
		$this->buildHtml('e_sitemap','./','e_index','utf8');
		echo '<div style="font-size:16px; line-height:20px; color:#535353; padding:12px; background-color:#effaff; border:solid 1px #dbe2ef">';
		echo "中文站点地图生成成功..<a href='".__ROOT__."/c_sitemap.html' target='_blank'>c_sitemap.html</a><br>";
		echo "英文站点地图生成成功..<a href='".__ROOT__."/e_sitemap.html' target='_blank'>e_sitemap.html</a><br>";
		echo '</div>';
	}

	public function baidu(){
		$list=M('List')->field('id,pid,url,link,sort')->select();
		$product=M('Product')->field('id,pid,url,sort')->select();
		$new=M('New')->field('id,pid,url,sort')->select();
		$download=M('Download')->field('id,pid,url,sort')->select();
		$photo=M('Photo')->field('id,pid,url,sort')->select();
		
		$baidu="<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
		$baidu.="<urlset>\r\n";
		
		$baidu.="<url>\r\n";
		$baidu.="<loc>".C('WEB_URL')."</loc>\r\n";
		$baidu.="<lastmod>".date("Y-m-d")."</lastmod>\r\n";
		$baidu.="<changefreq>daily</changefreq>\r\n";
		$baidu.="<priority>1.0</priority>\r\n";
		$baidu.="</url>\r\n\r\n";
		
		$baidu.=$this->baiduxml($list,'list');
		$baidu.=$this->baiduxml($product,'product');
		$baidu.=$this->baiduxml($new,'new');
		$baidu.=$this->baiduxml($download,'download');
		$baidu.=$this->baiduxml($photo,'photo');

		$baidu.="</urlset>";
		
		if(file_put_contents("baidu.xml",$baidu)){	
			echo '<div style="font-size:12px; line-height:20px; color:#535353; padding:12px; background-color:#effaff; border:solid 1px #dbe2ef">';
			echo "<font style='font-size:18px'>百度Sitemap生成成功..<a href='".__ROOT__."/baidu.xml' target='_blank'>baidu.xml</a></font></br></br>";
			echo "根据百度站长平台所说，提交sitemap有利于百度收录。</br>提交方法：</br>";
			echo "1、进入百度站长平台，注册帐号并登录</br>";
			echo "2、点击'数据提交' > 'Sitemap' > '添加新数据'</br>";
			echo "3、输入http://你的域名/baidu.xml，提交即可</br>";
			echo '</div>';
		}else{
			echo'百度Sitemap生成失败';
		}		
	}

	public function google(){
		$list=M('List')->field('id,pid,url,link,sort')->select();
		$product=M('Product')->field('id,pid,url,sort')->select();
		$new=M('New')->field('id,pid,url,sort')->select();
		$download=M('Download')->field('id,pid,url,sort')->select();
		$photo=M('Photo')->field('id,pid,url,sort')->select();
		
		$google="<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n";
		$google.="<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\r\n";
		
		$google.="<url>\r\n";
		$google.="<loc>".C('WEB_URL')."</loc>\r\n";
		$google.="<priority>1.0</priority>\r\n";
		$google.="<lastmod>".date("Y-m-d")."</lastmod>\r\n";
		$google.="<changefreq>weekly</changefreq>\r\n";
		$google.="</url>\r\n\r\n";
		
		$google.=$this->googlexml($list,'list');
		$google.=$this->googlexml($product,'product');
		$google.=$this->googlexml($new,'new');
		$google.=$this->googlexml($download,'download');
		$google.=$this->googlexml($photo,'photo');

		$google.="</urlset>";
		
		if(file_put_contents("sitemap.xml",$google)){
			echo '<div style="font-size:12px; line-height:20px; color:#535353; padding:12px; background-color:#effaff; border:solid 1px #dbe2ef">';
			echo "<font style='font-size:18px'>谷歌Sitemap生成成功..<a href='".__ROOT__."/sitemap.xml' target='_blank'>sitemap.xml</a></br></br></font>";
			echo "Sitemap生成后，可提交给谷歌站长平台，有利于收录。</br>提交方法：</br>";
			echo "1、登录谷歌站长平台，添加站点网址。</br>";
			echo "2、点击站点名称的链接，进入网站站长工具。</br>";
			echo "3、点击站点地图，输入http://你的域名/sitemap.xml，提交即可。</br>";
			echo '</div>';
		}else{
			echo'谷歌Sitemap生成失败';
		}
	}

	protected function baiduxml($array,$type){
		foreach($array as $value){
			$baidu.="<url>\r\n";
			$ebaidu.="<url>\r\n";
			if ($type=='list') {
				$homeurl = (stripos($value['link'],"http://")!== false) ? "" : C('WEB_URL') ;
				$baidu.="<loc>".$homeurl.W('Listhref',array('url'=>$value['url'],'id'=>$value['id'],'link'=>$value['link'],'lang'=>'c'),true)."</loc>\r\n";
				$ebaidu.="<loc>".$homeurl.W('Listhref',array('url'=>$value['url'],'id'=>$value['id'],'link'=>$value['link'],'lang'=>'e'),true)."</loc>\r\n";
			} else {
				$baidu.="<loc>".C('WEB_URL').W('Href',array('url'=>$value['url'],'id'=>$value['id'],'type'=>$type,'lang'=>'c'),true)."</loc>\r\n";
				$ebaidu.="<loc>".C('WEB_URL').W('Href',array('url'=>$value['url'],'id'=>$value['id'],'type'=>$type,'lang'=>'e'),true)."</loc>\r\n";
			}
			$baidu.="<lastmod>".date("Y-m-d")."</lastmod>\r\n";
			$baidu.="<changefreq>daily</changefreq>\r\n";
			$baidu.="<priority>0.8</priority>\r\n";
			$baidu.="</url>\r\n\r\n";
			$ebaidu.="<lastmod>".date("Y-m-d")."</lastmod>\r\n";
			$ebaidu.="<changefreq>daily</changefreq>\r\n";
			$ebaidu.="<priority>0.8</priority>\r\n";
			$ebaidu.="</url>\r\n\r\n";
		}
		return $baidu.$ebaidu;
	}

	protected function googlexml($array,$type){
		foreach($array as $value){
			$google.="<url>\r\n";
			$egoogle.="<url>\r\n";
			if ($type=='list') {
				$homeurl = (stripos($value['link'],"http://")!== false) ? "" : C('WEB_URL') ;
				$google.="<loc>".$homeurl.W('Listhref',array('url'=>$value['url'],'id'=>$value['id'],'link'=>$value['link'],'lang'=>'c'),true)."</loc>\r\n";
				$egoogle.="<loc>".$homeurl.W('Listhref',array('url'=>$value['url'],'id'=>$value['id'],'link'=>$value['link'],'lang'=>'e'),true)."</loc>\r\n";
			} else {
				$google.="<loc>".C('WEB_URL').W('Href',array('url'=>$value['url'],'id'=>$value['id'],'type'=>$type,'lang'=>'c'),true)."</loc>\r\n";
				$egoogle.="<loc>".C('WEB_URL').W('Href',array('url'=>$value['url'],'id'=>$value['id'],'type'=>$type,'lang'=>'e'),true)."</loc>\r\n";
			}
			$google.="<priority>0.5</priority>\r\n";
			$google.="<lastmod>".date("Y-m-d")."</lastmod>\r\n";
			$google.="<changefreq>weekly</changefreq>\r\n";
			$google.="</url>\r\n\r\n";
			$egoogle.="<priority>0.5</priority>\r\n";
			$egoogle.="<lastmod>".date("Y-m-d")."</lastmod>\r\n";
			$egoogle.="<changefreq>weekly</changefreq>\r\n";
			$egoogle.="</url>\r\n\r\n";
		}
		return $google.$egoogle;
	}


}
?>