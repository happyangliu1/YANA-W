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
class FeedbackAction extends CommonAction{
	public function index(){
		C('TOKEN_ON',true);
		$template = ($this->lang=='c') ? 'c_index' : 'e_index' ;
		$hide = ($this->lang=='c') ? 'hide' : 'ehide' ;
		$this->bigform=M('form')->field('id,name,ename,type,fieldname,sort,pid,required')->where($hide.' <> 1 AND pid = 0')->order('sort asc')->select();
		$this->smallform=M('form')->field('id,name,ename,type,fieldname,sort,pid,required')->where($hide.' <> 1 AND pid <> 0')->order('sort asc')->select();
		$this->display($template);
	}
	
	public function check(){
		$lang = $this->lang;
		$code_msg = ($lang=='c') ? '验证码错误!' : 'Captcha error!' ;
		$success_msg=($lang=='c') ? '留言成功' : 'Message success' ;

		$_POST=array_map(htmlspecialchars, $_POST);

		if($this->_post('button')!="" && $this->isPost()){
			$code=$this->_post('code');
			if($_SESSION['verify']!==md5($code)){
				$this->error($code_msg);
			}
			
			$db=D('Feedback');
			if($data=$db->create()){	

			$sendtitle= '留言内容：'.mb_substr($data['textarea'], 0,16,'utf-8').'...'; 

			  if($db->data($data)->add()){
				  
				  if(C('IS_EMAIL')){
				  	$hide = ($this->lang=='c') ? 'hide' : 'ehide' ;

				  	$formdata=M('form')->field('id,name,ename,fieldname')->where($hide.' <> 1 AND pid = 0')->order('sort asc')->select();

				  	foreach ($formdata as $v) {
				  		$sendcontents.='<p>'.$v['name'].'：'.$data[$v['fieldname']].'</p>';
				  	}
					
				  	switch (C('SEND_WAY')) {
				  		case '1':
				  		if ($this->smtpsendmail($sendtitle,$sendcontents)) {
				  			$this->success($success_msg);
				  		}else{
				  			$this->error('留言成功,但邮件发送失败!');
				  		}
				  			break;

				  		case '2':
				  		if ($this->mailfunction($data['title'],$sendcontents)) {
				  			$this->success($success_msg.'!!');
				  		}else{
				  			$this->error('留言成功,但邮件发送失败!!');
				  		}
				  			break;

				  		case '3':
				  		$phpmailer=$this->phpmailersend($data['title'],$sendcontents);
				  		if ($phpmailer===1) {
				  			$this->success($success_msg.'...');
				  		}else{
				  			$this->error('留言成功,但邮件发送失败：'.$phpmailer);
				  		}
				  			break;

				  		default:
				  			exit('邮件发送方式设置错误!');
				  			break;
				  	}
				  }else{
					  $this->success($success_msg);
				  }
				  	  
			   }else{
				  $this->error('错误：留言失败!');  
			   }	
			}else{
			  $this->error($db->getError());
			}
		}else{
			$this->error('非法提交');	
		}		
	}

	public function check2(){
		$lang = $this->lang;
	//	$code_msg = ($lang=='c') ? '验证码错误!' : 'Captcha error!' ;
		$success_msg=($lang=='c') ? '留言成功' : 'Message success' ;

		$_POST=array_map(htmlspecialchars, $_POST);

		if($this->_post('button')!="" && $this->isPost()){
		//	$code=$this->_post('code');
		//	if($_SESSION['verify']!==md5($code)){
		//		$this->error($code_msg);
		//	}
			
			$db=D('Feedback');
			if($data=$db->create()){	
				
			$data['email'] = $this->_post('email','htmlspecialchars');
			$sendtitle= '留言内容：'.mb_substr($data['textarea'], 0,16,'utf-8').'...'; 
			 $sendcontents="<p>邮箱：".$data['email']."</p>";

			  if($db->data($data)->add()){
				  
				  if(C('IS_EMAIL')){
					
				  	switch (C('SEND_WAY')) {
				  		case '1':
				  		if ($this->smtpsendmail($sendtitle,$sendcontents)) {
				  			$this->success($success_msg);
				  		}else{
				  			$this->error('留言成功,但邮件发送失败!');
				  		}
				  			break;

				  		case '2':
				  		if ($this->mailfunction($data['title'],$sendcontents)) {
				  			$this->success($success_msg.'!!');
				  		}else{
				  			$this->error('留言成功,但邮件发送失败!!');
				  		}
				  			break;

				  		case '3':
				  		$phpmailer=$this->phpmailersend($data['title'],$sendcontents);
				  		if ($phpmailer===1) {
				  			$this->success($success_msg.'...');
				  		}else{
				  			$this->error('留言成功,但邮件发送失败：'.$phpmailer);
				  		}
				  			break;

				  		default:
				  			exit('邮件发送方式设置错误!');
				  			break;
				  	}
				  }else{
					  $this->success($success_msg);
				  }
				  	  
			   }else{
				  $this->error('错误：留言失败!');  
			   }	
			}else{
			  $this->error($db->getError());
			}
		}else{
			$this->error('非法提交');	
		}		
	}
	
	
}
?>