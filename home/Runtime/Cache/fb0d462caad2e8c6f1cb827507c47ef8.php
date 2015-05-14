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
	
	<script type="text/javascript">
	function changeBar(){
			var name=document.getElementById("username").innerHTML;
			var mood=document.getElementById("mood").innerHTML;
			var intro=document.getElementById("introduction").innerHTML;
			var res=document.getElementById("residence").innerHTML;
			var pro=document.getElementById("profession").innerHTML;
			var edu=document.getElementById("education").innerHTML;
			var bar=10;
			if ( name!='必填'){
				bar=bar+30;
			}
			if ( document.getElementById("head").src!="__PUBLIC__/img/head/default.jpg"){
				bar=bar+10;
			}
			if ( mood!=''){
				bar=bar+10;
			}
			if ( intro!=''){
				bar=bar+10;
			}
			if (res!=''){
				bar=bar+10;
			}
			if ( pro!=''){
				bar=bar+10;
			}
			if ( edu!=''){
				bar=bar+10;
			}
			var bars=document.getElementById("bar");
			bars.style.width=bar+"%";
			bars.innerHTML=bar+"%";
		}
	</script>
		
	<title> 个人主页</title>
	
</head>
<body class="haspadding" onload="changeBar()">
<?php require_cache("./Public/navbar.php"); ?>

<div class="row paddingrow">
	<div class="page-header center text">
		<h1><?php echo ($user["username"]); ?>的个人主页</h1>
	</div>
</div>

<div class="container-fluid" id="personeledit">

<!-- 导航 -->
<nav class="navbar navbar-inverse navbar-fixed-bottom col-lg-5 col-lg-offset-4" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
      <span class="sr-only">Toggle navigation</span>
    </button>
    <a class="navbar-brand" href="#"><?php echo ($user["username"]); ?></a>
  </div>
  <div class="collapse navbar-collapse" id="navbar-collapse-01">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">个人信息</a></li>
	  <li><a href="__APP__/Board/board/user_id/<?php echo ($user["user_id"]); ?>">留言板</a></li>
      <li><a href="__APP__/Personel/myQuestion/user_id/<?php echo ($user["user_id"]); ?>">问题</a></li>
	  <li><a href="__APP__/Personel/myAnswer/user_id/<?php echo ($user["user_id"]); ?>">回答</a></li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav><!-- /navbar -->

	<div class="row paddingrow">
	<label class="col-md-2 col-md-offset-2 control-label text infolabel">资料完整度</label>
	<div class="progress" id="proBar">
	<div class="progress-bar" id="bar" style="width: 10%;">10%</div>
	</div>
	</div>
	
	<!-- 用户名和性别 -->
	<div class="row paddingrow">
		<div class="form-group">
			<label for="username" class="col-md-2 control-label text infolabel">用户名</label>
			<div class="col-md-2">
				<button class="btn btn-primary" id="username"><?php echo ($user["username"]); ?>  <i class="icon-<?php echo ($user["icon"]); ?> paddingRight"></i></button>
			</div>
			<label for="gender" class="col-md-2 col-md-offset-3 control-label text infolabel">性别</label>
			  <div class="col-md-2">
				<ul class="list-inline">
					<li><label class="radio text infolabel" for="male">
						<input name="gender" type="radio" data-toggle="radio" value="male" id="gender" readonly="readonly" checked>
						<?php echo ($user["gender"]); ?>
						</label>
					</li>
				</ul>
			</div>
		</div>
	</div>
	
	<!-- 头像和居住地 -->
	<div class="row paddingrow">
		<div class="form-group">
			<label for="head" class="col-md-2 control-label text infolabel">头像</label>
			<div class="col-md-2" >
				<img src="__PUBLIC__/img/head/<?php echo ($user["image"]); ?>" alt="头像" class="img-rounded img-responsive" id="head">
			</div>
			
			<label for="residence" class="col-md-2 col-md-offset-3 control-label text infolabel">居住地</label>
			<div class="col-md-3">
				<button class="btn btn-primary" id="residence"><?php echo ($user["residence"]); ?></button>
			</div>
		</div>
	</div>
	
	<!-- 职业和教育经历 -->
	<div class="row paddingrow">
		<div class="form-group">
			<label for="profession" class="col-md-2 control-label text infolabel">职业经历</label>
			<div class="col-md-2">
				<button class="btn btn-primary" id="profession"><?php echo ($user["profession"]); ?></button>
			</div>
			
			<label for="education" class="col-md-2 col-md-offset-3 control-label text infolabel">教育经历</label>
			<div class="col-md-3">
				<button class="btn btn-primary" id="education"><?php echo ($user["education"]); ?></button>
			</div>
		</div>
	</div>
	
	<!-- 心情和个人简介 -->
	<div class="row paddingrow">
		<div class="form-group">
			<label for="mood" class="col-md-2 control-label text infolabel">心情</label>
			<p class="col-md-3" id="mood"><?php echo ($user["mood"]); ?></p>
			
			<label title="" for="introduction" class="col-md-2 col-md-offset-2 control-label text infolabel">个人简介</label>
			<p class="col-md-3" id="introduction"><?php echo ($user["introduction"]); ?></p>
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