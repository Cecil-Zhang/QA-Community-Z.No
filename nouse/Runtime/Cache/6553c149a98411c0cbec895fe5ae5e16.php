<?php if (!defined('THINK_PATH')) exit(); define('DIR','../../bootstrap'); $page_title='Log in'; require_once(DIR.'header.php'); require_once(DIR.'connectvars.php'); echo '<body class="nopadding">
		<div class="progress" style="height:80px; top:0px;">
		<div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
		<span class="sr-only">45% Complete</span>
		<div class="heading text">Z.No - ' . $page_title . '</div></div>
		</div>'; $error_msg = ""; $success_msg = ""; if (!isset($_SESSION['user_id'])){ if (isset($_POST['login'])){ $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); $user_mailbox = mysqli_real_escape_string($dbc, trim($_POST['mailbox'])); $user_password = mysqli_real_escape_string($dbc, trim($_POST['password'])); if (!empty($user_mailbox) && !empty($user_password)) { $user_verify=$_POST['verify']; if (sha1($user_verify)==$_SESSION['pass_phrase']){ $query = "select * from user where usermail='$user_mailbox' and password=SHA('$user_password')"; $result = mysqli_query($dbc,$query); if (mysqli_num_rows($result)==1){ $row=mysqli_fetch_array($result); $_SESSION['user_id'] = $row['user_id']; $_SESSION['username'] = $row['username']; setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30)); setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30)); $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/homepage.php'; header('Location: ' . $home_url); }else { $query1 ="select * from user where usermail='$user_mailbox'"; $result1=mysqli_query($dbc,$query1); if (mysqli_num_rows($result1)==1){ $error_msg = '密码错误，请重试。'; }else{ $error_msg = '账号不存在，请重试。'; } } }else{ $error_msg = '验证码错误，请重试。'; } }else { $error_msg = 'Sorry, you must enter your mailbox and password to log in.'; } }elseif (isset($_POST['signup'])){ $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); $user_mailbox = mysqli_real_escape_string($dbc, trim($_POST['mailbox'])); $user_password = mysqli_real_escape_string($dbc, trim($_POST['password'])); if (!empty($user_mailbox) && !empty($user_password)) { $user_verify=$_POST['verify']; if (sha1($user_verify)==$_SESSION['pass_phrase']){ $query = "select * from user where usermail='$user_mailbox'"; $result = mysqli_query($dbc,$query); if (mysqli_num_rows($result)!=0){ $error_msg="邮箱已被注册，请重试！"; }else{ $query1="insert into user(usermail,password) values('$user_mailbox',SHA('$user_password'))"; $result1=mysqli_query($dbc,$query1); if($result){ $query2="select user_id from user where usermail='$user_mailbox'"; $result2=mysqli_query($dbc,$query2); if(mysqli_num_rows($result)==1){ $row2=mysqli_fetch_array($result2); $query3="insert into personelinfo(user_id) values('$row['user_id'])"; if (mysqli_query($dbc,$query3){ $success_msg="注册成功，请登录！"; } }else{ $error_msg='邮箱重复'; } }else{ $error_msg='插入失败'; } } }else{ $error_msg = '验证码错误，请重试。'; } }else { $error_msg = 'Sorry, you must enter your mailbox and password to log in.'; } } } ?>

	<div class="container" style="margin-top:60px;">	
	<div class="pull-left"><img src="img/preview.png" width="500px" height="360px" alt="previw" id="icons"></div>
	
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-signin pull-right" role="form" id="login">
		<h2 class="form-signin-heading" style="text-align:center">Hellow World</h2>
		<span class="add-on"><i class="icon-envelope"></i></span>
		<input type="email" name="mailbox" class="form-control" placeholder="Email address" value="<?php if (!empty($user_username)) echo $user_mailbox; ?>" required>	
		
		<span class="add-on"><i class="icon-key"></i></span>
		<input type="password" name="password" class="form-control" placeholder="Password" required>				
		
		<span class="add-on"><i class="icon-coffee"></i></span>
		<input type="text" name="verify" placeholder="Verification"  style="width:11.5em" required><img src="captcha.php" alt="Verification pass-phrase" 
			class="img-thumbnail" style="margin:5px;"/>
       
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
        
        <div>
		<input class="btn btn-primary inbutton" type="submit" value="Log in" name="login">
		<input class="btn btn-warning inbutton" type="submit" value="Sign up" name="signup">
		</div>
		
	</form>
	</div>
	<?php  if (!empty($error_msg)) { echo '<div class="alert alert-danger text" role="alert" id="inerror"><span class="add-on"><i class="icon-minus-sign"></i></span>  '.$error_msg.'</div>'; }elseif (!empty($success_msg)){ echo '<div class="alert alert-info text" role="alert" id="inerror"><span class="add-on"><i class="icon-fighter-jet"></i></span>  '.$success_msg.'</div>'; } ?>
	
		<!--<fieldset>
			<legend>Log In</legend>
			<label for="mailbox">邮箱:</label>
			<input type="text" name="mailbox" value="" /><br />
			<label for="password">密码:</label>
			<input type="password" name="password" /><br />
			<label for="verify">验证码:</label>
			<input type="text" id="verify" name="verify" value="" /> <img src="captcha.php" alt="Verification pass-phrase" />
		</fieldset>
		<input type="submit" value="Log In" name="submit" />
		-->
	
	

<?php
 mysqli_close($dbc); require_once(DIR.'footer.php'); ?>
</body>
</html>