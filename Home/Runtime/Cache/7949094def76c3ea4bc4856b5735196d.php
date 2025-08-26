<?php if (!defined('THINK_PATH')) exit(); if (htmlspecialchars($_GET['g'])=='c') { $titlemsg='提示信息'; $automsg='页面自动'; $jumpmsg='跳转'; $waitmsg='等待时间：'; } else { $titlemsg='Message'; $automsg='Automatically'; $jumpmsg='Jump'; $waitmsg='Waiting time: '; } ?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $titlemsg; ?></title>
    <link href="__PUBLIC__/css/bootstrap.css" rel="stylesheet">
</head>
<style type="text/css">
.showMsg{margin: 0 auto; width: 400px; text-align:center; margin-top: 200px;}
.errormsg{ color: red; font-size: 15px;}
.sumsg{color: green; font-size: 15px;}
.goto{ font-size: 12px;}
@media screen and (max-width: 768px) {  
    .showMsg{width:95%; margin-top: 200px;}
}
</style>
<body>
<div class="showMsg">

    <div class="panel <?php echo $vars = (!empty($message)) ? "panel-success" : "panel-warning" ;?>">
        <div class="panel-heading">
        <h3 class="panel-title"><?php echo($titlemsg)?></h3>
        </div>

        <div class="panel-body">

            <?php if(isset($message)): ?><p class="sumsg">√ <?php echo($message); ?></p>
            <?php else: ?>
            <p class="errormsg"><?php echo($error); ?></p><?php endif; ?>

            <p class="goto"><?php echo $automsg; ?> <a id="href" href="<?php echo($jumpUrl); ?>"><?php echo $jumpmsg; ?></a> <?php echo $waitmsg; ?><b id="wait"><?php echo($waitSecond); ?></b></p>

        </div>
    </div>

</div>

<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
    var time = --wait.innerHTML;
    if(time <= 0) {
        location.href = href;
        clearInterval(interval);
    };
}, 1000);
})();


</script>
</body>
</html>