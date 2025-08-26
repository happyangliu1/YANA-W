<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../Public/css/index.css" />
<script type="text/javascript" src="../Public/js/quickView.js"></script>
<title>添加下载</title>
<script type="text/javascript" charset="utf-8" src="<?php echo ($adminName); ?>/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo ($adminName); ?>/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="<?php echo ($adminName); ?>/ueditor/lang/zh-cn/zh-cn.js"></script>
<SCRIPT language=javaScript>
function CheckJob()
{
  var number = document.getElementById('sort').value;
  var reg = /^\d+$/;
  if (!number.match(reg)){
    alert ("排序号必须为数字!");
    document.myform.sort.focus();
    return false;
  }
 }
</SCRIPT>
</head>
<body>
<DIV class="BodyRight">
<DIV class="PageContent">
<TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
  <TBODY>
  <TR>
    <TD>
      <TABLE width="100%" border="0" cellspacing="0" cellpadding="0">
        <TBODY>
        <TR>

          <TD width="85" align="center" class="Move" id="setting1">
            <A onClick="javascript:settingselect('1')" href="javascript:void(0);">中文信息</A>
          </TD>
          <TD width="5" align="center"><IMG src="../Public/images/tiao.gif"></TD>

          <TD width="85" align="center" class="Out" id="setting2">
            <A onClick="javascript:settingselect('2')" href="javascript:void(0);">英文信息</A>
          </TD>
          <TD align="left" class="LineRight" style="padding-left: 10px;"></TD>
        </TR>

      </TBODY>
    </TABLE>
  </TD>
</TR>
  <TR>
    <TD class="LineRightBlue">
      <TABLE width="95%" style="margin-left: 20px;" border="0" cellspacing="0" 
      cellpadding="0">
        <TBODY>
        <TR>
          <TD width="88%" height="24">下载管理 &gt; 添加下载</TD>
          <TD width="12%" height="24" align="right"></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></DIV></DIV>

<form action="<?php echo U('savedown');?>" method="post" name="myform" id="myform" enctype="multipart/form-data" onSubmit="return CheckJob()">

<DIV id="settingBox1">
<DIV class="PageContent">
<table width="98%" border="0" style="margin:20px;" class="ListCategory">
  <tr>
    <td width="10%">下载名称：</td>
    <td width="90%" height="35"><input name="name" type="text" class="FormSmall" style="width: 320px;"> 
	<span style="color:#F00; font-size:12px;">*必填</span>
    </td>
  </tr>
  
  <tr>
    <td>下载分类:</td>
    <td height="35">
      <select name="pid" style="height:28px;">
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["html"]); if($vo["level"] > 0): ?>┕<?php endif; echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
    </td>
  </tr>

  <tr>
    <td>排序ID：</td>
    <td height="35"><input name="sort" id="sort" value="0" type="text" class="FormSmall" style="width: 50px;"> <span style="color:#F00; font-size:12px;">*必填</span><a title='只可填数字，数字越小排序越靠前。'style="margin-left: 5px;" href="#"><img src="../Public/images/help.gif"></a></td>
  </tr>

  <tr>
    <td>URL优化：</td>
    <td height="35"><input name="url" type="text" class="FormSmall" style="width: 320px;"> <a title='URL只能是字母，数字，下划线或-'style="margin-left: 5px;" href="#"><img src="../Public/images/help.gif"></a></td>
  </tr>
  
  <tr>
    <td>SEO标题：</td>
    <td height="35"><input name="title" type="text" class="FormSmall" style="width: 320px;"> 
	<span style="color:#F00; font-size:12px;">*必填</span>
    </td>
  </tr>
  
  <tr>
    <td>SEO关键字：</td>
    <td height="35"><input name="keywords" type="text" class="FormSmall" style="width: 320px;"></td>
  </tr>
  
  <tr>
    <td>SEO描述：</td>
    <td height="110"><textarea name="description" class="FormSmall" style="width: 450px; height: 80px;"></textarea>
    </td>
  </tr>

  <tr>
    <td width="9%">外部链接：</td>
    <td width="91%" height="35"><input name="link" type="text" class="FormSmall" style="width: 450px;">
    <span style="color:#F00; font-size:12px;">&nbsp;说明：如填写了外部链接，则优先使用外部链接，如要上传文件，请先清空外部链接</span>
    </td>
  </tr>
  
  <tr>
    <td>上传文件：</td>
    <td height="35"><input type='file'  name='filename'></td>
  </tr>
  
  <tr>
    <td>详细内容：</td>
    <td>
    <script id="contents" type="text/plain" style="width:98%;height:400px;"></script>
    </td>
  </tr>
</table>
</DIV>
</DIV>

<DIV class="close" id="settingBox2">
<DIV class="PageContent">
<table width="98%" border="0" style="margin:20px;" class="ListCategory">
  <tr>
    <td style="color:blue;" width="10%">下载名称 (英文)：</td>
    <td width="90%" height="35"><input name="ename" type="text" class="FormSmall" style="width: 320px;"> 
  <span style="color:#F00; font-size:12px;">*必填</span>
    </td>
  </tr>

  <tr>
    <td style="color:blue;">SEO标题 (英文)：</td>
    <td height="35"><input name="etitle" type="text" class="FormSmall" style="width: 320px;"> 
    </td>
  </tr>
  
  <tr>
    <td style="color:blue;">SEO关键字 (英文)：</td>
    <td height="35"><input name="ekeywords" type="text" class="FormSmall" style="width: 320px;"></td>
  </tr>
  
  <tr>
    <td style="color:blue;">SEO描述 (英文)：</td>
    <td height="110"><textarea name="edescription" class="FormSmall" style="width: 450px; height: 80px;"></textarea>
    </td>
  </tr>

  <tr>
    <td style="color:blue;">详细内容 (英文)：</td>
    <td>
     <script id="econtents" name="econtents" type="text/plain" style="width:98%;height:500px;"></script>
    </td>
  </tr>
</table>
</DIV>
</DIV>

<div style="float:left; margin:-10px 0px 20px 135px;height:150px;">
    <input type="submit" value="提交" class="bginput">&nbsp;&nbsp;
    <input name="reset" type="reset"  class="bginput" value="重置" />
</div>

</form>

<SCRIPT type="text/javascript">
  //实例化编辑器
  var ue = UE.getEditor('contents');
  var ue2 = UE.getEditor('econtents');

  function settingselect(id){
    document.getElementById('settingBox1').className="close";
    document.getElementById('settingBox2').className="close";
    document.getElementById('setting1').className="Out";
    document.getElementById('setting2').className="Out";
    
    document.getElementById('setting'+id).className="Move";
    document.getElementById('settingBox'+id).className="";
  }

</SCRIPT>
</body>
</html>