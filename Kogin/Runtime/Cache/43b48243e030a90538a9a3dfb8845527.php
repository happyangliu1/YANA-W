<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../Public/js/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="../Public/css/index.css" />
<script type="text/javascript" src="../Public/js/quickView.js"></script>
<title>修改产品</title>
<script type="text/javascript" charset="utf-8" src="<?php echo ($adminName); ?>/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo ($adminName); ?>/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="<?php echo ($adminName); ?>/ueditor/lang/zh-cn/zh-cn.js"></script>
<link rel="stylesheet" type="text/css" href="../Public/css/webuploader.css" />
<script type="text/javascript" src="../Public/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../Public/js/webuploader.min.js"></script>
<script type="text/javascript" >
 var uploadurl = "<?php echo U('doUploads');?>",uploadswf="../Public/Uploader.swf";
</script>
<script type="text/javascript" src="../Public/js/upload.js"></script>
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
          <TD width="88%" height="24">产品管理 &gt; 修改产品</TD>
          <TD width="12%" height="24" align="right"></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></DIV></DIV>

<form action="<?php echo U('updatepro');?>" method="post" name="myform" id="myform" enctype="multipart/form-data">
  
<DIV id="settingBox1">
<DIV class="PageContent">
<table width="98%" border="0" style="margin:20px;" class="ListCategory">
  <tr>
    <td width="9%">产品名称：</td>
    <td width="91%" height="35"><input name="name" type="text" class="FormSmall" value="<?php echo ($product["name"]); ?>" style="width: 320px;"> 
	<span style="color:#F00; font-size:12px;">*必填</span>
    </td>
  </tr>
  
  <tr>
    <td>产品分类:</td>
    <td height="35">
      <select name="pid" style="height:28px;">
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $product["pid"]): ?>selected="selected"<?php endif; ?>><?php echo ($vo["html"]); if($vo["level"] > 0): ?>┕<?php endif; echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
    </td>
  </tr>

  <tr>
    <td>排序ID：</td>
    <td height="35"><input name="sort" type="text" class="FormSmall" value="<?php echo ($product["sort"]); ?>" style="width: 50px;"> <span style="color:#F00; font-size:12px;">*必填</span></td>
  </tr>
  
  <tr>
    <td>首页推荐：</td>
    <td height="35">
      <select name="featured" style="height:28px;">
          <option value="1" <?php if(($product["featured"]) == "1"): ?>selected="selected"<?php endif; ?>>是</option>
          <option value="0" <?php if(($product["featured"]) == "0"): ?>selected="selected"<?php endif; ?>>否</option>
      </select>
    </td>
  </tr>
  
  <tr>
    <td>产品简介：</td>
    <td height="110"><textarea name="introduce" class="FormSmall" style="width: 320px; height: 120px;"><?php echo ($product["introduce"]); ?></textarea>
    </td>
  </tr>
  
  <tr>
    <td>URL优化：</td>
    <td height="35"><input name="url" type="text" value="<?php echo ($product["url"]); ?>" class="FormSmall" style="width: 320px;"> <a title='URL只能是字母，数字，下划线或-'style="margin-left: 5px;" href="#"><img src="../Public/images/help.gif"></a></td>
  </tr>
  
  <tr>
    <td width="10%">SEO标题：</td>
    <td width="90%" height="35"><input name="title" type="text" value="<?php echo ($product["title"]); ?>" class="FormSmall" style="width: 320px;"> 
	<span style="color:#F00; font-size:12px;">*必填</span>
    </td>
  </tr>
  
  <tr>
    <td>SEO关键字：</td>
    <td height="35"><input name="keywords" type="text" class="FormSmall" value="<?php echo ($product["keywords"]); ?>" style="width: 320px;"></td>
  </tr>
  
  <tr>
    <td>SEO描述：</td>
    <td height="110"><textarea name="description" class="FormSmall" style="width: 450px; height: 80px;"><?php echo ($product["description"]); ?></textarea>
    </td>
  </tr>

  <tr>
    <td>购买链接：</td>
    <td height="35"><input name="buyname" type="text" class="FormSmall" value="<?php echo ($product["buyname"]); ?>" style="width: 100px;">&nbsp;&nbsp;
    <input name="buylink" type="text" class="FormSmall" value="<?php echo ($product["buylink"]); ?>" style="width: 336px;">
    </td>
  </tr>
  
  <tr>
    <td>缩略图：</td>
    <td height="35">
    <?php if(empty($product["thumb"])): ?><input type='file' name='thumb'>
    <?php else: ?>
      <div id="thumbs" style="padding:4px 0;"><img src="__ROOT__/Uploads/<?php echo ($product["thumb"]); ?>" width="60" height="60"/>
      <a href="javascript:;" onclick="delete_order('<?php echo ($product['thumb']); ?>','<?php echo ($product['id']); ?>','thumb')">删除该图片</a>
      </div><?php endif; ?> 
    </td>
  </tr>
  
  <tr>
    <td>产品主图：</td>
    <td style="padding:10px 0px;">
      <?php if(!empty($photo)): ?><div id="imgall">
            <?php if(is_array($photo)): $k = 0; $__LIST__ = $photo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><p id="photo<?php echo ($k); ?>" class="productimg"><img src="__ROOT__/Uploads/<?php echo ($photo[$key]); ?>" width="65" height="65"/>
                <a href="javascript:;" onclick="delete_order2('<?php echo ($photo[$key]); ?>','<?php echo ($product['id']); ?>','photo',<?php echo ($k); ?>)">删除该图片</a>
              </p><?php endforeach; endif; else: echo "" ;endif; ?>
          </div>

          <a href="javascript:;" id="delallimg" onclick="delete_all('<?php echo ($product['id']); ?>')">删除</br>全部主图</a><?php endif; ?>  


      <div class="uploader-list-container" style="margin-top:95px;">
        <div class="queueList">
          <div id="dndArea" class="placeholder">
            <div id="filePicker-2"></div>
          </div>
        </div>
        <div class="statusBar" style="display:none;">
          <div class="progress"> <span class="text">0%</span> <span class="percentage"></span> </div>
          <div class="info"></div>
          <div class="btns">
            <div id="filePicker2"></div>
            <div class="uploadBtn">开始上传</div>
          </div>
        </div>
      </div>
      <div class="photoname"></div>
     
    </td>
  </tr>
  
  <tr>
    <td>产品内容：</td>
    <td>
    <script id="contents" type="text/plain" style="width:98%;height:400px;"><?php echo ($product["contents"]); ?></script>
    </td>
  </tr>
</table>
</DIV>
</DIV>

<DIV class="close" id="settingBox2">
<DIV class="PageContent">
<table width="98%" border="0" style="margin:20px;" class="ListCategory">
  <tr>
    <td width="10%" style="color:blue;">产品名称 (英文)：</td>
    <td width="90%" height="35"><input name="ename" type="text" value="<?php echo ($product["ename"]); ?>" class="FormSmall" style="width: 320px;"> 
  <span style="color:#F00; font-size:12px;">*必填</span>
    </td>
  </tr>

  <tr>
    <td style="color:blue;">产品简介(英文)：</td>
    <td height="110"><textarea name="eintroduce" class="FormSmall" style="width: 320px; height: 120px;"><?php echo ($product["eintroduce"]); ?></textarea>
    </td>
  </tr>

  <tr>
    <td style="color:blue;">SEO标题 (英文)：</td>
    <td height="35"><input name="etitle" type="text" value="<?php echo ($product["etitle"]); ?>" class="FormSmall" style="width: 320px;"> 
    </td>
  </tr>
  
  <tr>
    <td style="color:blue;">SEO关键字 (英文)：</td>
    <td height="35"><input name="ekeywords" type="text" value="<?php echo ($product["ekeywords"]); ?>" class="FormSmall" style="width: 320px;"></td>
  </tr>
  
  <tr>
    <td style="color:blue;">SEO描述 (英文)：</td>
    <td height="110"><textarea name="edescription" class="FormSmall" style="width: 450px; height: 80px;"><?php echo ($product["edescription"]); ?></textarea>
    </td>
  </tr>

  <tr>
    <td style="color:blue;">购买链接(英文)：</td>
    <td height="35"><input name="ebuyname" type="text" class="FormSmall" value="<?php echo ($product["ebuyname"]); ?>" style="width: 100px;">&nbsp;&nbsp;
    <input name="ebuylink" type="text" class="FormSmall" value="<?php echo ($product["ebuylink"]); ?>" style="width: 336px;">
    </td>
  </tr>

  <tr>
    <td style="color:blue;">产品内容 (英文)：</td>
    <td>
    <script id="econtents" name="econtents" type="text/plain" style="width:98%;height:500px;"><?php echo ($product["econtents"]); ?></script>
    </td>
  </tr>
  </table>
</DIV>
</DIV>

<div style="float:left; margin:-10px 0px 20px 135px;height:150px;">
    <input type="hidden" name="id" value="<?php echo ($product["id"]); ?>">
    <input type="submit" value="确认修改" class="bginput">&nbsp;&nbsp;
</div>

</form>

<SCRIPT type="text/javascript">
  //实例化编辑器
  var ue = UE.getEditor('contents');
  var ue2 = UE.getEditor('econtents');

  function delete_order(name,id,field){    
      confirm_ = confirm('您确认删除?');
      if(confirm_){
          $.ajax({
              type:"GET",
              url:'__APP__?m=Product&a=delphoto&name='+name+'&id='+id+'&field='+field,
              success:function(msg){
                  $("#thumbs").empty();
                  $("#thumbs").html("<input type='file' name='thumb'><input type='hidden' name='tnum' value='1'>");
              }
          });
      }
  };

  function delete_order2(name,id,field,k){    
      confirm_ = confirm('您确认删除该图片?');
      if(confirm_){
          $.ajax({
              type:"GET",
              url:'__APP__?m=Product&a=delphoto&name='+name+'&id='+id+'&field='+field,
              success:function(msg){
                  $("#photo"+k).empty();
              }
          });
      }
  };

  function delete_all(id){    
      confirm_ = confirm('您确认删除全部图片?');
      if(confirm_){
          $.ajax({
              type:"GET",
              url:'__APP__?m=Product&a=delmain&id='+id,
              success:function(msg){
                  $("#imgall").empty();
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