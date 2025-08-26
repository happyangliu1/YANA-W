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
class LoginAction extends Action{

	public function index(){
		if (C('APPDIR') <> __ROOT__) {
			$array = array('APPDIR' => __ROOT__ );
			$this->setconfig($array,'../config.php');
		}
		$this->display();	
	}

	public function checkLogin(){
		header("Content-Type:text/html; charset=utf-8");
		if($_SESSION['verify'] != $this->_post('code','md5')){
			$this->error('验证码错误！');
		}
		if($this->isPost()){
			$db=M('User');
			$where['username']=array('eq',$_POST['username']);
			$where['password']=array('eq',$this->_post('password','md5'));
			$where['_logic'] = 'and';
			$result=$db->where($where)->find();
			if(!$result){
				$this->error('用户名或密码错误！');
			}else{
				session('uid',$result['id']);
				session('uname',$result['username']);
				redirect(__APP__);
			}	
		}else{
			$this->error('非法操作');		
		}	
	}

	public function verify(){
		import('@.Org.Image');
		ob_end_clean();
		Image::buildImageVerify();
	}
	
	public function log(){
		$ip = get_client_ip();
		echo '您的登录IP是：'. $ip;
		import('ORG.Net.IpLocation');
		$Ip = new IpLocation('UTFWry.dat');
		$area = $Ip->getlocation($ip);
	}
	
	protected function setconfig($array,$file){
		$config=array_merge(include $file , array_change_key_case($array,CASE_UPPER));
		$str = "<?php\r\nreturn " . var_export($config, true) . ";\r\n?>";
		if(file_put_contents($file,$str)){
			return true;
		}else{
			return false;
		}
	}

}
?>