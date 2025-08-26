<?php
// +----------------------------------------------------------------------
// | 蓝科企业网站系统PHP版
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://lankecms.com All rights reserved.
// +----------------------------------------------------------------------
// | Sale ( http://lankecms.taobao.com )
// +----------------------------------------------------------------------
// | Author: 钟若天 <lankecms@163.com>
// +----------------------------------------------------------------------

class LinkAction extends CommonAction{
	public function index(){
		$db=M('Link');
		import('ORG.Util.Page');
		$count=$db->count();
		$page=new Page($count,20);
		$this->show=$page->show();
		$this->links=$db->field('id,name,ename,url,sort')->where('type = 1')->order('sort')->limit($page->firstRow.','.$page->listRows)->select();
		$this->display();	
	}
	
	public function add(){
		$this->display();	
	}

	public function addphoto(){
		$this->display();	
	}

	public function photo(){
		$db=M('Link');
		import('ORG.Util.Page');
		$count=$db->count();
		$page=new Page($count,20);
		$this->show=$page->show();
		$this->links=$db->field('id,name,ename,url,sort,photo')->where('type = 2')->order('sort')->limit($page->firstRow.','.$page->listRows)->select();
		$this->display();	
	}
	
	public function addlink(){
		if(!is_numeric($_POST['sort'])){
			$this->error('排序号必须为数字');	
		}
		$db=M('Link');
		if($data=$db->create()){
			if($db->data($data)->add()){
				$this->success('添加成功',U('Link/index'));
			}else{
				$this->error('修改失败');
			}
		}else{
			$this->error($this->getError());	
		}
	}

	public function savephoto(){
		if (!is_numeric($_POST['sort'])) {
			$this->error('排序号必须为数字');
		}
		$info=$this->uploadimg();
		$db=M('Link');
		if ($data=$db->create()) {
			$data['photo']=$info[0]['savename'];
			if($db->data($data)->add()){
				$this->success('添加成功',U('Link/photo'));
			}else{
				$this->error('修改失败');
			}
		}else{
			$this->error($db->getError());
		}
	}
	
	public function upphoto(){
		if ($_POST['name']=="") {
			$this->error('链接名称不能为空');
		}
		if(!is_numeric($_POST['sort'])){
			$this->error('排序号必须为数字');	
		}
		$db=M('Link');
		$num=$this->_post('num','intval');
		if($data=$db->create()){
			if($num){
				$info=$this->uploadimg();
				$data['photo']=$info[0]['savename'];
			}
			if($db->data($data)->save()){
				$this->success('修改成功',U('Link/photo'));
			}else{
				$this->error('修改失败或没有修改任何数据');
			}
		}else{
			$this->error($db->getError());	
		}
	}
	
	public function mod(){
		$id=$this->_get('id','intval');
		$this->links=M('Link')->field('id,name,ename,url,eurl,sort')->find($id);
		$this->display();	
	}

	public function modphoto(){
		$id=$this->_get('id','intval');
		$this->links=M('Link')->field('id,name,ename,url,eurl,sort,photo')->find($id);
		$this->display();
	}
	
	public function uplink(){
		if(!is_numeric($_POST['sort'])){
			$this->error('排序号必须为数字');	
		}
		$db=M('Link');
		if($data=$db->create()){
			if($db->data($data)->save()){
				$this->success('修改成功',U('Link/index'));
			}else{
				$this->error('修改失败或没有修改数据');	
			}
		}else{
			$this->error($db->getError());	
		}			
	}

	//删除
	public function del(){
		$db=M('Link');
		$id=$this->_get('id','intval');
		$photo=$db->where('id='.$id)->getField('photo');
		if($db->where('id='.$id)->delete()){
			if ($_GET['type'] == 'photo') {
				delimg('../Uploads/'.$photo);
			}
			$this->success('删除成功');
		}else{
			$this->error('删除失败');	
		}
	}

	//删除图片
	public function delphoto(){
		$name=$this->_get('name');
		$id=$this->_get('id','intval');
		if ($name && $id) {
			if (M('Link')->where('id ='.$id)->setField('photo','')) {
				if(delimg('../Uploads/'.$name)){
					$this->success('删除成功',U('modphoto',array('id'=>$id)));
				}else{
					$this->error('数据删除成功，但找不到要删除的文件',U('modphoto',array('id'=>$id)));
				}		
			} else {
				$this->error('删除失败');
			}
			
		} else {
			$this->error('非法操作');
		}
		
	}
	
	//更新排序
	public function uporder(){
		if ($this->isPost()){
		  $arr=$_POST['sort'];
		  foreach($arr as $k=>$v){
			  if(is_numeric($v)){
				  M('Link')->where(array('id'=>$k))->data(array('sort'=>$v))->save();
			  }else{
				  $this->error('排序号必须为数字');
			  }		
		  }
			if (empty($_GET['url'])) {
			  	$this->redirect('index');
			} else {
				$this->redirect($_GET['url']);
			}
	
		}else{
			$this->error('非法请求');
		}
	}
	


}
?>