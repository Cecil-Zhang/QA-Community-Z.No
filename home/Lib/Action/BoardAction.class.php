<?php 
	class BoardAction extends Action{
		
		public function board($user_id='@self'){			
			//查询留言板
			if(strcmp($user_id,'@self')==0){
				//查看自己的留言板
				$user_id=$_SESSION['user_id'];
				//清空未读消息
				$Person=M('Personelinfo');
				$Person->where('user_id='.$user_id)->setField('unreadBoard','0');
			}
			$Board=M('Board');
			$User=M('User');
			$username=$User->where('user_id='.$user_id)->getField('username');
			$this->assign('username',$username);
			$this->assign('user_id',$user_id);
			import('ORG.Util.Page');// 导入分页类
			$count = $Board->where('to_id='.$user_id)->count();// 查询满足要求的总记录数
			$Page = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
			$show = $Page->show();// 分页显示输出
			$msgs=$Board->where('to_id='.$user_id)->order('date desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			for($i=0;$i<$count;$i++){
				$where['user_id']=$msgs[$i]['from_id'];
				$user=$User->where($where)->find();
				//查询留言人的用户名,头像
				$msgs[$i]['username']=$user['username'];
				$msgs[$i]['image']=$user['image'];
			}
			$this->assign('msgList',$msgs);
			
			$this->assign('page',$show);// 赋值分页输出
			$this -> display();
		}
		
		public function leaveMsg(){
			$Board=M('Board');
			$data['from_id']=$_SESSION['user_id'];
			$data['to_id']=$_POST['userid'];
			$data['message']=$_POST['description'];
			$Board->add($data);
			
			$Person=M('Personelinfo');
			$Person->where('user_id='.$data['to_id'])->setField('unreadBoard','1');
			$this->redirect('Board/board',array('user_id'=>$data['to_id']));
		}
	}
	
?>
