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

class PhotoAction extends CommonAction{
	public function index(){
		$db=M('Photo');
		import('ORG.Util.Page');
		$count=$db->count();
		$page=new Page($count,12);
		$this->show=$page->show();
		$this->photo=$db->field('id,pid,name,ename,sort,thumb')->order('sort asc,id desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->list=recursive(M('List')->field('id,pid,name,type')->where("type = 'photo'")->order('sort')->select());
		$this->display();
	}
	
	//添加页面
	public function add(){
		$this->list=recursive(M('List')->field('id,pid,name,type')->where("type = 'photo'")->order('sort')->select());
		$this->display();
	}

	public function doUploads(){
		$info=$this->uploadimg();
		if ($info) {
			$this->ajaxReturn($info[0]['savename']);
		}	
	}
	
	//修改页面
	public function mod(){
		$this->list=recursive(M('List')->field('id,pid,name,type')->where("type = 'photo'")->order('sort')->select());

		$photolist=M('Photo')->field('',true)->find($this->_get('id','intval'));
		
		if(!empty($photolist['photo'])){
			$photo=explode(',',$photolist['photo']);
			$this->assign('photo',$photo);	
		}
		$this->assign('photolist',$photolist);
		$this->display();	
	}
	
	
	//添加图片
	public function savephoto(){
		$db=D('Photo');
		$_POST['url']=getSeoUrl('photo',$_POST['url']);
		if($data=$db->create()){
			if (!empty($_POST["photo"])) {
				for($i=0;$i<=count($_POST["photo"]);$i++){
					$photo.=$_POST["photo"][$i].',';
					if (C('IS_WATER')) {
						$this->watermark('../Uploads/'.$_POST["photo"][$i]);
					}		
				}
				$photo=rtrim($photo,",");
				$data['photo']=$photo;
			}
			
			if (!empty($_FILES['thumb']['name'])) {
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
				$this->success('图片添加成功',U('Photo/index'));
			}else{
				$this->error('添加失败');
			}
		}else{
			$this->error($db->getError());
		}
	}
	
	//更新图片
	public function updatephoto(){
		$db=D('Photo');
		$id=$this->_post('id','intval');
		$num=$this->_post('Num','intval');
		$tnum=$this->_post('tnum','intval');
		$photo=$db->where('id='.$id)->getField('photo');
		$_POST['url']=getSeoUrl('photo',$_POST['url']);
		if($data=$db->create()){
			$data['bid']=$this->getbigid($data['pid']);

			if (!empty($_POST["photo"])) {
				for($i=0;$i<=count($_POST["photo"]);$i++){
					$postphoto.=$_POST["photo"][$i].',';
					if (C('IS_WATER')) {
						$this->watermark('../Uploads/'.$_POST["photo"][$i]);
					}		
				}
				$photo=($photo=="")? rtrim($postphoto,",") : rtrim($photo.','.$postphoto,",");
				$data['photo']=$photo;
			}
			
			if (!empty($_FILES['thumb']['name'])) {
				$info=$this->uploadimg();
				$data['thumb']=$info[0]['savename'];
				if (C('IS_THUMB')) {
					$this->dothumb('../Uploads/'.$data['thumb'],C('maxwidth'),C('maxheight'));
				}
				if (C('IS_WATER')) {
					$this->watermark('../Uploads/'.$data['thumb']);
				}
			}
		
			if($db->data($data)->save()){
				$this->success('更新成功',U('Photo/index'));
			}else{
				$this->error('更新失败或没有数据被更改');
			}
		}else{
			$this->error($db->getError());	
		}


	}
	
	
	
	//删除图片
	public function delphoto(){
		$name=$this->_get('name');
		$id=$this->_get('id','intval');
		$field=$this->_get('field');

		if($name && $id){
		  $photo=M('Photo')->where('id ='.$id)->getField($field);
		  $photo=str_replace($name.',',"",$photo.',');
		  $photo=rtrim($photo,",");
			if(M('Photo')->where('id='.$id)->setField($field,$photo)){
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

	//删除图片数据
	public function del(){
		$id=$this->_get('id','intval');
		$db=M('Photo');
		$thumb=$db->where('id ='.$id)->getField('thumb');
		$photo=$db->where('id ='.$id)->getField('photo');

		if($db->where('id ='.$id)->delete()){
			delimg('../Uploads/'.$thumb);
			delallimg('../Uploads/',$photo);
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}

	//删除全部主图
	public function delmain(){
		$id=$this->_get('id','intval');
		$db=M('Photo');
		$photo=$db->where('id ='.$id)->getField('photo');
		delallimg('../Uploads/',$photo);
		if ($db->where('id ='.$id)->setField('photo','')) {
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}

	//全选删除
	public function delall(){
		$this->selectDel('Photo');
	}
	
	//更新排序
	public function uporder(){
		$this->getSort('Photo');
	}
	
	//搜索图片
	public function seach(){
		$this->getSearch('photo','name','photo');
	}


}
?>