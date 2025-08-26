<?php
class NavWidget extends Widget{
	public function render($data){
		$_template=$data['lang'].'_nav';
		if(S('navdata')){
			$data=S('navdata');
		}else{
			$n=M('List');
			$nav=$n->field('id,name,ename,url,pid,type,link,elink')->where('pid=0 and nav=1')->order('sort asc')->select();
			$data['nav']=$nav;
			
			if($nav){
				$snav=$n->field('id,name,ename,url,pid,type,link,elink')->where('pid != 0 and nav=1')->order('sort asc')->select();
				$data['snav']=$snav;
			}

			$appnav=$nav;
			foreach ($nav as  $k=>$v) {
				foreach ($snav as $sk=>$sv) {
					if ($v["id"] == $sv["pid"]) {
						$appnav[$k]['two'][]=$sv;
					}
				}
				
				foreach($appnav[$k]['two'] as $kk=>$vv)
				{
					$ssnav=$n->field('id,name,ename,url,pid,type,link,elink')->where(' nav=1 AND pid='.$vv['id'])->order('sort asc')->select();

					$appnav[$k]['two'][$kk]['three'] = $ssnav;
					;

					
				}
			}
			$data['appnav']=$appnav;
			S('navdata',$data,3600 * 24 * 30);
		}
		
		$content=$this->renderFile($_template,$data);
		return $content;
	}


}
?>