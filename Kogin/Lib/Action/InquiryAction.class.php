<?php
// +----------------------------------------------------------------------
// | 蓝科企业网站系统PHP版
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://lankecms.com All rights reserved.
// +----------------------------------------------------------------------
// | Sale ( http://lankecms.taobao.com/ )
// +----------------------------------------------------------------------
// | Author: 钟若天 <lankecms@163.com>
// +----------------------------------------------------------------------
class InquiryAction extends CommonAction{
	public function index(){
		$db=D('InquiryView');
		import('ORG.Util.Page');
		$count=$db->count();
		$page=new Page($count,30);
		$this->show=$page->show();
		$this->inquiry=$db->order('time desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->display();
	}
	
	public function view(){
		$id=$this->_get('id','intval');
		$this->inquiry=D('Inquiry')->relation(true)->find($id);
		$this->display();
	}
	
	public function del(){
		$id=$this->_get('id','intval');
		
		$db=M('Inquiry');
		if($db->where(array('id'=>$id))->delete()){
			$this->success('删除订单成功',U('Inquiry/index'));
		}else{
			$this->error('删除失败');
		}
	}
	
	public function alldel(){
		$model = M("Inquiry");
		$model->query('delete from __TABLE__ ');
		$this->redirect('index');
	}
	
	
	
	
	
}
?>