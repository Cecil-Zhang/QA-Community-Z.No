<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
		//$Data = M('Data'); // 实例化Data数据模型
        
        $this->display();
	}
	
	public function showuser(){
        $Data = M('User'); // 实例化Data数据模型
        $this->data = $Data->select();
        $this->display();
    }

}