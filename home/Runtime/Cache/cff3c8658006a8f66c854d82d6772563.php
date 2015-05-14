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
	
	<!-- 包括flat ui样式 -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/flat-ui.css" />
	
    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap.min.css" />
	
    <!-- Custom styles for this template -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/signin.css" />
	
	<!-- 包括Font Awesome样式 -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/font-awesome.min.css" />
	
	<title>登录</title>
	<script type="text/javascript">
		function chkVerify(str){
			$.post('<?php echo U("Login/checkVerify");?>',{'verify':str},function(data){
				if(data==1){
					document.getElementById("pass").className="glyphicon glyphicon-ok";
				}else{
					document.getElementById("pass").className="glyphicon glyphicon-remove";
				}
			});
		}
	</script>
</head>
<body class="nopadding">
	<div class="progress" style="height:80px; top:0px;">
		<div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
		<span class="sr-only">45% Complete</span>
		<div class="heading text">Z.No - They Know Everything</div>
	</div>
	</div>


	<div class="container" style="margin-top:60px;">	
	<div class="pull-left"><img src="__PUBLIC__/img/preview.png" width="500px" height="360px" alt="previw" id="icons"></div>
	
	<form method="post" action="__URL__/index" class="form-signin pull-right" role="form" id="login">
		<h2 class="form-signin-heading" style="text-align:center">Hellow World</h2>
		<span class="add-on"><i class="icon-envelope"></i></span>
		<input type="email" name="mailbox" class="form-control" placeholder="Email address" required/>	
		
		<span class="add-on"><i class="icon-key"></i></span>
		<input type="password" name="password" class="form-control" placeholder="Password" required/>				
		
		<span class="glyphicon glyphicon-eye-open" id="pass"></span>
		<input type="text" name="verify" onblur="chkVerify(this.value)" placeholder="Verification"  style="width:11.5em" required/><img src="__PUBLIC__/captcha.php" onclick="this.src=this.src" alt="Verification pass-phrase" 
			class="img-thumbnail" style="margin:5px;"/>
        <p class="personelrow">
		</p>
        
        <div>
		<input class="btn btn-primary inbutton" type="submit" value="Log in" name="login">
		<input class="btn btn-warning inbutton" type="submit" value="Sign up" name="signup">
		</div>
		
		<?php  if (!empty($error_msg)) { echo '<div class="text" id="inerror"><span class="add-on"><i class="icon-minus-sign"></i></span>  '.$error_msg.'</div>'; } ?>
	</form>
	</div>
<script src="__PUBLIC__/js/bootstrap.min.js"></script>
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