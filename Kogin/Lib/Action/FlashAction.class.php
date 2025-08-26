<?php
// +----------------------------------------------------------------------
// | 蓝科企业网站系统PHP版
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2020 http://Lankecms.com All rights reserved.
// +----------------------------------------------------------------------
// | Sale ( http://Lankecms.taobao.com )
// +----------------------------------------------------------------------
// | Author: 钟若天 <lankecms@163.com>
// +----------------------------------------------------------------------

class FlashAction extends CommonAction{

	public function index(){
		$this->flash=M('Flash')->where('isdel = 0')->field('id,title,type,sort,photo')->order('type desc,sort asc')->select();
		$this->display();
	}

	public function recycle(){
		$this->flash=M('Flash')->where('isdel = 1')->field('id,title,type,sort,photo')->order('type asc,sort asc')->select();
		$this->display();
	}
	
	public function add(){
		$this->display();	
	}
	
	//添加广告
	public function saveflash(){
		$db=D('Flash');
		
		$info=$this->uploadimg();
		
		if($data=$db->create()){
			$data['photo']=$info[0]['savename'];
			if($db->data($data)->add()){
				$this->success('广告添加成功',U('Flash/index'));
			}else{
				$this->error('广告添加失败');
			}
		}else{
			$this->error($db->getError());
		}	
	}
	
	public function mod(){
		$id=$this->_get('id','intval');
		$this->flash=M('Flash')->field('id,title,etitle,type,sort,link,elink,photo,description,edescription')->find($id);
		$this->display();	
	}
	
	
	//修改广告数据
	public function upflash(){
		$db=D('Flash');
		$num=$this->_post('num','intval');

		if($data=$db->create()){
			if($_FILES['photo']['name'] <> ''){
				$info=$this->uploadimg();
				$data['photo']=$info[0]['savename'];
			}
			if($db->data($data)->save()){
				$this->success('修改广告成功',U('Flash/index'));
			}else{
				$this->error('修改失败或没有修改任何数据');
			}
		}else{
			$this->error($db->getError());	
		}
	}
	
	//删除广告图片
	public function delphoto(){
		$name=$this->_get('name');
		$id=$this->_get('id','intval');
		
		if($name && $id){
			if(M('Flash')->where('id='.$id)->setField('photo','')){
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

	//放入回收站
	public function rec(){
		$db=M('Flash');
		$id=$this->_get('id','intval');
		$result = $db->where('id='.$id)->setField('isdel',1);
		 if($result !== false){
		        $this->success('删除成功');
		    }else{
		        $this->error('删除失败');
		    }
	}

	//恢复广告
	public function recok(){
		$db=M('Flash');
		$id=$this->_get('id','intval');
		$result = $db->where('id='.$id)->setField('isdel',0);
		 if($result !== false){
		        $this->success('恢复成功',U('Flash/index'));
		    }else{
		        $this->error('恢复失败');
		    }
	}
	
	
	//删除广告数据
	public function del(){
		$db=M('Flash');
		$id=$this->_get('id','intval');
		$photo=$db->where('id='.$id)->getField('photo');
		if($db->where('id='.$id)->delete()){
			if(delimg('../Uploads/'.$photo)){
				$this->success('删除成功');
			}else{
				$this->success('数据删除成功，但删除文件失败');
			}			
		}else{
			$this->error('删除失败');
		}
	}

	protected function uploadimg(){
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();
		$upload->allowExts  = array('jpg','gif','png','jpeg','bmp');// 设置附件上传类型
		$upload->savePath =  '../Uploads/'; //不要修改
		
		if(!$upload->upload()) {
			$this->error($upload->getErrorMsg());
		}else{
			$info =  $upload->getUploadFileInfo();
			return $info;
		}
	}
	
	
	//更新排序
	public function uporder(){
		if ($this->isPost()){
		  $arr=$_POST['sort'];
		  foreach($arr as $k=>$v){
			  if(is_numeric($v)){
				  M('Flash')->where(array('id'=>$k))->data(array('sort'=>$v))->save();
			  }else{
				  $this->error('排序号必须为数字');
			  }		
		  }
		  $this->redirect('index');	
		}else{
			$this->error('非法请求');
		}
	}

}
?>