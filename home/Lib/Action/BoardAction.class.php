<?php 
	class BoardAction extends Action{
		
		public function board($user_id='@self'){			
			//��ѯ���԰�
			if(strcmp($user_id,'@self')==0){
				//�鿴�Լ������԰�
				$user_id=$_SESSION['user_id'];
				//���δ����Ϣ
				$Person=M('Personelinfo');
				$Person->where('user_id='.$user_id)->setField('unreadBoard','0');
			}
			$Board=M('Board');
			$User=M('User');
			$username=$User->where('user_id='.$user_id)->getField('username');
			$this->assign('username',$username);
			$this->assign('user_id',$user_id);
			import('ORG.Util.Page');// �����ҳ��
			$count = $Board->where('to_id='.$user_id)->count();// ��ѯ����Ҫ����ܼ�¼��
			$Page = new Page($count,10);// ʵ������ҳ�� �����ܼ�¼����ÿҳ��ʾ�ļ�¼��
			$show = $Page->show();// ��ҳ��ʾ���
			$msgs=$Board->where('to_id='.$user_id)->order('date desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			for($i=0;$i<$count;$i++){
				$where['user_id']=$msgs[$i]['from_id'];
				$user=$User->where($where)->find();
				//��ѯ�����˵��û���,ͷ��
				$msgs[$i]['username']=$user['username'];
				$msgs[$i]['image']=$user['image'];
			}
			$this->assign('msgList',$msgs);
			
			$this->assign('page',$show);// ��ֵ��ҳ���
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
