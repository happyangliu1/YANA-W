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
class FeedbackAction extends CommonAction{
	public function index(){
		$db=M('Feedback');
		import('ORG.Util.Page');
		$count=$db->count();
		$page=new Page($count,30);
		$this->show=$page->show();
	
		$this->feed=$db->field('id,textarea,time')->order('time desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->display();
	}
	
	public function view(){
		$id=$this->_get('id','intval');
		$this->feed=M('Feedback')->find($id);
		//$this->formdata=M('form')->field('name,fieldname')->where('hide <> 1 AND pid = 0')->order('sort asc')->select();
		$this->formdata=M('form')->field('name,ename,fieldname')->where('pid = 0')->order('sort asc')->select();
		$this->display();
	}
	
	public function del(){
		$id=$this->_get('id','intval');
		
		$db=M('Feedback');
		if($db->where(array('id'=>$id))->delete()){
			$this->success('删除留言成功',U('Feedback/index'));
		}else{
			$this->error('删除失败');
		}
	}
	
	public function alldel(){
		$model = M("Feedback");
		$model->query('delete from __TABLE__ ');
		$this->redirect('index');
	}
	
	
	
	
}
?>