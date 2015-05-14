<?php
class BrowseAction extends Action {
	public function browse($sort='publishDate'){
		$this->assign($sort,'active');
		
		$question = M('Questions'); // 实例化User对象
		import('ORG.Util.Page');// 导入分页类
		$count = $question->count();// 查询满足要求的总记录数
		$Page = new Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数
		$show = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $question->order($sort.' desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$user=M('User');
		$con=M('Conquestag');
		$tag=M('Tags');
		$agree=M('Agreequestion');
		$star=M('Starquestion');
		$where3['user_id']=$_SESSION['user_id'];
		$where4['user_id']=$_SESSION['user_id'];
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
	
	public function agree(){
		$question=M('Questions');
		$where['Qid']=$_POST['Qid'];;
		$agreeNum=$_POST['agreeNum'];
		$result=$question->where($where)->setField('agreeNum',$agreeNum+1);
		$data['Qid']=$_POST['Qid'];
		$data['user_id']=$_SESSION['user_id'];
		$agree=M('Agreequestion');
		$agree->add($data);
		$Person=M('Personelinfo');
		$Person->where('user_id='.$_SESSION['user_id'])->setInc('credit',5);
		echo $result;
	}
	
	public function star(){
		$question=M('Questions');
		$where['Qid']=$_POST['Qid'];;
		$starNum=$_POST['starNum'];
		$result=$question->where($where)->setField('starNum',$starNum+1);
		$data['Qid']=$_POST['Qid'];
		$data['user_id']=$_SESSION['user_id'];
		$Star=M('Starquestion');
		$Star->add($data);
		echo $result;
	}
	
	public function search(){
		$search=$_POST['search'];
		$scope=$_POST['scope'];
		if ($scope=='on'){
			//搜人
			$this->redirect('Browse/findPeople',array('search'=>$search),0,'');
		}else{
			//搜问题
			$this->redirect('Browse/findQuestion',array('search'=>$search),0,'');
		}
	}
	
	public function findQuestion($search){
		//搜问题
		$Question=M('Questions');
		$star=M('Starquestion');
		$agree=M('Agreequestion');
		$Tag=M('Tags');
		$Conquestag=M('Conquestag');
		$User=M('User');
		$questions=array();
		//找到符合搜索条件的标签
		$like1['tag']=array('like',"%$search%");
		$tags=$Tag->where($like1)->field('tag_id')->select();
		$qids=array();
		foreach($tags as $tag){
			$result=$Conquestag->where('tag_id='.$tag['tag_id'])->field('Qid')->select();
			foreach($result as $temp){
				if(!in_array($temp['Qid'],$qids)){
					array_push($qids,$temp['Qid']);
				}
			}
		}
		
		$like2['title|content']=array('like',"%$search%");
		$result=$Question->where($like2)->field('Qid')->select();
		foreach($result as $one){
			if(!in_array($one['Qid'],$qids)){
					array_push($qids,$one['Qid']);
			}
		}
		$output=array();
		for($j=0;$j<count($qids);$j++){
			$qid=$qids[$j];
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
		$this->assign('search',$search);
		$this->display(); // 输出模板
	}
	
	public function findPeople($search){
			//搜人
			$User=M('User');
			$Person=M('Personelinfo');
			$output=array();
			$like1['username']= array('like',"%$search%");
			$result=$User->where($like1)->field('user_id,username,image')->select();
			for($i=0;$i<count($result);$i++){
				$output[$i]=array();
				$output[$i]=array_merge($output[$i],$result[$i]);
				$one=$Person->where('user_id='.$output[$i]['user_id'])->find();
				$output[$i]=array_merge($output[$i],$one);
			}
			
			$like2['residence|education|profession|mood|introduction']=array('like',"%$search%");
			
			$result2=$Person->where($like2)->select();
			for($i=count($result);$i<(count($result)+count($result2));$i++){
				$output[$i]=array();
				$output[$i]=array_merge($output[$i],$result2[$i-count($result)]);
				$one=$User->where('user_id='.$output[$i]['user_id'])->field('user_id,username,image')->find();
				$output[$i]=array_merge($output[$i],$one);
			}
			$this->assign('list',$output);
			$this->assign('search',$search);
			$this->display();
	}
}
?>
