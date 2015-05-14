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
		
		function acceptReply(obj){
			var rid=obj.value;
			var qid=document.getElementById('agree').value;
			alert(rid);
			$.post('<?php echo U("Answer/acceptReply");?>',{'Rid':rid,'Qid':qid});
			window.location.href="__URL__/answer/qid/"+qid;
		}
		
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
		
		function checkForm(){
			var str=UE.getEditor('description').getContentLength();
			var num=parseInt(str);
			if(num<=3000 && num>0){
				return true;
			}else{
				return false;
			}
			
		}
	</script>
	<title> 回答</title>
</head>
</body class="haspadding">
<?php require_cache("./Public/navbar.php"); ?>

<div class="container-fluid">
<div class="row personelrow">
	<div class="col-lg-4 col-lg-offset-4  center">
		<strong class="h5 center"><?php echo ($question["title"]); ?></strong>
		<?php  if(strcmp($question['ifFixed'],"-1")!=0){ echo '<button type="button" class="btn btn-sm btn-success pull-right" id="fix">已解决 <span class="glyphicon glyphicon-ok"></span></button>'; }else{ echo '<button type="button" class="btn btn-sm btn-primary pull-right" id="notfix" >未解决 <span class="glyphicon glyphicon-remove"></span></button>'; } ?>
		
	</div>
</div>

<!-- 问题悬赏积分和标签 -->
<div class="row personelrow">
	<div class="col-lg-offset-4 col-lg-2 text">
	悬赏积分：<?php echo ($question["credit"]); ?>
	</div>
	<div class="col-lg-4 button-group">
		<?php if(is_array($tagList)): foreach($tagList as $key=>$tag): ?><button type="button" class="btn btn-default btn-sm leftMargin"><?php echo ($tag); ?></button><?php endforeach; endif; ?>
	</div>
</div>


<!-- 问题描述，提问人描述 -->
<div class="row personelrow">
	<div class="col-lg-1 col-lg-offset-2">
		<a href="__APP__/Personel/homePage/user_id/<?php echo ($questioner["user_id"]); ?>"><img src="__PUBLIC__/img/head/<?php echo ($questioner["image"]); ?>" alt="头像" class="img-rounded img-responsive headImg"></a>
		<div class="center">
			<strong><i class="icon-<?php echo ($questioner["grade"]); ?>"></i><a href="__APP__/Personel/homePage/user_id/<?php echo ($questioner["user_id"]); ?>"><?php echo ($questioner["username"]); ?></a></strong>
			<?php if(is_array($questioner["pros"])): foreach($questioner["pros"] as $key=>$pro): ?><p class="sxText"><strong><u><?php echo ($pro); ?></u></strong></p><?php endforeach; endif; ?>
		</div>
	</div>
	<div class="col-lg-7">
		<h6><strong class="text">问题描述</strong>
		</h6>
		<div class="content"><?php echo ($question["content"]); ?></div>
		<span class="tag"><?php echo ($question["publishDate"]); ?></span>
		<div class="btn-group pull-right">
			<button type="button" class="btn btn-primary leftMargin" onclick="agree(this)" id="agree" value="<?php echo ($question["Qid"]); ?>" <?php if(strcmp($question['ifAgreed'],"1")==0) echo 'disabled="disabled"'; ?>><span class="glyphicon glyphicon-heart"></span>赞同 <?php echo ($question["agreeNum"]); ?></button>
			<button type="button" class="btn btn-primary leftMargin" onclick="star(this)" value="<?php echo ($question["Qid"]); ?>" <?php if(strcmp($question['ifStared'],"1")==0) echo 'disabled="disabled"'; ?>><span class="glyphicon glyphicon-send"></span> 收藏 <?php echo ($question["starNum"]); ?></button>
		</div>
	</div>
</div>

<!-- 回答 -->
<?php if(is_array($answerList)): foreach($answerList as $key=>$answer): require_cache("./Public/navbar.php"); ?>
<div class="row personelrow">
	<div class="col-lg-1 col-lg-offset-2">
		<a href="__APP__/Personel/homePage/user_id/<?php echo ($answer["user_id"]); ?>"><img src="__PUBLIC__/img/head/<?php echo ($answer["image"]); ?>" alt="头像" class="img-rounded img-responsive thumbnail"></a>
		<strong class="username"><i class="icon-<?php echo ($answer["grade"]); ?>"></i><a href="__APP__/Personel/homePage/user_id/<?php echo ($questioner["user_id"]); ?>"><?php echo ($answer["username"]); ?></a></strong>
	</div>
	<div class="col-lg-7">
		<p class="text"><?php echo ($answer["reply"]); ?></p>
		<ul class="list-inline pull-right">
			<li><footer><strong><?php echo ($answer["pros"]); ?></strong></footer></li>
			<li><footer><strong><u><?php echo ($answer["floors"]); ?>楼 编辑于<?php echo ($answer["publishDate"]); ?></u></strong></footer></li>
			<li><button type="button" class="btn btn-primary btn-sm" value="<?php echo ($answer["Rid"]); ?>" onclick="agreeReply(this)"<?php if(strcmp($answer['ifAgreed'],"1")==0) echo 'disabled="disabled"';?>><span class="glyphicon glyphicon-thumbs-up"></span> <?php echo ($answer["agreeNum"]); ?></button></li>
			<?php  if(strcmp($showAccept,'yes')==0){ echo '<li><a href="__URL__/acceptReply/qid/'.$question['Qid'].'/rid/'.$answer['Rid'].'"><button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-thumbs-ok"></span>采纳</button></a></li>'; } if(strcmp($answer['accept'],'yes')==0){ echo '<li><button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-thumbs-ok"></span>已采纳</button></li>'; } ?>
		</ul>
		<div class="btn-group pull-right">
			
		</div>
	</div>
</div><?php endforeach; endif; ?>

<!-- 分页 -->
<div class="row personelrow">
<div class="col-lg-4 col-lg-offset-8">
<?php echo ($page); ?>
</div>
</div>

<hr />
<form method="post" action="__URL__/submitAnswer" onsubmit="return checkForm()" id="form" role="form">
<!-- 回答编辑框 -->
<div class="form-group row personelrow haspadding">
<div class="col-lg-offset-3 col-md-6"><textarea id="description" name="description"></textarea></div>
</div>

<!-- 提交和取消按钮 -->
<div class="row personelrow">
	<div class="form-group">
		<input type="hidden" name="qid" value="<?php echo ($question["Qid"]); ?>"></input>
		<div class="col-md-2 col-md-offset-4">
			<input type="submit" name="submit" value="发布" class="btn btn-embossed btn-lg btn-primary mybutton" ></input>
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
  <!-- UEditor插件 -->
  <script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.config.js"></script>
  <script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.all.min.js"></script>
  <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
  <script type="text/javascript" src="__PUBLIC__/js/vendor/jquery.min.js"></script>
  <!-- 包括所有已编译的插件 -->
  <script type="text/javascript" src="__PUBLIC__/js/flat-ui.min.js"></script>
  
  <script type="text/javascript" src="__PUBLIC__/assets/js/application.js"></script>
  <script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.parse.js"></script>
  <script>
      $(function () {
        $('[data-toggle=tooltip]').tooltip();
      });
  </script>
  
  
</body>
</html>