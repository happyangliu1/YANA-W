<?php

class BreadWidget extends Widget{

	public function render($data){
		$templates=($data['lang']=='c') ? 'c_bread' : 'e_bread';
		if (S('Bread')) {
			$result=S('Bread');
		}else{
			$result=M('List')->field('id,name,ename,pid,url,sort,link')->order('sort asc,id desc')->select();
			S('Bread',$result,3600 * 24 * 30);
		}

		$data['Bread']=get_all_parent($result,$data['id']);

		$content=$this->renderFile($templates,$data);
		return $content;
	}


}



?>