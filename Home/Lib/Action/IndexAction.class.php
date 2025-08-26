<?php
class IndexAction extends CommonAction{
    public function index(){


    		if ($this->lang) {
    		$_template = ($this->lang=='c') ? 'c_index' : 'e_index' ;
    	}else{
    		$_template = (C('CNEN')=='cn') ? 'c_index' : 'e_index' ;
    	}


    	$this->isindex=true;

	$titledata=include'./title.php';
	$this->assign('titledata',$titledata);

	$this->display($_template);
    }
}
?>