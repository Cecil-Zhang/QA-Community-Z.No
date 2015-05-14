<?php
class QuizAction extends Action {
	public function quiz(){
		//获得当前用户的积分
		$credit=$this->getUserCredit();
		//获得所有标签列表
		$tags=M('Tags');
		$list=$tags->select();
		$this->assign('list',$list);
		$this->assign('currentCredit',$credit);
		$this -> display();
		
	}
	
	public function submit(){
		//为question表添加一行
		$data['credit']=$_POST['credit'];
		$data['content']=$_POST['description'];
		$data['title']=$_POST['title'];
		$data['user_id']=$_SESSION['user_id'];
		$question=M('Questions');
		$re=$question->add($data);
		
		//为conquestag表添加数据
		$tags=$_POST['tag'];
		$data1['Qid']=$re;
		$conQT=M('Conquestag');
		foreach($tags as $tag){
			$data1['tag_id']=$tag;
			$conQT->add($data1);
		}
		
		$Person=M('Personelinfo');
		$Person->where('user_id='.$_SESSION['user_id'])->setInc('credit',5);
		//为用户减去悬赏的积分
		$where['user_id']=$_SESSION['user_id'];
		$data=$this->getUserCredit()-$_POST['credit'];
		$Person=M('Personelinfo');
		$result=$Person->where($where)->setField('credit',$data);
		$this->redirect('Browse/browse');
	}
	
	public function getTagsByCategoryId(){
		//根据分类ID查询数据库获取标签列表		
		if(isset($_POST['category_id'])){
			$category_id=$_POST['category_id'];
			$tags=M('Tags');
			$where['category_id']=$category_id;
			$tagList=$tags->where($where)->select();
			echo json_encode($tagList);
		}else{
			echo '无category_id';
		}
	}
	
	public function getUserCredit(){
		if(isset($_SESSION['user_id'])){
			$Person=M('Personelinfo');
			$where['user_id']=$_SESSION['user_id'];
			$result=$Person->where($where)->find();
			echo $result['credit'];
			return $result['credit'];
		}else{
			$this->redirect('Login/index');
		}
	}
	
}
?>
