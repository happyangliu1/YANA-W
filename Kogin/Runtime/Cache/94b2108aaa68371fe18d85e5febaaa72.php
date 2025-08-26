<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../Public/css/index.css" />
<script type="text/javascript" src="../Public/js/quickView.js"></script>
<title>修改表单</title>
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="LineRightBlue1">
      <table width="95%" border="0" cellpadding="0" cellspacing="0" style="margin-left:20px;">
      <tr>
        <td width="88%" height="24">修改留言表单 【<a href="<?php echo U('Form/index');?>">返回表单列表</a>】</td>
        <td width="12%" align="right" class="bt_add"></td>
      </tr>
    </table>
    </td>
  </tr>
</table>

<form action="<?php echo U('update');?>" method="post">
<DIV class="PageContent">
<table width="98%" border="0" style="margin:20px;" class="ListCategory">
  <tr>
    <td width="9%">表单名称(中)：</td>
    <td width="91%" height="35"><input name="name" type="text" class="FormSmall" value="<?php echo ($formdata["name"]); ?>" style="width: 220px;"> <span style="color:#F00; font-size:12px;">*必填</span> 
    </td>
  </tr>

  <tr>
    <td width="9%">表单名称(英)：</td>
    <td width="91%" height="35"><input name="ename" type="text" class="FormSmall" value="<?php echo ($formdata["ename"]); ?>" style="width: 220px;"> <span style="color:#F00; font-size:12px;">*必填</span> 
    </td>
  </tr>

  <tr>
    <td>排序ID：</td>
    <td height="35"><input name="sort" type="text" value="<?php echo ($formdata["sort"]); ?>" class="FormSmall" style="width: 50px;"> <span style="color:#F00; font-size:12px;">*必填</span></td>
  </tr>
  
<?php if($formdata["pid"] == 0): ?><tr>
    <td>是否显示(中)</td>
    <td height="35">
      <label><input type="radio" name="hide" value="0" <?php if($formdata["hide"] == 0): ?>checked="checked"<?php endif; ?>/> 显示</label>
      &nbsp;&nbsp;&nbsp;
      <label><input type="radio" name="hide" value="1" <?php if($formdata["hide"] == 1): ?>checked="checked"<?php endif; ?>/> 隐藏</label>
    </td>
  </tr>
  <tr>
    <td>是否显示(英)</td>
    <td height="35">
      <label><input type="radio" name="ehide" value="0" <?php if($formdata["ehide"] == 0): ?>checked="checked"<?php endif; ?>/> 显示</label>
      &nbsp;&nbsp;&nbsp;
      <label><input type="radio" name="ehide" value="1" <?php if($formdata["ehide"] == 1): ?>checked="checked"<?php endif; ?>/> 隐藏</label>
    </td>
  </tr><?php endif; ?>

  <tr>
    <td>是否必填</td>
    <td height="35">
      <label><input type="radio" name="required" value="1" <?php if($formdata["required"] == 1): ?>checked="checked"<?php endif; ?>/> 是</label>
      &nbsp;&nbsp;&nbsp;
      <label><input type="radio" name="required" value="0" <?php if($formdata["required"] == 0): ?>checked="checked"<?php endif; ?>/> 否</label>
    </td>
  </tr>
  
  <tr>
    <td height="55" align="center">
    </td>
    <td height="55" align="left">
    <input type="hidden" name="id" value="<?php echo ($formdata["id"]); ?>">
    <input type="submit" value="修改" class="bginput">&nbsp;&nbsp;
    <input name="reset" type="reset"  class="bginput" value="重置" />
    </td>
    </tr>
</table>
</DIV>
</form>
</body>
</html>