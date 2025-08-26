<?php
class FlashWidget extends Widget{
	public function render($data){
	$type = (isset($data['type'])) ? $data['type'] : 'flash' ;
	$lang =  (isset($data['lang'])) ? $data['lang'] : 'c' ;

	if (isset($data['id'])) {
		$nickname = M('Flash')->where('id='.$data['id'].' and isdel =0')->getField('photo');
		return $nickname;
	} else {
		
		if(S('flashdata'.$type.$lang)){
			$data=S('flashdata'.$type.$lang);
		}else{
			$data['flash']=$this->flash=M('Flash')->where("type='".$type."' and isdel =0")->field('id,title,etitle,type,sort,link,elink,photo,description,edescription')->order('sort')->select();
			S('flashdata'.$type.$lang,$data,3600 * 24);
		}

		$template = ($lang == 'c') ? $type : 'e'.$type ;

		$content=$this->renderFile($template,$data);
		return $content;
	}
	


	}

}
?>