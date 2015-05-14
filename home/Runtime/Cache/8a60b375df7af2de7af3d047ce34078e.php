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
	<nav class="navbar navbar-inverse navbar-embossed navbar-fixed-top" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
      <span class="sr-only">Toggle navigation</span>
    </button>
    <a class="navbar-brand" href="#">Z.No</a>
  </div>
  <div class="collapse navbar-collapse" id="navbar-collapse-01">
    <ul class="nav navbar-nav">
      <li <?php if ($navactive=="homepage") echo 'class="active"';?>><a href="homepage.php">首页</a></li>
      <li <?php if ($navactive=="quiz") echo 'class="active"';?>><a href="quiz.php">提问</a></li>
	  <li <?php if ($navactive=="find") echo 'class="activ"';?>><a href="#fakelink">发现</a></li>
	  <li <?php if ($navactive=="msgBoard") echo 'class="activ"';?>><a href="#fakelink">留言板<span class="navbar-unread">2</span></a></li>
    </ul>
	
    <form method="post" action="homepage.php" class="navbar-form navbar-left form-inline"  role="search">
      <div class="form-group" >
		<select class="form-control select select-primary mbl" id="scope" data-toggle="select" name="scope">
            <optgroup label="范围">
              <option value="0">问题</option>
              <option value="1">用户</option>
            </optgroup>
		</select>
	  </div>
	  <div class="form-group">		
        <div class="input-group">
          <input class="form-control" id="navbarInput-01" type="search" placeholder="Search" name="select">
          <span class="input-group-btn">
            <button type="submit" class="btn" name="submit"><span class="fui-search"></span></button>
          </span>
        </div>
      </div>
    </form>
	
	<ul class="nav navbar-nav navbar-right" id="personel">
			<li><img src="__PUBLIC__/img/head/default.jpg" alt="头像" class="img-rounded thumbnail"></img> 
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
			  <?php if (isset($_COOKIE['username'])) echo $_COOKIE['username']; else echo '哈哈怪'; ?> 
			  <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="personel.php">个人信息</a></li>
                <li><a href="creditRecord.php">积分与权限</a></li>
				<li class="divider"></li>
                <li><a href="#">我的提问</a></li>
				<li><a href="#">我的回答</a></li>
				<li><a href="#">我的赞同</a></li>
				<li><a href="#">我的收藏</a></li>
              </ul>
            </li>
            <li><a href="logout.php">注销</a></li>
          </ul>
  </div><!-- /.navbar-collapse -->
</nav>
<script src="js/bootstrap.min.js"></script>
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