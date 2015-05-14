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
	
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/sprite.css" />
	
	<title> 修改密码</title>
	<script type="text/javascript">
		
		function chkPassword(obj){
			var pa=obj.value;
			
			$.post('<?php echo U("Personel/chkPassword");?>',{'password':pa},function(data){
				var obj2=document.getElementById('paError');
				if (data=='false'){
					obj2.style.visibility="visible";
				}else{
					obj2.style.visibility="hidden";
				}
			});
		}
		
		function chkSame(){
			var p1=document.getElementById('newPass').value;
			var p2=document.getElementById('newPassA').value;
			var obj=document.getElementById('serror');
			if(p1!='' && p2!=''){
				if(p1!=p2){
					obj.style.visibility="visible";
				}else{
					obj.style.visibility="hidden";
				}
			}
		}
		
		function chkform(){
			var obj=document.getElementById('serror').style.visibility;
			var obj2=document.getElementById('paError').style.visibility;
			if(obj=="visible"){
				var inp=document.getElementById('originalPass');
				inp.focus();
				return false;
			}
			if(obj2=="visible"){
				var inp2=document.getElementById('newPassA');
				inp2.focus();
				return false;
			}else{
				return true;
			}
		}
	</script>
</head>
<body class="nopadding" onload="changeBar()">
<?php require_cache("./Public/navbar.php"); ?>

<div class="row personelrow">
	<div class="page-header center text">
		<h1>修改密码</h1>
	</div>
</div>

<div class="container-fluid" id="personeledit">
	
	<form method="post" action="__URL__/submitPassword" onsubmit="return chkform()" role="form" id="changePassword">
	<!-- 原密码 -->
	<div class="row personelrow">
		<div class="form-group">
			<label for="originalPass" class="col-md-2 col-md-offset-2 control-label text infolabel">原密码</label>
			<div class="col-md-5">
				<div class="input-group">
				<input type="password" name="originalPass" id="originalPass" onblur="chkPassword(this)" class="form-control"/>
				<span class="input-group-addon add-on padless"><i class="cat cat-1"></i></span>
				</div>
			</div>
			<div class="col-md-2 text perror" id="paError" style="visibility:hidden">密码错误</div>
		</div>
	</div>
	
	<!-- 新密码1 -->
	<div class="row personelrow">
		<div class="form-group">
			<label for="newPass" class="col-md-2 col-md-offset-2 control-label text infolabel">输入新密码</label>
			<div class="col-md-5">
				<div class="input-group">
				<input type="password" name="newPass" id="newPass" onblur="chkSame()" class="form-control"/>
				<span class="input-group-addon add-on padless"><i class="cat cat-2"></i></span>
				</div>
			</div>
		</div>
	</div>
	
	<!-- 新密码2 -->
	<div class="row personelrow">
		<div class="form-group">
			<label for="newPassA" class="col-md-2 col-md-offset-2 control-label text infolabel">再次输入</label>
			<div class="col-md-5">
				<div class="input-group">
				<input type="password" name="newPassA" id="newPassA" onblur="chkSame()" class="form-control"/>
				<span class="input-group-addon add-on padless"><i class="cat cat-3"></i></span>
				</div>
			</div>
			<div class="col-md-2 text perror" id="serror" style="visibility:hidden" >两次输入密码错误</div>
		</div>
	</div>
	
	
	<!-- 提交和重置按钮 -->
	<div class="row personelrow">
		<div class="form-group">
			<div class="col-md-3 col-md-offset-4">
			<input name="submit" type="submit"  value="保存修改" class="btn btn-inverse btn-embossed btn-lg"></input>			
			</div>
			<div class="col-md-2">
			<input name="reset" type="reset" value="放弃修改" onblur="changeBar()" class="btn btn-default btn-embossed btn-lg"></input>
			</div>
		</div>
	</div>
	
	</form>	
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