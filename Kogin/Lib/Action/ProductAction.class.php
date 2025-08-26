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

class ProductAction extends CommonAction{
	public function index(){
		$db=M('product');
		import('ORG.Util.Page');
		$count=$db->count();
		$page=new Page($count,12);
		$this->show=$page->show();
		$this->product=$db->field('id,pid,name,ename,sort,thumb,featured')->order('sort asc,id desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->list=recursive(M('List')->field('id,pid,name,type')->where("type = 'product'")->order('sort')->select());
		$this->display();	
	}
	
	public function add(){
		$this->list=recursive(M('List')->field('id,pid,name,type')->where("type= 'product'")->order('sort')->select());
		$this->display();
	}

	public function doUploads(){
		$info=$this->uploadimg();
		if ($info) {
			$this->ajaxReturn($info[0]['savename']);
		}	
	}
	
	//修改显示页面
	public function mod(){
		$this->list=recursive(M('List')->field('id,pid,name,type')->where("type = 'product'")->order('sort')->select());
		$product=M('Product')->field('',true)->find($this->_get('id','intval'));

		if(!empty($product['photo'])){
			$photo=explode(',',$product['photo']);
			$this->assign('photo',$photo);	
		}
		$this->assign('product',$product);
		$this->display();	
	}

	//导出产品
	public function exportp(){
		header("Content-type:text/csv;charset=utf-8");
		header('Content-Encoding: GB2312');
	    header("Content-Disposition:attachment;filename=" . "export-product.csv");
	    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
	    header('Expires:0');
	    header('Pragma:public');    
	    $output = fopen('php://output', 'w'); 
	    print(chr(0xEF).chr(0xBB).chr(0xBF)); 

	    $header = array('中文产品名称','英文产品名称', '中文SEO标题', '英文SEO标题', 'url', '中文SEO关键词', '英文SEO关键词', '中文SEO描述', '英文SEO描述', '中文产品内容', '英文产品内容', ' 产品分类id', '根分类id', '产品主图(逗号分割)', '缩略图', '中文产品简介', '英文产品简介', '排序ID','首页推荐');//设置表头
	    //$header = array('name', 'title', 'url', 'keywords', 'description', 'contents', ' pid', 'bid', 'photo', 'thumb', 'introduce', 'sort', 'featured');
	    fputcsv($output, $header);

		$product=M('Product')->select();

        $num_data = count($product);
        for($i=0;$i<$num_data; $i++){
        	$data[0] = $product[$i]['name'];
        	$data[1] = $product[$i]['ename'];
        	$data[2] = $product[$i]['title'];
        	$data[3] = $product[$i]['etitle'];
        	$data[4] = $product[$i]['url'];
        	$data[5] = $product[$i]['keywords'];
        	$data[6] = $product[$i]['ekeywords'];
        	$data[7] = $product[$i]['description'];
        	$data[8] = $product[$i]['edescription'];
        	$data[9] = $product[$i]['contents'];
        	$data[10] = $product[$i]['econtents'];
        	$data[11] = '6';
        	$data[12] = '1';
        	$data[13] = $product[$i]['photo'];
        	$data[14] = $product[$i]['thumb'];
        	//$data[15] = 'Product ID：1024247<br>weight：412.00g<br>Shelf time：2018-12-20 11:07:19<br>Description：PAPAGO vehicle traveling data recorder full 1080 p hd wide dynamic image processing technology';
        	$data[15] = "\"产品编号：1024247\n重量：412.00g\n保质期：2018-12-20 11:07:19\n描述：利用世界最先进的技术，打造属于您的产品\"";
        	$data[16] = "\"Product ID：1024247\nnweight：412.00g\nShelf time：2018-12-20 11:07:19\nDescription：PAPAGO vehicle traveling data recorder full 1080 p hd wide dynamic image processing technology\"";
        	$data[17] = $product[$i]['sort'];
        	$data[18] = $product[$i]['featured'];
        	fputcsv($output, $data);
        }
       
	    fclose($output);
	}

	//批量添加产品
	public function plsavepro(){
		$db=D('Product');
		$fext = substr($_FILES['upfilename']['name'], strrpos($_FILES['upfilename']['name'], '.') + 1);
		
		if ($fext != 'csv') {
				//die('请上传csv格式的文件',HTTP_REFERER);
				$this->error('请上传csv格式的文件');
		}else{
			$myfile=$_FILES["upfilename"];
			$handle=fopen($myfile['tmp_name'], "r");
			
			$csv_val = array('name','ename','title','etitle','url','keywords','ekeywords','description','edescription','contents','econtents','pid','bid','photo','thumb','introduce','eintroduce','sort','featured');
			$csv_arr = array();
			$i = 0;
			$import_type = '';
			if ($handle)
			{
				while($line_data = fgetcsv($handle))
				{
					$tmp_row = array();
					foreach ($csv_val as $k => $v)
					{
						$tmp_row[$v] = trim(iconv('gbk','utf-8', ltrim($line_data[$k], '`')));
					}
					if($i==0){
						$i=1;
					}else{
						$csv_arr[] = $tmp_row;
					}
				}
			}
			fclose($handle);
						
			$num = count($csv_arr); 
			$successnum = 0;
			$errornum = 0;
			for($j=0; $j<$num;$j++){
				//$csv_arr[$j]
				if($db->data($csv_arr[$j])->add()){
					$successnum = $successnum +1;
				}else{
					$errornum = $errornum +1;
				}
				
			}
			$this->success('成功上传'.$successnum.'个产品,失败'.$errornum.'个');
			//echo '成功上传'.$successnum.'个产品,失败'.$errornum.'个';
		}
	}
	public function pluploadimg(){
		 $imgs = $_FILES['upimgname'];
		 $save_folder = '../Uploads/';
		 $tp = array("image/gif","image/pjpeg","image/jpeg","image/png");
		 $successcount=0;
		 $failcount=0;
		 foreach ($imgs["error"] as $key => $error){
			if(!in_array($imgs["type"][$key],$tp)){
				
				$this->error("包含错误文件类型!");
			}
			if($error == UPLOAD_ERR_OK){
				$tmp_name = $imgs["tmp_name"][$key];
				//$a=explode(".",$imgs["name"][$key]); 
				//$prename = $a[0];
				//$name = date('YmdHis').mt_rand(100,999).".".$a[1];
				$name = $imgs["name"][$key];
				$uploadfile = $save_folder.$name; 
				move_uploaded_file($tmp_name, $uploadfile);
				$successcount++;
			 }else{
				 $failcount++;
			 }
		  }
			$this->success('成功上传'.$successcount.'张图片,失败'.$failcount.'张');
		 	//var_dump($imgs);exit();
	}
	
	//添加产品
	public function savepro(){	
		$db=D('Product');
		$_POST['url']=getSeoUrl('product',$_POST['url']);
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
				$this->success('产品添加成功',U('Product/index'));
			}else{
				$this->error('添加失败');
			}
		}else{
			$this->error($db->getError());
		}	
	}
	
	//更新产品
	public function updatepro(){
		$db=D('Product');
		$id=$this->_post('id','intval');
		$num=$this->_post('Num','intval');
		$tnum=$this->_post('tnum','intval');
		$photo=$db->where('id='.$id)->getField('photo');
		$_POST['url']=getSeoUrl('product',$_POST['url']);
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
				$this->success('更新产品成功',U('Product/index'));
			}else{
				$this->error('更新失败或没有数据被更改');
			}		
		}else{
			$this->error($db->getError());	
		}

	}
	
	//删除产品图片
	public function delphoto(){
		$name=$this->_get('name');
		$id=$this->_get('id','intval');
		$field=$this->_get('field');

		if($name && $id){
		  $photo=M('Product')->where('id ='.$id)->getField($field);
		  $photo=str_replace($name.',',"",$photo.',');
		  $photo=rtrim($photo,",");
			if(M('Product')->where('id='.$id)->setField($field,$photo)){
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
	
	//删除产品
	public function del(){
		$id=$this->_get('id','intval');
		$db=M('Product');
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
		$db=M('Product');
		$photo=$db->where('id ='.$id)->getField('photo');
		delallimg('../Uploads/',$photo);
		if ($db->where('id ='.$id)->setField('photo','')) {
			echo 1;
		}else{
			echo 0;
		}
	}

	//全选删除
	public function delall(){
		$this->selectDel('Product');
	}

	//更新排序
	public function uporder(){
		$this->getSort('Product');
	}

	//搜索产品
	public function search(){
		$this->getSearch('product','name','product');
	}

	//复制产品
	public function copydata(){
		$id=$this->_get('id','intval');
		$db=M('Product');
		$product=$db->find($id);
		if ($product) {
			$product['name']=$product['name'].' - 副本';
			$product['ename']=$product['ename'].' - copy';
			$product['url']='products-'.rand(0,9).'-'.rand(0,99);
			if ($product['thumb']<>"") {
				$destthumb=time().$product['thumb'];
				copy('../Uploads/'.$product['thumb'], '../Uploads/'.$destthumb);
				$product['thumb']=$destthumb;
			}
			if ($product['photo']<>"") {
				$copyphoto=explode(',', $product['photo']);
				foreach ($copyphoto as $v) {
					$destphoto=time().$v;
					copy('../Uploads/'.$v, '../Uploads/'.$destphoto);
					$savephoto.=$destphoto.',';
				}
			$product['photo']=rtrim($savephoto,',');	
			}
			unset($product['id']);
			if ($db->data($product)->add()) {
				$this->success('复制产品成功');
			}else{
				$this->error('复制产品失败');
			}
		}
	}



}
?>