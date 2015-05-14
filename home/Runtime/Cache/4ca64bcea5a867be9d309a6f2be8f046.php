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
<div class="row personelrow">
	<div class="page-header center text">
		<h1>热点</h1>
	</div>
</div>

<div class="container-fluid">

<div class="row personelrow">
	<div class="col-lg-1 col-lg-offset-2">
		<img src="img/head/default.jpg" alt="头像" class="img-rounded img-responsive headImg">
		<div class="center headImg"><strong>哈哈怪</strong></div>
	</div>
	<div class="col-lg-7">
		<h6 class="title"><a href="#" class="title">挖掘机技术？
			<button type="button" class="btn btn-primary btn-sm pull-right" id="fix" disabled="disabled">已解决
			<span class="glyphicon glyphicon-ok"></span>
			</button></a>
		</h6>
		<div>挖掘机技术哪家强？挖掘机技术哪家强？挖掘机技术哪家强？挖掘机技术哪家强？
		挖掘机技术哪家强？挖掘机技术哪家强？挖掘机技术哪家强？挖掘机技术哪家强？挖掘机技术哪家强？
		挖掘机技术哪家强？挖掘机技术哪家强？挖掘机技术哪家强？挖掘机技术哪家强？挖掘机技术哪家强？挖掘机技术哪家强？
		</div>
		
		<div class="btn-group pull-right">
			<button type="button" class="wide btn btn-primary" ><span class="glyphicon glyphicon-heart"></span>赞同 11</button>
			<button type="button" class="wide btn btn-primary" ><span class="glyphicon glyphicon-share"></span>解答 21</button>
			<button type="button" class="btn btn-primary" ><span class="glyphicon glyphicon-share"></span>收藏 32</button>
		</div>
	</div>
</div>

<!-- 分页 -->
<div class="row personelrow">
<div class="col-lg-4 col-lg-offset-6">
<div class="pagination pull-right">
	<ul>
    <li class="previous"><a href="#" class="fui-arrow-left"></a></li>
	<li><a href="#">1</a></li>
	<li><a href="#">2</a></li>
	<li><a href="#">3</a></li>
	<li><a href="#">4</a></li>

    <!-- Make dropdown appear above pagination -->
    <li class="pagination-dropdown dropup">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fui-triangle-up"></i>
      </a>
      <!-- Dropdown menu -->
      <ul class="dropdown-menu">
        <li>
          <a href="#">10-20</a>
        </li>
      </ul>
    </li>

    <li class="next">
      <a href="#" class="fui-arrow-right"></a>
    </li>
  </ul>
</div>
</div>
</div>
</div>
<hr />
  <br/><p class="footer text center">Copyright &copy;2014 Z.Know, Inc.</p>
  <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
  <script type="text/javascript" src="__PUBLIC__/js/vendor/jquery.min.js"></script>
  <!-- 包括所有已编译的插件 -->
  <script type="text/javascript" src="__PUBLIC__/js/flat-ui.min.js"></script>
  <script>
      $(function () {
        $('[data-toggle=tooltip]').tooltip();
      });
  </script>
  
  
</body>
</html>