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
class FootAction extends CommonAction{
	
	public function index(){
		$data=M('Foot')->field('id,name,ename,url,eurl,sort,pid')->order('sort')->select();
		$this->footdata=recursive($data);
		$this->display();
	}

	public function add(){
		$this->pid = $this->_get('pid','intval');
		$this->display();
	}

	public function save(){
		if ($_POST['name']=="" || $_POST['ename']=="") {
			$this->error('菜单名称不能为空');
		}
		if(!is_numeric($_POST['sort'])){
			$this->error('排序号必须为数字');	
		}
		$db=M('Foot');
		if ($data=$db->create()) {
			if ($db->data($data)->add()) {
				$this->success('添加菜单成功!',U('Foot/index'));
			} else {
				$this->error('添加失败!');
			}		
		}else{
			$this->error($this->getError());
		}
	}

	public function mod(){
		$this->foot=M('Foot')->find($this->_get('id','intval'));
		$this->display();
	}

	public function update(){
		if ($_POST['name']=="") {
			$this->error('菜单名称不能为空');
		}
		if(!is_numeric($_POST['sort'])){
			$this->error('排序号必须为数字');	
		}
		$db=M('Foot');
		if ($data=$db->create()) {
			if ($db->data($data)->save()) {
				$this->success('修改菜单成功!',U('Foot/index'));
			} else {
				$this->error('修改失败!');
			}
			
		} else {
			$this->error($this->getError());
		}
		
	}

	public function del(){
		$id=$_GET['id'];
		$db=M('Foot');
		$foot=$db->field(array('id', 'pid'))->select();
		$allid=get_all_child($foot,$id);
		$allid[]=$id;
		$where = array('id' => array('IN', $allid));
		if ($db->where($where)->delete()) {
			$this->success('删除成功!');
		} else {
			$this->error('删除失败!');
		}
		
	}

	public function uporder(){
		$this->getSort('Foot');
	}


}











?>