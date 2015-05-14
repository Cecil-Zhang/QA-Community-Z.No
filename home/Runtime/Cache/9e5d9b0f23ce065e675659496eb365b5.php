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

<div class="container-fluid">
<div class="row personelrow">
<div class="page-header center text">
  <h1>提问</h1>
</div>
</div>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form">

<div class="form-group has-feedback row personelrow">
  <label for="title" class="col-md-2 col-md-offset-2 control-label text infolabel">标题</label>
  <div class="input-group col-md-6">
  <input type="text" placeholder="不超过30字" class="form-control" id="title"/>
  <span class="input-group-addon add-on"><i class="icon-medkit"></i></span>
  </div>
</div>

<div class="form-group has-feedback row personelrow">
  <label for="tag" class="col-md-2 col-md-offset-2 control-label text infolabel">标签</label>
  <div class="input-group col-md-6">
  <div class="tagsinput-primary">
		<input name="residence" class="tagsinput form-control" data-role="tagsinput" id="inputResidence" value="银河系,中国" />
  </div>
  </div>
</div>

<div class="form-group row personelrow">
  <label for="description" class="col-md-2 col-md-offset-2 control-label text infolabel">描述</label>
  <div class="input-group col-md-6">
		<textarea class="form-control" rows="6" id="description" placeholder="不超过500个字"></textarea>
		<span class="input-group-addon add-on"><i class="icon-stethoscope"></i></span>
  </div>
  <div class="col-md-offset-4">
	<span class="add-on pull-left"><i class="icon-camera"></i></span>
	<input type="file" name="pics" class="paddingLeft">
  </div>
 
</div>

<!-- 提交和重置按钮 -->
<div class="row personelrow haspadding">
	<div class="form-group">
		<div class="col-md-2 col-md-offset-4">
			<input name="submit" type="submit" value="发布" class="btn btn-embossed btn-lg btn-primary inbutton"></input>
		</div>
		<div class="col-md-2">
			<input name="submit" type="submit" value="取消" class="btn btn-default btn-embossed btn-lg inbutton"></input>
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
  <script>
      $(function () {
        $('[data-toggle=tooltip]').tooltip();
      });
  </script>
  
  
</body>
</html>