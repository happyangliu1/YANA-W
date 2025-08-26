<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../Public/css/index.css" />
<script type="text/javascript" src="../Public/js/quickView.js"></script>
<title>修改图片链接</title>
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="LineRightBlue1">
      <table width="95%" border="0" cellpadding="0" cellspacing="0" style="margin-left:20px;">
      <tr>
        <td width="88%" height="24">修改图片链接 【<a href="<?php echo U('Link/photo');?>">返回链接列表</a>】</td>
        <td width="12%" align="right" class="bt_add"></td>
      </tr>
    </table>
    </td>
  </tr>
</table>

<form action="<?php echo U('upphoto');?>" method="post" name="myform" id="myform" enctype="multipart/form-data" onSubmit="return CheckJob()">
<DIV class="PageContent">
<table width="98%" border="0" style="margin:20px;" class="ListCategory">
  <tr>
    <td width="9%">链接名称：</td>
    <td width="91%" height="35"><input name="name" type="text" value="<?php echo ($links["name"]); ?>" class="FormSmall" style="width: 220px;"> <span style="color:#F00; font-size:12px;">*必填</span>
    </td>
  </tr>

  <tr>
    <td style="color:blue;">链接名称 (英文)：</td>
    <td height="35"><input name="ename" type="text" value="<?php echo ($links["ename"]); ?>" class="FormSmall" style="width: 220px;"> <span style="color:#F00; font-size:12px;">*必填</span> 
    </td>
  </tr>

  <tr>
    <td>排序ID：</td>
    <td height="35"><input name="sort" type="text" value="<?php echo ($links["sort"]); ?>" class="FormSmall" style="width: 50px;"> <span style="color:#F00; font-size:12px;">*必填</span></td>
  </tr>
  
  <tr>
    <td>链接地址：</td>
    <td height="35"><input name="url" type="text" value="<?php echo ($links["url"]); ?>" class="FormSmall" style="width: 320px;"><a title='需以http://开头'style="margin-left: 5px;" href="#"><img src="../Public/images/help.gif"></a></td>
  </tr>

  <tr>
    <td style="color:blue;">链接地址 (英文)：</td>
    <td height="35"><input name="eurl" type="text" value="<?php echo ($links["eurl"]); ?>" class="FormSmall" style="width: 320px;"><a title='需以http://开头'style="margin-left: 5px;" href="#"><img src="../Public/images/help.gif"></a></td>
  </tr>

  <tr>
    <td>图片：</td>
    <td height="35">
    <?php if(empty($links["photo"])): ?><input type='file' name='photo'>
    <input type="hidden" name="num" value="1">
    <?php else: ?>
      <p style="padding:4px 0;">
     <img src="__ROOT__/Uploads/<?php echo ($links["photo"]); ?>" width="80" height="40"/>&nbsp;<a href="<?php echo U('delphoto',array('name'=>$links['photo'],'id'=>$links['id']));?>" class='del'>删除该图片</a>
      </p><?php endif; ?>
    </td>
  </tr>
  
  <tr>
    <td height="55" align="center">
    </td>
    <td height="55" align="left">
    <input type="hidden" name="id" value="<?php echo ($links["id"]); ?>">
    <input type="submit" value="修改" class="bginput">&nbsp;&nbsp;
    </td>
    </tr>
</table>
</DIV>
</form>
</body>
</html>