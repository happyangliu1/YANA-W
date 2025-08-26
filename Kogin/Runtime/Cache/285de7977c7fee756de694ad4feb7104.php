<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../Public/js/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="../Public/css/index.css" />
<title>留言表单管理</title>
<script type="text/javascript">
  $(function () {
    $( '.del' ).click( function () {
      return confirm('确认删除该表单？');
    } );
  });
</script>
<style>
  .open {
    display: block;
    width: 18px;
    height: 18px;
    cursor: pointer;
  }
</style>

</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="LineRightBlue1">
        <table width="95%" border="0" cellpadding="0" cellspacing="0" style="margin-left:20px;">
      <tr>
        <td width="88%" height="24">【留言表单管理】</td>
        <td width="12%" align="right" class="bt_add"></td>
      </tr>
    </table>
    </td>
  </tr>
</table>

<form name="theForm" method="post" action="<?php echo U('uporder');?>">
  <div class="tablelisthead">
    <ul pid='0'>
      <li class="li_10">排序</li>
      <li class="li_20">名称</li>
      <li class="li_10">类型</li>
      <li class="li_20">显示/隐藏</li>
      <li class="li_40">编辑</li>
    </ul>
  </div>
  
  <div id="languageBox2">
    <div class="tablelist">
    <?php if(is_array($formdata)): $i = 0; $__LIST__ = $formdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul onmouseover="this.style.background ='#FFFDD7'" onmouseout="this.style.background ='#FFFFFF'" id='<?php echo ($vo["id"]); ?>' pid='<?php echo ($vo["pid"]); ?>'>
          <li class="li_10">
          <input type="text" value="<?php echo ($vo["sort"]); ?>" name="sort[<?php echo ($vo["id"]); ?>]" class="listinput"/>
          </li>
          <li class="li_20">
              <?php if($vo["level"] > 0): ?>&nbsp;&nbsp;├─<?php endif; echo ($vo["name"]); ?> (<?php echo ($vo["ename"]); ?>)
          </li>

          <li class="li_10">
            <?php switch($vo["type"]): case "text": ?>文本框<?php break;?>
                <?php case "email": ?>Email域<?php break;?>
                <?php case "radio": ?>单选按钮<?php break;?>
                <?php case "select": ?>下拉列表<?php break;?>
                <?php case "textarea": ?>多行文本域<?php break;?>
                <?php default: ?>default<?php endswitch;?>
          </li>

          <li class="li_20">
              <?php if($vo["hide"] == 1): ?><del style="color:#b7b7b7;">隐藏(中)</del><?php else: ?>显示(中)<?php endif; ?> | 
              <?php if($vo["ehide"] == 1): ?><del style="color:#b7b7b7;">隐藏(英)</del><?php else: ?>显示(英)<?php endif; ?>
          </li>
          <li class="li_40">
            <?php if(($vo["pid"] == 0) AND ($vo["type"] == 'radio' OR $vo["type"] == 'select')): ?><a href="<?php echo U('add',array('pid'=>$vo['id'],'type'=>$vo['type'],'fieldname'=>$vo['fieldname']));?>">添加子项</a> |<?php endif; ?>
            <a href="<?php echo U('mod',array('id'=>$vo['id']));?>">修改</a>
            <?php if($vo["pid"] != 0): ?>| <a href="<?php echo U('del',array('id'=>$vo['id']));?>" class='del'>删除</a><?php endif; ?>
          </li>
      </ul><?php endforeach; endif; else: echo "" ;endif; ?>  
    </div>
  </div>
  
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="36" class="BotNavBg">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="padding-left:5px;">
            <input type="submit" value="更新排序" class="bginput">
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</form>
</body>
</html>