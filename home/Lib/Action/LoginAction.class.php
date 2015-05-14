<?php
	class LoginAction extends Action{
		
		public function index(){
			if(isset($_POST['login'])){
				if ($_SESSION['ifPass'] =='true'){
					$user=M('User');
					$usermail=trim($_POST['mailbox']);
					$password=trim($_POST['password']);
					$where['usermail']=$usermail;
					$where['password']=sha1($password);
					$count1=$user->where($where)->count();
					if ($count1==1){
						$r=$user->where($where)->select();
						$row=$r[0];
						$_SESSION['user_id'] = $row['user_id'];
						$_SESSION['username'] = $row['username'];
						$_SESSION['headImg']=$row['image'];
						setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
						setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
						setcookie('headImg', $row['image'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
						//跳转到主界面
						$_SESSION['ifPass'] ='';
						$this->redirect('Browse/browse');
					}else{
						$count=$user->where("usermail='$usermail'")->count();
						if($count==1){
							$this->assign('error_msg','密码错误，请重试');
						}else{
							$this->assign('error_msg','用户名不存在，请重试');
						}
						$this->display();
					}
				}else{
					$this->assign('error_msg','验证码错误，请重试');
					$this->display();
				}
			}elseif(isset($_POST['signup'])){
				$this->signup();
			}else{
				$this->display();
			}
		}
		
		public function signup(){
			$user_mailbox = $_POST['mailbox'];
			$user_password = $_POST['password'];
			if (strlen($user_password)>5){
				if ($_SESSION['ifPass'] =='true'){
					
					$user=M('User');
					$where['usermail']=$user_mailbox;
					$count=$user->where($where)->count();
					if ($count==0){
						$data['usermail']=$user_mailbox;
						$data['password']=sha1($user_password);
						$new_id=$user->add($data);
						
						if (!$new_id){
							$this->assign('error_msg','用户注册失败，请重试');
							$this->display();
						}else{
							$personelinfo=M('Personelinfo');
							$data1['user_id']=$new_id;
							$data1['image']='default.jpg';
							$re=$personelinfo->add($data1);
							if (!$re){
								$this->assign('error_msg','添加个人信息失败，请重试');
								$this->display();
							}else{
								//注册成功
								$_SESSION['user_id'] = $new_id;
								setcookie('user_id', $re, time() + (60 * 60 * 24 * 30));    // expires in 30 days
								$_SESSION['headImg'] = 'default.jpg';
								setcookie('headImg', 'default.jpg', time() + (60 * 60 * 24 * 30));    // expires in 30 days
								$_SESSION['ifPass'] ='';
								$this->redirect('Personel/edit');
							}
						}
					}else{
						$this->assign('error_msg','该邮箱已被注册，请重试');
						$this->display();
					}
				}else{
					$this->assign('error_msg','验证码错误，请重试');
					$this->display();
				}
			}else{
				$this->assign('error_msg','密码长度需大于6位，请重试');
				$this->display();
			}
		}		
		
		public function checkVerify(){
			$verify=$_POST['verify'];
			if (sha1($verify)==$_SESSION['pass_phrase']){
				$_SESSION['ifPass'] = 'true';
				echo 1;
			}else{	
				$_SESSION['ifPass'] = 'false';
				echo 0;
			}
			
		}
		
		public function logout(){
		  if (isset($_SESSION['user_id'])) {
			// Delete the session vars by clearing the $_SESSION array
			$_SESSION = array();

			// Delete the session cookie by setting its expiration to an hour ago (3600)
			if (isset($_COOKIE[session_name()])) {
			  setcookie(session_name(), '', time() - 3600);
			}

			// Destroy the session
			session_destroy();
		  }

		  // Delete the user ID and username cookies by setting their expirations to an hour ago (3600)
		  setcookie('user_id', '', time() - 3600);
		  setcookie('username', '', time() - 3600);
		  $this->redirect('Login/index');
		}
	}
?>