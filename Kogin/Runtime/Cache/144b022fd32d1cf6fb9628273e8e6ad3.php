<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../Public/css/index.css" />
<script type="text/javascript" src="../Public/js/quickView.js"></script>
<title>添加产品</title>
<script type="text/javascript" charset="utf-8" src="<?php echo ($adminName); ?>/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo ($adminName); ?>/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="<?php echo ($adminName); ?>/ueditor/lang/zh-cn/zh-cn.js"></script>
<SCRIPT language=javaScript>
function CheckJob()
{
	if (document.myform.upfilename.value.length==""){
		alert ("请选择上传文件！");
		return false;
	}else{
		document.getElementById('uploadbox').innerHTML ='上传中.....';
		return true;
	}
 }
function CheckImg()
{
	if (document.imgform.upimgname.value.length==""){
		alert ("请选择图片！");
		return false;
	}else{
		document.getElementById('uploadimgbox').innerHTML ='上传中.....';
		return true;
	}
 }
</SCRIPT>
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="LineRightBlue1">
      <table width="95%" border="0" cellpadding="0" cellspacing="0" style="margin-left:20px;">
      <tr>
        <td width="88%" height="24">批量添加产品 【<a href="<?php echo U('Product/index');?>">返回产品列表</a>】 |【<a href="<?php echo U('Product/pladd');?>">刷新</a>】</td>
        <td width="12%" align="right" class="bt_add"></td>
      </tr>
    </table>
    </td>
  </tr>
</table>

<form action="<?php echo U('plsavepro');?>" method="post" name="myform" id="myform" enctype="multipart/form-data" onSubmit="return CheckJob()">
<DIV class="PageContent">
<input type="hidden" value="import_goods" name="file">
<table width="98%" border="0" style="margin:20px;" class="ListCategory">
  <tr><td><a href="/Uploads/temp/addproducts.csv">下载csv模板</a></td></tr>
  <tr>
    <td width="9%">选择csv：</td>
    <td width="91%" height="35">
	<input type="file" name="upfilename" id="upfilename" value=""><span style="color:red;">*url有重复会上传失败</span>
    </td>
  </tr>

  
  <tr>
    <td height="55" align="center">
    </td>
    <td height="55" align="left">
    <div id="uploadbox">
    <input type="submit" value="提交" class="bginput">&nbsp;&nbsp;
    <input name="reset" type="reset"  class="bginput" value="重置" />
    </div>
    </td>
    </tr>
</table>


</DIV>
</form>

<hr />

<form action="<?php echo U('pluploadimg');?>" method="post" name="imgform" id="imgform" enctype="multipart/form-data" onSubmit="return CheckImg()">
<DIV class="PageContent">
<input type="hidden" value="import_goods" name="file">
<table width="98%" border="0" style="margin:20px;" class="ListCategory">
  <tr>
    <td width="9%">批量上传图片：</td>
    <td width="91%" height="35">
    <input name='upimgname[]' id="upimgname" type="file" multiple><span style="color:red;">*支持图片类型(jpg,png,gif,jpeg)&nbsp;&nbsp;&nbsp;&nbsp; 注：图片名字重复会直接覆盖</span>
    </td>
  </tr>

  
  <tr>
    <td height="55" align="center">
    </td>
    <td height="55" align="left">
    <div id="uploadimgbox">
    <input type="submit" value="提交" class="bginput">&nbsp;&nbsp;
    <input name="reset" type="reset"  class="bginput" value="重置" />
    </div>
    </td>
    </tr>
</table>


</DIV>
</form>

</body>
</html>