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

class ListAction extends CommonAction{
	
	public function index(){
		$id=(int)I('get.id');
		$this->doList($id,"id =%d",$this->lang);
	}

	public function html(){
		$url=I('get.url');
		$this->doList($url,"url ='%s'",$this->lang);
	}

	protected function doList($var,$str,$lang){
		$bid='';
		$list=M('List')->field('id,pid,bid,url,type,title,etitle,name,ename,keywords,ekeywords,description,edescription,contents,econtents')->where($str,array($var))->find();
		$this->getid = ($list['pid']==0 && $list['type']!='page') ? 0 : $list['id'] ;
		if (!$list) {
			$this->_empty();
			exit;
		}
		$id=$list['id'];
		$table=ucfirst($list['type']);
		$lang = ($lang=='c') ? 'c' : 'e' ;
		switch($table){
			case 'Product':
			$template=$lang.'_product';
			$num=C('LIST_PRONUM');
			break;
			
			case 'New':
			$template=$lang.'_new';
			$num=C('LIST_NEWNUM');
			break;
			
			case 'Photo':
			$template=$lang.'_photo';
			$num=C('LIST_PHOTONUM');
			break;
			
			case 'Download':
			$template=$lang.'_download';
			$num=C('LIST_DOWNNUM');
			break;
			
			case 'Page':
			$template=$lang.'_page';
			break;
			
			default:
			$template=$lang.'_index';
		}
		
		if($table == 'Page'){
			if ($lang=='c') {
				$list['contents']=$this->doInside($list['contents'],'c');
			} else {
				$list['econtents']=$this->doInside($list['econtents'],'e');
			}	
		}else{		
			if($list['pid']!=0){
				if($indb=M('List')->field('id')->where('pid = '.$id)->select()){
				  foreach($indb as $v){
					  $inpid.=$v['id'].',';
				  }
				$where['pid']=array('in',rtrim($id.",".$inpid,","));
				}else{
					$where['pid']=array('eq',$id);
				} 
				$list['id']=$list['pid'];
			}else{
				$where['bid']=array('eq',$id);
			}
			
			$db=M($table);
			$count=$db->where($where)->count();
			
			import('@.Org.Page');
			$cnenurl = ($lang=='c') ? C('CN_URL') : C('EN_URL') ;
			$pageurl = (C('URL_MODEL')==2) ? $cnenurl.'/'.$list['url'] : '' ;
			$page=new Page($count,$num,'',$pageurl);
			$prevs= ($lang=='c') ? '上一页' : 'Previous' ;
			$nexts= ($lang=='c') ? '下一页' : 'Next' ;
			$page->setConfig('prev',$prevs);
			$page->setConfig('next',$nexts);
			$page->setConfig('theme',"%upPage% %first% %prePage% %linkPage% %nextPage% %end% %downPage%");
			$show=$page->show();
			
			$article=$db->where($where)->order('sort asc,id desc')->limit($page->firstRow.','.$page->listRows)->select();
			$this->assign('article',$article);			
			$this->assign('page',$show);
			$this->assign('table',$table);
		}	
		$this->assign('list',$list);
		$this->assign('bid',$bid);
		$this->listid=$id;
    		$this->display($template);	
	}


}
?>