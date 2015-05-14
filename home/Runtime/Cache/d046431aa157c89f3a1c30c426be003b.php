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
	
    <!-- Custom styles for this template -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/signin.css" />
	
	<!-- 包括flat ui样式 -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/flat-ui.css" />
	
	<!-- 包括Font Awesome样式 -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/font-awesome.min.css" />
	
	<title> 首页</title>
  </head>
  <body class="haspadding">
	
  <?php require_cache("./Public/navbar.php"); ?>
  <hr />
  <br/><p class="footer text center">Copyright &copy;2014 Z.Know, Inc.</p>
  
  <!-- UEditor插件 -->
  <script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.config.js"></script>
  <script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.all.min.js"></script>
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