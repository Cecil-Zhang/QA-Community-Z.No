<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="__PUBLIC__/img/zno.ico">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/style.css" />
	
    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap.min.css" />
	
	<!-- 包括flat ui样式 -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/flat-ui.css" />
	
    <!-- Custom styles for this template -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/signin.css" />
	
	<!-- 包括Font Awesome样式 -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/font-awesome.min.css" />
	
	<title> 首页</title>
</head>
</body class="nopadding">
<?php require_cache("./Public/navbar.php"); ?>

<div class="container-fluid">
<div class="row personelrow">
<div class="page-header center text">
  <h1>积分与权限</h1>
</div>
</div>

<div class="row personelrow">
<div class="col-md-3 col-md-offset-5">
<button class="btn btn-primary"><h6>当前等级：<?php echo ($grade); ?> <i class="icon-<?php echo ($icon); ?> paddingRight"></i></h6></button>
</div>
</div>

<div class="row personelrow">
<div class="col-md-4 col-md-offset-2">  
<div class="list-group">
  <a class="list-group-item list-group-item-danger center  disabled"><i class="icon-ambulance paddingRight"></i>求知历程</a>
  <a class="list-group-item list-group-item-info center"><i class="icon-question-sign paddingRight"></i>提问<span class="badge"><?php echo ($quiz); ?></span></a>
  <a class="list-group-item list-group-item-warning center"><i class="icon-lightbulb paddingRight"></i>回答<span class="badge"><?php echo ($answer); ?></span></a>
  <a class="list-group-item list-group-item-success center"><i class="icon-thumbs-up paddingRight"></i>赞同<span class="badge"><?php echo ($agree); ?></span></a>
  <a class="list-group-item list-group-item-danger center"><i class="icon-tags paddingRight"></i>收藏<span class="badge"><?php echo ($star); ?></span></a>
</div>
</div>

<div class="col-md-4">
<ul class="list-group">
  <li class="list-group-item list-group-item-danger disable center disabled">积分<i class="icon-heart-empty pull-right"></i></li>
  <li class="list-group-item list-group-item-info center"><?php echo ($quiz); ?>*10=<?php echo ($quizc); ?><i class="icon-heart pull-right"></i></li>
  <li class="list-group-item list-group-item-warning center"><?php echo ($answer); ?>*10=<?php echo ($answerc); ?><i class="icon-heart pull-right"></i></li>
  <li class="list-group-item list-group-item-success center"><?php echo ($agree); ?>*5=<?php echo ($agreec); ?><i class="icon-heart pull-right"></i></li>
  <li class="list-group-item list-group-item-danger center">50+<?php echo ($quizc); ?>+<?php echo ($answerc); ?>+<?php echo ($agreec); ?>=<?php echo ($total); ?><i class="icon-heart pull-right"></i></li>
</ul>
</div>  
</div>

<div class="row personelrow">
<div class="col-md-8 col-md-offset-2">
<table class="table table-bordered">
<!-- On rows -->
<tr class="active">
	<td class="center">头衔</a></td>
	<td class="center">积分</td>
</tr>
<tr class="success">
	<td class="center"><i class="icon-truck paddingRight"></i>学渣</a></td>
	<td class="center">[0,100)</td>
</tr>
<tr class="warning">
	<td class="center"><i class="icon-plane paddingRight"></i>学霸</a></td>
	<td class="center">[100,300)</td>
</tr>
<tr class="danger">
	<td class="center"><i class="icon-fighter-jet paddingRight"></i>学神</a></td>
	<td class="center">[300,+∞)</td>
</tr>
</table>
</div>
</div>
</div>
<hr />
  <br/><p class="footer text center">Copyright &copy;2014 Z.Know, Inc.</p>
  <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
  <script type="text/javascript" src="__PUBLIC__/js/vendor/jquery.min.js"></script>
  <!-- 包括所有已编译的插件 -->
  <script type="text/javascript" src="__PUBLIC__/js/flat-ui.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/assets/js/application.js"></script>
  <script>
      $(function () {
        $('[data-toggle=tooltip]').tooltip();
      });
  </script>
  
  
</body>
</html>