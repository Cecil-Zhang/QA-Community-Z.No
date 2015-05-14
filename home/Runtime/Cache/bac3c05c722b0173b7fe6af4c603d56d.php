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
	
	<!-- 包括ueditor编辑器 -->
	<script type="text/javascript">
		window.UEDITOR_HOME_URL='__PUBLIC__/ueditor/';
		window.onload=function(){
			UE.getEditor('description',{	
				toolbars:[
					['fullscreen', '|', 'source', '|', 'undo','redo', '|', 'bold','italic','underline','fontborder','strikethrough','superscript', 'subscript', '|',
					'blockquote', 'pasteplain', '|', 'searchreplace', 'help', 'background','|','horizontal', 'date', 'time', 'spechars','|', 'link', 'unlink', 'anchor','emotion',  'attachment' ,
					 'autotypeset',  'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist','insertcode','|','paragraph', 'fontfamily', 'fontsize', '|',
					'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|' , 'simpleupload', 'insertimage']
				],
				initialFrameHeight:400,
				maximumWords:400
			});
		}
	</script>	
	
	<script type="text/javascript">
		uParse('.content','__PUBLIC__/ueditor/');
	</script>
	
	<script type="text/javascript">
		function chkForm(){
			var content=UE.getEditor('description').getContent();
			if(content==""){
				var obj=document.getElementById("description");
				obj.focus()
				return false;
			}else{	
				return true;
			}
		}
	</script>
	<title> 留言板</title>
</head>
</body class="haspadding">
<?php require_cache("./Public/navbar.php"); ?>

<div class="container-fluid">
<div class="row personelrow">
	<div class="page-header center text">
		<h1><?php echo ($username); ?>的留言板</h1>
	</div>
</div>

<!-- 导航 -->
<nav class="navbar navbar-inverse navbar-fixed-bottom col-lg-5 col-lg-offset-4" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
      <span class="sr-only">Toggle navigation</span>
    </button>
    <a class="navbar-brand" href="#"><?php echo ($username); ?></a>
  </div>
  <div class="collapse navbar-collapse" id="navbar-collapse-01">
    <ul class="nav navbar-nav">
      <li><a href="__APP__/Personel/homePage/user_id/<?php echo ($user_id); ?>">个人主页</a></li>
	  <li class="active"><a href="#">留言板</a></li>
      <li><a href="__APP__/Personel/myQuestion/user_id/<?php echo ($user_id); ?>">问题</a></li>
	  <li><a href="__APP__/Personel/myAnswer/user_id/<?php echo ($user_id); ?>">回答</a></li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav><!-- /navbar -->

<!-- 留言 -->
<?php if(is_array($msgList)): foreach($msgList as $key=>$msg): ?><div class="row personelrow">
	<div class="col-lg-1 col-lg-offset-2">
		<a href="__APP__/Personel/homePage/user_id/<?php echo ($msg["user_id"]); ?>"><img src="__PUBLIC__/img/head/<?php echo ($msg["image"]); ?>" alt="头像" class="img-rounded img-responsive headImg"></a>
		<div class="center headImg"><a href="__APP__/Personel/homePage/user_id/<?php echo ($msg["user_id"]); ?>"><strong><?php echo ($msg["username"]); ?></strong></a></div>
	</div>
	<div class="col-lg-7">
		<p class="content"><?php echo ($msg["message"]); ?></p>
		<ul class="list-inline pull-right">
			<li><footer><strong><u>发布于<?php echo ($msg["date"]); ?></u></strong></footer></li>
		</ul>
		<div class="btn-group pull-right">
			
		</div>
	</div>
</div><?php endforeach; endif; ?>
<hr />
<!-- 分页 -->
<div class="row personelrow">
<div class="col-lg-4 col-lg-offset-8">
<?php echo ($page); ?>
</div>
</div>

<!-- 留言编辑框 -->
<form method="post" action="__URL__/leaveMsg" id="form" role="form">
<div class="form-group row personelrow haspadding">
<div class="col-lg-offset-3 col-md-6"><textarea id="description" name="description"></textarea></div>
</div>

<!-- 提交和取消按钮 -->
<div class="row personelrow">
	<div class="form-group">
		<input type="hidden" name="userid" value="<?php echo ($user_id); ?>"></input>
		<div class="col-md-2 col-md-offset-4">
			<input type="submit" name="submit" value="发布" class="btn btn-embossed btn-lg btn-primary mybutton" onclick="return chkForm()"></input>
		</div>
		<div class="col-md-2">
			<input type="reset" name="reset" value="取消" class="btn btn-default btn-embossed btn-lg mybutton"></input>
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
  <!-- UEditor插件 -->
  <script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.config.js"></script>
  <script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.all.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/assets/js/application.js"></script>
  <script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.parse.js"></script>
  <script>
      $(function () {
        $('[data-toggle=tooltip]').tooltip();
      });
  </script>
  
  
</body>
</html>