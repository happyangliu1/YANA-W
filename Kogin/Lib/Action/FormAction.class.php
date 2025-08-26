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
class FormAction extends CommonAction{

	public function index(){
		$data=M('form')->order('sort asc')->select();
		$this->formdata = recursive($data);
		//dump($this->formdata);die();
		$this->display();
	}

	public function mod(){
		$this->formdata=M('form')->find($this->_get('id','intval'));
		$this->display();
	}

	public function update(){
		if ($_POST['name'] == '') {
			$this->error('名称不能为空!');
		}
		if (!is_numeric($_POST['sort'])) {
			$this->error('排序号必须为数字');
		}
		$db=M('form');
		if ($data=$db->create()) {
			if ($db->data($data)->save()) {
				$this->success('修改成功!',U('Form/index'));
			} else {
				$this->error('修改失败!');
			}
		} else {
			$this->error($this->getError());
		}
	}

	public function add(){
		$this->pid = $this->_get('pid','intval');
		$this->fieldname = $this->_get('fieldname');
		$this->type = $this->_get('type');
		$this->display();
	}

	public function save(){
		if ($_POST['name'] == '') {
			$this->error('名称不能为空');
		}
		if (!is_numeric($_POST['sort'])) {
			$this->error('排序号必须为数字');
		}
		$db=M('form');
		if ($data=$db->create()) {
			if($db->data($data)->add()){
				$this->success('添加成功',U('Form/index'));
			} else{
				$this->error('添加失败');
			}
		} else {
			$this->error($this->getError());
		}
		
	}

	public function del(){
		$id = $this->_get('id','intval');
		if (M('Form')->where('id ='.$id)->delete()) {
			$this->success('删除成功!');
		} else {
			$this->error('删除失败!');
		}
	}

	//排序
	public function uporder(){
		$this->getSort('Form');
	}










}

?>