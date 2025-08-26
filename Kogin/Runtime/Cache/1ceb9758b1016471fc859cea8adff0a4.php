<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../Public/css/index.css" />
<script type="text/javascript" src="../Public/js/quickView.js"></script>
<SCRIPT src="../Public/js/jquery-1.7.2.min.js" type="text/javascript"></SCRIPT>
<title>修改广告</title>
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="LineRightBlue1">
      <table width="95%" border="0" cellpadding="0" cellspacing="0" style="margin-left:20px;">
      <tr>
        <td width="88%" height="24">修改广告 【<a href="<?php echo U('Flash/index');?>">返回广告列表</a>】</td>
        <td width="12%" align="right" class="bt_add"></td>
      </tr>
    </table>
    </td>
  </tr>
</table>

<form action="<?php echo U('upflash');?>" method="post" name="myform" id="myform" enctype="multipart/form-data" onSubmit="return CheckJob()">
<DIV class="PageContent">
<table width="98%" border="0" style="margin:20px;" class="ListCategory">
  <tr>
    <td width="9%">广告标题：</td>
    <td width="91%" height="35"><input name="title" type="text" value="<?php echo ($flash["title"]); ?>" class="FormSmall" style="width: 320px;"> 
    </td>
  </tr>

  <tr>
    <td width="9%" style="color:blue;">广告标题(英文)：</td>
    <td width="91%" height="35"><input name="etitle" type="text" value="<?php echo ($flash["etitle"]); ?>" class="FormSmall" style="width: 320px;"> 
    </td>
  </tr>

  <tr>
    <td>排序ID：</td>
    <td height="35"><input name="sort" type="text" value="<?php echo ($flash["sort"]); ?>" class="FormSmall" style="width: 50px;"> <span style="color:#F00; font-size:12px;">*必填</span></td>
  </tr>

  <tr>
    <td>广告类型：</td>
    <td height="35">
      <select name="type" style="height:28px;">
          <option value="flash" <?php if($flash["type"] == 'flash'): ?>selected="selected"<?php endif; ?>>电脑幻灯片</option>
          <option value="app" <?php if($flash["type"] == 'app'): ?>selected="selected"<?php endif; ?>>手机幻灯片</option>
          <option value="adv" <?php if($flash["type"] == 'adv'): ?>selected="selected"<?php endif; ?>>图组广告</option>
          <option value="page" <?php if($flash["type"] == 'page'): ?>selected="selected"<?php endif; ?>>单图广告</option>
      </select>
    </td>
  </tr>
  
  <tr>
    <td>广告链接：</td>
    <td height="35"><input name="link" type="text" value="<?php echo ($flash["link"]); ?>" class="FormSmall" style="width: 320px;"></td>
  </tr>

  <tr>
    <td style="color:blue;">广告链接(英文)：</td>
    <td height="35"><input name="elink" type="text" value="<?php echo ($flash["elink"]); ?>" class="FormSmall" style="width: 320px;"></td>
  </tr>
  
  <tr>
    <td>广告图片：</td>
    <td height="35">
    <?php if(empty($flash["photo"])): ?><input type='file' name='photo'>
    <?php else: ?>
      <p id="photo" style="padding:4px 0;">
          <img src="__ROOT__/Uploads/<?php echo ($flash["photo"]); ?>" width="80" height="40"/>&nbsp;
          <a href="javascript:;" onclick="delete_order('<?php echo ($flash['photo']); ?>','<?php echo ($flash['id']); ?>')">
            删除该图片</a>
      </p><?php endif; ?>
    </td>
  </tr>

  <tr>
    <td>广告描述：</td>
    <td height="110"><textarea name="description" class="FormSmall" style="width: 400px; height: 70px;"><?php echo ($flash["description"]); ?></textarea>
    </td>
  </tr>

  <tr>
    <td style="color:blue;">广告描述(英文)：</td>
    <td height="110"><textarea name="edescription" class="FormSmall" style="width: 400px; height: 70px;"><?php echo ($flash["edescription"]); ?></textarea>
    </td>
  </tr>
  
  <tr>
    <td height="55" align="center">
    </td>
    <td height="55" align="left">
    <input type="hidden" name="id" value="<?php echo ($flash["id"]); ?>">
    <input type="submit" value="修改" class="bginput">&nbsp;&nbsp;
    </td>
    </tr>
</table>
</DIV>
</form>
<script type="text/javascript">
  function delete_order(name,id){    
      confirm_ = confirm('您确认删除?');
      if(confirm_){
          $.ajax({
              type:"GET",
              url:'__APP__?m=Flash&a=delphoto&name='+name+'&id='+id,
              success:function(msg){
                  //alert(msg);
                  $("#photo").empty();
                  $("#photo").html("<input type='file' name='photo'>");
              }
          });
      }
  };
</script>
</body>
</html>