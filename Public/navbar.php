<?php
// If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
  
  if (!isset($_SESSION['user_id'])) {
	$u=U('Login/index');
	header('Location:'.$u);
    exit();
  }
?>
<nav class="navbar navbar-inverse navbar-embossed navbar-fixed-top" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
      <span class="sr-only">Toggle navigation</span>
    </button>
    <a class="navbar-brand" href="#">Z.No</a>
  </div>
  <div class="collapse navbar-collapse" id="navbar-collapse-01">
    <ul class="nav navbar-nav">
      <li <?php if ($navactive=="homepage") echo 'class="active"';?>><a href="__APP__/Browse/browse">首页</a></li>
      <li <?php if ($navactive=="quiz") echo 'class="active"';?>><a href="__APP__/Quiz/quiz">提问</a></li>
	  <li <?php if ($navactive=="msgBoard") echo 'class="active"';?>><a href="__APP__/Board/board">留言板
		<?php
			$dbc = mysqli_connect('localhost', 'MrZhang', 'zhang', 'zno');
			$query = 'select unreadBoard from think_personelinfo where user_id="'.$_SESSION['user_id'].'"';
			$result = mysqli_query($dbc,$query);
			if(mysqli_num_rows($result)==1){
				$row=mysqli_fetch_array($result);
				if ($row[0]==1){
					echo '<span class="navbar-unread">2</span>';
				}
			}
		
		?>
	  </a></li>
    </ul>
	
    <form method="post" action="__APP__/Browse/search" class="navbar-form navbar-left form-inline"  role="search">
      <div class="form-group" >
		<input type="checkbox" name="scope" checked data-toggle="switch" data-on-text="搜人" data-off-text="搜问题" id="custom-switch-01" />
	  </div>
	  <div class="form-group">		
        <div class="input-group">
          <input class="form-control" id="navbarInput-01" type="search" placeholder="Search" name="search">
          <span class="input-group-btn">
            <button type="submit" class="btn" name="submit"><span class="fui-search"></span></button>
          </span>
        </div>
      </div>
    </form>
	
	<ul class="nav navbar-nav navbar-right" id="personel">
			<li><img src="__PUBLIC__/img/head/<?php echo $_SESSION['headImg']; ?>" alt="头像" class="img-rounded thumbnail"></img> 
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
			  <?php if (isset($_SESSION['username'])) echo $_SESSION['username']; else echo '无名氏'; ?> 
			  <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="__APP__/Personel/edit">个人信息</a></li>
				<li><a href="__APP__/Personel/changePassword">修改密码</a></li>
				<li><a href="__APP__/Personel/homePage">个人主页</a></li>
                <li><a href="__APP__/Personel/showCredit">积分与权限</a></li>
				<li class="divider"></li>
                <li><a href="__APP__/Personel/myQuestion">我的提问</a></li>
				<li><a href="__APP__/Personel/myAnswer">我的回答</a></li>
				<li><a href="__APP__/Personel/myStar">我的收藏</a></li>
              </ul>
            </li>
            <li><a href="__APP__/Login/logout">注销</a></li>
          </ul>
  </div><!-- /.navbar-collapse -->
</nav>