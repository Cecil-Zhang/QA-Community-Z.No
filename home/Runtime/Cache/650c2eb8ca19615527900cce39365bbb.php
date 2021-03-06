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
		function agree(obj){
			var qid=obj.value;
			var str=obj.innerHTML;
			var num=str.split(' ');
			$.post('<?php echo U("Browse/agree");?>',{'Qid':qid, 'agreeNum':num[3]},function(data){
				if(data!="false"){
					obj.innerHTML='<span class="glyphicon glyphicon-heart"></span>点赞 '+(parseInt(num[3])+1);
					obj.disabled="disabled";
				}
			});
		}
		
		function star(obj){
			var qid=obj.value;
			var str=obj.innerHTML;
			var num=str.split(' ');
			$.post('<?php echo U("Browse/star");?>',{'Qid':qid, 'starNum':num[3]},function(data){
				if(data!="false"){
					obj.innerHTML='<span class="glyphicon glyphicon-heart"></span>收藏 '+(parseInt(num[3])+1);
					obj.disabled="disabled";
				}
			});
		}
	</script>
	<title> 问题</title>
</head>
<body class="nopadding">
<?php require_cache("./Public/navbar.php"); ?>
<div class="row personelrow">
	<div class="page-header center text">
		<h1><?php echo ($username); ?>已发布的问题</h1>
	</div>
</div>
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
      <li><a href="__APP__/Personel/homePage/user_id/<?php echo ($user_id); ?>">个人主页</a></li>
	  <li><a href="__APP__/Board/board/user_id/<?php echo ($user_id); ?>">留言板</a></li>
      <li class="active"><a href="#">问题</a></li>
	  <li><a href="__APP__/Personel/myAnswer/user_id/<?php echo ($user_id); ?>">回答</a></li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav><!-- /navbar -->

<?php if(is_array($list)): foreach($list as $key=>$vo): ?><div class="row personelrow">
<div class="col-lg-offset-5 col-lg-3">
<h6 class="title">
<a href="__APP__/Answer/answer/qid/<?php echo ($vo["Qid"]); ?>" class="title"><?php echo ($vo["title"]); ?></a>	
</h6>
</div>
</div>
<div class="row">
	<div class="col-lg-7 col-lg-offset-3">
		<h6 class="title">
		<button class="tag btn btn-inverse"><?php echo ($vo["tags"]); ?></button>
			<div class="pull-right"><strong class="credit">悬赏:<?php echo ($vo["credit"]); ?></strong>
			<?php  if($vo['ifFixed']=="1"){ echo '<button type="button" class="btn btn-info btn-sm" id="fix">已解决<span class="glyphicon glyphicon-ok"></span>
					</button>'; }else{ echo '<button type="button" class="btn btn-sm btn-warning" id="notfix">未解决<span class="glyphicon glyphicon-remove"></span>
					</button>'; } ?>
			</div>
		</h6>
		<div id="content"><?php echo ($vo["content"]); ?></div>
		<span class="tag"><?php echo ($vo["publishDate"]); ?></span>
		<div class="btn-group pull-right">
			
			<button type="button" class="wide btn btn-primary" value="<?php echo ($vo["Qid"]); ?>" onclick="agree(this)" <?php if(strcmp($vo['ifAgreed'],"1")==0) echo 'disabled="disabled"'; ?>><span class="glyphicon glyphicon-heart"></span>点赞 <?php echo ($vo["agreeNum"]); ?></button>
			<a href="__APP__/Answer/answer/qid/<?php echo ($vo["Qid"]); ?>"><button type="button" class="wide btn btn-primary"  value="<?php echo ($vo["Qid"]); ?>"><span class="glyphicon glyphicon-share"></span>回答 <?php echo ($vo["answerNum"]); ?></button></a>
			<button type="button" class="btn btn-primary"  value="<?php echo ($vo["Qid"]); ?>" onclick="star(this)" <?php if(strcmp($vo['ifStared'],"1")==0) echo 'disabled="disabled"'; ?>><span class="glyphicon glyphicon-share"></span>收藏 <?php echo ($vo["starNum"]); ?></button>
		</div>
	</div>
</div><?php endforeach; endif; ?>
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
  
  <script type="text/javascript" src="__PUBLIC__/assets/js/application.js"></script>
  <script>
      $(function () {
        $('[data-toggle=tooltip]').tooltip();
      });
  </script>
  
  
</body>
</html>