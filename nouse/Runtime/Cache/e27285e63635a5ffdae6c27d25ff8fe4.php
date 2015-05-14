<?php if (!defined('THINK_PATH')) exit();?>
<?php
 define('DIR','./Public/'); $page_title="personel"; require_once(DIR.'flat_first_header.php'); require_once(DIR.'connectvars.php'); echo '<body class="nopadding">'; $navactive=""; require_once(DIR.'navbar.php'); ?>

<div class="row personelrow">
	<div class="page-header center text">
		<h1>我的资料</h1>
	</div>
</div>

<div class="container-fluid" id="personeledit">
	
	<div class="row personelrow">
	<label class="col-md-2 col-md-offset-2 control-label text infolabel">资料完整度</label>
	<div class="progress" id="proBar">
	<div class="progress-bar" style="width: 40%;">40%</div>
	</div>
	</div>

	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form">
	<!-- 用户名 -->
	<div class="row personelrow">
		<div class="form-group">
			<label for="inputUsername" class="col-md-2 col-md-offset-2 control-label text infolabel">用户名</label>
			<div class="col-md-5">
				<div class="input-group">
				<input type="text" class="form-control" placeholder="<?php if (isset($_COOKIE['username'])) echo $_COOKIE['username']; else echo '哈哈怪'; ?>" />
				<span class="input-group-addon add-on"><i class="icon-user-md"></i></span>
				</div>
			</div>
		</div>
	</div>
	
	<!-- 头像 -->
	<div class="row personelrow">
		<div class="form-group">
			<label for="inputPic" class="col-md-2 col-md-offset-2 control-label text infolabel">头像</label>
			<div class="col-md-3">
				<div class="input-group">
				<input type="file" id="inputPic">
                <p class="help-block">支持JPG、PNG、GIF格式,不超过2M。</p>
				</div>
			</div>
		</div>
		<div class="col-md-2" id="headImg">
			<img src="./././Public/img/head/default.jpg" alt="头像" class="img-rounded img-responsive" id="head">
		</div>
	</div>
	
	<!-- 性别 -->
	<div class="row personelrow">
		<div class="form-group">
			  <label class="col-md-2 col-md-offset-2 control-label text infolabel">性别</label>
			  <div class="col-md-3">
				<ul class="list-inline">
					<li><label class="radio text infolabel" for="male">
						<input name="gender" type="radio" data-toggle="radio" value="male" id="male" required>
						男
						</label>
					</li>
					<li><label class="radio text infolabel" for="female">
						<input name="gender" type="radio" data-toggle="radio" value="female" id="female" required checked>
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
			<label for="inputMood" class="col-md-2 col-md-offset-2 control-label text infolabel">心情</label>
			<div class="col-md-5">
				<div class="input-group">
				<textarea class="form-control" rows="3" id="inputMood" placeholder="不多于30个字"></textarea>
				<span class="input-group-addon add-on"><i class="icon-edit"></i></span>
				</div>
			</div>
		</div>
	</div>
	
	<!-- 个人简介 -->
	<div class="row personelrow">
		<div class="form-group">
			<label for="inputIntroduction" class="col-md-2 col-md-offset-2 control-label text infolabel">个人简介</label>
			<div class="col-md-5">
				<div class="input-group">
				<textarea class="form-control" rows="6" id="inputIntroduction" placeholder="不多于150个字"></textarea>
				<span class="input-group-addon add-on"><i class="icon-camera"></i></span>
				</div>
			</div>
		</div>
	</div>
	
	<!-- 居住地 -->
	<div class="row personelrow">
		<div class="form-group">
			<label title="" data-placement="top" data-toggle="tooltip" data-original-title="输入内容后按回车" for="inputResidence" class="col-md-2 col-md-offset-2 control-label text infolabel">居住地</label>
			<div class="input-group col-md-5">
				<div class="tagsinput-primary">
				<input name="residence" class="tagsinput form-control" data-role="tagsinput" id="inputResidence" value="银河系,中国" />
				</div>
				
			</div>
		</div>
	</div>
	
	<!-- 职业经历 -->
	<div class="row personelrow">
		<div class="form-group">
			<label title="" data-placement="top" data-toggle="tooltip" data-original-title="输入内容后按回车" for="inputProfession" class="col-md-2 col-md-offset-2 control-label text infolabel">职业经历</label>
			<div class="input-group col-md-5">
				<div class="tagsinput-primary">
				<input name="profession" class="tagsinput form-control" data-role="tagsinput" id="inputProfession" value="软件工程师" />
				</div>
			</div>
		</div>
	</div>
	
	<!-- 教育经历 -->
	<div class="row personelrow">
		<div class="form-group">
			<label title="" data-placement="top" data-toggle="tooltip" data-original-title="输入内容后按回车" for="inputEducation" class="col-md-2 col-md-offset-2 control-label text infolabel">教育经历</label>
			<div class="input-group col-md-5">
				<div class="tagsinput-primary">
				<input name="education" class="tagsinput form-control" data-role="tagsinput" id="inputEducation" value="南京大学" />
				</div>
			</div>
		</div>
	</div>
	
	<!-- 提交和重置按钮 -->
	<div class="row personelrow">
		<div class="form-group">
			<div class="col-md-3 col-md-offset-4">
			<input name="submit" type="submit" value="保存修改" class="btn btn-inverse btn-embossed btn-lg"></input>
			</div>
			<div class="col-md-2">
			<input name="reset" type="submit" value="放弃修改" class="btn btn-default btn-embossed btn-lg"></input>
			</div>
		</div>
	</div>
	</form>	
</div>

<?php
 require_once(DIR.'footer.php'); ?>