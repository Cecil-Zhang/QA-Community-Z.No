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
	
    <!-- Custom styles for this template -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/signin.css" />
	
	<!-- 包括Font Awesome样式 -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/font-awesome.min.css" />
	
	 <!-- Bootstrap core CSS -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap.min.css" />
	
	<!-- 包括flat ui样式 -->
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/flat-ui.css" />
	
	<!-- 包括ueditor编辑器 -->
	<script type="text/javascript">
		window.UEDITOR_HOME_URL='__PUBLIC__/ueditor/';
		window.onload=function(){
			UE.getEditor('description',{	
				toolbars:[
					['fullscreen', '|', 'source', '|', 'undo','redo', '|', 'bold','italic','underline','fontborder','strikethrough','superscript', 'subscript', '|',
					'blockquote', 'pasteplain', '|', 'searchreplace', 'help', 'background','|','horizontal', 'date', 'time', 'spechars','|', 'link', 'unlink', 'anchor','emotion',  'attachment' ],
					[ 'autotypeset',  'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist','insertcode','|','paragraph', 'fontfamily', 'fontsize', '|',
					'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|' , 'simpleupload', 'insertimage']
				],
				initialFrameHeight:400,
				maximumWords:400
			});
		}
	</script>	
	
	<!-- 检查悬赏积分是否合法 -->
	<script type="text/javascript">
		function chkCredit(obj){
			 if(obj.value!=null){
				var result=isNaN(obj.value)  //检查是否为非数字
				if(result==false){
					var num=parseInt(obj.value);
					$.post('<?php echo U("Quiz/getUserCredit/");?>',function(data){
						var cre=parseInt(data);
						if(cre<num){	
							obj.value="";
							obj.placeholder="客官，悬赏积分大于可用积分"+cre+"，请少打赏一点";
							obj.focus();
						}else if(num<=0){
							obj.value="";
							obj.placeholder="客官，悬赏积分必须大于0，请大方点";
							obj.focus();
						}
					});
				}
			}
		}
		
		function chkForm(){
			var obj=document.getElementById("form");
			var num=UE.getEditor('description').getContentLength();
			if(obj.credit.value==""){
				obj.credit.focus();
			}else if(obj.title.value==""){
				obj.title.focus();
			}else if(obj.tag.value==""){
				obj.tag.focus();
			}else if(num>3000||num<=0){
				obj.description.focus();
			}else{
				var val=$("#tag").val();
				var content=UE.getEditor('description').getContent();
				if (parseInt(obj.credit.value)>0){
					var credit=obj.credit.value;
					var title=obj.title.value;
					$.post('<?php echo U("Quiz/submit/");?>',{'credit':credit,'title':title,'tag':val,'description':content});
					window.location.href="__APP__/Browse/browse";
					return true;
				}else{
					alert('悬赏积分必须大于0');
				}
			}
			return false;
		}
	</script>
	<title> 提问</title>
	
</head>
<body class="nopadding">
<?php require_cache("./Public/navbar.php"); ?>

<div class="container-fluid">
<div class="row personelrow">
<div class="page-header center text">
  <h1>提问</h1>
</div>
</div>

<form id="form" onsubmit="return chkForm()" role="form">
<!-- 问题积分 -->
<div class="form-group has-feedback row personelrow">
  <label for="credit" class="col-md-2 col-md-offset-2 control-label text infolabel">悬赏积分</label>
  <div class="input-group col-md-6">
  <input type="text" class="form-control" onblur="chkCredit(this)" placeholder="当前拥有积分:<?php echo ($currentCredit); ?>，问题解决后，积分将赠予解决者" id="credit"/>
  <span class="input-group-addon add-on"><i class="icon-bullhorn"></i></span>
  </div>
</div>

<!-- 问题标题 -->
<div class="form-group has-feedback row personelrow">
  <label for="title" class="col-md-2 col-md-offset-2 control-label text infolabel">标题</label>
  <div class="input-group col-md-6">
  <input type="text" placeholder="不超过30字" class="form-control" id="title"/>
  <span class="input-group-addon add-on"><i class="icon-medkit"></i></span>
  </div>
</div>

<!-- 问题标签 -->
<div class="form-group has-feedback row personelrow">
  <label for="tag" class="col-md-2 col-md-offset-2 control-label text infolabel">标签</label>
  <div class="input-group col-md-6">
	  <select data-toggle="select" multiple class="form-control multiselect multiselect-primary mrs mbm" id="tag">
        <?php if(is_array($list)): foreach($list as $key=>$vo): ?><option value="<?php echo ($vo["tag_id"]); ?>"><?php echo ($vo["tag"]); ?></option><?php endforeach; endif; ?>
      </select>
	  <span class="input-group-addon add-on"><i class="icon-tags"></i></span>
  </div>
</div>

<!-- 问题描述 -->
<div class="form-group row personelrow">
  <label for="description" class="col-md-2 col-md-offset-2 control-label text infolabel">描述</label>
  <div class="input-group col-md-6">
		<textarea id="description" name="description"></textarea>
  </div>
 
</div>

<!-- 提交和重置按钮 -->
<div class="row personelrow haspadding">
	<div class="form-group">
		<div class="col-md-2 col-md-offset-4">
			<input name="submit" type="submit" value="发布" class="btn btn-embossed btn-lg btn-primary inbutton""></input>
		</div>
		<div class="col-md-2">
			<input name="reset" type="reset" value="取消" class="btn btn-default btn-embossed btn-lg inbutton"></input>
		</div>
	</div>
</div>
</form>
</div>
<hr />
  <br/><p class="footer text center">Copyright &copy;2014 Z.Know, Inc.</p>
  
  <!-- UEditor插件 -->
  <script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.config.js"></script>
  <script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.all.min.js"></script>
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