<?php
function recursive ($array, $pid=0, $level=0) {
	$arr = array();
	foreach ($array as $v) {
		if ($v['pid'] == $pid) {
			$v['level'] = $level;
			$v['html'] = str_repeat('-', $level);
			$arr[] = $v;
			$arr = array_merge($arr, recursive($array, $v['id'], $level + 1));	
		}
	}
	return $arr;
}

function get_all_parent ($array, $id) {
	$arr = array();
	foreach ($array as $v) {
		if ($v['id'] == $id) {
			$arr = array_merge($arr, get_all_parent($array, $v['pid']));
			$arr[] = $v;
		}
	}
	return $arr;
}

function redWord($str,$len,$name){
	$redstr=mb_substr($str,0,$len,'utf-8');
	$search=$name;
	$search = urldecode($search);
	$redstr=preg_replace("/($search)/i","<font color=red>\\1</font>",$redstr);
	return $redstr;
}

/*移动端判断*/
function isMobile(){ 
	if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])){
	    return true;
	} 

	if (isset ($_SERVER['HTTP_VIA'])){ 
	    return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
	} 

	if (isset ($_SERVER['HTTP_USER_AGENT'])) {
	    $clientkeywords = array ('nokia',
	        'sony',
	        'ericsson',
	        'mot',
	        'samsung',
	        'htc',
	        'sgh',
	        'lg',
	        'sharp',
	        'sie-',
	        'philips',
	        'panasonic',
	        'alcatel',
	        'lenovo',
	        'iphone',
	        'ipod',
	        'blackberry',
	        'meizu',
	        'android',
	        'netfront',
	        'symbian',
	        'ucweb',
	        'ucbrowser',
	        'windowsce',
	        'palm',
	        'operamini',
	        'operamobi',
	        'openwave',
	        'nexusone',
	        'cldc',
	        'midp',
	        'wap',
	        'mobile'
	        ); 
	    if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))){
	        return true;
	    } 
	} 


	return false;
} 

function LankeMobile(){
    	if (isset($_COOKIE['LankeMobile'])) {
    		return $_COOKIE['LankeMobile'];
    	}else{
	    	 if (isMobile()) {
	    	 	setcookie('LankeMobile','m',time()+3600*24*7,'/');
	    	 	return 'm';
	    	 }else{
	    	 	setcookie('LankeMobile','p',time()+3600*24*7,'/');
	    	 	return 'p';
	    	 }
    	}
}


?>