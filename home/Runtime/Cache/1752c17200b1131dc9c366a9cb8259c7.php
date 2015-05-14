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
		uParse('.content','__PUBLIC__/ueditor/');
	</script>
	
	<script type="text/javascript">
		function agreeReply(obj){
			var rid=obj.value;
			var str=obj.innerHTML;
			var num=str.split(' ');
			$.post('<?php echo U("Answer/agreeReply");?>',{'Rid':rid, 'agreeNum':num[3]},function(data){
				if(data!="false"){
					obj.innerHTML='<span class="glyphicon glyphicon-thumbs-up"></span> '+(parseInt(num[3])+1);
					obj.disabled="disabled";
				}
			});
		}
	</script>
	<title> 回答</title>
</head>
</body class="haspadding">


<div class="container-fluid">
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
      <li><a href="__APP__/Personel/homePage/user_id/<?php echo ($user_id); ?>">个人信息</a></li>
	  <li><a href="__APP__/Board/board/user_id/<?php echo ($user_id); ?>">留言板</a></li>
      <li><a href="__APP__/Personel/myQuestion/user_id/<?php echo ($user_id); ?>">问题</a></li>
	  <li class="active"><a href="#">回答</a></li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav><!-- /navbar -->

<div class="row personelrow">
	<div class="page-header center text">
		<h1><?php echo ($username); ?>已发布的回答</h1>
	</div>
</div>

<!-- 回答 -->
<?php if(is_array($answerList)): foreach($answerList as $key=>$answer): ?><!-- 回答的问题标题 -->
<div class="row personelrow">
	<div class="col-lg-7 col-lg-offset-3">
		<h6><strong class="text"><a href="__APP__/Answer/answer/qid/<?php echo ($answer["Qid"]); ?>"><?php echo ($answer["title"]); ?></a></strong></h6>
	</div>
</div>

<div class="row">
	<div class="col-lg-1 col-lg-offset-2">
		<strong class="username"><i class="icon-<?php echo ($answer["grade"]); ?>"></i><a href="#"><?php echo ($answer["username"]); ?></a></strong>
	</div>
	<div class="col-lg-7">
		<p class="content"><?php echo ($answer["reply"]); ?></p>
		<ul class="list-inline pull-right">
			<li><footer><strong><u><?php echo ($answer["floors"]); ?>楼 编辑于<?php echo ($answer["publishDate"]); ?></u></strong></footer></li>
			<li><button type="button" class="btn btn-primary btn-sm" value="<?php echo ($answer["Rid"]); ?>" onclick="agreeReply(this)"<?php if(strcmp($answer['ifAgreed'],"1")==0) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-thumbs-up"></span> <?php echo ($answer["agreeNum"]); ?></button></li>
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