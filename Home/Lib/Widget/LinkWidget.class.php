<?php
class LinkWidget extends Widget{
	public function render($data){
		$type = (!empty($data['type'])) ? $data['type'] : 1 ;
		$temp = ($type == 2) ? 'photo' : 'link' ;
		$templates=($data['lang']=='c') ? 'c_'.$temp : 'e_'.$temp;
		if(S('linksdata'.$type)){
			$data=S('linksdata'.$type);
		}else{
			$data['links']=$this->links=M('Link')->field('id,name,ename,photo,url,eurl,sort')->where('type ='.$type)->order('sort')->select();
			S('linksdata'.$type,$data,3600 * 24 * 30);
		}
		$content=$this->renderFile($templates,$data);
		return $content;
	}

}
?>