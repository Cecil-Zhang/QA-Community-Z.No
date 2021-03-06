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
	<script type="text/javascript">
		function chkUsername(field){
			if(field.value.length<4){
				document.getElementById("nameerror").innerHTML="用户名长度不能小于4!";
			}else{
				document.getElementById("nameerror").innerHTML="";
			}
		}
		
		function changeBar(){
			var name=document.getElementById("username").placeholder;
			var img=document.getElementById("inputPic").value;
			var mood=document.getElementById("inputMood").value;
			var intro=document.getElementById("inputIntroduction").value;
			var res=document.getElementById("inputResidence").value;
			var pro=document.getElementById("inputProfession").value;
			var edu=document.getElementById("inputEducation").value;
			var bar=10;
			if ( name!='必填'){
				bar=bar+30;
			}
			if ( img!='' || document.getElementById("head").src!="__PUBLIC__/img/head/default.jpg"){
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
</head>
<body class="nopadding" onload="changeBar()">
<?php require_cache("./Public/navbar.php"); ?>

<div class="row personelrow">
	<div class="page-header center text">
		<h1>我的资料</h1>
	</div>
</div>

<div class="container-fluid" id="personeledit">
	
	<div class="row personelrow">
	<label class="col-md-2 col-md-offset-2 control-label text infolabel">资料完整度</label>
	<div class="progress" id="proBar">
	<div class="progress-bar" id="bar" style="width: 10%;">10%</div>
	</div>
	</div>
	
	<form method="post" enctype="multipart/form-data" action="__URL__/save" role="form" id="info">
	<!-- 用户名 -->
	<div class="row personelrow">
		<div class="form-group">
			<label title="" data-placement="top" data-toggle="tooltip" data-original-title="保存后不可更改" for="inputUsername" class="col-md-2 col-md-offset-2 control-label text infolabel">用户名</label>
			<div class="col-md-5">
				<div class="input-group">
				<input type="text" name="username" id="username" onblur="chkUsername(this);changeBar()" class="form-control" placeholder="<?php echo ($username); ?>" <?php echo ($ifRequired); ?>/>
				<span class="input-group-addon add-on"><i class="icon-user-md"></i></span>
				</div>
			</div>
			<div class="col-md-3 text" id="nameerror"></div>
		</div>
	</div>
	
	<!-- 头像 -->
	<div class="row personelrow">
		<div class="col-md-4 col-md-offset-4">
			<div class="text" id="inerror"><?php echo ($error_msg); ?></div>
		</div>
	</div>
	<div class="row personelrow">
		<div class="form-group">
			<label for="inputPic" class="col-md-2 col-md-offset-2 control-label text infolabel">头像</label>
			<div class="col-md-3">
				<div class="input-group">
				<input type="file" id="inputPic" name="headImg"  onblur="changeBar()" accept="image/gif,image/jpeg,image/png,image/pjpeg" alt="头像">
                <p class="help-block">支持JPG、PNG、GIF格式,不超过2M。</p>
				</div>
			</div>
		</div>
		<div class="col-md-2 col-md-offset-1" id="headImg">
			<img src="__PUBLIC__/img/head/<?php echo ($headImg); ?>" alt="头像" class="img-rounded img-responsive" id="head">
		</div>
	</div>
	
	
	
	<!-- 性别 -->
	<div class="row personelrow">
		<div class="form-group">
			  <label class="col-md-2 col-md-offset-2 control-label text infolabel">性别</label>
			  <div class="col-md-3">
				<ul class="list-inline">
					<li><label class="radio text infolabel" for="male">
						<input name="gender" type="radio" data-toggle="radio" value="male" id="male" <?php echo ($maleChk); ?>>
						男
						</label>
					</li>
					<li><label class="radio text infolabel" for="female">
						<input name="gender" type="radio" data-toggle="radio" value="female" id="female" <?php echo ($femaleChk); ?>>
						女
						</label>
					</li>
				</ul>
			</div>
         </div>
	</div>
	
	<!-- 心情 -->
	<div class="row personelrow">
		<div class="form-group">
			<label title="" data-placement="top" data-toggle="tooltip" data-original-title="您现在的心情" for="inputMood" class="col-md-2 col-md-offset-2 control-label text infolabel">心情</label>
			<div class="col-md-5">
				<div class="input-group">
				<textarea class="form-control" rows="3" onblur="changeBar()" id="inputMood" placeholder="不多于30个字" name="mood"><?php echo ($mood); ?></textarea>
				<span class="input-group-addon add-on"><i class="icon-edit"></i></span>
				</div>
			</div>
		</div>
	</div>
	
	<!-- 个人简介 -->
	<div class="row personelrow">
		<div class="form-group">
			<label title="" data-placement="top" data-toggle="tooltip" data-original-title="您的自我介绍" for="inputIntroduction" class="col-md-2 col-md-offset-2 control-label text infolabel">个人简介</label>
			<div class="col-md-5">
				<div class="input-group">
				<textarea class="form-control" rows="6" onblur="changeBar()" id="inputIntroduction" placeholder="不多于150个字" name="introduction"><?php echo ($introduction); ?></textarea>
				<span class="input-group-addon add-on"><i class="icon-camera"></i></span>
				</div>
			</div>
		</div>
	</div>
	
	<!-- 居住地 -->
	<div class="row personelrow">
		<div class="form-group">
			<label title="" data-placement="top" data-toggle="tooltip" data-original-title="输入您居住过的地方后按回车" for="inputResidence" class="col-md-2 col-md-offset-2 control-label text infolabel">居住地</label>
			<div class="input-group col-md-5">
				<div class="tagsinput-primary">
				<input name="residence" class="tagsinput form-control" onchange="changeBar()" data-role="tagsinput" id="inputResidence" value="<?php echo ($residence); ?>" name="residence"/>
				</div>
				
			</div>
		</div>
	</div>
	
	<!-- 职业经历 -->
	<div class="row personelrow">
		<div class="form-group">
			<label title="" data-placement="top" data-toggle="tooltip" data-original-title="输入您的职业后按回车" for="inputProfession" class="col-md-2 col-md-offset-2 control-label text infolabel">职业经历</label>
			<div class="input-group col-md-5">
				<div class="tagsinput-primary">
				<input name="profession" class="tagsinput form-control" onchange="changeBar()" data-role="tagsinput" id="inputProfession" value="<?php echo ($profession); ?>" name="profession"/>
				</div>
			</div>
		</div>
	</div>
	
	<!-- 教育经历 -->
	<div class="row personelrow">
		<div class="form-group">
			<label title="" data-placement="top" data-toggle="tooltip" data-original-title="输入您的教育经历后按回车" for="inputEducation" class="col-md-2 col-md-offset-2 control-label text infolabel">教育经历</label>
			<div class="input-group col-md-5">
				<div class="tagsinput-primary">
				<input name="education" class="tagsinput form-control" onchange="changeBar()" data-role="tagsinput" id="inputEducation" value="<?php echo ($education); ?>" name="education"/>
				</div>
			</div>
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