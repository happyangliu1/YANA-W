<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../Public/css/index.css" />
<script type="text/javascript" src="../Public/js/quickView.js"></script>
<SCRIPT src="../Public/js/jquery-1.7.2.min.js" type="text/javascript"></SCRIPT>
<title>修改新闻</title>
<script type="text/javascript" charset="utf-8" src="<?php echo ($adminName); ?>/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo ($adminName); ?>/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="<?php echo ($adminName); ?>/ueditor/lang/zh-cn/zh-cn.js"></script>
<SCRIPT language=javaScript>
function CheckJob()
{
    //日期的正则表达式
    if (document.myform.time.value.length!=""){
      var timevalue = document.getElementById('time').value;
      var timereg = /^[1-9]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
      if (!timevalue.match(timereg)){
        alert ("日期格式不正确，正确格式为：2017-01-01");
        document.myform.time.focus();
        return false;
      }
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
          <TD width="88%" height="24">新闻管理 &gt; 修改新闻</TD>
          <TD width="12%" height="24" align="right"></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></DIV></DIV>

<form action="<?php echo U('updatenew');?>" method="post" name="myform" id="myform" enctype="multipart/form-data" onSubmit="return CheckJob()">

<DIV id="settingBox1">
<DIV class="PageContent">
<table width="98%" border="0" style="margin:20px;" class="ListCategory">
  <tr>
    <td width="10%">新闻标题：</td>
    <td width="90%" height="35"><input name="title" type="text" value="<?php echo ($news["title"]); ?>" class="FormSmall" style="width: 320px;"> 
	<span style="color:#F00; font-size:12px;">*必填</span>
    </td>
  </tr>
  
  <tr>
    <td>新闻分类:</td>
    <td height="35">
      <select name="pid" style="height:28px;">
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $news["pid"]): ?>selected="selected"<?php endif; ?>><?php echo ($vo["html"]); if($vo["level"] > 0): ?>┕<?php endif; echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
    </td>
  </tr>

  <tr>
    <td>发布时间：</td>
    <td height="35"><input name="time" id="time" type="date" value="<?php echo (date('Y-m-d',$news["time"])); ?>" class="FormSmall"  style="width: 140px; height:18px;"/></td>
  </tr>

  <tr>
    <td>排序ID：</td>
    <td height="35"><input name="sort" type="text" value="<?php echo ($news["sort"]); ?>" class="FormSmall" style="width: 50px;"> <span style="color:#F00; font-size:12px;">*必填</span></td>
  </tr>

  <tr>
    <td>URL优化：</td>
    <td height="35"><input name="url" type="text" value="<?php echo ($news["url"]); ?>" class="FormSmall" style="width: 320px;"> <a title='URL只能是字母，数字，下划线或-'style="margin-left: 5px;" href="#"><img src="../Public/images/help.gif"></a></td>
  </tr>
  
  <tr>
    <td>SEO关键字：</td>
    <td height="35"><input name="keywords" type="text" value="<?php echo ($news["keywords"]); ?>"  class="FormSmall" style="width: 320px;"></td>
  </tr>
  
  <tr>
    <td>SEO描述：</td>
    <td height="110"><textarea name="description" class="FormSmall" style="width: 450px; height: 80px;"><?php echo ($news["description"]); ?></textarea>
    </td>
  </tr>

  <tr>
    <td>缩略图：</td>
    <td height="35">
    <?php if(empty($news["thumb"])): ?><input type='file' name='thumb'> <span style="color:#F00; font-size:12px;">非必填</span>
    <?php else: ?>
      <div id="thumbs" style="padding:4px 0;"><img src="__ROOT__/Uploads/<?php echo ($news["thumb"]); ?>" width="60" height="60"/>
      <a href="javascript:;" onclick="delete_order('<?php echo ($news['thumb']); ?>','<?php echo ($news['id']); ?>')">删除该图片</a>
      </div><?php endif; ?> 
    </td>
  </tr>
  
  <tr>
    <td>新闻内容：</td>
    <td>
      <script id="contents" type="text/plain" style="width:98%;height:400px;"><?php echo ($news["contents"]); ?></script>
    </td>
  </tr>

</table>
</DIV>
</DIV>

<DIV class="close" id="settingBox2">
<DIV class="PageContent">
<table width="98%" border="0" style="margin:20px;" class="ListCategory">
  <tr>
    <td width="10%" style="color:blue;">新闻标题 (英文)：</td>
    <td width="90%" height="35"><input name="etitle" value="<?php echo ($news["etitle"]); ?>" type="text" class="FormSmall" style="width: 320px;"> 
  <span style="color:#F00; font-size:12px;">*必填</span>
    </td>
  </tr>

  <tr>
    <td style="color:blue;">SEO关键字 (英文)：</td>
    <td height="35"><input name="ekeywords" value="<?php echo ($news["ekeywords"]); ?>" type="text" class="FormSmall" style="width: 320px;"></td>
  </tr>
  
  <tr>
    <td style="color:blue;">SEO描述 (英文)：</td>
    <td height="110"><textarea name="edescription" class="FormSmall" style="width: 450px; height: 80px;"><?php echo ($news["edescription"]); ?></textarea>
    </td>
  </tr>
  
  <tr height="400">
    <td style="color:blue;">新闻内容 (英文)：</td>
    <td>
      <script id="econtents" name="econtents"  type="text/plain" style="width:98%;height:500px;"><?php echo ($news["econtents"]); ?></script>
    </td>
  </tr>
</table>
</DIV>
</DIV>

<div style="float:left; margin:-10px 0px 20px 135px;height:150px;">
    <input type="hidden" name="id" value="<?php echo ($news["id"]); ?>">
    <input type="submit" value="确认修改" class="bginput">&nbsp;&nbsp;
</div>

</form>

<SCRIPT type="text/javascript">
    //实例化编辑器
    var ue = UE.getEditor('contents');
    var ue2 = UE.getEditor('econtents');

    function delete_order(name,id){    
        confirm_ = confirm('您确认删除?');
        if(confirm_){
            $.ajax({
                type:"GET",
                url:'__APP__?m=New&a=delthumb&name='+name+'&id='+id,
                success:function(msg){
                    //alert(msg);
                    $("#thumbs").empty();
                    $("#thumbs").html("<input type='file' name='thumb'>");
                }
            });
        }
    };

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