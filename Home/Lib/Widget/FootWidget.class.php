<?php
class FootWidget extends Widget{
	public function render($data){
		$templates=($data['lang']=='c') ? 'c_foot' : 'e_foot';
		if (S('footdata')) {
			$data=S('footdata');
		} else {
			$footnav=M('Foot')->order('sort asc')->select();
			$data['footnav']=recursive($footnav);
			S('footdata',$data,3600 * 24 * 30);
		}

		$content=$this->renderFile($templates,$data);
		return $content;
	}



}
?>