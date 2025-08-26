<?php
// +----------------------------------------------------------------------
// | 蓝科企业网站系统PHP版
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2020 http://lankecms.com All rights reserved.
// +----------------------------------------------------------------------
// | Sale ( http://lankecms.taobao.com/ )
// +----------------------------------------------------------------------
// | Author: 钟若天 <lankecms@163.com>
// +----------------------------------------------------------------------

class NewAction extends CommonAction{
	public function index(){
		$db=M('New');
		import('ORG.Util.Page');
		$count=$db->count();
		$page=new Page($count,20);
		$this->show=$page->show();
		$this->news=$db->field('id,pid,title,etitle,sort')->order('sort asc,id desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->list=recursive(M('List')->field('id,pid,name,type')->where("type = 'new'")->order('sort')->select());
		$this->display();	
	}

	public function add(){
		$this->list=recursive(M('List')->field('id,pid,name,type')->where("type='new'")->order('sort')->select());
		$this->display();
	}
	
	public function mod(){
		$this->list=recursive(M('List')->field('id,pid,name,type')->where("type='new'")->order('sort')->select());
		$this->news=M('New')->field('',true)->find($this->_get('id','intval'));
		$this->display();	
	}
	
	//修改新闻
	public function updatenew(){
		$_POST['time'] = ($_POST['time'] != '') ? strtotime($_POST['time']) : time() ;
		$db=D('New');
		$_POST['url']=getSeoUrl('new',$_POST['url']);
		if($data=$db->create()){
			if ($_FILES['thumb']['name'] <> '') {
				$info=$this->uploadimg();
				$data['thumb']=$info[0]['savename'];
				if (C('IS_THUMB')) {
					$this->dothumb('../Uploads/'.$data['thumb'],C('maxwidth'),C('maxheight'));
				}
				if (C('IS_WATER')) {
					$this->watermark('../Uploads/'.$data['thumb']);
				}
			}
			$data['bid']=$this->getbigid($data['pid']);
			if($db->data($data)->save()){
				$this->success('修改新闻成功',U('New/index'));
			}else{
				$this->error('修改失败或没修改数据');
			}
		}else{
			$this->error($db->getError());
		}
	}
	
	//添加新闻
	public function savenew(){
		$_POST['time'] = ($_POST['time'] != '') ? strtotime($_POST['time']) : time() ;
		$db=D('New');
		$_POST['url']=getSeoUrl('new',$_POST['url']);
		if($data=$db->create()){
			if ($_FILES['thumb']['name'] <> '') {
				$info=$this->uploadimg();
				$data['thumb']=$info[0]['savename'];
				if (C('IS_THUMB')) {
					$this->dothumb('../Uploads/'.$data['thumb'],C('maxwidth'),C('maxheight'));
				}
				if (C('IS_WATER')) {
					$this->watermark('../Uploads/'.$data['thumb']);
				}
			}
			$data['bid']=$this->getbigid($data['pid']);
			if($db->data($data)->add()){
				$this->success('添加新闻成功',U('New/index'));
			}else{
				$this->error('添加失败');	
			}
		}else{
			$this->error($db->getError());	
		}
	}
	
	//删除新闻
	public function del(){
		$id=$this->_get('id','intval');
		if($id){
			if(M('New')->where('id='.$id)->delete()){
				$this->success('删除成功');
			}else{
				$this->error('删除失败');	
			}
		}else{
			$this->error('非法操作');	
		}
	}

	//删除图片
	public function delthumb(){
		$name=$this->_get('name');
		$id=$this->_get('id','intval');
		
		if($name && $id){
			if(M('New')->where('id='.$id)->setField('thumb','')){
				if(delimg('../Uploads/'.$name)){
					echo 1;
				}else{
					echo 1;
				}
			}else{
				echo 0;
			}
		}else{
			echo 0;
		}
	}
	
	//更新排序
	public function uporder(){
		$this->getSort('New');
	}

	//全选删除
	public function delall(){
		if ($this->isPost()) {
			if ($_POST['dell']=="") {
				$this->error('您未选择任何数据');
			}
			$ids=implode(",", $_POST['dell']);
			$where['id']=array('in',$ids);
			if (M('New')->where($where)->delete()) {
				$this->success('删除成功');
			} else {
				$this->error('删除失败');
			}		
		} else {
			$this->error('非法请求');
		}
	}

	//搜索新闻
	public function seach(){
		$this->getSearch('new','title','news');
	}

}
?>