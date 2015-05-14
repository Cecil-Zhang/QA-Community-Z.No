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
</body class="haspadding">
<?php require_cache("./Public/navbar.php"); ?>

<div class="container-fluid">
<div class="row personelrow">
	<div class="col-lg-4 col-lg-offset-4 center">
		<strong class="h5 center">挖掘机技术哪家强?</strong>
		<button type="button" class="btn btn-sm pull-right" id="fix" disabled="disabled">已解决 <span class="glyphicon glyphicon-ok"></span></button>
	</div>
</div>

<div class="row personelrow">
	<div class="col-lg-offset-4 col-lg-4 center button-group">
		<button type="button" class="btn btn-default btn-sm">挖掘机</button>
		<button type="button" class="btn btn-default btn-sm leftMargin">中国山东</button>
		<button type="button" class="btn btn-default btn-sm leftMargin">蓝翔</button>
	</div>
</div>

<!-- 问题描述，提问人描述 -->
<div class="row personelrow">
	<div class="col-lg-1 col-lg-offset-2">
		<img src="img/head/default.jpg" alt="头像" class="img-rounded img-responsive headImg">
		<div class="center">
			<strong><i class="icon-truck"></i>哈哈怪</strong>
			<p class="sxText"><strong><u>挖掘机驾驶员</u></strong></p>
			<p class="sxText"><strong><u>软件工程师</strong></u></p>
			<p class="sxText"><strong><u>教师</strong></u></p>
		</div>
	</div>
	<div class="col-lg-7">
		<h6><strong class="text">问题描述</strong>
		</h6>
		<p class="text"><strong> 挖掘机技术哪家强？挖掘机技术哪家强？挖掘机技术哪家强？挖掘机技术哪家强？
		挖掘机技术哪家强？挖掘机技术哪家强？挖掘机技术哪家强？挖掘机技术哪家强？挖掘机技术哪家强？
		挖掘机技术哪家强？挖掘机技术哪家强？挖掘机技术哪家强？挖掘机技术哪家强？挖掘机技术哪家强？挖掘机技术哪家强？</strong>
		</p>
		
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-primary leftMargin"><span class="glyphicon glyphicon-heart-empty"></span> 喜欢 11</button>
			<button type="button" class="btn btn-primary leftMargin"><span class="glyphicon glyphicon-pencil"></span> 回答 21</button>
			<button type="button" class="btn btn-primary leftMargin"><span class="glyphicon glyphicon-send"></span> 收藏 32</button>
		</div>
	</div>
</div>

<hr />

<!-- 回复 -->
<div class="row personelrow">
	<div class="col-lg-1 col-lg-offset-2">
		<img src="img/head/default1.jpg" alt="头像" class="img-rounded img-responsive thumbnail">		
		<strong class="username"><i class="icon-truck"></i>校长</strong>
	</div>
	<div class="col-lg-7">
		<p class="text">  中国山东找蓝翔！中国山东找蓝翔！中国山东找蓝翔！中国山东找蓝翔！中国山东找蓝翔！中国山东找蓝翔！中国山东找蓝翔！
		中国山东找蓝翔！中国山东找蓝翔！中国山东找蓝翔！中国山东找蓝翔！中国山东找蓝翔！中国山东找蓝翔！中国山东找蓝翔！中国山东找蓝翔！
		中国山东找蓝翔！中国山东找蓝翔！中国山东找蓝翔！中国山东找蓝翔！中国山东找蓝翔！中国山东找蓝翔！中国山东找蓝翔！中国山东找蓝翔！
		</p>
		<ul class="list-inline pull-right">
			<li><footer><strong>1楼</strong></footer></li>
			<li><footer><strong>挖掘机驾驶员,软件工程师，教师</strong></footer></li>
			<li><footer><strong><u>编辑于2014-10-28 17:31</u></strong></footer></li>
			<li>
		<button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-thumbs-up"></span> 11</button>
		<button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-thumbs-down"></span> 13</button>
		</li>
		</ul>
		<div class="btn-group pull-right">
			
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