<?php
// +----------------------------------------------------------------------
// | 蓝科企业网站系统PHP版
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2020 http://lankecms.com All rights reserved.
// +----------------------------------------------------------------------
// | Sale ( http://lankecms.taobao.com )
// +----------------------------------------------------------------------
// | Author: 钟若天 <lankecms@163.com>
// +----------------------------------------------------------------------

class CommonAction extends Action{
    public function showtishi(){
		$array=array('show_tishi'=>'0');
		$file = 'config.php';
		
		$config=array_merge(include $file , array_change_key_case($array,CASE_UPPER));
		$str = "<?php\r\nreturn " . var_export($config, true) . ";\r\n?>";
		if(file_put_contents($file,$str)){
			return true;
		}else{
			return false;
		}
	}
	public function _initialize(){
		header("Content-Type:text/html; charset=utf-8");
		$this->lang = I('get.g');
	}
	
	//上一个下一个
	protected function prevnext($table,$id,$name,$text,$lang){
		if ($lang=='c') {
			$noprevmsg='没有上一'.$text;
			$prevmsg='上一'.$text;
			$nonextmsg='没有下一'.$text;
			$nextmsg='下一'.$text;
		} else {
			
			$noprevmsg='No previous';
			$prevmsg='PREVIOUS';
			$nonextmsg='No next';
			$nextmsg='NEXT';
		}
		
		$db=M($table);
		$p=$db->field("id,url,{$name}")->where('id<'.$id)->order('id desc')->limit(1)->find();
		$prev=!$p? $noprevmsg : $prevmsg.'：<a href="'.W('Href',array('url'=>$p['url'],'id'=>$p['id'],'type'=>$table,'lang'=>$lang),true).'" title="'.$p[$name].'">'.mb_substr($p[$name], 0,45,'utf-8').'</a>';
		
		$n=$db->field("id,url,{$name}")->where('id>'.$id)->order('id asc')->limit(1)->find();
		$next=!$n? $nonextmsg : $nextmsg.'：<a href="'.W('Href',array('url'=>$n['url'],'id'=>$n['id'],'type'=>$table,'lang'=>$lang),true).'" title="'.$n[$name].'">'.mb_substr($n[$name], 0,45,'utf-8').'</a>';
		
		$prevnext=array('prev'=>$prev,'next'=>$next);
		return $prevnext;
	}
	
	//验证码
	public function verify(){
		import('ORG.Util.Image');
		ob_end_clean();
		Image::buildImageVerify();
	}
	
	//标签
	protected function doTags($table){
		$id=(int)I('get.id');
		$lang = $this->lang;

		$fieldname = ($lang=='c') ? 'name' : 'ename' ;
		$name=M('Tags')->where(array('id'=>$id))->getField($fieldname);
		if (!$name) {
			$this->error('非法参数');
		}
		$types=strtolower($table);

		$db=M($table);
		$where = ($lang=='c') ? " title like '%%%s%%' or description like '%%%s%%' " : " etitle like '%%%s%%' or edescription like '%%%s%%' " ;

		import('@.Org.Page');
		$count=$db->where($where,array($name,$name))->count();
		$cnenurl = ($lang=='c') ? C('CN_URL') : C('EN_URL') ;
		$pageurl = (C('URL_MODEL')==2) ? $cnenurl.'/'.$types.'_tags_'.$id : '' ;
		$page=new Page($count,20,'',$pageurl);
		$prevs= ($lang=='c') ? '上一页' : 'Previous' ;
		$nexts= ($lang=='c') ? '下一页' : 'Next' ;
		$page->setConfig('prev',$prevs);
		$page->setConfig('next',$nexts);
		$page->setConfig('theme',"%upPage% %linkPage% %downPage%");
		$this->show=$page->show();
		$this->article=$db->field('id,title,etitle,url,description,edescription')->where($where,array($name,$name))->limit($page->firstRow.','.$page->listRows)->select();

		$this->name=$name;
		$this->type=$table;
		$template = ($lang=='c') ? 'Tags:c_tag' : 'Tags:e_tag' ;
		$this->display($template);
	}

	//内链
	protected function doInside($array,$lang){
	    $indb=M('Inside');
	    $indata=$indb->field('id,keyword,ekeyword,url,eurl,number')->select();
	    $skey = ($lang=='c') ? 'keyword' : 'ekeyword' ;
	    $surl = ($lang=='c') ? 'url' : 'eurl' ;
	    foreach ($indata as $key => $value) {
	        $array=preg_replace('#'.$value[$skey].'#i',"<a href=".$value[$surl]." target='_blank'>".$value[$skey]."</a>",$array,$value['number']);
	   }

	   return $array;
	}

	public function down(){
            if (!is_numeric($_GET['id'])) {
                exit('非法参数');
            }
            $id=(int)I('get.id');
            if ($id < 1) {
                exit('非法操作');
            }
            $name=M("Download")->where("id=%d",array($id))->getField('filename');
            if ($name) {
                  $path='./Uploads/download/';
                  if(is_file($path.$name)){
                  header('Content-Disposition: attachment; filename="'.$name.'"');
                  header('Content-Length:'.filesize($path.$name));
                  readfile($path.$name);
                  }else{
                  $this->error('找不到此文件或此文件已被删除',__ROOT__.'/');  
                  }
            } else {
                 $this->error('找不到此文件',__ROOT__.'/');
                 die();
            }
	}

	protected function getarticle($var,$where,$lang,$table){
		if ($table=='New' || $table=='Download') {
			$fname = ($lang=='c') ? 'title' : 'etitle' ;
			$relafield='id,url,title,etitle,time';
		} else {
			$fname = ($lang=='c') ? 'name' : 'ename' ;
			$relafield='id,name,ename,description,edescription,url,thumb';
		}
		$db=M($table);
		$article=$db->field('sort',true)->where($where,array($var))->find();
		if ($article) {
			//内链处理
			if ($lang=='c') {
				$article['contents']=$this->doInside($article['contents'],'c');
			} else {
				$article['econtents']=$this->doInside($article['econtents'],'e');
			}
			//相关信息
			$this->related=$db->field($relafield)->where("pid = ".$article['pid']." and id <> ".$article['id'])->select();
			//图片数组
			if(!empty($article['photo'])){
			  $this->photo=explode(',',$article['photo']);	
			}
			//分类信息
			$this->articlelist=M('list')->field('id,pid,bid,type,name,ename')->find($article['pid']);
		}else{
			$this->_empty();
			exit;
		}

		$this->prevnext=$this->prevnext($table,$article['id'],$fname,'个',$lang);
		//分配信息
		$this->article=$article;
		$template = ($lang=='c') ? 'c_index' : 'e_index' ;
		$this->display($template);
	}

	public function version(){
		echo C('VERSION');
	}

	protected function smtpsendmail($title,$contents){
		import('@.Org.Email');
		$smtpserver = C('EMAIL_HOST');                //SMTP服务器
		$smtpserverport =C('EMAIL_PORT');           //SMTP服务器端口
		$smtpusermail = C('EMAIL_USERNAME');   //用户邮箱
		$smtpemailto = C('EMAIL_TO');                   //发送给谁
		$smtpuser = C('EMAIL_USERNAME');         //帐号
		$smtppass = C('EMAIL_PASSWORD');       //密码
		$mailsubject = $title;                                    //标题
		$mailbody = $contents;
		$mailtype = "HTML";
		$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
		$smtp->debug = FALSE;       //是否显示发送的调试信息
		if ($smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype)) {
			return true;
		}else{
			return false;
		}
	}

	protected function mailfunction($title,$contents){
		$to = C('EMAIL_TO');                                                     //发送给谁 
		$subject = "=?UTF-8?B?".base64_encode($title)."?=";  //标题,防止乱码
		$message = $contents;                                                 //发送给谁
		$headers = 'MIME-Version: 1.0' . "\r\n"; 
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; //Additional headers 
		$headers .= 'Reply-To: '.C('EMAIL_FROMNAME').'<'.C('EMAIL_USERNAME').'>' . "\r\n"; 
		$headers .= 'From: '.C('EMAIL_FROMNAME').'<'.C('EMAIL_USERNAME').'>' . "\r\n"; 
		if (mail($to,$subject,$message,$headers)) {
			 return true;
		} else {
			return false;
		}
	}

	protected function phpmailersend($title,$contents){
		  import('@.Org.Phpmailer');
		  try { 
			  $mail = new PHPMailer(true); 
			  $mail->IsSMTP(); 
			  $mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码 
			  $mail->SMTPAuth = true; //开启认证 
			  $mail->Port = C('EMAIL_PORT'); 
			  $mail->Host = C('EMAIL_HOST'); 
			  $mail->Username = C('EMAIL_USERNAME'); 
			  $mail->Password = C('EMAIL_PASSWORD'); 
			  $mail->AddReplyTo(C('EMAIL_USERNAME'),C('EMAIL_USERNAME'));//回复地址 
			  $mail->From = C('EMAIL_USERNAME'); 
			  $mail->FromName = C('EMAIL_FROMNAME'); 
			  $to = C('EMAIL_TO'); 
			  $mail->AddAddress($to); 
			  $mail->Subject = $title; 
			  $mail->Body = $contents; 
			  $mail->WordWrap = 120; // 设置每行字符串的长度 
			  $mail->IsHTML(true); 
			  $mail->Send(); 
			  return 1;
		  } catch (phpmailerException $e) { 
			  return $e->errorMessage();
		  }
	}

	public function _empty(){
		$lang = I('get.g');
		$template = ($lang=='c') ? 'Public:c_404' : 'Public:e_404' ;
		header("HTTP/1.0 404 Not Found");//使HTTP返回404状态码
		$this->list=recursive(M('List')->field('id,name,ename,url,pid,sort,type,link')->order('sort')->select());
		$this->display($template); 
	}
	
}
?>