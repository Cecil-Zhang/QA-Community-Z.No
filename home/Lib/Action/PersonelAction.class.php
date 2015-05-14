<?php 
	class PersonelAction extends Action{
		public function edit($error=''){
			if ((!isset($_SESSION['username'])) || empty($_SESSION['username'])){
				//表单的初始化
				$this->assign('username','必填');
				$this->assign('ifRequired','required');
				$this->assign('headImg',$_SESSION['headImg']);
				$this->assign('maleChk','checked');
				$this->assign('residence','银河系,中国');
				$this->assign('education','南京大学');
				$this->assign('profession','软件工程师');				
			}else{
				//从数据库读取用户数据
				$Person=M('Personelinfo');
				$User=M('User');
				$where['user_id']=$_SESSION['user_id'];
				$result=$Person->where($where)->find();
				$user_re=$User->where($where)->find();
				
				//为模板赋值
				$this->assign('username',$user_re['username']);
				$this->assign('ifRequired','disabled="disabled"');
				$this->assign('headImg',$_SESSION['headImg']);
				if ($result['gender']==1){
					$this->assign('maleChk','checked');
				}else{
					$this->assign('femaleChk','checked');
				}
				$this->assign('mood',$result['mood']);
				$this->assign('introduction',$result['introduction']);
				$this->assign('residence',$result['residence']);
				$this->assign('education',$result['education']);
				$this->assign('profession',$result['profession']);
			}
			$this->assign('error_msg',$error);
			$this -> display();
		}
		
		public function save(){
			define('GW_UPLOADPATH', 'Public/img/head/');
			define('GW_MAXFILESIZE', 1024*2048);      // 2MB
			
			if (isset($_POST['submit'])){
				$where['user_id']=$_SESSION['user_id'];
				
				//保存用户名和头像
				$user=M('User');
				if (isset($_POST['username'])){
					$username=$_POST['username'];
				}
				
				$headImg = $_FILES['headImg']['name'];
				$headImg_size = $_FILES['headImg']['size']; 
				//检查头像是否符合规则
				if (!empty($headImg)) {
					
					if (($headImg_size > 0) && ($headImg_size <= GW_MAXFILESIZE)) {
						
						if ($_FILES['headImg']['error'] == 0) {
							// Move the file to the target upload folder
							$target = GW_UPLOADPATH . $_SESSION['user_id'].$headImg;
							if (move_uploaded_file($_FILES['headImg']['tmp_name'], $target)) {
								$thumbnail=$_SESSION['user_id'].$headImg;
							}else {
								$error_msg="图片移动时出错，请重试";
								$this->redirect('Personel/edit/',array('error'=>$error_msg),0,'');
							}
						}else{
							$error_msg="图片上传时出错，请重试";
							$this->redirect('Personel/edit/',array('error'=>$error_msg),0,'');
						}
					}else {
						$error_msg="亲，图片过大，请换个small的";
						$this->redirect('Personel/edit/',array('error'=>$error_msg),0,'');
					}

					// Try to delete the temporary screen shot image file
					@unlink($_FILES['headImg']['tmp_name']);
				}
				
				if (isset($_POST['username'])){
					$data1['username']=$username;
				}
				if (isset($thumbnail)){
					$data1['image']=$thumbnail;
				}
				if (isset($username) || isset($thumbnail)){
					$result1=$user->where($where)->data($data1)->save();
					if ($result1){
						if (isset($username)){
							$_SESSION['username']=$data1['username'];
						}
						if (isset($thumbnail)){
							$_SESSION['headImg']=$data1['image'];
						}
					}
				}				
				
				//保存其余信息
				$person=M('Personelinfo');
				$data['gender']=$_POST['gender'];
				$data['mood']=$_POST['mood'];
				$data['introduction']=$_POST['introduction'];
				$data['residence']=$_POST['residence'];
				$data['education']=$_POST['education'];
				$data['profession']=$_POST['profession'];
				
				if ((!empty($_POST['gender'])) || (!empty($_POST['mood'])) || (!empty($_POST['introduction'])) || 
				 (!empty($_POST['education'])) || (!empty($_POST['profession'])) || (!empty($_POST['residence']))){
					$result=$person->where($where)->data($data)->save();
					$this->redirect('Personel/edit/');
				}
			}	
		}
		
		//验证用户上传的头像大小是否符合要求
		public function checkImg(){
			$_SESSION['headImg']='';
			if (isset($_POST['headImg']) && (!empty($_POST['headImg']))){
				$GW_UPLOADPATH='__PUBLIC__/img/head/';
				$GW_MAXFILESIZE=32768;      // 32 KB
				
				if (!(($headImg_size > 0) && ($headImg_size <= GW_MAXFILESIZE))) {
					$_SESSION['headImg']= "亲，图片过大，请换个small的";
				}
			}
		}
		
		public function showCredit(){
			$Person=M('Personelinfo');
			$where['user_id']=$_SESSION['user_id'];
			$credit=$Person->where($where)->getField('credit');
			$icon=$this->creditToIcon($credit);
			$this->assign('icon',$icon);
			$grade=$this->creditToGrade($credit);
			$this->assign('grade',$grade);
			
			$Starquestion=M('Starquestion');
			$Agreequestion=M('Agreequestion');
			$Agreereply=M('Agreereply');
			$Question=M('Questions');
			$Replies=M('Replies');
			$quiz=$Question->where($where)->count();
			$answer=$Replies->where($where)->count();
			$star=$Starquestion->where($where)->count();
			$agree1=$Agreequestion->where($where)->count();
			$agree2=$Agreereply->where($where)->count();
			$agree=$agree1+$agree2;
			$quizc=$quiz*10;
			$answerc=$answer*10;
			$agreec=$agree*5;
			$total=$quiz+$answerc+$agreec+50;
			$this->assign('quiz',$quiz);
			$this->assign('answer',$answer);
			$this->assign('agree',$agree);
			$this->assign('star',$star);
			$this->assign('quizc',$quizc);
			$this->assign('answerc',$answerc);
			$this->assign('agreec',$agreec);
			$this->assign('total',$total);
			$this->display();
		}
		
		public function creditToIcon($credit){
			$num=intval($credit);
			$result="truck";
			if($num>=100){
				$result="plane";
			}elseif($num>=300){
				$result="fighter-jet";
			}
			return $result;
		}
		
		public function creditToGrade($credit){
			$num=intval($credit);
			$result="学渣";
			if($num>=100){
				$result="学霸";
			}elseif($num>=300){
				$result="学神";
			}
			return $result;
		}
		
		public function myQuestion($user_id='@self'){
			$question = M('Questions'); // 实例化对象
			$user=M('User');
			$con=M('Conquestag');
			$tag=M('Tags');
			$agree=M('Agreequestion');
			$star=M('Starquestion');
			if (strcmp($user_id,'@self')==0){
				$user_id=$_SESSION['user_id'];
				$this->assign('username',$_SESSION['username']);
			}else{
				$temp=$user->where('user_id='.$user_id)->field('username')->find();
				$this->assign('username',$temp['username']);
			}
			$this->assign('user_id',$user_id);	
			import('ORG.Util.Page');// 导入分页类
			$que['user_id']=$user_id;
			$count = $question->where($que)->count();// 查询满足要求的总记录数
			$Page = new Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数
			$show = $Page->show();// 分页显示输出
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = $question->where($que)->order('publishDate')->limit($Page->firstRow.','.$Page->listRows)->select();
			
			$where3['user_id']=$user_id;
			$where4['user_id']=$user_id;
			for($i=0;$i<count($list);$i++){
				//查询问题发布者的用户名和头像
				$where['user_id']=$list[$i]['user_id'];
				$person=$user->where($where)->find();
				$list[$i]['username']=$person['username'];
				$list[$i]['image']=$person['image'];
				
				//查询该问题是否被当前用户同意过
				$where3['Qid']=$list[$i]['Qid'];
				$agreeResult=$agree->where($where3)->find();
				
				if($agreeResult!=false && $agreeResult!=NULL){
					$list[$i]['ifAgreed']='1';
				}else{
					$list[$i]['ifAgreed']='0';
				}
				
				//查询该问题是否被当前用户收藏过
				$where4['Qid']=$list[$i]['Qid'];
				$starResult=$star->where($where4)->find();
				if($starResult!=false && $starResult!=NULL){
					$list[$i]['ifStared']='1';
				}else{
					$list[$i]['ifStared']='0';
				}
				//查询问题的标签			
				$where1['Qid']=$list[$i]['Qid'];
				$result=$con->where($where1)->select();
				foreach($result as $re){
					$where2['tag_id']=$re['tag_id'];
					$singletag=$tag->where($where2)->find();
					$list[$i]['tags']=$list[$i]['tags'].' '. $singletag['tag'];
				}
			}
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			$this->display(); // 输出模板
		}
		
		public function myStar(){
			$Question=M('questions');
			$Conquestag=M('Conquestag');
			$User=M('User');
			$Tag=M('Tags');
			$star=M('Starquestion');
			$agree=M('Agreequestion');
			$user_id=$_SESSION['user_id'];
			$Starquestion=M('Starquestion');
			$qids=$Starquestion->where('user_id='.$user_id)->field('Qid')->select();
			$output=array();
			for($j=0;$j<count($qids);$j++){
				$qid=$qids[$j]['Qid'];
				$result=$Question->where('Qid='.$qid)->find();
				$tags=$Conquestag->where('Qid='.$qid)->select();
				$users=$User->where('user_id='.$result['user_id'])->find();
				$result['username']=$users['username'];
				$result['image']=$users['image'];
				$tagname='';
				foreach($tags as $tag){
					$temp=$Tag->where('tag_id='.$tag['tag_id'])->find();
					$tagname=$tagname.' '.$temp['tag'];
				}
				$result['tag']=$tagname;
				//查询该问题是否被当前用户收藏过
				$where4['Qid']=$qid;
				$where4['user_id']=$_SESSION['user_id'];
				$starResult=$star->where($where4)->find();
				if($starResult!=false && $starResult!=NULL){
					$result['ifStared']='1';
				}else{
					$result['ifStared']='0';
				}
				
				//查询该问题是否被当前用户同意过
				$where3['Qid']=$qid;
				$where3['user_id']=$_SESSION['user_id'];
				$agreeResult=$agree->where($where3)->find();
				
				if($agreeResult!=false && $agreeResult!=NULL){
					$result['ifAgreed']='1';
				}else{
					$result['ifAgreed']='0';
				}
				$output[$j]=$result;
			}	
			$this->assign('list',$output);// 赋值数据集
			$this->display(); // 输出模板
		}
		
		public function myAnswer($user_id='@self'){
			$user=M('User');
			if (strcmp($user_id,'@self')==0){
				$user_id=$_SESSION['user_id'];
				$this->assign('username',$_SESSION['username']);
			}else{
				$temp=$user->where('user_id='.$user_id)->field('username')->find();
				$this->assign('username',$temp['username']);
			}
			$this->assign('user_id',$user_id);
			//查询回答
			$Reply=M('Replies');
			$Question=M('Questions');
			
			$ans['user_id']=$user_id;
			$Agreereply=M('Agreereply');
			import('ORG.Util.Page');// 导入分页类
			$count = $Reply->where('user_id='.$user_id)->count();// 查询满足要求的总记录数
			$Page = new Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数
			$replies=$Reply->where('user_id='.$user_id)->order('publishDate desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			for($i=0;$i<count($replies);$i++){
				$ans['Rid']=$replies[$i]['Rid'];
				$agreeResult1=$Agreereply->where($ans)->find();
				//判断当前用户是否对该回答点过赞
				if($agreeResult1 != false && $agreeResult1 != NULL){
					$replies[$i]['ifAgreed']='1';
				}else{
					$replies[$i]['ifAgreed']='0';
				}
				
				//查询该回答的问题
				$where['Qid']=$replies[$i]['Qid'];
				$re=$Question->where($where)->field('Qid,title')->find();
				$replies[$i]['Qid']=$re['Qid'];
				$replies[$i]['title']=$re['title'];
			}
			
			$show = $Page->show();// 分页显示输出
			$this->assign('page',$show);// 赋值分页输出
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$this->assign('answerList',$replies);
			$this -> display();
		}
		
		public function homePage($user_id='@self'){
			if(strcmp($user_id,'@self')==0){
				$user_id=$_SESSION['user_id'];
			}
			//显示一个用户的个人主页
			$User=M('User');
			$user=$User->where('user_id='.$user_id)->field('username,image')->find();
			$Person=M('Personelinfo');
			$person=$Person->where('user_id='.$user_id)->find();
			$person['icon']=$this->creditToIcon($person['credit']);
			if ($person['gender']=="1"){
				$person['gender']="男";
			}else{
				$person['gender']="女";
			}
			$user=array_merge($user,$person);
			
			$this->assign('user',$user);
			$this->display();
		}
		
		public function changePassword(){
			$this->display();
		}
		
		public function chkPassword(){
			$pa=sha1($_POST['password']);
			$user=M('User');
			$password=$user->where('user_id='.$_SESSION['user_id'])->getField('password');
			if($password!=$pa){
				echo 'false';
			}else{
				echo 'true';
			}
		}
		
		public function submitPassword(){
			$new=sha1($_POST['newPass']);
			$user=M('User');
			$user->where('user_id='.$_SESSION['user_id'])->setField('password',$new);
			$this->redirect('Browse/browse');
		}
		
	}
	
?>
