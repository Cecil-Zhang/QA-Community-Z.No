<?php
class AnswerAction extends Action {
	public function answer($qid){
		//查询问题
		$Question=M('Questions');
		$qu=$Question->where('Qid='.$qid)->find();
		$readNum=$qu['readNum']+1;
		//问题阅读数+1
		$Question->where('Qid='.$qid)->setField('readNum',$readNum);
		
		//查询问题标签
		$Con=M('Conquestag');
		$Tag=M('Tags');
		$tags=$Con->where('Qid='.$qid)->field('tag_id')->select();
		for($i=0;$i<count($tags);$i++){
			$temp=$Tag->where('tag_id='.$tags[$i]['tag_id'])->field('tag')->find();
			$taglist[$i]=$temp['tag'];
		}
		$this->assign('tagList',$taglist);
		
		//查询问题发布者的用户名,头像,等级,职业
		$where['user_id']=$qu['user_id'];
		$User=M('User');
		$questioner=$User->where($where)->find();
		$Person=M('Personelinfo');
		$person=$Person->where($where)->field('profession,credit')->find();
		$questioner['pros']=split(',',$person['profession']);
		$questioner['grade']=$this->transformCredit($questioner['credit']);
		$this->assign('questioner',$questioner);
		
		//如果该问题的发布者就是当前用户且该问题尚未被采纳，显示采纳按钮
		if (($qu['user_id']==$_SESSION['user_id']) && ($qu['ifFixed']==-1)){
			$this->assign('showAccept','yes');
		}else{
			$this->assign('showAccept','no');
		}
			
		//查询该问题是否被当前用户同意过
		$where3['Qid']=$qu['Qid'];
		$where3['user_id']=$_SESSION['user_id'];
		$Agree=M('Agreequestion');
		$agreeResult=$Agree->where($where3)->find();
			
		if($agreeResult!=false && $agreeResult!=NULL){
			$qu['ifAgreed']='1';
		}else{
			$qu['ifAgreed']='0';
		}
			
		//查询该问题是否被当前用户收藏过
		$where4['Qid']=$qu['Qid'];
		$where4['user_id']=$_SESSION['user_id'];
		$Star=M('Starquestion');
		$starResult=$Star->where($where4)->find();
		
		if($starResult!=false && $starResult!=NULL){
			$qu['ifStared']='1';
		}else{
			$qu['ifStared']='0';
		}
		$this->assign('question',$qu);
		
		//查询回答		
		$Reply=M('Replies');
		import('ORG.Util.Page');// 导入分页类
		$count = $Reply->where('Qid='.$qid)->count();// 查询满足要求的总记录数
		$Page = new Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数
		$show = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$replies = $Reply->where('Qid='.$qid)->order('agreeNum desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$ans['user_id']=$_SESSION['user_id'];
		$Agreereply=M('Agreereply');
		
		//如果该问题已被采纳，将采纳答案优先显示
		if($qu['ifFixed']>-1){
			for($i=0;$i<count($replies);$i++){
				if($replies[$i]['Rid']==$qu['ifFixed']){
					$replies[$i]['accept']='yes';
					$tem=$replies[$i];
					$replies[$i]=$replies[0];
					$replies[0]=$tem;
				}
			}
		}
		//对每一个回答查询是否被当前用户点赞过
		for($i=0;$i<count($replies);$i++){
			$ans['Rid']=$replies[$i]['Rid'];
			$agreeResult1=$Agreereply->where($ans)->find();
			if($agreeResult1 != false && $agreeResult1 != NULL){
				$replies[$i]['ifAgreed']='1';
			}else{
				$replies[$i]['ifAgreed']='0';
			}
		
			$user=$User->where('user_id='.$replies[$i]['user_id'])->find();
			$personel=$Person->where('user_id='.$replies[$i]['user_id'])->field('profession,credit')->find();
			$replies[$i]['username']=$user['username'];
			$replies[$i]['image']=$user['image'];
			$replies[$i]['grade']=$this->transformCredit($personel['profession']);
			$replies[$i]['pros']=$personel['profession'];
		}
		$this->assign('answerList',$replies);
		$this->assign('page',$show);// 赋值分页输出
		$this -> display();
	}
	
	public function transformCredit($credit){
		$num=intval($credit);
		$result="truck";
		if($num>=100){
			$result="plane";
		}elseif($num>=300){
			$result="fighter-jet";
		}
		return $result;
	}
	
	public function submitAnswer(){
		//保存当前用户的回答
		$user_id=$_SESSION['user_id'];
		$qid=$_POST['qid'];
		$content=$_POST['description'];
		$Reply=M('Replies');
		$count=$Reply->where('Qid='.$qid)->count();
		$data['user_id']=$user_id;
		$data['Qid']=$qid;
		$data['reply']=$content;
		$data['floors']=$count+1;
		$result=$Reply->add($data);
		
		//问题回答数+1
		$Question=M('Questions');
		$Question->where('Qid='.$qid)->setInc('answerNum',1);
		$Person=M('Personelinfo');
		$Person->where('user_id='.$_SESSION['user_id'])->setInc('credit',10);
		$this->redirect('Answer/answer',array('qid'=>$qid),0,'');
	}
	
	public function agreeReply(){
		//回答点赞数+1
		$Reply=M('Replies');
		$where['Rid']=$_POST['Rid'];;
		$agreeNum=$_POST['agreeNum'];
		$result=$Reply->where($where)->setField('agreeNum',$agreeNum+1);
		
		$data['Rid']=$_POST['Rid'];
		$data['user_id']=$_SESSION['user_id'];
		$agree=M('Agreereply');
		$agree->add($data);
		echo $result;
	}
	
	public function acceptReply(){
		//采纳回答
		$rid=$_GET['rid'];
		$where['Qid']=$_GET['qid'];
		$Question=M('Questions');
		$User=M('User');
		$Reply=M('Replies');
		$result=$Question->where($where)->setField('ifFixed',$rid);
		
		//提问人扣除积分
		$gift=$Question->where($where)->field('user_id,credit')->find();
		$credit=$User->where('user_id='.$gift['user_id'])->field('credit')->find();
		$credit=$credit-$gift['credit'];
		$User->where('user_id='.$gift['user_id'])->setField('credit',$credit);
		//回答者加上积分
		$giftto=$Reply->where('Rid='.$rid)->field('user_id')->find();
		$credit2=$User->where('user_id='.$giftto['user_id'])->field('credit')->find();
		$credit2=$credit2+$gift['credit'];
		$User->where('user_id='.$giftto['user_id'])->setField('credit',$creidt2);
		$this->redirect('Answer/answer',array('qid'=>$where['Qid']),0,'');
	}
}
?>
